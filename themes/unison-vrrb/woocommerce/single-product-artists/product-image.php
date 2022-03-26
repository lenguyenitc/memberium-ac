<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.6.3
 */

if (!defined('ABSPATH')) {
    exit;
}

global $post, $product;
?>
<div class="jumbotron text-white bg-white m-0"
     style="background: url(
     <?php
     $background_image = get_field('background_image', $post->ID);
     if (!empty($background_image) && $background_image != '') {
         echo get_field('background_image', $post->ID);
     } else {
         echo get_bloginfo("template_url") . '/assets/images/banner.jpg';
     } ?>);
             background-repeat: no-repeat;
             background-position: center;
             background-size: cover;">

    <div class="container">
        <div class="col-12 p-0">
            <div class="col-xl-9 col-lg-10 col-sm-11 col-md-11 col-xs-12 text-center mx-auto p-0">
                <div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>"
                     id="product-<?php the_ID(); ?>" <?php post_class("artist-detail"); ?>>
                    <?php $new_desc = get_post_meta(get_the_ID(), 'unison_product_short_description', true);
                    if (isset($new_desc) && $new_desc != '') { ?>
                        <h3>
                            <?php echo get_post_meta(get_the_ID(), 'unison_product_short_description', true); ?>
                        </h3>
                    <?php } ?>
                    <div class="row">
                        <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right p-0 border-white ">
                            <?php
                            if (has_post_thumbnail()) {
                                $attachment_count = count($product->get_gallery_attachment_ids());
                                $gallery = $attachment_count > 0 ? '[product-gallery]' : '';
                                $props = wc_get_product_attachment_props(get_post_thumbnail_id(), $post);
                                $image = get_the_post_thumbnail($post->ID, apply_filters('single_product_large_thumbnail_size', 'shop_single'), array(
                                    'title' => $props['title'],
                                    'alt' => $props['alt'],
                                    'class' => 'img-fluid img-tier',
                                ));
                                echo apply_filters(
                                    'woocommerce_single_product_image_html',
                                    sprintf('%s', $image),
                                    $post->ID
                                );
                            } else {
                                echo apply_filters('woocommerce_single_product_image_html', sprintf('<img src="' .
                                    get_bloginfo('template_url') . '/images/UnisonLogo.jpg" class="img-fluid img-tier" alt="%s" />', wc_placeholder_img_src(), __('Placeholder', 'woocommerce')), $post->ID);
                            }

                            do_action('woocommerce_product_thumbnails');
                            ?>
                        </div>
