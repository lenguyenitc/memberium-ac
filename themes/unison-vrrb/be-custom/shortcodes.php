<?php

//Shortcode will show button "Reactivate" for subscription WooCommerce
function unison_reactivate_subscription_func( $atts ) {
	$atts = shortcode_atts( array(
		'product_id' => '',
    'text_btn' => 'Reactivate Subscription',
    'layout' => 'center',
	), $atts );

  ob_start();
  ?> <div class="be-unison-reactivate-template" style="text-align: <?php echo $atts['layout']; ?>">
    <?php
      if($atts['product_id']){
        $product_id = $atts['product_id'];
        $product = wc_get_product($product_id);
        if ( !empty($product) && $product->is_type( 'variable' ) ) {
            $user_id = get_current_user_id();
            $subscriptions = wcs_get_subscriptions(array(
                'customer_id' => $user_id,
                'subscription_status' => 'any',
                'subscriptions_per_page' => - 1,
                'orderby' => 'start_date',
                'order' => ASC
            ));

            if(!empty($subscriptions)){
                $subscription_current = '';
                foreach ($subscriptions as $key => $subscription) {
                      foreach ( $subscription->get_items() as $item_id => $item ) {
                          //Check product
                          $p_id = $item->get_product_id();
                          if($product_id == $p_id){
                            $subscription_current = $subscription;
                            break;
                          }
                      }
                }
                if($subscription_current){
                    $status = $subscription_current->get_status();
                    $sub_id = $subscription_current->get_ID();
                    if($status == 'cancelled' || $status == 'pending-cancel'){
                      $actions = wcs_get_all_user_actions_for_subscription($subscription_current,$user_id);
                      foreach ($actions as $key_ac => $action) {
                        if($key_ac == 'reactivate'):
                          ?>
                          <a href="<?php echo $action['url'] ?>" class="btn reactivate"><?php echo $atts['text_btn']; ?></a>
                          <?php
                        endif;
                      }
                    }
                }else{
                  echo '<div class="error-message">Not find any subscription for this product!</div>';
                }
            }else{
              echo '<div class="error-message">This product doen\'t have any subscriptions yet!</div>';
            }
        }else{
          echo '<div class="error-message">This is not a product variation!</div>';
        }
      }else{
        echo '<div class="error-message">You have not set <strong>[product_id]</strong> for this shortcode yet!</div>';
      }
     ?>
  </div> <?php
  return ob_get_clean();
}
add_shortcode( 'unison_reactivate_subscription', 'unison_reactivate_subscription_func' );


 ?>
