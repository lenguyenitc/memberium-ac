<?php


class M4AC_ContactWordPress extends M4ActiveCampaignWordPress {
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
		$request_url = "{$this->url}&api_action=contact_add&api_output={$this->output}";

		if ($params) {
			$request_url .= "&{$params}";
		}

		return $this->curl($request_url, $post_data);
	}

	
function delete_list($params) {
		return $this->curl("{$this->url}&api_action=contact_delete_list&api_output={$this->output}&{$params}");
	}

	
function delete($params) {
		return $this->curl("{$this->url}&api_action=contact_delete&api_output={$this->output}&{$params}");
	}

	
function edit($params, $post_data) {
		return $this->curl("{$this->url}&api_action=contact_edit&api_output={$this->output}&{$params}", $post_data);
	}

	
function list_($params) {
		if ($this->version == 1) {
			$request_url = "{$this->url}&api_action=contact_list&api_output={$this->output}&{$params}";
			$response    = $this->curl($request_url);
		}
		elseif ($this->version == 2) {
			$request_url = "{$this->url_base}/contact/emails";
			$response    = $this->curl($request_url, $params, "GET", "contact_list");
		}

		return $response;
	}

	
function note_add($params, $post_data) {
		return $this->curl("{$this->url}&api_action=contact_note_add&api_output={$this->output}&{$params}", $post_data);
	}

	
function note_edit($params, $post_data) {
		return $this->curl("{$this->url}&api_action=contact_note_edit&api_output={$this->output}&{$params}", $post_data);
	}

	
function note_delete($params) {
		return $this->curl("{$this->url}&api_action=contact_note_delete&api_output={$this->output}&{$params}");
	}

	
function paginator($params) {
		return $this->curl("{$this->url}&api_action=contact_paginator&api_output={$this->output}&{$params}");
	}

	
function sync($params, $post_data) {
		$request_url = "{$this->url}&api_action=contact_sync&api_output={$this->output}";

		if ($params) {
			$request_url .= "&{$params}";
		}

		return $this->curl($request_url, $post_data);
	}

	
function tag_add($params, $post_data) {
		$request_url = "{$this->url}&api_action=contact_tag_add&api_output={$this->output}";

		if ($params) {
			$request_url .= "&{$params}";
		}

		return $this->curl($request_url, $post_data);
	}

	
function tag_remove($params, $post_data) {
		$request_url = "{$this->url}&api_action=contact_tag_remove&api_output={$this->output}";

		if ($params) {
			$request_url .= "&{$params}";
		}
		return $this->curl($request_url, $post_data);
	}

	
function view($params) {
				if (preg_match("/^email=/", $params) ) {
			$action = 'contact_view_email';
		}
		elseif (preg_match("/^hash=/", $params) ) {
			$action = 'contact_view_hash';
		}
		elseif (preg_match("/^id=/", $params) ) {
			$action = 'contact_view';
		}
		else {
						$action = 'contact_view';
		}

		return $this->curl("{$this->url}&api_action={$action}&api_output={$this->output}&{$params}");
	}

}
