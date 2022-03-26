<?php
/**
 * My Account > Subscriptions page
 *
 * @author   Prospress
 * @category WooCommerce Subscriptions/Templates
 * @version  2.0.15
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$subscriptions = wcs_get_users_subscriptions();

if (empty($subscriptions)) { ?>
    <main class="flex-grow-1 never-had-account pt-0 pb-0">

        <div class="col-xxxl-12  col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-xs-12 col-sm-12 align-items-center p-0 pl-lg-3 pr-lg-3">
            <div class="mx-auto content">
                <div class="tab-content text-white">
                    <div class="tab-pane active show fade p-0" id="midi-box" role="tabpanel"
                         aria-labelledby="midi-box-tab">
                        <div class="col-xxxl-12  col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-xs-12 col-sm-12  gradient-transform">
                            <div class="row align-items-center">
                                <div class="col-xxxl-6 col-xxl-5 col-lg-4">
                                    <img class="tier-img col-xxxl-8 offset-xxxl-2 col-xxl-10 offset-xxl-2 col-xl-10 offset-xl-2 col-lg-10 offset-lg-2 col-md-12 col-xs-12 col-sm-12 p-0 pl-lg-3 pr-lg-3"
                                         src="<?php bloginfo('template_url') ?>/assets/images/never had an account.svg">
                                </div>
                                <div class="col-xxxl-5 col-xxl-7 col-xl-7 col-lg-8 col-md-11 col-xs-12 col-sm-11 pl-lg-5 pl-xxl-3 d-flex flex-column  justify-content-center justify-content-lg-left">
                                    <h4>The Ultimate Shortcut To Producing Hit Songs Every Single Month</h4>
                                    <p>When you join MIDI Box, every month you’ll receive an exlusive collection of
                                        never-before-released Chord Progressios, Basslines, Melodies & Drum Kits,
                                        all in
                                        Midi Format.</p>
                                    <a href="/midi-box" class="badge badge-pill badge-success justify-content-center">Learn
                                        more
                                        <img style="margin-left: 12px; width: 18px; min-width: 18px !important;"
                                             src="<?php bloginfo('template_url') ?>/assets/images/arrow-right.png">
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </main>
<?php }
foreach ($subscriptions as $key => $subscription) {
if ($current_page < 1) : ?>
    <main class="flex-grow-1 -account">

        <div class="col-xxxl-12  col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-xs-12 col-sm-12 align-items-center">
            <div class="mx-auto content">
                <div class="tab-content text-white">
                    <div class="tab-pane active show fade p-0" id="midi-box" role="tabpanel"
                         aria-labelledby="midi-box-tab">
                        <div class="col-xxxl-12  col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-xs-12 col-sm-12 align-items-center gradient-transform">
                            <div class="row">
                                <div class="col-xxxl-6 col-xxl-5">
                                    <img class="tier-img col-xxxl-8 offset-xxxl-2 col-xxl-10 offset-xxl-2 col-xl-10 offset-xl-2 col-lg-10 offset-lg-2 col-md-12 col-xs-12 col-sm-12"
                                         src="<?php bloginfo('template_url') ?>/assets/images/never had an account.svg">
                                </div>
                                <div class="col-xxxl-5 col-xxl-7 col-xl-7 col-lg-7 col-md-11 col-xs-12 col-sm-11">
                                    <h4>The Ultimate Shortcut To Producing Hit Songs Every Single Month</h4>
                                    <p>When you join MIDI Box, every month you’ll receive an exlusive collection of
                                        never-before-released Chord Progressios, Basslines, Melodies & Drum Kits,
                                        all in
                                        Midi Format.</p>
                                    <a href="#" class="badge badge-pill badge-success justify-content-center">Learn
                                        more
                                        <img style="margin-left: 12px;"
                                             src="<?php bloginfo('template_url') ?>/assets/images/arrow-right.png">
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </main>
<?php else :
foreach ($subscription->get_items() as $item_id => $item) :
$_product = apply_filters('woocommerce_subscriptions_order_item_product', $item->get_product(), $item);
$upgrade_downgrade_button = WC_Subscriptions_Switcher::get_switch_url($item_id, $item, $subscription);

$type = $item->get_meta('type');
?>
<div>
    <div class="mx-auto pl-3 pr-3 p">
        <div class="tab-content text-white p-0 ">
            <div class="tab-pane active show fade" id="midi-box" role="tabpanel" aria-labelledby="midi-box-tab">
                <div
                        class="row account-midi-box col-xxxl-12 col-xxl-12  col-xl-12 col-lg-12 col-sm-12 col-md-12 col-xs-12 mx-auto align-items-center flex-md-column flex-lg-row ">
                    <div
                            class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6  col-sm-12 col-md-12 col-xs-12 pr-0 pl-0 text-lg-right text-md-center text-sm-center text-xs-center d-flex justify-content-center justify-content-lg-end banner-img">
                        <img class="img-fluid mb-lg-0 pr-0 pl-0 img-tier position-relative"
                             src="<?php echo get_the_post_thumbnail_url($item['product_id']) ?>">
                    </div>
                    <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6  col-sm-8 col-md-8 col-xs-12 mx-auto p-0 pl-lg-5">
                        <img class="img-midi"
                             src="<?php bloginfo('template_url') ?>/assets/images/MIDI Box Logo-small.png">
                        <h4><?php echo $item->get_name(); ?></h4>
                        <p class="text-white  text-date">Renewal
                            date: <?php echo date('M d, Y', $subscription->get_time('next_payment')); ?></p>
                        <div class="text-center text-lg-left">
                            <a onclick="openModal()"
                               class="btn-violet pointer text-white"><?php echo get_option(WC_Subscriptions_Admin::$option_prefix . '_switch_button_text'); ?></a>
                        </div>
                    </div>
                </div>
                <!-- SECOND NAV MENU -->
                <div class="col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12  col-sm-12 col-md-12 col-xs-12  p-0 text"
                     style="border-bottom: 1px solid #393939">
                    <nav
                            class="col-xxxl-4 col-xxl-6 col-xl-6 col-lg-6   col-sm-12 col-md-12 col-xs-12 mx-auto nav w-100 justify-content-around  text-uppercase font-weight-bold">
                        <a class="nav-link filter-button ml-0 pl-0 pr-0 pt-0 grey-link" id="account-details-tab"
                           href="/my-account/subscription-downloads" aria-controls="midi-downloads"
                           aria-selected="false">Downloads</a>
                        <a class="nav-link active filter-button pl-0 pr-0 grey-link pt-0" id="orders-tab"
                           data-toggle="tab" href="#midi-billing" role="tab" aria-controls="midi-billing"
                           aria-selected="true">Billing</a>
                        <a class="nav-link filter-button pl-0 pr-0 grey-link pt-0" id="downloads-tab"
                           href="<?php echo $subscription->get_view_order_url(); ?>" aria-selected="false">Plan</a>
                    </nav>
                </div>
                <div class="tab-content text-white p-0">
                    <div class="tab-pane active fade show pl-0 pt-4 billing" id="midi-billing" role="tabpanel"
                         aria-labelledby="midi-billing">
                        <div
                                class="col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-11 col-xs-10 col-sm-11 pr-0 pl-0 mx-auto">
                            <div
                                    class='row flex-xxl-column-reverse flex-xl-column-reverse flex-lg-column-reverse flex-md-column-reverse flex-sm-column-reverse flex-xs-column-reverse flex-xxxl-row'>
                                <div
                                        class="col-xxxl-5 col-xxl-8 col-xl-8 col-md-12 col-xs-12 col-sm-12 col-lg-8 mx-auto pl-0">
                                    <p class="p2  ml-0 text-grey">Transaction history</p>
                                    <!--                        <div class="d-flex col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-xs-12 col-sm-12 padding-bottom-top border-bottom padding-top pl-0 pr-0">-->
                                    <!--                            <div class=" col-xxxl-9 col-xxl-9 col-xl-9 col-lg-9 col-md-11 col-xs-12 col-sm-11 pl-0">-->
                                    <!--                                <p class="pl-0 title">Sounds - Sounds Subscription-->
                                    <!--                                </p>-->
                                    <!--                                <p class="text-litle-grey">$7.99 paid using Mastercard ending in 5807</p>-->
                                    <!--                            </div>-->
                                    <!--                            <div class="col-xxxl-3 col-xxl-3 col-lg-3 col-xl-3 col-md-4 col-xs-4 col-sm-4 pr-0">-->
                                    <!--                                <p class="text-right text-litle-grey date">March 6th 2021-->
                                    <!--                                </p>-->
                                    <!--                            </div>-->
                                    <!--                        </div>-->

                                    <?php WC_Subscriptions::get_my_subscriptions_template($current_page); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <?php if ($type == "Plus") :
                        $variations = get_variations_for_product($item['product_id']);
                        foreach ($variations as $variation) {
                            $variation_type = wc_get_product_variation_attributes($variation->ID);

                                $upgrade_variation = 'Pro';
                                if ($variation_type['attribute_type'] == 'Pro') {
                                    $upgrade_id = $variation->ID;
                                    $upgrade_price = $variation->price;
                                }

                        }
                        ?>
                    <div class="modal-overlay closed" id="modal-overlay"></div>
                    <div class="modal-upgrade closed pb-0 mb-0" id="modal-upgrade">
                        <div class="modal-guts">
                            <img class="img-fluid pointer close"
                                 src="<?php bloginfo('template_url') ?>/assets/images/Vector x.png" id='close-x'>
                            <div class="row col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-xs-12 col-sm-12 mx-auto p-0 mb-0 align-items-center justify-content-between">
                                <div class="col-xxxl-5  col-xxl-5 col-xl-5 col-lg-5  pl-0 pr-0 text-md-center">
                                    <img class="img-fluid align-middle img-tier"
                                         src="<?php bloginfo('template_url') ?>/assets/images/tier upgrade.svg">
                                </div>
                                <div class="col-xxxl-7  col-xxl-7 col-xl-7 col-lg-7  col-md-12 col-xs-12 col-sm-12 mb-0 padding-left">
                                    <h5 class="text-left pl-0 title-small">Upgrade to <br><span
                                                style="color: #01BFA6;"> Pro Plan & Save </span></h5>
                                    <h5 class=" text-left pl-0 title-big">Upgrade to <span style="color: #01BFA6;"> Pro Plan & Save </span></h5>

                                    <p class="text-white text-left  font-weight-bold pl-0 white-green-text">Here's What
                                        <span style="color: #01BFA6;">You'll Get:</span></p>
                                    <ul class=" col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12  p-0">
                                        <div class="row">
                                            <div class="col-xxxl-7 col-xxl-7 col-xl-7 col-lg-7 col-md-12 col-xs-12 col-sm-12 pl-0">

                                                <li class="text-white text-left align-items-center"><img
                                                            class="img-fluid"
                                                            src="<?php bloginfo('template_url') ?>/assets/images/correct green.png"
                                                            style="margin-right: 5px;"> 200 Chord Progressions
                                                </li>
                                            </div>


                                            <div class="col-xxxl-5  col-xxl-5 col-xl-5 col-lg-5 col-md-12 col-xs-12 col-sm-12 pl-0">
                                                <li class="text-white text-left align-items-center"><img
                                                            class="img-fluid"
                                                            src="<?php bloginfo('template_url') ?>/assets/images/correct green.png"
                                                            style="margin-right: 5px;"> 200 Basslines
                                                </li>
                                            </div>
                                            <div class="col-xxxl-7 col-xxl-7 col-xl-7 col-lg-7  col-md-12 col-xs-12 col-sm-12 mt-10 pl-0">
                                                <li class="text-white text-left align-items-center"><img
                                                            class="img-fluid"
                                                            src="<?php bloginfo('template_url') ?>/assets/images/correct green.png"
                                                            style="margin-right: 5px;"> 200 Melodies
                                                </li>
                                            </div>
                                            <div class="col-xxxl-5  col-xxl-5 col-xl-5 col-lg-5 col-md-12 col-xs-12 col-sm-12 mt-10 pl-0">
                                                <li class="text-white text-left align-items-center"><img
                                                            class="img-fluid"
                                                            src="<?php bloginfo('template_url') ?>/assets/images/correct green.png"
                                                            style="margin-right: 5px;"> 280 Drum Patterns
                                                </li>
                                            </div>
                                        </div>
                                    </ul>
                                    <div class="col-xxxl-12 col-xxl-12  col-xl-12 col-lg-12  col-md-12 col-xs-12 col-sm-12 p-0 m-0 row justify-content-lg-between justify-content-md-center align-items-end font-weight-bold text-center">
                                        <p class="text-white text-left text-white-small">
                                            From: $17/month>$27month
                                        </p>
                                        <p class="text-white  text-left pr-0">
                                            DUE TODAY: <span class="green"><?php echo isset($upgrade_price) ? wc_price($upgrade_price) : ''; ?></span>
                                        </p>
                                    </div>

                                    <div class="text-left col-xxxl-12  col-xxl-12  col-md-12 col-xs-12 col-sm-12 p-0"
                                         id="close-button-upgrade">
                                        <?php do_action('woocommerce_before_add_to_cart_form'); ?>

                                        <form class="update-plan" method="post" enctype='multipart/form-data'>
                                            <input type="hidden" name="add-to-cart" value="<?php echo $item['product_id']; ?>"/>
                                            <input type="hidden" id="variation" name="variation_id" value="<?php echo isset($upgrade_id) ? esc_attr($upgrade_id) : ''; ?>"/>
                                            <button type="submit" class="badge badge-pill badge-success btn-shadow btn-update">Upgrade
                                                to pro plan</button>
                                        </form>
                                    </div>
                                    <p class="pointer text-center pb-0 mb-0 grey-small">Your billing date will be
                                        changed to this date <br> every month.</p>
                                </div>
                            </div>
                            <!-- <p id="open-button-password1" class="text-center font-weight-bold mt-3 pointer" style="font-size: 14px; color: grey;"> Forgot your password?</p> -->
                        </div>
                    </div>
                    <?php
                    endif;
                    endforeach;
                    endif;
                    } ?> 

                    <!-- <script>
                        function openModal() {
                            $('.modal-upgrade').removeClass('closed');
                            $('.modal-overlay').removeClass('closed');
                        }

                        var modalOverlay = document.querySelector("#modal-overlay");
                        var modalUpgrade = document.querySelector("#modal-upgrade");
                        var closeButtonUpgrade = document.querySelector("#close-button-upgrade");
                        var openButtonUpgrade = document.querySelector("#open-button-upgrade");


                        closeButtonUpgrade.addEventListener("click", function () {
                            modalUpgrade.classList.toggle("closed");
                            modalOverlay.classList.toggle("closed");
                        });

                        // openButtonUpgrade.addEventListener("click", function () {
                        //     modalUpgrade.classList.toggle("closed");
                        //     modalOverlay.classList.toggle("closed");
                        // });
                    </script> -->
                    <script>
                        $('.btn-violet').on('click', function () {
                            window.history.replaceState(null, null, "<?php echo $upgrade_downgrade_button; ?>");
                        });

                    </script>