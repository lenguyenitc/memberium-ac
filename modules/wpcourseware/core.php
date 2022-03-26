<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_lpmev89gjdi { 
function m4ac_l_3vsn0i(int $m4ac_at_5xofh, int $m4ac_goga1uxmdt, $m4ac_b8bjfslep) { $m4ac_uo08x_g7 = memberium_app()->m4ac_pm63av15g($m4ac_at_5xofh); if ($m4ac_uo08x_g7) { $m4ac_fyj150rzo = $m4ac_b8bjfslep->module_id; $m4ac_c4a3wlpzi = get_option('memberium_wpcw', [] ); if (isset($m4ac_c4a3wlpzi['modules']['completion_tag'][$m4ac_fyj150rzo]) ) { $m4ac_j0e14tousp_ = $m4ac_c4a3wlpzi['modules']['completion_tag'][$m4ac_fyj150rzo]; if (! empty($m4ac_j0e14tousp_) ) { memberium_app()->m4ac_ocsjt69hrb($m4ac_j0e14tousp_); } do_action('memberium/lms/completion', $m4ac_at_5xofh, $m4ac_goga1uxmdt); } } } 
function m4ac_vpdgviqa4(int $m4ac_at_5xofh, int $m4ac_goga1uxmdt, $m4ac_b8bjfslep) { $m4ac_uo08x_g7 = memberium_app()->m4ac_pm63av15g($m4ac_at_5xofh); if ($m4ac_uo08x_g7) { $m4ac_j0e14tousp_ = get_post_meta($m4ac_goga1uxmdt, '_memberium_wpcw_completion_tag', true); if ($m4ac_j0e14tousp_) { $this->m4ac_ocsjt69hrb($m4ac_j0e14tousp_); } do_action('memberium/lms/completion', $m4ac_at_5xofh, $m4ac_goga1uxmdt); } } 
function m4ac_f1h658xzm(int $m4ac_at_5xofh, int $m4ac_goga1uxmdt, $m4ac_b8bjfslep) { $m4ac_uo08x_g7 = memberium_app()->m4ac_pm63av15g($m4ac_at_5xofh); if ($m4ac_uo08x_g7) { $m4ac_eq46hibd07c = $m4ac_b8bjfslep->course_id; $m4ac_c4a3wlpzi = get_option('memberium_wpcw', [] ); if (isset($m4ac_c4a3wlpzi['courses']['completion_tag'][$m4ac_eq46hibd07c]) ) { $m4ac_j0e14tousp_ = $m4ac_c4a3wlpzi['courses']['completion_tag'][$m4ac_eq46hibd07c]; if (! empty($m4ac_j0e14tousp_) ) { memberium_app()->m4ac_ocsjt69hrb($m4ac_j0e14tousp_); } do_action('memberium/lms/completion', $m4ac_at_5xofh, $m4ac__37l6rhivt2); } } } private 
function m4ac_rh6ijntd() { add_action('wpcw_user_completed_course', [$this, 'm4ac_f1h658xzm'], 10, 3); add_action('wpcw_user_completed_module', [$this, 'm4ac_l_3vsn0i'], 10, 3); add_action('wpcw_user_completed_unit', [$this, 'm4ac_vpdgviqa4'], 10, 3); add_action('memberium/session/updated', [memberium_app(), 'm4ac_vuqs1opjhf'], 10, 2);  } 
function __construct() { $this->m4ac_rh6ijntd(); }  } }
