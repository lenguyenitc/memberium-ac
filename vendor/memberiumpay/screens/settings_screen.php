<?php
/**
 * Copyright (C) 2017-2019 David Bullock
 * Web Power and Light, LLC
 */



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}


class wpal_ecomm_settings_screen {

	static $instance = null;

	protected $tabs  = [];
	protected $settings = [];
	protected $active_tab = 'general';
	protected $screen_slug = '';
	protected $data_name = 'wpal/ecomm/settings';
	protected $profile_data_name = 'profile_methods';
	protected $add_profile_text = '';

	
	static public 
function init() {
		self::get_instance()->setup();
	}

	
	
function setup(){

		$ns = 'wpal_ecomm';
		$this->screen_slug = ( isset($_GET['page']) ) ? $_GET['page'] : 'wpal_ecomm';
		$this->active_tab  = ( isset($_GET['tab']) ) ? $_GET['tab'] : $this->active_tab;
		$this->add_profile_text = __( 'Add Payment Profile', $ns );

				$active_payment_methods = wpal_ecomm()->settings->get_option_select('active_payment_methods');

				if( !empty($active_payment_methods) ){
			$profiles = wpal_ecomm_merchant_profiles::get_instance();
			$profiles->add_filters();
		}

		$this->tabs = $this->get_tabs();

		$this->settings = $this->get_settings();

		$this->settings = wp_admin_templater_data::setting_values($this->settings, wpal_ecomm()->settings->get_options());

		        $this->show();

		        $this->to_json();
	}


		
function get_tabs(){

        $ns = 'wpal_ecomm';
		$this->tabs = [
			[
				'slug'	=> 'general',
				'label'	=> __( 'General', $ns ),
				'icon'	=> 'dashicons dashicons-admin-generic',
				'save'	=> $this->data_name
			],
			[
				'slug'	=> 'order-forms',
				'label'	=> __( 'Order Forms', $ns ),
				'icon'	=> 'dashicons dashicons-cart',
				'save'	=> $this->data_name
			]
		];
		$this->tabs = apply_filters("wpal/ecomm/screen/{$this->screen_slug}/tabs", $this->tabs);

		return $this->tabs;

	}

		public 
function show() {

		$ns = 'wpal_ecomm';

		echo '<div class="wrap">';
			echo '<h2 class="inline">'. __( 'E-Commerce Options', $ns ). '</h2>';

						echo '<a id="'.$this->profile_data_name.'-toggle" href="#" class="page-title-action wpat-toggle-add-new-form" role="button" aria-expanded="false">';
				echo '<span class="upload">'. $this->add_profile_text  .'</span>';
			echo '</a>';
			echo '<div class="wpat_notice_wrap"></div>';
						echo '<div class="wpat-add-new-form-wrap" aria-hidden="true">';
				echo '<div class="wpat-add-new-form-wrap-inner">';
					echo '<form id="'.$this->profile_data_name.'-form" method="post" class="wpat-add-new-form">';
					echo '</form>';
				echo '</div>';
			echo '</div>';

			echo '<form class="wpat-admin-form" method="post" data-screen="'.$this->screen_slug.'">';

								echo '<div class="wpat_admin_table wpat_tabbed_table">';
					echo '<div class="wpat_option_tabs"></div>';
					echo '<div class="wpat_option_panels"></div>';
				echo '</div>';
			echo '</form>';

		echo '</div>';
	}

	    
function to_json(){
		$ns = 'wpal_ecomm';
		$templater = wp_admin_templater::get_instance();
		$templater->to_json( 'tab', $this->active_tab );
		$templater->to_json( 'settings', $this->settings );
		$templater->to_json( 'tabs', $this->tabs );
		$templater->to_json( 'settings_screen', 1 );
		$templater->to_json( 'page', 'settings' );

		$templater->to_json('add_new_form', [
			'slug'		=> $this->profile_data_name.'-form',
			'label'		=> $this->add_profile_text,
			'icon'		=> 'dashicons dashicons-index-card',
			'toggle'	=> $this->profile_data_name.'-toggle',
			'data_name'	=> $this->profile_data_name,
			'settings'	=> $this->get_method_profile_form(),
		]);

		$templater->to_json( 'I18n', [
			'open'	=> __('Open', $ns)
		] );
	}

	
	public 
function get_settings() {

		$ns = 'wpal_ecomm';

		$settings = [];

				$tab  = 'general';

				$section = 'general';
		$settings[] = [
			'slug'	=> $section,
			'title'	=> __( 'General', $ns ),
			'type'	=> 'section',
			'tab'	=> $tab
		];

		$settings[] = [
			'slug'          => 'base_location',
			'title'         => __( 'Base Location', $ns ),
			'tooltip'       => __( 'Base location for your order forms', $ns ),
			'type'          => 'select',
			'choices'		=> 'countries',
			'default'		=> wpal_ecomm()->settings->get_option('base_location'),
			'tab'           => $tab,
			'section'       => $section,
		];

		$settings[] = [
			'slug'          => 'descriptor',
			'title'         => __( 'Statement Descriptor', $ns ),
			'tooltip'       => __( 'Reflects your doing business as (DBA) name that your customers will see on their credit card statement.', $ns ),
			'type'          => 'input',
			'tab'           => $tab,
			'section'       => $section,
		];

				$section = 'currency-section';
		$settings[] = [
			'slug'	=> $section,
			'title'	=> __( 'Currency', $ns ),
			'type'	=> 'section',
			'tab'	=> $tab
		];

		$settings[] = [
			'slug'          => 'default_currency',
			'title'         => __( 'Default Currency', $ns ),
			'tooltip'       => __( 'Select a default currency for your order forms.', $ns ),
			'type'          => 'select',
			'choices'		=> 'currencies',
			'default'		=> wpal_ecomm()->settings->get_option('default_currency'),
			'tab'           => $tab,
			'section'       => $section,
		];

				$section = 'email-support';
		$settings[] = [
			'slug'	=> $section,
			'title'	=> __( 'Support Email', $ns ),
			'type'	=> 'section',
			'tab'	=> $tab
		];

		$settings[] = [
			'slug'          => 'support_email',
			'title'         => __( 'Support Email', $ns ),
			'tooltip'       => __( 'Support email to be used for automated messaging.', $ns ),
			'type'          => 'input',
			'default'		=> wpal_ecomm()->settings->get_support_email(),
			'tab'           => $tab,
			'section'       => $section,
		];

				$section = 'email-sender';
		$settings[] = [
			'slug'	=> $section,
			'title'	=> __( 'Email Sender', $ns ),
			'type'	=> 'section',
			'tab'	=> $tab
		];

		$settings[] = [
			'slug'          => 'sender_name',
			'title'         => __( 'Email From Name', $ns ),
			'tooltip'       => __( 'Emails will use this in the from header to improve deliverability.', $ns ),
			'type'          => 'input',
			'default'		=> 'Wordpress',
			'tab'           => $tab,
			'section'       => $section,
		];

		$settings[] = [
			'slug'          => 'sender_email',
			'title'         => __( 'Email From Address', $ns ),
			'tooltip'       => __( 'Emails will use this in the from header to improve deliverability.', $ns ),
			'desc'			=> __( 'Emails should be from the site domain.', $ns ),
			'type'          => 'input',
			'default'		=> wpal_ecomm()->settings->get_sender_email(),
			'tab'           => $tab,
			'section'       => $section,
		];

				$tab  = 'order-forms';

				$section = 'merchants-section';
		$settings[] = [
			'slug'	=> $section,
			'title'	=> __( 'Order Form Options', $ns ),
			'type'	=> 'section',
			'tab'	=> $tab
		];

		$settings[] = [
			'slug'    	=> 'active_payment_methods',
			'title'     => __( 'Available Merchants', $ns ),
			'tooltip'	=> __( 'Select the available merchant payment methods.', $ns ),
			'type'      => 'switch_group',
			'choices'	=> 'payment_methods',
			'default'	=> wpal_ecomm()->settings->get_option_select('active_payment_methods'),
			'tab'       => $tab,
			'section'   => $section,
		];

		$settings[] = [
			'slug'    	=> 'default_method',
			'title'     => __( 'Default Order Form Merchant', $ns ),
			'tooltip'	=> __( 'Select the default merchant payment method.', $ns ),
			'type'      => 'select',
			'search'	=> 'no',
			'choices'	=> 'active_payment_methods',
			'default'	=> wpal_ecomm()->settings->get_option('default_method'),
			'tab'       => $tab,
			'section'   => $section,
		];
		return apply_filters( "wpal/ecomm/screen/{$this->screen_slug}/settings", $settings );

	}

	
	
function get_method_profile_form(){

		$ns = 'wpal_ecomm';

		$settings = [];
		$key = 'profile_methods';
		$section = $key.'-section';
        $tab = $key;
        $settings[] = [
            'slug'	=> $section,
            'type'	=> 'section',
			'desc'	=> __( 'Profiles allow you to configure multiple payment method profiles to use with multiple accounts and configurations.', $ns ),
            'tab'	=> $tab
        ];

		$settings[] = [
			'slug'          => 'name',
			'title'         => __( 'Name', $ns ),
			'tooltip'       => __( 'Profile Name for admin purposes. Example if you have multiple Stripe accounts for different countries you could call your profile Stripe US, and another Stripe UK.', $ns ),
			'type'          => 'input',
			'required'		=> true,
			'tab'           => $tab,
			'section'       => $section,
			'validate'		=> 'unique'
		];

				$settings[] = [
			'slug'    	=> 'method',
			'title'     => __( 'Payment Method', $ns ),
			'tooltip'	=> __( 'Select the payment method to configure.', $ns ),
			'type'      => 'select',
			'choices'	=> 'active_payment_methods',
			'search'	=> 'no',
			'default'	=> wpal_ecomm()->settings->get_option('default_method'),
			'tab'       => $tab,
			'section'   => $section,
		];

		return $settings;
	}

	
	static 
function add_profile($data){

		$ns = 'wpal_ecomm';

		$updated = false;
		$return = false;
		$settings_key = 'profile_methods';
		$message = __('Profile has not been saved.',$ns);

		$operation = ( isset($data['operation']) ) ? $data['operation'] : false;

		if( $operation === 'add_new' ){

			$name = ( isset($data['name']) ) ? $data['name'] : '';
			$method = ( isset($data['method']) ) ? $data['method'] : '';
			if( ! $name > '' || ! $method > '' ){
				$message = __('You must provide both a name and payment method to create a profile.',$ns);
			}
			else {

								$profiles = wpal_ecomm()->settings->get_option($settings_key, []);

								$slug = sanitize_title($name.'-'.$method);
				$slug_key = array_search($slug, array_column($profiles, 'slug'));
				if( $slug_key !== false ){
										$message = __('Please provide a unique name for your profile.',$ns);
				}
				else{
										$default = [
						'name'		=> '',
						'slug'		=> '',
						'method'	=> '',
						'keys'		=> [],
						'webhooks'	=> [],
						'currency'	=> '',
						'location'	=> ''
					];
					$new = [
						'name'		=> $name,
						'method'	=> $method,
						'slug'		=> $slug,
					];
					$new_key = wpal_ecomm_data::get_unique_index($profiles);
					$profiles[$new_key] = wp_parse_args($new,$default);
					$profiles[$new_key]['key'] = $new_key;
					$updated = true;
					wpal_ecomm()->settings->set_option($settings_key, $profiles);
					$message = $name . ' ' . __('profile added.',$ns);
					$return = [ 'callback' => 'add_payment_profile', 'tab' => $slug ];
				}
			}
		}
		return [
			'success'	=> ( $updated ) ? true : false,
			'message'	=> $message,
			'data'		=> $return
		];
	}

	
	static 
function edit_profile($data){

		$ns = 'wpal_ecomm';
		$updated = false;
		$return = false;
		$setting_key = 'profile_methods';
		$message = __('Profile has not been saved.',$ns);

				$profiles = wpal_ecomm()->settings->get_option($setting_key, []);
		$operation = ( isset($data['operation']) ) ? $data['operation'] : false;
		$profile_slug = ( isset($data['tab']) ) ? $data['tab'] : false;
		
				if( $profile_slug || !empty($profiles)){
						$profile_key = wpal_ecomm_data::get_index_where( $profiles, 'slug', $profile_slug );
			if( ! $profile_key ){
												$message .= __('<br/> Please try refreshing the page and trying again.',$ns);
			}
			$existing = $profiles[$profile_key];
			$profile_name = $existing['name'];
			$profile_method = $existing['method'];

						if( $operation === 'delete' ){
												do_action( 'wpal/ecomm/profile/delete', $profile_key, $existing );

				unset($profiles[$profile_key]);
				$updated = true;
				wpal_ecomm()->settings->set_option($setting_key, $profiles);
				$message = $profile_name . ' ' . __('profile delete.',$ns);
				$return = [ 'callback' => 'delete_payment_profile' ];
			}
						else {

				$method_class = wpal_ecomm()->get_merchant($profile_method);
				$settings = $method_class->admin()->settings($profile_slug, [], $existing);
				$templater = wp_admin_templater::get_instance();
				$updated_profile = $existing;

				foreach ($settings as $s => $setting) {
	                $slug = $setting['slug'];
	                if( isset($data[$slug]) && !isset($setting['ui_only']) ){
						$clean_key = preg_replace('/^' . preg_quote("{$profile_slug}_", '/') . '/', '', $slug);
	                    $updated_profile[$clean_key] = $templater->validate_sanitize($data[$slug], $setting);
					}
	            }
				if( $updated_profile != $existing ){

					$validated = true;

										if( $updated_profile['name'] != $existing['name'] ){

												$new_slug = sanitize_title($updated_profile['name'].'-'.$profile_method);
						$new_slug_key = array_search($new_slug, array_column($profiles, 'slug'));
												if( $new_slug_key !== false ){
							$message = __('Please provide a unique name for your profile.',$ns);
							$validated = false;
						}
												else {
							$updated_profile['slug'] = $new_slug;
														$return = [ 'callback' => 'add_payment_profile', 'tab' => $new_slug ];
						}

					}
					if($validated){
						$updated = true;
						$profiles[$profile_key] = $updated_profile;
						wpal_ecomm()->settings->set_option($setting_key, $profiles);
						$message = $profile_name . ' ' . __('profile updated.',$ns);
					}
				}
				else {
					$message = __('No changes to profile',$ns) . ' ' . $profile_name;
				}
			}
		}
		return [
			'success'	=> ( $updated ) ? true : false,
			'message'	=> $message,
			'data'		=> $return
		];

	}

	
	static 
function save_settings($data){

		$ns = 'wpal_ecomm';

		$updated  = false;
		$return   = false;
        $settings = false;
        $message  = __('Settings have not been saved.',$ns);

				$profiles  = wpal_ecomm_merchant_profiles::get_instance();
        $settings  = self::get_instance()->get_settings();
		$merchants = wpal_ecomm()->settings->get_option_select('active_payment_methods');
		$default   = wpal_ecomm()->settings->get_option_select('default_method');

        if( $settings ){
            $templater         = wp_admin_templater::get_instance();
			$updated_merchants = [];
			foreach ($settings as $s => $setting) {
                $slug = $setting['slug'];
                if( isset($data[$slug]) && !isset($setting['ui_only']) ){
                    $value = $templater->validate_sanitize($data[$slug], $setting);
                    if ( $value !== null ) {
                        $updated = true;
                        $message = __('Settings have been updated.',$ns);
                        wpal_ecomm()->settings->set_option( $slug, $value );
						if( $slug === 'active_payment_methods' ){
							$merchants = $value;
						}
						if( $slug === 'default_method' ){
							$default = $value;
						}
					}
				}
            }
        }

		if( ! empty($merchants) ){
			$merchants = explode(',', trim($merchants, ',') );
			$first_merchant = ! empty($merchants[0]) ? $merchants[0] : false;
			if( $first_merchant && ( empty($default) || ! in_array($default, $merchants) ) ){
				$updated = true;
				wpal_ecomm()->settings->set_option( 'default_method', $first_merchant );
			}
		}

		if( $updated ){
			wpal_ecomm()->settings->save();
			$return = [
				'callback' => 'location_reload'
			];
		}

        return [
			'success'	=> ( $updated ) ? true : false,
			'message'	=> $message,
			'data'		=> $return
		];
	}

	
    public static 
function get_instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

}
