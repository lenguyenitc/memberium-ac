<?php
/*
 * Template Name: Free Packs
 *
 */

get_header();
global $post;
?>
<div class="jumbotron text-white page-section-title-py bg-light-blue-gradient">
    <div class="container pt-0 pb-0">
        <div class="row">
            <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 mx-auto col-md-11 col-sm-11 col-xs-11 p-0">
                <div class="col-xxxl-5 col-xxl-5 col-lg-5 p-0">
                    <h1><?php echo the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<main class="flex-grow-1 text-white">
    <section class="content front-cards-section front-cards-sec-v2">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-12 mx-auto p-0">
                    <div class="row m-0 products-row">
                        <?php wp_reset_query();
                            $free_packs = new WP_Query(
                                array(
                                    'post_type' => 'product',
                                    'posts_per_page' => -1,
                                    'orderby' => 'menu_order',
                                    'has_password' => false,
                                    'order' => 'desc',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'product_cat',
                                            'field' => 'slug',
                                            'terms' => 'free-packs'
                                        )
                                    )
                                )
                            );
                            while ($free_packs->have_posts()) : $free_packs->the_post();
                                $music = get_post_meta($post->ID, '_music', true); ?>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-6 p-0 samplepack-item samplepack-item-v2">
                            <div class="card bg-transparent ">
                                <div class="card-image">
                                    <a href="<?php
                                            if (get_field('redirect_link', $post->ID)) {
                                                echo get_field('redirect_link', $post->ID);
                                            } else {
                                                echo the_permalink(); 
                                            }
                                        ?>">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img class="card-img img-fluid thumb" src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="Image caption">
                                        <?php endif; ?>
                                        <div class="image-overlay d-flex align-items-center justify-content-center">
                                            <div class="badge-pill product-cta-btn">Get it free</div>
                                        </div>
                                    </a>
                                    <div class="play_single_audio">
                                        <a href="#" class="btn-play js-sound" data-file="<?php echo $music; ?>" data-id="<?php echo $post->ID; ?>"></a>
                                    </div>        
                                </div>
                                <div class="text-white front-card d-flex pb-3">
                                    <div class="col-10 p-0 align-self-center">
                                        <a href="<?php echo get_the_permalink($item->ID); ?>" class="product-text">
                                            <?php 
                                                $price = get_post_meta($post->ID, '_regular_price', true);
                                                $sale_price = get_post_meta($post->ID, '_sale_price', true);
                                            ?>
                                            
                                            <p class="front-card-title font-weight-bold text-truncate line-clamp js-title-samplepacks">
                                                <?php the_title(); ?>
                                            </p>
                                            <span class="js-product-price d-none"><?php echo $price ?></span>
                                            <span class="js-product-sale-price d-none"><?php echo $sale_price ?></span>
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
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
    </section>
</main>

<?php get_footer();