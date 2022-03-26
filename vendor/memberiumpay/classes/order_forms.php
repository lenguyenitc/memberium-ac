<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}



class wpal_ecomm_order_forms {

	static $post_type;

    
    static 
function register(){

		$ns = 'wpal_ecomm';
		$slug = wpal_ecomm()->get_config('forms_slug');

		self::$post_type = $slug;
		$labels = apply_filters( "wpal/ecomm/{$slug}/labels", [
			'name'					=> _x('Order Forms','post type general name', $ns),
			'singular_name' 		=> _x('Order Form', 'post type singular name', $ns),
			'add_new' 				=> _x('Add New', 'Order Form', $ns),
			'add_new_item' 			=> __('Add New Order Form', $ns),
			'edit_item' 			=> __('Edit Order Form', $ns),
			'new_item' 				=> __('New Order Form', $ns),
			'view_item' 			=> __('View Order Form', $ns),
			'search_items' 			=> __('Search Order Forms', $ns),
			'not_found' 			=> __('Nothing found', $ns),
			'not_found_in_trash'	=> __('Nothing found in Trash', $ns),
			'parent_item_colon'		=> ''
		] );

		wpal_ecomm()->set_config('forms_name', $labels['name']);

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
			'supports' 				=> ['title'],
			'exclude_from_search' 	=> true,
			'register_meta_box_cb'	=> [__CLASS__,'meta_boxes'],
		];
		register_post_type( $slug, $args );
    }


	static 
function meta_boxes( $post ){
		$post_type = self::$post_type;
		if( $post->post_type === $post_type ){

			$ns = 'wpal_ecomm';
			add_meta_box(
				'wpal/ecomm/order/form',
				__('Order Form Shortcode', $ns),
				['wpal_ecomm_order_form_screen', 'show_shortcode_metabox'],
				$post_type,
				'side',
				'high',
				null
			);

						add_filter("get_user_option_meta-box-order_{$post_type}", function() use($post_type) {
				global $wp_meta_boxes;
				$publishbox = $wp_meta_boxes[$post_type]['side']['core']['submitdiv'];
				$shortcodemeta = $wp_meta_boxes[$post_type]['side']['high']['wpal/ecomm/order/form'];
				$wp_meta_boxes[$post_type] = ['side' => [
					'core'	=> ['submitdiv' => $publishbox],
					'high'	=> ['wpal/ecomm/order/form' => $shortcodemeta]
				]];
								return [];
			}, PHP_INT_MAX);
		}
	}



}
