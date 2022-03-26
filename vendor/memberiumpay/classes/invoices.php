<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}



class wpal_ecomm_invoices {

		
function get_new_invoice_id( $order_id, $args = [] ){

		$default = [
			'post_type'		=> $this->post_type,
			'post_parent'   => $order_id,
			'post_status'	=> 'draft',
		];
		$args = !empty($args) ? wp_parse_args($args, $default) : $default;
		$id = wp_insert_post($args);

		return ( (int)$id > 0 ) ? $id : $this->get_new_invoice_id($order_id);
	}

	
function generate_first_invoice( $order_id, $data, $status = 'processing' ){

		$subscriptions  = wpal_ecomm()->subscriptions();
		$functions		= wpal_ecomm()->functions();
		$cart			= $data['cart'];
		$total			= $cart['total'];
		$item			= $data['items'][0];
		$product_name	= $item['name'];
		$qty			= (int)$item['qty'];
		$plan_id		= $item['plan_id'];
		$plan			= $subscriptions->get_plan_config($plan_id);
		$bill_interval	= !empty($plan['bill_interval']) ? (int)$plan['bill_interval'] : 1;
		$interval		= $plan['interval'];
		$symbol			= wpal_ecomm_data::get_currency_symbol_by_code($data['currency']);
		$profile_id		= $data['profile_id'];

				if( (int)$item['trial'] > 0 ){
			$description = sprintf(__('Trial period for %s', 'wpal_ecomm'), $product_name);
			$period_end = $functions->get_next_date($plan['trial_days'], 1, false, 'U', false);
		}
		else{
			if( $bill_interval > 1 ){
				$interval_text = sprintf( __('every %s %s', 'wpal_ecomm'),
					$bill_interval, wpal_ecomm_data::subscription_intervals_plural($interval)
				);
			}
			else{
				$interval_text = $interval;
			}
			$display	 = number_format(str_replace(' ', '', $total), 2);
			$description = "{$qty} x {$product_name} (at {$symbol}{$display} / {$interval_text})";
			$period_end  = $functions->get_next_date($interval, $bill_interval, false, 'U', false);
		}

		$invoice = new stdClass;
		$invoice->id = $this->get_new_invoice_id($order_id);
		$invoice->number = ( !empty($resource['invoice_number']) ) ? $resource['invoice_number'] : $invoice->id;
		$invoice->status = $status;
		$invoice->data = $this->invoice_data;
		$invoice->data['items'][] = [
			'type'		=> 'subscription',
			'name'		=> $description,
			'qty'		=> $qty,
			'price'		=> $item['price'],
			'discount'	=> !empty($item['discount']) ? $item['discount'] : 0,
			'total'		=> $total,
			'product'	=> $subscriptions->get_product_id($item['id'],$profile_id),
			'plan'		=> $subscriptions->get_plan_id($plan_id,$profile_id),
			'start'		=> time(),
			'end'		=> $period_end,
			'interval'	=> $interval
		];
		$invoice->data['totals'] = [
			'subtotal'	=> !empty($cart['subtotal']) ? $cart['subtotal'] : $total,
			'tax'		=> !empty($cart['tax']) ? $cart['tax'] : 0,
			'discount'	=> !empty($cart['discount']) ? $cart['discount'] : 0,
			'total' 	=> $total
		];
		$invoice->data['created'] = time();
		return $this->create_invoice_post( $invoice, $order_id, $data['merchant'], $invoice->id );
	}

		
function create_invoice_post( $invoice, $order_id, $merchant, $wp_id = false ){

		$merchant_id = "{$this->prefix}{$merchant}";
		$status = $invoice->status;
		$total = $invoice->data['totals']['total'];
		$paid = ( $status === 'paid' ) ? $total : 0;
		$default_prefix = wpal_ecomm()->get_meta_prefix();

				$args = [
			'post_title'    => "{$invoice->number}",
			'post_content'	=> json_encode($invoice->data, JSON_UNESCAPED_UNICODE),
						'post_type'     => $this->post_type,
			'post_parent'   => $order_id,
			'post_status'	=> 'publish',
			'meta_input'    => [
				$merchant_id => $invoice->id,
				"{$this->prefix}status"			=> $status,
				"{$default_prefix}payment/due"	=> $total,
				"{$default_prefix}payment/paid"	=> $paid,
				"{$default_prefix}payment/time"	=> time()
			]
		];

		$args = apply_filters('wpal/ecomm/invoice/post/args', $args, $invoice, $order_id, $merchant);

				if( ! $wp_id ){
			$existing_invoice = wpal_ecomm()->functions()->get_order_id_by_meta($merchant_id, $invoice->id);
		}
		else{
			$existing_invoice = $wp_id;
		}

		if( (int)$existing_invoice > 0 ){
			$args['ID'] = $existing_invoice;
			$wp_invoice_id = wp_update_post($args);
		}
		else{
			$wp_invoice_id = wp_insert_post($args);
		}

		update_post_meta($order_id, wpal_ecomm()->functions()->get_prefix() . 'subscription/modified', time());

		return $wp_invoice_id;
	}

	
function get_invoice_status( $invoice_id ){
		return get_post_meta( $invoice_id, "{$this->prefix}status", true );
	}

	
function update_invoice_status( $invoice_id, $status ){
		$this->update_invoice_meta( $invoice_id, 'status', $status );
	}

	
function update_invoice_meta( $invoice_id, $key, $value ){
		update_post_meta($invoice_id, "{$this->prefix}{$key}", $value);
	}

		
function log_invoice_event( $invoice_id, $order_id, $total, $status, $url, $is_trial ){

		$sandbox_text = wpal_ecomm()->functions()->sandbox_text($order_id);
		$sandbox = ( $sandbox_text > '' );
		$type = ($is_trial) ? __('Trial', 'wpal_ecomm') : __('Payment', 'wpal_ecomm');
		$message = sprintf( $sandbox_text . ' ' . __('%s %s for Invoice ID %s', 'wpal_ecomm'),
			$type,
			$status,
			wpal_ecomm()->functions()->transaction_link($url, $invoice_id)
		);

				$logs = wpal_ecomm_order_logs::get_instance();
		$meta = $logs->report_meta('', $total, $sandbox, ['invoice_id'=>$invoice_id]);
		$logs->log_order_detail( $order_id, $status, $message, $meta );
	}

	
function order_invoice_ids($order_id){
		$query = new WP_Query( [
			'post_type' 		=> wpal_ecomm()->get_config('orders_slug'),
			'posts_per_page' 	=> -1,
			'post_parent'		=> $order_id,
			'post_status'		=> 'publish',
			'fields'			=> 'ids'
		] );
		return ( !empty($query->posts) ) ? $query->posts : false;
	}

		
function get_post_by_merchant_invoice_id( $invoice_id, $merchant ){
		$query = new WP_Query( [
			'post_type' 		=> wpal_ecomm()->get_config('orders_slug'),
			'posts_per_page' 	=> 1,
			'post_status'		=> 'publish',
			'meta_key'			=> "{$this->prefix}{$merchant}",
			'meta_value'		=> $invoice_id,
		] );
		return ( !empty($query->posts) ) ? $query->posts[0] : false;
	}

	    public static 
function get_instance() {
        static $instance = null;
        if ( is_null( $instance ) ) {
            $instance = new self;
			$instance->post_type = wpal_ecomm()->get_config('orders_slug');
			$instance->prefix = wpal_ecomm()->functions()->get_invoice_prefix();
        }
        return $instance;
    }

	public $post_type;
	public $prefix;
	public $invoice_data = [
		'items'		=> [],
		'totals'	=> [],
		'download'	=> '',
		'view'		=> '',
		'created'	=> 0
	];

}
