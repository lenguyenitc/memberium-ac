<?php


class M4AC_GroupWordPress extends M4ActiveCampaignWordPress {
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
		return $this->curl("{$this->url}&api_action=group_add&api_output={$this->output}", $post_data);
	}

	
function delete_list($params) {
		return $this->curl("{$this->url}&api_action=group_delete_list&api_output={$this->output}&{$params}");
	}

	
function delete($params) {
		return $this->curl("{$this->url}&api_action=group_delete&api_output={$this->output}&{$params}");
	}

	
function edit($params, $post_data) {
		return $this->curl("{$this->url}&api_action=group_edit&api_output={$this->output}", $post_data);
	}

	
function list_($params) {
		return $this->curl("{$this->url}&api_action=group_list&api_output={$this->output}&{$params}");
	}

	
function view($params) {
		return $this->curl("{$this->url}&api_action=group_view&api_output={$this->output}&{$params}");
	}

}
