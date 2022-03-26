<?php

/**
 * View Subscription
 *
 * Shows the details of a particular subscription on the account page
 *
 * @author  Prospress
 * @package WooCommerce_Subscription/Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

wc_print_notices(); ?>

<?php
foreach ($subscription->get_items() as $item_id => $item) {
    $_product = apply_filters('woocommerce_subscriptions_order_item_product', $item->get_product(), $item);
    $upgrade_downgrade_button = WC_Subscriptions_Switcher::get_switch_url($item_id, $item, $subscription);

    $type = $item->get_meta('type');

    if ($type != 'Pro') {
        if ($type == "Plus") :
            $variations = get_variations_for_product($item['product_id']);
            foreach ($variations as $variation) {
                $variation_type = wc_get_product_variation_attributes($variation->ID);

                $upgrade_variation = 'Pro';
                if ($variation_type['attribute_type'] == 'Pro') {
                    $upgrade_id = $variation->ID;
                    $upgrade_name = $variation->post_title;
                    $upgrade_price = $variation->price;
                    $upgrade_thumb = $variation->thumb;
                }
            }
        endif;

        if ($type == "Light") :
            $variations = get_variations_for_product($item['product_id']);
            foreach ($variations as $variation) {
                $variation_type = wc_get_product_variation_attributes($variation->ID);

                $upgrade_variation = 'Plus';
                if ($variation_type['attribute_type'] == 'Plus') {
                    $upgrade_id = $variation->ID;
                    $upgrade_name = $variation->post_title;
                    $upgrade_price = $variation->price;
                    $upgrade_thumb = $variation->thumb;
                }
            }
        endif;
    }
?>

    <div>
        <div class="mx-auto pl-3 pr-3 pl-lg-0 pr-lg-0">
            <div class="tab-content text-white p-0 ">
                <div class="tab-pane active show fade" id="midi-box" role="tabpanel" aria-labelledby="midi-box-tab">
                    <?php if ($subscription->has_status(array('active'))) { ?>
                            <div class="row  account-midi-box  col-xxxl-12 col-xxl-12  col-xl-12 col-lg-12 col-sm-12 col-md-12 col-xs-12 mx-auto align-items-center flex-md-column flex-lg-row ">
                                <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6  col-sm-12 col-md-12 col-xs-12 pr-lg-5 pl-0 text-lg-right text-md-center text-sm-center text-xs-center d-flex justify-content-center justify-content-lg-end banner-img">
<!--                                    <img class="img-fluid mb-lg-0 pr-0 pl-0 img-tier position-relative" src="--><?php //echo get_the_post_thumbnail_url($item['product_id']) ?><!--">-->
                                    <?php echo $_product->get_image(); ?>

                                </div>
                                <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6  col-sm-8 col-md-8 col-xs-12 mx-auto p-0 pl-lg-5 active-plan">
                                    <?php if ($subscription->get_status() === 'pending-cancel') : ?>
                                        <p class="pb-4">
                                            <span class="text-left active-text" style="color: #ECE289; border-color: #ECE289;">Inactive</span>
                                        </p>
                                    <?php endif; ?>
                                    <img class="img-midi" src="<?php bloginfo('template_url') ?>/assets/images/MIDI Box Logo-small.png">
                                    <h4><?php echo $item->get_name(); ?></h4>
                                    <p class="text-white  text-date">Renewal
                                        date: <?php echo date('M d, Y', $subscription->get_time('next_payment')); ?></p>
                                    <?php if ($type != 'Pro') : ?>
                                        <div class="text-center text-lg-left">
                                            <button onclick="openModal()"
                                                    class="btn-violet pointer text-white"><?php echo get_option(WC_Subscriptions_Admin::$option_prefix . '_switch_button_text'); ?></button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <script>
                                $('.btn-violet').on('click', function() {
                                    window.history.replaceState(null, null, "<?php echo $upgrade_downgrade_button; ?>");
                                });
                            </script>
                        <?php
                    } else { ?>
                        <div class="row account-midi-box col-xxxl-12 col-xxl-12  col-xl-12 col-lg-12 col-sm-12 col-md-12 col-xs-12 mx-auto align-items-center flex-md-column flex-lg-row ">
                            <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6  col-sm-12 col-md-12 col-xs-12 pr-lg-5 pl-0 text-lg-right text-md-center text-sm-center text-xs-center d-flex justify-content-center justify-content-lg-end banner-img">

                                <?php echo $_product->get_image(); ?>
                            </div>
                            <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6  col-sm-8 col-md-8 col-xs-12 mx-auto p-0 pl-lg-5 active-plan">
                                <?php if ($subscription->get_status() === 'pending-cancel') : ?>
                                    <p class="pb-4">
                                        <span class="text-left active-text" style="color: #ECE289; border-color: #ECE289;">Inactive</span>
                                    </p>
                                <?php endif; ?>
                                <img class="img-midi" src="<?php bloginfo('template_url') ?>/assets/images/MIDI Box Logo-small.png">
                                <h4><?php echo $item->get_name(); ?></h4>
                                <div class="text-center text-lg-left">
                                    <?php $actions = wcs_get_all_user_actions_for_subscription($subscription, get_current_user_id()); ?>
                                    <?php if (!empty($actions)) : ?>
                                        <?php foreach ($actions as $key => $action) : ?>
                                            <?php if ($subscription->get_status() === 'pending-cancel' && $action['name'] === 'Reactivate') : ?>
                                                <a href="<?php echo esc_url($action['url']); ?>" class="btn-violet pointer text-white <?php echo sanitize_html_class($key) ?>"><?php echo esc_html($action['name']); ?></a>
                                            <?php endif ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="text-center d-block position-relative p-5" id="loading">
                    </div>

                    <!-- SECOND NAV MENU -->
                    <div id="sub-info" class="d-none">
                        <div class="col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-md-12 col-xs-12  p-0 text filter-section" style="border-bottom: 1px solid #393939">
                            <nav class="col-xxxl-4 col-xxl-6 col-xl-6 col-lg-6 col-sm-12 col-md-12 col-xs-12 mx-auto nav w-100 justify-content-around  text-uppercase font-weight-bold mt-0">
                                <a class="nav-link filter-button  grey-link" data-filter="download" id="download" style="border-bottom: none" >Downloads</a>
                                <a class="nav-link filter-button  grey-link" data-filter="billing" id="billing" style="border-bottom: none">Billing</a>
                                <a class="nav-link filter-button  grey-link" data-filter="plan" id="plan" style="border-bottom: none">Plan</a>
                            </nav>
                        </div>

                        <div class="filter download">
                            <?php
                            $post_ids = [];
                            global $wp;
                            $current_slug = $wp->request;
                            if ($subscription->has_status(array('active'))) {

                                if ($subscription->has_downloadable_item() && $subscription->is_download_permitted()) {
                                    $downloads = $subscription->get_downloadable_items();
                                }
                            }

                            foreach ($subscription->get_items() as $item_id => $item) :
                                $upgrade_downgrade_button = WC_Subscriptions_Switcher::get_switch_url($item_id, $item, $subscription);
                            ?>
                                <div>
                                    <div class="mx-auto pl-3 pr-3 pl-lg-0 pr-lg-0">
                                        <div class="tab-content text-white p-0 ">
                                            <div class="tab-pane active show fade" id="midi-box" role="tabpanel" aria-labelledby="midi-box-tab">
                                                <div class="tab-content text-white p-0">
                                                    <div class="tab-pane active show fade inactive-downloads" id="midi-downloads" role="tabpanel" aria-labelledby="midi-downloads">
                                                        <?php foreach ($downloads as $download) :
                                                            $post_ids[] = $download['product_id'];
                                                            $product = wc_get_product($download['product_id']);

                                                            if ($product->get_date_created()->date('Y-m') <= date('Y-m')) : ?>
                                                                <div class="align-items-center border-bottom">
                                                                    <div class="media-body">
                                                                        <div class="row col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left align-items-lg-center align-items-md-top mx-auto p-0">
                                                                            <div class=" col-xxxl-2 col-xxl-2 col-xl-2 col-lg-2  col-md-3 col-sm-3 col-xs-3 pl-0">
                                                                                <img class="product-img pl-0" src="<?php echo get_the_post_thumbnail_url($download['product_id'], 'thumbnail') ?>" alt="Generic placeholder image ">
                                                                            </div>
                                                                            <div class="row col-xxxl-10 col-xxl-10 col-xl-10 col-lg-10 col-md-9 col-sm-9 col-xs-9 p-0 text-left ">
                                                                                <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12  text-left ">
                                                                                    <h5 class="mt-0"><?php echo $download['download_name']; ?></h5>
                                                                                    <h6 class="font-weight-normal m-10"><?php echo $download['product_name']; ?></h6>
                                                                                    <p class="text-grey"><?php echo $download['downloads_remaining']; ?>
                                                                                        Downloads remaining</p>
                                                                                </div>
                                                                                <div class="d-flex col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6  col-md-12 col-sm-12 col-xs-12 justify-content-lg-end justify-content-start pr-lg-0 align-items-center">
                                                                                    <a href="<?php echo $download['download_url'] ?>" class="btn-download ">DOWNLOAD</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php else : ?>
                                                                <p class=" text-left text-grey-big col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12  col-sm-11 col-md-11 col-xs-11 p-0">
                                                                    Previous Months</p>
                                                                <div class="media-body border-bottom padding-bottom">
                                                                    <div class="row col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left align-items-lg-center align-items-md-top mx-auto p-0">
                                                                        <div class=" col-xxxl-2 col-xxl-2 col-xl-2 col-lg-2  col-md-3 col-sm-3 col-xs-3 pl-0">
                                                                            <img class="product-img pl-0" src="<?php echo get_the_post_thumbnail_url($download['product_id'], 'thumbnail') ?>" alt="Generic placeholder image ">
                                                                        </div>
                                                                        <div class="row col-xxxl-10 col-xxl-10 col-xl-10 col-lg-10 col-md-9 col-sm-9 col-xs-9 p-0 text-left ">
                                                                            <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12  text-left ">
                                                                                <h5 class="mt-0"><?php echo $download['download_name']; ?></h5>
                                                                                <h6 class="font-weight-normal m-10"><?php echo $download['product_name']; ?></h6>
                                                                                <p class="text-grey"><?php echo $download['downloads_remaining']; ?>
                                                                                    Downloads remaining</p>
                                                                            </div>
                                                                            <div class="d-flex col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6  col-md-12 col-sm-12 col-xs-12 justify-content-lg-end justify-content-start pr-lg-0 align-items-center">
                                                                                <a href="<?php echo $download['download_url'] ?>" class="btn-download ">DOWNLOAD</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        <?php
                                                            endif;
                                                        endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                                                    </div>
                                                    </div>

                        <div class="filter billing">
                            <?php $list_subscriptions = wcs_get_users_subscriptions(); ?>

                            <div class="col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-11 col-xs-10 col-sm-11 mx-auto pt-5">
                                <div class='row flex-xxl-column-reverse flex-xl-column-reverse flex-lg-column-reverse flex-md-column-reverse flex-sm-column-reverse flex-xs-column-reverse flex-xxxl-row justify-content-between'>
                                    <div class="col-xxxl-5 col-xxl-8 col-xl-8 col-md-12 col-xs-12 col-sm-12 col-lg-8 pl-0">
                                        <p class="p2 ml-0 text-grey">Transaction history</p>

                                        <?php $payment_data = WC_Payment_Tokens::get_customer_tokens(get_current_user_id());

                                        foreach ($payment_data as $payment) : ?>

                                            <?php do_action('wcs_subscription_details_table_before_payment_method', $subscription); ?>
                                            <?php if ($subscription->get_time('next_payment') > 0) :
                                                $data = $payment->get_data(); ?>

                                                <div class="d-flex col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-xs-12 col-sm-12 padding-bottom-top border-bottom padding-top pl-0 pr-0">
                                                    <div class=" col-xxxl-9 col-xxl-9 col-xl-9 col-lg-9 col-md-11 col-xs-12 col-sm-11 pl-0">
                                                        <p class="pl-0 title">MIDI Box</p>
                                                        <p class="text-litle-grey"><?php echo wc_price($subscription->get_total(), array('currency' => $subscription->get_currency())); ?> paid using <?php echo strtoupper($data['card_type']); ?> ending in <?php echo $data['last4']; ?></p>
                                                    </div>
                                                    <div class="col-xxxl-3 col-xxl-3 col-lg-3 col-xl-3 col-md-4 col-xs-4 col-sm-4 pr-0">
                                                        <p class="text-right text-litle-grey date"><?php echo $subscription->get_date_to_display('last_order_date_created'); ?></p>
                                                    </div>
                                                </div>

                                        <?php endif;

                                        endforeach; ?>
                                    </div>
                                    <div class="col-xxxl-5 col-xxl-8 col-xl-8 col-lg-8 col-md-11 col-xs-12 col-sm-11 p-0">
                                        <p class="text-grey">Payment method</p>
                                        <div class="d-flex justify-content-between mastercard">
                                            <div class="row  col-xxxl-10 col-xxl-11 col-xl-11 col-lg-11 col-md-11 col-xs-12 col-sm-11 p-0 align-items-center">
                                                <!-- <img class="img-fluid mastercard-image" src="<?php bloginfo('template_url') ?>/assets/images/mastercard.svg"> -->
                                                <p class="text-white font-weight-bold mastercard-text p-0">
                                                    <span class="mastercard-title"><?php echo strtoupper($data['card_type']); ?></span> **** **** **** <?php echo $data['last4']; ?>
                                                </p>
                                            </div>
                                            <div class="col-xxxl-1 col-xxxl-1 col-xl-1 col-lg-1 font-weight-bold mastercard-green-text text-right align-self-center">
                                                <?php $actions = wcs_get_all_user_actions_for_subscription($subscription, get_current_user_id()); ?>
                                                <?php if (!empty($actions)) : ?>
                                                    <?php foreach ($actions as $key => $action) : ?>
                                                        <?php if ($action['name'] === 'Change payment') : ?>
                                                            <a href="<?php echo esc_url( $action['url'] ); ?>" class="mastercard-green-text pointer <?php echo sanitize_html_class( $key ) ?>">Edit</a>
                                                        <?php endif ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="filter plan">
                            <?php
                                }
                                /**
                                 * Gets subscription details table template
                                 *
                                 * @param WC_Subscription $subscription A subscription object
                                 *
                                 * @since 2.2.19
                                 */
                                do_action('woocommerce_subscription_details_table', $subscription);

                                /**
                                 * Gets subscription totals table template
                                 *
                                 * @param WC_Subscription $subscription A subscription object
                                 *
                                 * @since 2.2.19
                                 */
                                // do_action('woocommerce_subscription_totals_table', $subscription);

                                // do_action('woocommerce_subscription_details_after_subscription_table', $subscription);

                                //wc_get_template( 'order/order-details-customer.php', array( 'order' => $subscription ) );
                            ?>
                        </div>
                    </div>

                    <?php
                    if ($subscription->has_status(array('active', 'pending-cancel'))) {
                        foreach ($subscription->get_items() as $item_id => $item) {
                            $_product = apply_filters('woocommerce_subscriptions_order_item_product', $item->get_product(), $item);
                            $is_switched = wcs_is_product_switchable_type($_product);
                            $attributes = array_filter($_product->get_attributes(), 'wc_attributes_array_filter_visible');
                            $upgrade_downgrade_button = WC_Subscriptions_Switcher::get_switch_url($item_id, $item, $subscription);

                            if ($is_switched) :
                                $variations = get_variations_for_product($item['product_id']);
                                $min_variation = get_post_meta($item['product_id'], '_min_variation_regular_price');
                                $max_variation = get_post_meta($item['product_id'], '_max_variation_regular_price');
                                $min_variation_period = get_post_meta($item['product_id'], '_min_variation_period');
                                $max_variation_period = get_post_meta($item['product_id'], '_max_variation_period');
                    ?>
                                <!--MODAL CHANGE PLAN-->
                                <div class="modal-overlay closed" id="modal-overlay"></div>
                                <div class="modal-change-plan closed" id="modal-change-plan">
                                <div class="modal-change-plan-container">
                                    <div class="modal-guts">
                                        <img class="img-fluid pointer close" src="<?php bloginfo('template_url') ?>/assets/images/close-icon.png" id='close-x-modal-change' style="min-width: 15px !important; position: absolute; right: 18px; top: 17px; width: 11px;">
                                        <div class="col-xxxl-5 col-xxl-12 col-xl-12 col-lg-12 mt-6 mx-auto align-items-center text-center">
                                            <h3 class="p-0">Change Plan</h3>
                                            <p class="title">Whether you're just starting out or want to produce like a pro, there's a
                                                plan for you.
                                            </p>
                                        </div>
                                        <div class="col-xxxl-12 row mx-auto align-items-center justify-content-between text-center p-0">
                                            <?php
                                            foreach ($variations as $key => $variation) :
                                                $title = explode(':', $variation->post_excerpt);
                                                $price = $variation->price;
                                                $thumb = $variation->thumb;

                                                if ($price) :
                                                    if ($price == $min_variation[0]) : ?>
                                                        <div class="card-green green-glow" id="cardGreen">
                                                        <?php elseif ($price == $max_variation[0]) : ?>
                                                            <div class="card-white green-glow" id="cardWhite">
                                                            <?php else : ?>
                                                                <div class="card-blue green-glow" id="cardBlue">
                                                                <?php endif; ?>
                                                                <div class="text-content text-center mt-0 pt-0" style="height: 100%">
                                                                    <div class='col-12  row mx-auto align-items-center text-center justify-content-center justify-content-center'>
                                                                        <div class="col-xs-12 col-lg-6 p-0">
                                                                            <?php echo $thumb; ?>
                                                                        </div>
                                                                        <h4 class="title-card col-xs-12 col-lg-4 p-0"><?php echo $title[1]; ?></h4>
                                                                    </div>
                                                                    <p class="<?php if ($price != $max_variation[0]) echo 'text-white'; ?> pt-0 font-weight-bold p1 subtitle">
                                                                        Here's What <span style="color: #01BFA6;"> You'll Get: </span></p>
                                                                    <div class="<?php if ($price == $min_variation[0]) {
                                                                                    echo 'card-green-opacity text-white';
                                                                                } elseif ($price == $max_variation[0]) {
                                                                                    echo 'card-blue-linear';
                                                                                } else {
                                                                                    echo 'bg-opacity text-white card-blue-opacity';
                                                                                } ?> ">

                                                                        <div class="row col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 m-0 p-0 align-items-top">
                                                                            <div class="col-xxxl-1 col-xxl-1 col-xl-1 col-lg-1 col-md-1 col-sm-1 col-xs-1 pl-0" style="font-size: 20px; margin-right: 10.5px">
                                                                                <img src="<?php bloginfo('template_url') ?>/assets/images/check white.png" style="min-width: 15px !important">
                                                                            </div>
                                                                            <div class="col-xxxl-6 col-xxl-10 col-xl-10  col-lg-10  col-md-10 col-sm-10 col-xs-10 text-left p-0">
                                                                                <p class="text-white midis-month">MIDI BOX</p>
                                                                                <p class="text-white midis-month">
                                                                                <?php if ($price == $min_variation[0]) {
                                                                                    echo "(200 MIDI's/month)";
                                                                                } elseif ($price == $max_variation[0]) {
                                                                                    echo "(1,000 MIDI's/month)";
                                                                                } else {
                                                                                    echo "(500 MIDI's/month)";
                                                                                } ?> 
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <ul class="row  justify-content-between m-0 p-0" style="width: 100%">
                                                                            <div class="col-xxxl-7 col-xxl-12 col-xl-12 col-lg-12 mt-6 pr-0 mr-0 ml-0 pl-0">
                                                                                <li class="text-white  text-left m-0 align-items-center"><i class="fa fa-circle"></i>
                                                                                <?php if ($price == $min_variation[0]) {
                                                                                    echo "48 Chord Progressions";
                                                                                } elseif ($price == $max_variation[0]) {
                                                                                    echo "240 Chord Progressions";
                                                                                } else {
                                                                                    echo "120 Chord Progressions";
                                                                                } ?> 
                                                                                </li>
                                                                            </div>
                                                                            <div class="col-xxxl-5 col-xxl-12 col-xl-12 col-lg-12  mt-6 m-0 p-0">
                                                                                <li class="text-white text-left p-0">
                                                                                    <i class="fa fa-circle"></i>
                                                                                    <?php if ($price == $min_variation[0]) {
                                                                                    echo "48 Melodies";
                                                                                } elseif ($price == $max_variation[0]) {
                                                                                    echo "240 Melodies";
                                                                                } else {
                                                                                    echo "120 Melodies";
                                                                                } ?> 
                                                                                </li>
                                                                            </div>
                                                                            <div class="col-xxxl-7 col-xxl-12 col-xl-12 col-lg-12 mt-6 pr-0 mr-0 ml-0 pl-0">
                                                                                <li class="text-white text-left m-0 p-0 mt-10"><i class="fa fa-circle"></i>
                                                                                    <?php if ($price == $min_variation[0]) {
                                                                                    echo "48  Basslines";
                                                                                } elseif ($price == $max_variation[0]) {
                                                                                    echo "240  Basslines";
                                                                                } else {
                                                                                    echo "120  Basslines";
                                                                                } ?> 
                                                                                    
                                                                                </li>
                                                                            </div>
                                                                            <div class="col-xxxl-5 col-xxl-12 col-xl-12 col-lg-12  mt-6 pr-0 mr-0 ml-0 pl-0">
                                                                                <li class="text-white  text-left m-0 p-0 mt-10"><i class="fa fa-circle"></i>
                                                                                    <?php if ($price == $min_variation[0]) {
                                                                                    echo "48 Drum Patterns";
                                                                                } elseif ($price == $max_variation[0]) {
                                                                                    echo "280 Drum Patterns";
                                                                                } else {
                                                                                    echo "140 Drum Patterns";
                                                                                } ?> 
                                                                                </li>
                                                                            </div>
                                                                        </ul>
                                                                    </div>

                                                                </div>
<!--                                                                --><?php //$sale_price = get_post_meta($variation->ID, '_sale_price'); ?>
                                                                <div class="radio-item">
                                                                    <input class="product_variation" type="radio" id="rritem<?php echo ($key + 1); ?>" name="ritem" data-product-id="<?php echo $variation->ID; ?>" data-price="<?php echo $price ?>" value="<?php echo $title[1]; ?>">
                                                                    <label class="mb-0 pointer" for="rritem<?php echo ($key + 1); ?>"></label>
                                                                </div>

                                                                </div>
                                                        <?php
                                                    endif;
                                                endforeach; ?>
                                                            </div>
                                                            <div class=" col-xxxl-4 col-xxl-7 col-xl-7 col-lg-6 col-md-12 col-xs-11 col-sm-12 mx-auto align-items-bottom text-center justify-content-between" style="margin-top: 15px !important;">
                                                                <div class="row  align-items-center mt-4">
                                                                    <p class="text-white  text-left previous-price mx-auto p-0">
                                                                        From:
                                                                        <?php echo wc_price($_product->get_price()); ?>/month
                                                                        ><span class="new_sale_price"></span>/month
                                                                    </p>
                                                                    <p class="text-white text-left pr-0 white-text mx-auto p-0">
                                                                        DUE TODAY: <span class="p1 font-weight-bold green-text new_sale_price"></span>
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <div class="col-xxxl-6 col-xxl-6 text-center mx-auto  mt-xl-0 pr-0 pl-0">
                                                                <?php do_action('woocommerce_before_add_to_cart_form'); ?>

                                                                <form class="update-plan" method="post" enctype='multipart/form-data'>
                                                                    <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($item['product_id']); ?>" />
                                                                    <input type="hidden" id="variation" name="variation_id" value="" />
                                                                    <button type="submit" class="mx-auto btn-update font-weight-bold">UPDATE PLAN</button>
                                                                </form>

                                                            </div>
                                                            <div class="col-xxxl-5 col-xxl-12 col-xl-12 col-lg-12 mt-6  text-white text-center mx-auto  mt-3 mt-xl-0 p-0">
                                                                <p class='mx-auto text-small'>
                                                                    You'll get instant access to your new plan's <?php echo date('F'); ?> MIDI Box and your
                                                                    recurring billing
                                                                    date will be changed to the <?php echo date('jS'); ?> of each month.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php
                                    $type = $item->get_meta('type');

                                    if ($type != 'Pro') {
                                        if ($type == "Plus") :
                                            $variations = get_variations_for_product($item['product_id']);
                                            foreach ($variations as $variation) {
                                                $variation_type = wc_get_product_variation_attributes($variation->ID);

                                                $upgrade_variation = 'Pro';
                                                if ($variation_type['attribute_type'] == 'Pro') {
                                                    $upgrade_id = $variation->ID;
                                                    $upgrade_price = $variation->price;
                                                    $upgrade_thumb = $variation->thumb;
                                                }
                                            }
                                        endif;

                                        if ($type == "Light") :
                                            $variations = get_variations_for_product($item['product_id']);
                                            foreach ($variations as $variation) {
                                                $variation_type = wc_get_product_variation_attributes($variation->ID);

                                                $upgrade_variation = 'Plus';
                                                if ($variation_type['attribute_type'] == 'Plus') {
                                                    $upgrade_id = $variation->ID;
                                                    $upgrade_price = $variation->price;
                                                    $upgrade_thumb = $variation->thumb;
                                                }
                                            }
                                        endif;
                                    ?>
                                        <div class="modal-upgrade closed pb-0 mb-0" id="modal-upgrade">
                                            <div class="modal-guts">
                                                <img class="img-fluid pointer close" src="<?php bloginfo('template_url') ?>/assets/images/Vector x.png" id='close-button-upgrade' style="min-width: 15px !important; width: 15px !important">
                                                <div class="row col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-xs-12 col-sm-12 mx-auto p-0 mb-0 align-items-center justify-content-between">
                                                    <div class="col-xxxl-5  col-xxl-5 col-xl-5 col-lg-5  pl-0 pr-0 text-md-center img-tier">
                                                        <?php echo $upgrade_thumb; ?>
                                                    </div>
                                                    <div class="col-xxxl-7  col-xxl-7 col-xl-7 col-lg-7  col-md-12 col-xs-12 col-sm-12 mb-0 padding-left pr-0">
                                                        <h4 class="text-left pl-0 title-small">Upgrade to <br><span style="color: #01BFA6;"> <?php echo $upgrade_variation; ?> Plan & Save </span></h5>
                                                            <h4 class=" text-left pl-0 title-big">Upgrade to <span style="color: #01BFA6;"> <?php echo $upgrade_variation; ?> Plan & Save </span></h5>

                                                                <p class="text-white text-left  font-weight-bold pl-0 white-green-text">Here's What
                                                                    <span style="color: #01BFA6;">You'll Get:</span>
                                                                </p>
                                                                <ul class=" col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12  p-0">
                                                                    <div class="row">
                                                                        <div class="col-xxxl-7 col-xxl-7 col-xl-7 col-lg-7 col-md-12 col-xs-12 col-sm-12 pl-0">

                                                                            <li class="text-white text-left align-items-center"><img class="img-fluid" src="<?php bloginfo('template_url') ?>/assets/images/correct green.png" style="margin-right: 5px; min-width: 15px !important; width: 15px !important"> 200 Chord Progressions
                                                                            </li>
                                                                        </div>


                                                                        <div class="col-xxxl-5  col-xxl-5 col-xl-5 col-lg-5 col-md-12 col-xs-12 col-sm-12 pl-0 mtt-10">
                                                                            <li class="text-white text-left align-items-center"><img class="img-fluid" src="<?php bloginfo('template_url') ?>/assets/images/correct green.png" style="margin-right: 5px; min-width: 15px !important; width: 15px !important"> 200 Basslines
                                                                            </li>
                                                                        </div>
                                                                        <div class="col-xxxl-7 col-xxl-7 col-xl-7 col-lg-7  col-md-12 col-xs-12 col-sm-12 mt-10 pl-0">
                                                                            <li class="text-white text-left align-items-center"><img class="img-fluid" src="<?php bloginfo('template_url') ?>/assets/images/correct green.png" style="margin-right: 5px; min-width: 15px !important; width: 15px !important"> 200 Melodies
                                                                            </li>
                                                                        </div>
                                                                        <div class="col-xxxl-5  col-xxl-5 col-xl-5 col-lg-5 col-md-12 col-xs-12 col-sm-12 mt-10 pl-0 pr-0">
                                                                            <li class="text-white text-left align-items-center"><img class="img-fluid" src="<?php bloginfo('template_url') ?>/assets/images/correct green.png" style="margin-right: 5px; min-width: 15px !important; width: 15px !important"> 280 Drum Patterns
                                                                            </li>
                                                                        </div>
                                                                    </div>
                                                                </ul>
                                                                <div class="col-xxxl-12 col-xxl-12  col-xl-12 col-lg-12  col-md-12 col-xs-12 col-sm-12 p-0 m-0 row justify-content-lg-between justify-content-md-center align-items-center font-weight-bold text-center">
                                                                    <p class="text-white text-left text-white-small">
                                                                        From:
                                                                        <?php echo wc_price($_product->get_price()); ?>/month
                                                                        ><span class="new_sale_price"></span>/month                                                                    </p>
                                                                    <p class="text-white  text-left pr-0">
                                                                        DUE TODAY: <span class="green"><?php echo isset($upgrade_price) ? wc_price($upgrade_price) : ''; ?></span>
                                                                    </p>
                                                                </div>

                                                                <div class="text-left col-xxxl-12  col-xxl-12  col-md-12 col-xs-12 col-sm-12 p-0" id="close-button-upgrade">
                                                                    <?php do_action('woocommerce_before_add_to_cart_form'); ?>

                                                                    <form class="update-plan" method="post" enctype='multipart/form-data'>
                                                                        <input type="hidden" name="add-to-cart" value="<?php echo $item['product_id']; ?>" />
                                                                        <input type="hidden" id="variation" name="variation_id" value="<?php echo isset($upgrade_id) ? esc_attr($upgrade_id) : ''; ?>" />
                                                                        <button type="submit" class="badge badge-pill badge-success btn-shadow btn-upgrade">Upgrade
                                                                            to <?php echo $upgrade_variation; ?> plan</button>
                                                                    </form>
                                                                </div>
                                                                <p class="pointer text-center pb-0 mb-0 grey-small">Your billing date will be
                                                                    changed to this date every month.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            <?php
                                    }
                                }
                            } ?>

                            <script type="text/javascript">
                                function openModalChangePlan() {
                                    console.log('open modal')
                                    $('.modal-change-plan').removeClass('closed');
                                    $('.modal-overlay').removeClass('closed');
                                    $('html,body').animate({scrollTop:0},2000);
                                }

                                $(document).ready(() => {
                                    $('#close-x-modal-change').on('click', () => {
                                        $('.modal-change-plan').addClass('closed');
                                        $('.modal-overlay').addClass('closed');
                                    });
                                    $('#close-modal-change-payment-method').on('click', () => {
                                        $('#modal-change-payment-method').addClass('closed');
                                        $('.modal-overlay').addClass('closed');
                                    });
                                    $('#rritem1').prop('checked', true);
                                    $('.new_sale_price').text('$' + $('#rritem1').attr('data-price'));
                                    $('.card-green').addClass('glow-card');
                                    $('#cardGreen').click(() => {
                                        $('#rritem1').prop('checked', true);
                                        $('#variation').val('');
                                        $('#variation').val($('#rritem1').attr('data-product-id'));
                                        $('.new_sale_price').text('');
                                        $('.new_sale_price').text('$' + $('#rritem1').attr('data-price'));
                                        $('.card-green').addClass('glow-card');
                                        $('.card-blue').removeClass('glow-card');
                                        $('.card-white').removeClass('glow-card');
                                    });
                                    $('#cardBlue').click(() => {
                                        $('#rritem2').prop('checked', true);
                                        $('#variation').val('');
                                        $('#variation').val($('#rritem2').attr('data-product-id'));
                                        $('.new_sale_price').text('');
                                        $('.new_sale_price').text('$' + $('#rritem2').attr('data-price'));
                                        $('.card-blue').addClass('glow-card');
                                        $('.card-green').removeClass('glow-card');
                                        $('.card-white').removeClass('glow-card');

                                    });
                                    $('#cardWhite').click(() => {
                                        $('#rritem3').prop('checked', true);
                                        $('#variation').val('');
                                        $('#variation').val($('#rritem3').attr('data-product-id'));
                                        $('.new_sale_price').text('');
                                        $('.new_sale_price').text('$' + $('#rritem3').attr('data-price'));
                                        $('.card-white').addClass('glow-card');
                                        $('.card-green').removeClass('glow-card');
                                        $('.card-blue').removeClass('glow-card');

                                    });

                                });
                            </script>

                            <script>
                                $(window).on('load', () => {
                                    $('#download').trigger('click');
                                    $('#loading').removeClass('d-block');
                                    $('#loading').addClass('d-none');
                                    $('#sub-info').removeClass('d-none');
                                });
                            </script>

                            <script>
                                function openModal() {
                                    $('#modal-upgrade').removeClass('closed');
                                    $('#modal-overlay').removeClass('closed');
                                }

                                var modalOverlay = $("#modal-overlay");
                                var modalUpgrade = $("#modal-upgrade");
                                var closeButtonUpgrade = $("#close-button-upgrade");
                                var openButtonUpgrade = $("#open-button-upgrade");


                                closeButtonUpgrade.click(() => {
                                    modalUpgrade.addClass("closed");
                                    modalOverlay.addClass("closed");
                                });
                            </script>
                            <!-- <script> 
                            jQuery.fn.center = function () {
                            this.css("position", "absolute");
                            this.css("top", (($(window).height() - this.outerHeight()) / 2) + $(window).scrollTop() + "px");
                            this.css("left", (($(window).width() - this.outerWidth()) / 2) + $(window).scrollLeft() + "px");
                            return this;
}
                            $('.modal-change-plan').center()
                            </script> -->