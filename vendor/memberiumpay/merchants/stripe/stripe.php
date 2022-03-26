<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}



class wpal_ecomm_stripe {

		protected $name = 'Stripe';
	protected $loaded = false;
	protected $sandbox = false;
	protected $script_version = '1.0.8';

		protected $secret_key;
	protected $client_secret;
	protected $payment_intent_id;
	protected $payment_intent;

		protected $admin;
	protected $webhooks;
	protected $functions;
	protected $subscriptions;

	const PREFIX = 'wpal/ecomm/stripe/';

		
function init() {

		if( ! class_exists('Stripe') ) {
						$this->autoload();

			
		}
	}

		
function get_name(){
		return $this->name;
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
			'secret_key' 		=> $this->secret_key,
			'client_secret' 	=> $this->client_secret,
			'payment_intent_id'	=> $this->payment_intent_id
		];
	}

		
function order_form_config( $profile, $cart, $user_id ){

		$this->init();
		$config = $this->setup($profile);

				$intent_args = [
			'amount' 	=> $cart['total'],
			'currency'	=> $profile['currency']
		];

		$descriptor = wpal_ecomm()->settings->get_option('descriptor');
		if( ! empty($descriptor) ){
			$intent_args['statement_descriptor'] = $descriptor;
		}

				$customer = $this->existing_customer( $profile, $user_id );
		$customer_id = ( $customer && ! is_wp_error($customer) ) ? $customer->id : false;
		$payment_method = '';
		if( $customer_id ){
			$intent_args['customer'] = $customer_id;
						$payment_method_id = $customer->invoice_settings->default_payment_method;
			if( $payment_method_id > '' ){
				$payment_method = $this->retrieve_payment_method($payment_method_id);
				if( is_wp_error($payment_method) ){
					$payment_method = false;
				}
				else{
					$intent_args['payment_method'] = $payment_method_id;
				}
			}
		}

				if( isset($cart['subscription']) && $cart['subscription'] ){
			$intent_args['setup_future_usage'] = 'off_session';
		}
		$payment_intent = $this->set_payment_intent($intent_args);
		$payment_intent_id = ($payment_intent) ? $payment_intent['intent_id'] : false;
		$client_secret = ($payment_intent) ? $payment_intent['client_secret'] : false;

				$script_handle = 'wpal_ecomm_stripe';
		$url = $this->script_url();
		$v = $this->script_version;
		wp_register_script($script_handle.'-js', $url, [], $v, true);
		wp_enqueue_script($script_handle.'-js');

		return [
			'intent_id'				=> $payment_intent_id,
			'customer_id'			=> $customer_id,
			'payment_method'		=> $payment_method,
			'client_secret' 		=> $client_secret,
			'public_key'			=> $config['public_key'],
			'currency'				=> $config['currency'],
			'base_location' 		=> $config['base_location'],
			'sandbox'				=> $config['sandbox']
		];
	}

	
	
function payment_details_config( $config, $user_id, $merchant_profile, $data ){

		$order_id = ( isset($data['order_id']) ) ? (int)$data['order_id'] : 0;
		$from_order = ( (int)$order_id > 0 ) ? $order_id : false;

				$payment_method_id = ( isset($data['payment_method_id']) ) ? $data['payment_method_id'] : '';
		$display = ( !empty($data['payment_details']) ) ? $data['payment_details'] : '';
		$display = ( empty($display) && !empty($data['display']) ) ? $data['display'] : $display;

		if( empty($display) || empty($payment_method_id) ){
			if( $from_order ){
				if( empty($display) ){
					$display = wpal_ecomm()->functions()->get_order_payment_details($order_id);
				}
				if( ! $payment_method_id > '' ){
					$payment_method_id = wpal_ecomm()->functions()->get_order_payment_method_id($order_id);
				}
			}
		}

		$details = ( $display > '' ) ? explode('****', $display) : [];
		$config['card']	= [
			'display'				=> $display,
			'brand'					=> !empty($details[0]) ? trim($details[0]) : '',
			'last4'					=> !empty($details[1]) ? trim($details[1]) : '',
		];
		$config['payment_method_id'] = $payment_method_id;

		return $config;
	}

		
function my_account_config( $profile, $customer_id, $user_id, $action = '', $form_id = false ){

		$this->init();
		$config = $this->setup($profile);
		$intent = $this->create_setup_intent($customer_id);
		$tmpl_data = false;
		$card_id = false;
		if ( $action === 'update_cc_form' || $action === 'my_account' ){
			add_filter('wpal/ecomm/account/tmpls', [$this, 'get_account_templates'], 999, 3);
			add_filter('wpal/ecomm/update/CC/tmpls', [$this, 'get_account_templates'], 999, 3);
			if( $action === 'update_cc_form' ){
				$card_id = "update-cc-{$form_id}";
				$class_name = 'wpal-ecomm-my-account';
			}
			else{
				$card_id = "account-{$user_id}";
			}
		}

		if( is_wp_error($intent) ){
			return [
				'error' => $intent->get_error_message()
			];
		}
		return [
			'error'			=> false,
			'client_secret' => $intent->client_secret,
			'public_key'	=> $config['public_key'],
			'script'		=> $this->script_url('account'),
			'function_name'	=> 'wpalEcommStripeAccount',
			'tmpl'			=> 'wpal_ecomm_stripe_card_ui',
			'tmpl_data'		=> [
				'id'            => $card_id,
				'className'     => 'wpal-ecomm-my-account',
			],
			'card_id'		=> $card_id,
			'can_update'	=> 1
		];

	}


	
function get_account_templates( $templates ){

		$templates['stripe_card_ui'] = 'stripe-payment-method.php';
		return $templates;
	}

		
function config( $profile ){

 		$sandbox = ( (int)$profile['sandbox'] > 0 );
		$config = [
			'secret_key'	=> ( $sandbox ) ? $profile['sandbox_secret_key'] : $profile['secret_key'],
			'public_key'	=> ( $sandbox ) ? $profile['sandbox_public_key'] : $profile['public_key'],
			'webhook_key'	=> ( $sandbox ) ? $profile['sandbox_webhook_key'] : $profile['webhook_key'],
			'currency'		=> $profile['currency'],
			'base_location'	=> $profile['base_location'],
			'sandbox'		=> ( $sandbox ) ? 1 : 0
		];

		if( isset($profile['payment_intent_id']) ){
			$config['payment_intent_id'] = $profile['payment_intent_id'];
		}

		return $config;
	}

		
function set_api_key($config){

		$secret_key = isset($config['secret_key']) ? $config['secret_key'] : false;
		$error = false;
		if( $secret_key ){
			try {
				\Stripe\Stripe::setApiKey($secret_key);
								return true;
			}
			catch (\Stripe\Error\Authentication $e) {
				$error = $e->getMessage();
			}
		}
		else{
			$error = __('No Secret Key Supplied');
		}
	}

	    public 
function setup($profile) {

				$this->init();

		$config = $this->config($profile);

        if( isset($config['secret_key']) ){

            $this->secret_key = $config['secret_key'];
			$this->set_api_key($config);

        }

        if( isset($config['client_secret']) ){
            $this->client_secret = $config['client_secret'];
        }

        if( isset($config['payment_intent_id']) ){
            $this->payment_intent_id = $config['payment_intent_id'];
        }

		return $config;
    }

		
function existing_customer( $merchant_profile, $user_id ){

		$customer = false;
		if( (int)$user_id > 0 ){
			$prefix = $this->get_merchant_profile_prefix($merchant_profile);
			$existing_customer_id = get_user_meta($user_id, "{$prefix}customer_id", true);
			if( $existing_customer_id ){
				$customer = $this->subscriptions()->retrieve_customer($merchant_profile, $existing_customer_id);
				if( is_wp_error($customer) ){
					delete_user_meta($user_id, "{$prefix}customer_id", $existing_customer_id);
				}
			}
		}

		return $customer;
	}

		
function retrieve_payment_method( $payment_method_id, $config = false ){

		if( $config ){
			$this->set_api_key($config);
		}

		if( $payment_method_id > '' ){
			try {
				$response = \Stripe\PaymentMethod::retrieve($payment_method_id);
			}
			catch (\Stripe\Exception\ApiErrorException $e) {
				$response = new WP_Error( $e->getError()->code, $e->getMessage() );
			}

		}
		else{
			$error = __('No payment method ID supplied', 'wpal_ecomm');
			$response = new WP_Error( 'wpal/ecomm/stripe/payment_method/retrieve', $error );
		}

		if( ! is_wp_error($response) ){
			return [
				'id'				=> $payment_method_id,
				'billing_details'	=> $response->billing_details,
				'brand'				=> strtoupper($response->card->brand),
				'last4'				=> $response->card->last4,
			];
		}
		else{
			if ( WPAL_ECOMM_DEBUG ) wpal_ecomm_debug::log( __FILE__, __FUNCTION__, __LINE__, 'ERROR : ' . $response->get_error_message() );
			return $response;
		}
	}

		
function retrieve_payment_methods( $customer_id, $type = 'card' ){

		$payment_methods = [];
		$response = \Stripe\PaymentMethod::all([
			'customer'	=> $customer_id,
			'type'		=> $type,
		]);

		if( ! empty($response->data) ){
			$payment_methods['new'] = __('Add New Card', 'wpal_ecomm');
			foreach ($response->data as $key => $method) {
				$card = $method->card;
				$payment_methods[$method->id] = strtoupper($card->brand) . " **** {$card->last4}";
			}
		}
		return $payment_methods;
	}

		
function set_payment_intent($args, $payment_intent_id = ''){

		$response = [];
		$amount = ( isset($args['amount']) ) ? $args['amount'] : false;
		$currency = ( isset($args['currency']) ) ? strtolower($args['currency']) : false;
		$metadata = ( isset($args['metadata']) ) ? $args['metadata'] : false;

		if( $amount && $currency ){

			$intent_args = [
				'amount'	=> wpal_ecomm()->functions()->price_to_cents($amount),
				'currency'  => $currency,
			];
			if( $metadata ){
				$intent_args['metadata'] = $metadata;
			}
			$intent_args = wp_parse_args($intent_args, $args);

						if( empty($payment_intent_id) ){
				$payment_intent_id = $this->get_payment_intent_id();
			}

						if( ! empty($payment_intent_id) ){
				$update = $this->update_payment_intent($intent_args, $payment_intent_id);
				$this->client_secret = $update->client_secret;
				$payment_intent_id = $update->id;
			}
						else {
				$payment_intent_id = $this->create_payment_intent($intent_args);
			}
			return [
				'client_secret'	=> $this->client_secret,
				'intent_id'		=> $payment_intent_id
			];
		}
		else {
			return false;
		}

	}

		public 
function create_setup_intent( $customer_id, $types = ['card'] ){

		try {
			$response = \Stripe\SetupIntent::create([
				'payment_method_types'	=> $types,
				'customer' 				=> $customer_id,
				'usage'					=> 'off_session',
			]);
		}
		catch (\Stripe\Exception\ApiErrorException $e) {
			$response = new WP_Error( $e->getError()->code, $e->getMessage() );
		}

		return $response;

	}

        public 
function create_payment_intent( $args ){
		        $this->payment_intent = \Stripe\PaymentIntent::create($args);
        $this->client_secret = $this->payment_intent->client_secret;
		return $this->payment_intent->id;
    }

        public 
function update_payment_intent( $args ){

		$this->payment_intent = \Stripe\PaymentIntent::update($this->payment_intent_id,$args);

		return $this->payment_intent;

    }

	    public 
function retrieve_payment_intent( $id ){

		$payment_intent = '';
        try {
            $payment_intent = \Stripe\PaymentIntent::retrieve( $id );
        }
        catch (\Stripe\Error\Base $e) {
			if ( WPAL_ECOMM_DEBUG ) wpal_ecomm_debug::log( __FILE__, __FUNCTION__, __LINE__, "ERROR : {$e->getMessage()}" );
        }
        catch (Exception $e) {
			if ( WPAL_ECOMM_DEBUG ) wpal_ecomm_debug::log( __FILE__, __FUNCTION__, __LINE__, "ERROR : {$e->getMessage()}" );
        }
        $this->payment_intent = $payment_intent;
        return $this->payment_intent;

    }

		public 
function get_client_secret(){
		return $this->client_secret;
	}

		public 
function get_payment_intent(){
		return $this->payment_intent;
	}

	 	public 
function get_payment_intent_id(){

		$payment_intent = ( is_object($this->payment_intent) ) ? $this->payment_intent : false;
		$payment_intent_id = '';

				if( $payment_intent ){
			$payment_intent_id = $this->payment_intent->id;
		}
		$this->payment_intent_id = $payment_intent_id;
		return $payment_intent_id;
	}

		
function admin(){
		if( ! $this->admin ){
			require_once __DIR__ . '/admin.php';
			$this->admin = wpal_ecomm_stripe_admin::get_instance();
		}
		return $this->admin;
	}

		
function webhooks(){
		if( ! $this->webhooks ){
			require_once __DIR__ . '/webhooks.php';
			$this->webhooks = wpal_ecomm_stripe_webhooks::get_instance();
		}
		return $this->webhooks;
	}

		
function functions(){
		if( ! $this->functions ){
			require_once __DIR__ . '/functions.php';
			$this->functions = wpal_ecomm_stripe_functions::get_instance();
		}
		return $this->functions;
	}

		
function subscriptions(){
		if( ! $this->subscriptions ){
			require_once __DIR__ . '/subscriptions.php';
			$this->subscriptions = wpal_ecomm_stripe_subscriptions::get_instance();
		}
		return $this->subscriptions;
	}

					
function autoload(){

		spl_autoload_register(function($class_name) {

			$name_space = 'Stripe';
			if (substr($class_name, 0, strlen($name_space)) == $name_space) {
				$dir = trailingslashit( dirname(__DIR__ . '/vendor/stripe-php/init.php') );
				$lib = "{$dir}lib";
				$class_name = substr($class_name, strlen($name_space));
				$class_name = str_replace("\\", DIRECTORY_SEPARATOR, $class_name);
				if( $class_name > ''){
					include_once $lib . $class_name . '.php';
				}
				else {
					return false;
				}
			}
			else {
				return false;
			}
		});

	}

		
function script_url( $script = 'stripe' ){
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
