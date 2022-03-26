<?php
/**
 * Copyright (c) 2020 David J Bullock
 * Web Power and Light
 */

 if (! defined('ABSPATH') ) { die(); }  
class m4ac_ddez7vox0p { const VERSION = '1.0.1'; const META_SLUG = '_wpal/taxonomy/access'; const NONCE = 'wpal/taxonomy/access';  
function m4ac_w07mrqh2sxlp($m4ac_b7_c3kyi) { $m4ac_wdl2r3x6jg = [ 'prefix' => 'wpal', 'settings_title' => __('Taxonomy Access'), 'access_level_name' => __('Access Level'), 'key_name' => __('Key(s)'), 'ids_removed_text' => __('Notice : The following ID(s) have been removed'), ]; $m4ac_ah90o86m = wp_parse_args($m4ac_b7_c3kyi, $m4ac_wdl2r3x6jg);  foreach ($m4ac_ah90o86m as $m4ac_pzocy3nw => $m4ac_ihnr7cyv) { if ( array_key_exists($m4ac_pzocy3nw, $m4ac_wdl2r3x6jg) ){ $m4ac_gmn6r1csd04h = 'WPAL_TAX_' . strtoupper($m4ac_pzocy3nw); if ( ! defined($m4ac_gmn6r1csd04h) ){ define($m4ac_gmn6r1csd04h,$m4ac_ihnr7cyv); } } }  $this->m4ac_gry2qhnc(); }  
function m4ac_gry2qhnc() { if (is_admin() && ! wp_doing_ajax() ) {  add_action('load-term.php', [$this, 'm4ac_rn2eg1tu_'], 1);  $m4ac_ush6rftjk5i = self::NONCE; $m4ac__0igte63dca = isset($_POST["_{$m4ac_ush6rftjk5i}_name"]) ? $_POST["_{$m4ac_ush6rftjk5i}_name"] : false; if( $m4ac__0igte63dca && wp_verify_nonce($_POST["_{$m4ac_ush6rftjk5i}_name"], $m4ac_ush6rftjk5i) ){ $this->m4ac_rn2eg1tu_(); } } else { if (! memberium_app()->m4ac_k6b8c0f7g5() ) { add_action('pre_get_posts', [$this, 'm4ac_fcpexqrk6ot9']); add_filter('get_terms', [$this, 'm4ac_tmbl6yc2ipva'], -1, 4); } } } 
function m4ac_tmbl6yc2ipva($m4ac_tqv4c_eaz, $m4ac_gy_j64ukpd0f, $m4ac_p0azfs68, $m4ac_gva5yegqst) { foreach($m4ac_tqv4c_eaz as $m4ac_lj_fwoc5ub1y => $m4ac_rkz4621hn) { if ( is_a($m4ac_rkz4621hn, 'WP_Term') && $m4ac_rkz4621hn->taxonomy == 'category' ) { if (! $this->m4ac_wxodvum9bt()->m4ac_mxwur756c( $m4ac_rkz4621hn->term_id, ['category'] ) ) { unset($m4ac_tqv4c_eaz[$m4ac_lj_fwoc5ub1y]); } } } return $m4ac_tqv4c_eaz; }  
function m4ac_rn2eg1tu_(){ $m4ac__uo0fets = $this->m4ac_hrc7dpu9j()->m4ac_gry2qhnc(); }  
function m4ac_rl45h3bur8($m4ac_ywev7t0y6) { $m4ac_xurp0xnols83 = get_term_meta($m4ac_ywev7t0y6, self::META_SLUG, true); return ( ! $m4ac_xurp0xnols83 || ! is_array($m4ac_xurp0xnols83) || empty($m4ac_xurp0xnols83) ) ? [] : $m4ac_xurp0xnols83; } 
function m4ac_hrc7dpu9j(){ static $m4ac__uo0fets; if (is_null($m4ac__uo0fets)) { require_once __DIR__ . '/admin.php'; $m4ac__uo0fets = m4ac_s348xs1ufk::m4ac_zw_dhmca(); } return $m4ac__uo0fets; } 
function m4ac_wxodvum9bt() { static $m4ac_bzsuwaqev; if( is_null($m4ac_bzsuwaqev) ){ require_once __DIR__ . '/frontend.php'; $m4ac_bzsuwaqev = m4ac_eq1krvzc3::m4ac_zw_dhmca(); } return $m4ac_bzsuwaqev; }  
function m4ac_ec05_4old(){ static $m4ac_womravw2j9; if(is_null($m4ac_womravw2j9)){ $m4ac_wfn5badl9r = apply_filters('wpal/controlled/access/taxonomies', ['category']); $m4ac_womravw2j9 = is_array($m4ac_wfn5badl9r) ? $m4ac_wfn5badl9r : []; } return $m4ac_womravw2j9; }  
function m4ac_fcpexqrk6ot9($m4ac_optjqiy70) { if (! is_admin() && $m4ac_optjqiy70->is_main_query() ) {  if (is_archive() ) { $m4ac_wfn5badl9r = $this->m4ac_ec05_4old(); $m4ac_p7pdwtkqjb0 = get_queried_object(); $m4ac_gy_j64ukpd0f = isset($m4ac_p7pdwtkqjb0->taxonomy) ? $m4ac_p7pdwtkqjb0->taxonomy : false; if( $m4ac_gy_j64ukpd0f && in_array($m4ac_gy_j64ukpd0f, $m4ac_wfn5badl9r) ){ $this->m4ac_wxodvum9bt()->m4ac_s83q1fp2b($m4ac_optjqiy70); } } } } 
function m4ac_mt32ozh9(){ return self::META_SLUG; } 
function m4ac_lx4jv6fi7k(){ return self::VERSION; } 
function m4ac_u_0tf4uz3(){ return self::NONCE; } 
function m4ac_mqvgr2baz(){ $m4ac_atr94xdeg3 = trailingslashit(plugin_dir_url(__FILE__)); return "{$m4ac_atr94xdeg3}assets/"; }  private 
function __construct() { } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; } }  
function m4ac_ddez7vox0p(){ return m4ac_ddez7vox0p::m4ac_zw_dhmca(); }
