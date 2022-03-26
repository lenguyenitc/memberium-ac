<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}



class wpal_ecomm_paypal {

		protected $name = 'Paypal',
		$loaded = false,
		$sandbox = false,
		$script_version = '1.1.3',
				$client_secret = false,
		$client_id = false,
		$payment_failure_threshold = 1, 				$admin,
		$webhooks,
		$functions,
		$subscriptions;

	const PREFIX = 'wpal/ecomm/paypal/';

		
function init() {}

		
function get_name(){
		return $this->name;
	}

	
function get_max_pay_fails(){
		return $this->payment_failure_threshold;
	}

		
function get_prefix(){
		return self::PREFIX;
	}

		
function get_merchant_profile_prefix($profile){
		$sandbox = (int)$profile['sandbox'] > 0 ? 'sandbox/' : '';
		return "/{$this->get_prefix()}{$sandbox}{$profile['key']}/";
	}

		
function get_keys(){
		return [
			'client_id' 		=> $this->client_id,
			'client_secret' 	=> $this->client_secret,
		];
	}

		
function order_form_config( $merchant_profile, $cart, $user_id ){

				$script_handle = 'wpal_ecomm_paypal';
		$url = $this->script_url();
		$v = $this->script_version;
		wp_register_script($script_handle.'-js', $url, [], $v, true);
		wp_enqueue_script($script_handle.'-js');

				$config = $this->config($merchant_profile);
		if( !empty($cart['items']) && is_array($cart['items']) ){
			foreach ($cart['items'] as $i => $item) {
				if( $item['product_type'] === 'subscription' ){
					$plans = $item['plans'];
					foreach ($plans as $p => $plan) {
						$wp_plan_id = $plan['id'];
												if(empty($config['plan_ids'])){
							$config['plan_ids'] = [];
						}
						$paypal_plan_id = wpal_ecomm()->subscriptions()->get_plan_id($wp_plan_id,$merchant_profile['key']);
						$config['plan_ids'][$wp_plan_id] = $paypal_plan_id;
					}
				}
			}
		}

		if( (int)$user_id > 0 ){
			$customer = $this->existing_customer( $merchant_profile, $user_id );
			if( $customer ){
				$config['payer_id'] = $customer->id;
			}
		}

		return $config;
	}

		
function config( $merchant_profile ){

		$sandbox = ( (int)$merchant_profile['sandbox'] > 0 );
		$config = [
			'client_id'		=> ( $sandbox ) ? $merchant_profile['sandbox_client_id'] : $merchant_profile['client_id'],
			'client_secret'	=> ( $sandbox ) ? $merchant_profile['sandbox_client_secret'] : $merchant_profile['client_secret'],
			'webhook_key'	=> ( $sandbox ) ? $merchant_profile['sandbox_webhook_key'] : $merchant_profile['webhook_key'],
			'currency'		=> $merchant_profile['currency'],
			'base_location'	=> $merchant_profile['base_location'],
			'sandbox'		=> ( $sandbox ) ? 1 : 0
		];

		return $config;
	}

		
function setup( $merchant_profile ){

		$this->sandbox = ( (int)$merchant_profile['sandbox'] > 0 );
		$config = $this->config($merchant_profile);

		if( isset($config['client_id']) ){
			$this->client_id = $config['client_id'];
		}
		if( isset($config['client_secret']) ){
			$this->client_secret = $config['client_secret'];
		}

		return $config;

	}

	    
function get_access_token( $merchant_profile = false ){

		$access_token = false;

				if( $merchant_profile ){
			$access_token = $this->functions()->profile_access_token($merchant_profile);
			if( $access_token ){
				return $access_token;
			}
		}

		        if( ! $access_token ){

            $client_id = $this->get_client_id();
            $secret = $this->get_client_secret();

			$url = $this->get_api_url();
            $url .= '/v1/oauth2/token';

			$auth = base64_encode( $client_id . ':' . $secret );
			$response = wp_remote_post( $url, [
				'headers'	=> ['Authorization' => "Basic {$auth}"],
				'sslverify' => false,
				'body' 		=> ['grant_type' => 'client_credentials']
			] );

			if ( WPAL_ECOMM_DEBUG ) wpal_ecomm_debug::log( __FILE__, __FUNCTION__, __LINE__, 'Msg : Fetch Access Token' );

						if ( is_wp_error($response) ) {
				if ( WPAL_ECOMM_DEBUG ) wpal_ecomm_debug::log( __FILE__, __FUNCTION__, __LINE__, 'ERROR : ' . 'ERROR : ' . $response->get_error_message());
				return $response;
			}
			else{
								$json = json_decode(wp_remote_retrieve_body($response));
				$access_token = ( isset($json->access_token) ) ? $json->access_token : false;
				if( $access_token ){
										if( $merchant_profile ){
						$this->functions()->update_profile_access_token($merchant_profile,$json);
					}
					return $access_token;
				}
								else{
					$error = new WP_Error( $json->error, $json->error_message, $json );
					if ( WPAL_ECOMM_DEBUG ) wpal_ecomm_debug::log( __FILE__, __FUNCTION__, __LINE__, 'ERROR : ' . 'ERROR : ' . $json->error_message);
					return $error;
				}
			}
		}
	}

		
function get_authorized_params( $merchant_profile ){

				$paypal_config = $this->setup($merchant_profile);

				$token = $this->get_access_token( $merchant_profile );
		if( is_wp_error($token) ){
						return $token;
		}

		$params = [
			'httpversion' => '1.1',
			'headers'     => [
				'Authorization' => 'Bearer ' . $token,
				'Content-Type'  => 'application/json',
				'Accept'  		=> 'application/json'
			]
		];

		return $params;
	}

		
function existing_customer( $merchant_profile, $user_id ){

		$customer = false;
		if( (int)$user_id > 0 ){
			$prefix = $this->get_merchant_profile_prefix($merchant_profile);
			$existing_customer_id = get_user_meta($user_id, "{$prefix}customer_id", true);
			if( $existing_customer_id ){
				$customer = new stdClass;
				$customer->id = $existing_customer_id;
			}
		}
		return $customer;
	}

	
	
function payment_details_config( $config, $user_id, $merchant_profile, $data ){
		return $config;
	}

		
function my_account_config( $profile, $customer_id, $user_id, $action = '', $form_id = false ){

		$config = [
			'error'			=> false,
			'can_update'	=> 0
		];

		if ( $action === 'update_cc_form' || $action === 'my_account' ){
			$ns = 'wpal_ecomm';
			$link = __( '<a class="paypal-account-link" href="https://www.paypal.com/signin" target="_blank">PayPal account</a>', $ns );
			if( $action === 'my_account' ){
								$notice = __('<strong>Please Note</strong> : To update the credit card for your PayPal subscriptions it needs to be done from your %1$s directly.', $ns);
			}
			else{
				$notice = __('Update Credit Card for Paypal Subscriptions on your %1$s.', $ns);
				add_filter('wpal/ecomm/update/CC/I18n', [$this, 'update_cc_I18n'], 999, 3);
				$config['past_due_legend'] = 'past_due_paypal';
				$config['past_due_footer'] = __( '<a class="button paypal-login-link" href="https://www.paypal.com/signin" target="_blank">PayPal Login</a>', $ns );
			}
			$config['notice_tmpl'] = 'wpal_ecomm_fieldset';
			$config['notice_tmpl_data'] = [
				'className'	=> 'wpal-ecomm-paypal-cc-notice',
				'legend'	=> '',
				'content'	=> sprintf( $notice, $link )
			];
		}

		return $config;
	}

	
function update_cc_I18n( $I18n, $user_id, $form_id ){
		$I18n['titles']['past_due_paypal'] = __('Past Due PayPal Subscriptions', 'wpal_ecomm');
		return $I18n;
	}

	    
function get_api_url(){
		$sandbox = ( $this->sandbox ) ? "sandbox." : "";
		return "https://api.{$sandbox}paypal.com";
    }

	    
function get_client_id(){
        return $this->client_id;
    }

        
function get_client_secret(){
        return $this->client_secret;
    }

		
function admin(){
		if( ! $this->admin ){
			require_once __DIR__ . '/admin.php';
			$this->admin = wpal_ecomm_paypal_admin::get_instance();
		}
		return $this->admin;
	}

		
function webhooks(){
		if( ! $this->webhooks ){
			require_once __DIR__ . '/webhooks.php';
			$this->webhooks = wpal_ecomm_paypal_webhooks::get_instance();
		}
		return $this->webhooks;
	}

		
function functions(){
		if( ! $this->functions ){
			require_once __DIR__ . '/functions.php';
			$this->functions = wpal_ecomm_paypal_functions::get_instance();
		}
		return $this->functions;
	}

		
function subscriptions(){
		if( ! $this->subscriptions ){
			require_once __DIR__ . '/subscriptions.php';
			$this->subscriptions = wpal_ecomm_paypal_subscriptions::get_instance();
		}
		return $this->subscriptions;
	}

		
function script_url( $script = 'paypal' ){
		return esc_url( plugins_url( "assets/{$script}.js?v={$this->script_version}", __FILE__ ) );
	}

	    public static 
function get_instance() {
        static $instance = null;
        if ( is_null( $instance ) ) {
            $instance = new self;
        }
        return $instance;
    }

}
