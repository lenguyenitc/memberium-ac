<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}



class wpal_ecomm_paypal_functions {

	
	
function new_wp_order_args( $args, $order_id, $data, $prefix ){

		$args['meta_input']["{$prefix}paypal_order_id"] = $data['paypal_order_id'];
		if( !empty($data['paypal_payer_id']) ){
			$args['meta_input']["{$prefix}paypal_payer_id"] = $data['paypal_payer_id'];
		}
				if( $data['type'] === 'subscription' ){
			$args['meta_input']["{$prefix}subscription_id"] = $data['paypal_subscription_id'];
		}
				else{
			if ( isset($data['paypal_transaction_id']) && $data['paypal_transaction_id'] > '' ) {
				$args['meta_input']["{$prefix}paypal_transaction_id"] = $data['paypal_transaction_id'];
			}
		}

		return $args;
	}

	
	
function new_wp_order_created( $response, $data ){

		$ns = 'wpal_ecomm';
		$order_functions = wpal_ecomm()->functions();
		$paypal = wpal_ecomm()->get_merchant('paypal');

		$profile_id = $data['profile_id'];
		$profile = wpal_ecomm()->settings->get_merchant_profile($profile_id);
		$paypal_order_id = $data['paypal_order_id'];
		$order_form_id = $data['order_form_id'];
		$user_id = (int)$data['user_id'];
		$order_id = $response['order_id'];
		$response['subscription'] = false;
		$is_subscription = ( $data['type'] === 'subscription' );

		$sandbox_text = $order_functions->sandbox_text($order_id);
		$sandbox = ( $sandbox_text > '' );
		$total = $data['cart']['total'];
		$logs = wpal_ecomm_order_logs::get_instance();

				if( $is_subscription ){

			$item = $data['items'][0];
			$plan_id = $item['plan_id'];
			$is_trial = ( (int)$item['trial'] > 0 );
			$meta_prefix = $order_functions->get_prefix();

						$subscription_id = $data['paypal_subscription_id'];
			$billing_agreement = $paypal->subscriptions()->get_billing_agreement( $subscription_id, $profile );
			$customer_id = $billing_agreement->payer->payer_info->payer_id;
			$status = $this->normalize_status($billing_agreement->state);
			$status = ( $status === 'expired' ) ? 'active' : $status;
			$status = ( $status === 'active' && $is_trial ) ? 'trial' : $status;

			$response['subscription'] = $billing_agreement;

						$invoices = wpal_ecomm()->invoices();
			$invoice_id = $invoices->generate_first_invoice( $order_id, $data, $status );
			update_post_meta($order_id,"{$meta_prefix}initial/invoice", $invoice_id);

			$start_date_time = new DateTime();
			$start_date = $start_date_time->format('Y-m-d\TH:i:sP');
			$next_bill = false;
			if( property_exists($billing_agreement->agreement_details, 'next_billing_date') ){
				$next_bill = $billing_agreement->agreement_details->next_billing_date;
			}

						$plan_config = wpal_ecomm()->subscriptions()->get_plan_config($plan_id);
			$interval = $plan_config['interval'];
			$period_interval = ( $is_trial ) ? (int)$plan_config['trial_days'] : $interval;
			$bill_interval = !empty($plan_config['bill_interval']) ? (int)$plan_config['bill_interval'] : 1;
			$period_end = $this->current_period_end_from_agreement(
				$billing_agreement->agreement_details,
				$start_date,
				$period_interval,
				$bill_interval
			);
			update_post_meta($order_id,"{$meta_prefix}subscription/interval", $interval);
			update_post_meta($order_id,"{$meta_prefix}subscription/bill/interval", $bill_interval);
			update_post_meta($order_id,"{$meta_prefix}current/period/end", $period_end);
			if( $next_bill ){
				$next_amount = $order_functions->price_to_decimal($plan_config['amount']);
				update_post_meta($order_id,"{$meta_prefix}next/due/amount", $next_amount);
			}

						$transaction_url = $this->paypal->admin()->transaction_url($subscription_id,'subscriptions',$sandbox);
			$message = sprintf( $sandbox_text . __('Processing %s for order #%s %s%s%s', $ns ),
				$order_functions->transaction_link($transaction_url, $subscription_id),
				$order_id,
				$data['symbol'],
				$total,
				strtoupper($data['currency'])
			);
			$report_meta = $logs->report_meta( $subscription_id, $total, $sandbox );
			$logs->log_order_detail( $order_id, 'processing', $message, $report_meta, $user_id );

						if( $status === 'trial' ){
				$invoice_url = $paypal->admin()->transaction_url($subscription_id,'invoices',$sandbox);
				$invoices->log_invoice_event( $subscription_id, $order_id, $total, $status, $invoice_url, true );
				$order_functions->update_order_status( $order_id, $status );
				delete_post_meta($order_id,"{$meta_prefix}initial/invoice");
								do_action("wpal/ecomm/subscription/payment/succeeded", $order_id, 0, $profile_id);
			}

		}
				else{
						$transaction_id = $data['paypal_transaction_id'];
			$customer_id = ( !empty($data['paypal_payer_id']) ) ? $data['paypal_payer_id'] : '';
			$url = $paypal->admin()->transaction_url($transaction_id, 'order', $sandbox);
			$message = sprintf( $sandbox_text . __('Paypal Payment %s Captured for order #%s %s%s%s', $ns ),
				$order_functions->transaction_link($url, $transaction_id),
				$order_id,
				$data['symbol'],
				$total,
				strtoupper($data['currency'])
			);
			$meta = $logs->report_meta( $transaction_id, $total, $sandbox );
			$logs->log_order_detail( $order_id, 'completed', $message, $meta, $data['user_id'] );
			$order_functions->update_order_status( $order_id, 'completed' );
			do_action("wpal/ecomm/order/payment/succeeded", $order_id, $profile_id);
		}

		if( !empty( $customer_id ) ){
			$order_functions->update_order_meta( $order_id, 'paypal_payer_id', $customer_id );
			$this->save_user_payer_id( $user_id, $customer_id, $profile );
		}

		return $response;
	}

	
	
function api_request( $url, $body = [], $profile, $method = 'GET' ){

		$paypal = wpal_ecomm()->get_merchant('paypal');
		$params = $paypal->get_authorized_params($profile);
		if( is_wp_error($params) ){
			return $params;
		}
				$params['method'] = $method;
		if( ! empty($body) ){
			$params['body'] = json_encode($body);
		}
		$base = $paypal->get_api_url();
		$response = wp_remote_request("{$base}{$url}",$params);
		if( is_wp_error($response) ){
			if ( WPAL_ECOMM_DEBUG ) wpal_ecomm_debug::log( __FILE__, __FUNCTION__, __LINE__, "ERROR : " . $response->get_error_message() );
			return $response;
		}

		$body = json_decode(wp_remote_retrieve_body($response));
		$httpcode = wp_remote_retrieve_response_code($response);
		$success = ($httpcode >= 200 && $httpcode < 300 );
		if( ! $success ){
			$error = new WP_Error( $body->debug_id,  $body->message, $body->details );
			if ( WPAL_ECOMM_DEBUG ) wpal_ecomm_debug::log( __FILE__, __FUNCTION__, __LINE__, "ERROR : " . $body->message . "DEBUG ID : " . $body->debug_id );
			return $error;
		}

		return $body;
	}

	
    public 
function get_resource_url($resource, $link_type = 'up'){

        $url = false;

        $links = ( is_array($resource) && isset($resource['links']) ) ? $resource['links'] : false;
        if( is_array($links) ){
            foreach ($links as $key => $link) {
                $rel = ( is_array($link) && isset($link['rel']) && $link['rel'] == $link_type );
                if( $rel ){
                    $url = $link['href'];
                }
            }
        }

        return $url;
    }

	
	public 
function get_order_details($url, $profile){

		$details = false;
		$paypal = wpal_ecomm()->get_merchant('paypal');
		$params = $paypal->get_authorized_params($profile);
		if( is_wp_error($params) ){
			return $params;
		}
		$response = wp_remote_get($url,$params);
		if( is_wp_error($response) ){
			return $response;
		}
		$details = json_decode(wp_remote_retrieve_body($response));
		$httpcode = wp_remote_retrieve_response_code($response);
		$success = ($httpcode >= 200 && $httpcode < 300 ) ? true : false;
		if( ! $success ){
			$debug_id = $details->debug_id;
			return new WP_Error( $details->debug_id, $details->message );
		}

		return $details;
	}

	
	
function verify_paypal_webhook( $webhook_id ) {

		$ns = 'wpal_ecomm';

				$headers = $this->get_all_headers();
				$paypal_headers = [
		    'cert_url'          => 'PAYPAL-CERT-URL',
		    'transmission_id'   => 'PAYPAL-TRANSMISSION-ID',
		    'timestamp'         => 'PAYPAL-TRANSMISSION-TIME',
		    'algo'              => 'PAYPAL-AUTH-ALGO',
		    'signature'         => 'PAYPAL-TRANSMISSION-SIG',
		];
		foreach ($paypal_headers as $var => $keyval) {
			${$var} = ( isset($headers[$keyval]) ) ? $headers[$keyval] : '';
		}

				$hash_methods = ['SHA256withRSA' => 'sha256WithRSAEncryption'];
		$auth_algo = ( array_key_exists( $algo, $hash_methods ) ) ? $hash_methods[$algo] : $algo;

				$openssl_algos = openssl_get_md_methods( true );
		if( ! in_array( $auth_algo, $openssl_algos ) ) {
			return new WP_Error( 'openssl', "OpenSSL doesn't know how to handle message digest algorithm {$auth_algo}" );
		}

				$response = wp_remote_get( $cert_url );
		if( is_wp_error($response) ){
			return new WP_Error( 'cert', "Failed to fetch certificate from server : {$response->get_error_messages()}" );
		}
		else {
			$cert = wp_remote_retrieve_body( $response );
		}

				$x509 = openssl_x509_read( $cert );
		if( false === $x509 ) {
			return new WP_Error( 'openssl', "OpenSSL was unable to parse the certificate from PayPal" );
		}

				$payload = @file_get_contents('php://input');
		$crc = crc32( $payload );

				$sig_string = sprintf( '%s|%s|%s|%u', $transmission_id, $timestamp, $webhook_id, $crc );

				$decoded_signature = base64_decode( $signature );

				$pkey = openssl_pkey_get_public( $cert );
		if( false === $pkey ) {
			return new WP_Error( 'public_key', "Failed to get public key from PayPal certificate" );
		}

				$verify_status = openssl_verify( $sig_string, $decoded_signature, $pkey, $auth_algo );
		openssl_x509_free( $x509 );

				if( $verify_status == 1 ) {
			return true;
		}
		else if( $verify_status == -1 ) {
			return new WP_Error( 'verify', "Error occurred while trying to verify webhook signature" );
		}
		else {
			return new WP_Error( 'fail', "Unable to verify webhook" );
		}
	}

	
	
function normalize_order_data( $details, $profile ){

		$product_meta_prefix = wpal_ecomm_products::PRODUCT_META_PREFIX;
		$functions = wpal_ecomm()->functions();
		$purchase_units = $details->purchase_units[0];
		$status = $details->status;
		$cart_tax = 0;
		$user_id = ( isset($purchase_units->custom_id)) ? (int) str_replace( 'WPUID-', '', $purchase_units->custom_id ) : 0;
				$data = [
			'order_form_id'		=> $purchase_units->reference_id,
			'paypal_order_id'	=> $details->id,
			'paypal_payer_id'	=> '',
			'profile_id'		=> $profile['key'],
			'method'			=> 'paypal',
			'contact'			=> [],
			'cart'				=> [],
			'items'				=> [],
			'user_id'			=> $user_id,
			'status'			=> $status,
			'currency'			=> ''
		];

				$items = $purchase_units->items;
		foreach ($items as $key => $item) {
			$item_id = (int) str_replace('WPID-', '', $item->sku);
			$unit_price = $item->unit_amount->value;
			$price = $unit_price * $item->quantity;
			$discount = ( isset($item->unit_discount) ) ? $item->unit_discount : 0;
			$total = $price - $discount;
						$tax = ( isset($item->tax) ) ? $item->tax : 0;
			$cart_tax = $cart_tax + $tax;
			$data['items'][] = [
				'id'		=> $item_id,
				'type'		=> get_post_meta($item_id, "{$product_meta_prefix}type", true),
				'name'		=> $item->name,
				'qty'		=> $item->quantity,
				'price'		=> $functions->price_to_decimal($price),
				'discount'	=> $functions->price_to_decimal($discount),
				'total'		=> $functions->price_to_decimal($total),
			];
		}

				$amounts = $purchase_units->amount;
		$code = $amounts->currency_code;
		$breakdown = $amounts->breakdown;
		$data['currency'] = $code;
		$data['symbol'] = wpal_ecomm_data::get_currency_symbol_by_code($code);
		$data['cart'] = [
			'subtotal'	=> $amounts->breakdown->item_total->value,
			 			'tax'		=> $functions->price_to_decimal($tax),
			'discount'	=> ( isset($breakdown->discount) ) ? $breakdown->discount->value : 0,
			'total'		=> $amounts->value
		];

				$payer = $details->payer;
		$data['paypal_payer_id'] = $payer->payer_id;
		$address = $payer->address;
		$payer_phone = ( isset($payer->phone) && isset($payer->phone->phone_number) ) ? $payer->phone->phone_number : false;
		$phone_number = ( $payer_phone && isset($payer_phone->national_number) ) ? $payer_phone->national_number : '';
		if( !isset($address->address_line_1) ){
									$address = $purchase_units->shipping->address;
		}
		$data['contact'] = [
			'billing_first_name'	=> $payer->name->given_name,
			'billing_last_name'		=> $payer->name->surname,
			'billing_phone'			=> $phone_number,
			'billing_email'			=> $payer->email_address,
			'billing_address_1'		=> ( isset($address->address_line_1) ) ? $address->address_line_1 : '',
			'billing_address_2'		=> ( isset($address->address_line_2) ) ? $address->address_line_2 : '',
			'billing_country'		=> ( isset($address->country_code) ) ? $address->country_code : '',
			'billing_state'			=> ( isset($address->admin_area_1) ) ? $address->admin_area_1 : '',
			'billing_city'			=> ( isset($address->admin_area_2) ) ? $address->admin_area_2 : '',
					];
		$data['contact']['billing_full_name'] = $data['contact']['billing_first_name'] . ' ' . $data['contact']['billing_last_name'];
		return $data;
	}

		
function normalize_invoice_data( $resource, $billing_agreement, $order_id ){

		$amount = $resource['amount'];
		$amount_details = $amount['details'];
		$sandbox = wpal_ecomm()->functions()->is_sandbox_order($order_id);
		$status = $resource['state'];
		$subscription_id = $billing_agreement->id;
		$resource_id = $transaction_id = $resource['id'];
		if( $status === 'trial' ){
			if( "{$subscription_id}-trial" === $resource_id ){
				$transaction_id = $subscription_id;
			}
		}
		$data = new stdClass;
		$data->id = $resource_id;
		$data->number = ( !empty($resource['invoice_number']) ) ? $resource['invoice_number'] : $data->id;
		$data->status = ( $status === 'completed' ) ? 'paid' : $status;
		$data->data = [
			'items'		=>	$this->normalize_invoice_items($resource, $billing_agreement, $order_id),
			'download'	=>	'',
			'view'		=>	$this->paypal->admin()->transaction_url($resource_id,'invoices',$sandbox),
			'totals'	=> [
				'subtotal'	=> $amount_details['subtotal'],
								'tax'		=> ( !empty($amount_details['tax']) ) ? $amount_details['tax'] : 0,
				'discount'	=> ( !empty($amount_details['discount']) ) ? $amount_details['discount'] : 0,
				'total' 	=> $amount['total'],
			],
			'created'	=> strtotime($resource['create_time']),
		];

		return $data;

	}

		
function normalize_invoice_items($resource, $billing_agreement, $order_id){

						$order_functions = wpal_ecomm()->functions();
		$order_meta = $order_functions->get_order_metadata($order_id);
		$wp_product_id = $order_meta['product/id'];
		$product_name = get_the_title($wp_product_id);

		$wp_plan_id = $order_meta['plan/id'];
		$profile_id = $order_meta['profile_id'];
		$currency = $order_meta['currency'];
		$symbol = wpal_ecomm_data::get_currency_symbol_by_code($currency);
				$period_start = $resource['create_time'];

		$product_properties = wpal_ecomm()->subscriptions()->get_subscription_properties($wp_product_id, $profile_id, 'product', true);
		$paypal_product_id = ($product_properties) ? $product_properties[0]->property_id : '';

		$is_trial = ( $resource['state'] === 'trial' );

				$paypal_plan_id = ( empty($resource['plan_id']) ) ? false : $resource['plan_id'];
		if( ! $paypal_plan_id ){
			$paypal_plan_id = $this->get_paypal_plan_id($wp_plan_id, $profile_id, $is_trial);
		}

		$qty = 1;
		$price = $total = $resource['amount']['total'];
		$interval = $order_meta['subscription/interval'];
		$bill_interval = !empty($order_meta['subscription/bill/interval']) ? (int)$order_meta['subscription/bill/interval'] : 1;
		if( $is_trial ){
			$description = sprintf(__('Trial period for %s', 'wpal_ecomm'), $product_name);
			$plan_config = wpal_ecomm()->subscriptions()->get_plan_config($wp_plan_id);
			$period_interval = (int)$plan_config['trial_days'];
			$interval_count = 1;
		}
		else{
			if( $bill_interval > 1 ){
				$interval_text = sprintf( __('every %s %s', 'wpal_ecomm'),
					$bill_interval, wpal_ecomm_data::subscription_intervals_plural($interval)
				);
			}
			else{
				$interval_text = $interval;
			}
			$description = "{$qty} x {$product_name} (at {$symbol}{$total} / {$interval_text})";
			$period_interval = $interval;
		}
		$period_end = $this->current_period_end_from_agreement($billing_agreement->agreement_details, $period_start, $period_interval, $bill_interval);

		$items = [
			[
				'type'		=> 'subscription',
				'name'		=> $description,
				'qty'		=> $qty,
				'price'		=> $price,
				'discount'	=> 0,
				'total'		=> $total,
				'product'	=> $paypal_product_id,
				'plan'		=> $paypal_plan_id,
				'start'		=> strtotime($period_start),
				'end'		=> $period_end,
				'interval'	=> $interval
			]
		];

		return $items;
	}

	
function get_paypal_plan_id( $wp_id, $profile_id, $is_trial ){

				$plan_config = wpal_ecomm()->subscriptions()->get_plan_config($wp_id);
		$plan_is_trial = ( (int)$plan_config['trial'] > 0 && (int)$plan_config['trial_days'] > 0 );
		$active = 1;
				if( $is_trial ){
						if( ! $plan_is_trial ){
				$active = 0;
			}
		}
				else{
						if( $plan_is_trial ){
				$active = 0;
			}
		}
		$plan_properties = wpal_ecomm()->subscriptions()->get_subscription_properties($wp_id, $profile_id, 'plan', $active);
		return ($plan_properties) ? $plan_properties[0]->property_id : '';
	}

	
function current_period_end_from_agreement( $details, $created, $interval, $bill_interval ){
				if( (int)$interval > 0 ){
			return wpal_ecomm()->functions()->get_next_date($interval, $bill_interval, $created, 'U', false);
		}
				$next_bill_date = property_exists($details, 'next_billing_date') ? $details->next_billing_date : false;
		$last_payment_date = property_exists($details, 'last_payment_date') ? $details->last_payment_date : false;

				$resorce_created_check = new \DateTime($created);
		$resoure_ymd = $resorce_created_check->format('Y-m-d');
		if( $next_bill_date ){
						$next_bill_check = new \DateTime($next_bill_date);
			$next_ymd = $next_bill_check->format('Y-m-d');
						if( $next_ymd === $resoure_ymd ){
				$period_end = wpal_ecomm()->functions()->get_next_date($interval, $bill_interval, $next_bill_date, 'U', false);
			}
			else{
				$period_end = strtotime($next_bill_date);
			}
		}
		else{
			$period_end = wpal_ecomm()->functions()->get_next_date($interval, $bill_interval, $last_payment_date, 'U', false);
		}
		return $period_end;
	}

	
function normalize_status($status){

		$status = strtoupper($status);

		if( $status === 'APPROVAL_PENDING' ){
			return 'pending';
		}
		else if( $status === 'APPROVED' || $status === 'ACTIVE' ){
			return 'active';
		}
		else if ( $status === 'SUSPENDED' ) {
			return 'suspended';
		}
		else if ( $status === 'CANCELLED' ) {
			return 'canceled';
		}
		else if ( $status === 'EXPIRED' ) {
			return 'expired';
		}
		else {
			return $status;
		}

	}

		
function cancel_subscription($data, $user_id){

		$paypal = $this->paypal;
		$order_id = $data['order_id'];
		$subscription_id = $data['subscription_id'];
		$profile = wpal_ecomm()->settings->get_merchant_profile($data['profile_id']);
		if( isset($data['sandbox']) ){
			$profile['sandbox'] = ( (int)$data['sandbox'] > 0 ) ? 1 : 0;
		}
		$order_functions = wpal_ecomm()->functions();
		$meta_prefix = $order_functions->get_prefix();
		$order_status = $order_functions->get_order_status($order_id);
		$cancel_now = ( $order_status === 'cancel-pending' );

				$end_date = get_post_meta($order_id,"{$meta_prefix}current/period/end", true);

				if( ! empty($data['cancel_date']) ){
			$cancel_date = $data['cancel_date'];
						$days = $order_functions->get_days_between_dates("@{$end_date}", "@{$cancel_date}");
			if( $days < 0 ){
								return wpal_ecomm()->subscriptions()->queue_cancel_process( $data, $user_id );
			}
		}
		else{
			$cancel_date = time();
			$days = $order_functions->get_days_between_dates("@{$end_date}", "@{$cancel_date}");
		}

				$cancelled_message = __('Subscription Cancelled','wpal_ecomm');
		if( $days <= 3 ){
			$end_date_human = wp_date('M j, Y', $end_date);
			$interval = get_post_meta($order_id,"{$meta_prefix}subscription/interval", true);
			$bill_interval = get_post_meta($order_id,"{$meta_prefix}subscription/bill/interval", true);
			$bill_interval = ( (int)$bill_interval > 1 ) ? (int)$bill_interval : 1;
			$next_end = $order_functions->get_next_date($interval, $bill_interval, "@{$end_date}", "U", false);
			$next_end_human = wp_date('M j, Y', $next_end);
			$cancelled_message .= '<br><br>';
			$cancelled_message .= sprintf(__('PayPal Policy for subscription cancellations requires 3 days before your next bill date on %s.'), $end_date_human);
			$cancelled_message .= '<br><br>';
			$cancelled_message .= sprintf(__('You will not be billed after %s and your services will remain active until %s.'), $end_date_human, $next_end_human);
		}
		else{
			$next_end = $end_date;
		}

		$reason = !empty($data['reason']) ? sanitize_textarea_field($data['reason']) : '';
		$merchant_reason = empty($reason) ? __('Customer Requested', 'wpal_ecomm') : $reason;
		$cancelled = $paypal->subscriptions()->cancel_subscription($subscription_id, $merchant_reason, $profile);
		if( is_wp_error($cancelled) ){
						$log_data = wpal_ecomm()->subscriptions()->cancelled_log_data($data, $user_id, $order_id, $subscription_id);
			$message = sprintf(  __("Attempt to Cancel %sSubscription %s for order #%s%s failed. Error : %s", 'wpal_ecomm'),
				$log_data['sandbox_text'], $log_data['link'], $order_id, $log_data['admin_msg'], $cancelled->get_error_message()
			);
			wpal_ecomm_order_logs::get_instance()->log_order_detail($order_id, 'error', $message, $log_data['data'], $log_data['log_user_id']);
			return $cancelled;
		}
		else{
			$data['reason'] = $reason;
			$data['period_end'] = $next_end;
			$this->process_cancellation( $order_id, $subscription_id, $data );
			return [
				'success'	=> true,
				'message'	=> $cancelled_message,
				'end_date'	=> $end_date
			];
		}

	}

	
function process_cancellation( $order_id, $subscription_id, $data ){

		$paypal = $this->paypal;
		$order_functions = wpal_ecomm()->functions();
		$meta_prefix = $order_functions->get_prefix();
		$order_meta = $order_functions->get_order_metadata($order_id);
		$user_id = $order_meta['user_id'];
		$end_date = $order_meta['current/period/end'];
		$next_end = ( !empty($data['period_end']) ) ? $data['period_end'] : $end_date;
		$order_status = $order_meta['status'];
		$cancel_now = ( $order_status === 'cancel-pending' );
		$canceled_date = time();
		$reason = $data['reason'];

		$log_data = wpal_ecomm()->subscriptions()->cancelled_log_data( $data, $user_id, $order_id, $subscription_id );
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

		update_post_meta($order_id, "{$meta_prefix}canceled/date", $canceled_date);
		update_post_meta($order_id, "{$meta_prefix}status", $status);
		update_post_meta($order_id, "{$meta_prefix}canceled/process", $next_end);
		if( $next_end === $end_date ){
			delete_post_meta($order_id,"{$meta_prefix}next/due/amount");
		}

	}

		
function process_pay_fail( $resource, $order_id, $billing_agreement ){

				$invoices = wpal_ecomm()->invoices();
		$order_functions = wpal_ecomm()->functions();
		$meta_prefix = $order_functions->get_prefix();
		$order_meta = $order_functions->get_order_metadata($order_id);
		$profile_id = $order_meta['profile_id'];
		$subscription_id = $resource['id'];

				$billing_info = $resource['billing_info'];
		$failed_count = (int)$billing_info['failed_payments_count'];
		$max_failed = $this->paypal->get_max_pay_fails();
		$next_billing_time = $billing_info['next_billing_time'];
		$failed_payment = $billing_info['last_failed_payment'];
				$amount = $failed_payment['amount'];

				$subscription_status = ( $max_failed > $failed_count ) ? 'past_due' : 'failed';
		$invoice_status = ( $max_failed > $failed_count ) ? 'uncollectible' : 'open';

				$existing_invoice_id = false;
		$initial_invoice_id = ( !empty($order_meta['initial/invoice']) ) ? $order_meta['initial/invoice'] : false;
		$failed_invoice_id = ( !empty($order_meta['failed/invoice']) ) ? $order_meta['failed/invoice'] : false;
		if( $initial_invoice_id || $failed_invoice_id ){
						if($initial_invoice_id){
				$existing_invoice_id = $initial_invoice_id;
				delete_post_meta($order_id, "{$meta_prefix}initial/invoice");
			}
			else if($failed_invoice_id){
				$existing_invoice_id = $failed_invoice_id;
			}
		}

				if( $existing_invoice_id ){
			$wp_invoice_id = $existing_invoice_id;
			$invoices->update_invoice_status($existing_invoice_id,$invoice_status);
		}
				else {
						$wp_invoice_id = $invoices->get_new_invoice_id($order_id);
			update_post_meta($order_id,"{$meta_prefix}failed/invoice", $wp_invoice_id);
			$invoice_resource = [
				'id'			=> $wp_invoice_id,
				'state'			=> $invoice_status,
				'amount'		=> [
					'details' => [
						'subtotal' => $amount
					],
					'total' => $amount
				],
				'create_time'	=> time(),
				'plan_id'		=> $resource['plan_id'],
			];

						$invoice_post_data = $this->normalize_invoice_data( $invoice_resource, $billing_agreement, $order_id );
			$invoices->create_invoice_post( $invoice_post_data, $order_id, 'paypal' );
		}

				$sandbox = ( !empty($order_meta['sandbox']) && (int)$order_meta['sandbox'] > 0 );
		$url = $this->paypal->admin()->transaction_url($subscription_id,'invoices',$sandbox);
		$invoices->log_invoice_event( $subscription_id, $order_id, $amount, 'failed', $url, false );

				$order_functions->update_order_status( $order_id, $subscription_status );

				do_action( "wpal/ecomm/subscription/payment/failed", $order_id, $wp_invoice_id, $profile_id );

		return $resource;

	}

	
function process_pay_success( $resource, $order_id, $billing_agreement ){

		$paypal = $this->paypal;
		$invoices = wpal_ecomm()->invoices();
		$order_functions = wpal_ecomm()->functions();

				$meta_prefix = $order_functions->get_prefix();
		$order_meta = $order_functions->get_order_metadata($order_id);
		$profile_id = $order_meta['profile_id'];
		$plan_id = $order_meta['plan/id'];
		$plan_config = wpal_ecomm()->subscriptions()->get_plan_config($plan_id);
		$interval = $plan_config['interval'];
		$bill_interval = !empty($plan_config['bill_interval']) ? (int)$plan_config['bill_interval'] : 1;

		$transaction_id = $resource['id'];
		$subscription_status = $paypal->functions()->normalize_status($billing_agreement->state);
		$is_expired = ( $subscription_status === 'expired' );

		$details = $billing_agreement->agreement_details;
		$next_bill_date = property_exists($details, 'next_billing_date') ? $details->next_billing_date : false;
		$create_time = $resource['create_time'];

		$is_trial = false;
		$definition_types = wp_list_pluck($billing_agreement->plan->payment_definitions, 'type');
		$has_trial = ( in_array('TRIAL', $definition_types) );

		$next_end = $this->current_period_end_from_agreement($details, $create_time, $interval, $bill_interval);

				$existing_invoice_id = false;
		$initial_invoice_id = ( !empty($order_meta['initial/invoice']) ) ? $order_meta['initial/invoice'] : false;
		$failed_invoice_id = ( !empty($order_meta['failed/invoice']) ) ? $order_meta['failed/invoice'] : false;
		if( $initial_invoice_id || $failed_invoice_id ){
			if($failed_invoice_id){
				$existing_invoice_id = $failed_invoice_id;
				delete_post_meta($order_id, "{$meta_prefix}failed/invoice");
			}
			else if($initial_invoice_id){
				$existing_invoice_id = $initial_invoice_id;
				delete_post_meta($order_id, "{$meta_prefix}initial/invoice");
			}
		}

		$is_initial = $initial_payment = false;
		$invoice_ids = $invoices->order_invoice_ids($order_id);
		if( in_array($initial_invoice_id, $invoice_ids) && (int)$initial_invoice_id === (int)$invoice_ids[0] ){
			$initial_payment = $is_initial = true;
		}

				if( $is_expired ){
			$subscription_status = 'active';
						update_post_meta($order_id, "{$meta_prefix}completed/process", $next_end);
			delete_post_meta($order_id,"{$meta_prefix}next/due/amount");
		}

				if( $has_trial ){
			$setup_fee = $billing_agreement->plan->merchant_preferences->setup_fee->value;
			if ( $setup_fee != '0.00' ) {
				if( $is_initial ){
					$is_trial = true;
					$resource['state'] = 'trial';
				}
			}
		}

				$invoice_post_data = $paypal->functions()->normalize_invoice_data( $resource, $billing_agreement, $order_id );

				if( ! $existing_invoice_id ){
			$invoice_prefix = $order_functions->get_invoice_prefix();
			$existing_invoice_id = $order_functions->get_order_id_by_meta("{$invoice_prefix}paypal", $transaction_id);
			if( (int)$existing_invoice_id > 0 ){
				$existing_status = get_post_meta($existing_invoice_id, "{$invoice_prefix}status", true);
				if( $existing_status && $existing_status === $invoice_post_data->status ){
					return $resource;
				}
			}
		}

				$wp_invoice_id = $invoices->create_invoice_post( $invoice_post_data, $order_id, 'paypal', $existing_invoice_id );

				$sandbox = ( !empty($order_meta['sandbox']) && (int)$order_meta['sandbox'] > 0 );
		$url = $paypal->admin()->transaction_url( $transaction_id, 'invoices', $sandbox );
		$total = $resource['amount']['total'];
		$invoices->log_invoice_event( $transaction_id, $order_id, $total, 'active', $url, $is_trial );

				$order_functions->update_order_status( $order_id, $subscription_status );

				if( ! $is_initial ){
						update_post_meta($order_id,"{$meta_prefix}subscription/interval", $interval);
			if( $next_bill_date ){
				$next_amount = $order_functions->price_to_decimal($plan_config['amount']);
				update_post_meta($order_id,"{$meta_prefix}next/due/amount", $next_amount);
			}
			if( $is_trial ){
				$interval = (int)$plan_config['trial_days'];
			}
			$period_end = $paypal->functions()->current_period_end_from_agreement($details, $create_time, $interval, $bill_interval);
			update_post_meta($order_id,"{$meta_prefix}current/period/end", $period_end);
		}

				if( $initial_payment ) {
			do_action("wpal/ecomm/subscription/initial/payment/succeeded", $order_id, $wp_invoice_id, $profile_id);
		}
		do_action("wpal/ecomm/subscription/payment/succeeded", $order_id, $wp_invoice_id, $profile_id);

		return $resource;

	}

	
function process_pay_refund( $resource, $payment_id, $is_order, $profile_id, $sandbox ){

		$order_functions = wpal_ecomm()->functions();
		$meta_prefix = $order_functions->get_prefix();
		$paypal = $this->paypal;
		$ns = 'wpal_ecomm';
		$refund_id = $resource['id'];
		$created = $order_functions->get_formatted_date( $resource['create_time'], true, 'U' );

				if( $is_order ){
			$order_id = (int)$order_functions->get_order_id_by_meta("{$meta_prefix}paypal_transaction_id", $payment_id);
			if( $order_id < 1 ){
				return sprintf(__('Order Not found for Transaction %s.', $ns), $payment_id);
			}
			else{
				$amount_refunded = $resource['seller_payable_breakdown']['total_refunded_amount']['value'];
				$currency = $resource['seller_payable_breakdown']['total_refunded_amount']['currency_code'];
								$order_functions->manage_refund_meta( $order_id, $refund_id, $amount_refunded, 'order', $created );
								$url = $paypal->admin()->transaction_url( $payment_id, 'payments', $sandbox );
				$link = $order_functions->transaction_link($url, $payment_id);
				$order_functions->log_refund( $order_id, $payment_id, 'Payment', $amount_refunded, $currency, $link, $sandbox );
				do_action( "wpal/ecomm/order/refund", $order_id );
				return sprintf(__('Payment %s Refunded for Order #%s', $ns), $payment_id, $order_id );
			}
		}
				else{
			$invoices = wpal_ecomm()->invoices();
			$invoice_post = $invoices->get_post_by_merchant_invoice_id($payment_id, 'paypal');
			if( $invoice_post ){
				$wp_invoice_id = $invoice_post->ID;
				$order_id = (int)$invoice_post->post_parent;
				$user_id = $order_functions->get_order_user_id($order_id);
				$amount_refunded = $resource['total_refunded_amount']['value'];
				$currency = $resource['total_refunded_amount']['currency'];
				$invoice_id = $invoice_post->post_title;
								$order_functions->manage_refund_meta( $wp_invoice_id, $refund_id, $amount_refunded, 'invoice', $created );
								$url = $paypal->admin()->transaction_url($payment_id, 'payments', $sandbox);
				$link = $order_functions->transaction_link($url, $invoice_post->post_title);
				$order_functions->log_refund( $order_id, $payment_id, 'Invoice', $amount_refunded, $currency, $link, $sandbox );
								$subscription_id = $order_functions->get_order_subscription_id($order_id);
				$order_functions->update_order_status($order_id, 'cancel-pending');
				usleep(500000);
				$this->cancel_subscription([
					'order_id' 			=> $order_id,
					'subscription_id'	=> $subscription_id,
					'sandbox'			=> $sandbox,
					'profile_id'		=> $profile_id,
					'reason' 			=> sprintf( __('Invoice %s Refunded', $ns), $invoice_id )
				], $user_id );
				do_action( "wpal/ecomm/invoice/refund", $wp_invoice_id, $order_id );
				return sprintf(__('Invoice %s Refunded and Subscription %s Cancelled', $ns), $invoice_id, $subscription_id );
			}
			else{
				return sprintf(__('Invoice Not Found for Payment %s to Refund.', $ns), $payment_id);
			}
		}
	}

	
    
function get_all_headers() {
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
                $headers = array_change_key_case($headers, CASE_UPPER);
        return $headers;
    }

	
	
function profile_access_token( $profile ){

		$sandbox = ( (int)$profile['sandbox'] > 0 ) ? true : false;
		$pre = ( $sandbox ) ? 'sandbox_' : '';
		if( is_array($profile) && isset($profile["{$pre}access_token"]) ){
			if( $profile["{$pre}access_token"] > '' ){
				if( isset($profile["{$pre}token_life"]) ){
										$expires_in = time() - $profile["{$pre}token_life"];
					if ( ($expires_in) < 600 ) {
						$message = $this->seconds_to_live_message($expires_in);
						return $profile["{$pre}access_token"];
					}
					else{
						return false;
					}
				}
			}
		}
		return false;
	}

	
	
function update_profile_access_token( $profile, $response ){

				$profile_key = $profile['key'];

				$expires_in = $response->expires_in;
		$access_token = $response->access_token;

				$date = new DateTime();
		$now = $date->getTimestamp();
		$date->modify("+ {$expires_in} seconds");
		$token_life = $date->getTimestamp();

				$sandbox = ( (int)$profile['sandbox'] > 0 );
		$pre = ( $sandbox ) ? 'sandbox_' : '';

				$profile = wpal_ecomm()->settings->set_profile( $profile_key, $access_token, "{$pre}access_token" );
		$profile = wpal_ecomm()->settings->set_profile( $profile_key, $token_life, "{$pre}token_life" );

		return $profile;
	}

	
	
function seconds_to_live_message($seconds) {
		$hours = floor($seconds / 3600);
		$minutes = floor(($seconds / 60) % 60);
		$seconds = $seconds % 60;
		return "$hours:$minutes:$seconds";
	}

		
function write_log( $data, $type, $user_id ){

		$error_log = "";
		if( $type === 'capture' ){
			$error_log .= "PayPal ID = " . $data['id'] . "\n";
			$error_log .= "Status = " . $data['status'] . "\n";
			$data = $error_log;
		}
		else if ( $type === 'error' ){
			if( !empty($data['code']) ){
				$error_log .= "PayPal Error = " . $data['code'] . "\n";
				$data = $error_log;
			}
		}

		return $data;
	}

	
function save_user_payer_id( $user_id, $payer_id, $merchant_profile ){
		if( (int)$user_id > 0 ){
			$prefix = $this->paypal->get_merchant_profile_prefix($merchant_profile);
			update_user_meta($user_id, "{$prefix}customer_id", $payer_id );
		}
	}

	
function get_order_payer_id( $order_id ){
		$prefix = wpal_ecomm()->functions()->get_prefix();
		return get_post_meta( $order_id, "{$prefix}paypal_payer_id", true );
	}

		
function process_order_queue( $order_id, $user_id ){
		$payer_id = $this->get_order_payer_id($order_id);
		if( ! $payer_id ){
			return;
		}
		$data = [
			'merchant'		=> 'paypal',
			'profile_id'	=> wpal_ecomm()->functions()->get_order_profile_id($order_id),
			'customer_id'	=> $payer_id
		];
		wpal_ecomm()->customer()->update_merchant_profile_customer_id( $user_id, $data );
		wpal_ecomm()->customer()->set_merchant_profile_payment_details( $user_id, '', $data, true );

		return;
	}

		
function account_contact_updated($data, $user_id){
		return true;
	}

		
function account_billing_updated($data, $user_id){
		return true;
	}

	    public static 
function get_instance() {
        static $instance = null;
        if ( is_null( $instance ) ) {
            $instance = new self;
			$instance->paypal = wpal_ecomm_paypal::get_instance();
        }
        return $instance;
    }

		private $paypal = null;

}
