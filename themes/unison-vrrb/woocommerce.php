<?php get_header(); ?>
	
<?php 
if (have_posts()) {

	woocommerce_content(); 	
}

?>
<?php get_footer(); ?>