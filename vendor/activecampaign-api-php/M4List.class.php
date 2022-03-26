<?php


class M4AC_List_WordPress extends M4ActiveCampaignWordPress {
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
		return $this->curl("{$this->url}&api_action=list_add&api_output={$this->output}", $post_data);
	}

	
function delete_list($params) {
		return $this->curl("{$this->url}&api_action=list_delete_list&api_output={$this->output}&{$params}");
	}

	
function delete($params) {
		return $this->curl("{$this->url}&api_action=list_delete&api_output={$this->output}&{$params}");
	}

	
function edit($params, $post_data) {
		return $this->curl("{$this->url}&api_action=list_edit&api_output={$this->output}", $post_data);
	}

	
function field_add($params, $post_data) {
		return $this->curl("{$this->url}&api_action=list_field_add&api_output={$this->output}", $post_data);
	}

	
function field_delete($params) {
		return $this->curl("{$this->url}&api_action=list_field_delete&api_output={$this->output}&{$params}");
	}

	
function field_edit($params, $post_data) {
		return $this->curl("{$this->url}&api_action=list_field_edit&api_output={$this->output}", $post_data);
	}

	
function field_view($params) {
		return $this->curl("{$this->url}&api_action=list_field_view&api_output={$this->output}&{$params}");
	}

	
function list_($params, $post_data) {
		if ($post_data) {
			if (isset($post_data['ids']) && is_array($post_data['ids']) ) {
				$post_data['ids'] = implode(',', $post_data['ids']);
			}
		}

		return $this->curl("{$this->url}&api_action=list_list&api_output={$this->output}&{$params}", $post_data);
	}

	
function paginator($params) {
		return $this->curl("{$this->url}&api_action=list_paginator&api_output={$this->output}&{$params}");
	}

	
function view($params) {
		return $this->curl("{$this->url}&api_action=list_view&api_output={$this->output}&{$params}");
	}

}
