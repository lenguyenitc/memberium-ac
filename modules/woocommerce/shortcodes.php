<?php
/**
 * Copyright (c) 2018-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_txjyu9r_4 { static 
function m4ac_e46sr9ipdj($m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd = null, $m4ac_kp6zrjntmf78) { static $m4ac_xqndufev = 1; $m4ac_wdl2r3x6jg = [ 'autorun' => false, 'button_image' => '', 'button_text' => 'Add to Cart', 'css_id' => 'woo_add_to_cart_form_' . $m4ac_xqndufev, 'css_style' => '', 'product_ids' => '0',  'redirect' => '', 'tag_id' => '',  ]; if (isset($m4ac_c1m92xtgl8z[0]) && $m4ac_c1m92xtgl8z[0] == 'showatts') { return implode(',', array_keys($m4ac_wdl2r3x6jg) ); } $m4ac_c1m92xtgl8z = shortcode_atts($m4ac_wdl2r3x6jg, $m4ac_c1m92xtgl8z, 'memberium'); $m4ac_c1m92xtgl8z['css_id'] = trim($m4ac_c1m92xtgl8z['css_id']); $m4ac_ah90o86m = [ 'product_ids' => $m4ac_c1m92xtgl8z['product_ids'], 'redirect' => $m4ac_c1m92xtgl8z['redirect'], ]; $m4ac_l4jedymt8w3x = base64_encode(serialize($m4ac_ah90o86m) ); $m4ac_vejbrg5i = memberium_app()->m4ac_s5ze6qlragdu($m4ac_l4jedymt8w3x); $m4ac_md7c8zsu2o = new stdClass; $m4ac_md7c8zsu2o->button_image = $m4ac_c1m92xtgl8z['button_image']; $m4ac_md7c8zsu2o->button_text = $m4ac_c1m92xtgl8z['button_text']; $m4ac_md7c8zsu2o->css_class = $m4ac_qo82drlzxu; $m4ac_md7c8zsu2o->css_id = $m4ac_c1m92xtgl8z['css_id']; $m4ac_md7c8zsu2o->css_style = $m4ac_c1m92xtgl8z['css_style']; $m4ac_md7c8zsu2o->nonce = wp_nonce_field($m4ac_l4jedymt8w3x, '_wpnonce', true, false); $m4ac_md7c8zsu2o->parameters = $m4ac_l4jedymt8w3x; $m4ac_md7c8zsu2o->signature = $m4ac_vejbrg5i; $m4ac_xqndufev++; return m4ac_audvsgbhpw::m4ac_ltnm5sge8_($m4ac_kp6zrjntmf78, $m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd, $m4ac_kp6zrjntmf78, $m4ac_md7c8zsu2o); } static 
function m4ac_xct24o9h($m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd = null, $m4ac_kp6zrjntmf78) { } } }
