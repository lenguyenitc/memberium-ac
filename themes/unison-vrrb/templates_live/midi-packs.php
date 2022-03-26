<?php
/*
 * Template Name: Midi Packs
 *
 * */
get_header();
global $post; ?>

<div class="jumbotron text-white bg-light-blue-gradient page-section-title-py">
    <div class="container">
        <div class="row">
            <div class="col-xxxl-9 col-xxl-9  col-xl-11 col-lg-11 col-md-11 col-sm-11 col-xs-11 mx-auto p-0">
                <div class="col-xxxl-5 col-xxl-5 col-lg-5 p-0">
                    <h1><?php echo the_title(); ?></h1>
                    <p class="font-weight-normal p-0">Want to level up your chord progressions, melodies and drum
                        grooves? Check out our 75+ world-famous MIDI packs that have helped over 220,000 producers
                        skyrocket their music.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<main class="flex-grow-1">
    <section class="p-0 m-0 front-cards-section">
        <div class="container">
            <div class="row">
                <div
                    class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-11 col-xs-11 mx-auto text-white p-0">
                    <h3 class="fundamentals">Fundamentals</h3>
                    <div class="row m-0 products-row">
                        <?php
                            wp_reset_query();
                            $sample_packs = new WP_Query(array(
                                'post_type' => 'product',
                                'posts_per_page' => -1,
                                'order' => 'asc',
                                'has_password' => false,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'product_cat',
                                        'field' => 'slug',
                                        'terms' => 'midi-fundamentals'
                                    )
                                )
                            ));
                            $i = 1;
                            while ($sample_packs->have_posts()) : $sample_packs->the_post();
                                $music = get_post_meta($post->ID, '_music', true); ?>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 p-0 samplepack-item">
                            <?php if ($i == 1) : ?>
                            <img class="copies_sold_left"
                                src="<?php bloginfo('template_url') ?>/assets/images/150 k sold.svg" alt="Copies Sold"
                                style="width: 99px">
                            <?php endif; ?>
                            <div class="card bg-transparent">
                                <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php
                                                if (get_field('redirect_link', $post->ID)) {
                                                    echo get_field('redirect_link', $post->ID);
                                                } else {
                                                    echo the_permalink(); 
                                                }
                                            ?>">
                                    <div class="card-image">
                                        <img class="card-img img-fluid thumb"
                                            src="<?php echo get_the_post_thumbnail_url($post->ID); ?>"
                                            alt="Image caption">
                                        <div class="image-overlay d-flex align-items-center justify-content-center">
                                            <div class="badge-pill product-cta-btn-big">Learn more
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <?php endif; ?>
                                <div class="text-white front-card d-flex pb-3">
                                    <div class="single_product_play">
                                        <div class="play_single_audio">
                                            <a href="#" class="btn-play js-sound" data-file="<?php echo $music; ?>"
                                                data-id="<?php echo $post->ID; ?>">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-10 p-0 align-self-center">
                                        <a href="<?php
                                                if (get_field('redirect_link', $item->ID)) {
                                                    echo get_field('redirect_link', $item->ID);
                                                } else {
                                                    echo get_the_permalink($item->ID); 
                                                }
                                            ?>" class="product-text">
                                            <?php 
                                                $price = get_post_meta($post->ID, '_regular_price', true);
                                                $sale_price = get_post_meta($post->ID, '_sale_price', true);
                                            ?>
                                            <span class="js-product-price d-none"><?php echo $price ?></span>
                                            <span class="js-product-sale-price d-none"><?php echo $sale_price ?></span>
                                            <p
                                                class="front-card-title font-weight-bold text-truncate line-clamp js-title-samplepacks">
                                                <?php the_title(); ?></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $i++;
                            endwhile; ?>
                    </div>
                    <div class="col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-11 col-sm-11 col-xs-11  blue-ind p-0">
                        <h2>Blueprints &amp; Bundles</h2>
                    </div>
                    <div class="row m-0 products-row">
                        <?php

                        $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => -1,
                            // 1. define a custom query var here to pass your term through:
                            'search_prod_title' => 'Midi',
                            'post_status' => 'publish',
                            'has_password' => false,
                            'order' => 'desc',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field' => 'slug',
                                    'terms' => 'midi-blueprints-bundles'
                                )
                            )
                        );

                        add_filter('posts_where', 'title_filter', 10, 2);
                        $wp_query = new WP_Query($args);
                        remove_filter('posts_where', 'title_filter', 10);

                        while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                        <?php $product = wc_get_product($post->ID);
                            $music = get_post_meta($post->ID, '_music', true);
                            ?>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 p-0 samplepack-item">
                            <div class="card bg-transparent">
                                <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php
                                                if (get_field('redirect_link', $post->ID)) {
                                                    echo get_field('redirect_link', $post->ID);
                                                } else {
                                                    echo the_permalink(); 
                                                }
                                            ?>">
                                    <div class="card-image">
                                        <img class="card-img img-fluid thumb"
                                            src="<?php echo get_the_post_thumbnail_url($post->ID); ?>"
                                            alt="Image caption">
                                        <div class="image-overlay d-flex align-items-center justify-content-center">
                                            <div class="badge-pill product-cta-btn-big">Learn more
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <?php endif; ?>
                                <div class="text-white front-card d-flex pb-3">
                                    <div class="single_product_play">
                                        <div class="play_single_audio">
                                            <a href="#" class="btn-play js-sound" data-file="<?php echo $music; ?>"
                                                data-id="<?php echo $post->ID; ?>">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-10 p-0 align-self-center">
                                        <a href="<?php
                                                if (get_field('redirect_link', $item->ID)) {
                                                    echo get_field('redirect_link', $item->ID);
                                                } else {
                                                    echo get_the_permalink($item->ID); 
                                                }
                                            ?>" class="product-text">
                                            <?php 
                                                        $price = get_post_meta($post->ID, '_regular_price', true);
                                                        $sale_price = get_post_meta($post->ID, '_sale_price', true);
                                                    ?>
                                            <span class="js-product-price d-none"><?php echo $price ?></span>
                                            <span class="js-product-sale-price d-none"><?php echo $sale_price ?></span>
                                            <p
                                                class="front-card-title font-weight-bold text-truncate line-clamp js-title-samplepacks">
                                                <?php the_title(); ?></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <div>
                        <div
                            class="col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-11 col-sm-11 col-xs-11  ind-title p-0">
                            <h2>Individual packs</h2>
                        </div>
                        <!-- Filter -->
                        <div class="col-12 page-nav border-bottom p-0">
                            <nav
                                class="col-xxxl-12  col-xxl-12 col-xl-12 col-lg-12 col-xs-12 col-md-12 col-sm-12 mx-auto nav w-100 p-0 justify-content-around  text-uppercase font-weight-bold  mx-auto">
                                <div class="row justify-content-around" style="width: 100%">
                                    <!-- <a class="nav-link filter-button active ml-0 pl-0 pr-0 pt-0 link-text"
                                        data-filter="all">All</a> -->
                                    <a class="nav-link filter-button ml-0 pl-0 pr-0 pt-0 link-text active"
                                        data-filter="chord" id="active-filter">Chord packs</a>
                                    <a class="nav-link filter-button pl-0 pr-0 pt-0 link-text"
                                        data-filter="melody">Melody
                                        packs</a>
                                    <a class="nav-link filter-button pl-0 pr-0 pt-0 link-text" data-filter="drum">Drum
                                        packs</a>
                                    <a class="nav-link filter-button pl-0 pr-0 pt-0 link-text"
                                        data-filter="famous">Famous
                                        packs</a>
                                    <a class="nav-link filter-button pl-0 pr-0 pt-0 link-text"
                                        data-filter="advanced-scales">Advanced Scales 
                                        packs</a>
                                    <a class="nav-link pl-0 pr-0 pt-0 link-text genre-link" data-filter=""
                                        id="filter-dropdown-button" style="z-index: 200">
                                        <?php
                                            $terms2 = get_terms('pa_genre', array('hide_empty' => true));
                                            // print_r($terms2);
                                            $count = count($terms2);
                                            $genres = [];
                                            ?>
                                        <div class="genres filter-genre">
                                            <select class="default-usage-select" name="genres" onchange="getval(this);">
                                                <option class="option">Browse by genre</option>

                                                <?php
                                                    if ($count > 0) {
                                                        foreach ($terms2 as $term) {
                                                            echo '<option class="option" value="' . $term->slug .  '">' . $term->name . '</option>';
                                                            $genres[] = $term->slug;
                                                        }
                                                    }
                                                    ?>
                                            </select>
                                        </div>
                                    </a>
                                </div>
                            </nav>
                        </div>

                        <?php
                            $tax_query = array(
                                array(
                                    'taxonomy' => 'pa_genre',
                                    'field' => 'slug',
                                    'terms' => $genres,
                                    'operator' => 'in'
                                )
                            );
                            $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => -1,
                            'order' => 'desc',
                            'has_password' => false,
                            'tax_query' => $tax_query
                        );

                        $midi = new WP_Query($args); ?>
                        <div class="row m-0 products-row d-none" id="midi-pack-products">
                            <?php while ($midi->have_posts()) : $midi->the_post();
                                $genre = wp_get_post_terms($post->ID, 'pa_genre');
                                // print_r($genre);
                                    $product = wc_get_product($post->ID);
                                    $music = get_post_meta($post->ID, '_music', true);
                                    $cats = wp_get_post_terms($post->ID, 'product_cat');
                                    $product_cats = '';
                                    foreach ($cats as $cat) {
                                        $product_cats .= $cat->slug . ' ';
                                    }
                                ?>
                            <div class="col-xl-3 col-lg-3 col-sm-6 col-xs-6 p-0 filter samplepack-item <?php foreach ($genre as $genr) {
                                       echo $genr->slug . ' ';
                                    }; ?> <?php echo $product_cats; ?>"
                                style="z-index: 40">
                                <div class="card bg-transparent">
                                    <a href="<?php
                                                if (get_field('redirect_link', $post->ID)) {
                                                    echo get_field('redirect_link', $post->ID);
                                                } else {
                                                    echo the_permalink(); 
                                                }
                                            ?>">
                                        <div class="card-image">
                                            <img class="card-img img-fluid thumb"
                                                src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Image caption">
                                            <div class="image-overlay d-flex align-items-center justify-content-center">
                                                <div class="badge-pill product-cta-btn">Learn more
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="text-white front-card d-flex pb-3">
                                        <div class="single_product_play">
                                            <div class="play_single_audio">
                                                <a href="#" class="btn-play js-sound" data-file="<?php echo $music; ?>"
                                                    data-id="<?php echo $post->ID; ?>">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-10 p-0 align-self-center">
                                            <a href="<?php
                                                        if (get_field('redirect_link', $post->ID)) {
                                                            echo get_field('redirect_link', $post->ID);
                                                        } else {
                                                            echo get_the_permalink($item->ID); 
                                                        }
                                                    ?>" class="product-text">
                                                <?php 
                                                        $price = get_post_meta($post->ID, '_regular_price', true);
                                                        $sale_price = get_post_meta($post->ID, '_sale_price', true);
                                                    ?>
                                                <span class="js-product-price d-none"><?php echo $price ?></span>
                                                <span
                                                    class="js-product-sale-price d-none"><?php echo $sale_price ?></span>
                                                <p
                                                    class="front-card-title font-weight-bold text-truncate line-clamp js-title-samplepacks">
                                                    <?php echo the_title(); ?></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
function getval(sel) {
    console.log(sel.value);
    var show = sel.value;
    $('.filter').each(function() {

        if($(this).hasClass(show)) {
            $(this).show();
        } else {
            $(this).hide();
        }
        var test = $(this).attr('class');
        $(".genre-link").addClass('genre-link-active')
        $(".filter-button").removeClass('active')

        // if (test.indexOf(show) < 0) $(this).hide();

    });
}
$(".filter-button").click(function() {
    $(".genre-link").removeClass('genre-link-active')

});

$(window).on('load', function() {
    $('#active-filter').trigger('click');
    $('#midi-pack-products').removeClass('d-none');
});
</script>
<script>
</script>
<?php get_footer();