<?php
/*
 * Template Name: Preset Banks
 *
 */

get_header();
global $post;
?>

<div class="jumbotron preset-banks text-white bg-light-blue-gradient">
    <div class="container">
        <div class="row">
            <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-12 mx-auto  p-0">
                <h1><?php echo get_the_title(); ?></h1>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>
<main class="flex-grow-1">
    <section class="p-0 front-cards-section front-cards-sec-v2">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-12 mx-auto p-0">
                    <h3 class="featured-title">Featured</h3>
                    <div class="row m-0 products-row">
                        <?php
                        $featured_products = get_field('featured_product_list');
                        foreach ($featured_products as $featured_product) :
                        $music = get_post_meta($featured_product->ID, '_music', true); ?>
                        <div class="col-xxxl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6 p-0 samplepack-item samplepack-item-v2">
                            <div class="card bg-transparent">
                                <div class="card-image">
                                    <?php if (has_post_thumbnail($featured_product->ID)) : ?>
                                        <a href="<?php echo get_the_permalink($featured_product->ID); ?>">
                                            <img class="card-img img-fluid thumb" src="<?php echo get_the_post_thumbnail_url($featured_product->ID); ?>" alt="Image caption">
                                            <div class="image-overlay d-flex align-items-center justify-content-center">
                                                <div class="badge-pill product-cta-btn" data-product_title="Unison MIDI Chord Pack" data-quantity="1" data-product_id="1828" data-product_sku="">Learn more</div>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                    <div class="play_single_audio">
                                        <a href="#" class="btn-play js-sound" data-file="<?php echo $music; ?>" data-id="<?php echo $featured_product->ID; ?>"></a>
                                    </div>
                                </div>
                                <div class="d-flex text-white front-card pb-3">
                                    <!-- <div class="single_product_play">
                                        <div class="play_single_audio">
                                            <a href="<?php the_permalink(); ?>" class="btn-play js-sound"
                                                data-file="<?php echo $music ?>"
                                                data-id="<?php echo $featured_product->ID ?>">
                                            </a>
                                        </div>
                                    </div> -->
                                    <div class="col-10 p-0 align-self-center">
                                        <a href="<?php echo get_the_permalink($featured_product->ID); ?>" class="product-text">
                                            <?php 
                                            $price = get_post_meta($featured_product->ID, '_regular_price', true);
                                            $sale_price = get_post_meta($featured_product->ID, '_sale_price', true);
                                            $category_name = get_post_meta($featured_product->ID, 'category_name', true);
                                        ?>
                                            <p class="front-card-title font-weight-bold text-truncate line-clamp js-title-samplepacks">
                                                <?php echo get_the_title($featured_product->ID); ?>
                                            </p>
                                            <p class="pack_price_row <?php if($sale_price){ echo 'wgt-sale';}?>">
                                            <span class="js-price">$<span class="js-product-price"><?php echo $price ?></span></span>
                                            <?php
                                            if($sale_price)
                                            {
                                            ?>
                                                <span class="js-sale-price">$<span class="js-product-sale-price"><?php echo $sale_price ?></span></span>
                                           <?php
                                            }
                                            ?>
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- Filter -->
                    <div class="filter-section">
                        <nav class="nav border-bottom-nav-tabs w-100 justify-content-center text-uppercase">
                            <a class="nav-link filter-button preset active" data-filter="all">All</a>
                            <a class="nav-link filter-button preset" data-filter="serum">Serum</a>
                            <a class="nav-link filter-button preset" data-filter="omnisphere">Omnisphere</a>
                        </nav>
                    </div>
                    <div class="row m-0 products-row">
                        <?php
                        $products = new WP_Query(array(
                            'post_type' => 'product',
                            'posts_per_page' => -1,
                            'order' => 'desc',
                            'has_password' => false,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field' => 'slug',
                                    'terms' => array('serum', 'omnisphere')
                                )
                            )
                        ));

                        while ($products->have_posts()) : $products->the_post();
                            $cats = wp_get_post_terms($post->ID, 'product_cat');
                            $product = wc_get_product($post->ID);
                            $music = get_post_meta($post->ID, '_music', true);
                            $product_cats = '';
                            foreach ($cats as $cat) {
                                $product_cats .= $cat->slug . ' ';
                            } ?>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-6 p-0 filter samplepack-item samplepack-item-v2 <?php echo $product_cats; ?>">
                            <div class="card bg-transparent">
                                <div class="card-image">
                                    <a href="<?php
                                            if (get_field('redirect_link', $post->ID)) {
                                                echo get_field('redirect_link', $post->ID);
                                            } else {
                                                echo the_permalink(); 
                                            }
                                        ?>">
                                        <img class="card-img img-fluid thumb" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Image caption">
                                        <div class="image-overlay d-flex align-items-center justify-content-center">
                                            <div class="badge-pill product-cta-btn" data-product_title="Unison MIDI Chord Pack" data-quantity="1" data-product_id="1828" data-product_sku="">Learn more</div>
                                        </div>
                                    </a>
                                    <div class="play_single_audio">
                                        <a href="#" class="btn-play js-sound" data-file="<?php echo $music; ?>" data-id="<?php echo $post->ID;?>"></a>
                                    </div>
                                </div>
                                <div class="text-white front-card d-flex pb-3">
                                    <!-- <div class="single_product_play">
                                        <div class="play_single_audio">
                                            <a href="#" class="btn-play js-sound" data-file="<?php echo $music; ?>"
                                                data-id="<?php echo $post->ID; ?>">
                                            </a>
                                        </div>
                                    </div> -->
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
                                            <p class="front-card-title font-weight-bold text-truncate line-clamp js-title-samplepacks">
                                                <?php echo the_title(); ?>       
                                            </p>

                                            <p class="pack_price_row <?php if($sale_price){ echo 'wgt-sale';}?>">
                                            <span class="js-price">$<span class="js-product-price"><?php echo $price ?></span></span>
                                            <?php
                                            if($sale_price)
                                            {
                                            ?>
                                                <span class="js-sale-price">$<span class="js-product-sale-price"><?php echo $sale_price ?></span></span>
                                           <?php
                                            }
                                            ?>
                                            </p>                                           
                                            
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="promo-section"
        style="background-image: url(<?php bloginfo('template_url')?>/assets/images/promo-background.png);">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-12 mx-auto">
                    <div
                        class="row flex-xs-column-reverse flex-sm-column-reverse flex-lg-row d-flex justify-content-between">
                        <div class="col-lg-6 col-xs-12">
                            <div class="h-100 d-flex flex-column bg-transparent justify-content-between">
                                <h2><?php echo get_field('title', $post->ID); ?></h2>
                                <!--                                <h2>Get The Entire Collection & <br><span class="text-gradient-bg">Save 58% Off</h2>-->
                                <p class="text-white promo-section-text"><?php echo get_field('text', $post->ID); ?></p>
                                <div class="row flex-xs-column-reverse flex-sm-column-reverse flex-lg-row">
                                    <div class="col-lg-6 col-12 primary-button text-center text-lg-left">
                                        <a href="<?php echo get_field('button_link', $post->ID); ?>"
                                            class="badge badge-success learn-more promo-badge-pill"><?php echo get_field('button_text', $post->ID); ?></a>
                                    </div>
                                    <div class="col-xxxl-5 col-lg-6 col-12 prices mb-4 mb-sm-0 pr-xxxl-5 d-flex flex-sm-row">
                                        <p class="price-warning">
                                            <s>$<?php echo get_field('sale_price', $post->ID); ?></s>
                                        </p>
                                        <p class="price text-white font-weight-bold">
                                            $<?php echo get_field('sale_sale_price', $post->ID); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12 text-center text-lg-right">
                            <img class="img-fluid promo-image" src="<?php echo get_field('image', $post->ID)['url']?>"
                                alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>