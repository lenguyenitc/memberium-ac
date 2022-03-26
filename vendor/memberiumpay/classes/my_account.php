<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}



class wpal_ecomm_my_account {

		private $current_page = false;
		private $order_number = false;

		static 
function my_account_process(){

		        

		$success = false;
		$data    = false;
		$notice  = [
			'id'		=> 'wpal-ecomm-error',
			'title' 	=> __('Error', 'wpal_ecomm'),
			'content'	=> __('There has been an error', 'wpal_ecomm'),
		];

		$update = isset($_POST['update']) ? $_POST['update'] : false;
		$user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
		$details = isset($_POST['details']) ? $_POST['details'] : '';

		if( $update && $user_id > 0 && $details > '' ){
			$details   = json_decode(stripslashes($details), true);
			$updates   = ['contact', 'billing', 'merchant', 'subscription'];
						$results   = apply_filters("wpal/ecomm/account/update/{$update}/process", false, $user_id, $details);
						if( ! $results ){
				if( in_array($update, $updates) ){
					add_filter("wpal/ecomm/account/update/{$update}", [self::get_instance(), "update_{$update}_details"], 10, 3);
				}
				$results = apply_filters("wpal/ecomm/account/update/{$update}", [], $user_id, $details);
			}

			$success = ( isset($results['success']) ) ? $results['success'] : false;
            if(isset($results['message'])){
                $notice['content'] = $results['message'];
            }
            $data = ( isset($results['data']) ) ? $results['data'] : false;
		}

		if( $success ){
			$notice['id'] = 'wpal-ecomm-success';
			$notice['title'] = __('Success');
			wp_send_json_success( [
				'data'		=> $data,
				'notice'	=> $notice,
			] );
		}
		else {
			wp_send_json_error( [
				'data'		=> $data,
				'notice'	=> $notice,
			] );
		}
	}

	
	public 
function my_account_func( $args ){

				$html = '';
		$ns = 'wpal_ecomm';
		$frontend = wpal_ecomm()->frontend;

				$user = wp_get_current_user();
		$user_id = (is_object($user) && get_class($user) == 'WP_User') ? $user->ID : 0;

		$atts = shortcode_atts( [
			'classname' 	=> '',
			'template'		=> 'my-account.php',
			'theme'			=> '',
			'color__main'	=> '',
			'color__accent'	=> ''
		], $args );

		$className = esc_attr($atts['classname']);
		$className .= ( $className > '' ) ? ' ' : '';
		$template = esc_attr($atts['template']);
		$theme_dir = esc_attr($atts['theme']);
		$color__main = esc_attr($atts['color__main']);
		$color__accent = esc_attr($atts['color__accent']);

		if( $user_id < 1 ){
			$include = $frontend->template_part_path( 'login.php', $theme_dir );
			if( $include ){
				$html .= "<div class=\"{$className}wpal-ecomm-account logged-out\">";
					include $include;
				$html .= "</div>";
			}
			return $html;
		}

		$include = $frontend->template_part_path( $template, $theme_dir );
		if( $include ){

						$customer = wpal_ecomm()->customer();
			$contact = $this->get_contact_fields( $user_id, 'contact' );
			$billing = $this->get_contact_fields( $user_id, 'billing' );

						$order_data = $customer->get_orders($user_id);

						$details_data = [];
			$payment_details = $customer->get_payment_details($user_id);
			$requires_payment_info = false;
			if( $payment_details ){
				foreach ($payment_details as $profile_id => $details) {
					$merchant_class = wpal_ecomm()->get_merchant($details['merchant']);
					$profile = wpal_ecomm()->settings->get_merchant_profile($profile_id);
					$sandbox = ( (int)$profile['sandbox'] > 0 );
					$index = ( $sandbox ) ? 'sandbox' : 'details';
					$config = false;
					if( !empty($details[$index]) ){
						$config = $details[$index];
						$config['merchant'] = $details['merchant'];
						$config['profile_id'] = $profile_id;
						$customer_id = $config['customer_id'];
						$config['config'] = $merchant_class->my_account_config($profile, $customer_id, $user_id, 'my_account');
						$details_data[$profile_id] = $config;
						if( !empty($config['card']) ){
							$requires_payment_info = true;
						}
					}
				}
			}

			$payment_info = ( $requires_payment_info ) ? $customer->get_payment_fields($user_id) : [];

						$menu = $frontend->get_account_pages();
			add_filter('wpal/ecomm/account/I18n', function( $I18n, $user_id ) use( $menu ) {
				$I18n['titles'] = wp_parse_args( $menu, $I18n['titles'] );
				return $I18n;
			}, 10, 2 );

			$view = $this->get_current_account_page();
			$view_filters = [
				'billing'        => [ 'init' => [ 'loadMerchants', 'initMerchants' ], 'render' => ['ManageCountryRegionSelectors'] ],
		        'update_billing' => [ 'init' => [ 'loadMerchants', 'initMerchants' ], 'render' => ['ManageCountryRegionSelectors'] ],
		        'contact'        => [ 'init' => [ 'loadMerchants' ] ]
			];

			$active_class = 'wpal-ecomm-active';
			$base_url     = get_permalink(get_the_ID());
			$log_out_url  = wp_logout_url($base_url);
			$my_account   = [
				'order_id'				=> isset($_GET['order']) ? (int)$_GET['order'] : 0,
				'menu'					=> $menu,
				'fields'				=> [
					'contact'		=> $contact,
					'payment_info'	=> $payment_info,
					'billing'		=> $billing,
				],
				'script'				=> WPAL_ECOMM_URL . 'assets/my-account.js?v='.WPAL_ECOMM_VERSION,
				'I18n'					=> $this->I18n_translations($user_id),
				'tmpls'					=> $this->get_templates($user_id, 'my_account'),
				'theme'					=> $theme_dir,
				'orders'				=> $order_data,
				'subscriptions_table'	=> $this->subscriptions_table( $order_data ),
				'orders_table'			=> $this->orders_table( $order_data ),
				'items_table'			=> $this->order_items_table(),
				'payment_info'			=> $details_data,
				'base_url'				=> $base_url,
				'view'					=> $view,
				'view_filters'			=> apply_filters('wpal/ecomm/account/view/filters', $view_filters),
				'order'					=> $this->order_number,
				'active_class'			=> $active_class
			];
			$my_account = apply_filters('wpal/ecomm/my/account/render/data', $my_account, $user_id );
			$frontend->set_to_json('my_account',$my_account);

			include $include;
		}

		return $html;

	}

		
function I18n_translations( $user_id ){

		return apply_filters( 'wpal/ecomm/account/I18n', [
            'titles'	=> [
				'my_account'				=> __('My Account', 'wpal_ecomm'),
				'password_change'			=> __('Password change', 'wpal_ecomm'),
				'order_details'				=> __('Order Details', 'wpal_ecomm'),
				'order_items'				=> __('Order Items', 'wpal_ecomm'),
				'order_totals'				=> __('Order Totals', 'wpal_ecomm'),
				'billing_address'			=> __('Billing Address', 'wpal_ecomm'),
				'order_status'				=> __('Order Status', 'wpal_ecomm'),
				'order_created'				=> __('Date Created', 'wpal_ecomm'),
				'payment_method'			=> __('Payment Method', 'wpal_ecomm'),
				'payment_info'				=> __('Payment Info', 'wpal_ecomm'),
				'update_button'				=> __('Update', 'wpal_ecomm'),
				'no_change_title'			=> __('No Changes Made', 'wpal_ecomm'),
				'no_change_content'			=> __('No changes detected to your saved details.', 'wpal_ecomm'),
				'new_password'				=> __('New Password', 'wpal_ecomm'),
				'password_repeat'			=> __('Confirm new password', 'wpal_ecomm'),
				'update_card'				=> __('Update Card', 'wpal_ecomm'),
				'credit_card'				=> __('Credit card', 'wpal_ecomm'),
				'new_card'					=> __('Add New Credit Card', 'wpal_ecomm'),
				'update_billing'			=> __('Confirm Billing Details', 'wpal_ecomm'),
				'subscription_details'		=> __('Subscription Details', 'wpal_ecomm'),
				'subscription_status'		=> __('Status', 'wpal_ecomm'),
				'subscription_items'		=> __('Subscription Items','wpal_ecomm'),
				'subscription_totals'		=> __('Subscription Totals','wpal_ecomm'),
				'subscription_actions'		=> __('Actions','wpal_ecomm'),
				'next_bill_date'			=> __('Next Bill Date','wpal_ecomm'),
				'next_bill_amount'			=> __('Next Bill Amount','wpal_ecomm'),
				'cancel_button'				=> __('Cancel Subscription','wpal_ecomm'),
				'cancel_confirm'			=> __('Confirm Cancellation','wpal_ecomm'),
				'cancel_reason_label'		=> __('Reason for Cancellation', 'wpal_ecomm'),
				'cancel_reason_placeholder'	=> __('Please enter your reason for cancellation.', 'wpal_ecomm'),
				'canceled_date'				=> __('Date Canceled','wpal_ecomm'),
				'end_date'					=> __('Date Ending', 'wpal_ecomm')
			],
			'errors'	=> [
				'order_not_found'			=> __('No order with #%s found.', 'wpal_ecomm'),
				'subscription_not_found'	=> __('No subscription with #%s found.', 'wpal_ecomm'),
				'no_orders'					=> __('You have no current orders', 'wpal_ecomm'),
				'no_subscriptions'			=> __('You have no current subscriptions.', 'wpal_ecomm'),
				'no_saved_methods'			=> __('No saved payment methods.', 'wpal_ecomm'),
				'not_applicable'			=> __('n/a', 'wpal_ecomm'),
			],
			'loading'	=> [
				'updating'	=> __('Updating details', 'wpal_ecomm'),
				'loading'	=> __('Loading Please Wait', 'wpal_ecomm')
			],
			'sprintf'	=> [
				'not_found_wrap'	=> __('<div class="wpal-ecomm-not-found %s">%s</div>','wpal_ecomm' ),
				'confirm_billing'	=> __('Please confirm your billing details : <br/><ul class="billing-details">%s</ul>','wpal_ecomm'),
				'confirm_cancel'	=> __('Are you sure you would like to cancel your subscription to %s?','wpal_ecomm'),
				'label_value'		=> __('<span class="wpal-ecomm-label">%s</span><span class="wpal-ecomm-value">%s</span>','wpal_ecomm'),
				'payment_method'	=> __('%s **** %s', 'wpal_ecomm')
			],
			'totals'	=> wpal_ecomm()->functions()->totalsI18n( "account/{$user_id}")
		], $user_id);

	}

		
function get_templates( $user_id, $form_id ){

		return apply_filters( 'wpal/ecomm/account/tmpls', [
			'modal'					=> 'modal.php',
			'loading'				=> 'loading.php',
			'table'					=> 'table.php',
			'contact_fields'		=> 'contact-fields.php',
			'billing_fields'		=> 'billing-fields.php',
			'billing_details'		=> 'billing-details.php',
			'fieldset'				=> 'fieldset.php',
			'payment_info'			=> 'account-payment-info.php',
			'account_order'			=> 'account-order.php',
			'account_subscription'	=> 'account-subscription.php',
			'order_totals'			=> 'order-totals.php',
			'account_password'		=> 'passwords.php'
		], $user_id, $form_id );

	}

	
function subscriptions_table( $orders ){

		$table = false;
		$subscriptions = ( isset($orders['subscription']) ) ? $orders['subscription'] : false;
		if( $subscriptions ){
			$view = __('View', 'wpal_ecomm');
			$rows = [];
			foreach ($subscriptions as $order_id => $order) {
				if( ! empty($order['invoices']) ){
					$rows[] = [
						'id'		=> $order_id,
						'name'		=> $order['subscription/name'],
						'status'	=> $order['status'],
						'next'		=> $order['next_bill_date'],
						'total'		=> $order['next_bill_amount'],
						'actions'	=> "<button data-subscription-id=\"{$order_id}\" class=\"view-subscriptions\">{$view}</button>"
					];
				}
			}

			$table = [
				'attrs'		=> $this->table_attrs('subscriptions'),
				'columns'	=> [
					'name'		=> __('Name','wpal_ecomm'),
					'status'	=> __('Status','wpal_ecomm'),
					'next'		=> __('Next Bill Date','wpal_ecomm'),
					'total'		=> __('Total','wpal_ecomm'),
					'actions'	=> ''
				],
								'rows'		=> $rows,
				'I18n'		=> [
					'item'			=> __('Subscription','wpal_ecomm'),
					'items'			=> __('Subscriptions','wpal_ecomm'),
					'no_results'	=> __('No subscriptions found','wpal_ecomm'),
				]
			];
		}
		return $table;
	}

	
function orders_table( $orders ){

		$table = false;
		$singles = ( isset($orders['single']) ) ? $orders['single'] : false;
		if( $singles ){
			$functions = wpal_ecomm()->functions();
			$view = __('View', 'wpal_ecomm');
			$rows = [];
			foreach ($singles as $order_id => $order) {
				$rows[] = [
					'id'		=> $order_id,
					'name'		=> "#{$order_id}",
					'status'	=> $order['status'],
					'total'		=> $functions->price_display($order['total'],$order_id),
					'actions'	=> "<button data-order-id=\"{$order_id}\" class=\"view-order\">{$view}</button>"
				];
			}

			$table = [
				'attrs'		=> $this->table_attrs('orders'),
				'columns'	=> [
					'name'		=> __('Name','wpal_ecomm'),
					'status'	=> __('Status','wpal_ecomm'),
					'total'		=> __('Total','wpal_ecomm'),
					'actions'	=> ''
				],
								'rows'		=> $rows,
				'I18n'		=> [
					'item'			=> __('Order','wpal_ecomm'),
					'items'			=> __('Orders','wpal_ecomm'),
					'no_results'	=> __('No orders found','wpal_ecomm'),
				]
			];
		}
		return $table;
	}

	
function order_items_table(){
		return [
			'attrs'		=> $this->table_attrs('order-items'),
			'columns'		=>	[
				'name'			=> __('Name', 'wpal_ecomm'),
                'cost_display'	=> __('Cost', 'wpal_ecomm'),
				'qty'			=> __('Qty', 'wpal_ecomm'),
				'total_display'	=> __('Total', 'wpal_ecomm'),
            ],
			'I18n'		=> [
				'item'			=> __('Order Item','wpal_ecomm'),
				'items'			=> __('Order Items','wpal_ecomm'),
				'no_results'	=> __('No order items found','wpal_ecomm'),
			]
		];
	}

	
function table_attrs( $classname = '' ){
		$classname = ( $classname > '' ) ? " {$classname}" : "";
		return [
			[
				'prop'	=> "class",
				'value'	=> "wpal-ecomm-table{$classname}"
			]
		];
	}

		
function update_merchant_details( $return = [], $user_id, $data ){

		$return = [
			'success' => true,
			'message' => '',
			'data'	  => ''
		];

		$merchant = $data['merchant'];
		$merchant_class = wpal_ecomm()->get_merchant($merchant);
		$profile = wpal_ecomm()->settings->get_merchant_profile($data['profile_id']);
		if( $profile ){
			$config = $merchant_class->my_account_config($profile, $data['customer_id'], $user_id, __FUNCTION__);
			if( $config['error'] ){
				$return['success'] = false;
				$return['message'] = $config['error'];
			}
			else {
				$return['data'] = $config;
			}
		}
		else {
			$return['success'] = false;
			$return['message'] = __('Merchant Profile Not Found', 'wpal_ecomm');
					}

		return $return;
	}

		
function update_subscription_details( $return = [], $user_id, $data ){

		$return = [
			'success' => false,
			'message' => '',
			'data'	  => ''
		];
		$operation = ( isset($data['operation']) ) ? $data['operation'] : false;
		$order_id = ( !empty($data['order_id']) ) ? $data['order_id'] : false;
		if( ! $operation ){
			$return['message'] = __('No update operation defined', 'wpal_ecomm');
		}
		else if ( $operation === 'cancel' ){
			$profile_id = wpal_ecomm()->functions()->get_order_profile_id($order_id);
			$paymentDetails = wpal_ecomm()->customer()->get_merchant_profile_payment_details($user_id, $profile_id);
			if( $paymentDetails ){
				$merchant = $paymentDetails['merchant'];
				$merchant_class = wpal_ecomm()->get_merchant($merchant);
				$functions = $merchant_class->functions();
				$profile = wpal_ecomm()->settings->get_merchant_profile($profile_id);
				if( $profile ){
					$data['profile_id'] = $profile_id;
					add_filter("wpal/ecomm/account/subscription/cancel/{$merchant}", [$functions, 'cancel_subscription'], 10, 2);
					$response = apply_filters("wpal/ecomm/account/subscription/cancel/{$merchant}", $data, $user_id);
					if( is_wp_error($response) ){
						$message = $response->get_error_message();
						if( empty($message) ){
							$message = __('There has been an issue cancelling your Subscription. Please refresh the page and try again or contact support.','wpal_ecomm');
						}
						$return['message'] = $message;
					}
					else{
						$order_id = ( isset($data['order_id']) ) ? $data['order_id'] : false;
						$return['success'] = $response['success'];
						$return['message'] = $response['message'];
						do_action( "wpal/ecomm/subscription/cancel/requested", $order_id, $profile_id);
					}
				}
				else{
					$return['message'] = __('No connected profile', 'wpal_ecomm');
				}
			}
			else{
				$return['message'] = __('No payment details', 'wpal_ecomm');
			}
		}

		return $return;
	}

	
function update_contact_details( $return = [], $user_id, $data ){

		$existing_fields    = $this->get_contact_fields( $user_id, 'contact' );
		$existing_fields    = wp_list_pluck($existing_fields, 'value', 'name');
		$contact            = wpal_ecomm()->functions()->prefixed_array($data, 'billing_');
		$data['difference'] = array_diff($contact, $existing_fields);

				$response = false;
		if( isset($data['merchants']) ){
			$merchants = $data['merchants'];
			unset($data['merchants']);
			foreach ($merchants as $profile_id => $merchant_config) {
				$merchant = $merchant_config['merchant'];
				$merchant_class = wpal_ecomm()->get_merchant($merchant);
				$merchant_functions = $merchant_class->functions();
				$merchant_data = wp_parse_args($merchant_config, $data);
				add_filter("wpal/ecomm/account/contact/updated/{$merchant}", [$merchant_functions, 'account_contact_updated'], 10, 2);
				$response = apply_filters("wpal/ecomm/account/contact/updated/{$merchant}", $merchant_data, $user_id);
								$payment_method_error = ( is_wp_error($response['pm_response']) ) ? $response['pm_response']->get_error_message() : false;
				$customer_error = ( is_wp_error($response['customer_response']) ) ? $response['customer_response']->get_error_message() : false;
			}
		}

		$customer = wpal_ecomm()->customer();
		$customer->update_user_details( $user_id, $contact, 'my_account_contact');
		$fields = $this->get_contact_fields( $user_id, 'contact' );

		return [
			'success' => true,
			'message' => __('Your contact details have been updated.', 'wpal_ecomm'),
			'data'	  => wp_list_pluck($fields, 'value', 'name')
		];
	}

	
function update_billing_details( $return = [], $user_id, $data ){

				wpal_ecomm()->set_doing_remote_update(true);

		$return = [
			'success' => true,
			'message' => __('Your billing details have been updated.', 'wpal_ecomm'),
			'data'	  => false
		];

				$response = false;
		if( isset($data['merchants']) ){
			$merchants = $data['merchants'];
			unset($data['merchants']);
			foreach ($merchants as $profile_id => $merchant_config) {
				$merchant = $merchant_config['merchant'];
				$merchant_class = wpal_ecomm()->get_merchant($merchant);
				$merchant_functions = $merchant_class->functions();
				$merchant_data = wp_parse_args($merchant_config, $data);
				add_filter("wpal/ecomm/account/billing/updated/{$merchant}", [$merchant_functions, 'account_billing_updated'], 10, 2);
				$response = apply_filters("wpal/ecomm/account/billing/updated/{$merchant}", $merchant_data, $user_id);
			}
		}

		if( $response && is_wp_error($response) ){
			$return['success'] = false;
			$return['message'] = $response->get_error_message();
			return $return;
		}

		$customer = wpal_ecomm()->customer();
		$country = '';
		$country_code = '';
		if( isset($data['billing_country_code']) ){
			$country = $data['billing_country'];
			$country_code = $data['billing_country_code'];
			$data['billing_country'] = $country_code;
			unset($data['billing_country_code']);
		}
		$state = '';
		$state_code = '';
		if( isset($data['billing_state_code']) ){
			$state = $data['billing_state'];
			$state_code = $data['billing_state_code'];
			$data['billing_state'] = $state_code;
			unset($data['billing_state_code']);
		}

		$billing = wpal_ecomm()->functions()->prefixed_array($data,'billing_');
		$name_on_card = ( isset($data['name_on_card']) ) ? $data['name_on_card'] : '';
		$billing[$customer::NAME_ON_CARD] = $name_on_card;

		$customer->update_user_details($user_id, $billing, 'my_account_billing');
		$fields = $this->get_contact_fields( $user_id, 'billing' );
		$fields = wp_list_pluck($fields, 'value', 'name');
		$fields['billing_country_code'] = $country_code;
		$fields['billing_country'] = $country;
		$fields['billing_state_code'] = $state_code;
		$fields['billing_state'] = $state;

		$return['data']['billing'] = $fields;
		$return['data']['payment_info'] = $customer->get_payment_fields($user_id);
		return $return;
	}

	
function get_contact_fields( $user_id, $type ){

		$customer = wpal_ecomm()->customer();
		if( $type === 'contact' ){
			$fields = $customer->get_contact_fields();
		}
		else if( $type === 'billing' ){
			$fields = $customer->get_address_fields();
		}
		add_filter("wpal/ecomm/account/{$type}/fields", [$customer, 'populate_account_fields'], 100, 3);

		return apply_filters("wpal/ecomm/account/{$type}/fields", $fields, $user_id, 0);
	}

	
function get_current_account_page(){

		if( ! $this->current_page ){
			global $wp_query;
			$account_pages = wpal_ecomm()->frontend->get_account_pages();
			if( is_array($account_pages) ){
				$this->current_page = array_keys($account_pages)[0];
				foreach ($account_pages as $slug => $label) {
					if( isset( $wp_query->query_vars[$slug] ) ){
						$this->current_page = $slug;
						if( $slug === 'orders' || $slug === 'subscriptions' ){
							$this->order_number = $wp_query->query_vars[$slug];
						}
						break;
					}
				}
			}
		}

		return ( $this->current_page > '' ) ? $this->current_page : 'contact';
	}

		static $instance = null;
	public static 
function get_instance() {
		if ( is_null( self::$instance ) ) {
            self::$instance = new self;
        }
        return self::$instance;
	}

}
