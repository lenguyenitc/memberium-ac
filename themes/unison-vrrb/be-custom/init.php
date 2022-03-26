<?php
/**
 * Defined
 */
define( 'BE_DIR', __DIR__ );
define( 'BE_URI', get_stylesheet_directory_uri() . '/be-custom/' );
define( 'BE_VERSION', '1.0.6' );

/**
 * Includes
 */
require( BE_DIR . '/hooks.php' );
require( BE_DIR . '/static.php' );
require( BE_DIR . '/shortcodes.php');
?>
