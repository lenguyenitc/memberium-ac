<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (! defined('ABSPATH') ) { die(); } $m4ac_gsgyvaq_umiw = "memberium::welcomecontent::{$m4ac_rlcs0yj3fk1}"; if (MEMBERIUM_BETA || MEMBERIUM_DEBUG) { delete_transient($m4ac_gsgyvaq_umiw); } $content = get_transient($m4ac_gsgyvaq_umiw); if (! $content) { $content = wp_remote_get('https://licenseserver.webpowerandlight.com/memberium-ac/welcome/index.php?tab=' . $m4ac_rlcs0yj3fk1 . '&version=' . memberium_app()->m4ac_lx4jv6fi7k()); if (! empty($content['body']) ) { set_transient($m4ac_gsgyvaq_umiw, $content['body'], 3600); $content = $content['body']; } } echo $content;
