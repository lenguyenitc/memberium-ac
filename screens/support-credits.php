<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (! defined('ABSPATH') ) { die(); } $m4ac_gsgyvaq_umiw = 'memberium/welcomecontent/credits'; if (MEMBERIUM_BETA) { delete_transient($m4ac_gsgyvaq_umiw); } $m4ac_c4qc56391fd = get_transient($m4ac_gsgyvaq_umiw); if (! $m4ac_c4qc56391fd) { $m4ac_atr94xdeg3 = 'https://licenseserver.webpowerandlight.com/memberium-ac/welcome/index.php?tab=credits&version=' . memberium_app()->m4ac_lx4jv6fi7k(); $m4ac_c4qc56391fd = wp_remote_get($m4ac_atr94xdeg3); $m4ac_c4qc56391fd = $m4ac_c4qc56391fd['body']; if ($m4ac_c4qc56391fd > '') { set_transient($m4ac_gsgyvaq_umiw, $m4ac_c4qc56391fd, 3600); } } echo $m4ac_c4qc56391fd;
