<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}



class wpal_ecomm_ajax {

	static $instance = null;

	
function __construct() {}

	
function add_actions() {

				add_action('wp_ajax_wpat_ajax', ['wp_admin_templater_ajax', 'admin_ajax']);
				add_filter('wp/admin/templater/save/wpal/ecomm/settings', ['wpal_ecomm_settings_screen','save_settings']);
		add_filter('wp/admin/templater/save/profile_methods', ['wpal_ecomm_settings_screen','add_profile']);
		add_filter('wp/admin/templater/save/profile_method', ['wpal_ecomm_settings_screen','edit_profile']);
		add_filter('wp/admin/templater/save/wpal_ecomm_product_plans', ['wpal_ecomm_product_screen','save_product_plans']);
		add_filter('wp/admin/templater/save/wpal/ecomm/cancel/subscription', ['wpal_ecomm_order_screen','cancel_subscription']);

				add_action('wp_ajax_generate_webhook_key', ['wpal_ecomm_merchant_profiles', 'generate_webhook_key']);
				add_action('wp_ajax_wpal_ecomm_order_form_admin_data', ['wpal_ecomm_data', 'wpal_ecomm_order_form_admin_data']);

				add_action('wp_ajax_wpal_ecomm_process_order', ['wpal_ecomm_order', 'ajax_process']);
		add_action('wp_ajax_nopriv_wpal_ecomm_process_order', ['wpal_ecomm_order', 'ajax_process']);

		add_action('wp_ajax_wpal_ecomm_update_merchant_session', ['wpal_ecomm_order', 'ajax_process']);
		add_action('wp_ajax_nopriv_wpal_ecomm_update_merchant_session', ['wpal_ecomm_order', 'ajax_process']);

		add_action('wp_ajax_wpal_ecomm_create_user', ['wpal_ecomm_order', 'ajax_process']);
		add_action('wp_ajax_nopriv_wpal_ecomm_create_user', ['wpal_ecomm_order', 'ajax_process']);

		add_action('wp_ajax_wpal_ecomm_write_log', ['wpal_ecomm_debug', 'ajax_write_log']);
		add_action('wp_ajax_nopriv_wpal_ecomm_write_log', ['wpal_ecomm_debug', 'ajax_write_log']);

				add_action('wp_ajax_wpal_ecomm_account_update', ['wpal_ecomm_my_account', 'my_account_process']);

				add_action('wp_ajax_wpal_ecomm_update_cc', ['wpal_ecomm_update_cc_form', 'update_cc_process']);

	}

	    public static 
function get_instance() {

        if ( is_null( self::$instance ) ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

}
