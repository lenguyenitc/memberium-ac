<?php
/**
 * Copyright (c) 2021 David J Bullock
 * Web Power and Light
 */



if ( !defined( 'ABSPATH' ) ) {
    die();
}

if ($data->mode == 'input') {
	$length = strlen($data->feed_url) * 0.9;
	
	?><input class="memberium_feed_url" style="<?= $data->style ?>" value="<?= $data->feed_url ?>" disabled="disabled" size="<?= $length ?>"><?php
}
else {
	echo $data->feed_url;
}
