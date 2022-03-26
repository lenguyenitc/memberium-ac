<?php
/**
 * Copyright (c) 2020 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_gha03gknz { 
function m4ac_d2of90grdw($m4ac_x6vpzdgl54) { add_submenu_page($m4ac_x6vpzdgl54, 'Group Accounts (Beta)', 'Group Accounts', 'manage_options', 'm4ac-group-accounts', [$this, 'm4ac_axb53npk']); } 
function m4ac_axb53npk() { if (current_user_can('manage_options') ) { include_once __DIR__ . '/screens/settings.php'; m4ac_ckswq86yel5z::m4ac_lgfsc19jo3_r(); } } 
function m4ac__1xhns3la9p($m4ac_q3_aoy0q1d8 = false) { $m4ac_kh4lbwzr = 'memberium/groupaccounts/version'; $m4ac_x7s6u4n8i = $m4ac_q3_aoy0q1d8; $m4ac_x7s6u4n8i = $m4ac_x7s6u4n8i || get_option($m4ac_kh4lbwzr, 0) !== m4ac_fxpbyk36nrs::VERSION; $m4ac_x7s6u4n8i = $m4ac_x7s6u4n8i || $this->m4ac_d0wvtoj2iz(); if ($m4ac_x7s6u4n8i) { m4ac_cv4qfzco2k::m4ac_u0q7g4ejd8(); } } 
function m4ac_sj9nudr1() { $this->m4ac__1xhns3la9p(); } 
function __construct() { $this->register_actions(); } private 
function register_actions() { add_action('admin_init', [$this, 'm4ac_sj9nudr1'], 100); add_filter('memberium/dashboard/metrics/system', [$this, 'm4ac_xpo0ty85'], 10, 1); add_action('memberium_admin_menu_addons', [$this, 'm4ac_d2of90grdw'], 10, 1); } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; } private 
function m4ac_d0wvtoj2iz() { global $wpdb; $sql = "SHOW TABLES LIKE '%memberium_umbrella%';"; $tables = count($wpdb->get_results($sql) ); return ! ($tables == 1); } 
function m4ac_xpo0ty85($m4ac_xtz04kug) { global $wpdb; $m4ac_p80burja5 = "{$wpdb->prefix}memberium_groupaccount_members"; $sql = "SELECT distinct count(`parent_uid`) FROM `{$m4ac_p80burja5}` WHERE ";  return $m4ac_xtz04kug; }  } }
