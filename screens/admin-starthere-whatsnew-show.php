<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (! defined('ABSPATH') ) { die(); } $transient_key = 'memberium::welcomecontent::' . $m4ac_rlcs0yj3fk1; if (MEMBERIUM_BETA) { delete_transient($transient_key); } $content = get_transient($transient_key); if (! $content) { $content = wp_remote_get('https://licenseserver.webpowerandlight.com/memberium-ac/welcome/index.php?tab=' . $m4ac_rlcs0yj3fk1 . '&version=' . memberium_app()->m4ac_lx4jv6fi7k() ); $content = $content['body']; if ($content > '') { set_transient($transient_key, $content, 3600); } } echo $content;
