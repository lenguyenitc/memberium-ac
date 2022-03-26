<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}



class wpal_ecomm_order {

    private $merchant;
    private $merchant_class = null;
    private $merchant_functions = null;

	        	static 
function ajax_process(){

		        
		$data   = self::get_instance()->posted_order_data($_POST);
		$action = $data['action'];
		if( $action === 'wpal_ecomm_process_order' ){
			$response = self::get_instance()->process_order($data);
		}
		else if( $action === 'wpal_ecomm_update_merchant_session' ){
			$response = self::get_instance()->update_merchant_session($data);
		}
		else if( $action === 'wpal_ecomm_create_user' ){
			$response = wpal_ecomm()->customer()->create_wp_customer($data);
		}
		else if( $action === 'wpal_ecomm_transactions' ){
			$response = self::get_instance()->handle_transactions($data);
		}
		if( !empty($response['error']) ){
            wp_send_json_error($response);
        }
        else{
            wp_send_json_success($response);
        }

	}

                private 
function process_order($data){

        $ns = 'wpal_ecomm';
        $error = false;
		$user_id = $data['user_id'];
        $response = [
            'message'	=> '',
            'order_id'	=> 0,
            'user_id'	=> $user_id,
            'error'     => $error
        ];

        $this->merchant = $data['merchant'];
        $this->merchant_class = wpal_ecomm()->get_merchant($this->merchant);
        $this->merchant_functions = $this->merchant_class->functions();

                if( $user_id > 0 ){
			wpal_ecomm()->customer()->update_order_customer($user_id, $data);
        }
				else {
			$invalid_password = wpal_ecomm()->customer()->validate_order_password($data);
			if($invalid_password){
				$response['error'] = true;
				$response['message'] = $invalid_password;
				return $response;
			}
		}

                $create_order = $this->create_order($data, 'processing');
        $response['order_id'] = $create_order['order_id'];
        $response = wp_parse_args($response, $create_order);
        if( $create_order['message'] > '' ){
            $error = $create_order['message'];
			$response['error'] = true;
            $response['message'] = $error;
        }
        else{
            $order_form_id = ( isset($data['order_form_id']) ) ? $data['order_form_id'] : 0;
			$config = wpal_ecomm()->functions()->order_form_config($order_form_id);
            $config['order_form_id'] = $order_form_id;
            $config = wp_parse_args($config, $response);
            $response['thank_you'] = wpal_ecomm()->functions()->get_thankyou_config($config);
			$response['message'] = __('Order Created', $ns);
        }

        return $response;
    }

    
    
function create_order($data, $status = 'processing'){

        $ns = 'wpal_ecomm';
        $error = false;
        $prefix = wpal_ecomm()->functions()->get_prefix();
        $post_type = wpal_ecomm()->get_config('orders_slug');
		$order_id = ( isset($data['order_id']) ) ? (int) $data['order_id'] : 0;
        $response = [
            'order_id' 	=> $order_id,
            'error'		=> '',
			'message'	=> ''
        ];
		if( $order_id < 1 ){
				        $order_id = wp_insert_post([
	            'post_status'	=> 'publish',
	            'post_type'		=> $post_type,
	        ]);
		}

                if( $order_id ){

            $full_name = '';
            $merchant = $data['merchant'];
            $sandbox = ( (int)$data['sandbox'] > 0 );
			$subscription = ( $data['type'] === 'subscription' );
            $total = 0;

                        $metas = [
                "{$prefix}date_created"		=> time(),
                "{$prefix}type"				=> $data['type'],
                "{$prefix}order_form_id"	=> $data['order_form_id'],
                "{$prefix}profile_id"		=> $data['profile_id'],
                "{$prefix}merchant"			=> $merchant,
                "{$prefix}status"			=> $status,
                "{$prefix}currency"			=> $data['currency'],
                "{$prefix}sandbox"			=> (int)$data['sandbox'],
            ];

			if( (int) $data['user_id'] > 0 ){
				$metas["{$prefix}user_id"] = $data['user_id'];
			}

            $loops = ['contact','consent','cart','items'];
			$product_ids = [];
            foreach ($loops as $loop) {
                $loop_data = ( isset($data[$loop]) && is_array($data[$loop]) ) ? $data[$loop] : [];
                if( !empty($loop_data) ){
                    if( $loop === 'contact' ){
                        foreach ($loop_data as $k => $value) {
                            if( $k === 'billing_full_name' ){
                                $full_name = $value;
                            }
							else if( $k != 'new_account_password' ){
								$value = ( $k === 'billing_email' ) ? strtolower($value) : $value;
								$metas[$k] = $value;
							}
                        }
                    }
					else if( $loop === 'consent' ){
						foreach ($loop_data as $k => $value) {
							if( (int)$value > 0 ){
								$metas["{$prefix}consent/{$k}"] = $value;
							}
						}
					}
                    else if( $loop === 'cart' ){
												if( ! $subscription ){
							foreach ($loop_data as $k => $value) {
	                            $metas["{$prefix}{$k}"] = $value;
	                            $total = ( $k === 'total' ) ? $value : $total;
	                        }
						}
                    }
                    else if( $loop === 'items' ){
                        $i = 0;
                        foreach ($loop_data as $item) {
							$i++;
							$item['line'] = $i;
							$metas["{$prefix}line/item"] = $item;
							$metas["{$prefix}product/id"] = $item['id'];
							if( $subscription ){
								$metas["{$prefix}plan/id"] = $item['plan_id'];
							}
                        }
                    }
                }
            }

                        add_filter("wpal/ecomm/new/order/{$merchant}/args", [$this->merchant_functions, 'new_wp_order_args'], 10, 4 );

                        $order_title = ( $sandbox ) ? __('Sandbox', $ns) . ' ' : '';
			$order_title .= ( $subscription ) ? __('Subscription #', $ns) : __('Order #', $ns);
			$order_title .= $order_id;
            $new_order_args = apply_filters("wpal/ecomm/new/order/{$merchant}/args",[
                'ID'			=> $order_id,
                'post_status' 	=> 'publish',
                'post_type'		=> $post_type,
                'post_title'	=> $order_title,
                'meta_input'	=> $metas
            ], $order_id, $data, $prefix);
            $order_id = wp_insert_post($new_order_args);
            if( ! $order_id ){
                $error = __('Unable to create order.', $ns);
            }
                        else {

                $response['order_id'] = $order_id;

				                add_filter("wpal/ecomm/new/order/{$merchant}", [$this->merchant_functions, 'new_wp_order_created'], 10, 2 );
                $response = apply_filters("wpal/ecomm/new/order/{$merchant}", $response, $data);

                                $response = apply_filters("wpal/ecomm/new/order", $response, $data);

								if( is_wp_error($response['error']) ){
					$response['message'] = $response['error']->get_error_message();
				}
            }
        }
        else {
            $error = __('No order ID', $ns);
        }

        if( $error ){
            $response['error'] = new WP_Error('wpal/ecomm/order/create', $error);
        }

        return $response;
    }

    
    static 
function wp_order_created( $response, $data ){

        $ns = 'wpal_ecomm';

        $order_id = $response['order_id'];
        $order_form_id = ( isset($data['order_form_id']) ) ? $data['order_form_id'] : 0;
        if($order_form_id){

			$config = wpal_ecomm()->functions()->order_form_config($order_form_id);

                        $send_success = (int)$config['send_success_email'];
            if( $send_success > 0 ){
                $to = $config['success_email'];
                if( $to > '' ){
                    $order_title = get_the_title($order_id);
                    $site_name = get_bloginfo('name');
                    $subject = "{$order_title} - {$site_name}";
                    $edit_link = admin_url( "post.php?post={$order_id}&amp;action=edit", 'https' );
                    wpal_ecomm_email::send_mail($to, [
                        'subject'	=> $subject,
                        'title'		=> __("A successful order has been made!", $ns),
                        'content'	=> [
                            [
                                'type'		=> 'button',
                                'content'	=> __("View Order", $ns),
                                'url'		=> $edit_link
                            ]
                        ]
                    ]);
                }
            }
        }
        return $response;
    }

    
	
function posted_order_data($post){

				$data = [ 'contact' => [] ];
		foreach ($post as $k => $value) {
						if( !empty($value) && $value[0] === '{' ) {
				$post[$k] = $post[$k] > '' ? json_decode(stripslashes($post[$k]), true) : false;
			}
			if( in_array($k, [ 'contact', 'billing', 'payment_info' ]) ){
				$data['contact'] = wp_parse_args($post[$k], $data['contact']);
				if( $k !== 'contact' ){
					unset($post[$k]);
				}
			}
			else{
				$data[$k] = $post[$k];
			}
		}
		return apply_filters("wpal/ecomm/posted/order/data", $data);
	}

		
function update_merchant_session($data){

		$this->merchant = $data['merchant'];
        $this->merchant_class = wpal_ecomm()->get_merchant($this->merchant);
        $this->merchant_functions = $this->merchant_class->functions();
		return $this->merchant_functions->update_session($data);

	}

	
function handle_transactions($data){
		$merchant_class = wpal_ecomm()->get_merchant($data['merchant']);
		return $merchant_class->functions()->handle_form_transactions($data);
	}

	
	static 
function wp_user_customer_created( $user_id, $order_id ){
		$meta = wpal_ecomm()->functions()->get_order_metadata($order_id);
		$profile_id = isset($meta['profile_id']) ? $meta['profile_id'] : false;
		if( empty($profile_id) ){
			return;
		}
		$profile = wpal_ecomm()->settings->get_merchant_profile($profile_id);
		if( ! $profile ){
			return;
		}
		$type = isset($meta['type']) ? $meta['type'] : false;
		if( $type === 'subscription' ){
			$wp_invoice_id = 0; 			do_action( "wpal/ecomm/subscription/payment/succeeded", $order_id, $wp_invoice_id, $profile );
		}
		else if( $type === 'single' ){
			do_action( "wpal/ecomm/order/payment/succeeded", $order_id, $profile );
		}
				$merchant = wpal_ecomm()->functions()->get_order_merchant($order_id);
		$merchant_class = wpal_ecomm()->get_merchant($merchant);
		if( $merchant_class ){
			$merchant_functions = $merchant_class->functions();
			if( method_exists($merchant_functions, 'process_order_queue') ){
				add_action("wpal/ecomm/process/order/queue/{$merchant}", [$merchant_functions, 'process_order_queue'], 10, 2);
				do_action("wpal/ecomm/process/order/queue/{$merchant}", $order_id, $user_id);
			}
		}

		return;
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
