<?php
/**
* Copyright (c) 2018-2021 David J Bullock
* Web Power and Light
*/

 if (class_exists('m4ac_c6rqypiacz4') ) { 
class m4ac_ixt_z5jsy43 { static private 
function m4ac_gkf53solm() { $m4ac_h57xqitcp = self::$m4ac_h57xqitcp; $update_time = get_option('memberium-ac-sync-time', [] ); $m4ac_hn7gox1dw = []; $m4ac_q0if9_48vbyr = [];  if (empty($update_time['custom_fields']) || (time() - $update_time['custom_fields']) > 600) { memberium_app()->m4ac_p05w6kivzl4(); $update_time['custom_fields'] = time(); } if (empty($update_time['lists']) || (time() - $update_time['lists']) > 600) { memberium_app()->m4ac_yi6vneh3(); $update_time['lists'] = time(); } if (empty($update_time['tags']) || (time() - $update_time['tags']) > 600) { memberium_app()->m4ac_k7c1lfkywtju(); $update_time['tags'] = time(); } if (empty($update_time['automations']) || (time() - $update_time['automations']) > 600) { memberium_app()->m4ac_hvr5tkz6is(); $update_time['automations'] = time(); } update_option('memberium-ac-sync-time', $update_time, true); return $update_time; }  private static 
function m4ac_twrtyghj3_6() { global $wpdb; $m4ac_h57xqitcp = self::$m4ac_h57xqitcp; $table_name = MEMBERIUM_DB_AUTOMATIONS; $m4ac_xtcz6bi97flk = "SELECT count(`id`) from `{$table_name}` WHERE `appname` = '{$m4ac_h57xqitcp}' AND `status` = 1;"; $m4ac_g9fn685ibx['automations'] = $wpdb->get_var($m4ac_xtcz6bi97flk); $table_name = MEMBERIUM_DB_CONTACTS; $m4ac_xtcz6bi97flk = "SELECT count(`id`) from `{$table_name}` WHERE `fieldname` = '%EMAIL%' AND `appname` = '{$m4ac_h57xqitcp}' "; $m4ac_g9fn685ibx['contacts'] = (int) $wpdb->get_var($m4ac_xtcz6bi97flk); $table_name = MEMBERIUM_DB_FIELDS; $m4ac_xtcz6bi97flk = "SELECT count(`id`) from `{$table_name}` WHERE `appname` = '{$m4ac_h57xqitcp}'"; $m4ac_g9fn685ibx['custom_fields'] = $wpdb->get_var($m4ac_xtcz6bi97flk); $table_name = MEMBERIUM_DB_FORMS; $m4ac_xtcz6bi97flk = "SELECT count(`id`) from `{$table_name}` WHERE `appname` = '{$m4ac_h57xqitcp}'"; $m4ac_g9fn685ibx['forms'] = $wpdb->get_var($m4ac_xtcz6bi97flk); $table_name = MEMBERIUM_DB_LISTS; $m4ac_xtcz6bi97flk = "SELECT count(`id`) from `{$table_name}` WHERE `appname` = '{$m4ac_h57xqitcp}'"; $m4ac_g9fn685ibx['lists'] = $wpdb->get_var($m4ac_xtcz6bi97flk); $table_name = MEMBERIUM_DB_SESSIONS; $m4ac_xtcz6bi97flk = "SELECT count(`session_key`) from `{$table_name}` WHERE `email_key` > '' "; $m4ac_g9fn685ibx['sessions'] = (int) $wpdb->get_var($m4ac_xtcz6bi97flk); $table_name = MEMBERIUM_DB_TAGS; $m4ac_xtcz6bi97flk = "SELECT count(id) from {$table_name} WHERE `appname` = '{$m4ac_h57xqitcp}' "; $m4ac_g9fn685ibx['tags'] = (int) $wpdb->get_var($m4ac_xtcz6bi97flk); $table_name = $wpdb->postmeta; $m4ac_xtcz6bi97flk = "SELECT count(DISTINCT `post_id`) FROM `{$table_name}` WHERE meta_key LIKE '_memberium_%' AND meta_value > '';"; $m4ac_g9fn685ibx['protected_posts'] = (int) $wpdb->get_var($m4ac_xtcz6bi97flk); return $m4ac_g9fn685ibx; } private static 
function m4ac_u3nrqi79juh() {  m4ac_m4i8fbuxl::m4ac_qdzbg4uy(); } private static 
function m4ac_uas0l_u3zyqm() {  $m4ac_z_6opwls0e7 = m4ac_tl5skz6cfptr:: m4ac_a9x5p_oeaqu1(); if ($m4ac_z_6opwls0e7['valid']) { $license_status = '<b style="color:green;">Valid</b>'; } else { $license_status = '<b style="color:red;">Invalid</b> '; if ($m4ac_z_6opwls0e7['trial_mode']) { $license_status.= ' (Trial Mode)'; } } return $m4ac_z_6opwls0e7; } private static 
function m4ac_xdsc16jo() { if (MEMBERIUM_BETA) { echo '<label>Beta Mode</label><span class="metric"><strong style="color:red;">Beta</strong></span><br />'; } if (MEMBERIUM_DEBUG) { echo '<label>Debug Mode</label><span class="metric"><strong style="color:red;">ON</strong></span><br />'; } if (WP_DEBUG) { echo '<label>WordPress Debug Mode</label><span class="metric"><strong style="color:red;">ON</strong></span><br />'; } } private static 
function m4ac_zb9s63lx() { $m4ac_h57xqitcp = memberium_app()->m4ac_bztk3xj1(); $m4ac_w9gqelip4 = wp_using_ext_object_cache() ? '<strong style="color:green;">Enabled</strong>' : '<strong style="color:red;">Missing</strong>'; $m4ac_g9fn685ibx = self::m4ac_twrtyghj3_6($m4ac_h57xqitcp); $m4ac_us5k0l_jb = m4ac_tl5skz6cfptr::m4ac_gd1pbm4e(); $m4ac_kvuz76c3a = count(get_option(MEMBERIUM_MEMBERSHIP_SETTINGS, [] )); $m4ac__05hpcag6ve = strtoupper(MEMBERIUM_SKU); $m4ac_a24ktbplr_ = m4ac_f5ovcw_1iln::m4ac_mqkyuferc83(); $m4ac_y12sj7ngu_l = ucwords(memberium_app()->m4ac_lxda3js50urg() ); $m4ac_n145ehr20k6_ = get_bloginfo('version'); $m4ac_g46zqrds = count(get_option('cron', [] )); $m4ac_aw1_suboie = is_ssl() ? '<strong style="color:green;">Yes</strong>' : '<strong style="color:red;">No</strong>'; $m4ac_wc38soghd = is_multisite() ? 'Yes' : 'No'; $m4ac_b28d_brj9 = memberium_app()->m4ac_k6b8c0f7g5() ? '<strong class="membGood">Yes' : '<strong class="membWarning">No'; $m4ac_yklxpsa9i63b = ini_get('memory_limit'); $m4ac_irc4su3_l = intval(WP_MEMORY_LIMIT); $m4ac_cuaqbl8v = intval(WP_MAX_MEMORY_LIMIT); $m4ac_g1aetkjzdf = php_uname('s') . ' ' . php_uname('m'); $m4ac_o3kw2_4u1y = phpversion(); $m4ac_t40rfxltazsg = ini_get('display_errors') ? '<strong class="membWarning">Yes' : '<strong class="membGood">No'; $m4ac_jyg6uv7b = m4ac_p58mfx3cua::m4ac_teq1zlwih6() <> $_SERVER['REMOTE_ADDR'] ? '<strong style="color:green;">Yes</strong>' : 'No'; $m4ac_n145ehr20k6_ = memberium_app()->m4ac_cbc5pz_ng4(); $m4ac_xtz04kug = apply_filters('memberium/dashboard/metrics/system', []); echo '<label>WordPress User Count</label><span class="metric">', $m4ac_us5k0l_jb, '</span><br />'; echo '<label>Membership Levels</label><span class="metric">', $m4ac_kvuz76c3a, '</span><br />'; echo '<label>Protected Pages/Posts</label><span class="metric">', $m4ac_g9fn685ibx['protected_posts'], '</span><br />'; foreach($m4ac_xtz04kug as $m4ac_sv5rmko0 => $m4ac_ihnr7cyv) { echo "<label>{$m4ac_sv5rmko0}</label><span class='metric'>{$m4ac_ihnr7cyv}</span><br />"; } echo '<hr>'; echo '<label>SKU</label><span class="metric">', $m4ac__05hpcag6ve, '</span><br />'; echo '<label>WordPress Version</label><span class="metric">', $m4ac_n145ehr20k6_, '</span><br />'; echo '<label>WordPress Environment</label><span class="metric">', $m4ac_y12sj7ngu_l, '</span><br />'; echo '<label>WordPress Cron Jobs</label><span class="metric">', $m4ac_g46zqrds, '</span><br />'; echo '<label>WordPress SSL</label><span class="metric">', $m4ac_aw1_suboie, '</span><br />'; echo '<label>Wordpress Multisite</label><span class="metric"><strong>', $m4ac_wc38soghd, '</strong></span><br />'; echo '<label>Wordpress Super Admin</label><span class="metric">', $m4ac_b28d_brj9, '</strong></span><br />'; echo '<label>Wordpress Object Caching</label><span class="metric">', $m4ac_w9gqelip4, '</strong></span><br />'; echo '<hr>'; echo '<label>PHP Memory Allocated</label><span class="metric">', $m4ac_yklxpsa9i63b, 'B</span><br />'; echo '<label>WordPress Memory Limit</label><span class="metric">', $m4ac_irc4su3_l, 'MB</span><br />'; echo '<label>Admin Dashboard Memory Limit</label><span class="metric">', $m4ac_cuaqbl8v, 'MB</span><br />'; echo '<hr>'; echo '<label>Operating System</label><span class="metric">', $m4ac_g1aetkjzdf, '</span><br />'; echo '<label>PHP Version</label><span class="metric">', $m4ac_o3kw2_4u1y, '</span><br />'; echo '<label>Display Errors</label><span class="metric">', $m4ac_t40rfxltazsg, '</strong></span><br />'; echo '<label>SQL Version</label><span class="metric">', $m4ac_a24ktbplr_, '</span><br />'; echo '<label>Load Balancer / Proxy</label><span class="metric">', $m4ac_jyg6uv7b, '</span><br />'; } private static 
function m4ac_wthbxkl7_8g() { if (! empty($_GET['action'])) { if ($_GET['action'] == 'sync-tags') { memberium_app()->m4ac_k7c1lfkywtju(); } elseif ($_GET['action'] == 'sync-automations') { memberium_app()->m4ac_hvr5tkz6is(); } elseif ($_GET['action'] == 'sync-lists') { memberium_app()->m4ac_yi6vneh3(); } elseif ($_GET['action'] == 'sync-fields') { memberium_app()->m4ac_p05w6kivzl4(); } } } private static 
function m4ac_q7r8mkoaxne() { ?>
			<style>
				.membWarning { font-weight:bold; color:red; }
				.membGood { font-weight:bold; color:green; 	}
			</style>
			<?php
 } private static 
function m4ac_dr6tn9_5() { echo '<h3>System Metrics</h3>'; self::m4ac_xdsc16jo(); self::m4ac_zb9s63lx(); } private static 
function m4ac_jqv_d8j1o() { $m4ac_g9fn685ibx = self::m4ac_twrtyghj3_6(); $m4ac_q0if9_48vbyr = self::m4ac_gkf53solm(); $m4ac_xvstfiol = empty($m4ac_g9fn685ibx['automations']) ? 0 : (int) $m4ac_g9fn685ibx['automations']; $m4ac_tkdux7c65j2 = empty($m4ac_g9fn685ibx['custom_fields']) ? 0 : (int) $m4ac_g9fn685ibx['custom_fields']; $m4ac_fayn1ver = empty($m4ac_g9fn685ibx['forms']) ? 0 : (int) $m4ac_g9fn685ibx['forms']; $m4ac_p3hn29dkzmb = empty($m4ac_g9fn685ibx['lists']) ? 0 : (int) $m4ac_g9fn685ibx['lists']; $m4ac_qsywxdnb9h3 = empty($m4ac_g9fn685ibx['tags']) ? 0 : (int) $m4ac_g9fn685ibx['tags']; $m4ac_d98u4tqs5ew = empty($m4ac_g9fn685ibx['contacts']) ? 0 : (int) $m4ac_g9fn685ibx['contacts']; $m4ac_dsx0ecpvaoi = empty($m4ac_g9fn685ibx['sessions']) ? 0 : (int) $m4ac_g9fn685ibx['sessions']; $m4ac_wla6qjkzrsi = m4ac_s126v0fexga::m4ac_f2h0yfjeqws( (int) $m4ac_q0if9_48vbyr['automations']); $m4ac_ueb2mj0lxgo = m4ac_s126v0fexga::m4ac_f2h0yfjeqws( (int) $m4ac_q0if9_48vbyr['custom_fields']); $m4ac_eyixlwn31vb = m4ac_s126v0fexga::m4ac_f2h0yfjeqws( (int) $m4ac_q0if9_48vbyr['forms']); $m4ac_uak2r_ucv = m4ac_s126v0fexga::m4ac_f2h0yfjeqws( (int) $m4ac_q0if9_48vbyr['lists']); $m4ac_c_5fxkvjsd = m4ac_s126v0fexga::m4ac_f2h0yfjeqws( (int) $m4ac_q0if9_48vbyr['tags']); echo '<h3>ActiveCampaign Data Metrics</h3>'; echo '<label>Synced Tags</label><span class="metric">', $m4ac_qsywxdnb9h3, '</span> (', $m4ac_c_5fxkvjsd, ')<br />'; echo '<label>Synced Custom Fields</label><span class="metric">', $m4ac_g9fn685ibx['custom_fields'], '</span> (', m4ac_s126v0fexga::m4ac_f2h0yfjeqws( (int) $m4ac_q0if9_48vbyr['custom_fields']), ')<br />'; echo '<label>Synced Automations</label><span class="metric">', $m4ac_xvstfiol, '</span> (', $m4ac_wla6qjkzrsi, ')<br />'; echo '<label>Synced Lists</label><span class="metric">', $m4ac_p3hn29dkzmb, '</span> (', $m4ac_uak2r_ucv, ')<br />'; echo '<label>Synced Forms</label><span class="metric">', $m4ac_fayn1ver, '</span> (', $m4ac_eyixlwn31vb, ')<br />'; echo '<label>Active Sessions</label><span class="metric">', $m4ac_dsx0ecpvaoi, '</span><br />'; echo '<label>Cached Contacts</label><span class="metric">', $m4ac_d98u4tqs5ew, '</span><br />';   echo '<p>'; echo '<input type="submit" name="save" value="Synchronize ActiveCampaign" class="button-primary"> ', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000); echo '</p>'; } private static 
function m4ac_kbv5sz2j7() { $m4ac_ga3dz589uo = memberium_app()->m4ac_x280qrz9kmic('ac_api_verified'); $m4ac_z_6opwls0e7 = self::m4ac_uas0l_u3zyqm(); $m4ac_vask1to8ie6 = (boolean) $m4ac_ga3dz589uo ? '<span style="color:green;">Connected</span>' : '<span style="color:red;">Not Connected</span>'; $m4ac_xs9ykn8a = (boolean) $m4ac_z_6opwls0e7['valid'] ? '<strong style="color:green;">Yes</strong>' : '<strong style="color:red;">No</strong>'; echo '<h3>ActiveCampaign Connection</h3>'; echo '<form method="post" action="">'; echo "<label>App Name</label><b>", self::$m4ac_h57xqitcp, "</b><br />"; echo '<label>API Status</label><strong>', $m4ac_vask1to8ie6, '</strong><br />'; echo '<label>License Active</label><span>', $m4ac_xs9ykn8a, '</span><br />'; echo '<p>'; echo '<input type="submit" name="save" value="Renew License" class="button-primary" style="margin-right:20px;">'; echo '<input type="submit" name="save" value="Re-Activate Plugin" class="button-primary">'; echo '</p>'; } private static 
function m4ac_w07mrqh2sxlp() { self::$m4ac_h57xqitcp = memberium_app()->m4ac_bztk3xj1(); memberium_app()->m4ac_fuen6oxg('view_dashboard'); self::m4ac_u3nrqi79juh();  self::m4ac_wthbxkl7_8g(); } static 
function m4ac_lgfsc19jo3_r() { self::m4ac_w07mrqh2sxlp(); self::m4ac_q7r8mkoaxne(); m4ac_s126v0fexga::m4ac_e6yihrptl(); self::m4ac_kbv5sz2j7(); self::m4ac_jqv_d8j1o(); self::m4ac_dr6tn9_5(); echo '</form>'; } static $m4ac_h57xqitcp = ''; } m4ac_ixt_z5jsy43::m4ac_lgfsc19jo3_r(); }
