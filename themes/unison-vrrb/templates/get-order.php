<?php
/*
 * Template Name: Get Orders Test
 *
 * */

get_header('cart');
global $post,$wpdb;

$customer = wp_get_current_user(); // customer data object
    
?>
<style>
    p{
        /*color:white;*/
    }
    </style>
<p>

<?php
die;
$all_switch_orders = wcs_get_switch_orders_for_subscription(498943);

foreach($all_switch_orders as $key => $all_orders){
    $sub = $key;
    echo $key;
    var_dump(get_post_meta( $sub, 'purchased_month_packs', true ));
}
die;

$wc_gateways      = new WC_Payment_Gateways();
$payment_gateways = $wc_gateways->get_available_payment_gateways();
$paypal = $payment_gateways['paypal'];
if($paypal){
    $test_mode = $paypal->testmode;
    if($test_mode){
        $username = $paypal->settings['sandbox_api_username'];
        $password = $paypal->settings['sandbox_api_password'];
        $signature = $paypal->settings['sandbox_api_signature'];
    }else{
        $username = $paypal->settings['api_username'];
        $password = $paypal->settings['api_password'];
        $signature = $paypal->settings['api_signature'];
    }
}
die;
$payment_gateways = WC()->payment_gateways->payment_gateways();
$order->set_payment_method($payment_gateways['bacs']);
die;
$order_ids = array();
$all_switch_orders = wcs_get_switch_orders_for_subscription(498660);
foreach($all_switch_orders as $all_orders){
    $order_key = $all_orders->order_key;
    $order_id = wc_get_order_id_by_order_key($order_key);
    $order_ids[] = $order_id;
}

if(count($order_ids) > 0){
    $latest_order = max($order_ids);
    $get_order = wc_get_order( $latest_order );
    foreach($get_order->get_items() as $item_id => $item){
        $product_id = $item->get_product_id();
        $variation_id = $item->get_variation_id();
        var_dump($variation_id);
        echo "<br>";
    }
}

die;
// Get all customer orders
$subscription = wcs_get_subscription(498410);
$end_date = date("Y-m-d H:i:s", strtotime("+1 month", strtotime($subscription->start_date)));
$current_date = date('Y-m-d H:i:s');

if($end_date > $current_date){
    echo "not expire";
}else{
    echo "expire";
}
?>
</p>
