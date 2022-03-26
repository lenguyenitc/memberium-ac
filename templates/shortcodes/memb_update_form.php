<?php
/**
 * Copyright (c) 2021 David J Bullock
 * Web Power and Light
 */



if ( !defined( 'ABSPATH' ) ) {
    die();
}

if (! empty($data->errors)) {
	if (is_array($data->errors)) {
		foreach ($data->errors as $error_message) {
			echo "<p class='memb_registration_error'>{$error_message}</p>";
		}
	}
	else {
		echo "<p class='memb_registration_error'>{$data->errors}</p>";
	}
}

?><form method="post" action="" id="<?= $data->css_id ?>" class="<?= $data->css_class ?>">
	<?= $data->nonce ?>
	<input type="hidden" name="memb_form_type" value="memb_update_contact_form">
	<input type="hidden" name="params" value="<?= $data->parameters ?>">
	<input type="hidden" name="signature" value="<?= $data->signature ?>">
	<?php
		echo do_shortcode($content);
	?>
</form>
