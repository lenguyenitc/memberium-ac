<?php


class M4AC_MessageWordPress extends M4ActiveCampaignWordPress {
	public $api_key;
	public $url_base;
	public $url;
	public $version;

	
function __construct($version, $url_base, $url, $api_key) {
		$this->api_key = $api_key;
		$this->url = $url;
		$this->url_base = $url_base;
		$this->version = $version;
	}

	
function add($params, $post_data) {
		return $this->curl("{$this->url}&api_action=message_add&api_output={$this->output}", $post_data);
	}

	
function delete_list($params) {
		return $this->curl("{$this->url}&api_action=message_delete_list&api_output={$this->output}&{$params}");
	}

	
function delete($params) {
		return $this->curl("{$this->url}&api_action=message_delete&api_output={$this->output}&{$params}");
	}

	
function edit($params, $post_data) {
		return $this->curl("{$this->url}&api_action=message_edit&api_output={$this->output}", $post_data);
	}

	
function list_($params) {
		return $this->curl("{$this->url}&api_action=message_list&api_output={$this->output}&{$params}");
	}

	
function template_add($params, $post_data) {
		return $this->curl("{$this->url}&api_action=message_template_add&api_output={$this->output}", $post_data);
	}

	
function template_delete_list($params) {
		return $this->curl("{$this->url}&api_action=message_template_delete_list&api_output={$this->output}&{$params}");
	}

	
function template_delete($params) {
		return $this->curl("{$this->url}&api_action=message_template_delete&api_output={$this->output}&{$params}");
	}

	
function template_edit($params, $post_data) {
		return $this->curl("{$this->url}&api_action=message_template_edit&api_output={$this->output}", $post_data);
	}

	
function template_export($params) {
		return $this->curl("{$this->url}&api_action=message_template_export&api_output={$this->output}&{$params}");
	}

	
function template_import($params, $post_data) {
		return $this->curl("{$this->url}&api_action=message_template_import&api_output={$this->output}", $post_data);
	}

	
function template_list($params) {
		return $this->curl("{$this->url}&api_action=message_template_list&api_output={$this->output}&{$params}");
	}

	
function template_view($params) {
		return $this->curl("{$this->url}&api_action=message_template_view&api_output={$this->output}&{$params}");
	}

	
function view($params) {
		return $this->curl("{$this->url}&api_action=message_view&api_output={$this->output}&{$params}");
	}

}
