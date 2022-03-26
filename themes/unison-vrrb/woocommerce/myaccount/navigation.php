<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_account_navigation');
$customer_id = get_current_user_id();
global $wp;
$current_slug = $wp->request;

if ($current_slug == 'my-account') {
    $class = 'account-details';
} elseif (strpos($current_slug, 'my-account/orders') !== false) {
    $class = 'orders-list';
} elseif (strpos($current_slug, 'my-account/downloads') !== false) {
    $class = 'downloads';
} elseif (strpos($current_slug,'my-account/view-order') !== false) {
    $class = 'account-order-details';
}  elseif (strpos($current_slug,'my-account/view-subscription') !== false) {
    $class = 'account-midi-box-details';
}  elseif (strpos($current_slug,'my-account/members-area') !== false) {
    $class = 'account-members-area';
}  elseif (strpos($current_slug,'my-account/payment-method') !== false) {
    $class = 'payment-method';
}  else {
    $class = '';
}
?>

<section class="<?php echo $class; ?>">
    <div class="container">
    <div class="row">
    <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-sm-12 col-md-12 col-xs-12 mx-auto p-0">
    <div class="col-xxxl-12 col-xxl-12 p-0 account-desktop-menu" style="border-bottom: 1px solid #393939">
        <nav class="col-xxxl-9 col-xxl-9 col-xl-10 col-lg-10 mx-auto nav w-100 justify-content-around text-uppercase font-weight-bold">
            <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
                <?php if ($label !== 'Midi Box') { ?>
                    <a class="nav-link filter-button ml-0 pl-0 pr-0 p3 pt-0 grey-link <?php echo wc_get_account_menu_item_classes($endpoint) ?>"
                        id="<?php echo esc_html($endpoint); ?>-tab"
                        href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>" role="tab"
                        aria-controls="<?php echo esc_html($endpoint); ?>"
                        aria-selected="true"><?php echo esc_html($label); ?></a>
                <?php } ?>
            <?php endforeach; ?>
        </nav>
    </div>

    <div class="col-xxxl-12 col-xxl-12 p-0 account-mobile-menu" style="padding-bottom: 20px !important;">
        <nav class="col-md-8 col-sm-8 col-xs-10  mx-auto nav w-100 justify-content-center justify-content-md-around text-uppercase font-weight-bold p-0">
            <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
                <?php if ($label !== 'Midi Box') { ?>
                    <a class="nav-link filter-button grey-link mt-2 <?php echo wc_get_account_menu_item_classes($endpoint) ?>"
                        id="<?php echo esc_html($endpoint); ?>-tab"
                        href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>" role="tab"
                        aria-controls="<?php echo esc_html($endpoint); ?>" aria-selected="true">
                    <?php echo esc_html($label); ?></a>
                <?php } ?>
            <?php endforeach; ?>
        </nav>
    </div>

<?php do_action('woocommerce_after_account_navigation'); ?>