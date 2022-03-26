<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (! defined('ABSPATH') ) { die(); } echo '<form method="POST" action="">'; wp_nonce_field(MEMBERIUM_MODULES_DIR, 'memberium_options_nonce'); $m4ac_r0_a5ghub = memberium_app()->m4ac_s46veg231x('ext/'); $m4ac_xf28u9sh03ev = memberium_app()->m4ac_v0i3b6vafc(); echo '<ul>'; echo '<h3>Optional Extensions</h3>'; foreach ($m4ac_xf28u9sh03ev as $m4ac_q5u6fln0c3 => $m4ac_u10yzxwf4lc ) { $m4ac_hdaukwlzt14 = dirname(MEMBERIUM_MODULES_DIR . $m4ac_u10yzxwf4lc) . '/info.txt'; if (file_exists($m4ac_hdaukwlzt14)) { $m4ac_md7c8zsu2o = get_plugin_data($m4ac_hdaukwlzt14, false, false ); if (! empty($m4ac_md7c8zsu2o['Name'] ) ) { $m4ac_x6vpzdgl54 = basename(dirname($m4ac_u10yzxwf4lc) ); $m4ac_rmzhj98n16 = isset($m4ac_r0_a5ghub[$m4ac_x6vpzdgl54] ) ? $m4ac_r0_a5ghub[$m4ac_x6vpzdgl54] : 0; echo $this->m4ac_l1fpox937i8d("{$m4ac_md7c8zsu2o['Name']}", "ext/{$m4ac_x6vpzdgl54}/enabled", $m4ac_md7c8zsu2o['AuthorURI']); } } } echo '</ul>'; echo '<p><input type="submit" value="Update" class="button-primary"></p>'; echo '</form>';
