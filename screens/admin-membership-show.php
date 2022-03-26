<?php
/**
* Copyright (c) 2018-2021 David J Bullock
* Web Power and Light
*/

 if (!defined('ABSPATH') ) { die(); } global $wpdb; memberium_app()->m4ac_fuen6oxg('view_memberships'); $m4ac_t3cu9hgt = m4ac_l93s0gxuwfpd(); update_option(MEMBERIUM_MEMBERSHIP_SETTINGS, $m4ac_t3cu9hgt, true); if ($_SERVER['REQUEST_METHOD'] == 'POST') { m4ac_asa7v28x1q($this); } if (! empty($_GET['action']) && $_GET['action'] == 'edit' && ! empty($_GET['id']) ) { m4ac_jcsej1aob4(); m4ac_f1n7gt85phom(); } elseif (! empty($_GET['action']) && $_GET['action'] == 'add') { m4ac_vfi3jvawptx5(); m4ac_f1n7gt85phom(); } else { m4ac_e3o2f6gih_ms(); m4ac_vycltfvn74x(); } 
function m4ac_azr_yv5q8() { global $wp_roles; $m4ac_eapfg85_73w = $wp_roles->roles; $m4ac__mrexf31jzdt = []; foreach ($m4ac_eapfg85_73w as $m4ac_aft8kb9qcm=>$m4ac_k6itl5p4) { if ($m4ac_aft8kb9qcm <> 'administrator') { $m4ac__mrexf31jzdt[] = [ 'id' => $m4ac_aft8kb9qcm, 'name' => $m4ac_k6itl5p4['name'] ]; } } return $m4ac__mrexf31jzdt; } 
function m4ac_l93s0gxuwfpd() { $m4ac_t3cu9hgt = get_option(MEMBERIUM_MEMBERSHIP_SETTINGS, [] ); $m4ac_z9h1gke3vb0 = []; foreach ($m4ac_t3cu9hgt as $m4ac_lj_fwoc5ub1y => $m4ac_xurp0xnols83) { if ( (int) $m4ac_lj_fwoc5ub1y > 0 && (int) $m4ac_xurp0xnols83['main_id'] == $m4ac_lj_fwoc5ub1y) { $m4ac_z9h1gke3vb0[$m4ac_lj_fwoc5ub1y] = $m4ac_xurp0xnols83; } } return $m4ac_z9h1gke3vb0; } 
function m4ac_f0ulcs8d2o() { } 
function m4ac_ybz6u4j0wx_() { $m4ac_l48nxy_21hz = wp_get_themes(); $m4ac_wt42blhcpa = []; $m4ac_wt42blhcpa[] = [ 'id' => '', 'text' => '(Default)' ]; foreach ($m4ac_l48nxy_21hz as $name => $m4ac_ocj07nxdy54z) { $m4ac_wt42blhcpa[] = [ 'id' => $name, 'text' => $m4ac_ocj07nxdy54z->Name ]; } return json_encode($m4ac_wt42blhcpa); } 
function m4ac_dkn_5293() { global $wpdb;  $m4ac_id7k9t2q = m4ac_s126v0fexga::m4ac_t9z53uix_8(); $m4ac_xtcz6bi97flk = "SELECT `ID`, `post_title` FROM `{$wpdb->posts}` WHERE `post_status` = 'publish' AND `post_type`  IN ('" .implode("','", $m4ac_id7k9t2q) . "') ORDER BY `id` ASC;"; $m4ac_d09em3tyuh2 = $wpdb->get_results($m4ac_xtcz6bi97flk, ARRAY_A); $m4ac_vbqd27hzsn[] = [ 'id' => 0, 'text' => '(Default)' ]; foreach ($m4ac_d09em3tyuh2 as $m4ac_lj_fwoc5ub1y=>$m4ac_fqsk654i_hf) { $m4ac_vbqd27hzsn[] = [ 'id' => $m4ac_fqsk654i_hf['ID'], 'text' => $m4ac_fqsk654i_hf['post_title'] . ' (' . $m4ac_fqsk654i_hf['ID'] . ')' ]; unset($m4ac_d09em3tyuh2[$m4ac_lj_fwoc5ub1y]); } unset($m4ac_fqsk654i_hf, $m4ac_xtcz6bi97flk); return json_encode($m4ac_vbqd27hzsn); } 
function m4ac_vfi3jvawptx5() { $m4ac_t3cu9hgt = m4ac_l93s0gxuwfpd(); $m4ac__mrexf31jzdt = m4ac_azr_yv5q8(); $m4ac_l9lbyvw4xaed = memberium_app()->m4ac_ni3dn9fc('array');   echo '<div class="wrap memberium">'; echo '<p>Return to <a href="?page=memberium-memberships">Membership Screen</a></p>'; echo '<form method="post" action="?page=memberium-memberships">'; echo '<input name="action" value="add" type="hidden">'; echo '<h1 style="margin-bottom:20px;">Create Membership Tags and Level</h1>'; echo '<p style="margin-bottom:20px;">'; echo 'Looking for help to understand how to create a membership level or questions about what to input where? ', m4ac_s126v0fexga::m4ac_e_rxkt9u(9495, 'Click Here'); echo '</p>'; echo '<label style="margin-left:0px;">Membership Name:</label>'; echo '<input type="text" name="name" value="" placeholder="Enter Membership Name" required="required" size="25" tabindex="1" style="font-size:150%; margin-top:-10px;"> '; echo '<ul>'; echo '<h3>Tags</h3>'; echo '<li>'; echo '<label><strong style="color:green;">Access Tag</strong> <strong>*</strong></label>'; echo '<input value="" name="main_id" type="text" placeholder="This setting is required" class="requiredtaglistdropdown" required="required" style="width:350px;">'; echo '</li>'; echo '<li>'; echo '<label style="color:green;"><strong>Access List</strong></label>'; echo '<input value="0" type="text" class="listlistdropdown" name="list_id" style="width:300px;">  ', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<li>'; echo '<label style="color:green;"><strong>Add\'l Access Tags</strong></label>'; echo '<select style="width:400px; height:1.6em;" class="tag-selector" name="addltag_ids[]" multiple="multiple" placeholder="Select Additional Tags to Grant Access">'; echo '</select>', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<li>'; echo '<label><strong style="color:red;">Payment Failure (PAYF)</strong></label>'; echo '<input value="0" name="payf_id" type="text" class="taglistdropdown" style="width:350px;">  ', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<li>'; echo '<label><strong style="color:red;">Cancellation (CANC)</strong></label>'; echo '<input value="0" name="cancel_id" type="text" class="taglistdropdown" style="width:350px;">  ', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<li>'; echo '<label><strong style="color:red;">Suspension Tag (SUSP)</strong></label>'; echo '<input value="0" name="suspend_id" type="text" class="taglistdropdown" style="width:350px;">  ', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<hr>'; echo '<h3>Level</h3>'; echo '<li>'; echo '<label>Level</label>'; echo '<input type="number" value="0" name="level" min="0" max="999999" style="text-align:right; width: 80px;">  ', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<hr>'; echo '<h3>Special Pages</h3>'; echo '<li>'; echo '<label>First Login Page</label>'; echo '<input value="0" name="first_login_page" type="text" class="pagelistdropdown" style="width:500px;">  ', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<li>'; echo '<label>Membership Home Page</label>'; echo '<input value="0" name="login_page" type="text" class="pagelistdropdown" style="width:500px;">  ', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<li>'; echo '<label>Membership Logout Page</label>'; echo '<input value="0" name="logout_page" type="text" class="pagelistdropdown" style="width:500px;">  ', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<li>'; echo '<label>PAYF Home Page</label>'; echo '<input value="0" name="payf_homepage" type="text" class="pagelistdropdown" style="width:500px;">  ', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<li>'; echo '<li>'; echo '<label>SUSP Home Page</label>'; echo '<input value="0" name="susp_homepage" type="text" class="pagelistdropdown" style="width:500px;">  ', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<li>'; echo '<li>'; echo '<label>CANC Home Page</label>'; echo '<input value="0" name="canc_homepage" type="text" class="pagelistdropdown" style="width:500px;">  ', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<li>'; echo '<hr>'; echo '<h3>Integrations</h3>'; echo '<li>'; echo '<label>Add WordPress Roles</label>'; echo '<input value="" name="roles[]" type="hidden">'; echo '<select style="width:400px; height:1.6em;" class="roles-selector" name="roles[]" multiple="multiple" placeholder="Select WordPress roles to apply on login">'; echo '<option value="">(None)</option>'; if (empty($m4ac_qb48jahn0kc['roles']) ) { $m4ac_qb48jahn0kc['roles'] = []; } if (is_array($m4ac__mrexf31jzdt) ) { foreach ($m4ac__mrexf31jzdt as $m4ac_cnjvkyitq) { echo '<option value="', $m4ac_cnjvkyitq['id'], '" ', in_array($m4ac_cnjvkyitq['id'], $m4ac_qb48jahn0kc['roles']) ? ' selected="selected" ' : '', '>', $m4ac_cnjvkyitq['name'], '</option>'; } } echo '</select>  ', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<li>'; echo '<label>Set Theme</label>'; echo '<input value="" name="theme" type="text" class="themelistdropdown" style="width:250px;">'; echo '</li>'; do_action('memberium/memberships/edit', $m4ac_qb48jahn0kc); echo '<hr>'; echo '</ul>'; echo '<input type="submit" class="button-primary" value="Create Membership Level">'; echo '</form>'; echo '<p style="margin-bottom:20px;">'; echo 'Looking for help to understand how to create a membership level or questions about what to input where? ', m4ac_s126v0fexga::m4ac_e_rxkt9u(9495, 'Click Here'); echo '</p>'; echo '</div>'; } 
function m4ac_jcsej1aob4() { $m4ac_t3cu9hgt = m4ac_l93s0gxuwfpd(); $m4ac__mrexf31jzdt = m4ac_azr_yv5q8(); $m4ac_l9lbyvw4xaed = memberium_app()->m4ac_ni3dn9fc('array'); $m4ac_qb48jahn0kc = $m4ac_t3cu9hgt[$_GET['id']]; if (is_array($m4ac_qb48jahn0kc) ) { if (! isset($m4ac_qb48jahn0kc['main_id']) ) { $m4ac_qb48jahn0kc['main_id'] = $_GET['id']; }  if (empty($m4ac_qb48jahn0kc['addltag_ids']) ) { $m4ac_qb48jahn0kc['addltag_ids'] = ''; }  echo '<div class="wrap memberium">'; echo '<p>Return to <a href="?page=memberium-memberships">Membership Screen</a></p>'; echo '<form method="post">'; echo '<h1 style="margin-bottom:10px;">Membership Level Editor</h1>'; echo '<label style="margin-left:0px;">Membership Name:</label>'; echo '<input type="text" name="name" value="', $m4ac_qb48jahn0kc['name'], '" required="required" style="font-size:180%; margin-top:-10px;">'; echo '<ul>'; echo '<h3>Tags</h3>'; echo '<li>'; echo '<label style="color:green;"><strong>Access Tag</strong></label>'; echo '<input disabled="disabled" value="', (int) $_GET['id'], '" type="text" class="requiredtaglistdropdown" required="required" style="width:300px;">', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<li>'; echo '<label style="color:green;"><strong>Access List</strong></label>'; echo '<input value="', (int) $m4ac_qb48jahn0kc['list_id'], '" type="text" class="listlistdropdown" name="list_id" style="width:300px;">', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<li>'; echo '<label style="color:green;"><strong>Add\'l Access Tags</strong></label>'; echo '<select name="addltag_ids[]" class="tag-selector" multiple="multiple" placeholder="Select Additional Tags to Grant Access" style="width:400px;height:1.6em;" >'; $m4ac_ouqimb9v_w4g = (empty($m4ac_qb48jahn0kc['addltag_ids']) ) ? [] : explode(',', $m4ac_qb48jahn0kc['addltag_ids']); foreach ($m4ac_ouqimb9v_w4g as $m4ac_rsau1b7dj2lr) { echo '<option value="', $m4ac_rsau1b7dj2lr, '" selected="selected">', $m4ac_l9lbyvw4xaed[$m4ac_rsau1b7dj2lr], '</option>'; } echo '</select>', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<li>'; echo '<label style="color:red;"><strong>Payment Failure</strong></label>'; echo '<input value="', (int) $m4ac_qb48jahn0kc['payf_id'], '" name="payf_id" type="text" class="taglistdropdown" style="width:350px;">',m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<li>'; echo '<label style="color:red;"><strong>Cancellation</strong></label>'; echo '<input value="', (int) $m4ac_qb48jahn0kc['cancel_id'], '" name="cancel_id" type="text" class="taglistdropdown" style="width:350px;">', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<li>'; echo '<label style="color:red;"><strong>Suspension Tag</strong></label>'; echo '<input value="', (int) $m4ac_qb48jahn0kc['suspend_id'], '" name="suspend_id" type="text" class="taglistdropdown" style="width:350px;">', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<hr>'; echo '<h3>Level</h3>'; echo '<li>'; echo '<label>Level</label>'; echo '<input type="number" value="', $m4ac_qb48jahn0kc['level'], '" name="level" min="0" max="999999" required="required" style="text-align:right; width: 80px;">', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<hr>'; echo '<h3>Special Pages</h3>'; echo '<li>'; echo '<label>Home Page Priority</label>'; echo '<input type="number" value="', (int) $m4ac_qb48jahn0kc['login_redirect_priority'], '" name="login_redirect_priority" min="0" max="999999" required="required" style="text-align:right; width: 80px;">', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li>'; echo '<li>'; echo '<label>First Login Page</label>'; echo '<input value="', (int) $m4ac_qb48jahn0kc['first_login_page'], '" name="first_login_page" type="text" class="pagelistdropdown" style="width:500px;">'; echo '</li>'; echo '<li>'; echo '<label>Membership Home Page</label>'; echo '<input value="', $m4ac_qb48jahn0kc['login_page'], '" name="login_page" type="text" class="pagelistdropdown" style="width:500px;">'; echo '</li>'; echo '<li>'; echo '<label>Membership Logout Page</label>'; echo '<input value="', $m4ac_qb48jahn0kc['logout_page'], '" name="logout_page" type="text" class="pagelistdropdown" style="width:500px;">'; echo '</li>'; echo '<li>'; echo '<label>PAYF Home Page</label>'; echo '<input value="', (int) $m4ac_qb48jahn0kc['payf_homepage'] , '" name="payf_homepage" type="text" class="pagelistdropdown" style="width:500px;">'; echo '</li>'; echo '<li>'; echo '<li>'; echo '<label>SUSP Home Page</label>'; echo '<input value="', (int) $m4ac_qb48jahn0kc['susp_homepage'] , '" name="susp_homepage" type="text" class="pagelistdropdown" style="width:500px;">'; echo '</li>'; echo '<li>'; echo '<li>'; echo '<label>CANC Home Page</label>'; echo '<input value="', (int) $m4ac_qb48jahn0kc['canc_homepage'] , '" name="canc_homepage" type="text" class="pagelistdropdown" style="width:500px;">'; echo '</li>'; echo '<li>'; echo '<hr>'; echo '<h3>Integrations</h3>'; echo '<li>'; echo '<label>Add WordPress Roles</label>'; echo '<input value="" name="roles[]" type="hidden">'; echo '<select style="width:400px; height:1.6em;" class="roles-selector" name="roles[]" multiple="multiple" placeholder="Select WordPress roles to apply on login">'; if (empty($m4ac_qb48jahn0kc['roles']) ) { $m4ac_qb48jahn0kc['roles'] = []; } if (is_array($m4ac__mrexf31jzdt) ) { foreach ($m4ac__mrexf31jzdt as $m4ac_cnjvkyitq) { echo '<option value="', $m4ac_cnjvkyitq['id'], '" ', in_array($m4ac_cnjvkyitq['id'], $m4ac_qb48jahn0kc['roles']) ? ' selected="selected" ' : '', '>', $m4ac_cnjvkyitq['name'], '</option>'; } } echo '</select>', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</li><br />'; echo '<li>'; echo '<label>Set Theme</label>'; echo '<input value="', $m4ac_qb48jahn0kc['theme'], '" name="theme" type="text" class="themelistdropdown" style="width:250px;">'; echo '</li>'; do_action('memberium/memberships/edit', $m4ac_qb48jahn0kc); echo '<hr>'; echo '</ul>'; echo '<input type="submit" class="button-primary" value="Update Membership Level">'; echo '</form>'; echo '</div>'; } else { echo '<p>Invalid Membership Id</p>'; } } 
function m4ac_e3o2f6gih_ms() {  $m4ac_t3cu9hgt = m4ac_l93s0gxuwfpd(); $m4ac_t3cu9hgt = empty($m4ac_t3cu9hgt) ? [] : $m4ac_t3cu9hgt; $m4ac_kvuz76c3a = count($m4ac_t3cu9hgt); $m4ac_f8dnpolaceg5 = memberium_app()->m4ac_ni3dn9fc(); $m4ac_f8dnpolaceg5 = $m4ac_f8dnpolaceg5['mc']; echo '<div class="wrap">'; echo '<h1>Memberium Membership Settings</h1>'; echo '<h3>Current Membership Levels', m4ac_s126v0fexga::m4ac_e_rxkt9u(1222), '</h3>'; echo '<div style="width:90%;">'; echo '<p>'; echo 'These are the membership levels you have already set up, click the name of a membership level below to edit it or click the "Create New Membership Level" button to add a new memership level.'; echo '</p>'; echo '<hr />'; echo '<form method="POST" action="">'; echo '<input type="submit" name="main_action" value="Update Levels" style="position:absolute;left:-100%;" />'; echo '<table class="widefat" style="white-space:nowrap;">'; echo '<tr style="background-color:#eee">'; echo '<th style="width:50px;"></th>'; echo '<th style="width:250px;"><strong>Level&nbsp;Name</strong></th>'; echo '<th><strong>Tag</strong></th>'; echo '<th style="width:75px;"><strong>Level</strong></th>'; echo '<th style="width:75px;"><strong>Login Priority</strong></th>'; echo '<th><strong>Homepage</strong></th>'; echo '<th></th>'; echo '</tr>'; if ($m4ac_kvuz76c3a == 0) { echo '<tr><td colspan="99">You have no membership levels created.</td></tr>'; } else { foreach ($m4ac_t3cu9hgt as $m4ac_lj_fwoc5ub1y => $m4ac_qb48jahn0kc) { $m4ac_ocj07nxdy54z = wp_get_theme($m4ac_qb48jahn0kc['theme']); $m4ac_maz5nvkp = get_post($m4ac_qb48jahn0kc['login_page']); $m4ac_zeirgylda1 = empty($m4ac_maz5nvkp->post_title) ? '(Default)' : $m4ac_maz5nvkp->post_title; $m4ac__37l6rhivt2 = $m4ac_qb48jahn0kc['login_page'] > 0 ? ' (' . $m4ac_qb48jahn0kc['login_page'] . ')' : ''; $m4ac_b0zgjo5s4b3 = ! empty($m4ac_f8dnpolaceg5[$m4ac_lj_fwoc5ub1y]['name']) ? $m4ac_f8dnpolaceg5[$m4ac_lj_fwoc5ub1y]['name'] . ' (' . $m4ac_lj_fwoc5ub1y . ')' : '<em>Tag Missing</em>'; $m4ac_b0zgjo5s4b3 = ! empty($m4ac_f8dnpolaceg5[$m4ac_lj_fwoc5ub1y]) ? $m4ac_f8dnpolaceg5[$m4ac_lj_fwoc5ub1y] . ' (' . $m4ac_lj_fwoc5ub1y . ')' : '<em>Tag Missing</em>'; echo '<tr>'; echo '<td><a class="button-secondary" href="?page=', $_GET['page'], '&action=edit&id=', $m4ac_lj_fwoc5ub1y, '">Edit</a></td>'; echo '<td><strong><a href="?page=', $_GET['page'], '&action=edit&id=', $m4ac_lj_fwoc5ub1y, '">', $m4ac_qb48jahn0kc['name'], '</a></strong></td>'; echo '<td>', $m4ac_b0zgjo5s4b3, '</td>'; echo '<td><input type=number min=0 max=99999 maxlength=6 name="level[', $m4ac_lj_fwoc5ub1y, ']" value="', (int) $m4ac_qb48jahn0kc['level'], '" style="width:80px;"></td>'; echo '<td><input type=number min=0 max=99999 maxlength=6 name="login_redirect_priority[', $m4ac_lj_fwoc5ub1y, ']" value="', (int) $m4ac_qb48jahn0kc['login_redirect_priority'], '" style="width:80px;"></td>'; if (is_object($m4ac_maz5nvkp) ) { echo '<td><a href="', get_permalink($m4ac_maz5nvkp->ID), '">', $m4ac_zeirgylda1, $m4ac__37l6rhivt2, '</a></td>'; } else { echo '<td>(Default)</td>'; } echo '<td>', get_submit_button('Delete', 'delete', 'main_action[' . $m4ac_lj_fwoc5ub1y . ']', false); '</td>'; echo '</tr>'; } } unset($m4ac_ocj07nxdy54z); echo '</table>';  echo '<p>';   echo '<a href="?page=memberium-memberships&action=add" class="button-primary">Create New Membership Level</a> &nbsp; '; if (count($m4ac_t3cu9hgt) ) { echo '<input type="submit" name="main_action" value="Update Membership Levels" class="button-primary" />'; } echo '</form>'; echo '<hr />'; } 
function m4ac_vycltfvn74x() {  echo '<h3>Tag Builder Pro</h3>'; echo '<table class="widefat">';  echo '<form method="POST" action="">'; echo '<tr>'; echo '<td>Create Membership Level:</td>'; echo '<td>'; echo '<input name="tag_name" type="text" size="20" /> &nbsp; '; echo '<input type=checkbox name="create_set" value=all /> Include PAYF/SUSP/CANC &nbsp; '; echo '<input type="submit" name="create-membership" value="Create" class="button-primary" /> &nbsp; '; echo m4ac_s126v0fexga::m4ac_e_rxkt9u(8853), '</td>'; echo '</tr>'; echo '</form>';  echo '<form method="POST" action="">'; echo '<tr>'; echo '<td>Create New Tag:</td>'; echo '<td>'; echo '<input name=tag_name type=text size=20 required=required /> &nbsp; '; echo '<input type="submit" name="create-tag" value="Create" class="button-primary" /> &nbsp; '; echo m4ac_s126v0fexga::m4ac_e_rxkt9u(8852), '</td>'; echo '</tr>'; echo '</form>';  echo '<form method="POST" action="">'; echo '<tr>'; echo '<td>Create Drip Tags:</td>'; echo '<td>'; echo '<input name="tag_name" type="text" size="20" required=required /> &nbsp; '; echo 'Start: <input name=start type=number min=1 value=1 max=300 size=3 required=required /> &nbsp; '; echo 'End: <input name=end type=number min=1 value=1 max=300 size=3 required=required/> &nbsp; '; echo '<input type="submit" name="create-tags" value="Create All" class="button-primary" /> &nbsp; '; echo m4ac_s126v0fexga::m4ac_e_rxkt9u(8856), '</td>'; echo '</tr>'; echo '</form>'; echo '</table>'; echo '&nbsp;<br />'; echo '</div>'; echo '</div>'; } 
function m4ac_f1n7gt85phom() { $m4ac_wt42blhcpa = m4ac_ybz6u4j0wx_(); $m4ac_wtwmk0sz = memberium_app()->m4ac_jj97adupw_3v('json'); $m4ac_vbqd27hzsn = m4ac_dkn_5293();  $m4ac_j0e14tousp_ = memberium_app()->m4ac_ni3dn9fc(); $m4ac_j0e14tousp_ = $m4ac_j0e14tousp_['mc']; $m4ac_exjdtlhz_r3f = []; $m4ac_jm7bfqlw = []; $m4ac_exjdtlhz_r3f[] = [ 'id' => 0, 'text' => '(None)' ];  $m4ac__e7d4izu = []; foreach ( (array) $m4ac_j0e14tousp_ as $m4ac_lj_fwoc5ub1y => $tag) { if (! in_array($m4ac_lj_fwoc5ub1y, $m4ac__e7d4izu) ) { $m4ac_exjdtlhz_r3f[] = [ 'id' => $m4ac_lj_fwoc5ub1y, 'text' => $tag . ' (' . $m4ac_lj_fwoc5ub1y . ')' ]; $m4ac_jm7bfqlw[] = [ 'id' => $m4ac_lj_fwoc5ub1y, 'text' => $tag . ' (' . $m4ac_lj_fwoc5ub1y . ')' ]; } } $m4ac_exjdtlhz_r3f = json_encode($m4ac_exjdtlhz_r3f); $m4ac_jm7bfqlw = json_encode($m4ac_jm7bfqlw); unset($m4ac_j0e14tousp_, $m4ac_lj_fwoc5ub1y, $tag); echo '<script>'; echo 'var listlist        = ', $m4ac_wtwmk0sz, ';'; echo 'var themelist       = ', $m4ac_wt42blhcpa, ';'; echo 'var taglist         = ', $m4ac_exjdtlhz_r3f, ';'; echo 'var requiredtaglist = ', $m4ac_jm7bfqlw, ';'; echo 'var pagelist        = ', $m4ac_vbqd27hzsn, ';'; echo '</script>'; } 
function m4ac_asa7v28x1q($admin_class) { global $wpdb; $m4ac__mrexf31jzdt = m4ac_azr_yv5q8(); $m4ac_t3cu9hgt = m4ac_l93s0gxuwfpd();  if (isset($_POST['main_action']) ) { if (! empty($_POST['level']) && is_array($_POST['level']) ) { foreach ($_POST['level'] as $m4ac_ukqvxo6ne7 => $m4ac_ihnr7cyv) { $m4ac_t3cu9hgt[$m4ac_ukqvxo6ne7]['level'] = $m4ac_ihnr7cyv; } } if (! empty($_POST['login_redirect_priority']) && is_array($_POST['login_redirect_priority']) ) { foreach ($_POST['login_redirect_priority'] as $m4ac_ukqvxo6ne7 => $m4ac_ihnr7cyv) { $m4ac_t3cu9hgt[$m4ac_ukqvxo6ne7]['login_redirect_priority'] = $m4ac_ihnr7cyv; } } if (! empty($_POST['main_action']) && is_array($_POST['main_action']) ) { $m4ac_abzku524871 = []; foreach ($_POST['main_action'] as $m4ac_ukqvxo6ne7 => $m4ac_ihnr7cyv) { if ($m4ac_ihnr7cyv == 'Delete') { $admin_class->m4ac_g3ne76s9bjm('Your membership level &ldquo;<strong>' . $m4ac_t3cu9hgt[$m4ac_ukqvxo6ne7]['name'] . '</strong>&rdquo; has been deleted.'); unset($m4ac_t3cu9hgt[$m4ac_ukqvxo6ne7]); $m4ac_abzku524871[] = $m4ac_ukqvxo6ne7; } } $admin_class->m4ac_cw_uroy3na($m4ac_abzku524871); } } if (isset($_GET['id']) && $_GET['id'] && is_array($m4ac_t3cu9hgt[$_GET['id']]) ) { $_POST['addltag_ids'] = (isset($_POST['addltag_ids']) && is_array($_POST['addltag_ids']) ) ? trim(implode(',', $_POST['addltag_ids']), ',') : ''; $m4ac_t3cu9hgt[$_GET['id']]['addltag_ids'] = (empty($_POST['addltag_ids']) ? '' : $_POST['addltag_ids']); $m4ac_t3cu9hgt[$_GET['id']]['canc_homepage'] = (int) $_POST['canc_homepage']; $m4ac_t3cu9hgt[$_GET['id']]['cancel_id'] = isset($_POST['cancel_id']) ? (int) $_POST['cancel_id'] : $m4ac_t3cu9hgt[$_GET['id']]['cancel_id']; $m4ac_t3cu9hgt[$_GET['id']]['first_login_page'] = isset($_POST['first_login_page']) ? (int) $_POST['first_login_page'] : $m4ac_t3cu9hgt[$_GET['id']]['first_login_page']; $m4ac_t3cu9hgt[$_GET['id']]['level'] = ! empty($_POST['level']) ? (int) $_POST['level'] : $m4ac_t3cu9hgt[$_GET['id']]['level']; $m4ac_t3cu9hgt[$_GET['id']]['list_id'] = (int) $_POST['list_id']; $m4ac_t3cu9hgt[$_GET['id']]['login_page'] = isset($_POST['login_page']) ? (int) $_POST['login_page'] : $m4ac_t3cu9hgt[$_GET['id']]['login_page']; $m4ac_t3cu9hgt[$_GET['id']]['login_redirect_priority'] = ! empty($_POST['login_redirect_priority']) ? (int) $_POST['login_redirect_priority'] : $m4ac_t3cu9hgt[$_GET['id']]['login_redirect_priority']; $m4ac_t3cu9hgt[$_GET['id']]['logout_page'] = isset($_POST['logout_page']) ? (int) $_POST['logout_page'] : $m4ac_t3cu9hgt[$_GET['id']]['logout_page']; $m4ac_t3cu9hgt[$_GET['id']]['main_id'] = (int) $_GET['id']; $m4ac_t3cu9hgt[$_GET['id']]['name'] = ! empty($_POST['name']) ? $_POST['name'] : $m4ac_t3cu9hgt[$_GET['id']]['name']; $m4ac_t3cu9hgt[$_GET['id']]['payf_homepage'] = (int) $_POST['payf_homepage']; $m4ac_t3cu9hgt[$_GET['id']]['payf_id'] = isset($_POST['payf_id']) ? (int) $_POST['payf_id'] : $m4ac_t3cu9hgt[$_GET['id']]['payf_id']; $m4ac_t3cu9hgt[$_GET['id']]['susp_homepage'] = (int) $_POST['susp_homepage']; $m4ac_t3cu9hgt[$_GET['id']]['suspend_id'] = isset($_POST['suspend_id']) ? (int) $_POST['suspend_id'] : $m4ac_t3cu9hgt[$_GET['id']]['suspend_id']; $m4ac_t3cu9hgt[$_GET['id']]['roles'] = array_filter(isset($_POST['roles']) ? $_POST['roles'] : $m4ac_t3cu9hgt[$_GET['id']]['roles']); $m4ac_t3cu9hgt[$_GET['id']]['theme'] = isset($_POST['theme']) ? $_POST['theme'] : $m4ac_t3cu9hgt[$_GET['id']]['theme']; $m4ac_t3cu9hgt[$_GET['id']] = apply_filters('memberium_save_membership', $m4ac_t3cu9hgt[$_GET['id']]); $admin_class->m4ac_g3ne76s9bjm('Your membership level &ldquo;<strong>' . $_POST['name'] . '</strong>&rdquo; has been updated.'); } elseif (isset($_POST['action']) && $_POST['action'] == 'add') { if (! empty($_POST['name']) && ! empty($_POST['main_id']) ) { $_POST['addltag_ids'] = is_array($_POST['addltag_ids']) ? trim(implode(',', $_POST['addltag_ids']), ',') : ''; $m4ac_t3cu9hgt[$_POST['main_id']]['addltag_ids'] = $_POST['addltag_ids']; $m4ac_t3cu9hgt[$_POST['main_id']]['canc_homepage'] = (int) $_POST['canc_homepage']; $m4ac_t3cu9hgt[$_POST['main_id']]['cancel_id'] = (int) $_POST['cancel_id']; $m4ac_t3cu9hgt[$_POST['main_id']]['first_login_page'] = (int) $_POST['first_login_page']; $m4ac_t3cu9hgt[$_POST['main_id']]['level'] = (int) $_POST['level']; $m4ac_t3cu9hgt[$_POST['main_id']]['list_id'] = (int) $_POST['list_id']; $m4ac_t3cu9hgt[$_POST['main_id']]['login_page'] = (int) $_POST['login_page']; $m4ac_t3cu9hgt[$_POST['main_id']]['logout_page'] = (int) $_POST['logout_page']; $m4ac_t3cu9hgt[$_POST['main_id']]['main_id'] = (int) $_POST['main_id']; $m4ac_t3cu9hgt[$_POST['main_id']]['name'] = ucwords(trim($_POST['name']) ); $m4ac_t3cu9hgt[$_POST['main_id']]['payf_homepage'] = (int) $_POST['payf_homepage']; $m4ac_t3cu9hgt[$_POST['main_id']]['payf_id'] = (int) $_POST['payf_id']; $m4ac_t3cu9hgt[$_POST['main_id']]['roles'] = (array) $_POST['roles']; $m4ac_t3cu9hgt[$_POST['main_id']]['susp_homepage'] = (int) $_POST['susp_homepage']; $m4ac_t3cu9hgt[$_POST['main_id']]['suspend_id'] = (int) $_POST['suspend_id']; $m4ac_t3cu9hgt[$_POST['main_id']]['theme'] = $_POST['theme'];  $m4ac_aft8kb9qcm = 'Memberium ' . $m4ac_t3cu9hgt[$_POST['main_id']]['name']; $m4ac_cbhno9z3civ1 = sanitize_key('memberium_' . $m4ac_t3cu9hgt[$_POST['main_id']]['name']); $m4ac_cnjvkyitq = get_role($m4ac_cbhno9z3civ1); if (! $m4ac_cnjvkyitq) { add_role($m4ac_cbhno9z3civ1, $m4ac_aft8kb9qcm); } $m4ac_t3cu9hgt[$_POST['main_id']]['roles'] = (array) $_POST['roles']; $m4ac_t3cu9hgt = apply_filters('memberium_save_membership', $m4ac_t3cu9hgt); } else { $admin_class->m4ac_g3ne76s9bjm('Failed to add Membership Level.  Missing Fields'); } } elseif (isset($_POST['action']) && $_POST['action'] == 'Delete') { unset($m4ac_t3cu9hgt[$_POST['membership_id']]); $admin_class->m4ac_g3ne76s9bjm('Your membership level &ldquo;<strong>' . $m4ac_t3cu9hgt[$_POST['membership_id']]['name'] . '</strong>&rdquo; has been deleted.'); } elseif (! empty($_POST['create-tag']) ) {  $m4ac_b0zgjo5s4b3 = trim($_POST['tag_name']); $m4ac_xtcz6bi97flk = 'SELECT count(*) FROM ' . MEMBERIUM_DB_TAGS . ' WHERE appname = %s AND name = %s ;'; $m4ac_xtcz6bi97flk = $wpdb->prepare($m4ac_xtcz6bi97flk, memberium_app()->m4ac_bztk3xj1(), $m4ac_b0zgjo5s4b3); $m4ac_g9fn685ibx = $wpdb->get_var($m4ac_xtcz6bi97flk); if (! $m4ac_g9fn685ibx) { memberium_app()->m4ac_cze9c2qfxou($m4ac_b0zgjo5s4b3); memberium_app()->m4ac_k7c1lfkywtju(); $admin_class->m4ac_g3ne76s9bjm('Your Tag &ldquo;<strong>' . $m4ac_b0zgjo5s4b3 . '</strong>&rdquo; has been created.'); } else { $admin_class->m4ac_g3ne76s9bjm('Your Tag &ldquo;<strong>' . $m4ac_b0zgjo5s4b3 . '</strong>&rdquo; already exists.'); } }  elseif (! empty($_POST['create-membership']) ) { $m4ac_b0zgjo5s4b3 = trim($_POST['tag_name']); $m4ac_ehs3b2jr = (empty($_POST['create_set']) ) ? false : true; $m4ac_xq1hbs7nm = $m4ac_ehs3b2jr ? ['', 'PAYF', 'CANC', 'SUSP'] : ['']; $m4ac_ww61hmlri3p_ = false; $m4ac_j0e14tousp_ = []; foreach ($m4ac_xq1hbs7nm as $m4ac_u4hc21qvby) { $m4ac_j0e14tousp_[] = $m4ac_b0zgjo5s4b3 . $m4ac_u4hc21qvby; } $m4ac_vey53rbv = implode(',', $m4ac_j0e14tousp_); $m4ac_ww61hmlri3p_ = true; $m4ac_gg6yl0o3x = []; memberium_app()->m4ac_cze9c2qfxou($m4ac_vey53rbv); foreach ($m4ac_xq1hbs7nm as $m4ac_u4hc21qvby) { $m4ac_gg6yl0o3x[ 'Tag' . $m4ac_u4hc21qvby] = (int) memberium_app()->m4ac_gbu72zpmi($m4ac_b0zgjo5s4b3 . $m4ac_u4hc21qvby); } if ($m4ac_ww61hmlri3p_) { $m4ac_llpo02hu = [ 'name' => $m4ac_b0zgjo5s4b3, 'main_id' => $m4ac_gg6yl0o3x['Tag'], 'payf_id' => isset($m4ac_gg6yl0o3x['TagPAYF']) ? $m4ac_gg6yl0o3x['TagPAYF'] : 0, 'cancel_id' => isset($m4ac_gg6yl0o3x['TagCANC']) ? $m4ac_gg6yl0o3x['TagCANC'] : 0, 'suspend_id' => isset($m4ac_gg6yl0o3x['TagSUSP']) ? $m4ac_gg6yl0o3x['TagSUSP'] : 0, 'level' => 0, 'roles' => [], 'login_page' => 0, 'first_login_page' => 0, 'logout_page' => 0, 'theme' => '', 'login_redirect_priority' => 0, 'addltag_ids' => '', 'list_id' => 0, 'payf_homepage' => 0, 'susp_homepage' => 0, 'canc_homepage' => 0, ];  $m4ac_aft8kb9qcm = 'Memberium ' . $m4ac_b0zgjo5s4b3; $m4ac_cbhno9z3civ1 = sanitize_key('memberium_' . $m4ac_b0zgjo5s4b3); $m4ac_cnjvkyitq = get_role($m4ac_cbhno9z3civ1); if (! $m4ac_cnjvkyitq) { add_role($m4ac_cbhno9z3civ1, $m4ac_aft8kb9qcm); } $m4ac_llpo02hu['roles'] = [$m4ac_cbhno9z3civ1]; $m4ac_llpo02hu = apply_filters('memberium_save_membership', $m4ac_llpo02hu); $m4ac_t3cu9hgt[$m4ac_gg6yl0o3x['Tag']] = $m4ac_llpo02hu; $admin_class->m4ac_g3ne76s9bjm('Your Membership Tags for &ldquo;<strong>' . $m4ac_b0zgjo5s4b3 . '</strong>&rdquo; and Level have been created.'); } else { $admin_class->m4ac_g3ne76s9bjm('Your Membership Tags for &ldquo;<strong>' . $m4ac_b0zgjo5s4b3 . '</strong>&rdquo; already exist.'); } }  elseif (! empty($_POST['create-tags']) ) { $m4ac_iulgimz5eh1 = trim($_POST['tag_name']); $m4ac_dvrhd74l8u = (int) $_POST['start']; $m4ac_n6lwn5sxcy_t = (int) $_POST['end']; $m4ac_ww61hmlri3p_ = false; $m4ac__xyj24md9ukc = 'SELECT count(*) FROM ' . MEMBERIUM_DB_TAGS . ' WHERE appname = %s AND name = %s ;'; $m4ac_vey53rbv = []; if (false === strpos($m4ac_iulgimz5eh1, '%d') ) { $m4ac_iulgimz5eh1 .= ' %d'; } for ($m4ac_yqah5jzkgcdf = $m4ac_dvrhd74l8u; $m4ac_yqah5jzkgcdf <= $m4ac_n6lwn5sxcy_t; $m4ac_yqah5jzkgcdf++) { $m4ac_vey53rbv[] = sprintf($m4ac_iulgimz5eh1, $m4ac_yqah5jzkgcdf); } memberium_app()->m4ac_cze9c2qfxou(implode(',', $m4ac_vey53rbv) ); $m4ac_ww61hmlri3p_ = true; if ($m4ac_ww61hmlri3p_) { $admin_class->m4ac_g3ne76s9bjm('Your ' . count($m4ac_vey53rbv) . ' Drip Tags for &ldquo;<strong>' . $_POST['tag_name'] . '</strong>&rdquo; have been created.'); } else { $admin_class->m4ac_g3ne76s9bjm('Your Drip Tags for &ldquo;<strong>' . $_POST['tag_name'] . '</strong>&rdquo; already exist.'); } } else { } uasort($m4ac_t3cu9hgt, function ($m4ac_vh1e08li5osg, $m4ac_edo6sya013xv) { if ($m4ac_vh1e08li5osg['level'] == $m4ac_edo6sya013xv['level']) { if ($m4ac_vh1e08li5osg['name'] == $m4ac_edo6sya013xv['name']) { return 0; } return ($m4ac_vh1e08li5osg['name'] < $m4ac_edo6sya013xv['name']) ? -1 : 1; } return ($m4ac_vh1e08li5osg['level'] < $m4ac_edo6sya013xv['level']) ? -1 : 1; }); if (isset($_GET['id'])) { $m4ac_t3cu9hgt = apply_filters('memberium/memberships/save', $m4ac_t3cu9hgt, $_GET['id'], $_POST); } update_option(MEMBERIUM_MEMBERSHIP_SETTINGS, $m4ac_t3cu9hgt, true); $admin_class->m4ac_eyfki_0es(); }