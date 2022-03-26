<?php
/**
 * Copyright (C) 2018-2021 David Bullock
 * Web Power and Light, LLC
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_tcrp5sn4 {  
function m4ac_pjoa65nvi8hg($m4ac_h49jgnxe6r = '', $m4ac_sv5rmko0 = '', $m4ac_x6vpzdgl54 = '', $m4ac_lkc_wr2zfx = '', $m4ac_eqstxh0_cpn = '') { $this->tabs[$m4ac_x6vpzdgl54] = [ 'icon' => $m4ac_h49jgnxe6r, 'label' => $m4ac_sv5rmko0, 'slug' => strtolower(trim($m4ac_x6vpzdgl54) ), 'method' => $m4ac_lkc_wr2zfx, 'post' => $m4ac_eqstxh0_cpn, ]; if (count($this->tabs) == 1) { $this->m4ac_f68ima_0yw($m4ac_x6vpzdgl54); } } 
function m4ac_hyj7iu1vof($m4ac_i8a6nj1oc5hl) { $this->tabs = $m4ac_i8a6nj1oc5hl; } 
function m4ac_zoib4p0s8_1() { return $this->tabs; } 
function m4ac_iys9oz61a($m4ac_odl7scvn0u = '') { $this->headers[] = $m4ac_odl7scvn0u; } 
function m4ac_f68ima_0yw($m4ac_x6vpzdgl54 = '') { $m4ac_x6vpzdgl54 = strtolower(trim($m4ac_x6vpzdgl54) ); if (array_key_exists($m4ac_x6vpzdgl54, $this->tabs) ) { $this->default = $m4ac_x6vpzdgl54; return true; } return false; } 
function m4ac_lgfsc19jo3_r() { if (empty($this->tabs) ) { return; } $m4ac_rlcs0yj3fk1 = $this->m4ac_v_76k98imv23(); if ($this->tabs[$m4ac_rlcs0yj3fk1]['post']) { $this->m4ac_s_cyph2lo($this->tabs[$m4ac_rlcs0yj3fk1]['post']); } m4ac_s126v0fexga::m4ac_e6yihrptl(); echo '<div class="wrap about-wrap memberium">'; foreach($this->headers as $m4ac_nim3h6d1g) { echo $this->m4ac_s_cyph2lo($m4ac_nim3h6d1g); } echo '</div>'; echo '<div class="wrap">';  echo '<h4 class="nav-tab-wrapper">'; foreach ($this->tabs as $m4ac_x6vpzdgl54 => $m4ac_t0u8143ngdq) { $m4ac_eohq7wvlb0i = 'nav-tab'; $m4ac_eohq7wvlb0i .= ($m4ac_t0u8143ngdq['slug'] == $m4ac_rlcs0yj3fk1) ? ' nav-tab-active' : ''; if ($m4ac_t0u8143ngdq['slug'] == $m4ac_rlcs0yj3fk1) { echo "<span class='{$m4ac_eohq7wvlb0i}'><i class='{$m4ac_t0u8143ngdq['icon']}'></i> {$m4ac_t0u8143ngdq['label']}</span>"; } else { echo "<a class='{$m4ac_eohq7wvlb0i}' href='?page={$_GET['page']}&tab={$m4ac_t0u8143ngdq['slug']}'><i class='{$m4ac_t0u8143ngdq['icon']}'></i> {$m4ac_t0u8143ngdq['label']}</a>"; } } echo '</h4>'; echo '<div class="tabcontent" style="margin-top:10px;">'; echo $this->m4ac_s_cyph2lo($this->tabs[$m4ac_rlcs0yj3fk1]['method']); echo '</div>'; } 
function m4ac_v_76k98imv23() { $this->current_tab = isset($_GET['tab']) ? strtolower($_GET['tab']) : $this->default; if (! array_key_exists($this->current_tab, $this->tabs) ) { $this->current_tab = $this->default; } return $this->current_tab; } private 
function m4ac_s_cyph2lo($m4ac_odl7scvn0u = false) { if (! empty($m4ac_odl7scvn0u) ) { if (is_array($m4ac_odl7scvn0u) ) { if (method_exists($m4ac_odl7scvn0u[0], $m4ac_odl7scvn0u[1]) ) { return call_user_func_array($m4ac_odl7scvn0u, [] ); } else { echo '<p><span style="font-weight:bold;color:red;">Error:  </span>  ', $m4ac_odl7scvn0u[0], '->', $m4ac_odl7scvn0u[1], ' not found</p>'; } } elseif (is_string($m4ac_odl7scvn0u) ) { if (function_exists($m4ac_odl7scvn0u) ) { return call_user_func($m4ac_odl7scvn0u); } elseif (file_exists($m4ac_odl7scvn0u) ) { include_once($m4ac_odl7scvn0u); } else { echo $m4ac_odl7scvn0u; } } } } 
function __construct() { } private $tabs = []; private $headers = []; private $default = ''; private $current_tab = '';  } }
