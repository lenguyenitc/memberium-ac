<?php


class M4AC_AccountWordPress extends M4ActiveCampaignWordPress {
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

	
function add($params, $post_data) {
		return $this->curl("{$this->url}&api_action=account_add&api_output={$this->output}", $post_data);
	}

	
function cancel($params) {
		return $this->curl("{$this->url}&api_action=account_cancel&api_output={$this->output}&{$params}");
	}

	
function edit($params, $post_data) {
		return $this->curl("{$this->url}&api_action=account_edit&api_output={$this->output}", $post_data);
	}

	
function list_($params) {
		return $this->curl("{$this->url}&api_action=account_list&api_output={$this->output}&{$params}");
	}

	
function name_check($params) {
		return $this->curl("{$this->url}&api_action=account_name_check&api_output={$this->output}&{$params}");
	}

	
function plans($params) {
		return $this->curl("{$this->url}&api_action=account_plans&api_output={$this->output}&{$params}");
	}

	
function status($params) {
		return $this->curl("{$this->url}&api_action=account_status&api_output={$this->output}&{$params}");
	}

	
function status_set($params) {
		return $this->curl("{$this->url}&api_action=account_status_set&api_output={$this->output}&{$params}");
	}

	
function view() {
		return $this->curl("{$this->url}&api_action=account_view&api_output={$this->output}");
	}

}
