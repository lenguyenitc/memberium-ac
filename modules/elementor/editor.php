<?php
/**
 * Copyright (c) 2018-2021 David J Bullock
 * Web Power and Light
*/

 if (! defined( 'ABSPATH' ) ) { die(); }  if (class_exists('m4ac_c6rqypiacz4') ) { 
class m4ac_c7h1x8e5zif { public $slug = 'elementor'; public $version = '1.1.0';  public $to_json = [];  public $omitted_blocks = [];  public $ns = '';  public $prefix = '';  public $I18n = '';  public $access_class;  private 
function __construct(){} static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = null; if(is_null($m4ac_u4tpxcro19)){ $m4ac_u4tpxcro19 = new self; $m4ac_u4tpxcro19->access_class = m4ac_rntik2rdq0::m4ac_zw_dhmca(); $m4ac_u4tpxcro19->prefix = $m4ac_u4tpxcro19->access_class::PREFIX; $m4ac_u4tpxcro19->ns = $m4ac_u4tpxcro19->access_class::NS; $m4ac_u4tpxcro19->m4ac_w07mrqh2sxlp(); } return $m4ac_u4tpxcro19; } 
function m4ac_w07mrqh2sxlp() { add_filter("{$this->ns}/{$this->slug}/editor/control/args", [$this, 'm4ac_rih78n_py'], 10, 5 );  $m4ac_n_j31z9qsv = $this->access_class->m4ac_hrc7dpu9j(); $this->I18n = $m4ac_n_j31z9qsv->m4ac_up3uovdq_ib7( false, $this->slug ); $this->to_json['WPAL_BLOCKS_PREFIX'] = $this->prefix; $this->to_json['WPAL_BLOCKS_KEYS_REMOVED_TEXT'] = $this->I18n['keys_removed_text']; $this->to_json['controls'] = $m4ac_n_j31z9qsv->m4ac_buapm02l_8dx($this->slug);  $this->to_json['tags'] = $m4ac_n_j31z9qsv->m4ac_ni3dn9fc();  $this->omitted_blocks = apply_filters("{$this->ns}/{$this->slug}/settings/omitted_blocks", ['column']); } 
function m4ac_wcael1z6() { $m4ac_hakbo4tlcx2_ = plugin_dir_url(__FILE__); wp_enqueue_style('wpal-blocks-elementor-editor', "{$m4ac_hakbo4tlcx2_}/editor.css", [], $this->version, 'all'); wp_enqueue_script('wpal-blocks-elementor-editor', "{$m4ac_hakbo4tlcx2_}/editor.js", ['jquery'], $this->version, true); wp_localize_script('wpal-blocks-elementor-editor', 'wpale_params', $this->to_json); } 
function m4ac_t93m206endj( $m4ac_xki0g4o7uem, $m4ac_ikie3ubxldh ){ if( in_array($m4ac_xki0g4o7uem->get_type(), $this->omitted_blocks) ){ return; } $m4ac_se0rlu1358j = $this->to_json['controls']; if ( ! $m4ac_se0rlu1358j || empty($m4ac_se0rlu1358j) ) { return; }  $m4ac_xki0g4o7uem->start_controls_section( 'wpal-blocks', [ 'label' => $this->I18n['settings_title'], 'tab' => \Elementor\Controls_Manager::TAB_ADVANCED ] ); foreach ( $m4ac_se0rlu1358j as $m4ac_llc9w_f1tk6z => $m4ac_k4zrbefq2ps5 ) { $m4ac_ss6bwxopg8 = isset($m4ac_k4zrbefq2ps5['type']) ? $this->m4ac_nmo7us16l( $m4ac_k4zrbefq2ps5['type'] ) : false; $m4ac_pzocy3nw = isset($m4ac_k4zrbefq2ps5['name']) ? $m4ac_k4zrbefq2ps5['name'] : false; if ( $m4ac_pzocy3nw && $m4ac_ss6bwxopg8 ){ $m4ac_ce1kgncadr5 = [ 'label' => isset($m4ac_k4zrbefq2ps5['label']) ? $m4ac_k4zrbefq2ps5['label'] : false, 'type' => $m4ac_ss6bwxopg8 ];  $m4ac_apwqumvj9f = ['default', 'description', 'options', 'label_on', 'label_off', 'return_value', 'multiple', 'rows', 'separator', 'placeholder']; foreach ($m4ac_apwqumvj9f as $m4ac_qbjmklz9u => $m4ac_wvedziauxc) { if ( isset($m4ac_k4zrbefq2ps5[$m4ac_wvedziauxc]) ){ $m4ac_ce1kgncadr5[$m4ac_wvedziauxc] = $m4ac_k4zrbefq2ps5[$m4ac_wvedziauxc]; } } $m4ac_ce1kgncadr5 = apply_filters( "{$this->ns}/elementor/editor/control/args", $m4ac_ce1kgncadr5, $m4ac_pzocy3nw, $m4ac_xki0g4o7uem, $m4ac_ikie3ubxldh ); $m4ac_xki0g4o7uem->add_control( $m4ac_pzocy3nw, $m4ac_ce1kgncadr5 ); } }  $m4ac_xki0g4o7uem->end_controls_section(); }  
function m4ac_nmo7us16l( string $m4ac_ss6bwxopg8 = '' ){ $m4ac_ss6bwxopg8 = !empty($m4ac_ss6bwxopg8) ? strtolower( $m4ac_ss6bwxopg8 ) : $m4ac_ss6bwxopg8; if( $m4ac_ss6bwxopg8 === 'checkbox' ){ return \Elementor\Controls_Manager::SWITCHER; } else if( $m4ac_ss6bwxopg8 === 'select2' || $m4ac_ss6bwxopg8 === 'text' ){ return \Elementor\Controls_Manager::TEXT; } else if( $m4ac_ss6bwxopg8 === 'textarea' ){ return \Elementor\Controls_Manager::TEXTAREA; } return false; }  
function m4ac_rih78n_py($m4ac_ce1kgncadr5, $m4ac_pzocy3nw, $m4ac_xki0g4o7uem, $m4ac_ikie3ubxldh) { if ( $m4ac_pzocy3nw === "{$this->prefix}_loggedin" ){ $m4ac_ce1kgncadr5['separator'] = 'before'; } if ( $m4ac_pzocy3nw === "{$this->prefix}_access_tags" ){ $m4ac_ce1kgncadr5['separator'] = 'before'; } if ( $m4ac_pzocy3nw === "{$this->prefix}_access_tags" || $m4ac_pzocy3nw === "{$this->prefix}_access_tags2" ){ $m4ac_ce1kgncadr5['label_block'] = true; $m4ac_ce1kgncadr5['default'] = ''; } if ( $m4ac_pzocy3nw === "{$this->prefix}_invert_results" ){ $m4ac_ce1kgncadr5['separator'] = 'before'; } return $m4ac_ce1kgncadr5; } } }
