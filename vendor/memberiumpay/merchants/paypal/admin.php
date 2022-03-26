<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}



class wpal_ecomm_paypal_admin {

    protected $name = 'Paypal';

    
function settings( $tab, $settings, $profile ){

        $ns = 'wpal_ecomm';

						$section = 'general';
		$settings[] = [
			'slug'	=> $section,
			'title'	=> __( 'Profile Config', $ns ),
			'type'	=> 'section',
			'tab'	=> $tab
		];

		$settings[] = [
			'slug'      => "{$tab}_key",
			'type'      => 'hidden',
			'value'		=> $profile['key'],
			'tab'       => $tab,
			'section'   => $section,
			'ui_only'	=> 1
		];

		$settings[] = [
			'slug'          => "{$tab}_name",
			'title'         => __( 'Name', $ns ),
			'tooltip'       => __( 'Profile Name for admin purposes only.', $ns ),
			'type'          => 'input',
			'required'		=> true,
			'value'			=> $profile['name'],
			'tab'           => $tab,
			'section'       => $section,
			'validate'		=> 'unique'
		];

		$settings[] = [
			'slug'          => "{$tab}_base_location",
			'title'         => __( 'Base Location', $ns ),
			'tooltip'       => __( 'Base location for your order form', $ns ),
			'type'          => 'select',
			'choices'		=> 'countries',
			'value'			=> isset($profile['base_location']) ? $profile['base_location'] : '',
			'default'		=> wpal_ecomm()->settings->get_option('base_location'),
			'tab'           => $tab,
			'section'       => $section,
		];

		$settings[] = [
			'slug'          => "{$tab}_currency",
			'title'         => __( 'Default Currency', $ns ),
			'tooltip'       => __( 'Select a default currency for your order forms.', $ns ),
			'type'          => 'select',
			'choices'		=> 'currencies',
			'value'			=> isset($profile['currency']) ? $profile['currency'] : '',
			'default'		=> wpal_ecomm()->settings->get_option('default_currency'),
			'tab'           => $tab,
			'section'       => $section,
		];

				$section = 'authorization-section';
		$settings[] = [
			'slug'	=> $section,
			'title'	=> __( 'Authorization', $ns ),
			'type'	=> 'section',
			'tab'	=> $tab
		];

        $settings[] = [
			'slug'          => "{$tab}_client_id",
			'title'         => __( 'Client ID', $ns ),
			'tooltip'       => __( 'Enter your Client ID here.', $ns ),
			'type'          => 'input',
			'attrs'			=> [ ['prop' => 'data-public','value' => 1] ],
			'value'			=> isset($profile['client_id']) ? $profile['client_id'] : '',
			'tab'           => $tab,
			'section'       => $section,
		];
        $settings[] = [
			'slug'          => "{$tab}_client_secret",
			'title'         => __( 'Client Secret', $ns ),
			'tooltip'       => __( 'Enter your client secret.', $ns ),
			'type'          => 'input',
			'attrs'			=> [ ['prop' => 'data-secret','value' => 1] ],
			'value'			=> isset($profile['client_secret']) ? $profile['client_secret'] : '',
			'tab'           => $tab,
			'section'       => $section,
		];

				$webhook_key = isset($profile['webhook_key']) ? $profile['webhook_key'] : '';
		$settings[] = [
			'slug'		=> "{$tab}_webhook_key",
			'title'		=> __('Webhook ID', $ns),
			'tooltip'   => __('Validates processes for this account.', $ns ),
			'type'		=> 'readonly',
			'value'		=> $webhook_key,
			'tab'		=> $tab,
			'section'	=> $section,
		];

				$button_label = ( $webhook_key > '' ) ? __('Refresh', $ns) : __('Generate', $ns);
		$settings[] = [
			'slug'		=> "{$tab}_generate_webhook_key",
			'type'		=> 'button',
			'attrs'		=> [
				['prop' => 'class','value'			=> 'button button-primary'],
				['prop' => 'id','value'				=> "{$tab}_generate_webhook_key"],
				['prop' => 'data-prefix','value'	=> $tab],
				['prop' => 'data-type','value'		=> $profile['method']],
			],
			'label'		=> "{$button_label} " . __('Webhook ID', $ns),
			'tab'		=> $tab,
			'section'	=> $section,
			'callback'	=> 'generate_webhook_key',
			'ui_only'	=> 1
		];

				$section = 'sandbox-section';
		$settings[] = [
			'slug'	=> $section,
			'title'	=> __( 'Sandbox Settings', $ns ),
			'type'	=> 'section',
			'tab'	=> $tab
		];

		        $settings[] = [
			'slug'          => "{$tab}_sandbox",
			'title'         => __( 'Enable Sandbox', $ns ),
			'tooltip'       => __( 'Enabling this setting will run Paypal payments in Sandbox develepor mode.', $ns ),
			'type'          => 'switch',
			'value'			=> isset($profile['sandbox']) ? (int)$profile['sandbox'] : 0,
			'section'       => $section,
			'tab'           => $tab,
		];

        $settings[] = [
			'slug'          => "{$tab}_sandbox_client_id",
			'title'         => __( 'Sandbox Client ID', $ns ),
			'tooltip'       => __( 'Enter your sandbox Client ID here.', $ns ),
			'type'          => 'input',
			'attrs'			=> [ ['prop' => 'data-sandbox-public','value' => 1] ],
			'value'			=> isset($profile['sandbox_client_id']) ? $profile['sandbox_client_id'] : '',
			'tab'           => $tab,
			'section'       => $section,
		];
        $settings[] = [
			'slug'          => "{$tab}_sandbox_client_secret",
			'title'         => __( 'Sandbox Client Secret', $ns ),
			'tooltip'       => __( 'Enter your sandbox Client Secret here.', $ns ),
			'type'          => 'input',
			'attrs'			=> [ ['prop' => 'data-sandbox-secret','value' => 1] ],
			'value'			=> isset($profile['sandbox_client_secret']) ? $profile['sandbox_client_secret'] : '',
			'tab'           => $tab,
			'section'       => $section,
		];

				$sandbox_webhook_key = isset($profile['sandbox_webhook_key']) ? $profile['sandbox_webhook_key'] : '';
		$settings[] = [
			'slug'		=> "{$tab}_sandbox_webhook_key",
			'title'		=> __('Sandbox Webhook ID', $ns),
			'tooltip'   => __('Validates sandbox processes for this account.', $ns ),
			'type'		=> 'readonly',
			'value'		=> $sandbox_webhook_key,
			'tab'		=> $tab,
			'section'	=> $section,
		];

				$button_label = ( $sandbox_webhook_key > '' ) ? __('Refresh', $ns) : __('Generate', $ns);
		$settings[] = [
			'slug'		=> "{$tab}_generate_sandbox_webhook_key",
			'type'		=> 'button',
			'attrs'		=> [
				['prop' => 'class','value'			=> 'button button-primary'],
				['prop' => 'id','value'				=> "{$tab}_generate_sandbox_webhook_key"],
				['prop' => 'data-prefix','value'	=> "{$tab}_sandbox"],
				['prop' => 'data-type','value'		=> $profile['method']],
			],
			'label'		=> "{$button_label} " . __('Sandbox Webhook ID', $ns),
			'tab'		=> $tab,
			'section'	=> $section,
			'callback'	=> 'generate_sandbox_webhook_key',
			'ui_only'	=> 1
		];

        return $settings;
    }

	
	
function generate_webhook_key( $secret_key, $profile_key, $sandbox ){

		$webhook = false;
		$message = '';

		$profile = wpal_ecomm()->settings->get_merchant_profile( $profile_key );

				$profile['sandbox'] = ( $sandbox ) ? 1 : 0;

				$paypal = wpal_ecomm()->get_merchant('paypal');
		$paypal_config = $paypal->setup($profile);

				$params = $paypal->get_authorized_params($profile);
		if( is_wp_error($params) ){
			$message = $params->get_error_message();
			$message = empty($message) ? 'Error authorizing Paypal App' : $message;
		}
		else {
			$post_url = $paypal->get_api_url();
            $post_url .= '/v1/notifications/webhooks';
			$webhook_url = wpal_ecomm_webhooks::get_operation_url('paypal',$profile_key,$sandbox);
			$events = [
								[ 'name' => 'PAYMENT.CAPTURE.COMPLETED' ],
				[ 'name' => 'PAYMENT.CAPTURE.DENIED' ],
				[ 'name' => 'PAYMENT.CAPTURE.REFUNDED' ],
				[ 'name' => 'PAYMENT.CAPTURE.REVERSED' ],
								[ 'name' => 'PAYMENT.SALE.COMPLETED' ],
				[ 'name' => 'PAYMENT.SALE.REFUNDED' ],
				[ 'name' => 'PAYMENT.SALE.REVERSED' ],
				[ 'name' => 'BILLING.SUBSCRIPTION.PAYMENT.FAILED' ],
				[ 'name' => 'BILLING.SUBSCRIPTION.CANCELLED' ],
				[ 'name' => 'BILLING.SUBSCRIPTION.EXPIRED' ]
			];
			$params['body'] = json_encode([
				'url'			=> $webhook_url,
				'event_types'	=> $events
			]);
			$response = wp_remote_post( $post_url, $params );

			if( is_wp_error($response) ){
				$message = $response->get_error_message();
			}
			else{
				$webhook = json_decode(wp_remote_retrieve_body($response));
				if( isset($webhook->id) ){
					$pre = ( $sandbox ) ? 'sandbox_' : '';
					$property = $pre . 'webhook_key';
					wpal_ecomm()->settings->set_profile($profile_key, $webhook->id, $property);
				}
				else if( isset($webhook->message) ){
					$message = $webhook->message;
					$webhook = false;
				}
											}

		}

		if( $webhook ){
			$data = [
				'key' 	=>	$webhook->id,
			];
		}

		return [
			'success'	=> ( $webhook ) ? true : false,
			'message'	=> $message,
			'data'		=> ( $webhook ) ? $data : false
		];

	}

		
function get_order_transaction_id( $order_id, $metadata = false ){

		$metadata = ( $metadata ) ? $metadata : wpal_ecomm()->functions()->get_order_metadata($order_id);
		$type = ( isset($meta['type']) ) ? $meta['type'] : 'single';
		if($type === 'single'){
			$transaction_id = isset($metadata['paypal_transaction_id']) ? $metadata['paypal_transaction_id'] : '';
		}
		else {
						$transaction_id = isset($metadata['subscription_id']) ? $metadata['subscription_id'] : '';
		}
		return $transaction_id;
	}

	
	
function transaction_url( $id, $type = '', $sandbox = false ){

		$sub = ( $sandbox ) ? 'sandbox.' : '';
		return "https://www.{$sub}paypal.com/activity/payment/{$id}";

	}

		
function invoice_actions( $actions, $order_id ){
		return $actions;
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
