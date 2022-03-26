<?php
/*
 * Template Name: Custom Midi Box Checkout
 *
 * */
get_header('cart');
error_reporting(0);

defined('ABSPATH') || exit; ?>

<?php
global $post;
$logo = get_field('logo', $post->ID);
$type_of_variations = get_field('types_of_variation', $post->ID);
// new code
if(isset($_SESSION['sub_month'])) {
    $_SESSION['about_checkout'] = 'checkout-page';
}

$variation_products = [];
foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

    if ('product_variation' === get_post_type($_product->get_id()) || (class_exists('WC_Subscriptions_Product') && WC_Subscriptions_Product::is_subscription($_product))) {
        if ('product_variation' === get_post_type($_product->get_id())) :
            $product_id = wp_get_post_parent_id($_product->get_id());
            $variation_products[] = $product_id;
        else :
            $variation_products[] = $product_id;
        endif;

    }
}
?>
<?php if ($variation_products) :
    $type = $_product->get_attributes()['type'];

    $variation_type = get_field('type_of_variation', $product_id);

    if ($type == $variation_type) :
        $bonus_products = get_field('variation_products_' . strtolower($type), $product_id);
        $total_price = get_field('total_price_' . strtolower($type), $product_id);
    else :
        $bonus_products = get_field('variation_products_light', $product_id);
        $total_price = get_field('total_price_light', $product_id);
    endif;

    if ($type == $type_of_variations) :
        $bullet_text = get_field('bullet_text_' . strtolower($type), $post->ID);
    else :
        $bullet_text = get_field('bullet_text_light', $post->ID);
    endif;
    ?>
<div class="jumbotron checkout text-white bg-secondary py-3">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center d-flex align-items-center justify-content-center flex-sm-row">
                <img src="<?php bloginfo('template_url') ?>/assets/images/secure_checkout h37.svg"
                    class="secure-checkout-image" alt="Secure Checkout">
                <h1>Secure checkout</h1>
            </div>
        </div>
    </div>
</div>
<main class="flex-grow-1 midi-box-checkout custom">
    <section id="cart_woo" class="p-0">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-12 mx-auto">
                    <!-- <div class="woocommerce-notices-wrapper"></div> -->
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
                            <?php if ($bullet_text) : ?>
                                <div class="row checklist">
                                    <?php foreach ($bullet_text as $key => $text) :
                                        if ($key == 0) :
                                            echo '<div class="col-xs-12 col-sm-12 col-lg-6 col-xxxl-7">';
                                        elseif ($key == 5) :
                                            echo '<div class="col-xs-12 col-sm-12 col-lg-6 col-xxxl-5">';
                                        endif; ?>
                                        <div class="checklist-row">
                                            <i class="<?php echo $text['bullet_class']; ?> text-success"></i>
                                            <p class="text-white">​<?php echo $text['bullet_text']; ?></p>
                                        </div>
                                        <?php echo '</div>'; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php else :?>
                            <div class="row checklist">
                                <div class="col-xs-12 col-sm-12 col-lg-6 col-xxxl-7">
                                    <div class="checklist-row">
                                        <i class="fa fa-check text-success"></i>
                                        <p class="text-white">​The Ultimate Shortcut To Producing Hit Songs</p>
                                    </div>
                                    <div class="checklist-row">
                                        <i class="fa fa-check text-success"></i>
                                        <p class="text-white">​​800 Unique, Drag & Drop MIDI Files Every Month</p>
                                    </div>
                                    <div class="checklist-row">
                                        <i class="fa fa-check text-success"></i>
                                        <p class="text-white">​​Chord Progressions, Melodies, Basslines & Drums</p>
                                    </div>
                                    <div class="checklist-row">
                                        <i class="fa fa-check text-success"></i>
                                        <p class="text-white">​​5 Free Exclusive Bonuses</p>
                                    </div>
                                    <div class="checklist-row">
                                        <i class="fa fa-check text-success"></i>
                                        <p class="text-white">​​30-Day Money-Back Guarantee</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-lg-6 col-xxxl-5">
                                    <div class="checklist-row">
                                        <i class="fa fa-check text-success"></i>
                                        <p class="text-white">​​Made For All Genres Of Music</p>
                                    </div>
                                    <div class="checklist-row">
                                        <i class="fa fa-check text-success"></i>
                                        <p class="text-white">​​​Compatible With All DAWs</p>
                                    </div>
                                    <div class="checklist-row">
                                        <i class="fa fa-check text-success"></i>
                                        <p class="text-white">​Works With Both Mac & PC</p>
                                    </div>
                                    <div class="checklist-row">
                                        <i class="fa fa-check text-success"></i>
                                        <p class="text-white">​​100% Royalty-Free</p>
                                    </div>
                                    <div class="checklist-row">
                                        <i class="fa fa-check text-success"></i>
                                        <p class="text-white">​​​Use With Any Sounds</p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="row">
                                <?php
                                    foreach ($bonus_products as $key => $p_id) :
                                        $product = wc_get_product($p_id);
                                        ?>
                                <div class="col-xxxl-6 col-sm-12">
                                    <div class="bg-secondary border-radius-10">
                                        <div class="row bonus-card">
                                            <div class="col-auto text-left pl-0">
                                                <?php echo $product->get_image('woocommerce_thumbnail', array('class' => 'img-fluid')); ?>
                                            </div>
                                            <div class="col text-white text-left pl-0">
                                                <p class="pt-2 text-success">Bonus #<?php echo $key + 1;?></p>
                                                <p><?php echo $product->get_name(); ?></p>
                                                <p><?php echo wc_price($product->get_price());
                                                            ?>/ month value</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <?php

                                $variation_price = wcs_get_variation_prices($_product, $product_id);

                                $order_total_min = $variation_price['sale_price'];
                                $order_total_max = $variation_price['regular_price'];

                                ?>

                            <div class="row limited-offer">
                                <div class="col-12 text-center text-white">
                                    <h6>Total Value:</h6>
                                    <h2 class="text-pink"><?php echo wc_price($total_price); ?></h2>
                                    <?php if (!empty($order_total_min) && !empty($order_total_max)) { ?>
                                    <h5><span class="text-success">Limited Time Offer:</span></h5>
                                    <div class="row d-flex justify-content-center">
                                        <p class="old-price price-warning mr-0 mr-sm-2">
                                            <s><?php echo wc_price($order_total_max); ?></s>
                                        </p>
                                        <div>
                                            <span
                                                class="new-price font-weight-bold"><?php echo wc_price($order_total_min); ?></span><span
                                                class="month">/month</span>
                                        </div>
                                    </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>

                        <div class="col-xxxl-5 col-lg-6 col-sm-12">
                            <div class="container p-0 bg-white payment-box">
                                <div class="complete-order-title">
                                    <h4 class="text-dark text-center">Complete order</h4>
                                </div>
                                <!-- STEPS -->
                                <div class="steps">
                                    <ul class="nav steps-tabs">
                                        <li class="nav-item step step-1 <?php echo (!is_user_logged_in()) ? 'active' : '' ?>"
                                            id="step-1">
                                            <p class="step-number">1</p>
                                            <div class="step-text">
                                                <p class="step-title text-uppercase">account</p>
                                                <p class="step-subtitle text-capitalize">sign up or login</p>
                                            </div>
                                        </li>
                                        <li class="nav-item step step-2 <?php echo (is_user_logged_in()) ? 'active' : '' ?>"
                                            id="step-2">
                                            <p class="step-number">2</p>
                                            <div class="step-text">
                                                <p class="step-title text-uppercase">payment</p>
                                                <p class="step-subtitle text-capitalize">get access now</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- CREATE ACCOUNT BOX -->
                                <div class="create-account-box <?php echo (is_user_logged_in()) ? 'd-none' : '' ?>">
                                    <!-- <form class="create-account-form" action=""> -->
                                    <div class="create-account-form">
                                        <div class="nav">
                                            <?php custom_registration_function(); ?>
                                        </div>

                                        <div class="text-center text-capitalize login-link">
                                            <p class="text-grey">already have a account?
                                                <a href="#" class="text-success pointer"
                                                    onclick="openPopupLogin()">click
                                                    here to login</a>
                                            </p>
                                        </div>
                                    </div>
                                    <!-- </form> -->
                                </div>

                                <!-- SELECT PAYMENT BOX -->
                                <div class="select-payment-box <?php echo (!is_user_logged_in()) ? 'd-none' : '' ?>">
                                    <div class="col p-0">
                                        <p class="text-success payment-method-select p-0">Product</p>
                                        <div class="d-flex col justify-content-between p-0 pt-2"
                                            style="color: black; font-weight: bold;">
                                            <span>
                                                <?php
                                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                                                    ?>
                                            </span>
                                            <span>
                                                <?php
                                                if ($order_total_min) {
                                                    $last_price = $order_total_min;
                                                } else {
                                                    $last_price = $order_total_max;
                                                }
                                                echo apply_filters('woocommerce_cart_item_price', wc_price($last_price), $cart_item, $cart_item_key);
                                                ?>/month
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col p-0 pt-3">
                                        <p class="text-success payment-method-select p-0">Select payment method:</p>
                                        <form name="checkout" method="post" class="checkout woocommerce-checkout"
                                            action="<?php echo esc_url(wc_get_checkout_url()); ?>"
                                            enctype="multipart/form-data">
                                            <div id="payment" class="woocommerce-checkout-payment">

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

                                                <h3 id="order_review_heading"><?php _e('Your order', 'woocommerce'); ?>
                                                </h3>

                                                <?php do_action('woocommerce_checkout_before_order_review'); ?>

                                                <div id="order_review" class="woocommerce-checkout-review-order">
                                                    <?php do_action('woocommerce_checkout_order_review'); ?>
                                                </div>

                                                <?php do_action('woocommerce_checkout_after_order_review'); ?>

                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <div class="access-note">
                                <p class="text-center">Access will be sent to your email & granted in your Unison
                                    account.
                                </p>
                                <div class="credit-card-icons"></div>
                            </div>
                        </div>
                    </div>
                    <!-- SECURE PAYMENT SECTION -->
                    <div class="row secure-payment">
                        <div class="col-xxxl-7 col-lg-6 col-sm-12 text-center text-sm-left">
                            <div class="media flex-column flex-sm-row text">
                                <img src="<?php bloginfo('template_url') ?>/assets/images/checkout-money-back.svg"
                                    alt="60 Days Money Back Guarantee">
                                <div class="media-body">
                                    <h5>60-Day Money-Back Guarantee</h5>
                                    <p class="text-white">We stand behind our products 100%. If you don’t absolutely
                                        love the pack, just email support@unison.audio within 60 days and we’ll give you
                                        100% of your money back. No questions asked. No hard feelings.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxxl-5 col-lg-6 col-sm-12 text-center text-sm-left">
                            <div class="media flex-column flex-sm-row">
                                <img src="<?php bloginfo('template_url') ?>/assets/images/checkout-secure.svg"
                                    alt="Secure Payment">
                                <div class="media-body">
                                    <h5>Secure Payment</h5>
                                    <p class="text-white">All orders are processed through a secure payment network. Your payment information is safely encrypted with 256-bit SSL technology and your information is never shared. We respect your privacy.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center d-lg-none">
                        <a href="#" class="badge badge-success order-now">
                            order now
                            <img class="up-arrow ml-2"
                                src="<?php bloginfo('template_url') ?>/assets/images/arrow-up.png">
                        </a>
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
                    class="secure-checkout-image" alt="Secure Checkout">
                <h1>Secure checkout</h1>
            </div>
        </div>
    </div>
</div>

<?php do_action('woocommerce_before_cart'); ?>

<?php do_action('woocommerce_before_cart_table'); ?>
<main class="flex-grow-1 midi-box-checkout pt-5 bg-dark">
    <section id="cart_woo" class="p-0">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-12 mx-auto">
                    <!-- <div class="woocommerce-notices-wrapper"></div> -->
                    <div class="row flex-lg-row flex-xs-column-reverse flex-sm-column-reverse">
                        <div class="col-xxxl-7 col-lg-6 col-sm-12 bg-transparent text-center">
                            <h5 class="text-center order-summary text-sm-left">Order Summary</h5>
                            <div class="py-2 text-white vertical-overflow order-summary-content">
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
                                    class="media mb-3 <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
                                    <div class="product-image-holder"
                                        style="background-image: url(<?php echo get_the_post_thumbnail_url($product_id, 'thumbnail') ?>); background-position: center; background-size: cover">
                                    </div>
                                    <div class="media-body pr-3">
                                        <div class="row align-items-start">
                                            <div class="col-9 text-center text-xs-left text-sm-left">
                                                <h5 class="product-title">
                                                    <?php
                                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                                                    ?>
                                                </h5>
                                                <p class="font-weight-normal product-subtitle"><?php

                                                    $primary_cat_id = get_post_meta($product_id,'_yoast_wpseo_primary_product_cat',true);
                                                    if( $primary_cat_id ){
                                                        $product_cat = get_term($primary_cat_id, 'product_cat');
                                                    if( isset($product_cat->name) )
                                                        echo $product_cat->name;
                                                    }
                                                    
                                                    ?>
                                                </p>
                                                <?php
                                                    echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                                                    // Backorder notification
                                                    if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                                                    }
                                                ?>
                                                <span class="price font-weight-bold">
                                                    <?php echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                                    ?>
                                                    <span>
                                            </div>
                                            <div class="col-3 text-center">
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


                            <form class="frmCart coupon_form" action="<?php echo esc_url(wc_get_cart_url()); ?>"
                                method="post">
                                <!-- <div class="yellow-line"></div> -->
                                <?php if (wc_coupons_enabled()) { ?>
                                <label for="coupon_code"
                                    class="p2 my-4 text-light"><?php esc_html_e('Promo Code', 'woocommerce'); ?></label>
                                <input type="text" name="coupon_code"
                                    class="w-100 border-0 bg-light mb-4 woocommerce-Input" id="coupon_code" value=""
                                    placeholder="<?php esc_attr_e('Enter Promo Code', 'woocommerce'); ?>" />
                                <input type="submit" class="border-0 badge badge-pill apply-button" name="apply_coupon"
                                    value="<?php esc_attr_e('Apply', 'woocommerce'); ?>"></button>
                                <?php do_action('woocommerce_cart_coupon'); ?>
                                <?php }
                                    ?>

                                <?php do_action('woocommerce_cart_actions'); ?>

                                <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                                <?php global $woocommerce; ?>

                                <!-- <ul class="w-100 d-inline-flex text-white p1 flex-column mt-3">
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
                                </ul> -->
                            </form>
                        </div>

                        <div class="col-xxxl-5 col-lg-6 col-sm-12">
                            <div class="container p-0 bg-white payment-box">
                                <div class="complete-order-title">
                                    <h4 class="text-dark text-center">Complete order</h4>
                                </div>
                                <!-- STEPS -->
                                <div class="steps">
                                    <ul class="nav steps-tabs">
                                        <li class="nav-item step step-1 <?php echo (!is_user_logged_in()) ? 'active' : '' ?>"
                                            id="step-1">
                                            <p class="step-number">1</p>
                                            <div class="step-text">
                                                <p class="step-title text-uppercase">account</p>
                                                <p class="step-subtitle text-capitalize">sign up or login</p>
                                            </div>
                                        </li>
                                        <li class="nav-item step step-2 <?php echo (is_user_logged_in()) ? 'active' : '' ?>"
                                            id="step-2">
                                            <p class="step-number">2</p>
                                            <div class="step-text">
                                                <p class="step-title text-uppercase">payment</p>
                                                <p class="step-subtitle text-capitalize">get access now</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- CREATE ACCOUNT BOX -->
                                <div class="create-account-box <?php echo (is_user_logged_in()) ? 'd-none' : '' ?>">
                                    <!--                                    <form class="create-account-form" action="">-->
                                    <div class="create-account-form">
                                        <div class="nav">
                                            <?php custom_registration_function(); ?>
                                        </div>

                                        <div class="text-center text-capitalize login-link">
                                            <p class="text-grey">already have a account?
                                                <a href="#" class="text-success pointer"
                                                    onclick="openPopupLogin()">click
                                                    here to login</a>
                                            </p>
                                        </div>
                                    </div>
                                    <!--                                    </form>-->
                                </div>

                                <!-- SELECT PAYMENT BOX -->
                                <div class="select-payment-box <?php echo (!is_user_logged_in()) ? 'd-none' : '' ?>">
                                    <div class="col p-0">
                                        <ul class="w-100 d-inline-flex text-white p1 flex-column mt-3">
                                            <?php if ( ! empty( WC()->cart->applied_coupons ) ) {?>
                                             <li>
                                                <div class="d-flex col justify-content-between p-0 pt-2"
                                                    style="color: black; font-weight: bold;">
                                                    <label class="mb-0 text-tabs"><?php _e('Subtotal', 'woocommerce'); ?></label>
                                                    <span class="price text-tabs">
                                                        <?php echo WC()->cart->get_cart_subtotal(); ?>
                                                    </span>
                                                </div>
                                            </li>
                                            <?php } ?>
                                            <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
                                            <li class="coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
                                                <div class="d-flex col justify-content-between p-0 pt-2"
                                                    style="color: black; font-weight: bold;">
                                                    <label class="mb-0 text-tabs">
                                                        <?php wc_cart_totals_coupon_label($coupon); ?>
                                                    </label>
                                                    <span class="price text-tabs">
                                                        <?php wc_cart_totals_coupon_html($coupon); ?>
                                                    </span>
                                                </div>
                                            </li>
                                            <?php endforeach; ?>
                                            <li>
                                                <div class="d-flex col justify-content-between p-0 pt-2"
                                                    style="color: black; font-weight: bold;">
                                                    <label class="mb-0 text-tabs">Total</label>
                                                    <span class="price text-tabs">
                                                        <?php wc_cart_totals_order_total_html(); ?>
                                                    </span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- <div class="col p-0">
                                        <p class="text-success payment-method-select p-0">Product</p>
                                        <div class="d-flex col justify-content-between p-0 pt-2"
                                            style="color: black; font-weight: bold;">
                                            <span>
                                                <?php
                                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                                                    ?>
                                            </span>
                                            <span>
                                                <?php echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                                    ?>
                                            </span>
                                        </div>
                                    </div> -->

                                    <?php if ( $woocommerce->cart->total !== "0" ) { ?>
                                        <p class="text-success payment-method-select">Select payment method:</p>
                                    <?php } ?>
                                    <form name="checkout" method="post" class="checkout woocommerce-checkout"
                                        action="<?php echo esc_url(wc_get_checkout_url()); ?>"
                                        enctype="multipart/form-data">

                                        <div id="payment" class="woocommerce-checkout-payment">
                                            <ul class="wc_payment_methods payment_methods methods">
                                                <li class="wc_payment_method payment_method_stripe position-relative">
                                                    <input id="payment_method_stripe" type="radio"
                                                        class="input-radio position-absolute" name="payment_method"
                                                        value="stripe" checked="checked"
                                                        data-order_button_text="Checkout">
                                                    <label for="payment_method_stripe" class="font-weight-bold">
                                                        Credit Card
                                                    </label>
                                                    <div class="label-images">
                                                        <img src="./assets/images/cards-logo.png" alt="Credit Cards">
                                                    </div>
                                                </li>
                                                <li class="wc_payment_method payment_method_paypal position-relative">
                                                    <input id="payment_method_paypal" type="radio"
                                                        class="input-radio position-absolute" name="payment_method"
                                                        value="paypal" data-order_button_text="Proceed to PayPal">
                                                    <label for="payment_method_paypal" class="font-weight-bold">
                                                        PayPal </label>
                                                    <div class="label-images">
                                                        <img src="./assets/images/paypal-logo.png"
                                                            alt="PayPal acceptance mark">
                                                    </div>
                                                </li>
                                                
                                                <button type="submit" class="complete-payment-button">
                                                    <p>complete order</p>
                                                    <span class="submit-btn-subtitle text-capitalize">Get instant
                                                        access</span>
                                                </button>
                                                <p class="text-grey text-center secure-order-info">Your order is
                                                    processed through a secure payment network.</p>
                                            </ul>
                                            <div class="form-row place-order">
                                                <noscript>
                                                    Since your browser does not support JavaScript, or it is
                                                    disabled,please ensure you click the <em>Update Totals</em>
                                                    button before placing your order. You may be charged more than
                                                    the amount stated above
                                                    if you fail to do so. <br /><input type="submit" class="button alt"
                                                        name="woocommerce_checkout_update_totals"
                                                        value="Update totals" />
                                                </noscript>
                                                <!-- <input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="Complete Order" data-value="CHECKOUT">
                                                    <input type="hidden" id="_wpnonce" name="_wpnonce" value="aad7493525"><input type="hidden" name="_wp_http_referer" value="/?wc-ajax=update_order_review"> -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="access-note">
                                <p class="text-center">Access will be sent to your email & granted in your Unison
                                    account.
                                </p>
                                <div class="credit-card-icons"></div>
                            </div>

                        </div>
                    </div>

                    <!-- SECURE PAYMENT SECTION -->
                    <div class="row secure-payment">
                        <div class="col-xxxl-7 col-lg-6 col-sm-12 text-center text-sm-left">
                            <div class="media flex-column flex-sm-row text">
                                <img src="<?php bloginfo('template_url') ?>/assets/images/checkout-money-back.svg"
                                    alt="60 Days Money Back Guarantee">
                                <div class="media-body">
                                    <h5>60-Day Money-Back Guarantee</h5>
                                    <p class="text-white">We stand behind our products 100%. If you don’t absolutely love your purchase, just email support@unison.audio within 60 days and we’ll give you 100% of your money back. No questions asked. No hard feelings.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxxl-5 col-lg-6 col-sm-12 text-center text-sm-left">
                            <div class="media flex-column flex-sm-row">
                                <img src="<?php bloginfo('template_url') ?>/assets/images/checkout-secure.svg"
                                    alt="Secure Payment">
                                <div class="media-body">
                                    <h5>Secure Payment</h5>
                                    <p class="text-white">All orders are processed through a secure payment network. Your payment information is safely encrypted with 256-bit SSL technology and your information is never shared. We respect your privacy.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center d-lg-none">
                        <a href="#" class="badge badge-success order-now">
                            order now
                            <img class="up-arrow ml-2"
                                src="<?php bloginfo('template_url') ?>/assets/images/arrow-up.png">
                        </a>
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

<?php 
    // do_action('woocommerce_after_cart');
    get_footer();
?>