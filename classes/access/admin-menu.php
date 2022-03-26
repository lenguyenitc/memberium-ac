<?php
/**
 * Copyright (c) 2017-2021 David J Bullock
 * Web Power and Light, LLC
 * https://webpowerandlight.com
 * support@webpowerandlight.com
 *
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_cwgpe3b8ds { static 
function m4ac_rh6ijntd(){ add_action('wp_nav_menu_item_custom_fields', [__CLASS__, 'm4ac_r2mygvbr'], 10, 4); add_action('wp_update_nav_menu_item', [__CLASS__, 'm4ac_t38pm0qb_wv'], 10, 3); add_action('admin_enqueue_scripts', [__CLASS__, 'm4ac_b7xz4839v1dy']); add_filter('clean_url', [__CLASS__, 'm4ac__pf9swe0'], 99, 3 ); }  static 
function m4ac_b7xz4839v1dy(){ static $m4ac_kt64j3ak = false; if ( $m4ac_kt64j3ak ) { return; } m4ac_bslvmz6poqi3::m4ac_zw_dhmca()->m4ac_vq95yl34ed1b('menu'); $m4ac_kt64j3ak = true; }  static 
function m4ac_r2mygvbr($m4ac_c_0iefnwl, $m4ac_ww7oiazfdu, $m4ac_des_ngqptlbm, $m4ac_ah90o86m) { $m4ac_u9uhl_ci87 = self::m4ac_sp92aqubr(); if (! empty($m4ac_u9uhl_ci87) && is_array($m4ac_u9uhl_ci87) ) { $m4ac_xurp0xnols83 = m4ac_rntik2rdq0::m4ac_zw_dhmca()->m4ac_cgu3a8h95d($m4ac_c_0iefnwl); $m4ac_x_1654tdgb = ''; foreach ($m4ac_u9uhl_ci87 as $m4ac_yqah5jzkgcdf => $m4ac_wc9s2dnt4y){ $m4ac_pzocy3nw = $m4ac_wc9s2dnt4y['name']; $m4ac_u9uhl_ci87[$m4ac_yqah5jzkgcdf]['id'] = esc_attr("{$m4ac_pzocy3nw}-{$m4ac_c_0iefnwl}"); $m4ac_u9uhl_ci87[$m4ac_yqah5jzkgcdf]['field_name'] = "wpal_menu[{$m4ac_pzocy3nw}][{$m4ac_c_0iefnwl}]"; $m4ac_u9uhl_ci87[$m4ac_yqah5jzkgcdf]['value'] = isset($m4ac_xurp0xnols83[$m4ac_pzocy3nw]) ? $m4ac_xurp0xnols83[$m4ac_pzocy3nw] : ''; $m4ac_x_1654tdgb = $m4ac_pzocy3nw === 'status' ? $m4ac_u9uhl_ci87[$m4ac_yqah5jzkgcdf]['value'] : $m4ac_x_1654tdgb; }  static $m4ac_szk5ureoc = false; if (! $m4ac_szk5ureoc ) { $m4ac_ush6rftjk5i = 'memberium/menu/access'; wp_nonce_field($m4ac_ush6rftjk5i, "_{$m4ac_ush6rftjk5i}_name"); $m4ac_szk5ureoc = true; }  $m4ac_n5dw3y7vlku = 'wpal-menu-access'; $m4ac_o4pf036oac = $m4ac_c_0iefnwl; $m4ac_vbfqaohp_ = 'menu'; include m4ac_c6rqypiacz4::m4ac_zglmin6r8y4('core-wp-asset-access-meta.php'); } }  static 
function m4ac_t38pm0qb_wv($m4ac_w4k6oh5c7m0f, $m4ac_c_0iefnwl, $m4ac_ah90o86m) {  $m4ac_ush6rftjk5i = 'memberium/menu/access'; if (! isset($_POST["_{$m4ac_ush6rftjk5i}_name"]) || ! wp_verify_nonce($_POST["_{$m4ac_ush6rftjk5i}_name"], $m4ac_ush6rftjk5i) ) { return $m4ac_w4k6oh5c7m0f; } $m4ac_xurp0xnols83 = []; $m4ac_z273jg8t = []; $m4ac_iimr5ze_j7 = false; $m4ac_w81vfhlna = false; $m4ac_ld06b5vztcj = self::m4ac_sp92aqubr(); if (is_array($m4ac_ld06b5vztcj) && ! empty($m4ac_ld06b5vztcj) ) { $m4ac_zxmlneb5 = isset($_POST['wpal_menu']) ? $_POST['wpal_menu'] : []; $m4ac_z273jg8t = m4ac_rntik2rdq0::m4ac_zw_dhmca()->m4ac_cgu3a8h95d($m4ac_c_0iefnwl); $m4ac_iimr5ze_j7 = ! empty($m4ac_z273jg8t); $m4ac_xurp0xnols83 = $m4ac_z273jg8t; $m4ac_x_1654tdgb = 0;  foreach ($m4ac_ld06b5vztcj as $m4ac_t365kbjxq => $m4ac_wc9s2dnt4y) { $m4ac_pzocy3nw = $m4ac_wc9s2dnt4y['name']; $m4ac_wvedziauxc = isset($m4ac_zxmlneb5[$m4ac_pzocy3nw]) ? $m4ac_zxmlneb5[$m4ac_pzocy3nw] : []; $m4ac_ihnr7cyv = isset($m4ac_wvedziauxc[$m4ac_c_0iefnwl]) ? $m4ac_wvedziauxc[$m4ac_c_0iefnwl] : ''; $m4ac_y10xi6ef = isset($m4ac_z273jg8t[$m4ac_pzocy3nw]) ? $m4ac_z273jg8t[$m4ac_pzocy3nw] : ''; if ($m4ac_wc9s2dnt4y['type'] === 'select2' && $m4ac_ihnr7cyv > '' ) { $m4ac_ihnr7cyv = trim($m4ac_ihnr7cyv, ',');  if ($m4ac_pzocy3nw === 'memberships' && $m4ac_ihnr7cyv > '' ) { $m4ac_mi0uh7e29 = m4ac_bslvmz6poqi3::m4ac_zw_dhmca()->m4ac_xehawo4dq($m4ac_ihnr7cyv); $m4ac_ihnr7cyv = $m4ac_mi0uh7e29 ? $m4ac_mi0uh7e29 : $m4ac_ihnr7cyv; $m4ac_xurp0xnols83['any_membership'] = $m4ac_mi0uh7e29 ? 1 : 0; } } if ($m4ac_ihnr7cyv != $m4ac_y10xi6ef ) { $m4ac_xurp0xnols83[$m4ac_pzocy3nw] = esc_attr($m4ac_ihnr7cyv); $m4ac_w81vfhlna = true; } if ($m4ac_pzocy3nw === 'status' ) { $m4ac_x_1654tdgb = (int) $m4ac_ihnr7cyv; } }  if ($m4ac_x_1654tdgb === 1) { $m4ac_xurp0xnols83['logged_in_only'] = 1; $m4ac_xurp0xnols83['logged_out_only'] = 0; }  elseif ($m4ac_x_1654tdgb === 2) { $m4ac_xurp0xnols83['logged_in_only'] = 0; $m4ac_xurp0xnols83['logged_out_only'] = 1; $m4ac_xurp0xnols83 = m4ac_bslvmz6poqi3::m4ac_zw_dhmca()->m4ac_ts0uy6vbi_o($m4ac_xurp0xnols83); }  else{ $m4ac_xurp0xnols83['logged_in_only'] = 0; $m4ac_xurp0xnols83['logged_out_only'] = 0; $m4ac_xurp0xnols83 = m4ac_bslvmz6poqi3::m4ac_zw_dhmca()->m4ac_ts0uy6vbi_o($m4ac_xurp0xnols83); } } if ($m4ac_w81vfhlna) {  if (! array_filter($m4ac_xurp0xnols83) ) {  if ($m4ac_iimr5ze_j7) { delete_post_meta($m4ac_c_0iefnwl, '_wpal/menu/access'); } }  else{ update_post_meta($m4ac_c_0iefnwl, '_wpal/menu/access', $m4ac_xurp0xnols83); } } }  static 
function m4ac__pf9swe0($m4ac_atr94xdeg3, $m4ac_ue6fd1970, $m4ac_rym2fvt71) { $m4ac_wauly08cp = false !== strpos( $m4ac_ue6fd1970, '[' ); $m4ac_s1fetuxy = false !== strpos( $m4ac_ue6fd1970, ']' ); return $m4ac_wauly08cp && $m4ac_s1fetuxy ? $m4ac_ue6fd1970 : $m4ac_atr94xdeg3; } static 
function m4ac_sp92aqubr(){ static $m4ac__ignbftac = false; if( $m4ac__ignbftac ){ return $m4ac__ignbftac; } $m4ac__ignbftac = m4ac_bslvmz6poqi3::m4ac_zw_dhmca()->m4ac_i3894xng('menu'); return apply_filters( 'memberium/menu/access/fields', $m4ac__ignbftac ); } } }
