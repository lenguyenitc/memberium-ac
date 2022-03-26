<?php
  /*Template Name: Free Content*/
?>

<?php
 header('Location: '.site_url().'/soundbanks');
 exit();
 get_header(); ?>
  
  <section id="pSamplePack" class="page-packs free_content">
  <div class="banner" style="background-image:url(<?php bloginfo('template_url') ?>/images/banner.jpg )"></div>
  <div id="samplepacks">
  

    <!-- <h2><span>Free Downloads</span></h2> -->
    <input type="hidden" name="is_free" id="is_free" value="1">
    <ul class="filter samplepacks-filter">
      <li class="selected tax-filter2" id="sample-packs" data-type="newest">UNISON COLLECTION</li>

      <!-- <li class="" title="unison-packs" data-type="unison">Coming Soon</li> -->
      <li class="disabled">Coming Soon</li>
       <li class="disabled">Coming Soon</li>
       <li class="disabled">Coming Soon</li>
      <li>
      <?php 
      $terms2 = get_terms('pa_genre', array('hide_empty' => false));
      $count = count( $terms2 );

      if($count > 0) {
        foreach($terms2 as $term){
          
        }
      }
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

  <div class="home-slide--wrap">
    <div class="home-slide">
    <div class="home-slide--item">
          <div class="samplepack-list js-samplepack-list">
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
'meta_value' => 0
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
<div <?php post_class("samplepack-item free_item"); ?>>
  <p>

    <a class="" href="javascript:void(0)">
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

      <a class="js-title-samplepacks" href="javascript:void(0)">
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
    $music = get_post_meta( $post->ID, '_music', true );
    $product_download = get_post_meta( $post->ID, '_downloadable', true );
    $product_price = get_post_meta( $post->ID, '_price', true );
    
      echo '<a href="#" class="btn-free-play js-sound" data-file="'.$music.'" data-id="'.$post->ID.'"></a>';

        echo '<div class="button_free">';
        if(is_user_logged_in()){
              echo do_shortcode('[download_now id="" text="Download"]');
          }
        else{ 
              echo '<a href="'.get_the_permalink().'" data-product_title="'.get_the_title().'" data-quantity="1" data-product_id="'. get_the_ID() .'" data-product_sku="" class="js-check-login btn-buy">Download</a>';
          }
    //echo '<input type="hidden" name="p_type" id="p_type" value="'.$product_download.'">';
       // echo '<input type="hidden" name="p_price" id="p_price" value="'.$product_price.'">';
  ?> <!-- <input type="hidden" name="p_downloads" id="p_downloads" value="<?php print_r($downloads); ?>" >
   -->

<?php     
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
      $ostPack = 6;
    }
    else {
      $ostPack = 6 - $ostPack;  
    }
  ?>

  <?php
  while($ostPack){
     if ($i == 0){
        echo '<div class="home-slide--item">
              <div class="samplepack-list js-samplepack-list">';
      }
      $i++;
    echo '<div class="samplepack-item empty">
    <p><img src="'. get_bloginfo('template_url') .'/images/sample-empty.jpg" alt="sample-empty"></p>
    <div class="copy hamari">
      <h4>.</h4>
      <h6>.</h6>
    </div>
  </div>';

  if ($i == 6){
    echo '</div></div>';
    $i = 0;
  }
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
 <!--   <a href="/sample-packs/" class="btn">View all</a> -->
    </div>
    
    


</section>

<?php get_footer(); ?>