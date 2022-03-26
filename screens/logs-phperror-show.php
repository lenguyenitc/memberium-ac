<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_f5ovcw_1iln')) { 
class m4ac_gu63tkgd0hi { static 
function m4ac_g87a0h14i() { $m4ac_q7wsjnfa = ini_get('error_log'); $m4ac_dvrhd74l8u = empty($_GET['start']) ? 0 : (int) $_GET['start']; $m4ac_pzu0qml48 = empty($_GET['length']) ? 0.1 : (int) $_GET['length']; echo '<h3>PHP Error Log</h3>'; if (! empty($m4ac_q7wsjnfa) ) { if (file_exists($m4ac_q7wsjnfa) ) { $m4ac_igkif2xm67 = ceil(filesize($m4ac_q7wsjnfa) / MB_IN_BYTES); $m4ac_a0_ngly9c = (0 - min(filesize($m4ac_q7wsjnfa), MB_IN_BYTES) ); echo '<textarea style="width:80%" rows="20">'; echo file_get_contents($m4ac_q7wsjnfa, false, NULL, $m4ac_a0_ngly9c); echo '</textarea><br />'; echo '<p>Showing last 1MB of error logs</p>'; echo '<p>Log Location:  ', $m4ac_q7wsjnfa, '</p>'; echo '<p>Total Error Log Length:  ', $m4ac_igkif2xm67, 'MB</p>'; } else { echo '<p>Error log defined, but not found.</p>'; } } else { echo '<p>Error Logging not enabled in PHP</p>'; } } static 
function m4ac_lgfsc19jo3_r() { self::m4ac_g87a0h14i(); } private 
function __construct() {} } m4ac_gu63tkgd0hi::m4ac_lgfsc19jo3_r(); }
