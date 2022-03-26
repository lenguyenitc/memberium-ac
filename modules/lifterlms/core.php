<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_vuzyce68ip {   
function m4ac_uqr_u1ne0k($m4ac_f92tkhgnzfcb, $m4ac__37l6rhivt2) { return $m4ac_f92tkhgnzfcb; } 
function m4ac_joh8scux($m4ac_at_5xofh, $m4ac_eq46hibd07c) { $m4ac_uo08x_g7 = memberium_app()->m4ac_pm63av15g($m4ac_at_5xofh); if ($m4ac_uo08x_g7) { $m4ac_xurp0xnols83 = get_post_meta($m4ac_eq46hibd07c); if (! empty($m4ac_xurp0xnols83['_memberium_lms_automation'][0]) ) { memberium_app()->m4ac_lmhdiugb6cs($m4ac_xurp0xnols83['_memberium_lms_automation'][0], $m4ac_uo08x_g7); } if (! empty($m4ac_xurp0xnols83['_memberium_lms_tag'][0]) ) { memberium_app()->m4ac_ocsjt69hrb($m4ac_xurp0xnols83['_memberium_lms_tag'][0], $m4ac_uo08x_g7); } do_action('memberium/lms/completion', $m4ac_at_5xofh, $m4ac__37l6rhivt2); } } 
function m4ac_yuo6re_30waz($m4ac_at_5xofh, $m4ac_dhfjw_ib) { $m4ac_uo08x_g7 = memberium_app()->m4ac_pm63av15g($m4ac_at_5xofh); if ($m4ac_uo08x_g7) { $m4ac_xurp0xnols83 = get_post_meta($m4ac_dhfjw_ib); if (! empty($m4ac_xurp0xnols83['_memberium_lms_automation'][0]) ) { memberium_app()->m4ac_lmhdiugb6cs($m4ac_xurp0xnols83['_memberium_lms_automation'][0], $m4ac_uo08x_g7); } if (! empty($m4ac_xurp0xnols83['_memberium_lms_tag'][0]) ) { memberium_app()->m4ac_ocsjt69hrb($m4ac_xurp0xnols83['_memberium_lms_tag'][0], $m4ac_uo08x_g7); } do_action('memberium/lms/completion', $m4ac_at_5xofh, $m4ac__37l6rhivt2); } } 
function m4ac_gzf2xwdp9mo5($m4ac_at_5xofh, $m4ac_s_mr9ks0ex) { $m4ac_uo08x_g7 = memberium_app()->m4ac_pm63av15g($m4ac_at_5xofh); $m4ac_zr0lh_c46gkw = $m4ac_s_mr9ks0ex['id']; if ($m4ac_s_mr9ks0ex['passed']) { $m4ac_xurp0xnols83 = get_post_meta($m4ac_zr0lh_c46gkw); if (! empty($m4ac_xurp0xnols83['_memberium_lms_automation'][0]) ) { memberium_app()->m4ac_lmhdiugb6cs($m4ac_xurp0xnols83['_memberium_lms_automation'][0], $m4ac_uo08x_g7); } if (! empty($m4ac_xurp0xnols83['_memberium_lms_tag'][0]) ) { memberium_app()->m4ac_ocsjt69hrb($m4ac_xurp0xnols83['_memberium_lms_tag'][0], $m4ac_uo08x_g7); } do_action('memberium/lms/completion', $m4ac_at_5xofh, $m4ac__37l6rhivt2); } } private 
function m4ac_rh6ijntd() { add_action('lifterlms_lesson_completed', [$this, 'm4ac_yuo6re_30waz'], 5, 2); add_action('lifterlms_course_completed', [$this, 'm4ac_joh8scux'], 5, 2); add_action('lifterlms_quiz_completed', [$this, 'm4ac_gzf2xwdp9mo5'], 5, 2); add_action('memberium/session/updated', [memberium_app(), 'm4ac_qvf3jp61hyt'], 10, 2);  add_filter('llms_page_restricted', [$this, 'm4ac_uqr_u1ne0k'], 20, 2); } private 
function __construct() { memberium_app()->m4ac_chxl7ms_o9c('m4aclifterlms', 'LifterLMS for Memberium for ActiveCampaign'); $this->m4ac_rh6ijntd(); if (is_admin() ) { include __DIR__ . '/admin.php'; m4ac_dcho3qsnkfbv::m4ac_zw_dhmca(); } } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; }  } }
