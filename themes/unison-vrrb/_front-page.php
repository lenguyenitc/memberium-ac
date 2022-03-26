<?php
/*
Template Name: Home
 */
get_header();
if (!defined('ABSPATH')) {
  exit;
}
// Exit if accessed directly
global $product, $woocommerce_loop, $post;
?>
  <div class="owl-slider home_owl_slider" >
    <div class="owl-carousel">
      <div class="slide-owl">
       <div class="home-connect">
          <h1>Take your music to the next level <br>with our premium samples & presets.</h1>
          <a href="/soundbanks/" class="home_banner_btn">LEARN MORE</a>
          <!-- <h1>Unison-exclusive Black Friday deals are here.</h1>
          <a href="https://deals.unison.audio/black-friday" class="home_banner_btn">LEARN MORE</a> -->
        </div>
      </div>
       <div class="slide-owl">
        <div class="home-connect">
        <h4>Join our newsletter for production tips and tutorials.<br></h4>
          <a href="#newsletter_down" class="home_banner_btn">JOIN NOW</a>
        </div>
      </div>
    </div>
  <div class="customPrevBtn"></div>
  <div class="customNextBtn"></div>
  </div>
  <div id="samplepacks" class="top_offset_100">
  <h2 class="liner_head"><span>Products</span></h2>
    <ul class="filter samplepacks-filter">
    <li class="selected tax-filter2" id="featured-packs" data-type="newest">Featured</li>
      <li class="tax-filter2" id="sample-packs" data-type="newest">Serum Collection</li>
      <li class="tax-filter2" id="midi-collection" data-type="newest">MIDI Collection</li>
      <!-- <li class="" title="unison-packs" data-type="unison">Coming Soon</li> -->
      <li class="tax-filter2" id="artists" data-type="newest">Artist Series</li>
      <li class="tax-filter2" id="vocal-series" data-type="newest">Vocal series</li>
       <!-- <li class="disabled">Coming Soon</li> -->
      <li>
      <?php
		$terms2 = get_terms('pa_genre', array('hide_empty' => false));
		$count = count($terms2);
		?>
		        <div class="genres">
		            <select class="default-usage-select" name="genres">
		            <option class="option">Genre</option>
		            <?php
		if ($count > 0) {
		  foreach ($terms2 as $term) {
		    echo '<option class="option" value="' . $term->slug . '">' . $term->name . '</option>';
		  }
		}
		?>
            </select>
        </div>
    </li>
  </ul>
  <div class="loading">
    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
    <div class="home-slide--wrap">
        <div class="home-slide">
          <div class="home-slide--item">
            <div class="samplepack-list js-samplepack-list">
              <?php
				for ($i = 0; $i < 6; $i++) {
				  echo '<div class="samplepack-item empty">
				                    <p><img src="' . get_bloginfo('template_url') . '/images/sample-empty.jpg" alt="sample-empty"></p>
				                    <div class="copy">
				                      <h4>.</h4>
				                      <h6>.</h6>
				                    </div>
				                  </div>';
				}
				?>
            </div>
          </div>
        </div>
    </div>
  </div>
  <div class="tagged-posts2">
    <div class="home-slide--wrap" id="samplepack-slider">
      <div class="owl-carousel3">
        <?php
			$loop = new WP_Query(array(
			  'post_type' => 'product',
			  'posts_per_page' => -1,
			  'orderby' => 'menu_order',
			  'order' => 'asc',
			  'meta_key' => '_price',
			  'meta_value' => 0,
			  'meta_compare' => '!=',
			  'tax_query' => array(
			    array(
			      'taxonomy' => 'product_cat',
			      'field' => 'slug',
			      'terms' => 'featured-packs',
			    ),
			  ),
			));
			$i = 0;
			$countPack = 0;
			while ($loop->have_posts()): $loop->the_post();?>
					        <?php
			  $countPack++;
			  if ($i == 0) {
			    echo '<div class="home-slide--item">
					                  <div class="samplepack-list js-samplepack-list">';
			  }
			  $i++;
			  ?>
		        <div <?php post_class("samplepack-item");?>>
		        <?php if ($product->is_on_sale() && $product->product_type == 'variable'): ?>
		          <div class="bubble">
		                    <div class="inside">
		                      <div class="inside-text">
		                        <?php
  $available_variations = $product->get_available_variations();
  $maximumper = 0;
  for ($i = 0; $i < count($available_variations); ++$i) {
    $variation_id = $available_variations[$i]['variation_id'];
    $variable_product1 = new WC_Product_Variation($variation_id);
    $regular_price = $variable_product1->regular_price;
    $sales_price = $variable_product1->sale_price;
    $percentage = round(((($regular_price - $sales_price) / $regular_price) * 100), 1);
    if ($percentage > $maximumper) {
      $maximumper = $percentage;
    }
  }
  echo $price . sprintf(__('%s OFF', 'woocommerce'), $maximumper . '%');?></div>
		                    </div>
		             </div><!-- end callout -->
		        <?php elseif ($product->is_on_sale() && $product->product_type == 'simple'): ?>
          <div class="bubble">
                     <div class="inside">
                       <div class="inside-text">
                        <?php
$percentage = round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100);
echo $price . sprintf(__('%s OFF', 'woocommerce'), $percentage . '%');?></div>
                     </div>
              </div><!-- end bubble -->
        <?php endif;?>
          <p>
            <a href="<?php the_permalink();?>">
            <?php
if (has_post_thumbnail()) {
  the_post_thumbnail();
} else {
  echo '<img src="' . get_bloginfo("template_url") . '/images/UnisonLogo.jpg" alt="UnisonLogo" />';
}
?>
            </a>
          </p>
          <div class="copy">
            <h4>
              <a class="js-title-samplepacks" href="<?php the_permalink();?>">
                <?php the_title();?>
              </a>
            </h4>
            <!-- <h6>Afreaux</h6> -->
            <p class="js-price-text">
              <?php woocommerce_template_loop_price();?>
            </p>
            <?php
				$downloads = $product->get_files();
				echo "<div class='ctas'>";
				$music = get_post_meta($post->ID, '_music', true);
				if ($post->ID != 1828) {
				  echo '<a href="#" class="btn-play js-sound productbtn' . $post->ID . '" data-file="' . $music . '" data-id="' . $post->ID . '"></a>';
				}
				echo '<div class="button_free">';
				echo '<a href="' . get_the_permalink() . '" data-product_title="' . get_the_title() . '" data-quantity="1" data-product_id="' . get_the_ID() . '" data-product_sku="" class="btn-buy">Learn More</a>';
				 //echo '<a onclick="openCartDrawer(' . get_the_ID() . ')" data-product_title="' . get_the_title() . '" data-quantity="1" data-product_id="' . get_the_ID() . '" data-product_sku="" class="btn-buy cs_add_to_cart_btn">Learn More</a>';
				echo '<input type="hidden" value="already_looged">';
				echo '</div>';
				echo '</div>';
				?>
          </div>
        </div>
        <?php
if ($i == 6) {
  echo '</div></div>';
  $i = 0;
}
?>
        <?php endwhile;
wp_reset_postdata();?>
        <?php
$ostPack = $countPack % 6;
if ($ostPack == 0) {
  $ostPack = 0;
} else {
  $ostPack = 6 - $ostPack;
}
?>
          <?php
while ($ostPack) {
  echo '<div class="samplepack-item empty">
            <p><img src="' . get_bloginfo('template_url') . '/images/sample-empty.jpg" alt="sample-empty"></p>
            <div class="copy">
              <h4>.</h4>
              <h6>.</h6>
            </div>
          </div>';
  $ostPack--;
}
?>
      </div>
    </div>
    <p class="max-width">
      <span class="btn-prev btn-prev3"></span>
      <span class="btn-next btn-next3"></span>
    </p>
    <a href="/soundbanks/" class="btn">View all</a>
  </div>

      <!-- </div>
      </div> -->
    </div>
  </div>
</div>
<div class="newsletter" id="newsletter_down">
  <h2 class="top_offset_100">Join Our Newsletter</h2>
  <p>to receive exclusive content, tutorials, special offers & more</p>
  <div>
    <form id="mc4wp-form-1" class="mc4wp-form mc4wp-form-875 " method="post" data-id="875" >
      <div class="mc4wp-form-fields">
        <div class="wpcf7-form">
          <p>
          <span class="wpcf7-form-control-wrap your-name">
            <input name="FNAME" placeholder="Your first name" type="text" id="FNAME" class="FNAME">
          </span>
          <span class="wpcf7-form-control-wrap your-email">
          <input name="EMAIL" placeholder="Your email address" type="email" id="EMAIL" class="EMAIL" >
          </span>
          <input value="JOIN" class="wpcf7-form-control wpcf7-submit activacampaign" type="submit">
          </p>
        </div>
      </div>
      <div class="mc4wp-response"><div class="mc4wp-alert mc4wp-success"></div></div>
    </form>
  </div>
  <p><a class="insta_center" target="_blank" href="https://www.instagram.com/unisonaudio/"><img src="<?php bloginfo('template_url')?>/images/snap.png" alt="snap"></a></p>
  <h4 class="insta-text"><span>unisonaudio</span></h4>
</div>
<script>
$(document).ready(function(){
$(".myartists").click(function() {
    $('html, body').animate({
        scrollTop: $("#artists").offset().top
    }, 2000);
});
});
</script>
<?php get_footer();?>