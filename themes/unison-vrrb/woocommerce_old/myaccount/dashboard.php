<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wpdb; 

//  Update account details
$user_id = get_current_user_id();

  if (isset($_POST['account_first_name']) && !empty($_POST['account_first_name'])) {
   update_user_meta($user_id, 'first_name', $_POST['account_first_name']);
  }
  if (isset($_POST['account_last_name']) && !empty($_POST['account_last_name'])) {
   update_user_meta($user_id, 'last_name', $_POST['account_last_name']);
  }
  if (isset($_POST['account_email']) && !empty($_POST['account_email'])) {
   update_user_meta($user_id, 'email', $_POST['account_email']);
   update_user_meta($user_id, 'billing_email', $_POST['account_email']);
   update_user_meta($user_id, 'user_login', $_POST['account_email']);
  }
  $user = wp_get_current_user(); 
  if (isset($_POST['password_current']) && !empty($_POST['password_current'])) {
     $pass_chk = wp_check_password( $_POST['password_current'], $user->user_pass);
     if ($pass_chk && $_POST['password_1'] != '' && $_POST['password_2'] != '' && $_POST['password_1'] == $_POST['password_2']) {
     	wp_set_password( $_POST['password_1'],  $user_id );
     	//echo "Password updated";
     } 
    }
// eND Update account details

$customer_id = get_current_user_id();

	
?>

<!--<h4 style="text-transform:capitalize;">
	<?php
		//echo sprintf( esc_attr__( '%s%s%s', 'woocommerce' ), '<strong>', esc_html( $current_user->display_name ), '</strong>', '<a href="' . esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) ) . '">', '</a>' );
	?>
</h4>-->

<p>
	<label>Name:</label>
	<?php
	
	$first_name = get_user_meta( $customer_id, 'first_name', true ); 
	$last_name = get_user_meta( $customer_id, 'last_name', true );
	$country = get_user_meta( $customer_id, 'country', true );
	$phone = get_user_meta( $customer_id, 'phone', true ); 
	$citystate = get_user_meta( $customer_id, 'citystate', true ); 
	$current_user = wp_get_current_user();

	?>

	<strong><?php echo $first_name .' '. $last_name; ?></strong>
</p>
<p>
	<label>Email:</label>

	<strong><?php echo $current_user->user_email ?></strong>
</p>
        
<!--<p>
	<?php
		echo sprintf( esc_attr__( '%1$srecent orders%2$s %3$sshipping and billing addresses%2$s %4$sedit your password and account details%2$s', 'woocommerce' ), '<a class="btn" href="' . esc_url( wc_get_endpoint_url( 'orders' ) ) . '">', '</a>', '<a class="btn bg-w" href="' . esc_url( wc_get_endpoint_url( 'edit-address' ) ) . '">', '<a class="btn" href="' . esc_url( wc_get_endpoint_url( 'edit-account' ) ) . '">' );
	?>
</p>-->
<?php 
do_action( 'woocommerce_before_edit_account_form' ); ?>
<?php $user_id = get_current_user_id(); ?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post" id="woo_edit_account">

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
<fieldset>
    <legend class="pass-ch">Name</legend>
	<p class="woocommerce-FormRow woocommerce-FormRow--first form-row form-row-first">
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="First Name" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $current_user->first_name ); ?>" required/>
	</p>
	<p class="woocommerce-FormRow woocommerce-FormRow--last form-row form-row-last">
		<input placeholder="<?php _e( 'Last name', 'woocommerce' ); ?>" type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $current_user->last_name ); ?>" required/>
	</p>
	<div class="clear"></div>
</fieldset>
<fieldset>
	<legend class="pass-ch"><?php _e( 'Password Change', 'woocommerce' ); ?></legend>
	<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
		<input type="password" placeholder="<?php _e( 'Old Password', 'woocommerce' ); ?>" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" />
	</p>
	<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">	
		<input type="password" placeholder="<?php _e( 'New Password', 'woocommerce' ); ?>" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" />
	</p>
	<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
		<input type="password" placeholder="<?php _e( 'Confirm New Password', 'woocommerce' ); ?>" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" />
	</p>
</fieldset>
<fieldset>
    <legend class="pass-ch">Contact Info</legend>
	<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
		<input placeholder="<?php _e( 'Email Address', 'woocommerce' ); ?>" type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" value="<?php echo esc_attr( $current_user->user_email ); ?>" required/>
	</p>
	<?php //do_action( 'woocommerce_edit_account_form' ); ?>
	<p>
		<?php wp_nonce_field( 'save_account_details' ); ?>
		<input type="submit" class="btn inpbtn woo_account_edit" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>" />
		<input type="hidden" name="action" value="save_account_details" />
		<input type="hidden" name="old_email" value="<?php echo $current_user->user_email ?>" />
		
	</p>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>

</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>


<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );
?>
