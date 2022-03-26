<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_xihkav2ozs_p') ) { final 
class m4ac_e_bqir0ut {  
function m4ac_q7qhru9i() { global $post; $m4ac_j0e14tousp_ = m4ac_xihkav2ozs_p::m4ac_zw_dhmca()->m4ac_z2g4l1scfam($post->ID); echo '<label for="_memberium_access_tag">', _e("Access Tag", 'memberium'), ':</label> '; echo '<input name="_memberium_access_tag" class="taglistdropdown" style="width:100%; max-width:100%" value="', $m4ac_j0e14tousp_['main'], '"><br /><br />'; echo '<label for="_memberium_trial_tag">', _e("Trial Tag", 'memberium'), ':</label> '; echo '<input name="_memberium_trial_tag" class="taglistdropdown" style="width:100%; max-width:100%" value="', $m4ac_j0e14tousp_['trial'], '"><br /><br />'; echo '<label for="_memberium_canc_tag">', _e("Cancel Tag", 'memberium'), ':</label> '; echo '<input name="_memberium_canc_tag" class="taglistdropdown" style="width:100%; max-width:100%" value="', $m4ac_j0e14tousp_['canc'], '"><br /><br />'; echo '<label for="_memberium_payf_tag">', _e("Payment Failure Tag", 'memberium'), ':</label> '; echo '<input name="_memberium_payf_tag"  class="taglistdropdown" style="width:100%; max-width:100%" value="', $m4ac_j0e14tousp_['payf'], '"><br /><br />'; } 
function m4ac_tnj7l8o2($m4ac__37l6rhivt2) { if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return; } if (! $m4ac__37l6rhivt2) { return; } if (! current_user_can('edit_posts', $m4ac__37l6rhivt2) ) { return; } $m4ac_ah4c_sou = [ '_memberium_access_tag', '_memberium_canc_tag', '_memberium_payf_tag', '_memberium_trial_tag', ]; foreach($m4ac_ah4c_sou as $m4ac_ukqvxo6ne7) { if (isset($_POST[$m4ac_ukqvxo6ne7]) ) { update_post_meta($m4ac__37l6rhivt2, $m4ac_ukqvxo6ne7, trim($_POST[$m4ac_ukqvxo6ne7], ',') ); } } } 
function m4ac_w07mrqh2sxlp() { add_meta_box('memberium\edd\actions','Memberium for EDD', [$this, 'm4ac_q7qhru9i'], 'download', 'side'); add_action('save_post_download', [$this, 'm4ac_tnj7l8o2']); } private 
function __construct() { add_action('admin_init', [$this, 'm4ac_w07mrqh2sxlp']); } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; } } }
