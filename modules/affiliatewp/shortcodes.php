<?php
/**
 * Copyright (c) 2020 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_b5s7nacipdo8 { static 
function m4ac_ik9ypl6vt3uh($m4ac_c1m92xtgl8z, string $m4ac_c4qc56391fd = '', string $m4ac_kp6zrjntmf78 = '') { $m4ac_at_5xofh = get_current_user_id(); $m4ac_wdl2r3x6jg = [ 'not' => false, 'status' => 'active', ]; if (isset($m4ac_c1m92xtgl8z[0]) && $m4ac_c1m92xtgl8z[0] == 'showatts') { return implode(',', array_keys($m4ac_wdl2r3x6jg) ); } $m4ac_c1m92xtgl8z = shortcode_atts($m4ac_wdl2r3x6jg, $m4ac_c1m92xtgl8z, 'memberium'); $m4ac__53ph9g87f = false; if ($m4ac_at_5xofh ) { $m4ac__53ph9g87f = affwp_is_affiliate($m4ac_at_5xofh); if ($m4ac__53ph9g87f) { $m4ac_k3t0vnqb_u = affwp_get_affiliate_id($m4ac_at_5xofh); $m4ac__53ph9g87f = $m4ac_c1m92xtgl8z['status'] == strtolower(affwp_get_affiliate_status($m4ac_k3t0vnqb_u)); } } if (user_can($m4ac_at_5xofh, 'manage_options')) { $m4ac__53ph9g87f = true; } if ($m4ac_c1m92xtgl8z['not']) { $m4ac__53ph9g87f = ! $m4ac__53ph9g87f; } $m4ac_pa2k7635qor = m4ac_audvsgbhpw::m4ac_j9_6leqa($m4ac_c4qc56391fd, $m4ac_kp6zrjntmf78, true, $m4ac__53ph9g87f); return m4ac_audvsgbhpw::m4ac_teqln8w23g(false, $m4ac_pa2k7635qor, $m4ac_c1m92xtgl8z['txtfmt'], $m4ac_c1m92xtgl8z['capture']); } } }
