<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}



if (! class_exists('wpal_ecomm_settings') ) {

	
class wpal_ecomm_settings {

		protected static $instance = null;
		private $key               = 'wpal/ecomm/settings';
		private $preferences       = false;
		private $dirty             = false;
		private $keys              = [];

		
		
function __construct() {
			$this->load();
		}

		
function __destruct() {
			if ( $this->dirty ) {
				$this->save();
			}
		}

		
		public 
function load() {
			$options = get_option($this->key, [] );
			$defaults = [
				'ext_installed'					=>	0,
				'base_location'					=>	'US',
				'descriptor' 					=>	get_bloginfo('name'),
				'support_email'					=>	'',
				'sender_name'					=>	'Wordpress',
				'sender_email'					=>	'',
				'default_currency'				=>	'usd',
				'registered_payment_methods'	=>	'stripe,paypal',
				'active_payment_methods'		=>	'stripe,paypal',
				'default_method'				=>	'stripe',
				'profile_methods'				=>	[],
				'default_email'					=>	get_bloginfo('admin_email'),
				'bulk_cancel'					=>	[],
				'is_pro_install'				=>	0
			];
						$defaults = apply_filters('wpal/ecomm/settings/defaults', $defaults);
			$options['registered_payment_methods'] = 'stripe,paypal';
			$this->preferences = wp_parse_args( $options, $defaults );
			wp_cache_add('options', $this->preferences, 'wpal/ecomm/global');
		}

		
		public 
function save() {
			if ( ! empty( $this->preferences ) ) {
				update_option( $this->key, $this->preferences, true );
				$this->dirty = false;
			}
		}

		
		public 
function get_options() {
			if ( $this->preferences === false ) {
				$this->preferences = $this->load();
			}
			return $this->preferences;
		}

		
		public 
function get_option($key = '', $default = null) {

			if ( $this->preferences === false ) {
				$this->preferences = $this->load();
			}

			if (is_array($key)) {
				return array_intersect_key(array_flip($key), $this->preferences);
			}

			if ( array_key_exists( $key, $this->preferences) ) {
				return $this->preferences[$key];
			}

			return $default;
		}

		
		public 
function set_option( $key = '', $value = '' ) {

			if ( isset( $this->preferences[$key] ) && $this->preferences[$key] == $value ) {
				return true;
			}

			$this->preferences[$key] = $value;
			$this->dirty = true;

		}

		
		public 
function set( $key, $value ) {
			$this->keys[$key] = $value;
		}

		
		public 
function get( $key, $default = false ) {
			if ( isset( $keys[$key] ) ) {
				return $keys[$key];
			}

			return $default;
		}

		
		public 
function get_option_select( $key ){
			$value = $this->get_option($key);
			return ( $value > '' ) ? explode(',', trim($value, ',') ) : [];
		}

		
		public 
function get_option_bool( $key ){
			return ( (int)$this->get_option($key) > 0 ) ? true : false;
		}

		
		public 
function get_merchant_profile( $key = '' ){
			$method = false;
			if( $key > '' ){
				$methods = $this->get_option('profile_methods');
				if( is_array($methods) && array_key_exists($key, $methods) ){
					$method = $methods[$key];
					$method['key'] = $key;
				}
			}
			return $method;
		}

		public 
function get_merchant_name( $key ){
			$merchant = $this->get_merchant_profile($key);
			if( $merchant ){
				return $merchant['name'];
			}
		}

		
		public 
function set_profile( $key, $value = null, $property = '' ){

			$profiles = $this->get_option('profile_methods');
			$updated = false;
			if( is_array($profiles) && array_key_exists($key, $profiles) ){
								if( is_string($property) && $property > '' ){
					$profiles[$key][$property] = $value;
					$updated = true;
				}
								else {
					if( ! is_null($value) ){
						$profiles[$key] = $value;
						$updated = true;
					}
				}

			}

			if($updated){
				$this->set_option('profile_methods', $profiles);
			}

			return $profiles;
		}

		
		
function get_url($key){

			if( !is_string($key) ){
				return false;
			}
			$post_id = $this->get_option($key);
			if( (int)$post_id < 1 ){
				return false;
			}
						if( $this->post_exists($post_id) ){
				return get_the_permalink($post_id);
			}
			else{
				return false;
			}
		}

		
		
function post_exists($post_id){
			$post_status = (int)$post_id > 0 ? get_post_status( $post_id ) : false;
			return is_string($post_status) && $post_status === 'publish';
		}

		
		
function get_support_email(){

			$email = $this->get_option('support_email', '');
			if( is_email($email) ){
				return $email;
			}
			else{
				return '';
			}
		}

		
		
function get_sender_email(){

			$email = $this->get_option('sender_email', false);
			if( ! is_email($email) ){
				$urlparts = parse_url(home_url());
				$email = 'wordpress@' . $urlparts['host'];
			}
			return $email;
		}

		
		public static 
function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

	}
}
