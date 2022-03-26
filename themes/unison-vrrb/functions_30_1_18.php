<?php
add_theme_support( 'woocommerce' );

function register_my_widgets(){
  register_sidebar( array(
    'name' => "Footer Socials",
    'id' => 'footer_socials',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
  'after_widget'  => '</div>',
  'before_title'  => '<h2 class="widgettitle">',
  'after_title'   => '</h2>'
  ) );
}
add_action( 'widgets_init', 'register_my_widgets' );

function register_my_widgets2(){
  register_sidebar( array(
    'name' => "Currency",
    'id' => 'currency',
  ) );
}

// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );

// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );

function woo_add_custom_general_fields() {

  global $woocommerce, $post;
  
  echo '<div class="options_group">';
  
  // Text Field
woocommerce_wp_text_input( 
  array( 
    'id'          => '_record', 
    'label'       => __( 'Record label', 'woocommerce' ), 
    'placeholder' => 'Record label',
    'desc_tip'    => 'true',
    'description' => __( '', 'woocommerce' ) 
  )
);
woocommerce_wp_text_input( 
  array( 
    'id'          => '_language', 
    'label'       => __( 'Language', 'woocommerce' ), 
    'placeholder' => 'Language',
    'desc_tip'    => 'true',
    'description' => __( '', 'woocommerce' ) 
  )
);
woocommerce_wp_text_input( 
  array( 
    'id'          => '_music', 
    'label'       => __( 'Demo music URL', 'woocommerce' ), 
    'placeholder' => 'Music URL',
    'desc_tip'    => 'true',
    'description' => __( '', 'woocommerce' ) 
  )
);
woocommerce_wp_text_input( 
  array( 
    'id'          => '_location', 
    'label'       => __( 'Location', 'woocommerce' ), 
    'placeholder' => 'Location',
    'desc_tip'    => 'true',
    'description' => __( '', 'woocommerce' ) 
  )
);
woocommerce_wp_text_input( 
  array( 
    'id'          => '_daw', 
    'label'       => __( 'DAW', 'woocommerce' ), 
    'placeholder' => 'DAW',
    'desc_tip'    => 'true',
    'description' => __( '', 'woocommerce' ) 
  )
);
woocommerce_wp_text_input( 
  array( 
    'id'          => '_rec', 
    'label'       => __( 'Recommended Plugins For Lesson:', 'woocommerce' ), 
    'placeholder' => 'Recommended Plugins For Lesson:',
    'desc_tip'    => 'true',
    'description' => __( '', 'woocommerce' ) 
  )
);



woocommerce_wp_text_input( 
  array( 
    'id'          => '_facebook', 
    'label'       => __( 'Facebook url', 'woocommerce' ), 
    'placeholder' => 'Facebook url',
    'desc_tip'    => 'true',
    'description' => __( '', 'woocommerce' ) 
  )
);
woocommerce_wp_text_input( 
  array( 
    'id'          => '_twitter', 
    'label'       => __( 'Twitter url', 'woocommerce' ), 
    'placeholder' => 'Twitter url',
    'desc_tip'    => 'true',
    'description' => __( '', 'woocommerce' ) 
  )
);
woocommerce_wp_text_input( 
  array( 
    'id'          => '_soundcloud', 
    'label'       => __( 'SoundCloud url', 'woocommerce' ), 
    'placeholder' => 'SoundCloud url',
    'desc_tip'    => 'true',
    'description' => __( '', 'woocommerce' ) 
  )
);
woocommerce_wp_text_input( 
  array( 
    'id'          => '_spotify', 
    'label'       => __( 'Spotify url:', 'woocommerce' ), 
    'placeholder' => 'Spotify url:',
    'desc_tip'    => 'true',
    'description' => __( '', 'woocommerce' ) 
  )
);

  
  echo '</div>';
  
}

function woo_add_custom_general_fields_save( $post_id ){
  
  // Text Field
  $woocommerce_text_field = $_POST['_record'];
  if( !empty( $woocommerce_text_field ) )
    update_post_meta( $post_id, '_record', esc_attr( $woocommerce_text_field ) );

  // Text Field
  $woocommerce_text_field = $_POST['_language'];
  if( !empty( $woocommerce_text_field ) )
    update_post_meta( $post_id, '_language', esc_attr( $woocommerce_text_field ) );

$woocommerce_text_field = $_POST['_music'];
  if( !empty( $woocommerce_text_field ) )
    update_post_meta( $post_id, '_music', esc_attr( $woocommerce_text_field ) );

  // Text Field
  $woocommerce_text_field = $_POST['_location'];
  if( !empty( $woocommerce_text_field ) )
    update_post_meta( $post_id, '_location', esc_attr( $woocommerce_text_field ) );

  // Text Field
  $woocommerce_text_field = $_POST['_daw'];
  if( !empty( $woocommerce_text_field ) )
    update_post_meta( $post_id, '_daw', esc_attr( $woocommerce_text_field ) );

  // Text Field
  $woocommerce_text_field = $_POST['_rec'];
  if( !empty( $woocommerce_text_field ) )
    update_post_meta( $post_id, '_rec', esc_attr( $woocommerce_text_field ) );
    
  $woocommerce_text_field = $_POST['_facebook'];
  if( !empty( $woocommerce_text_field ) )
    update_post_meta( $post_id, '_facebook', esc_attr( $woocommerce_text_field ) );

  // Text Field
  $woocommerce_text_field = $_POST['_twitter'];
  if( !empty( $woocommerce_text_field ) )
    update_post_meta( $post_id, '_twitter', esc_attr( $woocommerce_text_field ) );

  // Text Field
  $woocommerce_text_field = $_POST['_soundcloud'];
  if( !empty( $woocommerce_text_field ) )
    update_post_meta( $post_id, '_soundcloud', esc_attr( $woocommerce_text_field ) );

  // Text Field
  $woocommerce_text_field = $_POST['_spotify'];
  if( !empty( $woocommerce_text_field ) )
    update_post_meta( $post_id, '_spotify', esc_attr( $woocommerce_text_field ) );
  
}

register_nav_menus( array(
    'header_menu' => 'Header Menu',
) );

add_action( 'widgets_init', 'register_my_widgets2' );

// Подключение библиотеки jQuery
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
function my_scripts_method() {
    // отменяем зарегистрированный jQuery
    // вместо "jquery-core" просто "jquery", чтобы отключить jquery-migrate
    wp_deregister_script( 'jquery-core' );
    wp_register_script( 'jquery-core', '//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js');
    wp_enqueue_script( 'jquery' );
}  

function woo_related_products_limit() {
  global $product;
  
  $args['posts_per_page'] = 6;
  return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
  function jk_related_products_args( $args ) {
  $args['posts_per_page'] = 20; // 4 related products
  $args['columns'] = 20; // arranged in 2 columns
  return $args;
}

add_filter( 'woocommerce_locate_template', 'so_25789472_locate_template', 10, 3 );

function so_25789472_locate_template( $template, $template_name, $template_path ){

    // on single posts with mock category and only for single-product/something.php templates
    if( is_product() && has_term( 'artists', 'product_cat' ) && strpos( $template_name, 'single-product/') !== false ){

        // replace single-product with single-product-mock in template name
        $mock_template_name = str_replace("single-product/", "single-product-artists/", $template_name );

        // look for templates in the single-product-mock/ folder
        $mock_template = locate_template(
            array(
                trailingslashit( $template_path ) . $mock_template_name,
                $mock_template_name
            )
        );

        // if found, replace template with that in the single-product-mock/ folder
        if ( $mock_template ) {
            $template = $mock_template;
        }
    }

    return $template;
}
// Enqueue script
function ajax_filter_posts_scripts() {
  // Enqueue script
  wp_register_script('afp_script', get_template_directory_uri() . '/ajax-filter-posts.js', false, null, false);
  wp_enqueue_script('afp_script');

  wp_localize_script( 'afp_script', 'afp_vars', array(
        'afp_nonce' => wp_create_nonce( 'afp_nonce' ), // Create nonce which we later will use to verify AJAX request
        'afp_ajax_url' => admin_url( 'admin-ajax.php' ),
      )
  );
}
add_action('wp_enqueue_scripts', 'ajax_filter_posts_scripts', 100);
// Script for getting posts
function ajax_filter_get_posts( $taxonomy ) {

  // Verify nonce
  if( !isset( $_POST['afp_nonce'] ) || !wp_verify_nonce( $_POST['afp_nonce'], 'afp_nonce' ) ){
   //die('Permission denied'); ?>
<div class="samplepack-list js-samplepack-list"><div class="samplepack-item empty">
    <p><img src="https://unison.audio/wp-content/themes/unison-vrrb/images/sample-empty.jpg"></p>
    <div class="copy">
      <h4></h4>
      <h6></h6>
    </div>
  </div><div class="samplepack-item empty">
    <p><img src="https://unison.audio/wp-content/themes/unison-vrrb/images/sample-empty.jpg"></p>
    <div class="copy">
      <h4></h4>
      <h6></h6>
    </div>
  </div><div class="samplepack-item empty">
    <p><img src="https://unison.audio/wp-content/themes/unison-vrrb/images/sample-empty.jpg"></p>
    <div class="copy">
      <h4></h4>
      <h6></h6>
    </div>
  </div><div class="samplepack-item empty">
    <p><img src="https://unison.audio/wp-content/themes/unison-vrrb/images/sample-empty.jpg"></p>
    <div class="copy">
      <h4></h4>
      <h6></h6>
    </div>
  </div><div class="samplepack-item empty">
    <p><img src="https://unison.audio/wp-content/themes/unison-vrrb/images/sample-empty.jpg"></p>
    <div class="copy">
      <h4></h4>
      <h6></h6>
    </div>
  </div><div class="samplepack-item empty">
    <p><img src="https://unison.audio/wp-content/themes/unison-vrrb/images/sample-empty.jpg"></p>
    <div class="copy">
      <h4></h4>
      <h6></h6>
    </div>
  </div></div>
  <?php }

  $taxonomy = $_POST['taxonomy'];

  // WP Query
  $args = array(
    'post_type' => 'product',
    'posts_per_page' => 500,
    'orderby' => 'menu_order',
	'order' => 'asc',
    'relation' => 'AND',
    'tax_query' => array (
        array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $taxonomy,
            ),
         array(
			'taxonomy' => 'product_cat',
			'field' => 'id',
			'terms' => 13,
			'operator' => 'NOT IN',
            ),
        ),
    );
  if( !$taxonomy ) {
    unset( $args['cat'] );
  }
  $query = new WP_Query( $args );
  $i = 0;
  $cou = 0;
  $cau = 0;
  $output = '<div class="home-slide--wrap item-block " id="artist-slider">
      <div class="owl-carousel2">';
  if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
    if($i == 0){$output .= '<div class="home-slide--item"><div class="artist-list">';}
    $i++;
    $cou++;
    $cau++;
    $output .= '<div class="wobble artist-item '.$i. '"><a class="l-ovl" href="'.get_the_permalink().'"></a><p>'.get_the_post_thumbnail().'</p><div class="copy"><h4>'.get_the_title().'</h4><p>' . get_genres_by_id($post->ID) . '</p></div></div>';
    if($i == 10 ){
      $output .= '</div></div>';
      $i = 0;
    }
    $result = 'success';

  endwhile; else:
    $cou = 1;
    $ostatok = $cou % 10;
    $i = 0;
  while($ostatok){
    if($i == 0){
      $output .= '<div class="home-slide--item"><div class="artist-list">';
    }
    $i++;
    $output .= '<div class="samplepack-item empty">
    <p><img src="'. get_bloginfo('template_url') .'/images/sample-empty.jpg"></p></div>';
    $ostatok--;
    if($i == 10 ){
      $output .= '</div></div>';
      $i = 0;
    }
  }
    $result = 'fail';
  endif;
  $ostatok = $cou % 10;
  $ostatok2 = $cau % 10;
  if ($ostatok == 0) {
    $ostatok = 0;
  }
  else {
    $ostatok = 10 - $ostatok; 
  }
  
  while($ostatok){
    $output .= '<div class="samplepack-item empty">
    <p><img src="'. get_bloginfo('template_url') .'/images/sample-empty.jpg"></p></div>';
  $ostatok--;
  }//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js
  $output .= '</div></div></div>';
  if($cau > 10){
  $output .= '<span class="btn-prev btn-prev2"></span><span class="btn-next btn-next2 '. $cau .'"></span></span>0'; 
  }
  
  $output .= '<a href="/artists/" class="btn">View all</a></div><script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script><script src="'.get_bloginfo('template_url').'/js/libs/jquery-1.11.1.js"></script><script src="'.get_bloginfo('template_url').'/libs/owlcarousel/owl.carousel.js"></script><script src="'.get_bloginfo('template_url').'/js/modules/slider.js"></script>';
  $output .= "<script>
  
      
        var owl2 = $('.owl-carousel2');
        owl2.owlCarousel({
          loop:true,
          items:1,
          dots:true,
          navSpeed:1000,
          dragEndSpeed:1000,
          smartSpeed:1000,
          fluidSpeed:1000,
          lazyLoad:true,
          lazyContent:true,
        });
        // Go to the next item
        $('.btn-next.btn-next2').click(function() {
            owl2.trigger('next.owl.carousel');
        })
        // Go to the previous item
        $('.btn-prev.btn-prev2').click(function() {
            // With optional speed parameter
            // Parameters has to be in square bracket '[]'
            owl2.trigger('prev.owl.carousel', [300]);
        });
    
    
  </script>";

  $response = json_encode($output);
  echo $response;
  die();
}
add_action('wp_ajax_filter_posts', 'ajax_filter_get_posts');
add_action('wp_ajax_nopriv_filter_posts', 'ajax_filter_get_posts');
add_action('woocommerce_after_shop_loop_item', 'my_print_stars' );


function my_print_stars(){
    global $wpdb;
    global $post;
    $count = $wpdb->get_var("
    SELECT COUNT(meta_value) FROM $wpdb->commentmeta
    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
    WHERE meta_key = 'rating'
    AND comment_post_ID = $post->ID
    AND comment_approved = '1'
    AND meta_value > 0
");

$rating = $wpdb->get_var("
    SELECT SUM(meta_value) FROM $wpdb->commentmeta
    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
    WHERE meta_key = 'rating'
    AND comment_post_ID = $post->ID
    AND comment_approved = '1'
");

if ( $count > 0 ) {

    $average = number_format($rating / $count, 2);

    echo '<div class="starwrapper" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';

    echo '<span class="star-rating" title="'.sprintf(__('Rated %s out of 5', 'woocommerce'), $average).'"><span style="width:'.($average*16).'px"><span itemprop="ratingValue" class="rating">'.$average.'</span> </span></span>';

    echo '</div>';
    }

}


function storefront_child_remove_phone($fields) {
    unset( $fields ['billing_company'] );
    unset( $fields ['billing_address_1'] );
    unset( $fields ['billing_address_2'] );
    unset( $fields ['billing_postcode'] );
    return $fields;
}
add_filter( 'woocommerce_billing_fields', 'storefront_child_remove_phone' );

// Hook in
add_filter( 'woocommerce_billing_fields' , 'custom_override_billing_fields' );

 
add_action( 'woocommerce_edit_account_form', 'my_woocommerce_edit_account_form' );
add_action( 'woocommerce_save_account_details', 'my_woocommerce_save_account_details' );
 
function my_woocommerce_edit_account_form() {
 
  $user_id = get_current_user_id();
  $user = get_userdata( $user_id );
 
  if ( !$user )
    return;
 
  $phone = get_user_meta( $user_id, 'phone', true );
  $country = get_user_meta( $user_id, 'country', true );
  $citystate = get_user_meta( $user_id, 'citystate', true );
  $url = $user->user_url;
 
  ?>
 
  
    <p class="woocommerce-FormRow woocommerce-FormRow--last form-row form-row-last">
      <input type="text" name="country" placeholder="Country" value="<?php echo esc_attr( $country ); ?>" class="input-text" />
    </p>
    <p class="woocommerce-FormRow woocommerce-FormRow--first form-row form-row-first">
      <input type="text" name="citystate" placeholder="City/State" value="<?php echo esc_attr( $citystate ); ?>" class="input-text" />
    </p>
    <p class="woocommerce-FormRow woocommerce-FormRow--last form-row form-row-last">
      <input type="text" name="phone" placeholder="Phone Number" value="<?php echo esc_attr( $phone ); ?>" class="input-text" />
    </p>
  </fieldset>
 
 
  <?php
 
}
 
function my_woocommerce_save_account_details( $user_id ) {
 
  update_user_meta( $user_id, 'phone', htmlentities( $_POST[ 'phone' ] ) );
  update_user_meta( $user_id, 'country', htmlentities( $_POST[ 'country' ] ) );
  update_user_meta( $user_id, 'citystate', htmlentities( $_POST[ 'citystate' ] ) );
 
  $user = wp_update_user( array( 'ID' => $user_id, 'user_url' => esc_url( $_POST[ 'url' ] ) ) );
 
}

// Ajax for Sample Packs
// Enqueue script
function ajax_filter_posts_scrip() {
  // Enqueue script
  wp_register_script('afp_scripts', get_template_directory_uri() . '/ajax-filter.js', false, null, false);
  wp_enqueue_script('afp_scripts');

  wp_localize_script( 'afp_scripts', 'afp_vars', array(
        'afp_nonce' => wp_create_nonce( 'afp_nonce' ), // Create nonce which we later will use to verify AJAX request
        'afp_ajax_url' => admin_url( 'admin-ajax.php' ),
      )
  );
}
add_action('wp_enqueue_scripts', 'ajax_filter_posts_scrip', 100);
// Script for getting posts
function ajax_filter( $taxonomy ) {

  // Verify nonce
  if( !isset( $_POST['afp_nonce'] ) || !wp_verify_nonce( $_POST['afp_nonce'], 'afp_nonce' ) )
    die('Permission denied');

  $taxonomy = $_POST['taxonomy'];
  $attribute = $_POST['attribute'];

  // WP Query
  /*$argsa = array(
    'post_type' => 'product',
    'posts_per_page' => 500,
    'order' => DESC,
    'relation' => 'AND',
    'tax_query' => array (
        array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $taxonomy,
            ),
        array(
            'taxonomy' => 'pa_genre',
            'field' => 'slug',
            'terms' => $attribute,
            'operator' => 'IN',
            ),
         
        ),
  );*/

  // Suburbs
if( !empty( $_POST['taxonomy'] ) ) {
    $taxonomy = $_POST['taxonomy'];
}

// States
if( !empty( $_POST['attribute'] ) ) {
    $attribute = $_POST['attribute'];
}

// Query arguments.

if($_POST['is_free'] == 1){
$argsa = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => 10,
            'meta_key'  => '_price',
            'meta_value' => 0,
            'meta_compare' => '=',
            'orderby' => 'menu_order',
			'order' => 'asc',
        );
}elseif ($_POST['is_free'] == 0){
$argsa = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => 10,
            'meta_key'  => '_price',
            'meta_value' => 0,
            'meta_compare' => '!=',
            'orderby' => 'menu_order',
			'order' => 'asc',
        );
}

$taxquery = array();

// if $state variable is selected.
if(!empty($taxonomy)){
    array_push($taxquery,array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $taxonomy,
        ));
}

// if $suburbs variable is selected.
if(!empty($attribute) && $attribute != 'Genre'){
    array_push($taxquery,array(
            'taxonomy' => 'pa_genre',
            'field' => 'slug',
            'terms' => $attribute,
        ));
}

// if $taxquery has array;
if(!empty($taxquery)){
    $argsa['tax_query'] = $taxquery;
}

  
  $query = new WP_Query($argsa);
  $output = '<div class="home-slide--wrap" id="samplepack-slider">
    <div class="owl-carousel3">';
  $i = 0; 
  $countPack = 0;
  $cau = 0;
  global $product, $woocommerce_loop, $post;
  if( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post();
    $cau++;
    $countPack++;
  if ($i == 0){
    $output .= '<div class="home-slide--item">
        <div class="samplepack-list js-samplepack-list">';
  }
  $i++;
  $output .= '<div class="samplepack-item" >';
	$price = get_post_meta( get_the_ID(), '_regular_price', true);
	$_product = wc_get_product( $post->ID );
	$sale_price = $_product->get_sale_price();
	  if($sale_price > 0){
		  $output .= '<div class="bubble">
			 <div class="inside">
			   <div class="inside-text">';
					$percentage = round( ( ( $price - $sale_price ) / $price ) * 100 );
					$output .= sprintf( __('%s OFF', 'woocommerce' ), $percentage . '%' ); 
		   $output .='</div>
			 </div>
		  </div>';
		}
  $output .= '<p>';
  if($_POST['is_free'] == 1){
  $output .= '<a href="javascript:void(0)">';
  }else
  {
    $output .= '<a href="' . get_the_permalink() . '">';
  }
  if( has_post_thumbnail() ) {
    $output .= ' ' . get_the_post_thumbnail() . ' ';
  }
  else {
    $output .= '<img src="'.get_bloginfo("template_url").'/images/UnisonLogo.jpg" />';
  }
  $output .= '</a>';
  $output .= '</p>';
$product_price = get_post_meta( get_the_ID(), '_price', true);
  //$output .= '<div class="copy"><h4><a class="js-title-samplepacks" href="'. get_the_permalink() . '">' . get_the_title() .'</a></h4><h6>Afreaux</h6>';
if($product_price == 0){
  $output .= '<div class="copy"><h4><a class="js-title-samplepacks" href="javascript:void(0);">' . get_the_title() .'</a></h4>';
}else{
	$output .= '<div class="copy"><h4><a class="js-title-samplepacks" href="'. get_the_permalink() . '">' . get_the_title() .'</a></h4>';
}
  $price = get_post_meta( get_the_ID(), '_regular_price', true);
  $currency = get_woocommerce_currency_symbol();
  $currency_pos = get_option( 'woocommerce_currency_pos' );
  if($product_price == 0){
  $output .= '<p class="js-price-text">';
    	$output .= '<span class="price"><ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">FREE</span></ins></span>';
  $output .= '</p>';
}else{
	$output .= '<p class="js-price-text">';
  if ($currency_pos == 'left' or $currency_pos == 'left_space') {
  	if($sale_price > 0){
  	$output .= '<span class="price"><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">'.$currency.'</span>'.$price.'</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">'.$currency.'</span>'.$sale_price.'</span></ins></span>';
  	}else{
    $output .= '<span class="price"><ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">'.$currency.'</span>'.$price.'</span></ins></span>';
	}
  }
  else {
  	if($sale_price > 0){
    	$output .= '<span class="price"><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">'.$price.'</span>'.$currency.'</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">'.$sale_price.'</span>'.$currency.'</span></ins></span>';
    }else{
    	$output .= '<span class="price"><ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">'.$price.'</span>'.$currency.'</span></ins></span>';
    } 
  }
  $output .= '</p>';
}
  $price = get_post_meta( get_the_ID(), '_regular_price', true);
  $product_price = get_post_meta( get_the_ID(), '_price', true);
  $downloads = get_post_meta( get_the_ID(), '_downloadable_files', true);
  $output .= '<div class="ctas cta">';
  $music = get_post_meta( $post->ID, '_music', true );
  if($product_price == 0){
     $output .= '<a href="#" class="btn-free-play js-sound" data-file="'.$music.'" data-id="'.$post->ID.'"></a>'; 
    if(is_user_logged_in()){
      $output .= do_shortcode('[download_now id="" text="Download"]');
    }else
    {
       $output .= '<a rel="nofollow" href="javascript:void(0)" data-product_title="'.get_the_title().'" data-quantity="1" data-product_id="'. get_the_ID() .'" data-product_sku="" class="js-check-login btn-buy">Download</a>';
    }
         
  }elseif ($product_price > 0){
    if($post->ID != 1828){
    $output .= '<a href="#" class="btn-play js-sound" data-file="'.$music.'" data-id="'.$post->ID.'"></a>';
    }
    $output .= '<a rel="nofollow" href="'.get_the_permalink().'" data-product_title="'.get_the_title().'" data-quantity="1" data-product_id="'. get_the_ID() .'" data-product_sku="" class="btn-buy ">Learn More</a>';

      //$_product->get_sale_price();
    
  }
  

  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  if ($i == 6){
    $output .= '</div></div>';
    $i = 0;
  }

  endwhile;
  $ostPack = $countPack % 6;
  if($ostPack == 0){
    $ostPack = 0;
  }
  else {
    $ostPack = 6 - $ostPack;
  }
    

  
  $s=0;
  while($ostPack){
    $output .= '<div class="samplepack-item empty-'.$s++.' empty">
    <p><img src="'. get_bloginfo('template_url') .'/images/sample-empty.jpg"></p>
    <div class="copy">
      <h4></h4>
      <h6></h6>
    </div>
  </div>';

  $ostPack--;
  }
  elseif(!$query->have_posts()) :
    $ostPack = $countPack % 6;
  
    $ostPack = 6 - $ostPack;

    $output .= '<div class="home-slide--item">
        <div class="samplepack-list js-samplepack-list">';
  
  while($ostPack){
    $output .= '<div class="samplepack-item empty">
    <p><img src="'. get_bloginfo('template_url') .'/images/sample-empty.jpg"></p>
    <div class="copy">
      <h4></h4>
      <h6></h6>
    </div>
  </div>';

  $ostPack--;
  }
  $output .= '</div></div>';
  endif;
  
  $output .= '</div></div></div>';
  if ($cau > 6){
  $output .= '<p class="max-width">
      <span class="btn-prev btn-prev3"></span>
      <span class="btn-next btn-next3"></span>
    </p></div></div>';  
  }
  
  //$output .= '<a href="/soundbanks/" class="btn page-p">View all</a>';
  //$output .= '<script src="'.get_bloginfo('template_url').'/libs/owlcarousel/owl.carousel.js"></script><script src="'.get_bloginfo('template_url').'/js/modules/slider.js"></script>';
  $output .= "<script>
  
      
        var owl3 = $('.owl-carousel3');
        owl3.owlCarousel({
          loop:true,
          items:1,
          dots:true,
          navSpeed:1000,
          dragEndSpeed:1000,
          smartSpeed:1000,
          fluidSpeed:1000,
          lazyLoad:true,
          lazyContent:true,
        });
        // Go to the next item
        $('.btn-next.btn-next3').click(function() {
            owl3.trigger('next.owl.carousel');
        })
        // Go to the previous item
        $('.btn-prev.btn-prev3').click(function() {
            // With optional speed parameter
            // Parameters has to be in square bracket '[]'
            owl3.trigger('prev.owl.carousel', [300]);
        });
    
    
  </script>";
  
  $response = json_encode($output);
  echo $response;
  die();
}
add_action('wp_ajax_filter_posts2', 'ajax_filter');
add_action('wp_ajax_nopriv_filter_posts2', 'ajax_filter');

function my_woocommerce_add_error( $error ) {
    if (strpos($error,'required') !== false) {
        $error = 'Required';
    }
    return $error;
}
add_filter( 'woocommerce_add_error', 'my_woocommerce_add_error' );

// turn off pass char
function wc_ninja_remove_password_strength() {
  if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
    wp_dequeue_script( 'wc-password-strength-meter' );
  }
}
add_action( 'wp_print_scripts', 'wc_ninja_remove_password_strength', 100 );
// --------------

function redirect_login_page() {
  $login_page  = home_url( '/login/' );
  $page_viewed = basename($_SERVER['REQUEST_URI']);
 
  if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
    wp_redirect($login_page);
    exit;
  }
}
add_action('init','redirect_login_page');

function login_failed() {
  $login_page  = home_url( '/login/' );
  wp_redirect( $login_page . '?login=failed' );
  exit;
}
add_action( 'wp_login_failed', 'login_failed' );
 
function verify_username_password( $user, $email, $password ) {
  $login_page  = home_url( '/login/' );
    if( sanitize_email($email) == "" || $password == "" ) {
        wp_redirect( $login_page . "?login=empty" );
        exit;
    }
}
add_filter( 'authenticate', 'verify_username_password',1, 3 );

/**
 * Returns genres concatenation by artist id
 *
 * @param $id
 * @return string
 */
function get_genres_by_id($id)
{
    $terms = get_the_terms($id, 'product_cat');
    $genres = [];
    if (!empty($terms)) {
        foreach ($terms as $term) {
            if (!empty($term->slug) && ($term->slug != 'artists')) {
                $genres[] = $term->name;
            }
        }
    }

    return implode(',', $genres);
}

/**
 * Send  SendinBlue trigger email
 *
 * @param $data
 * @return bool true on success and false on failure
 */
function sib_trigger($data)
{
    if (!isset($data['headers'])) {
        $data['headers'] = [];
    }

    $data['headers']['X-Mailin-tag'] = 'WP Unison Audio';

    if (isset($data['attr'])) {
        $data['attr']['SITE_URL'] = home_url();
    }

    $mailin = new Mailin(SIB_Manager::sendinblue_api_url, SIB_Manager::$access_key);
    $res = $mailin->send_transactional_template($data);

    return (!empty($res) && $res['code'] == 'success') ? true : false;
}

function searchfilter($query) {

    if ($query->is_search && !is_admin() ) {
        $query->set('post_type',array('product'));
    }

return $query;
}

add_filter('pre_get_posts','searchfilter');

add_action( 'wp_enqueue_scripts', 'so_load_script', 20 );
function so_load_script(){
 
    wp_enqueue_script( 'so_test', get_template_directory_uri().'/js/ajax_trigger.js' );
  
    $i18n = array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'checkout_url' => get_permalink( wc_get_page_id( 'checkout' ) ) );
    wp_localize_script( 'so_test', 'SO_TEST_AJAX', $i18n );
}


    // I took get_product_by_sku function in stackoverflow but I don't remember which question. 
    function get_product_by_sku( $sku ) {

        global $wpdb;

        $product_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $sku ) );

        if ( $product_id ) return new WC_Product( $product_id );

        return null;
    }

add_action('wp_ajax_myajax', 'myajax_callback');
add_action('wp_ajax_nopriv_myajax', 'myajax_callback');

    /**
     * AJAX add to cart.
     */
function myajax_callback() { 
      
      ob_start();
      global $woocommerce,$post,$wpdb; 
      require_once(dirname(dirname(dirname(dirname(__FILE__)))).('/wp-config.php'));
      $product_id        = $_REQUEST['id_p'];
      $product_title      = $_REQUEST['title_p'];
      $quantity          = 1;
      $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
      $product_status    = get_post_status( $product_id );
		$customer_orders = get_posts( array(
        'numberposts' => -1,
        'meta_key'    => '_customer_user',
        'meta_value'  => get_current_user_id(),
        'post_type'   => wc_get_order_types(),
        'post_status' => array_keys( wc_get_order_statuses() ),
    ) );
  		$productIds=array();
          foreach($customer_orders as $customer_order)
          {
            $customer_order_ID = $customer_order->ID;
            $customers_orders = wc_get_order( $customer_order_ID );
            
            foreach( $customers_orders-> get_items() as $item_key => $item_values ):
                  $item_data = $item_values->get_data();
                  $item_id = $item_data['product_id'];
                  $productIds[]=$item_id;
              endforeach;
          }
		  if(in_array( $product_id, $productIds)){
             $data = array(
                'error' => "completed",
            );
     			wp_send_json( $data );

            }
		
        if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity ) && 'publish' === $product_status ) {
        do_action( 'woocommerce_ajax_added_to_cart', $product_id );
        wc_add_to_cart_message( $product_id );
         $data = array(
                'error' => false,
            );
     wp_send_json( $data );
        } else {
            // If there was an error adding to the cart, redirect to the product page to show any errors
            $data = array(
                'error'       => true,
                'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
            );
            wp_send_json( $data );
        }
        die();
}


/*add_action('wp_ajax_renew', 'renew_product');
add_action('wp_ajax_nopriv_renew', 'renew_product');

    /**
     * AJAX add to cart.
     */
/*function renew_product() { 
      
        ob_start();
        global $woocommerce,$post,$wpdb; 
        $product_id        = $_REQUEST['id_p'];

        $product_title      = $_REQUEST['title_p'];
        $quantity          = 1;
        $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
        $product_status    = get_post_status( $product_id );
        if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity ) && 'publish' === $product_status ) {
        do_action( 'woocommerce_ajax_added_to_cart', $product_id );
        wc_add_to_cart_message( $product_id );
         $data = array(
                'error' => false,
            );
     wp_send_json( $data );
        } else {
            // If there was an error adding to the cart, redirect to the product page to show any errors
            $data = array(
                'error'       => true,
                'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
            );
            wp_send_json( $data );
        }
        die();
}
*/

function ajax_check_user_logged_in() {
    echo is_user_logged_in()?'yes':'no';
    die();
}
add_action('wp_ajax_is_user_logged_in', 'ajax_check_user_logged_in');
add_action('wp_ajax_nopriv_is_user_logged_in', 'ajax_check_user_logged_in');

add_filter('woocommerce_get_price_html', 'changeFreePriceNotice', 10, 2);
 
function changeFreePriceNotice($price, $product) {
  error_log($price);
  if ( $price == wc_price( 0.00 ) )
    return 'FREE';
  else
    return $price;
}

add_action('wp_ajax_homesubscription', 'homesubscriptionform');
add_action('wp_ajax_nopriv_homesubscription', 'homesubscriptionform');

    /**
     * AJAX add to cart.
     */
function homesubscriptionform() { 
  global $lastname;
       ob_start();
   		$fname =  explode(" ",$_REQUEST['first_name']);
      $lastname = '';
        for($i=1 ; $i<=count($fname);$i++){
            $lastname .= $fname[$i].' ';
        }
      
      $email = $_REQUEST['email'];
  		$url = 'https://unisonaudio.api-us1.com';
            $params = array(
                'api_key' => 'eb2fe56e0e9a790cb32dba566dcdb88e6a8744ebcb9250dac170a32651e0cf4db85bfb09',
                'api_action' => 'contact_add',
                'api_output' => 'serialize',
            );
            $post = array(
                'email'                    => $email,
                'first_name'               => $fname[0],
                'last_name'               => $lastname,
                'p[3]'                   => 3, 
                'status[3]'              => 1, 
                'instantresponders[123]' => 0, // set to 0 to if you don't want to sent instant autoresponders
            );

            // This section takes the input fields and converts them to the proper format
            $query = "";
            foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
            $query = rtrim($query, '& ');
            // This section takes the input data and converts it to the proper format
            $data = "";
            foreach( $post as $key => $value ) $data .= urlencode($key) . '=' . urlencode($value) . '&';
            $data = rtrim($data, '& ');
            // clean up the url
            $url = rtrim($url, '/ ');
            if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');
            // If JSON is used, check if json_decode is present (PHP 5.2.0+)
            if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
                die('JSON not supported. (introduced in PHP 5.2.0)');
            }
        // define a final API request - GET
        $api = $url . '/admin/api.php?' . $query;
        $request = curl_init($api); // initiate curl object
        curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
        curl_setopt($request, CURLOPT_POSTFIELDS, $data); // use HTTP POST to send form data
        //curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
        curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
        $response = (string)curl_exec($request); // execute curl post and store curl_setopt
        curl_close($request); // close curl object
        if ( !$response ) {
            die('Nothing was returned. Do you have a connection to Email Marketing server?');
        }
        $result = unserialize($response);
        if($result['result_code'] == 1){
           $data = array(
        'error' => false,
        'message' => 'You have successfully joined the Unison newsletter.'
    );
    wp_send_json( $data );

   }else if($result->result_code == 0)
   {
     $data = array(
                'error' => true,
                'message' => $result['result_message']
            );
     wp_send_json( $data );
   }
      
}

add_filter( 'woocommerce_order_button_text', 'woo_custom_order_button_text' ); 
function woo_custom_order_button_text() {
    return __( 'CHECKOUT', 'woocommerce' ); 
}
// define the woocommerce_save_account_details callback 
function action_woocommerce_save_account_details( $user_id ) { 
  $user_info = get_userdata($user_id);
  $user_email= $user_info->user_email;
  $first_name = get_user_meta( $user_id, 'first_name',true );
  $exists = email_exists( $user_email );
  if(!empty($_POST['account_email']) && $_POST['old_email'] != $_POST['account_email']){
  	wp_update_user( array ( 'ID' => $user_id, 'user_login' => $_POST['account_email'] ) ) ;
       sib_trigger(array(
            'id' => 8,
            'to' => $user_email,
            'attr' => array(
                'EMAIL' =>  $user_email,
                'FIRSTNAME' => $first_name
            )
        ));
     }
}
add_action( 'woocommerce_save_account_details', 'action_woocommerce_save_account_details', 10, 1 ); 

function _remove_script_version( $src ){
 // Remove query strings from static resources
$parts = explode( '?ver', $src );
return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
function crunchify_disable_comment_url($fields) { 
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields','crunchify_disable_comment_url');