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
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */
 
defined('ABSPATH') || exit;

?>
<?php
if ($order) :

    do_action('woocommerce_before_thankyou', $order->get_id());
    ?>

    <?php if ($order->has_status('failed')) : ?>

    <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>

    <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
        <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>"
           class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
        <?php if (is_user_logged_in()) : ?>
            <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"
               class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
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
        $items_html .= '<tr><td>' . $item['name'] . '</td><td>' . '$' . $item['line_subtotal'] . '</td></tr>';
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
//        sib_trigger(array(
//            'id' => 7,
//            'to' =>  $user->user_email,
//            'attr' => array(
//                'EMAIL' =>  $user->user_email,
//                'NAME' => $user->user_nicename,
//                'TOTAL' => $order->get_total(),
//                'PAID' => $order->get_total(),
//                'TAX' => 0,
//                'ITEMS_HTML' => $items_html
//            )
//        ));

    ?>
    <main class="vh-100 flex-grow-1" style="min-height: -webkit-fill-available;">
        <section class="bg-turquoise-gradient h-100 d-flex align-items-center text-center">
            <div class="container">
                <div class="col mx-auto">
                    <h3 class="order-confirmation-title mx-auto">Congratulations, your order is complete.</h3>
                    <p class="text-white order-confirmation-text mx-auto">Thank you for your order. You can download your purchases now via the link below, or later from the Downloads tab located in your Account Dashboard.</p>
                    <a href="/my-account/downloads" class="badge badge-pill-order-confirmation badge-success">Access downloads</a>
                </div>
            </div>
        </section>
    </main>
<?php endif; ?>

<?php else : ?>

    <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), null); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

<?php endif; ?>
