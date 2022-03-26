<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_wdt0ce9x5hqo { 
function __construct() { } static 
function m4ac_qi2cy0wu() { if (! function_exists('get_field') ) { return; } $m4ac_at_5xofh = get_current_user_id(); if ($m4ac_at_5xofh == 0) { return; } $m4ac_stq0k_h82 = get_field('course_page_type'); if (! in_array($m4ac_stq0k_h82, ['course', 'lesson']) ) { return; } $m4ac__37l6rhivt2 = get_the_id(); $m4ac_rl2v17zk = isset($_GET['mc']) ? $_GET['mc'] : ''; $m4ac_xurp0xnols83 = get_post_meta($m4ac__37l6rhivt2); $m4ac_mawbsgikyr7c = isset($_GET['t']) ? $_GET['t'] : ''; $m4ac_e1paj974x0k = isset($_GET['u']) ? $_GET['u'] : '';  $m4ac_htgxo3delu4 = false; if ($m4ac_stq0k_h82 == 'course' && $m4ac_rl2v17zk == 'y') { $m4ac_htgxo3delu4 = true; } elseif ($m4ac_stq0k_h82 == 'lesson' && $m4ac_evk3muni == 'c' && $m4ac_e1paj974x0k == 'y') { $m4ac_htgxo3delu4 = true; } if ($m4ac_htgxo3delu4) { $m4ac_uo08x_g7 = memberium_app()->m4ac_w8ohueyv(); if ($m4ac_uo08x_g7) { if (! empty($m4ac_xurp0xnols83['_memberium_lms_automation'][0]) ) { memberium_app()->m4ac_lmhdiugb6cs($m4ac_xurp0xnols83['_memberium_lms_automation'][0], $m4ac_uo08x_g7); } if (! empty($m4ac_xurp0xnols83['_memberium_lms_tag'][0]) ) { memberium_app()->m4ac_ocsjt69hrb($m4ac_xurp0xnols83['_memberium_lms_tag'][0], $m4ac_uo08x_g7); } do_action('memberium/lms/completion', $m4ac_at_5xofh, $m4ac__37l6rhivt2); } } }  } }
