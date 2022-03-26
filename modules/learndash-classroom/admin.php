<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final 
class m4ac_pa0nhor9tjc { 
function m4ac_t6cgxq5ldje7($m4ac_maz5nvkp) { $m4ac_e3ht7j0fxgiq = memberium_app()->m4ac_iui26zwm5_k($m4ac_maz5nvkp->ID, m4ac_k5h6dlyonj::m4ac_zw_dhmca()->m4ac_gm6_pd7vl(), ''); $m4ac_l9lbyvw4xaed = memberium_app()->m4ac_ni3dn9fc('array');  wp_nonce_field('save_post', "memberium_learndash_classroom_nonce_{$m4ac_maz5nvkp->ID}"); m4ac_s126v0fexga::m4ac_r8vk67mcnw2( 'Classroom Auto-Enroll Tag<br>', '_memberium_lms_groupcourse_autoenroll[]', $m4ac_e3ht7j0fxgiq['_memberium_lms_groupcourse_autoenroll'], 'tag-selector', [ 'help_id' => 0, 'multiple' => false, 'naked' => true, 'style' => 'width:100%;max-width:100%;', ] ); m4ac_f5ovcw_1iln::m4ac_zw_dhmca()->m4ac_iy1htpsfj(); } 
function m4ac_ja57o6te($m4ac__37l6rhivt2 = 0, $m4ac_qxu8b2sa7lm = null, $m4ac_jtf3bjyul2d = false) { if (! m4ac_f5ovcw_1iln::m4ac_zw_dhmca()->m4ac_iyjzw1tq20l($m4ac__37l6rhivt2, "memberium_learndash_classroom_nonce_{$m4ac__37l6rhivt2}", 'save_post') ) { return; } memberium_app()->m4ac_wq7u84xw5v0($m4ac__37l6rhivt2, m4ac_k5h6dlyonj::m4ac_zw_dhmca()->m4ac_gm6_pd7vl()); } 
function m4ac_ntcus0hd() { $m4ac_dxtjcmeridh = m4ac_s126v0fexga::m4ac_udme4nbtp(); if (in_array($m4ac_dxtjcmeridh, ['sfwd-courses']) ) { add_meta_box('memberium-learndash-classroom-actions', 'Classrooms for Memberium', [$this, 'm4ac_t6cgxq5ldje7'], $m4ac_dxtjcmeridh, 'side'); } add_action('save_post_sfwd-courses', [$this, 'm4ac_ja57o6te']); } 
function m4ac_rh6ijntd() { add_action('admin_init', [$this, 'm4ac_ntcus0hd']); } private 
function __construct() { $this->m4ac_rh6ijntd(); } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; } } }
