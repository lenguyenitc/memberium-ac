<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (defined('MEMBERIUM_HOME') ) { final 
class m4ac_yyac92bkugv1 { const PRODUCTION_UPDATE_URL = 'https://licenseserver.webpowerandlight.com/memberium-ac/current-version.php'; const DEV_UPDATE_URL = 'https://licenseserver.webpowerandlight.com/memberium-ac/current-version.php'; private 
function __construct() {} static 
function m4ac_ep2e5oq06y() { $m4ac_upwqy_51nxj = [ 'local' => self::DEV_UPDATE_URL, 'development' => self::DEV_UPDATE_URL, 'staging' => self::PRODUCTION_UPDATE_URL, 'production' => self::PRODUCTION_UPDATE_URL, ]; $m4ac_ccn07vmlhdg = wp_get_environment_type();  $m4ac_atr94xdeg3 = isset($m4ac_upwqy_51nxj[$m4ac_ccn07vmlhdg]) ? $m4ac_upwqy_51nxj[$m4ac_ccn07vmlhdg] : PRODUCTION_UPDATE_URL; $m4ac_cwimbugn = memberium_app()->m4ac_lx4jv6fi7k(); $m4ac_e0z43gx7e = get_bloginfo('admin_email'); $m4ac_us5k0l_jb = m4ac_tl5skz6cfptr::m4ac_gd1pbm4e(); $m4ac_o3kw2_4u1y = phpversion(); $m4ac_xqrupw5i = parse_url(get_bloginfo('url'), PHP_URL_HOST); $m4ac_n145ehr20k6_ = memberium_app()->m4ac_cbc5pz_ng4(); $m4ac_yvyosepl6 = [ 'admin' => rawurlencode($m4ac_e0z43gx7e), 'domain' => rawurlencode($m4ac_xqrupw5i), 'env' => rawurlencode($m4ac_ccn07vmlhdg), 'm4ac' => rawurlencode($m4ac_cwimbugn), 'php' => rawurlencode($m4ac_o3kw2_4u1y), 'users' => rawurlencode($m4ac_us5k0l_jb), 'wp' => rawurlencode($m4ac_n145ehr20k6_), ]; $m4ac_atr94xdeg3 = add_query_arg($m4ac_yvyosepl6, $m4ac_atr94xdeg3); return $m4ac_atr94xdeg3; } static 
function m4ac_mqd89s72u($m4ac_fic2e07vfkz, $m4ac_lp50ub_1, $m4ac_ah90o86m) { if (isset($m4ac_lp50ub_1->slug) ) { $m4ac_zvs_mh260f = memberium_app()->m4ac_jptd7w_v(); $m4ac_fic2e07vfkz = $m4ac_lp50ub_1->slug == $m4ac_zvs_mh260f; } return $m4ac_fic2e07vfkz; } static 
function m4ac_t0s4oq3c($m4ac_k8lsvk2rig09, $m4ac_ah90o86m, $m4ac_lp50ub_1) { if (isset($m4ac_k8lsvk2rig09->plugins) ) { $m4ac_cwimbugn = memberium_app()->m4ac_lx4jv6fi7k(); foreach ($m4ac_k8lsvk2rig09->plugins as $m4ac_ukqvxo6ne7 => $m4ac_b54e9qp61xcg) { if (isset($m4ac_b54e9qp61xcg->slug) && $m4ac_b54e9qp61xcg->slug == memberium_app()->m4ac_jptd7w_v() ) { $m4ac_atr94xdeg3 = self::m4ac_ep2e5oq06y() . '?version=' . urlencode($m4ac_cwimbugn); $m4ac_md7c8zsu2o = wp_remote_get($m4ac_atr94xdeg3); if ( is_array($m4ac_md7c8zsu2o) && ! is_wp_error($m4ac_md7c8zsu2o) ) { $m4ac_md7c8zsu2o = $m4ac_md7c8zsu2o['body']; $m4ac_md7c8zsu2o = unserialize($m4ac_md7c8zsu2o); $m4ac_k8lsvk2rig09->plugins->$m4ac_ukqvxo6ne7 = $m4ac_md7c8zsu2o; } } } } else { if ($m4ac_ah90o86m == 'plugin_information') { if (isset($_GET['plugin']) && $_GET['plugin'] == memberium_app()->m4ac_jptd7w_v() ) { $m4ac_atr94xdeg3 = self::m4ac_ep2e5oq06y() . '?version=' . urlencode(memberium_app()->m4ac_lx4jv6fi7k() ); $m4ac_md7c8zsu2o = wp_remote_get($m4ac_atr94xdeg3); if ( is_array($m4ac_md7c8zsu2o) && ! is_wp_error($m4ac_md7c8zsu2o) ) { $m4ac_md7c8zsu2o = $m4ac_md7c8zsu2o['body']; $m4ac_md7c8zsu2o = unserialize($m4ac_md7c8zsu2o); $m4ac_k8lsvk2rig09 = $m4ac_md7c8zsu2o; } } } } return $m4ac_k8lsvk2rig09; } static 
function m4ac_qk8qsf0e($m4ac_dch0om3rlkw) { static $m4ac_k8lsvk2rig09 = null; $m4ac_z5vuegw1z7 = memberium_app()->m4ac_lx4jv6fi7k(); if (is_null($m4ac_k8lsvk2rig09) ) { $m4ac_atr94xdeg3 = self::m4ac_ep2e5oq06y(); $m4ac_fmp1cur9 = wp_remote_get($m4ac_atr94xdeg3); if (is_array($m4ac_fmp1cur9) && ! is_wp_error($m4ac_fmp1cur9) & isset($m4ac_fmp1cur9['body'])) { $m4ac_fmp1cur9 = unserialize($m4ac_fmp1cur9['body']); if (! empty($m4ac_fmp1cur9)) { $m4ac_k8lsvk2rig09 = $m4ac_fmp1cur9; } } } $m4ac_jkd8huxq_3bg = isset($m4ac_k8lsvk2rig09->version) ? $m4ac_k8lsvk2rig09->version : $m4ac_z5vuegw1z7; $m4ac_zvs_mh260f = memberium_app()->m4ac_jptd7w_v(); $m4ac_jtf3bjyul2d = new stdClass; $m4ac_jtf3bjyul2d->id = 'webpowerandlight.com/plugins/memberium-ac'; $m4ac_jtf3bjyul2d->slug = $m4ac_zvs_mh260f; $m4ac_jtf3bjyul2d->plugin = 'memberium-ac/memberium-ac.php'; $m4ac_jtf3bjyul2d->new_version = $m4ac_jkd8huxq_3bg; $m4ac_jtf3bjyul2d->url = $m4ac_k8lsvk2rig09->homepage; $m4ac_jtf3bjyul2d->package = $m4ac_k8lsvk2rig09->download_link; $m4ac_jtf3bjyul2d->upgrade_notice = $m4ac_k8lsvk2rig09->upgrade_notice; $m4ac_jtf3bjyul2d->tested = $m4ac_k8lsvk2rig09->tested; $m4ac_jtf3bjyul2d->icons = $m4ac_k8lsvk2rig09->icons; $m4ac_jtf3bjyul2d->banners = $m4ac_k8lsvk2rig09->banners; $m4ac_jtf3bjyul2d->requires_php = $m4ac_k8lsvk2rig09->requires_php; $m4ac_jtf3bjyul2d->compatibility = $m4ac_k8lsvk2rig09->compatibility; if (version_compare($m4ac_jkd8huxq_3bg, $m4ac_z5vuegw1z7, 'gt') ) { $m4ac_dch0om3rlkw->response[$m4ac_jtf3bjyul2d->plugin] = $m4ac_jtf3bjyul2d; } else { unset($m4ac_dch0om3rlkw->response[$m4ac_jtf3bjyul2d->plugin]); } $m4ac_dch0om3rlkw->no_update[$m4ac_jtf3bjyul2d->plugin] = $m4ac_jtf3bjyul2d; return $m4ac_dch0om3rlkw; } static 
function m4ac_indi4kxuy2o3($m4ac_q3_aoy0q1d8 = false) { if (! $m4ac_q3_aoy0q1d8) { $m4ac_ylg0zfd6s2yq = time() - get_option('memberium/updater/timestamp', 0); if ($m4ac_ylg0zfd6s2yq > 0 && $m4ac_ylg0zfd6s2yq < 3600) { return; } } $m4ac_hifor0qksy7g = memberium_app()->m4ac_lx4jv6fi7k(); $m4ac_rdinw1pt60 = self::m4ac_ep2e5oq06y(); $m4ac__hv0tqegpf_5 = [ 'timeout' => 5, ]; $m4ac_fmp1cur9 = wp_remote_get($m4ac_rdinw1pt60, $m4ac__hv0tqegpf_5); if (! is_a($m4ac_fmp1cur9, 'WP_Error') && isset($m4ac_fmp1cur9['body'])) { $m4ac_v6huwgdqte = unserialize($m4ac_fmp1cur9['body']); if (isset($m4ac_v6huwgdqte->version) ) { update_option('memberium/updater/data', $m4ac_v6huwgdqte, false); update_option('memberium/updater/version', $m4ac_v6huwgdqte->version, false); update_option('memberium/updater/timestamp', time(), false); } else { error_log('Memberium:  Plugin update check failed.  Cannot fetch current version information.  Please contact support@memberium.com'); } } } static 
function m4ac_kl49ijo2x() { $m4ac_sn3z2l5qgc = false; $m4ac_sn3z2l5qgc = $m4ac_sn3z2l5qgc || (defined('MEMBERIUM_DISABLE_AUTOUPDATE') && MEMBERIUM_DISABLE_AUTOUPDATE); $m4ac_sn3z2l5qgc = $m4ac_sn3z2l5qgc || is_link(MEMBERIUM_HOME_DIR); $m4ac_sn3z2l5qgc = $m4ac_sn3z2l5qgc || strpos(MEMBERIUM_HOME_DIR, WP_PLUGIN_DIR) === false; $m4ac_sn3z2l5qgc = $m4ac_sn3z2l5qgc || is_writable(MEMBERIUM_HOME); return ! $m4ac_sn3z2l5qgc; } static 
function m4ac_q2smonpdve() { $m4ac_z5vuegw1z7 = strtolower(trim(memberium_app()->m4ac_lx4jv6fi7k() ) ); $m4ac__vb40dhp7xtk = (bool) memberium_app()->m4ac_x280qrz9kmic('autoupdate'); $m4ac__vb40dhp7xtk = $m4ac__vb40dhp7xtk || ! empty(strstr($m4ac_z5vuegw1z7, 'dev') ); $m4ac__vb40dhp7xtk = $m4ac__vb40dhp7xtk || ! empty(strstr($m4ac_z5vuegw1z7, 'alpha') ); $m4ac__vb40dhp7xtk = $m4ac__vb40dhp7xtk || ! empty(strstr($m4ac_z5vuegw1z7, 'beta') ); $m4ac__vb40dhp7xtk = $m4ac__vb40dhp7xtk || ! empty(strstr($m4ac_z5vuegw1z7, 'rc') ); $m4ac__vb40dhp7xtk = $m4ac__vb40dhp7xtk || ! empty(strstr($m4ac_z5vuegw1z7, 'pl') ); $m4ac__vb40dhp7xtk = $m4ac__vb40dhp7xtk || ! m4ac_tl5skz6cfptr::m4ac_e28auldn(); $m4ac__vb40dhp7xtk = $m4ac__vb40dhp7xtk && is_writable(MEMBERIUM_HOME); if (! $m4ac__vb40dhp7xtk) { return; } $m4ac_atr94xdeg3 = self::m4ac_ep2e5oq06y(); $m4ac_ww61hmlri3p_ = false; $m4ac_md7c8zsu2o = wp_remote_get($m4ac_atr94xdeg3); if (! is_array($m4ac_md7c8zsu2o) || is_wp_error($m4ac_md7c8zsu2o)) { return; } $m4ac_k8lsvk2rig09 = unserialize($m4ac_md7c8zsu2o['body']); $m4ac_z_7fobmq4d = $m4ac_k8lsvk2rig09->version; $m4ac_hkc3hm7bns = $m4ac_z5vuegw1z7; if (version_compare($m4ac_z_7fobmq4d, $m4ac_z5vuegw1z7, 'gt') ) { ignore_user_abort();  require_once ABSPATH .'/wp-admin/includes/file.php'; $m4ac_k_zw28kdjm = WP_PLUGIN_DIR; $m4ac__c8tulodk = download_url($m4ac_k8lsvk2rig09->download_link, 300);   if (file_exists($m4ac__c8tulodk) ) {   file_put_contents(ABSPATH . '.maintenance', '<?php $upgrading = time();'); require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-base.php'; require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-direct.php'; WP_Filesystem(); $m4ac_v2ghmxn0afu7 = new wp_filesystem_direct(null); $m4ac_evbp5d7l = MEMBERIUM_HOME_DIR; $m4ac_v2ghmxn0afu7->delete($m4ac_evbp5d7l, true); unzip_file($m4ac__c8tulodk, $m4ac_k_zw28kdjm); unlink($m4ac__c8tulodk); if (function_exists('opcache_reset') ) { @opcache_reset(); } if (file_exists(ABSPATH . '.maintenance') ) { unlink(ABSPATH . '.maintenance'); } $m4ac_ww61hmlri3p_ = true; } } return $m4ac_ww61hmlri3p_; } static 
function m4ac_jp13clzd() : string { self::m4ac_indi4kxuy2o3(); return get_option('memberium/updater/version', 0); }  } }