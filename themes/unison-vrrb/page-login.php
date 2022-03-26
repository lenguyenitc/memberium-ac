<?php 

if ( is_user_logged_in() ) 
{
    wp_redirect( '/my-account/' );
    die;
}

get_header(); ?>
<div class="page-cont flex-grow-1 d-flex justify-content-center align-items-center">
<div class="popup2" id="account2">
    <div class="contain mx-auto">
    <div class="col-12 text-center">
        <img class="img-login" src="<?php bloginfo( 'template_url' ) ?>/assets/images/logo 1.png" alt="">
    </div>
    <ul class="js-tab--account tab-account">
      <li  class="selected">login</li>
      <li>Sign Up</li>
    </ul>
      <div class="js-contain--account2 js-contain--account">
	
        <div class="login display">
          <?php $login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;
          if ( $login === "failed" ) {
            echo '<p class="login-msg"><strong>ERROR:</strong> Invalid e-mail address and/or password.</p>';
          } elseif ( $login === "empty" ) {
            echo '<p class="login-msg"><strong>ERROR</strong>: Enter e-mail address.</p>';
          } elseif ( $login === "false" ) {
            echo '<p class="login-msg"><strong>ERROR:</strong> You are logged out.</p>';
          }
          ?>
          <?php global $user_ID, $user_identity; get_currentuserinfo(); 


          if (!$user_ID) { ?>
          <?php
            $args = array(
                'echo' => false,
                'redirect' => site_url(), 
                'id_username' => 'user2',
                'id_password' => 'pass2',
                'form_id'        => 'loginform2',
                'label_username' => __( '' ),
            	'label_password' => __( '' ),
            	'label_remember' => __( '' ),
            	'label_log_in'   => __( 'Login' ),
            	'remember'       => false,
              'id_submit'      => 'wp-submit2',
            );

            $form = wp_login_form( $args ); 

            //add the placeholders
            $form = str_replace('name="log"', 'name="log" placeholder="Enter e-mail address"', $form);
            $form = str_replace('name="pwd"', 'name="pwd" placeholder="Password"', $form);

            echo $form;

            ?>

            <form method="post" action="<?php bloginfo('url') ?>/wp-login.php" class="frmSignIn">
              <p><a href="/reset/" class="los">Forgot your password?</a></p>
              <!-- <p class="or"><span>OR</span></p> -->
              <?php //do_action( 'wordpress_social_login' ); ?>
            </form>
          <?php } ?>
        </div>

        <div class="create-account">
            <?php custom_registration_function(); ?>
              <!-- <p class="or" style="margin-bottom:25px"><span>OR</span></p> -->
            <?php //do_action( 'wordpress_social_login' ); ?>
        </div>

      </div>
    </div>
    <span class="btn-close js-close-account"></span>
    <span class="ovl"></span>
  </div>
</div>
<?php get_footer(); ?>