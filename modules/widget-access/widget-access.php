<?php
/**
 * Copyright (c) 2020 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) {  
class m4ac_csga4duwvbry { const VERSION = '1.0.2';  private $m4ac_pgsmvk094ey = [];   
function __construct($m4ac_b7_c3kyi) { $m4ac_wdl2r3x6jg = [ 'prefix' => 'wpal', 'settings_title' => __('Widget Access'), 'access_level_name' => __('Access Level'), 'key_name' => __('Key(s)'), 'ids_removed_text' => __('Notice : The following ID(s) have been removed'), ]; $m4ac_ah90o86m = wp_parse_args($m4ac_b7_c3kyi, $m4ac_wdl2r3x6jg);  foreach ($m4ac_ah90o86m as $m4ac_pzocy3nw => $m4ac_ihnr7cyv) { if ( array_key_exists($m4ac_pzocy3nw, $m4ac_wdl2r3x6jg) ){ $m4ac_gmn6r1csd04h = 'WPAL_WIDGET_' . strtoupper($m4ac_pzocy3nw); if ( ! defined($m4ac_gmn6r1csd04h) ){ define($m4ac_gmn6r1csd04h,$m4ac_ihnr7cyv); } } }  $this->m4ac_gry2qhnc(); }  
function m4ac_gry2qhnc(){  add_action('in_widget_form', [$this, 'm4ac_xnelf0xw593'], 10, 3);  add_filter('widget_update_callback', [$this, 'm4ac_zxbqa9tg1'], 10, 2);  if( is_admin() ){ add_action('load-widgets.php', [$this, 'm4ac_s6a1djgm'], 1);  } else { add_filter('sidebars_widgets', [$this, 'm4ac_ev19quk3nc'], 10);  add_filter('widget_display_callback', [$this, 'm4ac_dv4f2pex8'], 10, 3);  } }  
function m4ac_ev19quk3nc($m4ac_kb13_5x7sp){ if (is_customize_preview() ){ return $m4ac_kb13_5x7sp; } global $wp_registered_widgets; if( empty($wp_registered_widgets) ){ return $m4ac_kb13_5x7sp; } foreach($m4ac_kb13_5x7sp as $m4ac_h5cit84m => $m4ac_pgsmvk094ey){ if ($m4ac_h5cit84m == 'wp_inactive_widgets' || empty($m4ac_pgsmvk094ey)){ continue; } foreach($m4ac_pgsmvk094ey as $m4ac_yqah5jzkgcdf => $m4ac_lj_fwoc5ub1y){ $m4ac_ryjk0cu9 = $this->m4ac_op7y_gjfd($m4ac_lj_fwoc5ub1y, $m4ac_h5cit84m); if( is_null($m4ac_ryjk0cu9) ){ global $wp_registered_widgets; $m4ac_nj4s6890h = $wp_registered_widgets[ $m4ac_lj_fwoc5ub1y ]['callback'][0]->option_name; $m4ac_ukqvxo6ne7 = $wp_registered_widgets[ $m4ac_lj_fwoc5ub1y ]['params'][0]['number']; $m4ac_naki8yespho = get_option( $m4ac_nj4s6890h ); $m4ac_naki8yespho = $m4ac_naki8yespho[ $m4ac_ukqvxo6ne7 ]; if( is_array($m4ac_naki8yespho) && !empty($m4ac_naki8yespho['content']) ){ $m4ac_l08xoqrsu = parse_blocks($m4ac_naki8yespho['content']); $m4ac_zi6f9ge7py8 = isset($m4ac_l08xoqrsu[0]) ? $m4ac_l08xoqrsu[0]['attrs'] : []; $m4ac_ryjk0cu9 = $this->m4ac_x0mjsegp2($m4ac_lj_fwoc5ub1y, $m4ac_zi6f9ge7py8, $m4ac_h5cit84m); } else{ $m4ac_ryjk0cu9 = $this->m4ac_uhf9vmy4u($m4ac_lj_fwoc5ub1y, $m4ac_h5cit84m); } } $this->m4ac_pgsmvk094ey[$m4ac_h5cit84m][$m4ac_lj_fwoc5ub1y] = $m4ac_ryjk0cu9; if( ! $m4ac_ryjk0cu9 ){ unset($m4ac_kb13_5x7sp[$m4ac_h5cit84m][$m4ac_yqah5jzkgcdf]); } } } return $m4ac_kb13_5x7sp; }  
function m4ac_dv4f2pex8($m4ac_u4tpxcro19, $m4ac_n_2w8gtz, $m4ac_ah90o86m){ $m4ac_ryjk0cu9 = $this->m4ac_op7y_gjfd($m4ac_n_2w8gtz->id, $m4ac_ah90o86m['id']); if( is_null($m4ac_ryjk0cu9) ){  if (is_a($m4ac_n_2w8gtz, 'WP_Widget_Block')) { $m4ac_l08xoqrsu = !empty($m4ac_u4tpxcro19['content']) ? parse_blocks($m4ac_u4tpxcro19['content']) : []; $m4ac_zi6f9ge7py8 = isset($m4ac_l08xoqrsu[0]) ? $m4ac_l08xoqrsu[0]['attrs'] : []; $m4ac_ryjk0cu9 = $this->m4ac_x0mjsegp2($m4ac_n_2w8gtz->id, $m4ac_zi6f9ge7py8, $m4ac_ah90o86m['id']); } else{ $m4ac_ryjk0cu9 = $this->m4ac_uhf9vmy4u($m4ac_n_2w8gtz->id, $m4ac_ah90o86m['id']); } } return $m4ac_ryjk0cu9 ? $m4ac_u4tpxcro19 : false; } 
function m4ac_x0mjsegp2( $m4ac_lj_fwoc5ub1y, $m4ac_zi6f9ge7py8, $m4ac_kqizdmhy ){ if( !empty($m4ac_zi6f9ge7py8) ){ $m4ac_zi6f9ge7py8 = apply_filters('wpal/blocks/gutenberg/element_visibility', $m4ac_zi6f9ge7py8); } $m4ac_ryjk0cu9 = $this->m4ac_k872kqmgc( $m4ac_lj_fwoc5ub1y, $m4ac_zi6f9ge7py8, $m4ac_kqizdmhy ); $this->m4ac_pgsmvk094ey[$m4ac_kqizdmhy][$m4ac_lj_fwoc5ub1y] = $m4ac_ryjk0cu9; return $m4ac_ryjk0cu9; }  
function m4ac_uhf9vmy4u($m4ac_lj_fwoc5ub1y, $m4ac_kqizdmhy){ $m4ac_ryjk0cu9 = $this->m4ac_op7y_gjfd($m4ac_lj_fwoc5ub1y, $m4ac_kqizdmhy); if( is_null($m4ac_ryjk0cu9) ){ if (preg_match('/^(.+)-(\d+)$/', $m4ac_lj_fwoc5ub1y, $m4ac_uvl4xi0ca7m) ){ $m4ac_t7j29uv6 = $m4ac_uvl4xi0ca7m[1]; $m4ac_yqah5jzkgcdf = $m4ac_uvl4xi0ca7m[2]; $m4ac_lqg2ejwks8 = get_option("widget_{$m4ac_t7j29uv6}"); $m4ac_lqg2ejwks8 = empty($m4ac_lqg2ejwks8[$m4ac_yqah5jzkgcdf]) ? [] : $m4ac_lqg2ejwks8[$m4ac_yqah5jzkgcdf]; $m4ac_ryjk0cu9 = $this->m4ac_k872kqmgc( $m4ac_lj_fwoc5ub1y, $m4ac_lqg2ejwks8, $m4ac_kqizdmhy ); $this->m4ac_pgsmvk094ey[$m4ac_kqizdmhy][$m4ac_lj_fwoc5ub1y] = $m4ac_ryjk0cu9; } else{ $this->m4ac_pgsmvk094ey[$m4ac_kqizdmhy][$m4ac_lj_fwoc5ub1y] = true; } } return $this->m4ac_pgsmvk094ey[$m4ac_kqizdmhy][$m4ac_lj_fwoc5ub1y]; } 
function m4ac_op7y_gjfd( $m4ac_lj_fwoc5ub1y, $m4ac_kqizdmhy ){ if( ! isset($this->m4ac_pgsmvk094ey[$m4ac_kqizdmhy]) ){ $this->m4ac_pgsmvk094ey[$m4ac_kqizdmhy] = []; } return isset($this->m4ac_pgsmvk094ey[$m4ac_kqizdmhy][$m4ac_lj_fwoc5ub1y]) ? $this->m4ac_pgsmvk094ey[$m4ac_kqizdmhy][$m4ac_lj_fwoc5ub1y] : null; } 
function m4ac_k872kqmgc( $m4ac_lj_fwoc5ub1y, $m4ac_lqg2ejwks8, $m4ac_kqizdmhy ){ $m4ac_b8vf6s7ep = apply_filters("wpal/widget/visibility", $m4ac_lqg2ejwks8, $m4ac_lj_fwoc5ub1y, $m4ac_kqizdmhy); $m4ac_wdl2r3x6jg = [ 'any_membership' => 0, 'asset_id' => '', 'contact_ids' => '', 'eval' => '', 'invert_results' => 0, 'logged_in_only' => 0, 'logged_out_only' => 0, 'memberships' => '', 'tags1' => '', 'tags2' => '', ]; $m4ac_ipigw6qz = wp_parse_args( $m4ac_b8vf6s7ep, $m4ac_wdl2r3x6jg); if (m4ac_mym496l81v::m4ac_c_8sq5i2a3() ) { $m4ac_ah4c_sou = [ 'any_membership', 'contact_ids', 'eval', 'invert_results', 'logged_in_only', 'logged_out_only', 'memberships', 'tags1', 'tags2', ];  } $m4ac_odl7scvn0u = ( $m4ac_ipigw6qz['asset_id'] > '' ) ? $m4ac_ipigw6qz['asset_id'] : false; return apply_filters('wpal/widget/can_access_asset', true, $m4ac_ipigw6qz, 'widget-area', $m4ac_odl7scvn0u); }  
function m4ac_xnelf0xw593($m4ac_n_2w8gtz, $m4ac_vo6741wvgc, $m4ac_u4tpxcro19) { $m4ac_lj_fwoc5ub1y = $m4ac_n_2w8gtz->id; $m4ac_u9uhl_ci87 = $this->m4ac_tvrp81mjk()->m4ac_hfr7ukej(); $m4ac_n5dw3y7vlku = 'wpal-widget-access'; $m4ac_x_1654tdgb = isset($m4ac_u4tpxcro19['status']) ? $m4ac_u4tpxcro19['status'] : ''; $m4ac_yl1eaywt765 = $this->m4ac_tvrp81mjk()->m4ac_ti4mso7bq(); include __DIR__ . '/templates/access-widget-fields.php'; return; }  
function m4ac_zxbqa9tg1( $m4ac_u4tpxcro19, $m4ac_flq1rv8wf0t ){ return $this->m4ac_tvrp81mjk()->m4ac_b5h_0vdi4($m4ac_u4tpxcro19, $m4ac_flq1rv8wf0t); }  
function m4ac_s6a1djgm(){ $this->m4ac_tvrp81mjk()->m4ac_wcael1z6(self::VERSION); }  
function m4ac_tvrp81mjk() { static $m4ac_n_j31z9qsv; if( is_null($m4ac_n_j31z9qsv) ){ require_once __DIR__ . '/admin.php'; $m4ac_n_j31z9qsv = new m4ac_byoqkcalxi; } return $m4ac_n_j31z9qsv; } } }