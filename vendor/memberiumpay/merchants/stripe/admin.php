<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}



class wpal_ecomm_stripe_admin {

	
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
			'tooltip'       => __( 'Base location for your order forms', $ns ),
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
			'slug'          => "{$tab}_public_key",
			'title'         => __( 'Public Key', $ns ),
			'tooltip'       => __( 'Enter your public key here.', $ns ),
			'type'          => 'input',
			'attrs'			=> [ ['prop' => 'data-public','value' => 1] ],
			'value'			=> isset($profile['public_key']) ? $profile['public_key'] : '',
			'tab'           => $tab,
			'section'       => $section,
		];

        $settings[] = [
			'slug'          => "{$tab}_secret_key",
			'title'         => __( 'Secret Key', $ns ),
			'tooltip'       => __( 'Enter your secret key here.', $ns ),
			'type'          => 'input',
			'attrs'			=> [ ['prop' => 'data-secret','value' => 1] ],
			'value'			=> isset($profile['secret_key']) ? $profile['secret_key'] : '',
			'tab'           => $tab,
			'section'       => $section,
		];

				$webhook_id = isset($profile['webhook_id']) ? $profile['webhook_id'] : '';
		$settings[] = [
			'slug'		=> "{$tab}_webhook_id",
			'type'      => 'hidden',
			'value'		=> $webhook_id,
			'tab'       => $tab,
			'section'   => $section,
		];
				$webhook_key = isset($profile['webhook_key']) ? $profile['webhook_key'] : '';
		$settings[] = [
			'slug'		=> "{$tab}_webhook_key",
			'title'		=> __('Endpoint Secret', $ns),
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
			'label'		=> "{$button_label} " . __('Endpoint Secret', $ns),
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
			'tooltip'       => __( 'Enabling this setting will process Stripe payments in Sandbox developer mode.', $ns ),
			'value'			=> isset($profile['sandbox']) ? (int)$profile['sandbox'] : 0,
			'type'          => 'switch',
			'section'       => $section,
			'tab'           => $tab,
		];

        $settings[] = [
			'slug'          => "{$tab}_sandbox_public_key",
			'title'         => __( 'Sandbox Public Key', $ns ),
			'tooltip'       => __( 'Enter your sandbox public key here.', $ns ),
			'type'          => 'input',
			'attrs'			=> [ ['prop' => 'data-sandbox-public','value' => 1] ],
			'value'			=> isset($profile['sandbox_public_key']) ? $profile['sandbox_public_key'] : '',
			'tab'           => $tab,
			'section'       => $section,
		];
        $settings[] = [
			'slug'          => "{$tab}_sandbox_secret_key",
			'title'         => __( 'Sandbox Secret Key', $ns ),
			'tooltip'       => __( 'Enter your sandbox secret key here.', $ns ),
			'type'          => 'input',
			'attrs'			=> [ ['prop' => 'data-sandbox-secret','value' => 1] ],
			'value'			=> isset($profile['sandbox_secret_key']) ? $profile['sandbox_secret_key'] : '',
			'tab'           => $tab,
			'section'       => $section,
		];

				$sandbox_webhook_id = isset($profile['sandbox_webhook_id']) ? $profile['sandbox_webhook_id'] : '';
		$settings[] = [
			'slug'		=> "{$tab}_sandbox_webhook_id",
			'type'      => 'hidden',
			'value'		=> $sandbox_webhook_id,
			'tab'       => $tab,
			'section'   => $section,
		];
				$sandbox_webhook_key = isset($profile['sandbox_webhook_key']) ? $profile['sandbox_webhook_key'] : '';
		$settings[] = [
			'slug'		=> "{$tab}_sandbox_webhook_key",
			'title'		=> __('Sandbox Endpoint Secret', $ns),
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
			'label'		=> "{$button_label} " . __('Sandbox Endpoint Secret', $ns),
			'tab'		=> $tab,
			'section'	=> $section,
			'callback'	=> 'generate_sandbox_webhook_key',
			'ui_only'	=> 1
		];

        return $settings;
    }

	
	
function generate_webhook_key( $secret_key, $profile_key, $sandbox = 0 ){

		$ns = 'wpal_ecomm';
				$stripe = wpal_ecomm_stripe::get_instance();
		$stripe->init();
		$webhook = false;
		$message = '';
		try {

			\Stripe\Stripe::setApiKey($secret_key);

						$sandbox = ( (int)$sandbox > 0 ) ? 1 : 0;
			$prefix = ( $sandbox > 0 ) ? "sandbox_" : "";
			$profile = wpal_ecomm()->settings->get_merchant_profile($profile_key);
			$id_key = "{$prefix}webhook_id";
			$key_key = "{$prefix}webhook_key";
			$webhook_id = ( isset($profile[$id_key]) ) ? $profile[$id_key] : '';
			$webhook_key = ( isset($profile[$key_key]) ) ? $profile[$key_key] : '';
			$url = wpal_ecomm_webhooks::get_operation_url('stripe',$profile_key,$sandbox);
			$events = apply_filters( 'wpal/ecomm/stripe/webhook/events', [
				'payment_intent.payment_failed',
				'payment_intent.succeeded',
				'invoice.payment_failed',
				'invoice.payment_succeeded',
				'customer.subscription.updated',
				'customer.subscription.deleted',
				'charge.refunded'
			] );

						if( $webhook_id > '' && $webhook_key > '' ){
				try {
					$webhook = \Stripe\WebhookEndpoint::update($webhook_id, [
						'url' 				=> $url,
						'enabled_events'	=> $events,
					]);
					$data = [
						'id' 	=>	$webhook_id,
						'key'	=>	$webhook_key
					];
				}
				catch (\Stripe\Exception\InvalidRequestException $e) {
					$message = $e->getMessage();
					$webhook_id = '';
				}
			}
						if( ! $webhook_id > '' ){
				try{
					$webhook = \Stripe\WebhookEndpoint::create([
						'url' 				=> $url,
						'enabled_events'	=> $events,
					]);
					$data = [
						'id' 	=>	$webhook->id,
						'key'	=>	$webhook->secret
					];
										wpal_ecomm()->settings->set_profile($profile_key, $webhook->id, $id_key);
					wpal_ecomm()->settings->set_profile($profile_key, $webhook->secret, $key_key);
					$message = __("Webhook Created", $ns);
				}
				catch (\Stripe\Exception\ApiErrorException $e){
					$message = $e->getMessage();
				}
			}
	 	}
				catch (\Stripe\Error\Authentication $e) {
			$message = $e->getMessage();
		}

		return [
			'success'	=> ( $webhook ) ? true : false,
			'message'	=> $message,
			'data'		=> ( $webhook ) ? $data : false
		];
	}

	
	
function transaction_url( $id, $type = '', $sandbox ){

		$path = ( $sandbox ) ? 'test/' : '';
		return "https://dashboard.stripe.com/{$path}{$type}/{$id}";
	}

		
function get_order_transaction_id( $order_id, $metadata = false ){
		if($metadata){
			return $metadata['payment_intent_id'];
		}
		else{
			$prefix = wpal_ecomm()->functions()->get_prefix();
			return get_post_meta($order_id,"{$prefix}payment_intent_id", true);
		}
	}

		
function invoice_actions( $actions, $order_id ){
		$actions['download_invoice'] = __('Download', 'wpal_ecomm');
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
