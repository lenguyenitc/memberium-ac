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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
$customer_id = get_current_user_id();
?>

<section id="pAccount">
  <!-- <div class="banner"><h2>My account</h2></div> -->
  <?php if (wp_is_mobile()){
  echo '<div class="acc-title"><h4>'; 
  the_title();
   echo '</h4></div>';
    } ?>
  <div class="acc-wrap">

    <div class="acc-info">
      <p class="ava">
                <?php 
                  $url = get_avatar_url( $customer_id );
                  echo get_avatar( $customer_id, '110', $default, $alt, $args ); 
                ?>
                
                <span class="btn-upload">Upload</span>
                <div class="av-upload">
                  <div class="close-av-modal"></div>
                  <?php echo do_shortcode('[avatar_upload]'); ?>
                </div>
        <input name="avatar" class="js-input-file h" type="file">
      </p>
      <h4 style="text-transform:capitalize;">
        <?php
        $first_name = get_user_meta( $customer_id, 'first_name', true ); 
        $last_name = get_user_meta( $customer_id, 'last_name', true ); 
        if (empty($first_name)){
          $first_name = get_user_meta( $customer_id, 'nickname', true ); 
        }
        echo $first_name .' '. $last_name; 
        ?>
      </h4>

            
      <ul class="link">
        <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; ?>
      </ul>
    </div>


<?php do_action( 'woocommerce_after_account_navigation' ); ?>
