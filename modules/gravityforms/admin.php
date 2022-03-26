<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (class_exists('m4ac_asnmzejyvl') ) { 
class m4ac_bhr0mxe6j { 
function m4ac_pu_0axtbv() { ?>
			<script type='text/javascript'>
			//adding setting to fields of type "text"
			fieldSettings.text += ", .memberiumfieldsync";

			//binding to the load field settings event to initialize the checkbox
			jQuery(document).bind("gform_load_field_settings", function(event, field, form){
				jQuery("#memberiumfieldsync").val(field["memberiumfieldsync"]);
			});
			</script>
			<?php
 } 
function m4ac_rpye0gw4nu3($m4ac_zyfp8awxq1, $m4ac_fy6qjxi1dn5) { static $seen = []; if (! empty($seen[$m4ac_fy6qjxi1dn5][$m4ac_zyfp8awxq1])) { return; } if ($m4ac_zyfp8awxq1 == 50) { $m4ac_u9uhl_ci87 = memberium_app()->m4ac_n_1ak7e32(); $m4ac_m1olqyceu6 = [ strtolower( trim( memberium_app()->m4ac_x280qrz9kmic('password_field'), '%' ) ), ]; foreach($m4ac_u9uhl_ci87 as $m4ac_ukqvxo6ne7 => $m4ac_ur90k1f2dy) { if (in_array($m4ac_ur90k1f2dy, $m4ac_m1olqyceu6) ) { unset($m4ac_u9uhl_ci87[$m4ac_ukqvxo6ne7]); } } unset($m4ac_ukqvxo6ne7, $m4ac_m1olqyceu6); ?>
				<!-- li class="default_value_setting admin_label_setting field_setting" -->
				<li class="admin_label_setting field_setting">
				<label for="field_admin_label" class="section_label">
				Memberium Sync
				<?php ?>

				</label>
				<select id="memberiumfieldsync" onchange="SetFieldProperty('memberiumfieldsync', this.value);" >
				<option value="">(None)</option>
				<?php
 if (is_array($m4ac_u9uhl_ci87) ) { foreach($m4ac_u9uhl_ci87 as $m4ac_wc9s2dnt4y) { echo '<option value="', $m4ac_wc9s2dnt4y, '">' . $m4ac_wc9s2dnt4y . '</option>'; } } ?>
				</select>
				</li>
				<?php
 } $seen[$m4ac_fy6qjxi1dn5][$m4ac_zyfp8awxq1] = 1; } private 
function m4ac_rh6ijntd() { add_action('gform_field_advanced_settings', [$this, 'm4ac_rpye0gw4nu3'], 10, 2); add_action('gform_editor_js', [$this, 'm4ac_pu_0axtbv']); } private 
function __construct() { $this->m4ac_rh6ijntd(); } static 
function m4ac_zw_dhmca() : self { static $m4ac_u4tpxcro19 = false; return $m4ac_u4tpxcro19 ? $m4ac_u4tpxcro19 : $m4ac_u4tpxcro19 = new self; } } }
