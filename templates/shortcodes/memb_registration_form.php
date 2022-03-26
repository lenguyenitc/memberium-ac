<?php
/**
 * Copyright (c) 2021 David J Bullock
 * Web Power and Light
 */



if ( !defined( 'ABSPATH' ) ) {
    die();
}

if (! empty($data->messages)) {
	if (is_array($data->messages)) {
		foreach ($data->messages as $message) {
			echo "<p class='memb_registration_error'>{$message}</p>";
		}
	}
	else {
		echo "<p class='memb_registration_error'>{$data->messages}</p>";
	}
}

?>
<form method="post" action="" id="<?= $data->css_id ?>" class="<?= $data->css_class ?>">
	<input type="hidden" name="memb_form_type" value="memb_registration">
	<?= $data->nonce ?>
	<input type="hidden" name="params" value="<?= $data->parameters ?>">
	<input type="hidden" name="signature" value="<?= $data->signature ?>">
	<?php
		echo do_shortcode($content);
	?>
</form>
