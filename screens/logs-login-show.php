<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_f5ovcw_1iln')) { 
class m4ac_pafgodtnqx9e { private static 
function m4ac_sseo86cw4() { global $wpdb; $m4ac_lmfaycbp_ot = empty($_GET['limit']) ? 15 : (int) trim($_GET['limit']); $m4ac_dvrhd74l8u = empty($_GET['start']) ? 0 : (int) trim($_GET['start']); $m4ac_nmf72t01 = empty($_GET['name']) ? '' : strtolower(trim ($_GET['name']) ); $m4ac_zyd9o3v4sz = empty($_GET['ip']) ? '' : trim($_GET['ip']); $m4ac_h57xqitcp = memberium_app()->m4ac_bztk3xj1(); $m4ac_jouqjei9gbc3 = MEMBERIUM_DB_LOGINLOG; $m4ac_ofd6sp_0 = ''; $m4ac_ofd6sp_0 .= empty($m4ac_nmf72t01) ? '' : " AND `username` LIKE '%" . $wpdb->esc_like($m4ac_nmf72t01) . "%' "; $m4ac_ofd6sp_0 .= empty($m4ac_zyd9o3v4sz) ? '' : " AND `ipaddress` LIKE '%" . $wpdb->esc_like($m4ac_zyd9o3v4sz) . "%' "; $m4ac_xtcz6bi97flk = "SELECT `logintime`, `ipaddress`, `username` FROM `{$m4ac_jouqjei9gbc3}` WHERE `appname` = '{$m4ac_h57xqitcp}' {$m4ac_ofd6sp_0} ORDER BY `id` DESC LIMIT {$m4ac_lmfaycbp_ot} ;"; $m4ac_x_1sx47rpefc = $wpdb->get_results($m4ac_xtcz6bi97flk, ARRAY_A); if (! is_array($m4ac_x_1sx47rpefc) || empty($m4ac_x_1sx47rpefc) ) { echo '<p>The login log is empty.</p>'; } else { $wp_timezone = get_option('timezone_string'); $original_timezone = date_default_timezone_get(); $geo = []; if (! empty($wp_timezone)) { date_default_timezone_set($wp_timezone); } echo '<table class="widefat">'; echo '<tr>'; echo '<td width="150">Login Time</td>'; echo '<td width="125">IP Address</td>'; echo '<td>Username</td>'; echo '<td>Location</td>'; echo '</tr>'; foreach($m4ac_x_1sx47rpefc as $row) { $ip = $row['ipaddress']; if (! isset($geo[$ip]) ) { $geo[$ip] = m4ac_xocn42gpf7d::m4ac__ovj3y9l($ip); } echo '<tr>'; echo '<td>', date('Y-m-d H:i:s', $row['logintime']), '</td>'; echo '<td><a href="https://geoiptool.com/en/?ip=' . $row['ipaddress'] . '" target="geoip">', $row['ipaddress'], '</a></td>'; echo '<td>', $row['username'], '</td>'; echo '<td>'; if (! empty($geo[$ip]['latitude']) ) { echo '<a target="map" href="https://www.google.com.au/maps/@', $geo[$ip]['latitude'], ',', $geo[$ip]['longitude'], ',13z">'; echo '<em class="fa fa-map-marker"></em> '; echo '</a>&nbsp;'; } if (isset($geo[$ip]) && is_array($geo[$ip]) ) { if (isset($geo[$ip]['city']) ) { echo $geo[$ip]['city'], ', ', $geo[$ip]['region_name'], ' ', $geo[$ip]['country_name']; } } else { echo '<em>Unknown</em>'; } echo '</td>'; echo '</tr>'; } date_default_timezone_set($original_timezone); echo '</table>'; } echo '<form method="get" style="margin-top:12px;display:inline-block;">'; echo '<input type="hidden" name="page" value="memberium-logs">'; echo "Username: <input type='text' name='name' value='{$m4ac_nmf72t01}' placeholder='Username'>"; echo "IP Address: <input type='text' name='ip' value='{$m4ac_zyd9o3v4sz}' placeholder='IP Address'>"; echo "Limit: <input type='text' name='limit' value='{$m4ac_lmfaycbp_ot}' placeholder='# Results'>"; echo '<input type="submit" value="Search" class="button-primary" style="margin-left:15px;">'; echo '</form>'; echo '<form method="post">'; echo '<input type="hidden" name="page" value="memberium-logs">'; echo '<input type="hidden" name="tab" value="login"><br />'; echo '<input type="submit" name="delete_login_log" value="Delete Log" class="button delete">'; echo '</form>'; } private static 
function m4ac__w5qavdh8() { global $wpdb; $m4ac_jouqjei9gbc3 = MEMBERIUM_DB_LOGINLOG; $m4ac_xtcz6bi97flk = "DELETE FROM `{$m4ac_jouqjei9gbc3}` WHERE 1 = 1;"; $wpdb->query($m4ac_xtcz6bi97flk); } static 
function m4ac_lgfsc19jo3_r() { if (current_user_can('manage_options') ) { if ($_SERVER['REQUEST_METHOD'] == 'POST') { if (! empty($_POST['logpurge']) ) { self::m4ac__w5qavdh8(); } } self::m4ac_sseo86cw4(); } } private 
function __construct() {} } m4ac_pafgodtnqx9e::m4ac_lgfsc19jo3_r(); }