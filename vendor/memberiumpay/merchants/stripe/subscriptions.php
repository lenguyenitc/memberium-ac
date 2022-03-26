<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}



class wpal_ecomm_stripe_subscriptions {

		private $stripe = null;

	
	
function create_product( $merchant_profile, $product_id ){

		$merchant_profile = $this->merchant_profile($merchant_profile);

		$product = get_page($product_id);
		$product_args = [
			'name'			=> $product->post_title,
			'type' 			=> 'service',			'metadata'	=>	[
				'product_id'	=> $product_id
			]
		];
		if( $product->post_excerpt > '' ){
			$product_args['description'] = $product->post_excerpt;
		}

		try {
			$response = \Stripe\Product::create($product_args);
		}
		catch (\Stripe\Exception\ApiErrorException $e) {
			$response = new WP_Error( $e->getError()->code, $e->getMessage() );
		}

		
		return ( is_wp_error( $response ) ) ? $response : $response->id;

	}

	
	
function update_product( $merchant_profile, $product_id, $args ){

		$merchant_profile = $this->merchant_profile($merchant_profile);

				\Stripe\Product::update($product_id, $args);
	}

	
	
function create_plan( $merchant_profile, $plan_id, $merchant_product_id ){

		$merchant_profile = $this->merchant_profile($merchant_profile);
		$merchant_id = $merchant_profile['key'];

		$plan_config = wpal_ecomm()->subscriptions()->get_plan_config($plan_id);

				$args = [
			'nickname'			=> $plan_config['name'],
			'amount'			=> wpal_ecomm()->functions()->price_to_cents($plan_config['amount']),
			'currency'			=> strtolower($plan_config['currency']),
			'interval'			=> $plan_config['interval'],
			'interval_count'	=> ( isset($plan_config['bill_interval']) ) ? (int)$plan_config['bill_interval'] : 1,
			'product'			=> $merchant_product_id,
			'metadata'			=> [ 'plan_id' => $plan_id, 'merchant_id' => $merchant_id ]
		];

				if( (int)$plan_config['trial'] ){
			$days = (int)$plan_config['trial_days'];
			if( $days > 0 ){
				$args['trial_period_days'] = $days;
			}
		}

		try {
			$response = \Stripe\Plan::create($args);
		}
		catch (\Stripe\Exception\ApiErrorException $e) {
			$response = new WP_Error( $e->getError()->code, $e->getMessage() );
		}

		
		return ( is_wp_error( $response ) ) ? $response : $response->id;

	}

	
	
function updated_plan( $merchant_profile, $plan_id, $merchant_plan_id, $updated ){

		$merchant_profile = $this->merchant_profile($merchant_profile);
		$merchant_id = $merchant_profile['key'];

		$params = [
			'metadata' => [ 'plan_id' => $plan_id, 'merchant_id' => $merchant_id ]
		];
		if( isset($updated['name']) ){
			$params['nickname'] = $updated['name'];
		}
		if( isset($updated['trial_days']) ){
			$params['trial_period_days'] = (int)$updated['trial_days'];
		}

		try {
			$response = \Stripe\Plan::update($merchant_plan_id, $params);
		}
		catch (\Stripe\Exception\ApiErrorException $e) {
			$response = new WP_Error( $e->getError()->code, $e->getMessage() );
		}

				return ( is_wp_error( $response ) ) ? $response : $response->id;
	}

		
function retrieve_plan( $plan_id ){

		$plan = \Stripe\Plan::retrieve($plan_id);

	}

		
function retrieve_plans( $product_id = '' ){

		$plans = \Stripe\Plan::all([
						'limit' => 100 		]);

	}

	
	
function new_subscription( $merchant_profile, $response, $data ){

		$order_id = $response['order_id'];
		$response['error'] = false;

				$customer_id = ( isset($data['stripe_customer']) ) ? $data['stripe_customer'] : '';

				if( $customer_id ){

						if( isset($data['subscription_id']) && $data['subscription_id'] > '' ){
				$deleted = $this->delete_subscription( $merchant_profile, $data['subscription_id'] );
				if( ! is_wp_error($deleted) ){
					$response['deleted_subscription_id'] = $data['subscription_id'];
					$response['deleted_invoice_id'] = $deleted->latest_invoice;
				}
			}

			$subscription = $this->create_subscription($merchant_profile, $order_id, $data);
			$key = ( is_wp_error($subscription) ) ? 'error' : 'subscription';
			$response[$key] = $subscription;
		}

		return $response;
	}

	
	
function create_subscription($merchant_profile, $order_id, $data){

		$merchant_profile = $this->merchant_profile($merchant_profile);
		$merchant_id = $merchant_profile['key'];
		$args = [
			'customer'					=> $data['customer_id'],
			'items'						=> [],
			'expand'					=> [
				'latest_invoice.payment_intent',
				'pending_setup_intent'
			],
			'metadata'					=> [
				'order_id'	=> $order_id
			]
		];
		$items = $data['items'];
		$stripe_plan_id = false;
						foreach ($items as $i => $item) {
			$type = $item['type'];
			if( $type ==='subscription' ){
				$wp_plan_id = $item['plan_id'];
				$stripe_plan_id = wpal_ecomm()->subscriptions()->get_plan_id($wp_plan_id,$merchant_id);
				if( $stripe_plan_id > '' ){
										$args['items'][] = [ 'plan' => $stripe_plan_id ];
					$args['metadata']['plan_id'] = $wp_plan_id;
				}
			}
					}

				if( $stripe_plan_id ){
			$plan_config = wpal_ecomm()->subscriptions()->get_plan_config($wp_plan_id);
						$is_trial = ( (int)$plan_config['trial'] > 0 );
			$trial_days = ( $is_trial ) ? (int)$plan_config['trial_days'] : 0;
			if( $trial_days > 0 ){
				$args['trial_period_days'] = $trial_days;
			}

			
			
						$end = $plan_config['end'];
			if( $end === 'date' || $end === 'count' ){
				if( $end === 'count' ){
										$interval_type = $plan_config['interval'];
										$interval_bill_count = $plan_config['bill_interval'];
										$interval_count = (int)$plan_config['count'];
										$total_number_of_intervals = $interval_bill_count * $interval_count;
										$end_date_time = new DateTime();
					$end_date_time->add(DateInterval::createFromDateString("{$total_number_of_intervals} {$interval_type}s"));
					$end_date = $end_date_time->getTimestamp();
				}
				else{
					$end_date = $plan_config['timestamp'];
				}
								$args['cancel_at'] = $end_date;
			}

						$args = apply_filters("wpal/ecomm/stripe/subscription/create/args", $args, $merchant_profile, $order_id, $data );

						try {
				$response = \Stripe\Subscription::create( $args );
			}
			catch (\Stripe\Exception\ApiErrorException $e) {
				$response = new WP_Error( $e->getError()->code, $e->getMessage() );
			}

		}
		else {
			$response = new WP_Error('wpal/ecomm/stripe/subscription/create', __('Subscription does not have a plan ID','wpal_ecomm'));
		}

		return $response;

	}

	
	
function delete_subscription( $merchant_profile, $subscription_id ){

		$merchant_profile = $this->merchant_profile($merchant_profile);

		$subscription = $this->retrieve_subscription( $merchant_profile, $subscription_id );
		if( ! is_wp_error($subscription) ){
			$deleted_subscription = $subscription->delete();
			$status = $deleted_subscription->status;
			$deleted = ( $status === 'canceled' || $status === 'incomplete_expired' ) ? true : false;
			if( ! $deleted ){
				$error = __('Error deleting subscription', 'wpal_ecomm');
				$subscription = new WP_Error( 'wpal/ecomm/stripe/subscription/delete', $error );
			}
			else {
				$subscription = $deleted_subscription;
			}
		}

		return $subscription;
	}

	
	
function cancel_subscription( $merchant_profile, $subscription_id, $cancels_on ){
		if( $cancels_on === 'now' ){
			$subscription = $this->retrieve_subscription( $merchant_profile, $subscription_id );
			if( ! is_wp_error($subscription) ){
				$subscription->cancel();
				$canceled = $subscription->status === 'canceled';
				if( $subscription->status != 'canceled' ){
					$error = __('Error cancelling subscription', 'wpal_ecomm');
					$subscription = new WP_Error( 'wpal/ecomm/stripe/subscription/cancel', $error );
				}
			}
			return $subscription;
		}
		else {
			if( $cancels_on === 'period_end' ){
				$args = ['cancel_at_period_end' => true];
			}
			else{
				$args = ['cancel_at' => $cancels_on];
			}
			return $this->update_subscription( $merchant_profile, $subscription_id, $args );
		}

	}

	
	
function retrieve_subscription( $merchant_profile, $subscription_id ){

		$merchant_profile = $this->merchant_profile($merchant_profile);

		if( $subscription_id > '' ){
			try {
				$response = \Stripe\Subscription::retrieve($subscription_id);
			}
			catch (Exception $e){
				$response = new WP_Error( $e->getError()->code, $e->getMessage() );
			}
		}
		else{
			$error = __('No subscription ID supplied', 'wpal_ecomm');
			$response = new WP_Error( 'wpal/ecomm/stripe/subscription/retrieve', $error );
		}

		return $response;
	}

	
	
function update_subscription( $merchant_profile, $subscription_id, $args ){

		$merchant_profile = $this->merchant_profile($merchant_profile);

		try {
			$response = \Stripe\Subscription::update( $subscription_id, $args );
		}
		catch (Exception $e){
			$response = new WP_Error( $e->getError()->code, $e->getMessage() );
		}

		return $response;

	}

		
function retrieve_customer( $merchant_profile, $customer_id ){

		$merchant_profile = $this->merchant_profile($merchant_profile);

		try {
			$response = \Stripe\Customer::retrieve($customer_id);
						if( isset($response->deleted) && (int)$response->deleted > 0 ){
				$response = new WP_Error( 'wpal/ecomm/stripe/customer/retrieve', __('Stripe Customer Deleted', 'wpal_ecomm') );
			}
		}
		catch (\Stripe\Exception\ApiErrorException $e) {
			$response = new WP_Error( 'wpal/ecomm/stripe/customer/retrieve', $e->getMessage() );
		}

		return $response;
	}

		
function create_customer( $merchant_profile, $args, $payment_method_id = '' ){

		$merchant_profile = $this->merchant_profile($merchant_profile);

		if( $payment_method_id > '' ){
			$args['payment_method'] = $payment_method_id;
			$args['invoice_settings'] = [
				'default_payment_method' => $payment_method_id
			];
		}

		try {
			$response = \Stripe\Customer::create($args);
		}
		catch (\Stripe\Exception\CardException $e){
			$response = new WP_Error('card_error', $e->getMessage() );
		}
		catch (\Stripe\Exception\ApiErrorException $e) {
			$response = new WP_Error( $e->getError()->code, $e->getMessage() );
		}

		return $response;
	}

		
function update_customer( $merchant_profile, $args, $customer_id, $payment_method_id = '' ){

		$merchant_profile = $this->merchant_profile($merchant_profile);

		if( $payment_method_id > '' ){
			$args['invoice_settings'] = [
				'default_payment_method' => $payment_method_id
			];
		}

		try {
            $response = \Stripe\Customer::update( $customer_id, $args );
        }
		catch (\Stripe\Exception\CardException $e){
			$response = new WP_Error('card_error', $e->getMessage() );
		}
		catch (\Stripe\Exception\InvalidArgumentException $e){
			$response = new WP_Error($e->getError()->code, $e->getMessage() );
		}
		catch (\Stripe\Exception\ApiErrorException $e) {
			$response = new WP_Error( $e->getError()->code, $e->getMessage() );
        }

		return $response;

	}

	
	
function update_payment_method( $merchant_profile, $args, $payment_method_id ){

		$merchant_profile = $this->merchant_profile($merchant_profile);

		$params = ['billing_details' => []];
		$billing_details = ['address', 'email', 'phone', 'name'];
		foreach ($billing_details as $detail) {
			if( isset($args[$detail]) && $args[$detail] > '' ){
				$params['billing_details'][$detail] = $args[$detail];
			}
		}
		if( isset($args['metadata']) && !empty($args['metadata']) ){
			$params['metadata'] = $args['metadata'];
		}
		if( empty($params['billing_details']) ){
			unset($params['billing_details']);
		}

		if( ! empty($params)  ){
			try {
				$response = \Stripe\PaymentMethod::update( $payment_method_id, $params );
			}
			catch (\Stripe\Exception\ApiErrorException $e) {
				$response = new WP_Error( $e->getError()->code, $e->getMessage() );
			}
		}
		else{
			$response = new WP_Error('wpal/ecomm/stripe/update/payment/method', __('No valid params to update','wpal_ecomm'));
		}

		return $response;

	}

	
	
function merchant_profile( $merchant_profile ){

		if( is_string($merchant_profile) ){
			$merchant_profile = wpal_ecomm()->settings->get_merchant_profile($merchant_profile);
		}
		$config = $this->stripe->setup($merchant_profile);
		return $merchant_profile;
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

}
