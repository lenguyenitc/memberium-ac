<?php
/**
 * Copyright (c) 2020-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_f3bt80q9ynda {  static 
function m4ac_hj2znsgd_3($m4ac_c1m92xtgl8z, string $m4ac_c4qc56391fd = '', $m4ac_kp6zrjntmf78 = '') { $m4ac_wdl2r3x6jg = [ 'achievement_id' => 0, 'user_id' => 0, ]; if (isset($m4ac_c1m92xtgl8z[0]) && $m4ac_c1m92xtgl8z[0] == 'showatts') { return implode(',', array_keys($m4ac_wdl2r3x6jg) ); } if (! is_user_logged_In() ) { return ''; } $m4ac_c1m92xtgl8z = shortcode_atts($m4ac_wdl2r3x6jg, $m4ac_c1m92xtgl8z, 'memberium'); $m4ac_c1m92xtgl8z['achievement_id'] = (int) $m4ac_c1m92xtgl8z['achievement_id']; $m4ac_c1m92xtgl8z['user_id'] = empty($m4ac_c1m92xtgl8z['user_id']) ? get_current_user_id() : $m4ac_c1m92xtgl8z['user_id']; if (empty($m4ac_c1m92xtgl8z['achievement_id']) ) { return ''; } if (empty($m4ac_c1m92xtgl8z['user_id']) ) { return ''; } $m4ac_lyvfabip4_s = badgeos_get_user_earned_achievement_ids($m4ac_c1m92xtgl8z['user_id']); if (in_array($m4ac_c1m92xtgl8z['achievement_id'], $m4ac_lyvfabip4_s) ) { return ''; } badgeos_award_achievement_to_user($m4ac_c1m92xtgl8z['achievement_id'], $m4ac_c1m92xtgl8z['user_id']); $m4ac_g0rhz13y8sn = array_filter(explode(',', get_user_meta(current_user_id(), 'memberium_achievement_uids', true) ) ); $m4ac_g0rhz13y8sn[] = $m4ac_c1m92xtgl8z['achievement_id']; $m4ac_g0rhz13y8sn = implode(',', array_unique($m4ac_g0rhz13y8sn) ); update_user_meta($m4ac_c1m92xtgl8z['user_id'], 'memberium_achievement_uids', $m4ac_g0rhz13y8sn); return ''; }  static 
function m4ac_kn5qgt2k($m4ac_c1m92xtgl8z, string $m4ac_c4qc56391fd = '', $m4ac_kp6zrjntmf78 = '') { $m4ac_wdl2r3x6jg = [ 'achievement_id' => 0, 'user_id' => '', ]; if (isset($m4ac_c1m92xtgl8z[0]) && $m4ac_c1m92xtgl8z[0] == 'showatts') { return implode(',', array_keys($m4ac_wdl2r3x6jg) ); } if (! is_user_logged_In() ) { return ''; } $m4ac_c1m92xtgl8z = shortcode_atts($m4ac_wdl2r3x6jg, $m4ac_c1m92xtgl8z, 'memberium'); $m4ac_c1m92xtgl8z['achievement_id'] = (int) $m4ac_c1m92xtgl8z['achievement_id']; $m4ac_c1m92xtgl8z['user_id'] = empty($m4ac_c1m92xtgl8z['user_id']) ? get_current_user_id() : $m4ac_c1m92xtgl8z['user_id']; if (empty($m4ac_c1m92xtgl8z['achievement_id']) ) { return ''; } if (empty($m4ac_c1m92xtgl8z['user_id']) ) { return ''; } $m4ac_lyvfabip4_s = badgeos_get_user_earned_achievement_ids($m4ac_c1m92xtgl8z['user_id']); if (! in_array($m4ac_c1m92xtgl8z['achievement_id'], $m4ac_lyvfabip4_s) ) { return ''; } badgeos_revoke_achievement_from_user($m4ac_c1m92xtgl8z['achievement_id'], $m4ac_c1m92xtgl8z['user_id']); $m4ac_g0rhz13y8sn = array_filter(explode(',', get_user_meta(current_user_id(), 'memberium_achievement_uids', true) ) ); if ( ($m4ac_ukqvxo6ne7 = array_search($m4ac_c1m92xtgl8z['achievement_id'], $m4ac_g0rhz13y8sn) ) !== false) { unset($m4ac_g0rhz13y8sn[$m4ac_ukqvxo6ne7]); } $m4ac_g0rhz13y8sn = implode(',', array_unique($m4ac_g0rhz13y8sn) ); update_user_meta($m4ac_c1m92xtgl8z['user_id'], 'memberium_achievement_uids', $m4ac_g0rhz13y8sn); return ''; } } }
