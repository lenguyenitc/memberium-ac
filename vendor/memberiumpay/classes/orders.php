<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}



class wpal_ecomm_orders {

	static $post_type;

    
    static 
function register(){

		$ns = 'wpal_ecomm';

		$slug = wpal_ecomm()->get_config('orders_slug');
		self::$post_type = $slug;

		$labels = apply_filters( "wpal/ecomm/{$slug}/labels", [
			'name'					=> _x('Orders','post type general name', $ns),
			'singular_name' 		=> _x('Order', 'post type singular name', $ns),
			'add_new' 				=> _x('Add New', 'Order', $ns),
			'add_new_item' 			=> __('Add New Order', $ns),
			'edit_item' 			=> __('Edit Order', $ns),
			'new_item' 				=> __('New Order', $ns),
			'view_item' 			=> __('View Order', $ns),
			'search_items' 			=> __('Search Orders', $ns),
			'not_found' 			=> __('Nothing found', $ns),
			'not_found_in_trash'	=> __('Nothing found in Trash', $ns),
		] );

		wpal_ecomm()->set_config('orders_name', $labels['name']);

		$args = [
			'labels' 				=> $labels,
			'public' 				=> false,
			'has_archive'         	=> false,
			'publicly_queryable' 	=> false,
			'show_ui' 				=> true,
			'show_in_menu'			=> false,
			'query_var' 			=> true,
			'capability_type' 		=> 'post',
			'hierarchical' 			=> false,
			'menu_position' 		=> null,
			'supports' 				=> false,
			'exclude_from_search' 	=> true,
			'register_meta_box_cb'	=> [__CLASS__,'meta_boxes']
		];
		register_post_type( $slug, $args );
    }

			
	static 
function meta_boxes( $post ){

		$post_type = self::$post_type;
		if( $post->post_type === $post_type ){

			$ns = 'wpal_ecomm';

						add_filter("get_user_option_meta-box-order_{$post_type}", function() use($post_type) {
				global $wp_meta_boxes;
												
				$wp_meta_boxes[$post_type] = [];
				return [];
			}, PHP_INT_MAX);
		}
	}

	static 
function get_all_orders_and_invoices(){
		$data = [];
		global $wpdb;
		$post_type = wpal_ecomm()->get_config('orders_slug');
		$sql = "SELECT DISTINCT ID, post_title, post_parent, post_content, post_date
			FROM {$wpdb->posts} product
			WHERE post_status = 'publish'
			AND post_type = '{$post_type}'
			ORDER BY CASE WHEN post_parent = 0 THEN ID ELSE post_parent END ASC,
			CASE WHEN post_parent = 0 THEN '0' ELSE post_title END ASC";
		$results = $wpdb->get_results($sql, ARRAY_A);
		if( $results ){
			$order_id = 0;
			foreach ($results as $index => $o) {
				$id = $o['ID'];
				$parent = $o['post_parent'];
				if( $parent > 0 ){
					$data[$order_id]['invoices'][] = $o;
				}
				else{
					$order_id = $id;
					$data[$id] = $o;
					$data[$id]['invoices'] = [];
				}
			}
			foreach ($data as $id => $d) {
				if( empty($d['invoices']) ){
					unset($data[$id]['invoices']);
				}
			}
			$data = array_values($data);
		}
		return $data;
	}

	static 
function get_orders($params = []) {
		$args       = [];
		$meta_args  = [];
		$date_query = [];
		$meta_prefix = wpal_ecomm()->functions()->get_prefix();

		$args['post_type']   = wpal_ecomm()->get_config('orders_slug');
		$args['post_status'] = 'publish';
		$args['nopaging']    = true;
		$args['orderby']     = 'ID';
		$args['post_parent'] = '%';
		$args['fields']      = 'ids';


		if (! empty($params['new_business_only'])) {
			$args['post_parent'] = 0;
		}

		
		$meta_args = false;
		if (! empty($params['meta_query']) ) {
			$meta_args[] = $params['meta_query'];
		}

		if (! empty($params['user_id']) ) {
			$meta_args[] = [
				'key'     => "{$meta_prefix}user_id",
				'compare' => '=',
				'value'   => $params['user_id'],
			];
		}

		if (! empty($params['product_id']) ) {
			$meta_args[] = [
				'key'     => "{$meta_prefix}product/id",
				'compare' => '=',
				'value'   => $params['product_id'],
			];
		}

		if(! empty($params['plan_id'])){
			$meta_args[] = [
				'key'     => "{$meta_prefix}plan/id",
				'compare' => '=',
				'value'   => $params['plan_id'],
			];
		}

		if(! empty($params['status'])){
			$status = $params['status'];
			$meta_args[] = [
				'key'     => "{$meta_prefix}status",
				'compare' => is_array($status) ? "IN" : "=",
				'value'   => $status,
			];
		}

		if( $meta_args && count($meta_args) > 1 ){
			if( !isset($meta_args['relation']) ){
				$meta_args['relation'] = 'AND';
			}
		}

		if (! empty($params['start_date']) ) {
			$date_query[] = ['after' => $params['start_date'] . ' 00:00:00'];
		}

		if (! empty($params['end_date']) ) {
			$date_query[] = ['before' => $params['end_date'] . '23:59:59'];
		}

		if (! empty($date_query)) {
			$date_query[] = ['inclusive' => true];
			$date_query[] = ['column'    => 'post_date'];
		}

		$args['meta_query'] = empty($meta_args) ? null : $meta_args;
		$args['date_query'] = empty($date_query) ? null : $date_query;

		$query = new wp_query($args);

		return $query->get_posts();
	}

	static 
function get_orders_by_payment_date($params = []){

		$new_only     = !empty($params['new_business_only']);
		$start_date   = !empty($params['start_date']) ? "{$params['start_date']} 00:00:00" : false;
		$end_date     = !empty($params['end_date']) ? "{$params['end_date']} 23:59:59" : false;
		$functions    = wpal_ecomm()->functions();
		$start_date   = $start_date ? self::get_query_timestamp( $start_date ) : false;
		$end_date     = $end_date ? self::get_query_timestamp( $end_date ) : false;
		$order_prefix = $functions->get_prefix();

		$order_query  = [
			'meta_query' =>	[
				'relation'  => 'AND',
				'ordertype' => [
					'key'     => "{$order_prefix}type",
					'compare' => "=",
					'value'   => 'single'
				],
				'orderstatus' => [
					'key'     => "{$order_prefix}status",
					'compare' => "=",
					'value'   => 'completed'
				]
			]
		];

		$invoice_query = [
			'meta_query' =>	[
				'relation'  => 'AND',
				'invoicetype' => [
					'key'     => "/wpal/ecomm/invoice/status",
					'compare' => "EXISTS"
				],
				'invoicepaid' => [
					'key'     => "_wpal/ecomm/payment/paid",
					'compare' => "EXISTS"
				]
			]
		];

				$date_query = false;
		if( $start_date || $end_date ){
			$date_query = ['type' => 'numeric'];
			if( $start_date && $end_date ){
				$date_query['value']   = [$start_date, $end_date];
				$date_query['compare'] = "BETWEEN";
			}
			else {
				$date_query['value']   = $start_date ? $start_date : $end_date;
				$date_query['compare'] = $start_date ? ">=" : "<=";
			}
		}
		if( $date_query ){
			$order_query['meta_query']['orderpayment']            = $date_query;
			$order_query['meta_query']['orderpayment']['key']     = "{$order_prefix}date_created";
			$invoice_query['meta_query']['invoicepayment']        = $date_query;
			$invoice_query['meta_query']['invoicepayment']['key'] = "_wpal/ecomm/payment/time";
		}

				if( $new_only ){
						$order_query['new_business_only'] = 1;
		}
		$orders = self::get_orders($order_query);

				if( ! $new_only ){
			$invoices = self::get_orders($invoice_query);
		}
				else{
			global $wpdb;
			$date_condition = "";
			if( $date_query['compare'] === 'BETWEEN' ){
				$date_condition = $wpdb->prepare("BETWEEN '%d' AND '%d' ", $start_date, $end_date );
			}
			else if($date_query['compare'] === '>=') {
				$date_condition = $wpdb->prepare(" >= '%d' ", $start_date );
			}
			else if($date_query['compare'] === '<='){
				$date_condition = $wpdb->prepare(" <= '%d' ", $end_date );
			}
						$sql = "SELECT `p`.`ID`, `p`.`post_parent`
				FROM `{$wpdb->posts}` AS p
				INNER JOIN `{$wpdb->postmeta}` AS `pm1` ON ( `p`.`ID` = `pm1`.`post_id` )
				INNER JOIN `{$wpdb->postmeta}` AS `pm2` ON ( `p`.`ID` = `pm2`.`post_id` )
				INNER JOIN `{$wpdb->postmeta}` AS `pm3` ON ( `p`.`ID` = `pm3`.`post_id` )
				WHERE `p`.`post_type` = 'wpal_ecomm_orders'
				AND `p`.`post_status` = 'publish'
				AND `pm1`.`meta_key` = '/wpal/ecomm/invoice/status'
				AND `pm2`.`meta_key` = '_wpal/ecomm/payment/paid'
				AND `pm3`.`meta_key` = '_wpal/ecomm/payment/time'
				AND CAST(`pm3`.`meta_value` AS SIGNED) {$date_condition}
				GROUP BY `p`.`ID`
				ORDER BY `p`.`ID` DESC";
			$results  = $wpdb->get_results($sql);
			$invoices = [];
			if( !empty($results) ){
								$results = wp_list_pluck($results, 'post_parent', 'ID');
				foreach ($results as $invoice_id => $parent_id) {
					$first_paid_id = $functions->get_first_paid_invoice_id($parent_id);
					if( (int)$first_paid_id === (int)$invoice_id ){
						$invoices[] = (int)$invoice_id;
					}
				}
			}
		}

		return array_merge($orders, $invoices);
	}

	static 
function get_query_timestamp( $date_string ){
		$date      = new DateTime($date_string);
		$timezone  = wp_timezone_string();
		$date->setTimezone(new DateTimeZone($timezone));
		$timestamp = $date->getTimestamp();
		$offset    = $date->getOffset();
		$negative  = $offset < 0;
		$offset    = abs($offset);
		return $negative ? $timestamp + $offset : $timestamp - $offset;
	}

}
