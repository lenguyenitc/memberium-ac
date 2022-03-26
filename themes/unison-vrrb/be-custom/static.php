<?php

/**
 * Proper way to enqueue scripts and styles
 */
function unison_be_add_css_js() {
    wp_enqueue_style( 'be-custom', BE_URI.'css/be-custom.css' ,array(),  BE_VERSION);
}
add_action( 'wp_enqueue_scripts', 'unison_be_add_css_js' );

 ?>
