<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}




class wpal_ecomm_merchant_profiles {

    static $instance = null;
	protected $profile_methods;

	    
function add_filters(){

		$this->profile_methods = wpal_ecomm()->settings->get_option('profile_methods');

		if( !empty($this->profile_methods) ){

			$ns = 'wpal_ecomm';
			$custom_reports = wpal_ecomm()->get_config('report_page');
			$setting_screen = ( isset($_GET['page']) ) ? $_GET['page'] : 'wpal_ecomm';

			foreach ( $this->profile_methods as $key => $profile ) {

				$method = $profile['method'];
				$method_class = wpal_ecomm()->get_merchant($method);

				if( $method_class ){

					$method_slug = $profile['method'];
					$profile_name = $profile['name'];
					$slug = $profile['slug'];
					$profile['key'] = $key;

										add_filter("wpal/ecomm/screen/{$setting_screen}/tabs", function( $tabs ) use( $slug, $profile_name, $method_slug  ) {
						$tabs[] = [
				            'slug'		=> $slug,
				            'label'		=> $profile_name,
				            'icon'		=> "dashicons wpal-ecomm {$method_slug}-icon",
							'save'		=> "profile_method",
							'delete'	=> "profile_method"
				        ];
						return $tabs;
					});
										add_filter("wpal/ecomm/screen/{$setting_screen}/settings", function( $settings ) use( $slug, $method_class, $profile ) {
						$settings = $method_class->admin()->settings( $slug, $settings, $profile );
						return $settings;
					});
	            }
			}
		}
    }

		static 
function generate_webhook_key(){

		$ns = 'wpal_ecomm';
		$profile_key = ( isset($_POST['profile_key']) ) ? $_POST['profile_key'] : false;
		$merchant = ( isset($_POST['merchant']) ) ? $_POST['merchant'] : false;
		$public = ( isset($_POST['public_key']) ) ? $_POST['public_key'] : false;
		$secret = ( isset($_POST['secret_key']) ) ? $_POST['secret_key'] : false;
		$sandbox = ( isset($_POST['sandbox']) && (int)$_POST['sandbox'] > 0 ) ? 1 : 0;
		$notice = [
			'type'			=> 'error',
			'title' 		=> __('Error',$ns),
			'content'		=> __('There has been an error.',$ns),
			'dismissable' 	=> __('Dismiss this notice.',$ns),
		];

		$method_class = wpal_ecomm()->get_merchant($merchant);
		if( $method_class ){
			$response = $method_class->admin()->generate_webhook_key($secret,$profile_key,$sandbox);
			$notice['content'] = $response['message'];
		}
		else {
			$response = ['success' => false];
			$notice['content'] .= " " . __("Unable to detect method.",$ns);
		}

		if( $response['success'] ){
			$notice['type'] = 'success';
			$notice['title'] = __('Success',$ns);
			wp_send_json_success( [
				'data'		=> $response['data'],
				'notice'	=> $notice,
				'merchant'	=> $merchant
			] );
		}
		else {
			wp_send_json_error( [
				'data'		=> $response['data'],
				'notice'	=> $notice,
			] );
		}
	}

        public static 
function get_instance() {

        if ( is_null( self::$instance ) ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

}
