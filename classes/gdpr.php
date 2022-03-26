<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_q41vun96b {  static 
function m4ac_c7osbujd0f(array $m4ac_p4mx9w7rzk) { $m4ac_p4mx9w7rzk['memberium-ac'] = [ 'exporter_friendly_name' => __('Memberium'), 'callback' => [__CLASS__, 'm4ac_z3td0ga9mje'], ]; return $m4ac_p4mx9w7rzk; }  static 
function m4ac_w4v0fac57(array $m4ac_ogotbk827cr) { $m4ac_ogotbk827cr['memberium-ac'] = [ 'eraser_friendly_name' => __('Memberium'), 'callback' => [__CLASS__, 'm4ac_adugm67h43os'], ]; return $m4ac_ogotbk827cr; } static 
function m4ac_z3td0ga9mje(string $m4ac_d78sk4qc3i, int $m4ac_fqsk654i_hf = 1) { global $wpdb; $m4ac_d78sk4qc3i = strtolower(trim ($m4ac_d78sk4qc3i) ); $m4ac_fheyfujga6 = get_user_by('email', $m4ac_d78sk4qc3i); $m4ac_at_5xofh = $m4ac_fheyfujga6->ID; $m4ac_uo08x_g7 = memberium_app()->m4ac_pm63av15g($m4ac_at_5xofh); $m4ac_fqsk654i_hf = (int) $m4ac_fqsk654i_hf; $m4ac_aovhct9ak2 = []; $m4ac_md7c8zsu2o = []; $m4ac_e3ht7j0fxgiq = [ 'login_ip_address' => 'Login IP Address', 'last_login_time' => 'Last Login Time', 'login_count' => 'Login Count', ]; foreach( (array) $m4ac_e3ht7j0fxgiq as $m4ac_xurp0xnols83 => $m4ac_sv5rmko0) { $m4ac_y2mw1xc6rq = get_user_meta($m4ac_at_5xofh, $m4ac_xurp0xnols83, true); if (! empty($m4ac_y2mw1xc6rq) ) { $m4ac_md7c8zsu2o[] = [ 'name' => $m4ac_sv5rmko0, 'value' => $m4ac_y2mw1xc6rq, ]; } }  if ($m4ac_uo08x_g7) { $m4ac_qsvd0m6oq = memberium_app()->m4ac_zrj6g8l4ap9i($m4ac_uo08x_g7); if (! empty($m4ac_qsvd0m6oq) ) { foreach($m4ac_qsvd0m6oq as $m4ac_egl6dkai => $m4ac_y2mw1xc6rq) { if (! empty($m4ac_y2mw1xc6rq) ) { $m4ac_md7c8zsu2o[] = [ 'name' => ucwords(strtolower(trim($m4ac_egl6dkai, '%') )), 'value' => $m4ac_y2mw1xc6rq, ]; } } } } $m4ac_e01_avscgtu = 'memberium'; $m4ac_b4imeuyzbo90 = 'Memberium'; $m4ac_c_0iefnwl = "memberium-user"; $m4ac_aovhct9ak2[] = [ 'group_id' => $m4ac_e01_avscgtu, 'group_label' => $m4ac_b4imeuyzbo90, 'item_id' => $m4ac_c_0iefnwl, 'data' => $m4ac_md7c8zsu2o, ]; $m4ac_md7c8zsu2o = []; $m4ac_xtcz6bi97flk = 'SELECT DISTINCT `ipaddress` FROM `' . MEMBERIUM_DB_LOGINLOG . '` WHERE `username` = %s '; $m4ac_xtcz6bi97flk = $wpdb->prepare($m4ac_xtcz6bi97flk, $m4ac_d78sk4qc3i); $m4ac_x_1sx47rpefc = $wpdb->get_col($m4ac_xtcz6bi97flk); if (is_array($m4ac_x_1sx47rpefc) && ! empty($m4ac_x_1sx47rpefc) ) { foreach($m4ac_x_1sx47rpefc as $row) { $m4ac_md7c8zsu2o[] = [ 'name' => 'IP Address', 'value' => $row ]; } $m4ac_e01_avscgtu = 'memberium-ip-history'; $m4ac_b4imeuyzbo90 = 'Memberium IP History'; $m4ac_c_0iefnwl = "memberium-ip-history"; $m4ac_aovhct9ak2[] = [ 'group_id' => $m4ac_e01_avscgtu, 'group_label' => $m4ac_b4imeuyzbo90, 'item_id' => $m4ac_c_0iefnwl, 'data' => $m4ac_md7c8zsu2o, ]; } $m4ac_z67lu8fb = true; return [ 'data' => $m4ac_aovhct9ak2, 'done' => $m4ac_z67lu8fb, ]; } static 
function m4ac_adugm67h43os(string $m4ac_d78sk4qc3i, int $m4ac_fqsk654i_hf = 1) { global $wpdb; $m4ac_d78sk4qc3i = strtolower(trim ($m4ac_d78sk4qc3i) ); $m4ac_fheyfujga6 = get_user_by('email', $m4ac_d78sk4qc3i); $m4ac_at_5xofh = $m4ac_fheyfujga6->ID; $m4ac_l8qgkhwfjo = false; $m4ac_fqsk654i_hf = (int) $m4ac_fqsk654i_hf; $m4ac_h57xqitcp = memberium_app()->m4ac_bztk3xj1(); $m4ac_uo08x_g7 = memberium_app()->m4ac_pm63av15g($m4ac_at_5xofh); $m4ac_jouqjei9gbc3 = MEMBERIUM_DB_CONTACTS; if ($m4ac_uo08x_g7) { $m4ac_xtcz6bi97flk = "DELETE FROM `{$m4ac_jouqjei9gbc3}` WHERE `appname` = %s AND `id` = %d "; $m4ac_xtcz6bi97flk = $wpdb->prepare($m4ac_xtcz6bi97flk, $m4ac_h57xqitcp, $m4ac_uo08x_g7); $m4ac_l8qgkhwfjo += $wpdb->query($m4ac_xtcz6bi97flk); self::m4ac_fyau4dm0($m4ac_uo08x_g7); }  $m4ac_jouqjei9gbc3 = MEMBERIUM_DB_LOGINLOG; $m4ac_xtcz6bi97flk = "DELETE FROM `{$m4ac_jouqjei9gbc3}` WHERE `appname` = %s AND `username` = %s"; $m4ac_xtcz6bi97flk = $wpdb->prepare($m4ac_xtcz6bi97flk, $m4ac_h57xqitcp, $m4ac_d78sk4qc3i); $m4ac_l8qgkhwfjo += $wpdb->query($m4ac_xtcz6bi97flk);  return [ 'items_removed' => $m4ac_l8qgkhwfjo, 'items_retained' => false, 'messages' => [], 'done' => true, ]; } private static 
function m4ac_fyau4dm0(int $m4ac_uo08x_g7) { if (in_array('unlimited', m4ac_tl5skz6cfptr::m4ac_s8n7dqso_() ) ) { $m4ac_rsau1b7dj2lr = (int) memberium_app()->m4ac_x280qrz9kmic('gdpr_deleted_tag', 0); if ($m4ac_rsau1b7dj2lr > 0) { memberium_app()->m4ac_ocsjt69hrb($m4ac_rsau1b7dj2lr, $m4ac_uo08x_g7); } } return true; } 
function __construct() { }  } }
