<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}


final 
class wpal_ecomm_activation {

    private 
function __construct() {}

    public static 
function activate_extension(){

				if( wpal_ecomm()->settings->get_option_bool('extension_installed') ){
			self::update_database_table();
		}
		else{
			self::create_database_tables();
		}
    }

	private static 
function update_database_table() {
		global $wpdb;
		$prefix = wpal_ecomm()->get_config('database_prefix');
		$old_name = "{$wpdb->prefix}{$prefix}subscription_properties";
		if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $old_name ) ) === $old_name ) {
			$table_name = "{$wpdb->prefix}wpal_subscription_properties";
			$sql = "ALTER TABLE {$old_name} RENAME TO {$table_name}";
			$wpdb->query($sql);
			wpal_ecomm()->settings->set_option('ext_installed', 1);
			wpal_ecomm()->settings->set_option('extension_installed', 0);
		}
	}

    private static 
function create_database_tables() {

        global $wpdb;

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		$table_name = "{$wpdb->prefix}wpal_subscription_properties";

		$sql = "CREATE TABLE {$table_name} ( \n" .
			"id int(11) NOT NULL AUTO_INCREMENT, \n" .
			"product_id int(11) NOT NULL, \n" .
            "merchant_id varchar(8) NOT NULL, \n" .
            "property_id varchar(32) NOT NULL, \n" .
			"property_type varchar(7) NOT NULL, \n" .
            "active int(1) NOT NULL, \n" .
            "metadata longtext, \n" .
            "timestamp datetime NOT NULL DEFAULT '0000-00-00 00:00:00', \n" .
			"KEY property_id (property_id), \n" .
			"PRIMARY KEY  (id) \n" .
			") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

		dbDelta($sql);

		wpal_ecomm()->settings->set_option('extension_installed', 1);
    }

	public static 
function maintenance( $version ){
		if(version_compare($version, '1.0.12', '<=')){
			delete_option('wpal/ecomm/country_region_data');
			$crm_data = wpal_ecomm_data::get_country_region_data();
		}
		if(version_compare($version, '1.0.20', '<=')){
						wpal_ecomm()->settings->set_option('registered_payment_methods', 'stripe,paypal');
			wpal_ecomm()->settings->set_option('active_payment_methods', 'stripe,paypal');
		}
		if(version_compare($version, '1.2.6', '<=')){
			self::update_order_form_fields();
		}
		wpal_ecomm()->settings->set_option('maintained', WPAL_ECOMM_VERSION);
	}

	public static 
function update_order_form_fields(){

		$forms = new WP_Query([
			'post_type' 		=> wpal_ecomm()->get_config('forms_slug'),
			'fields'			=> 'ids',
			'posts_per_page' 	=> -1
		]);
		if( $forms->have_posts() ){
			foreach ($forms->posts as $id) {
				$metakey = "/wpal/ecomm/order/form/config";
				$config = get_post_meta($id, $metakey, true);
				if( empty($config) || array_key_exists('billing_email_enabled', $config) ){
					continue;
				}
								$settings = wpal_ecomm_order_form_screen::get_instance()->get_form_settings([]);
				foreach ($settings as $setting) {
					if( $setting['type'] === 'section' ){
						continue;
					}
					$config[$setting['slug']] = $setting['default'];
				}
				update_post_meta( $id, $metakey, $config );
			}
		}
	}

}
