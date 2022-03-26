<?php


class M4AC_AuthWordPress extends M4ActiveCampaignWordPress {
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

	
function singlesignon($params) {
		return $this->curl("{$this->url}&api_action=singlesignon&api_output={$this->output}&{$params}");
	}

}
