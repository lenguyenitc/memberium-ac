<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $post;

$short_description = apply_filters('woocommerce_short_description', $post->post_excerpt);

if (!$short_description) {
    return;
}

?>
</div>
<div class="cl"></div>
<div class="copy" itemprop="description">
    <?php echo $short_description; // WPCS: XSS ok. ?>
    <?php
    $facebook = get_post_meta($post->ID, '_facebook', true);
    $twitter = get_post_meta($post->ID, '_twitter', true);
    $soundcloud = get_post_meta($post->ID, '_soundcloud', true);
    $spotify = get_post_meta($post->ID, '_spotify', true);

    if ($facebook) {
        echo '<a href="' . $facebook . '" target="_blank" class="soc-custom facebook"></a>';
    }
    if ($twitter) {
        echo '<a href="' . $twitter . '" target="_blank" class="soc-custom twitter"></a>';
    }
    if ($soundcloud) {
        echo '<a href="' . $soundcloud . '" target="_blank" class="soc-custom soundcloud"></a>';
    }
    if ($spotify) {
        echo '<a href="' . $spotify . '" target="_blank" class="soc-custom spotify"></a>';
    }

    ?>
</div>
