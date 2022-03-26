<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce, $post;

?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<h6 class="price">Price: <?php echo $product->get_price_html(); ?></h6>
		<?php
	
	$language = get_post_meta( $post->ID, '_language', true );
	$location = get_post_meta( $post->ID, '_location', true );
	$daw = get_post_meta( $post->ID, '_daw', true );
	$rec = get_post_meta( $post->ID, '_rec', true );
	
	if ($language){
		echo '<h5 class="custom_lab">Language: '. $language . '</h5>';
	}
	if ($location){
		echo '<h5 class="custom_lab">Location: '. $location . '</h5>';
	}
	if ($daw){
		echo '<h5 class="custom_lab">DAW: '. $daw . '</h5>';
	}
	if ($rec){
		echo '<h5 class="custom_lab">Recommended Plugins For Lesson: '. $rec . '</h5>';
	}
	




?>
	<meta itemprop="price" content="<?php echo esc_attr( $product->get_display_price() ); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />


</div>
<!--<?php 
		$downloads = $product->get_files();
		echo "<div class='cta'>";
		foreach( $downloads as $key => $each_download ) {
		  echo '<a href="546" class="btn-play js-sound" data-file="http://dev2.unison.audio/wp-content/uploads/2017/02/Sep-Ft.-Elle-Vee-Come-A-Little-Closer-Original-Mix.mp3"></a>';
		}
		echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $class ) ? $class : 'btn-buy js-add-cart button product_type_simple add_to_cart_button ajax_add_to_cart' ),
		esc_html( $product->add_to_cart_text() )
	),
$product );

		echo '</div>';

	?>-->


	<a href="#booking" class="btn bookings" style="margin-top: 30px;">Book Lesson</a>

	
