<?php
 if (class_exists('m4ac_c6rqypiacz4') ) { 
class m4ac_eltp7eu4f { private $m4ac_xhq87ztbe9 = 0; static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; } private 
function __construct() { $this->m4ac_rh6ijntd(); $this->m4ac_v48sf2rwq0op(); } private 
function m4ac_rh6ijntd() { if (function_exists('groups_get_groups') && class_exists('bp_groups_group') ) { add_action('memberium/session/updated', [$this, 'm4ac_cfmzjkcr6pgd'], 20, 2); add_action('bp_ready', [$this, 'm4ac_yynvwokuz']); add_action('bp_ready', [$this, 'm4ac_aym0n_ovdxi']); } } private 
function m4ac_v48sf2rwq0op() { add_shortcode('memb_buddypressgroup_grid', [$this, 'm4ac_vdkl_wv0axph']); } private 
function m4ac_gxw3265ho( $m4ac_jozc3lxp85 ) { $m4ac_g0rhz13y8sn = []; if (is_array($m4ac_jozc3lxp85)) { foreach($m4ac_jozc3lxp85 as $m4ac_cyn02pj85ko) { $m4ac_g0rhz13y8sn[] = $m4ac_cyn02pj85ko->id; } } return $m4ac_g0rhz13y8sn; } 
function m4ac_aym0n_ovdxi() { if ( is_user_logged_in() ) { $m4ac_at_5xofh = get_current_user_id(); if (get_user_meta( $m4ac_at_5xofh, 'memberium/buddypress/access/updated', true ) ) { do_action( 'memberium/session/updated', $m4ac_at_5xofh, $_SESSION ); delete_user_meta( $m4ac_at_5xofh, 'memberium/buddypress/access/updated' ); } } } 
function m4ac_dj70_hawik45( $m4ac_lj_fwoc5ub1y ) { return empty( $this->m4ac_xhq87ztbe9 ) ? $m4ac_lj_fwoc5ub1y : $this->m4ac_xhq87ztbe9; }  
function m4ac_cfmzjkcr6pgd($m4ac_at_5xofh, $m4ac__crsbi5yuze) { if (user_can( $m4ac_at_5xofh, 'manage_options' ) ) { return; } $m4ac_ah90o86m = [ 'show_hidden' => true, 'per_page' => 0, 'page' => 0, 'fields' => 'ids', ]; $m4ac_jozc3lxp85 = groups_get_groups( $m4ac_ah90o86m ); $m4ac_jozc3lxp85 = isset( $m4ac_jozc3lxp85['groups'] ) ? $m4ac_jozc3lxp85['groups'] : []; $m4ac_j0e14tousp_ = isset( $m4ac__crsbi5yuze['memb_user']['tag_ids'] ) ? array_filter( explode( ',', $m4ac__crsbi5yuze['memb_user']['tag_ids'] ) ) : []; if ( is_array( $m4ac_jozc3lxp85 ) && ! empty( $m4ac_jozc3lxp85 ) ) { add_filter('bp_loggedin_user_id', [$this, 'm4ac_dj70_hawik45'], PHP_INT_MAX, 1); $this->m4ac_xhq87ztbe9 = $m4ac_at_5xofh; $m4ac_ijm9e2x08sy = BP_Groups_Member::get_group_ids( $m4ac_at_5xofh )['groups']; $m4ac_ktad9fbqx506 = $this->m4ac_gxw3265ho( BP_Groups_Member::get_is_banned_of($m4ac_at_5xofh)['groups'] ); $m4ac_ug1f579eq = $this->m4ac_gxw3265ho( BP_Groups_Member::get_is_admin_of($m4ac_at_5xofh)['groups'] ); $m4ac_l_oh2n350 = $this->m4ac_gxw3265ho( BP_Groups_Member::get_is_mod_of($m4ac_at_5xofh)['groups'] ); $this->m4ac_xhq87ztbe9 = 0; remove_filter( 'bp_loggedin_user_id', 'm4ac_dj70_hawik45' ); foreach ( $m4ac_jozc3lxp85 as $m4ac_e01_avscgtu ) { $m4ac_miqhgs9pfyo = new BP_Groups_Member( $m4ac_at_5xofh, $m4ac_e01_avscgtu ); $m4ac_wvedziauxc = groups_get_groupmeta( $m4ac_e01_avscgtu, '_memberium/buddypress/autojoin' ); $m4ac_yebad2t8wi_ = [ 'autoban' => '', 'autojoin_admin' => '', 'autojoin_moderator' => '', 'autojoin_member' => '', ]; $m4ac_wvedziauxc = is_array( $m4ac_wvedziauxc ) ? $m4ac_wvedziauxc : []; $m4ac_wvedziauxc = array_merge( $m4ac_yebad2t8wi_, $m4ac_wvedziauxc ); $m4ac_wvedziauxc['autoban'] = isset( $m4ac_wvedziauxc['autoban'] ) ? array_filter( explode( ',', $m4ac_wvedziauxc['autoban'] ) ) : []; $m4ac_wvedziauxc['autojoin_admin'] = isset( $m4ac_wvedziauxc['autojoin_admin'] ) ? array_filter( explode( ',', $m4ac_wvedziauxc['autojoin_admin'] ) ) : []; $m4ac_wvedziauxc['autojoin_moderator'] = isset( $m4ac_wvedziauxc['autojoin_moderator'] ) ? array_filter( explode( ',', $m4ac_wvedziauxc['autojoin_moderator'] ) ) : []; $m4ac_wvedziauxc['autojoin_member'] = isset( $m4ac_wvedziauxc['autojoin_member'] ) ? array_filter( explode( ',', $m4ac_wvedziauxc['autojoin_member'] ) ) : []; $m4ac_xxb3veu0w = ! empty( $m4ac_wvedziauxc['autoban'] ); $m4ac_qdtb1hkql4 = ! empty( $m4ac_wvedziauxc['autojoin_moderator'] ); $m4ac_u6qrb18sev = ! empty( $m4ac_wvedziauxc['autojoin_admin'] ); $m4ac_zb9yik2m = $m4ac_u6qrb18sev || $m4ac_qdtb1hkql4 || (! empty($m4ac_wvedziauxc['autojoin_member'])); $m4ac_lf9zd7ik = in_array( $m4ac_e01_avscgtu, $m4ac_ktad9fbqx506 ); $m4ac_yo9tfumdjw = in_array( $m4ac_e01_avscgtu, $m4ac_l_oh2n350 ); $m4ac_b28d_brj9 = in_array( $m4ac_e01_avscgtu, $m4ac_ug1f579eq ); $m4ac_fu3b9oqsth = $m4ac_b28d_brj9 || $m4ac_yo9tfumdjw || in_array( $m4ac_e01_avscgtu, $m4ac_ijm9e2x08sy ); $m4ac_o0wta8xr = ! empty(array_intersect( $m4ac_wvedziauxc['autoban'], $m4ac_j0e14tousp_ ) ); $m4ac_cm374zwj = ! empty(array_intersect( $m4ac_wvedziauxc['autojoin_moderator'], $m4ac_j0e14tousp_ ) ); $m4ac_fbml4naew = ! empty(array_intersect( $m4ac_wvedziauxc['autojoin_admin'], $m4ac_j0e14tousp_ ) ); $m4ac_hm6evfickob = $m4ac_cm374zwj || $m4ac_fbml4naew || ( ! empty( array_intersect( $m4ac_wvedziauxc['autojoin_member'], $m4ac_j0e14tousp_ ) ) );  if ( $m4ac_xxb3veu0w ) { if ( $m4ac_o0wta8xr && ! $m4ac_lf9zd7ik ) { $m4ac_miqhgs9pfyo->demote(); $m4ac_miqhgs9pfyo->ban(); $m4ac_lf9zd7ik = true; } if ( ( ! $m4ac_o0wta8xr ) && $m4ac_lf9zd7ik ) { $m4ac_miqhgs9pfyo->unban(); $m4ac_lf9zd7ik = false; } } if ( ! $m4ac_lf9zd7ik ) { if ( $m4ac_zb9yik2m ) { if ( ( ! $m4ac_fu3b9oqsth ) && $m4ac_hm6evfickob ) { groups_join_group( $m4ac_e01_avscgtu, $m4ac_at_5xofh ); $m4ac_fu3b9oqsth = true; } elseif ( $m4ac_fu3b9oqsth && ( ! $m4ac_hm6evfickob ) ) { $m4ac_miqhgs9pfyo->remove(); $m4ac_fu3b9oqsth = false; } } } if ( ( ! $m4ac_lf9zd7ik ) && $m4ac_zb9yik2m ) { if ( $m4ac_qdtb1hkql4 ) { if ( $m4ac_cm374zwj && ( ! $m4ac_fbml4naew ) ) { $m4ac_miqhgs9pfyo->promote('mod'); } elseif ($m4ac_yo9tfumdjw && ! $m4ac_cm374zwj && ! $m4ac_fbml4naew ) { $m4ac_miqhgs9pfyo->demote('mod'); } } if ( $m4ac_u6qrb18sev ) { if ( ! $m4ac_b28d_brj9 && $m4ac_fbml4naew ) { $m4ac_miqhgs9pfyo->promote( 'admin' ); } elseif ( $m4ac_b28d_brj9 && ! $m4ac_fbml4naew ) { $m4ac_miqhgs9pfyo->demote( 'admin' ); } } } } } } 
function m4ac_yynvwokuz() { $m4ac_rvl9seywoj6 = m4ac_ght6_dfuw87::m4ac_zw_dhmca()->m4ac_jw39xlcjk(); if (! empty($m4ac_rvl9seywoj6) && is_array($m4ac_rvl9seywoj6) ) { foreach($m4ac_rvl9seywoj6 as $m4ac_at_5xofh => $m4ac__crsbi5yuze) { m4ac_cfmzjkcr6pgd($m4ac_at_5xofh, $m4ac__crsbi5yuze); delete_user_meta($m4ac_at_5xofh, 'memberium/buddypress/access/updated'); } } } 
function m4ac_vdkl_wv0axph($m4ac_c1m92xtgl8z, $m4ac_c4qc56391fd = null, $m4ac_kp6zrjntmf78 = '') { return; $m4ac_wdl2r3x6jg = [ 'img_size' => '120', ]; $m4ac_c1m92xtgl8z = shortcode_atts($m4ac_wdl2r3x6jg, $m4ac_c1m92xtgl8z, 'memberium'); $m4ac_ah90o86m = [ 'type' => 'alphabetical', 'per_page' => 999 ]; $m4ac_ds7ad3w0 = $m4ac_jozc3lxp85 = BP_Groups_Group::get($m4ac_ah90o86m); print_r( $m4ac_ds7ad3w0 ); } } }