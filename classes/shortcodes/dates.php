<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_zmdyx73z4ka { static 
function m4ac_q58zqt_o2ch($m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd = null, $m4ac_kp6zrjntmf78) { $m4ac_wdl2r3x6jg = [ 'after' => '', 'before' => '', 'capture' => '', 'date' => 'now', 'format' => 'l, F dS, Y, g:sA e', 'host_timezone' => '', 'htmlattr' => '', 'txtfmt' => '', ]; if (isset($m4ac_c1m92xtgl8z[0]) && $m4ac_c1m92xtgl8z[0] == 'showatts') { return implode(',', array_keys($m4ac_wdl2r3x6jg) ); } $m4ac_c1m92xtgl8z = shortcode_atts($m4ac_wdl2r3x6jg, $m4ac_c1m92xtgl8z, 'memberium'); $m4ac_pa2k7635qor = date($m4ac_c1m92xtgl8z['format'], strtotime($m4ac_c1m92xtgl8z['date'] . ' ' . $m4ac_c1m92xtgl8z['host_timezone']) ); return m4ac_audvsgbhpw::m4ac_teqln8w23g(false, $m4ac_pa2k7635qor, $m4ac_c1m92xtgl8z['txtfmt'], $m4ac_c1m92xtgl8z['capture'], $m4ac_c1m92xtgl8z['htmlattr'], $m4ac_c1m92xtgl8z['before'], $m4ac_c1m92xtgl8z['after']); } static 
function m4ac_fxm48hq2uio($m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd = null, $m4ac_kp6zrjntmf78) { $m4ac_wdl2r3x6jg = [ 'after' => '', 'before' => '', 'capture' => '', 'date_format' => 'F jS, Y', 'htmlattr' => '', 'txtfmt' => '', ]; if (isset($m4ac_c1m92xtgl8z[0]) && $m4ac_c1m92xtgl8z[0] == 'showatts') { return implode(',', array_keys($m4ac_wdl2r3x6jg) ); } if (function_exists('is_user_logged_in') && ! is_user_logged_in() ) { return ''; } $m4ac_c1m92xtgl8z = shortcode_atts($m4ac_wdl2r3x6jg, $m4ac_c1m92xtgl8z, 'memberium'); $m4ac_pa2k7635qor = date($m4ac_c1m92xtgl8z['date_format'], strtotime(get_userdata(get_current_user_id() )->user_registered) ); return m4ac_audvsgbhpw::m4ac_teqln8w23g(false, $m4ac_pa2k7635qor, $m4ac_c1m92xtgl8z['txtfmt'], $m4ac_c1m92xtgl8z['capture'], $m4ac_c1m92xtgl8z['htmlattr'], $m4ac_c1m92xtgl8z['before'], $m4ac_c1m92xtgl8z['after']); } } }
