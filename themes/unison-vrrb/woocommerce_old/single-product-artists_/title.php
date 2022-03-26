<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author     WooThemes
 * @package    WooCommerce/Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $product, $woocommerce, $post;
$record_label = get_post_meta( $post->ID, '_record', true );
the_title( '<h4  itemprop="name" class="product_title entry-title"><a class="js-title-samplepacks">', '</a></h4>' );

###ARTIST_GENRE_START
$genres = get_genres_by_id($post->ID);
if (!empty($genres)) {
    echo '<span>',$genres, '</span>';
}
###ARTIST_GENRE_END

if ($record_label){
		echo '<h5 class="custom_lab"><em>'. $record_label . '</em></h5>';
	}
