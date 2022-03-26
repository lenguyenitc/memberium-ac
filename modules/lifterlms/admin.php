<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_dcho3qsnkfbv { private 
function m4ac_gm6_pd7vl() { return [ '_memberium_lms_achievement', '_memberium_lms_assignment_approval_automation', '_memberium_lms_assignment_approval_tag', '_memberium_lms_assignment_upload_automation', '_memberium_lms_assignment_upload_tag', '_memberium_lms_autoenroll',  '_memberium_lms_autojoin',  '_memberium_lms_automation_fail', '_memberium_lms_automation', '_memberium_lms_redirect', '_memberium_lms_tag_fail', '_memberium_lms_tag', ]; } 
function m4ac_ny3wgde4p_j($m4ac_pzocy3nw) { return 'LifterLMS'; } 
function m4ac_vf3qbak7($m4ac_id7k9t2q = []) { return array_merge($m4ac_id7k9t2q, [ 'course', 'lesson', 'llms_quiz', ]); }    
function m4ac_ntcus0hd() { $m4ac_dxtjcmeridh = m4ac_s126v0fexga::m4ac_udme4nbtp(); $m4ac_jnf5st6j4vi = in_array($m4ac_dxtjcmeridh, $this->m4ac_vf3qbak7() ); if ($m4ac_jnf5st6j4vi) { add_meta_box( 'memberium-lifterlms-actions', "LifterLMS for Memberium", [$this, 'm4ac_q9wezqkup4j2'], $m4ac_dxtjcmeridh, 'side' ); } add_action('save_post', [$this, 'm4ac_oct5mu3a_']); } 
function m4ac_q9wezqkup4j2() { global $post; $m4ac__37l6rhivt2 = $post->ID; $m4ac_ah4c_sou = $this->m4ac_gm6_pd7vl(); $m4ac_e3ht7j0fxgiq = memberium_app()->m4ac_iui26zwm5_k($m4ac__37l6rhivt2, $this->m4ac_gm6_pd7vl(), ''); $m4ac_dxtjcmeridh = isset($post->post_type) ? $post->post_type : (isset($_GET['post_type']) ? $_GET['post_type'] : ''); $m4ac_l9lbyvw4xaed = memberium_app()->m4ac_ni3dn9fc('array');  $m4ac_s4zi1mg9wyu = memberium_app()->m4ac_pv1ptjizbd('array');  $m4ac_s2acj3pxehq = get_post_type_object($post->post_type)->labels->singular_name; $m4ac__y9c32zs = in_array($m4ac_dxtjcmeridh, ['course', 'lesson', 'llms_quiz']); $m4ac_qvsbpky0 = $m4ac_dxtjcmeridh == 'course'; $m4ac_heq649p5l_r1 = $m4ac_dxtjcmeridh == 'llms_quiz'; $m4ac_k_c7fa2brmln = $m4ac_dxtjcmeridh == 'llms_quiz'; wp_nonce_field(__CLASS__, "memberium_lifterms_actions_nonce_{$m4ac__37l6rhivt2}"); if ($m4ac_qvsbpky0) { m4ac_s126v0fexga::m4ac_r8vk67mcnw2( 'AutoEnroll Tags<br>', '_memberium_lms_autoenroll[]', $m4ac_e3ht7j0fxgiq['_memberium_lms_autoenroll'], 'tag-selector', [ 'help_id' => 0, 'multiple' => true, 'naked' => true, 'style' => 'width:100%;max-width:100%;', ] ); } if ($m4ac__y9c32zs) { echo "<p>On completion of this {$m4ac_s2acj3pxehq}, do the following actions:</p>"; m4ac_s126v0fexga::m4ac_r8vk67mcnw2( 'Run Automation on Completion<br>', '_memberium_lms_automation[]', $m4ac_e3ht7j0fxgiq['_memberium_lms_automation'], 'automationdropdown', [ 'help_id' => 0, 'multiple' => false, 'naked' => true, 'style' => 'width:100%;max-width:100%;', ] ); m4ac_s126v0fexga::m4ac_r8vk67mcnw2( 'Apply these Tags<br>', '_memberium_lms_tag[]', $m4ac_e3ht7j0fxgiq['_memberium_lms_tag'], 'tag-selector', [ 'help_id' => 0, 'multiple' => true, 'naked' => true, 'style' => 'width:100%;max-width:100%;', ] ); if ($m4ac_k_c7fa2brmln) { echo '<p><br />If the student <strong style="color:red;">fails</strong> this test, execute the following actions:</p>'; m4ac_s126v0fexga::m4ac_r8vk67mcnw2( 'Run This Automation<br>', '_memberium_lms_automation_fail[]', $m4ac_e3ht7j0fxgiq['_memberium_lms_automation_fail'], 'automationdropdown', [ 'help_id' => 0, 'multiple' => false, 'naked' => true, 'style' => 'width:100%;max-width:100%;', ] ); m4ac_s126v0fexga::m4ac_r8vk67mcnw2( 'Apply these Tags<br>', '_memberium_lms_tag_fail[]', $m4ac_e3ht7j0fxgiq['_memberium_lms_tag_fail'], 'tag-selector', [ 'help_id' => 0, 'style' => 'width:100%;max-width:100%;', 'multiple' => true, 'naked' => true, ] ); } } m4ac_f5ovcw_1iln::m4ac_zw_dhmca()->m4ac_iy1htpsfj(); } 
function m4ac_oct5mu3a_($m4ac__37l6rhivt2) { if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return;  }  if (empty($_POST["memberium_lifterms_actions_nonce_{$m4ac__37l6rhivt2}"]) || ! wp_verify_nonce($_POST["memberium_lifterms_actions_nonce_{$m4ac__37l6rhivt2}"], __CLASS__) ) { return; } if (! current_user_can('edit_posts', $m4ac__37l6rhivt2) ) { return; } memberium_app()->m4ac_wq7u84xw5v0($m4ac__37l6rhivt2, $this->m4ac_gm6_pd7vl() ); } private 
function m4ac_rh6ijntd() { add_action('admin_init', [$this, 'm4ac_ntcus0hd']); add_filter('memberium/lms/module_post_types', [$this, 'm4ac_vf3qbak7']); add_filter('memberium/lms/name', [$this, 'm4ac_ny3wgde4p_j']); } 
function __construct() { $this->m4ac_rh6ijntd(); } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; } } }
