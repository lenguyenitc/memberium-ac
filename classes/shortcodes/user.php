<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_c6rqypiacz4') ) { final
class m4ac__65hqa0xnb { static
function m4ac_wmekob51qp($m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd = null, $m4ac_kp6zrjntmf78 = '') { static $m4ac_fy6qjxi1dn5 = 0; if (! m4ac_tl5skz6cfptr::m4ac_e28auldn() ) { return; } $m4ac_wdl2r3x6jg = [ 'automation_id' => '', 'buttontext' => 'Change Email', 'debug' => false, 'email1label' => 'Email Address:', 'email2label' => 'Repeat Email Address:', 'failure_url' => '', 'form_name' => 'change_email_' . $m4ac_fy6qjxi1dn5, 'success_url' => '', 'tag_id' => '', ]; if (isset($m4ac_c1m92xtgl8z[0]) && $m4ac_c1m92xtgl8z[0] == 'showatts') { return implode(',', array_keys($m4ac_wdl2r3x6jg) ); } if (function_exists('is_user_logged_in') && ! is_user_logged_in() ) { return; } $m4ac_c1m92xtgl8z = shortcode_atts($m4ac_wdl2r3x6jg, $m4ac_c1m92xtgl8z, 'memberium'); $m4ac_at_5xofh = (int) get_current_user_id(); $m4ac_uo08x_g7 = (isset($_SESSION['memb_user']['crm_id']) ) ? $_SESSION['memb_user']['crm_id'] : 0; $m4ac_md7c8zsu2o = [ 'automation_id' => $m4ac_c1m92xtgl8z['automation_id'], 'debug' => $m4ac_c1m92xtgl8z['debug'], 'failure_url' => $m4ac_c1m92xtgl8z['failure_url'], 'success_url' => $m4ac_c1m92xtgl8z['success_url'], 'tag_id' => $m4ac_c1m92xtgl8z['tag_id'], ]; $m4ac_fy6qjxi1dn5++; $m4ac_pbk61dwjnxi = ''; $m4ac_yvyosepl6 = base64_encode(serialize($m4ac_md7c8zsu2o) ); $m4ac_vejbrg5i = memberium_app()->m4ac_s5ze6qlragdu($m4ac_yvyosepl6); $m4ac_d78sk4qc3i = empty($_SESSION['memb_user']['email']) ? '' : $_SESSION['memb_user']['email']; $m4ac_ush6rftjk5i = wp_nonce_field('memb_email_change_' . $m4ac_fy6qjxi1dn5, '_wpnonce', true, false); $m4ac_md7c8zsu2o = new stdclass; $m4ac_md7c8zsu2o->automation_id = $m4ac_c1m92xtgl8z['automation_id']; $m4ac_md7c8zsu2o->button_text = $m4ac_c1m92xtgl8z['buttontext']; $m4ac_md7c8zsu2o->debug = $m4ac_c1m92xtgl8z['debug']; $m4ac_md7c8zsu2o->email = $m4ac_d78sk4qc3i; $m4ac_md7c8zsu2o->email1_label = $m4ac_c1m92xtgl8z['email1label']; $m4ac_md7c8zsu2o->email2_label = $m4ac_c1m92xtgl8z['email2label']; $m4ac_md7c8zsu2o->failure_url = $m4ac_c1m92xtgl8z['failure_url']; $m4ac_md7c8zsu2o->form_id = $m4ac_fy6qjxi1dn5; $m4ac_md7c8zsu2o->form_name = $m4ac_c1m92xtgl8z['form_name']; $m4ac_md7c8zsu2o->messages = []; $m4ac_md7c8zsu2o->nonce = $m4ac_ush6rftjk5i; $m4ac_md7c8zsu2o->parameters = $m4ac_yvyosepl6; $m4ac_md7c8zsu2o->signature = $m4ac_vejbrg5i; $m4ac_md7c8zsu2o->success_url = $m4ac_c1m92xtgl8z['success_url']; $m4ac_md7c8zsu2o->tag_id = $m4ac_c1m92xtgl8z['tag_id']; if (! empty($_SESSION['flash']['email_change_message']) ) { $m4ac_md7c8zsu2o->messages = $_SESSION['flash']['email_change_message']; unset($_SESSION['flash']['email_change_message'], $_SESSION['flash']['email_change_result']); } return m4ac_audvsgbhpw::m4ac_ltnm5sge8_($m4ac_kp6zrjntmf78, $m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd, $m4ac_kp6zrjntmf78, $m4ac_md7c8zsu2o); } static
function m4ac_tx6l0_9m($m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd = null, $m4ac_kp6zrjntmf78 = '') { static $m4ac_fy6qjxi1dn5 = 1; if (! m4ac_tl5skz6cfptr::m4ac_e28auldn() ) { return; } $m4ac_wdl2r3x6jg = [ 'automation_id' => 0, 'buttontext' => 'Change Password', 'maxlength' => 999, 'password1label' => 'New Password:', 'password2label' => 'Repeat Password:', 'redirect_url' => '',  'successurl' => '', 'tag_id' => '', ]; if (isset($m4ac_c1m92xtgl8z[0]) && $m4ac_c1m92xtgl8z[0] == 'showatts') { return implode(',', array_keys($m4ac_wdl2r3x6jg) ); } if (function_exists('is_user_logged_in') && ! is_user_logged_in() ) { return; } if (! memberium_app()->m4ac_k6b8c0f7g5() && $_SESSION['memb_user']['source'] != 'activecampaign') { return; } $m4ac_c1m92xtgl8z = shortcode_atts($m4ac_wdl2r3x6jg, $m4ac_c1m92xtgl8z, 'memberium'); $m4ac_c1m92xtgl8z['maxlength'] = abs(intval($m4ac_c1m92xtgl8z['maxlength']) ); $m4ac_md7c8zsu2o = [ 'automation_id' => trim($m4ac_c1m92xtgl8z['automation_id']), 'redirect_url' => trim($m4ac_c1m92xtgl8z['redirect_url']), 'successurl' => trim($m4ac_c1m92xtgl8z['successurl']), 'tag_id' => trim($m4ac_c1m92xtgl8z['tag_id']), ]; $m4ac_yvyosepl6 = base64_encode(serialize($m4ac_md7c8zsu2o) ); $m4ac_vejbrg5i = memberium_app()->m4ac_s5ze6qlragdu($m4ac_yvyosepl6); $m4ac_v9ek465_fcuq = "memb_password_change-{$m4ac_fy6qjxi1dn5}"; $m4ac_pbk61dwjnxi = ''; $m4ac_md7c8zsu2o = new stdclass; $m4ac_md7c8zsu2o->automation_id = $m4ac_c1m92xtgl8z['automation_id']; $m4ac_md7c8zsu2o->button_text = $m4ac_c1m92xtgl8z['buttontext']; $m4ac_md7c8zsu2o->form_id = $m4ac_fy6qjxi1dn5; $m4ac_md7c8zsu2o->form_name = $m4ac_v9ek465_fcuq; $m4ac_md7c8zsu2o->max_length = $m4ac_c1m92xtgl8z['maxlength']; $m4ac_md7c8zsu2o->messages = ''; $m4ac_md7c8zsu2o->min_length = memberium_app()->m4ac_x280qrz9kmic('min_password_length'); $m4ac_md7c8zsu2o->nonce = wp_nonce_field('password_change_' . $m4ac_fy6qjxi1dn5 . $m4ac_yvyosepl6, '_wpnonce', true, false); $m4ac_md7c8zsu2o->parameters = $m4ac_yvyosepl6; $m4ac_md7c8zsu2o->password1_label = $m4ac_c1m92xtgl8z['password1label']; $m4ac_md7c8zsu2o->password2_label = $m4ac_c1m92xtgl8z['password2label']; $m4ac_md7c8zsu2o->redirect_url = $m4ac_c1m92xtgl8z['redirect_url']; $m4ac_md7c8zsu2o->signature = $m4ac_vejbrg5i; $m4ac_md7c8zsu2o->success_url = $m4ac_c1m92xtgl8z['successurl']; $m4ac_md7c8zsu2o->tag_id = $m4ac_c1m92xtgl8z['tag_id']; if (isset($_SESSION['flash']['password_change_message']) ) { $m4ac_md7c8zsu2o->messages = $_SESSION['flash']['password_change_message']; } unset($_SESSION['flash']['password_change_message'], $_SESSION['flash']['password_change_success']); $m4ac_fy6qjxi1dn5++; return m4ac_audvsgbhpw::m4ac_ltnm5sge8_($m4ac_kp6zrjntmf78, $m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd, $m4ac_kp6zrjntmf78, $m4ac_md7c8zsu2o); } static
function m4ac_igvikzus3qcn($m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd = null, $m4ac_kp6zrjntmf78 = '') { $m4ac_wdl2r3x6jg = [ 'after' => '', 'before' => '', 'capture' => '', 'contact_id' => memberium_app()->m4ac_w8ohueyv(), 'date_format' => '', 'default' => '', 'fields' => '', 'htmlattr' => '', 'separator' => ' ', 'txtfmt' => '', ]; if (isset($m4ac_c1m92xtgl8z[0]) && $m4ac_c1m92xtgl8z[0] == 'showatts') { return implode(',', array_keys($m4ac_wdl2r3x6jg) ); } $m4ac_c1m92xtgl8z = shortcode_atts($m4ac_wdl2r3x6jg, $m4ac_c1m92xtgl8z, 'memberium'); if (empty($m4ac_c1m92xtgl8z['fields']) ) { return; } $m4ac__crsbi5yuze = memberium_app()->m4ac_rsz_g9k7j5d2(); if ($m4ac_c1m92xtgl8z['contact_id'] <> memberium_app()->m4ac_w8ohueyv() ) { $m4ac_y0x7qa_kewg = memberium_app()->m4ac_zrj6g8l4ap9i($m4ac_c1m92xtgl8z['contact_id'], true); } else { $m4ac_y0x7qa_kewg = isset($m4ac__crsbi5yuze['memb_db_fields']) ? $m4ac__crsbi5yuze['memb_db_fields'] : []; } $m4ac_aocd0ub3gftq = array_map('strtolower', array_map('trim', array_filter(explode(',', $m4ac_c1m92xtgl8z['fields']) )) ); $m4ac_jcx_n26ukv = count($m4ac_aocd0ub3gftq); $m4ac_ekvz3dym8jif = 0;  $m4ac_pa2k7635qor = ''; foreach ($m4ac_aocd0ub3gftq as $m4ac_ur90k1f2dy) { $m4ac_ihnr7cyv = $m4ac_c1m92xtgl8z['default']; if ($m4ac_ur90k1f2dy == 'id') { $m4ac_ihnr7cyv = $m4ac_c1m92xtgl8z['contact_id']; } if (isset($m4ac_y0x7qa_kewg['%' . $m4ac_ur90k1f2dy . '%']) ) { $m4ac_ihnr7cyv = htmlspecialchars($m4ac_y0x7qa_kewg['%' . $m4ac_ur90k1f2dy . '%']); } elseif (isset($m4ac_y0x7qa_kewg[$m4ac_ur90k1f2dy]) ) { $m4ac_ihnr7cyv = htmlspecialchars($m4ac_y0x7qa_kewg[$m4ac_ur90k1f2dy]); } if (! empty($m4ac_c1m92xtgl8z['date_format']) ) { $m4ac_ihnr7cyv = date($m4ac_c1m92xtgl8z['date_format'], strtotime($m4ac_ihnr7cyv) ); } $m4ac_pa2k7635qor .= $m4ac_ihnr7cyv; if ($m4ac_jcx_n26ukv > 1) { $m4ac_pa2k7635qor .= $m4ac_c1m92xtgl8z['separator']; } } if ($m4ac_jcx_n26ukv > 1 && strlen($m4ac_c1m92xtgl8z['separator']) > 0) { $m4ac_pa2k7635qor = substr($m4ac_pa2k7635qor, 0, -strlen($m4ac_c1m92xtgl8z['separator']) ); } return m4ac_audvsgbhpw::m4ac_teqln8w23g(false, $m4ac_pa2k7635qor, $m4ac_c1m92xtgl8z['txtfmt'], $m4ac_c1m92xtgl8z['capture'], $m4ac_c1m92xtgl8z['htmlattr'], $m4ac_c1m92xtgl8z['before'], $m4ac_c1m92xtgl8z['after']); } static
function m4ac_d3drzofq($m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd = null, $m4ac_kp6zrjntmf78 = '') { $m4ac_wdl2r3x6jg = [ 'mode' => 'plain', 'style' => 'color:#000;', ]; if (isset($m4ac_c1m92xtgl8z[0]) && $m4ac_c1m92xtgl8z[0] == 'showatts') { return implode(',', array_keys($m4ac_wdl2r3x6jg) ); } $m4ac_c1m92xtgl8z = shortcode_atts($m4ac_wdl2r3x6jg, $m4ac_c1m92xtgl8z, 'memberium'); $m4ac_lijhd0nspe = memberium_app()->m4ac_ytw30pxyqsr(); $m4ac_md7c8zsu2o = new stdClass; if ($m4ac_lijhd0nspe) { $m4ac_yf4u85k60d = add_query_arg('rss_user', $m4ac_lijhd0nspe, get_feed_link() ); } else { $m4ac_yf4u85k60d = get_feed_link(); } $m4ac_md7c8zsu2o->feed_url = $m4ac_yf4u85k60d; $m4ac_md7c8zsu2o->mode = strtolower($m4ac_c1m92xtgl8z['mode']); $m4ac_md7c8zsu2o->style = $m4ac_c1m92xtgl8z['style']; $m4ac_md7c8zsu2o->key = $m4ac_lijhd0nspe; return m4ac_audvsgbhpw::m4ac_ltnm5sge8_($m4ac_kp6zrjntmf78, $m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd, $m4ac_kp6zrjntmf78, $m4ac_md7c8zsu2o);  } static
function m4ac_u2_6pq3wk($m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd = null, $m4ac_kp6zrjntmf78 = '') { $m4ac_wdl2r3x6jg = [ 'after' => '', 'before' => '', 'capture' => '', 'fields' => '', 'htmlattr' => '', 'separator' => ' ', 'txtfmt' => '', ]; if (isset($m4ac_c1m92xtgl8z[0]) && $m4ac_c1m92xtgl8z[0] == 'showatts') { return implode(',', array_keys($m4ac_wdl2r3x6jg) ); } $m4ac_c1m92xtgl8z = shortcode_atts($m4ac_wdl2r3x6jg, $m4ac_c1m92xtgl8z, 'memberium'); if (empty($m4ac_c1m92xtgl8z['fields'])) { return; } $m4ac_aocd0ub3gftq = explode(',', $m4ac_c1m92xtgl8z['fields']); $m4ac_pa2k7635qor = ''; foreach ($m4ac_aocd0ub3gftq as $m4ac_ur90k1f2dy) { $m4ac_ur90k1f2dy = strtolower(trim($m4ac_ur90k1f2dy) ); $m4ac_pa2k7635qor .= htmlspecialchars( memberium_app()->m4ac_u1avl_bn()->m4ac_u8cf5xh_0sbp($m4ac_ur90k1f2dy) ); if (count($m4ac_aocd0ub3gftq) > 1) { $m4ac_pa2k7635qor .= $m4ac_c1m92xtgl8z['separator']; } } return m4ac_audvsgbhpw::m4ac_teqln8w23g(false, $m4ac_pa2k7635qor, $m4ac_c1m92xtgl8z['txtfmt'], $m4ac_c1m92xtgl8z['capture'], $m4ac_c1m92xtgl8z['htmlattr'], $m4ac_c1m92xtgl8z['before'], $m4ac_c1m92xtgl8z['after']); } static
function m4ac_iqo5d1tzkn($m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd = null, $m4ac_kp6zrjntmf78 = '') { $m4ac_wdl2r3x6jg = [ 'alt' => '', 'capture' => '', 'css_class' => 'memberium-gravatar', 'default' => '', 'email' => false, 'rating' => 'g', 'size' => 32, 'title' => '', ]; if (isset($m4ac_c1m92xtgl8z[0]) && $m4ac_c1m92xtgl8z[0] == 'showatts') { return implode(',', array_keys($m4ac_wdl2r3x6jg) ); } $m4ac_c1m92xtgl8z = shortcode_atts($m4ac_wdl2r3x6jg, $m4ac_c1m92xtgl8z, 'memberium'); $m4ac_c1m92xtgl8z['size'] = ( (int) $m4ac_c1m92xtgl8z['size'] < 1) ? 32 : (int) $m4ac_c1m92xtgl8z['size']; $m4ac_c1m92xtgl8z['size'] = $m4ac_c1m92xtgl8z['size'] > 2048 ? 2048 : $m4ac_c1m92xtgl8z['size']; if (! $m4ac_c1m92xtgl8z['email'] && isset ($_SESSION['memb_db_fields']) && isset($_SESSION['memb_db_fields']['%email%']) ) { $m4ac_c1m92xtgl8z['email'] = $_SESSION['memb_db_fields']['%email%']; } $m4ac_n3gu2feos7 = '//www.gravatar.com/avatar/' . md5($m4ac_c1m92xtgl8z['email']) . '.jpg?s=' . (int) $m4ac_c1m92xtgl8z['size']; $m4ac_n3gu2feos7 .= ($m4ac_c1m92xtgl8z['default'] > '') ? '&d=' . urlencode($m4ac_c1m92xtgl8z['default']) : ''; $m4ac_n3gu2feos7 .= ($m4ac_c1m92xtgl8z['rating'] > '') ? '&r=' . urlencode($m4ac_c1m92xtgl8z['rating']) : ''; $m4ac_md7c8zsu2o = new stdClass; $m4ac_md7c8zsu2o->alt = esc_attr($m4ac_c1m92xtgl8z['alt']); $m4ac_md7c8zsu2o->css_class = $m4ac_c1m92xtgl8z['css_class']; $m4ac_md7c8zsu2o->email = $m4ac_c1m92xtgl8z['email']; $m4ac_md7c8zsu2o->rating = $m4ac_c1m92xtgl8z['rating']; $m4ac_md7c8zsu2o->size = esc_attr($m4ac_c1m92xtgl8z['size']); $m4ac_md7c8zsu2o->title = esc_attr($m4ac_c1m92xtgl8z['title']); $m4ac_md7c8zsu2o->url = $m4ac_n3gu2feos7; $m4ac_pa2k7635qor = m4ac_audvsgbhpw::m4ac_ltnm5sge8_($m4ac_kp6zrjntmf78, $m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd, $m4ac_kp6zrjntmf78, $m4ac_md7c8zsu2o); if ($m4ac_c1m92xtgl8z['capture'] > '') { $m4ac_pa2k7635qor = m4ac_audvsgbhpw::m4ac_wz3nde9i($m4ac_pa2k7635qor, $m4ac_c1m92xtgl8z['capture']); } return $m4ac_pa2k7635qor; } static
function m4ac_d6r9c5tas0($m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd = null, $m4ac_kp6zrjntmf78 = '') { $m4ac_wdl2r3x6jg = [ 'contact_id' => memberium_app()->m4ac_w8ohueyv(), 'field' => '', 'values' => '', ]; if (isset($m4ac_c1m92xtgl8z[0]) && $m4ac_c1m92xtgl8z[0] == 'showatts') { return implode(',', array_keys($m4ac_wdl2r3x6jg) ); } $m4ac_c1m92xtgl8z = shortcode_atts($m4ac_wdl2r3x6jg, $m4ac_c1m92xtgl8z, 'memberium'); $m4ac_ur90k1f2dy = strtolower($m4ac_c1m92xtgl8z['field']); $m4ac_y0x7qa_kewg = memberium_app()->m4ac_zrj6g8l4ap9i($m4ac_c1m92xtgl8z['contact_id'], true); $m4ac_ur90k1f2dy = isset($m4ac_y0x7qa_kewg["%{$m4ac_ur90k1f2dy}%"]) && ! isset($m4ac_y0x7qa_kewg[$m4ac_ur90k1f2dy]) ? "%{$m4ac_ur90k1f2dy}%" : $m4ac_ur90k1f2dy; $m4ac_e9u_6xvdykag = isset($m4ac_y0x7qa_kewg[$m4ac_ur90k1f2dy]) ? $m4ac_y0x7qa_kewg[$m4ac_ur90k1f2dy] : ''; $m4ac_pa2k7635qor = ''; if (! is_array($m4ac_e9u_6xvdykag) ) { if (stripos($m4ac_e9u_6xvdykag, '||') !== false) { $m4ac_e9u_6xvdykag = explode('||', $m4ac_e9u_6xvdykag); } elseif (! is_array($m4ac_e9u_6xvdykag) ) { $m4ac_e9u_6xvdykag = explode(',', $m4ac_e9u_6xvdykag); } else { $m4ac_e9u_6xvdykag = (array) $m4ac_e9u_6xvdykag; } } $m4ac_e9u_6xvdykag = array_map('strtolower', array_filter($m4ac_e9u_6xvdykag) ); $m4ac_c1m92xtgl8z['values'] = stripos($m4ac_c1m92xtgl8z['values'], '||') !== false ? array_filter(explode('||', $m4ac_c1m92xtgl8z['values']) ) : $m4ac_c1m92xtgl8z['values']; $m4ac_c1m92xtgl8z['values'] = is_string($m4ac_c1m92xtgl8z['values']) && stripos($m4ac_c1m92xtgl8z['values'], ',') !== false ? array_filter(explode(',', $m4ac_c1m92xtgl8z['values']) ) : $m4ac_c1m92xtgl8z['values']; if (! empty($m4ac_c1m92xtgl8z['values']) && is_array($m4ac_c1m92xtgl8z['values']) ) { foreach($m4ac_c1m92xtgl8z['values'] as $m4ac_ukqvxo6ne7) { $m4ac_tp09y21w7hcn = in_array(strtolower($m4ac_ukqvxo6ne7), $m4ac_e9u_6xvdykag) ? ' selected="selected" ' : ''; $m4ac_pa2k7635qor .= "<option value='{$m4ac_ukqvxo6ne7}' {$m4ac_tp09y21w7hcn}>{$m4ac_ukqvxo6ne7}</option>"; } } return $m4ac_pa2k7635qor; } static
function m4ac_a6qhtbkxui($m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd = '', $m4ac_kp6zrjntmf78 = '') { static $m4ac_xqndufev = 0; if (! m4ac_tl5skz6cfptr::m4ac_e28auldn() ) { return; } $m4ac_xqndufev++; $m4ac_c4qc56391fd = trim($m4ac_c4qc56391fd); $m4ac_wdl2r3x6jg = [ 'allow_existing' => false, 'autologin' => false, 'automation_id' => '', 'css_class' => '', 'css_id' => '', 'date_fields' => '', 'failure_url' => '', 'form_id' => '', 'list_id' => '', 'pass_fields' => false, 'pass_password' => false, 'remove_accents' => 'n', 'required_fields' => 'firstname,email', 'success_url' => '', 'tag_id' => '', ]; if (isset($m4ac_c1m92xtgl8z[0]) && $m4ac_c1m92xtgl8z[0] == 'showatts') { return implode(',', array_keys($m4ac_wdl2r3x6jg) ); } if (memberium_app()->m4ac_k6b8c0f7g5() ) { if (empty($m4ac_c4qc56391fd) ) { return '<p style="color:red;"><strong>ERROR:</strong>  No Form Specified</pre>'; } if (stripos($m4ac_c4qc56391fd, '<input') === false || stripos($m4ac_c4qc56391fd, 'first_name') === false || stripos($m4ac_c4qc56391fd, 'email') === false) { return '<p style="color:red;"><strong>ERROR:</strong>  Your form must include both the <strong>first_name</strong>, and <strong>email</strong> input fields in order to register a new contact.</p>'; } return '<p style="color:red;"><strong>NOTE:</strong>  Registration form is only displayed when not logged in.</p>'; } if (empty($m4ac_c4qc56391fd) ) { return ''; } if (function_exists('is_user_logged_in') && is_user_logged_in() ) { return; } $m4ac_c1m92xtgl8z = shortcode_atts($m4ac_wdl2r3x6jg, $m4ac_c1m92xtgl8z, 'memberium'); $m4ac_c1m92xtgl8z['allow_existing'] = m4ac_audvsgbhpw::m4ac_nw4k98ogv($m4ac_c1m92xtgl8z['allow_existing'], false); $m4ac_c1m92xtgl8z['autologin'] = m4ac_audvsgbhpw::m4ac_nw4k98ogv($m4ac_c1m92xtgl8z['autologin'], false); $m4ac_c1m92xtgl8z['pass_fields'] = m4ac_audvsgbhpw::m4ac_nw4k98ogv($m4ac_c1m92xtgl8z['pass_fields'], false); $m4ac_c1m92xtgl8z['pass_password'] = m4ac_audvsgbhpw::m4ac_nw4k98ogv($m4ac_c1m92xtgl8z['pass_password'], false); if (trim($m4ac_c1m92xtgl8z['form_id']) == '') { $m4ac_c1m92xtgl8z['form_id'] = 'registration_form_' . $m4ac_xqndufev; } $m4ac_md7c8zsu2o = [ 'allow_existing' => $m4ac_c1m92xtgl8z['allow_existing'], 'autologin' => $m4ac_c1m92xtgl8z['autologin'], 'automation_id' => $m4ac_c1m92xtgl8z['elv_automation_id'], 'date_fields' => $m4ac_c1m92xtgl8z['date_fields'], 'failure_url' => $m4ac_c1m92xtgl8z['failure_url'], 'form_id' => $m4ac_c1m92xtgl8z['form_id'], 'list_id' => $m4ac_c1m92xtgl8z['list_id'], 'pass_fields' => $m4ac_c1m92xtgl8z['pass_fields'], 'pass_password' => $m4ac_c1m92xtgl8z['pass_password'], 'remove_accents' => $m4ac_c1m92xtgl8z['remove_accents'], 'required_fields' => $m4ac_c1m92xtgl8z['required_fields'], 'success_url' => $m4ac_c1m92xtgl8z['success_url'], 'tag_id' => $m4ac_c1m92xtgl8z['tag_id'], ]; $m4ac_l4jedymt8w3x = base64_encode(serialize($m4ac_md7c8zsu2o) ); $m4ac_vejbrg5i = memberium_app()->m4ac_s5ze6qlragdu($m4ac_l4jedymt8w3x); $m4ac_pbk61dwjnxi = ''; $m4ac_md7c8zsu2o = new stdClass; $m4ac_md7c8zsu2o->css_class = $m4ac_c1m92xtgl8z['css_class']; $m4ac_md7c8zsu2o->css_id = $m4ac_c1m92xtgl8z['css_id']; $m4ac_md7c8zsu2o->nonce = wp_nonce_field($m4ac_l4jedymt8w3x, '_wpnonce', true, false); $m4ac_md7c8zsu2o->parameters = $m4ac_l4jedymt8w3x; $m4ac_md7c8zsu2o->signature = $m4ac_vejbrg5i; $m4ac_md7c8zsu2o->messages = []; if (! empty($_SESSION['error_message']) ) { if (is_array($_SESSION['error_message'])) { foreach ($_SESSION['error_message'] as $m4ac_zr9fojweg7) { $m4ac_md7c8zsu2o->messages[] = $m4ac_zr9fojweg7; } } else { $m4ac_md7c8zsu2o->messages[] = $_SESSION['error_message']; } unset($_SESSION['error_message']); } return m4ac_audvsgbhpw::m4ac_ltnm5sge8_($m4ac_kp6zrjntmf78, $m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd, $m4ac_kp6zrjntmf78, $m4ac_md7c8zsu2o); } static
function m4ac__89rqhwo($m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd = null, $m4ac_kp6zrjntmf78 = '') {
  $m4ac_uo08x_g7 = memberium_app()->m4ac_w8ohueyv();
    // $log = new WC_Logger();
    // $log->log( 'bt_memb_sync_contact::', $m4ac_uo08x_g7 );
  if ($m4ac_uo08x_g7) { memberium_app()->m4ac_q4exg8ji7w_v($m4ac_uo08x_g7);
   } } static
function m4ac_lnegj809o($m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd = null, $m4ac_kp6zrjntmf78 = '') { if (is_user_logged_in() ) { do_action('memberium/session/updated', get_current_user_id(), $_SESSION); } } static
function m4ac_q7ip892srdt($m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd = null, $m4ac_kp6zrjntmf78 = '') { $m4ac_wdl2r3x6jg = [ 'after' => '', 'before' => '', 'capture' => '', 'default' => '', 'fieldname' => '', 'htmlattr' => '', 'txtfmt' => '', ]; if (isset($m4ac_c1m92xtgl8z[0]) && $m4ac_c1m92xtgl8z[0] == 'showatts') { return implode(',', array_keys($m4ac_wdl2r3x6jg) ); } $m4ac_c1m92xtgl8z = shortcode_atts($m4ac_wdl2r3x6jg, $m4ac_c1m92xtgl8z, 'memberium'); if (empty($m4ac_c1m92xtgl8z['fieldname']) ) { return; } $m4ac_fheyfujga6 = wp_get_current_user(); $m4ac_ur90k1f2dy = $m4ac_c1m92xtgl8z['fieldname']; $m4ac_pa2k7635qor = empty($m4ac_fheyfujga6->$m4ac_ur90k1f2dy) ? $m4ac_c1m92xtgl8z['default'] : $m4ac_fheyfujga6->$m4ac_ur90k1f2dy; return m4ac_audvsgbhpw::m4ac_teqln8w23g(false, $m4ac_pa2k7635qor, $m4ac_c1m92xtgl8z['txtfmt'], $m4ac_c1m92xtgl8z['capture'], $m4ac_c1m92xtgl8z['htmlattr'], $m4ac_c1m92xtgl8z['before'], $m4ac_c1m92xtgl8z['after']); } static
function m4ac_b2lq0tga($m4ac_c1m92xtgl8z = [], $m4ac_c4qc56391fd = null, $m4ac_kp6zrjntmf78 = '') { $m4ac_wdl2r3x6jg = [ 'after' => '', 'before' => '', 'capture' => '', 'default' => '', 'fieldname' => '', 'htmlattr' => '', 'txtfmt' => '', ]; if (isset($m4ac_c1m92xtgl8z[0]) && $m4ac_c1m92xtgl8z[0] == 'showatts') { return implode(',', array_keys($m4ac_wdl2r3x6jg) ); } $m4ac_c1m92xtgl8z = shortcode_atts($m4ac_wdl2r3x6jg, $m4ac_c1m92xtgl8z, 'memberium'); $m4ac_pa2k7635qor = $m4ac_c1m92xtgl8z['default']; if (is_user_logged_in() ) { $m4ac_pa2k7635qor = get_user_meta(get_current_user_id(), $m4ac_c1m92xtgl8z['fieldname'], true); $m4ac_pa2k7635qor = $m4ac_pa2k7635qor === false ? $m4ac_c1m92xtgl8z['default'] : $m4ac_pa2k7635qor; if (is_array($m4ac_pa2k7635qor)) { $m4ac_pa2k7635qor = json_encode($m4ac_pa2k7635qor, JSON_PRETTY_PRINT | JSON_INVALID_UTF8_SUBSTITUTE); } } return m4ac_audvsgbhpw::m4ac_teqln8w23g(false, $m4ac_pa2k7635qor, $m4ac_c1m92xtgl8z['txtfmt'], $m4ac_c1m92xtgl8z['capture'], $m4ac_c1m92xtgl8z['htmlattr'], $m4ac_c1m92xtgl8z['before'], $m4ac_c1m92xtgl8z['after']); } static
function m4ac__of6v49ghix_($m4ac_c1m92xtgl8z = [], $m4ac_c4qc56391fd = null, $m4ac_kp6zrjntmf78 = '') { static $m4ac_rex7bvpq = ''; $m4ac_wdl2r3x6jg = [ 'length' => memberium_app()->m4ac_x280qrz9kmic('min_password_length'), 'repeat' => true, 'strength' => memberium_app()->m4ac_x280qrz9kmic('password_strength'), ]; if (isset($m4ac_c1m92xtgl8z[0]) && $m4ac_c1m92xtgl8z[0] == 'showatts') { return implode(',', array_keys($m4ac_wdl2r3x6jg) ); } $m4ac_c1m92xtgl8z = shortcode_atts($m4ac_wdl2r3x6jg, $m4ac_c1m92xtgl8z, 'memberium'); $m4ac_c1m92xtgl8z['repeat'] = m4ac_audvsgbhpw::m4ac_nw4k98ogv($m4ac_c1m92xtgl8z['repeat'], true); if ( empty($m4ac_rex7bvpq) || $m4ac_c1m92xtgl8z['repeat'] == false ) { $m4ac_rex7bvpq = memberium_app()->m4ac__oezsglai( $m4ac_c1m92xtgl8z['length'], $m4ac_c1m92xtgl8z['strength'] ); } return $m4ac_rex7bvpq; }  } }