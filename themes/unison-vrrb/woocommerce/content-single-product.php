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

defined('ABSPATH') || exit;
global $product;
global $post;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<style>
                        
.accordion-container{
  position: relative;
  /*max-width: 500px;*/
  height: auto;
  margin: 10px auto;
}
.accordion-container > h2{
  text-align: center;
  color: #fff;
  padding-bottom: 5px;
  margin-bottom: 20px;
  padding-bottom: 15px;
  border-bottom: 1px solid #ddd;
}
.set {
    position: relative;
    width: 100%;
    height: auto;
    background-color: #222222;
    margin-bottom: 14px;
    border-radius: 7px;
}
.set > .accordion {
    display: block;
    padding: 10px 15px;
    text-decoration: none;
    color: #fffff0;
    font-weight: 500;
    -webkit-transition: all 0.2s linear;
    -moz-transition: all 0.2s linear;
    transition: all 0.2s linear;
    font-size: 14px;
    text-align: left;
    padding: 12px 29px 12px 24px;
    position: relative;
}
.set > .accordion i {   
    margin-top: 0;
    font-size: 25px;
    position: absolute;
    top: 12px;
    right: 15px;
}
.set > .accordion.active {
    background-color: #202c2a;
    color: #02bfa3;
}
.accordion-content {
    background-color: #202c2a;
    display: none;
    width: 100%;
    min-width: 100%;
}
.accordion-content p {
    padding: 0 100px 24px 29px;
    margin: 0;
    color: #fff;
    font-size: 13px;
    text-align: left;
}

@media (max-width: 991px){
    .accordion-content p {
        padding: 0  32px 20px 24px;    
    }
}
@media (max-width: 481px){
    .accordion-content p {
        padding: 0  10px 24px;   
    }
    .set > .accordion i { 
     right: 10px;
    }
}
</style>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

    <?php
    /**
     * Hook: woocommerce_before_single_product_summary.
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    do_action('woocommerce_before_single_product_summary');
    ?>

    <div
        class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 justify-content-center text-center p-0 pl-lg-5">
        <div
            class="col-xxxl-10 col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-md-12 col-xs-12 mx-auto content pl-0 summary samplepack-item text-left">

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
            do_action('woocommerce_single_product_summary');
            ?>
        </div>
    </div>
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
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php //do_action( 'woocommerce_after_single_product' ); ?>
<main class="flex-grow-1 bg-black text-white">
    <?php $samples = get_field('samples', $product->ID); ?>
    <?php if ($samples) : ?>
    <section class="players p-0">
        <div class="container">
            <div class="row text-white">
                <div class="col-12 text-center">
                    <h3><?php echo get_field('samples_title', $product->ID); ?></h3>
                </div>
                <div
                    class="col-xxl-9 col-xxxl-8 col-xl-11 col-lg-11 col-md-11 col-sm-11 col-xs-12 row mx-auto player player-display-none p-0">
                    <!--                    --><?php //the_content(); ?>

                    <?php foreach ($samples as $key => $sample) { ?>
                    <div
                        class="col-xxxl-3 col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-6  justify-content-center  mejs_container">
                        <div class="media-wrapper player-text d-flex flex-column justify-content-between h-100">
                            <div class="margin-player-text">
                                <p class="p4 p-0 text-center" id="playerText<?php echo $key + 1; ?>">
                                    <?php echo $sample['audio_name'] ?></p>
                            </div>
                            <?php echo do_shortcode('[audio mp3="' . $sample['audio_link'] . '" wav="' . $sample['audio_link'] . '" ogg="' . $sample['audio_link'] . '"][/audio]'); ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-12 text-center">
                    <p class="text-green"><?php echo get_field('samples_text'); ?></p>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php $about_pack = get_field('extra_content', $product->ID); ?>
    <?php if ($about_pack) : ?>
    <section class="col-12 about-pack">
        <div class="container">
            <div class="col-xxxl-6 col-xxl-7 col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12 mx-auto p-0">
                <h5><?php echo get_field('about_pack_title', $product->ID); ?></h5>

                <?php echo $about_pack; ?>
                <div class="col-xxxl-5 col-xxl-10 col-md-12 col-sm-12 col-xs-12  p-0 mx-auto text-center">
                    <form class="cart" method="post" enctype='multipart/form-data'>
                        <input type="hidden" name="add-to-cart" value="<?php echo $post->ID; ?>" />

                        <button type="submit"
                            class="btn-individual-product align-items-end btn-add add_cart_btn btn-add badge-success"><i
                                class="fa fa-shopping-cart" style="margin-right: 10px;"></i>ADD TO
                            CART<?php 
                            $price = get_post_meta($post->ID, '_regular_price', true);
                            if ($price === '0') echo ' FREE'; ?></button>
                    </form>
                </div>
            </div>
        </div>
        <?php $how_it_works = get_field('how_it_works', $product->ID); ?>
        <?php if ($how_it_works) : ?>
        <div class="container">
            <div class="col-xxxl-6 col-xxl-7 col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12 p-0 mx-auto">
                <h5><?php echo get_field('how_it_works_title', $product->ID); ?></h5>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 mx-auto p-0 how-it-works-video">
                    <?php echo $how_it_works ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <?php $artist = get_field('about', $product->ID, false); ?>
    <?php if ($artist) : ?>
    <section class="container p-0">
        <div class="about-artist">
            <div class="col-xxxl-6 col-xxl-7 col-xl-9 col-lg-9 col-md-11 col-sm-11 col-xs-12 mx-auto">
                <h3>About the artist</h3>
                <div class="row align-items-top">
                    <div class="col-xxxl-3 col-xxl-3 col-xl-3 col-lg-3">
                        <img class="img-fluid" src="<?php echo get_field('image', $product->ID) ?>" alt="Image">
                    </div>
                    <div class="col-xxxl-9 col-xxl-8 col-xl-9  col-lg-9 text-left">
                        <p class="title"><?php echo get_field('about_artist_title', $product->ID); ?></p>
                        <p class="content pl-0">
                            <?php echo $artist; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php $faqs = get_field('faq', $product->ID); ?>
    <?php if ($faqs) : ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <section class="asks-accordion">
        <div class="container col-xxxl-7 col-xxl-8 col-xl-8 col-lg-9 col-md-11 col-sm-11 col-xs-12 mx-auto text-center">
            <div class=" text-center mx-auto">
                <h3 class="text-center"><?php echo get_field('faq_title'); ?></h3>
                <div class="p-0 acc-container accordion-container">
                    <?php foreach ($faqs as $key => $faq) : ?>
                    <!--  <div class="acordion-item pointer mb-4">
                        <div class="row col-xxxl-12 col-xl-12 col-lg-12 col-md-11 col-sm-11 col-xs-12  mx-auto rounded-xs acc-close"
                            aria-expanded="false" id="collapse-accordion" data-toggle="collapse"
                            data-target="#collapse<?php echo $faq['faq_number']; ?>"
                            >
                            <div class="col-lg-11 col-md-11 col-sm-10 col-md-11 col-sm-11 col-xs-10">
                                <p class=" text-left font-weight-bold">
                                    <?php echo $key + 1 ?>. <?php echo $faq['faq_question'] ?>
                                </p>
                            </div>
                            <div class=" col-lg-1 col-md-1 col-sm-1 col-md-1 col-sm-1 col-xs-2 text-right">
                                <img src="<?php bloginfo('template_url') ?>/assets/images/Vector.png" id="btn-down"
                                    style="width: 16px; height: 9px;">
                                <img src="<?php bloginfo('template_url') ?>/assets/images/Vector green.png" id="btn-up"
                                    style="width: 16px; height: 9px;">
                            </div>
                        </div>

                        <div id="collapse<?php echo $faq['faq_number']; ?>" data-parent="#accordion"
                            class="collapse acc-open">
                            <div
                                class="text-left row col-xl-12 col-lg-12 col-sm-12 col-md-11 col-sm-11 col-xs-12 mx-auto pt-0">
                                <p> <?php echo $faq['faq_answer'] ?></p>
                            </div>
                        </div>
                    </div>   -->


                    <!-- <div class="acordion-item pointer mb-4">
                        <div class="accordion row col-xxxl-12 col-xl-12 col-lg-12 col-md-11 col-sm-11 col-xs-12  mx-auto rounded-xs">
                            <div class='col-lg-11 col-md-11 col-sm-10 col-md-11 col-sm-11 col-xs-10'>
                                <p class=" text-left font-weight-bold" style="color: #fff;font-size: 14px;"><?php echo $key + 1 ?>. <?php echo $faq['faq_question'] ?></p>
                            </div>
                        </div>
                        <div class="col-lg-11 col-md-11 col-sm-10 col-md-11 col-sm-11 col-xs-10 accordion-content" >
                            <p class=" text-left">
                                  <?php echo $faq['faq_answer'] ?>
                            </p>
                        </div>

                    </div> -->                    
                      <div class="set pointer">
                        <p class='accordion row col-12  mx-auto rounded-xs'>
                          <?php echo $key + 1 ?>. <?php echo $faq['faq_question']; ?> 
                          <i class="fa fa-angle-down"></i>
                        </p>
                        <div class="col-lg-11 col-md-11 col-sm-10 col-md-11 col-sm-11 col-xs-10 accordion-content content-zen">
                          <p><?php echo $faq['faq_answer'] ?></p>
                        </div>
                      </div>




                    <?php endforeach; ?>
                </div>
            </div>
    </section>
    <?php endif; ?>

    <?php if (get_field('money_back_guarantee', $product->ID)) : ?>
    <section class="money-back pt-0">
        <div class="container">
            <div class="col-xxxl-8 col-xxl-9  col-xl-9 col-lg-10  col-sm-11 mx-auto text-center">
                <div class="row flex-md-column flex-sm-column flex-lg-row">
                    <div class="col-xxxl-6 col-xxl-6  col-xl-6  col-lg-6 col-sm-8 col-md-8 col-xs-10 mx-auto">
                        <div class="row align-items-top justify-content-center flex-md-column flex-lg-row ">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/money_back-200x200.png"
                                alt="60 Days Money Back Guarantee">
                            <div>
                                <h4>60-Day Money-Back Guarantee</h4>
                                <p>We stand behind our products 100%. If you don’t absolutely love the pack, just email
                                    support@unison.audio within 60 days and we’ll give you 100% of your money back. No
                                    questions asked. No hard feelings.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxxl-6 col-xxl-6  col-xl-6  col-lg-6 col-sm-8 col-md-8 col-xs-10 mx-auto">
                        <div class="row align-items-top justify-content-center flex-md-column flex-lg-row ">
                            <img src="<?php bloginfo('template_url') ?>/assets/images/site-secure 200x200.png"
                                alt="Secure Payment">
                            <div>
                                <h4>Secure Payment</h4>
                                <p>All orders are processed through a secure payment network. Your payment information is safely encrypted with 256-bit SSL technology and your information is never shared. We respect your privacy.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

</main>
<script>
// const accordionBtns = document.querySelectorAll(".accordion");

// accordionBtns.forEach((accordion) => {
//   accordion.onclick = function () {
//     this.classList.toggle("is-open");

//     let content = this.nextElementSibling;
//     console.log(content);
//     content.style.display = 'block';
//     if (content.style.maxHeight) {
//       //this is if the accordion is open
//       content.style.maxHeight = null;
//     } else {
//       //if the accordion is currently closed
//       content.style.maxHeight = content.scrollHeight + 10 + "px";
//       console.log(content.style.maxHeight);
//     }
//   };
// });

jQuery(document).ready(function() {
    $(".set > .accordion").on("click", function() {
        if ($(this).hasClass("active")) {
          $(this).removeClass("active");
          $(this)
            .siblings(".content-zen")
            .slideUp(200);
          $(".set > .accordion i")
            .removeClass("fa-angle-up")
            .addClass("fa-angle-down");
        } else {
          $(".set > .accordion i")
            .removeClass("fa-angle-up")
            .addClass("fa-angle-down");
          $(this)
            .find("i")
            .removeClass("fa-angle-down")
            .addClass("fa-angle-up");
          $(".set > .accordion").removeClass("active");
          $(this).addClass("active");
          $(".content-zen").slideUp(200);
          $(this)
            .siblings(".content-zen")
            .slideDown(200);
        }
      });

    $("audio").mediaelementplayer({
        success: function(mediaElement, domObject) {
            mediaElement.addEventListener('playing', function(index) {
                console.log("event triggered after play method");
                let player = document.querySelector(`#${index.detail.target.id}`)
                let container = player.closest('.mejs-mediaelement')
                let playText = player.closest('.player-text')
                console.log(playText)
                playText.style.color = "#1cbaa4"
                container.classList.add('play-blue')



            }, false);
            mediaElement.addEventListener('pause', function(index) {
                console.log("event triggered after pause method");
                let player = document.querySelector(`#${index.detail.target.id}`)
                let container = player.closest('.mejs-mediaelement')
                let playText = container.closest('.player-text')
                playText.style.color = "white"
                container.style.background = "transparent !important"
                container.classList.remove('play-blue')

            }, false);
        }
    })

})
</script>