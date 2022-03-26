<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (! defined('ABSPATH') ) { die(); } echo '<form method="POST" action="">'; wp_nonce_field(MEMBERIUM_MODULES_DIR, 'memberium_options_nonce'); echo '<ul>'; echo '<hr>'; echo '<h3>Page Handling</h3>';  $m4ac_ah90o86m = [ 'label' => 'Automatic Paragraphs', 'value' => memberium_app()->m4ac_x280qrz9kmic('wp_autop'), 'style' => 'width:250px;', 'class' => 'basic-single', 'help_id' => 21389, 'options' => [ 0 => 'No action', 1 => 'Disable Automatic Paragraphs', 2 => 'Delay Automatic Paragraphs' ], ]; $this->m4ac_rrsf4v236k('wp_autop', $m4ac_ah90o86m); echo $this->m4ac_l1fpox937i8d('Personal Menus', 'dynamic_menus', 16108); echo $this->m4ac_l1fpox937i8d('Two Pass Shortcode Handling', 'two_pass_shortcodes', 8227); echo $this->m4ac_l1fpox937i8d('Force Cache Flush', 'cache_flush', 9636); echo $this->m4ac_l1fpox937i8d('Enable ActiveCampaign Tracking', 'enable_ac_tracking', 10118); echo '<li><label>Registration Page</label><input type="text" id="registration_url" class="dropdown pagelistdropdown" value="', (int) memberium_app()->m4ac_x280qrz9kmic('registration_url'), '" name="registration_url" >'; echo m4ac_s126v0fexga::m4ac_e_rxkt9u(0000), '</li>'; echo '</ul>'; echo '<p><input type="submit" value="Update" class="button-primary"></p>'; echo '</form>';
