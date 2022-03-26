<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_tpdkxiac78 { static 
function m4ac_wq92z1jrug5y($m4ac_c1m92xtgl8z, string $m4ac_c4qc56391fd = '', string $m4ac_kp6zrjntmf78) { if ($_SERVER['REMOTE_ADDR'] !== '127.0.0.1') { return; } } static 
function m4ac_j7iq2yk5me9($m4ac_c1m92xtgl8z, string $m4ac_c4qc56391fd = '', string $m4ac_kp6zrjntmf78) { if (isset($m4ac_c1m92xtgl8z[0]) && $m4ac_c1m92xtgl8z[0] == 'showatts') { return ''; } $m4ac_c46iyf5tz = $GLOBALS['shortcode_tags']; $output = ''; $m4ac_gsa9phly5qux = [ 'memb_list_shortcodes', 'memb_debug', ]; ksort($m4ac_c46iyf5tz); foreach($m4ac_c46iyf5tz as $m4ac_g_sevcjrm94 => $m4ac_b5uacij3nhfe) { if (false !== stripos($m4ac_g_sevcjrm94, 'memb_') && ! in_array($m4ac_g_sevcjrm94, $m4ac_gsa9phly5qux) ) { $m4ac_md7c8zsu2o = "[{$m4ac_g_sevcjrm94}]<br />" . do_shortcode("[{$m4ac_g_sevcjrm94} showatts]") . '<br /><br />'; $output .= $m4ac_md7c8zsu2o; } } return $output; } } }
