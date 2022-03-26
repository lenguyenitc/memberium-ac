<?php
/**
 * Copyright (c) 2018-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_wpfmq9e7') ) { final 
class m4ac_e73kfzga206j { 
function m4ac_bbp083fuwt() { if (true) { return; } ?>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="reg_billing_first_name">First Name <span class="required">*</span></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" value="" />
			</p>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide" style="margin-bottom:1em;">
			<label for="reg_billing_last_name">Last Name <span class="required">*</span></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" value="" />
			</p>
			<?php
 } 
function m4ac_zbjkyil4v($m4ac_u9uhl_ci87) { if (is_user_logged_in() ) { if (! wp_doing_ajax() ) { $m4ac_u9uhl_ci87['billing']['billing_email']['required'] = 0; echo '
					<style>
					#billing_email_field {visibility:hidden;}
					#billing_email_field label span {visibility:hidden;}
					</style>'; } } return $m4ac_u9uhl_ci87; } 
function m4ac_vafepjb58() { $tags['nested'] = [ 'memb_has_in_cart' => [MEMBERIUM_NESTING_LEVELS, 'm4ac_uar2c9816_'], 'memb_has_purchased_product' => [MEMBERIUM_NESTING_LEVELS, 'm4ac_x3p_boz7r'], 'memb_is_cart_empty' => [MEMBERIUM_NESTING_LEVELS, 'm4ac_x2zl5tb8nxo'], ]; $tags['standard'] = []; foreach($tags['standard'] as $tag => $p) { add_shortcode($tag, [$this, $p]); } foreach($tags['nested'] as $tag => $p) { $m4ac_lkc_wr2zfx = $p[1]; add_shortcode($tag, [$this, $m4ac_lkc_wr2zfx] ); for ($i = 1; $i < (int) $p[0]; $i++) { add_shortcode($tag . $i, [$this, $m4ac_lkc_wr2zfx] ); } } add_shortcode('memb_add_to_woo_cart', ['m4ac_txjyu9r_4', 'm4ac_e46sr9ipdj']); } 
function m4ac_x3p_boz7r($atts, $content = null, $code) { $m4ac_wdl2r3x6jg = [ 'product_id' => '', ]; $m4ac_c1m92xtgl8z = shortcode_atts($m4ac_wdl2r3x6jg, $atts, 'memberium'); $product_ids = explode(',', $m4ac_c1m92xtgl8z['product_id']); $user_id = get_current_user_id(); $found = false; foreach($product_ids as $product_id) { $found = $found || wc_customer_bought_product(null, $user_id, $product_id); } $output = m4ac_audvsgbhpw::route_conditional_output($content, $code, true, $found); return m4ac_audvsgbhpw::process_output(false, $output, $txtfmt, $capture); } 
function m4ac_uar2c9816_($atts, $content = null, $code) { global $woocommerce; $m4ac_wdl2r3x6jg = [ 'product_id' => '', ]; $m4ac_c1m92xtgl8z = shortcode_atts($m4ac_wdl2r3x6jg, $atts, 'memberium'); $found = false; $product_ids = array_filter(explode(',', $m4ac_c1m92xtgl8z['product_id']) ); $cart_items = $woocommerce->cart->get_cart(); foreach($cart_items as $k => $v) { $found = $found || in_array($v['product_id'], $product_ids); } $output = m4ac_audvsgbhpw::route_conditional_output($content, $code, true, $found); return m4ac_audvsgbhpw::process_output(false, $output, $txtfmt, $capture); } 
function m4ac_x2zl5tb8nxo($atts, $content = null, $code) { $cart_items = $woocommerce->cart->get_cart(); $found = empty($cart_items); $output = m4ac_audvsgbhpw::route_conditional_output($content, $code, true, $found); return m4ac_audvsgbhpw::process_output(false, $output, $txtfmt, $capture); } 
function m4ac_ayefzhd6() { return; echo m4ac_d4yt1zjli::m4ac_nqyriec10(); }  
function m4ac_d5zirq_vut($m4ac_ihnr7cyv, $m4ac_pzocy3nw) { if ($m4ac_ihnr7cyv == 'no') { if ( WC()->cart ) { $m4ac_xiacz8bpdx = WC()->cart->get_cart(); if (is_array($m4ac_xiacz8bpdx) && ! empty($m4ac_xiacz8bpdx) ) { foreach ($m4ac_xiacz8bpdx as $m4ac_ww7oiazfdu) { $m4ac_c2yk16ze3dfl = $m4ac_ww7oiazfdu['product_id']; $m4ac_vw38otqs4md = get_post_meta($m4ac_c2yk16ze3dfl, '_memberium_guest_checkout', true); if ($m4ac_vw38otqs4md == 1) { $m4ac_ihnr7cyv = 'yes'; break; } } } } } return $m4ac_ihnr7cyv; } private 
function m4ac_rh6ijntd() { add_action('init', [$this, 'm4ac_vafepjb58'], 1); add_action('woocommerce_login_form', [$this, 'm4ac_ayefzhd6']); add_action('woocommerce_register_form_start', [$this, 'm4ac_bbp083fuwt']); add_filter('option_woocommerce_enable_guest_checkout', [$this, 'm4ac_d5zirq_vut'], 10, 2); add_filter('woocommerce_checkout_fields', [$this, 'm4ac_zbjkyil4v'], PHP_INT_MAX, 1); } private 
function __construct() { $this->m4ac_rh6ijntd(); } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; }  } }
