<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}



if (! class_exists('wpal_ecomm_admin')) {

	
class wpal_ecomm_admin {

				public static $footer_json = [];
				public static $I18n = [];

				private $templater;
				private $templater_hooks = [];
		private $templater_post_types = [];
				private $post_type_pages = ['post.php','post-new.php'];
		private $reports_hook;

		
function __construct() {
			add_action('init', [$this, 'init']);
		}

		
function init() {

			if (current_user_can('manage_options')) {
								add_action('admin_menu', [$this, 'admin_menu']);
				add_action('admin_init', [$this, 'admin_init']);
				add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
			}

						add_action('pre_get_comments', ['wpal_ecomm_order_logs', 'comment_queries_filter'], 10, 1);
									add_action('comment_feed_where', ['wpal_ecomm_order_logs', 'comment_feed_filter'], 10, 2 );

						add_action('after_switch_theme', function(){ wpal_ecomm()->reset_flushed_rewrites(); });
			add_action('load-options-permalink.php', [$this, 'manage_rewrite_flag']);

		}

		
function admin_init(){

						add_action('edit_form_after_title', [$this, 'edit_form_after_title']);
			add_action('save_post', [__CLASS__, 'save_post'], 10, 3);
			add_action('trashed_post', [__CLASS__,'force_delete_orders']);
			add_action('admin_notices', [$this, 'admin_notifications']);

						add_filter('wp/admin/templater/settings/choices/countries',['wpal_ecomm_data','countries_data']);
			add_filter('wp/admin/templater/settings/choices/currencies',['wpal_ecomm_data','currencies_data']);
			add_filter('wp/admin/templater/settings/choices/payment_methods',['wpal_ecomm_data','payment_methods_select_data']);
			add_filter('wp/admin/templater/settings/choices/active_payment_methods',['wpal_ecomm_data','active_payment_methods_select_data']);
						add_filter('wp/admin/templater/settings/choices/product_types',['wpal_ecomm_data','product_types_select_data']);
			add_filter('wp/admin/templater/settings/choices/subscription_intervals',['wpal_ecomm_data','subscription_intervals']);
			add_filter('wp/admin/templater/settings/choices/subscription_ends',['wpal_ecomm_data','subscription_ends']);
						add_action('wpal/ecomm/product/plan/edit', ['wpal_ecomm_product_screen', 'product_plan_edit'], 10, 4);
						add_filter('wp/admin/templater/settings/choices/wpal_ecomm_products',['wpal_ecomm_data','products_select_data']);
			add_filter('wp/admin/templater/settings/choices/wpal_ecomm_merchants',['wpal_ecomm_data','merchants_select_data']);
			add_filter('wp/admin/templater/settings/choices/thankyou_types',['wpal_ecomm_data','thankyou_types_select_data']);
						add_filter('wp/admin/templater/settings/choices/wpal_ecomm_order_status',['wpal_ecomm_data','order_status_select_data']);
			add_filter('wp/admin/templater/settings/choices/wpal_ecomm_subscription_status',['wpal_ecomm_data','subscription_status_select_data']);
						add_filter('parent_file', [$this,'active_submenus']);
			add_filter('enter_title_here',[$this,'post_type_title_text'], 10, 2 );
			add_filter('wp_editor_settings', [$this,'wp_editor_settings']);

			global $pagenow;
			$post_type = isset($_GET['post_type']) ? $_GET['post_type'] : false;
			$post_types = wpal_ecomm()->get_config('post_type_slugs');
			$orders_slug = wpal_ecomm()->get_config('orders_slug');

			if( $pagenow === 'post-new.php' || $pagenow === 'post.php' ){
				if( ! $post_type ){
					$post_id = isset($_GET['post']) ? (int)$_GET['post'] : 0;
					$post_type = ( $post_id > 0 ) ? get_post_type($post_id) : false;
				}
			}

						if ($post_type === $orders_slug ) {
				global $wp_post_types;
				$wp_post_types[$orders_slug]->cap->create_posts = 'do_not_allow';
			}

						if( $pagenow == 'edit.php' && in_array($post_type, $post_types) ){
				$products_slug = wpal_ecomm()->get_config('products_slug');
				if( $post_type === $products_slug || $post_type === $orders_slug ){
					add_filter('parse_query', [$this, 'parents_admin_query'], 10, 1);
					add_filter('wp_count_posts', [$this, 'parent_posts_count_filter'], 10, 3);
				}
				if ($post_type === $orders_slug ) {
					wpal_ecomm_order_admin_list::add_hooks($post_type);
				}
				else{
					add_filter("views_edit-{$post_type}", [$this, 'view_edit_link_counts']);
				}
			}
		}

		
function admin_menu(){

			$ns = 'wpal_ecomm';
			$config = wpal_ecomm()->get_config();
			$I18n = $config['I18n'];

						$main_slug = $config['menu_slug'];
			$main_menu_url = "admin.php?{$main_slug}";
			$hook_prefix = sanitize_title_with_dashes($I18n['menu_name']);

			add_menu_page(
				'',
				$I18n['menu_name'],
				$config['permissions'],
				$main_menu_url,
				'',
				'dashicons-cart',
				$config['menu_position']
			);

						$has_custom_reports = !empty($config['report_page']);
						$settings_slug = $has_custom_reports ? $main_slug : 'memberiumpay-settings';
			$settings_hook = "{$hook_prefix}_page_";
			$settings_hook .= $has_custom_reports ? $main_slug : 'memberiumpay-settings';
			$settings_pos = $has_custom_reports ? 1 : 2;
			$this->templater_hooks[] = $settings_hook;

						if( ! $has_custom_reports ){
				$report_hook = add_submenu_page(
					$main_menu_url,
					"{$I18n['menu_name']} " . __('Reports', $ns),
					__('Reports', $ns),
					$config['permissions'],
					$main_slug,
					['wpal_ecomm_reports_screen', 'init'],
					1
				);
				$this->reports_hook = $report_hook;
			}
			else{
				$this->reports_hook = $config['report_page'];
			}

						add_submenu_page(
				$main_menu_url,
				"{$I18n['menu_name']} " . __('Settings', $ns),
				__('Settings', $ns),
				$config['permissions'],
				$settings_slug,
				['wpal_ecomm_settings_screen', 'init'],
				$settings_pos
			);

						foreach ($config['post_types'] as $slug) {
				add_submenu_page(
					$main_menu_url,
					$config[$slug.'_name'],
					$config[$slug.'_name'],
					$config['permissions'],
					"edit.php?post_type={$config[$slug.'_slug']}",
					NULL
				);
				$this->templater_post_types[$config[$slug.'_slug']] = $this->post_type_pages;
			}

						remove_submenu_page($main_menu_url,$main_menu_url);
		}

		
		
function enqueue_scripts( $hook ){

			$enqueue_scripts = false;
			$post_type = isset($_GET['post_type']) ? $_GET['post_type'] : false;
			$enqueue_styles = false;
			if( $hook === 'edit.php' && $post_type ){
				$enqueue_styles = $post_type === wpal_ecomm()->get_config('orders_slug');
			}

						if( in_array($hook, $this->post_type_pages) ){
				if( ! $post_type ){
					$post_id = isset($_GET['post']) ? (int)$_GET['post'] : 0;
					$post_type = ( $post_id > 0 ) ? get_post_type($post_id) : false;
				}

				if( $post_type && array_key_exists($post_type, $this->templater_post_types) ){
					$enqueue_scripts = true;
					$enqueue_styles = true;
					$this->templater()->register_post_types($this->templater_post_types);
				}
			}

						if( in_array($hook, $this->templater_hooks) ){
				$enqueue_scripts = true;
				$enqueue_styles = true;
				$this->templater()->register_hooks([$hook]);
			}

			$assets = wpal_ecomm()->get_config('assets_url');
			if($enqueue_scripts || $enqueue_styles){

				$v = WPAL_ECOMM_VERSION;
				$handle = 'wpal_ecomm';

				if( $enqueue_styles ){
					$url = $assets . 'admin-style.css';
					wp_enqueue_style($handle, $url, [], $v, 'all');
				}
				if( $enqueue_scripts ){
					if( $this->templater->is_registered_hook($hook) ){
			            $this->templater->set_script_handle($handle);
			            $this->templater->set_data_name('wpal_ecomm_data');
			            $dep = $this->templater->dependencies();
			            $url = $assets . 'admin.js';
			            wp_register_script($handle, $url, $dep, $v, 'all');
			        }
				}
			}

						if( !empty($this->reports_hook) && $this->reports_hook === $hook ){
				wp_enqueue_style('wpal_ecomm_reports', "{$assets}/reports.css", [], '1.0', 'all');
				wp_register_script('wpal_ecomm_chart_js', "https://cdn.jsdelivr.net/npm/chart.js@2.8.0", ['jquery'], "2.8.0", true );
			}
		}

		
		
function active_submenus($parent_file){

			global $submenu_file;
			$post_type = ( isset($_GET['post_type']) ) ? $_GET['post_type'] : false;
			if( !$post_type ){
				$action = ( isset($_GET['action']) ) ? $_GET['action'] : false;
				$get_post = ( isset($_GET['post']) ) ? (int)$_GET['post'] : 0;
				if($action === 'edit' && $get_post > 0){
					global $post;
					$post_type = ( is_object($post) ) ? $post->post_type : false;
				}
			}
			if( $post_type ){
				$config = wpal_ecomm()->get_config();
				if( in_array( $post_type, $config['post_type_slugs']) ){
					$parent_file = "admin.php?page={$config['menu_slug']}";
					$submenu_file = "edit.php?post_type={$post_type}";
				}
			}

			return $parent_file;
		}

		
		
function edit_form_after_title($post){

			$products_slug = wpal_ecomm()->get_config('products_slug');
			if( $post->post_type === $products_slug ){
				wpal_ecomm_product_screen::get_instance()->init($products_slug);
			}
			$order_form_slug = wpal_ecomm()->get_config('forms_slug');
			if( $post->post_type === $order_form_slug ){
				wpal_ecomm_order_form_screen::get_instance()->init($order_form_slug);
			}
			$orders_slug = wpal_ecomm()->get_config('orders_slug');
			if( $post->post_type === $orders_slug ){
				wpal_ecomm_order_screen::get_instance()->init($orders_slug);
			}

		}

		
		static 
function save_post($post_id, $post, $update){
			if ($post_id < 1) {
				return;
			}

			if ('auto-draft' == $post->post_status) {
				return ;
			}

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}

			$ns = 'wpal_ecomm';

						if( isset($_POST["{$ns}_product_nonce_field"])){
				if( ! wp_verify_nonce($_POST["{$ns}_product_nonce_field"],"{$ns}_product_action") ){
					if ( WPAL_ECOMM_DEBUG ) wpal_ecomm_debug::log( __FILE__, __FUNCTION__, __LINE__, "ERROR : Product Save Nonce Error" );
					return;
				}
				$product_post_type = wpal_ecomm()->get_config('products_slug');
				if( $post->post_type === $product_post_type ){
					wpal_ecomm_product_screen::get_instance()->save_product($post_id, $_POST, $product_post_type);
					return;
				}
			}

						if( isset($_POST["{$ns}_order_form_nonce_field"])){
				if( ! wp_verify_nonce($_POST["{$ns}_order_form_nonce_field"],"{$ns}_order_form_action") ){
					if ( WPAL_ECOMM_DEBUG ) wpal_ecomm_debug::log( __FILE__, __FUNCTION__, __LINE__, "ERROR : Order Form Save Nonce Error" );
					return;
				}
				$order_form_post_type = wpal_ecomm()->get_config('forms_slug');
				if( $post->post_type === $order_form_post_type ){
					wpal_ecomm_order_form_screen::get_instance()->save_order_form($post_id, $_POST, $order_form_post_type);
					return;
				}
			}

						if( isset($_POST["{$ns}_order_nonce_field"])){
				if( ! wp_verify_nonce($_POST["{$ns}_order_nonce_field"],"{$ns}_order_action") ){
					if ( WPAL_ECOMM_DEBUG ) wpal_ecomm_debug::log( __FILE__, __FUNCTION__, __LINE__, "ERROR : Order Save Nonce Error" );
					return;
				}
				$order_post_type = wpal_ecomm()->get_config('orders_slug');
				if( $post->post_type === $order_post_type ){
					wpal_ecomm_order_screen::get_instance()->save_order($post_id, $_POST, $order_post_type);
					return;
				}
			}

			return;
		}

		static 
function force_delete_orders($order_id){
			$order_post_type = wpal_ecomm()->get_config('orders_slug');
			if (get_post_type($order_id) == $order_post_type) {
								$inoices = get_posts([
					'post_parent'	=> $order_id,
					'post_type'		=> $order_post_type
				]);
				if (is_array($inoices) && count($inoices) > 0) {
					foreach($inoices as $inoice){
						wp_delete_post($inoice->ID, true);
					}
				}
								wp_delete_post($order_id, true);
			}
		}

		
	    
function post_type_title_text( $title, $post ){

			if ( is_object($post) && ! empty($post->post_type) ) {
				$ns = 'wpal_ecomm';
				$post_types = wpal_ecomm()->get_config('post_type_slugs');
				if( in_array( $post->post_type, $post_types ) ){
					if( $post->post_type === WPAL_ECOMM_PREFIX . '_products' ){
						$title = __( 'Product Name', $ns );
					}
					if( $post->post_type === WPAL_ECOMM_PREFIX . '_order_forms' ){
						$title = __( 'Checkout Name', $ns );
					}
				}
			}

	        return $title;
	    }

		
		
function wp_editor_settings( $settings ){
			$current_screen = get_current_screen();
			$post_types = wpal_ecomm()->get_config('post_type_slugs');
						if ( ! $current_screen || ! in_array( $current_screen->post_type, $post_types, true ) ) {
				return $settings;
			}
			$settings['media_buttons'] = false;
			return $settings;
		}

		
	    
function parents_admin_query( $query ){
			$query->query_vars['post_parent'] = 0;
	        return $query;
	    }

		
		
function view_edit_link_counts( $views ){

			if( !empty($views['mine']) ){
				global $post_type_object, $wpdb;
				$post_type = $post_type_object->name;
				$exclude_states = get_post_stati(['show_in_admin_all_list' => false]);
				$current_user_id = get_current_user_id();
				$user_posts_count = (int) $wpdb->get_var(
					$wpdb->prepare("SELECT COUNT( 1 ) FROM $wpdb->posts
						WHERE post_type = %s
						AND post_status NOT IN ( '" . implode( "','", $exclude_states ) . "' )
						AND post_author = %d
						AND post_parent = 0",
					$post_type,
					$current_user_id
				) );

	            $views['mine'] = sprintf('<a href="%s" class="%s">Mine <span class="count">(%d)</span></a>',
	                admin_url("edit.php?author={$current_user_id}&post_type={$post_type}"),
					( isset( $_GET['author'] ) && ( $_GET['author'] == $current_user_id ) ) ? 'current' : '',
	                $user_posts_count
				);
			}
			return $views;
		}

		
	    
function parent_posts_count_filter( $counts, $type, $perm ){

	        			$products_slug = wpal_ecomm()->get_config('products_slug');
			$orders_slug = wpal_ecomm()->get_config('orders_slug');

	        if ( ! is_admin() || ( ! in_array($type, [$products_slug,$orders_slug]) ) ) {
	            return $counts;
	        }

	        	        global $wpdb;
	        $query = "SELECT post_status,
	        	COUNT( * ) AS num_posts
	        	FROM {$wpdb->posts}
	        	WHERE post_type = %s
	        	AND post_parent = 0
	        	GROUP BY post_status";
	        $results = $wpdb->get_results( $wpdb->prepare( $query, $type ), ARRAY_A );
	        $counts = array_fill_keys( get_post_stati(), 0 );
	        foreach ( $results as $row ) {
	            $counts[ $row['post_status'] ] = $row['num_posts'];
	        }
	        return (object) $counts;
	    }

				static 
function before_delete_wpal_ecomm_post( $post_id, $post ){
			$products_slug = wpal_ecomm()->get_config('products_slug');
			$orders_slug = wpal_ecomm()->get_config('orders_slug');
			$post_type = $post->post_type;
			$parent_id = $post->post_parent;
			if( $parent_id > 0 ){
				return;
			}
			if( ! in_array($post_type, [ $products_slug, $orders_slug ]) ){
				return;
			}
						global $wpdb;
			$sql = "SELECT ID FROM `{$wpdb->prefix}posts`";
			$sql.= " WHERE post_parent = '{$post_id}' AND post_type='{$post_type}'";
			$children = $wpdb->get_results($sql);
			if( !empty($children) ){
				$key = ( $post_type === $products_slug ) ? "product/plan" : "order/invoice";
				remove_action("delete_post", ["wpal_ecomm_admin", "before_delete_wpal_ecomm_post"], 10);
				foreach($children as $child){
					$existing = wpal_ecomm_data::get_content_config($child->ID);
					wp_delete_post($child->ID, true);
					do_action("wpal/ecomm/{$key}/deleted", $child->ID, $post_id, $existing);
				}
				add_action("delete_post", ["wpal_ecomm_admin", "before_delete_wpal_ecomm_post"], 10, 2);
			}
			return;
		}

				
function admin_notifications(){
			$user_id = get_current_user_id();
			$key = "wpal/ecomm/admin/{$user_id}";
			$notice = get_transient($key);
			if( ! $notice ){
				return;
			}
			$class = !empty($notice['class']) ? $notice['class'] : '';
			$message = !empty($notice['message']) ? $notice['message'] : false;
			if( $message ){
				printf( '<div class="%1$s"><p>%2$s</p></div>', $class, esc_html( $message ) );
			}
			delete_transient($key);
		}

				
function manage_rewrite_flag(){
			if ( isset( $_POST['permalink_structure'] ) || isset( $_POST['category_base'] ) ) {
				wpal_ecomm()->reset_flushed_rewrites();
			}
		}

				
function templater(){
			if( is_null($this->templater) ){
				$this->templater = wp_admin_templater::get_instance();
			}
			return $this->templater;
		}

	}
}
