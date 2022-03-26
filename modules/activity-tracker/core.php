<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_nlg2b5n8m31 { const VERSION = 2; private $m4ac_b7_c3kyi = []; 
function m4ac_lx4jv6fi7k() { return self::VERSION; } 
function m4ac_oe1mp5wkiux() { global $wpdb; $m4ac_b7_c3kyi = get_option('memberium/activity-tracker/config', []); $m4ac_wdl2r3x6jg = [ 'initialized' => 0, 'entry_table' => $wpdb->prefix . 'memberium_activity_tracker', ]; $this->m4ac_b7_c3kyi = wp_parse_args($m4ac_b7_c3kyi, $m4ac_wdl2r3x6jg); $this->m4ac_b7_c3kyi['version'] = self::VERSION; $this->m4ac_b7_c3kyi['updated'] = (int) (serialize($this->m4ac_b7_c3kyi) <> serialize($m4ac_b7_c3kyi)); if (serialize($this->m4ac_b7_c3kyi) <> serialize($m4ac_b7_c3kyi) ) { $this->m4ac_wqhj83z2($this->m4ac_b7_c3kyi); } return $this->m4ac_b7_c3kyi; } 
function m4ac_nrln4kv906() { if (! $this->m4ac_b7_c3kyi) { $this->m4ac_b7_c3kyi = $this->m4ac_oe1mp5wkiux(); } return $this->m4ac_b7_c3kyi; } 
function m4ac_wqhj83z2($m4ac_b7_c3kyi) { $this->m4ac_b7_c3kyi = $m4ac_b7_c3kyi; update_option('memberium/activity-tracker/config', $m4ac_b7_c3kyi); } 
function m4ac_e1uce38m() { global $wpdb; $m4ac_jouqjei9gbc3 = $this->m4ac_nrln4kv906()['database']; $m4ac_dkfx90t_d1ih = date('Y-m-d H:i:s', time() - (86400 * 90) ); $m4ac_xtcz6bi97flk = "DELETE FROM `{$m4ac_jouqjei9gbc3}` WHERE `start_time` < '{$m4ac_dkfx90t_d1ih}';"; $wpdb->query($m4ac_xtcz6bi97flk); } 
function m4ac_rh6ijntd() { add_action('memberium/activity_tracker/cron', [$this, 'm4ac_e1uce38m']); if (! wp_next_scheduled('memberium/activity_tracker/cron') ) { $m4ac_pmpqou_7zg = time() + 900; wp_schedule_event($m4ac_pmpqou_7zg, 'twicedaily', 'memberium/activity_tracker/cron'); } } private 
function m4ac_w_gxa1s9() { $this->m4ac_nrln4kv906(); $this->m4ac_rh6ijntd(); if (is_admin() ) { include_once __DIR__ . '/admin.php'; new m4ac_t7tfsiyrj6_5($this); } else { include_once __DIR__ . '/frontend.php'; new m4ac__qk06fim9t3($this); } } private 
function __construct() { if (! m4ac_tl5skz6cfptr::m4ac_efe5yorv(['unlimited']) ) { return; } return; $this->m4ac_w_gxa1s9(); } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; } } }
