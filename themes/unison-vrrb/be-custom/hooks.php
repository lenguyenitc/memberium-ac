<?php

// Try to cancel a paypal once the switch has been successfully completed
add_action( 'woocommerce_subscriptions_switch_completed', 'update_payment_method_after_switch', 10, 1 );
function update_payment_method_after_switch($order){

  $pay_new = $order->get_payment_method();
  //$pay_old = $order->get_meta( '_old_payment_method' );

  if($pay_new != '' && $pay_new != 'manual'){
    $subscriptions = wcs_get_subscriptions_for_order( $order, array( 'order_type' => 'switch' ) );
    foreach ( $subscriptions as $subscription ) {
      // restore payment meta to the new data
      $subscription->set_payment_method( $pay_new );
			$subscription->set_requires_manual_renewal( false );
			$subscription->save();
    }
  }

}


//Update meta user after change paypal method
add_action('init','unison_update_change_acc_paypal_method');
function unison_update_change_acc_paypal_method(){

   if(isset($_GET['woo-paypal-return']) && $_GET['woo-paypal-return'] &&
        isset( $_GET['token'] ) && $_GET['token']){

          $session = WC()->session->get( 'paypal' );

          if ( isset( $_GET['token'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            $token = sanitize_text_field( wp_unslash( $_GET['token'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
          } elseif ( isset( $session->token ) ) {
            $token = $session->token;
          }

          if ( ! isset( $token ) ) {
            return;
          }

          if ( empty( $session ) || (! $session || ! is_a( $session, 'WC_Gateway_PPEC_Session_Data' ) || $session->expiry_time < time() || $token !== $session->token) ) {
       			return;
       		}

           // Get the info we need and create the billing agreement.
       		$order = wc_get_order( $session->order_id );

       		$client   = wc_gateway_ppec()->client;
       		$response = $client->get_express_checkout_details( $token );

       		if ( $client->response_has_success_status( $response ) ) {
       			$checkout_details = new PayPal_Checkout_Details();
       			$checkout_details->loadFromGetECResponse( $response );
            $email =$checkout_details->payer_details->email;
            $time = current_time( 'timestamp', 0 );
            $user_id = get_current_user_id();

            //update data user
            update_user_meta( $user_id, '_email_paypal', $email );
            update_user_meta( $user_id, '_time_update_email_paypal', $time );

       		}

  }

}

//Custom redirect paypal
add_action( 'wp', 'unison_maybe_return_from_paypal' );
function unison_maybe_return_from_paypal(){
    // phpcs:disable WordPress.Security.NonceVerification.Recommended
    if (
      isset( $_GET['woo-paypal-return'] )
      && isset( $_GET['update_subscription_payment_method'] )
      && 'true' === $_GET['update_subscription_payment_method']
    ) {
      return;
    }

    if ( empty( $_GET['woo-paypal-return'] ) || empty( $_GET['token'] ) ) {
      return;
    }

    $token                    = $_GET['token']; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized,WordPress.Security.ValidatedSanitizedInput.MissingUnslash
    $create_billing_agreement = ! empty( $_GET['create-billing-agreement'] );
    $session                  = WC()->session->get( 'paypal' );

    if ( empty( $session ) ) {
      return;
    }

    $order = wc_get_order( $session->order_id );

    $client   = wc_gateway_ppec()->client;
    $response = $client->get_express_checkout_details( $token );

    if ( !$client->response_has_success_status( $response ) ) {
      // Redirect
      wp_redirect( $order->get_checkout_order_received_url() );
      exit();
		}

}


// Make zip/postcode field optional
//add_filter( 'woocommerce_default_address_fields' , 'unison_optional_unrequired' );
function unison_optional_unrequired( $p_fields ) {
  $p_fields['postcode']['required'] = false;
  return $p_fields;
}

//Add css on head
add_action('wp_head', 'bt_unison_add_css');
function bt_unison_add_css(){
  ?>
  <style media="screen">
      body #wfacp-e-form .wfacp_main_form.woocommerce .woocommerce-checkout #payment ul.payment_methods li.payment_method_ppec_paypal>label{
          float:inherit;
          color: #494949;
          font-weight: 600;
          font-size: 18px;
          margin-left: 8px;
      }
      .order_details .product-name .wcs-switch-link{
        display: inline-block;
        pointer-events: auto;
        display: none;
      }
      html body .button.cancel:hover::before{ display: none !important }
      .woocommerce-NoticeGroup.woocommerce-NoticeGroup-checkout{
        display: block;
      }
      #woo_edit_account .personal-info li{
        display: block;
      }
      #woo_edit_account .personal-info li>label{
        width: 100%;
        text-align: left;
        margin-bottom: 5px;
      }
      #woo_edit_account .personal-info li>input{
        width: 100%;
        color: #000;
        margin-bottom: 0;
      }
      .mbr-portal-account-details div.perfmatters-lazy{
        display: none;
      }
  </style>
  <?php
  if(isset($_GET['woo-paypal-return']) && is_checkout()){
    ?>
      <style media="screen">
        header,footer,.template-auto-trigger-payment form{
          display: none;
        }
        .template-auto-trigger-payment{
          height: 100%;
          position: absolute;
          width: 100%;
          display: flex;
          justify-content: center;
          align-items: center;
        }
        .template-auto-trigger-payment img.ajax-loading-payment{
          width: 50px;
          opacity: 0.5;
        }
        .template-auto-trigger-payment.closed{
          display: block;
          position: relative;
        }
        .template-auto-trigger-payment.closed img.ajax-loading-payment{
          display: none;
        }
      </style>
    <?php
  }
}

//Add css on head
add_action('wp_footer', 'bt_unison_add_script', 9999);
function bt_unison_add_script(){
  if(isset($_GET['woo-paypal-return'])){
    ?>
    <script type="text/javascript">

      const myCheckout = setInterval(myCheckoutPayment, 1000);
      var checkError = $('.woocommerce-error').text();

      function myCheckoutPayment() {
          var checkError = $('.woocommerce-error').text();
          if(checkError){
            $('header').show();
            $('footer').show();
            $('.template-auto-trigger-payment form').show();
            $('.template-auto-trigger-payment').addClass('closed');
            clearCheckoutPayment();
          }else{
            $('.complete-payment-button').click();
          }
      }

      function clearCheckoutPayment() {
        clearInterval(myCheckout);
      }

    </script>
    <?php
  }
}

//Hook change Upgrade / DownGrade for SUB WOO
//add_filter('woocommerce_subscriptions_switch_url','unison_woocommerce_subscriptions_switch_url_func',10,4);
function unison_woocommerce_subscriptions_switch_url_func($switch_url, $item_id, $item, $subscription ){
  //$product  = wc_get_product( $item['product_id'] );
  //$permalink_p = get_permalink( $product->get_id() );
  return '#popup-upgrade';
}

//add_filter('woocommerce_subscriptions_switch_link', 'unison_woocommerce_subscriptions_switch_link_func' , 10 , 4);
function unison_woocommerce_subscriptions_switch_link_func($switch_link, $item_id, $item, $subscription){
  if($subscription->get_payment_method() == 'ppec_paypal') $switch_link = '';
  return $switch_link;
}

//add_action( 'template_redirect', 'unison_woocommerce_redirect_after_checkout');
function unison_woocommerce_redirect_after_checkout(){
    global $wp; $woocommerce;
    if ( is_checkout() && !empty( $wp->query_vars['order-received'] ) ) {
        wp_safe_redirect( home_url().'/mbr-midibox-upgrade-thank-you/' );
        exit;
    }
}

//Remove required field requirement for first/last name in My Account Edit form
//add_filter('woocommerce_billing_fields', 'unison_remove_required_fields');
function unison_remove_required_fields( $fields ) {

      // Billing fields
      $fields['billing_company']['required'] = false;
      $fields['billing_email']['required'] = false;
      $fields['billing_phone']['required'] = false;
      $fields['billing_state']['required'] = false;
      $fields['billing_first_name']['required'] = false;
      $fields['billing_last_name']['required'] = false;
      $fields['billing_address_1']['required'] = false;
      $fields['billing_address_2']['required'] = false;
      $fields['billing_city']['required'] = false;
      $fields['billing_postcode']['required'] = false;

      return $fields;
}

add_filter('woocommerce_paypal_express_checkout_needs_billing_agreement',function($billing_agreement){
  return false;
});

//Remove post
//add_action('init','unison_remove_posts');
function unison_remove_posts(){

  if(isset($_GET['remove_post'])){
    $paged = isset($_GET['paged']) ? $_GET['paged']  : 1;
    $args = array(
      'post_type'  => 'shop_order',
      'post_status' => 'any',
      'posts_per_page' => 300,
      'paged' => $paged
    );

    $the_query = new WP_Query( $args );
    $item = 0;
    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
          $the_query->the_post();
          $p_id = get_the_ID();
          $p_date = strtotime(get_the_date());
          $before_month =  strtotime ( '-10 days' , current_time( 'timestamp', 0 ) ) ;
          if($before_month >= $p_date){
            wp_delete_post($p_id);
            echo $item.': '.$p_id.'<br>';
            $item++;
          }
        }
    }
    /* Restore original Post Data */
    wp_reset_postdata();
    echo 'success!!';
    die;
  }
}
 ?>
