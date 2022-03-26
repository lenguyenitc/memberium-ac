<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <title><?php wp_title("-", true, 'right');
          bloginfo('name'); ?></title>
  <!-- SEO -->
  <!-- Spiders must use meta description -->
  <meta name="robots" content="noodp, noydir">
  <!-- No Google Translate toolbar -->
  <meta name="google" content="notranslate">
  <!-- Viewport and mobile -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="HandheldFriendly" content="true">
  <meta name="MobileOptimized" content="320">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/png" href="<?php bloginfo('template_url') ?>/favicon.png" />
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/main.css">
  <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/animate.css">
  <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/libs/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/libs/owlcarousel/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/libs/owlcarousel/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/libs/modal/sweetalert.css">
  <!-- endinject -->
  <!--[if lt IE 9]>-->
  <!--<script src="assets/js/ie.head.min.js"></script>
    <link rel="stylesheet" href="assets/css/ie.min.css">-->
  <!--<![endif]-->
  <!-- Prefetch DNS for external assets -->

  <link rel="dns-prefetch" href="//www.google.com">
  <link rel="dns-prefetch" href="//fonts.googleapis.com">
  <link rel="dns-prefetch" href="//www.google-analytics.com">
  <link rel="dns-prefetch" href="//ajax.googleapis.com">
  <link rel="dns-prefetch" href="//fonts.googleapis.com">
  <link rel="dns-prefetch" href="//www.googletagmanager.com">
  <link rel="dns-prefetch" href="//www.googleadservices.com">

  <link rel="dns-prefetch" href="//www.facebook.com">
  <link rel="dns-prefetch" href="//connect.facebook.net">

  <link rel="dns-prefetch" href="//trackcmp.net">
  <link rel="dns-prefetch" href="//cdn.jsdelivr.net">

  <!-- END Prefetch DNS for external assets -->
  <?php
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
  wp_head(); ?>
  <!-- Google Tag Manager -->
  <!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-KM35ZH5');</script> -->
  <!-- End Google Tag Manager -->
  <script>
    jQuery(document).on('click', '.bookings', function(event) {
      event.preventDefault();

      jQuery('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top
      }, 1000);
    });
  </script>
</head>
<?php if (is_page('downloads')) {
  $bodyClass = 'woocommerce';
}
?>

<body <?php post_class($bodyClass); ?>>
  <?php $script_base_url = site_url(); ?>
  <script type="text/javascript">
    var script_base_url = '<?php echo $script_base_url; ?>';
  </script>
  <header>
    <div class="contain">
      <a href="/" class="logo"></a>
      <?php wp_nav_menu(
        array(
          'theme_location' => 'header_menu',
          'container' => 'nav',
          'items_wrap' => '<ul id="nav">%3$s</ul>',
        )
      ); ?>
      <div class="r-ct">
        <!--  <span class="btn-search"></span> -->
        <div class="user  has-dropdown ">

          <?php $user_id = get_current_user_id(); ?>
          <?php

          $first_name = get_user_meta($user_id, 'first_name', true);
          $last_name = get_user_meta($user_id, 'last_name', true);
          if (empty($first_name)) {
            $first_name = get_user_meta($user_id, 'nickname', true);
          }
          if (is_user_logged_in()) {
            echo "<a href='/my-account/' class='btn-user'></a><div class='submenu'><p>Hey, " . $first_name . " " . $last_name . "!</p><a href='/my-account/'>Account Overview</a>";
            wp_loginout(home_url());
            echo "</div>";
          } else {
            echo "<a href='#' class='btn-user js-check-login js-page-profile' data-login-header='1'></a>";
          }
          ?>
        </div>
        <div class="cart-header">
          <a href="/cart/" class="btn-cart <?php  //if ( !is_user_logged_in() ) { echo "js-check-login";}
                                            ?>"></a>
          <span id="cart-counts" class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>

        </div>
        <div class="loc">
          <?php dynamic_sidebar('currency'); ?>
        </div>
      </div>
    </div>
    <span class="btn-menu--mobile"></span>
  </header>