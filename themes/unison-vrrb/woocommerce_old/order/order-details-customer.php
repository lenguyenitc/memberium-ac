<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header><h2><?php _e( 'Customer Details', 'woocommerce' ); ?></h2></header>
<p>
	<label>Name:</label>
	<?php
	$customer_id = get_current_user_id();
	$first_name = get_user_meta( $customer_id, 'first_name', true ); 
	$last_name = get_user_meta( $customer_id, 'last_name', true );
	$country = get_user_meta( $customer_id, 'country', true );
	$phone = get_user_meta( $customer_id, 'phone', true ); 
	$citystate = get_user_meta( $customer_id, 'citystate', true ); 
	$current_user = wp_get_current_user();

	?>

	<strong><?php echo $first_name .' '. $last_name; ?></strong>
</p>
<p>
	<label>Email:</label>

	<strong><?php echo $current_user->user_email ?></strong>
</p>
<?php /*?>
<table class="shop_table customer_details">
	<?php if ( $order->customer_note ) : ?>
		<tr>
			<th><?php _e( 'Note:', 'woocommerce' ); ?></th>
			<td><?php echo wptexturize( $order->customer_note ); ?></td>
		</tr>
	<?php endif; ?>

	<?php if ( $order->billing_email ) : ?>
		<tr>
			<th><?php _e( 'Email:', 'woocommerce' ); ?></th>
			<td><?php echo esc_html( $order->billing_email ); ?></td>
		</tr>
	<?php endif; ?>

	<?php if ( $order->billing_phone ) : ?>
		<tr>
			<th><?php _e( 'Telephone:', 'woocommerce' ); ?></th>
			<td><?php echo esc_html( $order->billing_phone ); ?></td>
		</tr>
	<?php endif; ?>

	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
</table>

<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>

<div class="col2-set addresses">
	<div class="col-1">

<?php endif; ?>

<header class="title">
	<h3><?php _e( 'Billing Address', 'woocommerce' ); ?></h3>
</header>
<address>
	<?php echo ( $address = $order->get_formatted_billing_address() ) ? $address : __( 'N/A', 'woocommerce' ); ?>
</address>

<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>

	</div><!-- /.col-1 -->
	<div class="col-2">
		<header class="title">
			<h3><?php _e( 'Shipping Address', 'woocommerce' ); ?></h3>
		</header>
		<address>
			<?php echo ( $address = $order->get_formatted_shipping_address() ) ? $address : __( 'N/A', 'woocommerce' ); ?>
		</address>
	</div><!-- /.col-2 -->
</div><!-- /.col2-set -->

<?php endif; ?>
<?php */ ?>
