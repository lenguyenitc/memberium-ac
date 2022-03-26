<?php
  /*Template Name: Shop*/
?>

<?php get_header(); ?>
<?php dynamic_sidebar('filter');?>
  <?php if (have_posts()) : ?>
    <section id="pSamplePack">
  <div class="banner" style="background-image:url(<?php bloginfo('template_url') ?>/images/samplepack-detail.jpg )"></div>
    <div id="samplepacks">
  <?php
    
  ?>

    <h2><span>Sample packs</span></h2>
    <ul class="filter samplepacks-filter" data-href="/sample-packs/filter.html">
      <li class="selected js-samplepacks-filter" data-type="newest">NEWEST PACKS</li>
      <li class="js-samplepacks-filter" data-type="unison">Unison Packs</li>
      <li class="js-samplepacks-filter" data-type="featured">FEATURED PACKS</li>
      <li class="js-samplepacks-filter" data-type="best_sellers">Best Sellers</li>
      <li>
        <div class="genres">
          <div class="jquery-selectbox jquery-custom-selectboxes-replaced"><div class="jquery-selectbox-moreButton"></div><div class="jquery-selectbox-list jquery-custom-selectboxes-replaced-list"><span class="jquery-selectbox-item value-0 item-0">Genres</span><span class="jquery-selectbox-item value-1 item-1">Bass House/Dubstep</span><span class="jquery-selectbox-item value-2 item-2">Chill Trap/Downtempo</span><span class="jquery-selectbox-item value-3 item-3">Deep House/Future House</span><span class="jquery-selectbox-item value-4 item-4">Future Bass/Trap</span><span class="jquery-selectbox-item value-5 item-5">Hard House/Hardstyle</span><span class="jquery-selectbox-item value-6 item-6">Hip Hop/RnB</span><span class="jquery-selectbox-item value-7 item-7">House/G-House</span><span class="jquery-selectbox-item value-8 item-8">Melbourne Bounce/Minimal</span><span class="jquery-selectbox-item value-9 item-9">Progressive House/Big Room</span><span class="jquery-selectbox-item value-10 item-10">Techno</span><span class="jquery-selectbox-item value-11 item-11">Trance/Psy Trance</span><span class="jquery-selectbox-item value-12 item-12">Tropical House</span></div><span class="jquery-selectbox-currentItem">Genres</span><select class="default-usage-select js-samplepacks-genres" name="genres" style="display: none;">
            <option value="1">Bass House/Dubstep</option>
            <option value="2">Chill Trap/Downtempo</option>
            <option value="3">Deep House/Future House</option>
            <option value="4">Future Bass/Trap</option>
            <option value="5">Hard House/Hardstyle</option>
            <option value="6">Hip Hop/RnB</option>
            <option value="7">House/G-House</option>
            <option value="8">Melbourne Bounce/Minimal</option>
            <option value="9">Progressive House/Big Room</option>
            <option value="10">Techno</option>
            <option value="11">Trance/Psy Trance</option>
            <option value="12">Tropical House</option>
          </select>
        </div>
      </div>
    </li>
  </ul>
  <?php wc_print_notices();?>
  <div class="home-slide--wrap" id="samplepack-slider">
    <div class="home-slide">
      <div class="home-slide--item">
          <div class="samplepack-list js-samplepack-list">

  <?php
$loop = new WP_Query( array(
'post_type' => 'product',
'posts_per_page' => 500,
'order' => DESC,
'tax_query' => array(array('taxonomy' => 'product_cat','field' => 'slug', 'terms' => 'sample-packs'))
));
$i = 0; 
while ( $loop->have_posts() ): $loop->the_post(); ?>
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

      <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
        <?php 
          global $product;
          $dimensions = $product->get_dimensions();
        ?>
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

<?php endwhile; wp_reset_postdata(); ?>


        </div>
      </div>
      
    </div>
  <?php endif; ?>
  
</div></div>
</section>
<?php get_footer(); ?>