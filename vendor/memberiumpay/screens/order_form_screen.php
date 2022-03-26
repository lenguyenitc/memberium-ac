<?php
/**
 * Copyright (C) 2017-2019 David Bullock
 * Web Power and Light, LLC
 */



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}


class wpal_ecomm_order_form_screen {

        private $post_type;
	private $tabs  = [];
	private $settings = [];
	private $active_tab = 'configuration';
	private $post_id;
	private $thankYou = 'custom';
	private $config = false;
	private $type = false;
	private $plan_data_name = 'wpal_ecomm_order_form_plans';
	private $save_errors = [];
	private $toggle_required_setting = ['billing_phone'];
	private $consent_fields = [];

    
function init($post_type){
		global $post;
		$this->post_id = ( is_object($post) && isset($post->ID) ) ? $post->ID : false;
		$config = wpal_ecomm()->functions()->order_form_config($this->post_id);
		$this->config = ( $config ) ? $config : [];
		$this->type = ( isset($this->config['order_form_type']) ) ? $this->config['order_form_type'] : false;
		$this->thankYou = ( isset($this->config['thankyou_type']) ) ? $this->config['thankyou_type'] : 'custom';
        $this->post_type = $post_type;
		$this->save_errors = ( isset($this->config['save_errors']) ) ? $this->config['save_errors'] : [];

		$this->active_tab = ( isset($_GET['tab']) ) ? $_GET['tab'] : $this->active_tab;
		$is_pro_install = wpal_ecomm()->is_pro_install();
		if( $this->type === 'subscription' && $is_pro_install ){
			add_filter("wpal/ecomm/screen/{$post_type}/tabs", [$this, 'screen_tab_filter']);
			add_filter("wpal/ecomm/screen/{$post_type}/settings", [$this, 'screen_settings_filter']);
		}
		if( ! $is_pro_install ){
			add_filter("wpal/ecomm/screen/{$post_type}/settings", [$this, 'pro_features_dialog_settings']);
		}

        $this->tabs = $this->get_tabs();

        $this->settings = $this->get_settings();

        $this->show();

        $this->to_json();
    }

    
function get_tabs(){

        $tabs = [
			[
                'slug'	=> 'configuration',
                'label'	=> __( 'Config', 'wpal_ecomm' ),
                'icon'	=> 'dashicons dashicons-admin-generic',
            ],
			[
                'slug'	=> 'form',
                'label'	=> __( 'Form Fields', 'wpal_ecomm' ),
                'icon'	=> 'dashicons dashicons-feedback',
            ],
			
			[
                'slug'	=> 'thank-you',
                'label'	=> __( 'Thank You', 'wpal_ecomm' ),
                'icon'	=> 'dashicons dashicons-migrate',
            ],
			[
                'slug'	=> 'notices',
                'label'	=> __( 'Notices', 'wpal_ecomm' ),
                'icon'	=> 'dashicons dashicons-megaphone',
            ]

        ];

        return apply_filters( "wpal/ecomm/screen/{$this->post_type}/tabs", $tabs );

    }

	
function screen_tab_filter( $tabs ){

		if( $this->type === 'subscription' ){
			$tabs[] = [
				'slug'	=> 'subscription',
				'label'	=> __( 'Subscriptions', 'wpal_ecomm' ),
				'icon'	=> 'dashicons dashicons-admin-network',
			];
		}

		return $tabs;
	}

    
function get_settings(){

        $settings = [];

				$tab = 'configuration';
        $section = "{$tab}-section";
        $settings[] = [
            'slug'		=> $section,
            'type'		=> 'section',
            'tab'		=> $tab,
			'callback'	=> 'order_form_config_render'
        ];

		$settings[] = [
			'slug'		=> 'order_form_type',
			'title'		=> __('Order Form Type', 'wpal_ecomm'),
			'type'		=> 'select',
			'default'	=> 'single',
			'choices'	=> 'product_types',
			'search'	=> 'no',
			'tab'		=> $tab,
			'section'	=> $section,
			'change'	=> 'order_form_type_change',
		];

		$settings[] = [
			'slug'		=> 'order_form_currency',
			'title'		=> __( 'Checkout Currency', 'wpal_ecomm' ),
			'tooltip'	=> __( 'Select the currency for this order form\'s pricing.', 'wpal_ecomm' ),
			'type'		=> 'select',
			'choices'	=> 'currencies',
			'default'	=> wpal_ecomm()->settings->get_option('default_currency'),
			'tab'		=> $tab,
			'section'	=> $section,
			'change'	=> 'order_form_currency_change',
		];

		$settings[] = [
			'slug'			=> 'order_form_merchants',
			'title'			=> __('Merchant Profiles', 'wpal_ecomm'),
			'type'			=> 'multi_select',
			'default'		=> '',
			'search'		=> 'no',
			'sortable'		=> 1,
			'html_label'	=> 1,
			'tab' 			=> $tab,
			'section'		=> $section,
		];

		$settings[] = [
			'slug'		=> 'order_form_products',
			'title'		=> __('Product', 'wpal_ecomm'),
			'type'		=> 'select',
			'tab' 		=> $tab,
			'section'	=> $section,
			'change'	=> 'order_form_product_change',
		];

		$settings[] = [
			'slug'		=> 'order_form_pricing_plans',
			'title'		=> __('Pricing Plans', 'wpal_ecomm'),
			'type'		=> 'multi_select',
			'tab' 		=> $tab,
			'section'	=> $section,
		];

				$settings = $this->get_form_settings($settings);

				


				$tab = 'thank-you';

		        $section = "{$tab}-section";
        $settings[] = [
            'slug'		=> $section,
            'type'		=> 'section',
            'tab'		=> $tab,
			'desc'		=> __('Select how you would like to display the thank you page on a successful purchase.','wpal_ecomm'),
			'callback'	=> 'render_thankyou_panel'
        ];

				$settings[] = [
			'slug'		=> 'thankyou_type',
			'title'		=> __('Thank You Page Type', 'wpal_ecomm'),
			'type'		=> 'select',
			'default'	=> $this->thankYou,
			'choices'	=> 'thankyou_types',
			'search'	=> 'no',
			'tab' 		=> $tab,
			'section'	=> $section,
			'change'	=> 'toggle_thankyou_type'
		];

				$settings[] = [
            'slug'		=> "{$section}-page",
            'type'		=> 'section',
            'tab'		=> $tab,
        ];
		$settings[] = [
			'slug'		=> 'thankyou_page',
			'title'		=> __('Page', 'wpal_ecomm'),
			'type'		=> 'select',
			'default'	=> '',
			'choices'	=> 'pagelist',
			'tab' 		=> $tab,
			'section'	=> "{$section}-page",
		];

				$settings[] = [
            'slug'		=> "{$section}-url",
            'type'		=> 'section',
            'tab'		=> $tab,
        ];
		$settings[] = [
			'slug'		=> 'thankyou_url',
			'title'		=> __('URL', 'wpal_ecomm'),
			'type'		=> 'input',
			'tooltip'	=> __('Enter the URL to redirect customers to on a successful purchase.', 'wpal_ecomm'),
			'default'	=> '',
			'tab' 		=> $tab,
			'section'	=> "{$section}-url",
		];

				$settings[] = [
            'slug'		=> "{$section}-custom",
            'type'		=> 'section',
            'tab'		=> $tab,
        ];
		$custom_error = isset($this->save_errors['custom']) ? true : false;
		$default_title = $custom_error ? '' : __('Success!', 'wpal_ecomm');
		$settings[] = [
			'slug'		=> 'thankyou_custom_title',
			'title'		=> __('Custom Title', 'wpal_ecomm'),
			'type'		=> 'input',
			'tooltip'	=> __('Enter title to be dislayed on successfull purchase.', 'wpal_ecomm'),
			'default'	=> $default_title,
			'tab' 		=> $tab,
			'section'	=> "{$section}-custom",
		];

		$settings[] = [
			'slug'		=> 'thankyou_custom_content',
			'title'		=> __('Custom Content', 'wpal_ecomm'),
			'type'		=> 'editor',
			'tooltip'	=> __('Enter content to be displayed upon successful purchase.', 'wpal_ecomm'),
			'default'	=> '',
			'tab' 		=> $tab,
			'section'	=> "{$section}-custom",
			'config'	=> [
				'mediaButtons'  => true,
				'tinymce'       => [
					'wpautop' => true,
					'toolbar1'	=> "formatselect,bold,italic,alignleft,aligncenter,alignright,bullist,link",
				],
				'quicktags'		=> [
					'buttons' => "formatselect,strong,em,alignleft,aligncenter,alignright,link,ul,li,code"
				]
			]
		];

		        $section = "{$tab}-data-section";
        $settings[] = [
            'slug'		=> $section,
            'type'		=> 'section',
			'title'		=> __('Post Details to Thank You Page', 'wpal_ecomm'),
            'tab'		=> $tab,
        ];

		$settings[] = [
			'slug'		=> 'pass_order_details',
			'title'     => __('Pass Order Details', 'wpal_ecomm'),
			'tooltip'   => __('Enabling this setting will pass order details to the Thank You page via the URL.', 'wpal_ecomm'),
			'default'	=> 1,
			'type'      => 'switch',
			'section'   => $section,
			'tab'       => $tab,
			'unlock'	=> [ 'success_email' ]
		];

				$tab = 'notices';
		$section = "{$tab}-section";
				$settings[] = [
            'slug'	=> $section,
            'type'	=> 'section',
			'desc'	=> __('Optional Admin Notices','wpal_ecomm'),
            'tab'	=> $tab,
        ];

		$default_email = wpal_ecomm()->settings->get_option('default_email');

		$settings[] = [
			'slug'		=> 'send_success_email',
			'title'     => __('On Success', 'wpal_ecomm'),
			'tooltip'   => __('Notify Admin on successful purchase.', 'wpal_ecomm'),
			'default'	=> 1,
			'type'      => 'switch',
			'section'   => $section,
			'tab'       => $tab,
			'unlock'	=> [ 'success_email' ]
		];

		$settings[] = [
			'slug'		=> 'success_email',
			'title'		=> __('Success Email(s)', 'wpal_ecomm'),
			'type'		=> 'textarea',
			'rows'		=> 1,
			'tooltip'	=> __('Email or comma seperated list of emails to be notified upon succesful purchases.', 'wpal_ecomm'),
			'default'	=> $default_email,
			'tab' 		=> $tab,
			'section'	=> $section,
		];

        return apply_filters( "wpal/ecomm/screen/{$this->post_type}/settings", $settings );

    }

	
function get_form_settings( $settings ){
		$tab = 'form';
		$contact_fields = wpal_ecomm()->customer()->get_contact_fields();
		foreach ($contact_fields as $field) {
			$settings = $this->field_settings( $field, $settings, $tab );
		}

		$address_fields = wpal_ecomm()->customer()->get_address_fields();
		foreach ($address_fields as $field) {
			$settings = $this->field_settings( $field, $settings, $tab );
		}

		$consent_fields = wpal_ecomm()->customer()->get_consent_fields();
		$this->consent_fields = wp_list_pluck($consent_fields, 'name');
		foreach ($consent_fields as $field) {
			$settings = $this->field_settings( $field, $settings, $tab );
		}
		return $settings;
	}

	
function screen_settings_filter( $settings ){

		if( $this->type === 'subscription' ){

						$tab = 'subscription';
	        $section = "{$tab}-section";
	        $settings[] = [
	            'slug'		=> $section,
	            'type'		=> 'section',
	            'tab'		=> $tab,
	        ];
						$settings[] = [
				'slug'		=> 'pricing_plans',
				'type'    	=> 'table',
				'data'		=> $this->pricing_plans_table($this->post_id),
				'tab' 		=> $tab,
				'section'	=> $section,
				'ui_only'	=> 1
			];

		}

		return $settings;

	}

	
function pro_features_dialog_settings( $settings ){
				$dialog_content = apply_filters('wpal/ecomm/pro/features/dialog/content', '', $this->post_type);
		if( empty($dialog_content) ){
			return $settings;
		}
		$product_type_key = array_search('order_form_type', array_column($settings, 'slug'));
		$settings[$product_type_key]['change'] = 'pro_product_type_onchange';
		$settings[] = [
			'slug'		=> 'pro_product_type_dialog',
			'type'		=> 'dialog',
			'css_class'	=> 'pro_feature_dialog',
			'content'	=> $dialog_content
        ];
		return $settings;
	}

	
function field_settings( $field, $settings, $tab ){

		$name = $field['name'];
		$title = $field['label'];
		$is_consent = in_array( $name, $this->consent_fields );
		$allow_disable = in_array( $name, $this->toggle_required_setting ) || $is_consent;

		        $section = "{$tab}-{$name}-section";
        $settings[] = [
            'slug'		=> $section,
            'type'		=> 'section',
			'title'		=> $title,
            'tab'		=> $tab,
        ];

				$disable_args = [
			'slug'		=> "{$name}_enabled",
			'title'		=> __('Field Enabled', 'wpal_ecomm'),
			'type'		=> 'hidden',
			'default'	=> 1,
			'tab' 		=> $tab,
			'section'	=> $section,
		];
		if( $allow_disable ){
			$disable_args['type'] = 'switch';
			$disable_args['unlock'] = [ "{$name}_label", "{$name}_required", "{$name}_msg" ];
			if($is_consent){
				$disable_args['default'] = 0;
			}
		}
		$settings[] = $disable_args;

				$settings[] = [
			'slug'		=> "{$name}_label",
			'title'		=> __('Field Label', 'wpal_ecomm'),
			'type'		=> ( $is_consent ) ? 'editor' : 'input',
			'default'	=> $title,
			'tab' 		=> $tab,
			'section'	=> $section,
		];

				$required = ( substr( $name, -strlen( '_address_2' ) ) === '_address_2' ) ? 0 : 1;
		if( $allow_disable ){
			$required = isset($field['required']) ? (int)$field['required'] : 0;
		}
		$required_args = [
			'slug'		=> "{$name}_required",
			'title'		=> __('Required Field', 'wpal_ecomm'),
			'type'		=> 'hidden',
			'default'	=> $required,
			'tab' 		=> $tab,
			'section'	=> $section,
		];

		if( $allow_disable ){
			$required_args['type'] = 'switch';
			$required_args['unlock'] = [ "{$name}_msg" ];
		}
		$settings[] = $required_args;

				$settings[] = [
			'slug'		=> "{$name}_msg",
			'title'		=> __('Error Message', 'wpal_ecomm'),
			'type'		=> 'input',
			'default'	=> ( !empty($field['msg']) ) ? $field['msg'] : '',
			'tab' 		=> $tab,
			'section'	=> $section,
		];

		return $settings;
	}

    
function show(){

                echo '<fieldset class="wpat-admin-form wpat-post-type" data-screen="'.$this->post_type.'">';
			            echo '<div id="order-form-config-table" class="wpat_admin_table wpat_tabbed_table">';
                echo '<div class="wpat_option_tabs"></div>';
                echo '<div class="wpat_option_panels"></div>';
            echo '</div>';
			wp_nonce_field("wpal_ecomm_order_form_action", "wpal_ecomm_order_form_nonce_field");
        echo '</fieldset>';

    }

	
	static 
function show_shortcode_metabox($post){
		$prefix = wpal_ecomm()->get_config('shortcode_prefix');
		$shortcode = "[{$prefix}_order_form id={$post->ID}]";
		echo "<input class=\"widefat\" type=\"input\" value=\"{$shortcode}\" readonly />";
	}

	
    
function to_json(){

        $templater = wp_admin_templater::get_instance();
        $templater->to_json('tab', $this->active_tab);

				$order_form_config = [];
		$thankYou = $this->thankYou;
		if($this->post_id){
			global $post;
			$order_form_config = wpal_ecomm()->functions()->order_form_config($this->post_id);
			$order_form_config = ( $order_form_config ) ? $order_form_config : [];
			$thankYou = ( isset($order_form_config['thankyou_type']) ) ? $order_form_config['thankyou_type'] : $thankYou;
						foreach ($order_form_config as $key => $value) {
				if( (strpos($key, '_required', strlen($key) - strlen('_required')) !== false) ){
					$value = ( $value ) ? 1 : 0;
					if( $key === 'billing_address_2_required' ){
						$value = 0;
					}
					$order_form_config[$key] = $value;
				}
			}
		}
		$settings = wp_admin_templater_data::setting_values($this->settings, $order_form_config);
		$templater->to_json('settings', $settings);
        $templater->to_json('tabs', $this->tabs);
		$templater->to_json('thankyou', $thankYou);

				$save_errors = $this->save_errors;
		if( ! empty($save_errors) && is_array($save_errors) ){
			if( count($save_errors) > 1 ){
				$title = __('Errors : ', 'wpal_ecomm');
				$msg = "<ul>";
				foreach ($save_errors as $error) {
					$msg .= "<li>{$error}</li>";
				}
				$msg .= "</ul>";
			}
			else {
				$title = __('Error : ', 'wpal_ecomm');
				$msg = array_values($save_errors)[0];
			}
			$templater->to_json('save_error', [
				'type'		=> 'error',
				'title'		=> $title,
				'content'	=> $msg,
			]);
		}
    }

	
	public 
function pricing_plans_table($post_id){

		return [
			'slug'			=> $this->plan_data_name.'_table',
			'data_name'		=> $this->plan_data_name,
			'table_attrs'	=> 	[
				[ 'prop' => 'class', 'value' => 'wp-list-table widefat fixed striped' ],
			],
			'columns'		=>	[
				'property_type'	=> __('Type', 'wpal_ecomm'),
				'details'		=> __('Details', 'wpal_ecomm'),
											],
			'rows'			=> $this->get_plan_rows($post_id),
			'row_actions'	=> [
				'name'	=> [
					'edit' 		=> __('Edit', 'wpal_ecomm'),
					'delete' 	=> __('Delete', 'wpal_ecomm'),
				],
			],
			'I18n'			=> [
				'yes'			=>	__("Yes", 'wpal_ecomm'),
				'no'			=>	__("No", 'wpal_ecomm'),
			],
			'data_filter'	=> $this->plan_data_name.'_table',
					];

	}

	
function get_plan_rows($post_id){

		$rows = [];
		$config = wpal_ecomm()->functions()->order_form_config($post_id);
		$config = ( is_array($config) ) ? $config : false;
		if($config){
			$merchants = $config['order_form_merchants'];
			$merchants = ( $merchants > '' ) ? explode(',', trim($merchants, ',')) : false;
			$products = $config['order_form_products'];
			$products = ( $products > '' ) ? explode(',', trim($products, ',')) : false;
			$plans = $config['order_form_pricing_plans'];
			$plans = ( $plans > '' ) ? explode(',', trim($plans, ',')) : false;
			$settings_class = wpal_ecomm()->settings;
			$subscriptions = wpal_ecomm_subscriptions::get_instance();

			if( $merchants ){
				foreach ($merchants as $merchant_id) {
					$get_properties = [];
					foreach ($products as $product_id) {
						$get_products = $subscriptions->get_subscription_properties( $product_id, $merchant_id, 'product' );
						if($get_products){
							$get_properties = wp_parse_args($get_products, $get_properties);
						}
					}
					foreach ($plans as $plan_id) {
						$get_plans = $subscriptions->get_subscription_properties( $plan_id, $merchant_id, 'plan' );
						if($get_plans){
							$get_properties = wp_parse_args($get_plans, $get_properties);
						}
					}
					if($get_properties){
						foreach ($get_properties as $key => $property) {
							$details = "<ul class=\"plan-details\">";
							$merchant_profile_name = $settings_class->get_merchant_name($merchant_id);
							$details .= "<li>ID : {$property->property_id}</li>";
							$details .= "<li>Merchant Profile : {$merchant_profile_name}</li>";
							$details .= "</ul>";
														$property->merchant = $merchant_profile_name;
							$property->details = $details;
							$rows[] = $property;
						}
					}
				}
			}
		}
		return $rows;
	}

	
    
function save_order_form($post_id, $data, $post_type){

		$this->post_type = $post_type;
		$settings = $this->get_settings();
		$templater = wp_admin_templater::get_instance();

		add_filter('wp/admin/templater/validate/field/success_email', [$this, 'validate_success_email'], 10, 2);
		add_filter('wp/admin/templater/validate/field/order_form_merchants', [$this, 'validate_merchants'], 10, 2);
		add_filter('wp/admin/templater/validate/field/order_form_products', [$this, 'validate_products'], 10, 2);
		add_filter('wp/admin/templater/validate/field/order_form_pricing_plans', [$this, 'validate_pricing_plans'], 10, 2);
		add_filter('wp/admin/templater/validate/field/thankyou_type', [$this, 'validate_thankyou_type'], 10, 2);

				$order_form_config = [];
		foreach ($settings as $key => $setting) {
			$slug = ( isset($setting['slug']) ) ? $setting['slug'] : false;
			$type = ( isset($setting['ui_only']) ) ? $setting['type'] : false;
			$ui_only = ( isset($setting['ui_only']) ) ? true : false;
			if( $slug && isset($data[$slug]) && $type != 'section' && !$ui_only ){
				$value = $templater->validate_sanitize($data[$slug], $setting);
				$order_form_config[$slug] = $value;
			}
		}

				$type = ( isset($order_form_config['order_form_type']) ) ? $order_form_config['order_form_type'] : '';
		if( ! wpal_ecomm()->is_pro_install() ){
			$type = 'single';
		}
		$order_form_config['subscription_map'] = false;
		if( $type === 'subscription' ){

			$subscriptions = wpal_ecomm_subscriptions::get_instance();
			$order_form_config['subscription_map'] = $subscriptions->manage_order_form_subscription($post_id, $order_form_config);

		}

		if( $this->save_errors ){
			$order_form_config['save_errors'] = $this->save_errors;
		}

				$key = wpal_ecomm()->functions()->get_form_prefix();
		update_post_meta($post_id,"{$key}config",$order_form_config);

		return;
	}

	
	
function validate_success_email( $value, $setting ){

				$value = trim( trim($value,',') );
		if( ! $value > '' ){
			return $value;
		}
				$email_array = explode(',',$value);
		$cleansed = [];
		foreach ($email_array as $key => $email) {
			if( is_email($email) ){
				$cleansed[] = $email;
			}
		}
				return ( ! empty($cleansed) ) ? implode(",",$cleansed) : '';
	}

	
	
function validate_merchants($value, $setting){
		if($value > ''){
			$values = explode(',', trim($value, ',') );
			$selected = [];
			$currency = ( isset($_POST['order_form_currency']) ) ? $_POST['order_form_currency'] : '';
			$merchants = wpal_ecomm_data::merchants_select_data($currency);
			$merchants = ( !empty($merchants) ) ? wp_list_pluck($merchants,'id') : [];
			$result = array_intersect($values,$merchants);
			$value = ( !empty($result) ) ? implode(',',$result) : '';
		}

		return $value;
	}

	
	
function validate_products($value, $setting){
		if($value > ''){
			$values = explode(',', trim($value, ',') );
			$currency = ( isset($_POST['order_form_currency']) ) ? $_POST['order_form_currency'] : '';
			$type = ( isset($_POST['order_form_type']) ) ? $_POST['order_form_type'] : '';
			$products = wpal_ecomm_data::get_product_posts($type,$currency);
			$product_ids = ($products) ? wp_list_pluck($products,'ID') : [];
			$result = array_intersect($values,$product_ids);
			$value = ( !empty($result) ) ? implode(',',$result) : '';
			$_POST['order_form_products'] = $value;
		}
		return $value;
	}

	
	
function validate_pricing_plans($value, $setting){
		if($value > ''){
			$values = explode(',', trim($value, ',') );
			$product_id = ( isset($_POST['order_form_products']) ) ? $_POST['order_form_products'] : '';
			if($product_id > ''){
				$currency = ( isset($_POST['order_form_currency']) ) ? $_POST['order_form_currency'] : '';
								$plan_meta_prefix = wpal_ecomm_products::PLAN_META_PREFIX;
				$product_plans = wpal_ecomm_data::get_product_plans($product_id,[
					'meta_key' 	 => "{$plan_meta_prefix}currency",
					'meta_value' => $currency
				]);
				$plan_ids = wp_list_pluck($product_plans,'id');
				$result = array_intersect($values,$plan_ids);
				$value = ( !empty($result) ) ? implode(',',$result) : '';
			}
		}
		return $value;
	}

	
	
function validate_thankyou_type($value, $setting){

		$data = $_POST;
		$error = [];
		$ty = "thankyou_";
		if( $value === 'page' ){
			$page_id = isset($data["{$ty}page"]) ? $data["{$ty}page"] : 0;
			if( (int)$page_id > 0 ){
				if( ! wpal_ecomm()->settings->post_exists($page_id) ){
					$error['page'] = __('Selected Thank You Page does not exist', 'wpal_ecomm');
				}
			}
			else {
				$error['page'] = __('Please select a Thank You Page', 'wpal_ecomm');
			}
		}
		else if( $value === 'url' ){
			$url = isset($data["{$ty}url"]) ? $data["{$ty}url"] : '';
			$url_error = __('Thank You Page URL is invalid.', 'wpal_ecomm');
			if( $url > '' ){
				if( esc_url_raw($url) !== $url ){
					$error['url'] = $url_error;
				}
			}
			else{
				$error['url'] = $url_error;
			}
		}
		else if( $value === 'custom' ){
			$tyc = "{$ty}custom_";
			$title = isset($data["{$tyc}title"]) ? sanitize_text_field($data["{$tyc}title"]) : '';
			$content = isset($data["{$tyc}content"]) ? sanitize_textarea_field($data["{$tyc}content"]) : '';
			if( ! $title > '' && ! $content > '' ){
				$error['custom'] = __('No title or content entered for custom thank you page.', 'wpal_ecomm');
			}
		}

		if( ! empty($error) ){
			$this->save_errors = wp_parse_args($error, $this->save_errors);
		}

		return $value;
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
