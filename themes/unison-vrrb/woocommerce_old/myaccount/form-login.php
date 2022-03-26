<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
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
	exit; // Exit if accessed directly
}

?>




<div class="page-cont">
<div class="popup2" id="account2">
    <div class="contain">
      <h4>Account <span>Please Login or Sign Up</span></h4>
      <ul class="js-tab--account tab-account">
        <li>login</li>
        <li class="selected">Sign Up</li>
      </ul>
      <div class="js-contain--account2 js-contain--account">
		<?php $login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;
		if ( $login === "failed" ) {
		  echo '<p class="login-msg"><strong>ERROR:</strong> Invalid username and/or password.</p>';
		} elseif ( $login === "empty" ) {
		  echo '<p class="login-msg"><strong>ERROR:</strong> Username and/or Password is empty.</p>';
		} elseif ( $login === "false" ) {
		  echo '<p class="login-msg"><strong>ERROR:</strong> You are logged out.</p>';
		}
		?>
        <div class="login display">
          <?php global $user_ID, $user_identity; get_currentuserinfo(); if (!$user_ID) { ?>
          <?php


$args = array(
    'echo' => false,
    'redirect' => home_url(), 
    'id_username' => 'user',
    'id_password' => 'pass',
    'label_username' => __( '' ),
	'label_password' => __( '' ),
	'label_remember' => __( '' ),
	'label_log_in'   => __( 'Login' ),
	'remember'       => false,
);

$form = wp_login_form( $args ); 

//add the placeholders
$form = str_replace('name="log"', 'name="log" placeholder="Username or email address"', $form);
$form = str_replace('name="pwd"', 'name="pwd" placeholder="Password"', $form);

echo $form;





?>

            <form method="post" action="<?php bloginfo('url') ?>/wp-login.php" class="frmSignIn">
              
                <p><a href="/reset/" class="los">Forgot your password?</a></p>
              </p>
              <p class="or"><span>OR</span></p>
            
   <?php do_action( 'wordpress_social_login' ); ?>

            </form>



          <?php } ?>
        </div>



        <div class="create-account">
          <?php custom_registration_function(); ?>
<p class="or" style="margin-bottom:25px"><span>OR</span></p>
          <?php do_action( 'wordpress_social_login' ); ?>

        </div>

      </div>
    </div>
    <span class="btn-close js-close-account"></span>
    <span class="ovl"></span>
  </div>
</div>

