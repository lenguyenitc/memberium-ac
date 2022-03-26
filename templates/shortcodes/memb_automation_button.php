<?php
/**
 * Copyright (c) 2021 David J Bullock
 * Web Power and Light
 */



if ( !defined( 'ABSPATH' ) ) {
    die();
}

?>
<form name="<?= $data->form_name ?>" id="<?= $data->form_name ?>" method="post">
	<?= $data->nonce ?>
	<input type="hidden" name="memb_form_type" value="memb_automation_button">
	<input type="hidden" name="form_id" value="<?php echo $data->form_id; ?>">
	<input type="hidden" name="action" value="<?= $data->parameters ?>">
	<input type="hidden" name="signature" value="<?= $data->signature ?>">
	<?php
		if (empty($data->button_url)) {
			echo "<input type='submit' class='{$data->css_class}' id='{$data->button_name}' value='{$data->button_text}'>";
		} else {
			echo "<input type='image' src='{$data->button_url}' class='{$data->css_class}' id='{$data->button_name}'>";
		}
	?>
</form>
