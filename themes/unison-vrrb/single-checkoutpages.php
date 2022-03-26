<?php
/*
 * Template Name: Custom Checkout Page Template
 *
 * */
?>

<link href="<?php echo site_url(); ?>/wp-content/plugins/custom-multiple-checkout/cs-front-checkout.css"
    rel="stylesheet">
<link rel="shortcut icon" type="image/png" href="https://unison.audio/wp-content/themes/unison-vrrb/favicon.png">
<?php
global $wpdb;
$post_id = get_the_ID();
/*$disable_top_bar = get_post_meta($post_id, 'csmultiplecheckout_disable_top_bar', true);
if (empty($disable_top_bar)) {
    ?>
<div class="cs_checkout_top_bar">
    <?php
        $cs_chk_option_sec_top_bar = get_option('chkoption_sectopbar');
        ?>
    <p><?php echo $cs_chk_option_sec_top_bar; ?></p>
</div>
<?php
}*/
get_header('cart');
global $wpdb;
$post_id = get_the_ID();
$meta_key = 'csmultiplecheckout_product_bundle';
$product_ids_arr = get_post_meta($post_id, $meta_key, true);
$disable_partial_pay = get_post_meta($post_id, 'csmultiplecheckout_disable_partial_pay_for_this_page', true);
$disable_testimonials = get_post_meta($post_id, 'csmultiplecheckout_disable_testimonials_for_this_page', true);

$logo = get_field('logo', $post_id);
$bullet_text = get_field('bullet_text', $post_id);

$cs_chk_option_page_heading = get_option('chkoption_page_heading');
$cs_chk_option_sub_heading_left = get_option('chkoption_subheadingleft');
$cs_chk_option_sub_heading_right = get_option('chkoption_subheadingright');
$cs_chk_option_total_heading = get_option('chkoption_totalheading');
$cs_chk_option_special_heading = get_option('chkoption_specialheading');
$cs_chk_option_single_heading = get_option('chkoption_singleheading');
$cs_chk_option_monthly_heading = get_option('chkoption_monthlyheading');
$cs_chk_option_one_time_heading = get_option('chkoption_onetimeheading');
$cs_chk_option_partial_heading = get_option('chkoption_partialheading');
$cs_chk_option_testimonial_heading = get_option('chkoption_testimonialheading');

$cs_chk_option_sec_left_heading = get_option('chkoption_secleftheading');
$cs_chk_option_sec_left_desc = get_option('chkoption_secleftdesc');
$cs_chk_option_sec_left_img = get_option('chkoption_secleftimg');

$cs_chk_option_sec_right_heading = get_option('chkoption_secrightheading');
$cs_chk_option_sec_right_desc = get_option('chkoption_secrightdesc');
$cs_chk_option_sec_right_img = get_option('chkoption_secrightimg');

$cs_chk_option_sec_payment = get_option('chkoption_secpaytext');
$cs_chk_option_sec_payment_icon = get_option('chkoption_secpayimage');

$testimonials_data = get_post_meta($post_id, 'csmultiplecheckout_testimonials', true);

$color_schemes = get_post_meta($post_id, 'csmultiplecheckout_prices_key', true);
$cs_sepecial_launch_color = $color_schemes['cs_sepecial_launch_color'];
$cs_checkoutbuttons_box_sahdow = $color_schemes['cs_checkoutbuttons_box_sahdow'];
?>
<style type="text/css">
body.checkoutpages .cs_checkout_form_section .gform_footer input[type="image"],
.cs_checkout_form_section form .gform_page_footer input[type="image"],
.modal_popup_checkout button#popup_special_offer_btn {
    box-shadow: <?php echo !empty($cs_checkoutbuttons_box_sahdow) ? '0px 8px 22px 0px '. $cs_checkoutbuttons_box_sahdow . ' !important': '';
    ?>;
}
</style>
<div class="jumbotron checkout text-white bg-secondary py-3">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center d-flex align-items-center justify-content-center flex-sm-row">
                <img src="<?php bloginfo('template_url') ?>/assets/images/secure_checkout h37.svg"
                    class="secure-checkout-image" alt="Secure Checkout">
                <h1>Secure checkout</h1>
            </div>
        </div>
    </div>
</div>
<main class="flex-grow-1 midi-box-checkout">
    <section id="cart_woo" class="p-0">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-12 mx-auto">
                    <!-- <div class="woocommerce-notices-wrapper"></div> -->
                    <div class="row flex-lg-row flex-xs-column-reverse flex-sm-column-reverse pt-sm-5 pt-3">
                        <div class="col-xxxl-7 col-lg-6 col-sm-12 bg-black text-center checkout-container">
                            <?php if ($logo) : ?>
                            <img class="img-fluid midi-box-img" src="<?php echo $logo; ?>" alt="MIDI Box Logo">
                            <?php endif; ?>
                            <h4>Here's what <span class="text-success">you'll
                                    get</span>:</h4>
                            <?php if ($bullet_text) : ?>
                            <div class="row checklist">
                                <ul class="w-100" style="padding: 0 15px">
                                    <?php foreach ($bullet_text as $key => $text) :
                                        // if ($key == 0) :
                                        //     echo '<div class="col-xs-12 col-sm-12 col-lg-6 col-xxxl-7">';
                                        // elseif ($key == 5) :
                                        //     echo '<div class="col-xs-12 col-sm-12 col-lg-6 col-xxxl-5">';
                                        // endif; 
                                    ?>
                                    <li class="checklist-row">
                                        <i class="<?php echo $text['bullet_class'];?> text-success"></i>
                                        <p class="text-white"><?php echo $text['bullet_text'];?></p>
                                    </li>
                                    <?php
                                        // if ($key == 4 || $key == 9) :
                                            // echo '</div>';
                                        // endif;
                                    endforeach; ?>
                                </ul>
                            </div>
                            <?php else :?>
                            <div class="row checklist">
                                <div class="col-xs-12 col-sm-12 col-lg-6 col-xxxl-7">
                                    <div class="checklist-row">
                                        <i class="fa fa-check text-success"></i>
                                        <p class="text-white">​The Ultimate Shortcut To Producing Hit Songs</p>
                                    </div>
                                    <div class="checklist-row">
                                        <i class="fa fa-check text-success"></i>
                                        <p class="text-white">​​800 Unique, Drag & Drop MIDI Files Every Month</p>
                                    </div>
                                    <div class="checklist-row">
                                        <i class="fa fa-check text-success"></i>
                                        <p class="text-white">​​Chord Progressions, Melodies, Basslines & Drums</p>
                                    </div>
                                    <div class="checklist-row">
                                        <i class="fa fa-check text-success"></i>
                                        <p class="text-white">​​5 Free Exclusive Bonuses</p>
                                    </div>
                                    <div class="checklist-row">
                                        <i class="fa fa-check text-success"></i>
                                        <p class="text-white">​​30-Day Money-Back Guarantee</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-lg-6 col-xxxl-5">
                                    <div class="checklist-row">
                                        <i class="fa fa-check text-success"></i>
                                        <p class="text-white">​​Made For All Genres Of Music</p>
                                    </div>
                                    <div class="checklist-row">
                                        <i class="fa fa-check text-success"></i>
                                        <p class="text-white">​​​Compatible With All DAWs</p>
                                    </div>
                                    <div class="checklist-row">
                                        <i class="fa fa-check text-success"></i>
                                        <p class="text-white">​Works With Both Mac & PC</p>
                                    </div>
                                    <div class="checklist-row">
                                        <i class="fa fa-check text-success"></i>
                                        <p class="text-white">​​100% Royalty-Free</p>
                                    </div>
                                    <div class="checklist-row">
                                        <i class="fa fa-check text-success"></i>
                                        <p class="text-white">​​​Use With Any Sounds</p>
                                    </div>
                                </div>
                            </div>
                            <?php endif;?>
                            <div class="row">
                                <?php
                                if (!empty($product_ids_arr)) {
                                    foreach ($product_ids_arr as $key => $product_id) {
                                        $product = wc_get_product($product_id);
                                        $get_name = $product->get_name();
                                        $get_image = $product->get_image('woocommerce_thumbnail',array('class' => 'img-fluid'));
                                        $get_price = $product->get_price();
                                        $total_price += $get_price;
                                        if (metadata_exists('post', $product_id, 'csmultiplecheckout_product_license')) {
                                            $get_license_keys = array();
                                            $get_license_keys = get_post_meta($product_id, 'csmultiplecheckout_product_license', true);
                                            if (!empty($get_license_keys)) {
                                                $key_arr = array('');
                                                foreach ($get_license_keys as $key => $value) {
                                                    $key_arr[] = $value['key'];
                                                }
                                                ?>
                                <div class="col-xxxl-6 col-sm-12">
                                    <div class="bg-secondary border-radius-10">
                                        <div class="bonus-card d-flex">
                                            <div class="col-auto text-left pl-0">
                                                <?php echo $get_image; ?>
                                            </div>
                                            <div class="col text-white text-left pl-0 d-flex flex-column align-self-center" style="gap: 10px;">
                                                <p><?php echo $get_name; ?></p>
                                                <p><?php echo wc_price($get_price); ?> value</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                            }
                                        } else {
                                            $key_arr = array();
                                            ?>
                                <div class="col-xxxl-6 col-sm-12">
                                    <div class="bg-secondary border-radius-10">
                                        <div class="bonus-card d-flex">
                                            <div class="col-auto text-left pl-0">
                                                <?php echo $get_image; ?>
                                            </div>
                                            <div class="col text-white text-left pl-0 d-flex flex-column align-self-center" style="gap: 10px;">
                                                <p><?php echo $get_name; ?></p>
                                                <p><?php echo wc_price($get_price); ?> value</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }
                                    }
                                }
                                $price_data = get_post_meta($post_id, 'csmultiplecheckout_prices_key', true);
                                $order_total = !empty($price_data['cs_price_total_min']) ? $price_data['cs_price_total_min'] : $total_price;

                                $order_total_min = $price_data['cs_price_total_min'];
                                $order_total_max = $price_data['cs_price_total_max'];

                                $partial_total = !empty($price_data['cs_price_partial_min']) ? $price_data['cs_price_partial_min'] : ($total_price / 3);

                                $partial_total_min = $price_data['cs_price_partial_min'];
                                $partial_total_max = $price_data['cs_price_partial_max'];

                                $product_bundle_title = !empty($price_data['cs_product_bundle_title']) ? $price_data['cs_product_bundle_title'] : '';
                                $hidden_bundle_product_title = $price_data['cs_product_bundle_title'];
                                ?>
                            </div>
                            <div class="row limited-offer mx-auto">
                                <div class="col-12 text-center text-white">
                                    <h6 style="padding-bottom: 9px;"><?php echo $cs_chk_option_total_heading; ?></h6>
                                    <h2 class="text-pink"><?php echo wc_price($total_price); ?></h2>
                                    <h5><span class="text-success"><?php echo $cs_chk_option_special_heading; ?></span>
                                    </h5>
                                    <?php echo $cs_chk_option_single_heading; ?>
                                    <?php if (!empty($order_total_min) && !empty($order_total_max)) { ?>
                                    <div class="row d-flex justify-content-center">
                                        <p class="price-warning">
                                            <s><?php echo wc_price($order_total_max); ?></s>
                                        </p>
                                        <div>
                                            <span
                                                class="new-price font-weight-bold"><?php echo wc_price($order_total_min); ?></span>
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                    <div class="row d-flex justify-content-center">
                                        <div>
                                            <span
                                                class="new-price font-weight-bold"><?php echo wc_price($order_total / 3); ?></span><span
                                                class="month">/month</span>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <?php if (!empty($partial_total_min) && !empty($partial_total_max) && empty($disable_partial_pay)) { ?>
                                    <div class="row d-flex justify-content-center">
                                        <?php echo $cs_chk_option_monthly_heading; ?>
                                        <p class="old-price price-warning mr-0 mr-sm-2">
                                            <s><?php echo wc_price($partial_total_max); ?></s>
                                        </p>
                                        <div>
                                            <span
                                                class="new-price font-weight-bold"><?php echo wc_price($partial_total_min); ?></span><span
                                                class="month">/month</span>
                                        </div>
                                    </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-xxxl-5 col-lg-6 col-sm-12 text-center">
                            <div class="container p-0 bg-white payment-box">
                                <div class="complete-order-title">
                                    <h4 class="text-dark text-center"><?php echo $cs_chk_option_sub_heading_right; ?>
                                    </h4>
                                </div>
                                <?php
                                $currentpageid = get_the_ID();
                                if (is_user_logged_in()) {
                                    $current_user = wp_get_current_user();
                                    $user_id = get_current_user_id();
                                    $firstname = $current_user->first_name;
                                    $user_email = $current_user->user_email;
                                    echo do_shortcode('[gravityform id="6" field_values="currentuserid=' . $user_id . '&hidden_bundle_product_title=' . $hidden_bundle_product_title . '&currentpageid=' . $currentpageid . '&probundletitle=' . $product_bundle_title . '&onetimeamount=' . $order_total . '&partialamount=' . ($partial_total) . '&getusername=' . $firstname . '&getuseremail=' . $user_email . '" title="false" description="false" ajax="true"]');
                                } else {
                                    echo do_shortcode('[gravityform id="5" field_values="currentpageid=' . $currentpageid . '&hidden_bundle_product_title=' . $hidden_bundle_product_title . '&probundletitle=' . $product_bundle_title . '&onetimeamount=' . $order_total . '&partialamount=' . ($partial_total) . '" title="false" description="false" ajax="true"]');
                                }
                                ?>
                            </div>
                            <div class="access-note">
                                <p>Access will be sent to your email & granted in your Unison account.
                                </p>
                                <div class="credit-card-icons"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row secure-payment">
                        <div class="col-xxxl-7 col-lg-6 col-sm-12 text-center text-lg-left">
                            <div class="media flex-column flex-lg-row text">
                                <!--<div class="col-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 col-xxxl-3">-->
                                    <img class="img-fluid"
                                        src="<?php echo isset($cs_chk_option_sec_left_img) && $cs_chk_option_sec_left_img ? $cs_chk_option_sec_left_img : bloginfo('template_url') . '/assets/images/checkout-money-back.svg'; ?>"
                                        alt="60 Days Money Back Guarantee">
                                <!--</div>-->
                                <!--<div class="col-8 col-lg-8 col-md-12 col-sm-12 col-xs-12 col-xxxl-9">-->
                                    <div class="media-body">
                                        <h5><?php echo $cs_chk_option_sec_left_heading; ?></h5>
                                        <p class="text-white"><?php echo $cs_chk_option_sec_left_desc; ?></p>
                                    </div>
                                <!--</div>-->
                            </div>
                        </div>
                        <div class="col-xxxl-5 col-lg-6 col-sm-12 text-center text-lg-left">
                            <div class="media flex-column flex-lg-row">
                                <!--<div class="col-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">-->
                                    <img class="img-fluid"
                                        src="<?php echo isset($cs_chk_option_sec_right_img) && $cs_chk_option_sec_right_img ? $cs_chk_option_sec_right_img : bloginfo('template_url') . '/assets/images/checkout-secure.svg'; ?>"
                                        alt="Secure Payment">
                                <!--</div>-->
                                <!--<div class="col-8 col-lg-8 col-md-12 col-sm-12 col-xs-12">-->
                                    <div class="media-body">
                                        <h5><?php echo $cs_chk_option_sec_right_heading; ?></h5>
                                        <p class="text-white"><?php echo $cs_chk_option_sec_right_desc; ?></p>
                                    </div>
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script type="text/javascript">
$(document).ready(function() {
    $('#gform_next_button_5_5').attr('src', '/wp-content/uploads/2021/09/01_new_correction_w.svg');
});
$(document).on('gform_post_render', function() {
    var errortext = $('#gform_5').find('.validation_error').text();
    if (errortext != 'undefined' && errortext != '') {
        $('#gform_next_button_5_5').attr('src', '/wp-content/uploads/2021/09/01_new_correction_w.svg');
    } else {
        $('#gform_submit_button_5').attr('src', '/wp-content/uploads/2021/09/02_new_w.svg');

    }
});
</script>
<script type="text/javascript">
//Paypal radio shift to bottom
jQuery(document).on('gform_post_render', function() {
    update_price_on_change_form();
    jQuery('.cs_chk_already_have_ac').remove();
    jQuery("#gform_6 .gform_footer").after(
        '<div class="cs_chk_already_have_ac mt-0">Your order is processed through a secure payment network.</div>'
    );
    jQuery("#gform_page_5_2 .gform_page_footer").after(
        '<div class="cs_chk_already_have_ac mt-0">Your order is processed through a secure payment network.</div>'
    );

    // Login link append
    jQuery("#gform_page_5_1 .gform_page_footer").after(
        '<div class="cs_chk_already_have_ac">Already have an account? <a href="#" class="cs-checkout-btn-user" data-login-header="1"> Click here to login</a></div>'
    );
    // Update paypal radio position
    update_payment_form_radio();
    var errortext = jQuery('#gform_6').find('.validation_error').text();
    if (errortext != 'undefined' && errortext != '') {
        jQuery('.validation_error').remove();
        jQuery("#field_6_14").after(
            '<div class="validation_error">There was a problem with your submission. Errors have been highlighted below.</div>'
        );
    }

    //Custom header integrated to the form 6
    jQuery('.cs_gform6_header_sction').remove();
    jQuery('.cs_payment_step_first_gfrom').remove();
    jQuery("#gform_6 .gform_body").before(
        '<div id="gf_page_steps_5" class="gf_page_steps cs_gform6_header_sction"><div id="gf_step_5_1" class="gf_step gf_step_first gf_step_completed gf_step_previous"><span class="gf_step_number">1</span>&nbsp;<span class="gf_step_label">ACCOUNT <span class="gf_sub_step">Already Logged-In</span></span></div><div id="gf_step_5_2" class="gf_step gf_step_active gf_step_last"><span class="gf_step_number">2</span>&nbsp;<span class="gf_step_label">PAYMENT <span class="gf_sub_step">Get Access Now</span></span></div><div class="gf_step_clear"></div></div>'
    );   


});

function update_payment_form_radio() {
    var selectedValue = jQuery('input[name="input_7"]:checked').val();
    if (selectedValue == 'Stripe') {
        jQuery('.gchoice_5_7_1').removeAttr('style');
        jQuery('.gchoice_6_7_1').removeAttr('style');

        jQuery('#input_5_7').css('position', 'relative');
        // jQuery('.gchoice_5_7_1').css('position', 'absolute');
        jQuery('.gchoice_5_7_1').css('position', 'relative');


        jQuery('#input_6_7').css('position', 'relative');
        // jQuery('.gchoice_6_7_1').css('position', 'absolute');
        jQuery('.gchoice_6_7_1').css('position', 'relative');


        if (jQuery(window).width() < 767) {
            // jQuery('.gchoice_5_7_1').css('bottom', '-475px');
            jQuery('#gform_page_5_2').css('bottom', '-505px');
            //jQuery('.gchoice_6_7_1').css('bottom', '-505px');
        } else if (jQuery(window).width() > 640 && jQuery(window).width() < 1023 ) {
            // jQuery('.gchoice_5_7_1').css('bottom', '-475px');
            //jQuery('#gform_page_5_2 .gchoice_5_7_1').css('bottom', '-444px');
            //jQuery('.gchoice_6_7_1').css('bottom', '-444px');
        }else {
            // jQuery('.gchoice_5_7_1').css('bottom', '-370px');
            jQuery('#gform_page_5_2').css('bottom', '-355px');
            // jQuery('.gchoice_6_7_1').css('bottom', '-355px');
            jQuery('.gchoice_6_7_1').css('bottom', '0px');
        }

    } else {
        jQuery('.gchoice_5_7_1').removeAttr('style');
        jQuery('.gchoice_6_7_1').removeAttr('style');
        jQuery('.gchoice_5_7_1').css('width', '100%');
        jQuery('.gchoice_6_7_1').css('width', '100%');

    }
}

function update_price_on_change_form() {
    jQuery('input[name="input_10.2"]').val('<?php echo $partial_total; ?>');
    jQuery('input[name="input_11.2"]').val('<?php echo $order_total; ?>');
    jQuery('input[name="input_10.1"]').val('<?php echo $hidden_bundle_product_title; ?>');
    jQuery('input[name="input_11.1"]').val('<?php echo $hidden_bundle_product_title; ?>');
}

jQuery(document).on('change', '#gform_5,#gform_6', function() {
    if (event.target.name == 'input_7') {
        update_payment_form_radio();
        update_price_on_change_form();
    }
});
</script>
<?php if (!is_user_logged_in()) { ?>
<script type="text/javascript">
// Trigger popup login
if (jQuery('body').hasClass('type-checkoutpages')) {
    jQuery('.user.has-dropdown ').find('a').addClass('cs-checkout-btn-user');
    jQuery('.user.has-dropdown ').find('a').removeClass('js-page-profile');
    jQuery('.user.has-dropdown ').find('a').removeClass('js-check-login');
}
jQuery(document).on('click', '.cs-checkout-btn-user', function(e) {
    e.preventDefault();
   // if (jQuery('body').hasClass('type-checkoutpages')) {
        jQuery('div#account').show();
        jQuery('div#account').find('h4').hide();
        jQuery('.create-account').css("display", "none");
        jQuery('.login').show();
        jQuery('.login').addClass('display');
        jQuery('.tab-account li').addClass('selected');
        jQuery('.tab-account li + li').removeClass('selected');
        jQuery('.tab-account li + li').css("display", "none");
        jQuery('div#account').css("opacity", "1");
    //}
});
</script>
<?php } ?>

<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('header').find('.contain').find('.logo').css('cursor', 'auto');
    jQuery('header').find('.contain').find('.logo').attr('href', '');
    jQuery('header').find('.contain').find('.logo').on('click', function(e) {
        e.preventDefault();
        //jQuery(this).focus();
    });

});
</script>
<!-- Popup -->
<?php
$page_id = get_the_ID();
$popup_content = get_post_meta($page_id, 'checkout_popup_content', true);
$popup_enable = get_post_meta($page_id, 'checkout_enable_popup', true);
// $post_page = get_post(155950);
// $post_content = $post_page->post_content;
if (!empty($popup_content) && $popup_enable[0] == 'enable') {
    ?>
<!-- Trigger/Open The Modal -->
<!-- <button id="myBtn">Open Modal</button> -->
<div id="myModal" class="modal_popup_checkout">
    <div class="modal-content">
        <span class="close">&times;</span>
        <?php echo $popup_content; ?>
    </div>
</div>
<?php } ?>
<script type="text/javascript">
// Get the modal
var modal = document.getElementById("myModal");
//var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
var spanclose = document.getElementsByClassName("popup_special_offer_btn")[0];

jQuery(window).load(function() {
    Cookies.set('popupcookie', 'show');
    //jQuery(document).mousemove(function(){
    var popupcookie = Cookies.get('popupcookie');
    //if (popupcookie == 'show') {
    if (jQuery(window).width() < 1023) {
        window.onscroll = function(e) {
            setTimeout(function() {
                if (jQuery(window).scrollTop() > 100 && Cookies.get('popupcookie') == 'show') {
                    console.log(jQuery(window).scrollTop());
                    modal.style.display = "block";
                    Cookies.set('popupcookie', 'hide');
                }
            }, 4000);
        };
    } else {
        setTimeout(function() {
            jQuery("body").mousemove(function(event) {
                var top_appearance = event.pageY;
                //console.log(Cookies.get('popupcookie'));
                if (top_appearance < 100 && Cookies.get('popupcookie') == 'show') {
                    modal.style.display = "block";
                    Cookies.set('popupcookie', 'hide');
                }
            });
        }, 5000);
    }
    //}
    //Cookies.set('popupcookie', 'hide');
    //});
});
/*btn.onclick = function() {
      modal.style.display = "block";
    }*/
span.onclick = function() {
    modal.style.display = "none";
}
spanclose.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<script type="text/javascript">
<?php if (empty($disable_partial_pay)) { ?>
jQuery(window).load(function() {
    const payparams = new URLSearchParams(window.location.search);
    console.log(payparams.get('pay'));
    para_val = payparams.get('pay');
    var query_val = para_val.replace(/-/g, " ");
    console.log(query_val);
    //var selected_val = 'Partial Pay';
    if (query_val != '') {
        jQuery('input:radio[name="input_6"][value="' + query_val + '"]').prop('checked', true);
        //jQuery('input:radio[name="input_6"]').trigger('click');
        //jQuery('input:radio[name="input_6"][value="'+query_val+'"]').trigger('change');
    }
});

jQuery(document).on('change', 'input[name="input_6"]', function() {
    var selected_val = jQuery(this).val();
    var res = selected_val.replace(/ /g, "-");
    console.log(selected_val);
    if (history.pushState) {
        var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname +
            '?pay=' + res;
        window.history.pushState({
            path: newurl
        }, '', newurl);
    }
});
<?php } ?>
</script>
<!-- Popup -->
<style type="text/css">
<?php if ( !empty($disable_partial_pay)) {

    ?>ul#input_6_6 li.gchoice_6_6_1,
    ul#input_5_6 li.gchoice_5_6_1 {
        display: none !important;
    }

    <?php
}

$csmultiplecheckout_chkout_button_boxsahdow = $color_schemes['cs_checkoutbuttons_box_sahdow'];
if($csmultiplecheckout_chkout_button_boxsahdow==''){
    $csmultiplecheckout_chkout_button_boxsahdow = '#768cea';    
}

$csmultiplecheckout_chkout_button_bgcolor = $color_schemes['cs_checkoutbuttons_bg_color'];
if($csmultiplecheckout_chkout_button_bgcolor==''){
    $csmultiplecheckout_chkout_button_bgcolor = '#1cbaa4';
}

$csmultiplecheckout_chkout_button_bgcolor_hover = $color_schemes['cs_checkoutbuttons_bg_color_hover'];
if($csmultiplecheckout_chkout_button_bgcolor_hover==''){
    $csmultiplecheckout_chkout_button_bgcolor_hover = '#1cbaa4';
}

?>

input#gform_next_button_5_5,
input#gform_submit_button_5,
input#gform_submit_button_6{
    background: <?php echo $csmultiplecheckout_chkout_button_bgcolor; ?> !important;
    border-radius:4px;
    box-shadow:0px 8px 22px 0px <?php echo $csmultiplecheckout_chkout_button_boxsahdow; ?> !important;
    height:auto;
    opacity:1;
}

input#gform_next_button_5_5:hover,
input#gform_submit_button_5:hover,
input#gform_submit_button_6:hover{
    background:<?php echo $csmultiplecheckout_chkout_button_bgcolor_hover; ?> !important;
}

div#cs_drawer_main_nav {
    display: none;
}

.gf_browser_chrome {
    display: block !important;
}

.cs_checkout_bundle_container,
.cs_checkout_bundle_product_item {
    width: 100%;
    margin: 0 auto;
    clear: both;
}

.cs_checkout_bundle_one_half {
    width: 50%;
    float: left;
    padding: 0 50px;
}

.cs_checkout_bundle_one_third {
    width: 33%;
    float: left;
    padding: 0 50px;
}

.cs_checkout_bundle_two_thirds {
    width: 66%;
    float: left;
    padding: 0 50px;
}

.cs_checkout_bundle_page h1,
.cs_checkout_bundle_product_listing h3 {
    text-align: center;
    color: #ffffff;
}

.cs_checkout_bundle_product_item,
.cs_checkout_bundle_products_total {
    clear: both;
}

form#gform_1,
form#gform_2 {
    color: #00c1a7;
}

.cs_checkout_form_section {
    background: #737366;
    padding: 18px 20px;
}

.cs_chkot_pay_type p input[type="radio"] {
    width: 20px;
    margin-right: 10px;
    height: 20px;
    background: black;
}

body.type-checkoutpages nav.menu-main-menu-container {
    display: none;
}

body.type-checkoutpages header .r-ct .cart-header {
    display: none;
}

/*11-04-2020*/
.cs_add_payment_logos_to_form .ginput_container_radio {
    width: 100%;
}

.cs_add_payment_logos_to_form {
    flex-flow: column !important;
}

.cs_add_payment_logos_to_form>div>ul>li {
    display: flex !important;
    align-items: center !important;
    flex-flow: row !important;
    justify-content: flex-start !important;
    height: 48px !important;
}

.cs_add_payment_logos_to_form ul li label {
    padding-left: 35px !important;
    margin-left: 10px !important;
}

.cs_add_payment_logos_to_form ul li label::before {
    content: "";
    position: absolute;
    left: 10px;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    border: 1px solid #01BFA3;
    top: 16px;
    display: block;
}

.cs_add_payment_logos_to_form ul li input[type="radio"] {
    -webkit-appearance: none !important;
}

.cs_add_payment_logos_to_form ul li input[type="radio"]:checked::after {
    content: "";
    position: absolute;
    left: 13px;
    width: 9px;
    height: 9px;
    border-radius: 50%;
    background: #01BFA3;
    top: 19px;
}

.ginput_container_creditcard .gform_card_icon_container {
    position: absolute;
    top: -206px;
    left: 50%;
    transform: translate(-50%);
    background: url('https://unison.audio/wp-content/uploads/2020/05/creditcard_img.png') no-repeat center center;
    background-size: 100%;
    display: none;
}

.ginput_container_creditcard {
    position: relative;
}

.ginput_container_creditcard .gform_card_icon_container>div {
    opacity: 0;
    visibility: hidden;
}

.cs_add_payment_logos_to_form ul>li {
    border: 1px solid #DBDBDB;
    border-radius: 5px 5px 0 0;
    padding: 12px !important;
    width: 100%;
}

.cs_add_payment_logos_to_form ul li label::after {
    width: 160px;
    height: 55px;
    position: absolute;
    top: -5px;
    left: 95%;
    transform: translate(-100%);
}

.ginput_card_security_code_icon {
    display:none !important;
}

@media (max-width:767px) {
   li#field_6_6  .cs_paytype_radio, 
   li#field_6_6 .cs_price_radio, 
   #input_5_6 .gchoice_5_6_0 .cs_paytype_radio, 
   #input_5_6 .gchoice_5_6_1 .cs_paytype_radio,
   #input_5_6 .gchoice_5_6_0 .cs_price_radio, 
   #input_5_6 .gchoice_5_6_1 .cs_price_radio {
       display:inline !important;
   }
   #gform_submit_button_5{
        padding: 10px 0 !important;
        margin-bottom: 10px;
   }
}
.cs_add_payment_logos_to_form ul li input[value="Stripe"]+label::after {
    content: "";
    background: url('https://unison.audio/wp-content/uploads/2020/05/creditcard_img.png') no-repeat center center;
    background-size: 100%;
    display: block;
}

.cs_add_payment_logos_to_form ul li input[value="Paypal"]+label::after {
    content: "";
    display: block;
    background: url('https://unison.audio/wp-content/uploads/2020/05/paypal_img.jpg') no-repeat center center;
    background-size: 65%;
}

.cs_add_payment_logos_to_form ul>li {
    width: 100%;
}

body.type-checkoutpages .text_center.copy_wrap {
    border-top: 1px solid #303030 !important;
}

body.type-checkoutpages footer {
    display: none !important;
}

body.type-checkoutpages {
    padding-bottom: 0 !important;
}

body.type-checkoutpages div#playbar {
    display: none !important;
}

input#gform_previous_button_5 {
    display: none !important;
}

.gform_page_footer {
    margin-top: 0 !important;
    display: none;
}

/*.sc-payment-icons {
        max-width: 381px;
        width: 70%;
        margin: auto;
        display: block;
    }*/

.cs_chk_payment_badges {
    /*border-bottom: 1px solid #333;*/
    /*padding-bottom: 30px;*/
}

 .payment-box form input::-webkit-input-placeholder {
  color: #000;
  font-weight: 500;
}
.payment-box form input:-ms-input-placeholder {
  color: #000;
  font-weight: 500;
}
.payment-box form input::placeholder {
  color: #000;
  font-weight: 500;
}

@media (max-width: 1000px) {

    /*header .r-ct .btn-user {
            display: none;
        }*/
    .cs_checkout_top_bar p {
        font-size: 13px !important;
    }

    .sc-payment-icons {
        max-width: 381px;
        width: 70%;
        margin: auto;
        display: block;
    }

    .cs_checkout_bundle_page .cs_checkout_bundle_container:nth-child(2) .cs_checkout_bundle_one_half .cs_checkout_bundle_product_listing .cs_checkout_bundle_product_item .cs_checkout_bundle_one_third img {
        height: auto;
    }

    .cs_checkout_bundle_page .cs_checkout_bundle_container:nth-child(2) .cs_checkout_bundle_one_half .cs_checkout_bundle_product_listing .cs_checkout_bundle_product_item.my_cs_licensed_product_item .cs_checkout_bundle_one_third img {
        height: auto;
    }
}
</style>

<?php
get_footer();