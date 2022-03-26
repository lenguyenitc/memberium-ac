<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta id="viewport" name="viewport"
        content="width=device-width,user-scalable=no,initial-scale=1,minimum-scale=1,maximum-scale=1">
    <title><?php wp_title("-", true, 'right');
        bloginfo('name'); ?></title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" type="image/png" href="<?php bloginfo('template_url') ?>/favicon.png" />
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
    <?php
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    wp_head(); ?>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KM35ZH5');</script>
    <!-- End Google Tag Manager -->

</style>
</head>
<?php if (is_page('downloads')) {
    $bodyClass = 'woocommerce';
}
global $post;
?>

<body class="bg-dark  <?php echo $post->post_name; ?> <?php if (is_order_received_page()) echo 'order-received'; if (is_product()) echo 'individual-product-page'; ?>">

    <?php $script_base_url = site_url(); ?>
    <script type="text/javascript">
    var script_base_url = '<?php echo $script_base_url; ?>';
    </script>

<!-- Header -->
<header>

    <!-- Desktop navigation -->
    <div class="desktop-nav">
        <div class="container p-0">
            <div class="col-12 p-0">
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <a class="navbar-brand" href="/">
                            <img class="logo" src="<?php bloginfo('template_url') ?>/assets/images/logo/Logo-150.png" alt="Logo">
                        </a>
                    </div>
                    <nav class="navbar navbar-expand-xxl navbar-dark bg-dark " >
                        <?php wp_nav_menu(
                        array(
                            'theme_location' => 'header_menu',
                            'container' => 'div',
                            'container_class' => 'collapse navbar-collapse',
                            'container_id' => 'collapsingNavbar',
                            'menu_class' => 'navbar-nav mx-auto text-uppercase nav-items-font-size',
                            'add_li_class' => 'nav-item',
                            'link_class' => 'nav-link'
                        )
                    ); ?>
                    </nav>
                    <div>
                        <div class="navbar navbar-collapse" id="collapse_target1">
                            <ul class="navbar-nav navbar-top mx-auto text-uppercase align-items-center">
                                <div class="row nav-icons">
                                    <li class="nav-item dropdown text-center">
                                        <?php $user_id = get_current_user_id(); ?>
                                        <?php

                                        $first_name = get_user_meta($user_id, 'first_name', true);
                                        $last_name = get_user_meta($user_id, 'last_name', true);
                                        $last_name = str_replace(' ', '', $last_name);
                                        if (empty($first_name)) {
                                            $first_name = get_user_meta($user_id, 'nickname', true);
                                        } ?>
                                        <?php if (is_user_logged_in()) { ?>
                                        <a class="nav-link my-2" id="dropdownMenu" href="/my-account/">
                                            <img src="<?php bloginfo('template_url') ?>/assets/images/user-icon-h17.svg"
                                                alt="User">
                                        </a>
                                        <div class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenu">
                                            <p class="border-bottom border-light pb-3 mb-2">
                                                Hey, <?php echo $first_name; ?> <?php echo $last_name; ?></p>
                                            <a class="dropdown-item" href="/my-account/"
                                                title="Accound Overview">Account
                                                Overview</a>
                                            <?php wp_loginout(home_url()); ?>
                                        </div>
                                        <?php } else {
                                        echo "<a class='nav-link js-check-login js-page-profile' href='#' data-login-header='1'><img src='" . get_bloginfo("template_url") . "/assets/images/user-icon-h17.svg' alt='User'></a>";
                                    } ?>
                                    </li>
                                    <li class="nav-item text-center">
                                        <a class="nav-link my-2 position-relative openCart" href="">
                                            <img class="d-inline-block"
                                                src="<?php bloginfo('template_url') ?>/assets/images/shoping-cart-h17.svg"
                                                alt="Cart">
                                            <span id="cart-counts" class="tooltip-text position-absolute bg-danger">
                                    <?php echo WC()->cart->get_cart_contents_count(); ?>
                                    </span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Mobile navigation -->
    <div class="mobile-nav">
        <div style="padding-right:20px">
            <div class="col-12">
                <div class="row d-flex justify-content-between">
                    <div>
                        <nav class="navbar navbar-expand-xxl navbar-dark bg-dark">
                            <a class="navbar-brand" href="/">
                                <img class="logo-mobile" width="115px" src="<?php bloginfo('template_url') ?>/assets/images/logo/Logo-150.png" alt="Logo">
                            </a>
                            <?php wp_nav_menu(
                            array(
                                'theme_location' => 'header_menu',
                                'container' => 'div',
                                'container_class' => 'side-menu',
                                'menu_class' => 'navbar-nav mx-auto text-uppercase nav-items-font-size',
                                'add_li_class' => 'nav-item',
                                'link_class' => 'nav-link'
                            )
                        ); ?>
                        </nav>
                    </div>
                    <div>
                        <div class="navbar navbar-collapse" id="collapse_target1">
                            <ul class="navbar-nav nav-icons navbar-top mx-auto text-uppercase align-items-center">
                                <div class="row">
                                    <li class="nav-item dropdown text-center">
                                        <?php $user_id = get_current_user_id(); ?>
                                        <?php

                                    $first_name = get_user_meta($user_id, 'first_name', true);
                                    $last_name = get_user_meta($user_id, 'last_name', true);
                                    $last_name = str_replace(' ', '', $last_name);
                                    if (empty($first_name)) {
                                        $first_name = get_user_meta($user_id, 'nickname', true);
                                    } ?>
                                        <?php if (is_user_logged_in()) { ?>
                                        <a class="nav-link my-2" id="dropdownMenu" href="#">
                                            <img src="<?php bloginfo('template_url') ?>/assets/images/user-icon-h17.svg"
                                                alt="User">
                                        </a>
                                        <div class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenu">
                                            <p class="border-bottom border-light pb-3 mb-2">Hey,
                                                <?php echo $first_name; ?> <?php echo $last_name; ?> </p>
                                            <a class="dropdown-item" href="/my-account"
                                                title="Accound Overview">Account
                                                Overview</a>
                                            <?php wp_loginout(home_url()); ?>
                                        </div>
                                        <?php } else {
                                        echo "<a class='nav-link js-check-login js-page-profile' href='#' data-login-header='1'><img src='" . get_bloginfo("template_url") . "/assets/images/user-icon-h17.svg' alt='User'></a>";
                                    } ?>
                                    </li>
                                    <li class="nav-item text-center ccount">
                                        <a class="nav-link my-2 position-relative openCart" href="">
                                            <img class="d-inline-block"
                                                src="<?php bloginfo('template_url') ?>/assets/images/shoping-cart-h17.svg"
                                                alt="Cart">
                                            <span id="cart-counts" class="tooltip-text position-absolute bg-danger"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                                        </a>
                                    </li>
                                    <button class="navbar-toggler collapsed" type="button" id="sidebarCollapse"
                                        data-toggle="collapse" data-target="#collapsingNavbar"
                                        aria-controls="collapsingNavbar" aria-label="Toggle navigation">
                                        <span class="text-white">MENU</span>
                                        <!-- <span class="text-white menu-close">MENU</span> -->
                                        <span class="navbar-toggler-icon-burger"></span>
                                        <span class="navbar-toggler-icon-close"></span>
                                    </button>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
