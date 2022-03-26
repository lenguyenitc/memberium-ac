<?php
/*
Template Name: Home
 */
get_header();
if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly
global $product, $woocommerce_loop, $post; ?>

<section class="p-0">
    <?php
        if (class_exists('RevSliderFront')) {
            add_revslider('slider-11');
        } ?>
</section>
<!-- Main -->
<main class="flex-grow-1">
    <section class="clients p-0 bg-dark">
        <div class="container p-0">
            <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-xs-12 mx-auto p-0">
                <div class="flex-xs-column flex-sm-column flex-md-column flex-lg-row align-items-center d-flex p-0 clientshome">
                    <p class="font-weight-bold">WHO WE'VE WORKED WITH:</p>
                    <div class="clients-logos d-none-770">
                        <img src="<?php bloginfo('template_url') ?>/images/artists/Artist-Logos-Desktop-.png" width="100%" height="100%">                                              
                    </div>
                    <div class="clients-logos d-block-770">                                               
                        <img src="<?php bloginfo('template_url') ?>/images/artists/Mobile-Logos.png" width="100%">                       
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="p-0 front-cards-section front-cards-sec-v2 front-background-image">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-xs-12 mx-auto p-0">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 pr-xxxl-5">
                            <div class="front-free-packs">
                                <p> Free Packs</p>
                                <a href="/free-packs" class="d-inline-block text-white">View All Free Packs <img
                                        class="right-arrow"
                                        src="<?php bloginfo('template_url') ?>/assets/images/arrow-right.png" /></a>
                            </div>
                            <div class="row m-0 products-row">
                                <?php $free = get_field('free_packs_products'); ?>
                                <?php foreach ($free as $item) : ?>
                                <div class="col-sm-6 col-xs-6 p-0 samplepack-item samplepack-item-v2">
                                    <div class="card bg-transparent">
                                    <?php $music = get_post_meta($item->ID, '_music', true); ?>
                                        <div class="card-image">
                                            <a href="<?php
                                                if (get_field('redirect_link', $item->ID)) {
                                                    echo get_field('redirect_link', $item->ID);
                                                } else {
                                                    echo get_the_permalink($item->ID); 
                                                }
                                            ?>">
                                                <?php if (has_post_thumbnail($item->ID)) : ?>
                                                    <img class="card-img img-fluid thumb" src="<?php echo get_the_post_thumbnail_url($item->ID); ?>" alt="Image caption">
                                                <?php endif; ?>
                                                <?php if ($item->ID != 1828) : ?>
                                                <div class="image-overlay d-flex align-items-center justify-content-center">
                                                    <div class="badge-pill product-cta-btn"
                                                        data-product_title="<?php echo get_the_title($item->ID); ?>" data-quantity="1"
                                                        data-product_id="<?php echo $item->ID ?>" data-product_sku="">
                                                        Get It Free
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                            </a>
                                            <div class="play_single_audio ctas cta">
                                                <a href="#" class="btn-play js-sound productbtn<?php echo $item->ID ?>"
                                                    data-file="<?php echo $music; ?>"
                                                    data-id="<?php echo $item->ID; ?>">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="text-white front-card d-flex pb-3">
                                            <div class="col-10 p-0 align-self-center">
                                                <a href="<?php
                                                            if (get_field('redirect_link', $item->ID)) {
                                                                echo get_field('redirect_link', $item->ID);
                                                            } else {
                                                                echo get_the_permalink($item->ID); 
                                                            }
                                                        ?>" class="product-text">
                                                    <?php
                                                        $price = get_post_meta($item->ID, '_regular_price', true);
                                                        $sale_price = get_post_meta($item->ID, '_sale_price', true);
                                                    ?>
                                                    <span class="js-product-price d-none"><?php echo $price ?></span>
                                                    <span class="js-product-sale-price d-none"><?php echo $sale_price ?></span>
                                                    <p class="front-card-title font-weight-bold text-truncate line-clamp js-title-samplepacks">
                                                        <?php echo get_the_title($item->ID); ?>
                                                    </p>
                                                     <p class="pack_price_row <?php if($sale_price){ echo 'wgt-sale';}?>">
                                                        <?php 
                                                        if($price == 0)
                                                        {
                                                        ?>
                                                        <span class="js-price">FREE
                                                        <span class="js-product-price">
                                                        </span>
                                                        </span>   
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <span class="js-price">$
                                                        <span class="js-product-price">
                                                        <?php echo $price; ?>
                                                        </span>
                                                        </span>
                                                        <?php
                                                        if($sale_price)
                                                        {
                                                        ?>
                                                            <span class="js-sale-price">$<span class="js-product-sale-price"><?php echo $sale_price ?></span></span>
                                                       <?php
                                                        }
                                                        }
                                                        ?>
                                                        </p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach;
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 pl-xxxl-5">
                            <div class="front-featured">
                                <p class="d-inline-block">
                                    Featured</p>
                            </div>
                            <div class="row m-0 products-row">
                                <?php $featured = get_field('featured_products');
                                    ?>
                                <?php foreach ($featured as $item) : ?>
                                <div class="col-sm-6 col-xs-6 p-0 samplepack-item samplepack-item-v2">
                                    <div class="card bg-transparent">
                                        <?php $music = get_post_meta($item->ID, '_music', true); ?>
                                        <div class="card-image">
                                            <a href="<?php
                                                if (get_field('redirect_link', $item->ID)) {
                                                    echo get_field('redirect_link', $item->ID);
                                                } else {
                                                    echo get_the_permalink($item->ID); 
                                                }
                                            ?>">
                                                <?php if (has_post_thumbnail($item->ID)) : ?>
                                                    <img class="card-img img-fluid thumb" src="<?php echo get_the_post_thumbnail_url($item->ID); ?>" alt="Image caption">
                                                <?php endif; ?>
                                                <div class="image-overlay d-flex align-items-center justify-content-center">
                                                    <div class="badge-pill product-cta-btn"
                                                        data-product_title="<?php echo get_the_title($item->ID); ?>" data-quantity="1"
                                                        data-product_id="<?php echo $item->ID ?>" data-product_sku="">
                                                        Learn more
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="play_single_audio">
                                                <a href="#" class="btn-play js-sound" data-file="<?php echo $music; ?>" data-id="<?php echo $item->ID; ?>"></a>
                                            </div>
                                        </div>
                                        <div class="text-white front-card d-flex pb-3">
                                            <div class="col-10 p-0 align-self-center">
                                                <a href="<?php
                                                    if (get_field('redirect_link', $item->ID)) {
                                                        echo get_field('redirect_link', $item->ID);
                                                    } else {
                                                        echo get_the_permalink($item->ID); 
                                                    }
                                                ?>" class="product-text">
                                                    <?php
                                                        $price = get_post_meta($item->ID, '_regular_price', true);
                                                        $sale_price = get_post_meta($item->ID, '_sale_price', true);
                                                    ?>
                                                    <p class="front-card-title font-weight-bold text-truncate line-clamp js-title-samplepacks">
                                                        <?php echo get_the_title($item->ID); ?>
                                                    </p>
                                                    <p class="pack_price_row <?php if($sale_price){ echo 'wgt-sale';}?>">
                                                        <span class="js-price">$<span class="js-product-price"><?php echo $price ?></span></span>
                                                        <?php if($sale_price) { ?>
                                                        <span class="js-sale-price">$<span class="js-product-sale-price"><?php echo $sale_price ?></span></span>
                                                    <?php } ?>
                                                    </p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach;
                                    wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 p-0">
                        <div class="front-explore-titles">
                            <span>Explore Our Products</span>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-xs-12 mb-4 mb-lg-5">
                                <a href="/sample-packs">
                                    <div class="card-box green-glow bg-secondary card-animation">
                                        <div class="h-100 d-flex flex-column justify-content-between"
                                            style="background-color: black; border-radius: 20px;">
                                            <div class="card-box-img img-fluid products-image">
                                                <img src="<?php bloginfo('template_url') ?>/assets/images/Unison-Artist-Series-Bundle-Box-500-2%201-1.png"
                                                    class="border-radius-top bg-black text-center" alt="Sample packs">
                                            </div>
                                            <div class="product-card">
                                                <div class="product-info">
                                                    <p class="products-title">Sample Packs</p>
                                                    <div class="products-title-underline">
                                                    </div>
                                                    <p class="product-cards-text">Want to make your music sound
                                                        professional? Click here to check out our proven, pro-quality
                                                        sample packs created by world-class producers such as MALAA,
                                                        TrapMoneyBenny, Matroda, Montell2099 and more.
                                                    </p>
                                                </div>
                                                <div class="arrow-button">
                                                    <img
                                                        src="<?php bloginfo('template_url') ?>/assets/images/circle-arrow-right.png" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-sm-12 mb-4 mb-lg-5">
                                <a href="/preset-banks">
                                    <div class="card-box green-glow bg-secondary card-animation">
                                        <div class="h-100 d-flex flex-column justify-content-between"
                                            style="background-color: black; border-radius: 20px;">
                                            <div class="card-box-img img-fluid products-image">
                                                <img src="<?php bloginfo('template_url') ?>/assets/images/present-banks-card-img.png"
                                                    class="border-radius-top bg-black text-center" alt="Sample packs">
                                            </div>
                                            <div class="product-card">
                                                <div class="product-info">
                                                    <p class="products-title">Preset Banks</p>
                                                    <div class="products-title-underline">
                                                    </div>
                                                    <p class="product-cards-text">Want access to the hottest presets?
                                                        Click
                                                        here to check out our genre-specific, hit-modelled preset banks
                                                        created by our in-house team of professional sound designers for
                                                        you
                                                        to plug & play into your
                                                        own tracks.</p>
                                                </div>
                                                <div class="arrow-button">
                                                    <img
                                                        src="<?php bloginfo('template_url') ?>/assets/images/circle-arrow-right.png" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-xs-12 mb-4 mb-lg-5">
                                <a href="/midi-packs">
                                    <div class="card-box green-glow bg-secondary card-animation">
                                        <div class="h-100 d-flex flex-column justify-content-between"
                                            style="background-color: black; border-radius: 20px;">
                                            <div class="card-box-img img-fluid products-image">
                                                <img src="<?php bloginfo('template_url') ?>/assets/images/midi-packs-card-img.png"
                                                    class="border-radius-top bg-black text-center" alt="Sample packs">
                                            </div>
                                            <div class="product-card">
                                                <div class="product-info">
                                                    <p class="products-title">MIDI Packs</p>
                                                    <div class="products-title-underline">
                                                    </div>
                                                    <p class="product-cards-text">Want to level up your chord
                                                        progressions,
                                                        melodies and drum grooves? Click here to check out our 75+
                                                        world-famous MIDI packs that have helped over 220,000 producers
                                                        skyrocket their music.</p>
                                                </div>
                                                <div class="arrow-button">
                                                    <img
                                                        src="<?php bloginfo('template_url') ?>/assets/images/circle-arrow-right.png" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-xs-12 mb-4 mb-lg-0">
                                <a href="https://unison.audio/midi-wizard">
                                    <div class="card-box green-glow bg-secondary card-animation">
                                        <div class="h-100 d-flex flex-column justify-content-between"
                                            style="background-color: black; border-radius: 20px;">
                                            <div class="card-box-img img-fluid products-image">
                                                <img src="<?php bloginfo('template_url') ?>/assets/images/midi-wiz-card-img-new.png"
                                                    class="border-radius-top bg-black text-center" alt="Sample packs">
                                            </div>
                                            <div class="product-card">
                                                <div class="product-info">
                                                    <p class="products-title">MIDI Wizard</p>
                                                    <div class="products-title-underline">
                                                    </div>
                                                    <p class="product-cards-text">Want to produce hit songs? Click here
                                                        to get the world's first (and only) chord progression & melody
                                                        generator that's genre-specific and actually sounds good 93% of
                                                        the time.</p>
                                                </div>
                                                <div class="arrow-button">
                                                    <img
                                                        src="<?php bloginfo('template_url') ?>/assets/images/circle-arrow-right.png" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-xs-12 mb-4 mb-lg-0">
                                <a href="https://unison.audio/drum-monkey">
                                    <div class="card-box green-glow bg-secondary card-animation">
                                        <div class="h-100 d-flex flex-column justify-content-between"
                                            style="background-color: black; border-radius: 20px;">
                                            <div class="card-box-img img-fluid products-image-bundles">
                                                <img src="<?php bloginfo('template_url') ?>/assets/images/DrumMonkeys.png"
                                                    class="border-radius-top bg-black text-center" alt="Sample packs">
                                            </div>
                                            <div class="product-card">
                                                <div class="product-info">
                                                    <p class="products-title">Drum Monkey</p>
                                                    <div class="products-title-underline">
                                                    </div>
                                                    <p class="product-cards-text">Want to produce addictive tracks? Click here to get the world’s first (and only) drum loop generator that’s genre specific and actually sounds good 93% of the time.</p>
                                                </div>
                                                <div class="arrow-button">
                                                    <img
                                                        src="<?php bloginfo('template_url') ?>/assets/images/circle-arrow-right.png" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-xs-12 mb-4 mb-lg-0">
                                <a href="/bundles">
                                    <div class="card-box green-glow bg-secondary card-animation">
                                        <div class="h-100 d-flex flex-column justify-content-between"
                                            style="background-color: black; border-radius: 20px;">
                                            <div class="card-box-img img-fluid products-image-bundles">
                                                <img src="<?php bloginfo('template_url') ?>/assets/images/bundles-card-img-new.png"
                                                    class="border-radius-top bg-black text-center" alt="Sample packs">
                                            </div>
                                            <div class="product-card">
                                                <div class="product-info">
                                                    <p class="products-title">Bundles</p>
                                                    <div class="products-title-underline">
                                                    </div>
                                                    <p class="product-cards-text">Serious about becoming a pro music
                                                        producer? Click here to get everything you need to skyrocket
                                                        your
                                                        inspiration, create jaw-dropping chord progressions, make hit
                                                        melodies and get your music sounding
                                                        professional – at epic discounts.</p>
                                                </div>
                                                <div class="arrow-button">
                                                    <img
                                                        src="<?php bloginfo('template_url') ?>/assets/images/circle-arrow-right.png" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section class="bg-white bg-1 p-0">
        <img src="<?php bloginfo('template_url') ?>/assets/images/drips.svg" class="img-fluid w-100"
            style="position: relative; top: -2px;">
        <div class="container text-center">
            <div class="col-xxxl-9 col-xxl-8 col-xl-9 col-lg-10 col-xs-12 mx-auto p-0">
                <div class="row worlds-section-row">
                    <div class="col-lg-6 col-xs-12 midi-box-image"
                        style="background-image: url(<?php bloginfo('template_url') ?>/assets/images/worlds-first-section-image.png);">
                    </div>
                    <div class="col-lg-6 col-xs-12 worlds-first-section p-0">
                        <div>
                            <h3 class="text-dark worlds-heading first-row text-left">The World’s First Custom-Curated
                            </h3>
                            <h3 class="text-success worlds-heading text-left">Monthly MIDI Subscription</h3>
                            <p class="worlds-text">Now you can get exclusive access to as much as 1,000 unique,
                                hit-quality MIDI chord progressions, melodies, basslines and drum patterns – every
                                single month..</p>
                        </div>
                        <div class="learn-more-button">
                            <a href="/midi-box" class="badge badge-success">
                                Learn more
                                <img class="right-arrow"
                                    src="<?php bloginfo('template_url') ?>/assets/images/arrow-right.png">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <section class="bg-dark testimonial-wistia-player text-white proof-result front-proof-bg-image">
        <div class="container">
            <div class="col-xxxl-8 col-xxl-8 col-xl-11 col-lg-10 col-md-10 col-xs-12 mx-auto p-0">
                <div class="row proof-mobile-section">
                    <div class="col-lg-6 col-xs-12">
                        <div class="row">
                            <h1 class="proof-title">The Proof Is In The Results</h1>
                        </div>
                        <div class="row">
                            <p class="proof-text">Since our start in 2017, over 222,708 producers have purchased our
                                unique products and have taken their music to the next level – most notably with the
                                legendary Unison MIDI Chord Pack which has sold over 150,000 copies.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 offset-lg-1 col-xs-12 pl-0">
                        <h1 class="front-proof-titles-customers">222,708+</h1>
                        <p class="front-proof-text satisfied">Satisfied Customers</p>
                        <h1 class="front-proof-titles-reach">
                            12,872,782+</h1>
                        <p class="front-proof-text">Producers Reached</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xxl-10">
                    <div class="row justify-content-center">
                        <p class="hear-what">Hear what our customers have to say...</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center testimonials-main-page">
                <?php
                    $args = array(
                        'post_type' => 'testimonials',
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'posts_per_page' => 3,
                        'meta_query' => array(
                            array(
                                'key'     => 'show_on_homepage',
                                'value'   => true,
                                'compare' => '=',
                            ),
                            array(
                                'key'     => 'wistia',
                                'compare' => '!=',
                                'value'   => '',
                            ),
                            'relation' => 'AND'
                        ),
                    );
                    $the_query = new WP_Query($args);
                    while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <div class="col-xl-3 col-lg-4 col-xs-12 mb-3 p-0">
                    <div class="border-0 bg-transparent">
                        <div class="card-image front-blog-image-container">
                            <?php echo get_field('wistia', $post->ID); ?>
                        </div>
                        <div class="card-body p-0">
                            <a class="d-block" href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>">
                                <p class="customer-name text-white"><?php echo the_title(); ?></p>
                            </a>
                            <p class="customer-city"><?php echo get_field('country')?></p>
                        </div>
                    </div>
                </div>
                <?php endwhile;
                    wp_reset_postdata();
                    ?>
                <div class="col-12 text-center view-all-btn">
                    <a href="/reviews" class="badge badge-pill-carousel badge-success">
                        View all
                        <img class="right-arrow" src="<?php bloginfo('template_url') ?>/assets/images/arrow-right.png">
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<div class="modal-overlay closed" id="modal-overlay"></div>
<script src="https://fast.wistia.com/embed/medias/355hm6noc5.jsonp" async></script>
<script src="https://fast.wistia.com/assets/external/E-v1.js" async></script>
<script type="text/javascript">
function openModal(id) {
    console.log('[OPEN MODAL ID]: ', id);
    $(`#modal-testimonials-${id}`).removeClass('closed');
    $('#modal-overlay').removeClass('closed');
}

function closeModal(id) {
    console.log('[CLOSE MODAL ID]: ', id);
    $(`#modal-testemonial-close-${id}`).on('click', function() {
        $(`#modal-testimonials-${id}`).addClass('closed');
        $('#modal-overlay').addClass('closed');
    });
}
</script>
<?php get_footer();