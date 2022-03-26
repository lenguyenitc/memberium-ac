<?php
/**
 * Copyright (c) 2021 David J Bullock
 * Web Power and Light
 */



if ( !defined( 'ABSPATH' ) ) {
    die();
}

wp_enqueue_script('jquery', null, null, null, true);

?>
<style>
	#<?= $data->form_name ?><?= $data->form_id ?> div { 
		margin-bottom:12px;
	}
	#<?= $data->form_name ?><?= $data->form_id ?> label { 
		display:inline-block;
		width:150px;
	}
</style>
<?php

if (! empty($data->messages) ) {
	echo "<p class='password_change_message'>{$data->messages}</p>";
}

?>
<form name="<?= $data->form_name ?><?= $data->form_id ?>" id="<?= $data->form_name ?><?= $data->form_id ?>" method="post">
	<?= $data->nonce ?>
	<input type="hidden" name="memb_form_type" value="memb_change_password">
	<input type="hidden" name="form_id" value="<?= $data->form_id ?>">
	<input type="hidden" name="parameters" value="<?= $data->parameters ?>">
	<input type="hidden" name="signature" value="<?= $data->signature ?>">
	<div>
		<label><?= $data->password1_label ?></label>
		<input id="<?= $data->form_name ?><?= $data->form_id ?>-password1" minlength="<?=  $data->min_length ?>" maxlength="<?=  $data->max_length ?>" name="password1" autocomplete="new-password" type="password" size="20" required="required" value="">
	</div>
	<div>
		<label><?= $data->password2_label ?></label>
		<input id="<?= $data->form_name ?><?= $data->form_id ?>-password2" minlength="<?=  $data->min_length ?>" maxlength="<?= $data->max_length ?>" name="password2" autocomplete="new-password" type="password" size="20" required="required" value="">
	</div>
	<div>
		<label></label>
		<input id="<?= $data->form_name ?><?= $data->form_id ?>-submit" value="<?= $data->button_text ?>" type="submit" >
	</div>
</form>
<script>
	document.addEventListener("DOMContentLoaded", (event) => {
		jQuery("input[type=password]").hover(
			function() {
				jQuery(this).attr('type', 'text');
			}, function() {
				jQuery(this).attr('type', 'password');
			}
		);
	});
</script>
