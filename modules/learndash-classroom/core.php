<?php
/**
 * Copyright (c) 2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_k5h6dlyonj { public 
function m4ac_gm6_pd7vl() : array { return [ '_memberium_lms_groupcourse_autoenroll', ]; } 
function m4ac_focepd18(int $m4ac_at_5xofh, int $m4ac_e01_avscgtu) { $m4ac_uo08x_g7 = memberium_app()->m4ac_pm63av15g($m4ac_at_5xofh); if ($m4ac_uo08x_g7) { $m4ac_o8l2nrjpc75t = learndash_group_enrolled_courses($m4ac_e01_avscgtu); $m4ac__6h_pw1b5mfu = []; if (! empty($m4ac_o8l2nrjpc75t)) { foreach($m4ac_o8l2nrjpc75t as $m4ac_eq46hibd07c) { $m4ac_qfkmxuva96 = array_filter(explode(',', get_post_meta($m4ac_eq46hibd07c, '_memberium_lms_groupcourse_autoenroll', true) ) ); $m4ac__6h_pw1b5mfu = array_merge($m4ac__6h_pw1b5mfu, $m4ac_qfkmxuva96); } $m4ac__6h_pw1b5mfu = array_unique($m4ac__6h_pw1b5mfu); if (! empty($m4ac__6h_pw1b5mfu)) { memberium_app()->m4ac_ocsjt69hrb($m4ac__6h_pw1b5mfu, $m4ac_uo08x_g7); } } } } 
function m4ac_d3cn1azfh9v(int $m4ac_at_5xofh, int $m4ac_e01_avscgtu) { $m4ac_uo08x_g7 = memberium_app()->m4ac_pm63av15g($m4ac_at_5xofh); if ($m4ac_uo08x_g7) { $m4ac_o8l2nrjpc75t = learndash_group_enrolled_courses($m4ac_e01_avscgtu); $m4ac__6h_pw1b5mfu = []; if (! empty($m4ac_o8l2nrjpc75t)) { foreach($m4ac_o8l2nrjpc75t as $m4ac_eq46hibd07c) { $m4ac_qfkmxuva96 = array_filter(explode(',', get_post_meta($m4ac_eq46hibd07c, '_memberium_lms_groupcourse_autoenroll', true) ) ); $m4ac__6h_pw1b5mfu = array_merge($m4ac__6h_pw1b5mfu, $m4ac_qfkmxuva96); } $m4ac__6h_pw1b5mfu = array_unique($m4ac__6h_pw1b5mfu); if (! empty($m4ac__6h_pw1b5mfu)) { foreach($m4ac__6h_pw1b5mfu as $m4ac_ukqvxo6ne7 => $m4ac_o75qrnlisk) { $m4ac__6h_pw1b5mfu[$m4ac_ukqvxo6ne7] = (int) "-{$m4ac_o75qrnlisk}"; } $m4ac__6h_pw1b5mfu = implode(',', $m4ac_j0e14tousp_); memberium_app()->m4ac_ocsjt69hrb($m4ac__6h_pw1b5mfu, $m4ac_uo08x_g7); } } } } private 
function m4ac_rh6ijntd() { add_action('ld_removed_group_access', [$this, 'm4ac_d3cn1azfh9v'], 10, 2); add_action('ld_added_group_access', [$this, 'm4ac_focepd18'], 10, 2);  } private 
function __construct() { $this->m4ac_rh6ijntd(); if (is_admin() && require_once(__DIR__ . '/admin.php') ) { m4ac_pa0nhor9tjc::m4ac_zw_dhmca(); } } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; } } }
