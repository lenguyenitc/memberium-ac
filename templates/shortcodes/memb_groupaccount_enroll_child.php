<?php
/**
 * The Template for displaying the [memb_enroll_child] form shortcode
 *
 * This template can be overridden by copying it to yourtheme/memberium/memb_enroll_child.php
 *
 * Copyright (c) 2021 David J Bullock
 * Web Power and Light
 *
 * @param array  $atts       Shortcode attributes
 * @param string $content    Shortcode wrapped content
 * @param object $data       Shortcode data
 *
*/



if ( !defined( 'ABSPATH' ) ) {
    die();
}

if (! empty($data->messages)) {
    echo $data->messages;
}

?>

<form id="<?= $data->form_id ?>" method="post">
	<?= $data->nonce; ?>
	<input type="hidden" name="memb_form_type" value="memb_enroll_child">
	<input type="hidden" name="form_id" value="<?= $data->form_id; ?>">
	<input type="hidden" name="params" value="<?= $data->parameters; ?>">
	<input type="hidden" name="signature" value="<?= $data->signature; ?>">

    <?php
        if( ! empty($content) ){
        do_shortcode( $content );
    }
        else { ?>
    <div>
    	<label><?= $data->labels->email; ?></label>
    	<input name="email" value="" type="email" required="required"> *
	</div>
	<div>
		<label><?= $data->labels->firstname; ?></label>
        <input type="text" value="" name="firstname" required="required"> *
	</div>
	<div>
		<label><?= $data->labels->lastname; ?></label>
		<input name="lastname" value="" type="text" required="required">
	</div>

    <?php
        if( ! empty($data->dropdown) ) { ?>
        <div>
            <label><?= $data->labels->automation; ?></label>
            <?= $data->dropdown; ?>
        </div>
    <?php } ?>

    <?php } ?>
    <div>
		<label></label>
		<input type="submit" value="<?= $data->labels->button_text ?>" name="submit">
	</div>
</form>
