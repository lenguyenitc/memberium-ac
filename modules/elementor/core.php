<?php
/**
* Copyright (c) 2018-2021 David J Bullock
* Web Power and Light
*/

 if (! defined( 'ABSPATH' ) ) { die(); }  if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_flc2waesp { 
function m4ac_mhmiqn5l1(){ add_action('wpal/block/access/init', [$this, 'm4ac_w07mrqh2sxlp']); } 
function m4ac_w07mrqh2sxlp(){  add_action( 'elementor/element/after_section_end', [$this, 'm4ac_r0snw1zjld9'], 10, 2 );  add_action( 'elementor/editor/before_enqueue_scripts', [$this, 'm4ac_pq3az06tpxy'] );  if ( is_admin() && ! wp_doing_ajax() ) { return; } add_action( 'template_redirect', [ $this, 'm4ac_tpdcsg7urxhb' ], PHP_INT_MAX ); }    
function m4ac_wxodvum9bt(){ static $m4ac_bzsuwaqev = null; if( is_null($m4ac_bzsuwaqev) ){ include_once __DIR__ . '/' . 'frontend.php'; $m4ac_bzsuwaqev = m4ac_rsn24b38gcp::m4ac_zw_dhmca(); } return $m4ac_bzsuwaqev; } 
function m4ac_tpdcsg7urxhb(){ $m4ac__vzu1lnrwgp = \Elementor\Plugin::instance(); if ( $m4ac__vzu1lnrwgp->editor->is_edit_mode() ) { return; } if ( $m4ac__vzu1lnrwgp->preview->is_preview_mode() ) { return; } if( !empty($_GET['action']) && $_GET['action'] === 'elementor' ){ return; }  remove_action( 'elementor/element/after_section_end', [$this, 'm4ac_r0snw1zjld9'], 10 );  $this->m4ac_wxodvum9bt(); }    
function m4ac_d2g8isult(){ static $m4ac_bnemsgoy8r = null; if( is_null($m4ac_bnemsgoy8r) ){ include_once __DIR__ . '/' . 'editor.php'; $m4ac_bnemsgoy8r = m4ac_c7h1x8e5zif::m4ac_zw_dhmca(); } return $m4ac_bnemsgoy8r; } 
function m4ac_r0snw1zjld9( $m4ac_xki0g4o7uem, $m4ac_ikie3ubxldh ){ if ( 'section_advanced' === $m4ac_ikie3ubxldh || '_section_style' === $m4ac_ikie3ubxldh ) { $this->m4ac_d2g8isult()->m4ac_t93m206endj( $m4ac_xki0g4o7uem, $m4ac_ikie3ubxldh ); } } 
function m4ac_pq3az06tpxy(){ $this->m4ac_d2g8isult()->m4ac_wcael1z6(); }  private 
function __construct(){} static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = null; return is_null($m4ac_u4tpxcro19) ? new self : $m4ac_u4tpxcro19; } } }
