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
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="jumbotron checkout text-white bg-secondary py-3">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center d-flex align-items-center justify-content-center flex-sm-row">
                <img src="<?php bloginfo('template_url') ?>/assets/images/secure_checkout h37.svg"
                    class="secure-checkout-image"  alt="Secure Checkout">
                <h1>Secure checkout</h1>
            </div>
        </div>
    </div>
</div>

<?php do_action( 'woocommerce_before_cart' ); ?>
<?php wc_print_notices(); ?>
      <div class="cart-empty">
          <h4><?php _e('Your cart is empty', 'woocommerce') ?></h4>
          <p><?php //_e( 'Feel free to start browsing around', 'woocommerce' ) ?></p>
          <!-- <a href="/artists/" class="btn">Book A Lesson</a> -->
          <a href="/" class="btn">Browse Products</a>
      </div>

<?php
/*
 * @hooked wc_empty_cart_message - 10
 */
do_action( 'woocommerce_cart_is_empty' );
?>

<!--<?php if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
	<p class="return-to-shop">
		<a class="button wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php
				/**
				 * Filter "Return To Shop" text.
				 *
				 * @since 4.6.0
				 * @param string $default_text Default text.
				 */
				echo esc_html( apply_filters( 'woocommerce_return_to_shop_text', __( 'Return to shop', 'woocommerce' ) ) );
			?>
		</a>
	</p>
<?php endif; ?>-->


<script type="text/javascript">
  jQuery(document).ready(function(){
    $('html, body').animate({
            scrollTop: $('#cart_woo').offset().top         
        }, 2000);
  });
</script>