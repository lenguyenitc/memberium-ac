<?php
  /* Template Name: Sample Packs */
?>

<?php get_header(); ?>
  <section id="pSamplePack" class="page-packs">
  <div class="banner" style="background-image:url(<?php bloginfo('template_url') ?>/images/banner.jpg )"></div>
  <div id="samplepacks">
    <input type="hidden" class="soundbank_page_id" value="<?php echo get_the_ID();?>">
    <!-- <h2><span>Soundbanks</span></h2> -->
    <ul class="filter samplepacks-filter">
    <li class="selected tax-filter2" id="featured-packs" data-type="newest">Featured</li>
      <li class="tax-filter2" id="sample-packs" data-type="newest">Serum Collection</li>
      <li class="tax-filter2" id="midi-collection" data-type="newest">MIDI Collection</li>
      <li class="tax-filter2" id="artists" data-type="newest">Artist Series</li>
      <li class="tax-filter2" id="vocal-series" data-type="newest">Vocal series</li>
      <!-- <li class="disabled">Coming Soon</li> -->
      <li>
      <?php 
      $terms2 = get_terms('pa_genre', array('hide_empty' => false));
      $count = count( $terms2 );
      ?>
        <div class="genres">
            <select class="default-usage-select " name="genres">
              <option class="option">Genre</option>
              <?php
              if($count > 0) {
                foreach($terms2 as $term){
                  echo '<option class="option" value="'.$term->slug.'">'.$term->name.'</option>';
                }
              }
              ?>  
            </select>
        </div>
    </li>
  </ul>
  <div class="loading">
  <div class="loader_icon">
    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
  </div>
  <div class="home-slide--wrap">
    <div class="home-slide">
    <div class="home-slide--item">
          <div class="samplepack-list js-samplepack-list">

    <?php 
    for ($i=0; $i < 3; $i++) { 
      echo '<div class="samplepack-item empty">
          <p><img alt="sample_empty" src="'. get_bloginfo('template_url') .'/images/sample-empty.jpg"></p>
          <div class="copy">
            <h4>.</h4>
            <h6>.</h6>
          </div>
        </div>
      '; 
    }
    ?>
  </div></div></div></div></div>
  <div class="tagged-posts2">
  <div class="home-slide--wrap" id="samplepack-slider">
    <div class="home-slide">
      

<?php
$loop = new WP_Query( array(
'post_type' => 'product',
'posts_per_page' => 500,
'orderby' => 'menu_order',
'order' => 'asc',
'meta_key'  => '_price',
'meta_value' => 0,
'meta_compare' => '!=',
'tax_query' => array (
    array (
        'taxonomy' => 'product_cat',
        'field' => 'slug',
        'terms' => 'featured-packs',
      )
  )

));
$i = 0; 
$countPack = 0;
while ( $loop->have_posts() ): $loop->the_post(); ?>

<?php 
$countPack++;
  if ($i == 0){
    echo '<div class="home-slide--item">
          <div class="samplepack-list js-samplepack-list">';
  }
  $i++;
?>
<div <?php post_class("samplepack-item"); ?>>
<?php if ($product->is_on_sale() && $product->product_type == 'variable') : ?>

  <div class="bubble">
            <div class="inside">
              <div class="inside-text">
                <?php 
                  $available_variations = $product->get_available_variations();               
                  $maximumper = 0;
                  for ($i = 0; $i < count($available_variations); ++$i) {
                    $variation_id=$available_variations[$i]['variation_id'];
                    $variable_product1= new WC_Product_Variation( $variation_id );
                    $regular_price = $variable_product1 ->regular_price;
                    $sales_price = $variable_product1 ->sale_price;
                    $percentage= round((( ( $regular_price - $sales_price ) / $regular_price ) * 100),1) ;
                      if ($percentage > $maximumper) {
                        $maximumper = $percentage;
                      }
                    }
                  echo $price . sprintf( __('%s OFF', 'woocommerce' ), $maximumper . '%' ); ?>
              </div>
            </div>
     </div><!-- end callout -->

<?php elseif($product->is_on_sale() && $product->product_type == 'simple') : ?>
  
  <div class="bubble">
             <div class="inside">
               <div class="inside-text">
                <?php 
        $percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
        echo $price . sprintf( __('%s OFF', 'woocommerce' ), $percentage . '%' ); ?></div>
             </div>
      </div><!-- end bubble -->

<?php endif; ?>
  <p>

    <a href="<?php the_permalink(); ?>">
    <?php 
      if( has_post_thumbnail() ) {
        the_post_thumbnail();
      }
      else {
        echo '<img alt="unisonlogo" src="'.get_bloginfo("template_url").'/images/UnisonLogo.jpg" />';
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
    <!-- <h6>Afreaux</h6> -->
    <p class="js-price-text">
      <?php woocommerce_template_loop_price(); ?>
    </p>
    <?php 
    $downloads = $product->get_files();
   echo "<div class='ctas'>";
    $music = get_post_meta( $post->ID, '_music', true );
    if($post->ID != 1828){
      echo '<a href="#" class="btn-play js-sound productbtn'.$post->ID.'" data-file="'.$music.'" data-id="'.$post->ID.'"></a>';
    }
      echo '<div class="button_free">';
      echo '<a href="'.get_the_permalink().'" data-product_title="'.get_the_title().'" data-quantity="1" data-product_id="'. get_the_ID() .'" data-product_sku="" class="btn-buy">Learn More</a>';
       //echo '<a rel="nofollow" onclick="openCartDrawer(' . get_the_ID() . ')" data-product_title="' . get_the_title() . '" data-quantity="1" data-product_id="' . get_the_ID() . '" data-product_sku="" class="btn-buy cs_add_to_cart_btn">Learn More</a>';
      echo '<input type="hidden" value="already_looged">';
      echo '</div>';
      echo '</div>';
    
  ?>
  </div>

</div>
<?php
if ($i == 6){
  echo '</div></div>';
  $i = 0;
}
?>

<?php endwhile; wp_reset_postdata(); ?>
<?php
    $ostPack = $countPack % 6;
    if ($ostPack == 0){
      $ostPack = 0;
    }
    else {
      $ostPack = 6 - $ostPack;  
    }
    
  while($ostPack){
    echo '<div class="samplepack-item empty">
    <p><img alt="sample-empty" src="'. get_bloginfo('template_url') .'/images/sample-empty.jpg"></p>
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
      </div>
      <p class="max-width">
      <span class="btn-prev js-prev hidden-item"></span>
      <span class="btn-next js-next hidden-item"></span>
    </p>
 
    </div>
    
    
  </div>
</div>  
</section>
<?php get_footer(); ?>