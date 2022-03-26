<?php


class M4AC_TrackingWordPress extends M4ActiveCampaignWordPress {
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

	
function site_status($params, $post_data) {
		$this->version(2);

		return $this->curl("{$this->url_base}/track/site", $post_data, 'POST', 'tracking_site_status');
	}

	
function event_status($params, $post_data) {
		return $this->curl("{$this->url_base}/track/event", $post_data, 'POST', 'tracking_event_status');
	}

	
function site_list($params) {
		$this->version(2);

		return $this->curl("{$this->url_base}/track/site", [], 'GET', 'tracking_site_list');
	}

	
function event_list($params) {
		$this->version(2);

		return  $this->curl("{$this->versioned_url_base}/track/event", [], 'GET', 'tracking_event_list');
	}

	
function whitelist($params, $post_data) {
		$this->version(2);

		return $this->curl("{$this->url_base}/track/site", $post_data, 'PUT', 'tracking_whitelist');
	}

	
function whitelist_remove($params, $post_data) {
		$this->version(2);

		return $this->curl("{$this->url_base}/track/site", $post_data, 'DELETE', 'tracking_whitelist');
	}

	
function event_remove($params, $post_data) {
		$this->version(2);

		return $this->curl("{$this->url_base}/track/event", $post_data, 'DELETE', 'tracking_event_remove');
	}

	
function log($params, $post_data) {
		$post_data['actid'] = $this->track_actid;
		$post_data['key']   = $this->track_key;
		$visit_data         = [];

		if ($this->track_email) {
			$visit_data['email'] = $this->track_email;
		}

		if (isset($post_data['visit']) ) {
			$visit_data = array_merge($visit_data, $post_data['visit']);
		}

		if ($visit_data) {
			$post_data['visit'] = json_encode($visit_data);
		}

		return $this->curl('https://trackcmp.net/event', $post_data, 'POST', 'tracking_log');
	}
}
