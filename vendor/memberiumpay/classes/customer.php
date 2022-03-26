<?php
/**
 * Copyright (C) 2017-2019 David Bullock
 * Web Power and Light, LLC
 */



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}



class wpal_ecomm_customer {

	const PAYMENT_DEFAULT_KEY = '/wpal/ecomm/default/payment/details';
	const PAYMENT_KEY         = '/wpal/ecomm/payment/details';
	const NAME_ON_CARD        = '/wpal/ecomm/name/on/card';
	const QUEUE_KEY           = '/wpal/ecomm/queue';

	private $updated_meta = [];

		
function create_wp_customer($data){
		$response = [
			'user_id' 	=> 0,
			'error'		=> ''
		];

		$error      = false;
		$customer   = isset($data['contact']) ? $data['contact'] : [];
		$user_email = isset($customer['billing_email']) ? strtolower($customer['billing_email']) : false;
		$password   = false;

		if ( isset($customer['new_account_password']) ){
						$password = $customer['new_account_password'];
			$password = $password > '' ? $password : false;
			unset($customer['new_account_password']);
		}

				add_filter('send_email_change_email', [$this,'disable_email_change_email'], PHP_INT_MAX, 3 );

				$user_args = [
			'user_pass'  => $password,
			'user_email' => $user_email,
			'user_login' => $user_email,
		];

				$names = [
			'first_name' => 'billing_first_name',
			'last_name'  => 'billing_last_name'
		];

		foreach ($names as $key => $name) {
			$user_args[$key] = empty($customer[$name]) ? '' : sanitize_text_field($customer[$name]);
		}

		
		$existing = apply_filters('wpal/ecomm/customer/add_update', false, $user_args, $customer);
		$existing = ( is_object($existing) && get_class($existing) == 'WP_User' ) ? $existing : false;
		if( $existing ){
			$user_id = $existing->ID;
		}
				else {
						$existing = get_user_by('email', $user_email);
			if($existing) {
				$user_id = $existing->ID;
				unset($user_args['user_pass']);
								foreach ($user_args as $key => $value) {
					if($value === $existing->data->{$key}){
						unset($user_args[$key]);
					}
				}
				if(! empty($user_args)){
					$user_args['ID'] = $user_id;
					wp_update_user($user_args);
				}
			}
			else{
				$user_id = wp_insert_user($user_args);
			}
		}

				if( ! is_wp_error($user_id) ){

			$order_id = isset($data['order_id']) ? $data['order_id'] : 0;
			if( (int)$order_id > 0 ){
				wpal_ecomm()->functions()->update_order_user_id($order_id,$user_id);
			}

						wpal_ecomm()->set_doing_remote_update(true);
			$response['user_id'] = $user_id;
			$this->update_user_details($user_id, $customer, 'create_customer');
			$this->update_merchant_profile_customer_id($user_id, $data);
			$this->set_merchant_profile_payment_details($user_id, '', $data, true);
			wpal_ecomm()->set_doing_remote_update(false);

			if(! $existing) {
				do_action('wpal/ecomm/customer/created', $user_id, $order_id);
			}

			$this->process_order_queue($user_id, $order_id, __FUNCTION__);

						wp_set_auth_cookie($user_id, true, '');
			wp_set_current_user($user_id);
		}
		else{
			$response['error'] = $user_id->get_error_message();
		}

				remove_filter('send_email_change_email', [$this,'disable_email_change_email'], PHP_INT_MAX);

		return $response;
	}

	
function process_order_queue( $user_id = 0, $order_id = 0, $calling_function ){

		if( (int)$user_id > 0 && (int)$order_id > 0 ){
			$functions = wpal_ecomm()->functions();
			$queue = $functions->get_order_process_queue($order_id);
			if($queue){
				$log_data = $queue;
				$invoice_id = isset($queue['invoice_id']) ? $queue['invoice_id'] : false;
				if( isset($invoice_id) ){
					do_action($queue['action'], $order_id, $invoice_id, $queue['merchant_profile']);
				}
				else{
					do_action($queue['action'], $order_id, $queue['merchant_profile']);
				}
								$queue = $functions->get_order_process_queue($order_id);
				if( $queue ){
					$result = "Adding to User Meta To Process";
					$this->add_order_id_to_user_process_queue($user_id, $order_id);
				}
				else{
										$merchant = $functions->get_order_merchant($order_id);
			        $merchant_class = wpal_ecomm()->get_merchant($merchant);
					if( $merchant_class ){
						$merchant_functions = $merchant_class->functions();
						if( method_exists($merchant_functions, 'process_order_queue') ){
							add_action("wpal/ecomm/process/order/queue/{$merchant}", [$merchant_functions, 'process_order_queue'], 10, 2);
							do_action("wpal/ecomm/process/order/queue/{$merchant}", $order_id, $user_id);
						}
					}
					$result = "Processed";
				}
								if( defined('WPAL_ECOMM_QUEUE_LOG') && WPAL_ECOMM_QUEUE_LOG ){
					$log_data['user_id'] = $user_id;
					$log_data['order_id'] = $order_id;
					$log_data['contact_id'] = rcktm_user::get_crm_id_by_user_id($user_id);
					wpal_ecomm_debug::order_process_queue_log( $calling_function, $log_data, $result );
				}
			}
		}
	}

	
function get_user_orders_process_queue($user_id){
		$queued_order_ids = [];
		$order_ids = wpal_ecomm()->functions()->get_queued_order_ids($user_id);
		$user_meta_order_ids = get_user_meta($user_id, self::QUEUE_KEY, true);
		if($user_meta_order_ids){
			$queued_order_ids = array_unique(array_merge($user_meta_order_ids, $order_ids));
		}
		return ( ! empty($queued_order_ids) ) ? $queued_order_ids : false;
	}

	
function add_order_id_to_user_process_queue( $user_id, $order_id ){
		$order_ids = get_user_meta($user_id, self::QUEUE_KEY, true);
		if( ! $order_ids ){
			$order_ids = [];
		}
		if( !in_array($order_id, $order_ids) ){
			$order_ids[] = $order_id;
			update_user_meta($user_id, self::QUEUE_KEY, $order_ids);
		}
	}

	
function remove_order_id_from_user_process_queue( $user_id, $order_id ){
		$order_ids = get_user_meta($user_id, self::QUEUE_KEY, true);
		if( ! $order_ids ){
			return;
		}
		if( in_array($order_id, $order_ids) ){
			$i = array_search($order_id, $order_ids);
			unset($order_ids[$i]);
			if( empty($order_ids) ){
				delete_user_meta($user_id, self::QUEUE_KEY);
			}
			else{
				update_user_meta($user_id, self::QUEUE_KEY, $order_ids);
			}
		}
	}

		
function update_order_customer( $user_id, $data ){
		$customer = ( isset($data['contact']) ) ? $data['contact'] : [];
		$this->update_user_details($user_id, $customer, 'update_customer');
		$this->update_merchant_profile_customer_id($user_id,$data);
		$this->set_merchant_profile_payment_details($user_id, '', $data, true);
	}

		
function update_user_details($user_id, $data, $context){
		$user_meta = get_user_meta($user_id);
		$updated_user_args = [];
		$user_args = ['billing_email', 'billing_first_name', 'billing_last_name'];
		foreach ($data as $key => $value) {
			$existing_value = isset($user_meta[$key]) ? $user_meta[$key][0] : false;
			if( !$existing_value || $value != $existing_value ){
				if( in_array($key, $user_args) ){
					$user_key = substr($key, 8);
					$user_key = $user_key === 'email' ? 'user_email' : $user_key;
					$updated_user_args[$user_key] = $value;
				}
				if( $key !== 'billing_email' ){
					update_user_meta($user_id, $key, $value);
				}
			}
		}
		if( !empty($updated_user_args) ){
			$this->manage_wp_user_update( $user_id, $updated_user_args, $context );
		}
	}

	
function manage_wp_user_update( $user_id, $args, $context ){

		$updated = [];
		$user = get_user_by('ID',$user_id);
		$user_email = !empty($args['user_email']) ? $args['user_email'] : false;
		if( $user_email ){
						$user_email = $this->manage_user_email($user_id, $user_email, $user->user_email);
			if( ! $user_email ){
				unset($args['user_email']);
			}
		}
				if( empty($args) ){
			return;
		}

		$args['ID'] = $user_id;
		$args = apply_filters('wpal/ecomm/updated/user/args', $args, $context );
		if( ! empty($args) ){
			wp_update_user($args);
		}

		if($user_email){
			do_action('wpal/ecomm/updated/user_email', $user_id, $user_email, $existing);
		}

	}

		
function manage_user_email( $user_id, $email, $user_email ){

				$new = strtolower( trim($email) );
		$existing = strtolower( $user_email );

				if( $new === $existing ){
			$new_changed = ( $email != $user_email );
			$existing_changed = ( $existing != $user_email );
			if( $new_changed ){
								return false;
			}
						if( $existing_changed ){
								global $wpdb;
				$wpdb->update( "{$wpdb->prefix}users", ['user_email' => $new], ['ID' => $user_id] );
				update_user_meta($user_id, 'billing_email', $new);
				return false;
			}
		}
				else{
			update_user_meta($user_id, 'billing_email', $new);
			return $new;
		}
	}

		
function get_payment_details( $user_id ){
		$payment_details = get_user_meta($user_id, self::PAYMENT_KEY, true);

		if (! $payment_details) {
						$default = get_user_meta($user_id, self::PAYMENT_DEFAULT_KEY, true);

			if ($default) {
				$default['default'] = 1;
				$payment_details = $this->set_merchant_profile_payment_details( $user_id, '', $default, true );
				delete_user_meta( $user_id, self::PAYMENT_DEFAULT_KEY );
			}
		}

				if($payment_details){
			$active_payment_methods = wpal_ecomm()->settings->get_option_select('active_payment_methods');

			foreach ($payment_details as $p => $details) {
				if( in_array($details['merchant'], $active_payment_methods) ){
					$payment_details[$p] = $this->manage_merchant_profile_payment_details_customer_id( $user_id, $details );
				}
				else{
					unset($payment_details[$p]);
				}
			}
		}
		return $payment_details;
	}

		
function get_merchant_profile_payment_details( $user_id, $profile_id ){
		$payment_details = get_user_meta( $user_id, self::PAYMENT_KEY, true );
		if( is_array($payment_details) && array_key_exists($profile_id, $payment_details) ){
			return $this->manage_merchant_profile_payment_details_customer_id( $user_id, $payment_details[$profile_id] );
		}
		else{
			return false;
		}
	}

		
function set_merchant_profile_payment_details( $user_id, $profile_id, $data, $make_default = false ){

		$order_id = ( isset($data['order_id']) ) ? (int)$data['order_id'] : 0;
		$from_order = ( (int)$order_id > 0 ) ? $order_id : false;

				if( ! (int)$user_id > 0 ){
			$user_id = ( isset($data['user_id']) ) ? (int)$data['user_id'] : 0;
			if( ! $user_id > 0 ){
				if( $from_order ){
					$user_id = wpal_ecomm()->functions()->get_order_user_id($order_id);
				}
			}
		}
		if( ! (int)$user_id > 0 ){
			return false;
		}

				if( ! $profile_id > '' ){
			$profile_id = isset($data['profile_id']) ? $data['profile_id'] : '';
			if( ! $profile_id > '' ){
				if( $from_order ){
					$profile_id = wpal_ecomm()->functions()->get_order_profile_id($order_id);
				}
			}
		}
		if( ! $profile_id > '' ){
			return false;
		}

		$merchant_profile = wpal_ecomm()->settings->get_merchant_profile($profile_id);
		if( ! $merchant_profile ){
			return false;
		}
		$sandbox = ( (int)$merchant_profile['sandbox'] > 0 );
		$index = ( $sandbox ) ? 'sandbox' : 'details';

		$merchant = ( empty($data['merchant']) ) ? '' : $data['merchant'];
		if( ! $merchant > '' ){
			$merchant = $merchant_profile['merchant'];
		}

				$customer_id = ( ! empty($data['customer_id']) ) ? $data['customer_id'] : '';
		if( ! $customer_id > '' ){
			if( isset($data[$index]) && is_array($data[$index]) && !empty($data[$index]['customer_id']) ){
				$customer_id = $data[$index]['customer_id'];
			}
			else{
				$customer_id = $this->get_merchant_profile_customer_id($user_id, $profile_id);
				$customer_id = ( $customer_id ) ? $customer_id : '';
			}
		}

				$config = [
			'customer_id'	=> $customer_id,
			'card'			=> false
		];

				$merchant_class = wpal_ecomm()->get_merchant($merchant);
		add_filter("wpal/ecomm/{$merchant}/payment/details", [$merchant_class, 'payment_details_config'], 10, 4 );
		$config = apply_filters("wpal/ecomm/{$merchant}/payment/details", $config, $user_id, $merchant_profile, $data);

				$payment_details = get_user_meta( $user_id, self::PAYMENT_KEY, true );
		$payment_details = ( $payment_details ) ? $payment_details : [];
		if( empty($payment_details[$profile_id]) ){
			$payment_details[$profile_id] = [
				'merchant'		=> $merchant,
				'profile_id'	=> $profile_id,
				'details'		=> false
			];
		}

		$payment_details[$profile_id][$index] = $config;

		if( $make_default ){
			foreach ($payment_details as $key => $payment_detail) {
				if($key === $profile_id){
					$payment_details[$key][$index]['default'] = 1;
				}
				else{
					if( array_key_exists($index, $payment_details[$key]) ){
						if( is_array($payment_details[$key][$index]) ){
							$payment_details[$key][$index]['default'] = 0;
						}
					}
				}
			}
		}
		update_user_meta( $user_id, self::PAYMENT_KEY, $payment_details );
		return $payment_details;
	}

		
function get_merchant_profile_customer_id($user_id, $profile_id){

		$prefix = $this->get_merchant_profile_prefix_by_id($profile_id);
		if( ! $prefix ){
			return false;
		}

		return get_user_meta( $user_id, "{$prefix}customer_id", true );
	}

		
function update_merchant_profile_customer_id( $user_id, $data ){
		$customer_id = ( isset($data['customer_id']) ) ? $data['customer_id'] : '';
		$profile_id = ( isset($data['profile_id']) ) ? $data['profile_id'] : '';
		if( $profile_id > '' && $customer_id > '' ){
			$prefix = $this->get_merchant_profile_prefix_by_id($profile_id);
			if($prefix){
				update_user_meta($user_id, "{$prefix}customer_id", $customer_id );
							}
		}
	}

		
function manage_merchant_profile_payment_details_customer_id( $user_id, $details ){
		if( $details && is_array($details) ){
			$profile_id = $details['profile_id'];
			$merchant_profile = wpal_ecomm()->settings->get_merchant_profile($profile_id);
			if( ! $merchant_profile ){
				return $details;
			}
						$sandbox = ( (int)$merchant_profile['sandbox'] > 0 );
			$index = ( $sandbox ) ? 'sandbox' : 'details';
			$customer_id = '';
			if( !empty($details[$index]) && is_array($details[$index]) ){
				$customer_id = empty($details[$index]['customer_id']) ? '' : $details[$index]['customer_id'];
			}

	        	        if( empty($customer_id) ){
				$customer_id = $this->get_merchant_profile_customer_id($user_id, $profile_id);
				if( $customer_id ){
					$details[$index]['customer_id'] = $customer_id;
					$payment_details = get_user_meta( $user_id, self::PAYMENT_KEY, true );
					if( !empty($payment_details[$index]) && is_array($payment_details[$index]) ){
						$payment_details[$profile_id][$index]['customer_id'] = $customer_id;
						update_user_meta( $user_id, self::PAYMENT_KEY, $payment_details);
					}
				}
			}
		}
		return $details;
	}

		
function get_merchant_profile_prefix_by_id( $profile_id ){
		$merchant_profile = wpal_ecomm()->settings->get_merchant_profile($profile_id);
		if( ! $merchant_profile ){
			return false;
		}
		$merchant = $merchant_profile['method'];
		$merchant_class = wpal_ecomm()->get_merchant($merchant);
		return $merchant_class->get_merchant_profile_prefix($merchant_profile);
	}

        
function get_contact_fields( $type = 'billing', $order_form = '' ) {
        $ns = 'wpal_ecomm';
                $prefix = $type > '' ? "{$type}_" : '';

		$fields = [
			[
				'label'		   => __('Email Address', $ns),
				'name' 		   => "{$prefix}email",
				'required'	   => 1,
				'validate'	   => 'email',
				'msg'		   => __('Please enter a valid email', $ns),
				'autocomplete' => "email",
				'priority'	   => 100
		   ],
		   [
			   'label'		  => __('First Name', $ns),
			   'name' 		  => "{$prefix}first_name",
			   'required'	  => 1,
			   'validate'	  => 'common',
			   'msg'		  => __('Please enter your first name', $ns),
			   'autocomplete' => "given-name",
			   'priority'	  => 200
		   ],
		   [
			   'label'		  => __('Last Name', $ns),
			   'name'		  => "{$prefix}last_name",
			   'required'	  => 1,
			   'validate'	  => 'common',
			   'msg'		  => __('Please enter your last name', $ns),
			   'autocomplete' => "family-name",
			   'priority'	  => 300
            ],
			[
				'label'		   => __('Phone', $ns),
				'name' 		   => "{$prefix}phone",
				'validate'	   => 'phone',
				'msg'		   => __('Please enter a valid phone number', $ns),
				'autocomplete' => "tel",
				'priority'	   => 400
            ]
		];

		if (! empty($order_form) ) {
			$fields = $this->configured_form_fields($fields, $order_form);
		}

		return $fields;
    }

        
function get_address_fields( $type = 'billing', $order_form = '' ) {

        $ns = 'wpal_ecomm';
                $prefix = ( $type > '' ) ? "{$type}_" : "";
        $fields = [
			[
				'label'		   => __('Street Address', $ns),
				'name' 		   => "{$prefix}address_1",
				'required'	   => 1,
				'validate'	   => 'length',
				'msg'		   => __('Please enter your street address', $ns),
				'autocomplete' => "{$type} street-address",
				'priority'	   => 100,
            ],
            [
				'label'		   => __('Street Address Line 2', $ns),
				'name' 		   => "{$prefix}address_2",
				'autocomplete' => "{$type} street-address2",
				'priority'	   => 200
			],
			[
				'label'		   => __('Country', $ns),
				'name' 		   => "{$prefix}country",
				'type'		   => 'country_select',
				'validate'	   => 'country',
				'required'	   => 1,
				'msg'		   => __('Please select your country', $ns),
				'autocomplete' => "{$type} country-name",
				'priority'	   => 300
			],
			[
				'label'		  => __('Region', $ns),
				'name' 		  => "{$prefix}state",
				'type'		  => 'region_select',
				'validate'	  => 'region',
				'required'	  => 1,
				'msg'		  => __('Please select your region', $ns),
				'autocomplete' => "{$type} address-level1",
				'priority'	  => 400
			],
			[
				'label'		  => __('City / Town', $ns),
				'name' 		  => "{$prefix}city",
				'required'	  => 1,
				'validate'	  => 'common',
				'msg'		  => __('Please enter your city or town', $ns),
				'autocomplete' => "{$type} address-level2",
				'priority'	  => 500
			],
			[
				'label'		  => __('Zip / Postal Code', $ns),
				'name' 		  => "{$prefix}postcode",
				'required'	  => 1,
				'validate'	  => 'length',
				'msg'		  => __('Please enter your Zip/Postal Code', $ns),
				'autocomplete' => "{$type} postal-code",
				'priority'	  => 600
			]
		];
		if (! empty($order_form) ) {
			$fields = $this->configured_form_fields($fields, $order_form);
		}
		return $fields;
    }

	
function get_full_name( $user_id ){

		$prefix = 'billing_';
		$first = get_user_meta($user_id, "{$prefix}first_name", true);
		$last = get_user_meta($user_id, "{$prefix}last_name", true);
		if( ! $first && ! $last ){
			$first = get_user_meta($user_id, "first_name", true);
			$last = get_user_meta($user_id, "last_name", true);
		}

		$full_name = ( $first && $first > '' ) ? "{$first} " : "";
		$full_name .= ( $last && $last > '' ) ? $last : "";

		return trim($full_name);
	}

		
function get_payment_fields( $user_id ){

		$name_on_card = get_user_meta( $user_id, self::NAME_ON_CARD, true);
		if( ! $name_on_card ){
			$name_on_card = $this->get_full_name($user_id);
		}
		        return [
			[
				'label'		=> __('Name on Card', 'wpal_ecomm'),
				'name' 		=> "name_on_card",
				'required'	=> 1,
				'validate'	=> 'common',
				'msg'		=> __('Please enter the name as it appears on your card.', 'wpal_ecomm'),
				'value'		=> $name_on_card,
				'priority'	=> 100
			]
		];
    }

	
function get_consent_fields( $order_form = '' ) {
        $ns     = 'wpal_ecomm';
		$fields = [];

		$fields = [
			[
				'label'		=> __('Terms and Conditions', $ns),
				'name' 		=> "terms",
				'type'		=> "checkbox",
				'required'	=> 0,
				'msg'		=> __('Please agree to the terms and conditions', $ns),
				'priority'	=> 100
			],
			[
				'label'		=> __('Privacy Policy', $ns),
				'name' 		=> "privacy",
				'type'		=> "checkbox",
				'required'	=> 0,
				'msg'		=> __('Please agree to the privacy policy', $ns),
				'priority'	=> 200
			],
			[
				'label'		=> __('GDPR', $ns),
				'name' 		=> "gdpr",
				'type'		=> "checkbox",
				'required'	=> 0,
				'msg'		=> __('Please agree to GDPR consent', $ns),
				'priority'	=> 300
			]
		];

		if (! empty($order_form) ) {
			$fields = $this->configured_form_fields($fields, $order_form);
		}
		return $fields;

	}

		
function configured_form_fields( $fields, $config ){

		if (is_int($config)) {
			$config = wpal_ecomm()->functions()->order_form_config($config);
		}

		if ( ! is_array($config)) {
			return $fields;
		}

				$admin_fields = ['label', 'required', 'msg'];
		foreach ($fields as $i => $field) {
			$name = $field['name'];
			$enabled = ( !empty($config["{$name}_enabled"]) && (int)$config["{$name}_enabled"] > 0 );
			if( $enabled ){
				$required = ( !empty($config["{$name}_required"]) && (int)$config["{$name}_required"] > 0 );
				foreach ($admin_fields as $key) {
					if( $key === 'label' ){
						$fields[$i][$key] = wpal_ecomm()->functions()->editor_content($config["{$name}_{$key}"]);
						if( $required ){
							$fields[$i][$key] .= apply_filters("wpal/ecomm/field/required", " <span class=\"required\">*</span>");
						}
						else{
							$optional_text = __('( Optional )', 'wpal_ecomm');
							$fields[$i][$key] .= apply_filters("wpal/ecomm/field/optional", " <span class=\"optional\">{$optional_text}</span>");
						}
					}
					else{
						$fields[$i][$key] = $config["{$name}_{$key}"];
					}
				}
			}
			else{
				unset($fields[$i]);
			}
		}

		return $fields;
	}

	
	
function populate_order_billing_meta( $fields, $user_id = 0, $form_id = 0, $prefix = 'billing_' ){
		$user_info = false;
		if( $user_id > 0 ){
			$user_meta = get_user_meta( $user_id );
			$user_info = false;
			foreach ($fields as $key => $field) {
				$name = $field['name'];
				$type = ( isset($field['type']) ) ? $field['type'] : '';
				if( $name === 'billing_email' ){
					$user_info = ( ! $user_info ) ? get_userdata($user_id) : $user_info;
					$value = $user_info->user_email;
				}
				else{
					$value = ( isset($user_meta[$name]) ) ? $user_meta[$name][0] : '';
				}
				$value = ( isset($user_meta[$name]) ) ? $user_meta[$name][0] : '';
				$fields[$key]['value'] = '';
				if( $value > '' ){

					if( $type === 'country_select' || $type === 'region_select' ){
						$cr_data = wpal_ecomm_data::get_country_region_data();
						if( $type === 'country_select' ){
							$country_index = array_search($value, array_column($cr_data, 'countryShortCode'));
							if( isset($cr_data[$country_index]) ){
								$country = $cr_data[$country_index];
								$fields[$key]['shortcode'] = $value;
								$fields[$key]['fullname'] = $country['countryName'];
							}
						}
						else if( $type === 'region_select' ){
							$country_meta_name = str_replace( 'state', 'country', $name );
							$country_value = ( isset($user_meta[$country_meta_name]) ) ? $user_meta[$country_meta_name][0] : '';
							if( $country_value > '' ){
								$country_index = array_search($country_value, array_column($cr_data,'countryShortCode'));
								$country = ( isset($cr_data[$country_index]) ) ? $cr_data[$country_index] : false;
								if($country){
									$regions = $country['regions'];
									$region_index = array_search($value, array_column($regions,'shortCode'));
									$region = ( $region_index ) ? $regions[$region_index] : false;
									if($region){
										$fields[$key]['shortcode'] = $value;
										$fields[$key]['fullname'] = $value;
										$value = $region['shortCode'];
									}
								}
							}
						}
					}

					$fields[$key]['value'] = $value;
				}
				else{
					$info_array = [
						"{$prefix}first_name"	=> 0,
						"{$prefix}last_name"	=> 0,
						"{$prefix}email"		=> 0
					];
					if( array_key_exists($name, $info_array) ){
						$user_info = ( ! $user_info ) ? get_userdata($user_id) : $user_info;
						if($name === "{$prefix}first_name"){
							$fields[$key]['value'] = $user_info->first_name;
						}
						else if($name === "{$prefix}last_name"){
							$fields[$key]['value'] = $user_info->last_name;
						}
						else if($name === "{$prefix}email"){
							$fields[$key]['value'] = $user_info->user_email;
						}
					}
				}
			}
		}

		return $fields;
	}

	
	
function populate_account_fields( $fields, $user_id ){

		$fields = $this->populate_order_billing_meta( $fields, $user_id );
		return $fields;
	}

		
function get_orders( $user_id, $meta_query = [], $invoice_details = true ){

		if( $user_id < 1 ){
			return false;
		}
		$functions = wpal_ecomm()->functions();
		$order_prefix = $functions->get_prefix();
		$invoice_prefix = $functions->get_invoice_prefix();
		$orders_slug = wpal_ecomm()->get_config('orders_slug');
		$args = [
			'post_type' 		=> $orders_slug,
			'posts_per_page' 	=> -1,
			'post_status'		=> 'publish',
			'post_parent'		=> 0,
			'orderby'			=> 'modified'
	  	];
		if( ! empty($meta_query) ){
			if( ! isset($meta_query['relation']) ){
				$meta_query['relation'] = 'AND';
			}
		}
		$meta_query[] = [
			'key'	=> "{$order_prefix}user_id",
			'value'	=> $user_id
		];
		$args['meta_query'] = $meta_query;
		$query = new WP_Query( $args );
		if( $query->have_posts() ){
			$data = [];
						$date_format = get_option('date_format');
			foreach ($query->posts as $post) {
				$post_id = $post->ID;
				$order = $functions->get_order_metadata($post_id);
				$order['name'] = $post->post_title;
				$order['ID'] = $post_id;
				$order['order_created'] = wp_date($date_format,strtotime($post->post_date));
				$order['currency_symbol'] = wpal_ecomm_data::get_currency_symbol_by_code($order['currency']);
				$type = $order['type'];
				$merchant = $order['merchant'];
								if($merchant === 'paypal'){
					$order['payment_details'] = 'Paypal';
				}
				if( $type === 'subscription' ){
					$na = __('n/a', 'wpal_ecomm');
					$order['invoices'] = $functions->get_order_subscription_data($post_id);
					$order['subscription/name'] = $order['items'][0]['name'];
					$plan_id = ( !empty($order['plan/id']) ) ? (int)$order['plan/id'] : 0;
					$plan = ($plan_id) ? json_decode(get_post_field('post_content', $plan_id),true) : [];
					$order['allow_cancel'] = ( !empty($plan['allow_cancel']) ) ? (int)$plan['allow_cancel'] : 0;
					$expired = false;
					$end_date = (isset($order['current/period/end'])) ? $order['current/period/end'] : false;
					$bill_interval = ( !empty($plan['bill_interval']) && (int)$plan['bill_interval'] > 1 ) ? (int)$plan['bill_interval'] : 1;
					if( !isset($order['subscription/bill/interval']) ){
						update_post_meta($order['ID'],"{$order_prefix}subscription/bill/interval", $bill_interval);
						$order['subscription/bill/interval'] = $bill_interval;
					}
										if($end_date){
						$expired = ( wp_date("Ymd") > wp_date("Ymd",$end_date) );
					}
										$next_amount = (isset($order['next/due/amount'])) ? $order['next/due/amount'] : false;
					if( $expired || ! $next_amount ){
						$order['next_bill_amount'] = $na;
					}
					else{
						$interval = $order['subscription/interval'];
						if( $bill_interval > 1 ){
							$plural = wpal_ecomm_data::subscription_intervals_plural($interval);
							$interval = $bill_interval . ' ' . $plural;
						}
						$order['next_bill_amount'] = sprintf("%s%s(%s) / %s",
							$order['currency_symbol'],
							(isset($order['next/due/amount'])) ? $order['next/due/amount'] : false,
							strtoupper($order['currency']),
							$interval
						);
					}

										$end_date_display = ($end_date) ? wp_date('M j Y', $end_date) : $na;
					$order['next_bill_date'] = ( $expired || ! $end_date || $order['next_bill_amount'] === $na ) ? $na : $end_date_display;
					$order['current_end_date'] = $end_date_display;

										$canceled_date = (isset($order['canceled/date'])) ? $order['canceled/date'] : false;
					if($canceled_date){
						$order['canceled_date'] = wp_date('M j Y', $canceled_date);
												if( ! empty($order['cancel/on/process']) ){
							$order['cancel_on_date'] = wp_date('M j Y', $order['cancel/on/process']);
						}
					}
				}
				$data[$type][$post_id] = $order;
			}
			return $data;
		}
		else {
			return false;
		}
	}

		
function get_customer_ids($user_id){

		$data = [];
		$pre = '/wpal/ecomm/';
		$suffix = '/customer_id';
		global $wpdb;
		$sql = "SELECT meta_key, meta_value
			FROM {$wpdb->usermeta}
			WHERE user_id = '$user_id'
			AND meta_key LIKE '$pre%$suffix'";
		$ids = $wpdb->get_results( $sql );
		if($ids){
			foreach ($ids as $id) {
				$keys = explode( '/', substr($id->meta_key, 12) );
				$merchant = $keys[0];
				$profile = $keys[1];
				$status_key = ( $profile === 'sandbox' ) ? $profile : 'live';
				$profile = ( $profile === 'sandbox' ) ? $keys[2] : $profile;
				if( ! isset($data[$merchant]) ){
					$data[$merchant] = [];
				}
				if( ! isset($data[$merchant][$status_key]) ){
					$data[$merchant][$status_key] = [];
				}
				$data[$merchant][$status_key][$profile] = $id->meta_value;
			}
		}
		return $data;
	}

		
function get_user_id_by_email($email){

		$user_id = false;
		if( $email > '' ){
			$user = get_user_by( 'email', $email );
			if (  is_object($user) && $user->ID > 0  ) {
				$user_id = $user->ID;
			}
		}
		return $user_id;
	}

		
function get_user_email_by_id($user_id){
		$user_info = get_userdata($user_id);
		return ( $user_info ) ? $user_info->user_email : false;
	}

		
function get_user_billing_meta($user_id){

		$billing = [];
		$user_meta = get_user_meta( $user_id );
		foreach ($user_meta as $key => $value) {
			if ( strpos($key, 'billing_') !== false ){
				$billing[$key] = $value[0];
			}
		}
		if( empty($billing['billing_email']) ){
			$billing['billing_email'] = $this->get_user_email_by_id($user_id);
		}

		return ! empty($billing) ? $billing : false;
	}

	
	
function build_customer_address( $user_id, $data, $include_contact = false ){

		$not_set = [];
		$fields = $this->get_address_fields();
		if( $include_contact ){
			$fields = wp_parse_args( $fields, $this->get_contact_fields() );
		}
		foreach ($fields as $field) {
			$key = $field['name'];
			if( ! isset($data[$key]) && $key !== 'billing_address_2' ){
				$not_set[] = $key;
			}
		}
		if( ! empty($not_set) ){
			$billing_meta = $this->get_user_billing_meta($user_id);
			foreach ($not_set as $key) {
				if( isset($billing_meta[$key]) ){
					$data[$key] = $billing_meta[$key];
					unset($not_set[$key]);
				}
			}
		}

		return $data;
	}

		
function updating_user_meta($user_id, $meta_key, $meta_value){

		if( ! ( isset($this->updated_meta[$user_id]) ) ){
			$this->updated_meta[$user_id] = [];
		}
		$this->updated_meta[$user_id][$meta_key] = $meta_value;

	}

	
function get_past_due_invoices( $user_id, $merchant ){
		$invoices = false;
		$pefix = wpal_ecomm()->functions()->get_prefix();
		$post_type = wpal_ecomm()->get_config('orders_slug');
		$args = [
			'post_type' 		=> $post_type,
			'posts_per_page' 	=> -1,
			'post_status'		=> 'publish',
			'orderby'			=> 'ID'
		];
		$order_args = [
			'meta_query' => [
				'relation' => 'AND',
				'order_status'	=> [
					'key'	=> "{$pefix}status",
					'value' => 'past_due'
				],
				'customer_user_id'	=> [
					'key'	=> "{$pefix}user_id",
					'value' => $user_id
				],
				'merchant'	=> [
					'key'	=> "{$pefix}merchant",
					'value' => $merchant
				]
			]
		];
		$query = new WP_Query( wp_parse_args($order_args, $args) );
		if( $query->have_posts() ){
			$invoices = [];
			$past_due_invoice_status = apply_filters('wpal/ecomm/invoice/past_due/status', 'open', $merchant);
			$inv_pefix = wpal_ecomm()->functions()->get_invoice_prefix();
			foreach ($query->posts as $order) {
				$subscription_name = $order->post_title;
				$invoice_args = [
					'post_parent'	=> $order->ID,
					'meta_key'		=> "{$inv_pefix}status",
					'meta_value'	=> $past_due_invoice_status
				];
				$invoice_query = new WP_Query( wp_parse_args($invoice_args, $args) );
				if( $invoice_query->have_posts() ){
					$order_meta = wpal_ecomm()->functions()->get_order_metadata($order->ID);
					foreach ($invoice_query->posts as $invoice) {
						$invoice_id = get_post_meta($invoice->ID, "{$inv_pefix}{$merchant}", true);
						if( $invoice_id ){
							$data = wpal_ecomm()->functions()->get_invoice_data( $invoice );
							$data['order_name'] = $order_meta['items'][0]['name'];
							$data['merchant_id'] = $invoice_id;
							$invoices[] = $data;
						}
					}
				}
			}
		}
		wp_reset_postdata();
		return $invoices;
	}

	
function has_purchased_product( $user_id, $product_id, $active = true ){

		if( empty($user_id) || empty($product_id) ){
			return false;
		}

		$product = is_array($product_id) ? $product_id : wpal_ecomm_products::get_product_config($product_id);
		$product_id = $product['id'];

		$pefix = wpal_ecomm()->functions()->get_prefix();
		$args = [
			'user_id'		=> $user_id,
			'product_id'	=> $product_id
		];
		if( $active ){
			$product_type = $product['product_type'];
			if( $product_type === 'subscription' ){
				$status = ['active', 'pending', 'processing', 'trial', 'past_due', 'unpaid'];
			}
			else{
				$status = ['completed', 'pending', 'processing', 'hold'];
			}
			$args['status'] = apply_filters("wpal/ecomm/purchased/product/{$product_type}/status", $status);
		}

		$orders = wpal_ecomm_orders::get_orders($args);
		return empty($orders) ? false : $orders;
	}

		
function shutdown(){
		if( is_array($this->updated_meta) && ! empty($this->updated_meta) ){
			foreach ($this->updated_meta as $user_id => $data) {
				if( is_array($data) && ! empty($data) ){
					$payment_details = $this->get_payment_details($user_id);
					if( $payment_details ){
						foreach ($payment_details as $profile_id => $details) {
							$merchant = isset($details['merchant']) ? $details['merchant'] : '';
							$customer_id = isset($details['customer_id']) ? $details['customer_id'] : '';
							if( $merchant > '' && $profile_id > '' && $customer_id > '' ){
								$merchant_class = wpal_ecomm()->get_merchant($merchant);
								$merchant_functions = $merchant_class->functions();
																$data = $this->build_customer_address($user_id,$data);
								$data['profile_id'] = $profile_id;
								$data['customer_id'] = $customer_id;
				                $payment_method_id = ( !empty($data['payment_method_id']) ) ? $data['payment_method_id'] : false;
				                $billing_email = ( !empty($data['billing_email']) ) ? $data['billing_email'] : false;
				                if( $payment_method_id ){
				                  $data['current_payment_method_id'] = $data['payment_method_id'];
				                }
				                else{
				                  if( $billing_email && !empty($details['payment_method_id']) ){
				                    $data['current_payment_method_id'] = $details['payment_method_id'];
				                  }
				                }
								add_filter("wpal/ecomm/account/billing/updated/{$merchant}", [$merchant_functions, 'account_billing_updated'], 10, 2);
								$response = apply_filters("wpal/ecomm/account/billing/updated/{$merchant}", $data, $user_id);
								if( $response && is_wp_error($response) ){
									if ( WPAL_ECOMM_DEBUG ){
										wpal_ecomm_debug::log( __FILE__, __FUNCTION__, __LINE__, 'Error : ' . $response->get_error_message() );
									}
								}
							}
						}
					}
				}
			}
		}
	}

	
function validate_order_password($data){

		$error = false;
		$customer = isset($data['contact']) ? $data['contact'] : [];
		$password = false;
		$min = (int)wpal_ecomm()->get_config('min_password_length');
		if( isset($customer['new_account_password']) ){
			$password = $customer['new_account_password'];
			$password = ( $password > '' ) ? $password : false;
			if($password){
				$password_length = strlen($password);
				if ( preg_match('/\s/',$password) || $password_length < $min ){
					$error = 'password_length';
				}
								else {
					$user_email = isset($customer['billing_email']) ? strtolower($customer['billing_email']) : false;
					if( $user_email ){
						$check_user = get_user_by('email', $user_email);
						if ($check_user) {
							$match = wp_check_password($password, $check_user->data->user_pass, $check_user->ID);
							if (! $match) {
								$error = 'existing';
							}
						}
					}
				}
			}
			else{
				$error = 'password_length';
			}
		}
		else {
			$error = 'password_length';
		}

		if($error){
			if($error === 'password_length'){
				return sprintf(_x('Your password must be at least %d characters long with no spaces.', 'wpal/ecomm/new/password', 'wpal_ecomm'), $min);
			}
			else if($error === 'existing'){
				$msg = 'There is an existing account using email %s but entered password does not match.<br/>';
				$msg .= 'Please Log into your account or enter your existing password to complete your order.';
				return sprintf(_x($msg, 'wpal/ecomm/new/password', 'wpal_ecomm'), $user_email);
			}
		}
		else{
			return false;
		}

	}

		
function disable_email_change_email( $send, $user, $user_data ){
		return false;
	}

		private 
function __construct(){
		register_shutdown_function([$this, "shutdown"]);
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
