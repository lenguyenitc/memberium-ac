<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

if ( ! $post->post_excerpt ) {
	return;
}

?>
</div>
<div class="cl"></div>
<div class="copy" itemprop="description">
	<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
	<?php
	$facebook = get_post_meta( $post->ID, '_facebook', true );
	$twitter = get_post_meta( $post->ID, '_twitter', true );
	$soundcloud = get_post_meta( $post->ID, '_soundcloud', true );
	$spotify = get_post_meta( $post->ID, '_spotify', true );
	if ($facebook){
		echo '<a href="'.$facebook.'" target="_blank" class="soc-custom facebook"></a>';
	}
	if ($twitter){
		echo '<a href="'.$twitter.'" target="_blank" class="soc-custom twitter"></a>';
	}
	if ($soundcloud){
		echo '<a href="'.$soundcloud.'" target="_blank" class="soc-custom soundcloud"></a>';
	}
	if ($spotify){
		echo '<a href="'.$spotify.'" target="_blank" class="soc-custom spotify"></a>';
	}
	
	?>
</div>
