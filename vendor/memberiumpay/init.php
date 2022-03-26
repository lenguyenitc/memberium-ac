<?php
/*
Plugin Name: WPAL E-Comm
Author URI: 0000
Copyright (c) 2019-2021 Web, Power and Light
*/



if ( !defined( 'ABSPATH' ) ) {
	die();
}

require_once __DIR__ . '/classes/wpal_ecomm.php';

add_filter('wpalSelect2/css/src', function() {
	return plugin_dir_url(MEMBERIUM_HOME) . "css/wpal-select2.min.css";
});

add_filter('wpalSelect2/js/src', function() {
	return plugin_dir_url(MEMBERIUM_HOME) . "js/wpal-select2.full.min.js";
});

if( is_admin() ){

	add_filter('wp/admin/templater/settings/choices/crm_tags', function() {
		$tags = memb_getTagMap(true,true);
		$data = [];
		if( is_array($tags) && ! empty($tags) ){
			foreach ($tags as $id => $text) {
				$data[] = ['id'	=> $id,'text' => $text];
			}
		}
		return $data;
	});

	add_filter('memberium/unenhanced_posts', function( $types ) {

		$post_types = wpal_ecomm()->get_config('post_type_slugs');
		$types = array_merge($types, $post_types);
		return $types;

	}, 10, 1);

}


add_action("wpal/ecomm/subscription/payment/succeeded", function( $order_id, $invoice_id, $merchant_profile ) {

	$functions = wpal_ecomm()->functions();
	$action = 'wpal/ecomm/subscription/payment/succeeded';
	$keys = $functions->get_order_keys($order_id, $action);
	if( ! $keys ){
		return;
	}

	$grant = isset($keys['successful_key']) ? $keys['successful_key'] : false;
	$revoke = [];
	$revoke_index = ['failure_key', 'on_cancellation_key', 'requested_cancellation_key'];
	foreach ($revoke_index as $r) {
		if( !empty($keys[$r]) ){
			$revoke = array_merge($keys[$r], $revoke);
		}
	}
	$revoke = empty($revoke) ? false : array_unique($revoke);

	if( $grant || $revoke ){
		$ids = memb_wpal_ecomm_tag_filter( $grant, $revoke );
		if( $ids ){
			$user_id = $functions->get_order_user_id($order_id);
			$contact_id = ( (int)$user_id > 0 ) ? memb_getContactIdByUserId($user_id) : '';
			if( (int)$user_id > 0 && $contact_id > '' ){
				wpal_ecomm()->set_doing_remote_update(false);
				memb_setTags($ids, $contact_id);
				$functions->delete_order_process_queue($order_id, $user_id);
			}
			else {
				$functions->add_order_process_queue($order_id, [
					'action'			=> $action,
					'order_id'			=> $order_id,
					'invoice_id'		=> $invoice_id,
					'keys'				=> $keys,
					'merchant_profile'	=> $merchant_profile
				], $user_id, $contact_id );
			}
		}
	}

}, 10, 3);


add_action("wpal/ecomm/subscription/payment/failed", function( $order_id, $invoice_id, $merchant_profile ) {

	$functions = wpal_ecomm()->functions();
	$action = 'wpal/ecomm/subscription/payment/failed';
	$failed_keys = $functions->get_order_keys($order_id, $action, 'failure_key');
	if( $failed_keys && is_array($failed_keys) ){
		$user_id = $functions->get_order_user_id($order_id);
		$contact_id = ( (int)$user_id > 0 ) ? memb_getContactIdByUserId($user_id) : '';
		if( (int)$user_id > 0 && $contact_id > '' ){
			memb_setTags($failed_keys, $contact_id);
			$functions->delete_order_process_queue($order_id, $user_id);
		}
		else{
			$functions->add_order_process_queue($order_id, [
				'action'			=> $action,
				'order_id'			=> $order_id,
				'invoice_id'		=> $invoice_id,
				'keys'				=> $failed_keys,
				'merchant_profile'	=> $merchant_profile,
			], $user_id, $contact_id );
		}
	}

}, 10, 3);


add_action("wpal/ecomm/order/payment/succeeded", function( $order_id, $merchant_profile ) {

	$functions = wpal_ecomm()->functions();
	$action = 'wpal/ecomm/order/payment/succeeded';
	$keys = $functions->get_order_keys($order_id, $action);
	$success_keys = ( $keys && isset($keys['successful_key']) ) ? $keys['successful_key'] : false;
	$failed_keys = ( $keys && isset($keys['failure_key']) ) ? $keys['failure_key'] : false;

	if( $success_keys || $failed_keys ){
		$ids = memb_wpal_ecomm_tag_filter( $success_keys, $failed_keys );
		if( $ids ){
			$user_id = $functions->get_order_user_id($order_id);
			$contact_id = ( (int)$user_id > 0 ) ? memb_getContactIdByUserId($user_id) : '';
			if( (int)$user_id > 0 && $contact_id > '' ){
				memb_setTags($ids, $contact_id);
				$functions->delete_order_process_queue($order_id, $user_id);
			}
			else{
				$functions->add_order_process_queue($order_id, [
					'action'			=> $action,
					'order_id'			=> $order_id,
					'keys'				=> $keys,
					'merchant_profile'	=> $merchant_profile,
				], $user_id, $contact_id );
			}
		}
	}

}, 10, 2);


add_action("wpal/ecomm/order/payment/failed", function( $order_id, $merchant_profile ) {

	$functions = wpal_ecomm()->functions();
	$action = 'wpal/ecomm/order/payment/failed';
	$failed_keys = $functions->get_order_keys($order_id, $action, 'failure_key');
	if( $failed_keys && is_array($failed_keys) ){
		$user_id = $functions->get_order_user_id($order_id);
		$contact_id = ( (int)$user_id > 0 ) ? memb_getContactIdByUserId($user_id) : '';
		if( (int)$user_id > 0 && $contact_id > '' ){
			memb_setTags($failed_keys, $contact_id);
			$functions->delete_order_process_queue($order_id, $user_id);
		}
		else{
			$functions->add_order_process_queue( $order_id, [
				'action'			=> $action,
				'order_id'			=> $order_id,
				'keys'				=> $failed_keys,
				'merchant_profile'	=> $merchant_profile
			], $user_id, $contact_id );
		}
	}

}, 10, 2);


add_action("wpal/ecomm/subscription/cancel/requested", function( $order_id, $merchant_profile ) {

	$functions = wpal_ecomm()->functions();
	if( $functions->get_order_meta_by_key($order_id, 'no_cancel_requested_key') ){
		return;
	}
	$action = "wpal/ecomm/subscription/cancel/requested";
	$cancel_requested_keys = $functions->get_order_keys($order_id, $action, 'requested_cancellation_key');
	if ( $cancel_requested_keys && is_array($cancel_requested_keys) ) {
		$user_id = $functions->get_order_user_id($order_id);
		$contact_id = ( (int)$user_id > 0 ) ? memb_getContactIdByUserId($user_id) : '';
		if( $contact_id > '' ){
						$product_id = $functions->get_order_product_id($order_id);
			$active = wpal_ecomm()->customer()->has_purchased_product($user_id, $product_id, true);
			if( empty($active) ){
				memb_setTags($cancel_requested_keys, $contact_id);
			}
		}
	}

}, 10, 2);


add_action("wpal/ecomm/subscription/deleted", function( $order_id, $status, $merchant_profile ) {

	if( $status === 'canceled' ){

		$functions = wpal_ecomm()->functions();
		if( $functions->get_order_meta_by_key($order_id, 'no_cancel_key') ){
			return;
		}
		$action = "wpal/ecomm/subscription/deleted";
		$cancel_keys = $functions->get_order_keys($order_id, $action, 'on_cancellation_key');
		if ( $cancel_keys && is_array($cancel_keys) ) {
			$user_id = $functions->get_order_user_id($order_id);
			$contact_id = ( (int)$user_id > 0 ) ? memb_getContactIdByUserId($user_id) : '';
			if( $contact_id > '' ){
								$product_id = $functions->get_order_product_id($order_id);
				$active = wpal_ecomm()->customer()->has_purchased_product($user_id, $product_id, true);
				if( empty($active) ){
					memb_setTags($cancel_keys, $contact_id);
				}
			}
		}

	}

}, 10, 3);


add_action("wpal/ecomm/update/cc/failure", function( $user_id, $failure_keys ) {

	if( (int)$user_id > 0 && is_array($failure_keys) ){
		$contact_id = memb_getContactIdByUserId($user_id);
		if( $contact_id > '' ){
			memb_setTags($failure_keys, $contact_id);
		}
	}

}, 10, 2);


add_action("wpal/ecomm/update/cc/success", function( $user_id, $success_keys, $failure_keys ) {

	if( (int)$user_id > 0 ){
		$success_keys = is_array($success_keys) ? $success_keys : false;
		$failure_keys = is_array($failure_keys) ? $failure_keys : false;
		if( $success_keys || $failure_keys ){
			$ids = memb_wpal_ecomm_tag_filter( $success_keys, $failure_keys );
			if( $ids ){
				$contact_id = memb_getContactIdByUserId($user_id);
				if( $contact_id > '' ){
					memb_setTags($ids, $contact_id);
				}
			}
		}
	}

}, 10, 3);

add_filter('m4ac/maps/usermeta', 'memb_get_wpal_ecomm_usermeta_fields', 10, 1);

function memb_get_wpal_ecomm_usermeta_fields( array $fields = [] ){
	$map = apply_filters('memberium/ecomm/usermeta/fields', [
		'billing_first_name' => 'firstname',
		'billing_last_name'	 => 'lastname',
		'billing_address_1'  => 'address_1',
		'billing_address_2'  => 'address_2',
		'billing_city'       => 'city',
		'billing_company'    => 'orgname',
		'billing_country'    => 'country',
		'billing_email'      => 'email',
		'billing_phone'      => 'phone',
		'billing_postcode'   => 'zip',
		'billing_state'      => 'state'
	] );
	return ( is_array($map) ) ? array_merge($fields, $map) : $fields;
}

add_action('m4ac/user/email/updated', function( $user_id, $email ){
	update_user_meta($user_id, 'billing_email', $email);
}, 10, 2 );

add_action('memberium_maintenance', function(){
	wpal_ecomm()->functions()->hourly_cron_orders_check();
});


function memb_wpal_ecomm_tag_filter( $grant, $revoke ){
	$tags = [];
	$flipped = [];

	if( $grant ){
		$tags = $grant;
	}

	if( $revoke ){
		foreach ( $revoke as $id ) {
			$flipped[] = ( $id * -1 );
		}
	}
	$ids = array_unique(array_merge($tags,$flipped));
	return ( ! empty($ids) && is_array($ids) ) ? $ids : false;
}

wpal_ecomm();
