<?php
/**
 * Copyright (c) 2015-2021 David J Bullock
 * Web Power and Light, LLC
 * https://webpowerandlight.com
 * support@webpowerandlight.com
 *
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_rntik2rdq0 { 
function m4ac_mhmiqn5l1(){  add_filter('rest_pre_dispatch', [$this, 'm4ac_k8wflnrs9'], 10, 3 ); add_action('wpal/block/access/init', [$this, 'm4ac__jvdxwrainze'], 1);  do_action('wpal/block/access/init');  if (version_compare( get_bloginfo('version'), '5.4', '>=') ) { $this->m4ac_nox5z6wi(); }  $this->m4ac_jarbut05n();  $this->m4ac_iao0w23_(); }    
function m4ac__jvdxwrainze(){ if( is_admin() ){  add_action('enqueue_block_editor_assets', [$this->m4ac_hrc7dpu9j(), 'm4ac_v9op1dwlegiq'], 1); } else{  add_filter('render_block', [$this->m4ac_wxodvum9bt(), 'm4ac_vxisr9y_'], PHP_INT_MAX, 2 ); } }  
function m4ac_k8wflnrs9($m4ac_fic2e07vfkz, $m4ac_kmq95a1exf2, $m4ac_x410ukrvbs7) { if ( strpos($m4ac_x410ukrvbs7->get_route(), '/wp/v2/block-renderer' ) !== false) { if ( isset($m4ac_x410ukrvbs7['attributes']) ){ $m4ac_ndjylcna3 = $m4ac_x410ukrvbs7['attributes']; if( is_array($m4ac_ndjylcna3) && ! empty($m4ac_ndjylcna3) ){ foreach ($m4ac_ndjylcna3 as $m4ac_egl6dkai => $m4ac_y2mw1xc6rq) { if (strpos($m4ac_egl6dkai, self::PREFIX) === 0) { unset($m4ac_ndjylcna3[$m4ac_egl6dkai]); } } $m4ac_x410ukrvbs7['attributes'] = $m4ac_ndjylcna3; } } } return $m4ac_fic2e07vfkz; }    
function m4ac_nox5z6wi(){ $m4ac_lp50ub_1 = false; if ( wp_doing_ajax() ) { $m4ac_lp50ub_1 = isset($_POST['action']) ? $_POST['action'] : false; } if ( is_admin() || $m4ac_lp50ub_1 === 'add-menu-item' ) { add_action('load-nav-menus.php', ['m4ac_cwgpe3b8ds', 'm4ac_rh6ijntd'], 1);   if ($m4ac_lp50ub_1 === 'add-menu-item' ) { m4ac_cwgpe3b8ds::m4ac_rh6ijntd(); } } else if ( ! is_admin() || $m4ac_lp50ub_1 ) { add_filter('wp_get_nav_menu_items', [$this->m4ac_wxodvum9bt(), 'm4ac__xr7jbno'], 1, 3); } } 
function m4ac_cgu3a8h95d($m4ac_c_0iefnwl) { $m4ac_xurp0xnols83 = get_post_meta($m4ac_c_0iefnwl, '_wpal/menu/access', true); return ( ! $m4ac_xurp0xnols83 || ! is_array($m4ac_xurp0xnols83) || empty($m4ac_xurp0xnols83) ) ? [] : $m4ac_xurp0xnols83; }    
function m4ac_jarbut05n(){ add_action('in_widget_form', ['m4ac_t3mcyjgw8', 'm4ac_xnelf0xw593'], 10, 3);  add_filter('widget_update_callback', ['m4ac_t3mcyjgw8', 'm4ac_zxbqa9tg1'], 10, 2);  if( is_admin() ){ add_action('load-widgets.php', ['m4ac_t3mcyjgw8', 'm4ac_s6a1djgm'], 1);  } else { add_filter('sidebars_widgets', [$this->m4ac_wxodvum9bt(), 'm4ac_ev19quk3nc'], 10);  add_filter('widget_display_callback', [$this->m4ac_wxodvum9bt(), 'm4ac_dv4f2pex8'], 10, 3);  } }    
function m4ac_iao0w23_(){ if (is_admin() && ! wp_doing_ajax() ) {  add_action('load-term.php', ['m4ac_rd0bfus45xa', 'm4ac_rn2eg1tu_'], 1);  $m4ac_ush6rftjk5i = 'memberium/taxonomy/access'; $m4ac__0igte63dca = isset($_POST["_{$m4ac_ush6rftjk5i}_name"]) ? $_POST["_{$m4ac_ush6rftjk5i}_name"] : false; if( $m4ac__0igte63dca && wp_verify_nonce($_POST["_{$m4ac_ush6rftjk5i}_name"], $m4ac_ush6rftjk5i) ){ m4ac_rd0bfus45xa::m4ac_rn2eg1tu_(); } } else { if (! memberium_app()->m4ac_k6b8c0f7g5() ) { add_action('pre_get_posts', [$this->m4ac_wxodvum9bt(), 'm4ac_fcpexqrk6ot9']); add_filter('get_terms', [$this->m4ac_wxodvum9bt(), 'm4ac_tmbl6yc2ipva'], -1, 4); } } }  
function m4ac_ec05_4old(){ static $m4ac_womravw2j9; if(is_null($m4ac_womravw2j9)){ $m4ac_wfn5badl9r = apply_filters('wpal/controlled/access/taxonomies', ['category']); $m4ac_womravw2j9 = is_array($m4ac_wfn5badl9r) ? $m4ac_wfn5badl9r : []; } return $m4ac_womravw2j9; } 
function m4ac__qrg2f4t1ij( $m4ac_ywev7t0y6 ){ $m4ac_xurp0xnols83 = get_term_meta($m4ac_ywev7t0y6, '_wpal/taxonomy/access', true); return ( ! $m4ac_xurp0xnols83 || ! is_array($m4ac_xurp0xnols83) || empty($m4ac_xurp0xnols83) ) ? [] : $m4ac_xurp0xnols83; }    
function m4ac_hrc7dpu9j() : m4ac_bslvmz6poqi3 { static $m4ac__uo0fets = null; if( is_null($m4ac__uo0fets) ){ $m4ac__uo0fets = m4ac_bslvmz6poqi3::m4ac_zw_dhmca(); } return $m4ac__uo0fets; } 
function m4ac_wxodvum9bt() : m4ac_jh_0f3wq { static $m4ac_bzsuwaqev = null; if( is_null($m4ac_bzsuwaqev) ){ $m4ac_bzsuwaqev = m4ac_jh_0f3wq::m4ac_zw_dhmca(); } return $m4ac_bzsuwaqev; } private 
function __construct(){} static 
function m4ac_zw_dhmca(){ static $m4ac_u4tpxcro19 = null; return is_null($m4ac_u4tpxcro19) ? new self : $m4ac_u4tpxcro19; } const NS = 'memberium', PREFIX = 'm4ac'; } }
