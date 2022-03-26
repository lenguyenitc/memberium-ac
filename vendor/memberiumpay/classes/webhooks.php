<?php
/**
 * Copyright (C) 2017-2019 David Bullock
 * Web Power and Light, LLC
 */



if (! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	die();
}



class wpal_ecomm_webhooks {

	
	public static 
function manage_process_request( $request ){

		
		$ns = 'wpal_ecomm';

				$params = $request->get_params();
		$merchant = (isset($params['merchant'])) ? $params['merchant'] : false;

		if( $merchant > '' ){

						$profile = self::get_hooked_profile($params);
			if( ! $profile ){
				return self::kill_request( __FUNCTION__, __('Merchant Profile Not Defined', $ns) );
			}

						$merchant_class = wpal_ecomm()->get_merchant($merchant);
			if( $merchant_class ){
				return $merchant_class->webhooks()->process_webhook($params, $profile);
			}
			else {
				return self::kill_request( __FUNCTION__, __("No process function defined for {$merchant}.", $ns) );
			}

		}
				else {
			return self::kill_request( __FUNCTION__, __('Merchant not defined', $ns) );
		}
	}

	
	static 
function get_hooked_profile($params){

		$profile = false;
		$profile_id = ( isset($params['profile']) ) ? $params['profile'] : false;
		if( !empty($profile_id) ){
			$profile = wpal_ecomm()->settings->get_merchant_profile($profile_id);
		}
		return $profile;
	}

	
	static 
function is_sandbox($params){
		return ( isset($params['sandbox']) && (int)$params['sandbox'] > 0 ) ? 1 : 0;
	}

	
	static 
function successful_request( $function, $msg, $class = false ){

		$class = ( $class ) ? $class : __CLASS__;
		$message = 'Class : ' . $class . ' Func : ' . $function;
		$message .= ' Msg : ' .  self::messaging('success') . ' ' . $msg;
		$data = ['message' => $message];
		$data['time'] = wpal_ecomm()->functions()->get_formatted_date();
		if( defined('WPAL_ECOMM_WEBHOOK_LOG') && WPAL_ECOMM_WEBHOOK_LOG ){
			wpal_ecomm_debug::log_data($data, 'ecomm_webhooks.txt');
		}
		$response = new WP_REST_Response( $data );
		$response->set_status(200);
		return $response;
	}

	
	static 
function kill_request( $function, $msg, $class = false ){

		$class = ( $class ) ? $class : __CLASS__;
		$message = 'Class : ' . $class . ' Func : ' . $function;
		$message .= ' Msg : ' . self::messaging( $msg );
		$data = ['message' => $message];
		$data['time'] = wpal_ecomm()->functions()->get_formatted_date();
		if( defined('WPAL_ECOMM_WEBHOOK_LOG') && WPAL_ECOMM_WEBHOOK_LOG ){
			wpal_ecomm_debug::log_data($data, 'ecomm_webhooks.txt');
		}
		$response = new WP_REST_Response( $data );
		$response->set_status(200);
		return $response;
	}

	
	static 
function messaging( $msg ){

		$ns = 'wpal_ecomm';

		switch ($msg) {
			case 'access':
				return __('Access Denied', $ns);
				break;
			case 'operation':
				return __('Operation doesn\'t exist.', $ns);
				break;
			case 'success':
				return __('Success : ', $ns);
				break;
			case 'no_id_email':
				return __('No contact ID or Email provided.', $ns);
				break;
			default:
				return __('Error : ', $ns) . $msg;
				break;
		}
	}

	
	static 
function get_operation_url( $merchant, $profile_id = '', $sandbox = 0, $params = [] ){
		if( (int)$sandbox > 0 ){
			$params['sandbox'] = 1;
		}
		$rest_url = get_rest_url(null, "wpal-ecomm/v1/process/{$merchant}/{$profile_id}");
		return add_query_arg( $params, $rest_url );
	}
}
