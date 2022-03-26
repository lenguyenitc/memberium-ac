<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}



class wpal_ecomm_stripe_webhooks {

	private $events = [
												'customer.subscription.updated',
								'customer.subscription.deleted',
		
				'payment_intent.succeeded',
		'payment_intent.payment_failed',

								'invoice.payment_failed',
				'invoice.payment_succeeded',
				'invoice.payment_action_required',
														'charge.refunded'
	];

	
	public 
function process_webhook( $params, $merchant_profile ) {

		$ns = 'wpal_ecomm';
		$message = '';

				$sig_header = ( isset($_SERVER['HTTP_STRIPE_SIGNATURE']) ) ? $_SERVER['HTTP_STRIPE_SIGNATURE'] : false;
		if( ! $sig_header ){
			$message = __('Invalid Stripe Request', $ns);
			return wpal_ecomm_webhooks::kill_request( __FUNCTION__, $message );
		}

				$sandbox = wpal_ecomm_webhooks::is_sandbox($params);
		$merchant_profile['sandbox'] = $sandbox;
		$pre = ( $sandbox ) ? 'sandbox_' : '';

				$stripe = wpal_ecomm_stripe::get_instance();
		$stripe_config = $stripe->setup($merchant_profile);
		$endpoint_secret = $merchant_profile["{$pre}webhook_key"];
		if( ! $endpoint_secret ){
			$message =  __('No Endpoint set', $ns);
			return wpal_ecomm_webhooks::successful_request( __FUNCTION__, $message );
		}

				$payload = @file_get_contents('php://input');

		try {
			$event = \Stripe\Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
						if (  is_object($event) && $event->type > '' && in_array($event->type, $this->events ) ) {
				$process = $this->process_webhook_event($event, $merchant_profile);
				return wpal_ecomm_webhooks::successful_request( __FUNCTION__, $process );
			}
			else {
				$message =  __('Invalid Event Type', $ns);
				return wpal_ecomm_webhooks::successful_request( __FUNCTION__, $message );
			}
		}
		catch(\UnexpectedValueException $e) {
						$message =  __('Invalid Payload', $ns);
			return wpal_ecomm_webhooks::kill_request( __FUNCTION__, $message . ' Error : ' . $e->getMessage() );
		}
		catch(\Stripe\Error\SignatureVerification $e) {
						$message =  __('Invalid Signature', $ns);
			return wpal_ecomm_webhooks::kill_request( __FUNCTION__, $message . ' Error : ' . $e->getMessage() );
		}
	}

	
	
function process_webhook_event( $event, $merchant_profile ){

		$ns = 'wpal_ecomm';
		$response = '';

		$event_object = $event->data->object;
		$object_id = $event_object->id;
		$object_metadata = isset($event_object->metadata) ? $event_object->metadata : [];

				$stripe = wpal_ecomm_stripe::get_instance();
		$logs = wpal_ecomm_order_logs::get_instance();
		$order_functions = wpal_ecomm()->functions();
		$order_meta_prefix = $order_functions->get_prefix();
		$sandbox = $merchant_profile['sandbox'];
		$profile_id = $merchant_profile['key'];
		$type_array = explode('.', $event->type);
		$type = $type_array[0];

				if( defined('WPAL_ECOMM_WEBHOOK_LOG') && WPAL_ECOMM_WEBHOOK_LOG ){
			wpal_ecomm_debug::log_data([
				'Merchant'		=> 'Stripe',
				'Profile'		=> $profile_id,
				'Sandbox'		=> $sandbox,
				'Webhook ID'	=> $event->id,
				'Type' 			=> $event->type,
				'Resource ID'	=> $object_id,
				'Create Time'	=> wpal_ecomm()->functions()->get_formatted_date()
			], 'ecomm_webhooks.txt');
		}

				if( $type === 'customer' ){
			if($type_array[1] === 'created'){
								$user_id = ( isset($object_metadata->user_id) ) ? (int)$object_metadata->user_id : 0;
			}
			else if($type_array[1] === 'subscription'){
				$action = $type_array[2];
				$subscription_id = ( isset($event_object->id) ) ? $event_object->id : false;
				$subscription_status = ( isset($event_object->status) ) ? $event_object->status : null;
				$order_id = ( isset($object_metadata->order_id) ) ? (int)$object_metadata->order_id : 0;
				if( ! $order_id > 0 ){
										return sprintf(__('No WP Order ID for subscription %s', $ns), $subscription_id);
				}
								$order_status = ( $order_id > 0 ) ? $order_functions->get_order_status($order_id) : '';
				$canceled_date = get_post_meta($order_id, "{$order_meta_prefix}canceled/date", true);
				$update_status = '';

				if( $action === 'updated' || $action === 'deleted' ){

										$sandbox_text = $order_functions->sandbox_text($order_id);
					$url = $stripe->admin()->transaction_url($subscription_id,'subscriptions',$sandbox);

					if( $action === 'updated' ){

												if( $order_status === 'cancel-pending' && (int)$event_object->canceled_at === (int)$canceled_date ){
							return sprintf(__('Subscription cancellation request has already been processed for %s', $ns), $subscription_id);
						}
						$update_status = $stripe->functions()->normalize_status($subscription_status);
						do_action( "wpal/ecomm/subscription/updated", $order_id, $subscription_status, $profile_id );
					}
					else if($action === 'deleted'){
						$update_status = ( $subscription_status === 'canceled' ) ? 'canceled' : '';
						do_action( "wpal/ecomm/subscription/deleted", $order_id, $subscription_status, $profile_id );
						$response = sprintf(__('Order ID %s Subscription %s has been deleted', $ns), $order_id, $subscription_id);
					}

										if( $canceled_date && empty($event_object->canceled_at) ){
						delete_post_meta($order_id, "{$order_meta_prefix}canceled/date");
					}

					if( $order_status != $update_status ){
						$message = sprintf( $sandbox_text . ' ' . __('Subscription %s status has changed to %s', $ns ),
							$order_functions->transaction_link($url, $subscription_id),
							$subscription_status
						);

												$logs->log_order_detail( $order_id, $subscription_status, $message, [] );

												if( $update_status > '' ){
							$order_functions->update_order_status( $order_id, $update_status );
							$response = sprintf(__('Order ID %s Subscription %s status changed to %s', $ns), $order_id, $subscription_id, $update_status );
						}
					}
					else{
						$log_status = ( $update_status > '' ) ? $update_status : $order_status;
						$response = sprintf(__('Order ID %s Subscription %s status %s', $ns), $order_id, $subscription_id, $update_status );
					}

				}
				
			}
		}
				else if($type === 'invoice'){
			$action = $type_array[1];
			$subscription = false;
			$subscription_id = ( isset($event_object->subscription) ) ? $event_object->subscription : false;
			if( $subscription_id ){

				$invoice_id = $event_object->id;

								$billing_reason = $event_object->billing_reason;

								$subscription = $stripe->subscriptions()->retrieve_subscription($merchant_profile, $subscription_id);
				$metadata = is_wp_error($subscription) ? (object)[] : $subscription->metadata;
				$order_id = isset($metadata->order_id) ? (int)$metadata->order_id : 0;
				if( ! $order_id > 0 ){
					return sprintf(__('No WP Order ID for Invoice %s', $ns), $invoice_id );
				}

								$initial_invoice_id = get_post_meta($order_id,"{$order_meta_prefix}initial/invoice", $invoice_id);
				$subscription_status = $subscription->status;
				$is_trial = ( $subscription_status === 'trialing' );

				if( $action === 'payment_failed' || $action === 'payment_succeeded' ){

					$hook_status = ( $action === 'payment_succeeded' ) ? 'active' : 'failed';

					$total = $order_functions->cents_to_dollar($event_object->total);

										$invoice_post_data = $stripe->functions()->normalize_invoice_data($event_object);
					$invoices = wpal_ecomm()->invoices();
					$wp_invoice_id = $invoices->create_invoice_post( $invoice_post_data, $order_id, 'stripe', $initial_invoice_id );

										$url = $stripe->admin()->transaction_url($invoice_id,'invoices',$sandbox);
					$invoices->log_invoice_event( $invoice_id, $order_id, $total, $hook_status, $url, $is_trial );

										$subscription_status = $stripe->functions()->normalize_status($subscription_status);
					$order_functions->update_order_status( $order_id, $subscription_status );
					if( $initial_invoice_id ){
						delete_post_meta($order_id,"{$order_meta_prefix}initial/invoice");
					}

										if( $action === 'payment_succeeded' && $billing_reason != 'subscription_create' ){
												update_post_meta($order_id,"{$order_meta_prefix}subscription/interval", $subscription->plan->interval);
						update_post_meta($order_id,"{$order_meta_prefix}subscription/bill/interval", $subscription->plan->interval_count);
						update_post_meta($order_id,"{$order_meta_prefix}next/due/amount", $total);
						update_post_meta($order_id,"{$order_meta_prefix}current/period/end", $subscription->current_period_end);
					}

					if( $action === 'payment_failed' ){

						do_action( "wpal/ecomm/subscription/payment/failed", $order_id, $wp_invoice_id, $profile_id );

						if( $billing_reason != 'subscription_create' ){
							$customer = $stripe->subscriptions()->retrieve_customer($merchant_profile,$event_object->customer);
							$user_id = ( isset($customer->metadata->user_id) ) ? $customer->metadata->user_id : wpal_ecomm()->customer()->get_user_id_by_email($customer->email);
							$amount_due = $order_functions->cents_to_dollar($event_object->amount_due);
							do_action( "wpal/ecomm/subscription/payment/failed/email", [
								'order_id'		=> $order_id,
								'invoice_id'	=> $wp_invoice_id,
								'email'			=> $customer->email,
								'link'			=> $event_object->hosted_invoice_url,
								'user_id'		=> $user_id,
								'amount_due'	=> $amount_due,
								'merchant'		=> $profile_id,
							]);
						}

					}
					else{
												if( $billing_reason === 'subscription_create' ){
							do_action( "wpal/ecomm/subscription/initial/payment/succeeded", $order_id, $wp_invoice_id, $profile_id );
						}
												do_action( "wpal/ecomm/subscription/payment/succeeded", $order_id, $wp_invoice_id, $profile_id );
					}

					$response = sprintf(__('Order ID %s Subscription %s status changed to %s', $ns), $order_id, $subscription_id, $subscription_status );

				}
				else if($action === 'payment_action_required'){
				}
			}
		}
				else if ($type === 'payment_intent') {
			$action = $type_array[1];
			$order_id = ( isset($object_metadata->order_id) ) ? (int)$object_metadata->order_id : 0;
			$amount = ( isset($event_object->amount) ) ? $event_object->amount : null;
			if( $order_id > 0 ){

				$intent_id = $event_object->id;
				$status = ( $action === 'succeeded' ) ? 'completed' : 'failed';
				$url = $stripe->admin()->transaction_url($intent_id,'payments',$sandbox);
				$message = sprintf( __('Payment %s for Intent ID %s', $ns ),
					$status,
					$order_functions->transaction_link($url, $intent_id)
				);

								$meta = $logs->report_meta($intent_id, $amount, $sandbox);
				$logs->log_order_detail( $order_id, $status, $message, $meta );

								$order_functions->update_order_status( $order_id, $status );

								$hook_action = ( $action === 'payment_failed' ) ? 'failed' : 'succeeded';
				do_action( "wpal/ecomm/order/payment/{$hook_action}", $order_id, $profile_id );

				$response = sprintf(__('Order ID %s Payment Intent %s %s', $ns), $order_id, $intent_id, $hook_action );

			}
		}
				else if( $type === 'charge' ){
						if($type_array[1] === 'refunded'){

				$intent_id = $event_object->payment_intent;
				$currency = $event_object->currency;
				$amount_refunded = $order_functions->cents_to_dollar($event_object->amount_refunded);
				$refunds = $event_object->refunds->data;
				if( (int)$event_object->refunds->total_count > 1 ){
					$refund = array_reduce($refunds, function($a, $b){
						return $a ? ($a->sort > $b->sort ? $a : $b) : $b;
					});
				}
				else{
					$refund = $refunds[0];
				}

				$refund_id = $refund->id;
				$created = $refund->created;

								if( empty($event_object->invoice) ){
					$order_id = (int)$order_functions->get_order_id_by_meta( "{$order_meta_prefix}payment_intent_id", $intent_id );
										if( $order_id > 0 ){
												$order_functions->manage_refund_meta( $order_id, $refund_id, $amount_refunded, 'order', $created );
												$url = $stripe->admin()->transaction_url( $intent_id, 'payments', $sandbox );
						$link = $order_functions->transaction_link($url, $intent_id);
						$order_functions->log_refund( $order_id, $intent_id, 'Payment', $amount_refunded, $currency, $link, $sandbox );
						$response = sprintf(__('Payment %s Refunded for Order #%s', $ns), $intent_id, $order_id );
						do_action( "wpal/ecomm/order/refund", $order_id );
					}
					else{
						$response = sprintf(__('No Order for Payment Intent %s found in system', $ns), $intent_id );
					}
				}
								else{
					$invoice_id = $event_object->invoice;
					$invoices = wpal_ecomm()->invoices();
					$invoice_post = $invoices->get_post_by_merchant_invoice_id($invoice_id, 'stripe');
					if( $invoice_post ){
						$wp_invoice_id = $invoice_post->ID;
						$order_id = $invoice_post->post_parent;
						$user_id = $order_functions->get_order_user_id($order_id);
												$order_functions->manage_refund_meta( $wp_invoice_id, $refund_id, $amount_refunded, 'invoice', $created );
												$url = $stripe->admin()->transaction_url($invoice_id,'invoices',$sandbox);
						$link = $order_functions->transaction_link($url, $invoice_post->post_title);
						$order_functions->log_refund( $order_id, $intent_id, 'Invoice', $amount_refunded, $currency, $link, $sandbox );
												$subscription_id = $order_functions->get_order_subscription_id($order_id);
						$order_functions->update_order_status($order_id, 'cancel-pending');
						$stripe->functions()->cancel_subscription([
							'order_id' 			=> $order_id,
							'subscription_id'	=> $subscription_id,
							'profile_id'		=> $profile_id,
							'reason' 			=> sprintf( __('Invoice %s Refunded', $ns), $invoice_id )
						], $user_id );
						do_action( "wpal/ecomm/invoice/refund", $wp_invoice_id, $order_id );
						$response = sprintf(__('Invoice %s Refunded and Subscription %s Cancelled', $ns), $invoice_id, $subscription_id );
					}
					else{
						$response = sprintf(__('No Invoice %s Found in system', $ns), $invoice_id );
					}
				}
			}
		}

		return $response;
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
