<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;
global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

    <?php
    /**
     * Hook: woocommerce_before_single_product_summary.
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    do_action( 'woocommerce_before_single_product_summary' );
    ?>

    <div class="info summary entry-summary">

        <?php
        /**
         * Hook: woocommerce_single_product_summary.
         *
         * @hooked woocommerce_template_single_title - 5
         * @hooked woocommerce_template_single_rating - 10
         * @hooked woocommerce_template_single_price - 10
         * @hooked woocommerce_template_single_excerpt - 20
         * @hooked woocommerce_template_single_add_to_cart - 30
         * @hooked woocommerce_template_single_meta - 40
         * @hooked woocommerce_template_single_sharing - 50
         * @hooked WC_Structured_Data::generate_product_data() - 60
         */
        do_action( 'woocommerce_single_product_summary' );
        ?>

    </div><!-- .summary -->
</div><!-- /container -->
</div><!-- /row -->
</div><!-- /column -->

<?php
/**
 * Hook: woocommerce_after_single_product_summary.
 *
 * @hooked woocommerce_output_product_data_tabs - 10
 * @hooked woocommerce_upsell_display - 15
 * @hooked woocommerce_output_related_products - 20
 */
//do_action( 'woocommerce_after_single_product_summary' );
?>

<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div>

<?php //do_action( 'woocommerce_after_single_product' ); ?>

</section>
<div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 justify-content-center text-center p-0">
    <div class="col-xxxl-10 col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-md-12 col-xs-12 mx-auto content">
        <?php the_content(); ?>
    </div>
</div>
<?php $samples = get_field('samples', $product->ID); ?>

<main class="flex-grow-1 bg-black text-white">
    <section class="players p-0">
        <div class="container">
            <div class="row text-white">
                <div class="col-12 text-center">
                    <h3>A preview of what's inside.</h3>
                </div>
                <div class="col-xxl-9 col-xxxl-8 col-xl-11 col-lg-11 col-md-11 col-sm-11 col-xs-12 row mx-auto player player-display-none p-0">
                    <?php foreach ($samples as $sample) { ?>
                        <div class="col-xxxl-3 col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-6  justify-content-center  mejs_container">
                            <div class="my-3 col-12">
                                <p class="p4 p-0 text-center"
                                   id="playerText1"><?php echo $sample['audio_name'] ?></p>
                            </div>
                            <div class="media-wrapper">
                                <?php echo do_shortcode('[audio mp3="' . $sample['audio_link'] . '"][/audio]'); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-12 text-center">
                    <p class="text-green"><b>+ 214 More Unique MIDI Melodies…</b></p>
                </div>
            </div>
        </div>
    </section>
    <section class="col-12 about-pack">
        <div class="container">
            <div class="col-xxxl-5 col-xxl-7 col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12 mx-auto">
                <?php echo get_field('extra_content', $product->ID); ?>
                <div class="col-xxxl-5 col-xxl-10 col-md-12 col-sm-12 col-xs-12  p-0 mx-auto text-center">
                    <a href="#" class="bg-success text-center justify-content-center text-white font-weight-bold mx-auto btn-add product_add_cart_btn"><?php echo do_shortcode('[add_to_cart_btn]'); ?></a>
                </div>
            </div>
            <div class="col-xxxl-6 col-xxl-7 col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12 mx-auto p-0">
                <h5>How it works</h5>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 mx-auto p-0">
                    <video controls>
                        <source src="https://deals.unison.audio/868d1955-0117-45f4-bc0f-8c184fb0f30a" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </section>

    <section class="col-12 p-0">
        <div class="about-artist">
            <div class="col-xxxl-6 col-xxl-7 col-xl-9 col-lg-9 col-md-11 col-sm-11 col-xs-12 mx-auto">
                <h3>About the artist</h3>
                <div class="row align-items-top justify-content-between">
                    <div class="col-xxxl-3 col-xxl-3 col-xl-3 col-lg-3">
                        <img class="img-fluid" src="<?php echo get_field('image', $product->ID)?>" alt="Image">
                    </div>
                    <div class="col-xxxl-9 col-xxl-8 col-xl-8  col-lg-8 text-left">
                        <p class="title">Montell2029</p>
                        <p class="content pl-0">

                            <?php echo get_field('about', $product->ID)?>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="asks-accordion">
        <div class="container col-xxxl-8 col-xxl-9 col-xl-9 col-lg-9 col-md-11 col-sm-11 col-xs-12 mx-auto text-center">
            <div class=" text-center mx-auto">
                <h3 class="text-center">Frequently Asked Questions</h3>
                <div id="accordion" class="p-0">
                    <?php $faqs = get_field('faq', $product->ID); ?>
                    <?php foreach ($faqs as $key => $faq) : ?>
                        <div class="acordion-item pointer mb-4">
                            <div class="row col-xxxl-12 col-xl-12 col-lg-12 col-md-11 col-sm-11 col-xs-12  mx-auto rounded-xs acc-close"
                                 aria-expanded="false" id="collapse-accordion" data-toggle="collapse"
                                 data-target="#collapseOne" style="padding-bottom: 19px; padding-top: 19px">
                                <div class="col-lg-11 col-md-11 col-sm-10 col-md-11 col-sm-11 col-xs-10">
                                    <p class=" text-left font-weight-bold">
                                        <?php echo $key + 1?>.<?php echo $faq['faq_question'] ?>
                                    </p>
                                </div>
                                <div class=" col-lg-1 col-md-1 col-sm-1 col-md-1 col-sm-1 col-xs-2 text-right">
                                    <img src="<?php bloginfo('template_url')?>/assets/images/Vector.png" id="btn-down"
                                         style="width: 16px; height: 9px;">
                                    <img src="<?php bloginfo('template_url')?>/assets/images/Vector green.png" id="btn-up"
                                         style="width: 16px; height: 9px;">
                                </div>
                            </div>

                            <div id="collapseOne" data-parent="#accordion" class="collapse acc-open">
                                <div class="text-left row col-xl-12 col-lg-12 col-sm-12 col-md-11 col-sm-11 col-xs-12 mx-auto pt-0">
                                    <p> <?php echo $faq['faq_answer'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
    </section>

    <section class="money-back pt-0">
        <div class="container">
            <div class="col-xxxl-9 col-xxl-12  col-xl-9 col-lg-10  col-sm-11 mx-auto text-center  ">
                <div class="row flex-md-column flex-lg-row">
                    <div class="col-xxxl-6 col-xxl-6  col-xl-6  col-lg-6 col-sm-6 col-md-6 col-xs-6 mx-auto">
                        <div class="row align-items-top justify-content-center flex-md-column flex-lg-row ">
                            <img class=" mb-sm-0 mr-3 mx-auto" src="<?php bloginfo('template_url')?>/assets/images/money_back-200x200.png" alt="60 Days Money Back Guarantee">
                            <div>
                                <h4>60-Day Money-Back Guarantee</h4>
                                <p>We stand behind our products 100%. If you don’t absolutely love the pack, just email support@unison.audio within 60 days and we’ll give you 100% of your money back. No questions asked. No hard feelings.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxxl-6  col-xxl-6 col-xl-6  col-lg-6  col-lg-6 col-sm-6 col-md-6 col-xs-7 mx-auto">
                        <div class="row align-items-top justify-content-center flex-md-column flex-lg-row ">
                            <img class="mb-sm-0 mr-3 mx-auto" src="<?php bloginfo('template_url')?>/assets/images/site-secure 200x200.png" alt="Secure Payment">
                            <div>
                                <h4>Secure Payment</h4>
                                <p>All orders are processed through a secure payment network. Your payment information is safely encrypted with 256-bit SSL technology and your information is never shared. We respect your privacy.</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</main>
</div>
</div>
</div>