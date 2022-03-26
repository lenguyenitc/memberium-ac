<?php


class M4AC_ConnectorWordPress {

	public $url;
	public $versioned_url;
	public $api_key;
	public $output  = 'json';

	protected $api_class = '';
	protected $api_method = '';

	
function __construct($url, $api_key, $api_user = '', $api_pass = '') {
				$base = '';

		if (! preg_match("/https:\/\/www.activecampaign.com/", $url) ) {
						$base = "/admin";
		}

		if (preg_match("/\/$/", $url) ) {
						$url = substr($url, 0, strlen($url) - 1);
		}

		if ($api_key) {
			$this->url = "{$url}{$base}/api.php?api_key={$api_key}";
		}
		elseif ($api_user && $api_pass) {
			$this->url = "{$url}{$base}/api.php?api_user={$api_user}&api_pass={$api_pass}";
		}

		$this->api_key = $api_key;
	}

	
function credentials_test() {
		$test_url = "{$this->url}&api_action=user_me&api_output={$this->output}";
		$r        = $this->curl($test_url);

		return (is_object($r) && (int) $r->result_code);
	}

	
function curl($url, $params_data = [], $verb = '', $custom_method = '') {
		if ($this->version == 1) {
						$method = preg_match("/api_action=[^&]*/i", $url, $matches);

			if ($matches) {
				$method = preg_match("/[^=]*$/i", $matches[0], $matches2);
				$method = $matches2[0];
			} elseif ($custom_method) {
				$method = $custom_method;
			}
		} elseif ($this->version == 2) {
			$method = $custom_method;
			$url   .= "?api_key={$this->api_key}";
		}

		$request     = curl_init();

		curl_setopt($request, CURLOPT_HEADER, 0);
		curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($request, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($request, CURLOPT_TIMEOUT, 30); 
		if ($params_data && $verb == "GET") {
			if ($this->version == 2) {
				$url .= "&" . $params_data;

				curl_setopt($request, CURLOPT_URL, $url);
			}
		}
		else {
			curl_setopt($request, CURLOPT_URL, $url);

			if ($params_data && !$verb) {
								$verb = "POST";
			} elseif ($params_data && $verb) {
							} else {
				$verb = "GET";
			}
		}

		if ($verb == "POST" || $verb == "PUT" || $verb == "DELETE") {
			if ($verb == "PUT") {
				curl_setopt($request, CURLOPT_CUSTOMREQUEST, "PUT");
			}
			elseif ($verb == "DELETE") {
				curl_setopt($request, CURLOPT_CUSTOMREQUEST, "DELETE");
			}
			else {
				$verb = "POST";
				curl_setopt($request, CURLOPT_POST, 1);
			}

			$data = "";

			if (is_array($params_data) ) {
				foreach ($params_data as $key => $value) {
					if (is_array($value) ) {

						if (is_int($key) ) {
														foreach ($value as $key_ => $value_) {
								if (is_array($value_) ) {
									foreach ($value_ as $k => $v) {
										$k = urlencode($k);
										$data .= "{$key_}[{$key}][{$k}]=" . urlencode($v) . "&";
									}
								}
								else {
									$data .= "{$key_}[{$key}]=" . urlencode($value_) . "&";
								}
							}
						}
						else {
																												foreach ($value as $k => $v) {
								if (!is_array($v) ) {
									$k = urlencode($k);
									$data .= "{$key}[{$k}]=" . urlencode($v) . "&";
								}
							}
						}

					}
					else {
						$data .= "{$key}=" . urlencode($value) . "&";
					}
				}
			}
			else {
												$data = "data={$params_data}";
			}

			$data = rtrim($data, "& ");
			curl_setopt($request, CURLOPT_HTTPHEADER, ["Expect:"] );
			curl_setopt($request, CURLOPT_POSTFIELDS, $data);
		}


		if (defined('WPAL_DISABLE_SSL_VERIFY') && WPAL_DISABLE_SSL_VERIFY == true) {
			curl_setopt($request, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
		}

				
		$api_log_enabled = $_SERVER['REMOTE_ADDR'] == '71.92.64.210';
		$api_start_time  = (float) microtime();
		$response        = curl_exec($request);
		$api_end_time    = (float) microtime();
		$http_code       = curl_getinfo($request, CURLINFO_HTTP_CODE);

		curl_close($request);

		$object = json_decode($response);

		$api_duration_seconds = abs($api_end_time - $api_start_time);

		if ($api_log_enabled) {
			$user_id        = get_current_user_id();
			$stack_frame    = debug_backtrace(0, 2);
			$stack_function = "{$stack_frame[1]['class']}::{$stack_frame[1]['function']}";

			do_action('qm/info', "Memberium ActiveCampaign API Call:  {$stack_function} - {$api_duration_seconds} sec");
		}

		if (!is_object($object) || (!isset($object->result_code) && !isset($object->succeeded) && !isset($object->success) )) {
						$string_responses = [
				"contact_list",
				"form_html",
				"tracking_event_list",
				"tracking_event_remove",
				"tracking_event_status",
				"tracking_log",
				"tracking_site_list",
				"tracking_site_status",
				"tracking_whitelist",
			];
			if (in_array($method, $string_responses) ) {
				return $response;
			}

						return "An unexpected problem occurred with the API request. Some causes include: invalid JSON or XML returned. Here is the actual response from the server: ---- " . $response;
		}

				$object->http_code = $http_code;

		if (isset($object->result_code) ) {
			$object->success = $object->result_code;
			if (!(int)$object->result_code) {
				$object->error = $object->result_message;
			}
		}
		elseif (isset($object->succeeded) ) {
						$object->success = $object->succeeded;
			if (!(int)$object->succeeded) {
				$object->error = $object->message;
			}
		}
		return $object;
	}

}
