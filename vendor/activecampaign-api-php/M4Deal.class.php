<?php


class M4AC_DealWordPress extends M4ActiveCampaignWordPress {
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
		return $this->curl("{$this->url}&api_action=deal_add&api_output={$this->output}", $post_data);
	}

	
function edit($params, $post_data) {
		return $this->curl("{$this->url}&api_action=deal_edit&api_output={$this->output}", $post_data);
	}

	
function delete($params, $post_data) {
		return $this->curl("{$this->url}&api_action=deal_delete&api_output={$this->output}", $post_data);
	}

	
function get_entry($params) {
		return $this->curl("{$this->url}&api_action=deal_get&api_output={$this->output}&{$params}");
	}

	
function list_($params) {
		return $this->curl("{$this->url}&api_action=deal_list&api_output={$this->output}&{$params}");
	}

	
function note_add($params, $post_data) {
		return $this->curl("{$this->url}&api_action=deal_note_add&api_output={$this->output}", $post_data);
	}

	
function note_edit($params, $post_data) {
		return $this->curl("{$this->url}&api_action=deal_note_edit&api_output={$this->output}", $post_data);
	}

	
function pipeline_add($params, $post_data) {
		return $this->curl("{$this->url}&api_action=deal_pipeline_add&api_output={$this->output}", $post_data);
	}

	
function pipeline_edit($params, $post_data) {
		return $this->curl("{$this->url}&api_action=deal_pipeline_edit&api_output={$this->output}", $post_data);
	}

	
function pipeline_delete($params, $post_data) {
		return $this->curl("{$this->url}&api_action=deal_pipeline_delete&api_output={$this->output}", $post_data);
	}

	
function pipeline_list($params) {
		return $this->curl("{$this->url}&api_action=deal_pipeline_list&api_output={$this->output}&{$params}");
	}

	
function stage_add($params, $post_data) {
		return $this->curl("{$this->url}&api_action=deal_stage_add&api_output={$this->output}", $post_data);
	}

	
function stage_edit($params, $post_data) {
		return $this->curl("{$this->url}&api_action=deal_stage_edit&api_output={$this->output}", $post_data);
	}

	
function stage_delete($params, $post_data) {
		return $this->curl("{$this->url}&api_action=deal_stage_delete&api_output={$this->output}", $post_data);
	}

	
function stage_list($params) {
		return $this->curl("{$this->url}&api_action=deal_stage_list&api_output={$this->output}&{$params}");
	}

	
function task_add($params, $post_data) {
		return $this->curl("{$this->url}&api_action=deal_task_add&api_output={$this->output}", $post_data);
	}

	
function task_edit($params, $post_data) {
		return $this->curl("{$this->url}&api_action=deal_task_edit&api_output={$this->output}", $post_data);
	}

	
function tasktype_add($params, $post_data) {
		return $this->curl("{$this->url}&api_action=deal_tasktype_add&api_output={$this->output}", $post_data);
	}

	
function tasktype_edit($params, $post_data) {
		return $this->curl("{$this->url}&api_action=deal_tasktype_edit&api_output={$this->output}", $post_data);
	}

	
function tasktype_delete($params, $post_data) {
		return $this->curl("{$this->url}&api_action=deal_tasktype_delete&api_output={$this->output}", $post_data);
	}

}
