<?php


class M4AC_CampaignWordPress extends M4ActiveCampaignWordPress {
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

	
function create($params, $post_data) {
		return $this->curl("{$this->url}&api_action=campaign_create&api_output={$this->output}", $post_data);
	}

	
function delete_list($params) {
		return $this->curl("{$this->url}&api_action=campaign_delete_list&api_output={$this->output}&{$params}");
	}

	
function delete($params) {
		return $this->curl("{$this->url}&api_action=campaign_delete&api_output={$this->output}&{$params}");
	}

	
function list_($params) {
		return $this->curl("{$this->url}&api_action=campaign_list&api_output={$this->output}&{$params}");
	}

	
function paginator($params) {
		return $this->curl("{$this->url}&api_action=campaign_paginator&api_output={$this->output}&{$params}");
	}

	
function report_bounce_list($params) {
		return $this->curl("{$this->url}&api_action=campaign_report_bounce_list&api_output={$this->output}&{$params}");
	}

	
function report_bounce_totals($params) {
		return $this->curl("{$this->url}&api_action=campaign_report_bounce_totals&api_output={$this->output}&{$params}");
	}

	
function report_forward_list($params) {
		return $this->curl("{$this->url}&api_action=campaign_report_forward_list&api_output={$this->output}&{$params}");
	}

	
function report_forward_totals($params) {
		return $this->curl("{$this->url}&api_action=campaign_report_forward_totals&api_output={$this->output}&{$params}");
	}

	
function report_link_list($params) {
		return $this->curl("{$this->url}&api_action=campaign_report_link_list&api_output={$this->output}&{$params}");
	}

	
function report_link_totals($params) {
		return $this->curl("{$this->url}&api_action=campaign_report_link_totals&api_output={$this->output}&{$params}");
	}

	
function report_open_list($params) {
		return $this->curl("{$this->url}&api_action=campaign_report_open_list&api_output={$this->output}&{$params}");
	}

	
function report_open_totals($params) {
		return $this->curl("{$this->url}&api_action=campaign_report_open_totals&api_output={$this->output}&{$params}");
	}

	
function report_totals($params) {
		return $this->curl("{$this->url}&api_action=campaign_report_totals&api_output={$this->output}&{$params}");
	}

	
function report_unopen_list($params) {
		return $this->curl("{$this->url}&api_action=campaign_report_unopen_list&api_output={$this->output}&{$params}");
	}

	
function report_unsubscription_list($params) {
		return $this->curl("{$this->url}&api_action=campaign_report_unsubscription_list&api_output={$this->output}&{$params}");
	}

	
function report_unsubscription_totals($params) {
		return $this->curl("{$this->url}&api_action=campaign_report_unsubscription_totals&api_output={$this->output}&{$params}");
	}

	
function send($params) {
		return $this->curl("{$this->url}&api_action=campaign_send&api_output={$this->output}&{$params}");
	}

	
function status($params) {
		return $this->curl("{$this->url}&api_action=campaign_status&api_output={$this->output}&{$params}");
	}

}
