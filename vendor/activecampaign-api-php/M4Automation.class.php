<?php


class M4AC_AutomationWordPress extends M4ActiveCampaignWordPress {
	public $api_key;
	public $url_base;
	public $url;
	public $version;

	
function __construct($version, $url_base, $url, $api_key) {
		$this->api_key  = $api_key;
		$this->url      = $url;
		$this->url_base = $url_base;
		$this->version  = $version;
	}

	
function list_($params) {
		return $this->curl("{$this->url}&api_action=automation_list&api_output={$this->output}&{$params}");
	}

	
function contact_add($params, $post_data) {
		$request_url = "{$this->url}&api_action=automation_contact_add&api_output={$this->output}";

		if ($params) {
			$request_url .= "&{$params}";
		}

		return $this->curl($request_url, $post_data);
	}

	
function contact_remove($params, $post_data) {
		$request_url = "{$this->url}&api_action=automation_contact_remove&api_output={$this->output}";

		if ($params) {
			$request_url .= "&{$params}";
		}

		return $this->curl($request_url, $post_data);
	}

	
function contact_list($params) {
		return $this->curl("{$this->url}&api_action=automation_contact_list&api_output={$this->output}&{$params}");
	}

	
function contact_view($params) {
		return $this->curl("{$this->url}&api_action=automation_contact_view&api_output={$this->output}&{$params}");
	}

}
