<?php
/**
 * Copyright (c) 2019 David J Bullock
 * Web Power and Light
*/



if (! defined( 'ABSPATH' ) ) {
	die();
}



class wpal_ecomm_export {

    static 
function handle_export( $type, $params ){
        if( $type === 'orders' ){
            $args = array_flip(['start_date', 'end_date', 'new_business_only']);
            foreach ($args as $k => $v) {
                if( isset($params[$k]) ){
                    $args[$k] = sanitize_text_field($params[$k]);
                }
                else{
                    unset($args[$k]);
                }
            }
            if( !empty($args) ){
                $filename = self::generate_filename($args);
                $csv = self::generate_order_csv_data($args);
                self::download_csv( $filename, $csv );
            }
        }
    }

    static 
function export_orders_link( $args ){
		$href = add_query_arg( $args, admin_url('admin.php?wpal-ecomm-export=orders') );
		$label = __( 'Export Orders CSV', 'wpal_ecomm' );
		$html = "<a href=\"{$href}\" class=\"button wpal-ecomm-export\">";
		$html .= "<i class=\"dashicons dashicons-download\"></i>{$label}</a>";
		return $html;
    }

    static 
function generate_order_csv_data( $args ){

		$orders = wpal_ecomm_orders::get_orders_by_payment_date($args);

        $csv = [];
				$csv[] = [
            'Product Name',
            'Full Name',
            'Email',
            'User ID',
            'Return',
            'Payment Amount',
            'Payment Date'
        ];

        if( ! $orders ){
            return $csv;
        }

        $functions = wpal_ecomm()->functions();
        $order_prefix = $functions->get_prefix();
        $new_business_only = !empty($args['new_business_only']);
        $titles = [];
        foreach ($orders as $k => $post_id) {

			$parent_id			= get_post_field('post_parent', $post_id, 'raw');
			$is_invoice			= ! empty($parent_id);
			$invoice_id			= $is_invoice ? $post_id : false;
			$parent_id			= empty($parent_id) ? $post_id : $parent_id;
			$order_type			= $functions->get_order_type($parent_id);
			$is_sub     		= $order_type === 'subscription';
			$payment_collected	= false;

						if ( $invoice_id && ! get_post_status( $parent_id ) ) {
				continue;
			}

			if( ! $order_type ){
				continue;
			}

						if( $is_sub && ! $new_business_only && ! $is_invoice ){
				continue;
			}

						if( $is_sub && ! $invoice_id ){
				$invoice_id = (int) $functions->get_first_invoice_id($parent_id);
								if( empty($invoice_id) ){
					continue;
				}
			}

						$status_key = $is_sub ? '/wpal/ecomm/invoice/status' : '/wpal/ecomm/order/status';
			$status = get_post_meta($post_id, $status_key, true);
			if( $is_sub ){
				$payment_collected = 'paid' == $status;
			}
			else{
				$payment_collected = 'completed' == $status;
			}

						if( ! $payment_collected && $status !== 'refunded' ){
				continue;
			}

						$product_key = $invoice_id ? 'plan' : 'product';
			$product_id = get_post_meta($parent_id, "{$order_prefix}{$product_key}/id", true);
			if( ! array_key_exists($product_id, $titles) ){
				$title = get_the_title($product_id);
								if( empty($title) ){
										continue;
				}
				$title = remove_accents(html_entity_decode(get_the_title($product_id)));
				$titles[$product_id] = iconv('UTF-8', 'ISO-8859-1//IGNORE', $title);
			}
			$product_name = $titles[$product_id];
			$currency = $functions->get_order_currency($parent_id,'symbol');

						$line_item	  = get_post_meta($parent_id, '/wpal/ecomm/order/line/item', true);
			$price		  = isset($line_item['total']) ? $line_item['total'] : 0;

						$amount_key  = $is_sub ? "_wpal/ecomm/payment/paid" : "{$order_prefix}total";
			$payment_amt = get_post_meta($post_id, $amount_key, true);
			$payment_amt = empty($payment_amt) ? $price : $payment_amt;			$payment_amt = ( $payment_amt ) ? number_format( str_replace(' ', '', $payment_amt), 2, '.', '') : 0;

						$date_key = $is_sub ? "_wpal/ecomm/payment/time" : "{$order_prefix}date_created";
			$payment_date = get_post_meta($post_id, $date_key, true);
			if( empty($payment_date) ){
				$payment_date = $is_sub ? "" : get_the_time('U', $post_id);
			}
			$payment_date = !empty($payment_date) ? wp_date('M j Y', $payment_date) : "";

						$return = get_post_meta($post_id, "_wpal/ecomm/refunded/total", true);
			if($return){
				$return = $currency . $functions->price_to_decimal($return);
			}

						$user_id   = $functions->get_order_user_id($parent_id);
			$user_name = $functions->generate_full_name( $parent_id, $user_id );
			$email     = $functions->get_order_user_email( $parent_id, $user_id );

			$csv[] = [
				$product_name,
				$user_name,
				$email,
				$user_id,
				( $return ) ? $return : 'None',
				$payment_amt,
				$payment_date
			];
		}
		return $csv;
	}

    static 
function generate_filename($args){

		$name = wpal_ecomm()->get_config('report_name');
		if( !empty($args['new_business_only']) ){
			$name .= '-new-business';
		}
		if( !empty($args['start_date']) ){
			$name .= '-from-' . $args['start_date'];
		}
		if( !empty($args['end_date']) ){
			$name .= '-to-' . $args['end_date'];
		}

		return esc_attr($name);
    }

    static 
function download_csv( $filename, $data, $delimiter = ',', $enclosure = '"' ){

        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename={$filename}.csv");
        header("Content-Transfer-Encoding: UTF-8");

        $f = fopen('php://output', 'a');
        foreach ($data as $line) {
            fputcsv($f, $line, $delimiter, $enclosure);
        }
        fclose($f);
        exit();
    }

}
