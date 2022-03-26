<?php
/**
 * Copyright (c) 2018-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_jtqg02nw { 
function m4ac_eyne_uom($m4ac_gfib2lmy) { global $wpdb; if (! empty ($m4ac_gfib2lmy) ) { $m4ac_hb1za_impyrx = implode(',', $m4ac_gfib2lmy); $m4ac_xtcz6bi97flk = "SELECT user_id FROM {$wpdb->usermeta} WHERE user_id IN (" . $m4ac_hb1za_impyrx . ") AND `meta_key` = 'memberium_optout' AND `meta_value` = 1; "; $m4ac_eicky3a7o_9 = $wpdb->get_col($m4ac_xtcz6bi97flk); $m4ac_gfib2lmy = array_diff($m4ac_gfib2lmy, $m4ac_eicky3a7o_9); } return $m4ac_gfib2lmy; } private 
function m4ac_rh6ijntd() { add_filter('bbp_get_topic_subscribers', [$this, 'm4ac_eyne_uom']); } private 
function __construct() { $this->m4ac_rh6ijntd(); if (is_admin() ) { m4ac_ezon_g9aulwf::m4ac_zw_dhmca(); } else { m4ac_e0t4y56g::m4ac_zw_dhmca(); } } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; } } }
