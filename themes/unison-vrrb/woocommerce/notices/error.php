<?php
/**
 * Show error messages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/notices/error.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.9.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!$notices) {
    return;
}

?>


<?php if (is_account_page()) {
    foreach ($notices as $notice_check) {
        if (count($notices) == '1' && $notice_check['data']['id'] == 'account_display_name') {
            $add_message = 'Account details updated successfully.';
        } else {
            $add_message = '';
        }
    }
    ?>
    <ul class="woocommerce-error" role="alert">
        <?php foreach ($notices as $notice) : ?>
            <li<?php echo wc_get_notice_data_attr($notice); ?>>
                <?php echo wc_kses_notice($notice['notice']); ?>
            </li>
        <?php endforeach; 
        if($add_message!=''){ ?>
            <li>
                <?php echo $add_message; ?>
            </li>
            <?php
        }
        ?>
    </ul>
<?php } else { ?>
    <ul class="woocommerce-error">
        <?php
        $totalReq = count(array_keys($messages, 'Required'));
        $removeReq = array_diff($messages, ["Required"]);

        $hide_login_message = false;

        if (strpos($removeReq[0], 'Coupon') !== false) {
            $hide_login_message = true;
        }

        if ($totalReq > 1) {
            echo '<li>Please fill in all the <strong>required</strong> fields.</li>';
        } else {
            if ( !is_user_logged_in() ) {
                if($hide_login_message==false){
                    echo '<li>Login required for purchase. To login or create account, <a href="#" class="js-check-login js-page-profile">Click here</a></li><script src="' . get_bloginfo('template_url') . '/js/functions.js"></script>';
                }
            }
        }
        ?>
        <?php foreach ($removeReq as $message) : ?>
            <li><?php echo wp_kses_post($message); ?></li>
        <?php endforeach; ?>
    </ul>

<?php } ?>