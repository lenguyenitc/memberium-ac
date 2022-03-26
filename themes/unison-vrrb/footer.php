<?php
global $wp;
$unison_request = explode( '/', $wp->request );

?>
<!-- Footer -->
<footer class="bg-dark">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-10 col-sm-12 mx-auto">
                    <div class="row justify-content-between align-items-center footer-top-row">
                        <div class="col-sm-12 col-lg-2 col-xl-3 text-center text-xxl-left">
                            <a href="<?php echo home_url()?>" class="d-inline-block">
                                <img class="footer-logo" src="<?php bloginfo('template_url') ?>/assets/images/logo.png"
                                    alt="Logo">
                            </a>
                        </div>
                        <?php wp_nav_menu(array(
                                'theme_location' => 'footer_menu',
                                'container' => 'div',
                                'container_class' => 'text-center col-sm-12 col-lg-7 col-xl-6',
                                'menu_class' => 'navbar-nav text-uppercase flex-row',
                                'add_li_class' => 'nav-item',
                                'link_class' => 'nav-link'
                            )
                        ); ?>
                        <div class="col-lg-3 col-xl-3 text-center text-xxl-right socials">
                            <a target="_blank" href="https://www.facebook.com/unisonaudio" class="ml-0">
                                <img src="<?php bloginfo('template_url') ?>/assets/images/Facebook Icon.svg"
                                    class="img-fluid" alt="Facebook">
                            </a>
                            <a target="_blank" href="https://www.twitter.com/unisonaudio1">
                                <img src="<?php bloginfo('template_url') ?>/assets/images/Twitter icon.svg"
                                    class="img-fluid" alt="Twitter">
                            </a>
                            <a target="_blank" href="https://soundcloud.com/unisonaudio" class="mx-2">
                                <img src="<?php bloginfo('template_url') ?>/assets/images/Soundcloud Icon.svg"
                                    class="img-fluid" alt="SoundCloud">
                            </a>
                            <a target="_blank" href="https://www.youtube.com/channel/UC18ldjj2lV1SLhcZWOPg-Zg">
                                <img src="<?php bloginfo('template_url') ?>/assets/images/Youtube Icon.svg"
                                    class="img-fluid" alt="YouTube">
                            </a>
                            <a target="_blank" href="https://instagram.com/unisonaudio" class="mr-0">
                                <img src="<?php bloginfo('template_url') ?>/assets/images/Instagram Icon.svg"
                                    class="img-fluid" alt="Instagram">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row justify-content-center align-items-center footer-bottom-row">
                <div class="col-auto">
                    <span>© <?php echo date('Y'); ?> Unison.audio</span>
                </div>
                <div class="col-auto">
                    <a href="/terms-of-use/" title="Terms of Use">Terms of Use</a>
                </div>
                <div class="col-auto">
                    <a href="/privacy-policy/" title="Privacy Policy">Privacy Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="overlay"></div>

<?php if (!is_cart()) : ?>
<div class="popup modal-guts" id="account">
    <div class="contain">
        <div class="col-12 text-center">
            <img class="img-login" src="<?php bloginfo( 'template_url' ) ?>/assets/images/logo 1.png" alt="">
        </div>
        <!-- <h4>Account <span>Please Login or Sign Up</span></h4> -->
        <ul class="js-tab--account tab-account">
            <li id="login" class="selected">login</li>
            <li id="signup">Sign Up</li>
        </ul>
        <div class="js-contain--account">
            <div class="login display cs_login_from_wrp">
                <?php global $user_ID, $user_identity;
                wp_get_current_user();
                if ( ! $user_ID ) {
                    ?>
                <?php
                    $args = array(
                        'echo'           => true,
                        'redirect'       => site_url( $_SERVER['REQUEST_URI'] ),
                        'id_username'    => 'user1',
                        'id_password'    => 'pass1',
                        'form_id'        => 'loginform1',
                        'label_username' => __( '' ),
                        'label_password' => __( '' ),
                        'label_remember' => __( '' ),
                        'label_log_in'   => __( 'Login' ),
                        'remember'       => false,
                        'id_submit'      => 'wp-submit1',
                    );
                    $form = wp_login_form( $args );
                    //add the placeholders
                    $form = str_replace( 'id="user1"', 'id="user1" placeholder="Your Email Address..."', $form);
                    $form = str_replace( 'name="pwd"', 'name="pwd" placeholder="Your Password..."', $form );
                    echo $form;

                    ?>
                <form method="post" action="<?php bloginfo( 'url' ) ?>/wp-login.php" class="frmSignIn">
                    <p><a href="#" onclick="ForgetPass()" class="los">Forgot your password?</a></p>
                    <!--  <p class="or"><span>OR</span></p> -->
                    <?php //do_action( 'wordpress_social_login' ); ?>
                </form>
                <?php } ?>

            </div>
            <div class="create-account fvg">
                <?php custom_registration_function(); ?>

                <?php //do_action( 'wordpress_social_login' ); ?>
            </div>
        </div>
        <span class="btn-close js-close-account" id="close-lostpass"></span>
    </div>

    <span class="ovl"></span>
</div>
<?php else: ?>
<div class="popup modal-guts" id="account">
    <div class="contain login-continue">
        <div class="col-12 text-center">
            <img class="img-login" src="<?php bloginfo( 'template_url' ) ?>/assets/images/logo 1.png" alt="">
        </div>
        <div class="js-contain--account">
            <div class="login display cs_login_from_wrp">
                <div
                    class="col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 mx-auto d-flex flex-column m-0 p-0 login-continue">
                    <?php global $user_ID, $user_identity;
                    wp_get_current_user();
                    if ( ! $user_ID ) {
                        $new_args = array(
                            'echo'           => true,
                            'redirect'       => site_url( $_SERVER['REQUEST_URI'] ),
                            'id_username'    => 'user1',
                            'id_password'    => 'pass1',
                            'form_id'        => 'loginform1',
                            'label_username' => __( '' ),
                            'label_password' => __( '' ),
                            'label_remember' => __( '' ),
                            'label_log_in'   => __( 'LOGIN' ),
                            'remember'       => false,
                            'id_submit'      => 'wp-submit1',
                        );
                        $form2 = wp_login_form( $new_args );
                        //add the placeholders
                        $form2 = str_replace( 'name="log"', 'name="log" placeholder="Your Email Address..."', $form2 );
                        $form2 = str_replace( 'name="pwd"', 'name="pwd" placeholder="Your Password..."', $form2 );
                        echo $form2;

                        ?>
                </div>
                <form method="post" action="<?php bloginfo( 'url' ) ?>/wp-login.php" class="frmSignIn">
                    <span class="small-white-text subtextbut"
                        style="font-size: 14px; font-weight:700; line-height: 14px; text-align: center; color: #FFFFFF; opacity: 0.7; position: relative;">Continue
                        To Step #2</span>

                </form>
                <?php } ?>
                <p><a href="#" onclick="ForgetPass()" class="los"
                        style="font-size: 14px; font-weight: bold; text-decoration: underline; text-align: center; color: #787878;">Forgot
                        your password?</a></p>
            </div>
        </div>
        <span class="btn-close js-close-account" id="close-lostpass"></span>
    </div>
    <span class="ovl"></span>
</div>
<?php endif;?>

<div class="popup modal-guts" id="lostpass">
    <div class="contain lostpass-wrap">
        <div class="col-12 text-center">
            <img class="img-forgot" src="<?php bloginfo('template_url')?>/assets/images/logo 1.png" alt="">
            <h5 class="text-dark">Forgot your password?</h5>
        </div>
        <form method="post" id="reset">
            <div class="col-12  mx-auto d-flex flex-column m-0 p-0 text-center">
                <?php $user_email = isset($_POST['user_email']) ? $_POST['user_email'] : ''; ?>
                <input type="text" placeholder="Your Email Address..." name="user_email" id="user_email"
                    value="<?php echo $user_email; ?>" />
                <input type="hidden" name="action" value="reset" />
                <input type="submit" value="Request new password" class="font-weight-bold reset-password-button" />
            </div>
        </form>
        <div id="message"></div>
        <a href="#" class="mx-auto text-center grey-text" onclick="backToLogin()">Back to Login</a>
        <span class="btn-close js-close-account"></span>
    </div>
    <span class="ovl"></span>
</div>

<script>
$(document).ready(function() {
    var modalOverlay = $("#modal-overlay");
    var modalLogin = $("#midi-box-login");
    var closeButtonLogin = $("#close-midi-box-login");
    var openButtonLogin = $("#open-midi-box-login");


    closeButtonLogin.click(function() {
        modalLogin.addClass("closed");
        modalOverlay.addClass("closed");
        closeButtonLogin.addClass("close");
    });

    openButtonLogin.click(function() {
        modalLogin.removeClass("closed");
        modalOverlay.removeClass("closed");
        closeButtonLogin.removeClass("close");
    });
});
</script>

<div class="popup_complete js-popup-message js-popup-complete">
    <p>...</p>
    <span class="btn-close"></span>
</div>
<div class="popup_fail js-popup-message js-popup-fail">
    <p>...</p>
    <span class="btn-close"></span>
</div>
<div id="playbar">
    <!-- Progress -->
    <div id="waveform">
        <canvas width="2049" height="177"></canvas>
    </div>
    <div id="bar"></div>
    <div id="progress"></div>

    <div id="wrapper">
        <!-- Controls -->
        <div class="controlsOuter">
            <div class="controlsInner">
                <div id="loading"></div>

                <div class="button js-defaultsound" id="playBtn"></div>
                <div class="button" id="pauseBtn"></div>
                <div class="button" id="prevBtn"></div>
                <div class="button" id="nextBtn"></div>
            </div>
            <div class="button" id="volumeBtn"></div>
            <div id="timer">0:00</div>
            <div id="duration">0:00</div>
        </div>
        <!-- Volume -->
        <div id="uivolume">
            <span class="ui-slider ui-corner-all ui-slider-vertical ui-widget ui-widget-content">
                <span class="ui-slider-range ui-corner-all ui-widget-header ui-slider-range-min"></span>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
            </span>
        </div>

        <?php global $post, $product; ?>

        <div id="title">
            <p class="thumb"></p>
            <span id="track" class="track"></span>
            <span class="regular-price playbar-regular-price"></span>
            <span class="sale-price price-warning"><s></s></span>
        </div>
        <!-- button for download -->
        <div id="defaultbutton"></div>
        <!-- <div id="cartDownCont"> -->

    </div>
</div>
<div class="audio-wrap js-wrap-audio" id="audio"></div>
</div>
<script type="text/javascript">
function hidePopupLogin() {
    $('#account').velocity({
        opacity: 0
    }, {
        duration: 300,
        complete: function() {
            $(this).velocity({
                opacity: 0
            }, {
                display: 'none'
            })
        }
    });
}

// jQuery(document).ready(function() {
//     if ($('#cart_woo').length) {
//         $('html, body').animate({
//             scrollTop: $('#cart_woo').offset().top + 50
//         }, 2000);
//     }
// });

function ForgetPass() {
    jQuery('#lostpass').addClass('open-forgot');
    jQuery('#lostpass').attr('style', '');
    hidePopupLogin();
}
</script>
<?php

if ( is_product()) {

	$productSlug = getLastPathSegment( $_SERVER['REQUEST_URI'] );
	$product_obj = get_page_by_path( $productSlug, OBJECT, 'product' );
	$music       = get_post_meta( $product_obj->ID, '_music', true ); ?>

<div <?php post_class( "samplepack-item display-no" ); ?>>
    <p>
        <a href="<?php the_permalink(); ?>">
            <?php
				if ( has_post_thumbnail() ) {
					$url = wp_get_attachment_url( get_post_thumbnail_id( $product_obj->ID ), 'thumbnail');

					echo '<img alt="default" class="default-product" src="' . $url . '" />';
				} else {
					echo '<img src="' . get_bloginfo( "template_url" ) . '/images/UnisonLogo.jpg" alt="logo" />';
				}
				?>
        </a>
    </p>
    <div class="copy">
        <h4>
            <a class="js-title-samplepacks default_product_title" data-title="<?php the_title(); ?>"
                href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h4>
        <!-- <h6>Afreaux</h6> -->
        <p class="js-price-text">
            <?php woocommerce_template_loop_price(); ?>
        </p>
        <?php
			echo "<div class='ctas'>";
			$music         = get_post_meta( $product_obj->ID, '_music', true );
			$product_price = get_post_meta( $product_obj->ID, '_price', true );
			echo '<a href="#" class="btn-play default_product_song" id="js-defaultsound" data-file="' . $music . '" data-id="' . $product_obj->ID . '"></a>';
			echo '<div class="button_free default_product_button">';
			if ( $product_price == 0 ) {
                ?>
        <form class="cart" method="post" enctype='multipart/form-data'>
            <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product_obj->ID ); ?>" />
            <button type="submit"
                class="test-button add_cart_btn btn-buy"><?php echo esc_html( 'Add TO Cart free' ); ?></button>
        </form>

        <?php
				// if ( is_user_logged_in() ) {
				// 	// echo do_shortcode( '[download_now id="" text="Download"]' );
				// } else {
				// 	echo '<a href="javascript:void(0)" data-product_title="' . get_the_title() . '" data-quantity="1" data-product_id="' . get_the_ID() . '" data-product_sku="" class="js-check-login btn">Download</a>';
				// }
			} elseif ( $product_price > 0 ) { ?>
        <form class="cart" method="post" enctype='multipart/form-data'>
            <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product_obj->ID ); ?>" />
            <button type="submit"
                class="test-button add_cart_btn btn-buy"><?php echo esc_html( 'Add TO Cart' ); ?></button>
        </form>

        <?php }

			echo '</div>';
			echo '</div>';
			?>
    </div>

</div>
<?php
}

$cat_terms = get_terms( ['taxonomy' => 'product_cat'] );

$defaultloop = new WP_Query( array(
	'post_type'      => 'product',
	'posts_per_page' => 1,
	'order'          => 'DESC',
	'orderby'        => 'ID',
	'tax_query'      => array(
		array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => array($cat_terms),
			'operator' => 'OR'
		),
	),
) );

while ( $defaultloop->have_posts() ):
	$defaultloop->the_post();
    global $post;
    $music = get_post_meta( $post->ID, '_music', true );  ?>
<div <?php post_class( "samplepack-item display-no" ); ?>>
    <p>
        <a href="<?php the_permalink(); ?>">
            <?php
				if ( has_post_thumbnail() ) {
					$url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
					echo '<img alt="default" class="default-product" src="' . $url . '" />';
				} else {
					echo '<img src="' . get_bloginfo( "template_url" ) . '/images/UnisonLogo.jpg" alt="logo" />';
				}
				?>
        </a>
    </p>
    <div class="copy">
        <h4>
            <a class="js-title-samplepacks default_product_title" data-title="<?php the_title(); ?>"
                href="<?php the_permalink(); ?>">
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
            $product_price = get_post_meta(get_the_ID(), '_price', true );

			echo '<a href="#" class="btn-play default_product_song" id="js-defaultsound" data-file="' . $music . '" data-id="' . $post->ID . '"></a>';
			echo '<div class="button_free default_product_button">';

            if ( $product_price == 0 ) { ?>

        <form class="cart" method="post" enctype='multipart/form-data'>
            <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product_obj->ID ); ?>" />
            <button type="submit"
                class="test-button add_cart_btn btn-buy"><?php echo esc_html( 'Add TO Cart free' ); ?></button>
        </form>

        <?php
				// if ( is_user_logged_in() ) {
				// 	// echo do_shortcode( '[download_now id="" text="Download"]' );
				// } else {
				// 	echo '<a href="javascript:void(0)" data-product_title="' . get_the_title() . '" data-quantity="1" data-product_id="' . get_the_ID() . '" data-product_sku="" class="js-check-login btn">Download</a>';
				// }
			} elseif ( $product_price > 0 ) { ?>
        <form class="cart" method="post" enctype='multipart/form-data'>

            <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $post->ID ); ?>" />
            <button type="submit"
                class="test-button add_cart_btn btn-buy"><?php echo esc_html( 'Add TO Cart' ); ?></button>

        </form>

        <?php }

			echo '</div>';
			echo '</div>';
			?>
    </div>

</div>
<?php
endwhile;
wp_reset_query();
?>
<!-- Cart drawer code -->
<?php include('cart-drawer-sidebar.php'); ?>
<style type="text/css">
.sign_up_newsletter {
        width: 16px !important;
        display: inline-block !important;
    }
body.post-7 ul.wc_payment_methods.payment_methods.methods {
    display: flex;
    flex-direction: column;
}

body.post-7 li.wc_payment_method.payment_method_paypal {
    order: 2;
}

.payment_method_paypal div.payment_method_paypal {
    padding: 4rem 10px 8px 10px !important;
    zoom: 1;
    min-height: 50px;
    position: relative;
    border-top: 1px solid #d9d9d9;
    background-color: #fafafa !important;
    font-family: "GothamMedium", Helvetica Neue, Helvetica, Verdana, Roboto, sans-serif !important;
    /* margin-top: -6px !important; */
    border-radius: 4px;
    border: 1px solid #d9d9d9;
    border-top-right-radius: 0;
    border-top-left-radius: 0;
    text-align: center !important;
}


.payment_method_paypal div.payment_method_paypal p {
     font-size: 14px !important;
    font-weight: 400 !important;
}
</style>
<script type="text/javascript">
jQuery('input[name="payment_method"]').each(function() {
    var this_val = jQuery(this).val();
    if (this_val == 'stripe') {
        jQuery(this).prop('checked', true);
        jQuery('.wc_payment_method.payment_method_stripe').trigger('click');
        jQuery('.payment_box.payment_method_stripe').show();
    }
});
</script>
<!-- eND Cart drawer code -->
<div class="cs_get_upsell_producton_ajax"></div>

<!-- POPUP ONLY FOR PRICE PRODUCTS-->
<div class="popupbox popup c_popup">
    <div class="pop_container">
        <span class="btn-close js-close-account"></span>
        <h4>You have added </h4>
        <h4 id="addProductcarttile" class="title"></h4>
        <h4>to your shopping cart.</h4>
        <a href="javascript:void(0)" class="keep_shopping">Continue Shopping</a>
        <a href="/cart" class="pop_cart">Review Cart</a>
    </div>
</div>

<div class="popupbox_already popup c_popup">
    <div class="pop_container">
        <span class="btn-close js-close-account"></span>
        <h4 id="addProductcarttile_already" class="title"></h4>
        <h4> has been alreay added.</h4>
        <a href="javascript:void(0)" class="keep_shopping">Continue Shopping</a>
        <a href="/cart" class="pop_cart">Review Cart</a>
        <div class="checkbox_fields custom_filder">I would like to receive 10% off my first purchase, easy access to
            free products, special offers, and more by signing up to the Unison newsletter.
        </div>
    </div>
</div>

<div class="popup_purchased popup c_popup" style="display: none;">
    <div class="pop_container">
        <span class="btn-close js-close-account"></span>
        <h4 id="addProductcarttile_purchased" class="title"></h4>
        <h4> has already been purchased, you can access this purchase via the ‘Downloads’ button below.</h4>
        <a href="javascript:void(0)" class="keep_shopping">Continue Shopping</a>
        <a href="/my-account/downloads/" class="pop_cart">Downloads</a>
    </div>
</div>
<script type="text/javascript">
$('.pop_container .btn-close').click(function() {
    $('.pop_container .keep_shopping').click();
});

$('#close-lostpass').click(function() {
    $('#lostpass').removeClass('open-forgot');
})
</script>

<script>
$(document).ready(function() {
    $('.bb-b').click(function() {
        location.href = "/cart";
    });
    $('.form-field > label').on('click', function() {
        $('.form-field-wide').hide();
    });
    $('.appointable a').on('click', function() {
        $('.form-field-wide').show();
    });
    $('.ava').on('click', function() {
        $('.av-upload').show();
    });
    $('.close-av-modal').on('click', function() {
        $('.av-upload').hide();
    });
    $('.bookings').click(function() {
        $('form.cart').addClass('active');
    });
    if ($('.create-account div').hasClass('error')) {
        $('div#account').show();
        $('#signup').css("display", "none");
        $('.create-account').show();
        $('.create-account').addClass('display');
        $('#signup').removeClass('selected');
        $('#login').addClass('selected');
        $('.login').removeClass('display');
        $('.login').addClass('d-none');
        $('.tab-account').addClass('d-none');
        $('.create-account').css("opacity", "1");
    }
    var url = $(location).attr('href');
    parts = url.split("/");
    last_part = parts[parts.length - 2];
});
(function($) {

    $(function() {

        $('.rf').each(function() {
            var form = $(this),
                btn = form.find('.btn_submit');

            form.find('.rfield').addClass('empty_field');

            // Функция проверки полей формы
            function checkInput() {
                form.find('.rfield').each(function() {
                    if ($(this).val() != '') {
                        $(this).removeClass('empty_field');
                    } else {
                        $(this).addClass('empty_field');
                    }
                });
            }

            // Функция подсветки незаполненных полей
            function lightEmpty() {
                form.find('.empty_field').css({
                    'border-color': '#d8512d'
                });
                setTimeout(function() {
                    form.find('.empty_field').removeAttr('style');
                }, 500);
            }

            setInterval(function() {
                checkInput();
                var sizeEmpty = form.find('.empty_field').size();
                if (sizeEmpty > 0) {
                    if (btn.hasClass('disabled')) {
                        return false
                    } else {
                        btn.addClass('disabled')
                    }
                } else {
                    btn.removeClass('disabled')
                }
            }, 500);

            btn.click(function() {
                if ($(this).hasClass('disabled')) {
                    lightEmpty();
                    return false
                } else {
                    form.submit();
                }
            });

        });

    });

})(jQuery);
</script>

<!-- CART CHECKOUT STEP1 / SPTEP2 -->
<!-- <script type="text/javascript">
$(document).ready(function() {
    $('#step-1').on('click', function() {
        $('#step-1').addClass('active');
        $('#step-2').removeClass('active');
        $('.select-payment-box').addClass('d-none');
        $('.create-account-box').removeClass('d-none');
    });
    $('#step-2').on('click', function() {
        $('#step-2').addClass('active');
        $('#step-1').removeClass('active');
        $('.select-payment-box').removeClass('d-none');
        $('.create-account-box').addClass('d-none');
    });
});
</script> -->
<script type="text/javascript">
function backToLogin() {
    console.log('back to login')
    // jQuery('#lostpass').addClass('open-forgot');
    // jQuery('#lostpass').attr('style', '');
    $('#account').css({
        opacity: 1,
        display: 'block'
    });
    $('#lostpass').css({
        display: 'none'
    })
}
</script>

<div class="sc-player-engine-container">
    <audio preload="auto"></audio>
</div>
<script type="text/javascript">
jQuery(document).on('submit', '#loginform2', function(e) {
    e.preventDefault();
    var username = jQuery('#loginform2').find('input[name="log"]').val();
    var password = jQuery('#loginform2').find('input[name="pwd"]').val();
    //console.log(username,password);

    if (username != '' && password != '') {
        jQuery.ajax({
            url: afp_vars.afp_ajax_url,
            method: "post",
            data: {
                'action': 'cs_login_details_true',
                'username': username,
                'password': password
            },
            beforeSend: function() {
                jQuery('.my_cs_error_msg').remove();
            },
            success: function(response) {
                //alert(response);
                if (response == 'true' || response == 'damntrue') {
                    location.reload();
                    //window.location.href = "/my-account";
                } else {
                    //jQuery('.my_cs_error_msg').remove();
                    jQuery('#loginform2').prepend(
                        '<p class="login-msg my_cs_error_msg"><strong>ERROR:</strong> Incorrect email or password. Please try again.</p>'
                    );

                }
            }
        });
    } else {location.reload();
        jQuery('.my_cs_error_msg').remove();
        jQuery('#loginform2').prepend(
            '<p class="login-msg my_cs_error_msg"><strong>ERROR:</strong> Enter email and password.</p>');
    }
});
// ajax login authenticate
jQuery(document).on('submit', '#loginform1', function(e) {
    e.preventDefault();
    var username = jQuery('#loginform1').find('input[name="log"]').val();
    var password = jQuery('#loginform1').find('input[name="pwd"]').val();
    var idp = <?php echo get_the_ID(); ?>;
    var homepage ='<?php if(in_array(get_the_ID(),array(498380,498383,498384,500757))){ echo "cartpage"; }else{ echo "myaccount"; }?>';
    var loginRedirect = jQuery('#loginform1').find('input[name="redirect_to"]').val();
    //console.log(username,password);
    if (username != '' && password != '') {
        jQuery('#loginform1 #wp-submit1').val('Loading...');
        jQuery.ajax({
            url: afp_vars.afp_ajax_url,
            method: "post",
            data: {
                'action': 'cs_login_details_true',
                'username': username,
                'password': password,
                'loginRedirect': loginRedirect,


            },
            beforeSend: function() {
                jQuery('.my_cs_error_msg').remove();
            },
            success: function(response) {
                //console.log(response);
                //return false;
                jQuery('#loginform1 #wp-submit1').val('Login');
                // console.log(response);
                //alert(response);
                if(homepage == 'cartpage' && response != 'damntrue'){
                    //alert('tester');
                    window.location.href = loginRedirect;
                }
                else if (response == 'damntrue') {
                    window.location.href = "/my-account/downloads";
                }
                else if(response == 'true'){
                    location.reload();
                    //window.location.href = "/my-account";
                }else {
                    //jQuery('.my_cs_error_msg').remove();
                    //jQuery('p.login_fields').after(response);
                    jQuery('.my_cs_error_msg').remove();
                    jQuery('.cs_login_from_wrp').prepend('<p class="login-msg my_cs_error_msg"><strong>ERROR:</strong> Enter email and password.</p>');
                    return false;
                    //location.reload();

                }
            }
        });
    } else {
        jQuery('.my_cs_error_msg').remove();
        jQuery('.cs_login_from_wrp').prepend(
            '<p class="login-msg my_cs_error_msg"><strong>ERROR:</strong> Enter email and password.</p>');
    }
});
</script>
<script>
$('#user1').attr("placeholder", "Your Email Address...");
$('#pass1').attr("placeholder", "Your Password...");
</script>
<script type="text/javascript">
jQuery('.pop_container .btn-close,.pop_container_download .btn-close').click(function() {
    jQuery('.pop_container .keep_shopping,.pop_container_download .keep_shopping').click();
});

jQuery(window).load(function() {
    jQuery(window).resize();
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('.navbar-toggler').on('click', function() {
        if ($('.overlay').hasClass("active")) {
            $('.overlay').removeClass('active');
        } else {
            $('.overlay').addClass('active');
        }

        if ($('.mobile-nav').hasClass("fixed-top")) {
            $('.mobile-nav').removeClass('fixed-top');
        } else {
            $('.mobile-nav').addClass('fixed-top');
        }

        if ($('body').hasClass("margin-top")) {
            $('body').removeClass('margin-top');
        } else {
            $('body').addClass('margin-top');
        }

        if ($('.side-menu').hasClass("menu-opened")) {
            $('.side-menu').removeClass('menu-opened');
        } else {
            $('.side-menu').addClass('menu-opened');
        }
    });

    /*15-10-2021*/
    $('.nav-link.my-2').on('click', function() {
        if ($('.side-menu').hasClass("menu-opened")) {
            $('.navbar-toggler').trigger("click");
        }
    });
    /*15-10-2021*/

});
</script>

<!--MODAL CANCEL STEP 1-->

<div class="modal-cancel-step1 closed" id="modal-cancel-step1">
    <div class="modal-guts">
        <div class="title">
            <h5 class="text-center">Before You Go, Want To Downgrade Instead?</h5>
            <img class="img-fluid pointer close" src="<?php bloginfo('template_url')?>/assets/images/close-icon.png"
                id='modal-cancel-step1-close'>
        </div>
        <div
            class="row col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 mx-auto justify-content-between content align-items-center col-md-12 col-xs-12 col-sm-12">
            <div class=" col-xxxl-6 col-xxl-6 col-xl-5 col-lg-5 col-md-12 col-xs-12 col-sm-12 text-center">
                 <?php
                if(in_array('view-subscription',$unison_request) && is_account_page())
                {
                ?>
                    <img class="img-fluid tier"
                    src="<?php bloginfo('template_url')?>/assets/images/intro-hero-less-instruments.svg">
                <?php
                }
                ?>
            </div>
            <div
                class="col-xxxl-6 col-xxl-6 col-xl-7 col-lg-7 col-md-12 col-xs-12 col-sm-12  p-0 justify-content-center">

                <p class="p1 font-weight-bold text-white text-left white-green">Here's What <span
                        style="color:#01BFA6;"> You'll Get:</span></p>
                <ul class="row col-xxxl-12  col-xxl-12  col-xl-12 col-lg-12  col-md-12 col-xs-12 col-sm-12 m-0">
                    <div class="col-xxxl-7 col-xxl-7 col-xl-7 col-lg-7  col-md-12 col-xs-12 col-sm-12 pl-0 pr-0">

                        <li class="text-white text-left align-items-center"> <img class="img-fluid"
                                src="<?php bloginfo('template_url')?>/assets/images/correct green.png"> 40 Chord
                            Progressions</p>
                    </div>


                    <div class="col-xxxl-5 col-xxl-5 col-xl-5 col-lg-5 col-md-12 col-xs-12 col-sm-12 pl-0 mt-10-new">
                        <li class="text-white text-left align-items-center"> <img class="img-fluid"
                                src="<?php bloginfo('template_url')?>/assets/images/correct green.png"> 40 Basslines
                        </li>
                    </div>
                    <div class="col-xxxl-7 col-xxl-7 col-xl-7 col-lg-7 col-md-12 col-xs-12 col-sm-12 mt-10 pl-0">
                        <li class="text-white text-left align-items-center"><img class="img-fluid"
                                src="<?php bloginfo('template_url')?>/assets/images/correct green.png"> 40 Melodies</li>
                    </div>
                    <div class="col-xxxl-5 col-xxl-5 col-xl-5 col-lg-5 mt-10 col-md-12 col-xs-12 col-sm-12 pl-0">
                        <li class="text-white text-left align-items-center"><img class="img-fluid"
                                src="<?php bloginfo('template_url')?>/assets/images/correct green.png"> 16 Drum Kits
                        </li>
                    </div>
                </ul>
                <div
                    class="col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-xs-12 col-sm-12 p-0  justify-content-lg-between justify-content-md-center font-weight-bold price text-center ">
                    <div class="row">
                        <p
                            class="text-white  col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-xs-12 col-sm-12  text-lg-left text-md-center mx-auto only">
                            Only <span class="big-green-text">$7/month</span>
                        </p>
                        <p
                            class="text-white today col-xxxl-6  col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-xs-12 col-sm-12  text-lg-left text-md-center mx-auto ">
                            TODAYS TOTAL: <span class="big-green-text">$0</span>
                        </p>
                    </div>
                </div>
                <div class="text-left col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-xs-12 col-sm-12 p-0"
                    id="close-button-cancel-step1">
                    <button class="badge badge-pill badge-success btn-shadow cancel-btn"
                        id="downgrade-sub">Downgrade to lite plan</button>
                    <form class="downgarde-plan" method="post" enctype="multipart/form-data" id="downgarde-plan" style="display:none;">
                        <input type="hidden" name="add-to-cart" id="down_main_product" value="290493">
                        <input type="hidden" id="down_variation_id" name="variation_id" value="290496">
                    </form>
                </div>
                <p class="pointer font-weight-bold text-center mt-2 p-0 mx-auto deactivate-text" id="deactivate-sub">No,
                    I want to deactivate my subcription.</p>
            </div>
        </div>

    </div>
</div>

<?php
    global
    $post;
    $post_slug=$post->post_name;
    if($post_slug != 'my-account'){ ?>
        <!-- WISTIA PLAYER -->
        <script src="https://fast.wistia.com/embed/medias/355hm6noc5.jsonp" async></script>
        <script src="https://fast.wistia.com/assets/external/E-v1.js" async></script>
    <?php
    }
    ?>

<script>
$(document).ready(() => {
    let cancelHref = switchUrl = '';

    // open cancel modal
    $('#cancel-sub').click((event) => {
        cancelHref = event.target.href;
        switchUrl = $(event.target).data('switching');
        parentProduct = $(event.target).data('product-id');
        minProduct = $(event.target).data('product-parent');
        event.preventDefault();

        var getProduct = $('#cancel-sub').data('product');
        if(getProduct.includes('lite') || getProduct.includes('Lite')){
            $('#modal-overlay').removeClass('closed');
            $('#modal-cancel-step2').removeClass('closed');
            $('#confirm-cancel-sub').attr('href', cancelHref);
        }else{
            $('#modal-overlay').removeClass('closed');
            $('#modal-cancel-step1').removeClass('closed');
        }
    });


    // hide cancel modal 1
    $('#modal-cancel-step1-close').click(() => {
        $('#modal-cancel-step1').addClass('closed');
        $('#modal-overlay').addClass('closed');
    });

    // cancel continue to step 2
    $('#deactivate-sub').click(() => {
        $('#modal-cancel-step1').addClass('closed');
        $('#modal-cancel-step2').removeClass('closed');
        $('#confirm-cancel-sub').attr('href', cancelHref);
    });

    // downgrade instead cancel
    $('#downgrade-sub').click(() => {
        $('#modal-cancel-step1-close').hide();
        $('#downgrade-sub').append('<div class="woocommerce" id="down-loader"><div class="loader"></div></div>');
        window.history.replaceState(null, null, switchUrl);
        $('#down_variation_id').val(minProduct);
        $('#down_main_product').val(parentProduct);
        var formData = $('#downgarde-plan').serialize();
        $.ajax({
            url: window.location.href,
            type: 'post',
            contentType: 'application/x-www-form-urlencoded',
            data: formData,
            success: function( data, textStatus, jQxhr ){
                $('#one_click_purchase').attr('src','/cart?callBy=oneClick');
                $("#one_click_purchase").on("load", function () {
                    $('#modal-cart').removeClass('closed');

                    $('#modal-cancel-step1').addClass('closed');
                    $('#down-loader').remove();
                    $('#modal-cancel-step1-close').show();
                });
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
            }
        });
        return false;
    });

    // hide cancel modal 2
    $('#modal-cancel-step2-close').click(() => {
        $('#modal-cancel-step2').addClass('closed');
        $('#modal-overlay').addClass('closed');
    });

    // decline cancel sub step 2
    $('#decline-cancel-sub').click(() => {
        $('#modal-cancel-step2').addClass('closed');
        $('#modal-overlay').addClass('closed');
    });

    // confirm cancel sub step 2
    $('#confirm-cancel-sub').click(() => {
        $('#modal-cancel-step2').addClass('closed');
        $('#modal-overlay').addClass('closed');
    });

})
</script>

<!--MODAL CANCEL STEP 2-->

<div class="modal-cancel-step2 closed" id="modal-cancel-step2">
    <div class="modal-guts">
        <div>
            <img class="img-fluid pointer close" src="<?php bloginfo('template_url')?>/assets/images/close-icon.png"
                id='modal-cancel-step2-close'>
            <p class="p3 text-center text-white font-weight-bold title">Are You Sure You Want to <br> Deactivate Your
                Subscription?</p>
        </div>
        <div
            class="row col-xxxl-12 col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-xs-12 col-sm-12 mx-auto justify-content-center align-items-center flex-md-column-reverse flex-sm-column-reverse flex-xs-column-reverse flex-lg-row">
            <div class="col-xxxl-3 col-xxl-3 col-xl-3 col-lg-3 col-md-12 col-xs-12 col-sm-12 p-0 pl-3">
                <a href="" class="text-white accept" id="confirm-cancel-sub">YES, I'M SURE</a>
            </div>
            <div class="col-xxxl-8 col-xxl-8 col-xl-8 col-lg-8 col-md-12 col-xs-12 col-sm-12 p-0 text-center"
                id="close-button-cancel-step2">
                <a href="#" class="badge badge-pill badge-success decline" id="decline-cancel-sub">NO, I WANT TO KEEP IT ACTIVE!</a>
            </div>

        </div>

    </div>
</div>
</div>
<!--MODAL PURCHASE-->

<div class="modal-purchase closed" id="modal-purchase">
    <div class="modal-guts">
        <img class="img-fluid pointer close" src="<?php bloginfo('template_url') ?>/assets/images/close-icon.png"
            id='close-x'>
        <div
            class="row small-title col-xxxl-12  col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-xs-12 col-sm-12 text-center">
            <h5 class="text-center pl-0">Get The February, 2021 <span style="color: #01BFA6;">MIDI Box - Pro Tier
                </span>Now</h5>
        </div>
        <div
            class="row  col-xxxl-12  col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-xs-12 col-sm-12 mx-auto align-items-center justify-content-between p-0">

            <div
                class="col-xxxl-6  col-xxl-6 col-xl-5 col-lg-5 col-md-12 col-xs-12 col-sm-12 pr-0 pl-0 text-md-center text-lg-left">
                 <?php
                if(in_array('view-subscription',$unison_request) && is_account_page())
                {
                ?>
                    <img class="img-fluid tier"
                    src="<?php bloginfo('template_url')?>/assets/images/intro-hero-less-instruments.svg">
                <?php
                }
                ?>
            </div>
            <div class="col-xxxl-6  col-xxl-6 col-xl-7 col-lg-7 col-md-12 col-xs-12 col-sm-12  p-0 pl-2 ">
                <h5 class="text-left pl-0 big-title">Get The February, 2021 <br><span style="color: #01BFA6;">MIDI Box -
                        Pro Tier </span>Now</h5>
                <p class="text-white text-left  font-weight-bold pl-0 white-green-text">Here's What <span
                        style="color: #01BFA6;">You'll Get:</span></p>
                <ul class="col-xxxl-12 col-xxl-12  col-xl-12 col-lg-12 p-0">
                    <div class="row">
                        <div class="col-xxxl-7 col-xxl-7  col-xl-7 col-lg-7 col-md-12 col-xs-12 col-sm-12 pl-0">

                            <li class="text-white  text-left align-items-center"> <img class="img-fluid"
                                    src="<?php bloginfo('template_url') ?>/assets/images/correct green.png"
                                    style="margin-right: 5px;"> 200 Chord Progressions</p>
                        </div>


                        <div class="col-xxxl-5  col-xxl-5  col-xl-5 col-lg-5 col-md-12 col-xs-12 col-sm-12  pl-0">
                            <li class="text-white  text-left align-items-center"> <img class="img-fluid"
                                    src="<?php bloginfo('template_url') ?>/assets/images/correct green.png"
                                    style="margin-right: 5px;"> 200 Basslines</li>
                        </div>
                        <div class="col-xxxl-7 col-xxl-7 col-xl-7 col-lg-7 col-md-12 col-xs-12 col-sm-12 mt-10 pl-0">
                            <li class="text-white  text-left align-items-center"> <img class="img-fluid"
                                    src="<?php bloginfo('template_url') ?>/assets/images/correct green.png"
                                    style="margin-right: 5px;"> 200 Melodies</li>
                        </div>
                        <div class="col-xxxl-5 col-xxl-5  col-xl-5 col-lg-5 mt-10 col-md-12 col-xs-12 col-sm-12 pl-0">
                            <li class="text-white  text-left align-items-center"> <img class="img-fluid"
                                    src="<?php bloginfo('template_url') ?>/assets/images/correct green.png"
                                    style="margin-right: 5px;"> 280 Drum Patterns</li>
                        </div>
                    </div>
                </ul>
                <div
                    class="col-xxxl-11 col-xxl-11  col-xl-11 col-lg-11 col-md-12 col-xs-12 col-sm-12 p-0 row justify-content-between align-items-center font-weight-bold pl-3 pr-0">
                    <p
                        class="text-white  col-xxxl-8 col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-xs-8 col-sm-8 text-left p-0 text-one-payment">
                        One-Time Payment
                    </p>
                    <p
                        class="text-white col-xxxl-4  col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-xs-4 col-sm-4 pr-0 pl-0 only">
                        ONLY: <span class="p1 green">$27</span>
                    </p>
                </div>

                <div class="text-left col-xxxl-12  col-xxl-12  col-xl-12 col-lg-12 col-md-12 col-xs-12 col-sm-12 p-0"
                    id="close-button-purchase">
                    <a href="#" class="badge badge-pill badge-success btn-shadow btn-purchase">buy NOW with one
                        click</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
jQuery(document).ready(() => {
    jQuery('.coupan-form-togg').click(function(){
        jQuery('.coupan-form-togg-act').toggle();
    })

    jQuery('.js-page-profile').click((event) => {
        jQuery('.login').addClass('display')
    })

    setTimeout(function(){
        jQuery('#wc-stripe-new-payment-method').prop('checked', true);
    },600);
    setTimeout(function(){
        jQuery('#wc-stripe-new-payment-method').prop('checked', true);
    },800);
    setTimeout(function(){
        jQuery('#wc-stripe-new-payment-method').prop('checked', true);
    },1500);

    //01-12-2021
    jQuery('.play_single_audio .btn-play').on('click', function(){
        var playbar_height = jQuery('div#playbar').height();
        jQuery(".bg-dark .copyright").css("padding-bottom", playbar_height+"px");
    });

    // custom code for saved card start

    <?php
        $saved_card_list = '';
        $saved_payment_methods = saved_payment_methods_func();
        //print_r($saved_payment_methods);
        if(!empty($saved_payment_methods)){
            $k=1;
            foreach($saved_payment_methods as $key => $saved_payment_method){
                if($k==1){
                    $is_checked = 'checked=checked';
                }else{
                    $is_checked = '';
                }
                $saved_card_list .= '<li class="woocommerce-SavedPaymentMethods-token"><input id="wc-stripe-payment-token-'.$key.'" type="radio" name="wc-stripe-payment-token" value="'.$key.'" style="width:auto;" class="woocommerce-SavedPaymentMethods-tokenInput" '.$is_checked.'><label for="wc-stripe-payment-token-'.$key.'">'.$saved_payment_method['card_type'].' ending in '.$saved_payment_method['last4'].' (expires '.$saved_payment_method['expiry_month'].'/'.$saved_payment_method['expiry_year'].')</label><div class="stripe-source-errors" role="alert"></div>';
                $k++;
            }

            $saved_card_list .= '<li class="woocommerce-SavedPaymentMethods-new"><input id="wc-stripe-payment-token-new" type="radio" name="wc-stripe-payment-token" value="new" style="width:auto;" class="woocommerce-SavedPaymentMethods-tokenInput"><label for="wc-stripe-payment-token-new">Use a new payment method</label></li>';
            ?>

            <?php
        }

    ?>
    //populateSavedCrads();

});
function populateSavedCrads(){

        if(jQuery('#gform_wrapper_5 .cs_gfrom_credit_card_section, #gform_wrapper_6 .cs_gfrom_credit_card_section').find('.savecardforfuture').length==0){
            jQuery('#gform_wrapper_5 .cs_gfrom_credit_card_section, #gform_wrapper_6 .cs_gfrom_credit_card_section').append('<div class="savecardforfuture"><label><input type="checkbox" value="yes" name="savecardforfuture"><span>Save this card to my account for faster and more secure checkout.</span></label></div>');
        }

        if(jQuery('#gform_wrapper_6').find('.woocommerce-SavedPaymentMethods.wc-saved-payment-methods').length==0){
            jQuery('#gform_wrapper_6 .cs_gfrom_credit_card_section').prepend('<ul class="woocommerce-SavedPaymentMethods wc-saved-payment-methods" data-count="10"><?php echo $saved_card_list; ?></ul>');
            if(jQuery("input[name=wc-stripe-payment-token]:checked").val()!='new'){
                //jQuery("#gform_wrapper_6 .savecardforfuture").hide();
                //console.log('fdsadfsaff');
            }
        }
        if(jQuery("input[name=wc-stripe-payment-token]").length > 0){
            jQuery('.ginput_container_creditcard').hide();
            jQuery(".savecardforfuture").hide();
            jQuery(".savecardforfuture input").prop('checked', false);
        }
        jQuery("input[name=wc-stripe-payment-token]").on('change', function(){
            if(jQuery("input[name=wc-stripe-payment-token]:checked").val()=='new'){
                jQuery('.ginput_container_creditcard').show();
                jQuery('.savecardforfuture input[name=savecardforfuture]').prop('checked', true);
                jQuery(".savecardforfuture").show();
            }else{
                jQuery('.ginput_container_creditcard').hide();
                jQuery(".savecardforfuture").hide();
                jQuery(".savecardforfuture input").prop('checked', false);
            }
        });

        jQuery(".ginput_container_radio .gfield_radio input[name=input_7]").on('change', function(){
            jQuery('.wc-saved-payment-methods li:first input[name=wc-stripe-payment-token]').prop('checked', true);
        });

        jQuery('#gform_wrapper_5 .savecardforfuture input[name=savecardforfuture]').prop('checked', true);

        if(jQuery('#gform_wrapper_6').find('.woocommerce-SavedPaymentMethods.wc-saved-payment-methods li').length==0){
            jQuery('.savecardforfuture input[name=savecardforfuture]').prop('checked', true);
        }

    }
    // custom code for saved card end
    // $('#place_order').click(function(){
    //     let paycardid = $(this).closest('#payment').find('.woocommerce-SavedPaymentMethods-tokenInput:checked').val();
    //     //alert(paycardid);
    //     $.ajax({
    //         url: afp_vars.afp_ajax_url,
    //         method: "post",
    //         data: {
    //             'action': 'carddefaultsave',
    //             'paycardid': paycardid
    //         },
    //         success: function(response) {
    //             let subid = jQuery('.custom-form-btn > input[name=woocommerce_change_payment]').val();
    //             //console.log(response);
    //             setTimeout(function(){ window.location.href = "/my-account/view-subscription/"+subid; }, 5000);
    //         }
    //     });
    // });
    jQuery('.cantdelete').click(function(){
        jQuery('.cantdeletenotice').removeClass('d-none');
        jQuery('.cantdeletenotice').addClass('woocommerce-message');
        jQuery('.woocommerce-MyAccount-paymentMethods').addClass('pt-3');
        setTimeout(function(){ jQuery('.cantdeletenotice').addClass('d-none');jQuery('.cantdeletenotice').removeClass('woocommerce-message');jQuery('.woocommerce-MyAccount-paymentMethods').removeClass('pt-3'); }, 5000);
        return false;
    })
    jQuery('.btn-download_limit').click(function(){
        let productid = jQuery(this).attr('data-proid');
        let orderid = jQuery(this).attr('data-orderid');
        let nthis =  jQuery(this);
        jQuery.ajax({
            url: afp_vars.afp_ajax_url,
            method: "post",
            data: {
                'action': 'downloadlimit',
                'productid': productid,
                'orderid': orderid,
                },
            success: function(response) {
                if(response == 0 && response != "" ){
                    nthis.css('pointer-events', 'none');
                    nthis.css('background-color', '#7e7e7e !important');
                    nthis.css('border', '0');
                    nthis.addClass('disabled');
                }
                nthis.closest('.bonusrow').find('.dwontolimit').text('');
                nthis.closest('.bonusrow').find('.dwontolimit').text(response + ' Downloads remaining');

            }
        });

    });
    jQuery('.subtextbut').click(function(){
        jQuery('#loginform1').submit();
    })
</script>

<!-- MODAL CHANGE DATA  -->
<div class="modal-change-data closed" id="modal-change-data">
    <div class="contain">
        <img class="img-fluid pointer close" src="<?php bloginfo( 'template_url' ) ?>/assets/images/black x.png" id='close-x'>
        <div class="col-12 text-center p-0">
            <img class="img-change-data" src="<?php bloginfo( 'template_url' ) ?>/assets/images/logo 1.png" alt="">
        </div>
        <div class="mx-auto d-flex flex-column m-0 text-center">
            <label class="text-left">Your Email Address:</label>
            <input type="email" placeholder="valentina.tadic009@gmail.com" name="email" id="email">
            <label class="text-left">Your Username:</label>
            <input type="text" placeholder="Valentina" class="mt-0" name="username" id="username">
        </div>

        <div class="text-center mx-auto  btn-change-data" id="close-button-change-data">
            <span class="font-weight-bold text-white" type="button">SAVE CHANGES</span>
        </div>

    </div>
</div>

<?php wp_footer(); ?>
<script>

    function unis_height_title()
    {
        var heights = $(".home .front-card-title").map(function ()
        {
            return $(this).height();
        }).get();

        maxHeight = Math.max.apply(null, heights);
        $('.home .product-text').css('height',maxHeight+'px');

    }

    $( window ).resize(function()
    {
      unis_height_title();
    });

    jQuery(document).ready(function(){

        unis_height_title();

        if(jQuery('#gform_5')[0]){
            jQuery('#input_5_1_3').addClass('regunamecheck');
            jQuery('#input_5_2').addClass('regumailcheck');
            jQuery('#input_5_3').addClass('regupasscheck');
            jQuery('#gform_next_button_5_5').addClass('subbutreglogcheck');
            jQuery('#gform_next_button_5_5').removeAttr('onkeypress');
            jQuery('#gform_next_button_5_5').removeAttr('onclick');
        }
        jQuery('.button.subbutreglog').click(function(e){
            e.preventDefault();
            var regusername = jQuery('.rfield.reguname').val();
            var regupass = jQuery('.regupass').val();
            var regumail = jQuery('.regumail').val();
            var sign_up_newsletter = jQuery('.sign_up_newsletter').val();
            var _this = $(this);
            _this.val('Loading...');
            jQuery.ajax({
                url: afp_vars.afp_ajax_url,
                method: "post",
                data: {
                    'action': 'cs_registration_true',
                    'regusername': regusername,
                    'regupass': regupass,
                    'regumail': regumail,
                    'sign_up_newsletter': sign_up_newsletter,
                    },
                success: function(response) {
                    if('0' != response){
                        if(jQuery('.error')[0]){
                            jQuery('.error').remove();
                            var xx = jQuery('.create-account');
                            xx.prepend(response);
                        }
                        else{
                            var xx = jQuery('.create-account');
                            xx.prepend(response);
                        }
                        _this.val('Sign Up');
                    }else{
                        location.reload();
                    }
                }

            });
            return false;
        });
        jQuery('input.subbutreglogcheck').click(function(e){
            e.preventDefault();
            var regusername = jQuery('input.regunamecheck').val();
            var regupass = jQuery('input.regupasscheck').val();
            var regumail = jQuery('input.regumailcheck').val();
            jQuery.ajax({
                url: afp_vars.afp_ajax_url,
                method: "post",
                data: {
                    'action': 'cs_registration_true',
                    'regusername': regusername,
                    'regupass': regupass,
                    'regumail': regumail,
                    },
                success: function(response) {
                    if('0' != response){
                        if(jQuery('.error')[0]){
                            jQuery('.error').remove();
                            var xx = jQuery('.create-account');
                            xx.append(response);
                            jQuery('.gform_page_footer').after(response);
                        }
                        else{
                            var xx = jQuery('.create-account');
                            xx.append(response);
                            jQuery('.gform_page_footer').after(response);
                        }
                    }else{
                        location.reload();
                    }

                }

            });
            return false;
        });
        if(jQuery('#single-order')[0]){
            let linktext = jQuery('.woocommerce-table__product-name .table-green a').text();
            jQuery('.woocommerce-table__product-name .table-green a').remove();
            jQuery('.woocommerce-table__product-name .table-green').append(linktext);

        }

        jQuery('.account-desktop-menu #rent-to-own-tab').attr('target', '_blank');

    })

    jQuery('#acordion-item').click(function(){
        jQuery(this).closest('.collapse-accordion').toggle();
    })




</script>
</body>

</html>
