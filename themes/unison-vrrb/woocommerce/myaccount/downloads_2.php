<?php
/**
 * Downloads
 *
 * Shows downloads on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/downloads.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if(empty($_GET['stat'])){
    
    header('Location: '.$_SERVER['REQUEST_URI'].'?stat=r');
}
$customer_orders = get_posts(array(
    'numberposts' => -1,
    'meta_key' => '_customer_user',
    'orderby' => 'date',
    'order' => 'DESC',
    'meta_value' => get_current_user_id(),
    'post_type' => 'shop_order',
    'post_status' => array_keys(wc_get_order_statuses()), 'post_status' => array('completed'),
));
$user_id = get_current_user_id();
$createArraysub = array();
$subscription_id='';
$d_limit = '';
if(!empty($customer_orders)){
    foreach($customer_orders as $customer_order){

        $order = wc_get_order( $customer_order->ID );

        
        foreach ($order->get_items() as $item_key => $item ){

            $product_id   = $item->get_product_id();
            
            if(empty($product_id)){continue;}

            if($product_id != '486634' && $product_id != '714108'){

                $product      = $item->get_product();
                $item_name    = $item->get_name();
                

                foreach( $product->get_downloads() as $key_download_id => $download ) {
                    $dlimi = get_post_meta( $product_id, '_download_limit_'.$customer_order->ID, true );
                    if($dlimi == ''){
                        $dlimi = get_post_meta( $product_id, '_download_limit', true );
                    }

                    $get_name = $download->get_name();
                    $btname = explode("/",$get_name);
                    $get_file = $download->get_file();
                    $download_link = $download->get_file();
                    $is_downloads = (bool) $download;
                    if($is_downloads){
                     ?>
                    <div class="align-items-center border-bottom py-3" style="border-bottom:1px solid #393939 !important;">
                        <div class="media-body">
                            <div class="row col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left align-items-lg-center align-items-md-top mx-auto p-0">
                                <div class=" col-xxxl-2 col-xxl-2 col-xl-2 col-lg-2  col-md-3 col-sm-3 col-xs-3 pl-0">
                                    <img class="product-img pl-0" src="<?php echo get_the_post_thumbnail_url($product_id, 'thumbnail') ?>" alt="Generic placeholder image ">
                                </div>
                                  <div class="row col-xxxl-10 col-xxl-10 col-xl-10 col-lg-10 col-md-9 col-sm-9 col-xs-9 p-0 text-left ">
                                    <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12  text-left ">
                                        <h5 class="mt-0"><?php echo $item_name; ?></h5>
                                        <h6 class="font-weight-normal m-10"><?php echo $btname[0] ?></h6>
                                        <p class="text-grey"><?php if($dlimi != '' && $dlimi >= 0 ){ echo $dlimi;}else{ echo '∞'; } ?>
                                    Downloads remaining</p>
                                    </div>
                                    <div class="d-flex col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6  col-md-12 col-sm-12 col-xs-12 justify-content-lg-end justify-content-start pr-lg-0 align-items-center">
                                        <a href="<?php if($dlimi <= '0'){echo '#';}else{ echo $download_link; } ?>" <?php if($dlimi == '0'){ echo 'style="pointer-events: none;background-color: #7e7e7e !important;border: 0"';} ?> class="btn-download btn-download_limit" data-proid="<?php echo $product_id;?>"data-orderid="<?php echo $customer_order->ID;?>" <?php if($btname[2] != ''){echo 'target="_blank"';} ?> > <?php if( $btname[1] != ''){echo $btname[1];}else{echo 'DOWNLOAD';} ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                }
            }  

            if($product_id == '486634' || $product_id == '714108'){
                $customer_subscriptions = get_posts( array(
                    'numberposts' => -1,
                    'meta_value'  => get_current_user_id(), // user_id
                    'post_type'   => 'shop_subscription', // WC orders post type
                    'post_status' => 'all' // complete order
                ));
                
                if(count($customer_subscriptions) > 0){
                    foreach ($customer_subscriptions as $key => $value) {
                        $subscription_id = $value->ID;
                    }
                }

            }
        }
    }
    if(!empty($subscription_id)){
        $type = $item->get_meta('type');
        $subscriptionmetaold = get_post_meta( $subscription_id );


        $variations = get_variations_for_product($product_id);
        foreach($variations as $variation){
            $protypecheck = explode(': ',$variation->post_excerpt)[1];
            $variation_pro = wc_get_product($variation->ID); 

            $product_paremt = $variation_pro->get_parent_id();
            
            $acftype = '';
            if($protypecheck == $type){
                if($type == 'Plus'){
                    $acftype = 'plus';
                }
                if($type == 'Lite'){
                    $acftype = 'light';
                }
                if($type == 'Pro'){
                    $acftype = 'pro';
                }
            }
            $bonuses = get_field('bonus_variation_products_'.$acftype, $product_paremt);
            if(!empty($bonuses)){
            ?>
            <div class="col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-11 col-xs-10 col-sm-11 mx-auto pt-2">
                <div class='row flex-xxxl-column-reverse flex-xxl-column-reverse flex-xl-column-reverse flex-lg-column-reverse flex-md-column-reverse flex-sm-column-reverse flex-xs-column-reverse flex-xxxl-row justify-content-between'>
                    <div class="col-xxxl-12 col-xxl-12 col-xl-12 col-md-12 col-xs-12 col-sm-12 col-lg-12 mx-auto pl-0">
                        <p class="p2 ml-0 text-grey">Bonuses</p>
                        <div class="align-items-center" style='border-bottom: 1px solid #393939a6 !important;'>
                            <div class="media-body">
                                <?php 

                                $subscription_id_dwnld = array();;
                                $customer_subscriptions = get_posts( array(
                                    'numberposts' => -1,
                                    'meta_value'  => get_current_user_id(), // user_id
                                    'post_type'   => 'shop_subscription', // WC orders post type
                                    'post_status' => 'wc-active' // complete order
                                ));
                                if(count($customer_subscriptions) > 0){
                                    foreach ($customer_subscriptions as $key => $value) {      
                                        $subscription_id_dwnld = $value->ID;
                                    }
                                }

                                foreach($bonuses as $bonuses_ids){
                                    

                                    //echo $bonuses_ids;
                                    $metadld = get_post_meta($bonuses_ids);
                                    $product = wc_get_product( $bonuses_ids );
                                    $downloads = $product->get_downloads();
                                    foreach( $downloads as $key => $each_download ) {
                                        $get_name = $each_download->get_name();
                                        $btname = explode("/",$get_name);
                                        $dataproduct = $product->get_data();
                                        $numbonus = explode(':', $dataproduct['name'])[0];
                                        $dlimi = get_post_meta( $bonuses_ids, '_download_limit_'.$subscription_id_dwnld, true );
                                        if($dlimi == ''){
                                            $dlimi = get_post_meta( $bonuses_ids, '_download_limit', true );
                                        }
                                        ?>
                                        <div class="row bonusrow col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left align-items-lg-center align-items-md-top mx-auto p-0" style='border-bottom: 1px solid #393939a6 !important;'>
                                            <div class=" col-xxxl-2 col-xxl-2 col-xl-2 col-lg-2  col-md-3 col-sm-3 col-xs-3 pl-0">
                                                <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($bonuses_ids)); ?> " class="img-fluid w-100 m-0 p-0" alt="Ultimate key">
                                            </div>
                                            <div class="row col-xxxl-10 col-xxl-10 col-xl-10 col-lg-10 col-md-9 col-sm-9 col-xs-9 p-0 text-left ">
                                                <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12  text-left ">
                                                    <h5 class="mt-0"><?php echo $dataproduct['name']; ?></h5>
                                                    <!-- <h6 class="font-weight-normal m-10"><?php echo $download['product_name']; ?></h6> -->
                                                    <p class="text-grey dwontolimit"><?php if($dlimi != '' && $dlimi >= 0){ echo $dlimi; }else{ echo '∞'; } ?>
                                                        Downloads remaining</p>
                                                </div>
                                                <div class="d-flex col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6  col-md-12 col-sm-12 col-xs-12 justify-content-lg-end justify-content-start pr-lg-0 align-items-center">

                                                    <a href="<?php if($dlimi <= '0'){echo '#';}else{ echo $each_download["file"]; } ?>" <?php if($dlimi <= '0'){ echo 'style="pointer-events: none;background-color: #7e7e7e !important;border: 0"';} ?> class="btn-download btn-download_limit" data-proid="<?php echo $bonuses_ids;?>"data-orderid="<?php echo $subscription_id_dwnld?>" <?php if($btname[2] != ''){echo 'target="_blank"';} ?> > <?php if( $btname[1] != ''){echo $btname[1];}else{echo 'DOWNLOAD';} ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    } 
                                } ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }


            $prokeys1 = $variation->ID.'_purchased_month_packs';

            if($subscriptionmetaold[$prokeys1][0] == '' ){
                $prodnldsmeta = get_post_meta( $subscription_id, 'purchased_month_packs', true );
                $x = wcs_get_subscription( $subscription_id );
                
                foreach ( $x->get_items() as $item_id => $item ) {
                    $product = $item->get_product();

                    //$product->get_name();
                    $files = $product->get_downloads();
                    foreach ($files as $file) {
                        if($prodnldsmeta == $file['name']){
                            $createArraysub[] = array(
                                "product_name" => $product->get_name(),
                                "product_url" => get_permalink($product->get_id()), 
                                "downloads_remaining" => "",
                                "access_expires" => NULL, 
                                "download_url" => $file['file'],
                                "download_id" => $file['id'], 
                                "download_name" => $file['name'],
                                "product_id" => $product->get_id(),
                                "file" => array( 
                                    "name"=> $file['name'],
                                    "file"=> $file['file']
                                )
                            );
                        }
                    }
                }

            }
        }
        
       
        foreach($variations as $variation){
            $protypecheck = explode(': ',$variation->post_excerpt)[1];
            $variation_pro = wc_get_product($variation->ID); 

            $product_paremt = $variation_pro->get_parent_id();
            $prokeys1 = $variation->ID.'_purchased_month_packs';
            if($subscriptionmetaold[$prokeys1][0] != '' ){
                $provaraitions = array();
                $subscription = new WC_Subscription( $subscription_id );
                
                
                $product = wc_get_product( $variation->ID );
                $prokeys = $variation->ID.'_purchased_month_packs';
                $subscriptionmeta = get_post_meta( $subscription_id );

                    

                $prodnldsmeta = get_post_meta( $subscription_id, $prokeys, true );
                $product = wc_get_product( $variation->ID );
                $product_name = explode('(',$product->get_formatted_name())[0];
                

                if(!empty($prodnldsmeta)){
                    $sub_purchased_audios = explode(',',$prodnldsmeta);
                    if(!empty($sub_purchased_audios)){
                        foreach($sub_purchased_audios as $sub_purchased_audio){
                            if($sub_purchased_audio == 'August 2021'){
                                $sub_purchased_audio = 'Summer 2021';
                            }
                            
                            $files = $product->get_downloads();
                            foreach ($files as $file) {
                                if($sub_purchased_audio == $file['name']){
                                    $createArraysub[] = array(
                                        "product_name" => $product_name,
                                        "product_url" => get_permalink($variation->ID), 
                                        "downloads_remaining" => "",
                                        "access_expires" => NULL, 
                                        "download_url" => $file['file'],
                                        "download_id" => $file['id'], 
                                        "download_name" => $file['name'],
                                        "product_id" => $variation->ID,
                                        "file" => array( 
                                            "name"=> $file['name'],
                                            "file"=> $file['file']
                                        )
                                    );
                                }
                            }

                        }
                    }
                    
                }
                
            }
            
        }
        $userdupe=array();

        foreach ($createArraysub as $index=>$t) {
            if (isset($userdupe[$t["download_id"]])) {
                unset($createArraysub[$index]);
                continue;
            }
            $userdupe[$t["download_id"]]=true;
        }
        //array_unique($userdupe, SORT_REGULAR)
        foreach($createArraysub as $download){ 

                //$valuesd[] = $download['file']['name'];
                ?>
                <div class="align-items-center border-bottom" style="padding: 10px 0; border-bottom: 1px solid #393939 !important;">
                    <div class="media-body">
                        <div class="row col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left align-items-lg-center align-items-md-top mx-auto p-0">
                            <div class=" col-xxxl-2 col-xxl-2 col-xl-2 col-lg-2  col-md-3 col-sm-3 col-xs-3 pl-0">
                                <img class="product-img pl-0" src="<?php echo get_the_post_thumbnail_url($download['product_id'], 'thumbnail') ?>" alt="Generic placeholder image ">
                            </div>
                            <div class="row col-xxxl-10 col-xxl-10 col-xl-10 col-lg-10 col-md-9 col-sm-9 col-xs-9 p-0 text-left ">
                                <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12  text-left ">
                                    <h5 class="mt-0"><?php echo $download['file']['name']; ?></h5>
                                    <h6 class="font-weight-normal m-10"><?php echo $download['product_name']; ?></h6>
                                    <p class="text-grey"><?php if($download['downloads_remaining'] != ''){ echo $download['downloads_remaining'];}else{ echo '∞'; } ?>
                                        Downloads remaining</p>
                                </div>
                                <div class="d-flex col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6  col-md-12 col-sm-12 col-xs-12 justify-content-lg-end justify-content-start pr-lg-0 align-items-center">
                                    <a href="<?php echo $download['download_url'] ?>" class="btn-download btn-download_limit"data-proid="<?php echo $product->get_id();?>">DOWNLOAD</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php

            
            
        }
        // echo '<pre>';
        //     print_r($createArraysub);
        // echo '</pre>';
        //$results = array_unique($createArraysub);
        
    }
}
