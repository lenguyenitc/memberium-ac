<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}



class wpal_ecomm_stripe_functions {

	private $meta_keys = [
		'payment_intent_id',
		'payment_details',
		'payment_method_id'
	];

	
	
function new_wp_order_args( $args, $order_id, $data, $prefix ){

		foreach ($this->meta_keys as $key) {
			if( isset($data[$key]) ){
				$args['meta_input']["{$prefix}{$key}"] = $data[$key];
			}
		}

		return $args;
	}

	
	
function new_wp_order_created( $response, $data ){

		$ns = 'wpal_ecomm';
		$order_functions = wpal_ecomm()->functions();
		$meta_prefix = $order_functions->get_prefix();

		$user_id = $data['user_id'];
		$order_id = $response['order_id'];
		$response['subscription'] = false;

		$profile_id = $data['profile_id'];
		$merchant_profile = wpal_ecomm()->settings->get_merchant_profile($profile_id);
		$payment_intent_id = $data['payment_intent_id'];
		$merchant_profile['payment_intent_id'] = $payment_intent_id;
		$config = $this->stripe->setup($merchant_profile);

				$sandbox_text = $order_functions->sandbox_text($order_id);
		$sandbox = ( $sandbox_text > '' );

				$customer_error = false;
		$customer_id = $this->maybe_create_customer($merchant_profile, $data);
		if( is_wp_error($customer_id) ){
			$customer_error = $customer_id->get_error_code();
			if( $customer_error === 'card_error' ){
				$response['card_error'] = $customer_id->get_error_message();
			}
			else {
				$response['error'] = $customer_id;
			}
			$customer_id = '';
		}
		$data['stripe_customer'] = $data['customer_id'] = $response['customer_id'] = $customer_id;

		$update_intent = isset($data['update_intent']) ? (int)$data['update_intent'] : 0;
		if( $update_intent > 0 ){
			$this->update_session($data);
		}
		$total = $data['cart']['total'];
		$logs = wpal_ecomm_order_logs::get_instance();
		$link = 'failed';
		$transaction_id = $payment_intent_id;

				if( $data['type'] === 'subscription' ){
			if( $customer_error ){
				$response['subscription'] = false;
				$order_functions->update_order_status( $order_id, 'failed' );
			}
			else {

								$invoices = wpal_ecomm()->invoices();
				$invoice_id = $invoices->generate_first_invoice( $order_id, $data );
				update_post_meta($order_id,"{$meta_prefix}initial/invoice", $invoice_id);

								$subscription = $this->stripe->subscriptions()->new_subscription( $merchant_profile, $response, $data );
				$response = wp_parse_args($subscription, $response);
				$subscription_id = false;
				if( !empty($subscription['subscription']) ){
					$subscription = $subscription['subscription'];
					$subscription_id = $subscription->id;
					update_post_meta($order_id,"{$meta_prefix}subscription_id", $subscription_id);

										$amount = $order_functions->cents_to_dollar($subscription->plan->amount_decimal);
					update_post_meta($order_id,"{$meta_prefix}subscription/interval", $subscription->plan->interval);
					update_post_meta($order_id,"{$meta_prefix}subscription/bill/interval", $subscription->plan->interval_count);
					update_post_meta($order_id,"{$meta_prefix}next/due/amount", $amount);
					update_post_meta($order_id,"{$meta_prefix}current/period/end", $subscription->current_period_end);

					$url = $this->stripe->admin()->transaction_url($subscription_id,'subscriptions',$sandbox);
					$link = $order_functions->transaction_link($url, $subscription_id);
					$transaction_id = $subscription_id;
				}
				else {
					$invoices->update_invoice_status($invoice_id, 'failed');
					$order_functions->update_order_status( $order_id, 'failed' );
				}

								if( isset($subscription['deleted_subscription_id']) ){
					$response = $this->manage_deleted_subscription($response);
				}

			}
		}
				else {
						$metadata = ['metadata' => ['order_id' => $order_id]];
			$update = $this->stripe->update_payment_intent( $metadata );
			$url = $this->stripe->admin()->transaction_url($payment_intent_id,'payments',$sandbox);
			$link = $order_functions->transaction_link($url, $payment_intent_id);
		}

				$message = sprintf( $sandbox_text . __('Processing %s for order #%s %s%s%s', $ns ),
			$link,
			$order_id,
			$data['symbol'],
			$total,
			strtoupper($data['currency'])
		);
		$meta = $logs->report_meta( $transaction_id, $total, $sandbox );
		$logs->log_order_detail( $order_id, 'processing', $message, $meta, $user_id );

		if( $customer_error === 'card_error' ){
			$logs->log_order_detail( $order_id, 'error', $response['card_error'], [], $user_id );
		}

		return $response;
	}

		
function cancel_subscription($data, $user_id){

		$stripe = $this->stripe;
		$order_id = $data['order_id'];
		$subscription_id = $data['subscription_id'];
		$profile = wpal_ecomm()->settings->get_merchant_profile($data['profile_id']);
		$order_functions = wpal_ecomm()->functions();
		$meta_prefix = $order_functions->get_prefix();
		$order_status = $order_functions->get_order_status($order_id);
		$cancel_now = ( $order_status === 'cancel-pending' );
		$reason = !empty($data['reason']) ? sanitize_textarea_field($data['reason']) : '';
		if( ! empty($data['cancel_date']) ){
			$cancel_date = $data['cancel_date'];
						$period_end_date = get_post_meta($order_id,"{$meta_prefix}current/period/end", true);
			$date_difference = $order_functions->get_days_between_dates("@{$period_end_date}", "@{$cancel_date}");
			if( $date_difference < 0 ){
								return wpal_ecomm()->subscriptions()->queue_cancel_process( $data, $user_id );
			}
		}
		$cancels_on = ( $cancel_now ) ? 'now' : 'period_end';
		$log_data = wpal_ecomm()->subscriptions()->cancelled_log_data( $data, $user_id, $order_id, $subscription_id );

				$cancelled = $stripe->subscriptions()->cancel_subscription($profile, $subscription_id, $cancels_on);
		if( is_wp_error($cancelled) ){
						$message = sprintf(  __("Attempt to Cancel %sSubscription %s for order #%s%s failed. Error : %s", 'wpal_ecomm'),
				$log_data['sandbox_text'], $log_data['link'], $order_id, $log_data['admin_msg'], $cancelled->get_error_message()
			);
			wpal_ecomm_order_logs::get_instance()->log_order_detail($order_id, 'error', $message, $log_data['data'], $log_data['log_user_id']);
			return $cancelled;
		}
		else{
			$end_date = $cancelled->cancel_at;
			$canceled_date = $cancelled->canceled_at;
			$cancel_on_text = ( $cancel_now ) ? '' : " on " . wp_date('M j Y',$end_date);
			$status = ( $cancel_now ) ? 'canceled' : 'cancel-pending';
			$message = sprintf( $log_data['sandbox_text'] . __('Subscription %s for order #%s set to cancel%s%s.', 'wpal_ecomm'),
				$log_data['link'], $order_id, $cancel_on_text, $log_data['admin_msg']
			);
			if( !empty($reason) ){
				$message .= "<br/></br/>";
				$message .= __('Cancellation Reason :', 'wpal_ecomm');
				$message .= "</br/>{$reason}</br/>";
			}
			wpal_ecomm_order_logs::get_instance()->log_order_detail($order_id, $status, $message, $log_data['data'], $log_data['log_user_id']);

						$meta_prefix = $order_functions->get_prefix();
			delete_post_meta($order_id,"{$meta_prefix}next/due/amount");
			update_post_meta($order_id,"{$meta_prefix}canceled/date",$canceled_date);
			update_post_meta($order_id,"{$meta_prefix}current/period/end",$end_date);
			update_post_meta($order_id,"{$meta_prefix}status",$status);

			return [
				'success'	=> true,
				'message'	=> __('Subscription Cancelled','wpal_ecomm'),
				'end_date'	=> $end_date
			];
		}

	}

	
	
function update_session($data){

				$profile_id = $data['profile_id'];
		$user_id = ( !empty($data['user_id']) ) ? $data['user_id'] : 0;
		$merchant_profile = wpal_ecomm()->settings->get_merchant_profile($profile_id);
		$payment_intent_id = $data['payment_intent_id'];
		$merchant_profile['payment_intent_id'] = $payment_intent_id;
		$config = $this->stripe->setup($merchant_profile);

		$args = [
			'amount' 	=> $data['cart']['total'],
			'currency'	=> $data['currency'],
		];

				$customer_id = isset($data['customer_id']) ? $data['customer_id'] : false;
		if( $customer_id ){
			$args['customer'] = $customer_id;
		}

				$payment_method_id = isset($data['payment_method_id']) ? $data['payment_method_id'] : false;
		if( $payment_method_id ){
			if($payment_method_id != 'new'){
				$args['payment_method'] = $payment_method_id;
			}
		}

				if( $customer_id && $payment_method_id ){
			$add_method = isset($data['attach_payment_method']) ? (int)$data['attach_payment_method'] : 0;
			if( $add_method > 0 ){
				$this->attach_card_customer($payment_method_id, $customer_id);
			}
			$make_default = isset($data['make_default']) ? (int)$data['make_default'] : 0;
			if( $make_default > 0 ){

				$this->stripe->subscriptions()->update_customer($merchant_profile, [], $customer_id, $payment_method_id);

				wpal_ecomm()->customer()->set_merchant_profile_payment_details( $user_id, $profile_id, $data, true );
			}
		}

				$response = $this->stripe->set_payment_intent($args, $payment_intent_id);
		return $response;
	}

	
	
function attach_card_customer( $payment_method_id, $customer_id ){

		try {
			$payment_method = \Stripe\PaymentMethod::retrieve($payment_method_id);
			$payment_method->attach(['customer' => $customer_id]);
			$response = $payment_method;
		}
		catch (\Stripe\Exception\ApiErrorException $e) {
			$response = new WP_Error( 'wpal/ecomm/stripe/customer/attach', $e->getMessage() );
		}

		return $response;
	}

	
	
function maybe_create_customer($merchant_profile, $data){

		$user_id = $data['user_id'];

				$customer_id = ( isset($data['stripe_customer']) ) ? $data['stripe_customer'] : '';
		if( ! $customer_id > '' ){
			$customer = $this->stripe->existing_customer($merchant_profile, $user_id);
			$customer_id = ( $customer && ! is_wp_error($customer) ) ? $customer->id : '';
		}

				if( ! $customer_id > '' ){
			$args = $this->normalize_customer_data($data, $user_id, $merchant_profile['key']);
			$payment_method_id = ( isset($data['payment_method_id']) ) ? $data['payment_method_id'] : '';
			$customer = $this->stripe->subscriptions()->create_customer($merchant_profile, $args, $payment_method_id);
			if( ! is_wp_error($customer) ){
				$customer_id = $customer->id;
				$prefix = $this->stripe->get_merchant_profile_prefix($merchant_profile);
				if( (int)$user_id > 0 ){
					update_user_meta($user_id, "{$prefix}customer_id", $customer_id );
				}
			}
			else {
				$customer_id = $customer;
			}
		}

		return $customer_id;
	}

		
function normalize_customer_data($data, $user_id = 0, $profile_id = ''){

		if( isset($data['contact']) ){
			$data = wp_parse_args($data, $data['contact']);
			unset($data['contact']);
		}
		$args = [];
		$contact = [
			'name'	=> 'full_name',
			'email'	=> 'email',
			'phone' => 'phone'
		];
		$pre = 'billing_';
		foreach ($contact as $key => $slug) {
			if( isset($data["{$pre}{$slug}"]) && $data["{$pre}{$slug}"] > '' ){
				$args[$key] = $data["{$pre}{$slug}"];
			}
		}

				if( ! isset($args['name']) ){
			$first = ( isset($data['billing_first_name']) ) ? $data['billing_first_name'] : '';
			$last = ( isset($data['billing_last_name']) ) ? $data['billing_last_name'] : '';
			$full_name = ( $first && $first > '' ) ? "{$first} " : "";
			$full_name .= ( $last && $last > '' ) ? $last : "";
			$full_name = trim($full_name);
			if( $full_name > '' ){
				$args['name'] = $full_name;
			}
		}

		$address = [
			'line1'			=> 'address_1',
			'line2'			=> 'address_2',
			'city'			=> 'city',
			'country'		=> 'country',
			'state'			=> 'state',
			'postal_code'	=> 'postcode'
		];
		$args['address'] = [];
		foreach ($address as $key => $slug) {
			if( isset($data["{$pre}{$slug}"]) && $data["{$pre}{$slug}"] > '' ){
				$data_key = "{$pre}{$slug}";
				if( $slug === 'country' || $slug === 'state' ){
					$code_key = "{$data_key}_code";
					$data_key = ( isset($data[$code_key]) ) ? $code_key : $data_key;
				}
				$args['address'][$key] = $data[$data_key];
			}
		}

				if( (int)$user_id > 0 || $profile_id > '' ){

			$args['metadata'] = [];
			if( (int)$user_id > 0 ){
				$args['metadata']['user_id'] = $user_id;
			}
			if( $profile_id > '' ){
				$args['metadata']['merchant_id'] = $profile_id;
			}
		}

		return apply_filters('wpal/ecomm/stripe/customer/data', $args, $data );
	}

		
function normalize_invoice_data( $invoice ){

		$order_functions = wpal_ecomm()->functions();
		$lines = ( $invoice->lines ) ? $invoice->lines->data : false;

		$data = new stdClass;
		$data->id = $invoice->id;
		$data->number = $invoice->number;
		$data->status = $invoice->status;
		$data->charge_id = $invoice->charge;

				$data->data = [
			'items'		=>	$this->normalize_invoice_items($lines),
			'download'	=>	$invoice->invoice_pdf,
			'view'		=>	$invoice->hosted_invoice_url,
			'totals'	=> [
				'subtotal'	=> $order_functions->cents_to_dollar($invoice->subtotal),
				'tax'		=> is_null($invoice->tax) ? 0 : $order_functions->cents_to_dollar($invoice->tax),
				'discount'	=> is_null($invoice->discount) ? 0 : $order_functions->cents_to_dollar($invoice->discount),
				'total' 	=> $order_functions->cents_to_dollar($invoice->total),
			],
			'created'	=> $invoice->created
		];

		return $data;

	}

		
function normalize_invoice_items($lines){

		if( ! is_array($lines) ){
			return false;
		}

		$order_functions = wpal_ecomm()->functions();
		$items = [];
		foreach ($lines as $i => $line) {
			$price = $order_functions->cents_to_dollar($line->amount);
			$qty = $line->quantity;
			$line_total = $order_functions->cents_to_dollar($line->amount * $qty);
						$description = str_replace('u00d7','x',$line->description);
			$items[] = [
				'type'		=> 'subscription',
				'name'		=> $description,
				'qty'		=> $qty,
				'price'		=> $price,
				'discount'	=> 0,
				'total'		=> $line_total,
				'product'	=> $line->plan->product,
				'plan'		=> $line->plan->id,
				'start'		=> $line->period->start,
				'end'		=> $line->period->end,
				'interval'	=> $line->plan->interval
			];
					}

		return $items;
	}

		
function manage_deleted_subscription( $response ){

		$deleted_id = $response['deleted_subscription_id'];
		$deleted_invoice_id = $response['deleted_invoice_id'];
		unset($response['deleted_subscription_id']);
		unset($response['deleted_invoice_id']);

				$invoice_prefix = wpal_ecomm()->functions()->get_invoice_prefix();
		$existing_invoice_id = $order_functions->get_order_id_by_meta("{$invoice_prefix}stripe",$deleted_id);

		$url = $this->stripe->admin()->transaction_url($deleted_id,'subscriptions',$sandbox);
		$link = $order_functions->transaction_link($url, $deleted_id);
		$message = sprintf( $sandbox_text . __('Subscription %s deleted.', $ns ), $link );
		$logs->log_order_detail( $order_id, 'deleted', $message, [], $user_id );

		return $response;
	}

		
function account_payment_methods( $data = [], $merchant_profile, $customer_id  ){

		$customer = $this->stripe->subscriptions()->retrieve_customer( $merchant_profile, $customer_id );
		if( ! is_wp_error($customer) ){
			$payment_method = $customer->invoice_settings->default_payment_method;
			if( $payment_method > '' ){
				$data['customer_id'] = $customer_id;
				$data['default'] = $payment_method;
											}
		}

		return $data;
	}

		
function account_contact_updated($data, $user_id){

		$customer_id = ( isset($data['customer_id']) ) ? $data['customer_id'] : false;
		$payment_method_id = ( isset($data['payment_method_id']) ) ? $data['payment_method_id'] : false;

		if( ! $customer_id && ! $payment_method_id ){
			return false;
		}
		$stripe = $this->stripe;
		$profile = wpal_ecomm()->settings->get_merchant_profile($data['profile_id']);
		$args = $this->normalize_customer_data($data, $user_id, $profile['key']);
		$customer = wpal_ecomm()->customer();
		$update_card = false;
		$pm_response = false;
		$response = false;
		$difference = ( isset($data['difference']) && ! empty($data['difference']) ) ? $data['difference'] : false;
		if($difference){
			$email_changed = ( isset($difference['billing_email']) ) ? $difference['billing_email'] : false;
			$phone_changed = ( isset($difference['billing_phone']) ) ? $difference['billing_phone'] : false;
			$update_card = ( $email_changed || $phone_changed );
						if( $payment_method_id && $update_card ){
				$pm_response = $stripe->subscriptions()->update_payment_method($profile, $args, $payment_method_id);
			}
						if( $customer_id ){
				$response = $stripe->subscriptions()->update_customer($profile, $args, $customer_id, $payment_method_id);
			}
		}
		return [
			'pm_response' 		=> $pm_response,
			'customer_response' => $response
		];
	}

		
function account_billing_updated($data, $user_id){

		$stripe = $this->stripe;
		$profile_id = ( isset($data['profile_id']) ) ? $data['profile_id'] : false;
		if( ! $profile_id ){
			$msg = __('Merchant profile ID not supplied.','wpal_ecomm');
			return new WP_Error('wpal/ecomm/stripe/update/billing/details', $msg);
		}
		$profile = wpal_ecomm()->settings->get_merchant_profile($profile_id);

		$customer_id = ( isset($data['customer_id']) ) ? $data['customer_id'] : '';
		$current_pm_id = ( isset($data['current_payment_method_id']) ) ? $data['current_payment_method_id'] : '';
		$new_pm_id = ( isset($data['payment_method_id']) ) ? $data['payment_method_id'] : '';

				$pm_updated = false;
		if( $new_pm_id > '' ){
			$pm_updated = ( $current_pm_id != $new_pm_id ) ? $new_pm_id : false;
		}
		$payment_method_id = ( $pm_updated ) ? $pm_updated : $current_pm_id;

				$args = $this->normalize_customer_data($data, $user_id, $profile['key']);

				$payment_args = $args;
		if( isset($data['name_on_card']) ){
			$args['name'] = $data['name_on_card'];
			$payment_args['name'] = $data['name_on_card'];
		}

				if( $payment_method_id > '' ){
			$pm_response = $stripe->subscriptions()->update_payment_method($profile, $payment_args, $payment_method_id);
		}

				if( $pm_updated ){
			$config = $this->stripe->setup($profile);
			$this->attach_card_customer($payment_method_id, $customer_id);

						$brand = strtoupper($data['brand']);
			$last4 = $data['last4'];
			$data['payment_details'] = "{$brand} **** {$last4}";
			wpal_ecomm()->customer()->set_merchant_profile_payment_details( $user_id, $profile_id, $data );
		}

				$response = $stripe->subscriptions()->update_customer($profile, $args, $customer_id, $payment_method_id);
		if( is_wp_error($response) ){
			return $response;
		}

		return true;

	}

	
function pay_invoice( $invoice_id, $profile_id ){

		$profile = wpal_ecomm()->settings->get_merchant_profile($profile_id);
		$config = $this->stripe->setup($profile);
		$client_secret = ( !empty($config['secret_key']) ) ? $config['secret_key'] : false;
		if( ! $client_secret ){
			return new WP_Error( 'wpal/ecomm/stripe/pay/invoice',
				sprintf( __('Client Secret not set for profile %s'), $profile_id )
			);
		}

		try {
			$invoice = new \Stripe\Invoice($invoice_id);
			$invoice->pay();
		}
		catch (\Stripe\Exception\ApiErrorException $e) {
			return new WP_Error( 'wpal/ecomm/stripe/pay/invoice', $e->getMessage() );
		}

		return true;
	}

	
function normalize_status($status){

		if( $status === 'trialing' ){
			return 'trial';
		}
		else if( $status === 'incomplete' ){
			return 'unpaid';
		}
		else if ( $status === 'incomplete_expired' ) {
			return 'failed';
		}
		else {
			return $status;
		}

	}

		
function write_log( $data, $type, $user_id ){
		return $data;
	}

        public static 
function get_instance() {
        static $instance = null;
        if ( is_null( $instance ) ) {
            $instance = new self;
			$instance->stripe = wpal_ecomm_stripe::get_instance();
        }
        return $instance;
    }

		private $stripe = null;

}
