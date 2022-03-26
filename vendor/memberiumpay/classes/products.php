<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}



class wpal_ecomm_products {

	static $post_type;
	const PRODUCT_META_PREFIX = '/wpal/ecomm/product/';
	const PLAN_META_PREFIX = '/wpal/ecomm/plan/';

    
    static 
function register(){

		$slug = wpal_ecomm()->get_config('products_slug');
		self::$post_type = $slug;
		$labels = apply_filters( "wpal/ecomm/{$slug}/labels", [
			'name'					=> _x( 'Products','post type general name', 'wpal_ecomm'),
			'singular_name' 		=> _x( 'Product', 'post type singular name', 'wpal_ecomm'),
			'add_new' 				=> _x( 'Add New', 'Product', 'wpal_ecomm'),
			'add_new_item' 			=> __( 'Add New Product', 'wpal_ecomm'),
			'edit_item' 			=> __( 'Edit Product', 'wpal_ecomm'),
			'new_item' 				=> __( 'New Product', 'wpal_ecomm'),
			'view_item' 			=> __( 'View Product', 'wpal_ecomm'),
			'search_items' 			=> __( 'Search Products', 'wpal_ecomm'),
			'not_found' 			=> __( 'Nothing found', 'wpal_ecomm'),
			'not_found_in_trash'	=> __( 'Nothing found in Trash', 'wpal_ecomm'),
			'featured_image'        => __( 'Product Image', 'wpal_ecomm'),
			'set_featured_image'    => __( 'Set Product Image', 'wpal_ecomm'),
			'remove_featured_image' => __( 'Remove Product Image', 'wpal_ecomm'),
			'use_featured_image'    => __( 'Use as Product Image', 'wpal_ecomm'),
			'parent_item_colon'		=> ''
		] );
		wpal_ecomm()->set_config('products_name', $labels['name']);

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
			'supports' 				=> ['title','thumbnail'],
			'exclude_from_search' 	=> true,
			'register_meta_box_cb'	=> [__CLASS__,'meta_boxes'],
		];
		register_post_type( $slug, $args );
    }

	static 
function meta_boxes( $post ){
		$post_type = self::$post_type;
		if( $post->post_type === $post_type ){
						add_filter("get_user_option_meta-box-order_{$post_type}", function() use($post_type) {
				global $wp_meta_boxes;
				$publishbox = $wp_meta_boxes[$post_type]['side']['core']['submitdiv'];
				$postimagediv = $wp_meta_boxes[$post_type]['side']['low']['postimagediv'];
				$wp_meta_boxes[$post_type] = ['side' => [
					'core'	=> ['submitdiv' => $publishbox],
					'low'	=> ['postimagediv' => $postimagediv]
				]];
								return [];
			}, PHP_INT_MAX);
		}
	}

	static 
function get_product_config( $id, $admin = false ){

		$prefix = self::PRODUCT_META_PREFIX;
		$post = get_post( $id );
		$config = get_post_meta($id, "{$prefix}config", true);
		$config = ( $config ) ? $config : [];
		$config['id'] = $id;
		$config['name'] = $post->post_title;
		$description_key = ( $admin ) ? 'product_description' : 'content';
		$config[$description_key] = apply_filters('the_content',wp_specialchars_decode($post->post_content));
		$excerpt_key = ( $admin ) ? 'product_excerpt' : 'excerpt';
		$config[$excerpt_key] = $post->post_excerpt;
		if( !empty($config['duplicates']) && !empty($config['duplicate_message']) ){
			$config['duplicate_message'] = wp_kses(htmlentities(stripslashes($config['duplicate_message'])),[]);
		}
		return $config;
	}

	
	static 
function get_product_keys( $product_id, $order_id ){

		$keys = apply_filters("wpal/ecomm/product/keys", [
			'successful_key' 				=> '',
			'failure_key'					=> '',
			'requested_cancellation_key'	=> '',
			'on_cancellation_key'			=> ''
		], $product_id, $order_id);

		$product = self::get_product_config($product_id);
		foreach ($keys as $slug => $ids) {
			$product_keys = $default_keys = [];
			if( isset($product[$slug]) ){
				$value = $product[$slug];
				$product_keys = ( $value > '' ) ? explode(',', trim($value, ',') ) : [];
			}
			if( $ids > '' ){
				$default_keys = explode(',', trim($value, ',') );
			}
			$keys[$slug] = array_unique(array_merge($product_keys, $default_keys));
		}

		return $keys;
	}

	static 
function get_product_name_from_plan_id( $plan_id ){
		$product_name = '';
		$parent_id = wp_get_post_parent_id($plan_id);
		if( (int)$parent_id > 0 ){
			$product_name = get_the_title($parent_id);
		}
		return $product_name;
	}

	static 
function get_all_products_and_plans(){
		$data = [];
		global $wpdb;
		$post_type = wpal_ecomm()->get_config('products_slug');
		$sql = "SELECT DISTINCT ID, post_title, post_parent, post_content
			FROM {$wpdb->posts} product
			WHERE post_status = 'publish'
			AND post_type = '{$post_type}'
			ORDER BY CASE WHEN post_parent = 0 THEN ID ELSE post_parent END ASC,
			CASE WHEN post_parent = 0 THEN '0' ELSE post_title END ASC";

		$results = $wpdb->get_results($sql, ARRAY_A);
		if( $results ){
			$product_id = 0;
			foreach ($results as $index => $p) {
				$id = $p['ID'];
				$parent = $p['post_parent'];
				if( $parent > 0 ){
					$data[$product_id]['plans'][] = $p;
				}
				else{
					$product_id = $id;
					$data[$id] = $p;
					$data[$id]['plans'] = [];
				}
			}
			foreach ($data as $id => $d) {
				if( empty($d['plans']) ){
					unset($data[$id]['plans']);
				}
			}
			$data = array_values($data);
		}
		return $data;
	}

}
