<?php
/**
* Copyright (c) 2018-2021 David J Bullock
* Web Power and Light
*/

 if (! defined( 'ABSPATH' ) ) { die(); }  if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_eji813dsp06 { 
function m4ac_mhmiqn5l1(){ add_action('wpal/block/access/init', [$this, 'm4ac_w07mrqh2sxlp']); } 
function m4ac_w07mrqh2sxlp(){ add_action('et_builder_modules_loaded', [$this, 'm4ac_p31_7rlix6hf'], PHP_INT_MAX ); add_action('admin_enqueue_scripts', [$this, 'm4ac_nzsutk5hm84']); } 
function m4ac_p31_7rlix6hf(){ if( is_admin() || isset($_GET['et_fb']) ){ $this->m4ac_d2g8isult()->m4ac_w07mrqh2sxlp(); } else{ $this->m4ac_wxodvum9bt()->m4ac_w07mrqh2sxlp(); } }  
function m4ac_nzsutk5hm84( $m4ac_m0ed2libwkf1 ){ if ( in_array($m4ac_m0ed2libwkf1, ['edit.php','post-new.php','post.php']) ){ wp_enqueue_style('select2css_divi', plugin_dir_url(__FILE__) . 'select2_divi.css', false, '1.0.5', 'all'); } } 
function m4ac_d2g8isult(){ static $elf_editor = null; if( is_null($elf_editor) ){ include_once __DIR__ . '/' . 'editor.php'; $elf_editor = m4ac_nkjcf17dwe_::m4ac_zw_dhmca(); } return $elf_editor; } 
function m4ac_wxodvum9bt(){ static $m4ac_bzsuwaqev = null; if( is_null($m4ac_bzsuwaqev) ){ include_once __DIR__ . '/' . 'frontend.php'; $m4ac_bzsuwaqev = m4ac_am9vithl::m4ac_zw_dhmca(); } return $m4ac_bzsuwaqev; }  private 
function __construct(){} static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = null; return is_null($m4ac_u4tpxcro19) ? new self : $m4ac_u4tpxcro19; } } }
