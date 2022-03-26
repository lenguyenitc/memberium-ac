<?php
/**
 * Copyright (c) 2018-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_jekx0t9lfyu {  static 
function m4ac_yzun0apb(string $m4ac_awyb6xagu4 = '', $m4ac_md7c8zsu2o = NULL) { $m4ac_xnaz4_ir7 = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2); $m4ac_ixteyr6q = $m4ac_xnaz4_ir7[0]['file']; $m4ac_n_45s2wtb3ou = $m4ac_xnaz4_ir7[0]['line']; $m4ac_b5uacij3nhfe = function_exists($m4ac_xnaz4_ir7[1]['function']) ? $m4ac_xnaz4_ir7[1]['function'] : ''; global $user; if (isset($_GET['doing_wp_cron']) || is_admin() ) { return; } $m4ac_z6z25jho3_ = $_SERVER['REMOTE_ADDR'] . '::' . isset($_SERVER['REQUEST_TIME_FLOAT']) ? $_SERVER['REQUEST_TIME_FLOAT'] : $_SERVER['REQUEST_TIME']; $m4ac_pa2k7635qor = $m4ac_z6z25jho3_ . ' :: ' . microtime(true) . ' :: ' . (function_exists('get_current_user_id') ? get_current_user_id() : 0); if (function_exists('current_filter') ) { $m4ac_pa2k7635qor .= ' :: ' . current_filter(); } $m4ac_pa2k7635qor .= ' :: '; $m4ac_pa2k7635qor .= basename($m4ac_ixteyr6q) . ' -> ' . $m4ac_b5uacij3nhfe . ' -> ' . $m4ac_n_45s2wtb3ou . " :: "; if (isset($m4ac_md7c8zsu2o) ) { $m4ac_pa2k7635qor .= $m4ac_awyb6xagu4 . ' = '; if (is_array($m4ac_md7c8zsu2o) || is_object($m4ac_md7c8zsu2o) ) { $m4ac_pa2k7635qor .= print_r($m4ac_md7c8zsu2o, true); } elseif (is_bool($m4ac_md7c8zsu2o) ) { $m4ac_pa2k7635qor .= $m4ac_md7c8zsu2o ? 'True' : 'False'; } else { $m4ac_pa2k7635qor .= $m4ac_md7c8zsu2o; } } else { $m4ac_pa2k7635qor .= $m4ac_awyb6xagu4; } $m4ac_pa2k7635qor .= "\n"; if (MEMBERIUM_DEBUGLOG == 'error_log:') { error_log($m4ac_pa2k7635qor); } elseif (MEMBERIUM_DEBUGLOG > '') { file_put_contents(MEMBERIUM_DEBUGLOG, $m4ac_pa2k7635qor, FILE_APPEND); } else { echo nl2br($m4ac_pa2k7635qor); } } } }
