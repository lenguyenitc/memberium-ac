<?php
/*
Plugin Name: Memberium for ActiveCampaign
Plugin URI: https://www.memberium.com
Description: Provide membership site functions for WordPress.
Version: 1.192
Author: David Bullock
Author URI: https://www.webpowerandlight.com/
License: Copyright (c) 2016-2021 David Bullock
Text Domain: memberium
Requires at least: 5.7.2
Requires PHP: 7.0
*/



if (defined('ABSPATH') ) {
	if (! function_exists('memberium_app') ) {
		define('MEMBERIUM_HOME', __FILE__);
		define('MEMBERIUM_HOME_DIR', __DIR__ . '/');

		require_once MEMBERIUM_HOME_DIR . 'classes/core.php';

		
function memberium_app() {
			return m4ac_c6rqypiacz4::m4ac_zw_dhmca();
		}

		memberium_app();
	}
}
