<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta id="viewport" name="viewport"
        content="width=device-width,user-scalable=no,initial-scale=1,minimum-scale=1,maximum-scale=1">
    <title><?php wp_title("-", true, 'right'); bloginfo('name'); ?></title>
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

</head>
<?php if (is_page('downloads')) {
    $bodyClass = 'woocommerce';
}
?>


<body class="bg-dark d-flex flex-column vh-100">
    <?php

    if ( 'checkoutpages' == get_post_type() ){
        $post_id = get_the_ID();
        $disable_top_bar = get_post_meta($post_id, 'csmultiplecheckout_disable_top_bar', true);
        if (empty($disable_top_bar)) {
            ?>
        <div class="cs_checkout_top_bar">
            <?php
                $cs_chk_option_sec_top_bar = get_option('chkoption_sectopbar');
                ?>
            <p><?php echo $cs_chk_option_sec_top_bar; ?></p>
        </div>
        <?php
        }
    }

    ?>
    <!-- Header -->
    <header>
        <!-- Mobile navigation -->
        <div class="mobile-nav">
            <div style="padding-right:20px">
                <div class="col-12">
                    <div class="row d-flex justify-content-between">
                        <div>
                            <nav class="navbar navbar-expand-xxl navbar-dark bg-dark">
                                <a class="navbar-brand" href="/">
                                    <img class="logo-mobile"
                                        src="/wp-content/uploads/2021/09/Unison-Logo-Cropped.png" width="100px" alt="Logo">
                                </a>
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
                                                    <?php echo $first_name; ?><?php echo $last_name; ?> </p>
                                                <a class="dropdown-item" href="/my-account"
                                                    title="Accound Overview">Account
                                                    Overview</a>
                                                <?php wp_loginout(home_url()); ?>
                                            </div>
                                            <?php } else {
                                            echo "<a class='nav-link js-check-login js-page-profile' href='#' data-login-header='1'><img src='" . get_bloginfo("template_url") . "/assets/images/user-icon-h17.svg' alt='User'></a>";
                                        } ?>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Desktop navigation -->
        <div class="desktop-nav">
            <div class="container p-0">
                <div class="col-12 p-0">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <a class="navbar-brand" href="/">
                                <img class="logo" src="<?php bloginfo('template_url') ?>/assets/images/logo-svg.svg"
                                    alt="Logo">
                            </a>
                        </div>
                        <nav class="navbar navbar-expand-xxl navbar-dark bg-dark">
                        </nav>
                        <div>
                            <div class="navbar navbar-collapse" id="collapse_target1">
                                <ul class="navbar-nav navbar-top mx-auto text-uppercase align-items-center">
                                    <div class="row nav-icons">
                                        <li class="nav-item dropdown text-center">
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
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
