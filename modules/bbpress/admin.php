<?php
/**
 * Copyright (c) 2018-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_ezon_g9aulwf { private $m4ac_d2s9mi0r4 = false; 
function m4ac_joch_re68k($m4ac_qz2fsdy3pb = []) { $m4ac_hlqcfhztjsu = [ 'reply', ]; return array_merge($m4ac_qz2fsdy3pb, $m4ac_hlqcfhztjsu); } private 
function m4ac_rh6ijntd() { add_action('admin_init', [$this, 'm4ac_ntcus0hd'], 200); add_filter('memberium/unenhanced_posts', [$this, 'm4ac_joch_re68k'], 10, 1); } 
function m4ac_ntcus0hd() { $m4ac_dxtjcmeridh = memberium_app()->m4ac_dfujoe3avi_()->m4ac_lyn05jkedwl(); if ($m4ac_dxtjcmeridh == 'forum') { add_meta_box('memberium-bbpress-forum-controls', 'Memberium Forum Integration', [$this, 'm4ac_wck2jlmq'], $m4ac_dxtjcmeridh, 'side'); add_action('save_post', [$this, 'm4ac_jrup317d']); } } 
function m4ac_wck2jlmq() { global $post; wp_nonce_field(MEMBERIUM_MODULES_DIR, "memberium_bbpress_forum_nonce_{$post->ID}"); $m4ac_e3ht7j0fxgiq = get_post_meta($post->ID); $m4ac_u9uhl_ci87 = [ '_memberium/bbpress/can_post' => 'memberium_can_post', ]; foreach ($m4ac_u9uhl_ci87 as $m4ac_jj79h_ou1vm => $m4ac_hz6dcgrl_w) { if (isset($m4ac_e3ht7j0fxgiq[$m4ac_jj79h_ou1vm][0]) ) { $m4ac_ah4c_sou[$m4ac_hz6dcgrl_w] = trim($m4ac_e3ht7j0fxgiq[$m4ac_jj79h_ou1vm][0]); } else { $m4ac_ah4c_sou[$m4ac_hz6dcgrl_w] = ''; } } m4ac_s126v0fexga::m4ac_r8vk67mcnw2( 'Grant Posting Access<br>', 'memberium_can_post', $m4ac_ah4c_sou['memberium_can_post'], 'tag-selector', [ 'help_id' => 0, 'style' => 'width:100%;max-width:100%;', 'multiple' => true, 'naked' => true, ] ); } 
function m4ac_jrup317d($m4ac__37l6rhivt2) { if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return;  }  if (empty($_POST["memberium_bbpress_forum_nonce_{$m4ac__37l6rhivt2}"]) || ! wp_verify_nonce($_POST["memberium_bbpress_forum_nonce_{$m4ac__37l6rhivt2}"], MEMBERIUM_MODULES_DIR) ) { return; } if (! current_user_can('edit_posts', $m4ac__37l6rhivt2) ) { return; } $m4ac_ah4c_sou = []; $m4ac_bsijd7zrx = [ 'memberium_can_post' => '_memberium/bbpress/can_post', ]; foreach ($m4ac_bsijd7zrx as $post_name => $key_name) { if (isset($_POST[$post_name]) ) { $m4ac_ah4c_sou[$key_name] = implode(',', array_filter(explode(',', $_POST[$post_name]) ) ); } } foreach($m4ac_bsijd7zrx as $post_name => $m4ac_kbagjrq9) { if (isset($m4ac_ah4c_sou[$m4ac_kbagjrq9])) { if (empty($m4ac_ah4c_sou[$m4ac_kbagjrq9])) { delete_post_meta($m4ac__37l6rhivt2, $m4ac_kbagjrq9); } else { update_post_meta($m4ac__37l6rhivt2, $m4ac_kbagjrq9, $m4ac_ah4c_sou[$m4ac_kbagjrq9]); } } } } private 
function __construct() { $this->m4ac_rh6ijntd(); } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; } } }
