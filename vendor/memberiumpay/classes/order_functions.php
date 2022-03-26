<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}



class wpal_ecomm_order_functions {
	const PREFIX = '/wpal/ecomm/order/';
	const INV_PREFIX = '/wpal/ecomm/invoice/';
	const FORM_PREFIX = '/wpal/ecomm/order/form/';

	public $comment_id = 'WPAL_Ecomm';

		
function get_prefix(){
		return self::PREFIX;
	}

		
function get_invoice_prefix(){
		return self::INV_PREFIX;
	}

		
function get_form_prefix(){
		return self::FORM_PREFIX;
	}

		
function order_form_config( $order_form_id ){
		$key = $this->get_form_prefix();
		return get_post_meta($order_form_id, "{$key}config", true);
	}

	
	
function get_order_id_by_meta( $key, $value ){

		global $wpdb;
		$tbl = $wpdb->prefix.'postmeta';
		$prepare_query = $wpdb->prepare(
			"SELECT post_id
			FROM 	$tbl
			WHERE 	meta_key = '%s'
			AND		meta_value = '%s'",
			$key,
			$value
		);
		$get_col = $wpdb->get_col( $prepare_query );
		return ( is_array($get_col) && isset($get_col[0]) ) ? $get_col[0] : 0;
	}

	
	
function get_order_user_id($order_id){

		$prefix = self::PREFIX;
		$user_id = (int)get_post_meta( $order_id, "{$prefix}user_id", true );
		if( $user_id < 1 ){
			$user_email = get_post_meta( $order_id, "billing_email", true );
			if($user_email > ''){
				$user = get_user_by('email', $user_email);
				if( $user ){
					$user_id = (int)$user->ID;
					$this->update_order_user_id($order_id, $user_id);
				}
			}
		}
		return $user_id;
	}

	
function get_order_user_email( $order_id, $user_id = 0 ){
		$user_id = (int)$user_id;
		$user_email = get_post_meta( $order_id, "billing_email", true );
		if( empty($user_email) ){
			if( $user_id < 1 ){
				$prefix = self::PREFIX;
				$user_id = (int)get_post_meta( $order_id, "{$prefix}user_id", true );
			}
			if( $user_id < 1 ){
				return '';
			}
			$user = get_user_by('id', $user_id);
			$user_email = ! empty($user) ? $user->user_email : '';
		}
		return empty($user_email) ? '' : $user_email;
	}

	
function get_order_payment_details($order_id){

		$prefix = self::PREFIX;
		$details = get_post_meta( $order_id, "{$prefix}payment_details", true );
		return ( $details ) ? $details : '';
	}

	
function get_order_payment_method_id($order_id){

		$prefix = self::PREFIX;
		$payment_method_id = get_post_meta( $order_id, "{$prefix}payment_method_id", true );
		return ( $payment_method_id ) ? $payment_method_id : '';
	}

	
function get_order_profile_id($order_id){
		$prefix = self::PREFIX;
		$profile_id = get_post_meta( $order_id, "{$prefix}profile_id", true );
		return ( $profile_id ) ? $profile_id : '';
	}

	
function get_order_merchant($order_id){
		$prefix = self::PREFIX;
		$merchant = get_post_meta( $order_id, "{$prefix}merchant", true );
		return ( $merchant ) ? $merchant : '';
	}

	
function get_order_subscription_id($order_id){
		$prefix = self::PREFIX;
		$subscription_id = get_post_meta( $order_id, "{$prefix}subscription_id", true );
		return ( $subscription_id ) ? $subscription_id : '';
	}

	
function get_order_product_id($order_id){
		$prefix = self::PREFIX;
		$product_id = get_post_meta( $order_id, "{$prefix}product/id", true );
		return ( $product_id ) ? $product_id : '';
	}

	
function get_order_plan_id($order_id){
		$prefix = self::PREFIX;
		$plan_id = get_post_meta( $order_id, "{$prefix}plan/id", true );
		return ( $plan_id ) ? $plan_id : '';
	}

		
function update_order_meta( $order_id = 0, $key, $value = false ){
		if( is_string($key) && $key > '' && $order_id > 0 ){
			$prefix = self::PREFIX;
			update_post_meta($order_id,"{$prefix}{$key}",$value);
		}
	}

		
function delete_order_meta( $order_id, $key ){
		if( is_string($key) && $key > '' && $order_id > 0 ){
			$prefix = self::PREFIX;
			delete_post_meta($order_id,"{$prefix}{$key}");
		}
	}

	
function get_order_meta_by_key( $order_id, $key ){
		$meta = false;
		if( is_string($key) && !empty($key) && $order_id > 0 ){
			$prefix = self::PREFIX;
			$meta = get_post_meta($order_id, "{$prefix}{$key}", true);
		}
		return $meta;
	}

	
function get_order_process_queue( $order_id ){
		$prefix = self::PREFIX;
		return get_post_meta( $order_id, "{$prefix}process/queue", true );
	}

	
function add_order_process_queue( $order_id, $queue, $user_id, $contact_id ){
		$this->update_order_meta($order_id, 'process/queue', $queue);
				if( defined('WPAL_ECOMM_QUEUE_LOG') && WPAL_ECOMM_QUEUE_LOG ){
			$queue['user_id'] = $user_id;
			$queue['order_id'] = $order_id;
			$queue['contact_id'] = $contact_id;
			$result = "Adding to Order Meta To Process";
			wpal_ecomm_debug::order_process_queue_log( __FUNCTION__, $queue, $result );
		}
	}

	
function delete_order_process_queue($order_id, $user_id){
		$this->delete_order_meta($order_id, 'process/queue');
		wpal_ecomm()->customer()->remove_order_id_from_user_process_queue($user_id, $order_id);
	}

		
function get_queued_order_ids( $user_id = 0, $meta_query = false ){
		$order_prefix = $this->get_prefix();
		if( ! $meta_query ){
			$meta_query = [
				[
					'key'		=> "{$order_prefix}process/queue",
					'compare'	=> 'EXISTS',
				]
			];
		}
		if( (int)$user_id > 0 ){
			$meta_query['relation'] = 'AND';
			$meta_query[] = [
				'key'	=> "{$order_prefix}user_id",
				'value'	=> $user_id
			];
		}
		$args = [
			'post_type' 		=> wpal_ecomm()->get_config('orders_slug'),
			'posts_per_page' 	=> -1,
			'post_status'		=> 'publish',
			'post_parent'		=> 0,
			'fields'        	=> 'ids',
			'meta_query'		=> $meta_query
		];
		$query = new WP_Query( $args );
		$order_ids = $query->posts;
		wp_reset_postdata();
		return $order_ids;
	}

	
function hourly_cron_orders_check(){
				$unprocessed_order_ids = $this->get_queued_order_ids();
        if( !empty($unprocessed_order_ids) ){
            foreach ($unprocessed_order_ids as $order_id) {
                $user_id = $this->get_order_user_id($order_id);
                if( $user_id > 0 ){
										if( user_can( $user_id, 'manage_options' ) ){
						$this->delete_order_process_queue($order_id, $user_id);
					}
					else{
						wpal_ecomm()->customer()->process_order_queue($user_id, $order_id, __FUNCTION__);
					}
                }
            }
        }
				$this->orders_maintenance_status_process( 'canceled' );
		$this->orders_maintenance_status_process( 'completed' );
		$this->orders_maintenance_status_process( 'cancel/on' );
	}

	
function orders_maintenance_status_process( $status ){

		$order_prefix = $this->get_prefix();
				$meta_query = [
			[
				'key'		=> "{$order_prefix}{$status}/process",
				'value'		=> time(),
				'compare'	=> '<=',
				'type'		=> 'NUMERIC'
			]
		];

		$orders_ids = $this->get_queued_order_ids( 0, $meta_query );
		if( !empty($orders_ids) ){
			foreach ($orders_ids as $order_id) {
				$user_id = $this->get_order_user_id($order_id);
				if( $user_id ){
					$profile_id = $this->get_order_profile_id($order_id);
					if( $status === 'canceled' ){
						do_action("wpal/ecomm/subscription/deleted", $order_id, $status, $profile_id );
					}
					else if( $status === 'cancel/on' ){
												$admin_id = get_post_meta($order_id, "{$order_prefix}{$status}/admin", true );
						wpal_ecomm()->subscriptions()->cancel_subscription_by_order_id($order_id, 0, $admin_id);
						$this->delete_order_meta($order_id, "{$status}/admin");
					}
					else {
						do_action("wpal/ecomm/subscription/{$status}", $order_id, $profile_id );
					}
				}
				if( $status != 'cancel/on' ){
					$this->update_order_status($order_id, $status);
				}
				$this->delete_order_meta($order_id, "{$status}/process");
			}
		}

	}

	
function manage_refund_meta( $post_id, $refund_id, $amount, $type, $time = false ){
		$time = ( $time ) ? $time : time();
		$prefix = wpal_ecomm()->get_meta_prefix();
		$type_prefix = ( $type === 'invoice' ) ? self::INV_PREFIX : self::PREFIX;
		update_post_meta( $post_id, "{$type_prefix}status", 'refunded' );
		update_post_meta( $post_id, "{$prefix}refunded/total", $amount );
		update_post_meta( $post_id, "{$prefix}refunded/time", $time );
		if( $refund_id ){
			update_post_meta( $post_id, "{$prefix}refunded/id", $refund_id );
		}
	}

	
function log_refund( $order_id, $transaction_id, $type, $amount, $currency, $link, $sandbox ){
		$currency = strtoupper($currency);
		$message = sprintf( __("Refunding %s%s %s for %s %s", 'wpal_ecomm' ),
			wpal_ecomm_data::get_currency_symbol_by_code($currency),
			$amount,
			$currency,
			$type,
			$link
		);
		$logs = wpal_ecomm_order_logs::get_instance();
		$log_meta = $logs->report_meta( $transaction_id, $amount, $sandbox );
		$logs->log_order_detail( $order_id, 'refunded', $message, $log_meta );
	}

	
	
function get_order_metadata($order_id){

		$meta = [];
		$prefix = self::PREFIX;
		$generic_prefix = wpal_ecomm()->get_meta_prefix();

		if( (int)$order_id > 0 ){
			$all_meta = get_post_meta($order_id);
						foreach ($all_meta as $key => $value) {
								if( (strpos($key, $prefix) === 0) ){
					$metakey = substr($key, strlen($prefix));
										if( $metakey === 'line/item' ){
						$items = [];
						foreach ($value as $i => $item) {
							$items[] = maybe_unserialize($item);
						}
												usort($items, function($a,$b){return $a['line']-$b['line'];});
						$meta['items'] = $items;
					}
					else {
						$meta[$metakey] = $value[0];
					}
				}
								else if( (strpos($key, 'billing_') === 0) ){
					$meta[$key] = $value[0];
				}
								else if( (strpos($key, $generic_prefix) === 0) ){
					$meta[$key] = $value[0];
				}
				else{
					$add = apply_filters( "wpal/ecomm/get/order/meta", false, $key, $value );
					if($add){
						$meta[$add['key']] = $add['value'];
					}
				}
			}
		}
		return apply_filters( "{$prefix}metadata", $meta );
	}

		
function prefixed_array( $data, $prefix ){
		return array_filter($data, function ($key) use($prefix) {
			return strpos($key, $prefix) === 0;
		}, ARRAY_FILTER_USE_KEY);
	}

	
	
function get_order_keys( $order_id, $action, $key = '' ){

		$keys = [];
		$meta = $this->get_order_metadata($order_id);

				$queue = !empty($meta["process/queue"]) ? $meta["process/queue"] : [];
		if( !empty($queue["keys"]) && $queue["action"] === $action ){
			return $queue["keys"];
		}

		$product_id = ( !empty($meta["product/id"]) ) ? (int)$meta["product/id"] : 0;
		if( $product_id > 0 ){
			$keys = wpal_ecomm_products::get_product_keys($product_id, $order_id);
		}

		if( $key > '' ){
			if ( is_string($key) ) {
				return ( isset($keys[$key]) ) ? $keys[$key] : false;
			}
			else {
				wp_die('Invalid Key ' . $key . " in ". __FUNCTION__ );
			}
		}
		else{
			return ( ! empty($keys) ) ? $keys : false;
		}

	}

	
function get_order_subscription_data($order_id, $posts_per = -1 ){

		$items = [];
		$query = new WP_Query( [
			'post_type' 		=> wpal_ecomm()->get_config('orders_slug'),
			'posts_per_page' 	=> $posts_per,
			'post_parent'		=> $order_id,
			'post_status'		=> 'publish',
			'orderby'			=> 'modified'
		] );
		if( $query->have_posts() ){
			foreach ($query->posts as $post) {
				$invoice = $this->get_invoice_data( $post );
				if( $invoice ){
					$items[] = $invoice;
				}
			}
		}

		return $items;
	}

	
	
function get_invoice_data( $post ){

		$post = ( is_object($post) ) ? $post : get_post($post);
		$post_id = $post->ID;

		$prefix = $this->get_invoice_prefix();
		$config = json_decode($post->post_content,true);
		$item = ( isset($config['items']) ) ? $config['items'][0] : false;
		if( $item ){
			$name = str_replace('u00d7','x',$item['name']);
			$totals = $config['totals'];
			return [
				'id'		=> $post_id,
				'title'		=> $post->post_title,
				'desc'		=> $name,
				'period'	=> $this->period_text($item['start'],$item['end']),
				'next'		=> wp_date('M j Y', strtotime('+1 day', $item['end'])),
				'status'	=> get_post_meta($post_id,"{$prefix}status",true),
				'total'		=> $this->price_display($totals['total'],$post->post_parent),
				'totals'	=> $totals,
				'items'		=> $config['items'],
				'created'	=> wp_date('M j Y, g:i a', $config['created']),
				'download'	=> ( isset($config['download']) ) ? $config['download'] : '',
				'view'		=> ( isset($config['view']) ) ? $config['view'] : '',
				'timestamp'	=> $config['created'],
				'modified'	=> $post->post_modified,
				'interval'	=> isset($config['interval']) ? $config['interval'] : ''
			];
		}
		else{
			return false;
		}

	}

		
function get_subscription_details( $order_id ){
		$details = '';
		if( (int)$order_id < 1 ){
			return $details;
		}
		global $wpdb;
		$tbl = $wpdb->prefix.'posts';
		$type = wpal_ecomm()->get_config('orders_slug');
		$sql = "SELECT `post_date`, `ID`, `post_content`
			FROM `{$tbl}`
			WHERE `post_parent` = %d
			AND `post_type` = %s
			ORDER BY `post_date` DESC
			LIMIT 1";
		$invoice = $wpdb->get_row($wpdb->prepare($sql, $order_id, $type));
		if( !empty($invoice) ){
			$config = json_decode($invoice->post_content,true);
			$item = isset($config['items']) ? $config['items'][0] : false;
			if($item){
				$details = str_replace('u00d7','x',$item['name']) . '<br/>';
				$details .= $this->period_text($item['start'],$item['end']);
			}
		}
		return $details;
	}

	
function get_first_invoice_id($order_id){
		global $wpdb;
		$sql = "SELECT `ID`
			FROM `{$wpdb->prefix}posts`
			WHERE `post_parent` = %d
			AND `post_type` = %s
			ORDER BY `post_date` ASC
			LIMIT 1";
		$id = $wpdb->get_var( $wpdb->prepare( $sql, $order_id, wpal_ecomm()->get_config('orders_slug') ) );
		return is_null($id) ? 0 : (int)$id;
	}

	
function get_first_paid_invoice_id($order_id){
		global $wpdb;
		$sql = "SELECT `ID`
			FROM `{$wpdb->posts}` AS `p`
			INNER JOIN `{$wpdb->postmeta}` AS `pm` ON ( `p`.`ID` = `pm`.`post_id` )
			WHERE `post_parent` = %d
			AND `post_type` = %s
			AND `pm`.`meta_key` = '_wpal/ecomm/payment/time'
			ORDER BY `post_date` ASC
			LIMIT 1";
			$id = $wpdb->get_var( $wpdb->prepare( $sql, $order_id, wpal_ecomm()->get_config('orders_slug') ) );
		return is_null($id) ? 0 : (int)$id;
	}

		
function get_order_details( $order_id ){
		$details = '';
		$meta = $this->get_order_metadata($order_id);
		$order_items = isset($meta['items']) ? $meta['items'] : [];
		if( count($order_items) < 1 ){
			return $details;
		}
		$i = 0;
		foreach ($order_items as $key => $item) {
			$details .= $i > 0 ? "<br/>" : "";
			$details .= "{$item['name']}";
			$i ++;
		}
		$total_title = __('Total');
		$details .=  "<br/><span class=\"wpal-ecomm-order-total-title\">{$total_title}</span>";
		$total = $this->price_display($meta['total'], $order_id);
		$details .=  " <span class=\"wpal-ecomm-order-total\">{$total}</span>";
		return $details;
	}

		
function price_display( $price, $order_id ){
		$currency = $this->get_order_currency($order_id, false);
		$code = $currency['code'];
		$symbol = $currency['symbol'];
		$price = $this->price_to_decimal($price);
		return "{$symbol}{$price} (<span class='currency'>{$code}</span>)";
	}

	
	
function update_order_status( $order_id, $status ){

		$prefix = self::PREFIX;
		$existing = get_post_meta( $order_id, "{$prefix}status", true );
				wp_update_post( [ 'ID' => $order_id ] );
		if( $existing != $status ){
			update_post_meta( $order_id, "{$prefix}status", $status );
			do_action( "{$prefix}update/status", $order_id, $status, $existing );
		}

	}

	
	
function update_order_user_id( $order_id, $user_id ){

		$prefix = self::PREFIX;
		update_post_meta( $order_id, "{$prefix}user_id", $user_id );

	}

	
	
function get_order_name($order_id){

		$order_name = get_the_title($order_id);
		if( $order_name === 'Auto Draft' ){
			$order_name = $this->generate_order_title($order_id);
		}
		return $order_name;
	}

	
	
function get_order_currency( $order_id, $type = false ){

		$return = false;
		$prefix = self::PREFIX;
		$currency = get_post_meta($order_id, "{$prefix}currency", true);
		$currency = ( ! $currency ) ? wpal_ecomm()->settings->get_option('default_currency') : $currency;
		if( $currency ){
			if( $type === 'symbol' || ! $type ){
				$symbol = wpal_ecomm_data::get_currency_symbol_by_code($currency);
			}
			if( ! $type ){
				$return = [
					'symbol'	=> $symbol,
					'code'		=> $currency
				];
			}
			else if( $type === 'symbol' ){
				$return = $symbol;
			}
			else if( $type === 'code' ){
				$return = $currency;
			}
		}
		return $return;
	}

		
function get_order_status( $order_id ){
		$prefix = self::PREFIX;
		return get_post_meta($order_id, "{$prefix}status", true);
	}

		
function get_order_status_text( $order_id = 0 ){
		$meta = is_array($order_id) ? $order_id : $this->get_order_metadata($order_id);
		$status = !empty($meta['status']) ? $meta['status'] : '';
		if( empty($status) ){
			return $status;
		}
		$type = ( isset($meta['type']) ) ? $meta['type'] : 'single';
		if( $type === 'subscription' ){
			if( $status === 'cancel-pending' ){
				$period_end = $this->formated_order_date($meta, 'current/period/end');
				return sprintf( __( 'Cancels on %s' ), $period_end );
			}
			else{
				$statuses = wpal_ecomm_data::subscription_status_select_data();
			}
		}
		else{
			$statuses = wpal_ecomm_data::order_status_select_data();
		}
		$index = array_search($status, array_column($statuses, 'id'));
		return $statuses[$index]['text'];
	}

	
function get_order_type( $order_id ){
		$prefix = self::PREFIX;
		return get_post_meta($order_id, "{$prefix}type", true);
	}

	
	
function generate_order_title($order_id, $full_name = '', $user_id = 0){

		$ns = 'wpal_ecomm';
		$full_name = '';
		$prefix = self::PREFIX;

		if( ! $full_name > '' ){

			$customer_id = ( (int)$user_id > 0 ) ? $user_id : get_post_meta($order_id, "{$prefix}user_id");
			if( (int)$customer_id > 0 ){
				$full_name = $this->generate_full_name($order_id, $customer_id);
			}
		}

				$sandbox_text = $this->sandbox_text($order_id);

		return trim($sandbox_text . __('Order #', $ns) . "{$order_id} {$full_name}");
	}

	
	
function generate_full_name($order_id, $user_id = 0){

		if( $user_id < 1 ){
			$meta_prefix = self::PREFIX;
			$user_id = get_post_meta($order_id, "{$meta_prefix}user_id");
		}
		$prefix = 'billing_';
		$first = get_post_meta($order_id, "{$prefix}first_name", true);
		$last = get_post_meta($order_id, "{$prefix}last_name", true);

		if( ! $first > '' || ! $last > '' ){

			$first = get_user_meta($user_id, "{$prefix}first_name", true);
			$last = get_user_meta($user_id, "{$prefix}last_name", true);

		}

		$full_name = ( $first && $first > '' ) ? "{$first} " : "";
		$full_name .= ( $last && $last > '' ) ? $last : "";

		return trim($full_name);
	}

	
	
function get_thankyou_config( $data ){

		$prefix = "wpal/ecomm/thankyou/";
		$order_id = $data['order_id'];
		$response = [
			'url'		=> '',
			'content'	=> ''
		];
		$url_params = ['order_id'];
		$type = $data['thankyou_type'];
		if( $type === 'page' ){
			$page_id = $data['thankyou_page'];
			$response['url'] = get_the_permalink($page_id);
		}
		else if( $type === 'url' ){
			$response['url'] = $data['thankyou_url'];
		}
		else if( $type === 'custom' ){
			$html = '<div class="wpal-ecomm-thanks">';
				$title = $data['thankyou_custom_title'];
				$inner = '<h2>'.$title.'</h2>';
				$inner .= '<div class="wpal-ecomm-thanks-content">';
					$inner .= $this->editor_content($data['thankyou_custom_content']);
				$inner .= '</div>';
				$html .= apply_filters("{$prefix}custom/content", $inner, $data);
			$html .= '</div>';
			$response['content'] = $html;
		}

		if( $response['url'] > '' ){
			if( (int) $data['pass_order_details'] > 0 ){
																$meta = $this->get_order_metadata($data['order_id']);
				$args = [
					'first_name' => $meta['billing_first_name'],
					'last_name' => $meta['billing_last_name'],
					'email'		=> $meta['billing_email'],
				];

								if( isset($meta['total']) && $meta['total'] > 0){
					$args['total'] = $meta['total'];
				}

				if( isset($meta['discount']) && $meta['discount'] > 0){
					$args['discount'] = $meta['discount'];
				}

				$args['order_id'] = $data['order_id'];
				$args = apply_filters("{$prefix}order/details", $args, $meta, $data);
				$response['url'] = add_query_arg($args, $response['url']);
			}
		}

		return $response;
	}

	
function editor_content( $content ){
		return do_shortcode(nl2br(html_entity_decode(stripslashes($content))));
	}


	
	
function is_sandbox_order($order_id){

		$prefix = self::PREFIX;
		$sandbox = get_post_meta($order_id, "{$prefix}sandbox", true);

		return ( (int)$sandbox > 0 );
	}

	
	
function sandbox_text($order_id){

		$sandbox_text = '';
		if($this->is_sandbox_order($order_id)){
			$sandbox_text = __('Sandbox', 'wpal_ecomm') . ' ';
		}

		return $sandbox_text;
	}

	
	
function transaction_link($url,$text){
		return sprintf('<a target="_blank" href="%s">%s</a>', $url, $text);
	}

		
function price_to_decimal($number){
		$round = round($number, 2, PHP_ROUND_HALF_UP);
		return number_format((float)$round, 2, '.', '');
	}

		
function price_to_cents( $amount ){
		$float = $this->price_to_decimal($amount);
		return $float * 100;
	}

		
function cents_to_dollar( $cents ){
		return number_format(($cents /100), 2, '.', '');
	}

	
function period_text($start, $end){

		$start_month_day =  wp_date('M j', $start);
		$start_year =  wp_date('Y', $start);
		$end_month_day =  wp_date('M j', $end);
		$end_year =  wp_date('Y', $end);

		$text = "{$start_month_day} ";
				$text .= ( $start_year != $end_year ) ? $start_year : "";
		$text .= "- ";
		$text .= "{$end_month_day} {$end_year}";
		return $text;
	}

		
function totalsI18n( $filter = '' ){
		return apply_filters( 'wpal/ecomm/labels/totals', [
			'subtotal'	=> __('Subtotal', 'wpal_ecomm'),
			'tax'		=> __('Tax', 'wpal_ecomm'),
			'discount'	=> __('Discount', 'wpal_ecomm'),
			'total'		=> __('Total', 'wpal_ecomm'),
			'due_today'	=> __('Due Today', 'wpal_ecomm'),
			'next_due'	=> __('Due %s', 'wpal_ecomm'),
			'next_bill'	=> __('Next Bill Date : <span class="next-bill-date">%s</span>', 'wpal_ecomm')
		], $filter );
	}

		
function formated_order_date( $order_id, $key, $format = 'M j Y' ){
		$meta = is_array($order_id) ? $order_id : $this->get_order_metadata($order_id);
		if( !empty($meta[$key]) ){
			return wp_date($format,$meta[$key]);
		}
		else{
			return '';
		}
	}

	
	
function get_next_date( $interval, $interval_count = 1, $from_date = false, $format = false, $wp_timezone = true ){
		return $this->get_interval_date($interval, $interval_count, $from_date, true, $format, $wp_timezone);
	}

	
function get_previous_date( $interval, $interval_count = 1, $from_date = false, $format = false, $wp_timezone = true ){
		return $this->get_interval_date($interval, $interval_count, $from_date, false, $format, $wp_timezone);
	}

	
function get_interval_date( $interval, $interval_count = 1, $from_date = false, $next = true, $format = false, $wp_timezone = true ){
		$interval_string = '';
		if( (int)$interval > 0 ){
			$interval_string = "P{$interval}D";
		}
		else if( in_array( $interval, ['year','month','week','day']) ){
			$type = strtoupper($interval[0]);
			$interval_string = "P{$interval_count}{$type}";
		}
		if( empty($interval_string) ){
			return '';
		}
		$date = ($from_date) ? new DateTime($from_date) : new DateTime();
		$timezone = ( $wp_timezone ) ? wp_timezone_string() : 'UTC';
		$date->setTimezone(new DateTimeZone($timezone));
		$interval = new DateInterval($interval_string);
		if( $next ){
			$date->add($interval);
		}
		else{
			$date->sub($interval);
		}
		$format = $format ? $format : get_option('date_format');
		return $date->format($format);
	}

	
function get_days_between_dates($date1, $date2){
		$date1 = ($date1 instanceof DateTime) ? $date1 : new DateTime($date1);
		$date2 = ($date2 instanceof DateTime) ? $date2 : new DateTime($date2);
		$interval = $date2->diff($date1);
		return ( $interval->invert ) ? - $interval->days : $interval->days;
	}

	
function get_formatted_date( $date = false, $wp_timezone = false, $format = 'Y-m-d\TH:i:sP' ){
		$date = ($date) ? new DateTime($date) : new DateTime();
		$timezone = ( $wp_timezone ) ? wp_timezone_string() : 'UTC';
		$date->setTimezone(new DateTimeZone($timezone));
		return $format === 'timestamp' ? $date->getTimestamp() : $date->format($format);
	}

		static $instance;
	public static 
function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

}
