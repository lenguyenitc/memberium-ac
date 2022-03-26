<?php
/*
Template Name: WebhookactiveCampaign 
*/
error_reporting(E_ALL);
ini_set("display_errors","1");
require_once(dirname(dirname(dirname(dirname(__FILE__)))).('/wp-config.php'));
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST;
    if(isset($data['contact']) && !empty($data['contact'])){
	    if(isset($data['list']) && ($data['list']!=3)){

	    	$contact = $data['contact'];
	    	$password = wp_generate_password(6,false);
		    $new_user_id = wp_insert_user(array(
					'user_login'		=> $contact['email'],
					'user_pass'	 		=> $password,
					'user_email'		=> $contact['email'],
					'first_name'		=> $contact['first_name'],
					'last_name'			=> $contact['last_name'],
					'user_registered'	=> date('Y-m-d H:i:s'),
					'role'				=> 'subscriber'
				)
			);

			if($new_user_id) {
				// send an email to the admin alerting them of the registration
				//wp_new_user_notification($new_user_id);
				$user_info = get_userdata($new_user_id);
				if(!empty($user_info)){

					$reset_key = uniqid('un', true);

					update_user_meta($new_user_id, 'reset_password_key', $reset_key);

					$password_reset_link = '<a href="'.site_url().'/reset/?reset_key='.$reset_key.'&user_email='.$contact['email'].'">Please choose a password for your new account here.</a>';
					
					 sib_trigger(array(
	                                'id' => 13,
	                                'to' =>  $contact['email'],
	                                'attr' => array(
	                                'EMAIL' =>  $contact['email'],
	                                //'NAME' => $contact['first_name'].' '.$contact['last_name'],
	                                //'FIRSTNAME' => $contact['first_name'],
	                                //'USERNAME' => $contact['email'],
	                                'PASSWORD_REST_LINK' => $password_reset_link,
	                               )
	                            ));
					
				}

			}
			////////////
			//product assign
			global $woocommerce,$post,$wpdb;       
	        ob_start();
	        $listProducts = get_option("aclist_".$data['list']."_product_ids");
	        foreach($listProducts as $listProduct ){
		        $product_id = $listProduct;
		        $product_title = 'test';
		        $product_downloadable  = 'yes';
		        $product_price = '0';
		        $product_downloads = '';
				$args = array(
					'posts_per_page'   => 1,
					'include'          => $product_id ,
					'post_type'        => 'product',
					'post_status'      => 'publish',
					);
				 $products = get_posts( $args);
				 foreach( $products as $product ) :
				  setup_postdata($product);  
				     $product_downloads = print_r($product->get_files(), true);
				 endforeach; 

		        $quantity = 1;
		        $product_status = get_post_status( $product_id );
			    if($product_downloadable == 'yes'){
					$user =  get_user_by( 'email', $contact['email'] ); 
					$user =  $user->ID; 
			        $def_args = array('customer_id' => $user, 'status' => 'completed');
			        $order = wc_create_order($def_args);
			        $order->add_product( get_product( $product_id ), 1 ); 
			        //(get_product with id and next is for quantity)
			        $order->calculate_totals();
					$results = $wpdb->get_results("SELECT * FROM `wp_woocommerce_order_items` ORDER BY `wp_woocommerce_order_items`.`order_item_id` DESC LIMIT 1");
					foreach ( $results as $result){
						 $id = $result->order_id;
					}
					wc_downloadable_product_permissions($id,$quantity);
					
		    	}
	    
			}
			//////////// end product access
		}
	}
    exit;
}
?>