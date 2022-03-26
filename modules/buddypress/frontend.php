<?php
 if (class_exists('m4ac_c6rqypiacz4') ) { 
class m4ac_okn1hzlf9 { 
function m4ac_j9das4o1hge() { if (is_buddypress() ) { $m4ac_h6z7qjgx = bp_current_component(); if ($m4ac_h6z7qjgx) { $m4ac_h6z7qjgx = $m4ac_h6z7qjgx == 'profile' ? 'members' : $m4ac_h6z7qjgx; $m4ac__37l6rhivt2 = bp_core_get_directory_page_id($m4ac_h6z7qjgx); if ($m4ac__37l6rhivt2) { $m4ac_bzsuwaqev = m4ac_m7m0xgfv::m4ac_zw_dhmca(); $m4ac_p7j_84tfw = $m4ac_bzsuwaqev->m4ac_mh407kspfdzq($m4ac__37l6rhivt2); if (! $m4ac_p7j_84tfw) { $m4ac_lp50ub_1 = $m4ac_bzsuwaqev->m4ac_s9exz3s7($m4ac__37l6rhivt2); if ($m4ac_lp50ub_1 == 'hide') { global $wp_query; $wp_query->set_404(); status_header(404); return; } elseif ($m4ac_lp50ub_1 == 'redirect') { $m4ac_bzsuwaqev->m4ac_rif1vp5ho9ka($m4ac__37l6rhivt2); } } } } } } 
function m4ac_rh6ijntd() { add_action('template_redirect', [$this, 'm4ac_j9das4o1hge'], 11); } private 
function __construct() { $this->m4ac_rh6ijntd(); } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; } } }
