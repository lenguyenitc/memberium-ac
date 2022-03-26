<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}



class wpal_ecomm_frontend {

		public static $footer_json = [];
		public static $I18n = [];
		private $settings;
		private $to_json = [];
		private $script_handle = 'wpal_ecomm';
		private $shortcode_map;
		private $loaded_tmpls = [];
		private $account_pages = [];

	
function __construct() {
		add_action('init', [$this, 'init_frontend']);
	}

	
	
function init_frontend() {

		$shortcode_prefix = wpal_ecomm()->get_config('shortcode_prefix');
		$this->shortcode_map = [
			"{$shortcode_prefix}_order_form" => "wpal_ecomm_order_form",
			"{$shortcode_prefix}_my_account" => "wpal_ecomm_my_account",
			"{$shortcode_prefix}_update_cc_form" => "wpal_ecomm_update_cc_form",
		];

		$this->account_pages = apply_filters('wpal/ecomm/my/account/pages', [
			'contact'		=> __('Contact Details', 'wpal_ecomm'),
			'billing'		=> __('Billing Details', 'wpal_ecomm'),
			'subscriptions'	=> __('Subscriptions', 'wpal_ecomm'),
			'orders'		=> __('Orders', 'wpal_ecomm'),
			'password'		=> __('Password', 'wpal_ecomm'),
			'logout'		=> __('Logout', 'wpal_ecomm')
		] );

		$this->settings = wpal_ecomm()->settings;
		$this->actions();
		$this->shortcodes();
		$this->filters();
		$this->rewrites();
	}

	
	
function filters(){

		add_filter('widget_comments_args', ['wpal_ecomm_order_logs', 'filter_comment_widget'], PHP_INT_MAX, 2);
		add_action('template_redirect', [$this, 'catch_my_account_404'] );

	}

	
	
function actions() {

		add_action('wp_enqueue_scripts', [$this, 'frontend_scripts']);
		add_action('wp_footer', [$this, 'frontend_footer']);

	}

	
	
function rewrites(){
		foreach ($this->account_pages as $slug => $label) {
			add_rewrite_endpoint( $slug, EP_PERMALINK | EP_PAGES );
		}
		if( ! $this->settings->get_option_bool('flushed_rewrites') ){
			flush_rewrite_rules();
			$this->settings->set_option('flushed_rewrites', 1);
		}
	}

	
function catch_my_account_404(){
		if( is_404() ){
			$is_account_slug = false;
			$request = trim( strtok($_SERVER['REQUEST_URI'], '?'), '/');
			$parts = array_reverse(explode('/',$request));
						if( (int)$parts[0] > 0 ){
				$account_slug = isset($parts[1]) ? $parts[1] : false;
				$is_account_slug = $account_slug && array_key_exists($account_slug, $this->account_pages);
			}
						else if( array_key_exists($parts[0], $this->account_pages) ){
				$is_account_slug = true;
			}
						if( $is_account_slug ){
				wpal_ecomm()->reset_flushed_rewrites();
				$protocol = is_ssl() ? 'https://' : 'http://';
				$url = "{$protocol}$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				wp_safe_redirect($url);
				exit;
			}
		}
		return false;
	}

	
function get_account_pages(){
		return $this->account_pages;
	}

	
	
function frontend_scripts() {

		$v = WPAL_ECOMM_VERSION;
		$assets = wpal_ecomm()->get_config('assets_url');
				$dep = [ 'jquery', 'wp-util', 'underscore' ];

				$url = "{$assets}micromodal.min.js";
		wp_register_script('micromodal', $url, [], '4.2', true);
		
		        $wpal_select_woo_js = apply_filters('wpalSelect2/js/src', '');
        wp_register_script('wpalSelect2',$wpal_select_woo_js,['jquery'],'1.0.4');
        $wpal_select_woo_css = apply_filters('wpalSelect2/css/src', '');
        wp_enqueue_style('wpalSelect2',$wpal_select_woo_css,false,'5.7.2');

		$flag_css = "{$assets}flag-icon.css";
		wp_register_style('flag-icon-css', $flag_css, [], $v, 'all');

		$url = "{$assets}frontend-scripts.js";
		wp_register_script($this->script_handle.'-js', $url, $dep, $v, true);
				$url = "{$assets}frontend-styles.css";
		wp_register_style($this->script_handle . '-css', $url, [], $v, 'all');
				wp_enqueue_style("{$this->script_handle}-css");
	}


	
	
function shortcodes(){

		foreach ($this->shortcode_map as $tag => $class) {
			add_shortcode($tag, [$this, "shortcode_mapping"]);
		}

	}

			
function shortcode_mapping( $atts, $content, $tag ){

		$html = '';

		if( isset($this->shortcode_map[$tag]) ){
			$class = $this->shortcode_map[$tag];
			if( class_exists($class) ){
				if( method_exists($class, 'get_instance') ){
					$instance = call_user_func( [$class, 'get_instance'] );
					$prefix = wpal_ecomm()->get_config('shortcode_prefix');
					$operation = str_replace("{$prefix}_", '', "{$tag}_func");
					if( method_exists($class, $operation) ){
						$html = call_user_func( [$instance, $operation], $atts, $content, $tag );
					}
				}
			}
		}

		return $html;
	}

	
	
function frontend_footer() {

		$json = $this->get_to_json();
		if( !empty($json)){

			$user_id = get_current_user_id();
			$json['user_id'] = $user_id;

			$order_forms = ( isset($json['order_forms']) ) ? $json['order_forms'] : false;
			$cleanse_param = ( isset($json['cleanse_param']) ) ? $json['cleanse_param'] : false;
			$my_account = ( isset($json['my_account']) ) ? $json['my_account'] : false;
			$update_cc = ( isset($json['update_cc']) ) ? $json['update_cc'] : false;

			if($order_forms){
								foreach ($json['order_forms'] as $id => $order_form) {
					$merchants = [];
					$cart = $order_form['cart'];
					$default_country = false;
										foreach ($order_form['merchants'] as $merchant => $profile) {
												$merchant_class = wpal_ecomm()->get_merchant( $merchant );
						if( $merchant_class ){
														$merchants[$merchant] = $merchant_class->order_form_config($profile, $cart, $user_id);
							$merchants[$merchant]['profile_id'] = $profile['profile_id'];
							if( ! $default_country ){
								$default_country = $merchants[$merchant]['base_location'];
							}
						}
					}
					$json['order_forms'][$id]['merchants'] = $merchants;
					$json['order_forms'][$id]['tmpls'] = $this->print_templates($order_form);
				}
			}

			if( $order_forms || $my_account ){
				$json['subscription_intervals_plural'] = wpal_ecomm_data::subscription_intervals_plural();
			}

			if( $order_forms || $cleanse_param || $my_account || $update_cc ){

				if($my_account){
					$json['my_account']['tmpls'] = $this->print_templates($my_account);
				}

				if( $update_cc ){
					foreach ( $update_cc as $key => $update_cc_config ) {
						$json['update_cc'][$key]['tmpls'] = $this->print_templates($update_cc_config);
					}
				}

				if( $order_forms || $my_account || $update_cc ){
										$json['currency_data'] = wpal_ecomm_data::$currencies;
					$json['country_region_data'] = wpal_ecomm_data::get_country_region_data();

										wp_enqueue_script("wpalSelect2");
					wp_enqueue_style("wpalSelect2");
										wp_enqueue_style("flag-icon-css");

										$json['ajax_url'] = admin_url('admin-ajax.php');
					$json['security'] = wp_create_nonce('wpal-ecomm-security-nonce');
										wp_enqueue_script("micromodal");
				}

								$json = apply_filters('wpal/ecomm/frontend/data', $json);
				wp_enqueue_script("{$this->script_handle}-js");
				wp_localize_script("{$this->script_handle}-js", 'wpal_ecomm_data', $json);

			}

		}

	}

	
	
function print_templates($config){
		$configured_tmpls = ( isset($config['tmpls']) ) ? $config['tmpls'] : [];
		$templates = apply_filters('wpal/ecomm/frontend/templates', $configured_tmpls, $config);
		$tmpls = [];
		if( ! empty($templates) ){
			foreach ( $templates as $key => $filename ) {
				$html = '';
				$include = $this->template_part_path( $filename, $config['theme'] );
				if( $include > '' ){
					$tmpls[] = "wpal_ecomm_{$key}";
					if( ! array_key_exists( "wpal_ecomm_{$key}", $this->loaded_tmpls ) ){
						echo "<script type=\"text/html\" id=\"tmpl-wpal_ecomm_{$key}\">";
							include $include;
							if( !empty($html) ){
								echo $html;
							}
						echo "</script>";
						$this->loaded_tmpls["wpal_ecomm_{$key}"] = true;
					}
				}
			}
		}

		return $tmpls;
	}

	
    
function template_part_path( $filename, $directory_name = '' ){

		$not_found = [];
		$directory_name = ( $directory_name > '' ) ? trailingslashit($directory_name) : '';
		$theme_dir = wpal_ecomm()->get_config('tmpl_theme_dir');
		$theme_template = "{$theme_dir}{$directory_name}{$filename}";

                $template = locate_template( $theme_template, false );
				if( ! is_file($template) ){
			$not_found['theme'] = $theme_template;

						$tmpl_plugin_path = wpal_ecomm()->get_config('tmpl_plugin_path');
						if( $tmpl_plugin_path != WPAL_ECOMM_TMPL_DIR ){
				$template = "{$tmpl_plugin_path}{$directory_name}{$filename}";
				if( ! is_file($template) ){
					$not_found['plugin'] = $template;
					$template = false;
				}
			}
						if( ! $template ){
				$template = WPAL_ECOMM_TMPL_DIR . $filename;
				if( ! is_file($template) ){
					$not_found['extension'] = $template;
					$template = false;
				}
			}
		}

		$template = apply_filters('wpal/ecomm/template/path', $template, $filename, $directory_name);
		if ( ! is_file($template) )	{
			if ( is_admin() ) {
				$notice = __('File not found in any of the following locations :', 'wpal_ecomm');
				$notice .= '<ul>';
				foreach ($not_found as $path) {
					$notice .= "<li>{$path}</li>";
				}
				$notice .= '</ul>';
				return $this->admin_error_msg($notice);
			}
			else{
				return false;
			}
		}
		else{
			return $template;
		}
	}

	
	
function set_to_json($key, $value = false) {

		if ($value) {
			$this->to_json[$key] = $value;
		}
		else {
			unset($this->to_json[$key]);
		}

	}

    
	
function get_to_json($key = false) {

		if ($key) {
			return (isset($this->to_json[$key])) ? $this->to_json[$key] : null;
		}
		else {
			return $this->to_json;
		}

	}

	
	public 
function admin_error_msg($msg){
		if( $msg > '' ){
			$permissions = wpal_ecomm()->get_config('permissions');
			if( current_user_can($permissions) ) {
				if( is_array($msg) ){
					$msg_array = $msg;
					if( count($msg) > 1 ){
						$msg = "<ul>";
						foreach ($msg_array as $error) {
							$msg .= "<li>{$error}</li>";
						}
						$msg .= "</ul>";
					}
					else {
						$msg = array_values($msg_array)[0];
					}
				}
				return "<div class=\"wpal-ecomm-error\">{$msg}</div>";
			}
		}
		return '';
	}

}
