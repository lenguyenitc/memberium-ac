<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))).('/wp-config.php'));

 $p_downloads = '';

$args = array(
	'posts_per_page'   => 1,
	'include'          => $_REQUEST['product_id'] ,
	'post_type'        => 'product',
	'post_status'      => 'publish',
	);

 $products = get_posts( $args);
 foreach( $products as $product ) :
  setup_postdata($product);  
     $p_downloads = print_r($product->get_files(), true);
		$product_price = get_post_meta( $_REQUEST['product_id'], '_price', true );
		$p_type_free = get_post_meta( $_REQUEST['product_id'], '_downloadable', true );
		$product_link = get_post_permalink( $_REQUEST['product_id'] );
		$product_title = get_the_title( $_REQUEST['product_id'] );

      endforeach; 

$data = array('product_price' => $product_price, 'product_link' => $product_link, 'product_title' => $product_title, 'p_downloads' =>$p_downloads, 'type_p' =>$p_type_free);
wp_send_json( $data );

?>