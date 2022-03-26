<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<section id="pSupport">
	<div class="support-wrap search_for_new">
  	<div class="banner">
        <h2><span class="l-ar"></span></h2>
    </div>
		<div class="list-search" id="searchcontrol" style="padding:0;">
      <div id="___gcse_0">
      	<div class="gsc-control-cse gsc-control-cse-en">
      		<div class="gsc-control-wrapper-cse" dir="ltr">
      			<div class="search-wrap">
				      <?php get_search_form() ?>
				    </div>
      		</div>
				</div>
			</div>
  	</div>
	</div>
</section>

<div id="samplepacks" class="search_page_wrapper">
  

    <h2 class="search_page_heading"><span>Search results</span></h2>
   
  
  <div class="home-slide--wrap" id="samplepack-slider">
    <div class="home-slide">
      

	<?php

$i = 0; 
$countPack = 0;
if ( have_posts() ) :
while ( have_posts() ): the_post(); ?>

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
				<?php the_title(); ?>



			</a>
		</h4>
		<!--<h6>Afreaux</h6>-->
		<p class="js-price-text">
			<?php woocommerce_template_loop_price(); ?>
		</p>
		<?php 
		$downloads = $product->get_files();
		echo "<div class='ctas'>";
		foreach( $downloads as $key => $each_download ) {
		  echo '<a href="#" class="btn-play js-sound" data-file="'.$each_download["file"].'"></a>';
		}
		woocommerce_template_loop_add_to_cart();
		echo '</div>';
	?>
	</div>

</div>


<?php endwhile;
else :
?>
<div class="search_no_post">
<?php
	echo wpautop( 'Sorry, no posts were found' );

$args = array(
	'posts_per_page'   => 12,
	'offset'           => 0,
	'orderby'          => 'rand',
	'order'            => 'DESC',
	'post_type'        => 'product',
	'post_status'      => 'publish',
	'suppress_filters' => true 
);
$posts_array = get_posts( $args );
?>
<h3>Default Recommendation</h3>
<ul>

<?php 	
foreach ( $posts_array as $post ) : setup_postdata( $post ); 
?>
<li class="samplepack-list">
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
				<?php the_title(); ?>
			</a>
		</h4>
		<!--<h6>Afreaux</h6>-->
		<p class="js-price-text">
			<?php woocommerce_template_loop_price(); ?>
		</p>
		<?php 
		$downloads = $product->get_files();
		echo "<div class='ctas'>";
		foreach( $downloads as $key => $each_download ) {
		  echo '<a href="#" class="btn-play js-sound" data-file="'.$each_download["file"].'"></a>';
		}
		woocommerce_template_loop_add_to_cart();
		echo '</div>';
	?>
	</div>

</div>
	</li>
	
<?php endforeach;  ?>
</ul>
</div>
<?php
endif;
 wp_reset_postdata(); ?>


         </div>
      </div>
      
    </div>
<?php get_footer(); ?>
