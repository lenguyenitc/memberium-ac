<?php
/**
* Copyright (c) 2018-2021 David J Bullock
* Web Power and Light
*/

 if (! defined( 'ABSPATH' ) ) { die(); }  
class m4ac_d5p_b3rdkjis extends \Elementor\Widget_Shortcode {  protected 
function render() { $m4ac_g_sevcjrm94 = $this->get_settings_for_display('shortcode'); $m4ac_g_sevcjrm94 = apply_filters( 'memberium/elementor/widget/shortcode/render', $m4ac_g_sevcjrm94, $this->get_settings_for_display() ); if ( ! empty($m4ac_g_sevcjrm94) ){ $m4ac_g_sevcjrm94 = do_shortcode(shortcode_unautop($m4ac_g_sevcjrm94) ); echo '<div class="elementor-shortcode">', $m4ac_g_sevcjrm94, '</div>'; } } }
