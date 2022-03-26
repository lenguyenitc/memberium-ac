<?php

/*

Template name: Artists

*/
?>
<?php get_header(); ?>

<section id="pArtists">
  <div class="banner" style="background-image: url( <?php bloginfo('template_url') ?>/images/banner.jpg )"></div>
  <div id="artists">
    <h2><span class="l-ar"><?php the_title(); ?></span></h2>
    <ul class="filter artists-filter desktop" data-href="/artists/filter.html">
      <li data-id="0" class="selected tax-filter js-artists-filter" title="artists">ALL</li>
    	<?php $tax = 'product_cat';
			$terms = get_terms(array('taxonomy' => 'product_cat','parent' => 46,'hide_empty' => false));
			$count = count( $terms );
			if ( $count > 0 ): ?>
  		<?php
  			foreach ( $terms as $term ) {
    			echo '<li class="tax-filter js-artists-filter" title="'.$term->slug.'">'.$term->name.'</li>';
  				} ?>
			<?php endif;?>
  	</ul>
    <div class="filter mobile artists-filter" data-href="/artists/filter.html">
      <select class="default-usage-select js-artists-filter-mobile">
        <option class="option1" value="0">All GENRES</option>
        <?php
  				foreach ( $terms as $term ) {
    				echo '<option class="option1" value="'.$term->slug.'"><a href="" title="'.$term->slug.'">'.$term->name.'</a></option>';
  				} 
  			?>
      </select>
    </div>
    <div class="loading2">
  <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
  <div class="home-slide--wrap item-block " >
      <div class="home-slide js-artist-list ">
    <div class="home-slide--item"><div class="artist-list">

    <?php 
    for ($i=0; $i < 10; $i++) { 
      echo '<div class="artist-item empty">
    <p><img src="'. get_bloginfo('template_url') .'/images/artist-empty.jpg" alt="artist-empty"></p></div>'; 
    }
    ?>
  </div></div></div></div></div>
    <div class="tagged-posts">
    <div class="artist-list js-artist-list js-item-list">
    <?php
  	$argss = array(
	    'post_type' => 'product',
	    'posts_per_page' => 1000,
	    'order' => ASC,
	    'tax_query' => array(
	      array (
	      	'taxonomy' => 'product_cat',
	        'field' => 'slug',
	        'terms' => 'artists',
	      ),
	    ),
	  );
  	$queryy = new WP_Query( $argss );
		?>
	<?php $count2 = 0;	?>
  <?php while ( $queryy->have_posts() ) : $queryy->the_post(); ?>

    <?php $count2++; ?>
                <div class="artist-item <?php echo $i; ?>">
                  <a href="<?php the_permalink() ?>" class="l-ovl"></a>
                  <p>
                  <?php
                     if(has_post_thumbnail()){
                      the_post_thumbnail();
                     }
                     else {
                      echo '<img src="'. get_bloginfo('template_url') .'/images/artist-empty.jpg">';
                     }
                  ?>
                  </p>
                  <div class="copy">
                    <h4><?php the_title(); ?></h4>
                      <p>
                          <?php echo get_genres_by_id($post->ID) ?>
                      </p>

                  </div>
                </div>
  <?php endwhile; ?>
<?php
    $ost = $count2 % 10;

    $ost = 5 - $ost;


  ?>

  <?php
  while($ost){
    echo '<div class="artist-item empty">
    <p><img src="'. get_bloginfo('template_url') .'/images/artist-empty.jpg" alt="artist-empty"></p></div>';
  $ost--;
  }
  ?> 
    </div>
    </div>
      </div>
</section>

<?php get_footer(); ?>