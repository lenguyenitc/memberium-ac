<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $woocommerce_loop, $post;

?>
<div class="cont"><?php the_content();?></div>
<div style="margin-top: 200px;" id="samplepacks" class="rel-sam">
    <h2><span>Sample packs
 <?php

		$sold_by = get_option( 'wcpv_vendor_settings_display_show_by', 'yes' );
		if ( 'yes' === $sold_by ) {
			$sold_by = WC_Product_Vendors_Utils::get_sold_by_link( $post->ID );
			
		}

		?>

    </span></h2>
  
  <div class="home-slide--wrap" id="samplepack-slider">
    <div class="owl-carousel2">
      

	<?php

	if ( empty( $product ) || ! $product->exists() ) {
	return;
}

if ( ! $related = $product->get_related( $posts_per_page ) ) {
	return;
}

$loop = new WP_Query( array(
'post_type' => 'product',
'posts_per_page' => 500,
'order' => DESC,
'relation' => 'AND',

	'post__not_in'         => array( $product->id ),
'tax_query' => array (
    array(
		'taxonomy' => 'wcpv_product_vendors',
		'field' => 'slug',
		'terms' => $sold_by['name'],
	),
	array(
		'taxonomy' => 'product_cat',
		'field' => 'slug',
		'terms' => 'sample-packs',
	),
  )

));
$i = 0; 
$countPack = 0;
if ($loop->have_posts()) : while ( $loop->have_posts() ): $loop->the_post(); ?>

<?php 
$countPack++;
	if ($i == 0){
		echo '<div class="home-slide--item">
          <div class="samplepack-list js-samplepack-list">';
	}
	$i++;
?>
<div <?php post_class("samplepack-item"); ?>>
	<p>

		<a href="<?php the_permalink(); ?>">
		<?php 
			if( has_post_thumbnail() ) {
				the_post_thumbnail();
			}
			else {
				echo '<img src="'.get_bloginfo("template_url").'/images/UnisonLogo.jpg" />';
			}
		?>		
		</a>
	</p>
	<div class="copy">
		<h4>

			<a class="js-title-samplepacks" href="<?php the_permalink(); ?>">
				<?php the_title();  get_the_ID() ?>



			</a>
		</h4>
		<h6>Afreaux</h6>
		<p class="js-price-text">
			<?php woocommerce_template_loop_price(); ?>
		</p>

		<?php 

	
	
		$downloads = get_post_meta( get_the_ID(), '_downloadable_files', true);
		echo "<div class='ctas'>";
		$music = get_post_meta( $post->ID, '_music', true );
		  echo '<a href="#" class="btn-play js-sound" data-file="'.$music.'"></a>';
		woocommerce_template_loop_add_to_cart();
		echo '</div>';
	?>
	</div>
</div>
<?php
if ($i == 3){
	echo '</div></div>';
	$i = 0;
}
?>

<?php endwhile; ?>
<?php
    $ostPack = $countPack % 3;
    $ostPack = 3 - $ostPack;

  ?>

  <?php
  while($ostPack){
    echo '<div class="samplepack-item empty">
    <p><img src="'. get_bloginfo('template_url') .'/images/sample-empty.jpg"></p>
    <div class="copy">
      <h4></h4>
      <h6></h6>
    </div>
  </div>';
  $ostPack--;
  }
  ?>
  
<?php endif; ?>
<?php if(!$loop->have_posts()) : ?>
<?php 
  	

    
    $ostPacks = 3;
echo '<div class="home-slide--item">
          <div class="samplepack-list js-samplepack-list">';

  while($ostPacks){
    echo '<div class="samplepack-item empty">
    <p><img src="'. get_bloginfo('template_url') .'/images/sample-empty.jpg"></p>
    <div class="copy">
      <h4></h4>
      <h6></h6>
    </div>
  </div>';
  $ostPacks--;
  }
  
  	
   ?>
<?php endif; ?>
        </div>
      </div>
      
    </div>
    <ul class="dash js-dot"></ul>
    <p class="max-width">
      <span class="btn-prev btn-prev2"></span>
      <span class="btn-next btn-next2"></span>
    </p>
    
  </div>
</div>
<?php
wp_reset_postdata();
 


/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! comments_open() ) {
	return;
}

?>

<?php

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => 500,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'relation' => 'AND',
	'post__not_in'         => array( $product->id ),
	'tax_query'            => array(
		array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => 'artists',
            ),
         array(
            'taxonomy' => 'product_cat',
            'field' => 'id',
			'terms' => 13,
			'operator' => 'NOT IN',
            ),
        ),
) );

$products                    = new WP_Query( $args );
$woocommerce_loop['name']    = 'related';
$woocommerce_loop['columns'] = apply_filters( 'woocommerce_related_products_columns', 500 );

if ( $products->have_posts() ) : ?>

	<div id="artists">

		<h2><span class="l-ar"><?php _e( 'Similar Artists', 'woocommerce' ); ?></span></h2>
		<div id="artist-slider" class="home-slide--wrap item-block">
			<div class="home-slide js-artist-list">
<?php $i = 0; ?>
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php 
	if ($i == 0){
		echo '<div class="home-slide--item">
          <div class="artist-list">';
	}
	$i++;
?>
<div <?php post_class("artist-item"); ?>>
	<a class="l-ovl" href="<?php the_permalink(); ?>"></a>
	<p>
		<?php 
			if( has_post_thumbnail() ) {
				the_post_thumbnail();
			}
			else {
				echo '<img src="'.get_bloginfo("template_url").'/images/UnisonLogo.jpg" />';
			}
		?>		
		
	</p>
	<div class="copy">
		<h4><?php the_title(); ?></h4>
		<p>Afreaux</p>
	</div>
</div>
<?php
if ($i == 5){
	echo '</div></div>';
	$i = 0;
}
?>

			<?php endwhile; // end of the loop. ?>


		
			</div>
			<ul class="dash js-dot"></ul>
    <p class="max-width">
      <span class="btn-prev js-prev hidden-item"></span>
      <span class="btn-next js-next hidden-item"></span>
    </p>
		</div>

	</div>

<?php endif;

wp_reset_postdata();
 