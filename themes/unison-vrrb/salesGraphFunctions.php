<?php
add_action('init', 'cs_add_author_woocommerce_product', 999);
function cs_add_author_woocommerce_product() {
  add_post_type_support('product', 'author');
}

add_action('wp_ajax_csGetSalesReport', 'get_sales_report');
add_action('wp_ajax_nopriv_csGetSalesReport', 'get_sales_report');

function get_sales_report() {
  parse_str($_REQUEST['csSalesRecordData']);
  // echo $cs_from_date . "<br>";
  // echo $cs_to_date;
  $new_end_date = date("Y-m-d", strtotime("+1 day", strtotime($cs_to_date)));
  global $wpdb;
  $user_id = get_current_user_id();
  $args = array(
    'post_type' => 'product',
    'post_status' => 'publish',
    'posts_per_page' => 1,
    'author' => $user_id,
  );

  $current_user_product = get_posts($args);
  $product_id = $current_user_product[0]->ID;
  $order_status = array('wc-completed', 'wc-processing', 'wc-on-hold');
  $total_amount = '';
  $results = array();
  $results = $wpdb->get_results("
  SELECT order_items.order_id, order_items.order_item_id,posts.post_date
  FROM {$wpdb->prefix}woocommerce_order_items as order_items
  LEFT JOIN {$wpdb->prefix}woocommerce_order_itemmeta as order_item_meta ON order_items.order_item_id = order_item_meta.order_item_id
  LEFT JOIN {$wpdb->posts} AS posts ON order_items.order_id = posts.ID
  WHERE posts.post_type = 'shop_order'
  AND posts.post_status IN ( '" . implode("','", $order_status) . "' )
  AND posts.post_date >= '$cs_from_date'
  AND posts.post_date <= '$new_end_date'
  AND order_items.order_item_type = 'line_item'
  AND order_item_meta.meta_key = '_product_id'
  AND order_item_meta.meta_value = '$product_id'
  ");

  // month_difference
  $month_difference = date("m", strtotime($cs_to_date)) - date("m", strtotime($cs_from_date));

  $order_parameters = array();
  $coumn_title = array();
  $total_transactions = array();
  //When filter is selected for month duration
  if (date("Y-m", strtotime($cs_from_date)) == date("Y-m", strtotime($cs_to_date))) {
    foreach ($results as $key => $value) {
      $post_date = date("d M", strtotime($value->post_date));

     $bundle_product_data = get_post_meta($value->order_id, 'order_transaction_orders_bundle_product', true);
      if ($bundle_product_data['csmultiplecheckout_divide_bundle_order'][0] == 'yes') {
       $order = wc_get_order( $value->order_id );
       $items_count = count($order->get_items());
       $actual_bundle_product_total = $bundle_product_data['divide_bundle_order_total'];
       $order_parameters[] = array($post_date, round(($order->get_total()/$items_count),0));
       $total_amount += round(($order->get_total()/$items_count),0);
     } else {
       $total_amount += wc_get_order_item_meta($value->order_item_id, '_line_total');
       $order_parameters[] = array($post_date, wc_get_order_item_meta($value->order_item_id, '_line_total'));
     }

      $total_transactions[] = $value->order_id;
      
    }

    //Month Array
    $array_months = array();
    for ($x = date("j", strtotime($cs_from_date)); $x <= date("d", strtotime($cs_to_date)); $x++) {
      if ($x < 10) {
        $x = '0' . $x;
      }
      $array_months[$x . ' ' . date("M", strtotime($cs_from_date))] = 0;
    }

  } elseif (date("Y-m", strtotime($cs_from_date)) != date("Y-m", strtotime($cs_to_date)) && $month_difference <= 3 && date("Y", strtotime($cs_from_date)) == date("Y", strtotime($cs_to_date))) {
    foreach ($results as $key => $value) {
      $post_date = date("d M", strtotime($value->post_date));

      $bundle_product_data = get_post_meta($value->order_id, 'order_transaction_orders_bundle_product', true);
      if ($bundle_product_data['csmultiplecheckout_divide_bundle_order'][0] == 'yes') {
       $order = wc_get_order( $value->order_id );
       $items_count = count($order->get_items());
       $actual_bundle_product_total = $bundle_product_data['divide_bundle_order_total'];
       $order_parameters[] = array($post_date, round(($order->get_total()/$items_count),0));
       $total_amount += round(($order->get_total()/$items_count),0);
     } else {
       $total_amount += wc_get_order_item_meta($value->order_item_id, '_line_total');
       $order_parameters[] = array($post_date, wc_get_order_item_meta($value->order_item_id, '_line_total'));
     }
       $total_transactions[] = $value->order_id;
    }

    //Month Array
    $array_months = array();
    $start_date = date("Y-m-d", strtotime($cs_from_date));
    $end_date = date("Y-m-d", strtotime($cs_to_date));
    while (strtotime($start_date) <= strtotime($end_date)) {
      //echo "$start_date\n";
      $array_months[date("d M", strtotime($start_date))] = 0;
      $start_date = date("Y-m-d", strtotime("+1 day", strtotime($start_date)));
    }

  } elseif (date("Y-m", strtotime($cs_from_date)) != date("Y-m", strtotime($cs_to_date))) {
    foreach ($results as $key => $value) {
      $post_date = date("M Y", strtotime($value->post_date));

      $bundle_product_data = get_post_meta($value->order_id, 'order_transaction_orders_bundle_product', true);
      if ($bundle_product_data['csmultiplecheckout_divide_bundle_order'][0] == 'yes') {
       $order = wc_get_order( $value->order_id );
       $items_count = count($order->get_items());
       $actual_bundle_product_total = $bundle_product_data['divide_bundle_order_total'];
       $order_parameters[] = array($post_date, round(($order->get_total()/$items_count),0));
       $total_amount += round(($order->get_total()/$items_count),0);
     } else {
       $total_amount += wc_get_order_item_meta($value->order_item_id, '_line_total');
       $order_parameters[] = array($post_date, wc_get_order_item_meta($value->order_item_id, '_line_total'));
     }
      $total_transactions[] = $value->order_id;
    }
    //Years Month Array
    $array_months = array();
    $start_date = date("Y-m-d", strtotime($cs_from_date));
    $end_date = date("Y-m-d", strtotime($cs_to_date));
    while (strtotime($start_date) <= strtotime($end_date)) {
      //echo "$start_date\n";
      $array_months[date("M Y", strtotime($start_date))] = 0;
      $start_date = date("Y-m-d", strtotime("+1 month", strtotime($start_date)));
    }
  }

  $coumn_title[] = array('Sales', 'Amount($)');

  $total_amt_search = $total_amount;
  $total_txn_search = count($total_transactions);

  $order_res = array();
  foreach ($order_parameters as $vals) {
    if (array_key_exists($vals[0], $order_res)) {
      $order_res[$vals[0]][1] += $vals[1];
      $order_res[$vals[0]][0] = $vals[0];
    } else {
      $order_res[$vals[0]] = $vals;
    }
  }

  $plot_res = array();
  foreach ($array_months as $key => $array_month) {
    if (array_key_exists($key, $order_res)) {
      $plot_res[$key] = $order_res[$key];
    } else {
      $plot_res[$key] = array($key, '0');
    }
  }

  $plot_array = array();
  foreach ($plot_res as $value) {
    $plot_array[] = $value;
  }
  $statics_data = json_encode(array_merge($coumn_title, $plot_array), JSON_NUMERIC_CHECK);
  $statics_data_new = json_decode($statics_data);
  echo json_encode(array('statics_data' => $statics_data_new, 'amount_data' => $total_amt_search, 'txn_data' => $total_txn_search));

  die;
}