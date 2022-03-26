<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
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

do_action( 'woocommerce_before_edit_account_form' ); ?>
<?php $user_id = get_current_user_id(); ?>
<form class="woocommerce-EditAccountForm edit-account" action="" method="post">

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
<fieldset>
    <legend class="pass-ch">Name</legend>
	<p class="woocommerce-FormRow woocommerce-FormRow--first form-row form-row-first">
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="First Name" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
	</p>
	<p class="woocommerce-FormRow woocommerce-FormRow--last form-row form-row-last">
		<input placeholder="<?php _e( 'Last name', 'woocommerce' ); ?>" type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
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
	<p class="woocommerce-FormRow woocommerce-FormRow--first form-row form-row-first">
		<input placeholder="<?php _e( 'Email Address', 'woocommerce' ); ?>" type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />
	</p>
	<?php //do_action( 'woocommerce_edit_account_form' ); ?>
	<p>
		<?php wp_nonce_field( 'save_account_details' ); ?>
		<input type="submit" class="btn inpbtn" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>" />
		<input type="hidden" name="action" value="save_account_details" />
	</p>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>

</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
