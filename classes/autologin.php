<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac__1axme3us9g5 { private static $m4ac_hfsur9n_p47 = false; private static $m4ac_zjigl_aw4hbm = 0; private static $m4ac_uo08x_g7 = 0; private static 
function m4ac_f1r5_x03zb() { self::$m4ac_hfsur9n_p47 = empty($_GET['debug']) ? false : true; self::m4ac_b7x_5evn9a('Debug Mode: On'); return self::$m4ac_hfsur9n_p47; } private static 
function m4ac_b7x_5evn9a($m4ac_oemjasi0tp) { if (self::$m4ac_hfsur9n_p47) { echo $m4ac_oemjasi0tp, '<br />'; } } private static 
function m4ac_s65dsbrx0e($m4ac_oemjasi0tp) { m4ac_eghsod68x::m4ac_w3vnwgx7zjf(self::$m4ac_zjigl_aw4hbm, strip_tags($m4ac_oemjasi0tp) ); if (self::$m4ac_hfsur9n_p47) { echo "{$m4ac_oemjasi0tp}<br />"; exit; } wp_set_current_user(0); wp_redirect(get_bloginfo('wpurl'), 302, 'Memberium'); return; } private static 
function m4ac_w8ohueyv() { self::$m4ac_uo08x_g7 = empty($_GET['id']) ? 0 : (int) $_GET['id']; self::m4ac_b7x_5evn9a('Contact ID: ' . self::$m4ac_uo08x_g7); return self::$m4ac_uo08x_g7; } private static 
function m4ac_h2c_faqjod4u() { $m4ac_ah90o86m = [ 'contact_id' => self::$m4ac_uo08x_g7, 'type' => 'autologin', ]; self::$m4ac_zjigl_aw4hbm = m4ac_eghsod68x::m4ac_hozfsg3t($m4ac_ah90o86m, 'Autologin Started'); return self::$m4ac_zjigl_aw4hbm; } private static 
function m4ac__3avoqt4i() { $m4ac_rlxs2myv1 = false; $m4ac_rsgp378wz = memberium_app()->m4ac_x280qrz9kmic('autologin_authkeys'); $m4ac_rsgp378wz = array_filter(explode(',', $m4ac_rsgp378wz) ); if (! empty($m4ac_rsgp378wz) ) { $m4ac_rm8jklr5nq = empty($_GET['memb_autologin']) ? '' : trim($_GET['memb_autologin']); $m4ac_rm8jklr5nq = empty($_GET['auth_key']) ? $m4ac_rm8jklr5nq: trim($_GET['auth_key']); $m4ac_rlxs2myv1 = in_array($m4ac_rm8jklr5nq , $m4ac_yq51omtd); } return $m4ac_rlxs2myv1; } private static 
function m4ac_zrocdgi27x() { $m4ac_rlxs2myv1 = false; $m4ac_rsgp378wz = memberium_app()->m4ac_x280qrz9kmic('autologin_authkeys'); $m4ac_rsgp378wz = array_filter(explode(',', $m4ac_rsgp378wz) ); if (! empty($m4ac_rsgp378wz) ) { $m4ac_rm8jklr5nq = empty($_GET['memb_autologin']) ? '' : trim($_GET['memb_autologin']); $m4ac_rm8jklr5nq = empty($_GET['auth_key']) ? $m4ac_rm8jklr5nq: trim($_GET['auth_key']); $m4ac_rlxs2myv1 = in_array($m4ac_rm8jklr5nq , $m4ac_rsgp378wz); } if (! $m4ac_rlxs2myv1) { $m4ac_c1hb9x8yfrl = "Invalid auth key used: '{$m4ac_rm8jklr5nq}'"; $m4ac_ljd2_k7u1wt = get_bloginfo('wpurl'); self::m4ac_s65dsbrx0e($m4ac_c1hb9x8yfrl); session_write_close(); nocache_headers(); if (! self::$m4ac_hfsur9n_p47) { wp_redirect($m4ac_ljd2_k7u1wt, 302, 'Memberium ' . __FUNCTION__ . '::' . __LINE__); } exit; } } private static 
function m4ac_x4l2sv5rmkih() {  $m4ac_d25y01lp = memberium_app()->m4ac_x280qrz9kmic('thrivecart_secret'); $m4ac_g6y3s487axgf = empty($_GET['thrivecart_hash']) ? '' : trim($_GET['thrivecart_hash']); $m4ac_uum1d5ie_pqh = empty($_GET['thrivecart']) ? '' : $_GET['thrivecart']; $m4ac_xf0crep7h1 = false; if (! empty($m4ac_d25y01lp) ) { if (is_array($m4ac_uum1d5ie_pqh) ) { if(strlen($m4ac_g6y3s487axgf) == 32) { ksort($m4ac_uum1d5ie_pqh); array_walk_recursive($m4ac_uum1d5ie_pqh, function(&$m4ac_yqah5jzkgcdf) { $m4ac_yqah5jzkgcdf = rawurlencode($m4ac_yqah5jzkgcdf); }); $m4ac_owo7ubzl = md5(implode('__', [ $m4ac_d25y01lp, strtoupper(json_encode($m4ac_uum1d5ie_pqh) ) ] ) ); $m4ac_xf0crep7h1 = ($m4ac_g6y3s487axgf == $m4ac_owo7ubzl); } } } if (! $m4ac_xf0crep7h1) { self::m4ac_s65dsbrx0e('Invalid ThriveCart Hash'); } return $m4ac_xf0crep7h1; } private static 
function m4ac_kc3lbfn1xzq9() { $m4ac_j0e14tousp_ = empty($_GET['tag_ids']) ? '' : $_GET['tag_ids']; $m4ac_oemjasi0tp = empty($m4ac_j0e14tousp_) ? 'No login tags defined.' : 'Setting Tag IDs ' . $m4ac_j0e14tousp_; self::m4ac_b7x_5evn9a($m4ac_oemjasi0tp); return $m4ac_j0e14tousp_; } private static 
function m4ac_lwc67x4y2kun() { $m4ac_rld1a_268o = empty($_GET['automation_id']) ? '' : $_GET['automation_id']; $m4ac_oemjasi0tp = empty($m4ac_rld1a_268o) ? 'No login automations defined.' : 'Setting automations IDs ' . $m4ac_rld1a_268o; self::m4ac_b7x_5evn9a($m4ac_oemjasi0tp); return $m4ac_rld1a_268o; } private static 
function m4ac_hcyo2uia() { $m4ac_ljd2_k7u1wt = empty($_GET['redir']) ? '' : $_GET['redir'];  $m4ac_oemjasi0tp = empty($m4ac_ljd2_k7u1wt) ? 'Redirect Not Defined.' : 'Redirect URL set to ' . $m4ac_ljd2_k7u1wt; self::m4ac_b7x_5evn9a($m4ac_oemjasi0tp); return $m4ac_ljd2_k7u1wt; } private static 
function m4ac_ll3smch21o($m4ac_uum1d5ie_pqh) : array { $m4ac_wkmfd7vlj81 = []; $m4ac_wkmfd7vlj81['email'] = empty($m4ac_uum1d5ie_pqh['customer']['email']) ? '' : strtolower(trim(sanitize_email($m4ac_uum1d5ie_pqh['customer']['email']) ) ); if (empty($m4ac_wkmfd7vlj81['email']) ) { $m4ac_oemjasi0tp = 'ThriveCart Autologin missing customer email'; self::m4ac_s65dsbrx0e($m4ac_oemjasi0tp); } else { self::m4ac_b7x_5evn9a('Login email set to ' . $m4ac_wkmfd7vlj81['email']); } $m4ac_wkmfd7vlj81['firstname'] = empty($m4ac_uum1d5ie_pqh['customer']['firstname']) ? '' : trim($m4ac_uum1d5ie_pqh['customer']['firstname']); $m4ac_wkmfd7vlj81['lastname'] = empty($m4ac_uum1d5ie_pqh['customer']['lastname']) ? '' : trim($m4ac_uum1d5ie_pqh['customer']['lastname']); $m4ac_wkmfd7vlj81['contactno'] = empty($m4ac_uum1d5ie_pqh['customer']['contactno']) ? '' : trim($m4ac_uum1d5ie_pqh['customer']['contactno']); $m4ac_wkmfd7vlj81['address'] = empty($m4ac_uum1d5ie_pqh['customer']['address']) ? [] : $m4ac_uum1d5ie_pqh['customer']['address']; $m4ac_wkmfd7vlj81['custom_fields'] = empty($m4ac_uum1d5ie_pqh['customer']['custom_fields']) ? [] : $m4ac_uum1d5ie_pqh['customer']['custom_fields']; return $m4ac_wkmfd7vlj81; } private static 
function m4ac_eamd05vhos($m4ac_uum1d5ie_pqh) : array { $m4ac__khy05gls_ = []; $m4ac__khy05gls_['id'] = empty($m4ac_uum1d5ie_pqh['order_id']) ? 0 : trim($m4ac_uum1d5ie_pqh['order_id']); $m4ac__khy05gls_['total'] = empty($m4ac_uum1d5ie_pqh['order_total']) ? 0 : trim($m4ac_uum1d5ie_pqh['order_id']); $m4ac__khy05gls_['payment_processor'] = empty($m4ac_uum1d5ie_pqh['payment_processor']) ? '' : strtolower(trim($m4ac_uum1d5ie_pqh['payment_processor']) ); $m4ac__khy05gls_['product_id'] = empty($m4ac_uum1d5ie_pqh['product_id']) ? 0 : (int) $m4ac_uum1d5ie_pqh['product_id']; $m4ac__khy05gls_['purchases'] = empty($m4ac_uum1d5ie_pqh['purchases']) ? [] : array_filter($m4ac_uum1d5ie_pqh['purchases']); $m4ac__khy05gls_['items'] = empty($m4ac_uum1d5ie_pqh['order']) ? [] : $m4ac_uum1d5ie_pqh['order']; return $m4ac__khy05gls_; }  private static 
function m4ac_u28fge67xlk($m4ac_wkmfd7vlj81, $m4ac__khy05gls_) : int { $m4ac_cc39jsy5 = ''; $m4ac_uo08x_g7 = 0; $m4ac_d78sk4qc3i = $m4ac_wkmfd7vlj81['email']; $m4ac_macz7d15s0k3 = $m4ac__khy05gls_['order_id']; $m4ac_hix162sdofjr = memberium_app()->m4ac_x280qrz9kmic('password_field'); $m4ac_ah90o86m = []; $m4ac_ah90o86m['fields']['%EMAIL%'] = $m4ac_wkmfd7vlj81['email']; $m4ac_ah90o86m['fields']['%FIRSTNAME%'] = $m4ac_wkmfd7vlj81['firstname']; if (! empty($m4ac_wkmfd7vlj81['lastname'])) { $m4ac_ah90o86m['fields']['%LASTNAME%'] = $m4ac_wkmfd7vlj81['lastname']; } if (! empty($m4ac_wkmfd7vlj81['lastname'])) { $m4ac_ah90o86m['fields']['%LASTNAME%'] = $m4ac_wkmfd7vlj81['lastname']; } if (! empty($m4ac_wkmfd7vlj81['contactno'])) { $m4ac_ah90o86m['fields']['%PHONE%'] = $m4ac_wkmfd7vlj81['contactno']; } if (! empty($m4ac_wkmfd7vlj81['custom_fields']['password']) ) { $m4ac_ah90o86m['fields'][$m4ac_hix162sdofjr] = $m4ac_tx367pnma0c['customer']['custom_fields']['password']; } if (! empty($m4ac_ah90o86m) ) { self::$m4ac_uo08x_g7 = memberium_app()->m4ac_uj7435zxcb2($m4ac_ah90o86m); if (self::$m4ac_uo08x_g7) { memberium_app()->m4ac_q4exg8ji7w_v(self::$m4ac_uo08x_g7, false, true); $m4ac_at_5xofh = memberium_app()->m4ac_e538xo4yks(self::$m4ac_uo08x_g7); if ($m4ac_at_5xofh) { $m4ac_go2gtisry = 'thrivecart_order_' . $m4ac_macz7d15s0k3; add_user_meta($m4ac_at_5xofh, $m4ac_go2gtisry, $m4ac_tx367pnma0c, true); } else { self::m4ac_s65dsbrx0e('No matching User ID'); } } else { self::m4ac_s65dsbrx0e('No matching Contact ID'); } } return self::$m4ac_uo08x_g7; } private static 
function m4ac_ub73kf2m(string $m4ac_d78sk4qc3i) { $m4ac_cqct7xz1idv5 = false; $m4ac_wmfjkvhsd = 0; $m4ac_g67fyd3rvsjg = 30; $m4ac_hnbgmzvu_pcw = 500000; while ($m4ac_wmfjkvhsd <= $m4ac_g67fyd3rvsjg && $m4ac_cqct7xz1idv5 === false) { $m4ac_cqct7xz1idv5 = get_user_by('email', $m4ac_d78sk4qc3i); if ($m4ac_cqct7xz1idv5) { break; } $m4ac_wmfjkvhsd++; usleep($m4ac_hnbgmzvu_pcw); } if (! $m4ac_cqct7xz1idv5) { $m4ac_cc39jsy5 = "Local WordPress user not found."; self::m4ac_s65dsbrx0e($m4ac_cc39jsy5); } return $m4ac_cqct7xz1idv5; } private static 
function m4ac_gnvbpz_43u($m4ac_uo08x_g7 = 0, $m4ac_ljd2_k7u1wt = '') {  if ($m4ac_uo08x_g7) { if (function_exists('is_user_logged_in') && is_user_logged_in() ) { $m4ac_wojn61md = empty($_SESSION['memb_user']['crm_id']) ? 0 : $_SESSION['memb_user']['crm_id']; if ($m4ac_wojn61md === $m4ac_uo08x_g7) { $m4ac_oemjasi0tp = 'Member already logged in.'; m4ac_eghsod68x::m4ac_w3vnwgx7zjf(self::$m4ac_zjigl_aw4hbm, $m4ac_oemjasi0tp); session_write_close(); nocache_headers(); if (! self::$m4ac_hfsur9n_p47) { wp_redirect($m4ac_ljd2_k7u1wt, 302, 'Autologin while already logged in'); } self::m4ac_b7x_5evn9a($m4ac_oemjasi0tp); exit; } } } } private static 
function m4ac_osfh9qcr82wx($m4ac_uo08x_g7) { $m4ac_rmusx52i6pq = memberium_app()->m4ac_x280qrz9kmic('disable_login_sync');  if (! $m4ac_rmusx52i6pq) { $m4ac_fic2e07vfkz = memberium_app()->m4ac_q4exg8ji7w_v($m4ac_uo08x_g7); $m4ac_oemjasi0tp = $m4ac_fic2e07vfkz ? 'succeeded' : 'failed'; self::m4ac_b7x_5evn9a(__LINE__ . ': Contact Sync for ' . $m4ac_uo08x_g7 . " {$m4ac_oemjasi0tp}."); } } private static 
function m4ac_lame1f4b(int $m4ac_uo08x_g7) { $m4ac_fic2e07vfkz = memberium_app()->m4ac_q4exg8ji7w_v($m4ac_uo08x_g7); $m4ac_oemjasi0tp = $m4ac_fic2e07vfkz ? 'succeeded' : 'failed'; self::m4ac_b7x_5evn9a(__LINE__ . ': Contact Sync for ' . $m4ac_uo08x_g7 . ' succeeded.'); } private static 
function m4ac_xtc1rnz8($m4ac_fheyfujga6) { $m4ac_ly5rsbl18cj = false;  if (is_a($m4ac_fheyfujga6, 'WP_User')) { $m4ac_vmkua7q3d2vx = [ 'activate_plugins', 'author', 'contributor', 'delete_others_pages', 'delete_posts', 'editor', 'manage_network', 'manage_options', 'update_core', ]; foreach($m4ac_vmkua7q3d2vx as $m4ac_hnk4x8m7stjz) { if (user_can($m4ac_fheyfujga6, $m4ac_hnk4x8m7stjz) ) { $m4ac_ly5rsbl18cj = true; break; } } if ($m4ac_ly5rsbl18cj) { $m4ac_oemjasi0tp = 'Auto-Login attempt by non-subscriber.  Ending.'; self::m4ac_s65dsbrx0e($m4ac_oemjasi0tp); } self::m4ac_b7x_5evn9a('User capabilities check passed'); } return $m4ac_ly5rsbl18cj; } private static 
function m4ac__rs5ilmg($m4ac_fheyfujga6) { if (is_a($m4ac_fheyfujga6, 'WP_Error') ) { $m4ac_oemjasi0tp = $m4ac_fheyfujga6->get_error_message(); self::m4ac_s65dsbrx0e($m4ac_oemjasi0tp); } } private static 
function m4ac_wqou9kn56bz3() { global $wp_rewrite; if (empty($wp_rewrite) ) { $wp_rewrite = new WP_Rewrite(); } } private static 
function m4ac_mkqyg41d($m4ac_ljd2_k7u1wt = '', $m4ac__crsbi5yuze = []) { if (empty($m4ac_ljd2_k7u1wt)) { $m4ac_ljd2_k7u1wt = empty($m4ac__crsbi5yuze['memb_user']['dashboard_id']) ? $m4ac_ljd2_k7u1wt : get_permalink($m4ac__crsbi5yuze['memb_user']['dashboard_id']); $m4ac_ljd2_k7u1wt = empty($m4ac_ljd2_k7u1wt) ? get_bloginfo('wpurl') : $m4ac_ljd2_k7u1wt; } self::m4ac_b7x_5evn9a('Redirect set to ' . $m4ac_ljd2_k7u1wt); return $m4ac_ljd2_k7u1wt; } private static 
function m4ac_hr8mqtsh(array $m4ac_n32grmxfnb) { $m4ac_ljd2_k7u1wt = empty($m4ac_n32grmxfnb['redir']) ? get_bloginfo('wpurl') : $m4ac_n32grmxfnb['redir']; $m4ac_bxvpge5qkdo9 = self::m4ac_mli4nq8c95ks($m4ac_n32grmxfnb); $m4ac_h4g2ak7sheq = apply_filters('memberium/autologin/redirect/parameters', $m4ac_bxvpge5qkdo9, $m4ac_n32grmxfnb); foreach($m4ac_h4g2ak7sheq as $m4ac_ukqvxo6ne7 => $m4ac_ihnr7cyv) { $m4ac_h4g2ak7sheq[$m4ac_ukqvxo6ne7] = rawurlencode($m4ac_ihnr7cyv); } $m4ac_ljd2_k7u1wt = add_query_arg($m4ac_h4g2ak7sheq, $m4ac_ljd2_k7u1wt); self::m4ac_b7x_5evn9a('Redirect: ' . $m4ac_ljd2_k7u1wt); return $m4ac_ljd2_k7u1wt; } private static 
function m4ac_dantcxh4ufs() { $m4ac_d78sk4qc3i = empty($_GET['email']) ? '' : strtolower(trim(sanitize_email($_GET['email']) ) ); if (empty($m4ac_d78sk4qc3i)) { self::m4ac_s65dsbrx0e('Email Address Missing'); } self::m4ac_b7x_5evn9a('Email: ' . $m4ac_d78sk4qc3i); return $m4ac_d78sk4qc3i; }  private static 
function m4ac_xgjkufw7_23(string $m4ac_d78sk4qc3i) { $m4ac_fheyfujga6 = get_user_by('email', $m4ac_d78sk4qc3i); if (! $m4ac_fheyfujga6) { self::m4ac_s65dsbrx0e('Known Login Check Failed - User not found.'); } else { self::m4ac_b7x_5evn9a('Retrieved user by email address, #' . $m4ac_fheyfujga6->ID); } return $m4ac_fheyfujga6; } private static 
function m4ac_hupw51_no7(string $m4ac_d78sk4qc3i, int $m4ac_uo08x_g7) { $m4ac_fic2e07vfkz = false; $m4ac_fheyfujga6 = get_user_by('email', $m4ac_d78sk4qc3i); if ($m4ac_fheyfujga6) { $m4ac_at_5xofh = m4ac_bem2ya5k::m4ac_y4vi6m8f1qhj($m4ac_uo08x_g7); if ($m4ac_at_5xofh == $m4ac_fheyfujga6->ID) { $m4ac_fic2e07vfkz = true; } } if (! $m4ac_fic2e07vfkz) { self::m4ac_s65dsbrx0e('Contact ID and Email do not match account information.'); } else { self::m4ac_b7x_5evn9a('Contact ID and Email Matched'); } return $m4ac_fic2e07vfkz; } private static 
function m4ac_mli4nq8c95ks(array $m4ac_n32grmxfnb = []) { $m4ac_ah4c_sou = [ 'utm_campaign', 'utm_content', 'utm_medium', 'utm_source', 'utm_term', ]; $m4ac_bxvpge5qkdo9 = []; foreach($m4ac_ah4c_sou as $m4ac_ukqvxo6ne7) { if (isset($m4ac_n32grmxfnb[$m4ac_ukqvxo6ne7])) { $m4ac_bxvpge5qkdo9[$m4ac_ukqvxo6ne7] = $m4ac_n32grmxfnb[$m4ac_ukqvxo6ne7]; } } return $m4ac_bxvpge5qkdo9; }  static 
function m4ac_b2isx_k6z7p() { if (! m4ac_tl5skz6cfptr::m4ac_e28auldn() ) { return; } $m4ac_hfsur9n_p47 = self::m4ac_f1r5_x03zb(); $m4ac_uo08x_g7 = self::m4ac_w8ohueyv(); self::m4ac_h2c_faqjod4u(); m4ac_eghsod68x::m4ac_w3vnwgx7zjf(self::$m4ac_zjigl_aw4hbm, 'Parameters ' . $_SERVER['REQUEST_URI']); $m4ac_cqct7xz1idv5 = false; $m4ac_uum1d5ie_pqh = empty($_GET['thrivecart']) ? [] : $_GET['thrivecart']; $m4ac_wrbqyskjm59o = self::m4ac_x4l2sv5rmkih();  $m4ac_ljd2_k7u1wt = self::m4ac_hcyo2uia(); $m4ac_vwur90xpqe = self::m4ac_kc3lbfn1xzq9(); $m4ac_wkmfd7vlj81 = self::m4ac_ll3smch21o($m4ac_uum1d5ie_pqh); $m4ac__khy05gls_ = self::m4ac_eamd05vhos($m4ac_uum1d5ie_pqh); $m4ac_uo08x_g7 = self::m4ac_u28fge67xlk($m4ac_wkmfd7vlj81, $m4ac__khy05gls_);  m4ac_eghsod68x::m4ac_g3aom_rv8(self::$m4ac_zjigl_aw4hbm, $m4ac_uo08x_g7); $m4ac_cqct7xz1idv5 = self::m4ac_ub73kf2m($m4ac_wkmfd7vlj81['email']); $m4ac_at_5xofh = $m4ac_cqct7xz1idv5->ID; $m4ac__crsbi5yuze = memberium_app()->m4ac_c17vlcx3a4($m4ac_at_5xofh); $m4ac_ljd2_k7u1wt = self::m4ac_mkqyg41d($m4ac_ljd2_k7u1wt, $m4ac__crsbi5yuze); self::m4ac_gnvbpz_43u($m4ac_uo08x_g7, $m4ac_ljd2_k7u1wt); self::m4ac_lame1f4b($m4ac_uo08x_g7); self::m4ac_b7x_5evn9a('Adding Tags ' . $m4ac_vwur90xpqe); memberium_app()->m4ac_ocsjt69hrb($m4ac_vwur90xpqe, $m4ac_uo08x_g7); memberium_app()->m4ac_e538xo4yks($m4ac_uo08x_g7); self::m4ac_xtc1rnz8($m4ac_cqct7xz1idv5); $m4ac_qsvd0m6oq = memberium_app()->m4ac_zrj6g8l4ap9i($m4ac_uo08x_g7); $m4ac_cqct7xz1idv5 = apply_filters('authenticate', $m4ac_cqct7xz1idv5, $m4ac_cqct7xz1idv5->user_login, ''); $m4ac_cqct7xz1idv5 = apply_filters('wp_authenticate_user', $m4ac_cqct7xz1idv5, ''); self::m4ac__rs5ilmg($m4ac_fheyfujga6); self::m4ac_wqou9kn56bz3(); memberium_app()->doing_autologin = true; memberium_app()->m4ac_fuen6oxg('do_autologin'); wp_set_auth_cookie($m4ac_at_5xofh); wp_set_current_user($m4ac_at_5xofh); m4ac_d4yt1zjli::m4ac_f8glwn2bd($m4ac_wkmfd7vlj81['email'], false); do_action('wp_login', $m4ac_wkmfd7vlj81['email'], $m4ac_fheyfujga6); memberium_app()->m4ac_u1avl_bn()->m4ac_xsbh_l1x(); session_write_close(); nocache_headers(); self::m4ac_b7x_5evn9a('Redirecting to ' . $m4ac_ljd2_k7u1wt); if (! self::$m4ac_hfsur9n_p47) { wp_redirect($m4ac_ljd2_k7u1wt, 302, 'Memberium ' . __FUNCTION__ . '::' . __LINE__); } exit; } static 
function m4ac_yomt_qfhbwjv() { global $wpdb; if (! m4ac_tl5skz6cfptr::m4ac_e28auldn() ) { return; } $m4ac_hfsur9n_p47 = self::m4ac_f1r5_x03zb(); $m4ac_uo08x_g7 = self::m4ac_w8ohueyv(); self::m4ac_b7x_5evn9a('Parameters: ' . $_SERVER['REQUEST_URI']); self::m4ac_h2c_faqjod4u(); m4ac_eghsod68x::m4ac_w3vnwgx7zjf(self::$m4ac_zjigl_aw4hbm, 'Parameters: ' . $_SERVER['REQUEST_URI']); self::m4ac_zrocdgi27x(); $m4ac_d78sk4qc3i = self::m4ac_dantcxh4ufs(); $m4ac_ljd2_k7u1wt = self::m4ac_hcyo2uia(); $m4ac_vwur90xpqe = self::m4ac_kc3lbfn1xzq9(); $m4ac_enc0v8u7g = self::m4ac_lwc67x4y2kun(); $m4ac_sli4_ovwsdr = self::m4ac_hupw51_no7($m4ac_d78sk4qc3i, $m4ac_uo08x_g7); $m4ac_fheyfujga6 = self::m4ac_xgjkufw7_23($m4ac_d78sk4qc3i);  $m4ac_fheyfujga6 = apply_filters('authenticate', $m4ac_fheyfujga6, '', ''); self::m4ac__rs5ilmg($m4ac_fheyfujga6); self::m4ac_xtc1rnz8($m4ac_fheyfujga6); if (! empty($m4ac_vwur90xpqe) ) { self::m4ac_b7x_5evn9a('Adding Tags ' . $m4ac_vwur90xpqe); memberium_app()->m4ac_ocsjt69hrb($m4ac_vwur90xpqe, $m4ac_uo08x_g7); } if (! empty($m4ac_enc0v8u7g) ) { self::m4ac_b7x_5evn9a('Running Automations ' . $m4ac_enc0v8u7g); memberium_app()->m4ac_lmhdiugb6cs($m4ac_enc0v8u7g, $m4ac_uo08x_g7); } $m4ac_at_5xofh = $m4ac_fheyfujga6->ID; $m4ac__crsbi5yuze = memberium_app()->m4ac_c17vlcx3a4($m4ac_at_5xofh); $m4ac_ljd2_k7u1wt = self::m4ac_mkqyg41d($m4ac_ljd2_k7u1wt, $m4ac__crsbi5yuze); self::m4ac_gnvbpz_43u($m4ac_uo08x_g7, $m4ac_ljd2_k7u1wt); self::m4ac_osfh9qcr82wx($m4ac_uo08x_g7); self::m4ac_wqou9kn56bz3(); memberium_app()->m4ac_e538xo4yks($m4ac_uo08x_g7); memberium_app()->doing_autologin = true; memberium_app()->m4ac_fuen6oxg('do_autologin'); wp_set_auth_cookie($m4ac_at_5xofh); wp_set_current_user($m4ac_at_5xofh); m4ac_d4yt1zjli::m4ac_f8glwn2bd($m4ac_d78sk4qc3i, false); do_action('wp_login', $m4ac_d78sk4qc3i, $m4ac_fheyfujga6); self::m4ac_b7x_5evn9a('SUCCESS:  Redirecting to ' . $m4ac_ljd2_k7u1wt); session_write_close(); nocache_headers(); if (! self::$m4ac_hfsur9n_p47) { wp_redirect($m4ac_ljd2_k7u1wt, 302, 'Memberium ' . __FUNCTION__ . '::' . __LINE__); } exit; }  } }