<?php

if (!defined("ACTIVECAMPAIGN_URL") || (!defined("ACTIVECAMPAIGN_API_KEY") && !defined("ACTIVECAMPAIGN_API_USER") && !defined("ACTIVECAMPAIGN_API_PASS") )) {
}

require_once('M4Connector.class.php');


class M4ActiveCampaignWordPress extends M4AC_ConnectorWordPress {
	public $api_key;
	public $track_actid;
	public $track_email;
	public $track_key;
	public $url_base;
	public $url;
	public $versioned_url_base;

	public $debug = false;
	public $version = 1;

	
function __construct($url, $api_key, $api_user = '', $api_pass = '') {
		$this->api_key            = $api_key;
		$this->url_base           = $this->url = $url;
		$this->versioned_url_base = $url;

		parent::__construct($url, $api_key, $api_user, $api_pass);
	}

	
function version($version) {
		$this->version = (int) $version;

		if ($version == 2) {
			$this->versioned_url_base = $this->url_base . '/api/2';
			$this->url_base           = $this->url_base . "/2";
		}
	}

	
function api($path, $post_data = [] ) {
				$components = explode("/", $path);
		$component  = $components[0];

		if (count($components) > 2) {
									array_shift($components);
						$method_str = implode("_", $components);
			$components = [$component, $method_str];
		}

		if (preg_match("/\?/", $components[1]) ) {
									$method_arr = explode("?", $components[1]);
			$method = $method_arr[0];
			$params = $method_arr[1];
		}
		else {
									if (isset($components[1]) ) {
				$method = $components[1];
				$params = "";
			}
			else {
				return "Invalid method.";
			}
		}

				if ($component == "list") {
						$component = "list_";
		}
		elseif ($component == "branding") {
			$component = "design";
		}
		elseif ($component == "sync") {
			$component = "contact";
			$method = "sync";
		}
		elseif ($component == "singlesignon") {
			$component = "auth";
		}

		$class = ucwords($component); 		$class = "M4AC_" . $class . "WordPress";
		
		$add_tracking = false;
		if ($class == "M4AC_TrackingWordPress") {
			$add_tracking = true;
		}

		$this->dynamic_class_loader($class);

		$class = new $class($this->version, $this->url_base, $this->url, $this->api_key);
		
		if ($add_tracking) {
			$class->track_email = $this->track_email;
			$class->track_actid = $this->track_actid;
			$class->track_key   = $this->track_key;
		}

		if ($method == "list") {
						$method = "list_";
		}

		$class->debug = $this->debug;

		return $class->$method($params, $post_data);
	}

	
function dynamic_class_loader($classname) {
		static $map = [
			'M4AC_AccountWordPress'    => 'M4Account',
			'M4AC_AuthWordPress'       => 'M4Auth',
			'M4AC_AutomationWordPress' => 'M4Automation',
			'M4AC_CampaignWordPress'   => 'M4Campaign',
			'M4AC_ContactWordPress'    => 'M4Contact',
			'M4AC_DealWordPress'       => 'M4Deal',
			'M4AC_DesignWordPress'     => 'M4Design',
			'M4AC_FormWordPress'       => 'M4Form',
			'M4AC_GroupWordPress'      => 'M4Group',
			'M4AC_List_WordPress'      => 'M4List',
			'M4AC_MessageWordPress'    => 'M4Message',
			'M4AC_SettingsWordPress'   => 'M4Settings',
			'M4AC_SubscriberWordPress' => 'M4Subscriber',
			'M4AC_TrackingWordPress'   => 'M4Tracking',
			'M4AC_UserWordPress'       => 'M4User',
			'M4AC_WebhookWordPress'    => 'M4Webhook',
		];

		if (array_key_exists($classname, $map) ) {
			include_once __DIR__ . '/' . $map[$classname] . '.class.php';
		}
	}
}
