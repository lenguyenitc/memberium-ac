<?php
/**
 * Copyright (c) 2020-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_z5imw3gzjvh { 
function m4ac_x1p3tgbs($m4ac_at_5xofh, $m4ac_yznhxig5vw8) { $m4ac_uo08x_g7 = (int) memberium_app()->m4ac_pm63av15g($m4ac_at_5xofh); if ($m4ac_uo08x_g7) { $m4ac_tvwmj3nezd7 = get_option('memberium/badgeos/tag_by_badge', [] ); if (! empty($m4ac_tvwmj3nezd7) ) { if (array_key_exists($m4ac_yznhxig5vw8, $m4ac_tvwmj3nezd7) ) { $m4ac_o75qrnlisk = $m4ac_tvwmj3nezd7[$m4ac_yznhxig5vw8]; memberium_app()->m4ac_ocsjt69hrb($m4ac_o75qrnlisk, $m4ac_uo08x_g7); } } } } 
function m4ac_lghvxt0q4z($m4ac_at_5xofh, $m4ac__crsbi5yuze) { if (! function_exists('badgeos_maybe_award_achievement_to_user') ) { return; } if (empty($m4ac__crsbi5yuze['memb_user']['tag_ids']) || empty($m4ac_at_5xofh) ) { return; } $m4ac_at_5xofh = (int) $m4ac_at_5xofh; $m4ac_j0e14tousp_ = explode(',', $m4ac__crsbi5yuze['memb_user']['tag_ids']); $m4ac_tvwmj3nezd7 = get_option('memberium/badgeos/assign_by_tag', [] ); $m4ac_o_wlyfigm97c = $this->m4ac_jfdzmch3_7j($m4ac_at_5xofh); foreach($m4ac_tvwmj3nezd7 as $m4ac_yznhxig5vw8 => $m4ac_rsau1b7dj2lr) { if (! empty($m4ac_rsau1b7dj2lr) ) { if (! in_array($m4ac_yznhxig5vw8, $m4ac_o_wlyfigm97c) ) { if (in_array($m4ac_rsau1b7dj2lr, $m4ac_j0e14tousp_) ) { badgeos_award_achievement_to_user($m4ac_yznhxig5vw8, $m4ac_at_5xofh); } } } } } 
function m4ac_jfdzmch3_7j($m4ac_at_5xofh = 0) { $m4ac_ah90o86m = [ 'user_id' => $m4ac_at_5xofh, ]; $m4ac_o_wlyfigm97c = badgeos_get_user_achievements($m4ac_ah90o86m); $m4ac_m5iu_o1l9y63 = array_map(function($m4ac__2sbtcpi0jey){ return $m4ac__2sbtcpi0jey->ID; }, $m4ac_o_wlyfigm97c); return $m4ac_m5iu_o1l9y63; } 
function m4ac_h_uel5bo8ax() { if (! function_exists('badgeos_get_achievements') ) { return []; } $m4ac_ah90o86m = [ 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', ]; $m4ac_o_wlyfigm97c = badgeos_get_achievements($m4ac_ah90o86m); $m4ac_k8yzb_1n7tpo = []; foreach($m4ac_o_wlyfigm97c as $m4ac__2sbtcpi0jey) { $m4ac_k8yzb_1n7tpo[$m4ac__2sbtcpi0jey->ID] = $m4ac__2sbtcpi0jey->post_title; } return $m4ac_k8yzb_1n7tpo; } 
function m4ac_g869u1ypmz7($m4ac_at_5xofh, $m4ac__37l6rhivt2) { if (function_exists('badgeos_award_achievement_to_user') ) { $m4ac_wnx_rwg4dya = get_post_meta($m4ac__37l6rhivt2, '_memberium_lms_achievement', true); if ($m4ac_wnx_rwg4dya) { badgeos_award_achievement_to_user($m4ac_wnx_rwg4dya, $m4ac_at_5xofh); } } } 
function m4ac_v48sf2rwq0op() { $m4ac_eohq7wvlb0i = 'm4ac_f3bt80q9ynda'; $m4ac_c46iyf5tz = [ 'memb_award_achievement' => 'm4ac_hj2znsgd_3', 'memb_revoke_achievement' => 'm4ac_kn5qgt2k', ]; foreach($m4ac_c46iyf5tz as $m4ac_pzocy3nw => $m4ac__ijlyd9ens) { add_shortcode($m4ac_pzocy3nw, [$m4ac_eohq7wvlb0i, $m4ac__ijlyd9ens]); } } private 
function m4ac_jfwg5lq7() { if ($_SERVER['REQUEST_METHOD'] == 'POST' && ! empty($_GET['key']) ) { require_once __DIR__ . '/webhooks.php'; $m4ac_eohq7wvlb0i = 'm4ac_k9xwo873_prq'; add_action('m4ac/webhook/award_achievement', [$m4ac_eohq7wvlb0i, 'm4ac_if_gucaht0x'], 10, 1); add_action('m4ac/webhook/award_points', [$m4ac_eohq7wvlb0i, 'm4ac_xyk3i56g8'], 10, 1); } } private 
function m4ac_rh6ijntd() { add_action('memberium/lms/completion', [$this, 'm4ac_g869u1ypmz7'], 10, 2); add_action('memberium/session/updated', [$this, 'm4ac_lghvxt0q4z'], 10, 2); add_action('badgeos_award_achievement', [$this, 'm4ac_x1p3tgbs'], 10, 2); if (is_admin() ) { include MEMBERIUM_MODULES_DIR . '/badgeos/admin.php'; m4ac_gtok6ui9::m4ac_zw_dhmca(); } else { add_action('memberium/shortcodes/add', [$this, 'm4ac_v48sf2rwq0op']); } } private 
function __construct() { $this->m4ac_rh6ijntd(); $this->m4ac_jfwg5lq7(); memberium_app()->m4ac_chxl7ms_o9c('m4acbadgeos', 'BadgeOS for Memberium for ActiveCampaign'); } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; }  } }