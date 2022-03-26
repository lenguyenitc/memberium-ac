<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (! defined('ABSPATH') ) { die(); } if (! function_exists('wp_new_user_notification') ) { 
function wp_new_user_notification($m4ac_at_5xofh, $m4ac_jovf531j9bm = '', $m4ac_ub8h1act = 'both') { $m4ac_rp4_enzix = memberium_app()->m4ac_x280qrz9kmic(); $m4ac_fheyfujga6 = get_userdata($m4ac_at_5xofh); if (empty($m4ac_rp4_enzix['wp_welcome_email']) ) { return false; } $m4ac_v9ib6apotjn = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES); $m4ac_oemjasi0tp = sprintf(__('New user registration on your site %s:'), $m4ac_v9ib6apotjn) . "\r\n\r\n"; $m4ac_oemjasi0tp .= sprintf(__('Username: %s'), $m4ac_fheyfujga6->user_login) . "\r\n\r\n"; $m4ac_oemjasi0tp .= sprintf(__('E-mail: %s'), $m4ac_fheyfujga6->user_email) . "\r\n"; @wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), $m4ac_v9ib6apotjn), $m4ac_oemjasi0tp); if (empty($m4ac_jovf531j9bm) ) { return false; } $m4ac_oemjasi0tp = sprintf(__('Username: %s'), $m4ac_fheyfujga6->user_login) . "\r\n"; $m4ac_oemjasi0tp .= sprintf(__('Password: %s'), $m4ac_jovf531j9bm) . "\r\n"; $m4ac_oemjasi0tp .= wp_login_url() . "\r\n"; wp_mail($m4ac_fheyfujga6->user_email, sprintf(__('[%s] Your username and password'), $m4ac_v9ib6apotjn), $m4ac_oemjasi0tp); return true; } }
