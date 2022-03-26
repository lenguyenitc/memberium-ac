<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}



class wpal_ecomm_subscriptions extends wp_custom_db_crud {

	    private $table = 'wpal_subscription_properties';

		public $row = [
		'product_id' 	=> 0,
		'merchant_id'	=> '',
		'property_id'	=> '',
		'property_type'	=> '',
		'active'		=> 0,
		'metadata'		=> ''
	];

		private $merchants = [];

		private 
function __construct() {

		parent::__construct($this->table);

	}

	
	
function manage_order_form_subscription($order_form_id, $data){

		$product_id = $data['order_form_products'];
		$merchants = $data['order_form_merchants'];
		$merchants = ( ! empty($merchants) ) ? explode(',', trim($merchants, ',')) : false;
		$subscription_map = [];
		if($merchants){
			foreach ($merchants as $merchant_id) {
				$merchant = wpal_ecomm()->settings->get_merchant_profile($merchant_id);
				if($merchant){
					$subscription_map[$merchant_id]['products'] = [];
					$merchant_products = $this->manage_order_form_products( $product_id, $merchant, $order_form_id );

					if( $merchant_products ){
						$plans = $data['order_form_pricing_plans'];
						$plans = ( ! empty($plans) ) ? explode(',', trim($plans, ',')) : false;
						if( $plans ){
							foreach ($merchant_products as $merchant_product_id) {
								$subscription_map[$merchant_id]['products'][$product_id] = [
									'id'	=> $merchant_product_id,
									'plans'	=> []
								];
								foreach ($plans as $plan_id) {
									$merchant_plans = $this->manage_order_form_plans( $plan_id, $merchant, $merchant_product_id, $order_form_id);
									if( $merchant_plans ){
										foreach ($merchant_plans as $wp_plan_id => $merchant_plan_id) {
											$subscription_map[$merchant_id]['products'][$product_id]['plans'][$wp_plan_id] = $merchant_plan_id;
										}
									}
								}
							}
						}
					}
				}
			}
		}

		return ( empty($subscription_map) ) ? false : $subscription_map;
	}

	
	
function manage_order_form_products( $product_id, $merchant, $order_form_id){

		$products = false;
		$merchant_id = $merchant['key'];
		$get_products = $this->get_subscription_properties($product_id,$merchant_id,'product',1);
				if( $get_products ){
			$this->manage_property_meta($get_products, $order_form_id);
			$products = wp_list_pluck($get_products, 'property_id', 'product_id' );
		}
				else{
			$merchant_class = wpal_ecomm()->get_merchant($merchant['method']);
			$subscribed_id = $merchant_class->subscriptions()->create_product($merchant, $product_id);
			if( ! is_wp_error( $subscribed_id ) ){
				$insert_args = [
					'product_id' 	=> $product_id,
					'merchant_id'	=> $merchant_id,
					'property_id'	=> $subscribed_id,
					'property_type'	=> 'product',
					'active'		=> 1,
					'metadata'		=> json_encode(['order_forms' => [$order_form_id]]),
					'timestamp'		=> current_time( 'mysql', 1 )
				];
								$insert = $this->insert($insert_args);
				$products = [ $product_id => $subscribed_id ];
			}
		}
		return ( empty($products) ) ? false : $products;
	}

	
	
function manage_order_form_plans( $plan_id, $merchant, $merchant_product_id, $order_form_id ){

		$merchant_id = $merchant['key'];
		$plans = false;
		$get_plans = $this->get_subscription_properties($plan_id, $merchant_id, 'plan', 1);
				if( $get_plans ){
						$this->manage_property_meta($get_plans, $order_form_id);
			$plans = wp_list_pluck($get_plans, 'property_id', 'product_id');
		}
		else {
			$merchant_class = wpal_ecomm()->get_merchant($merchant['method']);
			$subscribed_id = $merchant_class->subscriptions()->create_plan($merchant, $plan_id, $merchant_product_id);
			if( ! is_wp_error( $subscribed_id ) ){
				$insert_args = [
					'product_id' 	=> $plan_id,
					'merchant_id'	=> $merchant_id,
					'property_id'	=> $subscribed_id,
					'property_type'	=> 'plan',
					'active'		=> 1,
					'metadata'		=> json_encode(['order_forms' => [$order_form_id]]),
					'timestamp'		=> current_time( 'mysql', 1 )
				];
								$insert = $this->insert($insert_args);
				$plans = [ $plan_id => $subscribed_id ];
			}
		}
		return ( empty($plans) ) ? false : $plans;
	}

	
	
function manage_property_meta( $properties, $order_form_id ){

		if( is_array($properties) ){
			foreach ($properties as $id => $property) {
				$metadata = json_decode($property->metadata, true);
				$order_forms = ( isset($metadata['order_forms']) ) ? $metadata['order_forms'] : [];
				if( ! in_array($order_form_id, $order_forms) ){
					$order_forms[] = $order_form_id;
					$metadata['order_forms'] = $order_forms;
					$update = ['metadata' => json_encode($metadata)];
					$where = ['id' => $property->id];
					$this->update($update,$where);
				}
			}
		}
	}


	public 
function get_product_id( $product_id, $merchant_id ){
		return $this->get_property_id_by_wp_id( $product_id, $merchant_id, 'product' );
	}

	
	public 
function get_plan_id( $product_id, $merchant_id ){
		return $this->get_property_id_by_wp_id( $product_id, $merchant_id );
	}

	public 
function get_property_id_by_wp_id( $wp_id, $merchant_id, $type = 'plan', $active = 1 ){
		$property = $this->get_by( [
			'product_id'	=> $wp_id,
			'merchant_id'	=> $merchant_id,
			'property_type' => $type,
			'active'		=> $active
		],'=', true );
		return ( $property ) ? $property->property_id : false;
	}

				
function get_plan_config($plan_id){

		$plan = get_page($plan_id);
		$plan_config = json_decode($plan->post_content, true);
		$plan_config['title'] = $plan->post_title;
		return $plan_config;
	}

				
function get_plan_properties($plan_id){
		$properties = $this->get_subscription_properties($plan_id, '', 'plan');
		$plan_properties = '';
		if( ! empty($properties) ){
			$plan_properties = [];
			foreach ($properties as $property) {
				$metadata = $property->metadata;
				$metadata = ( $metadata > '' ) ? json_decode($metadata) : (object)[];
				$order_forms = ( isset($metadata->order_forms) ) ? $metadata->order_forms : [];
				$plan_properties[$property->id] = [
					'id' 			=> $property->id,
					'profile_id'	=> $property->merchant_id,
					'property_id'	=> $property->property_id,
					'order_forms'	=> $order_forms
				];
			}
		}
		return $plan_properties;
	}

				public 
function get_subscription_properties( $product_id = 0, $merchant_id = '', $type = false, $active = null ){

		$where = [];
		if( (int)$product_id > 0 ){
			$where['product_id'] = $product_id;
		}
		if( $merchant_id > '' ){
			$where['merchant_id'] = $merchant_id;
		}
		if( $type === 'product' || $type === 'plan' ){
			$where['property_type'] = $type;
		}
		if( ! is_null($active) ){
			$where['active'] = (int)$active;
		}

		return $this->get_by($where,'=');

	}

	
function cancel_subscription_by_order_id( $order_id, $cancel_timestamp = 0, $admin_id = 0 ){
		$functions = wpal_ecomm()->functions();
        $order_meta = $functions->get_order_metadata($order_id);
		$merchant = $order_meta['merchant'];
		$merchant_class = wpal_ecomm()->get_merchant($merchant);
		if( $merchant_class ){
			$merchant_functions = $merchant_class->functions();
			if( method_exists($merchant_functions, 'cancel_subscription') ){
				$data = [
					'order_id' 			=> $order_id,
					'subscription_id'	=> $order_meta['subscription_id'],
					'profile_id'		=> $order_meta['profile_id'],
				];
				if( $cancel_timestamp > 0 ){
					$data['cancel_date'] = $cancel_timestamp;
				}
				if( (int)$admin_id > 0 ){
					$admin = get_userdata($admin_id);
					if( $admin ){
						$data['admin_id'] = $admin_id;
						$data['admin_email'] = $admin->user_email;
					}
				}
				add_filter("wpal/ecomm/account/subscription/cancel/{$merchant}", [$merchant_functions, 'cancel_subscription'], 10, 2);
				$response = apply_filters("wpal/ecomm/account/subscription/cancel/{$merchant}", $data, $order_meta['user_id']);
			}
			else{
				$response = new WP_Error( 'wpal/ecomm/cancel/subscription', sprintf( __( 'No cancel function for %s merchant', 'wpal_ecomm' ), ucfirst($merchant) ) );
			}
		}
		else{
			$response = new WP_Error( 'wpal/ecomm/cancel/subscription', sprintf( __( 'No supporting class for %s merchant', 'wpal_ecomm' ), ucfirst($merchant) ) );
		}
		return $response;
	}

		
function queue_cancel_process( $data, $user_id ){

		$order_id = $data['order_id'];
		$subscription_id = $data['subscription_id'];
		$cancel_date = $data['cancel_date'];
				$process_date = wpal_ecomm()->functions()->get_previous_date( 'day', 1, "@{$cancel_date}", 'U' );
		$log_data = $this->cancelled_log_data($data, $user_id, $order_id, $subscription_id);
		$meta_prefix = wpal_ecomm()->functions()->get_prefix();
				update_post_meta($order_id, "{$meta_prefix}cancel/on/process", $process_date);
		update_post_meta($order_id, "{$meta_prefix}cancel/on/admin", $log_data['admin_id']);
		update_post_meta($order_id, "{$meta_prefix}canceled/date", time());

		$cancel_on_text = ' on ' . wp_date('M j Y',$cancel_date);
		$message = sprintf( $log_data['sandbox_text'] . __('Subscription %s for order #%s set to cancel%s%s.', 'wpal_ecomm'),
			$log_data['link'], $order_id, $cancel_on_text, $log_data['admin_msg']
		);
		wpal_ecomm_order_logs::get_instance()->log_order_detail($order_id, 'cancel/on', $message, $log_data['data'], $log_data['log_user_id']);
		return [
			'success'	=> true,
			'message'	=> $message,
			'end_date'	=> $cancel_date
		];
	}

		
function cancelled_log_data( $data, $user_id, $order_id, $subscription_id ){

				$sandbox_text = wpal_ecomm()->functions()->sandbox_text($order_id);
		$sandbox = ( $sandbox_text > '' );

				$link = '';
		$merchant = wpal_ecomm()->functions()->get_order_merchant($order_id);
		$merchant_class = wpal_ecomm()->get_merchant($merchant);
		if( $merchant_class ){
						$url = $merchant_class->admin()->transaction_url($subscription_id,'subscriptions',$sandbox);
			$link = wpal_ecomm()->functions()->transaction_link($url, $subscription_id);
		}

				$admin_user_id = ( !empty($data['admin_id']) && (int)$data['admin_id'] > 0 ) ? $data['admin_id'] : false;
		$log_user_id = $admin_user_id ? $admin_user_id : $user_id;
		$admin_email = !empty($data['admin_email']) ? $data['admin_email'] : false;
		$log_data = ($admin_email) ? ['admin_email' => $admin_email] : [];
				if( !empty($data['webhook_id']) ){
			$log_data['webhook_id'] = $data['webhook_id'];
		}
				if( !empty($data['cancel_date']) ){
			$log_data['cancel_date'] = $data['cancel_date'];
		}

		$admin_msg = ($admin_email) ? " by Admin {$admin_email}" : "";

		return 	[
			'sandbox_text'	=> $sandbox_text,
			'link'			=> $link,
			'admin_msg'		=> $admin_msg,
			'log_user_id'	=> $log_user_id,
			'admin_id'		=> $admin_user_id,
			'data'			=> $log_data
		];

	}

	public static 
function get_instance() {
        static $instance = null;
        if ( is_null( $instance ) ) {
            $instance = new self;
        }
        return $instance;
    }

}
