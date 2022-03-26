<?php 
$defaultloop = new WP_Query( array(
'post_type' => 'product',
'posts_per_page' => 1,
'order' => 'DESC',
'tax_query' => array (
    array (
        'taxonomy' => 'product_cat',
        'field' => 'slug',
        'terms' => 'default-sound-category',
      )
  )
));
while ( $defaultloop->have_posts() ): 
  $defaultloop->the_post();
$music = get_post_meta( $post->ID, '_music', true ); ?>
<div <?php post_class("samplepack-item"); ?> style="display: none;">
  <p>

    <a href="<?php the_permalink(); ?>">
    <?php 
      if( has_post_thumbnail() ) {
		$url= wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
        echo '<img class="default-product" src="'.$url.'"/>';
      }
      else {
        echo '<img src="'.get_bloginfo("template_url").'/images/UnisonLogo.jpg" />';
      }
    ?>    
    </a>
  </p>
  <div class="copy">
    <h4>

      <a class="js-title-samplepacks default_product_title" data-title="<?php the_title();?>" href="<?php the_permalink(); ?>">
             <?php the_title(); ?>
      </a>
    </h4>
    <!-- <h6>Afreaux</h6> -->
    <p class="js-price-text">
    
      <?php woocommerce_template_loop_price(); ?>
    </p>
    <?php 
    echo "<div class='ctas'>";
    $music = get_post_meta( $post->ID, '_music', true );
    $product_price = get_post_meta( $post->ID, '_price', true );
      echo '<a href="#" class="btn-play default_product_song" id="js-defaultsound" data-file="'.$music.'" data-id="'.$post->ID.'"></a>';
      echo '<div class="button_free default_product_button">';
      if($product_price == 0){
      if(is_user_logged_in()){
      echo do_shortcode('[download_now id="" text="Download"]');
    }else
    {
      echo '<a rel="nofollow" href="javascript:void(0)" data-product_title="'.get_the_title().'" data-quantity="1" data-product_id="'. get_the_ID() .'" data-product_sku="" class="js-check-login">Download</a>';
    }
  }elseif ($product_price > 0){
    $output .= '<a href="#" class="btn-play js-sound" data-file="'.$music.'" data-id="'.$post->ID.'"></a>';
    $output .= '<a rel="nofollow" href="'.get_the_permalink().'" data-product_title="'.get_the_title().'" data-quantity="1" data-product_id="'. get_the_ID() .'" data-product_sku="" class="btn-buy ">Learn More</a>';
  }
      //echo '<a rel="nofollow" href="'.get_the_permalink().'" data-product_title="'.get_the_title().'" data-quantity="1" data-product_id="'. get_the_ID() .'" data-product_sku="" class="btn-buy">Learn More</a>';
      //echo '<input type="hidden"  id="p_id" value="already_looged">';
      echo '</div>';
      echo '</div>';
  ?>
  </div>

</div>
<?php 
endwhile;
?>