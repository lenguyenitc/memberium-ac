<?php


class M4AC_UserWordPress extends M4ActiveCampaignWordPress {
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
		return $this->curl("{$this->url}&api_action=user_add&api_output={$this->output}", $post_data);
	}

	
function delete_list($params) {
		return $this->curl("{$this->url}&api_action=user_delete_list&api_output={$this->output}&{$params}");
	}

	
function delete($params) {
		return $this->curl("{$this->url}&api_action=user_delete&api_output={$this->output}&{$params}");
	}

	
function edit($params, $post_data) {
		return $this->curl("{$this->url}&api_action=user_edit&api_output={$this->output}", $post_data);
	}

	
function list_($params) {
		return $this->curl("{$this->url}&api_action=user_list&api_output={$this->output}&{$params}");
	}

	
function me() {
		return $this->curl("{$this->url}&api_action=user_me&api_output={$this->output}");
	}

	
function view($params) {
				if (preg_match("/^email=/", $params) ) {
			$action = "user_view_email";
		}
		elseif (preg_match("/^username=/", $params) ) {
			$action = "user_view_username";
		}
		elseif (preg_match("/^id=/", $params) ) {
			$action = "user_view";
		}

		return $this->curl("{$this->url}&api_action={$action}&api_output={$this->output}&{$params}");
	}

}
