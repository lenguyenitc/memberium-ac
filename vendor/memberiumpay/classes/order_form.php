<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}



class wpal_ecomm_order_form {

	
	public 
function order_form_func( $atts, $content, $tag ){
		$ns = 'wpal_ecomm';
		$frontend = wpal_ecomm()->frontend;

				$html = '';

		$atts = shortcode_atts( [
			'id' 			=>	0,
			'classname' 	=> '',
			'template'		=> 'order-form.php',
			'theme'			=> '',
			'color__main'	=> '',
			'color__accent'	=> ''
		], $atts );

		$id = $atts['id'];
		$className = esc_attr($atts['classname']);
		$className .= ( $className > '' ) ? ' ' : '';
		$template = esc_attr($atts['template']);
		$theme_dir = esc_attr($atts['theme']);
		$color__main = esc_attr($atts['color__main']);
		$color__accent = esc_attr($atts['color__accent']);

				$user = wp_get_current_user();
		$user_id = (is_object($user) && get_class($user) == 'WP_User') ? $user->ID : 0;
		$error = false;
		$customer = wpal_ecomm()->customer();

				if( (int)$id < 1 ){
			$error = __('Please provide ID for the order form to display.', $ns);
			return $frontend->admin_error_msg($error);
		}
		else{
			if( ! wpal_ecomm()->settings->post_exists($id) ){
				$error = __('There is no order form with the ID', $ns) . ' ' . $id;
				return $frontend->admin_error_msg($error);
			}
		}

				$order_form_config = wpal_ecomm()->functions()->order_form_config($id);
		if( empty($order_form_config) ){
			$error = __('Order Form Config is Empty', $ns);
			return $frontend->admin_error_msg($error);
		}

				$save_errors = isset($order_form_config['save_errors']) ? $order_form_config['save_errors'] : false;
		if( $save_errors ){
			return $frontend->admin_error_msg($save_errors);
		}

				$success_id = isset($_GET['success']) ? $_GET['success'] : 0;
		if( (int)$success_id > 0 ){
			if( wpal_ecomm()->settings->post_exists($success_id) ){
				$order_form_config['className'] = $className;
				$display = $this->order_thank_you_display($id, $success_id, $order_form_config);
				if( $display > '' ){
					$frontend->set_to_json('cleanse_param', 'success');
					return $display;
				}
			}
		}

		$order_form_vars = ['products','pricing_plans','merchants'];
		foreach ($order_form_vars as $var) {
			${$var} = false;
			if( isset($order_form_config["order_form_{$var}"]) ){
				${$var} = $order_form_config["order_form_{$var}"];
				${$var} = ( !empty(${$var}) ) ? array_flip(explode(',', trim(${$var}, ','))) : false;
			}
		}
		$order_form_type = $order_form_config['order_form_type'];
		$is_subscription = ( $order_form_type === 'subscription' );
		$subscription_map = $order_form_config['subscription_map'];
		$currency = $order_form_config['order_form_currency'];
		$missing_plans = ( $is_subscription && empty($pricing_plans) );

				if( ! $products || ! $merchants || $missing_plans ){
			$error = '';
			if( ! $products ){
								$error .= __('You must define at least one product for your order form', $ns);
			}
			$error .= ( ! $products && ! $merchants ) ? ' and ' : '';
			if( ! $merchants ){
								$error .= __('You must define at least one merchant profile for your order form', $ns);
			}
			$error .= ( ! $products || ! $merchants ) ? ' and ' : '';

			if( $missing_plans ){
				$error .= __('You must define at least one pricing plan for your subscription order form', $ns);
			}
			return $frontend->admin_error_msg($error);
		}
				$items = [];
		foreach ($products as $product_id => $product) {
						if( ! wpal_ecomm()->settings->post_exists($product_id) ){
				$error .= __('No product found with ID', $ns) . ' ' . $product_id;
				return $frontend->admin_error_msg($error);
			}
			$product = wpal_ecomm_products::get_product_config($product_id);
			if( ! $product ){
				$name = get_the_title($product_id);
				$error .= $name . ' ' . __('product is not configured.', $ns) . ' ' . $product_id;
				return $frontend->admin_error_msg($error);
			}

			$product_type = $product['product_type'];
						$product['image'] = get_the_post_thumbnail_url($product_id);
			$product['qty']	= 1;

						if( !empty($product['duplicates']) ){
				if( $customer->has_purchased_product( $user_id, $product ) ){
					$product['purchased'] = 1;
					if( empty($product['duplicate_message']) ){
						$support_text = __("contact support", $ns);
						$support_email = wpal_ecomm()->settings->get_support_email();
						if( !empty($support_email) ){
							$support_text = "<a href=\"mailto:{$support_email}\">{$support_text}</a>";
						}
						$product['duplicate_message'] = sprintf(__('You have already purchased %s. If you are having issues with your purchase please %s.', $ns), get_the_title($product_id), $support_text);
					}
				}
			}

			if( $product_type === 'subscription' ){
								$checked = 'checked';
				$product['plans'] = [];
				foreach ($pricing_plans as $plan_id => $plan) {
					$plan_content = get_post_field('post_content', $plan_id);
					if( !empty($plan_content) ){
						$plan = json_decode($plan_content,true);
						$plan['id'] = $plan_id;
						$plan['product_id'] = $product_id;
						$is_trial = ( (int)$plan['trial'] > 0 && (int)$plan['trial_days'] > 0 );
						$interval = ($is_trial) ? (int)$plan['trial_days'] : $plan['interval'];
						$interval_count = ( !empty($plan['bill_interval']) && (int)$plan['bill_interval'] > 0 ) ? (int)$plan['bill_interval'] : 1;
						$plan['next_bill'] = wpal_ecomm()->functions()->get_next_date($interval, $interval_count);
						if( $checked > '' ){
							$product['price'] = $plan['amount'];
														$product['on_sale'] = 0;
							$product['sale_price'] = $plan['amount'];
							$plan['checked'] = $checked;
							$checked = '';
						}
						$product['plans'][] = $plan;
					}
				}
			}
			$items[] = $product;
		}

		$products = apply_filters('wpal/ecomm/order/form/items', $items, $id, $order_form_config, $user_id);

				$default_merchant = false;
		$merchant_profiles = [];
		$methods = [];
		$active_payment_methods = wpal_ecomm()->settings->get_option_select('active_payment_methods');
		foreach ($merchants as $merchant_id => $merchant) {
			$merchant = wpal_ecomm()->settings->get_merchant_profile($merchant_id);
			if($merchant){
				$method = $merchant['method'];
												if( in_array($method, $merchant_profiles) ){
					$merchant = false;
				}
				else if ( ! in_array($method, $active_payment_methods) ){
					$merchant = false;
				}
			}
			if($merchant){
				$default_merchant = ( ! $default_merchant ) ? $method : $default_merchant;
				$merchant_profiles[$method] = $merchant;
				$merchant_profiles[$method]['profile_id'] = $merchant_id;
			}
		}

				if( empty($merchant_profiles) ){
			$error .= __('There must be at least one configured active merchant to display order form.', $ns);
			return $frontend->admin_error_msg($error);
		}

				$promos = [];

				$cart = $this->get_default_cart( $products, $promos );
		$cart = apply_filters('wpal/ecomm/order/form/default/cart', $cart, $id, $order_form_config, $user_id);

				$contact = $customer->get_contact_fields('billing', $order_form_config);

				if( $user_id < 1 ){
			$email_index = array_search('billing_email', array_column($contact, 'name'));
			$label = __('Create Account Password', $ns);
			$label .= apply_filters("wpal/ecomm/field/required", " <span class=\"required\">*</span>");
			$min = wpal_ecomm()->get_config('min_password_length');
			$pass_error = sprintf(_x('Your password must be at least %d characters long with no spaces.', 'wpal/ecomm/new/password', $ns), $min);
			$contact[] = [
				'label'		=> $label,
				'name' 		=> "new_account_password",
				'className'	=> "wpal-ecomm-password-input",
				'type'		=> "password",
				'validate'	=> "password",
				'required'	=> 1,
				'msg'		=> $pass_error,
				'priority'	=> $contact[$email_index]['priority'] + 50,
				'attrs'		=> [
					[ 'prop' => 'minlength', 'value' => $min ],
				]
			];
			$contact = array_values($contact);
		}

		add_filter('wpal/ecomm/order/form/contact/fields', [$customer, 'populate_order_billing_meta'], 10, 4);
		$contact = apply_filters('wpal/ecomm/order/form/contact/fields', $contact, $user_id, $id, 'billing_' );

				$billing = $customer->get_address_fields('billing', $order_form_config);
		add_filter('wpal/ecomm/order/form/billing/fields', [$customer, 'populate_order_billing_meta'], 10, 4);
		$billing = apply_filters('wpal/ecomm/order/form/billing/fields', $billing, $user_id, $id, 'billing_' );

		$consent = $customer->get_consent_fields($order_form_config);
		$consent = apply_filters('wpal/ecomm/order/form/consent/fields', $consent, $user_id, $id);

				$order_forms = $frontend->get_to_json('order_forms');
		$order_forms = ( is_null($order_forms) ) ? [] : $order_forms;
		$_count = count($order_forms) + 1;
		$unique_id = md5("{$id}-{$_count}");
		$form_data = [
			'id'				=> $unique_id,
			'type'				=> $order_form_type,
			'theme'				=> $theme_dir,
			'color__main'		=> $color__main,
			'color__accent'		=> $color__accent,
			'order_form_id'		=> $id,
			'fields'			=> [
				'contact'	=> $contact,
				'billing'	=> $billing,
				'consent'	=> $consent,
			],
			'cart'				=> $cart,
			'merchants'			=> $merchant_profiles,
			'default'			=> $default_merchant,
			'currency'			=> $currency,
			'products'			=> $products,
						'descriptor'		=> wpal_ecomm()->settings->get_option('descriptor'),
			'I18n'				=> $this->I18n_translations($id),
			'tmpls'				=> $this->get_templates($id)
		];
		$order_forms[$_count] = apply_filters('wpal/ecomm/order/form/data', $form_data, $user_id);
		$frontend->set_to_json('order_forms', $order_forms);

				$include = $frontend->template_part_path( $template, $theme_dir );

		if( $include > '' ){
						if( $color__main > '' || $color__accent > '' ){
				wpal_ecomm_dynamic_css::order_form_styles( $order_forms[$_count] );
			}

			include $include;
		}

		return $html;
	}

	
	
function get_default_cart( $products, $promos ){

		$subtotal = 0;
		$discount = 0;
		$tax = 0;
		$total = 0;
		$items = [];
		$subscription = false;
		$trial = false;
		foreach ($products as $key => $product) {

						$default = true;
			if( $default ){
				$subscription = ( $product['product_type'] === 'subscription' ) ? true : false;
				if($subscription){
					$plans = $product['plans'];
					$checked = array_search('checked', array_column($plans, 'checked'));
					$plan = $plans[$checked];
					$price = $plan['amount'];
					$product['plan_id'] = $plan['id'];
					$product['trial'] = ( (int)$plan['trial'] > 0 && (int)$plan['trial_days'] > 0 ) ? 1 : 0;
				}
				else{
					$price = $this->product_price($product);
				}
				$items[] = $product;
				$subtotal = $subtotal + $price;
								$tax = $tax + 0;
			}
		}
		$total = $subtotal + $tax;
		$total = $total - $discount;

		$cart = [
			'items' 	=> $items,
			'subtotal'	=> $subtotal,
			'tax'		=> $tax,
			'discount'	=> $discount,
			'total'		=> $total
		];
		if( $subscription ){
			$cart['subscription'] = true;
		}

		return $cart;
	}

	
	
function product_price($product){

		$key = ( (int)$product['on_sale'] > 0 ) ? 'sale_price': 'price';
		return wpal_ecomm()->functions()->price_to_decimal($product[$key]);

	}

		
function order_thank_you_display($order_form_id, $order_id, $config){

		$html = '';
		$meta = wpal_ecomm()->functions()->get_order_metadata($order_id);
		if( empty($meta) ){
			return $html;
		}
		$className = $config['className'];
		$config['order_id'] = $order_id;
		$thankyou = wpal_ecomm()->functions()->get_thankyou_config($config);
		$order_user = $meta['user_id'];
		$user_id = get_current_user_id();

		if( (int)$user_id === (int)$order_user && $order_user > 0 ){
			$html .= "<div class=\"{$className}wpal-ecomm wpal-ecomm-order-form wpal-ecomm-order-thankyou\" ";
				$html .= "data-order-form-id=\"{$order_id}\">";
				$html .= $thankyou['content'];
			$html .= "</div>";
		}

		return $html;

	}

		
function I18n_translations($id){

		return apply_filters( 'wpal/ecomm/order/form/I18n', [
            'titles'	=> [
				'login'				=> __('Login to Account', 'wpal_ecomm'),
				'login_trigger'		=> __('Login with email', 'wpal_ecomm'),
				'login_form'		=> __('Log in to your account', 'wpal_ecomm'),
				'create_account'	=> __('Create Account', 'wpal_ecomm'),
				'contact'			=> __('Contact Info', 'wpal_ecomm'),
				'or'				=> __('or', 'wpal_ecomm'),
                'billing'			=> __('Billing Info', 'wpal_ecomm'),
                'order'				=> __('Order Details', 'wpal_ecomm'),
                'merchants'			=> __('Payment Methods', 'wpal_ecomm'),
				'products'			=> __('Product Details', 'wpal_ecomm'),
                'subscriptions'		=> __('Select Plan', 'wpal_ecomm'),
                'checkout_btn'		=> __('Checkout Now', 'wpal_ecomm'),
                'default_method'	=> __('Make Default', 'wpal_ecomm'),
                'confirm_payment'	=> __('Confirm Payment', 'wpal_ecomm'),
				'new_card'			=> __('Add New Card', 'wpal_ecomm'),
				'payment_error'		=> __('Payment Error', 'wpal_ecomm'),
				'order_error'		=> __('Order Error', 'wpal_ecomm')
            ],
            'errors'	=> [
                'order_creation'	=> __('There has been an error creating your order. Error : ', 'wpal_ecomm'),
				'unknown_error'		=> __('There has been an error with your payment please contact <a href="%s">support</a> for more details', 'wpal_ecomm'),
                'try_new_card'		=> __('Please try again with a new card.', 'wpal_ecomm'),
                'generic_order'		=> __('Error Creating Order', 'wpal_ecomm')
            ],
            'loading'	=> [
                'creating_order'		=> __('Creating Order', 'wpal_ecomm'),
                'process_payment'		=> __('Processing Payment', 'wpal_ecomm'),
                'approve_paypal_order'	=> __('Approving Paypal order', 'wpal_ecomm'),
                'finalize_order'		=> __('Finalizing order', 'wpal_ecomm')
            ],
            'sprintf'	=> [
                'subscription'		=> __('%s%s (%s) / %s', 'wpal_ecomm'),                'trial'				=> __('<span class="subscription-trial">Trial Offer for %s days</span>', 'wpal_ecomm'),
				'next_due'			=> __('%s%s (%s) on %s'),				'subscription_total'=> __('%s ', 'wpal_ecomm'),
				'billed_interval'	=> __('billed per %s', 'wpal_ecomm'),
				'payment_method'	=> __('%s **** %s', 'wpal_ecomm')
            ],
			'totals'	=> wpal_ecomm()->functions()->totalsI18n( "order/form{$id}"),
        ], $id );
	}

		
function get_templates($id){

		return apply_filters('wpal/ecomm/order/form/tmpls', [
			'login'				=> 'login.php',
			'modal'				=> 'modal.php',
			'loading'			=> 'loading.php',
			'contact_fields'	=> 'contact-fields.php',
			'billing_fields'	=> 'billing-fields.php',
			'product_details'	=> 'product-details.php',
			'subscriptions'		=> 'subscriptions.php',
			'consent_fields'	=> 'consent-fields.php',
			'cart'				=> 'cart.php',
			'payment_methods'	=> 'payment-methods.php'
		], $id);

	}

	
	static $instance = null;

	public static 
function get_instance() {
		if ( is_null( self::$instance ) ) {
            self::$instance = new self;
        }
        return self::$instance;
	}

}
