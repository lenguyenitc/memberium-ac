<?php
/**
 * Order Downloads.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-downloads.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if (!defined('ABSPATH')) {
    exit;
}

$post_ids = [];
global $wp;
$current_slug = $wp->request;

if (strpos($current_slug, 'my-account/subscription-downloads') === 0) { ?>
<div>
    <div class="mx-auto">
        <div class="tab-content text-white p-0 ">
            <div class="tab-pane active show fade" id="midi-box" role="tabpanel" aria-labelledby="midi-box-tab">
            <?php if ($item) :?>
                       <div
                        class="row account-midi-box col-xxxl-12 col-xxl-12  col-xl-12 col-lg-12 col-sm-12 col-md-12 col-xs-12 mx-auto align-items-center flex-md-column flex-lg-row ">
                    <div
                            class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6  col-sm-12 col-md-12 col-xs-12 pr-lg-5 pl-0 text-lg-right text-md-center text-sm-center text-xs-center d-flex justify-content-center justify-content-lg-end banner-img">
<!--                        <img class="img-fluid mb-lg-0 pr-0 pl-0 img-tier position-relative"-->
<!--                             src="--><?php //echo get_the_post_thumbnail_url($item['product_id'])?><!--">-->
                    </div>
                    <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6  col-sm-8 col-md-8 col-xs-12 mx-auto p-0 pl-lg-5">
                        <img class="img-midi"
                             src="<?php bloginfo('template_url') ?>/assets/images/MIDI Box Logo-small.png">
                        <h4><?php echo $item->get_name(); ?></h4>
                        <p class="text-white  text-date">Renewal
                            date: <?php echo date('M d, Y', $subscription->get_time('next_payment')); ?></p>
                        <div class="text-center text-lg-left">
                            <button onclick="openModal()" class="btn-violet pointer text-white"><?php echo get_option(WC_Subscriptions_Admin::$option_prefix . '_switch_button_text'); ?></button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
           <!-- SECOND NAV MENU -->
                <div class="col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12  col-sm-12 col-md-12 col-xs-12  p-0 text"
                     style="border-bottom: 1px solid #393939">
                    <nav
                            class="col-xxxl-4 col-xxl-6 col-xl-6 col-lg-6   col-sm-11 col-md-11 col-xs-11 mx-auto nav w-100 justify-content-around  text-uppercase font-weight-bold">
                        <a class="nav-link active filter-button ml-0 pl-0 pr-0 pt-0 grey-link" id="account-details-tab"
                           href="/my-account/subscription-downloads" aria-controls="midi-downloads"
                           aria-selected="false">Downloads</a>
                        <a class="nav-link filter-button pl-0 pr-0 grey-link pt-0" id="orders-tab"
                           href="/my-account/subscriptions" aria-controls="midi-billing"
                           aria-selected="true">Billing</a>
                        <a class="nav-link <?php echo (site_url() . $_SERVER['REQUEST_URI'] == $subscription->get_view_order_url()) ? 'active' : '';?> filter-button pl-0 pr-0 grey-link pt-0" id="downloads-tab"
                           href="<?php echo $subscription->get_view_order_url(); ?>" aria-selected="false">Plan</a>
                    </nav>
                </div>
<?php }
if (strpos($current_slug, 'my-account/view-order') === 0) : ?>
<div class="mt-0">
    <?php else : ?>
    <section class="woocommerce-order-downloads p-3 p-lg-0 mb-0 pt-0">
        <?php endif; ?>
    <p class="text-left grey-text">Available Downloads</p>

    <?php foreach (array_reverse($downloads) as $download) : 
        $post_ids[] = $download['product_id'];
        $product = wc_get_product($download['product_id']);?>
        <div class="media align-items-center flex-column flex-sm-row mb-46 pr-0">
            <div class="media-body">
                <div class="row col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left align-items-lg-center align-items-md-top mx-auto p-0">
                    <div class=" col-xxxl-2 col-xxl-2 col-xl-2 col-lg-2  col-md-3 col-sm-3 col-xs-3 pl-0">
                        <img class="mr-0"
                             src="<?php echo get_the_post_thumbnail_url($download['product_id'], 'thumbnail') ?>"
                             alt="Generic placeholder image">
                    </div>
                    <div class="row col-xxxl-10 col-xxl-10 col-xl-10 col-lg-10 col-md-9 col-sm-9 col-xs-9 p-0 text-left ">
                        <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12  text-left ">
                            <h5 class="mt-0 p2"><?php echo $download['product_name']; ?></h5>
                            <h6><?php echo $download['download_name']; ?></h6>
                            <p style="font-size:14px" class="product-activation-code">
                                <?php 
                                
                                if (function_exists('get_activation_code')) {
                                    get_activation_code($download['order_id'], $download['product_id']);
                                }
                                ?>
                            </p>
                            <p class="seven-rem"><?php echo $download['downloads_remaining'] === "" ? "∞" : $download['downloads_remaining']; ?> Downloads
                                remaining</p>
                            <!-- <p class="price">$<?php echo $product->get_price(); ?></p> -->

                        </div>
                        <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6  col-md-12 col-sm-12 col-xs-12 text-lg-right text-md-left pr-0">
                            <a href="<?php echo $download['download_url'] ?>" class="btn-download">DOWNLOAD</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>   

    <?php
    global $post;

    $related = array();

    /*$related = get_posts(
        array(
            'numberposts' => 2,
            'post__not_in' => $post_ids,
            'post_type' => 'product',
            'tax_query' => array(array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id', // can be 'term_id', 'slug' or 'name'
                'terms' => wp_get_post_terms(1828, 'product_cat', array('fields' => 'ids')),
            ),),
        )
    );*/
    if ($related) { ?>
        <p class="grey-text">Recommended For You</p>
        <?php
        foreach ($related as $post) {
            setup_postdata($post);
            $thumbnail = get_the_post_thumbnail_url($post->ID, 'thumbnail');
            $product = wc_get_product($post->ID);
            $permalink = get_the_permalink($post->ID);
            $title = get_the_title();
            $price = $product->get_price();
            ?>

            <div class="media align-items-center flex-column flex-sm-row mb-40">
                <div class="media-body">
                    <div class="row col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left align-items-lg-center align-items-md-top mx-auto p-0">
                        <div class=" col-xxxl-2 col-xxl-2 col-xl-2 col-lg-2  col-md-3 col-sm-3 col-xs-3 pl-0">
                            <img class="mr-0" src="<?php echo $thumbnail; ?>" alt="Generic placeholder image">
                        </div>
                        <div class="row col-xxxl-10 col-xxl-10 col-xl-10 col-lg-10 col-md-9 col-sm-9 col-xs-9 p-0 text-left ">
                            <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12  text-left ">
                                <h5 class="mt-0"><?php echo $title; ?></h5>
                                <p class="seven-rem"></p>
                                <span class="price">$<?php echo $price; ?><span>
                            </div>
                            <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6  col-md-12 col-sm-12 col-xs-12 text-lg-right text-md-left pr-0">
                                <a href="<?php echo $permalink; ?>" class="btn-empty-green">VIEW DETAILS</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        wp_reset_postdata();
    }
    ?>