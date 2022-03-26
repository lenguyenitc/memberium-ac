<?php
/**
 * Copyright (C) 2017-2019 David Bullock
 * Web Power and Light, LLC
 */



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}


class wpal_ecomm_product_screen {

	static $instance = null;

        protected $post_type;
	protected $product_type;
	protected $tabs  = [];
	protected $settings = [];
	protected $active_tab = 'details';
	protected $post_id;
	protected $today_ymd = false;
	protected $bill_interval_max = [
		'day'	=> 365,
		'week'  => 52,
		'month' => 12,
		'year'  => 1
	];

		protected $plan_data_name = 'wpal_ecomm_product_plans';

    
function init($post_type){

		global $post;

		$this->post_id = ( is_object($post) && isset($post->ID) ) ? $post->ID : false;
		$product_meta_prefix = wpal_ecomm_products::PRODUCT_META_PREFIX;
		$product_type = get_post_meta($this->post_id, "{$product_meta_prefix}type", true);
		if( ! wpal_ecomm()->is_pro_install() ){
			$product_type = 'single';
			add_filter("wpal/ecomm/screen/{$post_type}/settings", [$this, 'pro_features_dialog_settings']);
		}

		$this->product_type = ( $product_type ) ? $product_type : 'single';

        $this->post_type = $post_type;

		$this->active_tab = ( isset($_GET['tab']) ) ? $_GET['tab'] : $this->active_tab;

        $this->tabs = $this->get_tabs();

        $this->settings = $this->get_settings( $this->post_id );

        $this->show();

        $this->to_json();

    }

	    
function get_tabs(){

        $ns = 'wpal_ecomm';

        $tabs = [
            [
                'slug'	=> 'details',
                'label'	=> __( 'Details', $ns ),
                'icon'	=> 'dashicons dashicons-format-aside',
            ],
			[
                'slug'	=> 'subscriptions',
                'label'	=> __( 'Subscriptions', $ns ),
                'icon'	=> 'dashicons dashicons-clock',
            ],
            [
                'slug'	=> 'pricing',
                'label'	=> __( 'Pricing', $ns ),
                'icon'	=> 'dashicons dashicons-cart',
            ],
            [
                'slug'	=> 'automation',
                'label'	=> __( 'Automation', $ns ),
                'icon'	=> 'dashicons dashicons-id-alt',
            ],
			[
                'slug'	=> 'security',
                'label'	=> __( 'Security', $ns ),
                'icon'	=> 'dashicons dashicons-lock',
            ]
        ];

        return apply_filters( "wpal/ecomm/screen/{$this->post_type}/tabs", $tabs );

    }

	    
function get_settings( $post_id = 0 ){

		$post_id = ( (int) $post_id > 0 ) ? $post_id : $this->post_id;

        $ns = 'wpal_ecomm';

        $settings = [];

						$settings[] = [
			'slug'		=> 'product_type',
			'type'		=> 'select',
			'default'	=> 'single',
			'choices'	=> 'product_types',
			'search'	=> 'no',
			'tab' 		=> '',
			'section'	=> '',
			'change'	=> 'product_type_onchange'
		];

		        $tab = 'subscriptions';

                $section = "{$tab}-section";
        $settings[] = [
            'slug'		=> $section,
            'type'		=> 'section',
			'desc'		=> __( 'Pricing plans define how customers will be billed for this product.<br/>You may want to add multiple plans if you sell this product in multiple currencies, intervals or other configurations.', $ns),
            'tab'		=> $tab,
			'className' => 'wpal_ecomm-subscription',
			'callback'	=> 'init_add_new_plan'
        ];

				$plan_data_name = $this->plan_data_name;
		$settings[] = [
			'slug'		=> 'add_new_plan',
			'label'		=> __( 'Add Pricing Plan', $ns ),
			'type'    	=> 'add_new_form',
			'data'		=> $this->get_plan_form($plan_data_name, $post_id, true),
			'icon'		=> 'dashicons dashicons-analytics',
			'toggle'	=> "{$plan_data_name}-toggle",
			'data_name'	=> $plan_data_name,
			'tab' 		=> $tab,
			'section'	=> $section,
			'ui_only'	=> 1
		];

				$settings[] = [
			'slug'		=> 'plan_table',
			'type'    	=> 'table',
			'data'		=> $this->get_plan_table($plan_data_name, $post_id),
			'tab' 		=> $tab,
			'section'	=> $section,
			'ui_only'	=> 1
		];

                $tab  = 'details';

                $section = 'details-section';
        $settings[] = [
            'slug'	=> $section,
            'type'	=> 'section',
            'tab'	=> $tab
        ];
        $settings[] = [
            'slug'          => 'product_description',
            'title'         => __( 'Description', $ns ),
            'tooltip'       => __( 'Full product description.', $ns ),
            'type'          => 'editor',
            'tab'           => $tab,
            'section'       => $section,
        ];

        $settings[] = [
            'slug'          => 'product_excerpt',
            'title'         => __( 'Excerpt', $ns ),
            'tooltip'       => __( 'Simple text for short description.', $ns ),
            'type'          => 'textarea',
            'tab'           => $tab,
            'section'       => $section,
        ];

                $tab  = 'pricing';
                $section = 'pricing-section';
        $settings[] = [
            'slug'	=> $section,
            'type'	=> 'section',
            'tab'	=> $tab
        ];

		$settings[] = [
			'slug'          => 'product_currency',
			'title'         => __( 'Currency', $ns ),
			'tooltip'       => __( 'Select the currency for this products\'s pricing.', $ns ),
			'type'          => 'select',
			'choices'		=> 'currencies',
			'default'		=> wpal_ecomm()->settings->get_option('default_currency'),
			'tab'           => $tab,
			'section'       => $section,
		];

        $settings[] = [
            'slug'          => 'price',
            'title'         => __( 'Price', $ns ),
            'tooltip'       => __( '', $ns ),
            'type'          => 'price',
            'default'       => 0.00,
            'min'			=> 0,
            'tab'           => $tab,
            'section'       => $section,
        ];

        $settings[] = [
			'slug'          => 'on_sale',
			'title'         => __( 'Enable Sale', $ns ),
			'tooltip'       => __( '', $ns ),
			'type'          => 'switch',
			'section'       => $section,
			'tab'           => $tab,
		];

        $settings[] = [
            'slug'          => 'sale_price',
            'title'         => __( 'Sale Price', $ns ),
            'tooltip'       => __( '', $ns ),
            'type'          => 'price',
            'default'       => 0.00,
            'min'			=> 0,
            'tab'           => $tab,
            'section'       => $section,
        ];

		$tab = 'automation';
		$section = $tab . '-section';
		$I18n = wpal_ecomm()->get_config('I18n');
		$keys = $I18n['keys_name'];
		$keys_lower = strtolower($keys);
		$key = $I18n['key_name'];
		$key_lower = strtolower($key);

		$settings[] = [
			'slug'	=> $section,
			'title'	=> $I18n['keys_title'],
			'desc'	=> sprintf( __( 'Assign %s for different events throughout the order lifecycle', $ns ), $keys ),
			'type'	=> 'section',
			'tab'	=> $tab
		];

		$settings[] = [
			'slug'		=> 'successful_key',
			'title'		=> __( 'Successful Purchase', $ns ),
			'tooltip'	=> sprintf( __( 'Add or remove %s upon successful purchase.', $ns ), $keys_lower ),
			'desc'		=> sprintf( __( 'By default successful orders will remove the Failed Purchase %s.', $ns ), $key_lower ),
			'type'		=> 'multi_select',
			'default'	=> '',
			'choices'	=> 'crm_tags',
			'tab' 		=> $tab,
			'section'	=> $section,
		];

		$settings[] = [
			'slug'		=> 'failure_key',
			'title'		=> __( 'Failed Purchase', $ns ),
			'tooltip'	=> sprintf( __( 'Add or remove %s upon failed purchase.', $ns ), $keys_lower ),
			'desc'		=> __( '', $ns ),
			'type'		=> 'multi_select',
			'default'	=> '',
			'choices'	=> 'crm_tags',
			'tab' 		=> $tab,
			'section'	=> $section,
		];

		$section = 'subscriptions';
		$settings[] = [
			'slug'		=> $section,
			'title'		=> __( 'Subscriptions', $ns ),
			'desc'		=> sprintf( __( 'Assign %s for different subscription events', $ns ), $keys_lower ),
			'className' => 'wpal_ecomm-subscription',
			'type'		=> 'section',
			'tab'		=> $tab,
		];

		$settings[] = [
			'slug'		=> 'requested_cancellation_key',
			'title'		=> __( 'Cancel Requested', $ns ),
			'tooltip'	=> sprintf( __( 'Add or remove %s when subscription canellation is requested.', $ns ), $keys_lower ),
			'type'		=> 'multi_select',
			'default'	=> '',
			'choices'	=> 'crm_tags',
			'tab' 		=> $tab,
			'section'	=> $section,
		];

		$settings[] = [
			'slug'		=> 'on_cancellation_key',
			'title'		=> __( 'On Cancel', $ns ),
			'tooltip'	=> sprintf( __( 'Add or remove %s when a member cancells their subscription.', $ns ), $keys_lower ),
			'type'		=> 'multi_select',
			'default'	=> '',
			'choices'	=> 'crm_tags',
			'tab' 		=> $tab,
			'section'	=> $section,
		];

		$tab = 'security';
		$section = $tab . '-section';
		$settings[] = [
			'slug'	=> $section,
			'title'	=> __( 'Security', $ns ),
			'desc'	=> __( 'Purchase control settings', $ns ),
			'type'	=> 'section',
			'tab'	=> $tab
		];

		$settings[] = [
			'slug'		=> 'duplicates',
			'title'		=> __( 'Disable Duplicate Purchases', $ns ),
			'tooltip'	=> __( 'Do not allow customer to purchase this product multiple times. Not applicable to inactive subscriptions.', $ns ),
			'type'		=> 'switch',
			'unlock'	=> ['duplicate_message'],
			'section'	=> $section,
			'tab'		=> $tab
		];

		$settings[] = [
            'slug'          => 'duplicate_message',
            'title'         => __( 'Duplicate Message', $ns ),
            'tooltip'       => __( 'Simple text for duplicate messaging displayed to the customer when attempting to check out.', $ns ),
            'type'          => 'textarea',
            'tab'           => $tab,
            'section'       => $section,
        ];

        return apply_filters( "wpal/ecomm/screen/{$this->post_type}/settings", $settings );

    }

	
function pro_features_dialog_settings( $settings ){
		$dialog_content = apply_filters('wpal/ecomm/pro/features/dialog/content', '', $this->post_type);
		if( empty($dialog_content) ){
			return $settings;
		}
		$product_type_key = array_search('product_type', array_column($settings, 'slug'));
		$settings[$product_type_key]['change'] = 'pro_product_type_onchange';
		$settings[] = [
			'slug'		=> 'pro_product_type_dialog',
			'type'		=> 'dialog',
			'css_class'	=> 'pro_feature_dialog',
			'content'	=> $dialog_content
        ];
		return $settings;
	}

	    
function show(){

		$ns = 'wpal_ecomm';
				echo '<p class="wpal-product-desc description">'.__('This name will appear on Checkout, customers\' receipts, and invoices.',$ns).'</p>';

                echo '<fieldset class="wpat-admin-form wpat-post-type" data-screen="'.$this->post_type.'">';
						echo '<div id="product-type-select-wrap">';
				echo '<label for="product-type-select">';
					echo '<span class="wpat-label-text">';
						echo __( 'Product Type', $ns );
					echo '</span>';
				echo '</label>';
			echo '</div>';
			            echo '<div id="product-config-table" class="wpat_admin_table wpat_tabbed_table" data-product-type="'.$this->product_type.'">';
                echo '<div class="wpat_option_tabs"></div>';
                echo '<div class="wpat_option_panels"></div>';
            echo '</div>';
			wp_nonce_field("{$ns}_product_action", "{$ns}_product_nonce_field");
        echo '</fieldset>';

    }

	    
function to_json(){

		$ns = 'wpal_ecomm';

        $templater = wp_admin_templater::get_instance();
        $templater->to_json('tab', $this->active_tab);

				$product_config = [];
		if($this->post_id){
			$product_config = wpal_ecomm_products::get_product_config($this->post_id, true);
		}
		$settings = wp_admin_templater_data::setting_values($this->settings, $product_config);
		$templater->to_json('settings', $settings);
        $templater->to_json('tabs', $this->tabs);
		$templater->to_json('product_type', $this->product_type);
		$templater->to_json('currency_data', wpal_ecomm_data::$currencies);
		$templater->set_I18n('save_plans', __('Please review and save open Subscription plans individually.', $ns));
		$templater->set_I18n('add_new_plan', __('Add New Pricing Plan', $ns));
		$templater->set_I18n('locked_plan', __('Pricing may not be changed for active plans.<br/>To change any of these values please configure a new plan.', $ns));
				$templater->set_I18n('price_plan_per', __('Customer will be billed %s%s (%s) / %s', $ns));
				$templater->set_I18n('price_plan_end_count', __('for %s %s%s.', $ns));
				$templater->set_I18n('price_plan_end_date', __('until %s.', $ns));
		$templater->set_I18n('price_plan_end_infinite', __('until cancelled.', $ns));
				$templater->set_I18n('price_plan_trial', __('Trial period offer for %s day%s', $ns));
		$templater->set_I18n('locked_plan_trial', __('Trials may not be changed for active plans.<br/>To change trial settings please configure a new plan.', $ns));
				$locked_wrapper = '<span class="locked-hidden">%s</span><input type="text" class="widefat" readonly value="%s">';
		$templater->set_I18n('locked_wrapper', __($locked_wrapper, $ns));
		$templater->set_I18n('section_desc', __('<p class="description wpat_section-desc">%s</p>', $ns));
				$templater->set_I18n('confirm_bulk_cancel', __('Are you sure you want to bulk cancel all active subscriptions for %s - %s on %s?', $ns));
		$templater->set_I18n('bulk_cancel_in_progress', __('Bulk Cancel Plan on %s in progress.', $ns));
		$templater->to_json('bulk_cancel_data', wpal_ecomm()->settings->get_option('bulk_cancel'));
		$timezone = wp_timezone_string();
		$timezone_object = new DateTimeZone( $timezone );
		$offset = $timezone_object->getOffset( new DateTime( 'now' ) );
		$templater->to_json('timezone_data', [
			'sign'  => $offset < 0 ? "-" : "+",
			'value' => abs($offset),
			'zone'	=> $timezone
		]);
		$templater->to_json('bill_interval_max', $this->bill_interval_max);
    }

	
    
function save_product($post_id, $data, $post_type){

		$this->post_type = $post_type;
		$settings = $this->get_settings();
		$templater = wp_admin_templater::get_instance();
		$product_meta_prefix = wpal_ecomm_products::PRODUCT_META_PREFIX;

				$product_config = [];
		foreach ($settings as $key => $setting) {
			$slug = ( isset($setting['slug']) ) ? $setting['slug'] : false;
			$type = ( isset($setting['ui_only']) ) ? $setting['type'] : false;
			$ui_only = ( isset($setting['ui_only']) ) ? true : false;
			if( $slug && isset($data[$slug]) && $type != 'section' && !$ui_only ){
				$value = $templater->validate_sanitize($data[$slug], $setting);
				$product_config[$slug] = $value;
			}
		}

				$content = $product_config['product_description'];
		unset($product_config['product_description']);
		$excerpt = $product_config['product_excerpt'];
		unset($product_config['product_excerpt']);

				$product_type = isset($data['product_type']) ? $data['product_type'] : 'single';
		if( ! wpal_ecomm()->is_pro_install() ){
			$product_type = 'single';
		}
		update_post_meta($post_id,"{$product_meta_prefix}type",$product_type);

				$product_currency = isset($data['product_currency']) ? $data['product_currency'] : wpal_ecomm()->settings->get_option('default_currency');
		update_post_meta($post_id,"{$product_meta_prefix}currency",$product_currency);

				update_post_meta($post_id,"{$product_meta_prefix}config",$product_config);

				remove_action('save_post', ['wpal_ecomm_admin', 'save_post']);
				wp_update_post([
			'ID' 			=> $post_id,
			'post_content'	=> $content,
			'post_excerpt'  => $excerpt,
		]);
				add_action('save_post', ['wpal_ecomm_admin', 'save_post']);

		return;
	}

	
function get_plan_form($data_name, $post_id, $add_new = false){

		$ns = 'wpal_ecomm';

		$settings = [];

		$tab = $data_name;
		$section_name = "{$data_name}-section";
		$section = $section_name;
		$settings[] = [
			'slug'	=> $section,
			'title'	=> __('Admin',$ns),
			'type'	=> 'section',
			'tab'	=> $tab
		];

		$settings[] = [
			'slug'		=> 'plan_id',
			'type'		=> 'hidden',
			'default'	=> 0,
			'tab' 		=> $tab,
			'section'	=> $section
		];

		$settings[] = [
			'slug'		=> 'product_post_id',
			'type'		=> 'hidden',
			'default'	=> $post_id,
			'tab' 		=> $tab,
			'section'	=> $section
		];

		$settings[] = [
			'slug'		=> 'plan_name',
			'title'		=> __( 'Plan Name', $ns ),
			'type'		=> 'input',
			'tooltip'	=> __( 'Enter the name for this plan.', $ns ),
			'tab' 		=> $tab,
			'section'	=> $section,
		];

		$settings[] = [
			'slug'		=> 'plan_description',
			'title'		=> __( 'Description', $ns ),
			'type'		=> 'textarea',
			'tooltip'	=> __( 'Enter short description for this plan.', $ns ),
			'tab' 		=> $tab,
			'section'	=> $section,
					];

		$section = "{$section_name}-pricing";
		$settings[] = [
			'slug'	=> $section,
			'title'	=> __('Pricing',$ns),
			'type'	=> 'section',
			'tab'	=> $tab
		];

		$settings[] = [
			'slug'          => 'plan_currency',
			'title'         => __( 'Currency', $ns ),
			'tooltip'       => __( 'Select the currency for this plan\'s pricing.', $ns ),
			'type'          => 'select',
			'choices'		=> 'currencies',
			'default'		=> wpal_ecomm()->settings->get_option('default_currency'),
			'tab'           => $tab,
			'section'       => $section,
		];

		$settings[] = [
			'slug'		=> 'interval',
			'title'		=> __('Billing Intervals', $ns),
			'type'		=> 'select',
			'default'	=> 'month',
			'choices'	=> 'subscription_intervals',
			'search'	=> 'no',
			'tab' 		=> $tab,
			'section'	=> $section,
			'change'	=> 'billing_interval_change',
			'callback'	=> 'billing_interval_render'
		];

		$settings[] = [
			'slug'		=> 'bill_interval',
			'title'		=> __('Number of <span class="interval-amount-text">Interval</span>s between billing', $ns),
			'tooltip'   => __( 'Number of <span class="interval-amount-text">Interval</span>s between subscription billings. Example : Bill every 3 <span class="interval-amount-text">Interval</span>s. Maximum of one year interval allowed (1 year, 12 months, or 52 weeks).', $ns ),
			'type'		=> 'number',
			'default'	=> 1,
			'min'		=> 1,
			'tab' 		=> $tab,
			'section'	=> $section,
			'callback'	=> 'bill_interval_listener'
		];

		$settings[] = [
            'slug'          => 'interval_amount',
            'title'         => __( 'Billing Amount Per <span class="interval-amount-text">Interval</span>', $ns ),
            'tooltip'       => __( '', $ns ),
            'type'          => 'price',
            'default'       => 0.00,
            'min'			=> 0,
            'tab'           => $tab,
            'section'       => $section,
        ];

		$settings[] = [
			'slug'          => 'plan_end',
			'title'         => __( 'Subscription Ends', $ns ),
			'type'          => 'select',
			'choices'		=> 'subscription_ends',
			'default'		=> 'infinite',
			'search'		=> 'no',
			'tab'           => $tab,
			'section'       => $section,
			'change'		=> 'plan_ends_change',
			'callback'		=> 'plan_ends_render'
		];

		$settings[] = [
			'slug'		=> 'interval_count',
			'title'     => __( 'Number of <span class="interval-amount-text">Interval</span>s', $ns ),
			'type'		=> 'number',
			'default'	=> 1,
			'min'		=> 1,
			'tab' 		=> $tab,
			'section'	=> $section,
		];
		$today_ymd = $this->get_today_ymd();
		$settings[] = [
			'slug'		=> 'interval_date',
			'title'     => __( 'End Date', $ns ),
			'type'		=> 'datepicker',
			'default'	=> $today_ymd,
			'min'		=> $today_ymd,
			'tooltip'	=> __( 'Please use the YYYY-MM-DD format.', $ns ),
			'tab' 		=> $tab,
			'section'	=> $section,
		];

		$section = "{$section_name}-trial";
		$settings[] = [
			'slug'	=> $section,
			'title'	=> __('Trial Period',$ns),
			'type'	=> 'section',
			'tab'	=> $tab
		];

		$settings[] = [
			'slug'          => 'trial',
			'title'         => __( 'Has Trial Period', $ns ),
			'type'          => 'switch',
			'unlock'		=> ['trial_days'],
			'section'       => $section,
			'tab'           => $tab,
		];

		$settings[] = [
			'slug'          => 'trial_days',
			'title'         => __( 'Number of Days', $ns ),
			'tooltip'		=> __( 'Subscriptions to this plan will start with a free trial for this many days.', $ns),
			'type'          => 'number',
			'min'			=> 1,
			'default'		=> 1,
			'units'			=> __('Days',$ns),
			'section'       => $section,
			'tab'           => $tab,
		];

		$section = "{$section_name}-cancel";
		$settings[] = [
			'slug'	=> $section,
			'title'	=> __('Allow Customer to Cancel',$ns),
			'type'	=> 'section',
			'tab'	=> $tab
		];

		$settings[] = [
			'slug'          => 'allow_cancel',
			'title'         => __( 'Allow Cancel', $ns ),
			'type'          => 'switch',
			'default'		=> 0,
			'section'       => $section,
			'tab'           => $tab,
		];

		if( ! $add_new ){
			$section = "{$section_name}-bulk-cancel";
			$settings[] = [
				'slug'	=> $section,
				'title'	=> __('Bulk Cancel',$ns),
				'desc'	=> __( 'Set all active subscriptions using this plan to cancel on a specified date.', $ns) . '<br/></br/>',
				'type'	=> 'section',
				'tab'	=> $tab
			];

			$settings[] = [
				'slug'          => 'bulk_cancel',
				'title'         => __( 'Initiate Bulk Cancel', $ns ),
				'type'          => 'switch',
				'default'		=> 0,
				'section'       => $section,
				'unlock'		=> ['bulk_cancel_date'],
				'tab'           => $tab,
			];

									$settings[] = [
				'slug'		=> 'bulk_cancel_date',
				'title'     => __( 'Bulk Cancel Date', $ns ),
				'type'		=> 'datepicker',
				'default'	=> $today_ymd,
				'min'		=> $today_ymd,
				'tooltip'	=> __( 'Please use the YYYY-MM-DD format.<br><br><strong>Note:<strong> Customer will still have access until the end of the current period from the cancel date.', $ns ),
				'tab' 		=> $tab,
				'section'	=> $section,
			];
		}

		return $settings;
	}

	
function get_plan_table($data_name, $post_id){

		$ns = 'wpal_ecomm';

		return [
            'slug'			=> "{$data_name}-table",
			'data_name'		=> $data_name,
			'post_id'		=> $post_id,
            'table_attrs'	=> 	[
                [ 'prop' => 'class', 'value' => 'wp-list-table widefat fixed striped' ],
            ],
            'columns'		=>	[
				'plan_id'			=> __('ID', $ns),
				'plan_name'			=> __('Name', $ns),
				'plan_details'		=> __('Details', $ns),
            ],
			'hidden'		=> ['plan_id'],
			'row_id_prop'	=> 'plan_id',
			'row_name_prop'	=> 'plan_name',
            'rows'			=> $this->get_product_plan_rows($post_id),
			'row_actions'	=> [
                'plan_name'	=> [
                    'edit' 		=> __('Edit', $ns),
                    'delete' 	=> __('Delete', $ns),
                ],
            ],
            'I18n'			=> [
				'items'			=> __('Plans', $ns),
				'no_results'	=> __('No Plans', $ns),
            ],
            'data_filter'	=> "{$data_name}_table",
			'edit_form'		=> $this->get_plan_form($data_name, $post_id),
			'edit_filter'	=> "{$data_name}_edit"
        ];
	}

	
function get_product_plan_rows($post_id){
		if( empty($post_id) ){
			return [];
		}
		$plans = wpal_ecomm_data::get_product_plans($post_id);
		if( ! empty($plans) ){
			foreach ($plans as $key => $plan) {
								$plans[$key]['merchant_ids'] = wpal_ecomm()->subscriptions()->get_plan_properties($plan['id']);
				$plan_end = $plan['end'];
				if( $plan_end !== 'date' ){
					$plans[$key]['date'] = $this->get_today_ymd();
				}
			}
		}
		return $plans;
	}

		static 
function save_product_plans($data){

		$ns = 'wpal_ecomm';
				$updated = false;
		$message = __('Product Plan Not updated', $ns);
		$return  = false;

		if( ! wpal_ecomm()->is_pro_install() ){
			return [
				'success'	=> false,
				'message'	=> __('Subscription Products are a Pro feature.', $ns),
				'data'		=> $return
			];
		}

				$operation = $data['operation'];
		$data_name = $data['data_name'];

				$product_id = ( $operation === 'delete' ) ? $data['post_id'] : $data['product_post_id'];

				if( $operation === 'add_new' || $operation === 'edit' ){

			$parent_name = html_entity_decode(get_the_title($product_id));
			$plan_id = $data['plan_id'];
			$name = $data['plan_name'];
			$desc = $data['plan_description'];
			$currency = $data['plan_currency'];
			$date = $data['interval_date'];
			$interval = $data['interval'];
			$bill_interval = !empty($data['bill_interval']) ? (int)$data['bill_interval'] : 1;
			$bill_interval = ( $bill_interval > 0 ) ? $bill_interval : 1;
			$max_bill_interval = self::get_instance()->bill_interval_max[$interval];
			if( $bill_interval > 1 && $bill_interval > $max_bill_interval ){
				$message .= ' ' . __("Bill Interval Count must not exceed 1 year", $ns);
			}
			else {
				$config = [
					'name'				=> $name,
					'description'		=> $desc,
					'currency'			=> $currency,
					'interval'			=> $interval,
					'bill_interval'		=> $bill_interval,
					'billed_text'		=> wpal_ecomm_data::get_interval_billed_text($interval, $bill_interval),
					'amount'			=> $data['interval_amount'],
					'end'				=> $data['plan_end'],
					'count'				=> $data['interval_count'],
					'date'				=> $date,
					'timestamp'			=> strtotime($date),
					'trial'				=> (int)$data['trial'],
					'trial_days'		=> (int)$data['trial_days'],
					'allow_cancel'		=> (int)$data['allow_cancel']
				];

								$bulk_cancellation = false;
				$bulk_cancel = ( !empty($data['bulk_cancel']) ) ? (int)$data['bulk_cancel'] : 0;
				$cancel_date = ( !empty($data['bulk_cancel_date']) ) ? $data['bulk_cancel_date'] : false;
				if( $bulk_cancel > 0 && $cancel_date ){
					$cancel_date = new DateTime($cancel_date, new DateTimeZone(wp_timezone_string()));
					$cancel_timestamp = $cancel_date->format('U');
					$now = new DateTime( "midnight", new DateTimeZone(wp_timezone_string()) );
					$now_timestamp = $now->format('U');
					$future_date = ( $cancel_timestamp > $now_timestamp );
					$bulk_cancellations = wpal_ecomm()->settings->get_option('bulk_cancel');
					if( ! isset($bulk_cancellations[$plan_id]) ){
						$bulk_cancellation = true;
						$bulk_cancellations[$plan_id] = $cancel_timestamp;
						wpal_ecomm()->settings->set_option('bulk_cancel', $bulk_cancellations);
						wpal_ecomm()->settings->save();
						do_action('wpal/ecomm/bulk/cancel/subscription/plan', $plan_id, "{$parent_name} - {$name}", $cancel_timestamp, get_current_user_id());
					}
				}

				$plan_meta_prefix = wpal_ecomm_products::PLAN_META_PREFIX;
				$plan_args = [
		            'post_title'    => "{$parent_name} - {$name}",
		            'post_content'  => json_encode($config,JSON_HEX_APOS),
		            'post_type'     => wpal_ecomm()->get_config('products_slug'),
		            'post_parent'   => $product_id,
					'post_status'	=> 'publish',
		            'meta_input'    => [
		                "{$plan_meta_prefix}currency" => $currency,
	                ]
	            ];

								if( $operation === 'add_new' ){
					$verb = __('Added',$ns);
					$plan_id = wp_insert_post( $plan_args );
					$config['id'] = $plan_id;
					do_action('wpal/ecomm/product/plan/add', $plan_id, $product_id, $config);
				}
								else{
					$verb = __('Updated',$ns);
					$existing = wpal_ecomm_data::get_content_config($plan_id);
					$plan_args['ID'] = $plan_id;
					$config['id'] = $plan_id;
	                wp_update_post( $plan_args );
					do_action('wpal/ecomm/product/plan/edit', $plan_id, $product_id, $config, $existing);
				}
				$updated = true;
			}
		}
		else {
			if( $operation === 'delete' ){
				$plan_id = $data['row_id'];
				$existing = wpal_ecomm_data::get_content_config($plan_id);
				if( $existing ){
					$name = $existing['name'];
					$updated = true;
					$verb = __('Deleted',$ns);
					wp_delete_post($plan_id,true);
					do_action('wpal/ecomm/product/plan/deleted', $plan_id, $product_id, $existing);
				}
				else{
					$message = __('Plan not found. Please refresh the page and try again.', $ns);
				}
			}
		}

		if( $updated ){
			$message = $verb . ' ' . __('Product Plan',$ns) . ' ' . $name;
			if( $bulk_cancellation ){
				$message .= '<br/>' . sprintf(__( 'Existing subscriptions have been set to cancel on %s' ), $cancel_date->format('F j, Y') );
			}
			$return = [
				'list_table' => self::get_instance()->get_plan_table($data_name, $product_id)
			];
		}

		return [
			'success'	=> ( $updated ),
			'message'	=> $message,
			'data'		=> $return
		];

	}

	
	static 
function product_plan_edit($plan_id, $product_id, $config, $existing){

		$updated = [];
				$new_name = $config['name'];
		$new_trial = (int)$config['trial'];
		$new_trial_days = (int)$config['trial_days'];
				$existing_name = $existing['name'];
		$existing_trial = (int)$existing['trial'];
		$existing_trial_days = (int)$existing['trial_days'];
				if( $new_name != $existing_name ){
			$updated['name'] = $new_name;
		}
				$trial_days_changed = ( $new_trial_days != $existing_trial_days ) ? true : false;
				$toggled = ( $new_trial != $existing_trial ) ? true : false;

				if( $new_trial > 0 ){
						if( $trial_days_changed || $toggled ){
				$updated['trial_days'] = $new_trial_days;
			}
		}
				else if( $toggled ){
			$updated['trial_days'] = 0;
		}

				if( ! empty($updated) ){
						$properties = wpal_ecomm()->subscriptions()->get_plan_properties($plan_id);
			if( $properties > '' ){
				$profiles = [];
								foreach ($properties as $id => $property) {
					$profile_id = $property['profile_id'];
					$property_id = $property['property_id'];
					if( ! array_key_exists($profile_id, $profiles) ){
						$profiles[$profile_id] = [];
					}
					if( ! in_array($property_id, $profiles[$profile_id]) ){
						$profiles[$profile_id][] = $property_id;
					}
				}
								foreach ($profiles as $profile_id => $property_ids) {
					$profile = wpal_ecomm()->settings->get_merchant_profile($profile_id);
					if($profile){
						$merchant = $profile['method'];
						$merchant_class = wpal_ecomm()->get_merchant($merchant);
						if( ! empty($property_ids) ){
							add_filter("wpal/ecomm/product/plan/edit/{$merchant}", [$merchant_class->subscriptions(), 'updated_plan'], 10, 4 );
							foreach ($property_ids as $property_id) {
								$updated_plan = apply_filters("wpal/ecomm/product/plan/edit/{$merchant}", $profile, $plan_id, $property_id, $updated);
							}
						}

					}
				}
			}
		}
	}

	
function get_today_ymd(){
		if( ! $this->today_ymd ){
			$today = new DateTime('now', new DateTimeZone(wp_timezone_string()));
			$this->today_ymd = $today->format('Y-m-d');
		}
		return $this->today_ymd;
	}

        public static 
function get_instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
