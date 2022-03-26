<?php get_header() ?>
<div class="page-cont flex-grow-1 d-flex justify-content-center align-items-center" style="min-height:600px">
    
    <?php
        global $wpdb; 

        error_reporting(0);
        //ini_set("display_errors","1");        
        
        $error = '';
        $success = '';
        
        // check if we're in reset form
        if( isset( $_POST['action'] ) && 'reset' == $_POST['action'] ) 
        {
            $email = trim($_POST['user_email']);

            try {

                if (empty($email)) {
                    throw new \Exception('Enter a username or e-mail address..');
                }

                if(!is_email($email)) {
                    throw new \Exception('Invalid username or e-mail address.');
                }

                if(!email_exists($email)) {
                    throw new \Exception('There is no user registered with that email address.');
                }

                //$random_password = wp_generate_password( 6, false, false );
                $reset_key = uniqid('un', true);
                $user = get_user_by( 'email', $email );                

                $reset_password_time = get_user_meta($user->ID, 'reset_password_time', true);

                $current_time = strtotime("-15 minutes", strtotime(date("Y-m-d H:i:s")));

                if($reset_password_time==''){
                    update_user_meta($user->ID, 'reset_password_time', date("Y-m-d H:i:s"));
                }else if(strtotime($reset_password_time) > $current_time){

                    $d1 = new DateTime(date("Y-m-d H:i:s", $current_time));
                    $d2 = new DateTime($reset_password_time);
                    $interval = $d1->diff($d2);

                    $diffInMinutes = $interval->i;

                    throw new \Exception('A password reset link was recently sent to your email address. You will be able to send another request in '.$diffInMinutes.' minutes.');
                }else{
                    update_user_meta($user->ID, 'reset_password_time', date("Y-m-d H:i:s"));
                }

                update_user_meta($user->ID, 'reset_password_key', $reset_key);

                /*$update_user = wp_update_user( array (
                        'ID' => $user->ID,
                        'user_pass' => $random_password
                    )
                );*/

                // if  update user return true then lets send user an email containing the new password
                /*if(!$update_user) {
                    throw new \Exception('Oops something went wrong updating your account.');
                }*/

                $password_reset_link = '<a href="'.site_url().'/reset/?reset_key='.$reset_key.'&user_email='.$email.'">Please use this link to reset your password</a>';

                $data = array(
                    'id' => 12,
                    'to' => $email,
                    'attr' => array(
                        'EMAIL' => $email,
                        'NAME' => $user->user_nicename,
                        'USERNAME' => $user->user_login,
                        'PASSWORD_LINK' => $password_reset_link
                    )
                );

                if (!sib_trigger($data)) {
                    $error = 'Sorry. Something went wrong while sending email. Please try later';
                }

                // $success = 'Check your email address for you new password.';
                $success = 'Your password retrieval request has been successfully processed, please find your password reset link at the email address submitted.';

            } catch (\Exception $e) {
                $error = $e->getMessage();
            }           
            
        }

        // password change
        if( isset( $_POST['action'] ) && 'reset_password' == $_POST['action'] ) 
        {
            $email = trim($_POST['user_email']);
            $password = trim($_POST['password']);
            $c_password = trim($_POST['c_password']);
            $reset_key = trim($_POST['reset_key']);
            try {

                if (empty($password)) {
                    throw new \Exception('Enter valid password');
                }
                if ($password!=$c_password) {
                    throw new \Exception('Password does not match');
                }
                if (strlen($password)<6) {
                    throw new \Exception('Enter atleast 6 digit password');
                }

                if (empty($email)) {
                    throw new \Exception('Enter a username or e-mail address..');
                }

                if(!is_email($email)) {
                    throw new \Exception('Invalid username or e-mail address.');
                }

                if(!email_exists($email)) {
                    throw new \Exception('There is no user registered with that email address.');
                }

                //$random_password = wp_generate_password( 6, false, false );
                $user = get_user_by( 'email', $email );

                $match_reset_key = get_user_meta($user->ID, 'reset_password_key', true);

                if (empty($match_reset_key)) {
                    throw new \Exception('This link has expired or is invalid. Please go back to forget page & resend link.');
                }

                if ($match_reset_key!=$reset_key) {
                    throw new \Exception('This link has expired or is invalid. Please go back to forget page & resend link.');
                }

                update_user_meta($user->ID, 'reset_password_key', '');

                $update_user = wp_update_user( array (
                        'ID' => $user->ID,
                        'user_pass' => $password
                    )
                );

                // if  update user return true then lets send user an email containing the new password
                if(!$update_user) {
                    throw new \Exception('Oops something went wrong updating your account.');
                }                

                // $success = 'Check your email address for you new password.';
                $success = 'Your password was successfully changed.';

            } catch (\Exception $e) {
                $error = $e->getMessage();
            }           
            
        }
    ?>
<div class="popup2 login_cont_for lostpass-wrap2" id="account2">
    <div class="contain">
        <div class="col-12 text-center">
            <img class="img-forgot" src="<?php bloginfo( 'template_url' ) ?>/assets/images/logo 1.png" alt="">
        </div>
        <div class="js-contain--account2 js-contain--account">
            <div class="login display">
                <?php 
                if(isset($_GET['reset_key']) && isset($_GET['user_email'])){
                    ?>
                    <form method="post">
                        <h5 class="text-dark">Password Change</h5>
                        <p class="user m-0">
                            <?php $user_email = isset( $_GET['user_email'] ) ? $_GET['user_email'] : ''; ?>
                            <?php $reset_key = isset( $_GET['reset_key'] ) ? $_GET['reset_key'] : ''; ?>
                            <input type="hidden" placeholder="Your Email Address..." name="user_email" id="user_email" value="<?php echo $user_email; ?>" /></p>
                            <p class="user m-0">
                            <input type="password" placeholder="New Password" name="password" id="password" /></p>
                            <p class="user m-0">
                            <input type="password" placeholder="Confirm New Password" name="c_password" id="c_password" /></p>
                            <?php 
                            if( ! empty( $error ) )
                            echo '<div class="message"><p class="error"><strong>ERROR:</strong> '. $error .'</p></div>';
                        
                            if( ! empty( $success ) )
                                echo '<div class="error_login"><p class="success">'. $success .'</p></div>';
                            ?>
                        <p>
                            <input type="hidden" name="action" value="reset_password" />
                            <input type="hidden" name="reset_key" value="<?php echo $reset_key; ?>" />
                            <input type="submit" value="Change password" class="button-primary reset-password-button w-100"  />
                        </p>
                    </form>
                    <?php
                }else{
                    ?>
                    <form method="post">
                        <h5 class="text-dark">Forgot Your Password?</h5>
                        <p class="user m-0">
                            <?php $user_email = isset( $_POST['user_email'] ) ? $_POST['user_email'] : ''; ?>
                            <input  type="text" placeholder="Your Email Address..." name="user_email" id="user_email" value="<?php echo $user_email; ?>" /></p>
                            <?php 

                            if( ! empty( $error ) )
                            echo '<div class="message"><p class="error"><strong>ERROR:</strong> '. $error .'</p></div>';
                        
                            if( ! empty( $success ) )
                                echo '<div class="error_login"><p class="success">'. $success .'</p></div>';
                            ?>
                        <p>
                            <input type="hidden" name="action" value="reset" />
                            <input type="submit" value="Request new password" class="button-primary reset-password-button w-100"  />
                        </p>
                    </form>
                    <?php
                }
                ?>
                <p><a href="/login/" class="grey-text">Back To Login</a></p>
            </div>
        </div>        
        <span class="btn-close js-close-account"></span>
        <span class="ovl"></span>
    </div>
  </div>
</div>
 
<?php get_footer() ?>