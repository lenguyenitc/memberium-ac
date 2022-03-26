<?php
/**
 * Copyright (c) 2021 David J Bullock
 * Web Power and Light
 */



if ( !defined( 'ABSPATH' ) ) {
    die();
}

?>
<form method="post" action="" id="<?= $data->css_id ?>" class="<?= $data->css_class ?>" >
	<?= $data->nonce ?>
	<input type="hidden" name="memb_form_type" value="memb_add_to_woo_cart">
	<input type="hidden" name="params" value="<?= $data->parameters ?>">
	<input type="hidden" name="signature" value="<?= $data->signature ?>">
	<?php
	echo do_shortcode($content);

	if (! empty($data->button_image) ) {
		echo "<input id='{$data->css_id}' src='{$data->button_image}' alt='{$data->button_text}' style='{$data->css_style}' type='image' >";
	}
	else {
		 echo "<input id='{$data->css_id}' value='{$data->button_text}' style='{$data->css_style}' type='submit'>";
	}
	?>
</form>
