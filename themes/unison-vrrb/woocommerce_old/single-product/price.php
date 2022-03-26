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

global $product,$post;

?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<h6 class="price"><?php echo $product->get_price_html(); ?></h6>

	<meta itemprop="price" content="<?php echo esc_attr( $product->get_display_price() ); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>
<?php 
		$downloads = $product->get_files();
    $product_download = get_post_meta( $post->ID, '_downloadable', true );
    $product_price = get_post_meta( $post->ID, '_price', true );
    echo "<div class='cta'>";
		$music = get_post_meta( $post->ID, '_music', true );
		if($product->price > 0){
		  echo '<div class="single_product_play"><div class="play_single_audio"><a href="546" class="btn-play js-sound" data-file="'.$music.'" data-id="'.$post->ID.'"></a></div></div><span style="display: inline-block;vertical-align: middle;">play demo</span>';
		}else{
			echo '<div class="single_product_play"><div class="play_single_audio"><a href="546" class="btn-free-play js-sound" data-file="'.$music.'" data-id="'.$post->ID.'"></a></div></div><span style="display: inline-block;vertical-align: middle;">play demo</span>';
		}
		  echo '<div class="button_free">';
	
			/*if ( !is_user_logged_in() && ($product->price == 0) ) {
            echo '<a rel="nofollow" href="'.get_the_permalink().'" data-product_title="'.get_the_title().'" data-quantity="1" data-product_id="'. get_the_ID() .'" data-product_sku="" class="add_cart_btn js-check-login btn-free-buy">Add To Cart</a>';
            echo '<input type="hidden" name="p_type" id="sp_type_free" value="'.$product_download.'">';
        echo '<input type="hidden" name="p_price" id="sp_price_free" value="'.$product_price.'">';

?> <input type="hidden" name="p_downloads" id="sp_downloads_free" value="<?php print_r($downloads); ?>" >
         
<?php
          
          }elseif ( !is_user_logged_in() && ($product->price > 0) ) {
            echo '<a rel="nofollow" href="'.get_the_permalink().'" data-product_title="'.get_the_title().'" data-quantity="1" data-product_id="'. get_the_ID() .'" data-product_sku="" class="add_cart_btn js-check-login btn-buy">Add To Cart</a>';
			  echo '<input type="hidden" name="p_type" id="sp_type_free" value="'.$product_download.'">';
        echo '<input type="hidden" name="p_price" id="sp_price_free" value="'.$product_price.'">';

?> <input type="hidden" name="p_downloads" id="sp_downloads_free" value="<?php print_r($downloads); ?>" >
<?php
          
          }else */

          if($product->price == 0)
          {
			echo '<a rel="nofollow" href="'.get_the_permalink().'" data-product_title="'.get_the_title().'" data-quantity="1" data-product_id="'. get_the_ID() .'" data-product_sku="" class="download-button add_cart_btn btn-free-buy">Add To Cart</a>';
      echo '<input type="hidden" name="p_type" id="sp_type_free" value="'.$product_download.'">';
        echo '<input type="hidden" name="p_price" id="sp_price_free" value="'.$product_price.'">';

?> <input type="hidden" name="p_downloads" id="sp_downloads_free" value="<?php print_r($downloads); ?>" >
         
<?php
}elseif($product->price > 0)
    {

    	if ( $product->is_in_stock() ) : ?>

		<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

		<form class="cart" method="post" enctype='multipart/form-data'>
		 	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		 	<?php
		 		//if ( ! $product->is_sold_individually() ) {
		 			//woocommerce_quantity_input( array(
		 				//'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
		 				//'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product ),
		 			//	'input_value' => ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 )
		 			//) );
		 		//}
		 	?>

		 	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $post->ID ); ?>" />

		 	<button type="submit" class="test-button add_cart_btn btn-buy"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

			<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
		</form>

		<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

	<?php endif; 


    	//echo '<a rel="nofollow" href="'.get_the_permalink().'" data-product_title="'.get_the_title().'" data-quantity="1" data-product_id="'. get_the_ID() .'" data-product_sku="" class="test-button add_cart_btn btn-buy">Add To Cart</a>';
}	
echo '</div>';
echo '</div>';
	?>