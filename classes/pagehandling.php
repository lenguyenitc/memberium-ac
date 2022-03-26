<?php
/**
 * Copyright (c) 2018-2021 David J Bullock
 * Web Power and Light, LLC
 * https://webpowerandlight.com
 * support@webpowerandlight.com
 *
 */

 if (class_exists('m4ac_c6rqypiacz4') ) {  final 
class m4ac_mym496l81v {  static 
function m4ac__ytcflhq73() { static $m4ac_ahve5j6ap = false; if (! $m4ac_ahve5j6ap) { $m4ac_ahve5j6ap = true; if (! defined('LSCACHE_NO_CACHE') ) { define('LSCACHE_NO_CACHE', true); } if (! defined('DONOTCACHEPAGE')) { define('DONOTCACHEPAGE', true); } if (! headers_sent()) { header('X-Cache-Enabled: False'); header('X-Memberium-Caching: Plugin Caching Hinted Off'); } } } static 
function m4ac_m5yvtnl_qd4() { $m4ac_trpt5j47fod8 = defined('MEMBERIUM_DISABLE_CACHING') && MEMBERIUM_DISABLE_CACHING == true; $m4ac_trpt5j47fod8 = $m4ac_trpt5j47fod8 || wp_doing_ajax(); if ($m4ac_trpt5j47fod8 || (! is_user_logged_in() ) ) { return; } self::m4ac__ytcflhq73(); if (! headers_sent() ) { header('Cache-Control: no-cache, max-age=0, must-revalidate, no-store'); header('Pragma: no-cache'); header('Expires: 0'); nocache_headers(); } }  static 
function m4ac_e0yeql2bpv() { static $m4ac_amkl4yge2xba = false; if (self::$m4ac_uc1mw5ve) { return; } self::$m4ac_uc1mw5ve = true; if ($m4ac_amkl4yge2xba) { return; } self::m4ac_m5yvtnl_qd4();  if (! empty($_SERVER['HTTP_X_VARNISH']) ) { return; } if (defined('WPE_DISABLE_CACHE_PURGING') ) { if (! headers_sent() ) { $m4ac_pzocy3nw = 'wordpress_logged_in_' . md5($_SERVER['REMOTE_ADDR']); $m4ac_pzocy3nw = 'wordpress_logged_in_cachebuster'; $m4ac_ihnr7cyv = 'memberium%40cachebuster%7C' . time() . '%7C' . sha1($m4ac_pzocy3nw) . '%7C' . sha1(time() ); $m4ac_cvfszt76e = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'; if (function_exists('is_user_logged_in')) { if (! is_user_logged_in() && did_action('set_current_user')) { setcookie($m4ac_pzocy3nw, $m4ac_ihnr7cyv, 0, '/', '', $m4ac_cvfszt76e, true); $m4ac_amkl4yge2xba = true; } elseif (is_user_logged_in() ) { setcookie($m4ac_pzocy3nw, null, 0, '/'); } } } } } static 
function m4ac_c_8sq5i2a3() { return ! self::$m4ac_uc1mw5ve; } private static $m4ac_uc1mw5ve = false;  } }
