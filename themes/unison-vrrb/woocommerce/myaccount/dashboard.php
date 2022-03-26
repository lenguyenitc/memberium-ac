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
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$allowed_html = array(
    'a' => array(
        'href' => array(),
    ),
); ?>

<?php

global $wpdb;
$current_user = wp_get_current_user();
$user = wp_get_current_user();
//  Update account details
$user_id = get_current_user_id();
$usrname = esc_attr($current_user->first_name) . ' ' . esc_attr($current_user->last_name);

// if (isset($_POST['payment_details']) && !empty($_POST['payment_details'])) {

//     update_user_meta($user_id, 'payment_details', $_POST['payment_details']);
// }
// if (isset($_POST['account_last_name']) && !empty($_POST['account_last_name']) && $current_user->last_name != $_POST['account_last_name']) {
//     $account_first_name =  explode(" ", $_POST['account_first_name'] );
//     if(isset($account_first_name[1])){
//         update_user_meta($user_id, 'last_name', $account_first_name[1]);
//     }
// }


$customer_id = get_current_user_id();

$first_name = get_user_meta($customer_id, 'first_name', true);
$last_name = get_user_meta($customer_id, 'last_name', true);
$country = get_user_meta($customer_id, 'country', true);
$phone = get_user_meta($customer_id, 'phone', true);
$citystate = get_user_meta($customer_id, 'citystate', true);
$payment = get_user_meta($customer_id, 'payment_details', true);
$current_user = wp_get_current_user();

$attachment_id = get_user_meta( $user_id, 'image', true );

// True
if ( $attachment_id ) {
    $original_image_url = wp_get_attachment_url( $attachment_id );

     wp_get_attachment_image( $attachment_id, 'full');
}

do_action('woocommerce_before_edit_account_form'); ?>
<?php $user_id = get_current_user_id();
?>

    <div class=" col-12 pl-0 pr-0">

        <form class="woocommerce-EditAccountForm edit-account d-flex flex-column pl-0" action="" method="post"
              id="woo_edit_account" enctype="multipart/form-data">
              <div class="row p-0">
                  <div class="col-xxxl-5 col-xxl-7 col-xl-5 col-md-5 col-lg-5 col-xs-12 col-md-9 col-sm-9 text-center text-sm-left p-0">
            <?php do_action('woocommerce_edit_account_form_start'); ?>
            <ul class="text-center pl-0 mb-0 pb-0 personal-info">
                <li class="mb-3">
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide p-0">
                        <label class="details-grey-small"  for="image"><?php esc_html_e('Profile Picture', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                        <input type="file" class="woocommerce-Input custom-file-input" name="image"
                        onchange="previewFile(this); loadImg();"
                        accept="image/x-png,image/gif,image/jpeg"
                        style="color: transparent; padding-left: 0px; padding-top: 30px; padding-bottom: 20px; width: 100%;">
                    </p>
                </li>
                <li class="mb-3">
                    <label class="details-grey-small">Name:</label>
                    <input type="text"
                           class="woocommerce-Input woocommerce-Input--text input-text border-0"
                           placeholder="First Name" name="account_first_name" id="account_first_name"
                           value="<?php echo esc_attr($current_user->first_name) . ' ' . esc_attr($current_user->last_name); ?>"
                           required/>

                    <input placeholder="<?php _e('Last name', 'woocommerce'); ?>" type="hidden"
                           class="woocommerce-Input woocommerce-Input--text input-text border-0 "
                           name="account_last_name" id="account_last_name"
                           value=" " required/>
                </li>
                <li>
                    <label class="details-grey-small">Email:</label>
                    <input placeholder="<?php _e('Email Address', 'woocommerce'); ?>" type="email"
                           class="woocommerce-Input woocommerce-Input--email input-text  border-0"
                           name="account_email" id="account_email"
                           value="<?php echo esc_attr($current_user->user_email); ?>" required/>
                </li>
            </ul>
<div class="col-12 d-flex flex-column p-0">
            <label class="details-grey mb-2 text-left">Password change:</label>
            <input type="password" placeholder="<?php _e('Old Password', 'woocommerce'); ?>"
                   name="password_current"
                   id="password_current"/>
            <input type="password" placeholder="<?php _e('New Password', 'woocommerce'); ?>"
                   name="password_1"
                   id="password_1"/>
            <input type="password" placeholder="<?php _e('Confirm New Password', 'woocommerce'); ?>"
                   name="password_2"
                   id="password_2"/>
</div>

            <?php //do_action( 'woocommerce_edit_account_form' ); ?>

            <?php wp_nonce_field('save_account_details'); ?>
            <input type="submit"
                   class="badge badge-success btn-save" id='my-acc-edit' name="save_account_details"
                   value="<?php esc_attr_e('Save changes', 'woocommerce'); ?>"/>
            <input type="hidden" name="action" value="save_account_details"/>
            <input type="hidden" name="old_email"id="old_email" value="<?php echo $current_user->user_email ?>"/>
            <input type="hidden" name="old_fname"id="old_fname" value="<?php echo esc_attr($current_user->first_name) . ' ' . esc_attr($current_user->last_name); ?>"/>


</div>
                    <div class="col-xxxl-5 offset-xxxl-2 offset-xl-1 offset-xxl-0 col-xxl-4 col-xl-5 col-md-12 col-lg-5 offset-lg-1 offset-xs-0 col-xs-12 col-md-12 col-sm-12 p-0 pl-lg-3 pr-lg-3">
<!-- <label class="details-grey mb-15 text-left">Payment details:</label>
            <textarea class="bg-transparent w-100 border-0" name="payment_details" id="payment_details"
                      rows="5"><?php echo esc_attr($current_user->payment_details); ?></textarea> -->
                    </div>
</div>

        </form>
    </div>
    <script>
        jQuery('#my-acc-edit').click(function(){

            //$this = $(this);
            var ajaxurl = "<?php echo admin_url( 'admin-ajax.php'); ?>";
            let fname = jQuery('#account_first_name').val();
            let lname = jQuery('#account_last_name').val();
            let email = jQuery('#account_email').val();
            let old_email = jQuery('#old_email').val();
            let old_fname = jQuery('#old_fname').val();
            let passnew1 = jQuery('#password_current').val();
            let passnew2 = jQuery('#password_1').val();
            let passnew3 = jQuery('#password_2').val();
            let file_data = jQuery('.custom-file-input')[0].files[0];

            form_data = new FormData();
            form_data.append('file', file_data);

            if(fname != ''){
                form_data.append('fname', fname);
            }
            if(lname != ''){
                form_data.append('lname', lname);
            }
            if(email != ''){
                form_data.append('email', email);
            }
            if(passnew1 != ''){
                form_data.append('passnew1', passnew1);
            }
            if(passnew2 != ''){
                form_data.append('passnew2', passnew2);
            }
            if(passnew3 != ''){
                form_data.append('passnew3', passnew3);
            }
            if(old_email != ''){
                form_data.append('old_email', old_email);
            }
            if(old_fname != ''){
                form_data.append('old_fname', old_fname);
            }

            form_data.append('file', file_data);

            form_data.append('action', 'user_form_update_my_acc');
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                contentType: false,
                processData: false,
                data: form_data,
                success: function (response) {
                    //alert(response);
                    //console.log(response);
                    if(response == 'updated'){
                        setTimeout(function () {
                            window.location.reload();
                        },200);
                    }
                    else{
                        setTimeout(function () {
                            window.location.reload();
                        },200);
                    }
                    //alert('File uploaded successfully.');
                }
            });
            return false;

        });
        function previewFile(input){
            var file = $("input[type=file]").get(0).files[0];
            console.log(file)

            if(file){
                jQuery(".custom-file-input").css("color", "white")
              }
            else {
                jQuery(".custom-file-input").css("color", "transparent")
            }
        }

        function loadImg(){
            $('.avatar-img').attr('src', URL.createObjectURL(event.target.files[0]));
        }

    </script>



<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_dashboard');

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_before_my_account');

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_after_my_account');
