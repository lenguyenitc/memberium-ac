<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if (!defined('ABSPATH')) {
    exit;
}

//if ( $related_products ) : ?>
<!---->
<!--    <section class="related products">-->
<!---->
<!--        --><?php
//        $heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );
//
//        if ( $heading ) :
//            ?>
<!--            <h2>--><?php //echo esc_html( $heading ); ?><!--</h2>-->
<!--        --><?php //endif; ?>
<!---->
<!--        --><?php //woocommerce_product_loop_start(); ?>
<!---->
<!--        --><?php //foreach ( $related_products as $related_product ) : ?>
<!---->
<!--            --><?php
//            $post_object = get_post( $related_product->get_id() );
//
//            setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
//
//            wc_get_template_part( 'content', 'product' );
//            ?>
<!---->
<!--        --><?php //endforeach; ?>
<!---->
<!--        --><?php //woocommerce_product_loop_end(); ?>
<!---->
<!--    </section>-->
<?php
//endif;
//
//wp_reset_postdata();

global $product, $woocommerce_loop;

if (empty($product) || !$product->exists()) {
    return;
}

if (!$related = wc_get_related_products($product->id, $posts_per_page)) {
    return;
}

$args = apply_filters('woocommerce_related_products_args', array(
    'post_type' => 'product',
    'ignore_sticky_posts' => 1,
    'no_found_rows' => 1,
    'posts_per_page' => 500,
    'orderby' => $orderby,
    'post__in' => $related,
    'post__not_in' => array($product->id)
));

$products = new WP_Query($args);
$woocommerce_loop['name'] = 'related';
$woocommerce_loop['columns'] = apply_filters('woocommerce_related_products_columns', 500);

if ($products->have_posts()) : ?>

    <div id="samplepacks" class="samplepacks-detail">

        <h2><span class="l-ar"><?php _e('Similar Packs', 'woocommerce'); ?></span></h2>
        <div id="samplepack-slider" class="home-slide--wrap">
            <div class="home-slide">

                <?php while ($products->have_posts()) : $products->the_post(); ?>

                    <?php
                    if ($i == 0) {
                        echo '<div class="home-slide--item">
          <div class="samplepack-list js-samplepack-list">';
                    }
                    $i++;
                    ?>
                    <div <?php post_class("samplepack-item"); ?>>
                        <p>

                            <a href="<?php the_permalink(); ?>">
                                <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail();
                                } else {
                                    echo '<img src="' . get_bloginfo("template_url") . '/images/UnisonLogo.jpg" />';
                                }
                                ?>
                            </a>
                        </p>
                        <div class="copy">
                            <h4>

                                <a class="js-title-samplepacks" href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>


                                </a>
                            </h4>
                            <!--<h6>Afreaux</h6>-->
                            <p class="js-price-text">
                                <?php woocommerce_template_loop_price(); ?>
                            </p>
                            <?php
                            $downloads = $product->get_files();
                            echo "<div class='ctas'>";
                            foreach ($downloads as $key => $each_download) {
                                echo '<a href="#" class="btn-play js-sound" data-file="' . $each_download["file"] . '"></a>';
                            }
                            woocommerce_template_loop_add_to_cart();

                            echo '</div>';
                            ?>
                        </div>
                    </div>
                    <?php
                    if ($i == 6) {
                        echo '</div></div>';
                        $i = 0;
                    }
                    ?>

                <?php endwhile; // end of the loop. ?>

                <?php woocommerce_product_loop_end(); ?>

            </div>

        </div>
        <ul class="dash js-dot"></ul>
        <p class="max-width">
            <span class="btn-prev js-prev hidden-item"></span>
            <span class="btn-next js-next hidden-item"></span>
        </p>
    </div>

<?php endif;

wp_reset_postdata();
