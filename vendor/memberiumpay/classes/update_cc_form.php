<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}



class wpal_ecomm_update_cc_form {

	
	public 
function update_cc_form_func( $atts, $content, $tag ){

		static $form_id = 1;

		$user_id = get_current_user_id();
		if ( (int)$user_id < 1 ) {
			return;
		}

		$ns = 'wpal_ecomm';
		$frontend = wpal_ecomm()->frontend;

				$html = '';

		$atts = shortcode_atts( [
			'id' 			=>	"update-cc-form-{$form_id}",
			'className' 	=> '',
			'template'		=> 'update-cc-form.php',
			'theme'			=> '',
			'color__main'	=> '',
			'color__accent'	=> '',
			'failure_keys'	=> '',
			'success_keys'	=> '',
			'redirect'		=> ''
		], $atts );

		$id = esc_attr($atts['id']);
		$className = esc_attr($atts['className']);
		$className .= ( $className > '' ) ? ' ' : '';
		$template = esc_attr($atts['template']);
		$theme_dir = esc_attr($atts['theme']);
		$color__main = esc_attr($atts['color__main']);
		$color__accent = esc_attr($atts['color__accent']);

		$include = $frontend->template_part_path( $template, $theme_dir );
		if( $include ){

						$customer = wpal_ecomm()->customer();
			$billing_fields = $customer->populate_account_fields( $customer->get_address_fields(), $user_id );
			$billing = $customer->get_user_billing_meta($user_id);
			$email = $billing['billing_email'];
			$invoices = '';

						$details_data = [];
			$payment_details = $customer->get_payment_details($user_id);
			$requires_payment_info = false;
			$can_pay_orders = false;
			$has_invoices = false;
			if( $payment_details ){
				foreach ($payment_details as $profile_id => $details) {
					$merchant = $details['merchant'];
					$merchant_class = wpal_ecomm()->get_merchant($merchant);
					$profile = wpal_ecomm()->settings->get_merchant_profile($profile_id);
					$sandbox = ( (int)$profile['sandbox'] > 0 );
					$index = ( $sandbox ) ? 'sandbox' : 'details';
					$config = false;
					if( !empty($details[$index]) ){
						$config = $details[$index];
						$config['merchant'] = $merchant;
						$config['profile_id'] = $profile_id;
						$customer_id = $config['customer_id'];
						$config['config'] = $merchant_class->my_account_config($profile, $customer_id, $user_id, 'update_cc_form', $form_id);
						$has_card_info = ( !empty($config['card']) );
						if( $has_card_info ){
							$requires_payment_info = true;
													}
												$invoices = $customer->get_past_due_invoices($user_id, $merchant);
						if($invoices){
							$has_invoices = true;
							$config['invoice_table'] = $this->get_invoices_table($invoices);
							if( (int)$config['config']['can_update'] > 0 ){
								$can_pay_orders = true;
							}
						}
						else {
							$config['invoice_table'] = '';
							if( ! $has_card_info ){
								unset($details_data[$profile_id]);
							}
						}

						$details_data[$profile_id] = $config;

												if( $merchant === 'stripe' ){
							$postal_index = array_search('billing_postcode', array_column($billing_fields, 'name'));
							unset($billing_fields[$postal_index]);
						}
					}
				}
				if( $has_invoices ){
					add_filter('wpal/ecomm/update/CC/tmpls', [$this, 'get_templates_over_due_filter'], 10, 3);
				}
				if( $can_pay_orders ){
					add_filter('wpal/ecomm/update/CC/I18n', [$this, 'get_I18n_over_due_filter'], 10, 3);
				}
			}

			$payment_info = ( $requires_payment_info ) ? $customer->get_payment_fields($user_id) : [];
			$update_cc_data = $frontend->get_to_json('update_cc');
			$update_cc_data = is_null($update_cc_data) ? [] : $update_cc_data;
			$update_cc_data[] = [
				'form_id'		=> $form_id,
				'fields'		=> [
					'payment_info'	=> $payment_info,
					'billing'		=> $billing_fields
				],
				'contact'		=> [
					'billing_email'	=> $email,
					'bill' 			=> $billing,
				],
				'script'		=> WPAL_ECOMM_URL . 'assets/update-cc.js?v='.WPAL_ECOMM_VERSION,
				'I18n'			=> $this->I18n_translations($user_id, $form_id),
				'tmpls'			=> $this->get_templates($user_id, $form_id),
				'theme'			=> $theme_dir,
				'failure_keys'	=> $this->cleanse_keys($atts, 'failure_keys'),
				'success_keys'	=> $this->cleanse_keys($atts, 'success_keys'),
				'redirect'		=> $atts['redirect'],
				'payment_info'	=> $details_data
			];
			$frontend->set_to_json('update_cc',$update_cc_data);
			include $include;
			if( $invoices ){
				remove_filter('wpal/ecomm/update/CC/tmpls', [$this, 'get_templates_over_due_filter'], 10);
			}
		}

		$form_id++;
		return $html;
    }

	
function get_invoices_table( $invoices ){

		if( $invoices ){
			$rows = [];
			foreach ($invoices as $invoice) {
				$rows[] = [
					'id'			=> $invoice['id'],
					'merchant_id'	=> $invoice['merchant_id'],
					'name'			=> $invoice['order_name'],
					'period'		=> $invoice['period'],
					'total'			=> $invoice['total'],
				];
			}

			return [
				'attrs'		=> [
					[
						'prop'	=> "class",
						'value'	=> "wpal-ecomm-table overdue-invoices"
					]
				],
				'columns'	=> [
					'id'		=> __('ID', 'wpal_ecomm'),
					'name'		=> __('Name','wpal_ecomm'),
					'period'	=> __('Period','wpal_ecomm'),
					'total'		=> __('Total','wpal_ecomm'),
				],
				'hidden'	=> ['id'],
				'rows'		=> $rows,
				'I18n'		=> [
					'item'			=> __('Invoice','wpal_ecomm'),
					'items'			=> __('Invoices','wpal_ecomm'),
					'no_results'	=> __('No invoice found','wpal_ecomm'),
				]
			];
		}
		return false;
	}

		
function I18n_translations( $user_id, $form_id ){
		return apply_filters( 'wpal/ecomm/update/CC/I18n', [
            'titles'	=> [
				'update_card'		=> __('Update Card', 'wpal_ecomm'),
				'update_button'		=> __('Update Card', 'wpal_ecomm'),
				'update_address'	=> __('Update Billing Address', 'wpal_ecomm'),
				'credit_card'		=> __('Credit card', 'wpal_ecomm'),
				'new_card'			=> __('Add New Credit Card', 'wpal_ecomm'),
				'form_legend'		=> __('Update Credit Card', 'wpal_ecomm'),
				'billing_legend'	=> __('Billing Address', 'wpal_ecomm'),
				'confirm_title'		=> __('Comfirm Update', 'wpal_ecomm'),
				'past_due'			=> __('Past Due', 'wpal_ecomm')
			],
			'loading'	=> [
				'updating'	=> __('Updating details', 'wpal_ecomm'),
				'loading'	=> __('Loading Please Wait', 'wpal_ecomm')
			],
			'sprintf'	=> [
				'not_found_wrap'	=> __('<div class="wpal-ecomm-not-found %s">%s</div>','wpal_ecomm'),
				'payment_method'	=> __('%s **** %s', 'wpal_ecomm'),
				'confirm_content'	=> __('Confirm card update for %s', 'wpal_ecomm'),
				'current_card'		=> __('Unable to process current card %s **** %s.<br/>Please update the card on your account.', 'wpal_ecomm')
			]
		], $user_id, $form_id );
	}

	
function get_I18n_over_due_filter( $I18n, $user_id, $form_id ){
		$I18n['titles']['update_button'] = __('Update Card & Complete Orders', 'wpal_ecomm');
		return $I18n;
	}

		
function get_templates( $user_id, $form_id ){

		return apply_filters( 'wpal/ecomm/update/CC/tmpls', [
			'modal'					=> 'modal.php',
			'loading'				=> 'loading.php',
			'fieldset'				=> 'fieldset.php',
			'payment_info'			=> 'account-payment-info.php',
			'billing_fields'		=> 'billing-fields.php',
			'billing_details'		=> 'billing-details.php',
		], $user_id, $form_id );

	}

	
function get_templates_over_due_filter( $templates, $user_id, $form_id ){
		$templates['table'] = 'table.php';
				return $templates;
	}

	
function cleanse_keys( $data, $key, $to_array = false ){
		$keys = '';
		if( !empty($data[$key]) ){
			$keys = explode(',', trim($data[$key], ',') );
			$keys = array_unique($keys);
			if( ! $to_array ){
				$keys = implode (", ", $keys);
			}
		}
		return $keys;
	}

	static 
function update_cc_process() {
				wpal_ecomm()->set_doing_remote_update(true);

		$notice = [
			'id'		=> 'wpal-ecomm-error',
			'title' 	=> __('Error', 'wpal_ecomm'),
			'content'	=> __('There has been an error', 'wpal_ecomm'),
		];

		$user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
		$data = isset($_POST['details']) ? json_decode(stripslashes($_POST['details']), true) : '';
		$updated = ( isset($data['updated']) && (int)$data['updated'] > 0 );
		$success_keys = !empty($data['success_keys']) ? self::get_instance()->cleanse_keys($data, 'success_keys', true) : false;
		$failure_keys = !empty($data['failure_keys']) ? self::get_instance()->cleanse_keys($data, 'failure_keys', true) : false;

				if( ! $updated && $failure_keys ){
			do_action("wpal/ecomm/update/cc/failure", $user_id, $failure_keys);
			wp_send_json_error();
		}

		$redirect = !empty($data['redirect']) ? $data['redirect'] : '';
		$billing = !empty($data['billing']) && is_array($data['billing']) ? $data['billing'] : false;
		if( $billing ){
			$data = wp_parse_args($data, $data['billing']);
			unset($data['billing']);
		}

		$merchants = !empty($data['merchants']) && is_array($data['merchants']) ? $data['merchants'] : false;
		$profile_id = !empty($data['updated_profile_id']) ? $data['updated_profile_id'] : false;
		$invoices = false;
		$merchant_config = false;
		if($merchants){
		    unset($data['merchants']);
		    if($profile_id){
				$merchant_config = $merchants[$profile_id];
		        $invoices = !empty($merchant_config['invoices']) ? $merchant_config['invoices'] : false;
				$data = wp_parse_args($merchant_config, $data);
		    }
		}

		if( ! $merchant_config ){
			wp_send_json_error();
		}

		$merchant = $data['merchant'];
		$payment_method_id = $data['payment_method_id'];
		$merchant_class = wpal_ecomm()->get_merchant($merchant);
		$merchant_functions = $merchant_class->functions();
		add_filter("wpal/ecomm/account/billing/updated/{$merchant}", [$merchant_functions, 'account_billing_updated'], 10, 2);
		$response = apply_filters("wpal/ecomm/account/billing/updated/{$merchant}", $data, $user_id);
		if( is_wp_error($response) ){
			if( $failure_keys ){
				do_action("wpal/ecomm/update/cc/failure", $user_id, $failure_keys);
			}
			$notice['content'] = $response->get_error_message();
			wp_send_json_error( [
				'notice' => $notice,
			] );
		}
		else{
						self::update_user_cc_details( $user_id, $data, $billing );
			$successful_update = true;
			if( $invoices ){
				$s = ( count($invoices) > 1 ) ? 's' : '';
				$updated_invoices = [
					'success'	=> [],
					'fail'		=> []
				];
				foreach ($invoices as $invoice) {
					$wp_id = $invoice['id'];
					$invoice_id = $invoice['merchant_id'];
					add_filter("wpal/ecomm/pay/invoice/{$merchant}", [$merchant_functions, 'pay_invoice'], 10, 2);
					$paid = apply_filters("wpal/ecomm/pay/invoice/{$merchant}", $invoice_id, $profile_id);
					if( $paid && ! is_wp_error($paid) ){
						do_action('wpal/ecomm/invoice/paid', $paid, $wp_id, $invoice_id, $user_id);
						$updated_invoices['success'][$wp_id] = sprintf( __('Payment of %s was successful for %s %s.', 'wpal_ecomm'),
							$invoice['total'], $invoice['name'], $invoice['period']
						);
					}
					else{
						$successful_update = false;
						do_action('wpal/ecomm/invoice/payment/failure', $paid, $wp_id, $invoice_id, $user_id);
						$message = apply_filters('wpal/ecomm/invoice/payment/failure/message', $paid->get_error_message(), $merchant, $wp_id, $invoice_id, $user_id);
						$updated_invoices['fail'][$wp_id] = sprintf( __('Payment of %s failed for %s %s. Error : %s', 'wpal_ecomm'),
							$invoice['total'], $invoice['name'], $invoice['period'], $message
						);
					}

										if( defined('WPAL_ECOMM_CC_UPDATE_LOG') && WPAL_ECOMM_CC_UPDATE_LOG ){
						wpal_ecomm_debug::log_data([
							'Merchant'		=> ucfirst($merchant),
							'Profile'		=> $profile_id,
							'Paid'			=> $paid,
							'Invoice WP'	=> $wp_id,
							'Invoice ID'	=> $invoice_id,
							'User ID'		=> $user_id,
							'Create Time'	=> wpal_ecomm()->functions()->get_formatted_date()
						], 'ecomm_update_cc.txt');
					}

				}
			}

			$notice['content'] = __('Your card has been successfully updated', 'wpal_ecomm');

			if( $successful_update ){
								if( $success_keys || $failure_keys ){
					do_action("wpal/ecomm/update/cc/success", $user_id, $success_keys, $failure_keys);
				}
				$notice['id'] = 'wpal-ecomm-success';
				$notice['title'] = __('Success');
				if( $invoices ){
					$notice['content'] .= ' ' . sprintf( __('and outstanding amount%s collected.', 'wpal_ecomm'), $s );
					$notice['content'] .= self::invoice_messaging($updated_invoices);
				}
				wp_send_json_success( [
					'notice'	=> $notice,
					'redirect'	=> $redirect
				] );
			}
			else{
								if( $failure_keys ){
					do_action("wpal/ecomm/update/cc/failure", $user_id, $failure_keys);
				}
				$notice['content'] .= ' ' . sprintf( __('but outstanding amount%s was not collected.', 'wpal_ecomm'), $s );
				$notice['content'] .= self::invoice_messaging($updated_invoices);
				wp_send_json_error( [
					'notice'	=> $notice,
					'refresh'	=> 1
				] );
			}
		}
	}

	static 
function update_user_cc_details( $user_id, $data, $billing ){

		$billing = !$billing ? [] : $billing;
		$name_on_card = ( isset($data['name_on_card']) ) ? $data['name_on_card'] : '';

		if( !empty($billing) || $name_on_card > '' ){
			$customer = wpal_ecomm()->customer();
			$billing[$customer::NAME_ON_CARD] = $name_on_card;
			if( isset($billing['billing_country_code']) ){
				$billing['billing_country'] = $billing['billing_country_code'];
				unset($billing['billing_country_code']);
			}
			if( isset($billing['billing_state_code']) ){
				$billing['billing_state'] = $billing['billing_state_code'];
				unset($billing['billing_state_code']);
			}
			$customer->update_user_details($user_id, $billing, 'credit_card_details');
		}

		return;
	}

		static 
function invoice_messaging( $updated_invoices ){
		$html = '';
		$updated_invoices = is_array($updated_invoices) ? $updated_invoices : [];
		$success = !empty($updated_invoices['success']) ? $updated_invoices['success'] : false;
		$fail = !empty($updated_invoices['fail']) ? $updated_invoices['fail'] : false;
		if( $success || $fail ){
			$li_string = '<li class="wpal-ecomm-invoice-payment %s" data-wp-id=%s>%s</li>';
			$html .= '<ul class="wpal-ecomm-pay-invoice-results">';
			if( $fail ){
				foreach ($fail as $wp_id => $message) {
					$html .= sprintf($li_string, 'fail', $wp_id, $message);
				}
			}
			if( $success ){
				foreach ($success as $wp_id => $message) {
					$html .= sprintf($li_string, 'success', $wp_id, $message);
				}
			}
			$html .= '</ul>';
		}
		return $html;
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
