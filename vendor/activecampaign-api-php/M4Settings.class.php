<?php


class M4AC_SettingsWordPress extends M4ActiveCampaignWordPress {
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

	
function edit($params, $post_data) {
		return $this->curl("{$this->url}&api_action=settings_edit&api_output={$this->output}", $post_data);
	}

}
