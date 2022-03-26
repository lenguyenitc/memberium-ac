<?php
/**
 * Copyright (c) 2012-2021 David J Bullock
 * Web Power and Light
 */

 if (! defined('ABSPATH') ) { die(); } global $wpdb; if (! current_user_can('manage_options') ) { wp_die(__('You do not have sufficient permissions to access this page.') ); } $_GET['tab'] = isset($_GET['tab']) ? $_GET['tab'] : 'credits'; memberium_app()->m4ac_ftm2xflo(); if ($_SERVER['REQUEST_METHOD'] == 'POST') { if ($_GET['tab'] === 'updates') { $this->m4ac_g3ne76s9bjm('Updates Options Updated'); if (isset($_POST['autoupdate']) ) { memberium_app()->m4ac_vlpfetc4son5( (int) (bool) $_POST['autoupdate'], 'autoupdate'); } if (! empty($_POST['manual_upgrade_confirm']) ) { $this->m4ac_ovo9zsk5mhqw($_POST['manual_upgrade']); } } elseif (isset($_GET['purge-contacts']) ) { $m4ac_p80burja5 = MEMBERIUM_DB_CONTACTS; $m4ac_xtcz6bi97flk = "TRUNCATE `{$m4ac_p80burja5}` "; $m4ac_d98u4tqs5ew = $wpdb->query($m4ac_xtcz6bi97flk); $this->m4ac_g3ne76s9bjm('Local Contact Database Purged', 'update'); } if (empty($_GET['tab']) || $_GET['tab'] == 'checklist') { foreach ($_POST as $m4ac_ukqvxo6ne7 => $m4ac_ihnr7cyv) { if ($m4ac_ihnr7cyv == '1') { memberium_app()->m4ac_fuen6oxg($m4ac_ukqvxo6ne7); } } } if (isset($_GET['tab']) && $_GET['tab'] == 'debug' && isset($_POST['delete-debug']) && $_POST['delete-debug'] > '') { unlink(MEMBERIUM_DEBUGLOG); } if (isset($_GET['tab']) && $_GET['tab'] == 'checklist') { } }  $this->m4ac_eyfki_0es(); $m4ac_i8a6nj1oc5hl = []; $m4ac_i8a6nj1oc5hl['credits'] = '<i class="fa fa-users"></i> Credits';  echo '<div class="wrap about-wrap memberium">'; echo '<img src="//memberium.com/wp-content/uploads/2014/09/memberium-home-illustration6.png" width="125" style="float:right; border-radius:10px;">'; echo '<h3 style="text-align:left;font-size:240%;">', _('Welcome to<br />Memberium for ActiveCampaign'), ' v', memberium_app()->m4ac_lx4jv6fi7k(), '</h3>'; echo '<div class="about-text">'; echo _e('Thank you!  We&rsquo;re activated and ready to help you build your own private Membership community.  <br />'); echo '</div>'; echo '</div>'; echo '<div class="wrap">';  $m4ac_rlcs0yj3fk1 = $this->m4ac_d8yqavu9w($m4ac_i8a6nj1oc5hl); echo '<div class="tabcontent" style="margin-top:10px;">'; $m4ac_us5k0l_jb = m4ac_tl5skz6cfptr::m4ac_gd1pbm4e(); $m4ac_vj7al2oxz = MEMBERIUM_SCREEN_DIR . 'admin-starthere-' . $_GET['tab'] .'-show.php'; if (file_exists($m4ac_vj7al2oxz) ) { include_once $m4ac_vj7al2oxz; } echo '</div>'; echo '</div>';