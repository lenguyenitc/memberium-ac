<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}



function wpal_ecomm(){
	return wpal_ecomm::get_instance();
}



class wpal_ecomm {

	public $admin,
	 	$frontend,
		$settings;

	private $functions,
	 $customer,
	 $subscriptions,
	 $invoices,
	 $merchants = [],
     $config = [],
	 $doing_remote_update = false;

	 const META_PREFIX = '_wpal/ecomm/';

    
    
function setup(){

				define('WPAL_ECOMM_VERSION', '1.3.4' );
		define('WPAL_ECOMM_HOME_DIR', dirname(__DIR__) . '/');
		define('WPAL_ECOMM_CLASS_DIR', __DIR__ . '/');
		define('WPAL_ECOMM_TMPL_DIR', WPAL_ECOMM_HOME_DIR . 'templates/');

        $defaults = [
			'debug'					=> 0,
			'debuglog'				=> 'error_log:',
			'prefix'				=> 'wpal_ecomm',
			'menu_slug'				=> 'wpal-ecomm',
			'menu_position'			=> 3,
			'min_password_length'	=> 12,
			'is_pro_install'		=> 0,
			'permissions'			=> 'manage_options',
			'shortcode_prefix'		=> 'ecomm',
			'tmpl_theme_dir'		=> '',
			'tmpl_plugin_path'		=> WPAL_ECOMM_TMPL_DIR,
			'log_directory'			=> WPAL_ECOMM_HOME_DIR . 'logs/',
			'report_page'			=> false,
			'report_name'			=> 'ecomm-orders',
			'I18n'					=> [
				'menu_name'		=> __('WPAL Ecomm', 'wpal_ecomm'),
				'key_title'		=> __('Access Key', 'wpal_ecomm'),
				'keys_title'	=> __('Access Keys', 'wpal_ecomm'),
				'key_name'		=> __('Key', 'wpal_ecomm'),
				'keys_name'		=> __('Keys', 'wpal_ecomm')
			]
		];

        $config = apply_filters( 'wpal/ecomm/config', $defaults );
        $this->config = wp_parse_args( $config, $defaults );

        		define('WPAL_ECOMM_PREFIX', $this->config['prefix'] );
        define('WPAL_ECOMM_DEBUG', (int)$this->config['debug'] );
        define('WPAL_ECOMM_DEBUGLOG', $this->config['debuglog'] );
		$this->config['WPAL_ECOMM_URL'] = trailingslashit( plugins_url( '', dirname(__FILE__) ) );
		$this->config['assets_url'] = $this->config['WPAL_ECOMM_URL'] . 'assets/';
		define('WPAL_ECOMM_URL', $this->config['WPAL_ECOMM_URL']);
		define('WPAL_ECOMM_LOG_DIR', $this->config['log_directory']);

						$this->config['post_types'] = ['products', 'forms', 'orders'];
		$this->config['post_type_slugs'] = [];
		foreach ($this->config['post_types'] as $slug) {
			$this->config[$slug.'_slug'] = WPAL_ECOMM_PREFIX . '_' . $slug;
			$this->config['post_type_slugs'][] = WPAL_ECOMM_PREFIX . '_' . $slug;
		}

                include_once WPAL_ECOMM_CLASS_DIR . 'autoloader.php';

				$this->settings = wpal_ecomm_settings::get_instance();

				if( ! $this->settings->get_option_bool('ext_installed') ){
			wpal_ecomm_activation::activate_extension();
		}

				if( is_admin() ){
			$mainenance_version = $this->settings->get_option('maintained', '1.2.6');
			if (version_compare(WPAL_ECOMM_VERSION, $mainenance_version) > 0) {
				wpal_ecomm_activation::maintenance($mainenance_version);
			}
		}

                $this->add_hooks();

				$this->merchants = apply_filters("wpal/ecomm/register/merchants", $this->merchants);

    }

		
function functions(){

		if( ! $this->functions ){
			$this->functions = wpal_ecomm_order_functions::get_instance();
		}
		return $this->functions;
	}

		
function customer(){

		if( ! $this->customer ){
			$this->customer = wpal_ecomm_customer::get_instance();
		}
		return $this->customer;
	}

		
function subscriptions(){

		if( ! $this->subscriptions ){
			$this->subscriptions = wpal_ecomm_subscriptions::get_instance();
		}
		return $this->subscriptions;
	}

		
function invoices(){

		if( ! $this->invoices ){
			$this->invoices = wpal_ecomm_invoices::get_instance();
		}
		return $this->invoices;
	}

    
	
function add_hooks() {

		add_action("plugins_loaded", [$this, 'text_domain'], 1 );
		add_action("init", [$this, 'handle_catchers']);

				foreach ($this->config['post_types'] as $slug) {
			$slug = ( $slug === 'forms' ) ? "order_forms" : $slug;
			add_action( 'init', ["wpal_ecomm_{$slug}", 'register'] );
		}

				add_action("delete_post", ["wpal_ecomm_admin", "before_delete_wpal_ecomm_post"], 10, 2);

				add_filter("wpal/ecomm/register/merchants", [$this, 'register_merchants']);

				add_filter("wpal/ecomm/new/order", ['wpal_ecomm_order', 'wp_order_created'], 10, 2 );
		add_filter("wpal/ecomm/customer/created", ['wpal_ecomm_order', 'wp_user_customer_created'], 10, 2 );

				add_filter('update_user_metadata', [$this, 'update_user_meta'], 10, 5 );
				add_action('rcktm/crm/id/set', [$this, 'check_user_order_process_queue'], 10, 2);
		add_action("rcktm/crm/contact/added", [$this, 'check_user_order_process_queue'], 10, 2);

				if ( wp_doing_ajax() ) {
			wpal_ecomm_ajax::get_instance()->add_actions();
		}

				add_action("rest_api_init", [$this, 'register_api_routes']);
		add_action("wpal/ecomm/subscription/payment/failed/email", [$this, 'subscription_payment_fail_email']);

				add_action('http_api_curl', [$this, 'http_api_curl_action'], 10, 3);

		if (is_admin()) {
			$this->admin = new wpal_ecomm_admin;
		}
		else {
			$this->frontend = new wpal_ecomm_frontend;
		}

	}

	
function handle_catchers(){
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$export = !empty($_GET['wpal-ecomm-export']) ? sanitize_text_field($_GET['wpal-ecomm-export']) : false;
			if($export){
				wpal_ecomm_export::handle_export( $export, $_GET );
			}
		}
	}

		
function subscription_payment_fail( $args ){

		$email = $args['email'];
		$order_id = $args['order_id'];
		$amount_due = $args['amount_due'];
		$link = $args['link'];

		$failed_key = "wpal/ecomm/subscription/payment/failed/email/";
		$subject =  __('Your most recent invoice payment failed', 'wpal_ecomm');
		$symbol = $this->functions()->get_order_currency($order_id,'symbol');
		$content = [
			[
				'type'		=> 'paragrah',
				'content'	=> "Hi there,
					Unfortunately, your most recent invoice payment for {$symbol}{$amount_due} was declined.
		  			This could be due to a change in your card number, your card expiring,
					cancellation of your credit card, or the card issuer not recognizing the
					payment and therefore taking action to prevent it."
			],
			[
				'type'		=> 'paragrah',
				'content'	=> __('Please update your payment information as soon as possible here:', 'wpal_ecomm')
			],
			[
				'type'		=> 'button',
				'content'	=> __("View / Pay Invoice Here", 'wpal_ecomm'),
				'url'		=> $link
			]
		];

		wpal_ecomm_email::send_mail($email, [
			'subject'	=> apply_filters("{$failed_key}subject", $subject, $args),
			'title'		=> apply_filters("{$failed_key}title", $subject, $args),
			'content'	=> apply_filters("{$failed_key}content", $content, $args)
		]);

	}

	
	
function is_order_form_admin(){

		$order_form = ( isset($_GET['tab']) && $_GET['tab'] == 'order-form' ) ? true : false;
		$admin = ( isset($_GET['page']) && $_GET['page'] == 'wpal-ecomm' ) ? true : false;

		return ( $admin && $order_form ) ? true : false;
	}

	
	
function register_merchants( $merchants ){

		$active_payment_methods = $this->settings->get_option_select('active_payment_methods');
		if( ! empty($active_payment_methods) ){

			foreach ($active_payment_methods as $method) {

				if ( ! isset( $this->merchants[$method] ) ) {

					$merchant_class = "wpal_ecomm_{$method}";
					$merchants[$method] = $merchant_class;

										wpal_ecomm_autoloader::register($merchant_class, WPAL_ECOMM_HOME_DIR."merchants/{$method}/{$method}");
				}
			}
		}
		return $merchants;
	}

	
	
function get_merchant( $merchant ){

		$merchant_class = false;
		if( isset($this->merchants[$merchant]) ){
			$merchant_class = $this->merchants[$merchant];
			if( is_string($merchant_class) ){
				$merchant_class = $merchant_class::get_instance();
			}
		}
		return $merchant_class;
	}

	
function get_merchants() {
		return isset($this->merchants) ? $this->merchants : [];
	}

    
	
function text_domain() {
		load_plugin_textdomain( 'wpal_ecomm', false, __DIR__ . '/languages' );
	}

	
	
function register_api_routes() {
		register_rest_route( 'wpal-ecomm/v1', '/process/(?P<merchant>[^/]+)/(?P<profile>[^/]+)', [
			'methods'				=> ['GET', 'POST'],
			'callback'				=> ['wpal_ecomm_webhooks', 'manage_process_request'],
			'permission_callback'	=> '__return_true'
		] );
	}

		
function update_user_meta( $null, $user_id, $meta_key, $meta_value, $prev_value ){

		if ( $this->get_doing_remote_update() ) {
			return null;
		}

		$is_billing = (strpos($meta_key, 'billing_') !== false);
		$is_user_name = ( $meta_key === 'first_name' || $meta_key === 'last_name' );

		if( ! $is_billing && ! $is_user_name ){
			return null;
		}

		if( ! $prev_value > '' ){
			$prev_value = get_user_meta($user_id, $meta_key, true);
		}

		if ($prev_value == $meta_value) {
			return null;
		}

		if( $is_user_name ){
			update_user_meta($user_id, "billing_{$meta_key}", $meta_value);
		}
		else{
			wpal_ecomm()->customer()->updating_user_meta($user_id, $meta_key, $meta_value);
		}

	}

	
function check_user_order_process_queue( $user_id, $contact_id = '' ){
		$order_ids = wpal_ecomm()->customer()->get_user_orders_process_queue($user_id);
		if( is_array($order_ids) ){
			foreach ($order_ids as $order_id) {
				wpal_ecomm()->customer()->process_order_queue($user_id, $order_id, __FUNCTION__);
			}
		}
	}

	
function set_doing_remote_update($x) {
		$this->doing_remote_update = (bool) $x;
	}

	
function get_doing_remote_update() {
		return $this->doing_remote_update;
	}

	
	
function http_api_curl_action( $handle, $r, $url ) {
		if ( strstr($url,'https://') && (strstr($url,'.paypal.com') ) ) {
			curl_setopt( $handle, CURLOPT_SSLVERSION, 6 );
		}
	}

	
function is_pro_install(){
		 $is_pro = $this->get_config('is_pro_install');
		 return ( (int)$is_pro > 0 );
	}

	
function reset_flushed_rewrites(){
		$this->settings->set_option('flushed_rewrites', 0);
		$this->settings->save();
	}

	
	
function get_config( $key = false ){
				if( $key ){
			if( isset( $this->config[$key] ) ){
				return $this->config[$key];
			}
			else {
				return false;
			}
		}
				else {
			return $this->config;
		}
	}

	
	
function set_config( $key, $value ){
		if(is_string($key)) {
			$config = empty($this->config) ? $this->get_config() : $this->config;
			$config[$key] = $value;
		}
		else {
			wp_die('Invalid Key ' . $key . " in ". __FUNCTION__ );
		}

		if( $config != $this->config ){
			$this->config = $config;
		}
	}

	
function get_meta_prefix(){
		return self::META_PREFIX;
	}

	
    public static 
function get_instance() {
        static $instance = null;
        if ( is_null( $instance ) ) {
            $instance = new self;
            $instance->setup();
        }
        return $instance;
    }

}
