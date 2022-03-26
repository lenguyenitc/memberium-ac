<?php

add_action( 'unison_new_cron', 'cw_function' ); // cron job function to add new month audio
function cw_function() {
    $subject = "Congratulation! New audio added to your account new.";
    $headers  = "From: Unison  <info@unison.audio>\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();
    $headers .= "X-Priority: 1\n"; // Urgent message!
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=iso-8859-1\n";
    $user_email = array();
    $subscriptions = wcs_get_subscriptions(['subscriptions_per_page' => -1]); // get all subscription users
    foreach ( $subscriptions as $subscription ) {
        $updated_val = $name = '';
        $data = $subscription->get_data();
        if($data['status'] == 'active'){ // for active subscription
            $id = $data['id'];

            $subscription = wc_get_order($id); 
            $items = $subscription->get_items();  
            $variation_id = '' ;
            foreach( $items as $item ) {
                $type = $item->get_type();
                $product_id = $item->get_product_id();
                $variation_id = $item->get_variation_id();
            }

            $view_link = home_url('my-account/view-subscription/'.$id);
            $sub = wcs_get_subscription( $id );
            $sub_end_date = $sub->get_date('next_payment');
            $createDate = new DateTime($sub_end_date);

            $strip = $createDate->format('Y-m-d');
            $toda = date('Y-m-d');

            if($strip == $toda){
                $user_email = $data['billing']['email'];
                $user = get_user_by( 'email', $user_email );
                if(count($user) > 0){
                    $name = $user->display_name;
                }
                $purchase_month = get_post_meta( $id, 'purchased_month_packs', true );
                $get_current = date('F Y');
                if($purchase_month != ''){
                    $convert_to_array = array_map('trim', explode(',', $purchase_month));
                    if(!in_array($get_current, $convert_to_array)){
                        $updated_val = $purchase_month.','.$get_current;
                    }
                    else{
                        $updated_val = $get_current;
                    }
                }else{
                    $updated_val = $get_current;
                }

                if($updated_val != ''){

                    update_post_meta($id, 'purchased_month_packs', esc_attr($updated_val));
                    // create message
                    $message = "<h2>".date('F')." audio added to your account.</h2>";
                    $message .= "<p>Hi ".ucwords($name).",</p>";
                    $message .= "<p>Congratulations, you got <strong>".date('F')."</strong> month audio free. Thank you for choosing us! </p>";
                    $message .= "<p>Please checkout your new audio by goto your profile section.</p>";
                    $message .= "<p>or <a href='".$view_link."'>click here</a> </p>";
                    $message .= "<p>Thank you for being our valued customer.</p>";
                    $message .= "<br><p>Thanks & Regards<br><strong>Unison</strong></p>";
                    //wp_mail('hahifej865@showbaz.com',$subject,$message,$headers); // send mail to user
                    $monthdwn = date('F');
                    $nrevulink = "<a href='".$view_link."'>click here</a>";
                    //wp_mail('refremailnew123@yopmail.com','$subject',$user_email,'$headers');
                    sib_trigger(array(
                       'id' => 14,
                       'to' =>  $user_email,
                       'attr' => array(
                           'USER_NAME' => $name,
                           'AUDIO_MONTH' =>  $monthdwn,
                           'AUDIO_LINK' => $nrevulink,
                       )
                    ));
                }
            }
        }
    }
    die;
}

include 'salesGraphFunctions.php';
add_theme_support('woocommerce');

function register_my_widgets()
{
    register_sidebar(array(
        'name' => "Footer Socials",
        'id' => 'footer_socials',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'register_my_widgets');

function register_my_widgets2()
{
    register_sidebar(array(
        'name' => "Currency",
        'id' => 'currency',
    ));
}

add_action('init', 'myStartSession');
function myStartSession() {
    if(!session_id()) {
        session_start();
    }
}

// Display Fields
add_action('woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields');

// Save Fields
add_action('woocommerce_process_product_meta', 'woo_add_custom_general_fields_save');

function woo_add_custom_general_fields()
{

    global $woocommerce, $post;

    echo '<div class="options_group">';

    // Text Field
    woocommerce_wp_text_input(
        array(
            'id' => '_record',
            'label' => __('Record label', 'woocommerce'),
            'placeholder' => 'Record label',
            'desc_tip' => 'true',
            'description' => __('', 'woocommerce'),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => '_language',
            'label' => __('Language', 'woocommerce'),
            'placeholder' => 'Language',
            'desc_tip' => 'true',
            'description' => __('', 'woocommerce'),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => '_music',
            'label' => __('Demo music URL', 'woocommerce'),
            'placeholder' => 'Music URL',
            'desc_tip' => 'true',
            'description' => __('', 'woocommerce'),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => '_location',
            'label' => __('Location', 'woocommerce'),
            'placeholder' => 'Location',
            'desc_tip' => 'true',
            'description' => __('', 'woocommerce'),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => '_daw',
            'label' => __('DAW', 'woocommerce'),
            'placeholder' => 'DAW',
            'desc_tip' => 'true',
            'description' => __('', 'woocommerce'),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => '_rec',
            'label' => __('Recommended Plugins For Lesson:', 'woocommerce'),
            'placeholder' => 'Recommended Plugins For Lesson:',
            'desc_tip' => 'true',
            'description' => __('', 'woocommerce'),
        )
    );

    woocommerce_wp_text_input(
        array(
            'id' => '_facebook',
            'label' => __('Facebook url', 'woocommerce'),
            'placeholder' => 'Facebook url',
            'desc_tip' => 'true',
            'description' => __('', 'woocommerce'),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => '_twitter',
            'label' => __('Twitter url', 'woocommerce'),
            'placeholder' => 'Twitter url',
            'desc_tip' => 'true',
            'description' => __('', 'woocommerce'),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => '_soundcloud',
            'label' => __('SoundCloud url', 'woocommerce'),
            'placeholder' => 'SoundCloud url',
            'desc_tip' => 'true',
            'description' => __('', 'woocommerce'),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => '_spotify',
            'label' => __('Spotify url:', 'woocommerce'),
            'placeholder' => 'Spotify url:',
            'desc_tip' => 'true',
            'description' => __('', 'woocommerce'),
        )
    );

    echo '</div>';
}

function woo_add_custom_general_fields_save($post_id)
{

    // Text Field
    $woocommerce_text_field = $_POST['_record'];
    if (!empty($woocommerce_text_field)) {
        update_post_meta($post_id, '_record', esc_attr($woocommerce_text_field));
    }

    // Text Field
    $woocommerce_text_field = $_POST['_language'];
    if (!empty($woocommerce_text_field)) {
        update_post_meta($post_id, '_language', esc_attr($woocommerce_text_field));
    }

    $woocommerce_text_field = $_POST['_music'];
    if (!empty($woocommerce_text_field)) {
        update_post_meta($post_id, '_music', esc_attr($woocommerce_text_field));
    }

    // Text Field
    $woocommerce_text_field = $_POST['_location'];
    if (!empty($woocommerce_text_field)) {
        update_post_meta($post_id, '_location', esc_attr($woocommerce_text_field));
    }

    // Text Field
    $woocommerce_text_field = $_POST['_daw'];
    if (!empty($woocommerce_text_field)) {
        update_post_meta($post_id, '_daw', esc_attr($woocommerce_text_field));
    }

    // Text Field
    $woocommerce_text_field = $_POST['_rec'];
    if (!empty($woocommerce_text_field)) {
        update_post_meta($post_id, '_rec', esc_attr($woocommerce_text_field));
    }

    $woocommerce_text_field = $_POST['_facebook'];
    if (!empty($woocommerce_text_field)) {
        update_post_meta($post_id, '_facebook', esc_attr($woocommerce_text_field));
    }

    // Text Field
    $woocommerce_text_field = $_POST['_twitter'];
    if (!empty($woocommerce_text_field)) {
        update_post_meta($post_id, '_twitter', esc_attr($woocommerce_text_field));
    }

    // Text Field
    $woocommerce_text_field = $_POST['_soundcloud'];
    if (!empty($woocommerce_text_field)) {
        update_post_meta($post_id, '_soundcloud', esc_attr($woocommerce_text_field));
    }

    // Text Field
    $woocommerce_text_field = $_POST['_spotify'];
    if (!empty($woocommerce_text_field)) {
        update_post_meta($post_id, '_spotify', esc_attr($woocommerce_text_field));
    }
}

register_nav_menus(array(
    'header_menu' => 'Header Menu',
    'footer_menu' => 'Footer Menu'
));

add_action('widgets_init', 'register_my_widgets2');




// Подключение библиотеки jQuery
add_action('wp_enqueue_scripts', 'my_scripts_method');
function my_scripts_method()
{
    wp_enqueue_style('main-css', get_template_directory_uri() . '/css/main.css');
//    wp_enqueue_style('new-css', get_template_directory_uri() . '/assets/css/new_main.css');
    wp_enqueue_style('animate-css', get_template_directory_uri() . '/css/animate.css');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/libs/font-awesome/css/font-awesome.css');
    wp_enqueue_style('owl-carousel-default', get_template_directory_uri() . '/libs/owlcarousel/assets/owl.theme.default.min.css');
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/libs/owlcarousel/assets/owl.carousel.min.css');
    wp_enqueue_style('sweet-alert', get_template_directory_uri() . '/libs/modal/sweetalert.css');

    wp_enqueue_style('font', 'https://fonts.googleapis.com/css2?family=Montserrat&display=swap');
    wp_enqueue_style( 'default-style', get_stylesheet_uri() );

//      wp_enqueue_style( 'mediaelement-css', get_template_directory_uri() . '/assets/js/mediaelement/mediaelementplayer.min.css' );

    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '1.0.0', true);

    wp_enqueue_script('fastclick', get_template_directory_uri() . '/js/libs/fastclick.js', array(), '1.0.0', true);
    wp_enqueue_script('howler', get_template_directory_uri() . '/js/libs/howler.core.js', array(), '1.0.0', true);
    wp_enqueue_script('siriwave', get_template_directory_uri() . '/js/libs/siriwave.js', array(), '1.0.0', true);
    wp_enqueue_script('be', get_template_directory_uri() . '/js/be.js', array(), '1.0.0', true);
    wp_enqueue_script('timezone', get_template_directory_uri() . '/js/timezone.js', array(), '1.0.0', true);
    wp_enqueue_script('moment', get_template_directory_uri() . '/js/moment.js', array(), '1.0.0', true);
    wp_enqueue_script('moment-timezone', get_template_directory_uri() . '/js/moment-timezone-with-data.js', array(), '1.0.0', true);
    wp_enqueue_script('plugin', get_template_directory_uri() . '/js/libs/plugin.js', array(), '1.0.0', true);
    wp_enqueue_script('sc-player', get_template_directory_uri() . '/js/libs/sc-player.js', array(), '1.0.0', true);

    wp_enqueue_script('soundcloud', get_template_directory_uri() . '/js/libs/soundcloud.player.api.js', array(), '1.0.0', true);
    wp_enqueue_script('underscore', get_template_directory_uri() . '/js/libs/underscore-1.7.0.js', array(), '1.0.0', true);
    wp_enqueue_script('utils', get_template_directory_uri() . '/js/libs/utils.js', array(), '1.0.0', true);
    wp_enqueue_script('owlcarousel', get_template_directory_uri() . '/libs/owlcarousel/owl.carousel.min.js', array(), '1.0.0', true);
    wp_enqueue_script('helper', get_template_directory_uri() . '/js/modules/helper.js', array(), '1.0.0', true);
    wp_enqueue_script('player', get_template_directory_uri() . '/js/modules/player.js', array(), '1.0.0', true);
    wp_enqueue_script('slider', get_template_directory_uri() . '/js/modules/slider.js', array(), '1.0.0', true);
    wp_enqueue_script('main', get_template_directory_uri() . '/js/modules/main.js', array(), '1.0.0', true);
    wp_enqueue_script('function', get_template_directory_uri() . '/js/functions.js', array(), '1.0.0', true);
    wp_enqueue_script('sweetalert', get_template_directory_uri() . '/libs/modal/sweetalert.min.js', array(), '1.0.0', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    //    wp_enqueue_script('mediaelement', get_template_directory_uri() . '/assets/js/mediaelement/mediaelement-and-player.min.js', array(), '1.0.0', true);

    // отменяем зарегистрированный jQuery
    // вместо "jquery-core" просто "jquery", чтобы отключить jquery-migrate
    wp_deregister_script('jquery-core');
    wp_register_script('jquery-core', '//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js');
    wp_enqueue_script('jquery');
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/custom.js', array(), '1.1.0', true);
    wp_enqueue_script( 'reset-ajax',get_template_directory_uri() . '/assets/js/reset-ajax.js', array( 'jquery' ) );

    wp_localize_script('reset-ajax', 'resetajax',
        array(
            'reset_nonce' => wp_create_nonce('reset_nonce'), // Create nonce which we later will use to verify AJAX request
            'reset_ajax_url' => admin_url('admin-ajax.php'),
        ));

}

function add_additional_class_on_li($classes, $item, $args)
{
    if (isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}

add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

function add_menu_link_class($atts, $item, $args)
{
    if (property_exists($args, 'link_class')) {
        $atts['class'] = $args->link_class;
    }
    return $atts;
}

add_filter('nav_menu_link_attributes', 'add_menu_link_class', 1, 3);

function woo_related_products_limit()
{
    global $product;

    $args['posts_per_page'] = 6;
    return $args;
}

add_filter('woocommerce_output_related_products_args', 'jk_related_products_args');
function jk_related_products_args($args)
{
    $args['posts_per_page'] = 20; // 4 related products
    $args['columns'] = 20; // arranged in 2 columns
    return $args;
}

add_filter('woocommerce_locate_template', 'so_25789472_locate_template', 10, 3);

function so_25789472_locate_template($template, $template_name, $template_path)
{

    // on single posts with mock category and only for single-product/something.php templates
    if (is_product() && has_term('artists', 'product_cat') && strpos($template_name, 'single-product/') !== false) {

        // replace single-product with single-product-mock in template name
        $mock_template_name = str_replace("single-product/", "single-product-artists/", $template_name);

        // look for templates in the single-product-mock/ folder
        $mock_template = locate_template(
            array(
                trailingslashit($template_path) . $mock_template_name,
                $mock_template_name,
            )
        );

        // if found, replace template with that in the single-product-mock/ folder
        if ($mock_template) {
            $template = $mock_template;
        }
    }

    return $template;
}

// Enqueue script
function ajax_filter_posts_scripts()
{
    // Enqueue script
    wp_register_script('afp_script', get_template_directory_uri() . '/ajax-filter-posts.js', false, null, false);
    wp_enqueue_script('afp_script');

    wp_localize_script(
        'afp_script',
        'afp_vars',
        array(
            'afp_nonce' => wp_create_nonce('afp_nonce'), // Create nonce which we later will use to verify AJAX request
            'afp_ajax_url' => admin_url('admin-ajax.php'),
        )
    );
}

add_action('wp_enqueue_scripts', 'ajax_filter_posts_scripts', 100);
// Script for getting posts
function ajax_filter_get_posts($taxonomy)
{
    global $post;

    // Verify nonce
    if (!isset($_POST['afp_nonce']) || !wp_verify_nonce($_POST['afp_nonce'], 'afp_nonce')) {
        //die('Permission denied');
        ?>
<div class="samplepack-list js-samplepack-list">
    <div class="samplepack-item empty">
        <p><img src="https://unison.audio/wp-content/themes/unison-vrrb/images/sample-empty.jpg"></p>
        <div class="copy">
            <h4></h4>
            <h6></h6>
        </div>
    </div>
    <div class="samplepack-item empty">
        <p><img src="https://unison.audio/wp-content/themes/unison-vrrb/images/sample-empty.jpg"></p>
        <div class="copy">
            <h4></h4>
            <h6></h6>
        </div>
    </div>
    <div class="samplepack-item empty">
        <p><img src="https://unison.audio/wp-content/themes/unison-vrrb/images/sample-empty.jpg"></p>
        <div class="copy">
            <h4></h4>
            <h6></h6>
        </div>
    </div>
    <div class="samplepack-item empty">
        <p><img src="https://unison.audio/wp-content/themes/unison-vrrb/images/sample-empty.jpg"></p>
        <div class="copy">
            <h4></h4>
            <h6></h6>
        </div>
    </div>
    <div class="samplepack-item empty">
        <p><img src="https://unison.audio/wp-content/themes/unison-vrrb/images/sample-empty.jpg"></p>
        <div class="copy">
            <h4></h4>
            <h6></h6>
        </div>
    </div>
    <div class="samplepack-item empty">
        <p><img src="https://unison.audio/wp-content/themes/unison-vrrb/images/sample-empty.jpg"></p>
        <div class="copy">
            <h4></h4>
            <h6></h6>
        </div>
    </div>
</div>
<?php }

    $taxonomy = $_POST['taxonomy'];

    // WP Query
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 500,
        'orderby' => 'menu_order',
        'order' => 'asc',
        'relation' => 'AND',
        'tax_query' => array(
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
    if (!$taxonomy) {
        unset($args['cat']);
    }
    $query = new WP_Query($args);
    $i = 0;
    $cou = 0;
    $cau = 0;
    $output = '<div class="home-slide--wrap item-block " id="artist-slider">
      <div class="owl-carousel2">';
    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        if ($i == 0) {
            $output .= '<div class="home-slide--item"><div class="artist-list">';
        }
        $i++;
        $cou++;
        $cau++;
        $output .= '<div class="wobble artist-item ' . $i . '"><a class="l-ovl" href="' . get_the_permalink() . '"></a><p>' . get_the_post_thumbnail() . '</p><div class="copy"><h4>' . get_the_title() . '</h4><p>' . get_genres_by_id($post->ID) . '</p></div></div>';
        if ($i == 10) {
            $output .= '</div></div>';
            $i = 0;
        }
        $result = 'success';

    endwhile;
    else :
        $cou = 1;
        $ostatok = $cou % 10;
        $i = 0;
        while ($ostatok) {
            if ($i == 0) {
                $output .= '<div class="home-slide--item"><div class="artist-list">';
            }
            $i++;
            $output .= '<div class="samplepack-item empty">
                                                    <p><img src="' . get_bloginfo('template_url') . '/images/sample-empty.jpg"></p></div>';
            $ostatok--;
            if ($i == 10) {
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
    } else {
        $ostatok = 10 - $ostatok;
    }

    while ($ostatok) {
        $output .= '<div class="samplepack-item empty">
    <p><img src="' . get_bloginfo('template_url') . '/images/sample-empty.jpg"></p></div>';
        $ostatok--;
    } //ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js
    $output .= '</div></div></div>';
    if ($cau > 10) {
        $output .= '<span class="btn-prev btn-prev2"></span><span class="btn-next btn-next2 ' . $cau . '"></span></span>0';
    }

    $output .= '<a href="/artists/" class="btn">View all</a></div><script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script><script src="' . get_bloginfo('template_url') . '/js/libs/jquery-1.11.1.js"></script><script src="' . get_bloginfo('template_url') . '/libs/owlcarousel/owl.carousel.js"></script><script src="' . get_bloginfo('template_url') . '/js/modules/slider.js"></script>';
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

// // Midi- chord page mail campain list...

add_action('wp_ajax_activaCamp', 'activaCamp');
add_action('wp_ajax_nopriv_activaCamp', 'activaCamp');
function activaCamp(){
    $email = $_POST['sub_id'];
    $url = 'https://unisonaudio.api-us1.com';
    $params = array(
      'api_key' => 'eb2fe56e0e9a790cb32dba566dcdb88e6a8744ebcb9250dac170a32651e0cf4db85bfb09',
      'api_action' => 'contact_sync',
      'api_output' => 'serialize',
    );
    $post = array(
      'email' => $email,
      'p[19]' => 19,
      'status[19]' => 1,
    );

    // This section takes the input fields and converts them to the proper format
    $query = "";
    foreach ($params as $key => $value) {
      $query .= urlencode($key) . '=' . urlencode($value) . '&';
    }

    $query = rtrim($query, '& ');
    // This section takes the input data and converts it to the proper format
    $data = "";
    foreach ($post as $key => $value) {
      $data .= urlencode($key) . '=' . urlencode($value) . '&';
    }

    $data = rtrim($data, '& ');
    // clean up the url
    $url = rtrim($url, '/ ');
    if (!function_exists('curl_init')) {
      die('CURL not supported. (introduced in PHP 4.0.2)');
    }

    // If JSON is used, check if json_decode is present (PHP 5.2.0+)
    if ($params['api_output'] == 'json' && !function_exists('json_decode')) {
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
    $response = (string) curl_exec($request); // execute curl post and store curl_setopt
    curl_close($request); // close curl object
    $array = unserialize($response);
    if(!empty($array['subscriber_id']))
    {
        echo 'success';
    }
    else
    {
        echo 'failed';
    }
    /*if(!empty($array['subscriber_id']) || empty($array['subscriber_id']))
    {
        echo 'success';
    }*/
    die();
}


add_action('wp_ajax_filter_posts', 'ajax_filter_get_posts');
add_action('wp_ajax_nopriv_filter_posts', 'ajax_filter_get_posts');
add_action('woocommerce_after_shop_loop_item', 'my_print_stars');

function my_print_stars()
{
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

    if ($count > 0) {

        $average = number_format($rating / $count, 2);

        echo '<div class="starwrapper" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';

        echo '<span class="star-rating" title="' . sprintf(__('Rated %s out of 5', 'woocommerce'), $average) . '"><span style="width:' . ($average * 16) . 'px"><span itemprop="ratingValue" class="rating">' . $average . '</span> </span></span>';

        echo '</div>';
    }
}

function storefront_child_remove_phone($fields)
{
    unset($fields['billing_company']);
    unset($fields['billing_address_1']);
    unset($fields['billing_address_2']);
    unset($fields['billing_postcode']);
    return $fields;
}

add_filter('woocommerce_billing_fields', 'storefront_child_remove_phone');

// Hook in
add_filter('woocommerce_billing_fields', 'custom_override_billing_fields');

add_action('woocommerce_edit_account_form', 'my_woocommerce_edit_account_form');
add_action('woocommerce_save_account_details', 'my_woocommerce_save_account_details');

function my_woocommerce_edit_account_form()
{

    $user_id = get_current_user_id();
    $user = get_userdata($user_id);

    if (!$user) {
        return;
    }

    $phone = get_user_meta($user_id, 'phone', true);
    $country = get_user_meta($user_id, 'country', true);
    $citystate = get_user_meta($user_id, 'citystate', true);
    $payment = get_user_meta($user_id, 'payment_details', true);
    $url = $user->user_url;
    ?>
<label class="mb-3">Payment details:</label>
<textarea class="bg-transparent w-100 border-0" name="payment_details" id="payment_details"
    rows="3"><?php echo esc_attr($payment); ?></textarea>

<p class="woocommerce-FormRow woocommerce-FormRow--last form-row form-row-last">
    <input type="text" name="country" placeholder="Country" value="<?php echo esc_attr($country); ?>"
        class="input-text" />
</p>
<p class="woocommerce-FormRow woocommerce-FormRow--first form-row form-row-first">
    <input type="text" name="citystate" placeholder="City/State" value="<?php echo esc_attr($citystate); ?>"
        class="input-text" />
</p>
<p class="woocommerce-FormRow woocommerce-FormRow--last form-row form-row-last">
    <input type="text" name="phone" placeholder="Phone Number" value="<?php echo esc_attr($phone); ?>"
        class="input-text" />
</p>
</fieldset>


<?php

}

function my_woocommerce_save_account_details($user_id)
{

    update_user_meta($user_id, 'phone', htmlentities($_POST['phone']));
    update_user_meta($user_id, 'country', htmlentities($_POST['country']));
    update_user_meta($user_id, 'citystate', htmlentities($_POST['citystate']));
    update_user_meta($user_id, 'payment_details', htmlentities($_POST['payment_details']));

    $user = wp_update_user(array('ID' => $user_id, 'user_url' => esc_url($_POST['url'])));
}

// Ajax for Sample Packs
// Enqueue script
function ajax_filter_posts_scrip()
{
    // Enqueue script
    wp_register_script('afp_scripts', get_template_directory_uri() . '/ajax-filter.js', false, null, false);
    wp_enqueue_script('afp_scripts');

    wp_localize_script(
        'afp_scripts',
        'afp_vars',
        array(
            'afp_nonce' => wp_create_nonce('afp_nonce'), // Create nonce which we later will use to verify AJAX request
            'afp_ajax_url' => admin_url('admin-ajax.php'),
        )
    );
}

add_action('wp_enqueue_scripts', 'ajax_filter_posts_scrip', 100);

// Script for getting posts
function ajax_filter($taxonomy)
{

    // Verify nonce
    if (!isset($_POST['afp_nonce']) || !wp_verify_nonce($_POST['afp_nonce'], 'afp_nonce')) {
        die('Permission denied');
    }

    $taxonomy = $_POST['taxonomy'];
    $attribute = $_POST['attribute'];

    // Suburbs
    if (!empty($_POST['taxonomy'])) {
        $taxonomy = $_POST['taxonomy'];
    }

    // States
    if (!empty($_POST['attribute'])) {
        $attribute = $_POST['attribute'];
    }

    // Query arguments.

    if ($_POST['is_free'] == 1) {
        $argsa = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'meta_key' => '_price',
            'meta_value' => 0,
            'meta_compare' => '=',
            'orderby' => 'menu_order',
            'order' => 'asc',
        );
    } elseif ($_POST['is_free'] == 0) {
        $argsa = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'meta_key' => '_price',
            'meta_value' => 0,
            'meta_compare' => '!=',
            'orderby' => 'menu_order',
            'order' => 'asc',
        );
    }

    $taxquery = array();

    // if $state variable is selected.
    if (!empty($taxonomy)) {
        array_push($taxquery, array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $taxonomy,
        ));
    }

    // if $suburbs variable is selected.
    if (!empty($attribute) && $attribute != 'Genre') {
        array_push($taxquery, array(
            'taxonomy' => 'pa_genre',
            'field' => 'name',
            'terms' => $attribute,
        ));
    }

    // if $taxquery has array;
    if (!empty($taxquery)) {
        $argsa['tax_query'] = $taxquery;
    }

    if ($_POST['soundbank_page_id'] == 35) {
        $owl_class = '';
    } else {
        $owl_class = 'owl-carousel3';
        $is_home_page = 'true';
    }

    $query = new WP_Query($argsa);
    $output = '<div class="home-slide--wrap" id="samplepack-slider">
    <div class="' . $owl_class . '">';
    $i = 0;
    $countPack = 0;
    $cau = 0;
    global $product, $woocommerce_loop, $post;
    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        $cau++;
        $countPack++;
        if ($i == 0) {
            $output .= '<div class="home-slide--item">
                                                                                                        <div class="samplepack-list js-samplepack-list">';
        }
        $i++;
        $output .= '<div class="samplepack-item" >';
        $price = get_post_meta(get_the_ID(), '_regular_price', true);
        $_product = wc_get_product($post->ID);
        $sale_price = $_product->get_sale_price();
        if ($sale_price > 0) {
            $output .= '<div class="bubble">
                                                                                                       <div class="inside">
                                                                                                         <div class="inside-text">';
            $percentage = round((($price - $sale_price) / $price) * 100);
            $output .= sprintf(__('%s OFF', 'woocommerce'), $percentage . '%');
            $output .= '</div>
                                                                                                       </div>
                                                                                                      </div>';
        }
        $output .= '<p>';
        if ($_POST['is_free'] == 1) {
            $output .= '<a href="javascript:void(0)">';
        } else {
            $output .= '<a href="' . get_the_permalink() . '">';
        }
        if (has_post_thumbnail()) {
            $output .= ' ' . get_the_post_thumbnail(get_the_ID(), array(170, 170)) . ' ';
        } else {
            $output .= '<img src="' . get_bloginfo("template_url") . '/images/UnisonLogo.jpg" />';
        }
        $output .= '</a>';
        $output .= '</p>';
        $product_price = get_post_meta(get_the_ID(), '_price', true);
        //$output .= '<div class="copy"><h4><a class="js-title-samplepacks" href="'. get_the_permalink() . '">' . get_the_title() .'</a></h4><h6>Afreaux</h6>';
        if ($product_price == 0) {
            $output .= '<div class="copy"><h4><a class="js-title-samplepacks" href="javascript:void(0);">' . get_the_title() . '</a></h4>';
        } else {
            $output .= '<div class="copy"><h4><a class="js-title-samplepacks" href="' . get_the_permalink() . '">' . get_the_title() . '</a></h4>';
        }
        $price = get_post_meta(get_the_ID(), '_regular_price', true);
        $currency = get_woocommerce_currency_symbol();
        $currency_pos = get_option('woocommerce_currency_pos');
        if ($product_price == 0) {
            $output .= '<p class="js-price-text">';
            $output .= '<span class="price"><ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">FREE</span></ins></span>';
            $output .= '</p>';
        } else {
            $output .= '<p class="js-price-text">';
            if ($currency_pos == 'left' or $currency_pos == 'left_space') {
                if ($sale_price > 0) {
                    $output .= '<span class="price"><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">' . $currency . '</span>' . $price . '</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">' . $currency . '</span>' . $sale_price . '</span></ins></span>';
                } else {
                    $output .= '<span class="price"><ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">' . $currency . '</span>' . $price . '</span></ins></span>';
                }
            } else {
                if ($sale_price > 0) {
                    $output .= '<span class="price"><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">' . $price . '</span>' . $currency . '</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">' . $sale_price . '</span>' . $currency . '</span></ins></span>';
                } else {
                    $output .= '<span class="price"><ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">' . $price . '</span>' . $currency . '</span></ins></span>';
                }
            }
            $output .= '</p>';
        }
        $price = get_post_meta(get_the_ID(), '_regular_price', true);
        $product_price = get_post_meta(get_the_ID(), '_price', true);
        $downloads = get_post_meta(get_the_ID(), '_downloadable_files', true);
        $output .= '<div class="ctas cta">';
        $music = get_post_meta($post->ID, '_music', true);
        if ($product_price == 0) {
            $output .= '<a href="#" class="btn-free-play js-sound" data-file="' . $music . '" data-id="' . $post->ID . '"></a>';
            if (is_user_logged_in()) {
                $output .= do_shortcode('[download_now id="" text="Download"]');
            } else {
                $output .= '<a rel="nofollow" href="javascript:void(0)" data-product_title="' . get_the_title() . '" data-quantity="1" data-product_id="' . get_the_ID() . '" data-product_sku="" class="js-check-login btn-buy">Download</a>';
            }
        } elseif ($product_price > 0) {
            if ($post->ID != 1828) {
                $output .= '<a href="#" class="btn-play js-sound" data-file="' . $music . '" data-id="' . $post->ID . '"></a>';
            }
            $output .= '<a rel="nofollow" href="' . get_the_permalink() . '" data-product_title="' . get_the_title() . '" data-quantity="1" data-product_id="' . get_the_ID() . '" data-product_sku="" class="btn-buy ">Learn More</a>';
        }

        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        if ($i == 6) {
            $output .= '</div></div>';
            $i = 0;
        }

    endwhile;
        $ostPack = $countPack % 6;
        if ($ostPack == 0) {
            $ostPack = 0;
        } else {
            $ostPack = 6 - $ostPack;
        }

        $s = 0;
        while ($ostPack) {
            $output .= '<div class="samplepack-item empty-' . $s++ . ' empty">
    <p><img src="' . get_bloginfo('template_url') . '/images/sample-empty.jpg"></p>
    <div class="copy">
      <h4></h4>
      <h6></h6>
    </div>
  </div>';

            $ostPack--;
        }
    elseif (!$query->have_posts()) :
        $ostPack = $countPack % 6;

        $ostPack = 6 - $ostPack;

        $output .= '<div class="home-slide--item">
                                                        <div class="samplepack-list js-samplepack-list">';

        while ($ostPack) {
            $output .= '<div class="samplepack-item empty">
                                                    <p><img src="' . get_bloginfo('template_url') . '/images/sample-empty.jpg"></p>
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
    if ($cau > 6) {
        $output .= '<p class="max-width">
      <span class="btn-prev btn-prev3"></span>
      <span class="btn-next btn-next3"></span>
    </p>';
        if ($_POST['soundbank_page_id'] != 35) {
            $output .= '<a href="/soundbanks/" class="btn">View all</a></div></div>';
        }
    }

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

function my_woocommerce_add_error($error)
{
    if (strpos($error, 'required') !== false) {
        $error = 'Required';
    }
    if($error == 'The card was declined.'){
        $error = "The card was declined. Please enter correct card details .";
        if(isset($_SESSION['delete_hold_order'])){
            $order_id = $_SESSION['delete_hold_order'];
            $order = wc_get_order( $order_id );
            $items = $order->get_items();  
            $variation_id = '' ;
            foreach( $items as $item ) {
                $type = $item->get_type();
                $product_id = $item->get_product_id();
                $variation_id = $item->get_variation_id();
            }
            if($variation_id != ''){
                wp_delete_post($order_id,true);
                WC()->cart->add_to_cart($variation_id);
                unset($_SESSION['delete_hold_order']);
            }
        }
    }
    if(strpos($error,"No such source:") !== false){
        $error = $error." Please use correct card details .";
        if(isset($_SESSION['delete_hold_order'])){
            $order_id = $_SESSION['delete_hold_order'];
            $order = wc_get_order( $order_id );
            $items = $order->get_items();  
            $variation_id = '' ;
            foreach( $items as $item ) {
                $type = $item->get_type();
                $product_id = $item->get_product_id();
                $variation_id = $item->get_variation_id();
            }
            if($variation_id != ''){
                wp_delete_post($order_id,true);
                WC()->cart->add_to_cart($variation_id);
                unset($_SESSION['delete_hold_order']);
            }
        }
    }
    return $error;
}

add_filter('woocommerce_add_error', 'my_woocommerce_add_error');

// turn off pass char
function wc_ninja_remove_password_strength()
{
    if (wp_script_is('wc-password-strength-meter', 'enqueued')) {
        wp_dequeue_script('wc-password-strength-meter');
    }
}

add_action('wp_print_scripts', 'wc_ninja_remove_password_strength', 100);
// --------------

function redirect_login_page()
{
    $login_page = home_url('/login/');
    $page_viewed = basename($_SERVER['REQUEST_URI']);

    if ($page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($login_page);
        exit;
    }
}

//add_action('init', 'redirect_login_page');

function login_failed()
{
    $login_page = home_url('/my-account/');
    wp_redirect($login_page . '?login=failed');
    exit;
}
add_action('wp_login_failed', 'login_failed');

// function auto_login_new_user( $user_id ) {
//     wp_set_current_user($user_id);
//     wp_set_auth_cookie($user_id);
//     $user = get_user_by( 'id', $user_id );
//     do_action( 'wp_login', $user->user_login ); 
//     wp_redirect( home_url() ); // You can change home_url() to the specific URL,such as "wp_redirect( 'http://www.wpcoke.com' )";
//     exit;
// }
// add_action( 'user_register', 'auto_login_new_user' );

/*function unison_login_redirect( $url, $request, $user ) {
    if ( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
        if ( $user->has_cap( 'administrator' ) ) {
            $url = admin_url();
        } else {
            $url = home_url( '/my-account' );
        }
    }
    return $url;
}
 
add_filter( 'login_redirect', 'unison_login_redirect', 10, 3 );*/

/*function verify_username_password($user, $email, $password) {
$login_page = home_url('/login/');
if (sanitize_email($email) == "" || $password == "") {
wp_redirect($login_page . "?login=empty");
exit;
}
}
add_filter('authenticate', 'verify_username_password', 1, 3);*/

/**
 * Returns genres concatenation by artist id
 *
 * @param $id
 *
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
 *
 * @return bool true on success and false on failure
 */
/*function sib_trigger($data)
{

    if (!isset($data['headers'])) {
        $data['headers'] = [];
    }

    $data['headers']['X-Mailin-tag'] = 'WP Unison Audio';

    if (isset($data['attr'])) {
        $data['attr']['SITE_URL'] = home_url();
    }

    $mailin = new SIB_API_Manager();
    $res = $mailin->send_email($data);
    return (!empty($res) && $res['code'] == 'success') ? true : false;
}*/

/**
 * Send  SendinBlue trigger email
 *
 * @param $data
 * @return bool true on success and false on failure
 */
function sib_trigger($data) {
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

function searchfilter($query)
{

    if ($query->is_search && !is_admin()) {
        $query->set('post_type', array('product'));
    }

    return $query;
}

add_filter('pre_get_posts', 'searchfilter');

// add_action( 'wp_enqueue_scripts', 'so_load_script', 20 );
// function so_load_script(){

//     wp_enqueue_script( 'so_test', get_template_directory_uri().'/js/ajax_trigger.js' );

//     $i18n = array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'checkout_url' => get_permalink( wc_get_page_id( 'checkout' ) ) );
//     wp_localize_script( 'so_test', 'so_test_ajax', $i18n );
// }

// I took get_product_by_sku function in stackoverflow but I don't remember which question.
function get_product_by_sku($sku)
{

    global $wpdb;

    $product_id = $wpdb->get_var($wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $sku));

    if ($product_id) {
        return new WC_Product($product_id);
    }

    return null;
}

add_action('wp_ajax_myajax', 'myajax_callback');
add_action('wp_ajax_nopriv_myajax', 'myajax_callback');

/**
 * AJAX add to cart.
 */
function myajax_callback()
{

    ob_start();
    global $woocommerce, $post, $wpdb;
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . ('/wp-config.php');
    $product_id = $_REQUEST['id_p'];
    $product_title = $_REQUEST['title_p'];
    $quantity = 1;
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);
    $customer_orders = get_posts(array(
        'numberposts' => -1,
        'meta_key' => '_customer_user',
        'meta_value' => get_current_user_id(),
        'post_type' => wc_get_order_types(),
        'post_status' => array_keys(wc_get_order_statuses()),
    ));
    $productIds = array();
    foreach ($customer_orders as $customer_order) {
        $customer_order_ID = $customer_order->ID;
        $customers_orders = wc_get_order($customer_order_ID);

        foreach ($customers_orders->get_items() as $item_key => $item_values) :
            $item_data = $item_values->get_data();
            $item_id = $item_data['product_id'];
            $productIds[] = $item_id;
        endforeach;
    }
    if (in_array($product_id, $productIds)) {
        $data = array(
            'error' => "completed",
        );
        wp_send_json($data);
    }

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity) && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
        wc_add_to_cart_message($product_id);
        $data = array(
            'error' => false,
        );
        wp_send_json($data);
    } else {
        // If there was an error adding to the cart, redirect to the product page to show any errors
        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id),
        );
        wp_send_json($data);
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

function ajax_check_user_logged_in()
{
    echo is_user_logged_in() ? 'yes' : 'no';
    die();
}

add_action('wp_ajax_is_user_logged_in', 'ajax_check_user_logged_in');
add_action('wp_ajax_nopriv_is_user_logged_in', 'ajax_check_user_logged_in');

add_filter('woocommerce_get_price_html', 'changeFreePriceNotice', 10, 2);

function changeFreePriceNotice($price, $product)
{
    error_log($price);
    if ($price == wc_price(0.00)) {
        return 'FREE';
    } else {
        return $price;
    }
}



add_action('wp_ajax_homesubscription', 'homesubscriptionform');
add_action('wp_ajax_nopriv_homesubscription', 'homesubscriptionform');

/**
 * AJAX add to cart.
 */
function homesubscriptionform()
{
    global $lastname;
    ob_start();
    $fname = explode(" ", $_REQUEST['first_name']);
    $lastname = '';
    for ($i = 1; $i <= count($fname); $i++) {
        $lastname .= $fname[$i] . ' ';
    }

    $email = $_REQUEST['email'];
    $url = 'https://unisonaudio.api-us1.com';
    $params = array(
        'api_key' => 'eb2fe56e0e9a790cb32dba566dcdb88e6a8744ebcb9250dac170a32651e0cf4db85bfb09',
        'api_action' => 'contact_add',
        'api_output' => 'serialize',
    );
    $post = array(
        'email' => $email,
        'first_name' => $fname[0],
        'last_name' => $lastname,
        'p[3]' => 3,
        'status[3]' => 1,
        'instantresponders[123]' => 0, // set to 0 to if you don't want to sent instant autoresponders
    );

    // This section takes the input fields and converts them to the proper format
    $query = "";
    foreach ($params as $key => $value) {
        $query .= urlencode($key) . '=' . urlencode($value) . '&';
    }

    $query = rtrim($query, '& ');
    // This section takes the input data and converts it to the proper format
    $data = "";
    foreach ($post as $key => $value) {
        $data .= urlencode($key) . '=' . urlencode($value) . '&';
    }

    $data = rtrim($data, '& ');
    // clean up the url
    $url = rtrim($url, '/ ');
    if (!function_exists('curl_init')) {
        die('CURL not supported. (introduced in PHP 4.0.2)');
    }

    // If JSON is used, check if json_decode is present (PHP 5.2.0+)
    if ($params['api_output'] == 'json' && !function_exists('json_decode')) {
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
    if (!$response) {
        die('Nothing was returned. Do you have a connection to Email Marketing server?');
    }
    $result = unserialize($response);
    if ($result['result_code'] == 1) {
        $data = array(
            'error' => false,
            'message' => 'You have successfully joined the Unison newsletter.',
        );
        wp_send_json($data);
    } else if ($result->result_code == 0) {
        $data = array(
            'error' => true,
            'message' => $result['result_message'],
        );
        wp_send_json($data);
    }
}

add_filter('woocommerce_order_button_text', 'woo_custom_order_button_text');
function woo_custom_order_button_text()
{
    return __('CHECKOUT', 'woocommerce');
}

// define the woocommerce_save_account_details callback
// function action_woocommerce_save_account_details($user_id)
// {
//     $user_info = get_userdata($user_id);
//     $user_email = $user_info->user_email;
// //    update_user_meta($user_id, 'billing_email', $user_email);
//     $first_name = get_user_meta($user_id, 'first_name', true);
//     $exists = email_exists($user_email);

//     if (!empty($_POST['account_email']) && $_POST['old_email'] != $_POST['account_email']) {
//         wp_update_user(array('ID' => $user_id, 'user_login' => $_POST['account_email']));
//         //        sib_trigger(array(
//         //            'id' => 8,
//         //            'to' => $user_email,
//         //            'attr' => array(
//         //                'EMAIL' => $user_email,
//         //                'FIRSTNAME' => $first_name,
//         //            ),
//         //        ));
//     }
// }

// add_action('woocommerce_save_account_details', 'action_woocommerce_save_account_details', 10, 1);

function _remove_script_version($src)
{
    // Remove query strings from static resources
    $parts = explode('?ver', $src);
    return $parts[0];
}

add_filter('script_loader_src', '_remove_script_version', 15, 1);
add_filter('style_loader_src', '_remove_script_version', 15, 1);
function crunchify_disable_comment_url($fields)
{
    unset($fields['url']);
    return $fields;
}

add_filter('comment_form_default_fields', 'crunchify_disable_comment_url');

function get_unison_reply_link($args = array(), $comment = null, $post = null)
{
    $defaults = array(
        'add_below' => 'comment',
        'respond_id' => 'respond',
        'reply_text' => __('Reply'),
        /* translators: Comment reply button text. 1: Comment author name */
        'reply_to_text' => __('Reply to %s'),
        'login_text' => __('Log in to Reply'),
        'max_depth' => 0,
        'depth' => 0,
        'before' => '',
        'after' => '',
    );

    $args = wp_parse_args($args, $defaults);

    if (0 == $args['depth'] || $args['max_depth'] <= $args['depth']) {
        return;
    }

    $comment = get_comment($comment);

    if (empty($post)) {
        $post = $comment->comment_post_ID;
    }

    $post = get_post($post);

    if (!comments_open($post->ID)) {
        return false;
    }

    /**
     * Filters the comment reply link arguments.
     *
     * @param array $args Comment reply link arguments. See get_comment_reply_link()
     *                            for more information on accepted arguments.
     * @param WP_Comment $comment The object of the comment being replied to.
     * @param WP_Post $post The WP_Post object.
     *
     * @since 4.1.0
     *
     */
    $args = apply_filters('comment_reply_link_args', $args, $comment, $post);

    if (get_option('comment_registration') && !is_user_logged_in()) {
        $link = sprintf(
            '<a rel="nofollow" class="js-check-login comment-reply-login" href="%s">%s</a>',
            esc_url(wp_login_url(get_permalink())),
            $args['login_text']
        );
    } else {
        $onclick = sprintf(
            'return addComment.moveForm( "%1$s-%2$s", "%2$s", "%3$s", "%4$s" )',
            $args['add_below'],
            $comment->comment_ID,
            $args['respond_id'],
            $post->ID
        );

        $link = sprintf(
            "<a rel='nofollow' class='comment-reply-link' href='%s' onclick='%s' aria-label='%s'>%s</a>",
            esc_url(add_query_arg('replytocom', $comment->comment_ID, get_permalink($post->ID))) . "#" . $args['respond_id'],
            $onclick,
            esc_attr(sprintf($args['reply_to_text'], $comment->comment_author)),
            $args['reply_text']
        );
    }

    /**
     * Filters the comment reply link.
     *
     * @param string $link The HTML markup for the comment reply link.
     * @param array $args An array of arguments overriding the defaults.
     * @param object $comment The object of the comment being replied.
     * @param WP_Post $post The WP_Post object.
     *
     * @since 2.7.0
     *
     */
    return apply_filters('comment_reply_link', $args['before'] . $link . $args['after'], $args, $comment, $post);
}

function unison_comment($comment, $args, $depth)
{
    if ('div' === $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    } ?>
<<?php echo $tag;
    comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID() ?>"><?php
    if ('div' != $args['style']) { ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
    } ?>
        <div class="comment-author vcard"><?php
    if ($args['avatar_size'] != 0) {
        echo get_avatar($comment, $args['avatar_size']);
    }
    printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()); ?>
        </div><?php
    if ($comment->comment_approved == '0') {
        ?>
        <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.'); ?></em><br /><?php
    } ?>
        <div class="comment-meta commentmetadata">
            <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>"><?php
            /* translators: 1: date, 2: time */
            printf(
                __('%1$s at %2$s'),
                get_comment_date(),
                get_comment_time()
            ); ?>
            </a><?php
        edit_comment_link(__('(Edit)'), '  ', ''); ?>
        </div>

        <?php comment_text(); ?>

        <div class="reply"><?php
    echo get_unison_reply_link(
        array_merge(
            $args,
            array(
                'add_below' => $add_below,
                'depth' => $depth,
                'max_depth' => $args['max_depth'],
            )
        )
    ); ?>
        </div><?php
    if ('div' != $args['style']) : ?>
    </div><?php
    endif;
}

function wpdocs_custom_excerpt_length($length)
{
    return 27;
}

add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);

function empty_wc_add_to_cart_message($message, $product_id)
{
    return '';
}

;

add_filter('wc_add_to_cart_message', 'empty_wc_add_to_cart_message', 10, 2);

// define the woocommerce_pay_order_button_html callback
function filter_woocommerce_pay_order_button_html($input_type_submit_class_button_alt_id_place_order_value_esc_attr_order_button_text_data_value_esc_attr_order_button_text)
{
    $input_type_submit_class_button_alt_id_place_order_value_esc_attr_order_button_text_data_value_esc_attr_order_button_text = "Proceed To Payment";
    return $input_type_submit_class_button_alt_id_place_order_value_esc_attr_order_button_text_data_value_esc_attr_order_button_text;
}

;

// add the filter
add_filter('woocommerce_pay_order_button_html', 'filter_woocommerce_pay_order_button_html', 999, 1);

// add the filter
add_filter('woocommerce_pay_order_button_html', 'filter_woocommerce_pay_order_button_html', 999, 1);

function getLastPathSegment($url)
{
    $path = parse_url($url, PHP_URL_PATH); // to get the path from a whole URL
    $pathTrimmed = trim($path, '/'); // normalise with no leading or trailing slash
    $pathTokens = explode('/', $pathTrimmed); // get segments delimited by a slash

    if (substr($path, -1) !== '/') {
        array_pop($pathTokens);
    }
    return end($pathTokens); // get the last segment
}

add_shortcode('add_to_cart_btn', 'addToCartBtn');
function addToCartBtn()
{
    global $product, $post;
    ob_start(); ?>
    <form class="cart" method="post" enctype='multipart/form-data'>
        <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($post->ID); ?>" />
        <button type="submit" class="test-button add_cart_btn btn-buy"><?php echo esc_html('Add TO Cart'); ?></button>
        <?php //do_action( 'woocommerce_after_add_to_cart_button' );
        ?>
    </form>
    <?php
    return ob_get_clean();
}

// define the woocommerce_add_to_cart callback
function action_woocommerce_add_to_cart($cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data)
{
    global $post, $woocommerce;
    $Path = $_SERVER['REQUEST_URI'];

    $last_element = explode('/', $Path);

    $the_slug = $last_element[2];
    $args = array(
        'name' => $the_slug,
        'post_type' => 'product',
        'post_status' => 'publish',
        'numberposts' => 1,
    );
    $my_posts = get_posts($args);
    if ($my_posts) :
        $current_page_id = $my_posts[0]->ID;
    endif;
    $product = new WC_Product($product_id);
    $upsells = $product->get_upsell_ids();
    if (!$upsells && $current_page_id != $product->id) {
        wp_redirect(site_url() . '/cart');
    } else if ($upsells && $current_page_id == $product->id) {

        $meta_query = WC()->query->get_meta_query();
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 1,
            'post__in' => $upsells,
            'post__not_in' => array($product->id),
            'meta_query' => $meta_query,
        );

        $products = new WP_Query($args);
        if ($products->have_posts()) : ?>
   
    <div class="modal-upsell pb-0 mb-0" id="modal-upsell">
        <?php while ($products->have_posts()) : $products->the_post();

                    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                        if ($cart_item['product_id'] == get_the_ID()) {
                            WC()->cart->remove_cart_item($cart_item_key);
                        }
                    }
                    $price = get_post_meta(get_the_ID(), '_regular_price', true);
                    $sale = get_post_meta(get_the_ID(), '_sale_price', true); ?>
        <div class="modal-upsell-container artist-detail" style="margin: auto !important">
            <img class="img-fluid pointer close" src="<?php bloginfo('template_url') ?>/assets/images/close-icon.png"
                id='modal-upsell-close'>
            <div class="title">
                <h5 class="text-center text-white">Producers who bought this item also bought
                    "<?php echo get_the_title(); ?>"</h5>
            </div>
            <div
                class="row col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-xs-12 col-sm-12 mx-auto p-0 mb-0 align-items-top justify-content-between content">
                <div
                    class="col-xxxl-6  col-xxl-6 col-xl-6 col-lg-6  pl-0 pr-0 text-xs-center text-md-center text-sm-center text-lg-right p-0 pr-lg-4 border-right">
                    <?php the_post_thumbnail('medium', ['class' => 'img-fluid align-middle img-tier thumb']); ?>
                </div>
                <div
                    class="col-xxxl-6  col-xxl-6 col-xl-6 col-lg-6  col-md-12 col-xs-12 col-sm-12 mb-0 p-0 pl-lg-4 mx-auto samplepack-item ">
                    <h5 class=" text-left pl-0 title-big js-title-samplepacks"><?php echo get_the_title(); ?>
                    </h5>
                    <p class="text-left green-text">
                        <?php if ($price) { ?>
                        <span class="price-upsell"><?php echo '$' . $price; ?> </span>
                        <span class="price-upsell js-product-price d-none"><?php echo $price; ?> </span>
                        <?php }
                                    if ($sale) {
                                        ?>
                        <span class="sale  js-product-sale-price"><?php echo $sale; ?> </span>
                        <?php } ?>
                    </p>
                    <?php $music = get_post_meta(get_the_ID(), '_music', true); ?>
                    <div class="col-12 text-left row align-items-center p-0 m-0">
                        <div
                            class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 p-0 m-0 title-player player-display-none">
                            <?php global $product, $post;
                            $music = get_post_meta($post->ID, '_music', true);
                            echo '<div class="play-border-upsell"><div class="play-inner text-left p-0"><div class="single_product_play"><div class="play_single_audio"><a href="546" class="btn-play btn-play-upsell js-sound" data-file="' . $music . '" data-id="' . $post->ID . '"></a></div></div><span class="play-text position-unset text-white" style="display: inline-block;vertical-align: middle;">Play Demo</span></div></div>';
                            ?>
                        </div>

                        <div class="text-center text-sm-left col-xxxl-12  col-xxl-12  col-md-12 col-xs-12 col-sm-12 p-0 border-top-new"
                            id="close-button-upgrade">
                            <a onclick="openCartDrawer('<?php echo get_the_ID(); ?>','upsell')"
                                class="badge  badge-success btn-upsell" id="upsell-add-to-cart">YES, ADD TO MY ORDER</a>
                        </div>
                        <div class="text-center text-sm-left col-xxxl-12  col-xxl-12  col-md-12 col-xs-12 col-sm-12 p-0"
                            id="close-button-upgrade">
                            <a href="javascript:void(0);" onclick="closeOverlay()" class="badge  badge-success btn-upsell-grey">No, thanks</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; // end of the loop. ?>
    </div>

    <?php endif;
        wp_reset_postdata();
    } else {
        wp_redirect(site_url() . '/cart');
    }
}

// add the action
//add_action('woocommerce_add_to_cart', 'action_woocommerce_add_to_cart', 10, 6);

// define the woocommerce_add_to_cart_validation callback
function filter_woocommerce_add_to_cart_validation($true, $product_id, $quantity)
{
    // make filter magic happen here...
    if ($true == 1) {
        return $true;
    } else {
        wp_redirect(site_url() . '/cart');
    }
}

;

// add the filter
add_filter('woocommerce_add_to_cart_validation', 'filter_woocommerce_add_to_cart_validation', 10, 3);

add_filter('send_password_change_email', '__return_false');
/*
* Filter for the tab of UAP
*/
add_filter('woocommerce_account_menu_items', 'misha_remove_my_account_links');
function misha_remove_my_account_links($menu_links)
{
    if (current_user_can('editor') || current_user_can('administrator')) {
        $menu_links['uap'] = 'Artist Dashboard';
        //unset($menu_links['downloads']);
    } else {
        unset($menu_links['uap']); // Addresses
    }
    return $menu_links;
}

//hide the sales report for the support
function woo_support_remove_items()
{
    $remove = array('wc-reports');
    foreach ($remove as $submenu_slug) {
        $current_user = wp_get_current_user();
        $support_user = $current_user->user_login;
        $support_email = $current_user->user_email;
        if ($support_user == 'support' && $support_email == 'support@unison.audio') {
            remove_submenu_page('woocommerce', $submenu_slug);
        }
    }


    if ( get_current_user_id()!=1 ) {

        //Hide "WooCommerce → Home".
        remove_submenu_page('woocommerce', 'wc-admin');

        //Hide "WooCommerce → Reports".
        remove_submenu_page('woocommerce', 'wc-reports');    

        //Hide "Analytics".
        remove_menu_page('wc-admin&path=/analytics/overview');
        //Hide "Analytics → Overview".
        remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/overview');
        //Hide "Analytics → Products".
        remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/products');
        //Hide "Analytics → Revenue".
        remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/revenue');
        //Hide "Analytics → Orders".
        remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/orders');
        //Hide "Analytics → Variations".
        remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/variations');
        //Hide "Analytics → Categories".
        remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/categories');
        //Hide "Analytics → Coupons".
        remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/coupons');
        //Hide "Analytics → Taxes".
        remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/taxes');
        //Hide "Analytics → Downloads".
        remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/downloads');
        //Hide "Analytics → Stock".
        remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/stock');
        //Hide "Analytics → Settings".
        remove_submenu_page('wc-admin&path=/analytics/overview', 'wc-admin&path=/analytics/settings');
    }


}

add_action('admin_menu', 'woo_support_remove_items', 99, 0);


//ajax custome login authenticate
function cs_ajax_check_user_loggein_details_true()
{
    global $wpdb;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $redirect_to = $_POST['loginRedirect'];
    $checked = $_POST['check'];
	$is_true_login = wp_authenticate($username, $password);
		if(!is_wp_error($is_true_login)) {
        $user_id = $is_true_login->data->ID;
        //$user_id1 = username_exists($username);
        if ($user_id) {
            $userdata = get_userdata($user_id);
            wp_set_auth_cookie($user_id);
            $subscriptions = wcs_get_users_subscriptions( $user_id );
            //$user_all_sub = wcs_get_subscriptions($user_id);
            //print_r($subscriptions);
            if( !empty($subscriptions) ){ 
                echo 'damntrue';
            }
            else{
                //do_action('wp_login',$userdata->ID);
                echo "nosubscription";
            }
            
        } else {
            echo "false";
        }
    } else {
        echo "false";
    }
    die();
}

add_action('wp_ajax_cs_login_details_true', 'cs_ajax_check_user_loggein_details_true');
add_action('wp_ajax_nopriv_cs_login_details_true', 'cs_ajax_check_user_loggein_details_true');

//Product page upsell product add to cart and redirect to cart page
add_filter('woocommerce_add_to_cart_redirect', 'rv_redirect_on_add_to_cart');
function rv_redirect_on_add_to_cart()
{
    global $post, $woocommerce, $wpdb;
    $Path = $_SERVER['REQUEST_URI'];
    $last_element = explode('/', $Path);

    $the_slug = $last_element[2];
    $args = array(
        'name' => $the_slug,
        'post_type' => 'product',
        'post_status' => 'publish',
        'numberposts' => 1,
    );
    $my_posts = get_posts($args);
    if ($my_posts) :
        $current_page_id = $my_posts[0]->ID;
    endif;
    if (isset($_POST['add-to-cart'])) {
        
        $product_id = (int)apply_filters('woocommerce_add_to_cart_product_id', $_POST['add-to-cart']);
        if ($current_page_id != $product_id) {
            if(strpos($Path,'switch-subscription') !== false){
                $url_sub = substr($Path, 0, strpos($Path, "?switch-subscription"));
                $user_id = get_current_user_id();
                $data_query = 'SELECT * from wp_woocommerce_payment_tokens where user_id='.$user_id.' AND is_default=1';
                $result = $wpdb->get_results($data_query);
                if(count($result) > 0){
                    // return site_url() . $url_sub.'?switch_subscription=true';
                }else{
                    return site_url() . '/cart';
                }                
            }else{
                return site_url() . '/cart';
            }
        }
    }
}


// function ajax add to cart drawer action
add_action('wp_ajax_my_cs_remove_cart_product_drawer_action', 'my_cs_remove_cart_product_drawer_action');
add_action('wp_ajax_nopriv_my_cs_remove_cart_product_drawer_action', 'my_cs_remove_cart_product_drawer_action');
function my_cs_remove_cart_product_drawer_action()
{
    global $wpdb;
    if (!empty($_POST['product_id'])) {
        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            if ($cart_item['product_id'] == $_POST['product_id']) {
                WC()->cart->remove_cart_item($cart_item_key);
            }
        }
    }
    get_cs_cart_drawer_items();

    wp_die();
}

// function ajax add to cart drawer action
add_action('wp_ajax_my_cs_add_to_cart_drawer_action', 'my_cs_add_to_cart_drawer_action');
add_action('wp_ajax_nopriv_my_cs_add_to_cart_drawer_action', 'my_cs_add_to_cart_drawer_action');

function my_cs_add_to_cart_drawer_action()
{
    global $wpdb;
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        if ($cart_item['product_id'] == $_POST['product_id']) {
            WC()->cart->remove_cart_item($cart_item_key);
        }
    }

    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = 1;
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id);
    $product_status = get_post_status($product_id);

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

        do_action('woocommerce_ajax_added_to_cart', $variation_id);

        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($variation_id => $quantity), true);
        }

        //WC_AJAX :: get_refreshed_fragments();
        get_cs_cart_drawer_items();
    } else {

        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
        );

        echo wp_send_json($data);
    }

    wp_die();
}

add_action('wp_ajax_get_cs_cart_drawer_items', 'get_cs_cart_drawer_items');
add_action('wp_ajax_nopriv_get_cs_cart_drawer_items', 'get_cs_cart_drawer_items');

function get_cs_cart_drawer_items()
{
    if (!WC()->cart->is_empty()) {
        ?>
    <div class="cart_drawer_table_contets">
        <table class="shop_table shop_table_responsive cart" cellspacing="0">
            <tbody>
                <?php do_action('woocommerce_before_cart_contents'); ?>

                <?php
                foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                        $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                        ?>
                <tr
                    class="<?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">


                    <div class="px-3 pt-2">
                        <div class="d-flex flex-row p-3 border-bottom-new">
                            <div class="product-thumbnail" style="padding: 0px;">
                                <?php
                                        $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                        if (!$product_permalink) {
                                            echo $thumbnail;
                                        } else {
                                            printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail);
                                        }
                                        ?>
                            </div>

                            <div data-title="<?php _e('Product', 'woocommerce'); ?>" style="width: 100%;">
                                <div class="copy d-flex flex-column h-100 justify-content-center" style="width: 90%; margin: 0 auto;">

                                    <!-- <h5 class="pb-2">
                                            </h5> -->
                                    <?php
                                            if (!$product_permalink) {
                                                echo apply_filters('woocommerce_cart_item_name', sprintf('<h5 class="cart-item-text">%s</h5>', $_product->get_title()), $cart_item, $cart_item_key) . '&nbsp;';
                                            } else {
                                                echo apply_filters('woocommerce_cart_item_name', sprintf('<h5 class="cart-item-text">%s</h5>', $_product->get_title()), $cart_item, $cart_item_key);
                                            }
                                            ?>

                                    <h6 class="price-cart">
                                        <?php
                                                echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                                                ?>
                                    </h6>

                                    <!-- <p>
                                                <?php
                                                // Meta data
                                                // echo WC()->cart->get_item_data($cart_item);

                                                // Backorder notification
                                                // if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                                //     echo '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>';
                                                // }
                                                // ?>
                                            </p> -->
                                </div>

                            </div>

                            <div class="product-price" data-title="<?php _e('Price', 'woocommerce'); ?>">
                                <?php
                                        echo '<a href="javascript:void(0)" onclick="removeCartDrawerProduct(' . $product_id . ')" class="cs_remove_drawer_product" title="Remove item"><img style="height: 8px; width: 8px;" src="' . get_bloginfo('template_url') . '/assets/images/x.png" /></a>';
                                        ?>
                            </div>
                        </div>

                    </div>
                </tr>
                <?php
                    }
                }

                do_action('woocommerce_cart_contents');
                ?>
                <?php do_action('woocommerce_after_cart_contents'); ?>
            </tbody>
        </table>
    </div>
    <?php if (!WC()->cart->is_empty()) : ?>
    <div class="cs_drawer_footer_section">
        <h6 class="total text-center pb-3" style="color: #606060; font-size: 16px;">
            <strong><?php _e('Subtotal', 'woocommerce'); ?>
                :</strong> <?php echo WC()->cart->get_cart_subtotal(); ?>
        </h6>

        <?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>

        <p class="cs_drawer_checkout">
            <a href="<?php echo esc_url(wc_get_cart_url()); ?>"
                class="button wc-forward d-flex button-green-glow mx-auto" style="padding-left: 10px;">
                <span>
                    <?php _e('Go To Checkout', 'woocommerce'); ?>
                </span>
                <span>
                    <img class="img-fluid" style="height: 10px; padding-left: 1rem;"
                        src="<?php bloginfo('template_url') ?>/assets/images/forward-icon.png" />
                </span>
            </a>
        </p>
        <p class="cs_drawer_keepshopping">
            <a href="javascript:void(0)"
                class="cs_button_keep_shopping cs_drawer_menu_close"><?php _e('KEEP SHOPPING', 'woocommerce'); ?></a>
        </p>
    </div>   
    <?php endif;
    } else {
        echo '<p class="cs_drawer_empty p-5">Add Products To Your Cart</p>';
    }?>
    <script type="text/javascript">
        jQuery('span#cart-counts').text('<?php echo WC()->cart->get_cart_contents_count(); ?>');
    </script>
    <?php
    exit;
}


// function ajax add to cart get upsell product action
add_action('wp_ajax_my_cs_get_product_upsell_action', 'my_cs_get_product_upsell_action');
add_action('wp_ajax_nopriv_my_cs_get_product_upsell_action', 'my_cs_get_product_upsell_action');
function my_cs_get_product_upsell_action()
{
    global $wpdb;
    if (!empty($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        $product = new WC_Product($product_id);
        $upsells = $product->get_upsells();
        if (!empty($upsells)) {
            $meta_query = WC()->query->get_meta_query();
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 1,
                'post__in' => $upsells,
                'post__not_in' => array($product->id),
                'meta_query' => $meta_query,
            );

            $products = new WP_Query($args);
            if ($products->have_posts()) : ?>
            
    <div class="modal-upsell pb-0 mb-0" id="modal-upsell">
        <?php while ($products->have_posts()) : $products->the_post();

                        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                            if ($cart_item['product_id'] == get_the_ID()) {
                                WC()->cart->remove_cart_item($cart_item_key);
                            }
                        }
                        $price = get_post_meta(get_the_ID(), '_regular_price', true);
                        $sale = get_post_meta(get_the_ID(), '_sale_price', true); ?>
        <div class="modal-upsell-container artist-detail popup-wrap" style="margin: auto !important">
            <img class="img-fluid pointer close" src="<?php bloginfo('template_url') ?>/assets/images/close-icon.png"
                id='modal-upsell-close'>
            <div class="title">
                <h5 class="text-center text-white">Producers who bought this item also bought
                    "<?php echo get_the_title(); ?>"</h5>
            </div>
            <div
                class="row col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-xs-12 col-sm-12 mx-auto p-0 mb-0 align-items-top justify-content-between content text-center">
                <div
                    class="col-xxxl-6  col-xxl-6 col-xl-6 col-6  pl-0 pr-0 text-xs-center text-md-center text-sm-center text-lg-right p-0  pr-lg-4 border-right post-img">
                    <?php the_post_thumbnail('medium', ['class' => 'img-fluid align-middle img-tier thumb']); ?>
                </div>
                <div class="col-xxxl-6  col-xxl-6 col-xl-6 col-lg-6 col-6 mb-0  p-0 pl-lg-4 mx-auto samplepack-item ">
                    <h5 class=" text-left pl-0 title-big js-title-samplepacks"><?php echo get_the_title(); ?></span>
                    </h5>
                    <p class="text-left green-text">

                        <?php if ($sale) { 
                            if ($price) {
                                                ?>
                            <span class="price-upsell price-warning"><s><?php echo '$' . $price; ?></s> </span>
                            <?php } ?>
                            <span class="sale js-product-sale-price text-white font-weight-bold"><?php echo '$' . $sale; ?> </span>
                            <?php }else{
                            if ($price) { ?>
                                <span class="price-upsell"><?php echo '$' . $price; ?> </span>
                                <?php }
                            }

                            ?>
                            <!-- /*25-10-2021*/ -->
                            <span class="price-upsell js-product-price d-none"><?php echo $price; ?> </span>
                            <!-- /*25-10-2021*/ -->                               
                    </p>
                    <?php $music = get_post_meta(get_the_ID(), '_music', true); ?>
                    <div class="col-12 text-left row align-items-center p-0 m-0">
                        <div
                            class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 p-0 m-0 title-player player-display-none">
                            <?php global $product, $post;
                                $music = get_post_meta($post->ID, '_music', true);
                                echo '<div class="play-border-upsell"><div class="play-inner  text-left p-0"><div class="single_product_play"><div class="play_single_audio"><a href="546" class="btn-play btn-play-upsell js-sound" data-file="' . $music . '" data-id="' . $post->ID . '"></a></div></div><span class="play-text position-unset text-white" style="display: inline-block;vertical-align: middle;">Play Demo</span></div></div>';
                            ?>
                        </div>
                        <?php if(!wp_is_mobile()){ ?>
                          <div class="desktop-btns w-100">
                            <div class="text-left col-xxxl-12  col-xxl-12  col-md-12 col-xs-12 col-sm-12 p-0 border-top-new"
                                id="close-button-upgrade">
                                <a onclick="openCartDrawer('<?php echo get_the_ID(); ?>','upsell')"
                                    class="badge  badge-success btn-upsell cs_trigger_hide_popup"
                                    id="upsell-add-to-cart">YES, ADD TO MY ORDER</a>
                            </div>
                            <div class="text-left col-xxxl-12 col-xxl-12 col-md-12 col-xs-12 col-sm-12 p-0"
                                id="close-button-upgrade">
                                <a href="javascript:void(0);" class="badge badge-success btn-upsell-grey goToCheckout"
                                    id="upsell-no-thanks">No, thanks</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                    <?php if(wp_is_mobile()){ ?>
                     <div class="d-none tablet-btns">
                        <div class="text-left col-xxxl-12 col-xxl-12 col-md-12 col-xs-12 col-sm-12 p-0 border-top-new"
                                id="close-button-upgrade">
                            <a onclick="openCartDrawer('<?php echo get_the_ID(); ?>','upsell')"
                                    class="badge  badge-success btn-upsell cs_trigger_hide_popup"
                                    id="upsell-add-to-cart">YES, ADD TO MY ORDER</a>
                        </div>
                        <div class="text-left col-xxxl-12 col-xxl-12 col-md-12 col-xs-12 col-sm-12 p-0"
                            id="close-button-upgrade">
                            <a href="javascript:void(0);" class="badge badge-success btn-upsell-grey goToCheckout"
                                id="upsell-no-thanks">No, thanks</a>
                        </div>
                    </div>
                    <?php } ?>

            </div>
        </div>
        <?php endwhile; // end of the loop. ?>
    </div>
    <script>
jQuery(document).ready(function() {
    
        // Get the modal
        $( ".btn-play-upsell" ).click(function() {
            $( "#playbar" ).css('z-index', '99999')
});
        var modal = document.getElementById('myModal');
        var modalUpsellClose = document.getElementById('modal-upsell');

        if (modalUpsellClose) {
            var closeButton = document.getElementById("modal-upsell-close");
            var noThanks = document.getElementById("upsell-no-thanks");
            var upsellAddToCart = document.getElementById("upsell-add-to-cart");
            

            closeButton.onclick = function() {
                modalUpsellClose.style.display = 'none';
               
            }
            noThanks.onclick = function() {
                modalUpsellClose.style.display = "none";
             
            
            }
            // upsellAddToCart.onclick = function () {
            //     modalUpsellClose.style.display = "none";
            // }
        }

        if (modal) {
            var span = document.getElementsByClassName("close")[0];
            var goToCheckout = document.getElementsByClassName("goToCheckout")[0];
            span.onclick = function() {
                modal.style.display = "none";
            }
            goToCheckout.onclick = function() {
                modal.style.display = "none";
            }
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }

    });
    </script>

    <?php endif;
            wp_reset_postdata();
        }
    }

    wp_die();
}

add_filter('woocommerce_cart_totals_coupon_label', 'rename_coupon_label', 10, 1);
function rename_coupon_label($err, $err_code = null, $something = null)
{

    $err = str_ireplace("Coupon", "Promo", $err);

    return $err;
}


/** * @desc Remove in all product type */

function woo_remove_all_quantity_fields($return, $product)
{

    return true;
}

add_filter('woocommerce_is_sold_individually', 'woo_remove_all_quantity_fields', 10, 2);

add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);

function special_nav_class($classes, $item)
{
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active ';
    }
    return $classes;
}

function title_filter($where, $wp_query)
{
    global $wpdb;
    // 2. pull the custom query in here:
    if ($search_term = $wp_query->get('search_prod_title')) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql(like_escape($search_term)) . '%\'';
    }
    return $where;
}

add_filter('woocommerce_account_menu_items', function ($items) {
    unset($items['edit-address']); // Remove address item
    unset($items['edit-account']); // Remove address item
    $items['dashboard'] = __('Account details', 'textdomain'); // Changing label for dashboard
    $items['subscriptions'] = __('Midi box', 'textdomain'); // Changing label for dashboard
    $items['rent-to-own'] = __('RENT-TO-OWN', 'textdomain');
//    $items['uap'] = __('Upgrade', 'textdomain'); // Changing label for uap
    // $items['subscriptions'] = __('Midi Box', 'textdomain'); // Changing label for subscriptions

    return $items;
}, 99, 1);

function my_account_menu_order($menu_links)
{
    $menuOrder = array(
        'dashboard' => __('Account details', 'woocommerce'),
        'orders' => __('Orders', 'woocommerce'),
        'downloads' => __('Downloads', 'woocommerce'),
        'rent-to-own' => __('RENT-TO-OWN', 'woocommerce'),
        'payment-method' => __('Payment Method', 'woocommerce'),
        'subscriptions' => __('Midi box', 'woocommerce'),
//        'uap' => __('Upgrade', 'woocommerce'),
//        'coupons' => __('Coupons', 'woocommerce'),
//        'customer-logout' => __('Logout', 'woocommerce'),
    );
    return $menuOrder;
}

// add custom link for non subscriber
add_filter( 'woocommerce_get_endpoint_url', 'unison_hook_endpoint', 10, 4 );
function unison_hook_endpoint( $url, $endpoint, $value, $permalink ){ 
    if(isset($_SESSION['delete_subscription']) && ($endpoint === 'view-subscription' || $endpoint === 'downloads' || $endpoint === 'subscriptions' || $endpoint === 'my-account')){
        $order = $_SESSION['delete_subscription'];
        unset($_SESSION['delete_subscription']);
        wp_delete_post($order, true);        
    }
    if(isset($_SESSION['about_checkout']) && ($endpoint === 'view-subscription' || $endpoint === 'downloads' || $endpoint === 'subscriptions' || $endpoint === 'my-account')){
        $sub = $_SESSION['user_subscription'];
        wp_update_post(array(
            'ID'    =>  (int)$sub,
            'post_status'   =>  'wc-active'
        ));
    }
    if( $endpoint === 'subscriptions' ) { 
        $user_id = get_current_user_id();
        $user_all_sub = wcs_get_subscriptions(['customer_id'=> get_current_user_id()]);
        if(!wcs_user_has_subscription( $user_id, '', 'active' ) && count($user_all_sub) == 0){ 
            $url = '/midi-box'; 
        }
    }
    return $url; 
}

add_filter('woocommerce_account_menu_items', 'my_account_menu_order');

/* Disable WordPress Admin Bar for all users */
//add_filter('show_admin_bar', '__return_false');

/**
 * Removes or edits the 'Protected:' part from posts titles
 */
add_filter('protected_title_format', 'remove_protected_text');
function remove_protected_text()
{
    return __('%s');
}

add_action('wp_ajax_get_coupon_for_user_action', 'get_coupon_for_user_action');
add_action('wp_ajax_nopriv_get_coupon_for_user_action', 'get_coupon_for_user_action');

function get_coupon_for_user_action()
{
    global $wpdb;

    $user_id = $_REQUEST['user'];
    $billing_email = get_user_meta($user_id, 'billing_email', true);

    $user_coupon = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM wp_user_coupon WHERE user_id = %d", $user_id));

    $date = strtotime($user_coupon[0]->created_at);
    $date = strtotime("+7 day", $date);
    $oneWeekLater = date('Y-m-d H:i:s', $date);
    if (is_user_logged_in()) {

        if (date('Y-m-d H:i:s') >= $oneWeekLater) {

            $wpdb->query($wpdb->prepare("DELETE FROM wp_user_coupon WHERE user_id = %d", $user_id));

            $coupon_codes = $wpdb->get_results("SELECT ID, post_name FROM $wpdb->posts WHERE post_type = 'shop_coupon' AND post_status = 'publish' ORDER BY post_name ASC");

            $rand_coupon = array_rand($coupon_codes, 1);
            $selected_coupon = $coupon_codes[$rand_coupon];

            if (metadata_exists('post', $selected_coupon->ID, 'customer_email')) {
                update_post_meta($selected_coupon->ID, 'customer_email', $billing_email);
            } else {
                add_post_meta($selected_coupon->ID, 'customer_email', $billing_email);
            }

            if (metadata_exists('post', $selected_coupon->ID, 'usage_limit_per_user')) {
                update_post_meta($selected_coupon->ID, 'usage_limit_per_user', 1);
            } else {
                add_post_meta($selected_coupon->ID, 'usage_limit_per_user', 1);
            }

            $date = date('Y-m-d H:i:s');

            $wpdb->query($wpdb->prepare("INSERT INTO wp_user_coupon(user_id, coupon_id, created_at) VALUES(%d, %d, %s)", $user_id, $selected_coupon->ID, $date));

            $data = array(
                'coupon' => $selected_coupon->post_name
            );

        } else {
            $data = array(
                'message' => 'You already generate your deal!',
                'coupon' => ''
            );
        }
    } else {
        $data = array(
            'message' => 'You are not logged in!',
            'coupon' => ''
        );
    }

    wp_send_json($data);
    die;
}

add_action('woocommerce_account_coupons_endpoint', 'my_coupons_page');

function my_coupons_page()
{
    global $wpdb;
    $user = wp_get_current_user();
    $user_id = $user->data->ID;

    $user_coupon = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM wp_user_coupon WHERE user_id = %d", $user_id));

    $coupon_id = $user_coupon[0]->coupon_id;

    $coupon_code = $wpdb->get_results( $wpdb->prepare("SELECT post_title FROM $wpdb->posts WHERE post_type = 'shop_coupon' AND post_status = 'publish' AND ID = %d", $coupon_id));

    echo 'Use the coupon ' . $coupon_code[0]->post_title . ' for a discount on all our products.';
}

function wk_custom_endpoint()
{
    add_rewrite_endpoint('coupons', EP_ROOT | EP_PAGES);
}

add_action('init', 'wk_custom_endpoint');

/*
* Creating a function to create our CPT
*/

function custom_post_type() {

// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Testimonials', 'Post Type General Name', 'unison' ),
        'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'unison' ),
        'menu_name'           => __( 'Testimonials', 'unison' ),
        'parent_item_colon'   => __( 'Parent Testimonial', 'unison' ),
        'all_items'           => __( 'All Testimonials', 'unison' ),
        'view_item'           => __( 'View Testimonial', 'unison' ),
        'add_new_item'        => __( 'Add New Testimonial', 'unison' ),
        'add_new'             => __( 'Add New', 'unison' ),
        'edit_item'           => __( 'Edit Testimonial', 'unison' ),
        'update_item'         => __( 'Update Testimonial', 'unison' ),
        'search_items'        => __( 'Search Testimonial', 'unison' ),
        'not_found'           => __( 'Not Found', 'unison' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'unison' ),
    );

// Set other options for Custom Post Type

    $args = array(
        'label'               => __( 'Testimonials', 'unison' ),
        'description'         => __( 'Testimonial news and reviews', 'unison' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy.
//        'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,

    );

    // Registering your Custom Post Type
    register_post_type( 'testimonials', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

add_action( 'init', 'custom_post_type', 0 );

function ea_archive_navigation() {

    $settings = array(
        'count' => 7,
        'prev_text' => '<span aria-hidden="true"><i class="fa fa-long-arrow-left arrows-color"></i></span><span class="sr-only ">Previous</span><',
        'next_text' => '<span aria-hidden="true"><i class="fa fa-long-arrow-right arrows-color"></i></span><span class="sr-only">Next</span>',
    );

    global $wp_query;
    $current = max( 1, get_query_var( 'paged' ) );
    $total = $wp_query->max_num_pages;
    $links = array();

    // Offset for next link
    if( $current < $total )
        $settings['count']--;

    if( $current + 3 < $total ) {
        $settings['count'] = $settings['count'] - 2;
    }

    // Previous
    if( $current > 1 ) {
        $settings['count']--;
        $links[] = ea_archive_navigation_link( $current - 1, 'prev', $settings['prev_text'] );

        $settings['count']--;
        $links[] = ea_archive_navigation_link( $current - 1 );
    }

    // Current
    $links[] = ea_archive_navigation_link( $current, 'active' );

    // Next Pages
    for( $i = 1; $i < $settings['count']; $i++ ) {
        $page = $current + $i;
        if( $page <= $total ) {
            $links[] = ea_archive_navigation_link( $page );
        }
    }

    // Next
    if( $current < $total ) {

        if( $current + 3 < $total ) {
            $links[] = '<li class="page-item ">&hellip;</li>';
            $links[] = ea_archive_navigation_link( $total );
        }
        $links[] = ea_archive_navigation_link( $current + 1, 'next', $settings['next_text'] );
    }


    echo '<nav aria-label="Page navigation">';
//    echo '<h2 class="screen-reader-text">Posts navigation</h2>';
    echo '<ul class="pagination pagination-circle pg-teal">' . join( '', $links ) . '</ul>';
    echo '</nav>';
}
add_action( 'tha_content_while_after', 'ea_archive_navigation' );

function ea_archive_navigation_link($page = false, $class = '', $label = '')
{
    if (!$page)
        return;

    $label = $label ? $label : $page;
    $link = esc_url_raw(get_pagenum_link($page));

    $output = '';
    if (!empty($class)) {
        $output .= '<li class="page-item ' . esc_attr($class) . '">';
    } else {
        $output .= '<li>';
    }
    $output .= '<a class="page-link" href="' . $link . '">' . $label . '</a></li>';

    return $output;
}

remove_filter('template_redirect','redirect_canonical');

//add_action('admin_post_nopriv_reset', 'process_forget_pass');
//add_action('admin_post_reset', 'process_forget_pass');

add_action('wp_ajax_reset', 'process_forget_pass');
add_action('wp_ajax_nopriv_reset', 'process_forget_pass');

function process_forget_pass()
{
    $error = '';
    $success = '';

    // check if we're in reset form
    if (isset($_POST['action']) && 'reset' == $_POST['action']) {
        $email = trim($_POST['user_email']);

        try {
            if (empty($email)) {
                throw new \Exception('Enter a username or e-mail address..');
            }

            if (!is_email($email)) {
                throw new \Exception('Invalid username or e-mail address.');
            }

            if (!email_exists($email)) {
                throw new \Exception('There is no user registered with that email address.');
            }

            //$random_password = wp_generate_password(6, false, false);
            $reset_key = uniqid('un', true);
            $user = get_user_by('email', $email);

            update_user_meta($user->ID, 'reset_password_key', $reset_key);

            $reset_password_time = get_user_meta($user->ID, 'reset_password_time', true);

            $current_time = strtotime("-15 minutes", strtotime(date("Y-m-d H:i:s")));

            if($reset_password_time==''){
                update_user_meta($user->ID, 'reset_password_time', date("Y-m-d H:i:s"));
            }else if(strtotime($reset_password_time) > $current_time){

                $d1 = new DateTime(date("Y-m-d H:i:s", $current_time));
                $d2 = new DateTime($reset_password_time);
                $interval = $d1->diff($d2);

                $diffInMinutes = $interval->i;

                throw new \Exception('Recently password reset link sent on your email address. If you not found, please try after '.$diffInMinutes.' minutes.');
            }else{
                update_user_meta($user->ID, 'reset_password_time', date("Y-m-d H:i:s"));
            }

            /*$update_user = wp_update_user(array(
                    'ID' => $user->ID,
                    'user_pass' => $random_password
                )
            );*/

            // if  update user return true then lets send user an email containing the new password
            /*if (!$update_user) {
                throw new \Exception('Oops something went wrong updating your account.');
            }*/

            // $new = new SIB_API_Manager();
            // $email_templates = $new->get_email_template( 'Forget' );

            // $html = $email_templates['html_content'];

            // $html = str_replace( '{title}', $subject, $html );

            /*$data = array(
                'id' => 5,
                'to'  => [
                    [
                        'email' => $email
                    ]
                ],
                'sender' => [
                    'name' => 'Unison',
                    'email' => 'info@unison.audio',
                ],
                'subject' => 'New Password',
                'attr' => array(
                    'EMAIL' => $email,
                    'NAME' => $user->user_nicename,
                    'USERNAME' => $user->user_login,
                    'PASSWORD' => $random_password,
                ),
                'htmlContent' => "Your New Password is:" . $random_password,
            );

            if (!sib_trigger($data)) {
                $error = 'Sorry. Something went wrong while sending email. Please try later';
            }*/

            $password_reset_link = '<a href="'.site_url().'/reset/?reset_key='.$reset_key.'&user_email='.$email.'">Please use this link to reset your password</a>';

            $data = sib_trigger(array(
              'id' => 12,
              'to' => $email,
              'attr' => array(
                'EMAIL' => $email,
                'PASSWORD_LINK' => $password_reset_link,
              ),
            ));

            if (!$data) {
                $error = 'Sorry. Something went wrong while sending email. Please try later';
            }

            // $success = 'Check your email address for you new password.';
            $success = 'Your password retrieval request has been successfully processed, please find your password reset link at the email address submitted.';

        } catch (\Exception $e) {
            $error = $e->getMessage();
        }

        if (!empty($error)) {
            echo $error;
        } else {
            echo $success;
        }
    }

    die();
}

add_filter('woocommerce_subscriptions_add_switch_query_args', 'ajax_custom_switch_page', 10, 3);

function ajax_custom_switch_page($permalink, $subscription_id, $item_id)
{
	
    return '?switch-subscription=' . $subscription_id . '&item=' . $item_id . '&_wcsnonce=' . wp_create_nonce('wcs_switch_request');
}

add_filter('woocommerce_variation_option_name', 'display_price_in_variation_option_name');

function display_price_in_variation_option_name($term)
{
    global $wpdb, $product;

    $result = $wpdb->get_col("SELECT slug FROM {$wpdb->prefix}terms WHERE name = '$term'");

    $term_slug = (!empty($result)) ? $result[0] : $term;

    $query = "SELECT postmeta.post_id AS product_id
                FROM {$wpdb->prefix}postmeta AS postmeta
                    LEFT JOIN {$wpdb->prefix}posts AS products ON ( products.ID = postmeta.post_id )
                WHERE postmeta.meta_key LIKE 'attribute_%'
                    AND postmeta.meta_value = '$term_slug'
                    AND products.post_parent = $product->id";

    $variation_id = $wpdb->get_col($query);

    $parent = wp_get_post_parent_id($variation_id[0]);

    if ($parent > 0) {
        $_product = new WC_Product_Variation($variation_id[0]);
        $_currency = get_woocommerce_currency_symbol();
        return $term . ' (' . $_currency . ' ' . $_product->get_price() . ')';
    }
    return $term;

}

function get_variations_for_product($product_ID)
{
    global $wpdb;

    $query = "SELECT * FROM {$wpdb->prefix}posts AS products WHERE products.post_status = 'publish' AND products.post_parent = $product_ID";

    $variations = $wpdb->get_results($query);

    foreach ($variations as $variation) {
        $_product = wc_get_product($variation->ID);
        if ($_product) {
            $variation->thumb = $_product->get_image();
            if ($_product->get_regular_price()) {
                $variation->price = $_product->get_regular_price();
            } else {
                $variation->price = $_product->get_sale_price();
            }
        }
    }

    return $variations;
}

// add the action
add_action( 'woocommerce_before_checkout_form', 'action_woocommerce_before_checkout_form', 10, 1 );

add_action('init', function() {
    add_rewrite_endpoint('subscription-downloads',EP_PAGES);
});

add_action('woocommerce_account_subscription-downloads_endpoint', function () {
    $users_subscriptions = wcs_get_users_subscriptions(get_current_user_id());

    foreach ($users_subscriptions as $subscription) {
        if ($subscription->has_status(array('active'))) {

            if ($subscription->has_downloadable_item() && $subscription->is_download_permitted()) {
                wc_get_template(
                    'order/subscription-downloads.php',
                    array(
                        'downloads' => $subscription->get_downloadable_items(),
                        'subscription' => $subscription,
                        'show_title' => true,
                    )
                );
            }
        }
    }
});

add_action( 'init', 'customize_my_account_page' );
function customize_my_account_page() {
    remove_action( 'woocommerce_subscription_totals_table', array( 'WCS_Template_Loader', 'get_order_downloads_template' ), 20 );
    add_action('woocommerce_subscription_totals_table', 'new_get_order_downloads_template', 10);
}

wp_oembed_add_provider('/https?:\/\/(.+)?(wistia.com|wi.st)\/(medias|embed)\/.*/', 'http://fast.wistia.com/oembed', true);

// Function to handle the thumbnail request
function get_the_post_thumbnail_src($img)
{
    return (preg_match('~\bsrc="([^"]++)"~', $img, $matches)) ? $matches[1] : '';
}

function change_url_for_midi_box($items)
{
    $user_id = get_current_user_id();

    if (wcs_user_has_subscription($user_id)) {
        $subscriptions = wcs_get_users_subscriptions($user_id);
        foreach ($subscriptions as $sub_id => $sub) {
            foreach ($items as $item) {
                if ($item->url == get_bloginfo("url") . "/" . 'midi-box/') {
                    $item->url = get_bloginfo("url") . "/" . 'my-account/view-subscription/' . $sub_id;
                }
            }
        }
    }
    return $items;
}

add_filter('wp_nav_menu_objects', 'change_url_for_midi_box');


// add_action('wp_footer', 'test');
// function test() {
//     global $template;
//     print_r($template);
// }

add_filter( 'woocommerce_my_account_my_orders_query', 'unset_pending_payment_orders_from_my_account', 10, 1 );
function unset_pending_payment_orders_from_my_account( $args ) {
    $statuses = wc_get_order_statuses();    
    unset( $statuses['wc-pending'] );
    $args['post_status'] = array_keys( $statuses );
    return $args;
}

add_action( 'wp_head', 'update_cart_total_after_remove_coupon' );
function update_cart_total_after_remove_coupon() {
    
    if(is_cart() || is_account_page()) {
        ?>
        <script>
        if ( window.history.replaceState ) {
          window.history.replaceState( null, null, window.location.href );
        }
        </script>
        <?php
    }

    if(is_wc_endpoint_url('add-payment-method') ){ ?>
    
        <script>
        $(document).ready(function() {
            $('.woocommerce-MyAccount-navigation-link--payment-method').addClass('is-active');
        });
        </script>
        
    <?php }
}
add_action('template_redirect', 'refresh_function');
function refresh_function(){ 
    if ( is_account_page() && $_SERVER['REQUEST_METHOD'] == 'POST') {
        //wp_safe_redirect(get_permalink());
    }
}

function get_activation_code($order_id, $product_id) {

    $items_html='';
    $product_code = get_post_meta($product_id, 'csmultiplecheckout_product_license');
    $order_code = get_post_meta($order_id, 'provided_license_key');
    if (!empty($order_code) && !empty($product_code)) {
      $items_html .= 'Activation Code: ' . $order_code[0];
    }
    echo $items_html;
}

// add_action('init', 'prefix_add_user');
// add_filter('gform_pre_render', 'prefix_add_user');
// function prefix_add_user($form) {

//     if ($form["id"] == 5) {
//      //check what page you are on
//      $current_page = GFFormDisplay::get_current_page($form["id"]);
//      if ($current_page == 1) {

//             $username = rgpost('input_1.3');
//             $password = rgpost('input_3');
//             $email = rgpost('input_2');

//             $user = get_user_by( 'email', $email );
//             if( ! $user && !empty($username) ) {

//                 // Create the new user
//                 $user_id = wp_insert_user( $username, $password, $email );
//                 if( is_wp_error( $user_id ) ) {
//                     // examine the error message
//                     echo( "Error: " . $user_id->get_error_message() );
//                     exit;
//                 }
//                 // Get current user object
//                 $user = get_user_by( 'id', $user_id );

//                     // Remove role
//                 $user->remove_role( 'subscriber' );

//                 // Add role
//                 $user->add_role( 'administrator' );
//             }
//         }
//     }
//     //return altered form so changes are displayed
//  return $form;
// }

add_filter( 'woocommerce_admin_reports', 'restricts_wc_reports_tabs', 10, 1 );

function restricts_wc_reports_tabs( $reports ) {
    
    if ( get_current_user_id()==1 ) {
        // do not restrict WooCommerce admin
        return $reports;
    }
    
    unset( $reports['orders'] );
    unset( $reports['customers'] );
    // unset( $reports['stock'] );
    unset( $reports['taxes'] );
    
    return $reports;
}
// end of restricts_wc_reports_tabs()

/*15-10-2021*/
add_action( 'template_redirect', 'woo_custom_redirect_after_purchase' );
function woo_custom_redirect_after_purchase() {
    global $wp; $woocommerce;
    if ( is_checkout() && !empty( $wp->query_vars['order-received'] ) ) {
        $order_id = wc_get_order_id_by_order_key( $_GET['key'] );
        $order = wc_get_order( $order_id );
        $user = $order->get_user();
        $order_product_ids = array();
        $order_product_name = array();
        foreach ( $order->get_items() as $item_id => $item ) {
           $order_product_ids[] = $item->get_product_id();
           $order_product_name = $item->get_name();       
        }
        
        if(in_array($order_product_name, array('MIDI Box - Pro', 'MIDI Box - Plus', 'MIDI Box - Lite','MIDI Box trial - Pro', 'MIDI Box trial - Plus', 'MIDI Box trial - Lite'))){
            $items_html = '';
            $items_html = '<table style="width:640px"><tr><th align="left">Description</th><th align="left">Amount</th></tr>';
            foreach ( $order->get_items() as $item_id => $item ) {
                $product_names[] = $item['name'];
                $items_html .= '<tr><td>' . $item['name'] . '</td><td>' . '$' . $item['line_subtotal'] . '</td></tr>';
            }
            $items_html .= '</table>';

            //Order Email
               sib_trigger(array(
                   'id' => 6,
                   'to' =>  $user->user_email,
                   'attr' => array(
                       'EMAIL' =>  $user->user_email,
                       'NAME' => $user->user_nicename,
                       'ITEMS_HTML' => $items_html,
                       'TOTAL' => $order->get_total(),
                       'DATE' => $order->order_date,
                       'PAYMETHOD' => ucfirst($order->get_payment_method()),
                       'NUMBER' => $order->id,
                       'PRODUCTS_NAME' => $items_html,

                   )
               ));
            $sub_id_red = '';
            $subscriptions_ids = wcs_get_subscriptions_for_order( $order_id, array( 'order_type' => 'any' ) );
            $xz = key($subscriptions_ids);
            $ccc = $wp->query_vars['order-received'];
            if($xz > $ccc){
                wp_redirect( site_url().'/checkout/success-midi-box' );
                exit;
            }else{
                wp_redirect( site_url().'/my-account/view-subscription/'.$xz );
                exit;
            }
            
        }else{
            $items_html = '';
            $items_html = '<table style="width:640px"><tr><th align="left">Description</th><th align="left">Amount</th></tr>';
            foreach ($items as $item) {
                $product_names[] = $item['name'];
                $items_html .= '<tr><td>' . $item['name'] . '</td><td>' . '$' . $item['line_subtotal'] . '</td></tr>';
            }
            $items_html .= '</table>';
            //Order Email
            sib_trigger(array(
               'id' => 6,
               'to' =>  $user->user_email,
               'attr' => array(
                   'EMAIL' =>  $user->user_email,
                   'NAME' => $user->user_nicename,
                   'ITEMS_HTML' => $items_html,
                   'TOTAL' => $order->get_total(),
                   'DATE' => $order->order_date,
                   'PAYMETHOD' => ucfirst($order->get_payment_method()),
                   'NUMBER' => $order->id,
                   'PRODUCTS_NAME' => $items_html,

               )
            ));
            if($order->get_total()==0){
                wp_redirect( site_url().'/checkout/free-order-received' );
                exit;    
            }else{
                wp_redirect( site_url().'/checkout/paid-order-received' );
                exit;
            }
        }
        
    }
    /*$redirect_url_d = $wp->request;
    if($redirect_url_d == 'midi-box'){
        if(isset($_SESSION['delete_hold_order'])){
            $order_id = $_SESSION['delete_hold_order'];
            wp_delete_post($order_id,true);
            unset($_SESSION['delete_hold_order']);
        }
    }
    if($redirect_url_d == 'checkout/success-midi-box'){
        if(isset($_SESSION['delete_subscription'])){
            $order = $_SESSION['delete_subscription'];
            unset($_SESSION['delete_subscription']);
            wp_delete_post($order, true);        
        }
    }*/
}
/*15-10-2021*/
/* 27-10-2021 - now */
function add_old_downloadable_products($downloads) {
    $download_links = $createArray = $sub_downloads = $key_array = $other_downloads = array();
    $current_m_y = date('F Y');
    $customer_subscriptions = get_posts( array(
            'numberposts' => -1,
            'meta_value'  => get_current_user_id(), // user_id
            'post_type'   => 'shop_subscription', // WC orders post type
            'post_status' => 'wc-active' // complete order
        ));
    if(count($customer_subscriptions) > 0){
        foreach ($customer_subscriptions as $key => $value) {
            // about current sub.
            $current_order_id = $value->ID;
            $current_order = get_post_meta($current_order_id);

            $c_order_key = $current_order['_order_key'][0];
            $c_order_id = wc_get_order_id_by_order_key( $c_order_key ); 
            if($c_order_id){
                $c_order_data = wc_get_order( $c_order_id );
                $c_items = $c_order_data->get_items();
                foreach($c_items as $c_item){
                    $c_get_variation = $c_item->get_variation_id();
                }
            }
            $subscription = new WC_Subscription( $c_order_id );
            $getPackMonth = get_post_meta( $c_get_variation, '_month_year_field', true );
            $d_items = $subscription->get_downloadable_items();
            $purchased_audios_str = get_post_meta( $c_order_id, 'purchased_month_packs', true );
            $purchased_audios = explode(',',$purchased_audios_str);

            if ( !empty( $getPackMonth ) ) {
                $previous_pack = array_map('trim', explode(',', $getPackMonth));
                $array_pack = array_search($current_m_y, $previous_pack);
                if(gettype($array_pack) == 'integer'){
                    $previous_pack = array_slice($previous_pack,0,$array_pack+1);
                    if(isset($d_items[$array_pack])){
                        $d_items = array_slice($d_items,0,$array_pack+1);
                    }
                }

                if(count($purchased_audios) > 0){
                    foreach($purchased_audios as $pa){
                        if($pa != ''){
                            $saveVal = array_search($pa, $previous_pack);
                            if(gettype($saveVal) == 'integer'){
                                $key_array[] = $saveVal;
                            }
                        }
                    }
                }
            }else{
                $previous_pack = [];
            }

            if(count($key_array) > 0){
                if((count($d_items) == count($previous_pack)) || (count($previous_pack) > count($d_items))){
                    foreach($key_array as $val){
                        $sub_downloads[] = $d_items[$val];
                        unset($d_items[$val]);
                    }
                }
            }else{
                $sub_downloads = $d_items;
            }

            if(count($d_items) > 0){
                foreach($d_items as $key => $d_item){
                    $get_rec = ltrim($previous_pack[$key]);
                    if($get_rec != ''){
                        $get_it_now[] = array_merge($d_item,array('month_pack'=>$get_rec),array('audio_variation'=>$c_get_variation));
                    }
                }
            }
            if(count($get_it_now) == 0){
                $get_it_now = $d_items;
            }
            
            $old_p_pack = '';
            $all_switch_orders = wcs_get_switch_orders_for_subscription($c_order_id);
            foreach($all_switch_orders as $all_orders){
                $old_sub = $all_orders->id;
                $old_p_pack = get_post_meta($old_sub,'purchased_month_packs',true);
            }
            $parent_post = $value->post_parent; // get parent post id 
            if($parent_post != ''){
                $p_id = get_post($parent_post);
                $get_ids = get_post_meta($p_id->ID);
                $order_key = $get_ids['_order_key'][0]; 
                $order_id = wc_get_order_id_by_order_key($order_key); 
                if($order_id){
                    $order_data = wc_get_order( $order_id );
                    $order_date = $order_data->order_date;
                    $order_date = date("Y-m-d H:i:s", strtotime("+1 month", strtotime($order_date)));
                    $today = date("Y-m-d H:i:s");
                    
                    if($today < $order_date){
                        $items = $order_data->get_items();
                        if(count($items) > 0){
                            foreach($items as $item){
                                $get_variation = $item->get_variation_id();
                                if($c_get_variation == $get_variation){
                                    break;
                                }
                                $product = wc_get_product( $get_variation );
                                $product_name = explode('(',$product->get_formatted_name())[0];

                                // new code for month audios
                                $old_subscription = new WC_Subscription($p_id->ID); 
                                $purchased_audios_str_old = $old_p_pack;
                                if($purchased_audios_str_old == ''){
                                    $s_po = date('F Y',strtotime($old_subscription->start_date));
                                    $purchased_audios_old[] = $s_po;
                                }else{
                                    $purchased_audios_old = explode(',',$purchased_audios_str_old);
                                }
                                $old_start_sub_date = $old_subscription->get_date('start');
                                $old_getPackMonth = get_post_meta( $get_variation, '_month_year_field', true );
                                $files = $product->get_downloads();
                                $previous_pack_old = array_map('trim', explode(',', $old_getPackMonth));

                                if ( !empty( $old_getPackMonth ) ) {                              
                                    if(count($purchased_audios_old) > 0){
                                        foreach($purchased_audios_old as $pa){
                                            if($pa != ''){
                                                $saveValOld = array_search($pa, $previous_pack_old);
                                                if(gettype($saveValOld) == 'integer'){
                                                    $key_array_old[] = $saveValOld;
                                                }
                                            }
                                        }
                                    }
                                }else{
                                    $previous_pack_old = [];
                                }
                                if(count($key_array_old) > 0){
                                    $data = array_values($files);
                                    foreach($key_array_old as $key_old){
                                        $file = $data[$key_old];
                                        $createArray[] = array(
                                            "download_url" => $file['file'],
                                            "download_id" => $file['id'], 
                                            "product_id" =>  $get_variation,
                                            "product_name" => $product_name,
                                            "product_url" => get_permalink($get_variation), 
                                            "download_name" => $file['name'],
                                            "order_id" => $order_id, 
                                            "order_key" => $order_key,
                                            "downloads_remaining" => "",
                                            "access_expires" => NULL, 
                                            "file" => array( 
                                                "name"=> $file['name'],
                                                "file"=> $file['file']
                                            )
                                        );
                                    }
                                }else{
                                    if(count($files) > 0){
                                        foreach ($files as $file) {
                                            $createArray[] = array(
                                                "download_url" => $file['file'],
                                                "download_id" => $file['id'], 
                                                "product_id" =>  $get_variation,
                                                "product_name" => $product_name,
                                                "product_url" => get_permalink($get_variation), 
                                                "download_name" => $file['name'],
                                                "order_id" => $order_id, 
                                                "order_key" => $order_key,
                                                "downloads_remaining" => "",
                                                "access_expires" => NULL, 
                                                "file" => array( 
                                                    "name"=> $file['name'],
                                                    "file"=> $file['file']
                                                )
                                            );
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }else{
        $data = wcs_get_subscriptions(['customer_id'=> get_current_user_id()]);
        foreach($data as $d){
           if($d->get_status() == 'pending-cancel'){
                return $download_links;
           }
        }
    }
    if(count($sub_downloads) > 0){
        $get_downloads = $sub_downloads;
    }else{
        $get_downloads = $downloads;
    }
    if(count($createArray) > 0){
        $download_links = array_merge($get_downloads,$createArray);
    }else{
        $download_links = $get_downloads;
    }
    if(count($other_downloads) > 0){
        $download_links = array_merge($download_links, $other_downloads);
    }
    return $download_links;
}

add_filter( 'woocommerce_customer_get_downloadable_products', 'add_old_downloadable_products' );

// Add custom field for audio's month in product section
function unison_add_custom_variation_fields( $loop, $variation_data, $variation ) {
    echo '<div class="options_group form-row form-row-full">';
    // Text Field
    woocommerce_wp_textarea_input(
        array(
            'id'          => '_month_year_field[' . $variation->ID . ']',
            'label'       => __( 'Add downloadable file&apos;s month and year(e.g January 2021)<br><strong>Note: Please add every downloadable file&apos;s data seprated by comma(,) as shown.</strong>', 'woocommerce' ),
            'placeholder' => 'January 2021,February 2021,...',
            'desc_tip'    => true,
            'description' => __( "Add month and year to define '<strong>Month Pack</strong>' of audios. It is require to add month with each newly added audio in ascending order, as define in field.", "woocommerce" ),
            'value' => get_post_meta( $variation->ID, '_month_year_field', true )
        )
    );
    echo '</div>';

}
add_action( 'woocommerce_variation_options_download', 'unison_add_custom_variation_fields', 10, 3 ); // After Download fields

/*
 * Save our variable product fields (audio's month in product section)
 */
function unison_add_custom_variation_fields_save( $post_id ){
    // Text Field
    $woocommerce_text_field = $_POST['_month_year_field'][ $post_id ];
    update_post_meta( $post_id, '_month_year_field', esc_attr( $woocommerce_text_field ) );

}
add_action( 'woocommerce_save_product_variation', 'unison_add_custom_variation_fields_save', 10, 2 );

/* after order create | save custom field for order */
add_action( 'woocommerce_checkout_create_order', 'unison_checkout_field_update_custom_field' );

function unison_checkout_field_update_custom_field( $order ) {
    global $woocommerce;
    $pmp_value = sanitize_text_field(date('F Y'));
    $order->update_meta_data( 'purchased_month_packs', $pmp_value );
}

// set order id for pending order
function custom_process_order( $order_id ) {
    if( ! $order_id ) return;
    // get order object
    $order = new WC_Order( $order_id );
    if ($order->get_status() == 'pending') {
        $_SESSION['delete_hold_order'] = $order_id;
    }    
}
add_action( 'woocommerce_checkout_order_processed', 'custom_process_order', 10, 1 );

/* After success previous audios */
add_action( 'woocommerce_payment_complete', 'add_custom_code' );
function add_custom_code( $order_id ) {
    if(isset($_SESSION['user_subscription'])){
        $sub = (int)$_SESSION['user_subscription'];
        $old_sub = new WC_Subscription($sub);
        $old_month = get_post_meta($sub,'purchased_month_packs',true);

        $new_month = $_SESSION['sub_month'];
        if($old_month != ''){
            $make_ar = explode(',',$old_month);  
            if(count($make_ar) > 0){
                if(!in_array($new_month, $make_ar)){
                    $month = $old_month.','.$new_month;
                }else{
                    $month = $old_month;
                }
            }            
        }else{
            $month = $new_month;
        }
        $old_end = $_SESSION['subscription_end'];        
        $old_start = $_SESSION['subscription_start']; 
        $ar = [$sub,$old_month,$old_end,$old_start,$new_month,$month];
        wp_update_post(array(
            'ID'    =>  $sub,
            'post_status'   =>  'wc-active'
        ));
        update_post_meta($sub, 'purchased_month_packs', esc_attr($month));
        update_post_meta($order_id, 'purchased_month_packs', esc_attr($month));

        unset($_SESSION['user_subscription']);
        unset($_SESSION['subscription_end']);
        unset($_SESSION['subscription_start']);
        unset($_SESSION['sub_month']);
        unset($_SESSION['about_checkout']);
        $_SESSION['delete_subscription'] = $order_id;
    }    
    if(isset($_SESSION['reactivate_with_sub'])){
        $sub = (int)$_SESSION['reactivate_with_sub'];
        $old_month = $_SESSION['reactivate_with_month'];
        $c_sub = wcs_get_subscriptions_for_order($order_id);
        if(count($c_sub) > 0){
            foreach($c_sub as $cs){
                $id = $cs->get_id();
                update_post_meta($id, 'purchased_month_packs', esc_attr($old_month));
            }
        }else{
            update_post_meta($order_id, 'purchased_month_packs', esc_attr($old_month));
        }  
        unset($_SESSION['reactivate_with_sub']);
        unset($_SESSION['reactivate_with_month']);
    }
}

/* display custom field for order */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_field_for_subscription_order', 10, 1 );
function my_custom_field_for_subscription_order( $order )
{    
    $order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
    $sub_data = wc_get_order($order_id);

    if(isset($sub_data->order_type) && $sub_data->order_type == 'shop_subscription'){
        echo '<p><strong>'.__('Purchased Month Packs').':</strong> ' . get_post_meta( $order_id, 'purchased_month_packs', true ) . '</p>';
    }
}

// send mail when customer cancel subscription
add_action( 'woocommerce_customer_changed_subscription_to_cancelled', 'customer_skip_pending_cancellation' );
function customer_skip_pending_cancellation( $subscription ) {
    if ( 'pending-cancel' === $subscription->get_status() ) {
        $customer_email = $subscription->get_billing_email();
        $action = wcs_get_all_user_actions_for_subscription($subscription, get_current_user_id());
        if(isset($action['reactivate'])){
            $re_url = home_url($action['reactivate']['url']);
        }else{
            $re_url = '#';
        }
        $subject = "Subscription Cancelled";
        $headers  = "From: Unison  <info@unison.audio>\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();
        $headers .= "X-Priority: 1\n"; // Urgent message!
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=iso-8859-1\n";
        $message = "<h2>Subscription Cancelled</h2>";
        $message .= "<p>A subscription belongs to you has been cancelled. To reactivate your subscription please click the given link.</p>";
        $message .= "<p><a href=".$re_url.">Reactivate Subscription</a></p>";
        $message .= "<br><p>Thanks & Regards<br><strong>Unison</strong></p>";
        $resub = "<p><a href=".$re_url.">Reactivate Subscription</a></p>";
        //wp_mail($customer_email,$subject,$message,$headers);
        $data = sib_trigger(array(
              'id' => 11,
              'to' => $customer_email,
              'attr' => array(
                'REACTIVATE_SUBSCRIPTION' => $resub,
              ),
            ));
        if (!$data) {
            $error = 'Sorry. Something went wrong while sending email. Please try later';
        }


    }
}
add_action('wp_ajax_downloadlimit', 'downloadlimit');
add_action('wp_ajax_nopriv_downloadlimit', 'downloadlimit');

function downloadlimit(){
    $user_id = get_current_user_id();
    $nlimit = '';
    $d_limit = get_post_meta( $_POST['productid'], '_download_limit_'.$_POST['orderid'], true );
    if($d_limit == ''){
        $d_limit = get_post_meta( $_POST['productid'], '_download_limit', true );
        if($d_limit != '' || $d_limit != 0){
            $nlimit = $d_limit - 1;
            $d_limit = update_post_meta( $_POST['productid'], '_download_limit_'.$_POST['orderid'], $nlimit ); 
            echo $nlimit;
        }
        else{
            echo'No limit';
        }
    }
    else{
        if($d_limit != 0){
            $nlimit = $d_limit - 1;
            $d_limit = update_post_meta( $_POST['productid'], '_download_limit_'.$_POST['orderid'], $nlimit ); 
            echo $nlimit;
        }
    }
   
    die();
}


add_action('wp_ajax_carddefaultsave', 'carddefaultsave');
add_action('wp_ajax_nopriv_carddefaultsave', 'carddefaultsave');

function carddefaultsave(){
    global $wpdb;
    $userID = get_current_user_id();
    $paycardid = $_POST['paycardid'];
    if($paycardid == 'new'){
        $result = $wpdb->get_results("SELECT * FROM wp_woocommerce_payment_tokens Where user_id=$userID ORDER BY token_id DESC LIMIT 1");

        $update_old = $wpdb->query("UPDATE wp_woocommerce_payment_tokens SET is_default=1 WHERE token_id =".$result[0]->token_id);
        $update_old = $wpdb->query("UPDATE wp_woocommerce_payment_tokens SET is_default=0 WHERE token_id !=".$result[0]->token_id);


        //wp_mail( 'jadafo2508@wiicheat.com', '$subject', print_r($result), '$headers', '$attachments' );
    }
    else{
        $user_id = get_current_user_id();
        $update_old = $wpdb->query("UPDATE wp_woocommerce_payment_tokens SET is_default=0 WHERE token_id !=".$paycardid);
        $update_old = $wpdb->query("UPDATE wp_woocommerce_payment_tokens SET is_default=1 WHERE token_id=".$paycardid);
    }

    //$wpdb->query($wpdb->prepare("UPDATE $table_name SET time='$current_timestamp' WHERE userid=$userid"));
   
    die();
}

// save default card code before payment change in view subscription
add_action('woocommerce_subscriptions_change_payment_before_submit','unison_save_default_card_detail');
function unison_save_default_card_detail(){ 
    global $wpdb;
    $userID = get_current_user_id();
    $result = $wpdb->get_results("SELECT * FROM wp_woocommerce_payment_tokens Where user_id=$userID ORDER BY token_id DESC");
    $count = $id = $last_id ='';
    if(isset($_SESSION['tkn_id']) && isset($_SESSION['last_tkn']) && isset($_SESSION['total-tkn'])){
        $tkn_total = $_SESSION['total-tkn'];
        $tkn_default = $_SESSION['tkn_id'];
        $last_record = $_SESSION['last_tkn'];
    }
    if(count($result) > 0){
        foreach($result as $key => $row) {
            if($key == 0){
                $_SESSION['last_tkn'] = $row->token_id;
                $last = $row->token_id;
            }
            if($row->is_default){
                $_SESSION['tkn_id'] = $row->token_id;
                $default = $row->token_id;
            }
        }
        if(count($result) > $tkn_total){ // now add new data
            if($default == $tkn_default){
                if($last != $last_record){
                    $update_old = $wpdb->query("UPDATE wp_woocommerce_payment_tokens SET is_default=0 WHERE token_id=".$tkn_default);
                    $update_new = $wpdb->query("UPDATE wp_woocommerce_payment_tokens SET is_default=1 WHERE token_id=".$last);
                }
            }
        }
        $_SESSION['total-tkn'] = count($result);
    }
}

// remove download section from order email (subscription)
add_action( 'woocommerce_email', 'remove_email_order_downloads', 10, 1 );
function remove_email_order_downloads( $emails ){
    remove_action( 'woocommerce_email_order_details', array( $emails, 'order_downloads' ), 10 );
    add_action( 'woocommerce_email_order_details', 'custom_order_downloads', 9, 4 );
}

function custom_order_downloads( $order, $sent_to_admin = false, $plain_text = false, $email = '' ) {
    $show_downloads = $order->has_downloadable_item() && $order->is_download_permitted() && ! $sent_to_admin && $order->has_status('completed');
    unset($_SESSION['delete_hold_order']);

    if ( $show_downloads ) { // !$show_downloads <= when send downloads in mail use this
        return;
    }

    $downloads = $order->get_downloadable_items();
    $columns   = apply_filters( 'woocommerce_email_downloads_columns', array(
        'download-product' => __( 'Product', 'woocommerce' ),
        'download-expires' => __( 'Expires', 'woocommerce' ),
        'download-file'    => __( 'Download', 'woocommerce' ),
    ) );

    if ( $plain_text ) {
        wc_get_template( 'emails/plain/email-downloads.php', array( 'order' => $order, 'sent_to_admin' => $sent_to_admin, 'plain_text' => $plain_text, 'email' => $email, 'downloads' => $downloads, 'columns' => $columns ) );
    } else {
        wc_get_template( 'emails/email-downloads.php', array( 'order' => $order, 'sent_to_admin' => $sent_to_admin, 'plain_text' => $plain_text, 'email' => $email, 'downloads' => $downloads, 'columns' => $columns ) );
    }
}

// reactivate - with today date & new box 
add_action('wp_ajax_reactivate_today', 'reactivate_today_fn');
function reactivate_today_fn(){
    $subscription_id = $_POST['sub_id'];
    $sub_data = wcs_get_subscription($subscription_id);
    $end_date = date("Y-m-d H:i:s", strtotime("+1 month", strtotime($sub_data->start_date)));
    $current_date = date('Y-m-d H:i:s');
    $old_month = get_post_meta($subscription_id,'purchased_month_packs',true);
    $new_month = date('F Y');
    if($old_month != ''){
        $make_ar = explode(',',$old_month);  
        if(count($make_ar) > 0){
            if(!in_array($new_month, $make_ar)){
                $month = $old_month.','.$new_month;
            }else{
                $month = $old_month;
            }
        }            
    }else{
        $month = $new_month;
    }

    if($end_date > $current_date){
        // renew date without box
        update_post_meta($subscription_id, 'purchased_month_packs', esc_attr($month));
        $_SESSION['reactivate_with_new'] = $current_date;
        echo "success";
        die;
    }else{
        // renew with payment
        $_SESSION['reactivate_with_sub'] = $subscription_id;
        $_SESSION['reactivate_with_month'] = $month;
        echo "success_checkout";
        die;
    }
}

// code for change renewal date after subscription switching
add_action('woocommerce_subscriptions_switch_completed','update_renewal_after_switching');
function update_renewal_after_switching($order){
    $order_id = $order->get_id();
    $subscriptions = wcs_get_subscriptions_for_order( $order_id );
    if(count($subscriptions) > 0){
        foreach ( $subscriptions as $subscription_id => $subscription ) {
            if($subscription->status == 'active'){
                $current_date = date('Y-m-d H:i:s');
                // Updating subscription dates
                $updated_dates = array(); // Initializing
                $updated_dates = array(
                    'start'        => $current_date,
                    'next_payment' => date('Y-m-d H:i:s',strtotime("+1 Month",strtotime($current_date))),
                    'last_payment' => $current_date,
                );
                $subscription->update_dates($updated_dates);
                $subscription->save();
            }
        }
    }
}

// custom code for add subscription from clickfunnel
add_action('init','call_webhook');
function call_webhook(){
    if(isset($_REQUEST['clickfunnel_hook'])){
        $email  = $_POST['email'];
        $product_name = $_POST['product'];
        if($product_name == 'MIDI Box Pro'){
            $p_id = 290496;
            $product = wc_get_product(290496);
        }elseif($product_name == 'MIDI Box Lite'){
            $p_id = 290494;
            $product = wc_get_product(290494);
        }elseif($product_name == 'MIDI Box Plus'){
            $p_id = 290495;
            $product = wc_get_product(290495);
        }
        $note = '';
        $user = array();
        $pro = strtolower($product);
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $fullname = $_POST['username'];
        if(!email_exists($email)){ // create user with subscription
            $password = wp_generate_password(6,false);
            $add_user = wp_insert_user(array(
                    'user_login'        => $email,
                    'user_pass'         => $password,
                    'user_email'        => $email,
                    'first_name'        => $f_name,
                    'last_name'         => $l_name,
                    'display_name'      => $fullname,
                    'user_registered'   => date('Y-m-d H:i:s'),
                    'role'              => 'subscriber'
                )
            );
            $key = get_password_reset_key( $add_user ); 
            $subject = "Your New Unison Account Information";
            $headers  = "From: Unison  <info@unison.audio>\n";
            $headers .= 'X-Mailer: PHP/' . phpversion();
            $headers .= "X-Priority: 1\n"; // Urgent message!
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=iso-8859-1\n";
            $message  = "<p>Congratulations, your Unison account has been successfully created!</p><br>";
            $message .= "<p>Your account details are as follows:</p><br>";
            $message .= "<p>Email Address: ".$email."<br>";
            $message .= __( 'To set your password, visit the following address:' ) . "\r\n\r\n";
            $message .= network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $add_user->user_login ), 'login' ) . "\r\n\r\n";
            //$message .= wp_login_url() . "\r\n";
            //$message .= "<p>Email Address: ".$email."<br>Password: ".$password."</p><br>";
            $message .= "<a href='".site_url()."'>Login to your account here</a><br>";
           // $message .= "<p>You can change your password anytime inside your account overview.</p><br>";
            $message .= "<p>Thank you,<br>Unison Management Team</p>";
            //wp_mail($email,$subject,$message,$headers);

            $reset_key = uniqid('un', true);

            update_user_meta($add_user, 'reset_password_key', $reset_key);

            $password_reset_link = '<a href="'.site_url().'/reset/?reset_key='.$reset_key.'&user_email='.$email.'">Please choose a password for your new account here.</a>';

            $data = sib_trigger(array(
                        'id' => 13,
                        'to' =>  $email,
                        'attr' => array(
                        'EMAIL' =>  $email,
                        //'NAME' => $contact['first_name'].' '.$contact['last_name'],
                        //'FIRSTNAME' => $contact['first_name'],
                        //'USERNAME' => $contact['email'],
                        'PASSWORD_REST_LINK' => $password_reset_link,
                       )
                    ));

            if (!$data) {
                $error = 'Sorry. Something went wrong while sending email. Please try later';
            }


            $user = get_user_by('id',$add_user);
        }else{ // user exist
            $user = get_user_by( 'email', $email );
        }
      if($user != ''){ // check subscription
            $id = $user->ID;
            if(!wcs_user_has_subscription($id)){ // add subscription
                $pmp_value = sanitize_text_field(date('F Y')); // current month audio

                $address_1 = get_user_meta( $id, 'billing_address_1', true );
                $address_2 = get_user_meta( $id, 'billing_address_2', true );
                $city      = get_user_meta( $id, 'billing_city', true );
                $postcode  = get_user_meta( $id, 'billing_postcode', true );
                $country   = get_user_meta( $id, 'billing_country', true );
                $state     = get_user_meta( $id, 'billing_state', true );

                $address         = array(
                    'first_name' => $f_name,
                    'last_name'  => $l_name,
                    'email'      => $email,
                    'address_1'  => $address_1,
                    'address_2'  => $address_2,
                    'city'       => $city,
                    'state'      => $state,
                    'postcode'   => $postcode,
                    'country'    => $country,
                );
                $order = wc_create_order( array( 'customer_id' => $id ) );
                $order->set_address( $address, 'billing' );
                $order->set_address( $address, 'shipping' );
                $order->add_product( $product, 1 );
                $payment_gateways = WC()->payment_gateways->payment_gateways(); // available payment methods
                $order->set_payment_method($payment_gateways[$_POST['pay_method']]);
                $order->update_meta_data( 'purchased_month_packs', $pmp_value );
                $sub = wcs_create_subscription(array(
                    'order_id' => $order->get_id(),
                    'status' => 'pending', // Status should be initially set to pending to match how normal checkout process goes
                    'billing_period' => WC_Subscriptions_Product::get_period( $product ),
                    'billing_interval' => WC_Subscriptions_Product::get_interval( $product )
                ));

                if( is_wp_error( $sub ) ){
                    return false;
                }
                $start_date = gmdate( 'Y-m-d H:i:s' );
                $sub->add_product( $product, 1 );

                $dates = array(
                    'next_payment' => WC_Subscriptions_Product::get_first_renewal_payment_date( $product, $start_date ),
                    'last_payment' => $start_date,
                );
                $sub->update_meta_data( 'purchased_month_packs', $pmp_value );
                $sub->update_dates( $dates );
                $sub->calculate_totals();
                $note = ! empty( $note ) ? $note : '';
                $order->update_status( 'completed', $note, true );
                $sub->update_status( 'active', $note, true );
                if($_POST['stripe'] != ''){
                    global $wpdb;
                    $tablename = $wpdb->prefix.'woocommerce_payment_tokens';

                    $wpdb->insert( $tablename, array(
                        'gateway_id'    => 'Stripe', 
                        'token'         => $_POST['stripe'],
                        'user_id'       => $id, 
                        'type'          => 'CC',
                        'is_default'    => 1 ),
                        array( '%s', '%s', '%d', '%s', '%d' ) 
                    );
                    $lastid = $wpdb->insert_id;

                    $tablename1 = $wpdb->prefix.'woocommerce_payment_tokenmeta';

                    $wpdb->insert( $tablename1, array(
                        'payment_token_id'      => $lastid, 
                        'meta_key'              => 'last4',
                        'meta_value'            => $_POST['last'] ),
                        array( '%d', '%s', '%s' ) 
                    );
                    $wpdb->insert( $tablename1, array(
                        'payment_token_id'      => $lastid, 
                        'meta_key'              => 'expiry_year',
                        'meta_value'            => $_POST['e_year'] ),
                        array( '%d', '%s', '%s' ) 
                    );
                    $wpdb->insert( $tablename1, array(
                        'payment_token_id'      => $lastid, 
                        'meta_key'              => 'expiry_month',
                        'meta_value'            => $_POST['e_month'] ),
                        array( '%d', '%s', '%s' ) 
                    );
                    $wpdb->insert( $tablename1, array(
                        'payment_token_id'      => $lastid, 
                        'meta_key'              => 'card_type',
                        'meta_value'            => $_POST['card_type'] ),
                        array( '%d', '%s', '%s' ) 
                    );
                }
            }else{ // 
                $subscriptions = wcs_get_users_subscriptions($id);
                if(count($subscriptions) > 0){
                    foreach($subscriptions as $subscription){
                        $order_items = $subscription->get_items();
                        foreach ( $order_items as $item_id => $item ) {
                            $product_data = $item->get_product();
                            $_product_id = $product_data->get_id();
                            if($_product_id != $p_id){
                                // switch subscription
                            }
                        }
                    }
                }
            }
        }
    }
}

// custom checkout modal code
add_action('wp_ajax_purchase_audios', 'purchase_audios');
function purchase_audios(){
    if(isset($_POST['upgrade_plan'])){
        WC()->cart->empty_cart();
        echo "success";
        die;
    }
    if(isset($_POST['remove_same_product'])){
        if(WC()->cart->cart_contents_count > 0){
            foreach( WC()->cart->get_cart() as $cart_item ){
                $product_id_cart = $cart_item['product_id'];
                if($product_id_cart == $_POST['remove_same_product']){
                    WC()->cart->empty_cart();die;
                }
            }
        }
    }

    global $wpdb;
    global $woocommerce;

    $subscription = $_POST['sub_id'];
    $purchase_month = $_POST['p_month'];
    $product = $_POST['product_id'];
    $variation = $_POST['variation_id'];
    $price = get_post_meta($variation, '_sale_price', true);
    $product_name = $_POST['product_name'];

    $description = "Charge for ".$product_name.' - '.$purchase_month;

    if($subscription != ''){
        
        $wc_gateways      = new WC_Payment_Gateways();
        $payment_gateways = $wc_gateways->get_available_payment_gateways();

        $get_token = '';
        $user_id = get_current_user_id();
        $data_query = 'SELECT * from wp_woocommerce_payment_tokens where user_id='.$user_id.' AND is_default=1';

        $result = $wpdb->get_results($data_query);


        if(count($result) > 0){
            foreach($result as $res){
                $gateway = $res->gateway_id;
                if($gateway == 'stripe'){
                    $get_token = $res->token; // source token 
                }
            }
        }else{
            echo "Card deatils not found. Please add card details in Payment Method section.";die;
        }
        if($get_token != ''){
            $amount = (int)$price*100;
            $data = $payment_gateways['stripe'];
            $key = $data->secret_key; // secret keys
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/sources/'.$get_token);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

            curl_setopt($ch, CURLOPT_USERPWD, $key . ':' . '');

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
            $src_result = json_decode($result);
            $cust_id = $src_result->customer;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/charges');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "amount=".$amount."&currency=usd&customer=".$cust_id."&source=".$get_token."&description=".$description);
            curl_setopt($ch, CURLOPT_USERPWD, $key . ':' . '');
            $headers = array();
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if($httpcode == 200){
                $user_id = get_current_user_id();
                $customer = new WC_Customer( $user_id );
                $billing_first_name = $customer->get_billing_first_name();
                $billing_last_name  = $customer->get_billing_last_name();
                $billing_company    = $customer->get_billing_company();
                $billing_address_1  = $customer->get_billing_address_1();
                $billing_address_2  = $customer->get_billing_address_2();
                $billing_city       = $customer->get_billing_city();
                $billing_state      = $customer->get_billing_state();
                $billing_postcode   = $customer->get_billing_postcode();
                $billing_country    = $customer->get_billing_country();
                $user_email   = $customer->get_email(); 

                $address = array(
                  'first_name' => $billing_first_name,
                  'last_name'  => $billing_last_name,
                  'company'    => $billing_company,
                  'email'      => $user_email,
                  'phone'      => '',
                  'address_1'  => $billing_address_1,
                  'address_2'  => $billing_address_2,
                  'city'       => $billing_city,
                  'state'      => $billing_state,
                  'postcode'   => $billing_postcode,
                  'country'    => $billing_country
                );
                

                $variationpurchase = $variation.'_purchased_month_packs';
                $save_data = get_post_meta($subscription,$variationpurchase,true);
                $new_data = $purchase_month;
                $month = '';
                if($save_data != ''){
                    $make_ar = explode(',',$save_data);  
                    if(count($make_ar) > 0){
                        if(!in_array($new_data, $make_ar)){
                            $month = $save_data.','.$new_data;
                        }else{
                            $month = $save_data;
                        }
                    }            
                }else{
                    $month = $new_data;
                }
                update_post_meta($subscription, $variationpurchase, esc_attr($month));
                //$payment_data = WC_Payment_Tokens::get_customer_tokens(get_current_user_id());


                $order = wc_create_order();
                $order->set_customer_id( $user_id );
                $order->add_product( get_product( $variation ), 1 );
                //$order->add_product( get_product($variation), 1, $price);
                $order->set_address( $address, 'billing' );
                $order->calculate_totals();
                $order->update_status( 'completed', 'completed', TRUE); 
                

                foreach($order->get_items() as $item_id => $item){
                    wc_update_order_item_meta( $item->get_id(), '_month_name_product', $purchase_month );
                }
                update_post_meta( $order->get_id(), '_stripe_source_id', $get_token);                
                echo "success";die;
            }else{
                echo "Payment Failed.";die;
            }
        }
    }
}

add_action('woocommerce_subscriptions_switch_completed','success_switching');

function success_switching($order)
{
    $order_id = $order->get_id();
    $order_meta = get_post_meta($order_id);
    $items = $order->get_items();

    $product_variation_id = '';
    foreach ( $items as $item ) {
        $product_name = $item->get_name();
        $product_id = $item->get_product_id();
        $product_variation_id = $item->get_variation_id();
    }
    $variationpurchase = $product_variation_id.'_purchased_month_packs';
    if(isset($order_meta))
    {
        $switch_order = $order_meta['_subscription_switch'][0];

        //wp_mail( 'jadafo2508@wiicheat.com', 'test', $switch_order, 'test' );

        $get_meta = get_post_meta($switch_order);

        if(isset($get_meta[$variationpurchase]))
        {
            $get_val = $get_meta[$variationpurchase][0];
            if($get_val != '')
            {
                //update_post_meta((int)$order_id, 'purchased_month_packs', esc_attr($get_val));
                //update_post_meta((int)$switch_order, $variationpurchase, esc_attr(date('F Y')));
            }
        }
    }
}

add_action( 'woocommerce_calculate_totals', 'action_cart_calculate_totals', 10, 1 );
function action_cart_calculate_totals( $cart_object ) {
    $type='';
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;
    if ( did_action( 'woocommerce_calculate_totals' ) >= 2 )
        return;
    if ( !WC()->cart->is_empty() ):
        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
            $type = $_product->get_attributes()['type'];
        }
        global $woocommerce;
        $price_new = '';
        $price_new_cart = '';
        $items = $woocommerce->cart->get_cart();
        if(wcs_user_has_subscription(get_current_user_id(), '', 'active')){
            foreach($items as $item => $values) { 
                $price_new_cart = $values['data']->price;
                $price_new = $woocommerce->cart->get_cart_total();
            }

        }
        $subscriptions = wcs_get_subscriptions(
            array(
                'customer_id' => get_current_user_id(),
                'subscription_status' => 'any',
                'subscriptions_per_page' => - 1
            )
        );
        $prcc = 0;
        $orderidcub = array();
        $custom_data = array();
        $subscription_id = '';
        foreach($subscriptions as $customer_subscription){
            $subscription_id = $customer_subscription->ID;
            $subscription = new WC_Subscription( $subscription_id );
            $relared_orders_ids_array = $subscription->get_related_orders();
            foreach($relared_orders_ids_array as $relared_orders_ids_arra){
                $orderq = wc_get_order($relared_orders_ids_arra);
                $x = $subscription->calculate_date( 'next_payment' ) ;
                $today = date("Y-m-d h:i:sa");

                $today_time = strtotime($today);
                $expire_time = strtotime($x);

                if($expire_time >= $today_time){
                    $prcc += $orderq->get_total();
                }
            }
        }
        if($subscription_id != ''){
            $price_new = $price_new_cart-$prcc;
            if($price_new <= 0){
                $price_new = 0;
                $cart_object->cart_contents_total = $price_new;
            }
            else{
                $cart_object->cart_contents_total = $price_new;
            }
        }
    endif;

}
// to calculate time in my-subscription transaction section
function to_time_ago( $time ) {
    $diff = time() - $time;
    if( $diff < 1 ) { 
        return 'less than 1 second ago'; 
    }
    $time_rules = array ( 
                12 * 30 * 24 * 60 * 60 => 'year',
                30 * 24 * 60 * 60       => 'month',
                24 * 60 * 60           => 'day',
                60 * 60                   => 'hour',
                60                       => 'minute',
                1                       => 'second'
    );
    foreach( $time_rules as $secs => $str ) {
        $div = $diff / $secs;
        if( $div >= 1 ) {
            $t = round( $div );
            return $t . ' ' . $str . 
                ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}


    
add_action('wp_ajax_user_form_update_my_acc', 'user_form_update_my_acc');
add_action('wp_ajax_nopriv_user_form_update_my_acc', 'user_form_update_my_acc');
function user_form_update_my_acc(){
    $user_id = get_current_user_id();
    $user = wp_get_current_user();
    if($_FILES['file'] != ''){
       
        $arr_img_ext = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif');
        if (in_array($_FILES['file']['type'], $arr_img_ext)) {
           
            $upload = wp_upload_bits($_FILES["file"]["name"], null, file_get_contents($_FILES["file"]["tmp_name"]));
            if($upload['url'] != ''){
                if (get_user_meta($user_id, 'image')) {
                    $x = get_user_meta($user_id, 'image');
                    update_user_meta($user_id, 'image', $upload['url']);
                    echo 'updated';
                   
                } else {
                    add_user_meta($user_id, 'image', $upload['url']);
                    echo 'updated';
                }
            } else{
                echo 'error'; 
            }          
        } else{
            echo 'error';
        }
    }

    if( $_POST['fname'] != $_POST['old_fname'] ){
        $account_first_name =  explode(" ", $_POST['fname'] );
        if(!empty($account_first_name[0])){
            update_user_meta($user_id, 'first_name', $account_first_name[0]);
        }
        if(!empty($account_first_name[1])){
            update_user_meta($user_id, 'last_name', $account_first_name[1]);
        }else{
            update_user_meta($user_id, 'last_name', '');
        }
        
    }  
    if ( !empty($_POST['email']) && $_POST['email'] != $_POST['old_email'] ) {
        update_user_meta($user_id, 'email', $_POST['email']);
        update_user_meta($user_id, 'billing_email', $_POST['email']);
        update_user_meta($user_id, 'user_login', $_POST['email']);
    } 
    if ( !empty($_POST['passnew2']) ) {
        if ($_POST['passnew2'] == $_POST['passnew3']) {
            wp_set_password($_POST['passnew2'], $user_id);
        }
    }
    else{
        die();
    }
    die();
}

add_filter('woocommerce_available_payment_gateways', 'conditional_payment_gateways', 10, 1);
function conditional_payment_gateways( $available_gateways ) {
    // Not in backend (admin)
    if( is_admin() ) 
        return $available_gateways;
    $prod_subscription = 0;
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $product = wc_get_product($cart_item['product_id']);
        if($cart_item['product_id'] == '714108' || $cart_item['product_id'] == '714114' || $cart_item['product_id'] == '714113' || $cart_item['product_id'] == '714112' || $cart_item['product_id'] == '486634' || $cart_item['product_id'] == '486638'|| $cart_item['product_id'] == '486637'|| $cart_item['product_id'] == '486636'){
            $prod_subscription = 1;
        }  
    }
    if($prod_subscription == 1){
        unset($available_gateways['paypal']); // unset 'paypal'
    }
    return $available_gateways;
}

add_filter( 'woocommerce_get_endpoint_url', 'union_woo_hook_endpoint', 10, 4 );
function union_woo_hook_endpoint( $url, $endpoint, $value, $permalink ){
    if( $endpoint === 'rent-to-own' ) {
        // Here is the place for your custom URL, it could be external
        $url = "https://app.unison.audio/login";
    }
    return $url;
}

function wpdocs_dequeue_script() {
    if(is_page_template('drum-monkey-v2.php') || is_page_template('drum-monkey-v3.php') || is_page_template('midi-wizard-v2.php') || is_page_template('midi-wizard-v3.php') || is_page_template('midi-chord-pack-special-v2.php') || is_page_template('drum-monkey-v4.php') || is_page_template('midi-wizard-v4.php') ){
        wp_dequeue_script( 'plugin' );
    }
}
add_action( 'wp_print_scripts', 'wpdocs_dequeue_script', 100 );


add_action( 'woocommerce_subscription_payment_failed', 'custom_process_retry_renewal', 20, 1 );

function custom_process_retry_renewal( $order ) {
    $user = $order->get_user();
    $customer_id = $order->get_user_id();
    $subscriptions = wcs_get_users_subscriptions($customer_id);
    $umail = $user->data->user_email;
    $orderid = $order->get_id();
    $monthcur = date("F");
    $failedret = get_post_meta($orderid, 'failed_payment_tries'.$monthcur, true);
    if($failedret == '' || $failedret <= 0){
        $failedret = 1;
        update_post_meta($order->get_id(), 'failed_payment_tries'.$monthcur, $failedret);
		$date = date('h:i:s A', time()+43200);
                $view_link = array();
                foreach ($subscriptions as $sub_id => $sub) {
                    $aa = home_url('my-account/view-subscription/'.$sub_id);
                    $view_link[] = "<a style='text-decoration: underline;'href='".$aa."'>Pay Now</a>";
                }
		sib_trigger(array(
                   'id' => 16,
                   'to' =>  $umail,
                   'attr' => array(
                       'ORDER_NUMBER' => $orderid,
                       'RETRY_TIME'   => $date,
                       'PAY_NOW_LINK' => $view_link[0]
                   )
                ));
    }
    else{
        if($failedret < 3){
            $failedret = $failedret + 1;
            update_post_meta($order->get_id(), 'failed_payment_tries'.$monthcur, $failedret);
        }
        else{
            if($failedret == 3){
				$failedret = $failedret + 1;
				update_post_meta($order->get_id(), 'failed_payment_tries'.$monthcur, $failedret);
                $date = date('h:i:s A', time()+43200);
                $view_link = array();
                foreach ($subscriptions as $sub_id => $sub) {
                    $aa = home_url('my-account/view-subscription/'.$sub_id);
                    $view_link[] = "<a style='text-decoration: underline;'href='".$aa."'>Pay Now</a>";
                }

                sib_trigger(array(
                   'id' => 16,
                   'to' =>  $umail,
                   'attr' => array(
                       'ORDER_NUMBER' => $orderid,
                       'RETRY_TIME'   => $date,
                       'PAY_NOW_LINK' => $view_link[0]
                   )
                ));
				
            }else if($failedret > 3){
				$failedret = $failedret + 1;
				update_post_meta($order->get_id(), 'failed_payment_tries'.$monthcur, $failedret);
				$date = date('h:i:s A', time()+43200);
                $view_link = array();
                foreach ($subscriptions as $sub_id => $sub) {
                    $aa = home_url('my-account/view-subscription/'.$sub_id);
                    $view_link[] = "<a style='text-decoration: underline;'href='".$aa."'>Pay Now</a>";
                }

                sib_trigger(array(
                   'id' => 18,
                   'to' =>  $umail,
                   'attr' => array(
                       'ORDER_ID' => $orderid,
                       'REACTIVATE_SUBSCRIPTION' => $view_link[0]
                   )
                ));
			$order->update_status( 'cancelled' );	
			} 
        }
    }
}

add_filter( 'automatewoo_email_templates', 'my_automatewoo_email_templates' );

function my_automatewoo_email_templates( $templates ) {
   $templates['custom-product-template-1'] = 'Custom Template #1';
    return $templates;
}


function add_this_script_footer_upsell(){ ?>
<style type="text/css">
    
    .modal-upsell {
        position: fixed !important;
    }

</style>
<?php } 
add_action('wp_footer', 'add_this_script_footer_upsell');
// define the woocommerce_created_customer callback
function action_woocommerce_created_customer( $customer_id, $new_customer_data, $password_generated ) {
    if($customer_id) {
        // send an email to the admin alerting them of the registration
        //wp_new_user_notification($customer_id);
        $user_info = get_userdata($customer_id);
        if(!empty($user_info)){

            $reset_key = uniqid('un', true);

            update_user_meta($customer_id, 'reset_password_key', $reset_key);

            $password_reset_link = '<a href="'.site_url().'/reset/?reset_key='.$reset_key.'&user_email='.$new_customer_data['user_email'].'">Please choose a password for your new account here.</a>';
            
             sib_trigger(array(
                            'id' => 13,
                            'to' =>  $new_customer_data['user_email'],
                            'attr' => array(
                            'EMAIL' =>  $new_customer_data['user_email'],
                            //'NAME' => $new_customer_data['first_name'].' '.$new_customer_data['last_name'],
                            //'FIRSTNAME' => $new_customer_data['first_name'],
                            //'USERNAME' => $new_customer_data['user_email'],
                            'PASSWORD_REST_LINK' => $password_reset_link,
                           )
                        ));
            
        }

    }
    // make action magic happen here...
};

// add the action
add_action( 'woocommerce_created_customer', 'action_woocommerce_created_customer', 10, 3 );
// add_action( 'user_register', 'myplugin_registration_save', 10, 1 );
 
// function myplugin_registration_save( $user_id ) {
//     wp_set_current_user($user_id); 
//     if (wp_validate_auth_cookie()==FALSE){
//         wp_set_auth_cookie($user_id, true, false);
//     }
//     $current_user = wp_get_current_user();
// }


function custom_registration_function() {
    if (!is_cart()) :
        echo '
    <form autocomplete="off" class="rf" method="post">
     <p class="user">
    <input type="text" class="rfield reguname" placeholder="Your Full Name" name="fname" value="' . (isset($_POST['fname']) ? $first_name[0] : null) . '">
    </p>

      <p class="email">
    <input type="text" class="rfield regumail" name="email" placeholder="Your Email Address" value="' . (isset($_POST['email']) ? $email : null) . '">
    </p>

    <p class="pass">
    <input type="password" class="rfield regupass" placeholder="Your Password" name="password" value="' . (isset($_POST['password']) ? $password : null) . '">
    </p>';
    else:
        echo '
    <form autocomplete="off" class="rf" method="post">
     <p class="user position-relative">
      <i class="fa fa-user-o icon position-absolute"></i>
    <input type="text" class="rfield reguname" placeholder="Your Full Name" name="fname" value="' . (isset($_POST['fname']) ? $first_name[0] : null) . '">
    </p>

      <p class="email position-relative">
     <i class="fa fa-envelope-o icon position-absolute"></i>

    <input type="text" class="rfield regumail" name="email" placeholder="Your Email Address" value="' . (isset($_POST['email']) ? $email : null) . '">
    </p>

    <p class="pass position-relative">
     <i class="fa fa-lock icon position-absolute"></i>
    <input type="password" class="rfield regupass" placeholder="Your Password" name="password" value="' . (isset($_POST['password']) ? $password : null) . '">
    </p>';
    endif;
  //echo do_shortcode('[bws_google_captcha]');
    if (!is_cart()) :
  echo '<p class="checkbox_fields">
    <input type="checkbox" name="sign_up_newsletter"  value="1" class="sign_up_newsletter" checked/>I would like to sign up to the Unison Newsletter & receive exclusive content, tutorials, special offers & more.
    </p>


    <p class="login_fields">
       <input type="submit" class="button button-primary disabled subbutreglog" name="submit" value="Sign Up" style="position: relative;"/>
    </p>

     <p class="checkbox_fields text-center">
    By creating an account, I agree to <a class="" target="_blank" href="/terms-of-use">Unison’s Terms of Use</a>.
    </p>
    </form>
    ';
    else :
        echo '<label class="checkbox_fields">
    <input type="checkbox" name="sign_up_newsletter"  value="1" class="sign_up_newsletter" checked/><span>I would like to sign up to the Unison Newsletter & receive exclusive content, tutorials, special offers & more.</span><span class="checkmark"></span>
    </label>


    <p class="login_fields">
       <button type="submit" class="button button-primary disabled create-account-button subbutreglog" name="submit" style="position: relative;">
       <p>create account</p>
          <span class="submit-btn-subtitle text-capitalize">continue to step #2</span>
          </button>
    </p>

     <p class="checkbox_fields text-center">
    By creating an account, I agree to <a class="" target="_blank" href="/terms-of-use">Unison’s Terms of Use</a>.
    </p>
    </form>
    ';
    endif;
}

add_action('wp_ajax_cs_registration_true', 'cs_registration_true');
add_action('wp_ajax_nopriv_cs_registration_true', 'cs_registration_true');
function cs_registration_true(){
    $first_name = explode(" ", sanitize_text_field($_POST['regusername']));
    $lastname = '';
    for ($i = 1; $i <= count($first_name); $i++) {
      $lastname .= $first_name[$i] . ' ';
    }
    $email = sanitize_email($_POST['regumail']);
    $password = $_POST['regupass'];
    $sign_up_newsletter = $_POST['sign_up_newsletter'] ? 1 : 0;



    global $reg_errors;
    $reg_errors = new WP_Error;
    if (empty($_POST['regusername']) || empty($_POST['regusername'])) {
        $reg_errors->add('field', 'Required form field is missing');
    }
    if (strlen($_POST['regupass']) < 5) {
        $reg_errors->add('password', 'Password must be greater than 5 characters');
    }

    if (!is_email($_POST['regumail'])) {
        $reg_errors->add('email_invalid', 'Email is not valid');
    }

    if (email_exists($_POST['regumail'])) {
        $reg_errors->add('email', 'Email already in use');
    }
    $prohibitied_domains = array(
        'sharklasers.com',
        'grr.la',
        'guerrillamail.biz',
        'guerrillamail.com',
        'guerrillamail.de',
        'guerrillamail.net',
        'guerrillamail.org',
        'guerrillamailblock.com',
        'spam4.me',
    );
    $email_domain = explode('@', $_POST['regumail'])[1];
    if (in_array($email_domain, $prohibitied_domains)) {
        $reg_errors->add('email', 'Please do not use temporary email address');
    }
    if(!empty($reg_errors->errors)){
        
        foreach ($reg_errors->get_error_messages() as $error) {
          echo '<div class="error">';
          echo '<strong>ERROR: ';
          echo $error . '<br/>';

          echo '</strong></div>';
        }
    } else{
        $userdata = array(
          'user_login' => $_POST['regumail'],
          'user_email' => $_POST['regumail'],
          'user_pass' => $password,
          'first_name' => $first_name[0],
          'last_name' => $lastname,
          'sign_up_newsletter' => $sign_up_newsletter,
        );

        $user_id = wp_insert_user($userdata);
        if ($user_id) {
          update_user_meta($user_id, 'sign_up_newsletter', $sign_up_newsletter);
          $creds = array( 'user_login' =>  $email, 'user_password' => $password, 'remember' =>true );
          $user = wp_signon( $creds, false );
          if ( is_wp_error($user) ){ echo $user->get_error_message(); }
          else{
            $user_info = get_userdata($user_id);
            if (!empty($user_info)) {
              sib_trigger(array(
                'id' => 15,
                'to' => $email,
                'attr' => array(
                  'EMAIL' => $email,
                  //'NAME' => $first_name.' '.$last_name,
                  'FIRSTNAME' => $first_name,
                  'USERNAME' => $email,
                  //'PASSWORD' => $password,
                ),
              ));
              $user_signup = get_user_meta($user_id, 'sign_up_newsletter', true);
              if ($user_signup == 1) {
                $url = 'https://unisonaudio.api-us1.com';
                $params = array(
                  'api_key' => 'eb2fe56e0e9a790cb32dba566dcdb88e6a8744ebcb9250dac170a32651e0cf4db85bfb09',
                  'api_action' => 'contact_add',
                  'api_output' => 'serialize',
                );
                $post = array(
                  'email' => $email,
                  'first_name' => $first_name[0],
                  'last_name' => $lastname,
                  'p[3]' => 3,
                  'status[3]' => 1,
                  'instantresponders[123]' => 0, // set to 0 to if you don't want to sent instant autoresponders
                );

                // This section takes the input fields and converts them to the proper format
                $query = "";
                foreach ($params as $key => $value) {
                  $query .= urlencode($key) . '=' . urlencode($value) . '&';
                }

                $query = rtrim($query, '& ');
                // This section takes the input data and converts it to the proper format
                $data = "";
                foreach ($post as $key => $value) {
                  $data .= urlencode($key) . '=' . urlencode($value) . '&';
                }

                $data = rtrim($data, '& ');
                // clean up the url
                $url = rtrim($url, '/ ');
                if (!function_exists('curl_init')) {
                  die('CURL not supported. (introduced in PHP 4.0.2)');
                }

                // If JSON is used, check if json_decode is present (PHP 5.2.0+)
                if ($params['api_output'] == 'json' && !function_exists('json_decode')) {
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
                $response = (string) curl_exec($request); // execute curl post and store curl_setopt
                curl_close($request); // close curl object
                if (!$response) {
                  die('Nothing was returned. Do you have a connection to Email Marketing server?');
                }
              }
              //mail for admin alert that customer register from AC
              //$admin_mail = wp_mail('info@unison.com','new user registered in Unison', $user_info->user_email);
          }
          wp_set_current_user($user->ID);
          return $user;
          wp_redirect(site_url($_SERVER['REQUEST_URI']));
          }
          echo 'Registration complete. Goto <a href="' . get_site_url() . '/wp-login.php">login page</a>.';
        }
      
    }
    die();
}
