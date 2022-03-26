<?php
/**
 * Copyright (c) 2018-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_e0t4y56g { private 
function __construct() { $this->m4ac_rh6ijntd(); } static 
function m4ac_zw_dhmca() { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; } 
function m4ac_dpt4i5ac($m4ac_mbjh6lyt) { $m4ac_zz7t3ox9ebp = bbp_get_forum_id(); $m4ac_zb9atqks6 = get_post_meta($m4ac_zz7t3ox9ebp, '_memberium/bbpress/can_post', true); if ($m4ac_zb9atqks6) { $m4ac_mbjh6lyt = memberium_app()->m4ac_t5ws0_v68($m4ac_zb9atqks6); } return $m4ac_mbjh6lyt; } 
function m4ac_vv02a_3ltfg($m4ac_mbjh6lyt) { $m4ac_zz7t3ox9ebp = bbp_get_forum_id();  $m4ac_zb9atqks6 = get_post_meta($m4ac_zz7t3ox9ebp, '_memberium/bbpress/can_post', true); if ($m4ac_zb9atqks6) { $m4ac_mbjh6lyt = memberium_app()->m4ac_t5ws0_v68($m4ac_zb9atqks6); } return $m4ac_mbjh6lyt; } 
function m4ac_rh6ijntd() { add_filter('bbp_current_user_can_publish_topics', [$this, 'm4ac_vv02a_3ltfg']);  add_filter('bbp_current_user_can_access_create_topic_form', [$this, 'm4ac_vv02a_3ltfg']);  add_filter( 'bbp_current_user_can_access_create_reply_form', [$this, 'm4ac_dpt4i5ac'] ); } } }
