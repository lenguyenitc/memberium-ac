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
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined('ABSPATH') || exit; ?>

<?php
$variation_products = [];
foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

    if ('product_variation' === get_post_type($_product->get_id())) {
        $product_id = wp_get_post_parent_id($product_id);
        $variation_products[] = $product_id;
    }
}

?>
<?php if ($variation_products) :
    $type = $_product->get_attributes()['type'];
    if ($type) :
        $cat = get_term_by('slug', strtolower($type) . '-subscription', 'product_cat');

    $args = array(
        'post_type'  => 'product',
        'tax_query' => [
            [
                'taxonomy' => 'product_cat',
                'terms' => $cat->term_id
            ],
        ],
    );
    $bonus_posts = get_posts($args);
    endif;
    ?>
    <div class="jumbotron checkout text-white bg-secondary py-3">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center d-flex align-items-center justify-content-center flex-sm-row">
                    <img src="<?php bloginfo('template_url') ?>/assets/images/secure_checkout h37.svg"
                         alt="Secure Checkout">
                    <h1>Secure checkout</h1>
                </div>
            </div>
        </div>
    </div>
    <main class="flex-grow-1 midi-box-checkout">
        <section id="cart_woo" class="p-0">
            <div class="container">
                <div class="row">
                    <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-12 mx-auto">
                        <div class="woocommerce-notices-wrapper"></div>
                        <div class="row checkout-title align-items-center justify-content-center text-center">
                            <h3>Complete Your <span class="text-success">Midi Box Sign Up</span> Now</h3>
                        </div>
                        <div class="row flex-lg-row flex-xs-column-reverse flex-sm-column-reverse">
                            <div class="col-xxxl-7 col-lg-6 col-sm-12 bg-black text-center checkout-container">
                                <img class="img-fluid midi-box-img"
                                     src="<?php bloginfo('template_url') ?>/assets/images/MIDI Box Logo 9.png"
                                     alt="MIDI Box Logo">
                                <h4>Here's what <span class="text-success">you'll
                                        get</span>:</h4>
                                <div class="row checklist">
                                    <div class="col-7">
                                        <div class="pb-3"
                                             style="display: flex; flex-direction: row; text-align: left; gap: 5px;">
                                            <div>
                                                <i class="fa fa-check mr-3 text-success"></i>
                                            </div>
                                            <p class="text-white">​The Ultimate Shortcut To Producing Hit Songs</p>
                                        </div>
                                        <div class="pb-3"
                                             style="display: flex; flex-direction: row; text-align: left; gap: 5px;">
                                            <div>
                                                <i class="fa fa-check mr-3 text-success"></i>
                                            </div>
                                            <p class="text-white">​​800 Unique, Drag & Drop MIDI Files Every Month</p>
                                        </div>
                                        <div class="pb-3"
                                             style="display: flex; flex-direction: row; text-align: left; gap: 5px;">
                                            <div>
                                                <i class="fa fa-check mr-3 text-success"></i>
                                            </div>
                                            <p class="text-white">​​Chord Progressions, Melodies, Basslines & Drums</p>
                                        </div>
                                        <div class="pb-3"
                                             style="display: flex; flex-direction: row; text-align: left; gap: 5px;">
                                            <div>
                                                <i class="fa fa-check mr-3 text-success"></i>
                                            </div>
                                            <p class="text-white">​​5 Free Exclusive Bonuses</p>
                                        </div>
                                        <div class="pb-3"
                                             style="display: flex; flex-direction: row; text-align: left; gap: 5px;">
                                            <div>
                                                <i class="fa fa-check mr-3 text-success"></i>
                                            </div>
                                            <p class="text-white">​​30-Day Money-Back Guarantee</p>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="pb-3"
                                             style="display: flex; flex-direction: row; text-align: left; gap: 5px;">
                                            <div>
                                                <i class="fa fa-check mr-3 text-success"></i>
                                            </div>
                                            <p class="text-white">​​Made For All Genres Of Music</p>
                                        </div>
                                        <div class="pb-3"
                                             style="display: flex; flex-direction: row; text-align: left; gap: 5px;">
                                            <div>
                                                <i class="fa fa-check mr-3 text-success"></i>
                                            </div>
                                            <p class="text-white">​​​Compatible With All DAWs</p>
                                        </div>
                                        <div class="pb-3"
                                             style="display: flex; flex-direction: row; text-align: left; gap: 5px;">
                                            <div>
                                                <i class="fa fa-check mr-3 text-success"></i>
                                            </div>
                                            <p class="text-white">​Works With Both Mac & PC</p>
                                        </div>
                                        <div class="pb-3"
                                             style="display: flex; flex-direction: row; text-align: left; gap: 5px;">
                                            <div>
                                                <i class="fa fa-check mr-3 text-success"></i>
                                            </div>
                                            <p class="text-white">​​100% Royalty-Free</p>
                                        </div>
                                        <div class="pb-3"
                                             style="display: flex; flex-direction: row; text-align: left; gap: 5px;">
                                            <div>
                                                <i class="fa fa-check mr-3 text-success"></i>
                                            </div>
                                            <p class="text-white">​​​Use With Any Sounds</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php foreach ($bonus_posts as $bonus_post) : ?>
                                        <div class="col-xxxl-6 col-sm-12">
                                            <div class="bg-secondary">
                                                <div class="row bonus-card">
                                                    <div class="col-4 text-left">
                                                        <img class="img-fluid"
                                                             src="<?php echo get_the_post_thumbnail_url($bonus_post->ID)?>"
                                                             alt="">
                                                    </div>
                                                    <div class="col-8 text-white text-left p-0">
                                                        <p class="pt-2 text-success"><?php echo $bonus_post->post_title; ?></p>
                                                        <p><?php echo $bonus_post->post_excerpt; ?></p>
                                                        <p>(800 MIDIs Every Month)</p>
                                                        <p>$<?php echo get_post_meta($bonus_post->ID, '_subscription_price', true);
                                                            ?>/ <?php echo get_post_meta($bonus_post->ID, '_subscription_period', true);
                                                            ?> value</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="row limited-offer">
                                    <div class="col-12 text-center text-white">
                                        <h6>Total Value:</h6>
                                        <h2 class="text-pink">$648</h2>
                                        <h5><span class="text-success">Limited Time Offer:</span></h5>
                                        <div class="row d-flex justify-content-center">
                                            <p class="old-price price-warning mr-0 mr-sm-2"><s>$127</s></p>
                                            <div>
                                                <span class="new-price font-weight-bold">$27</span><span class="month">/month</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxxl-5 col-lg-6 col-sm-12">
                                <div class="container p-0 bg-white payment-box">
                                    <div class="complete-order-title">
                                        <h4 class="text-dark text-center">Complete order</h4>
                                    </div>
                                    <form name="checkout" method="post" class="checkout woocommerce-checkout"
                                          action="<?php echo esc_url(wc_get_checkout_url()); ?>"
                                          enctype="multipart/form-data">
                                        <?php if (!is_user_logged_in()) {
                                            echo apply_filters('woocommerce_order_button_html', '<input id="place_order" style="float:right" type="submit" class="js-check-login button alt" type="hidden" name="woocommerce_checkout_place_order" value="Proceed To Checkout" data-value="' . esc_attr($order_button_text) . '" />');
                                        } ?>
                                        <?php if (sizeof($checkout->checkout_fields) > 0) : ?>

                                            <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                                            <div class="col2-set" id="customer_details">
                                                <div class="col-1">
                                                    <?php do_action('woocommerce_checkout_billing'); ?>
                                                </div>

                                                <div class="col-2">
                                                    <?php do_action('woocommerce_checkout_shipping'); ?>
                                                </div>
                                            </div>

                                            <?php do_action('woocommerce_checkout_after_customer_details'); ?>

                                        <?php endif; ?>

                                        <h3 id="order_review_heading"><?php _e('Your order', 'woocommerce'); ?></h3>

                                        <?php do_action('woocommerce_checkout_before_order_review'); ?>

                                        <div id="order_review" class="woocommerce-checkout-review-order">
                                            <?php do_action('woocommerce_checkout_order_review'); ?>
                                        </div>

                                        <?php do_action('woocommerce_checkout_after_order_review'); ?>


                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- SECURE PAYMENT SECTION -->
                        <div class="row secure-payment">
                            <div class="col-xxxl-7 col-lg-6 col-sm-12 text-center text-sm-left">
                                <div class="media flex-column flex-sm-row text">
                                    <img src="<?php bloginfo('template_url')?>/assets/images/checkout-money-back.svg" alt="60 Days Money Back Guarantee">
                                    <div class="media-body">
                                        <h5>60-Day Money-Back Guarantee</h5>
                                        <p class="text-white">We stand behind our products 100%. If you don’t absolutely love the pack, just email support@unison.audio within 60 days and we’ll give you 100% of your money back. No questions asked. No hard feelings.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxxl-5 col-lg-6 col-sm-12 text-center text-sm-left">
                                <div class="media flex-column flex-sm-row">
                                    <img src="<?php bloginfo('template_url')?>/assets/images/checkout-secure.svg" alt="Secure Payment">
                                    <div class="media-body">
                                        <h5>Secure Payment</h5>
                                        <p class="text-white">All orders are processed through a secure payment network. Your payment information is safely encrypted with 256-bit SSL technology and your information is never shared. We respect your privacy.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
<?php else :
    ?>
    <div class="jumbotron checkout text-white bg-secondary py-3">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center d-flex align-items-center justify-content-center flex-sm-row">
                    <img src="<?php bloginfo('template_url') ?>/assets/images/secure_checkout h37.svg"
                         alt="Secure Checkout">
                    <!-- <h1><?php echo $cs_chk_option_page_heading; ?></h1> -->
                    <h1>Secure Checkout</h1>
                </div>
            </div>
        </div>
    </div>

    <?php do_action('woocommerce_before_cart'); ?>

    <?php do_action('woocommerce_before_cart_table'); ?>
    <main class="flex-grow-1 midi-box-checkout">
        <section id="cart_woo" class="p-0">
            <div class="container">
                <div class="row">
                    <div class="col-xxxl-8 col-xxl-10 col-sm-12 mx-auto">
                        <div class="woocommerce-notices-wrapper"></div>
                        <div class="row">
                            <div class="col-xxxl-7 col-lg-6 col-sm-12 mb-4">
                                <h4 class="mb-5 text-center text-sm-left">Order Summary</h4>
                                <div class="py-2 text-white overflow-auto order-summary-content">
                                    <?php do_action('woocommerce_before_cart_contents'); ?>

                                    <?php
                                    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                                        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                                        if ('product_variation' === get_post_type($product_id)) {
                                            $variation_id = $product_id;
                                            $product_id = wp_get_post_parent_id($variation_id);
                                        }

                                        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                                            $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                                            ?>
                                            <div
                                                    class="media align-items-center flex-column flex-sm-row mb-5 <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
                                                <img class="mr-0 mb-3 mr-sm-5 mb-sm-0"
                                                     src="<?php echo get_the_post_thumbnail_url($product_id, 'thumbnail') ?>"
                                                     alt="Generic placeholder image">
                                                <div class="media-body pr-3">
                                                    <div class="row align-items-start">
                                                        <div class="col-lg-10 col-sm-10 text-center text-sm-left">
                                                            <h5 class="mt-0">
                                                                <?php
                                                                echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                                                                ?>
                                                            </h5>
                                                            <h6 class="p1 my-1 font-weight-normal"><?php
                                                                $terms = get_the_terms($product_id, 'product_cat');
                                                                $arr = array();
                                                                foreach ($terms as $term) {
                                                                    $product_cat = $term->term_id;
                                                                    $arr[] = $product_cat;
                                                                }
                                                                if (in_array('13', $arr)) {
                                                                    echo 'Serum Collection';
                                                                } elseif (in_array('12', $arr)) {
                                                                    echo 'Artist Series';
                                                                } elseif (in_array('130', $arr)) {
                                                                    echo 'Vocal series';
                                                                } elseif (in_array('132', $arr)) {
                                                                    echo 'MIDI Collection';
                                                                } else {
                                                                    echo $terms[0]->name;
                                                                }
                                                                //echo $terms[0]->name;

                                                                ?></h6>
                                                            <?php
                                                            echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                                                            // Backorder notification
                                                            if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                                                echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                                                            }
                                                            ?>
                                                            <span class="price d-block mt-3 font-weight-bold">
                                                    <?php echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                                    ?>
                                                    <span>
                                                        </div>
                                                        <div class="col-lg-2 col-sm-2 text-center">
                                                            <?php
                                                            echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                                'woocommerce_cart_item_remove_link',
                                                                sprintf(
                                                                    '<a href="%s" class="text-light d-block" aria-label="%s" data-product_id="%s" data-product_sku="%s">&#10006;</a>',
                                                                    esc_url(wc_get_cart_remove_url($cart_item_key)),
                                                                    esc_html__('Remove order', 'woocommerce'),
                                                                    esc_attr($product_id),
                                                                    esc_attr($_product->get_sku())
                                                                ),
                                                                $cart_item_key
                                                            );
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }

                                    do_action('woocommerce_cart_contents');
                                    ?>
                                    <?php do_action('woocommerce_after_cart_contents'); ?>

                                    <?php do_action('woocommerce_after_cart_table'); ?>
                                </div>


                                <form class="frmCart coupon_form mt-5"
                                      action="<?php echo esc_url(wc_get_cart_url()); ?>"
                                      method="post">
                                    <?php if (wc_coupons_enabled()) { ?>
                                        <label for="coupon_code"
                                               class="p2 mb-4 text-light"><?php esc_html_e('Promo Code', 'woocommerce'); ?></label>
                                        <input type="text" name="coupon_code"
                                               class="w-100 border-0 bg-light mb-4 woocommerce-Input" id="coupon_code"
                                               value=""
                                               placeholder="<?php esc_attr_e('Enter Promo Code', 'woocommerce'); ?>"/>
                                        <input type="submit" class="border-0 float-right badge badge-pill"
                                               name="apply_coupon"
                                               value="<?php esc_attr_e('Apply', 'woocommerce'); ?>"></button>
                                        <?php do_action('woocommerce_cart_coupon'); ?>
                                    <?php }
                                    ?>

                                    <?php do_action('woocommerce_cart_actions'); ?>

                                    <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                                    <?php global $woocommerce; ?>

                                    <ul class="w-100 d-inline-flex text-white p1 flex-column mt-3 border-bottom">
                                        <li>
                                            <label class="mb-0 p1">Subtotal</label>
                                            <span class="price">
                                            <?php wc_cart_totals_subtotal_html(); ?>
                                        </span>
                                        </li>
                                        <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
                                            <li class="coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
                                                <label class="mb-0 p1">
                                                    <?php wc_cart_totals_coupon_label($coupon); ?>
                                                </label>
                                                <span class="price">
                                            <?php wc_cart_totals_coupon_html($coupon); ?>
                                        </span>
                                            </li>
                                        <?php endforeach; ?>
                                        <li>
                                            <label class="mb-0 p1">Total</label>
                                            <span class="price">
                                            <?php wc_cart_totals_order_total_html(); ?>
                                        </span>
                                        </li>
                                    </ul>
                                </form>

                            </div>


                            <div class="col-xxxl-5 col-lg-6 col-sm-12 text-center">
                                <div class="container p-0 bg-white payment-box">
                                    <div class="complete-order-title">
                                        <!-- <h4 class="text-dark text-center"><?php echo $cs_chk_option_sub_heading_right; ?>
                                    </h4> -->
                                        <h4 class="text-dark text-center">Complete Order</h4>
                                    </div>

                                    <p class="text-success text-left font-weight-bold">Select payment method</p>

                                    <form name="checkout" method="post" class="checkout woocommerce-checkout"
                                          action="<?php echo esc_url(wc_get_checkout_url()); ?>"
                                          enctype="multipart/form-data">
                                        <?php if (!is_user_logged_in()) {
                                            echo apply_filters('woocommerce_order_button_html', '<input id="place_order" style="float:right" type="submit" class="js-check-login button alt" type="hidden" name="woocommerce_checkout_place_order" value="Proceed To Checkout" data-value="' . esc_attr($order_button_text) . '" />');
                                        } ?>
                                        <?php if (sizeof($checkout->checkout_fields) > 0) : ?>

                                            <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                                            <div class="col2-set" id="customer_details">
                                                <div class="col-1">
                                                    <?php do_action('woocommerce_checkout_billing'); ?>
                                                </div>

                                                <div class="col-2">
                                                    <?php do_action('woocommerce_checkout_shipping'); ?>
                                                </div>
                                            </div>

                                            <?php do_action('woocommerce_checkout_after_customer_details'); ?>

                                        <?php endif; ?>

                                        <h3 id="order_review_heading"><?php _e('Your order', 'woocommerce'); ?></h3>

                                        <?php do_action('woocommerce_checkout_before_order_review'); ?>

                                        <div id="order_review" class="woocommerce-checkout-review-order">
                                            <?php do_action('woocommerce_checkout_order_review'); ?>
                                        </div>

                                        <?php do_action('woocommerce_checkout_after_order_review'); ?>


                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- SECURE PAYMENT SECTION -->
                        <div class="row align-items-center secure-payment">
                            <div class="col-xxxl-6 col-lg-6 col-sm-12 text-center text-sm-left">
                                <div class="media align-items-center flex-column flex-sm-row mb-5">
                                    <img class="mr-0 mb-3 mr-sm-4 mb-sm-0 img-fluid"
                                         src="<?php echo bloginfo('template_url') ?>/assets/images/money-back-guaranteed.png"
                                         alt="60 Days Money Back Guarantee">
                                    <div class="media-body pr-3">
                                        <h5 class="mt-0 mb-3">60-Day Money-Back Guarantee</h5>
                                        <p class="p1 text-white">Here at Unison we stand behind our products fully. If
                                            you’re not blown away with the improvement to your music, just email
                                            supprot@unison.audio within 60 days and we’ll give you 100% of your money
                                            back. No question asked. No hard feelings. You have nothing to lose and
                                            everything to gain.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxxl-5 offset-xxxl-1 col-lg-6 col-sm-12 text-center text-sm-left">
                                <div class="media align-items-center flex-column flex-sm-row mb-5">
                                    <img class="mr-0 mb-3 mr-sm-4 mb-sm-0 img-fluid"
                                         src="<?php echo bloginfo('template_url') ?>/assets/images/secure ssl transaction.png"
                                         alt="Secure Payment">
                                    <div class="media-body pr-3">
                                        <h5 class="mt-0 mb-3">Secure Payment</h5>
                                        <p class="p1 text-white">We securely accept payments through all major credit
                                            cards and PayPal. Your payment information is never stored and safely
                                            encrypted with 256-bit SSL technology. We respect your privacy.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php endif; ?>
    <style type="text/css">
        .cart-page-wrapper-section {
            width: 100%;
            position: relative;
        }

        .cart-page-wrapper-left,
        .cart-page-wrapper-right {
            width: 50%;
            display: inline-block;
            float: left;
        }

        .cart-page-wrapper-right .export .code,
        .cart-page-wrapper-right .export .info {
            width: 100%;
        }
    </style>
<?php global $product, $woocommerce_loop;

if (!$crosssells = WC()->cart->get_cross_sells()) {
    return;
}

$args = array(
    'post_type' => 'product',
    'ignore_sticky_posts' => 1,
    'no_found_rows' => 1,
    'posts_per_page' => apply_filters('woocommerce_cross_sells_total', 1),
    'orderby' => $orderby,
    'post__in' => $crosssells,
    'meta_query' => WC()->query->get_meta_query()
);

$products = new WP_Query($args);
$woocommerce_loop['name'] = 'cross-sells';
$woocommerce_loop['columns'] = apply_filters('woocommerce_cross_sells_columns', $columns);
$upsell_on_cart_page = 'false';
if ($products->have_posts() && $upsell_on_cart_page == 'true') : ?>

    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="up-sells upsells products upsells_custom_popup">
                <?php while ($products->have_posts()) : $products->the_post();
                    $price = get_post_meta(get_the_ID(), '_regular_price', true);
                    $sale = get_post_meta(get_the_ID(), '_sale_price', true); ?>
                    <input type="hidden" class="extra_product_title" value="<?php echo get_the_title(); ?>">
                    <div class="images_popup">
                        <div class="mobile_view">
                            <h1 class="product_title entry-title"> Producers who bought this item
                                also bought <br>"<?php echo get_the_title(); ?>" </h1>
                        </div>
                        <?php the_post_thumbnail('medium'); ?>
                        <div class="price_section">
                            <?php if ($price) { ?>
                                <span class="price"><?php echo '$' . $price; ?> </span>
                            <?php }
                            if ($sale) {
                                ?>
                                <span class="sale"><?php echo $sale; ?> </span>
                            <?php } ?>
                        </div>
                        <?php
                        $music = get_post_meta(get_the_ID(), '_music', true); ?>
                        <div class='cta'>
                            <?php
                            if (($price > 0) || $sale > 0) {
                                echo '<div class="single_product_play"><div class="play_single_audio"><a href="546" class="btn-play js-sound" data-file="' . $music . '" data-id="' . get_the_ID() . '"></a></div></div><span style="display: inline-block;vertical-align: middle;">play demo</span>';
                            } else {
                                echo '<div class="single_product_play"><div class="play_single_audio"><a href="546" class="btn-free-play js-sound" data-file="' . $music . '" data-id="' . get_the_ID() . '"></a></div></div><span style="display: inline-block;vertical-align: middle;">play demo</span>';
                            } ?>
                        </div>
                    </div>
                    <div class="product_details desktop_view">
                        <h1 class="product_title entry-title"> Producers who bought this item also bought
                            <br>"<?php echo get_the_title(); ?>"
                        </h1>
                        <div class="button_section">
                            <form class="cart" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="add-to-cart" value="<?php echo get_the_ID(); ?>">
                                <input type="submit" class="test-button add_cart_btn btn-buy">YES, ADD TO ORDER
                                </button>
                            </form>
                            <a href="javascript:void(0);" class="goToCheckout add_cart_btn checkout_btn">NO, GO TO
                                CHECKOUT</a>
                        </div>
                    </div>
                <?php endwhile; // end of the loop.
                wp_reset_query(); ?>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php do_action('woocommerce_after_cart'); ?>