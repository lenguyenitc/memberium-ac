<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.6.0
 */

defined('ABSPATH') || exit;

$order = wc_get_order($order_id);
// print_r($order);
if (!$order) {
    return;
}

$order_items = $order->get_items(apply_filters('woocommerce_purchase_order_item_types', 'line_item'));
$show_purchase_note = $order->has_status(apply_filters('woocommerce_purchase_note_order_statuses', array('completed', 'processing')));
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads = $order->get_downloadable_items();
$show_downloads = $order->has_downloadable_item() && $order->is_download_permitted();

if ($show_downloads) {

$post_ids = [];
global $wp;
$current_slug = $wp->request; ?>

<div class="mt-0">
    <p class="text-grey">Available Downloads</p>

    <?php foreach ($downloads as $download) :
        $post_ids[] = $download['product_id'];
        $product = wc_get_product($download['product_id']); ?>

        <div class="media align-items-center flex-column flex-sm-row mb-60">
            <div class="media-body">
                <div class="row align-items-center justify-content-center pr-0">
                    <div class="row col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left align-items-lg-center align-items-md-top mx-auto">
                        <div class="col-xxxl-2 col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-3 col-xs-3">
                            <img class="mr-0 mb-3 mr-sm-5 mb-sm-0"
                                 src="<?php echo get_the_post_thumbnail_url($download['product_id'], 'thumbnail') ?>"
                                 alt="Generic placeholder image">
                        </div>
                        <div class="row col-xxxl-10 col-xxl-10 col-xl-10 col-lg-10 col-md-9 col-sm-9 col-xs-9 p-0 text-left">
                            <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 text-left">
                                <h5 class="mt-0"><?php echo $download['download_name']; ?></h5>
                                <h6 class="font-weight-normal my-1"><?php echo $download['product_name']; ?></h6>
                                <p style="font-size:14px" class="product-activation-code">
                                    <?php 
                                    if (function_exists('get_activation_code')) {
                                        get_activation_code($order_id, $download['product_id']);
                                    }
                                    ?>
                                </p>
                                <p class="seven-rem"><?php echo $download['downloads_remaining']; ?> Downloads
                                    remaining</p>
                                <!-- <p class="price">$<?php echo $product->get_price(); ?></p> -->
                            </div>
                            <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6  col-md-12 col-sm-12 col-xs-12 text-lg-right text-md-left pr-0">
                                <a href="<?php echo $download['download_url'] ?>" class="btn-download">DOWNLOAD</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <p class="text-grey">Recommended for you</p>

    <?php
    global $post;

    $related = get_posts(
        array(
            'numberposts' => 2,
            'post__not_in' => $post_ids,
            'post_type' => 'product',
            'tax_query' => array(array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id', // can be 'term_id', 'slug' or 'name'
                'terms' => wp_get_post_terms(1828, 'product_cat', array('fields' => 'ids')),
            ),),
        )
    );
    if ($related) {
        foreach ($related as $post) {
            setup_postdata($post);
            $thumbnail = get_the_post_thumbnail_url($post->ID, 'thumbnail');
            $product = wc_get_product($post->ID);
            $permalink = get_the_permalink($post->ID);
            $title = get_the_title();
            $price = $product->get_price();
            ?>

            <div class="media align-items-center flex-column flex-sm-row mb-60">
                <div class="media-body">
                    <div class="row align-items-center justify-content-center pr-0">
                        <div class="row col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left align-items-lg-center align-items-md-top mx-auto">
                            <div class="col-xxxl-2 col-xxl-2 col-xl-2 col-lg-2  col-md-3 col-sm-3 col-xs-3">
                                <img class="mr-0" src="<?php echo $thumbnail; ?>" alt="Generic placeholder image">
                            </div>
                            <div class="row col-xxxl-10 col-xxl-10 col-xl-10 col-lg-10 col-md-9 col-sm-9 col-xs-9 p-0 text-left">
                                <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 text-left">
                                    <h5 class="mt-0"><?php echo $title; ?></h5>
                                    <h6 class="font-weight-normal my-1" style="font-size: 16px; ">Midi fundamentals</h6>
                                    <!-- <p class="price">$<?php echo $price; ?><span> -->
                                </div>
                                <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6  col-md-12 col-sm-12 col-xs-12 text-lg-right text-md-left pr-0">
                                    <a href="<?php echo $permalink; ?>" class="btn-empty-green">VIEW DETAILS</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        wp_reset_postdata();
    }
    }
    ?>

    <div class="col-xxxl-7 col-xxl-9 col-xl-9 col-lg-9  col-md-11 col-sm-11 col-xs-12 pl-0 pr-0">
        <?php do_action('woocommerce_order_details_before_order_table', $order); ?>

        <h3 class="woocommerce-order-details__title"><?php esc_html_e('Order details', 'woocommerce'); ?></h3>

        <table class="woocommerce-table woocommerce-table--order-details table order_details">

            <thead>
            <tr style="border-bottom: 1px solid #3C3C3C !important; padding-bottom: 5px; ">
                <th class="woocommerce-table__product-name py-4 table-white-small col-md-6 col-sm-6 col-xs-6"><?php esc_html_e('Product', 'woocommerce'); ?></th>
                <th class="woocommerce-table__product-table table-white-small mr-0"><?php esc_html_e('Price', 'woocommerce'); ?></th>
            </tr>
            </thead>

            <tbody>
            <?php
            do_action('woocommerce_order_details_before_order_table_items', $order);

            foreach ($order_items as $item_id => $item) {
                $product = $item->get_product();

                wc_get_template(
                    'order/order-details-item.php',
                    array(
                        'order' => $order,
                        'item_id' => $item_id,
                        'item' => $item,
                        'show_purchase_note' => $show_purchase_note,
                        'purchase_note' => $product ? $product->get_purchase_note() : '',
                        'product' => $product,
                    )
                );
            }

            do_action('woocommerce_order_details_after_order_table_items', $order);
            ?>
            </tbody>

            <tfoot>
            <?php
            foreach ($order->get_order_item_totals() as $key => $total) {
                ?>
                <tr <?php echo ($key != 'order_total') ? "style='border-bottom: 1px solid #3C3C3C; padding-bottom: 5px;'" : "" ?>>
                    <th class="py-4 <?php echo ($key != 'order_total') ? "table-white-small" : "table-white-big" ?>"
                        scope="row"><?php echo esc_html($total['label']); ?></th>
                    <td class="<?php echo ($key != 'order_total') ? "table-grey" : "table-white-big" ?>"><?php echo ('payment_method' === $key) ? esc_html($total['value']) : wp_kses_post($total['value']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                </tr>
                <?php
            }
            ?>
            <?php if ($order->get_customer_note()) : ?>
                <tr>
                    <th><?php esc_html_e('Note:', 'woocommerce'); ?></th>
                    <td><?php echo wp_kses_post(nl2br(wptexturize($order->get_customer_note()))); ?></td>
                </tr>
            <?php endif; ?>
            </tfoot>
        </table>

        <?php do_action('woocommerce_order_details_after_order_table', $order); ?>
    </div>

    <?php
    /**
     * Action hook fired after the order details.
     *
     * @param WC_Order $order Order data.
     *
     * @since 4.4.0
     */
    do_action('woocommerce_after_order_details', $order);

    if ($show_customer_details) {
        wc_get_template('order/order-details-customer.php', array('order' => $order));
    } ?>

    <a class="badge badge-success btn-access" href="/my-account/downloads/">Access Your Downloads Now</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>