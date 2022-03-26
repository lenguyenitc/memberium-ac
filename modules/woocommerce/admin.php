<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_wpfmq9e7') ) { final 
class m4ac_whx8pyv_s { 
function m4ac_sj9nudr1() { add_meta_box('memberium\woocommerce\actions','Memberium WooCommerce', [$this, 'm4ac_i8nrs2fh5v'], 'product', 'side'); add_action('save_post_product', [$this, 'm4ac_j5vjbxa4ck']); } 
function m4ac_i8nrs2fh5v() { global $post; $m4ac_e3ht7j0fxgiq = get_post_meta($post->ID); $m4ac__evj8cxs = empty($m4ac_e3ht7j0fxgiq['_memberium_main_tag'][0]) ? 0 : $m4ac_e3ht7j0fxgiq['_memberium_main_tag'][0]; $m4ac_y1453n67 = empty($m4ac_e3ht7j0fxgiq['_memberium_canc_tag'][0]) ? 0 : $m4ac_e3ht7j0fxgiq['_memberium_canc_tag'][0]; $m4ac_j9zh6o14jw = empty($m4ac_e3ht7j0fxgiq['_memberium_payf_tag'][0]) ? 0 : $m4ac_e3ht7j0fxgiq['_memberium_payf_tag'][0]; $m4ac_j1053mnx4 = empty($m4ac_e3ht7j0fxgiq['_memberium_susp_tag'][0]) ? 0 : $m4ac_e3ht7j0fxgiq['_memberium_susp_tag'][0]; $m4ac_nolbyw_gt4s = empty($m4ac_e3ht7j0fxgiq['_memberium_order_automation'][0]) ? 0 : $m4ac_e3ht7j0fxgiq['_memberium_order_automation'][0]; $m4ac_soz8df5q = empty($m4ac_e3ht7j0fxgiq['_memberium_canc_automation'][0]) ? 0 : $m4ac_e3ht7j0fxgiq['_memberium_canc_automation'][0]; $m4ac_tnezsywfvjci = empty($m4ac_e3ht7j0fxgiq['_memberium_payf_automation'][0]) ? 0 : $m4ac_e3ht7j0fxgiq['_memberium_payf_automation'][0]; $m4ac_cpas6mw0 = empty($m4ac_e3ht7j0fxgiq['_memberium_susp_automation'][0]) ? 0 : $m4ac_e3ht7j0fxgiq['_memberium_susp_automation'][0]; $m4ac_vw38otqs4md = empty($m4ac_e3ht7j0fxgiq['_memberium_guest_checkout'][0]) ? 0 : $m4ac_e3ht7j0fxgiq['_memberium_guest_checkout'][0]; echo '<label for="_memberium_main_tag">', _e("Access Tag", 'memberium'), ':</label> '; echo '<input name="_memberium_main_tag" class="taglistdropdown" style="width:100%; max-width:100%" value="', $m4ac__evj8cxs, '"><br /><br />'; echo '<label for="_memberium_canc_tag">', _e("Cancel Tag", 'memberium'), ':</label> '; echo '<input name="_memberium_canc_tag" class="taglistdropdown" style="width:100%; max-width:100%" value="', $m4ac_y1453n67, '"><br /><br />'; echo '<label for="_memberium_payf_tag">', _e("Payment Failure Tag", 'memberium'), ':</label> '; echo '<input name="_memberium_payf_tag"  class="taglistdropdown" style="width:100%; max-width:100%" value="', $m4ac_j9zh6o14jw, '"><br /><br />'; echo '<label for="_memberium_susp_tag">', _e("Suspend/On-Hold Tag", 'memberium'), ':</label> '; echo '<input name="_memberium_susp_tag" class="taglistdropdown" style="width:100%; max-width:100%" value="', $m4ac_j1053mnx4, '"><br /><br />'; echo '<hr />'; echo '<label for="_memberium_order_automation">', _e("Order Automation", 'memberium'), ':</label> '; echo '<input name="_memberium_order_automation" class="automationdropdown" style="width:100%; max-width:100%" value="', $m4ac_nolbyw_gt4s, '"><br /><br />'; echo '<label for="_memberium_canc_automation">', _e("Cancel Automation", 'memberium'), ':</label> '; echo '<input name="_memberium_canc_automation" class="automationdropdown" style="width:100%; max-width:100%" value="', $m4ac_soz8df5q, '"><br /><br />'; echo '<label for="_memberium_payf_automation">', _e("Payment Failure Automation", 'memberium'), ':</label> '; echo '<input name="_memberium_payf_automation" class="automationdropdown" style="width:100%; max-width:100%" value="', $m4ac_tnezsywfvjci, '"><br /><br />'; echo '<label for="_memberium_susp_automation">', _e("Suspend/On-Hold Automation", 'memberium'), ':</label> '; echo '<input name="_memberium_susp_automation" class="automationdropdown" style="width:100%; max-width:100%" value="', $m4ac_cpas6mw0, '"><br /><br />'; echo '<hr />'; $m4ac_rp4_enzix = [ 0 => 'No', 1 => 'Yes', ]; echo '<label for="_memberium_guest_checkout">', _e("Allow Guest Checkout", 'memberium'), ':</label> '; m4ac_s126v0fexga::m4ac_jslwze610('_memberium_guest_checkout', $m4ac_rp4_enzix, $m4ac_vw38otqs4md, []); } 
function m4ac_j5vjbxa4ck($m4ac__37l6rhivt2) { if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return; } if (! $m4ac__37l6rhivt2) { return; } if (! current_user_can('edit_posts', $m4ac__37l6rhivt2) ) { return; } $m4ac_e3ht7j0fxgiq = m4ac_wpfmq9e7::m4ac_j9r3pbfa25(); foreach($m4ac_e3ht7j0fxgiq as $m4ac_xurp0xnols83) { if (isset($_POST[$m4ac_xurp0xnols83]) ) { $_POST[$m4ac_xurp0xnols83] = trim($_POST[$m4ac_xurp0xnols83], ','); update_post_meta($m4ac__37l6rhivt2, $m4ac_xurp0xnols83, $_POST[$m4ac_xurp0xnols83]); } } } private 
function __construct() { add_filter('woocommerce_helper_suppress_admin_notices', '__return_true'); add_action('admin_init', [$this, 'm4ac_sj9nudr1']); } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; } } }
