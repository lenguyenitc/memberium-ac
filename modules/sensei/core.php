<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_vkm_wfdg1c { 
function m4ac_j2cb4d8a($m4ac_eq46hibd07c) { return count(get_all_active_learner_ids_for_course($m4ac_eq46hibd07c) ); } private 
function m4ac_yhz4g159vfym($m4ac_at_5xofh, $m4ac_ss6bwxopg8, $m4ac_fyj150rzo) { $m4ac_uo08x_g7 = memberium_app()->m4ac_pm63av15g($m4ac_at_5xofh); if (! $m4ac_uo08x_g7) { return; } if ($m4ac_ss6bwxopg8 == 'course') { $m4ac_jc30xzdo5 = $this->m4ac_i5902bskhf($m4ac_at_5xofh, $m4ac_fyj150rzo); } elseif ($m4ac_ss6bwxopg8 == 'lesson') { $m4ac_jc30xzdo5 = $this->m4ac_ms_qmykg($m4ac_at_5xofh, $m4ac_fyj150rzo); } else { return; } $m4ac_e3ht7j0fxgiq = get_post_meta($m4ac_fyj150rzo); $m4ac_a1_g9a7w = empty($m4ac_e3ht7j0fxgiq['_memberium_lms_automation'][0]) ? '' : $m4ac_e3ht7j0fxgiq['_memberium_lms_automation'][0]; $m4ac_rsau1b7dj2lr = empty($m4ac_e3ht7j0fxgiq['_memberium_lms_tag'][0]) ? '' : $m4ac_e3ht7j0fxgiq['_memberium_lms_tag'][0];  if (false) { if (! empty($m4ac_e3ht7j0fxgiq['_is4wp_lms_start_date'][0]) ) { $m4ac_ur90k1f2dy = isset($m4ac_e3ht7j0fxgiq['_is4wp_lms_start_date'][0]) ? $m4ac_e3ht7j0fxgiq['_is4wp_lms_start_date'][0] : ''; $m4ac_zdjqsh97rnep = isset($m4ac_jc30xzdo5['start'][0]) ? $m4ac_jc30xzdo5['start'][0] : ''; memberium_app()->set_dirty_contact_field($m4ac_uo08x_g7, $m4ac_ur90k1f2dy, $m4ac_zdjqsh97rnep); } if (! empty($m4ac_e3ht7j0fxgiq['_is4wp_lms_complete_percent'][0]) ) { $m4ac_ur90k1f2dy = isset($m4ac_e3ht7j0fxgiq['_is4wp_lms_complete_percent'][0]) ? $m4ac_e3ht7j0fxgiq['_is4wp_lms_complete_percent'][0] : ''; $m4ac_zdjqsh97rnep = isset($m4ac_jc30xzdo5['percent'][0]) ? $m4ac_jc30xzdo5['percent'][0] : ''; memberium_app()->set_dirty_contact_field($m4ac_uo08x_g7, $m4ac_ur90k1f2dy, $m4ac_zdjqsh97rnep); } } if (! empty($m4ac_rsau1b7dj2lr) ) { memberium_app()->m4ac_ocsjt69hrb($m4ac_rsau1b7dj2lr, $m4ac_uo08x_g7); } if (! empty($m4ac_a1_g9a7w) ) { memberium_app()->m4ac_lmhdiugb6cs($m4ac_a1_g9a7w, $m4ac_uo08x_g7); } do_action('memberium/lms/completion', $m4ac_at_5xofh, $m4ac_fyj150rzo); } private 
function m4ac_i5902bskhf($m4ac_at_5xofh, $m4ac_eq46hibd07c) { global $wpdb; $m4ac_eq46hibd07c = (int) $m4ac_eq46hibd07c; $m4ac_at_5xofh = (int) $m4ac_at_5xofh; $m4ac_xtcz6bi97flk = "SELECT `comment_ID` FROM `{$wpdb->comments}` WHERE `comment_post_ID` = {$m4ac_eq46hibd07c} AND `user_id` = {$m4ac_at_5xofh} AND `comment_approved` = 'complete' AND `comment_type` = 'sensei_course_status';"; $m4ac_v7_tuyn34 = (int) $wpdb->get_var($m4ac_xtcz6bi97flk); if ($m4ac_v7_tuyn34) { $m4ac__h7gi23rlfwj = get_comment_meta($m4ac_v7_tuyn34); } else { $m4ac__h7gi23rlfwj = []; } return $m4ac__h7gi23rlfwj; } private 
function m4ac_ms_qmykg($m4ac_at_5xofh, $m4ac_dhfjw_ib) { global $wpdb; $m4ac_dhfjw_ib = (int) $m4ac_dhfjw_ib; $m4ac_at_5xofh = (int) $m4ac_at_5xofh; $m4ac_xtcz6bi97flk = "SELECT `comment_ID` FROM `{$wpdb->comments}` WHERE `comment_post_ID` = {$m4ac_dhfjw_ib} AND `user_id` = {$m4ac_at_5xofh} AND `comment_approved` = 'complete' AND `comment_type` = 'sensei_lesson_status';"; $m4ac_v7_tuyn34 = (int) $wpdb->get_var($m4ac_xtcz6bi97flk); if ($m4ac_v7_tuyn34) { $m4ac__h7gi23rlfwj = get_comment_meta($m4ac_v7_tuyn34); } else { $m4ac__h7gi23rlfwj = []; } return $m4ac__h7gi23rlfwj; } private 
function m4ac_xcf6tldz() { return (int) sensei()->version; } private 
function m4ac_uxjwam8k2q0() { global $wpdb; $m4ac_r4fx9ld28 = '_memberium_lms_autoenroll'; $m4ac_pmokvuh_i = $wpdb->posts; $m4ac_aekgzj_c1 = $wpdb->postmeta; $m4ac_xtcz6bi97flk = "SELECT `ID`, `meta_value` FROM `{$m4ac_pmokvuh_i}`, `{$m4ac_aekgzj_c1}` WHERE post_status = 'publish' AND post_type = 'course' AND  post_id = ID AND meta_key = '{$m4ac_r4fx9ld28}' AND meta_value > '' "; $m4ac_dwslpr0x57b = $wpdb->get_results($m4ac_xtcz6bi97flk, ARRAY_A); return $m4ac_dwslpr0x57b; } private 
function m4ac_zuv32fl0e($m4ac_at_5xofh, $m4ac_eq46hibd07c) { $m4ac_cwimbugn = $this->m4ac_xcf6tldz(); if ($m4ac_cwimbugn == 2) { Sensei_Utils::user_start_course($m4ac_at_5xofh, $m4ac_eq46hibd07c);  } else { try { $m4ac_ygp3iwutd = new Sensei_Frontend; $m4ac_ygp3iwutd->manually_enrol_learner($m4ac_at_5xofh, $m4ac_eq46hibd07c); } catch (exception $m4ac_ipeq0zhwk5) { $this->m4ac_jn1gxbla_[] = [ 'action' => 'add', 'user_id' => $m4ac_at_5xofh, 'course_id' => $m4ac_eq46hibd07c, ]; } } } private 
function m4ac_c4fyabvq30s($m4ac_at_5xofh, $m4ac_eq46hibd07c) { $m4ac_cwimbugn = $this->m4ac_xcf6tldz(); if ($m4ac_cwimbugn == 2) { sensei_utils::sensei_remove_user_from_course($m4ac_eq46hibd07c, $m4ac_at_5xofh);  } else { try { $m4ac_ygp3iwutd = new Sensei_Frontend; $m4ac__bl57cx94j6v = Sensei_Course_Manual_Enrolment_Provider::instance();  sensei_utils::sensei_remove_user_from_course($m4ac_eq46hibd07c, $m4ac_at_5xofh);  $m4ac__bl57cx94j6v->withdraw_learner( $m4ac_at_5xofh, $m4ac_eq46hibd07c);  } catch (Exception $m4ac_ipeq0zhwk5) { $this->m4ac_jn1gxbla_[] = [ 'action' => 'remove', 'user_id' => $m4ac_at_5xofh, 'course_id' => $m4ac_eq46hibd07c, ]; } } } 
function m4ac_yewdilfu29($m4ac_at_5xofh, $m4ac__crsbi5yuze) { if (user_can($m4ac_at_5xofh, 'manage_options')) { return; } $m4ac_dwslpr0x57b = $this->m4ac_uxjwam8k2q0(); if (empty($m4ac_dwslpr0x57b) || ! is_array($m4ac_dwslpr0x57b)) { return; } $m4ac_klqx45k28ns = $this->m4ac_xcf6tldz(); $m4ac_ozqg25cw = empty($m4ac__crsbi5yuze['memb_db_fields']['groups']) ? '' : $m4ac__crsbi5yuze['memb_db_fields']['groups']; foreach ($m4ac_dwslpr0x57b as $m4ac_maz5nvkp) { $m4ac_r8u1kqoch = $m4ac_maz5nvkp['meta_value']; $m4ac_eq46hibd07c = $m4ac_maz5nvkp['ID']; $m4ac_qhc_yts1u7 = memberium_app()->m4ac_t5ws0_v68($m4ac_maz5nvkp['meta_value'], $m4ac__crsbi5yuze); $m4ac_h7pfibyqgh = sensei_utils::has_started_course($m4ac_eq46hibd07c, $m4ac_at_5xofh); if ($m4ac_h7pfibyqgh !== $m4ac_qhc_yts1u7) { if ($m4ac_qhc_yts1u7) {  $this->m4ac_zuv32fl0e($m4ac_at_5xofh, $m4ac_eq46hibd07c); } else {  $this->m4ac_c4fyabvq30s($m4ac_at_5xofh, $m4ac_eq46hibd07c); } } } } 
function m4ac_jtl5o4w6v() { if (empty($this->m4ac_jn1gxbla_)) { return; } foreach($this->m4ac_jn1gxbla_ as $m4ac_ukqvxo6ne7 => $m4ac_ihnr7cyv) { if ($m4ac_ihnr7cyv['action'] == 'add') { $this->m4ac_zuv32fl0e($m4ac_ihnr7cyv['user_id'], $m4ac_ihnr7cyv['course_id']); unset($m4ac_jn1gxbla_[$m4ac_ukqvxo6ne7]); } if ($m4ac_ihnr7cyv['action'] == 'remove') { $this->m4ac_c4fyabvq30s($m4ac_ihnr7cyv['user_id'], $m4ac_ihnr7cyv['course_id']); unset($m4ac_jn1gxbla_[$m4ac_ukqvxo6ne7]); } } } 
function m4ac_m6bdtfzviu0($m4ac_at_5xofh, $m4ac_eq46hibd07c) { $this->m4ac_yhz4g159vfym($m4ac_at_5xofh, 'course', $m4ac_eq46hibd07c); } 
function m4ac_fhz_r8mlskt7($m4ac_at_5xofh, $m4ac_dhfjw_ib) { $this->m4ac_yhz4g159vfym($m4ac_at_5xofh, 'lesson', $m4ac_dhfjw_ib); } 
function m4ac_lr0mxetj4gch($m4ac_at_5xofh, $m4ac_zr0lh_c46gkw, $m4ac_famz4tgu8k, $m4ac_f56_2auh9n8, $m4ac_v7wtzys4npq) { $m4ac_uo08x_g7 = memberium_app()->m4ac_pm63av15g($m4ac_at_5xofh); if (! $m4ac_uo08x_g7) { return; } $m4ac_x8jgmplo_1dh = wp_get_post_parent_id($m4ac_zr0lh_c46gkw);  $m4ac_ss6bwxopg8 = get_post_type($m4ac_x8jgmplo_1dh); if ($m4ac_ss6bwxopg8 == 'course') { $m4ac_jc30xzdo5 = $this->m4ac_i5902bskhf($m4ac_at_5xofh, $m4ac_x8jgmplo_1dh); } elseif ($m4ac_ss6bwxopg8 == 'lesson') { $m4ac_jc30xzdo5 = $this->m4ac_ms_qmykg($m4ac_at_5xofh, $m4ac_x8jgmplo_1dh); } else { return; } $m4ac_e3ht7j0fxgiq = get_post_meta($m4ac_zr0lh_c46gkw);  if (false) { if ( ! empty( $m4ac_e3ht7j0fxgiq['_is4wp_lms_grade'][0] ) ) { $m4ac_ur90k1f2dy = isset($m4ac_e3ht7j0fxgiq['_is4wp_lms_grade'][0]) ? $m4ac_e3ht7j0fxgiq['_is4wp_lms_grade'][0] : ''; $m4ac_zdjqsh97rnep = $m4ac_famz4tgu8k; memberium_app()->set_dirty_contact_field($m4ac_uo08x_g7, $m4ac_ur90k1f2dy, "{$m4ac_zdjqsh97rnep}"); } if (! empty($m4ac_e3ht7j0fxgiq['_is4wp_lms_completed'][0]) ) { $m4ac_ur90k1f2dy = isset($m4ac_e3ht7j0fxgiq['_is4wp_lms_completed'][0]) ? $m4ac_e3ht7j0fxgiq['_is4wp_lms_completed'][0] : ''; $m4ac_zdjqsh97rnep = (int) ($m4ac_famz4tgu8k >= $m4ac_f56_2auh9n8); memberium_app()->set_dirty_contact_field( $m4ac_uo08x_g7, $m4ac_ur90k1f2dy, $m4ac_zdjqsh97rnep ); } memberium_app()->m4ac_dki739zs2uq(); } } private 
function m4ac_rh6ijntd() { add_action('init', [$this, 'm4ac_jtl5o4w6v'], PHP_INT_MAX); add_action('memberium/session/updated', [$this, 'm4ac_yewdilfu29'], 10, 2); add_action('sensei_user_course_end', [$this, 'm4ac_m6bdtfzviu0'], 10, 2); add_action('sensei_user_lesson_end', [$this, 'm4ac_fhz_r8mlskt7'], 10, 2); add_action('sensei_user_quiz_grade', [$this, 'm4ac_lr0mxetj4gch'], 10, 5); } private 
function __construct() { memberium_app()->m4ac_chxl7ms_o9c('m4acwoosensei', 'WooSensei for Memberium for ActiveCampaign'); $this->m4ac_rh6ijntd(); if (is_admin() ) { include_once __DIR__ . '/admin.php'; m4ac_nvwo3u15_::m4ac_zw_dhmca(); } } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; } private $m4ac_jn1gxbla_ = [];  } }