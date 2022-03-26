<?php

/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit;
$customer_id = get_current_user_id();
global $post;
$attachment_id = get_user_meta( $customer_id, 'image', true );

//$avatar = wp_get_attachment_image_url( $attachment_id, 'full');

?>

<div class="jumbotron text-white  account-jumbotron-padding bg-light-blue-gradient">
    <div class="container">
        <div class="row col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-xs-11 col-sm-11 mx-auto  col-sm-12 align-items-center pl-0 pr-0 flex-xxxl-row flex-xxl-row flex-xl-row flex-lg-row  flex-md-column-reverse flex-sm-column-reverse flex-xs-column-reverse">
            <div class="col-xxxl-5 col-xxl-5 col-xl-5 col-lg-5 col-xs-12 col-sm-6 col-md-6 p-0">
                <h1>My Account</h1>
                <p class="font-weight-normal">This is your home for managing your account details, accessing your
                    downloads and accessing specific deals curated just for you.</p>
            </div>
            <div class="col-xxxl-2 offset-xxxl-5 col-xxl-3 col-lg-2 offset-lg-5 offset-xxl-4 col-xl-2 offset-xl-5 col-sm-12  pr-0 col-xs-12 col-sm-12">
                <?php if ($attachment_id) : ?>
                    <img class="avatar-img" src="<?php echo $attachment_id; ?>">
                <!-- <div class="avatar-img" style="background: url('<?php //echo $avatar; ?>');"> </div> -->
                <?php else :?>
                    <img class="img-fluid" src="<?php bloginfo('template_url') ?>/assets/images/Group 17.png"
                         alt="User Avatar">
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<main class="flex-grow-1">

    <?php
    /**
     * My Account navigation.
     *
     * @since 2.6.0
     */
    do_action('woocommerce_account_navigation'); ?>
    <?php
        global $wp;
        $current_slug = $wp->request;
    ?>

    <?php if ($current_slug == 'my-account') { ?>
    <div>
        <div class="col">
            <div class="tab-content text-white p-0 mx-auto">
                <div class="tab-pane fade show active col-xxxl-10 col-xxl-10 col-xs-12 col-lg-12  mt-4"
                     id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                    <div class="row mb-0 pb-0">
                        <div class="overview-user col-12">
                            <?php } elseif ($current_slug == 'my-account/orders' || strpos($current_slug, 'my-account/view-order') == 0) { ?>
                            <div class="row pt-0">
                                <div class="col">
                                    <div class="tab-content text-white p-0 <?php if (strpos($current_slug, 'my-account/view-order') == 0) echo 'content'; ?>">
                                        <div class="tab-pane fade show active"
                                             id="orders" role="tabpanel" aria-labelledby="orders-tab">

                                            <?php } elseif ($current_slug == 'my-account/downloads') { ?>
                                            <div class="row">
                                                <div class="col p-0">
                                                    <div class="tab-content text-white">
                                                        <div class="tab-pane fade show active col-xxxl-12 col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-xs-12 col-lg-12 pr-0"
                                                             id="downloads" role="tabpanel"
                                                             aria-labelledby="downloads-tab">
                                                            <?php } elseif ($current_slug == 'my-account/subscriptions' || strpos($current_slug, 'view-subscription') == 0) { ?>
                                                            <div>
                                                                <div class="mx-auto pl-3 pr-3 pl-lg-0 pr-lg-0">
                                                                    <div class="tab-content text-white p-0 ">
                                                                        <div class="tab-pane active show fade"
                                                                             id="midi-box" role="tabpanel"
                                                                             aria-labelledby="midi-box-tab">
                                                                            <?php } ?>
                                                                            <?php
                                                                            /**
                                                                             * My Account content.
                                                                             *
                                                                             * @since 2.6.0
                                                                             */
                                                                            do_action('woocommerce_account_content');
                                                                            ?>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
<?php $user = wp_get_current_user(); ?>
    <section class="bg-blue-light2 mitchell-offer">
        <div class="container">
            <div class="col-xxxl-9 col-xxl-11 col-xl-11 col-lg-11 col-sm-10 col-md-9 col-xs-12 mx-auto">
                <div class="row align-items-center flex-xxxl-row flex-xxl-row flex-xl-row flex-lg-row  flex-md-column-reverse flex-sm-column-reverse flex-xs-column-reverse">
                    <div class="col-xxxl-6 col-xxl-7  col-xl-8 col-lg-8 col-sm-12 col-sm-12 col-xs-12 align-items-top pl-0 pr-0">
                        <div class=" bg-transparent">
                            <p class="grey-text"><?php if($user->display_name != ''){echo $user->display_name;}else{echo $user->user_email;} ?>’s Offer</p>
                            <h2><?php echo get_field('title', $post->ID); ?></h2>
                            <p class="content-text text-deskop pl-0 pr-0"><?php echo get_field('text', $post->ID); ?></p>
                                <p class="content-text text-mobile pl-0 pr-0"><?php echo get_field('text', $post->ID); ?></p>
                            <div class="row col-xxxl-10 col-xxl-12 col-xl-8 col-lg-9 col-md-10 col-xs-12 col-sm-12 align-items-center justify-content-between p-0 m-0 flex-xxxl-row flex-xxl-row flex-xl-row flex-lg-row  flex-md-column-reverse flex-sm-column-reverse flex-xs-column-reverse">
                                <div class="col-sm-6 col-xxl-7 col-xl-6 col-lg-6 col-md-12 col-xs-12 col-sm-12 text-center text-lg-left p-0">
                                    <a href="<?php echo get_field('button_link', $post->ID); ?>" class="badge badge-success button-learn"><?php echo get_field('button_text', $post->ID); ?></a>
                                </div>
                                <div class="col-xxxl-5 col-xxl-5 col-xl-5 col-lg-5 align-items-top  d-flex p-0">
                                    <p class="price-warning "
                                       style="margin-right: 10px;"><s><?php echo get_field('price', $post->ID); ?></s></p>
                                    <p class=" price-warning" style="margin-right: 10px;">
                                        <s><?php echo get_field('sale_price', $post->ID); ?></s></p>
                                    <p class="mitchell-price text-white font-weight-bold"><?php echo get_field('sale_sale_price', $post->ID); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxxl-5  col-xxl-4 col-xl-4  col-lg-4 offset-xxl-1 col-sm-12 d-flex justify-content-center justify-content-xxxl-end img-container">
                        <img class="img-fluid mt-xxl-0"
                             src="<?php echo get_field('image', $post->ID)['url']?>"
                             alt="Image">
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
