<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}



class wpal_ecomm_paypal_subscriptions {

		private $paypal = null;
	private $functions = null;

	
	
function create_product( $merchant_profile, $product_id ){

		$merchant_profile = $this->merchant_profile($merchant_profile);

		$product = get_page($product_id);

		$name = $product->post_title;
		if (strlen($name) > 127){
			$name = substr($name,0,127);
		}

		$product_args = [
			'name'			=> $name,
			'type' 			=> 'SERVICE',														];
		if( $product->post_excerpt > '' ){
			$product_args['description'] = $product->post_excerpt;
		}

		$request = '/v1/catalogs/products';
		$product = $this->functions->api_request($request,$product_args,$merchant_profile,'POST');
		if( is_wp_error( $product ) ){
			return $product;
		}
		return ( isset($product->id) ) ? $product->id : 0;

	}

	
	
function create_plan( $merchant_profile, $plan_id, $merchant_product_id ){

		$merchant_profile = $this->merchant_profile($merchant_profile);
		$merchant_id = $merchant_profile['key'];

		$plan_config = wpal_ecomm()->subscriptions()->get_plan_config($plan_id);
		$request = '/v1/billing/plans';

				$product_name = wpal_ecomm_products::get_product_name_from_plan_id($plan_id);
		$plan_name = $plan_config['name'];
		$name = ( $product_name > '' ) ? "{$product_name} : {$plan_name}" : $plan_name;
		if (strlen($name) > 127){
			$name = substr($name,0,127);
		}

				$body = [
			"product_id"			=> $merchant_product_id,
			"name"					=> $name,			"status"				=> "ACTIVE",
			"billing_cycles"		=> [],
			'description'			=> $name,						"payment_preferences"	=> [
				"auto_bill_outstanding"		=> true,
				"payment_failure_threshold"	=> $this->paypal->get_max_pay_fails()
			]
		];

				$interval = strtoupper($plan_config['interval']);
		$interval_bill_count = isset($plan_config['bill_interval']) ? (int)$plan_config['bill_interval'] : 1;
		$has_trial = (int)$plan_config['trial'];
		$currency = strtoupper($plan_config['currency']);
		$sequence = 1;
		$index = 0;
				if( $has_trial > 0 ){
			$trial_days = (int)$plan_config['trial_days'];
			if( $trial_days > 0 ){
				$body["billing_cycles"][$index] = [
					"frequency" 	=> [
						"interval_unit"		=> "DAY",
						"interval_count"	=> $trial_days
					],
					"tenure_type"		=> "TRIAL",
					"sequence" 			=> $sequence,
					"total_cycles"		=> 1,
					"pricing_scheme"	=>  [
						"fixed_price"	=> [
							"value"			=> "0",							"currency_code"	=> $currency
						]
					]
				];
				$index = 1;
				$sequence = 2;
			}
		}

				$plan_cycles = 0;
		$end = $plan_config['end'];
		if( $end === 'count' ){
			$plan_cycles = (int)$plan_config['count'];
		}

				$body["billing_cycles"][$index] = [
			"frequency" 		=> [
				"interval_unit"		=> $interval,
				"interval_count"	=> $interval_bill_count
			],
			"tenure_type" 		=> "REGULAR",
			"sequence" 			=> $sequence,
			"total_cycles"		=> $plan_cycles,
			"pricing_scheme"	=> [
				"fixed_price" => [
					"value"			=> $plan_config['amount'],
					"currency_code"	=> $currency
				]
			],
		];

				
		$plan = $this->functions->api_request($request,$body,$merchant_profile,'POST');
		if( is_wp_error($plan) ){
			return $plan;
		}

		return ( isset($plan->id) ) ? $plan->id : 0;
	}


		
function activate_plan( $plan_id, $merchant_profile ){

		$request = "/v1/billing/plans/{$plan_id}/activate";
		$activate = $this->functions->api_request($request,[],$merchant_profile,'POST');
		if( is_wp_error($activate) ){
			return $activate;
		}
		return true;
	}

	
	
function get_subscription( $subscription_id, $merchant_profile ){
		$merchant_profile = $this->merchant_profile($merchant_profile);
		$request = "/v1/billing/subscriptions/{$subscription_id}";
		$subscription = $this->functions->api_request($request,[],$merchant_profile,'GET');
		if( is_wp_error($subscription) ){
			return false;
		}
		return $subscription;
	}

	
function execute_billing_agreement($token, $merchant_profile){
		$request = "/v1/payments/billing-agreements/{$token}/agreement-execute";
		$billing_agreement = $this->functions->api_request($request,[],$merchant_profile,'POST');
		if( is_wp_error($billing_agreement) ){
			return false;
		}
		return $billing_agreement;
	}

	
	
function cancel_subscription( $subscription_id, $reason, $merchant_profile ){

		$reason = wp_strip_all_tags($reason, true );
		if( strlen($reason) > 128 ){
			$reason = substr($reason,128);
		}

		$merchant_profile = $this->merchant_profile($merchant_profile);
		$request = "/v1/billing/subscriptions/{$subscription_id}/cancel";
		$subscription = $this->functions->api_request($request,[
			'reason' => $reason
		],$merchant_profile,'POST');
		if( is_wp_error($subscription) ){
			return $subscription;
		}
		return $subscription;

	}

	
function get_billing_agreement( $subscription_id, $merchant_profile ){

		$merchant_profile = $this->merchant_profile($merchant_profile);
		$request = "/v1/payments/billing-agreements/{$subscription_id}";
		$agreement = $this->functions->api_request($request,[],$merchant_profile,'GET');
		if( is_wp_error($agreement) ){
			return false;
		}
		return $agreement;

	}

	
	
function get_subscription_transactions( $subscription_id, $merchant_profile, $start, $end ){

		$merchant_profile = $this->merchant_profile($merchant_profile);
		$request = "/v1/payments/billing-agreements/{$subscription_id}/transactions";
		$request .= "?start_date={$start}";
		$request .= "&end_date={$end}";
		$transactions = $this->functions->api_request($request,[],$merchant_profile,'GET');
		if( is_wp_error($transactions) ){
			return $transactions;
		}
		return $transactions;

	}

	
	
function merchant_profile( $merchant_profile ){

		if( is_string($merchant_profile) ){
			$merchant_profile = wpal_ecomm()->settings->get_merchant_profile($merchant_profile);
		}
		$config = $this->paypal->setup($merchant_profile);
		return $merchant_profile;
	}

	    public static 
function get_instance() {
        static $instance = null;
        if ( is_null( $instance ) ) {
            $instance = new self;
			$instance->paypal = wpal_ecomm_paypal::get_instance();
			$instance->functions = $instance->paypal->functions();
        }
        return $instance;
    }

}
