<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { 
class m4ac_u_e8lxq9 { static 
function activate($m4ac_d2s9mi0r4) { global $wpdb; $m4ac_bryzewbvhl = 'utf8'; $m4ac_s9s75q0em = 'utf8_unicode_ci'; $m4ac_p80burja5 = $m4ac_d2s9mi0r4->m4ac_nrln4kv906()['entry_table']; if (! empty($m4ac_p80burja5) ) { require_once ABSPATH . 'wp-admin/includes/upgrade.php'; $m4ac_xtcz6bi97flk = "CREATE TABLE {$m4ac_p80burja5} (\n" . "id int(11) NOT NULL AUTO_INCREMENT, \n" . "start_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, \n" . "end_time timestamp DEFAULT 0, \n" . "contact_id int(11) NOT NULL, \n" . "user_id int(11) NOT NULL, \n" . "object_id int(11) NOT NULL, \n" . "event_type varchar(24) NOT NULL, \n" . "ip_address varchar(50) NOT NULL, \n" . "method varchar(12) NOT NULL, \n" . "language varchar(12) NOT NULL, \n" . "request_uri varchar(128) NOT NULL, \n" . "token varchar(64) NOT NULL, \n" . "user_agent varchar(128) NOT NULL, \n" . "notes longtext NOT NULL, \n" . "KEY start_time (start_time), \n" . "KEY contact_id (contact_id), \n" . "KEY object_id (object_id), \n" . "KEY token (token), \n" . "PRIMARY KEY  (id) \n" . ") ENGINE=InnoDB DEFAULT CHARSET={$m4ac_bryzewbvhl} COLLATE={$m4ac_s9s75q0em};"; dbDelta($m4ac_xtcz6bi97flk); } } } }
