<?php
/**
 * Copyright (c) 2021 David J Bullock
 * Web Power and Light
 */



if ( !defined( 'ABSPATH' ) ) {
    die();
}

if (! empty($data->messages) ) {
	echo "<div class='email_change_message'>{$data->messages}</div>";
}

?>
<form name="<?= $data->form_name ?>" id="<?= $data->form_name ?>" method='post'>
	<?= $data->nonce ?>
	<input type="hidden" name="memb_form_type" value="memb_change_email">
	<input type="hidden" name="form_id" value="<?= $data->form_id ?>">
	<input type="hidden" name="actions" value="<?= $data->parameters ?>">
	<input type="hidden" name="signature" value="<?= $data->signature ?>">
	<div>
		<label><?= $data->email1_label ?></label>
		<input name="email1" type="email" required="required" value="<?= $data->email ?>">
	</div>
	<div>
		<label><?= $data->email2_label ?></label>
		<input name="email2" type="email" required="required" value="<?= $data->email ?>">
	</div>
	<div>
		<label></label>
		<input type="submit" value="<?= $data->button_text ?>" name="submit">
	</div>
</form>
