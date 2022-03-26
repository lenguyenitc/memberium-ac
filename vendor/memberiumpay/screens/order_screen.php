<?php
/**
 * Copyright (C) 2017-2019 David Bullock
 * Web Power and Light, LLC
 */



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}


class wpal_ecomm_order_screen {

	static $instance = null;

		private $tabs  = [];
	private $settings = [];
	private $active_tab = 'details';
	private $items_data_name = 'wpal_ecomm_order_items';
	private $subscriptions_data_name = 'wpal_ecomm_subscription_billing';
	private $totals_data_name = 'wpal_ecomm_order_totals';
	private $logs_data_name = 'wpal_ecomm_order_logs';

        private $post_type;
	private $post_id;

		private $metadata = [];
	private $order_items = [];
	private $order_log = [];

		private $currency;
	private $currency_symbol;

		private $order_form_id;
	private $customer_id;
	private $billing = [];
	private $date_created;
	private $status;
	private $is_subscription = false;

		private $merchant_class = null;

	    
function init($post_type){

				global $post;
		$this->post_type = $post_type;
		$this->post_id = ( is_object($post) && isset($post->ID) ) ? $post->ID : false;
		$post_id = $this->post_id;
		$this->hooks();

				if( ! $this->is_new_order() ){
			$functions = wpal_ecomm()->functions();
			$this->metadata = $functions->get_order_metadata($this->post_id);
			$this->order_items = ( isset($this->metadata['items']) ) ? $this->metadata['items'] : [];
			$currency = $functions->get_order_currency($this->post_id, false);
			if( $currency ){
				$this->currency = $currency['code'];
				$this->currency_symbol = $currency['symbol'];
			}
			$logs = wpal_ecomm_order_logs::get_instance();
			$this->order_log = $logs->get_order_log($this->post_id);
			$type = ( isset($this->metadata['type']) ) ? $this->metadata['type'] : 'single';
			$this->is_subscription = ( $type === 'subscription' );
						if( ! isset($this->metadata['merchant']) ){
				$merchant = $this->metadata['processor'];
			}
			else{
				$merchant = $this->metadata['merchant'];
			}

			$this->merchant_class = wpal_ecomm()->get_merchant($merchant);
		}

				$this->active_tab = ( isset($_GET['tab']) ) ? $_GET['tab'] : $this->active_tab;
        $this->tabs = $this->get_tabs();
        $this->settings = $this->get_settings($post_id, $this->metadata);
        $this->show();
        $this->to_json();
    }

		
function hooks(){
		add_filter( "wpal/ecomm/order/billing/contact/fields", function($fields, $form_id){
			$i = array_search('billing_email', array_column($fields, 'name'));
		 	$fields[$i]['priority'] = 399;
			return $fields;
		}, 10, 2 );
	}

	    
function get_tabs(){

        $ns = 'wpal_ecomm';

        $tabs = [
            [
                'slug'	=> 'details',
                'label'	=> __( 'Details', $ns ),
                'icon'	=> 'dashicons dashicons-format-aside',
            ]
        ];

        return apply_filters( "wpal/ecomm/screen/{$this->post_type}/tabs", $tabs );

    }

	    
function get_settings( $post_id, $metadata ){

        $ns = 'wpal_ecomm';

        $settings = [];

                $tab  = 'details';

                $section = "{$tab}-order-section";

		$order_description = '';
				if( ! $this->is_new_order() ){
			$order_description = $this->order_description( $post_id, $metadata );
		}

        $settings[] = [
            'slug'	=> $section,
			'title'	=> __('Order Details',$ns),
			'desc'	=> $order_description,
            'type'	=> 'section',
            'tab'	=> $tab
        ];
		$settings[] = [
			'slug'			=> 'date_created',
			'title'			=> __('Date Created', $ns),
			'type'			=> 'datetime',
			'default'		=> time(),
			'tab' 			=> $tab,
			'section'		=> $section,
		];

		$order_status = isset($metadata['status']) ? $metadata['status'] : 'processing';
		$title = ( $this->is_subscription ) ? __('Subscription Status', $ns) : __('Order Status', $ns);

		$settings[] = [
			'slug'		=> 'order_status_display',
			'title'		=> $title,
			'type'		=> 'readonly',
			'tab' 		=> $tab,
			'section'	=> $section,
			'default'	=> wpal_ecomm()->functions()->get_order_status_text($metadata),
			'ui_only'	=> 1,
			'callback'	=> 'wpal_ecomm_status_render'
		];

		$settings[] = [
			'slug'		=> 'status',
						'type'		=> 'hidden',
						'default'	=> 'pending',
									'tab' 		=> $tab,
			'section'	=> $section,
								];

		        $section = "{$tab}-customer-section";
        $settings[] = [
            'slug'	=> $section,
			'title'	=> __('Customer Details',$ns),
			'desc'	=> $this->customer_links($post_id, $metadata),
            'type'	=> 'section',
            'tab'	=> $tab
        ];

		$customer_name_email = $this->is_new_order() ? '' : $this->customer_name_email( $post_id, $metadata );
		$settings[] = [
			'slug'		=> 'user_details',
			'title'		=> __('Customer', $ns),
			'type'		=> 'readonly',
			'tab' 		=> $tab,
			'section'	=> $section,
			'default'	=> $customer_name_email,
			'ui_only'	=> 1
		];
		$defalut_payment_details = '';
		if($metadata['merchant'] === 'paypal'){
			$defalut_payment_details = 'Paypal';
		}
		$settings[] = [
			'slug'		=> 'payment_details',
			'title'		=> __('Payment Details', $ns),
			'type'		=> 'readonly',
			'default'	=> $defalut_payment_details,
									'tab' 		=> $tab,
			'section'	=> $section,
					];

		$settings[] = [
			'slug'		=> 'user_id',
			'type'		=> 'hidden',
			'tab' 		=> $tab,
			'section'	=> $section,
											];

		$consents = wpal_ecomm()->functions()->prefixed_array($metadata, 'consent/');
		if( !empty($consents) ){
			$form_id = !empty($metadata['order_form_id']) ? $metadata['order_form_id'] : '';
			$consent_fields = wpal_ecomm()->customer()->get_consent_fields($form_id);
			$consent_labels = wp_list_pluck($consent_fields, 'label', 'name');
			foreach ( $consents as $consent => $checked ) {
				$consent = str_replace("consent/", "", $consent);
				$settings[] = [
					'slug'		=> $consent,
					'title'		=> !empty($consent_labels[$consent]) ? $consent_labels[$consent] : ucfirst($consent),
					'type'		=> 'switch',
					'default'	=> 1,
					'disabled'	=> 1,
					'tab' 		=> $tab,
					'section'	=> $section,
				];
			}

		}

		        $section = "{$tab}-customer-billing-section";
        $settings[] = [
			'tab'		=> $tab,
            'slug'		=> $section,
			'title'		=> __('Billing Details',$ns),
            'type'		=> 'section',
			'callback'	=> 'wpal_ecomm_billing_details',
        ];

				$settings = $this->customer_details($settings, $tab, 'billing');

		$settings[] = [
			'type'		=> 'display',
			'title'		=> __('Billing address', $ns),
			'tmpl'		=> [
				'slug'	=> 'billing_address',
				'name'	=> 'billing_address',
				'path'	=> WPAL_ECOMM_TMPL_DIR . 'billing-details.php',
				'wrap'	=> true
			],
			'tab' 		=> $tab,
			'section'	=> $section,
		];

				
		if( $this->is_subscription ){

			
				        $section = "{$tab}-subscription-billing-section";
	        $settings[] = [
	            'slug'	=> $section,
	            'type'	=> 'section',
				'title'	=> __('Subscription Billing',$ns),
	            'tab'	=> $tab
	        ];

						$settings[] = [
				'slug'		=> 'subscription_billing',
				'type'    	=> 'table',
				'data'		=> $this->order_subscription_billing_table($post_id, $metadata),
				'tab' 		=> $tab,
				'section'	=> $section,
				'ui_only'	=> 1
			];

		}
		else {

				        $section = "{$tab}-items-section";
	        $settings[] = [
	            'slug'	=> $section,
	            'type'	=> 'section',
				'title'	=> __('Order Items',$ns),
	            'tab'	=> $tab
	        ];

						$settings[] = [
				'slug'		=> 'order_items',
				'type'    	=> 'table',
				'data'		=> $this->order_items_table($post_id),
				'tab' 		=> $tab,
				'section'	=> $section,
				'ui_only'	=> 1
			];

						$settings[] = [
				'slug'		=> 'order_totals',
				'type'    	=> 'table',
				'data'		=> $this->order_totals_table($post_id, $metadata),
				'tab' 		=> $tab,
				'section'	=> $section,
				'ui_only'	=> 1
			];

		}

		        $section = "{$tab}-log-section";
        $settings[] = [
            'slug'	=> $section,
            'type'	=> 'section',
			'title'	=> __('Order Logs',$ns),
            'tab'	=> $tab
        ];

		$settings[] = [
			'slug'		=> 'order_logs',
			'type'    	=> 'table',
			'data'		=> $this->order_logs_table($post_id),
			'tab' 		=> $tab,
			'section'	=> $section,
			'ui_only'	=> 1
		];

        return apply_filters( "wpal/ecomm/screen/{$this->post_type}/settings", $settings );

    }

	    
function show(){

		$ns = 'wpal_ecomm';
		$functions = wpal_ecomm_order_functions::get_instance();

                echo '<fieldset class="wpat-admin-form wpat-post-type" data-screen="'.$this->post_type.'">';

			echo '<header class="wpat-admin-form-header">';
				echo '<h2>'.$functions->get_order_name($this->post_id).'</h2>';
			echo '</header>';

			            echo '<div id="order-config-table" class="wpat_admin_table wpat_tabbed_table">';
                echo '<div class="wpat_option_tabs"></div>';
        		echo '<div class="wpat_option_panels">';

				echo '</div>';
            echo '</div>';
			wp_nonce_field("{$ns}_order_action", "{$ns}_order_nonce_field");
        echo '</fieldset>';

    }

	
    
function to_json(){
		global $pagenow;
        $templater = wp_admin_templater::get_instance();
        $templater->to_json('tab', $this->active_tab);
		$settings = wp_admin_templater_data::setting_values($this->settings, $this->metadata);
		$templater->to_json('settings', $settings);
        $templater->to_json('tabs', $this->tabs);
		$templater->to_json('order_currency', $this->currency_symbol);
		$templater->to_json('country_region_data', wpal_ecomm_data::get_country_region_data());
		$templater->to_json('meta_data', $this->metadata);
		$order_status = (isset($this->metadata['status'])) ? $this->metadata['status'] : 'processing';
		$templater->to_json('status', $order_status);
		$templater->to_json('order_type', ( $this->is_subscription ) ? 'subscription' : 'order' );
		$templater->set_I18n('cancel', __('Cancel'));
		$templater->set_I18n('cancel_now', __('Cancel Now'));
		$templater->set_I18n('cancel_confirm', __('Are you sure you want to cancel this order?'));
		$sandbox = ( isset($metadata['sandbox']) ) ? (int)$metadata['sandbox'] : 0;
		$templater->to_json('sandbox', $sandbox);
		$templater->to_json('new_order', ( $pagenow === 'post-new.php' ) ? 1 : 0 );
		$cancelled = wpal_ecomm()->functions()->formated_order_date($this->metadata, 'canceled/date');
		$period_end = wpal_ecomm()->functions()->formated_order_date($this->metadata, 'current/period/end');
		$can_cancel = (  $cancelled > '' && $period_end > '' ) ? 0 : 1;
		$can_cancel = in_array($order_status, ['cancel-pending', 'past_due', 'trial']) ? 1 : $can_cancel;
		$templater->to_json('can_cancel', $can_cancel);
		if( $can_cancel ){
			$templater->to_json('dialog', 1);
			$templater->to_json('cancel_dialog', $this->cancel_dialog_settings($period_end, $order_status));
		}
    }

	
	
function customer_details( $settings, $tab, $type ){

		$section = "{$tab}-customer-{$type}-section";
		$order_form_id = $this->order_form_id;

		$settings = ( is_array($settings) ) ? $settings : [];
		$type = ( $type === 'billing' ) ? $type : 'shipping';

				$customer = wpal_ecomm()->customer();
		$fields = $customer->get_contact_fields( $type );
		$fields = apply_filters("wpal/ecomm/order/{$type}/contact/fields", $fields, $order_form_id);

		foreach ($fields as $field) {
			$type = ( isset($field['type']) ) ? $field['type'] : 'input';
						$value = ( isset($fields['value']) ) ? $fields['value'] : '';
			$settings[] = [
				'slug'			=> $field['name'],
				'title'			=> $field['label'],
				'type'			=> $type,
				'default'		=> '',
				'tab' 			=> $tab,
				'section'		=> $section,
				'value'			=> $value,
				'priority'		=> $field['priority']
			];
		}

				$fields = $customer->get_address_fields( $type );
		$fields = apply_filters("wpal/ecomm/order/{$type}/address/fields", $fields, $order_form_id);
		$selected_country = '';
		foreach ($fields as $key => $field) {
			$slug = $field['name'];
			$type = ( isset($field['type']) ) ? $field['type'] : 'input';
						$args = [
				'slug'			=> $slug,
				'title'			=> $field['label'],
				'type'			=> $type,
				'default'		=> '',
				'tab' 			=> $tab,
				'section'		=> $section,
			];
			if( $type === 'country_select' ){
				$args['type'] = 'select';
				$args['choices'] = 'countries';
				$args['default'] = wpal_ecomm()->settings->get_option('base_location');
				$args['change'] = 'wpal_ecomm_country_change';
			}
			else if( $type === 'region_select' ){
				$args['type'] = 'select';
				$args['callback'] = 'wpal_ecomm_render_region_select';
			}
			$settings[] = $args;
		}

		return $settings;
	}

	
	
function order_subscription_billing_table( $post_id ){

		$ns = 'wpal_ecomm';
		$actions = ['view_invoice'	=> __('View', $ns)];
		$merchant_admin = $this->merchant_class->admin();
		add_filter("wpal/ecomm/account/subscription/invoice/actions", [$merchant_admin, 'invoice_actions'], 10, 2);
		$actions = apply_filters("wpal/ecomm/account/subscription/invoice/actions", $actions, $post_id);
		$row_actions = [];
		if( !empty($actions) ){
			$row_actions['title'] = $actions;
		}

		return [
            'slug'			=> $this->subscriptions_data_name.'_table',
			'data_name'		=> $this->subscriptions_data_name,
            'table_attrs'	=> $this->table_class(),
			'I18n'			=> $this->table_I18n(),
            'columns'		=>	[
				'title'		=> __('Invoice #', $ns),
                'status'	=> __('Status', $ns),
				'details'	=> __('Details', $ns),
				'total'		=> __('Total', $ns),
				'created'	=> __('Created', $ns),
            ],
            'rows'			=> wpal_ecomm()->functions()->get_order_subscription_data($post_id),
			'row_actions'	=> $row_actions,
            'data_filter'	=> $this->subscriptions_data_name.'_table',
        ];
	}

	
	
function order_items_table( $post_id ){

		$ns = 'wpal_ecomm';

        return [
            'slug'			=> $this->items_data_name.'_table',
			'data_name'		=> $this->items_data_name,
            'table_attrs'	=> $this->table_class(),
			'I18n'			=> $this->table_I18n(),
            'columns'		=>	[
				'image'			=> __('Item', $ns),
				'name'			=> __('', $ns),
                'cost_display'	=> __('Cost', $ns),
				'qty'			=> __('Qty', $ns),
				'total_display'	=> __('Total', $ns),
            ],
            'rows'			=> $this->get_order_item_rows($post_id),
			
            'data_filter'	=> $this->items_data_name.'_table',
        ];
	}

	
	
function order_totals_table($post_id, $metadata = []){

		$ns = 'wpal_ecomm';
		$rows = [];

		$keys = ['subtotal','tax','discount','total'];
		foreach ($keys as $key) {
			$amount = ( isset($metadata[$key]) ) ? $metadata[$key] : 0;
			$amount = ( $amount > 0 ) ? wpal_ecomm()->functions()->price_to_decimal($amount) : '0.00';
			$string = '<div class="order-totals-line %s"><span class="price-label">%s : </span>';
			$string .= '<span class="price-wrap"><i>%s</i><span class="price">%s</span></span></div>';
			$rows[] = [
				'line'	=> sprintf($string, $key, ucfirst($key), $this->currency_symbol, $amount )
			];
		}
		return [
            'slug'			=> $this->totals_data_name.'_table',
			'data_name'		=> $this->totals_data_name,
            'table_attrs'	=> 	[
                [ 'prop' => 'class', 'value' => 'wp-list-table widefat fixed wpal-ecomm-totals' ],
            ],
			'I18n'			=> $this->table_I18n(),
            'columns'		=>	[
				'line'		=> __('Order Totals', $ns),
            ],
            'rows'			=> $rows,
		];
	}

	
	
function get_order_item_rows($post_id){

		$rows = [];
		if( (int)$post_id > 0 ){

			$order_items = $this->order_items;

			if( is_array($order_items) && !empty($order_items) ){
				foreach ($order_items as $item) {
					$item_id = $item['id'];
					$item['image'] = get_the_post_thumbnail_url($item_id);
					$rows[] = $item;
				}
			}
		}
		return $rows;
	}

	
	
function order_logs_table($post_id){

		$ns = 'wpal_ecomm';

        return [
            'slug'			=> $this->logs_data_name.'_table',
			'data_name'		=> $this->logs_data_name,
            'table_attrs'	=> $this->table_class(),
			'I18n'			=> $this->table_I18n(),
            'columns'		=>	[
				'type'		=> __('Type', $ns),
				'email'		=> __('Email', $ns),
				'message'	=> __('Message', $ns),
            ],
			'rows'			=> $this->order_log,
        ];
	}

	
	
function cancel_dialog_settings( $period_end, $order_status ){

		$ns = 'wpal_ecomm';
		$settings = [];
		$data_name = 'cancel_dialog';
		$section = "{$data_name}_config";
		$is_pending = ( $order_status === 'cancel-pending' );
		if( $is_pending ){
			$desc = sprintf(__('Current subscription set to cancel on %s', $ns), $period_end);
		}
		else{
			$desc = sprintf(__('Current subscription billing period ends on %s', $ns), $period_end);
		}
		$settings[] = [
            'slug'		=> $section,
            'type'		=> 'section',
            'tab'		=> $data_name,
			'desc'		=> $desc
        ];

		if( $is_pending ){
			$tooltip = sprintf(__('Subscription already set to cancel on %s. This option is disabled.', $ns), $period_end);
		}
		else{
			$tooltip = sprintf(__('Cancel Now or at period end %s', $ns), $period_end);
		}

		$settings[] = [
			'slug'		=> 'cancel_now',
			'title'     => __('Cancel Now', $ns),
			'tooltip'   => $tooltip,
			'default'	=> ( $is_pending ) ? 1 : 0,
			'type'      => 'switch',
			'tab'		=> $data_name,
			'section'	=> $section,
			'disabled'	=> ( $is_pending ) ? 1 : 0
		];

		$settings[] = [
			'slug'		=> 'no_cancel_requested_key',
			'title'     => __('Do Not Apply Cancel Requested Key', $ns),
			'tooltip'   => __('If selected the Cancel Requested key will not be applied.', $ns),
			'default'	=> 0,
			'type'      => 'switch',
			'tab'		=> $data_name,
			'section'	=> $section,
		];

		$settings[] = [
			'slug'		=> 'no_cancel_key',
			'title'     => __('Do Not Apply Cancelled Key', $ns),
			'tooltip'   => __('If selected the Cancelled key will not be applied.', $ns),
			'default'	=> 0,
			'type'      => 'switch',
			'tab'		=> $data_name,
			'section'	=> $section,
		];

		return [
            'slug'				=> 'cancel_dialog',
			'type'				=> 'dialog',
			'css_class'			=> 'cancel_dialog',
			'data_name'			=> $data_name,
			'legend_css_class'	=> 'dashicons dashicons-clock',
            'title'				=> __('Cancel Subscription', $ns),
            'content'			=>	$settings,
			'buttons'			=>	[
				[
					'slug'		=> 'cancel_subscription',
					'title'		=> __('Cancel Subscription', $ns),
					'type'    	=> 'button',
					'attrs' 	=> [
						[ 'prop' => 'class', 'value' => 'button cancel_subscription' ]
					],
				]
            ]
        ];
	}

	
    
function save_order($post_id, $data, $post_type) {

		$this->post_type = $post_type;
		$user_id = $data['user_id'];

				$this->init($post_type);
		$metadata = $this->metadata;
		$settings = $this->get_settings($post_id, $metadata);
		$templater = wp_admin_templater::get_instance();

				$order_config = [];
		foreach ($settings as $key => $setting) {
			$slug = ( isset($setting['slug']) ) ? $setting['slug'] : false;
			$type = ( isset($setting['type']) ) ? $setting['type'] : false;
			$ui_only = ( isset($setting['ui_only']) ) ? true : false;
			if( $slug && isset($data[$slug]) && $type != 'section' && !$ui_only ){
				$value = $templater->validate_sanitize($data[$slug], $setting);
				$order_config[$slug] = $value;
			}
		}

				$pre = 'billing_';
		$billing_keys = ['email', 'first_name', 'last_name', 'phone', 'address_1', 'address_2', 'country', 'state', 'city', 'postcode'];
		$current_billing = [];
		$updated_billing = [];
		foreach ($billing_keys as $key) {
			$prefixed = "{$pre}{$key}";
			$current_billing[$prefixed] = $this->metadata[$prefixed];
			$updated_billing[$prefixed] = $order_config[$prefixed];
		}
		$difference = array_diff($updated_billing, $current_billing);
		if( count($difference) > 0 ){
			foreach ($difference as $key => $value) {
				update_post_meta($post_id, $key, $value);
			}
			wpal_ecomm()->customer()->update_user_details( $user_id, $difference, 'admin_order_edit');
		}

		return;
	}

		static 
function cancel_subscription($data){

		$ns = 'wpal_ecomm';
		$order_id = ( !empty($data['ID']) ) ? (int)$data['ID'] : false;
		$return = [
			'success'	=> false,
			'message'	=> '',
			'data'		=> false
		];
		if( ! $order_id ){
			$return['message'] = __('Error: Unable to detect Order ID', $ns);
			return $return;
		}
		$admin_id = get_current_user_id();
		$cancel_now = ( !empty($data['cancel_now']) );
		$no_cancel_key = ( !empty($data['no_cancel_key']) );
		$no_cancel_requested_key = ( !empty($data['no_cancel_requested_key']) );
		$order_functions = wpal_ecomm()->functions();
		$status = $order_functions->get_order_status($order_id);
		$is_pending = ( $status === 'cancel-pending' );

				if( $no_cancel_key ){
			$order_functions->update_order_meta($order_id, 'no_cancel_key', 1);
		}
		if( $no_cancel_requested_key ){
			$order_functions->update_order_meta($order_id, 'no_cancel_requested_key', 1);
		}

				if( $cancel_now && ! $is_pending ){
			$order_functions->update_order_status( $order_id, 'cancel-pending' );
		}

		$response = wpal_ecomm()->subscriptions()->cancel_subscription_by_order_id($order_id, 0, $admin_id);

		if( is_wp_error($response) ){
			$return['message'] = sprintf(__('Error Cancelling Subscription : %s', $ns), $response->get_error_message());
			return $return;
		}
		else{
						$message = $response['message'];
			if( ! $cancel_now ){
				$message .= " " . sprintf( __( 'and will end on %s.' ), wp_date('M j Y',$response['end_date']) );
			}
			set_transient( "wpal/ecomm/admin/{$admin_id}", [
				'message'	=> $message,
				'class'		=> 'notice is-dismissible notice-success',
			], 60*5 );

			$return['success'] = true;
			$return['message'] = $message;
			$profile_id = $order_functions->get_order_profile_id($profile_id);
			if( ! $no_cancel_requested_key ){
				do_action( "wpal/ecomm/subscription/cancel/requested", $order_id, $profile_id);
			}
			if( $cancel_now && ! $no_cancel_key ){
				do_action("wpal/ecomm/subscription/deleted", $order_id, 'canceled', $profile_id );
			}
			return $return;
		}
	}

		
function order_description( $order_id, $metadata ){

		$profile = wpal_ecomm()->settings->get_merchant_profile($metadata['profile_id']);
				$merchant = ucfirst($profile['method']);
		$sandbox = ( isset($metadata['sandbox']) ) ? (int)$metadata['sandbox'] : 0;
		$transaction_id = $this->merchant_class->admin()->get_order_transaction_id( $order_id, $metadata );
		$url_type = 'payments';
		$desc = __('Payment created via', 'wpal_ecomm');
		if( $this->is_subscription ){
			$transaction_id = ( isset($metadata['subscription_id']) ) ? $metadata['subscription_id'] : '';
			$url_type = 'subscriptions';
			$desc = __('Subscription created via', 'wpal_ecomm');
		}
		$url = $this->merchant_class->admin()->transaction_url( $transaction_id, $url_type, $sandbox );
		$link = wpal_ecomm()->functions()->transaction_link($url,$transaction_id);
		$desc .= " {$profile['name']} ({$merchant}) {$link}";
		return $desc;
	}

	
function customer_links($post_id, $metadata){

		$html = '';

		$links = [];
		$user_id = wpal_ecomm()->functions()->get_order_user_id($post_id);
		if( $user_id ){
			$orders = wpal_ecomm()->customer()->get_orders( $user_id, [], false );
			$subscriptions = ( !empty($orders['subscription']) ) ? count($orders['subscription']) : 0;
			$single = ( !empty($orders['single']) ) ? count($orders['single']) : 0;
			$order_count = $subscriptions + $single;
			if( $order_count > 0 ){
				$order_link = add_query_arg([
					'post_type' => $this->post_type,
					's'			=> urlencode($metadata['billing_email'])
				], admin_url('edit.php') );
				$links[] = [
					'url'	=> $order_link,
					'label'	=> sprintf(__('Customer Orders (%s)'), $order_count)
				];
			}
			$links[] = [
				'url'	=> get_edit_user_link($user_id),
				'label'	=> __('WP Profile')
			];
		}

		$links = apply_filters('wpal/ecomm/order/customer/links', $links, $user_id, $post_id);

		if(!empty($links) && is_array($links)){
			$html .= '<ul class="wpal-ecomm-customer-links">';
			foreach ($links as $link) {
				$html .= sprintf('<li><a href="%s" target="_blank">%s</a></li>', $link['url'], $link['label']);
			}
			$html .= '</ul>';
		}
		return $html;
	}

	
function customer_name_email( $order_id, $metadata ){
		$email = isset($metadata['billing_email']) ? $metadata['billing_email'] : '';
		$name = isset($metadata['billing_first_name']) ? $metadata['billing_first_name'] : '';
		$last = isset($metadata['billing_last_name']) ? $metadata['billing_last_name'] : '';
		$name .= $name > '' ? " {$last}" : $last;
		$display = trim($name);
		$display .= $name > "" ? " " : "";
		$display .= $email > "" ? "( {$email} )" : "";
		return $display;
	}

		
function is_new_order(){
		global $pagenow;
		return in_array( $pagenow, array( 'post-new.php' ) );
	}

		
function price_display($price){
		$price = wpal_ecomm()->functions()->price_to_decimal($price);
		return "{$this->currency_symbol}{$price} ({$this->currency})";
	}

		
function table_class(){
		return [ [ 'prop' => 'class', 'value' => 'wp-list-table widefat fixed striped' ] ];
	}

		
function table_I18n( $translations = [] ){

		$defaults = [
			'yes'	=>	__("Yes", 'wpal_ecomm'),
			'no'	=>	__("No", 'wpal_ecomm')
		];
		return wp_parse_args( $translations, $defaults );
	}

        public static 
function get_instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
