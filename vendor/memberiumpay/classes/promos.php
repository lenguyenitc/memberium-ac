<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}



class wpal_ecomm_promos {

    
    static 
function register(){

		$slug = wpal_ecomm()->get_config('promos_slug');
		$labels = apply_filters( 'wpal/ecomm/'.$slug.'/labels', [
			'name'					=> _x( 'Promos','post type general name', 'wpal_ecomm'),
			'singular_name' 		=> _x( 'Promo', 'post type singular name', 'wpal_ecomm'),
			'add_new' 				=> _x( 'Add New', 'Promo', 'wpal_ecomm'),
			'add_new_item' 			=> __( 'Add New Promo', 'wpal_ecomm'),
			'edit_item' 			=> __( 'Edit Promo', 'wpal_ecomm'),
			'new_item' 				=> __( 'New Promo', 'wpal_ecomm'),
			'view_item' 			=> __( 'View Promo', 'wpal_ecomm'),
			'search_items' 			=> __( 'Search Promos', 'wpal_ecomm'),
			'not_found' 			=> __( 'Nothing found', 'wpal_ecomm'),
			'not_found_in_trash'	=> __( 'Nothing found in Trash', 'wpal_ecomm'),
		] );

		wpal_ecomm()->set_config('promos_name', $labels['name']);

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
			'supports' 				=> ['title', 'editor'],
			'exclude_from_search' 	=> true
		];
		register_post_type( $slug, $args );
    }

}
