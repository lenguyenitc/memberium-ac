<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */
defined( 'ABSPATH' ) || exit;
?>
<?php
do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) : ?>
    <div class="col-xxxl-12 col-xxl-12 col-xl-10 col-lg-10 mx-auto ml-0">
    <table class="table woocommerce-orders-table woocommerce-MyAccount-orders orders-tabele" style="width: 100%" id="table-order">
        <thead>
        <tr>
            <?php $i = 1; ?>
            <?php foreach (wc_get_account_orders_columns() as $column_id => $column_name) : ?>
                <th class="<?php echo ($i == 1) ? 'py-4' : 'p3'; ?> woocommerce-orders-table__header woocommerce-orders-table__header-<?php echo esc_attr($column_id); ?>"
                    scope="col">
                    <?php echo esc_html($column_name); ?>
                </th>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $y = 1;
        foreach ( $customer_orders->orders as $customer_order ) {
            $order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
            $item_count = $order->get_item_count() - $order->get_item_count_refunded();
            ?>
            <tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $order->get_status() ); ?> order">
                <?php foreach (wc_get_account_orders_columns() as $column_id => $column_name) :?>
                    <?php if ($column_id == 'order-number') : ?>
                        <th class="py-4 text-green woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr($column_id); ?>"
                            scope="row" data-title="<?php echo esc_attr($column_name); ?>">
                            <?php if (has_action('woocommerce_my_account_my_orders_column_' . $column_id)) : ?>
                                <?php do_action('woocommerce_my_account_my_orders_column_' . $column_id, $order); ?>

                            <?php elseif ('order-number' === $column_id) : ?>
                                <a href="<?php echo esc_url($order->get_view_order_url()); ?>">
                                    <?php echo esc_html(_x('#', 'hash before order number', 'woocommerce') . $order->get_order_number()); ?>
                                </a>

                            <?php elseif ('order-date' === $column_id) : ?>
                                <time datetime="<?php echo esc_attr($order->get_date_created()->date('c')); ?>"><?php echo esc_html(wc_format_datetime($order->get_date_created())); ?></time>

                            <?php elseif ('order-status' === $column_id) : ?>
                                <?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>

                            <?php elseif ('order-total' === $column_id) : ?>
                                <?php
                                /* translators: 1: formatted order total 2: total order items */
                                echo wp_kses_post(sprintf(_n('%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce'), $order->get_formatted_order_total(), $item_count));
                                ?>

                            <?php elseif ('order-actions' === $column_id) : ?>
                                <?php
                                $actions = wc_get_account_orders_actions($order);

                                if (!empty($actions)) {
                                    foreach ($actions as $key => $action) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                                        echo '<a href="' . esc_url($action['url']) . '" class="woocommerce-button button ' . sanitize_html_class($key) . '">' . esc_html($action['name']) . '</a>';
                                    }
                                }
                                ?>
                            <?php endif; ?>
                        </th>

                    <?php else : ?>
                        <td class="grey-text woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr($column_id); ?>"
                            data-title="<?php echo esc_attr($column_name); ?>">
                            <?php if (has_action('woocommerce_my_account_my_orders_column_' . $column_id)) : ?>
                                <?php do_action('woocommerce_my_account_my_orders_column_' . $column_id, $order); ?>

                            <?php elseif ('order-number' === $column_id) : ?>
                                <a href="<?php echo esc_url($order->get_view_order_url()); ?>">
                                    <?php echo esc_html(_x('#', 'hash before order number', 'woocommerce') . $order->get_order_number()); ?>
                                </a>

                            <?php elseif ('order-date' === $column_id) : ?>
                                <time datetime="<?php echo esc_attr($order->get_date_created()->date('c')); ?>"><?php echo esc_html(wc_format_datetime($order->get_date_created())); ?></time>

                            <?php elseif ('order-status' === $column_id) : ?>
                                <?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>

                            <?php elseif ('order-total' === $column_id) : ?>
                                <?php
                                /* translators: 1: formatted order total 2: total order items */
                                echo wp_kses_post(sprintf(_n('%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce'), $order->get_formatted_order_total(), $item_count));
                                ?>

                            <?php elseif ('order-actions' === $column_id) : ?>
                                <?php
                                $actions = wc_get_account_orders_actions($order);

                                if (!empty($actions)) {
                                    foreach ($actions as $key => $action) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                                        echo '<a href="' . esc_url($action['url']) . '" id="order" class="order-btn button-view woocommerce-button button ' . sanitize_html_class($key) . '">' . esc_html($action['name']) . '</a>';
                                    }
                                }
                                ?>
                            <?php endif; ?>
                        </td>
                    <?php endif; ?>
                    <?php $y++; ?>
                <?php endforeach; ?>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

    <table class="orders-tabele-mobile w-100">
        <tr>
            <?php
            foreach ($customer_orders->orders as $customer_order) {
            $order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
            $item_count = $order->get_item_count() - $order->get_item_count_refunded();
            ?>
            <?php foreach (wc_get_account_orders_columns() as $column_id => $column_name) : ?>
            <th class="col-2">
                <?php echo esc_html($column_name); ?>
            </th>
            <td>
                <?php if ($column_id == 'order-number') : ?>

                    <?php if (has_action('woocommerce_my_account_my_orders_column_' . $column_id)) : ?>
                        <?php do_action('woocommerce_my_account_my_orders_column_' . $column_id, $order); ?>

                    <?php elseif ('order-number' === $column_id) : ?>
                        <a href="<?php echo esc_url($order->get_view_order_url()); ?>">
                            <?php echo esc_html(_x('#', 'hash before order number', 'woocommerce') . $order->get_order_number()); ?>
                        </a>

                    <?php elseif ('order-date' === $column_id) : ?>
                        <time datetime="<?php echo esc_attr($order->get_date_created()->date('c')); ?>"><?php echo esc_html(wc_format_datetime($order->get_date_created())); ?></time>

                    <?php elseif ('order-status' === $column_id) : ?>
                        <?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>

                    <?php elseif ('order-total' === $column_id) : ?>
                        <?php
                        /* translators: 1: formatted order total 2: total order items */
                        echo wp_kses_post(sprintf(_n('%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce'), $order->get_formatted_order_total(), $item_count));
                        ?>

                    <?php elseif ('order-actions' === $column_id) : ?>
                        <?php
                        $actions = wc_get_account_orders_actions($order);

                        if (!empty($actions)) {
                            foreach ($actions as $key => $action) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                                echo '<a href="' . esc_url($action['url']) . '" id="order" class="order-btn button-view woocommerce-button button ' . sanitize_html_class($key) . '">' . esc_html($action['name']) . '</a>';
                                echo '<tr class="order-bottom-border"></tr>';
                            }
                        }
                        ?>
                    <?php endif; ?>
                <?php else : ?>

                    <?php if (has_action('woocommerce_my_account_my_orders_column_' . $column_id)) : ?>
                        <?php do_action('woocommerce_my_account_my_orders_column_' . $column_id, $order); ?>

                    <?php elseif ('order-number' === $column_id) : ?>
                        <a href="<?php echo esc_url($order->get_view_order_url()); ?>">
                            <?php echo esc_html(_x('#', 'hash before order number', 'woocommerce') . $order->get_order_number()); ?>
                        </a>

                    <?php elseif ('order-date' === $column_id) : ?>
                        <time datetime="<?php echo esc_attr($order->get_date_created()->date('c')); ?>"><?php echo esc_html(wc_format_datetime($order->get_date_created())); ?></time>

                    <?php elseif ('order-status' === $column_id) : ?>
                        <?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>

                    <?php elseif ('order-total' === $column_id) : ?>
                        <?php
                        /* translators: 1: formatted order total 2: total order items */
                        echo wp_kses_post(sprintf(_n('%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce'), $order->get_formatted_order_total(), $item_count));
                        ?>

                    <?php elseif ('order-actions' === $column_id) : ?>
                        <?php
                        $actions = wc_get_account_orders_actions($order);

                        if (!empty($actions)) {
                            foreach ($actions as $key => $action) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                                echo '<a href="' . esc_url($action['url']) . '" id="order" class="order-btn button-view woocommerce-button button ' . sanitize_html_class($key) . '">' . esc_html($action['name']) . '</a>';
                                echo '<tr class="order-bottom-border"></tr>';
                            }
                        }
                        ?>
                    <?php endif; ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <?php endforeach; ?>
            <?php
            }
            ?>
        </tr>
        <!--            <th class="col-2" style="padding-top: 33px">-->
        <!--                Order-->
        <!--            </th>-->
        <!--            <td class="col-10 text-green" style="padding-top: 33px">-->
        <!--                #29032-->
        <!--            </td>-->
        <!--        </tr>-->
        <!--        <tr>-->
        <!--            <th class="col-2">-->
        <!--                Date-->
        <!--            </th>-->
        <!--            <td class="col-10 grey-text">-->
        <!--                03/26/2021-->
        <!---->
        <!--            </td>-->
        <!--        </tr>-->
        <!--        <tr>-->
        <!--            <th class="col-2">-->
        <!--                Status-->
        <!--            </th>-->
        <!--            <td class="col-10 grey-text">-->
        <!--            Completed-->
        <!---->
        <!--            </td>-->
        <!--        </tr>-->
        <!--        <tr>-->
        <!--            <th class="col-2  padding-15">-->
        <!--                <p>Total</p>-->
        <!--            </th>-->
        <!--            <td class="col-10 grey-text padding-15">-->
        <!--            $47 for Item-->
        <!---->
        <!--            </td>-->
        <!--        </tr>-->
        <!--        <tr>-->
        <!--            <th class="col-2 button-tr">-->
        <!--                Actions-->
        <!--            </th>-->
        <!--            <td class="col-10 text-green button-tr">-->
        <!--                <a href="#" class="order-btn button-view" id='order'>VIEW</a>-->
        <!--            </td>-->

    </table>

    <?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

    <?php if ( 1 < $customer_orders->max_num_pages ) : ?>
        <div class="mt-lg-4 text-center woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination d-flex">
            <?php if ( 1 !== $current_page ) : ?>
                <a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button btn-order mr-4" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'woocommerce' ); ?></a>
            <?php endif; ?>

            <?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
                <a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button btn-order" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'woocommerce' ); ?></a>
            <?php endif; ?>
        </div>
    <?php endif; ?>


<?php else : ?>
    <div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
        <a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php esc_html_e( 'Browse products', 'woocommerce' ); ?></a>
        <?php esc_html_e( 'No order has been made yet.', 'woocommerce' ); ?>
    </div>
<?php endif; ?>



<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>