<?php

/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $product, $post;
?>

<?php

$downloads = $product->get_downloads();
$product_download = get_post_meta($post->ID, '_downloadable', true);
$product_price = get_post_meta($post->ID, '_price', true);
$price = get_post_meta($post->ID, '_regular_price', true);
$sale_price = get_post_meta($post->ID, '_sale_price', true);


if ($sale_price) {
    echo '<div class="d-flex align-items-top mt-2"><span class="mr-1 price-warning"><s>' . ($price === "0" ? 'FREE' : '$' . $price) . '</s></span><span class="text-left green-text">' . ($sale_price === "0" ? 'FREE' : '$' . $sale_price) . '</span></div>';
    echo '<span class="js-product-price d-none">' . $price . '</span>';
    echo '<span class="js-product-sale-price d-none">' . $sale_price . '</span>';
    echo '<span style="display:none;" class="price">$' . $sale_price . '</span>';
} elseif ($price === "0") {
    echo '<p class="text-left green-text mt-2">FREE</span></p>';
    echo '<span class="js-product-price d-none">' . $price . '</span>';
} else {
    echo '<p class="price text-left green-text mt-2">$<span class="js-product-price">' . $price . '</span></p>';
}

echo "<div class='cta'>";
$music = get_post_meta($post->ID, '_music', true);
echo '<div class="play-border"><div class="single_product_play"><div class="play_single_audio"><a href="546" class="btn-play js-sound" data-file="' . $music . '" data-id="' . $post->ID . '"></a></div></div><span class="play-text p-0" style="display: inline-block; line-height: initial; z-index: 100;">Play demo</span></div>';

echo '<div class="btn-big">';

if ($product->is_in_stock()) : ?>

    <?php do_action('woocommerce_before_add_to_cart_form'); ?>

    <form class="cart text-left" method="post" enctype='multipart/form-data'>
        <?php do_action('woocommerce_before_add_to_cart_button'); ?>

        <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($post->ID); ?>" />

        <button type="submit" class="btn-individual-product align-items-end btn-add add_cart_btn btn-add badge-success"><i class="fa fa-shopping-cart" style="margin-right: 10px;"></i><?php echo esc_html($product->single_add_to_cart_text()); ?><?php if ($price === '0') echo ' FREE'; ?></button>

        <?php do_action('woocommerce_after_add_to_cart_button'); ?>
    </form>

    <?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif;
echo '</div>'; ?>
<?php echo '</div>'; ?>
</div>
</div>
</div>


<?php if ($product->is_in_stock()) : ?>

    <form class="cart text-center cta-mobile" method="post" enctype='multipart/form-data'>
        <?php do_action('woocommerce_before_add_to_cart_button'); ?>
        <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($post->ID); ?>" />
        <button type="submit" class="btn-individual-product align-items-end btn-add add_cart_btn btn-add badge-success">
            <i class="fa fa-shopping-cart" style="margin-right: 10px;"></i>
            <?php echo esc_html($product->single_add_to_cart_text()); ?><?php if ($price === '0') echo ' FREE'; ?>
        </button>

        <?php do_action('woocommerce_after_add_to_cart_button'); ?>

        <?php do_action('woocommerce_after_add_to_cart_button'); ?>
    </form>

    <?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif; ?>