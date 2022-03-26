<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_j5_sa096cjq { 
function m4ac_bq5_24sy($m4ac_ixteyr6q) { global $op_content_layout; do_action('memberium/shortcodes/add'); $op_content_layout = do_shortcode($op_content_layout); return $m4ac_ixteyr6q; } 
function m4ac_jfv1cub09iyk($m4ac_c4qc56391fd) { $m4ac_c4qc56391fd = preg_replace('/\[(\w.*)\]/', '[[$1]]', $m4ac_c4qc56391fd); return $m4ac_c4qc56391fd; } 
function m4ac_sy9_7o6r() { $m4ac_bzsuwaqev = m4ac_m7m0xgfv::m4ac_zw_dhmca(); $m4ac__37l6rhivt2 = $m4ac_bzsuwaqev->m4ac_n_ymb6d7ku(); $m4ac_vkwcyrxub = get_post_meta($m4ac__37l6rhivt2, '_optimizepress_pagebuilder', true) == 'Y'; if ($m4ac_vkwcyrxub) { add_filter('comment_text', [$this, 'm4ac_jfv1cub09iyk'], 1, 1); } } private 
function m4ac_rh6ijntd() { add_filter('op_check_page_availability', [$this, 'm4ac_bq5_24sy']);  } private 
function __construct() { $this->m4ac_rh6ijntd(); } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; }  } }
