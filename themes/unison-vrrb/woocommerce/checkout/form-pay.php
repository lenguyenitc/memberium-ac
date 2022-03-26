<?php
/**
 * Pay for order form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-pay.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

$totals = $order->get_order_item_totals(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

?>
<section id="pCart">
    <div class="banner"><h2>Payment method</h2></div>

    <div class="cart-wrap">


        <div class="step_2">

            <div class="frmPayment" action="/payment/paypal.html" method="POST">
                <h4>Select Payment Method <span>Pay Securely with PayPal!</span></h4>

                <ul class="tab-payment ">
                    <li class="selected"><img
                                src="/wp-content/themes/unison-vrrb/images/i-paypal.png"></li>
                </ul>

                <div class="contain-payment">

                    <div class="display">
                        <p>Pay via Paypal, you can pay directly with your credit card.</p>
                        <h6><span>Paypal accepts</span></h6>

                        <a href="#"><img src="/wp-content/themes/unison-vrrb/images/i-c1.jpg"></a>
                        <a href="#"><img src="/wp-content/themes/unison-vrrb/images/i-c2.jpg"></a>
                        <a href="#"><img src="/wp-content/themes/unison-vrrb/images/i-c3.jpg"></a>
                        <a href="#"><img src="/wp-content/themes/unison-vrrb/images/i-c4.jpg"></a>
                        <a href="#"><img src="/wp-content/themes/unison-vrrb/images/i-c5.jpg"></a>

                        <hr>

                    </div>

                </div>
                <form id="order_review" method="post">

                    <table class="shop_table2">
<!--                        <thead>-->
<!--                        <tr>-->
<!--                            <th class="product-name">--><?php //esc_html_e( 'Product', 'woocommerce' ); ?><!--</th>-->
<!--                            <th class="product-quantity">--><?php //esc_html_e( 'Qty', 'woocommerce' ); ?><!--</th>-->
<!--                            <th class="product-total">--><?php //esc_html_e( 'Totals', 'woocommerce' ); ?><!--</th>-->
<!--                        </tr>-->
<!--                        </thead>-->
                        <tbody>
                        <?php if (sizeof($order->get_items()) > 0) : ?>
                            <?php foreach ($order->get_items() as $item_id => $item) : ?>
                                <?php
                                if (!apply_filters('woocommerce_order_item_visible', true, $item)) {
                                    continue;
                                }
                                ?>
                                <tr class="<?php echo esc_attr(apply_filters('woocommerce_order_item_class', 'order_item', $item, $order)); ?>">
                                    <td class="product-name">
                                        <?php
                                        echo apply_filters('woocommerce_order_item_name', esc_html($item['name']), $item, false);

                                        do_action('woocommerce_order_item_meta_start', $item_id, $item, $order);
                                        wc_display_item_meta( $item );
                                        do_action('woocommerce_order_item_meta_end', $item_id, $item, $order);
                                        ?>
                                    </td>
                                    <td class="product-quantity"><?php echo apply_filters('woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf('&times; %s', esc_html($item['qty'])) . '</strong>', $item); ?></td>
                                    <td class="product-subtotal"><?php echo $order->get_formatted_line_subtotal($item); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                        <tfoot>
                        <?php if ( $totals ) : ?>
                            <?php foreach ( $totals as $total ) : ?>
                                <tr>
                                    <th scope="row" colspan="2"><?php echo $total['label']; ?></th><?php // @codingStandardsIgnoreLine ?>
                                    <td class="product-total"><?php echo $total['value']; ?></td><?php // @codingStandardsIgnoreLine ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tfoot>
                    </table>

                    <div id="payment">
                        <?php if ($order->needs_payment()) : ?>
                            <ul class="wc_payment_methods payment_methods methods px-0">
                                <?php
                                if ( ! empty( $available_gateways ) ) {
                                    foreach ( $available_gateways as $gateway ) {
                                        wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
                                    }
                                } else {
                                    echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', esc_html__( 'Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) ) . '</li>'; // @codingStandardsIgnoreLine
                                }
                                ?>
                            </ul>
                        <?php endif; ?>
                        <div class="form-row">
                            <input type="hidden" name="woocommerce_pay" value="1"/>

                            <?php wc_get_template('checkout/terms.php'); ?>

                            <?php do_action('woocommerce_pay_order_before_submit'); ?>

                            <?php echo apply_filters( 'woocommerce_pay_order_button_html', '<button type="submit" class="button alt" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>

                            <?php do_action('woocommerce_pay_order_after_submit'); ?>

                            <?php wp_nonce_field( 'woocommerce-pay', 'woocommerce-pay-nonce' ); ?>
                        </div>
                    </div>
                </form>

            </div>

        </div>


    </div>


</section>
