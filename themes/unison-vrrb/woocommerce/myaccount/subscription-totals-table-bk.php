<?php
/**
 * Subscription details table
 *
 * @author  Prospress
 * @package WooCommerce_Subscription/Templates
 * @since 2.6.0
 * @version 2.6.0
 */
global $woocommerce, $wpdb;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
foreach ($subscription->get_items() as $item_id => $item) {
    $_product = apply_filters('woocommerce_subscriptions_order_item_product', $item->get_product(), $item);
    $is_switched = wcs_is_product_switchable_type($_product);
    $attributes = array_filter( $_product->get_attributes(), 'wc_attributes_array_filter_visible' );
    $upgrade_downgrade_button = WC_Subscriptions_Switcher::get_switch_url($item_id, $item, $subscription);

if ($is_switched) :
    $variations = get_variations_for_product($item['product_id']);
    $min_variation = get_post_meta($item['product_id'], '_min_variation_regular_price');
    $max_variation = get_post_meta($item['product_id'], '_max_variation_regular_price');
    $min_variation_period = get_post_meta($item['product_id'], '_min_variation_period');
    $max_variation_period = get_post_meta($item['product_id'], '_max_variation_period');
    ?>

<!--MODAL CHANGE BILLING PLAN-->
<div class="modal-overlay closed" id="modal-overlay"></div>
<div class="modal-change-plan closed" id="modal-change-plan">
    <div class="modal-guts">
        <img class="img-fluid pointer close" src="<?php bloginfo('template_url') ?>/assets/images/close-icon.png"
            id='close-x' style="min-width: 15px !important">
        <div class="col-xxxl-5 col-xxl-12 col-xl-12 col-lg-12 mt-6 mx-auto align-items-center text-center">
            <h3 class="p-0">Change Plan</h3>
            <p class="title">Whether you're just starting out or want to produce like a pro, there's a plan for you.
            </p>
        </div>
        <div class="col-xxxl-12 row mx-auto align-items-center justify-content-between text-center p-0">
            <?php foreach ($variations as $key => $variation) :
            $title = explode(':', $variation->post_excerpt);
            $regular_price = get_post_meta($variation->ID, '_regular_price');
            $sale_price = get_post_meta($variation->ID, '_sale_price');

            if ($sale_price) {
                $price = $sale_price;
            } else {
                $price = $regular_price;
            }
            if ($price[0] == $min_variation[0]) : ?>
            <div class="card-green green-glow" id="cardGreen">
                <?php elseif ($price[0] == $max_variation[0]) : ?>
                <div class="card-white green-glow">
                    <?php else : ?>
                    <div class="card-blue green-glow">
                        <?php endif; ?>
                        <div class="text-content text-center mt-0 pt-0" style="height: 100%">
                            <div class='col-12 row mx-auto align-items-center text-center justify-content-center'>
                                <img src="<?php bloginfo('template_url') ?>/assets/images/Tier group midi3.svg"
                                    alt="Tier 1" class="tier1">
                                <h4 class="title-card"><?php echo $title[1]; ?></h4>
                            </div>
                            <p
                                class="<?php if ($price[0] != $max_variation[0]) echo 'text-white';?> pt-0 font-weight-bold p1 subtitle">
                                Here's What <span style="color: #01BFA6;"> You'll Get: </span></p>
                            <div class="<?php if ($price[0] == $min_variation[0]) {
                                echo 'card-green-opacity text-white';
                            } elseif ($price[0] == $max_variation[0]) {
                                echo 'card-blue-linear';
                            } else {
                                echo 'bg-opacity text-white card-blue-opacity';
                            } ?> ">

                                <div
                                    class="row col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 m-0 p-0 align-items-top">
                                    <div class="col-xxxl-1 col-xxl-1 col-xl-1 col-lg-1 col-md-1 col-sm-1 col-xs-1 pl-0"
                                        style="font-size: 20px; margin-right: 10.5px">
                                        <img src="<?php bloginfo('template_url') ?>/assets/images/check white.png" style="min-width: 15px !important">
                                    </div>
                                    <div
                                        class="col-xxxl-6 col-xxl-10 col-xl-10  col-lg-10  col-md-10 col-sm-10 col-xs-10 text-left p-0">
                                        <p class="text-white midis-month">MIDI BOX</p>
                                        <p class="text-white midis-month">(200 MIDI's/month)</p>
                                    </div>
                                </div>
                                <ul class="row  justify-content-between m-0 p-0" style="width: 100%">
                                    <div class="col-xxxl-7 col-xxl-12 col-xl-12 col-lg-12 mt-6 pr-0 mr-0 ml-0 pl-0">
                                        <li class="text-white  text-left m-0 align-items-center"><i
                                                class="fa fa-circle"></i>48 Chord Progressions</li>
                                    </div>


                                    <div class="col-xxxl-5 col-xxl-12 col-xl-12 col-lg-12  mt-6 m-0 p-0">
                                        <li class="text-white text-left p-0">
                                            <i class="fa fa-circle"></i>48 Melodies
                                        </li>
                                    </div>
                                    <div class="col-xxxl-7 col-xxl-12 col-xl-12 col-lg-12 mt-6 pr-0 mr-0 ml-0 pl-0">
                                        <li class="text-white text-left m-0 p-0 mt-10"><i class="fa fa-circle"></i>48
                                            Basslines
                                        </li>
                                    </div>
                                    <div class="col-xxxl-5 col-xxl-12 col-xl-12 col-lg-12  mt-6 pr-0 mr-0 ml-0 pl-0">
                                        <li class="text-white  text-left m-0 p-0 mt-10"><i class="fa fa-circle"></i>56
                                            Drum Patterns
                                        </li>
                                    </div>
                                </ul>
                            </div>

                        </div>
<!--                        --><?php //$sale_price = get_post_meta($variation->ID, '_sale_price'); ?>
                        <div class="radio-item">
                            <input class="product_variation" type="radio" id="ritem<?php echo ($key+1); ?>" name="ritem"
                                data-product-id="<?php echo $variation->ID; ?>" data-price="<?php echo $price[0] ?>" value="<?php echo $title[1]; ?>">
<!--                            <input type="hidden" class="sale_price" value="--><?php //echo $sale_price[0] ?><!--">-->
                            <label class="mb-0 pointer" for="ritem<?php echo ($key+1); ?>"></label>
                        </div>

                    </div>
                    <?php endforeach; ?>
                </div>
                <div class=" col-xxxl-4 col-xxl-7 col-xl-7 col-lg-10 col-md-12 col-xs-11 col-sm-12 mx-auto align-items-bottom text-center justify-content-between"
                    style="margin-top: 15px !important;">
                    <div class="row  align-items-center">
                        <p class="text-white  text-left previous-price mx-auto p-0">
                            From:
                            $<?php echo $min_variation[0]; ?>/<?php echo $min_variation_period[0]; ?>>$<?php echo $max_variation[0]; ?><?php echo $max_variation_period[0]; ?>
                        </p>
                        <p class="text-white text-left pr-0 white-text mx-auto p-0">
                            DUE TODAY: <span class="p1 font-weight-bold green-text new_sale_price"></span>
                        </p>
                    </div>
                </div>

                <div class="col-xxxl-6 col-xxl-6 text-center mx-auto  mt-xl-0 pr-0 pl-0">
                    <?php do_action('woocommerce_before_add_to_cart_form'); ?>

                    <form class="update-plan" method="post" enctype='multipart/form-data'>
                        <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($item['product_id']); ?>"/>
                        <input type="hidden" id="variation" name="variation_id" value=""/>
                        <button type="submit" class="mx-auto btn-update">UPDATE PLAN</button>
                    </form>

                </div>
                <div
                    class="col-xxxl-5 col-xxl-12 col-xl-12 col-lg-12 mt-6  text-white text-center mx-auto  mt-3 mt-xl-0 p-0">
                    <p class='mx-auto text-small'>
                        You'll get instant access to your new plan's <?php echo date('F'); ?> MIDI Box and your recurring billing
                        date will be changed to the <?php echo date('jS'); ?> of each month.
                    </p>
                </div>
            </div>
        </div>
        <?php endif;
} ?>

        <table class="shop_table order_details">
            <thead>
                <tr>
                    <?php if ($allow_item_removal) : ?>
                    <th class="product-remove" style="width: 3em;">&nbsp;</th>
                    <?php endif; ?>
                    <th class="product-name">
                        <?php echo esc_html_x('Product', 'table headings in notification email', 'woocommerce-subscriptions'); ?>
                    </th>
                    <th class="product-total">
                        <?php echo esc_html_x('Total', 'table heading', 'woocommerce-subscriptions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
    foreach ($subscription->get_items() as $item_id => $item) {
        $_product = apply_filters('woocommerce_subscriptions_order_item_product', $item->get_product(), $item);
        $is_switched = WC_Subscriptions_Switcher::is_product_of_switchable_type($_product);
        $switch_text = get_option(WC_Subscriptions_Admin::$option_prefix . '_switch_button_text', __('Upgrade or Downgrade', 'woocommerce-subscriptions'));
        $upgrade_downgrade_button = WC_Subscriptions_Switcher::get_switch_url($item_id, $item, $subscription);

        if (apply_filters('woocommerce_order_item_visible', true, $item)) { ?>
                <tr
                    class="<?php echo esc_attr(apply_filters('woocommerce_order_item_class', 'order_item', $item, $subscription)); ?>">
                    <?php if ($allow_item_removal) : ?>
                    <td class="remove_item">
                        <?php if (wcs_can_item_be_removed($item, $subscription)) : ?>
                        <?php $confirm_notice = apply_filters('woocommerce_subscriptions_order_item_remove_confirmation_text', __('Are you sure you want remove this item from your subscription?', 'woocommerce-subscriptions'), $item, $_product, $subscription); ?>
                        <a href="<?php echo esc_url(WCS_Remove_Item::get_remove_url($subscription->get_id(), $item_id)); ?>"
                            class="remove"
                            onclick="return confirm('<?php printf(esc_html($confirm_notice)); ?>');">&times;</a>
                        <?php endif; ?>
                    </td>
                    <?php endif; ?>
                    <td class="product-name">
                        <?php
                    if ($_product && !$_product->is_visible()) {
                        echo wp_kses_post(apply_filters('woocommerce_order_item_name', $item['name'], $item, false));
                    } else {
                        echo wp_kses_post(apply_filters('woocommerce_order_item_name', sprintf('<a href="%s">%s</a>', get_permalink($item['product_id']), $item['name']), $item, false));
                    }

                    echo wp_kses_post(apply_filters('woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf('&times; %s', $item['qty']) . '</strong>', $item));

                    /**
                     * Allow other plugins to add additional product information here.
                     *
                     * @param int $item_id The subscription line item ID.
                     * @param WC_Order_Item|array $item The subscription line item.
                     * @param WC_Subscription $subscription The subscription.
                     * @param bool $plain_text Wether the item meta is being generated in a plain text context.
                     */
                    do_action('woocommerce_order_item_meta_start', $item_id, $item, $subscription, false);

                    wcs_display_item_meta($item, $subscription);

                    /**
                     * Allow other plugins to add additional product information here.
                     *
                     * @param int $item_id The subscription line item ID.
                     * @param WC_Order_Item|array $item The subscription line item.
                     * @param WC_Subscription $subscription The subscription.
                     * @param bool $plain_text Wether the item meta is being generated in a plain text context.
                     */
                    ?>

                    </td>
                    <td class="product-total">
                        <?php echo wp_kses_post($subscription->get_formatted_line_subtotal($item)); ?>
                    </td>
                </tr>
                <?php
        }

        if ($subscription->has_status(array('completed', 'processing')) && ($purchase_note = get_post_meta($_product->id, '_purchase_note', true))) {
            ?>
                <tr class="product-purchase-note">
                    <td colspan="3"><?php echo wp_kses_post(wpautop(do_shortcode($purchase_note))); ?></td>
                </tr>
                <?php
        }
    }
    ?>
            </tbody>
            <tfoot>
                <?php
    foreach ($totals as $key => $total) : ?>
                <tr>
                    <th scope="row" <?php echo ($allow_item_removal) ? 'colspan="2"' : ''; ?>>
                        <?php echo esc_html($total['label']); ?></th>
                    <td><?php echo wp_kses_post($total['value']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tfoot>
        </table>
        <script type="text/javascript">
        function openModal() {
            $('.modal-change-plan').removeClass('closed');
            $('.modal-overlay').removeClass('closed');
        }

        $(document).ready(function() {
            $('#close-x').on('click', function() {
                $('.modal-change-plan').addClass('closed');
                $('.modal-overlay').addClass('closed');
            });

            $('#ritem1').click(function() {
                $('#variation').val('');
                $('#variation').val($(this).attr('data-product-id'));
                $('.new_sale_price').text('');
                $('.new_sale_price').text('$' + $(this).attr('data-price'));
                $('.card-green').addClass('glow-card');
                $('.card-blue').removeClass('glow-card');
                $('.card-white').removeClass('glow-card');
            });
            $('#ritem2').click(function() {
                $('#variation').val('');
                $('#variation').val($(this).attr('data-product-id'));
                $('.new_sale_price').text('');
                $('.new_sale_price').text('$' + $(this).attr('data-price'));
                $('.card-blue').addClass('glow-card');
                $('.card-green').removeClass('glow-card');
                $('.card-white').removeClass('glow-card');

            });
            $('#ritem3').click(function() {
                $('#variation').val('');
                $('#variation').val($(this).attr('data-product-id'));
                $('.new_sale_price').text('');
                $('.new_sale_price').text('$' + $(this).attr('data-price'));
                $('.card-white').addClass('glow-card');
                $('.card-green').removeClass('glow-card');
                $('.card-blue').removeClass('glow-card');

            });

        });
        </script>