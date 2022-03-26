<?php
/**
 * Copyright (c) 2018-2021 David J Bullock
 * Web Power and Light
*/

 if (! defined( 'ABSPATH' ) ) { die(); }  if (class_exists('m4ac_c6rqypiacz4') ) { 
class m4ac_rsn24b38gcp { public $slug = 'elementor';  public $container_els = ['section', 'column'];  public $container_visibility = [];  public $widget_visibility = [];  public $ns = '';  private 
function __construct(){} static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = null; if(is_null($m4ac_u4tpxcro19)){ $m4ac_u4tpxcro19 = new self; $m4ac_u4tpxcro19->ns = m4ac_rntik2rdq0::NS; $m4ac_u4tpxcro19->m4ac_w07mrqh2sxlp(); } return $m4ac_u4tpxcro19; } 
function m4ac_w07mrqh2sxlp() { $this->container_els = apply_filters("{$this->ns}/{$this->slug}/editor/container_slugs", $this->container_els);  add_action('elementor/widgets/widgets_registered', [$this, 'm4ac_jo_jzkrdhx3g'], 20 );  add_action('elementor/frontend/before_render', [$this, 'm4ac_lrofzlv4e1'], 10, 1 );  add_action('elementor/frontend/after_render', [$this, 'm4ac_exg7pdl6_q'], 10, 1 );  add_filter('elementor/frontend/section/should_render', [$this, 'm4ac_nnw02uvehs46'], 1, 2 );  add_filter('elementor/frontend/column/should_render', [$this, 'm4ac_nnw02uvehs46'], 1, 2 ); add_filter('elementor/frontend/widget/should_render', [$this, 'm4ac_nnw02uvehs46'], 1, 2 ); }  
function m4ac_jo_jzkrdhx3g($m4ac__ta6lp0k3yiv) { $m4ac__ta6lp0k3yiv->unregister_widget_type('shortcode'); require_once __DIR__ . '/widget-shortcode.php'; $m4ac__ta6lp0k3yiv->register_widget_type(new m4ac_d5p_b3rdkjis); }  
function m4ac_lrofzlv4e1($m4ac_s4vbziwltsh) {  if ( \Elementor\Plugin::$instance->editor->is_edit_mode() || empty($m4ac_s4vbziwltsh) ) { return; } $m4ac_sxr6ok5c49b = $m4ac_s4vbziwltsh->get_type(); $m4ac_xqndufev = $m4ac_s4vbziwltsh->get_id(); $m4ac_lqg2ejwks8 = $m4ac_s4vbziwltsh->get_settings_for_display(); $m4ac_ryjk0cu9 = $this->m4ac_pmskz27in0p($m4ac_lqg2ejwks8); $m4ac_km4i0phu = in_array($m4ac_sxr6ok5c49b, $this->container_els);  if ( $m4ac_km4i0phu ){  if (! $m4ac_ryjk0cu9) { $this->container_visibility[$m4ac_xqndufev] = $this->m4ac_wj0iql6r9c($m4ac_s4vbziwltsh); } }  else { $m4ac_f219sgjhimvx = $m4ac_s4vbziwltsh->get_name();  if ( $m4ac_ryjk0cu9 ) {  $m4ac_ryjk0cu9 = $this->m4ac_xjr6q53yt4h1( $m4ac_xqndufev, $m4ac_ryjk0cu9 );  if ( ! $m4ac_ryjk0cu9 ) { $this->widget_visibility[] = $m4ac_xqndufev; } }  else { $this->widget_visibility[] = $m4ac_xqndufev; }  if ( ! $m4ac_ryjk0cu9 ) { if ($m4ac_f219sgjhimvx === 'text-editor') { add_filter('widget_text', [$this, 'm4ac_dlvumc0x'], 1, 2 ); } if ($m4ac_f219sgjhimvx === 'shortcode') { add_filter("{$this->ns}/{$this->slug}/widget/shortcode/render", [$this, 'm4ac_dlvumc0x'], 1, 2 ); } } } }  
function m4ac_exg7pdl6_q($m4ac_s4vbziwltsh) {  if ( \Elementor\Plugin::$instance->editor->is_edit_mode() || empty( $m4ac_s4vbziwltsh ) ) { return; } $m4ac_sxr6ok5c49b = $m4ac_s4vbziwltsh->get_type(); $m4ac_xqndufev = $m4ac_s4vbziwltsh->get_id(); $m4ac_km4i0phu = in_array($m4ac_sxr6ok5c49b, $this->container_els);  if ($m4ac_km4i0phu) { }  else { $m4ac_f219sgjhimvx = $m4ac_s4vbziwltsh->get_name();  if ( in_array( $m4ac_xqndufev, $this->widget_visibility ) ){ if ( $m4ac_f219sgjhimvx === 'text-editor' ){ remove_filter('widget_text', [$this, 'm4ac_dlvumc0x'], 1 ); } if ( $m4ac_f219sgjhimvx === 'shortcode' ){ remove_filter("{$this->ns}/{$this->slug}/widget/shortcode/render", [$this, 'm4ac_dlvumc0x'], 1, 2 ); } } } }  
function m4ac_wj0iql6r9c($m4ac_s4vbziwltsh) { $m4ac_v1ea40rbm9s = $m4ac_s4vbziwltsh->get_data('elements'); $m4ac_pgsmvk094ey = []; if ( is_array( $m4ac_v1ea40rbm9s ) && !empty( $m4ac_v1ea40rbm9s ) ){ foreach ($m4ac_v1ea40rbm9s as $key => $m4ac_bxgo2_8ep) { $m4ac_pgsmvk094ey = $this->m4ac_sh39unqv( $m4ac_pgsmvk094ey, $m4ac_bxgo2_8ep ); $m4ac_nl738uhm = ( isset($m4ac_bxgo2_8ep['elements']) && !empty($m4ac_bxgo2_8ep['elements']) ) ? $m4ac_bxgo2_8ep['elements'] : false; if ( $m4ac_nl738uhm ){ foreach ($m4ac_nl738uhm as $m4ac_s4vbziwltsh => $m4ac_v2h87nftp) { $m4ac_pgsmvk094ey = $this->m4ac_sh39unqv( $m4ac_pgsmvk094ey, $m4ac_v2h87nftp ); $m4ac_wa6h78wo = isset($m4ac_v2h87nftp['elements']) ? $m4ac_v2h87nftp['elements'] : false; if ( $m4ac_wa6h78wo ){ foreach ($m4ac_wa6h78wo as $m4ac_jd7clhqxvu4 => $m4ac_ihnr7cyv) { $m4ac_pgsmvk094ey = $this->m4ac_sh39unqv( $m4ac_pgsmvk094ey, $m4ac_ihnr7cyv ); } } } } } } return $m4ac_pgsmvk094ey; }  
function m4ac_sh39unqv($m4ac_pgsmvk094ey, $m4ac_md7c8zsu2o) { $m4ac_ss6bwxopg8 = !empty($m4ac_md7c8zsu2o['elType']) ? $m4ac_md7c8zsu2o['elType'] : false; $m4ac_lj_fwoc5ub1y = !empty($m4ac_md7c8zsu2o['id']) ? $m4ac_md7c8zsu2o['id'] : false; if ( $m4ac_ss6bwxopg8 === 'widget' && $m4ac_lj_fwoc5ub1y) { $m4ac_pgsmvk094ey[] = $m4ac_lj_fwoc5ub1y; } return $m4ac_pgsmvk094ey; }  
function m4ac_xjr6q53yt4h1($m4ac_xqndufev, $m4ac_ryjk0cu9) {  $m4ac_sfwdljoun8r2 = false; if ( !empty($this->container_visibility) ){ foreach ($this->container_visibility as $m4ac_m5blk4xjo6m => $m4ac_g0rhz13y8sn) { if ( is_array( $m4ac_g0rhz13y8sn ) ){ foreach ($m4ac_g0rhz13y8sn as $m4ac_lj_fwoc5ub1y) { if ( $m4ac_xqndufev === $m4ac_lj_fwoc5ub1y ){ $m4ac_ryjk0cu9 = false; } } } } } return $m4ac_ryjk0cu9; }  
function m4ac_nnw02uvehs46($m4ac_s8craofhvwj, $m4ac_s4vbziwltsh) {  if ( \Elementor\Plugin::$instance->editor->is_edit_mode() || empty( $m4ac_s4vbziwltsh ) ) { return $m4ac_s8craofhvwj; } $m4ac_sxr6ok5c49b = $m4ac_s4vbziwltsh->get_type(); $m4ac_xqndufev = $m4ac_s4vbziwltsh->get_id(); $m4ac_km4i0phu = in_array( $m4ac_sxr6ok5c49b, $this->container_els );  if ( $m4ac_km4i0phu ){ if ( array_key_exists( $m4ac_xqndufev, $this->container_visibility ) ){ if ( $m4ac_sxr6ok5c49b === 'section' ){ $m4ac_s8craofhvwj = false; } } }  else { if ( in_array($m4ac_xqndufev, $this->widget_visibility) ){ $m4ac_s8craofhvwj = false; } } return $m4ac_s8craofhvwj; }  
function m4ac_dlvumc0x($m4ac_c4qc56391fd, $m4ac_lqg2ejwks8) { return ' '; }  
function m4ac_pmskz27in0p( array $m4ac_zi6f9ge7py8 = [] ) : bool { $m4ac_t3cu9hgt = [];  $m4ac_at3z4pf08bk5 = m4ac_rntik2rdq0::m4ac_zw_dhmca(); $m4ac_n9dgpcif35mr = $m4ac_at3z4pf08bk5::PREFIX; foreach ($m4ac_zi6f9ge7py8 as $m4ac_pzocy3nw => $m4ac_ihnr7cyv) { if ( strpos($m4ac_pzocy3nw, "{$m4ac_n9dgpcif35mr}_membership_levels") !== false && $m4ac_ihnr7cyv === '1' ) { $m4ac_t3cu9hgt[] = (int) str_replace("{$m4ac_n9dgpcif35mr}_membership_levels-", "", $m4ac_pzocy3nw); } } $m4ac_o1wy3x076 = isset($m4ac_zi6f9ge7py8["{$m4ac_n9dgpcif35mr}_access_tags"]) ? $m4ac_zi6f9ge7py8["{$m4ac_n9dgpcif35mr}_access_tags"] : ''; $m4ac_o1wy3x076 = !empty($m4ac_o1wy3x076) && is_array($m4ac_o1wy3x076) ? implode(',', $m4ac_o1wy3x076) : $m4ac_o1wy3x076; $m4ac_rz2xgywca = isset($m4ac_zi6f9ge7py8["{$m4ac_n9dgpcif35mr}_access_tags2"]) ? $m4ac_zi6f9ge7py8["{$m4ac_n9dgpcif35mr}_access_tags2"] : ''; $m4ac_rz2xgywca = !empty($m4ac_rz2xgywca) && is_array($m4ac_rz2xgywca) ? implode(',', $m4ac_rz2xgywca) : $m4ac_rz2xgywca; $m4ac_bxvpge5qkdo9 = [ 'memberships' => implode(',', $m4ac_t3cu9hgt), 'any_membership' => isset($m4ac_zi6f9ge7py8["{$m4ac_n9dgpcif35mr}_anymembership"]) && $m4ac_zi6f9ge7py8["{$m4ac_n9dgpcif35mr}_anymembership"] === '1' ? 1 : 0, 'logged_in_only' => isset($m4ac_zi6f9ge7py8["{$m4ac_n9dgpcif35mr}_loggedin"] ) && $m4ac_zi6f9ge7py8["{$m4ac_n9dgpcif35mr}_loggedin"] === '1' ? 1 : 0, 'logged_out_only' => isset($m4ac_zi6f9ge7py8["{$m4ac_n9dgpcif35mr}_anonymous_only"] ) && $m4ac_zi6f9ge7py8["{$m4ac_n9dgpcif35mr}_anonymous_only"] === '1' ? 1 : 0, 'invert_results' => isset($m4ac_zi6f9ge7py8["{$m4ac_n9dgpcif35mr}_invert_results"] ) && $m4ac_zi6f9ge7py8["{$m4ac_n9dgpcif35mr}_invert_results"] === '1' ? 1 : 0, 'contact_ids' => isset($m4ac_zi6f9ge7py8["{$m4ac_n9dgpcif35mr}_contact_ids"]) ? sanitize_text_field($m4ac_zi6f9ge7py8["{$m4ac_n9dgpcif35mr}_contact_ids"]) : '', 'eval' => isset($m4ac_zi6f9ge7py8["{$m4ac_n9dgpcif35mr}_eval"]) ? trim($m4ac_zi6f9ge7py8["{$m4ac_n9dgpcif35mr}_eval"]) : '', 'asset_id' => isset($m4ac_zi6f9ge7py8["{$m4ac_n9dgpcif35mr}_asset_id"]) ? sanitize_text_field($m4ac_zi6f9ge7py8["{$m4ac_n9dgpcif35mr}_asset_id"]) : '', 'tags1' => !empty($m4ac_o1wy3x076) ? trim($m4ac_o1wy3x076, ',') : '', 'tags2' => !empty($m4ac_rz2xgywca) ? trim($m4ac_rz2xgywca, ',') : '' ]; return $m4ac_at3z4pf08bk5->m4ac_wxodvum9bt()->m4ac_tf2ju8al( $m4ac_bxvpge5qkdo9, 'elementor' ); } } }