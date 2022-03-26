<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (! defined('ABSPATH') ) { die(); } memberium_app()->m4ac_fuen6oxg('view_integrations'); $m4ac_z_eb83ux = $this->m4ac_q50_ep3k1(); $m4ac_uwndrie7zq9u = false; m4ac_facomelvsiku($m4ac_z_eb83ux); m4ac_b2fgvcryzj($m4ac_z_eb83ux); m4ac_ajfkhgaw($m4ac_z_eb83ux); 
function m4ac_ajfkhgaw($m4ac_z_eb83ux) { echo '<h3>Available Integrations</h3>'; echo '<p class="indented">'; if (! empty($m4ac_z_eb83ux['available']) ) { foreach ($m4ac_z_eb83ux['available'] as $integration) { echo $integration['name']; if (! empty($integration['help']) ) { echo m4ac_s126v0fexga::m4ac_e_rxkt9u($integration['help']); } if (! empty($integration['link']) ) { echo ' (<a href="', $integration['link'], '" target="_blank">Read More</a>)'; } echo '<br>'; } } else { echo 'No additional available integrations.<br>'; } echo '</p>'; } 
function m4ac_facomelvsiku($m4ac_z_eb83ux) { if (! empty($m4ac_z_eb83ux['detected']) ) { $m4ac_uwndrie7zq9u = true; echo '<h3>Detected Integrations</h3>'; echo '<p class="indented">'; foreach ($m4ac_z_eb83ux['detected'] as $integration) { echo 'Detected: <span class="', $integration['class'], 'plugin">', $integration['name'], '</span>'; if ($integration['help'] > 0) { echo m4ac_s126v0fexga::m4ac_e_rxkt9u($plugin['help']); } echo '<br>'; } echo '</p>'; } if (! $m4ac_uwndrie7zq9u) { echo '<p>No Integrations Detected.</p>'; } } 
function m4ac_b2fgvcryzj($m4ac_z_eb83ux) { if (! empty($m4ac_z_eb83ux['problem']) ) { $m4ac_uwndrie7zq9u = true; echo '<h3>Potential conflicts</h3>'; echo '<p class="indented">'; foreach ($m4ac_z_eb83ux['problem'] as $integration) { echo 'Detected: <span class="badplugin ', $integration['class'], 'plugin">', $integration['name'], '</span>'; if ($integration['help'] > 0) { echo m4ac_s126v0fexga::m4ac_e_rxkt9u($plugin['help']); } echo '<br>'; } echo '</p>'; } }
