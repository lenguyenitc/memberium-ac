<?php
error_reporting(0);
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
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
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


?>
<section id="pCart">
  <div class="banner"><h2>Review Cart</h2></div>

  <div class="cart-wrap" id="cart_woo">
    <ul class="step">
      <li class="active">
        <strong>1</strong>
        <span>Review Cart </span>
        <em></em>
      </li>
      <li>
        <strong>2</strong>
        <span>CHECKOUT</span>
        <em></em>
      </li>
      <li>
        <strong>3</strong>
        <span>Download</span>
      </li>
    </ul>

<?php do_action( 'woocommerce_before_cart' ); ?>
<div class="cart-page-wrapper-section">
<div class="cart-page-wrapper-left">
<div class="cart-item">
 <?php do_action( 'woocommerce_before_cart_table' ); ?>

 <table class="shop_table shop_table_responsive cart" cellspacing="0">
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">



					<td class="product-thumbnail" style="vertical-align:top;">
						<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $product_permalink ) {
								echo $thumbnail;
							} else {
								printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
							}
						?>
					</td>

					<td width="70%" class="product-name" data-title="<?php _e( 'Product', 'woocommerce' ); ?>">
						<div class="copy">
						<h6>
						<?php

								$terms = get_the_terms( $product_id, 'product_cat' );
								$arr = array();
								foreach($terms as $term){
									$product_cat = $term->term_id;
									$arr[] = $product_cat;
								}
								if(in_array('13',$arr)){
									echo 'Serum Collection';
								}
								elseif(in_array('12',$arr)){
									echo 'Artist Series';
								}elseif(in_array('130',$arr)){
									echo 'Vocal series';
								}elseif(in_array('132',$arr)){
									echo 'MIDI Collection';
								}
								else{
									echo $terms[0]->name;
								}
								//echo $terms[0]->name;

							?>
                  			</h6>

                  			<h5>
                  			<?php
	                  			if ( ! $product_permalink ) {
									echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
								} else {
									echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<h5>%s</h5>', $_product->get_title() ), $cart_item, $cart_item_key );
								}

								
                  			?>
                  			</h5>
                  			<hr>
                  			<p>	
                  			<?php 
// Meta data
								echo WC()->cart->get_item_data( $cart_item );

								// Backorder notification
								if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
									echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
								}
                  			?>
                  			</p>
                        </div>
						
					</td>

					<td class="product-price" data-title="<?php _e( 'Price', 'woocommerce' ); ?>">
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
								'<a href="%s" class="" title="%s" data-product_id="%s" data-product_sku="%s"><span class="btn-close"></span></a>',
								esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
								__( 'Remove this item', 'woocommerce' ),
								esc_attr( $product_id ),
								esc_attr( $_product->get_sku() )
							), $cart_item_key );
						?>
						<?php
							echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
					</td>

				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>
<?php do_action( 'woocommerce_after_cart_table' ); ?>
</div>
</div>
<div class="cart-page-wrapper-right">
<form class="frmCart" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<div class="step_1">
	<div class="export" >

          <div class="code">
          
            
            
            <?php if ( wc_coupons_enabled() ) { ?>
					

						<input type="text" name="coupon_code" class="input-text js-input-promo" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Promo code', 'woocommerce' ); ?>" /> <input type="submit" class="btn bg_btn" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>" />

						<?php do_action( 'woocommerce_cart_coupon' ); ?>
				<?php } ?>

				<?php do_action( 'woocommerce_cart_actions' ); ?>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
          </div>
		 <div class="info">
			<?php global $woocommerce; ?>

			<table class="cart_totals " cellspacing="0">
				<tbody>
					<tr class="cart-subtotal">
						<td>Subtotal</td>
						<td data-title="Subtotal"><span class="woocommerce-Price-amount amount"><?php wc_cart_totals_subtotal_html(); ?></span></td>
					</tr>
					<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
					<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<td><?php wc_cart_totals_coupon_label( $coupon ); ?></td>
						<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
					</tr>
				<?php endforeach; ?>
					<tr class="line">
						<td></td>
						<td><em></em></td>
					</tr>
					<tr class="order-total">
						<td>Total</td>
						<td data-title="Total"><strong><span class="woocommerce-Price-amount amount"><?php wc_cart_totals_order_total_html();?></span></strong> </td>
					</tr>
					
				</tbody>
			</table>
			
		</div>
    </div>
    <hr class="cs_cart_bottom_hr">
</div>

</form>
<div class="checkout-wrap">
       
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
      <?php if ( !    is_user_logged_in() ) {
       echo apply_filters( 'woocommerce_order_button_html', '<input id="place_order" style="float:right" type="submit" class="js-check-login button alt" type="hidden" name="woocommerce_checkout_place_order" value="Proceed To Checkout" data-value="' . esc_attr( $order_button_text ) . '" />' ); }?>
  <?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

    <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

    <div class="col2-set" id="customer_details">
      <div class="col-1">
        <?php do_action( 'woocommerce_checkout_billing' ); ?>
      </div>

      <div class="col-2">
        <?php do_action( 'woocommerce_checkout_shipping' ); ?>
      </div>
    </div>

    <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

  <?php endif; ?>

  <h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>

  <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

  <div id="order_review" class="woocommerce-checkout-review-order">
    <?php do_action( 'woocommerce_checkout_order_review' ); ?>
  </div>

  <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
 

</form>

</div>
</div>
</div>
  <div class="cart-page-badge-section-container">
	    <div class="cart-page-badge-section-one-half">
			<div class="cart-page-badge-img-left">
				<img width="107" src="../wp-content/uploads/2020/05/money_back-_1_.png">
			</div>
			<div class="cart-page-badge-desc-right">
				<h2>60-Day Money-Back Guarantee</h2>
				<p>Here at Unison we stand behind our products fully. If you’re not blown away with the improvement to your music, just email support@unison.audio within 60 days and we’ll give you 100% of your money back. No questions asked. No hard feelings. You have nothing to lose and everything to gain.</p>
			</div>
		</div>
		<div class="cart-page-badge-section-one-half">
			<div class="cart-page-badge-img-left">
				<img width="107" src="../wp-content/uploads/2020/05/site-secure.png">
			</div>
			<div class="cart-page-badge-desc-right">
				<h2>Secure Payment</h2>
				<p>We securely accept payments through all major credit cards and PayPal. Your payment information is never stored and is safely encrypted with 256-bit SSL technology. We respect your privacy.</p>
			</div>
		</div>
	</div>
</div>
</section>
<style type="text/css">
	.cart-page-wrapper-section {
    width: 100%;
    position: relative;
}

.cart-page-wrapper-left, .cart-page-wrapper-right {
    width: 50%;
    display: inline-block;
    float: left;
}

.cart-page-wrapper-right .export .code, .cart-page-wrapper-right .export .info {
    width: 100%;
}
</style>
<?php global $product, $woocommerce_loop;

	if ( ! $crosssells = WC()->cart->get_cross_sells() ) {
		return;
	}

	$args = array(
		'post_type'           => 'product',
		'ignore_sticky_posts' => 1,
		'no_found_rows'       => 1,
		'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', 1 ),
		'orderby'             => $orderby,
		'post__in'            => $crosssells,
		'meta_query'          => WC()->query->get_meta_query()
	);

	$products                    = new WP_Query( $args );
	$woocommerce_loop['name']    = 'cross-sells';
	$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', $columns );
    $upsell_on_cart_page = 'false';
	if ( $products->have_posts() && $upsell_on_cart_page == 'true') : ?>

		<div id="myModal" class="modal">
	        <!-- Modal content -->
	        <div class="modal-content">
	          <span class="close">&times;</span>
	            <div class="up-sells upsells products upsells_custom_popup">
	              <?php while ( $products->have_posts() ) : $products->the_post(); 
	                $price = get_post_meta( get_the_ID(), '_regular_price', true);
	                $sale = get_post_meta( get_the_ID(), '_sale_price', true); ?>
	                <input type="hidden" class="extra_product_title" value="<?php echo get_the_title();?>"> 
	              <div class="images_popup"> 
	              	<div class="mobile_view"><h1 class="product_title entry-title"> Producers who bought this item also bought <br>"<?php echo get_the_title();?>" </h1></div>
	                <?php the_post_thumbnail('medium'); ?>
	                  <div class="price_section">
	                    <?php if($price){ ?>
	                      <span class="price"><?php echo '$'.$price; ?> </span>
	                    <?php }
	                    if($sale){
	                    ?>
	                      <span class="sale"><?php echo $sale; ?> </span>
	                    <?php } ?>
	                  </div>
	                  <?php
	                  $music = get_post_meta( get_the_ID(), '_music', true ); ?>
	                  	<div class='cta'>
		                  <?php
		                  if(($price > 0) || $sale > 0){
		                    echo '<div class="single_product_play"><div class="play_single_audio"><a href="546" class="btn-play js-sound" data-file="'.$music.'" data-id="'.get_the_ID().'"></a></div></div><span style="display: inline-block;vertical-align: middle;">play demo</span>';
		                  }else{
		                    echo '<div class="single_product_play"><div class="play_single_audio"><a href="546" class="btn-free-play js-sound" data-file="'.$music.'" data-id="'.get_the_ID().'"></a></div></div><span style="display: inline-block;vertical-align: middle;">play demo</span>';
		                  } ?>
	              		</div>
	              </div>
	              <div class="product_details desktop_view">
	                  <h1 class="product_title entry-title"> Producers who bought this item also bought <br>"<?php echo get_the_title();?>" </h1>
	                <div class="button_section">   
	                    <form class="cart" method="post" enctype="multipart/form-data">
	                      <input type="hidden" name="add-to-cart" value="<?php echo get_the_ID(); ?>">
	                      <button type="submit" class="test-button add_cart_btn btn-buy">YES, ADD TO ORDER</button>  
	                    </form>
	                    <a href="javascript:void(0);" class="goToCheckout add_cart_btn checkout_btn">NO, GO TO CHECKOUT</a>
	                </div>
	              </div>
	              <?php endwhile; // end of the loop. 
	              wp_reset_query(); ?>
	            </div>
	        </div>
	    </div>

	<?php endif;
?>

<?php do_action( 'woocommerce_after_cart' ); ?>