<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_bem2ya5k { static 
function m4ac_pm63av15g($m4ac_at_5xofh) { $m4ac_uo08x_g7 = (int) get_user_meta($m4ac_at_5xofh, 'memberium_ac_contact_id', true);  return $m4ac_uo08x_g7; } static 
function m4ac_w_b7do4p($m4ac_at_5xofh, $m4ac_uo08x_g7) { $m4ac_at_5xofh = (int) $m4ac_at_5xofh; if (user_can($m4ac_at_5xofh, 'manage_options') ) { return; } $m4ac_nw7b1yqzh = self::m4ac_pm63av15g($m4ac_at_5xofh); if ($m4ac_nw7b1yqzh > 0 && $m4ac_nw7b1yqzh === $m4ac_uo08x_g7) { return; } global $wpdb; $m4ac_bzqua71m = 'memberium_ac_contact_id'; $m4ac_lzwv76pb9 = "m4ac/contact_id/{$m4ac_uo08x_g7}"; $m4ac_xtcz6bi97flk = "SELECT `umeta_id`, `meta_key`, `meta_value` FROM {$wpdb->usermeta} WHERE `user_id` = %d AND `meta_key` LIKE 'm4ac/contact_id/%' AND `meta_value` <> %d "; $m4ac_xtcz6bi97flk = $wpdb->prepare($m4ac_xtcz6bi97flk, $m4ac_at_5xofh, $m4ac_uo08x_g7); $m4ac_e3ht7j0fxgiq = $wpdb->get_results($m4ac_xtcz6bi97flk, OBJECT_K); if (is_array($m4ac_e3ht7j0fxgiq)) { foreach($m4ac_e3ht7j0fxgiq as $m4ac_xurp0xnols83) { delete_user_meta($m4ac_at_5xofh, $m4ac_xurp0xnols83->meta_key, $m4ac_xurp0xnols83->meta_value); } } update_user_meta($m4ac_at_5xofh, $m4ac_bzqua71m, $m4ac_uo08x_g7); update_user_meta($m4ac_at_5xofh, $m4ac_lzwv76pb9, $m4ac_uo08x_g7); }  static 
function m4ac_qnspthvw($m4ac_d78sk4qc3i, $m4ac_uo08x_g7) { $m4ac_fheyfujga6 = get_user_by('email', $m4ac_d78sk4qc3i); if ($m4ac_fheyfujga6) { self::m4ac_w_b7do4p($m4ac_fheyfujga6->ID, $m4ac_uo08x_g7); } } static 
function m4ac_y4vi6m8f1qhj($m4ac_uo08x_g7) { global $wpdb; $m4ac_ukqvxo6ne7 = "m4ac/contact_id/{$m4ac_uo08x_g7}"; $m4ac_xtcz6bi97flk = "SELECT `user_id` FROM {$wpdb->usermeta} WHERE `meta_key` = %s and `meta_value` = %d"; $m4ac_xtcz6bi97flk = $wpdb->prepare($m4ac_xtcz6bi97flk, $m4ac_ukqvxo6ne7, $m4ac_uo08x_g7); $m4ac_at_5xofh = (int) $wpdb->get_var($m4ac_xtcz6bi97flk); if (! $m4ac_at_5xofh) { $m4ac_ukqvxo6ne7 = 'memberium_ac_contact_id'; $m4ac_xtcz6bi97flk = "SELECT `user_id` FROM {$wpdb->usermeta} WHERE `meta_key` = %s and `meta_value` = %d"; $m4ac_xtcz6bi97flk = $wpdb->prepare($m4ac_xtcz6bi97flk, $m4ac_ukqvxo6ne7, $m4ac_uo08x_g7); $m4ac_at_5xofh = (int) $wpdb->get_var($m4ac_xtcz6bi97flk); if ($m4ac_at_5xofh) { self::m4ac_w_b7do4p($m4ac_at_5xofh, $m4ac_uo08x_g7); } } return $m4ac_at_5xofh; } static 
function m4ac_jwuh0szyia($m4ac_at_5xofh) { global $wpdb; $m4ac_at_5xofh = (int) $m4ac_at_5xofh; delete_user_meta($m4ac_at_5xofh, 'memberium_ac_contact_id'); $m4ac_xtcz6bi97flk = "DELETE FROM {$wpdb->usermeta} WHERE `user_id` = {$m4ac_at_5xofh} AND `meta_key` LIKE 'm4ac/contact_id/%';"; $wpdb->query($m4ac_xtcz6bi97flk); } static 
function m4ac_jednqz6buc($m4ac_uo08x_g7, $m4ac_bxvpge5qkdo9 = [] ) { } static 
function m4ac_caji1hn63q2($m4ac_uo08x_g7, $m4ac_bxvpge5qkdo9 = [] ) { }  } }
