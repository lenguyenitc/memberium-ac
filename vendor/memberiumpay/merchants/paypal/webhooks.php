<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}



class wpal_ecomm_paypal_webhooks {

	private $events = [
		'PAYMENT.CAPTURE.COMPLETED',
		'PAYMENT.CAPTURE.DENIED',
		'PAYMENT.CAPTURE.REFUNDED',
		'PAYMENT.CAPTURE.REVERSED',
								'PAYMENT.SALE.COMPLETED',
		'PAYMENT.SALE.REFUNDED',
		'PAYMENT.SALE.REVERSED',
		'BILLING.SUBSCRIPTION.PAYMENT.FAILED',
		'BILLING.SUBSCRIPTION.CANCELLED'
	];

	
	public 
function process_webhook( $params, $profile ) {

		$ns = 'wpal_ecomm';

		$paypal = wpal_ecomm()->get_merchant('paypal');
		$paypal_functions = $paypal->functions();

				$sandbox = wpal_ecomm_webhooks::is_sandbox($params);
		$profile['sandbox'] = $sandbox;
		$pre = ( $sandbox ) ? 'sandbox_' : '';
		$paypal_config = $paypal->config($profile);

				$webhook_key = $profile["{$pre}webhook_key"];
		if( ! $webhook_key > '' ){
			$message = __('No webhook key set for profile', $ns) . ' - ' .$profile['name'];
			return wpal_ecomm_webhooks::kill_request( __FUNCTION__, $message );
		}
				$verify = $paypal_functions->verify_paypal_webhook( $webhook_key );
		if( is_wp_error($verify) ){
			return wpal_ecomm_webhooks::kill_request( __FUNCTION__, $verify->get_error_message() );
		}
				$event = $params['event_type'];
		if (  $event > '' && in_array($event, $this->events ) ) {
			$process = $this->process_webhook_event($event, $profile, $params);
			return wpal_ecomm_webhooks::successful_request( __FUNCTION__, $process );
		}
		else {
			$message =  __('Invalid Event Type', $ns) . " {$event}";
			return wpal_ecomm_webhooks::successful_request( __FUNCTION__, $message );
		}
	}

	
	
function process_webhook_event($event, $profile, $params){

		$ns = 'wpal_ecomm';
		$webhook_id = $params['id'];
		$webhook_create_time = $params['create_time'];
		$profile_id = $profile['key'];
		$resource_type = $params['resource_type'];
		$resource = $params['resource'];
		$sandbox = ( !empty($params['sandbox']) && (int)$params['sandbox'] > 0 ) ? 1 : 0;
		$resource_id = $resource['id'];
		$paypal = wpal_ecomm()->get_merchant('paypal');
		$order_functions = wpal_ecomm()->functions();
		$meta_prefix = $order_functions->get_prefix();

		$type_array = explode('.', $event);
		$type = $type_array[0];		$action = $type_array[1];		$status = $type_array[2];		if( $type === 'BILLING' && $action === 'PAYMENT' ){
			$action === $type_array[2];
			$status === $type_array[3]; 		}
		$is_refunding = ( in_array($resource_type, ['refund', 'reversal']) ); 
				if( defined('WPAL_ECOMM_WEBHOOK_LOG') && WPAL_ECOMM_WEBHOOK_LOG ){
			wpal_ecomm_debug::log_data([
				'Merchant'		=> 'Paypal',
				'Profile'		=> $profile_id,
				'Sandbox'		=> $sandbox,
				'Webhook ID'	=> $webhook_id,
				'Type' 			=> $event,
				'Resource ID'	=> $resource_id,
				'Create Time'	=> wpal_ecomm()->functions()->get_formatted_date(),
				'Summary'		=> $params['summary']
			], 'ecomm_webhooks.txt');
		}

				$is_subscription = ( $resource_type === 'subscription' || $resource_type === 'sale' );

				if( $is_subscription ){

			$subscription_id = ( $resource_type === 'subscription' ) ? $resource_id : $resource['billing_agreement_id'];
			$order_id = $order_functions->get_order_id_by_meta("{$meta_prefix}subscription_id", $subscription_id);
						if( (int)$order_id > 0 ){

								if( $status === 'CANCELLED' ){
					$current_status = $order_functions->get_order_status($order_id);
										if( $current_status != 'canceled' && $current_status != 'cancel-pending' ){
						$paypal->functions()->process_cancellation( $order_id, $subscription_id, [
							'reason' 	 => sanitize_textarea_field($resource['status_change_note']),
							'webhook_id' => $webhook_id
						] );
					}
					return sprintf(__('Subscription ID %s has been cancelled for Order ID %s.', $ns), $subscription_id, $order_id);
				}
				else if( $status === 'FAILED' || $status === 'COMPLETED' ){

					$billing_agreement = $paypal->subscriptions()->get_billing_agreement( $subscription_id, $profile );
					if( $status === 'FAILED' ){
						$paypal->functions()->process_pay_fail( $resource, $order_id, $billing_agreement );
						return sprintf(__('Failed Payment %s for Order ID %s has been processed.', $ns), $resource_id, $order_id);
					}
					else if( $status === 'COMPLETED' ){
						$paypal->functions()->process_pay_success( $resource, $order_id, $billing_agreement );
						return sprintf(__('Successful Transaction ID %s for Order ID %s has been processed.', $ns), $resource_id, $order_id);
					}
				}
			}
			else{
				return sprintf(__('Order Not Created for Subscription %s.', $ns), $subscription_id);
			}

		}
				else if( $resource_type === 'capture' ){
			$order_id = $order_functions->get_order_id_by_meta("{$meta_prefix}paypal_transaction_id", $resource_id);
			if( (int)$order_id > 0 ){
								if( $resource_type === 'capture' ){
										if( $resource_type === 'capture' ){
						if( $status === 'DENIED' ){
							do_action("wpal/ecomm/order/payment/failed", $order_id, $profile_id);
						}
						else if( $status === 'COMPLETED' ){
							do_action("wpal/ecomm/order/payment/succeeded", $order_id, $profile_id);
						}
					}
					return sprintf(__('%s Transaction ID %s for Order ID %s has been processed.', $ns),
						ucfirst(strtolower($status)), $resource_id, $order_id
					);
				}
			}
						else{
				return sprintf(__('Order Not Created for Resource %s.', $ns), $resource_id);
			}
		}
				else if( $is_refunding ){
			$is_order = ( $action === 'CAPTURE' );
			if( $is_order ){
				$order_url = $paypal->functions()->get_resource_url($resource);
				if( $order_url ){
					$payment_id = substr(strrchr(rtrim($order_url, '/'), '/'), 1);
				}
				else{
					return sprintf(__('Unable to retrieve transaction ID for Refund %s.', $ns), $resource_id);
				}
			}
			else {
				$payment_id = $resource['sale_id'];
			}
			return $paypal->functions()->process_pay_refund( $resource, $payment_id, $is_order, $profile_id, $sandbox );

		}
				else{
			return sprintf(__('Resource type %s not recognized for ID %s', $ns), $resource_type, $resource_id);
		}

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
