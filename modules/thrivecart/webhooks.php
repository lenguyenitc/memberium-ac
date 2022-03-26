<?php
/**
* Copyright (c) 2012-2021 David J Bullock
* Web Power and Light
*/

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_q4bmu39fqlog { private 
function m4ac_fusjlpko26() { return [ 'affiliate.commission_earned' => null, 'affiliate.commission_payout' => null, 'affiliate.commission_refund' => null, 'cart.abandoned' => null, 'order.rebill_failed' => 'm4ac_xlvxoghi', 'order.refund' => 'm4ac_yvpfl5aw', 'order.subscription_cancelled' => 'm4ac_u_l0bfw3j', 'order.subscription_paused' => 'm4ac_y56gn984yd_', 'order.subscription_payment' => 'm4ac_gisrjcg59a', 'order.subscription_resumed' => 'm4ac_vqo0m6wdl', 'order.success' => 'm4ac__gf0qm73', ]; } private 
function m4ac_cfnuoj0xk($m4ac_x430jawey_t) { $m4ac_d25y01lp = memberium_app()->m4ac_x280qrz9kmic('thrivecart_secret'); return ($m4ac_x430jawey_t == $m4ac_d25y01lp) && ! empty($m4ac_d25y01lp); } private 
function m4ac_xlvxoghi($m4ac_yx9orudsf6) { } private 
function m4ac_yvpfl5aw($m4ac_yx9orudsf6) { } private 
function m4ac_u_l0bfw3j($m4ac_yx9orudsf6) { } private 
function m4ac_y56gn984yd_($m4ac_yx9orudsf6) { } private 
function m4ac_gisrjcg59a($m4ac_yx9orudsf6) { } private 
function m4ac_vqo0m6wdl($m4ac_yx9orudsf6) { } private 
function m4ac__gf0qm73($m4ac_yx9orudsf6) { } private 
function m4ac_xjs73r_wo($m4ac_uamg786doir) { $m4ac_yx9orudsf6 = []; $m4ac_yx9orudsf6['event'] = isset($m4ac_uamg786doir['event']) ? strtolower($m4ac_uamg786doir['event']) : ''; $m4ac_yx9orudsf6['thrivecart_account'] = isset($m4ac_uamg786doir['thrivecart_account']) ? $m4ac_uamg786doir['thrivecart_account'] : ''; $m4ac_yx9orudsf6['thrivecart_secret'] = isset($m4ac_uamg786doir['thrivecart_secret']) ? $m4ac_uamg786doir['thrivecart_secret'] : ''; $m4ac_yx9orudsf6['base_product'] = isset($m4ac_uamg786doir['base_product']) ? (int) $m4ac_uamg786doir['base_product'] : 0; $m4ac_yx9orudsf6['order_id'] = isset($m4ac_uamg786doir['order_id']) ? (int) $m4ac_uamg786doir['order_id'] : 0; $m4ac_yx9orudsf6['currency'] = isset($m4ac_uamg786doir['currency']) ? strtouppwer($m4ac_uamg786doir['currency']) : 'USD'; $m4ac_yx9orudsf6['customer_id'] = isset($m4ac_uamg786doir['customer_id']) ? (int) $m4ac_uamg786doir['customer_id'] : 0; $m4ac_yx9orudsf6['customer_identifier'] = isset($m4ac_uamg786doir['customer_identifier']) ? $m4ac_uamg786doir['customer_identifier'] : ''; $m4ac_yx9orudsf6['customer']['name'] = isset($m4ac_uamg786doir['customer']['name']) ? $m4ac_uamg786doir['customer']['name'] : ''; $m4ac_yx9orudsf6['customer']['firstname'] = isset($m4ac_uamg786doir['customer']['firstname']) ? $m4ac_uamg786doir['customer']['firstname'] : ''; $m4ac_yx9orudsf6['customer']['lastname'] = isset($m4ac_uamg786doir['customer']['lastname']) ? $m4ac_uamg786doir['customer']['lastname'] : ''; $m4ac_yx9orudsf6['customer']['email'] = isset($m4ac_uamg786doir['customer']['email']) ? strtolower($m4ac_uamg786doir['customer']['email']) : ''; $m4ac_yx9orudsf6['customer']['address'] = isset($m4ac_uamg786doir['customer']['address']) ? $m4ac_uamg786doir['customer']['address'] : ''; } 
function m4ac_j2scyr35f() { $m4ac_x430jawey_t = isset($_POST['thrivecart_secret']) ? $_POST['thrivecart_secret'] : false; $m4ac_urkc84ehvzw = isset($_POST['event']) ? strtolower($_POST['event']) : ''; if (! array_key_exists($m4ac_urkc84ehvzw, $this->m4ac_fusjlpko26() ) ) { return; } if (! $m4ac_x430jawey_t || ! $this->m4ac_cfnuoj0xk($m4ac_x430jawey_t) ) { return; } $m4ac_d20rhfsku = $this->m4ac_fusjlpko26()[$m4ac_urkc84ehvzw]; $m4ac_yx9orudsf6 = $this->m4ac_xjs73r_wo($_POST); if ($m4ac_d20rhfsku) { call_user_func([$this, $m4ac_d20rhfsku], $m4ac_yx9orudsf6); } http_response_code(200); exit; } private 
function __construct() { add_action('template_redirect', [$this, 'm4ac_j2scyr35f'], 1, 0); } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; } }     }
