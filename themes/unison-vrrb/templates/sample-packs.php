<?php
/*
 * Template Name: Sample Packs
 *
 * */

get_header();
global $post, $product;
?>

<div class="jumbotron sample-packs text-white bg-light-blue-gradient">
    <div class="container">
        <div class="row">
            <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-xs-12 mx-auto p-0">
                <h1><?php echo the_title(); ?></h1>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>

<main class="flex-grow-1 p-0">
    <section class="p-0 front-cards-section front-cards-sec-v2">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-12 mx-auto p-0">
                    <h3 class="featured-title">Featured</h3>
                    <div class="row m-0 products-row">
                        <?php
                            wp_reset_query();
                        $featured_products = get_field('featured_product_list');
                        if ($featured_products) :
                        foreach ($featured_products as $featured_product) :
                            $music = get_post_meta($featured_product->ID, '_music', true); ?>
                        <div class="col-xxxl-4 col-lg-4 col-sm-6 col-xs-6 p-0 samplepack-item samplepack-item-v2">
                            <div class="card bg-transparent">
                                <div class="card-image">
                                    <a href="<?php echo get_the_permalink($featured_product->ID); ?>">
                                        <?php if (has_post_thumbnail($featured_product->ID)) : ?>
                                            <img class="card-img img-fluid thumb" src="<?php echo get_the_post_thumbnail_url($featured_product->ID); ?>" alt="Image caption">
                                        <?php endif; ?>
                                        <div class="image-overlay d-flex align-items-center justify-content-center">
                                            <div class="badge-pill product-cta-btn-big"
                                                data-product_title="<?php echo get_the_title($featured_product->ID); ?>"
                                                data-quantity="1" data-product_id="<?php echo $featured_product->ID ?>"
                                                data-product_sku="">
                                                Learn more
                                            </div>
                                        </div>
                                    </a>
                                    <div class="play_single_audio">
                                        <a href="<?php echo get_the_permalink($featured_product->ID); ?>" class="btn-play js-sound" data-file="<?php echo $music; ?>" data-id="<?php echo $featured_product->ID; ?>"></a>
                                    </div>
                                </div>
                                <div class="text-white front-card d-flex pb-3">
                                    <div class="col-10 p-0 align-self-center">
                                        <a href="<?php echo get_the_permalink($featured_product->ID); ?>" class="product-text">
                                            <?php
                                            $price = get_post_meta($featured_product->ID, '_regular_price', true);
                                            $sale_price = get_post_meta($featured_product->ID, '_sale_price', true);
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
                        <?php endforeach;
                        endif; ?>
                    </div>
                    <!-- Filter -->
                    <div class="filter-section">
                        <nav class="nav border-bottom-nav-tabs w-100 justify-content-center text-uppercase">
                            <!-- <a class="nav-link filter-button sample active" data-filter="all">All</a> -->
                            <a class="nav-link filter-button sample active" data-filter="artists-series" id="active-filter">Artist series</a>
                            <a class="nav-link filter-button sample" data-filter="vocal-series">Vocal series</a>
                            <a class="nav-link filter-button sample" data-filter="sample-packs">Unison originals</a>
                        </nav>
                    </div>
                    <div class="row m-0 products-row pb-5 d-none" id="sample-packs-products">
                        <?php
                            wp_reset_query();
                            $cats = ['sample-packs', 'artists-series', 'vocal-series'];

                            $filter_sample_packs = new WP_Query(array(
                                'post_type' => 'product',
                                'posts_per_page' => -1,
                                'order' => 'desc',
                                'has_password' => false,
                                'meta_key' => '_price',
                                'meta_value' => 0,
                                'meta_compare' => '!=',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'product_cat',
                                        'field' => 'slug',
                                        'terms' => $cats
                                    )
                                )
                            ));

                            while ($filter_sample_packs->have_posts()) : $filter_sample_packs->the_post();
                                $current_cat = '';

                                foreach (wc_get_product_terms(get_the_ID(), 'product_cat') as $term) {
                                    if (in_array($term->slug, $cats)) {
                                        $current_cat = $term->slug;
                                    }
                                }
                                $music = get_post_meta($post->ID, '_music', true); ?>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-6 p-0 filter samplepack-item samplepack-item-v2 <?php echo $current_cat; ?>">
                            <div class="card bg-transparent">
                                <?php if (has_post_thumbnail($post->ID)) : ?>
                                <div class="card-image">    
                                    <a href="<?php
                                        if (get_field('redirect_link', $post->ID)) {
                                            echo get_field('redirect_link', $post->ID);
                                        } else {
                                            echo the_permalink(); 
                                        }
                                    ?>">
                                        <img class="card-img img-fluid thumb" src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="Image caption">
                                        <div class="image-overlay d-flex align-items-center justify-content-center">
                                            <div class="badge-pill product-cta-btn">Learn more</div>
                                        </div>
                                    </a>
                                    <div class="play_single_audio">
                                        <a href="<?php the_permalink(); ?>" class="btn-play js-sound" data-file="<?php echo $music ?>" data-id="<?php echo $post->ID; ?>"></a>
                                    </div>
                                </div>
                                <?php else : ?>
                                <div class="card-image">
                                    <a href="<?php
                                        if (get_field('redirect_link', $post->ID)) {
                                            echo get_field('redirect_link', $post->ID);
                                        } else {
                                            echo the_permalink(); 
                                        }
                                    ?>">
                                        <img class="card-img img-fluid" src="<?php bloginfo('template_url')?>/assets/images/Rectangle%2025-1.jpg" alt="Image caption">
                                        <div class="image-overlay d-flex align-items-center justify-content-center">
                                            <div class="badge-pill product-cta-btn">Learn more</div>
                                        </div>
                                    </a>
                                    <div class="play_single_audio">
                                        <a href="<?php the_permalink(); ?>" class="btn-play js-sound" data-file="<?php echo $music ?>" data-id="<?php echo $post->ID; ?>"></a>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="d-flex text-white front-card pb-3">
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
                                                <?php the_title(); ?>
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
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-purple-gradient promo-section">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-12 mx-auto">
                    <div
                        class="row flex-xs-column-reverse flex-sm-column-reverse flex-lg-row d-flex justify-content-between">
                        <div class="col-lg-6 col-xs-12">
                            <div class="h-100 d-flex flex-column bg-transparent justify-content-between">
                                <h2><?php echo get_field('title', $post->ID); ?></h2>
                                <!--                                <h2>Get The Entire Collection & <span class="text-gradient-bg">Save Over 55%</span></h2>-->
                                <p class="text-white promo-section-text"><?php echo get_field('text', $post->ID); ?></p>
                                <div class="row flex-xs-column-reverse flex-sm-column-reverse flex-lg-row">
                                    <div class="col-lg-6 col-12 primary-button text-center text-lg-left">
                                        <a href="<?php echo get_field('button_link', $post->ID); ?>"
                                            class="badge badge-success learn-more promo-badge-pill"><?php echo get_field('button_text', $post->ID); ?></a>
                                    </div>
                                    <div class="col-xxxl-5 col-lg-6 col-12 prices mb-4 mb-sm-0 pr-xxxl-5 d-flex flex-sm-row ">
                                        <p class="price-warning">
                                            <s><?php echo get_field('sale_price', $post->ID); ?></s>
                                        </p>
                                        <p class="price text-white font-weight-bold">
                                            <?php echo get_field('sale_sale_price', $post->ID); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12 text-center text-lg-right">
                            <img class="img-fluid promo-image"
                                src="<?php bloginfo('template_url')?>/assets/images/sample-packs-entire-colection.png"
                                alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    jQuery('.generate-deals').on('click', function() {
        let data = {
            'action': 'get_coupon_for_user_action',
            'user': '<?php echo get_current_user_id(); ?>',
        };
        jQuery.ajax({
            type: 'post',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: data,
            beforeSend: function() {},
            success: function(response) {
                let coupon = response.coupon;

                if (coupon.length > 0) {
                    alert('Congratulation, your coupon code is ' + response.coupon +
                        '. You can generate another one in a week!');
                } else {
                    alert(response.message);
                }
            }
        });
    });

    $(window).on('load', function() {
        $('#active-filter').trigger('click');
        $('#sample-packs-products').removeClass('d-none');
    });

</script>
<?php
get_footer();