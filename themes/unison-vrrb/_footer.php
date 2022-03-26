<?php

if ( is_product() ) {
	$productSlug = getLastPathSegment( $_SERVER['REQUEST_URI'] );
	$product_obj = get_page_by_path( $productSlug, OBJECT, 'product' );
	$music       = get_post_meta( $product_obj->ID, '_music', true ); ?>
    <div <?php post_class( "samplepack-item display-no" ); ?>>
        <p>
            <a href="<?php the_permalink(); ?>">
				<?php
				if ( has_post_thumbnail() ) {
					$url = wp_get_attachment_url( get_post_thumbnail_id( $product_obj->ID ) );
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
				if ( is_user_logged_in() ) {
					echo do_shortcode( '[download_now id="" text="Download"]' );
				} else {
					echo '<a href="javascript:void(0)" data-product_title="' . get_the_title() . '" data-quantity="1" data-product_id="' . get_the_ID() . '" data-product_sku="" class="js-check-login btn">Download</a>';
				}
			} elseif ( $product_price > 0 ) { ?>
                <form class="cart" method="post" enctype='multipart/form-data'>
                    <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product_obj->ID ); ?>"/>
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

$defaultloop = new WP_Query( array(
	'post_type'      => 'product',
	'posts_per_page' => 1,
	'order'          => 'DESC',
	'orderby'        => 'ID',
	'tax_query'      => array(
		array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => 'default-sound-category',
		),
	),
) );

while ( $defaultloop->have_posts() ):
	$defaultloop->the_post();
	$music = get_post_meta( $post->ID, '_music', true ); ?>
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
			$music         = get_post_meta( $post->ID, '_music', true );
			$product_price = get_post_meta( $post->ID, '_price', true );
			echo '<a href="#" class="btn-play default_product_song" id="js-defaultsound" data-file="' . $music . '" data-id="' . $post->ID . '"></a>';
			echo '<div class="button_free default_product_button">';
			if ( $product_price == 0 ) {
				if ( is_user_logged_in() ) {
					echo do_shortcode( '[download_now id="" text="Download"]' );
				} else {
					echo '<a href="javascript:void(0)" data-product_title="' . get_the_title() . '" data-quantity="1" data-product_id="' . get_the_ID() . '" data-product_sku="" class="js-check-login btn">Download</a>';
				}
			} elseif ( $product_price > 0 ) { ?>
                <form class="cart" method="post" enctype='multipart/form-data'>

                    <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $post->ID ); ?>"/>
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
?>
<!-- Cart drawer code -->
<?php include('cart-drawer-sidebar.php'); ?>
<style type="text/css">
  body.post-7 ul.wc_payment_methods.payment_methods.methods {
      display: flex;
      flex-direction: column;
  }
  body.post-7  li.wc_payment_method.payment_method_paypal {
      order: 2;
  }
</style>
<script type="text/javascript">
  jQuery('input[name="payment_method"]').each(function(){
   var this_val = jQuery(this).val();
   if(this_val == 'stripe'){
     jQuery(this).prop('checked',true);
     jQuery('.wc_payment_method.payment_method_stripe').trigger('click');
     jQuery('.payment_box.payment_method_stripe').show();
  }
});
</script>
<!-- eND Cart drawer code -->
<div class="cs_get_upsell_producton_ajax"></div>
<footer>
    <div class="contain">
        <a href="/" class="logo"></a>
		<?php dynamic_sidebar( 'footer_socials' ); ?>
        <div class="links">
            <a href="/customer-support/">Customer Support</a>
        </div>
    </div>
</footer>
<div class="text_center copy_wrap">
    <p class="copyright_text">© <?php echo date( 'Y' ); ?> Unison.audio
        <a href="/terms-of-use/">Terms of Use</a>
        <a href="/privacy-policy/">Privacy Policy</a></p>
</div>
<div class="popup" id="account">
    <div class="contain">
        <h4>Account <span>Please Login or Sign Up</span></h4>
        <ul class="js-tab--account tab-account">
            <li class="selected">login</li>
            <li >Sign Up</li>
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
					$form = str_replace( 'name="log"', 'name="log" placeholder="Your Email Adress"', $form );
					$form = str_replace( 'name="pwd"', 'name="pwd" placeholder="Your Password"', $form );
					echo $form;

					?>
                    <form method="post" action="<?php bloginfo( 'url' ) ?>/wp-login.php" class="frmSignIn">
                        <p><a href="/reset/" class="los">Forgot your password?</a></p>
                        <!--  <p class="or"><span>OR</span></p> -->
						<?php //do_action( 'wordpress_social_login' ); ?>
                    </form>
				<?php } ?>
            </div>
            <div class="create-account">
				<?php custom_registration_function(); ?>

				<?php //do_action( 'wordpress_social_login' ); ?>
            </div>
        </div>
    </div>
    <span class="btn-close js-close-account"></span>
    <span class="ovl"></span>
</div>

<div class="popup" id="lostpass">
    <div class="lostpass-wrap">
        <h4>FORGET PASSword</h4>
        <form class="frmForgot" action="/member/forgot-pass.html" method="POST" autocomplete="off">
            <p><input name="email" placeholder="Your Email adress" type="text"></p>
            <p><input value="submit" class="btn js-forgot-pass" type="submit"></p>
        </form>
    </div>
    <span class="btn-close js-close-account"></span>
    <span class="ovl"></span>
</div>
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
          <span class="ui-slider-range ui-corner-all ui-widget-header ui-slider-range-min" "></span>
            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
            </span>
        </div>

		<?php global $post, $product; ?>

        <div id="title">
            <p class="thumb"></p>
            <span id="track" class="track"></span>
        </div>
        <!-- button for download -->
        <div id="defaultbutton"></div>
        <div id="cartDownCont">

        </div>
    </div>

    <div class="audio-wrap js-wrap-audio" id="audio"></div>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            if ($('#cart_woo').length) {
                $('html, body').animate({
                    scrollTop: $('#cart_woo').offset().top + 50
                }, 2000);
            }
        });
    </script>
    <script>
        jQuery(document).ready(function () {
            // Get the modal
            var modal = document.getElementById('myModal');

            if (modal) {

                // Get the button that opens the modal
                /*var btn = document.getElementById("myBtn");*/

                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];
                var goToCheckout = document.getElementsByClassName("goToCheckout")[0];

                // When the user clicks the button, open the modal
                /*btn.onclick = function() {
				  modal.style.display = "block";
				}*/

                // When the user clicks on <span> (x), close the modal
                span.onclick = function () {
                    modal.style.display = "none";
                }

                if (undefined !== goToCheckout) {
                    goToCheckout.onclick = function () {
                        modal.style.display = "none";
                    }
                }

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function (event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            }

        });
    </script>
    <script>
        //jQuery(window).load(function(){
        //jQuery('.post-380 .btn-user,.post-9 .btn-user').removeClass('js-check-login');
        //    jQuery('.post-380 .btn-user,.post-9 .btn-user').removeClass('js-page-profile');
        //});

        jQuery(document).ready(function () {
            jQuery('.bb-b').click(function () {
                location.href = "/cart";
            });
            jQuery('.form-field > label').on('click', function () {
                jQuery('.form-field-wide').hide();
            });
            jQuery('.appointable a').on('click', function () {
                jQuery('.form-field-wide').show();
            });
            jQuery('.ava').on('click', function () {
                jQuery('.av-upload').show();
            });
            jQuery('.close-av-modal').on('click', function () {
                jQuery('.av-upload').hide();
            });
            jQuery('.bookings').click(function () {
                jQuery('form.cart').addClass('active');
            });
            if (jQuery('.create-account div').hasClass('error')) {
                jQuery('div#account').show();
                jQuery('.login').css("display", "none");
                jQuery('.create-account').show();
                jQuery('.create-account').addClass('display');
                jQuery('.tab-account li').removeClass('selected');
                jQuery('.tab-account li + li').addClass('selected');
                jQuery('.create-account').css("opacity", "1");
            }
            var url = jQuery(location).attr('href');
            parts = url.split("/");
            last_part = parts[parts.length - 2];
            //console.log(last_part);
            if (last_part == 'my-account' || last_part == 'login') {
                jQuery('.js-tab--account li:eq(1)').trigger('click');
            }

        });
        (function ($) {

            $(function () {

                $('.rf').each(function () {
                    var form = $(this),
                        btn = form.find('.btn_submit');

                    form.find('.rfield').addClass('empty_field');

                    // Функция проверки полей формы
                    function checkInput() {
                        form.find('.rfield').each(function () {
                            if ($(this).val() != '') {
                                $(this).removeClass('empty_field');
                            } else {
                                $(this).addClass('empty_field');
                            }
                        });
                    }

                    // Функция подсветки незаполненных полей
                    function lightEmpty() {
                        form.find('.empty_field').css({'border-color': '#d8512d'});
                        setTimeout(function () {
                            form.find('.empty_field').removeAttr('style');
                        }, 500);
                    }

                    setInterval(function () {
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

                    btn.click(function () {
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
    <script src="<?php bloginfo( 'template_url' ); ?>/js/libs/fastclick.js"></script>
	<?php
	global $wp_query;
	$checkout_id = $wp_query->post->ID;
	$post_name   = get_post_type( $checkout_id );
	if ( $post_name != 'checkoutpages' ) { ?>
        <script src="<?php bloginfo( 'template_url' ); ?>/js/libs/jquery-1.11.1.js"></script>
	<?php } ?>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/libs/howler.core.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/libs/siriwave.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/be.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/timezone.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/moment.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/moment-timezone-with-data.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/libs/plugin.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/libs/sc-player.js"></script>
    <div class="sc-player-engine-container">
        <audio preload="auto"></audio>
    </div>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/libs/soundcloud.player.api.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/libs/underscore-1.7.0.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/libs/utils.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/libs/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/modules/helper.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/modules/player.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/modules/slider.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/modules/main.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/js/functions.js"></script>
    <script src="<?php bloginfo( 'template_url' ); ?>/libs/modal/sweetalert.min.js"></script>

    <script>

        jQuery(document).ready(function () {
            $('#user').attr('placeholder', 'Your Email Address');
            $('#pass').attr('placeholder', 'Your Password');

            jQuery('.post-380 .btn-user,.post-9 .btn-user').click(function () {
                jQuery('.login-username,.rf p.user .rfield[name="username"]').addClass('active-focus');
            });
            jQuery('.post-380 input,.post-9 input').click(function () {
                jQuery('.login-username,.rf p.user .rfield[name="username"]').removeClass('active-focus');
            });
            var owl = $('.owl-carousel');
            owl.owlCarousel({
                loop: true,
                items: 1,
                dots: true,
                navSpeed: 1000,
                dragEndSpeed: 1000,
                smartSpeed: 1000,
                fluidSpeed: 1000,
                lazyLoad: true,
                lazyContent: true,
                autoplay: true,
                autoplayTimeout: 10000,
            });
            // Go to the next item
            $('.customNextBtn').click(function () {
                owl.trigger('next.owl.carousel');
            });
            // Go to the previous item
            $('.customPrevBtn').click(function () {
                // With optional speed parameter
                // Parameters has to be in square bracket '[]'
                owl.trigger('prev.owl.carousel', [300]);
            });
            var owl3 = $('.owl-carousel3');
            owl3.owlCarousel({
                loop: true,
                items: 1,
                dots: true,
                navSpeed: 1000,
                dragEndSpeed: 1000,
                smartSpeed: 1000,
                fluidSpeed: 1000,
                lazyLoad: true,
                lazyContent: true,
            });
            // Go to the next item
            $('.btn-next.btn-next3').click(function () {
                owl3.trigger('next.owl.carousel');
            });
            // Go to the previous item
            $('.btn-prev.btn-prev3').click(function () {
                // With optional speed parameter
                // Parameters has to be in square bracket '[]'
                owl3.trigger('prev.owl.carousel', [300]);
            });
            var owl2 = $('.owl-carousel2');
            owl2.owlCarousel({
                loop: true,
                items: 1,
                dots: true,
                navSpeed: 1000,
                dragEndSpeed: 1000,
                smartSpeed: 1000,
                fluidSpeed: 1000,
                lazyLoad: true,
                lazyContent: true,
            });
            // Go to the next item
            $('.btn-next.btn-next2').click(function () {
                owl2.trigger('next.owl.carousel');
            });
            // Go to the previous item
            $('.btn-prev.btn-prev2').click(function () {
                // With optional speed parameter
                // Parameters has to be in square bracket '[]'
                owl2.trigger('prev.owl.carousel', [300]);
            });

            setInterval(function () {
                jQuery('body').find('#place_order').val('Proceed To Checkout')
            });
        });


    </script>
	<?php if ( is_front_page() ) { ?>
        <script type="text/javascript">
            setTimeout(function () {
                jQuery('#featured-packs').trigger('click');
            }, 500);

            jQuery(window).load(function () {
                var selected_id = window.location.hash;
                if (selected_id != '') {

                    var myid = selected_id.replace(/#/gi, "");
                    if (myid == 'serum-collection') {
                        myid = 'sample-packs';
                    } else if (myid == 'artist-series') {
                        myid = 'artists';
                    }

                    setTimeout(function () {
                        jQuery(selected_id).trigger('click');
                    }, 0);

                    jQuery('html, body').animate({
                        scrollTop: jQuery("#" + myid).offset().top
                    }, 0);

                    jQuery('#samplepacks ul li').each(function () {
                        var current_id = jQuery(this).attr('id');
                        if (current_id == myid) {
                            jQuery(this).addClass('selected');
                            jQuery(this).trigger('click');
                            console.log(myid);
                        } else {
                            jQuery(this).removeClass('selected');
                        }
                    });
                }
                //
                var home_url = window.location.origin;
                if (home_url != '') {
                    jQuery('#samplepacks ul li').each(function () {
                        jQuery(this).on('click', function () {
                            var current_id = jQuery(this).attr('id');
                            if (current_id == 'sample-packs') {
                                jQuery(location).attr('href', home_url + '/#serum-collection');
                            } else if (current_id == 'artists') {
                                jQuery(location).attr('href', home_url + '/#artist-series');
                            } else {
                                jQuery(location).attr('href', home_url + '/#' + current_id);
                            }

                        });
                    });
                }
            });
        </script>
	<?php } ?>

	<?php if ( is_page( 'soundbanks' ) ) { ?>
        <script type="text/javascript">
            jQuery(window).load(function () {
                var selected_id = window.location.hash;
                if (selected_id != '') {

                    var myid = selected_id.replace(/#/gi, "");
                    if (myid == 'serum-collection') {
                        myid = 'sample-packs';
                    } else if (myid == 'artist-series') {
                        myid = 'artists';
                    }

                    setTimeout(function () {
                        jQuery(selected_id).trigger('click');
                    }, 0);

                    jQuery('html, body').animate({
                        scrollTop: jQuery("#" + myid).offset().top
                    }, 0);

                    jQuery('#samplepacks ul li').each(function () {
                        var current_id = jQuery(this).attr('id');
                        if (current_id == myid) {
                            jQuery(this).addClass('selected');
                            jQuery(this).trigger('click');

                        } else {
                            jQuery(this).removeClass('selected');
                        }
                    });
                }
                //
                var home_url = '<?php echo site_url();?>/soundbanks';
                if (home_url != '') {
                    jQuery('#samplepacks ul li').each(function () {
                        jQuery(this).on('click', function () {
                            var current_id = jQuery(this).attr('id');
                            if (current_id == 'sample-packs') {
                                jQuery(location).attr('href', home_url + '/#serum-collection');
                            } else if (current_id == 'artists') {
                                jQuery(location).attr('href', home_url + '/#artist-series');
                            } else {
                                jQuery(location).attr('href', home_url + '/#' + current_id);
                            }

                        });
                    });
                }
            });
        </script>
	<?php } ?>

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
        jQuery('.pop_container .btn-close').click(function () {
            jQuery('.pop_container .keep_shopping').click();
        });

    </script>

    <script type="text/javascript">
        jQuery('.pop_container .btn-close,.pop_container_download .btn-close').click(function () {
            jQuery('.pop_container .keep_shopping,.pop_container_download .keep_shopping').click();
        });
        jQuery(window).load(function () {
            jQuery(window).resize();
        });

    </script>
    <script type="text/javascript">
        // ajax login authenticate
        jQuery(document).on('submit', '#loginform1', function (e) {
            e.preventDefault();
            var username = jQuery('#loginform1').find('input[name="log"]').val();
            var password = jQuery('#loginform1').find('input[name="pwd"]').val();
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
                    beforeSend: function () {
                        jQuery('.my_cs_error_msg').remove();
                    },
                    success: function (response) {
                        console.log(response);
                        if (response == 'true') {
                            location.reload();
                        } else {
                            //jQuery('.my_cs_error_msg').remove();
                            jQuery('.cs_login_from_wrp').prepend('<p class="login-msg my_cs_error_msg"><strong>ERROR:</strong> Incorrect email or password. Please try again.</p>');

                        }
                    }
                });
            } else {
                jQuery('.my_cs_error_msg').remove();
                jQuery('.cs_login_from_wrp').prepend('<p class="login-msg my_cs_error_msg"><strong>ERROR:</strong> Enter email and password.</p>');
            }
        });

    </script>
    <!-- endinject -->
    <!--[if lt IE 9]>-->
    <!--<script src="assets/js/ie.body.min.js"></script>-->
    <!--<![endif]-->
	<?php wp_footer(); ?>
    </body>
    </html>