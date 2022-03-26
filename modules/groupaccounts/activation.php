<?php
/**
 * Copyright (c) 2020 David J Bullock
 * Web Power and Light
 */

 if (! defined('ABSPATH') ) { die(); } final 
class m4ac_cv4qfzco2k { static 
function m4ac_u0q7g4ejd8() { $m4ac_ur05d8bo = get_option('memberium/groupaccounts/version', 0); if ($m4ac_ur05d8bo < m4ac_fxpbyk36nrs::VERSION) { self::m4ac__1xhns3la9p(); } } private static 
function m4ac__1xhns3la9p() { global $wpdb; require_once ABSPATH . 'wp-admin/includes/upgrade.php'; $m4ac_p80burja5 = "{$wpdb->prefix}memberium_groupaccount_members"; $m4ac_xtcz6bi97flk = "CREATE TABLE {$m4ac_p80burja5} (\n" . "id int(11) NOT NULL AUTO_INCREMENT, \n" . "parent_uid int(11) NOT NULL, \n" . "child_uid int(11) NOT NULL, \n" . "time_added timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, \n" . "parent_updated timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, \n" . "active int(11) NOT NULL, \n" . "KEY parent_uid (parent_uid), \n" . "KEY child_uid (child_uid), \n" . "KEY active (active), \n" . "UNIQUE KEY pkey (parent_uid,child_uid), \n" . "PRIMARY KEY  (id) \n" . ") ENGINE=InnoDB;"; dbDelta($m4ac_xtcz6bi97flk); update_option('memberium/groupaccounts/version', m4ac_fxpbyk36nrs::VERSION, true); } }
