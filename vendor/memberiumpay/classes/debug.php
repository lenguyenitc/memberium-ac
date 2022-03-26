<?php
/**
 * Copyright (c) 2018-2019 David J Bullock
 * Web Power and Light
 */



if ( !defined( 'ABSPATH' ) ) {
	die();
}

final 
class wpal_ecomm_debug {

	static public 
function log($file = '', $function = '', $line = 0, $description = '', $data = NULL) {
		if ( is_admin() ) {
					}
		if ( isset( $_GET['doing_wp_cron'] ) ) {
			return;
		}

		global $user;

		$session_id = $_SERVER['REMOTE_ADDR'] . '::' . isset( $_SERVER['REQUEST_TIME_FLOAT'] ) ? $_SERVER['REQUEST_TIME_FLOAT'] : $_SERVER['REQUEST_TIME'];

		$output = $session_id . ' :: ' . microtime( true );
		$output .= ' :: ' . ( function_exists( 'get_current_user_id' ) ? get_current_user_id() : 0 );
		if ( function_exists( 'current_filter' ) ) {
			$output .= ' :: ' . current_filter();
		}
		$output  .= ' :: ';
		$output .= basename( $file ) . ' -> ' . $function . ' -> ' . $line . " :: ";
		if ( isset( $data ) ) {
			$output .= $description . ' = ';
			if ( is_array( $data ) || is_object( $data ) ) {
				$output .= print_r( $data, true );
			}
			elseif ( is_bool( $data ) ) {
				$output .= $data ? 'True' : 'False';
			}
			else {
				$output .= $data;
			}
		}
		else {
			$output .= $description;
		}
		$output .= "\n";

		if ( WPAL_ECOMM_DEBUGLOG == 'error_log:' ) {
			error_log( $output );
		}
		elseif ( WPAL_ECOMM_DEBUGLOG > '' ) {
			file_put_contents( WPAL_ECOMM_DEBUGLOG, $output, FILE_APPEND );
		}
		else {
			echo nl2br( $output );
		}
	}

	static public 
function write_log( $log, $print = false ){
		$error_log = ( is_array( $log ) || is_object( $log ) ) ? print_r( $log, true ) : $log;
        if($print){
            return '<pre>'.$error_log.'</pre>';
        }
        else{
            error_log($error_log);
        }
	}

	static public 
function order_process_queue_log( $function, $data, $result ){

		$error_log = "\n\n\nFunction = " . $function . "\n";
		$error_log .= "Time = " . date('Y-m-d j:i:s') . "\n";
		$error_log .= 'Action = ' . $data['action'] . "\n";
		$error_log .= 'User ID = ' . $data['user_id'] . "\n";
		$error_log .= 'Contact ID = ' . $data['contact_id'] . "\n";
		$error_log .= 'Order ID = ' . $data['order_id'] . "\n";
		if( isset($data['invoice_id']) ){
			$error_log .= 'Invoice ID = ' . $data['invoice_id'] . "\n";
		}
		$error_log .= 'MSG = ' . $result . "\n";
		self::log_dir_check();
		file_put_contents(WPAL_ECOMM_LOG_DIR . 'process_order_queue_log.txt', $error_log, FILE_APPEND);
	}

	static public 
function ajax_write_log(){

		$write_log = ( defined('WPAL_ECOMM_ORDER_LOG') && WPAL_ECOMM_ORDER_LOG );
		if( ! $write_log ){
			wp_send_json_success();
		}

		$type = isset($_POST['log_type']) ? $_POST['log_type'] : '';
		$merchant = isset($_POST['merchant']) ? $_POST['merchant'] : '';
		$user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
		$data = isset($_POST['data']) ? $_POST['data'] : false;
		$data = $data ? json_decode(stripslashes($data), true) : false;
				if( $data && $merchant > '' ){
	        $merchant_class = wpal_ecomm()->get_merchant($merchant);
			if( $merchant_class ){
				$merchant_functions = $merchant_class->functions();
				add_filter("wpal/ecomm/{$merchant}/log", [$merchant_functions, 'write_log'], 10, 3 );
                $data = apply_filters("wpal/ecomm/{$merchant}/log", $data, $type, $user_id );
			}
		}
				$error_log = "\n\n\nType = " . $type . "\n";
		$error_log .= "Time = " . date('Y-m-d j:i:s') . "\n";
		$error_log .= ( $user_id > 0 ) ? "UserID = " . $user_id . "\n" : "";
		if( $data > '' ){
			if( is_array($data) ){
				$error_log .= "Data = " . print_r($data, true) . "\n";
			}
			else if( is_string($data) ){
				$error_log .= $data;
			}
		}
		self::log_dir_check();
		file_put_contents(WPAL_ECOMM_LOG_DIR . 'order_log.txt', $error_log, FILE_APPEND);
		wp_send_json_success($data);
	}

	static public 
function log_data( $data, $file ){
		$error_log = "\n\n\n";
		foreach ($data as $key => $value) {
			$value = ( is_array($value) || is_object($value) ) ? json_encode($value, JSON_PRETTY_PRINT) : $value;
			$error_log .= "{$key} = {$value}\n";
		}
		self::log_dir_check();
		file_put_contents(WPAL_ECOMM_LOG_DIR . $file, $error_log, FILE_APPEND);
	}

	static public 
function log_dir_check(){
		if ( !is_dir(WPAL_ECOMM_LOG_DIR) || !file_exists(WPAL_ECOMM_LOG_DIR) ) {
			mkdir(WPAL_ECOMM_LOG_DIR);
		}
	}

}
