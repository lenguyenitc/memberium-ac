<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_ywyql6ok17r { public 
function m4ac_g7rwlehjdx6($m4ac_ihnr7cyv, $m4ac__37l6rhivt2, $m4ac_at_5xofh) { $m4ac_at_5xofh = empty($m4ac_at_5xofh) ? get_current_user_id() : $m4ac_at_5xofh; if (memberium_app()->m4ac_k6b8c0f7g5($m4ac_at_5xofh) ) { return true; } if ($m4ac_ihnr7cyv) { $m4ac_ihnr7cyv = memberium_app()->m4ac_u1avl_bn()->m4ac_mh407kspfdzq($m4ac__37l6rhivt2); } return $m4ac_ihnr7cyv; } public 
function m4ac_xdfmei5z($m4ac_p7j_84tfw, $m4ac_l9i7xcd4qv_, $m4ac_eq46hibd07c) { if ($m4ac_p7j_84tfw) { $m4ac_p7j_84tfw = m4ac_m7m0xgfv::m4ac_zw_dhmca()->m4ac_mh407kspfdzq($m4ac_l9i7xcd4qv_); } return $m4ac_p7j_84tfw; } public 
function m4ac_v48sf2rwq0op() { $m4ac_c46iyf5tz = 'm4ac_z85jadbo'; add_shortcode('memb_learndash_is_completed', [$m4ac_c46iyf5tz, 'm4ac_xc6g0azen4o']); add_shortcode('memb_learndash_is_enrolled', [$m4ac_c46iyf5tz, 'm4ac_v8npt9za6x']); add_shortcode('memb_learndash_course_enroll', [$m4ac_c46iyf5tz, 'm4ac_vyid5l6b4c_']); add_shortcode('memb_learndash_course_unenroll', [$m4ac_c46iyf5tz, 'm4ac_vyid5l6b4c_']); } private 
function m4ac_jfwg5lq7() { if ($_SERVER['REQUEST_METHOD'] == 'POST' && ! empty($_GET['key']) ) { require_once __DIR__ . '/webhooks.php'; $m4ac_eohq7wvlb0i = 'm4ac_qpr4s9xdty'; add_action('m4ac/webhook/create_group', [$m4ac_eohq7wvlb0i, 'm4ac_n4nefumqcxk'], 10, 1); add_action('m4ac/webhook/enroll_course', [$m4ac_eohq7wvlb0i, 'm4ac__bfa9uwh6'], 10, 1); } } private 
function m4ac_rh6ijntd() { add_action('memberium/shortcodes/add', [$this, 'm4ac_v48sf2rwq0op']); add_filter('learndash_can_user_read_step', [$this, 'm4ac_xdfmei5z'], 10, 3); add_filter('sfwd_lms_has_access', [$this, 'm4ac_g7rwlehjdx6'], PHP_INT_MAX, 3); } private 
function __construct() { $this->m4ac_rh6ijntd(); $this->m4ac_jfwg5lq7(); } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; } } }
