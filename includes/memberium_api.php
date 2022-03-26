<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4')) { 
function memb_getAppName() { return memberium_app()->m4ac_bztk3xj1(); } 
function memb_getContactId() : int { return memberium_app()->m4ac_w8ohueyv(); } 
function memb_getContactIdByUserId(int $user_id) : int { return memberium_app()->m4ac_pm63av15g($user_id); } 
function memb_getUserIdByContactId(int $contact_id) : int { return m4ac_bem2ya5k::m4ac_y4vi6m8f1qhj($contact_id); } 
function memb_hasPostAccess(int $post_id) { return memberium_app()->m4ac_u1avl_bn()->m4ac_mh407kspfdzq($post_id); } 
function memb_overrideProhibitedAction(string $action) { return memberium_app()->m4ac_u1avl_bn()->m4ac_zo360rw_keb1($action); } 
function memb_hasAllTags($tags, int $contact_id = 0) { return memberium_app()->m4ac_pisytqw8zn($tags, $contact_id); } 
function memb_hasAnyTags($tags, int $contact_id = 0) { if ($contact_id) { $m4ac_at_5xofh = m4ac_bem2ya5k::m4ac_y4vi6m8f1qhj($contact_id); if ($m4ac_at_5xofh) { $m4ac__crsbi5yuze = memberium_app()->m4ac_i46yafk1zmi($m4ac_at_5xofh); } } else { $m4ac__crsbi5yuze = memberium_app()->m4ac_rsz_g9k7j5d2(); } return memberium_app()->m4ac_t5ws0_v68($tags, $m4ac__crsbi5yuze); } 
function memb_getContactField(string $fieldname = '', bool $sanitize = false) { return m4ac_m7m0xgfv::m4ac_zw_dhmca()->m4ac_d58nps2ix6u($fieldname, $sanitize); } 
function memb_setContactField(int $contact_id, array $fields, bool $flush = true) { if (! $contact_id) { return false; } return memberium_app()->m4ac_eg298f5u($contact_id, $fields, $flush = false); } 
function memb_setTags($tags = '', int $contact_id = 0, bool $force = false) { return memberium_app()->m4ac_ocsjt69hrb($tags, $contact_id, $force); } 
function memb_get_license_status() { return m4ac_tl5skz6cfptr::m4ac_e28auldn(); } 
function memb_has_license_tags($tags) { return m4ac_tl5skz6cfptr::m4ac_efe5yorv($tags); } 
function memb_is_license_trial() { return m4ac_tl5skz6cfptr::m4ac_p1ek48mj(); } 
function memb_has_membership(string $level_name) { return m4ac_m7m0xgfv::m4ac_zw_dhmca()->m4ac_yfwqk4gj($level_name); } 
function memb_has_any_membership() { return m4ac_m7m0xgfv::m4ac_zw_dhmca()->m4ac_fb2dzwl5haof(); } 
function memb_has_MembershipLevel(int $level) { return m4ac_m7m0xgfv::m4ac_zw_dhmca()->m4ac_ztnichdg5s1($level); } 
function memb_getTagMap(bool $cache_bust = false, bool $negatives = false ) { return memberium_app()->m4ac_sjc175u_0ygp($cache_bust, $negatives); } 
function memb_getSession(int $user_id) { if (isset($_SESSION['memb_user']['id']) && $_SESSION['memb_user']['id'] == (int) $user_id) { return $_SESSION; } return memberium_app()->m4ac_c17vlcx3a4($user_id); } }
