<?php
/**
 * Copyright (c) 2021 David J Bullock
 * Web Power and Light
 */



if ( !defined( 'ABSPATH' ) ) {
    die();
}

if (! empty($data->message)) {
	echo "<div id='{$data->css_message_id}' class='{$data->css_message_class}' style='{$data->css_message_style}?>'>{$data->message}</div>";
}

?>
<form name='<?= $data->css_name ?>' id='<?= $data->css_id ?>' method='post' action=''>
	<?= $data->nonce ?>
	<input type="hidden" name="memb_form_type" value="memberium/spiffy_login_button">
	<input type="hidden" name="form_id" value="<?= $data->css_id ?>">
	<input type="hidden" name="parameters" value="<?= $data->parameters ?>"">
	<input type="hidden" name="signature" value="<?= $data->signature ?>">
	<?php
		if (empty($data->button_url) ) {
			echo "<input type='submit' style='{$data->css_button_style}' id='{$data->css_button_id}' value='{$data->button_text}'>";
		}
		else {
			echo "<input type='image' src='{$data->button_url}' class='{$data->css_class}' id='{$data->button_name}' >";
		}
	?>
</form>
