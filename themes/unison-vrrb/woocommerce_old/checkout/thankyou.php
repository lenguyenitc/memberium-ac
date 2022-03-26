<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
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
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section id="pCart">
  <div class="banner"><h2>Confirmation</h2></div>

  <div class="cart-wrap download_thanks">
    <ul class="step">
      <li>
        <strong>1</strong>
        <span>Review Cart </span>
        <em></em>
      </li>
      <li class="active">
        <strong >2</strong>
        <span>CHECKOUT</span>
        <em></em>
      </li>
      <li >
        <strong>3</strong>
        <span>Download</span>
      </li>
    </ul>
    <div class="step_2">

<?php
if ( $order ) :  ?>

	<?php if ( $order->has_status( 'failed' ) ) : ?>

		<p class="woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

		<p class="woocommerce-thankyou-order-failed-actions">
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
				<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My Account', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>

        <?php
        $user = $order->get_user();
        $product_names = [];
        $items = $order->get_items();
        $items_html = '';

        $items_html = '<table style="width:640px"><tr><th align="left">Description</th><th align="left">Amount</th></tr>';
        foreach ($items as $item) {
            $product_names[] = $item['name'];
            $items_html .= '<tr><td>' .  $item['name'] . '</td><td>' .'$'. $item['line_subtotal'] . '</td></tr>';
        }
        $items_html .= '</table>';

        //Order Email
        sib_trigger(array(
            'id' => 6,
            'to' =>  $user->user_email,
            'attr' => array(
                'EMAIL' =>  $user->user_email,
                'NAME' => $user->user_nicename,
                'ITEMS_HTML' => $items_html,
                'TOTAL' => $order->get_total(),
                'DATE' => $order->order_date,
                'PAYMETHOD' => ucfirst($order->get_payment_method()),
                'NUMBER' => $order->id,
				'PRODUCTS_NAME' => $items_html,

            )
        ));
        
        //Receipt notification
        sib_trigger(array(
            'id' => 7,
            'to' =>  $user->user_email,
            'attr' => array(
                'EMAIL' =>  $user->user_email,
                'NAME' => $user->user_nicename,
                'TOTAL' => $order->get_total(),
                'PAID' => $order->get_total(),
                'TAX' => 0,
                'ITEMS_HTML' => $items_html
            )
        ));

        ?>
        <div class="cart-empty success">
            <?php echo  __( '<h4>THANK YOU FOR YOUR ORDER </h4><p>You can download your purchases now via the link below, <br>or<br> later from the Downloads tab located in your Account <br>Overview </p>', 'woocommerce' ); ?>
		 <!-- <p><?php //echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'THANK YOU FOR YOUR ORDER <br>You can download your purchases now via the link below, <br>or<br> later from the Downloads tab located in your Account <br>Overview', 'woocommerce' ), $order ); ?></p> -->
        <!-- <h4><strong></strong><?php //echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'THANK YOU FOR YOUR ORDER', 'woocommerce' ), $order ); ?></strong></h4>
        
        <p><?php //echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'You can download your purchases now via the link below, or ', 'woocommerce' ), $order ); ?></p>
        <p><?php 
            //$current_user = wp_get_current_user();
            //echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'later from the Downloads tab located in your Account', 'woocommerce' ), $order ); ?></p>

         <p><?php 
            //$current_user = wp_get_current_user();
            //echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Overview', 'woocommerce' ), $order ); ?></p> -->
          <br/>  

		<div class="clear"></div>

        <a href="/downloads" class="btn">Access your downloads now</a>
</div>
	<?php endif; ?>

	<?php //do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
	<?php //do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>

	<p class="woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>

<?php endif; ?>
</div>