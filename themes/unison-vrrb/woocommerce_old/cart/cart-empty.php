<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}



?>
<section id="pCart">
  <div class="banner"><h2>Review Cart</h2></div>

  <div class="cart-wrap">
    <!-- <ul class="step">
      <li class="active">
        <strong>1</strong>
        <span>Review Cart </span>
        <em></em>
      </li>
      <li>
        <strong>2</strong>
        <span>Confirmation</span>
        <em></em>
      </li>
      <li>
        <strong>3</strong>
        <span>Download</span>
      </li>
    </ul> -->

<?php do_action( 'woocommerce_before_cart' ); ?>
<?php wc_print_notices(); ?>
<div class="cart-empty">
      <h4><?php _e( 'Your cart is empty', 'woocommerce' ) ?></h4>
      <p><?php //_e( 'Feel free to start browsing around', 'woocommerce' ) ?></p>
      <!-- <a href="/artists/" class="btn">Book A Lesson</a> -->
      <a href="/soundbanks/" class="btn">Browse Products</a>
    </div>
<?php do_action( 'woocommerce_cart_is_empty' ); ?>
</div></section>
<!--<?php if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
	<p class="return-to-shop">
		<a class="button wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php _e( 'Return To Shop', 'woocommerce' ) ?>
		</a>
	</p>
</div>
<?php endif; ?>-->
<script type="text/javascript">
  jQuery(document).ready(function(){
    $('html, body').animate({
            scrollTop: $('#cart_woo').offset().top         
        }, 2000);
  });
</script>