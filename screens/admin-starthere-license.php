<?php
/**
 * Copyright (c) 2018-2021 David J Bullock
 * Web Power and Light
 */

 if (!defined('ABSPATH') ) { die(); } if (! empty($_GET['action'])) { if ($_GET['action'] == 'update') { m4ac_tl5skz6cfptr::m4ac_f1w9jlh37i(); } } m4ac_i9s36j4d520b(); 
function m4ac_i9s36j4d520b() { $m4ac_w386fgqma2 = m4ac_tl5skz6cfptr::m4ac_a9x5p_oeaqu1(); $m4ac_j0e14tousp_ = array_filter(explode(',', $m4ac_w386fgqma2['tags'])); $m4ac_xf0crep7h1 = (bool) $m4ac_w386fgqma2['valid']; ?>
	<h3>License Status</h3>
	<div class="indented">
	<?php
 if (! $m4ac_xf0crep7h1) { echo '<p>No valid license</p>'; return; } $m4ac_ghqny9xr7ac = '<strong style="color:green;">Yes</strong>'; $m4ac_fuis1hr8 = '<strong style="color:red;">No</strong>'; $m4ac_nb8gpn93s2l = '<strong style="color:red;">Yes</strong>'; $m4ac_eqhspdut = '<strong style="color:green;">No</strong>'; $m4ac_ck8wtizso64 = (bool) $m4ac_w386fgqma2['active']; $m4ac_ru3vbteo0 = (bool) $m4ac_w386fgqma2['trial_mode']; $m4ac_au2txny6iwa1 = $m4ac_w386fgqma2['max_users'] < m4ac_tl5skz6cfptr::m4ac_gd1pbm4e(); $m4ac_ay_0mo97qdh = $m4ac_w386fgqma2['max_users'] == PHP_INT_MAX ? 'Unlimited' : number_format($m4ac_w386fgqma2['max_users']); $m4ac_oiz1yd5b6jue = in_array('unlimited', $m4ac_j0e14tousp_); $m4ac_g9ikgfj5xzuo = in_array('payf', $m4ac_j0e14tousp_); if (! empty($m4ac_w386fgqma2['owner_firstname']) ) { if (! empty($m4ac_w386fgqma2['owner_firstname'])) { echo '<label>Owner Name:</label>'; echo '<span>', $m4ac_w386fgqma2['owner_firstname'] . ' ' . $m4ac_w386fgqma2['owner_lastname'] , '</span><br />'; } if (! empty($m4ac_w386fgqma2['owner_email'])) { echo '<label>Owner Email:</label>'; echo "<span><a href='mailto:{$m4ac_w386fgqma2['owner_email']}'>{$m4ac_w386fgqma2['owner_email']}</a></span><br />"; } } if (! empty($m4ac_w386fgqma2['license_name'])) { echo '<label>License Name:</label>'; echo '<span>', $m4ac_w386fgqma2['license_name'], '</span><br />'; } echo '<label>Active:</label>'; echo '<span>', $m4ac_ck8wtizso64 ? $m4ac_ghqny9xr7ac : $m4ac_fuis1hr8, '</span><br />'; echo '<label>Next License Update Check:</label>'; echo '<span>', date('F jS g:i', $m4ac_w386fgqma2['renewal_date']), '</span><br />'; echo '<label>Subscription Payment Status:</label>'; echo '<span>', ! $m4ac_g9ikgfj5xzuo && ! $m4ac_ru3vbteo0 ? $m4ac_ghqny9xr7ac : $m4ac_fuis1hr8, '</span><br />'; echo '<label>Eligible for Support:</label>'; echo '<span>', $m4ac_ck8wtizso64 && ! $m4ac_ru3vbteo0 ? $m4ac_ghqny9xr7ac : $m4ac_fuis1hr8, '</span><br />'; if ($m4ac_ru3vbteo0) { echo '<label>Trial Mode:</label>'; echo '<span>', $m4ac_ru3vbteo0 ? $m4ac_ghqny9xr7ac : $m4ac_fuis1hr8, '</span><br />'; } echo '<label>Unlimited Domains:</label>'; echo '<span>', $m4ac_oiz1yd5b6jue ? $m4ac_ghqny9xr7ac : $m4ac_fuis1hr8, '</span><br />'; echo '<label>Unlimited Subdomains:</label>'; echo '<span>', true ? $m4ac_ghqny9xr7ac : $m4ac_fuis1hr8, '</span><br />'; echo '&nbsp;<br />'; if (! $m4ac_ck8wtizso64) { echo '<label>Trial Mode:</label>'; echo '<span>', $m4ac_ru3vbteo0 ? $m4ac_ghqny9xr7ac : $m4ac_fuis1hr8, '</span><br />'; } ?>
<label>Licensed Users:</label>
<span><?php echo $m4ac_ay_0mo97qdh ?></span><br />
<label>Current Users:</label>
<span><?php echo number_format(m4ac_tl5skz6cfptr::m4ac_gd1pbm4e() ); ?></span><br />
<label>Oversubscribed:</label>
<span><?php echo $m4ac_au2txny6iwa1 ? $m4ac_nb8gpn93s2l : $m4ac_eqhspdut; ?></span><br />
&nbsp;<br />
</div>

<form method="post" action="">
<input type="hidden" name="m4ac_license_update" value="1">
<input type="submit" name="save" value="Check License" class="button-primary" style="margin-right:20px;">
</form>
<p>&nbsp;</p>
<p>If your license does not pick up, please click the "Check License" button.  If the license still does not pick up, please contact support.</p>

<?php
}
