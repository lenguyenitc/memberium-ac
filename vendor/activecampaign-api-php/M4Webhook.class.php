<?php


class M4AC_WebhookWordPress extends M4ActiveCampaignWordPress {
	public $api_key;
	public $url_base;
	public $url;
	public $version;

	
function __construct($version, $url_base, $url, $api_key) {
		$this->version  = $version;
		$this->url_base = $url_base;
		$this->url      = $url;
		$this->api_key  = $api_key;
	}

	
function add($params, $post_data) {
		return $this->curl("{$this->url}&api_action=webhook_add&api_output={$this->output}", $post_data);
	}

	
function delete($params) {
		return $this->curl("{$this->url}&api_action=webhook_delete&api_output={$this->output}&{$params}");
	}

	
function delete_list($params) {
		return $this->curl("{$this->url}&api_action=webhook_delete_list&api_output={$this->output}&{$params}");
	}

	
function edit($params, $post_data) {
		return $this->curl("{$this->url}&api_action=webhook_edit&api_output={$this->output}", $post_data);
	}

	
function list_($params) {
		return $this->curl("{$this->url}&api_action=webhook_list&api_output={$this->output}&{$params}");
	}

	
function view($params) {
		return $this->curl("{$this->url}&api_action=webhook_view&api_output={$this->output}&{$params}");
	}

	
function events($params) {
		return $this->curl("{$this->url}&api_action=webhook_events&api_output={$this->output}&{$params}");
	}

	
function process($params) {
				$r = [];

		if ($_SERVER["REQUEST_METHOD"] != 'POST') {
			return $r;
		}

		$params_array = explode('&', $params);
		$params_      = [];

		foreach ($params_array as $expression) {
						list($var, $val) = explode("=", $expression);
			$params_[$var]   = $val;
		}

		$event  = $params_['event'];
		$format = $params_['output'];

		if ($format == 'json') {
			return json_encode($_POST);
		}
	}

}
