<?php
/**
 * Copyright (c) 2018-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_wpfmq9e7') ) { final 
class m4ac_t_v0ya96r { static 
function m4ac_s7mo2cxfk() { if (! wp_verify_nonce($_POST['_wpnonce'], $_POST['params']) ) { wp_die('Invalid Update Form Submission'); exit; } if (! memberium_app()->m4ac_bh4tj53v6z8k($_POST['signature'], $_POST['params']) ) { wp_die('Security Check Failed - Signature Validation Error'); exit; }  $m4ac_bxvpge5qkdo9 = unserialize(base64_decode($_POST['params']) ); $m4ac_d8mkw6qu45br = array_filter(explode(',', $m4ac_bxvpge5qkdo9['product_ids']) ); $m4ac_gphbxj7n = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 0; if ($m4ac_gphbxj7n < 1) { $m4ac_gphbxj7n = 1; } if ($m4ac_d8mkw6qu45br) { foreach($m4ac_d8mkw6qu45br as $m4ac_lj_fwoc5ub1y) { if (m4ac_m7m0xgfv::m4ac_zw_dhmca()->m4ac_mh407kspfdzq($m4ac_lj_fwoc5ub1y) ) { wc()->cart->add_to_cart($m4ac_lj_fwoc5ub1y, $m4ac_gphbxj7n); } } }  $m4ac_atr94xdeg3 = (! empty($m4ac_bxvpge5qkdo9['redirect']) ) ? $m4ac_bxvpge5qkdo9['redirect'] : wc()->cart->get_checkout_url(); wp_redirect($m4ac_atr94xdeg3, 302, 'Memberium ' . __FUNCTION__ . '::' . __LINE__); exit; } } }
