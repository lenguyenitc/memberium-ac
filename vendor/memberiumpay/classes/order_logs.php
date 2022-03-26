<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}



class wpal_ecomm_order_logs {

	const AGENT = 'WPAL/Ecomm';
	const TYPE = 'wpal_ecomm_log';
	const META_PREFIX = 'wpal/ecomm/';
	const META_KEY_TYPE = 'wpal/ecomm/type';

	
	
function log_order_detail( $order_id, $type, $message = '', $meta = [], $user_id = 0 ){

		if( ! wpal_ecomm()->settings->post_exists($order_id) ){
			return false;
		}

		$args = [];
		$comment_content = $message;
		$meta[self::META_KEY_TYPE] = $type;
				$admin_email = !empty($meta['admin_email']) ? $meta['admin_email'] : false;

		if( $user_id === self::AGENT ){
			$author = $user_id;
			$urlparts = parse_url(home_url());
			$domain = $urlparts['host'];
			$email = "wordpress@{$domain}";
		}
		else if($admin_email){
			unset($meta['admin_email']);
			$email = $admin_email;
			$user = get_user_by('ID', $user_id);
			if ( $user->first_name ) {
				if ( $user->last_name ) {
					$author = $user->first_name . ' ' . $user->last_name;
				}
				else {
					$author = $user->first_name;
				}
			}
			else {
				$author = $user->display_name;
			}
		}
		else {
			$functions = wpal_ecomm()->functions();
			$order_meta = $functions->get_order_metadata($order_id);
			$email = $order_meta['billing_email'];
			if( (int)$user_id > 0 ){
				$author = $functions->generate_full_name($order_id,$user_id);
			}
			else {
				$user_id = self::AGENT;
				$first = $order_meta['billing_first_name'];
				$last = $order_meta['billing_last_name'];
				$author = trim("{$first} {$last}");
			}
		}

		$comment_args = [
			'comment_post_ID'		=> $order_id,
			'comment_content'		=> $comment_content,
			'comment_agent'			=> self::AGENT,
			'comment_type'			=> self::TYPE,
			'comment_parent'		=> 0,
			'comment_approved'		=> 1,
			'comment_author'		=> $author,
			'comment_author_email'	=> $email,
			'user_id'				=> $user_id,
			'comment_meta'			=> $meta
		];

		$comment_args = apply_filters('wpal/ecomm/add/order/detail', $comment_args, $order_id, $user_id);
		$comment_id = wp_insert_comment($comment_args);
		return $comment_id;

	}

	
	
function report_meta( $id = '', $amount = null, $sandbox = false, $meta = [] ){

		$return = [];

		if( $id > '' ){
			$meta['transaction'] = $id;
		}
		if ( ! is_null($amount) ){
			$meta['amount'] = $amount;
		}
		if( $sandbox ){
			$meta['sandbox'] = $sandbox;
		}
		if( is_array($meta) && ! empty($meta) ){
			$prefix = self::META_PREFIX;
			foreach ($meta as $key => $value) {
								$return["{$prefix}{$key}"] = $value;
			}
		}

		return $return;
	}

	
	
function get_order_log($order_id){

		$logs = [];
		$args = [
			'type'		=>	self::TYPE,
			'post__in'	=>	$order_id
		];
		$query = get_comments($args);
		if( is_array($query) && !empty($query) ){
			foreach ($query as $key => $log) {
				$comment_id = $log->comment_ID;
				$time = '<time>'.get_comment_date('d F Y g:i a',$comment_id).'</time>';
				$logs[] = [
					'id'		=> $comment_id,
					'type'		=> get_comment_meta($comment_id,self::META_KEY_TYPE, true),
					'email'		=> $log->comment_author_email,
					'message'	=> $log->comment_content . $time
				];

			}
		}
		return $logs;
	}

	
	static 
function comment_queries_filter($query){
		$defaults = ['ID', 'parent', 'post_author', 'post_name', 'post_parent', 'type', 'post_type', 'post_id', 'post_ID'];
		foreach ( $defaults as $key ) {
			if ( !empty($query->query_vars[$key]) ) {
				return;
			}
		}
		if( $query->query_vars['type'] !== self::TYPE ){
			$not_in = ( $query->query_vars['type__not_in'] ) ? $query->query_vars['type__not_in'] : [];
			$not_in = wp_parse_args($not_in, [self::TYPE]);
			$query->query_vars['type__not_in'] = $not_in;
		}
	}

	
	static 
function comment_feed_filter( $where, $query ){
		if ( is_comment_feed() ) {
			$type = self::TYPE;
			$where .= " AND {$wpdb->comments}.comment_type != '{$type}'";
		}
		return $where;
	}

	
	static 
function filter_comment_widget( $args, $widget ){

		$not_in = [ self::TYPE ];
		if( isset($args['type__not_in']) ){
			$not_in = wp_parse_args($args['type__not_in'], $not_in);
		}
		$args['type__not_in'] = $not_in;
		return $args;
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
