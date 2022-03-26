<?php
/**
 * Copyright (c) 2017-2021 David J Bullock
 * Web Power and Light
 */

     if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_wpfmq9e7 { static 
function m4ac_j9r3pbfa25() { return [ '_memberium_canc_automation', '_memberium_canc_tag', '_memberium_main_tag', '_memberium_guest_checkout', '_memberium_order_automation', '_memberium_payf_automation', '_memberium_payf_tag', '_memberium_susp_automation', '_memberium_susp_tag', ]; } private 
function m4ac_lnbtgd82ps1($m4ac__khy05gls_) { return; $m4ac_ah90o86m = [ 'fields' => [ 'email' => $m4ac__khy05gls_->get_billing_email, 'first_name' => $m4ac__khy05gls_->get_billing_first_name, 'last_name' => $m4ac__khy05gls_->get_billing_last_name,  ], ]; $contact_id = memberium_app()->m4ac_uj7435zxcb2($m4ac_ah90o86m); return $contact_id; } private 
function m4ac_ymgskbcon1q($m4ac__37l6rhivt2, $m4ac_at_5xofh = 0, $m4ac_h0_p7cxt = '') { if ($m4ac__37l6rhivt2 && $m4ac_at_5xofh && ! empty($m4ac_h0_p7cxt) ) { $m4ac__ndczilub = current_time('mysql'); $m4ac_h0_p7cxt = trim($m4ac_h0_p7cxt); if ($m4ac_at_5xofh) { $m4ac_fheyfujga6 = get_user_by('id', $m4ac_at_5xofh); $m4ac_yyzs0red2534 = $m4ac_fheyfujga6->user_login; $m4ac_wqzj0dt81 = $m4ac_fheyfujga6->user_email; } else { $m4ac_at_5xofh = 0; $m4ac_yyzs0red2534 = 'Memberium'; $m4ac_wqzj0dt81 = ''; } $m4ac_hq05fg9hjnl = [ 'comment_post_ID' => (int) $m4ac__37l6rhivt2, 'comment_author' => $m4ac_yyzs0red2534, 'comment_author_email' => $m4ac_wqzj0dt81, 'comment_author_url' => '', 'comment_content' => $m4ac_h0_p7cxt, 'comment_type' => 'order_note', 'comment_parent' => 0, 'user_id' => $m4ac_at_5xofh, 'comment_author_IP' => '', 'comment_agent' => 'Memberium', 'comment_date' => $m4ac__ndczilub, 'comment_approved' => 1, ]; wp_insert_comment($m4ac_hq05fg9hjnl); } } private 
function m4ac_q3q20hudf5k($m4ac_uo08x_g7, $m4ac_at_5xofh, $m4ac_c2yk16ze3dfl, $m4ac_macz7d15s0k3, $m4ac_vykuqfwdj_0) { if ($m4ac_uo08x_g7 && $m4ac_c2yk16ze3dfl) { $m4ac_teuk8tfrb7l = $this->m4ac_zn9_u0zdv($m4ac_c2yk16ze3dfl); $m4ac_k819oejtbv = ''; $m4ac_n5dw3y7vlku = 'Memberium '; $m4ac_upwqy_51nxj = [ 'active' => '', 'completed' => '', 'refunded' => '', 'cancelled' => '_memberium_canc_automation', 'expired' => '_memberium_canc_automation', 'failed' => '_memberium_payf_automation', 'on-hold' => '_memberium_susp_automation', 'processing' => '_memberium_order_automation', ]; $m4ac_ukqvxo6ne7 = empty($m4ac_upwqy_51nxj[$m4ac_vykuqfwdj_0]) ? 0 : $m4ac_upwqy_51nxj[$m4ac_vykuqfwdj_0]; if (! empty($m4ac_ukqvxo6ne7) ) { $m4ac_t2_mhtranw = empty($m4ac_teuk8tfrb7l[$m4ac_ukqvxo6ne7]) ? 0 : $m4ac_teuk8tfrb7l[$m4ac_ukqvxo6ne7]; if ($m4ac_t2_mhtranw) { memberium_app()->m4ac_lmhdiugb6cs($m4ac_t2_mhtranw, $m4ac_uo08x_g7); $this->m4ac_ymgskbcon1q($m4ac_macz7d15s0k3, $m4ac_at_5xofh, "{$m4ac_n5dw3y7vlku} ran automation {$m4ac_t2_mhtranw}<br>"); } } } } private 
function m4ac_wnf1aswkir9($m4ac_uo08x_g7, $m4ac_at_5xofh, $m4ac_c2yk16ze3dfl, $m4ac_macz7d15s0k3, $m4ac_vykuqfwdj_0) { if ($m4ac_uo08x_g7 && $m4ac_c2yk16ze3dfl) { $m4ac_j0e14tousp_ = $this->m4ac_uia6n28c($m4ac_c2yk16ze3dfl); $m4ac_k819oejtbv = ''; $m4ac_n5dw3y7vlku = 'Memberium '; $m4ac_negkh6tf = [ 'active', 'completed', 'processing' ]; $m4ac_fpb42c89g = [ 'cancelled', 'expired', 'refunded' ]; if (in_array($m4ac_vykuqfwdj_0, $m4ac_negkh6tf) ) { memberium_app()->m4ac_ocsjt69hrb($m4ac_j0e14tousp_['main'], $m4ac_uo08x_g7); memberium_app()->m4ac_ocsjt69hrb(0 - $m4ac_j0e14tousp_['canc'], $m4ac_uo08x_g7); memberium_app()->m4ac_ocsjt69hrb(0 - $m4ac_j0e14tousp_['payf'], $m4ac_uo08x_g7); memberium_app()->m4ac_ocsjt69hrb(0 - $m4ac_j0e14tousp_['susp'], $m4ac_uo08x_g7); if ($m4ac_j0e14tousp_['main']) $m4ac_k819oejtbv .= "{$m4ac_n5dw3y7vlku} added tag {$m4ac_j0e14tousp_['main']}<br>"; if ($m4ac_j0e14tousp_['canc']) $m4ac_k819oejtbv .= "{$m4ac_n5dw3y7vlku} removed tag {$m4ac_j0e14tousp_['canc']}<br>"; if ($m4ac_j0e14tousp_['payf']) $m4ac_k819oejtbv .= "{$m4ac_n5dw3y7vlku} removed tag {$m4ac_j0e14tousp_['payf']}<br>"; if ($m4ac_j0e14tousp_['susp']) $m4ac_k819oejtbv .= "{$m4ac_n5dw3y7vlku} removed tag {$m4ac_j0e14tousp_['susp']}<br>"; } elseif ($m4ac_vykuqfwdj_0 == 'failed') { if ($m4ac_j0e14tousp_['payf']) { memberium_app()->m4ac_ocsjt69hrb($m4ac_j0e14tousp_['payf'], $m4ac_uo08x_g7); $m4ac_k819oejtbv .= "{$m4ac_n5dw3y7vlku} added tag {$m4ac_j0e14tousp_['payf']}<br>"; } } elseif (in_array($m4ac_vykuqfwdj_0, $m4ac_fpb42c89g) ) { if ($m4ac_j0e14tousp_['canc']) { memberium_app()->m4ac_ocsjt69hrb($m4ac_j0e14tousp_['canc'], $m4ac_uo08x_g7); $m4ac_k819oejtbv .= "{$m4ac_n5dw3y7vlku} added tag {$m4ac_j0e14tousp_['canc']}<br>"; } } elseif ($m4ac_vykuqfwdj_0 == 'expired') { if ($m4ac_j0e14tousp_['main']) { memberium_app()->m4ac_ocsjt69hrb(0 - $m4ac_j0e14tousp_['main'], $m4ac_uo08x_g7); $m4ac_k819oejtbv .= "{$m4ac_n5dw3y7vlku} removed tag {$m4ac_j0e14tousp_['main']}<br>"; } } elseif ($m4ac_vykuqfwdj_0 == 'on-hold') { if ($m4ac_j0e14tousp_['susp']) { memberium_app()->m4ac_ocsjt69hrb($m4ac_j0e14tousp_['susp'], $m4ac_uo08x_g7); $m4ac_k819oejtbv .= "{$m4ac_n5dw3y7vlku} added tag {$m4ac_j0e14tousp_['susp']}<br>"; } } } $this->m4ac_ymgskbcon1q($m4ac_macz7d15s0k3, $m4ac_at_5xofh, $m4ac_k819oejtbv); } private 
function m4ac_w_t0xrsy9fm($m4ac_at_5xofh, $m4ac_c2yk16ze3dfl, $m4ac_sde8cbqo0pj) { $m4ac_ah90o86m = [ 'subscriptions_per_page' => -1, 'customer_id' => $m4ac_at_5xofh, 'product_id' => $m4ac_c2yk16ze3dfl, 'subscription_status' => $this->m4ac_negkh6tf, ]; $m4ac_v_p5ktnwq3ol = wcs_get_subscriptions($m4ac_ah90o86m); unset($m4ac_v_p5ktnwq3ol[$m4ac_sde8cbqo0pj]); return (bool) count($m4ac_v_p5ktnwq3ol); }    
function m4ac_wpf7i82a() { return $this->post_keys; } 
function m4ac_uia6n28c($m4ac_c2yk16ze3dfl) { $m4ac_e3ht7j0fxgiq = get_post_meta($m4ac_c2yk16ze3dfl); $m4ac_j0e14tousp_ = []; if (is_array($m4ac_e3ht7j0fxgiq) ) { foreach($this->post_keys as $m4ac_pzocy3nw => $m4ac_ukqvxo6ne7) { $m4ac_j0e14tousp_[$m4ac_pzocy3nw] = empty($m4ac_e3ht7j0fxgiq[$m4ac_ukqvxo6ne7][0]) ? 0 : $m4ac_e3ht7j0fxgiq[$m4ac_ukqvxo6ne7][0]; } } return $m4ac_j0e14tousp_; } 
function m4ac_zn9_u0zdv($m4ac_c2yk16ze3dfl) { $m4ac_e3ht7j0fxgiq = get_post_meta($m4ac_c2yk16ze3dfl); $m4ac_ah4c_sou = $this->m4ac_j9r3pbfa25(); $m4ac_teuk8tfrb7l = []; if (is_array($m4ac_e3ht7j0fxgiq) ) { foreach($m4ac_ah4c_sou as $m4ac_ukqvxo6ne7) { $m4ac_teuk8tfrb7l[$m4ac_ukqvxo6ne7] = empty($m4ac_e3ht7j0fxgiq[$m4ac_ukqvxo6ne7][0]) ? '' : $m4ac_e3ht7j0fxgiq[$m4ac_ukqvxo6ne7][0]; } } return $m4ac_teuk8tfrb7l; }    
function m4ac_bvjm_0xefazu($m4ac_r5mkahou1, $m4ac_xiap6497osxq, $m4ac_r6s75vkfz) { $m4ac_bw1y8jqec30 = $m4ac_r5mkahou1->get_id(); $m4ac_at_5xofh = $m4ac_r5mkahou1->get_user_id(); if (! $m4ac_at_5xofh) { $this->m4ac_ymgskbcon1q($m4ac_bw1y8jqec30, 0, 'Memberium skipped applying tags due to no assigned WordPress user.'); return; } $m4ac_uo08x_g7 = memberium_app()->m4ac_pm63av15g($m4ac_at_5xofh); if (! $m4ac_uo08x_g7) { $this->m4ac_ymgskbcon1q($m4ac_bw1y8jqec30, $m4ac_at_5xofh, 'Memberium skipped applying tags due to no assigned CRM contact.'); return; } $m4ac_xiacz8bpdx = $m4ac_r5mkahou1->get_items(); if (is_array($m4ac_xiacz8bpdx) && ! empty($m4ac_xiacz8bpdx) ) { foreach($m4ac_xiacz8bpdx as $m4ac_m78gbkfpt69x => $m4ac_ww7oiazfdu) { $m4ac_c2yk16ze3dfl = $m4ac_ww7oiazfdu->get_product_id(); if (in_array($m4ac_xiap6497osxq, $this->m4ac_nhre0sp7jtdz) ) { $m4ac_nl28n4xrgd = $this->m4ac_w_t0xrsy9fm($m4ac_at_5xofh, $m4ac_c2yk16ze3dfl, $m4ac_bw1y8jqec30); if ($m4ac_nl28n4xrgd) { $this->m4ac_ymgskbcon1q($m4ac_bw1y8jqec30, $m4ac_at_5xofh, 'Memberium skipped applying deactivation tag due to other active subscriptions.'); break; } } $this->m4ac_wnf1aswkir9($m4ac_uo08x_g7, $m4ac_at_5xofh, $m4ac_c2yk16ze3dfl, $m4ac_bw1y8jqec30, $m4ac_xiap6497osxq); $this->m4ac_q3q20hudf5k($m4ac_uo08x_g7, $m4ac_at_5xofh, $m4ac_c2yk16ze3dfl, $m4ac_bw1y8jqec30, $m4ac_xiap6497osxq); } } } 
function m4ac_qabqz3d1w($m4ac_macz7d15s0k3, $m4ac_r6s75vkfz, $m4ac_xiap6497osxq) { $m4ac__khy05gls_ = wc_get_order($m4ac_macz7d15s0k3); $m4ac_at_5xofh = $m4ac__khy05gls_->get_user_id(); if (! $m4ac_at_5xofh) { return; } $m4ac_uo08x_g7 = memberium_app()->m4ac_pm63av15g($m4ac_at_5xofh); if (! $m4ac_uo08x_g7) { return; } $m4ac_xiacz8bpdx = $m4ac__khy05gls_->get_items(); if (is_array($m4ac_xiacz8bpdx) && ! empty($m4ac_xiacz8bpdx) ) { foreach ($m4ac_xiacz8bpdx as $m4ac_m78gbkfpt69x => $m4ac_ww7oiazfdu) { $m4ac_c2yk16ze3dfl = $m4ac_ww7oiazfdu->get_product_id(); $this->m4ac_wnf1aswkir9($m4ac_uo08x_g7, $m4ac_at_5xofh, $m4ac_c2yk16ze3dfl, $m4ac_macz7d15s0k3, $m4ac_xiap6497osxq); $this->m4ac_q3q20hudf5k($m4ac_uo08x_g7, $m4ac_at_5xofh, $m4ac_c2yk16ze3dfl, $m4ac_macz7d15s0k3, $m4ac_xiap6497osxq); } } memberium_app()->m4ac_c17vlcx3a4(); } 
function m4ac_y7s69l4w($m4ac_bsijd7zrx) { $m4ac_luz795g0 = [ 'billing_first_name' => 'firstname', 'billing_last_name' => 'lastname', 'billing_company' => 'organization', ]; return $m4ac_bsijd7zrx; } 
function m4ac_dy_1i67hbu($m4ac_bsijd7zrx) { $m4ac_bsijd7zrx['memb_add_to_woo_cart'] = ['m4ac_t_v0ya96r', 'm4ac_s7mo2cxfk']; return $m4ac_bsijd7zrx; } 
function m4ac_nt2ejgrmaf($m4ac_at_5xofh) { $m4ac_fheyfujga6 = get_user_by('id', $m4ac_at_5xofh); $m4ac_uo08x_g7 = (int) m4ac_bem2ya5k::m4ac_pm63av15g($m4ac_at_5xofh); if ($m4ac_uo08x_g7) { $m4ac_odf4y8jzrq = false; $m4ac_d78sk4qc3i = $m4ac_fheyfujga6->user_email; $m4ac_qsvd0m6oq = memberium_app()->m4ac_zrj6g8l4ap9i($m4ac_uo08x_g7, false); $m4ac_b0hw9pif_qj = get_user_meta($m4ac_at_5xofh, 'first_name', true); $m4ac_ce5wvyafjo = get_user_meta($m4ac_at_5xofh, 'last_name', true); $m4ac_bxvpge5qkdo9 = [ 'id' => $m4ac_uo08x_g7, 'overwrite' => 0, 'email' => $m4ac_d78sk4qc3i, ]; if ($m4ac_qsvd0m6oq['%FIRSTNAME%'] !== $m4ac_b0hw9pif_qj) { $m4ac_bxvpge5qkdo9['first_name'] = $m4ac_b0hw9pif_qj; $m4ac_odf4y8jzrq = true; } if ($m4ac_qsvd0m6oq['%LASTNAME%'] !== $m4ac_ce5wvyafjo) { $m4ac_bxvpge5qkdo9['last_name'] = $m4ac_ce5wvyafjo; $m4ac_odf4y8jzrq = true; } if ( $m4ac_odf4y8jzrq || $m4ac_d78sk4qc3i <> $m4ac_qsvd0m6oq['%EMAIL%'] ) { $m4ac_bxvpge5qkdo9['email'] = $m4ac_d78sk4qc3i; memberium_app()->m4ac_yiqu4k3xj5()->api('contact/edit', $m4ac_bxvpge5qkdo9); memberium_app()->m4ac_q4exg8ji7w_v($m4ac_uo08x_g7); } } } private 
function m4ac_rh6ijntd() { add_action('woocommerce_order_status_changed', [$this, 'm4ac_qabqz3d1w'], 10, 3); add_action('woocommerce_subscription_status_updated', [$this, 'm4ac_bvjm_0xefazu'], 10, 3); add_action('woocommerce_save_account_details', [$this, 'm4ac_nt2ejgrmaf'], 10, 1); add_filter('memberium/usermeta/crm_field_maps',[$this, 'm4ac_y7s69l4w'], 10, 1); add_filter('memberium/catchers/get',[$this, 'm4ac_dy_1i67hbu'], 10, 1); if (! is_admin() ) { } } private 
function __construct() { $this->m4ac_rh6ijntd(); if (is_admin() ) { include_once __DIR__ . '/admin.php'; m4ac_whx8pyv_s::m4ac_zw_dhmca(); } else { include_once __DIR__ . '/frontend.php'; m4ac_e73kfzga206j::m4ac_zw_dhmca(); } } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; } private static $m4ac_u4tpxcro19 = false; private $m4ac_negkh6tf = [ 'active', 'completed', 'pending-cancel', 'processing', ]; private $m4ac_fpb42c89g = [ 'cancelled', 'expired', 'refunded', ]; private $m4ac_nhre0sp7jtdz = [ 'pending', 'on-hold', ]; public $post_keys = [ 'canc' => '_memberium_canc_tag', 'main' => '_memberium_main_tag', 'payf' => '_memberium_payf_tag', 'susp' => '_memberium_susp_tag', ];  } }
