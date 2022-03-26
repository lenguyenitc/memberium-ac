<?php
 if (class_exists('m4ac_c6rqypiacz4') ) { 
class m4ac_kcy5l6erqaot { 
function m4ac_lx0fs6j4t($m4ac_qb48jahn0kc, $m4ac_lj_fwoc5ub1y, $m4ac_maz5nvkp) { $m4ac_qb48jahn0kc[$m4ac_lj_fwoc5ub1y]['buddypress_profile_type'] = empty($m4ac_qb48jahn0kc[$m4ac_lj_fwoc5ub1y]['buddypress_profile_type']) ? '' : $m4ac_qb48jahn0kc[$m4ac_lj_fwoc5ub1y]['buddypress_profile_type']; if (isset($m4ac_maz5nvkp['buddypress_profile_type'])) { $m4ac_qb48jahn0kc[$m4ac_lj_fwoc5ub1y]['buddypress_profile_type'] = $m4ac_maz5nvkp['buddypress_profile_type']; } return $m4ac_qb48jahn0kc; } 
function m4ac_i4x6wafn($m4ac_qb48jahn0kc) { if (function_exists('bp_get_member_types') ) { $m4ac_qjmwcbto9 = bp_get_member_types([], ''); if (! empty($m4ac_qjmwcbto9) && is_array($m4ac_qjmwcbto9) ) { $m4ac_qb48jahn0kc['buddypress_profile_type'] = empty($m4ac_qb48jahn0kc['buddypress_profile_type']) ? '' : $m4ac_qb48jahn0kc['buddypress_profile_type']; echo '<h3>BuddyPress</h3>'; echo '<li>'; echo '<label>Profile Type</label>'; echo '<input value="" name="buddypress_profile_type" type="hidden">'; echo '<select style="width:400px; height:1.6em;" class="roles-selector" name="buddypress_profile_type" placeholder="Select the BuddyPress profile type to apply on login">'; echo '<option value="">(None)</option>'; foreach($m4ac_qjmwcbto9 as $m4ac_ukqvxo6ne7 => $m4ac_mcgw3_2ib8u) { $m4ac_sv5rmko0 = isset($m4ac_mcgw3_2ib8u->labels['name']) ? $m4ac_mcgw3_2ib8u->labels['name'] : $m4ac_sv5rmko0; echo '<option value="', $m4ac_ukqvxo6ne7, '" ', $m4ac_ukqvxo6ne7 == $m4ac_qb48jahn0kc['buddypress_profile_type'] ? ' selected="selected" ' : '', '>', $m4ac_sv5rmko0, '</option>'; } echo '</select>', m4ac_s126v0fexga::m4ac_e_rxkt9u(0000 ); echo '</li><br />'; } } } 
function m4ac_svixrd4p_7() { global $wpdb; $m4ac_u9uhl_ci87 = [ 'memberium_roles', 'memberium/roles', "{$wpdb->prefix}user_level", "{$wpdb->prefix}capabilities", 'bp_xprofile_visibility_levels', ]; return $m4ac_u9uhl_ci87; } 
function m4ac_le8zobag7($m4ac_fn0vehzwk5r) { $m4ac_lj_fwoc5ub1y = (int) $m4ac_fn0vehzwk5r->id; if ($m4ac_lj_fwoc5ub1y) { $m4ac_upwqy_51nxj = m4ac_ght6_dfuw87::m4ac_zw_dhmca()->m4ac_bpj9gib0t(); $m4ac_ihnr7cyv = array_key_exists($m4ac_lj_fwoc5ub1y, $m4ac_upwqy_51nxj) ? $m4ac_upwqy_51nxj[$m4ac_lj_fwoc5ub1y] : ''; } else { $m4ac_ihnr7cyv = ''; } ?>
			<div class="postbox">
				<h2>
				<label for="memberium-usermeta-mapping"><?php esc_html_e( 'Memberium UserMeta Mapping', 'memberium' ); ?></label></h2>
				<div class="inside">
					<div>
						<input type="text" name="memberium-usermeta-mapping" id="memberium-usermeta-mapping" value="<?php echo $m4ac_ihnr7cyv; ?>" placeholder="Leave Blank to Disable" style="width:100%">
					</div>
				</div>
			</div>
			<?php
 } 
function m4ac_jrt0f4p5($m4ac_fn0vehzwk5r) { $m4ac_lj_fwoc5ub1y = $m4ac_fn0vehzwk5r->id; if (! $m4ac_lj_fwoc5ub1y) { return; } $m4ac_kbagjrq9 = isset($_POST['memberium-usermeta-mapping']) ? trim($_POST['memberium-usermeta-mapping']) : ''; if (in_array($m4ac_kbagjrq9, $this->m4ac_svixrd4p_7() ) ) { return; } $m4ac_upwqy_51nxj = m4ac_ght6_dfuw87::m4ac_zw_dhmca()->m4ac_bpj9gib0t(); if (in_array($m4ac_kbagjrq9, $m4ac_upwqy_51nxj)) { return; } if (empty($m4ac_kbagjrq9)) { unset($m4ac_upwqy_51nxj[$m4ac_lj_fwoc5ub1y]); } else { $m4ac_upwqy_51nxj[$m4ac_lj_fwoc5ub1y] = $m4ac_kbagjrq9; } m4ac_ght6_dfuw87::m4ac_zw_dhmca()->m4ac_y2hj8ioyuefn($m4ac_upwqy_51nxj); } private 
function m4ac_rh6ijntd() { add_action('xprofile_field_after_sidebarbox', [$this, 'm4ac_le8zobag7']); add_action('xprofile_fields_saved_field', [$this, 'm4ac_jrt0f4p5']); add_action('memberium/memberships/edit', [$this, 'm4ac_i4x6wafn'], 10, 1); add_filter('memberium/memberships/save', [$this, 'm4ac_lx0fs6j4t'], 10, 3); } private 
function __construct() { $this->m4ac_rh6ijntd(); } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; } } }
