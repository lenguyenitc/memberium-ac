<?php
/**
 * Copyright (c) 2020 David J Bullock
 * Web Power and Light
 */

 if (! defined('ABSPATH') ) { die(); } if ( class_exists('m4ac_fxpbyk36nrs') ) { final 
class m4ac_ygq0pdca9j7 { 
function m4ac_v48sf2rwq0op($m4ac_j0e14tousp_) { $m4ac_eohq7wvlb0i = 'm4ac_zljx6gq_'; $m4ac_n5dw3y7vlku = 'memb_groupaccount_'; $m4ac_sizoc4_wk2lx = 'standard'; $m4ac_j0e14tousp_[$m4ac_sizoc4_wk2lx]["{$m4ac_n5dw3y7vlku}child_count"] = [$m4ac_eohq7wvlb0i, 'm4ac_eo96ytq52h']; $m4ac_j0e14tousp_[$m4ac_sizoc4_wk2lx]["{$m4ac_n5dw3y7vlku}enroll_child"] = [$m4ac_eohq7wvlb0i, 'm4ac_aqnegc7ai0o']; $m4ac_j0e14tousp_[$m4ac_sizoc4_wk2lx]["{$m4ac_n5dw3y7vlku}has_children"] = [$m4ac_eohq7wvlb0i, 'm4ac_k3mxr69v4t']; $m4ac_j0e14tousp_[$m4ac_sizoc4_wk2lx]["{$m4ac_n5dw3y7vlku}is_child"] = [$m4ac_eohq7wvlb0i, 'm4ac_iyi0h36b']; $m4ac_j0e14tousp_[$m4ac_sizoc4_wk2lx]["{$m4ac_n5dw3y7vlku}is_parent"] = [$m4ac_eohq7wvlb0i, 'm4ac_wfhrlmpd84']; $m4ac_j0e14tousp_[$m4ac_sizoc4_wk2lx]["{$m4ac_n5dw3y7vlku}list_children"] = [$m4ac_eohq7wvlb0i, 'm4ac_v3sber0yiljp']; $m4ac_j0e14tousp_[$m4ac_sizoc4_wk2lx]["{$m4ac_n5dw3y7vlku}show_code"] = [$m4ac_eohq7wvlb0i, 'm4ac_sv8efbsrq']; return $m4ac_j0e14tousp_; } private 
function m4ac_rh6ijntd() { add_filter( 'm4ac/shortcode_names', [$this, 'm4ac_v48sf2rwq0op'], 10, 1 ); add_action( 'wp_enqueue_scripts', [$this, 'm4ac_m_9sq42m8'] ); add_action( 'wp_footer', [$this, 'm4ac_zqnbt5u690am'] ); }    
function m4ac_m_9sq42m8(){ $m4ac_y2mw1xc6rq = m4ac_fxpbyk36nrs::VERSION; $m4ac_hakbo4tlcx2_ = trailingslashit( plugins_url('memberium-ac') ); wp_register_style( 'm4ac_groupaccounts_child_css', "{$m4ac_hakbo4tlcx2_}/css/groupaccounts-child-list.css", false, $m4ac_y2mw1xc6rq, 'all' ); wp_register_script( 'm4ac_groupaccounts_js', "{$m4ac_hakbo4tlcx2_}/js/groupaccounts-front.js", [], $m4ac_y2mw1xc6rq, true ); } 
function m4ac_zqnbt5u690am(){ if( ! empty($this->m4ac_o_9h7xk02v45) ){ $this->m4ac_o_9h7xk02v45['ajaxUrl'] = admin_url('admin-ajax.php'); wp_localize_script( 'm4ac_groupaccounts_js', 'm4acGroupAccountsData', $this->m4ac_o_9h7xk02v45 ); wp_enqueue_script( 'm4ac_groupaccounts_js' ); } } 
function m4ac_wrdk07a_c( $m4ac_ukqvxo6ne7, $m4ac_ihnr7cyv = false ) { if ($m4ac_ihnr7cyv) { $this->m4ac_o_9h7xk02v45[$m4ac_ukqvxo6ne7] = $m4ac_ihnr7cyv; } } 
function m4ac_kyw8rgxof19m( $m4ac_ukqvxo6ne7 = false ) { if ($m4ac_ukqvxo6ne7) { return isset($this->m4ac_o_9h7xk02v45[$m4ac_ukqvxo6ne7]) ? $this->m4ac_o_9h7xk02v45[$m4ac_ukqvxo6ne7] : false; } else { return $this->m4ac_o_9h7xk02v45; } } 
function __construct() { $this->m4ac_rh6ijntd(); } 
function __destruct() { } static 
function m4ac_zw_dhmca() : self { return self::$m4ac_u4tpxcro19 ? self::$m4ac_u4tpxcro19 : self::$m4ac_u4tpxcro19 = new self; } private static $m4ac_u4tpxcro19 = false; private $m4ac_o_9h7xk02v45 = [];  } }
