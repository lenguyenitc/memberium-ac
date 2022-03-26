<?php
/**
 * Copyright (c) 2020 David J Bullock
 * Web Power and Light
 */

 if (! defined( 'ABSPATH' ) ) { die(); }  
class m4ac_kkt4iaow70v8 { const VERSION = '1.0.1';  const META_SLUG = '_wpal/menu/access';   
function m4ac_w07mrqh2sxlp($m4ac_b7_c3kyi) { $m4ac_wdl2r3x6jg = [ 'prefix' => 'wpal', 'settings_title' => __('Menu Item Access'), 'access_level_name' => __('Access Level'), 'key_name' => __('Key(s)'), 'ids_removed_text' => __('Notice : The following ID(s) have been removed'), ]; $m4ac_ah90o86m = wp_parse_args($m4ac_b7_c3kyi, $m4ac_wdl2r3x6jg);  foreach ($m4ac_ah90o86m as $m4ac_pzocy3nw => $m4ac_ihnr7cyv) { if (array_key_exists($m4ac_pzocy3nw, $m4ac_wdl2r3x6jg)) { $m4ac_gmn6r1csd04h = 'WPAL_MENU_' . strtoupper($m4ac_pzocy3nw); if (! defined($m4ac_gmn6r1csd04h) ) { define($m4ac_gmn6r1csd04h, $m4ac_ihnr7cyv); } } }  $this->m4ac_rh6ijntd(); }  
function m4ac_rh6ijntd() { $m4ac_lp50ub_1 = false; if (wp_doing_ajax() ) { $m4ac_lp50ub_1 = isset($_POST['action']) ? $_POST['action'] : false; } if (is_admin() || $m4ac_lp50ub_1 === 'add-menu-item') { add_action('load-nav-menus.php', [$this, 'm4ac_t_b67tc1hlq'], 1);   if ($m4ac_lp50ub_1 === 'add-menu-item' ) { $this->m4ac_t_b67tc1hlq(); } }  else if (! is_admin() || $m4ac_lp50ub_1 ) { add_filter('wp_get_nav_menu_items', [$this, 'm4ac__xr7jbno'], 1, 3); } }  
function m4ac_t_b67tc1hlq() { require_once __DIR__ . '/admin.php'; m4ac_ihjiwv3y1::m4ac_y5ges3afo()->m4ac_rh6ijntd(); }  
function m4ac_suhaylpjg($m4ac_c_0iefnwl) { $m4ac_xurp0xnols83 = get_post_meta($m4ac_c_0iefnwl, self::META_SLUG, true); return ( ! $m4ac_xurp0xnols83 || ! is_array($m4ac_xurp0xnols83) || empty($m4ac_xurp0xnols83) ) ? [] : $m4ac_xurp0xnols83; }  
function m4ac__xr7jbno($m4ac_xiacz8bpdx, $m4ac_kv34cs6ym, $m4ac_ah90o86m) { $m4ac_b8vf6s7ep = []; $m4ac_qvbeawljp6 = is_object($m4ac_kv34cs6ym) && isset($m4ac_kv34cs6ym->slug) ? $m4ac_kv34cs6ym->slug : 'default'; if (is_array($m4ac_xiacz8bpdx) && ! empty($m4ac_xiacz8bpdx) ) { $m4ac_bzsuwaqev = $this->m4ac_wxodvum9bt(); foreach ($m4ac_xiacz8bpdx as $m4ac_yqah5jzkgcdf => $m4ac_ww7oiazfdu) { if ($m4ac_bzsuwaqev->m4ac_b9cs4bq6z($m4ac_ww7oiazfdu, $m4ac_xiacz8bpdx, $m4ac_qvbeawljp6) ) { $m4ac_b8vf6s7ep[] = $m4ac_ww7oiazfdu; } } $m4ac_xiacz8bpdx = $m4ac_b8vf6s7ep; } return $m4ac_xiacz8bpdx; }  
function m4ac_fvmlp8ifo($m4ac_c4qc56391fd) { $m4ac_wauly08cp = ( false !== strpos( $m4ac_c4qc56391fd, '[' ) ); $m4ac_s1fetuxy = ( false !== strpos( $m4ac_c4qc56391fd, ']' ) ); return ( $m4ac_wauly08cp && $m4ac_s1fetuxy ); } 
function m4ac_wxodvum9bt() { static $m4ac_bzsuwaqev = false; if (! $m4ac_bzsuwaqev) { require_once __DIR__ . '/frontend.php'; $m4ac_bzsuwaqev = m4ac_f_lb1u2poq6::m4ac_y5ges3afo(); } return $m4ac_bzsuwaqev; } 
function m4ac_mt32ozh9() { return self::META_SLUG; } 
function m4ac_lx4jv6fi7k() { return self::VERSION; } 
function m4ac_mqvgr2baz() { $m4ac_atr94xdeg3 = plugin_dir_url(__FILE__); return "{$m4ac_atr94xdeg3}/assets/"; } private 
function __construct() { }  static 
function m4ac_y5ges3afo() { static $m4ac_u4tpxcro19 = false; if (! $m4ac_u4tpxcro19) { $m4ac_u4tpxcro19 = new self; } return $m4ac_u4tpxcro19; } }  
function m4ac_dxe41wmltk() { return m4ac_kkt4iaow70v8::m4ac_y5ges3afo(); }
