$(document).ready(function() {
    $('#user1').attr('placeholder', 'Your Email Address');
    $('#pass1').attr('placeholder', 'Your Password');
    $('#user2').attr('placeholder', 'Your Email Address');
    $('#pass2').attr('placeholder', 'Your Password');
    $('#user').attr('placeholder', 'Your Email Address');
    $('#pass').attr('placeholder', 'Your Password');
    $('.default-usage-select').selectbox();
    $("#datepicker").datepicker({
        onSelect: function(date) {
            UNISON.booking.chooseDate(date);
        },
        minDate: new Date(),
        beforeShowDay: UNISON.booking.disableSpecificDates
    });
    $('.js-tab--contact li:eq(0)').trigger('click');
    if ($('#pAccount').length) {
        $('footer').addClass('no-space');
    }
    $('.btn-menu--mobile').on('click', function(evt) {
        evt.preventDefault();
        if ($(this).hasClass('open')) {
            $(this).removeClass('open')
            $('#nav').hide();
            $('header').css({
                'position': 'static'
            });
        } else {
            $(this).addClass('open');
            $('#nav').show();
            $('header').css({
                'position': 'fixed'
            });
        }
    });

    $('body').on('click', ".activacampaign", function(e) {
        e.preventDefault();
        $.validator.addMethod("spamEmails", function(value, element) {
            if (this.optional(element)) // return true on optional element
                return true;
            var prohibitied_domains = [
                'sharklasers.com',
                'grr.la',
                'guerrillamail.biz',
                'guerrillamail.com',
                'guerrillamail.de',
                'guerrillamail.net',
                'guerrillamail.org',
                'guerrillamailblock.com',
                'spam4.me',
            ];
            var EMAIL = value.split('@');
            var resultEmail = EMAIL['1'];
            if (jQuery.inArray(resultEmail, prohibitied_domains) != -1) {
                return false;
            } else {
                return true;
            }
        }, 'Please do not use temporary email address');
        $("#mc4wp-form-1").validate({
            rules: {
                FNAME: {
                    required: true
                },
                EMAIL: {
                    required: true,
                    email: true,
                    spamEmails: true
                }
            }
        });
        if ($("#mc4wp-form-1").valid() == true) {
            var FNAME = $('#FNAME').val();
            var EMAIL = $('#EMAIL').val();
            jQuery.ajax({
                url: afp_vars.afp_ajax_url,
                method: "post",
                data: {
                    'action': 'homesubscription',
                    'first_name': FNAME,
                    'email': EMAIL
                }
            }).done(function(response) {
                if (response.error == false) {
                    jQuery('.mc4wp-success').html(response.message).show().fadeOut(5000);
                } else if (response.error == true) {
                    jQuery('.mc4wp-alert').html(response.message).show().fadeOut(5000);
                }
            });
        }
    });
});
var player = null;
var btnAddCartDown = $('#playbar').find('#playbarbtn');
var cartDownCont = $('#playbar').find('#cartDownCont');
var defaultbutton = $('#playbar').find('#defaultbutton');
$(btnAddCartDown).hide();
$(cartDownCont).hide();

function AudioSample(selector) {
    var self = this;
    this.$audio = $(selector);
    this.playAudio = function(evt) {
        evt.preventDefault();
        if (jQuery("#loading").css('display') == 'block') {
            return false;
        }
        var pathFile = $(this).attr('data-file');
        var fileName = $(this).parents('.samplepack-item').find('.js-title-samplepacks').text() || $(this).parents('.artist-detail').find('.js-title-samplepacks').text() || $('.extra_product_title').val();
        var thumb = $(this).parents('.samplepack-item').find('.thumb').attr('src') || $(this).parents('.artist-detail').find('.thumb').attr('src');
        var price = $(this).parents('.samplepack-item').find('.js-product-price').text();
        var sale_price = $(this).parents('.samplepack-item').find('.js-product-sale-price').text();

        if (sale_price) {
            $('#title .sale-price s').empty(price);
            $('#title .sale-price s').append('$' + price);
            $('#title .regular-price').empty(sale_price);
            $('#title .regular-price').append(sale_price);
            $('#title .sale-price').removeClass('d-none');
            if(sale_price == 0) {
                $('.test-button.add_cart_btn.btn-buy').text('Add to cart free');
            } else {
                $('.test-button.add_cart_btn.btn-buy').text('Add to cart');
                
                if(evt.target.className!='btn-play btn-play-upsell js-sound'){
                    $('.regular-price.playbar-regular-price').prepend('$');
                }
            }

        } else {
            $('#title .regular-price').empty(price);
            // $('#title .regular-price').empty(sale_price);
            $('#title .regular-price').append(price);
            $('#title .sale-price').addClass('d-none');

            if (price == 0) {
                $('#title .regular-price.playbar-regular-price').prepend('$');
                $('.test-button.add_cart_btn.btn-buy').text('Add to cart free');
            } else {
                $('.regular-price.playbar-regular-price').prepend('$');
                $('.test-button.add_cart_btn.btn-buy').text('Add to cart');
            }
        }

        if (thumb == undefined) {
            thumb = jQuery('.modal .wp-post-image').attr('src');
        }

        var $thumb = $('<img src="' + thumb + '"/>');
        if (player != null) {
            player.stop();
        }
        player = new Player([{
            title: fileName,
            file: pathFile,
            howl: null
        }]);
        $('#playbar .cost').text($(this).parents('.samplepack-item').find('.js-price-text').text());
        var product_id = $(this).attr('data-id');
        $('#playbar .btn').attr('data-id', product_id);
        $('#title .thumb').html('').append($thumb);
        $('.js-sound').not($(this)).removeClass('pause');
        if (!$(this).hasClass('pause')) {
            $(this).addClass('pause');
            $('#playbar').show();
            if ($('#pauseBtn').is(':visible')) {
                $(pauseBtn).trigger('click');
                $('#playbar').css('bottom', '-140px');
            }
            $('#playbar').css('bottom', 0);
            player.play();
        } else {
            $(this).removeClass('pause');
            $("#playbar").css('z-index', '599')
            player.pause();
            // $('#playbar').css('bottom', '-140px');
            $(playBtn).on('click', function() {
                $('#playbar').css('bottom', 0);
                console.log('aaaa');
                player.play();
            });
        }
        var myThemePath = script_base_url + '/wp-content/themes/unison-vrrb/get_product_details.php';
        var product_price;
        $.ajax({
            type: "POST",
            url: myThemePath,
            data: {
                'product_id': product_id
            },
            success: function(data) {
                product_price = data.product_price;
                var product_link = data.product_link;
                var product_title = data.product_title;
                var p_downloads = data.p_downloads;
                var type_p = data.type_p;
                $(cartDownCont).show();
                $(btnAddCartDown).removeClass('test-button download-button autoOrder');
                if (product_price == 0) {
                    $(btnAddCartDown).addClass('download-button autoOrder');
                } else {
                    $(btnAddCartDown).addClass('test-button');
                }
                jQuery("#playbar #defaultbutton .test-button").attr({
                    // "href": product_link,
                    "data-product_id": product_id,
                    "data-quantity": 1,
                    "data-product_title": product_title,
                });
                jQuery('input[name=add-to-cart]').val(product_id);
                jQuery("#p_type_free").attr({
                    "value": type_p
                });
                jQuery("#p_price_free").attr({
                    "value": product_price
                });
                jQuery("#p_downloads_free").attr({
                    "value": p_downloads
                });
                if (product_price > 0) {
                    var data = {
                        action: 'is_user_logged_in',
                        button_text: 'Add to cart'
                    };
                    jQuery.post(myThemePath, data, function(response) {
                        if (response == 'no') {
                            $('.button_title').text(data.button_text);
                            var product = {
                                'id': product_id,
                                'title': product_title
                            }
                            sessionStorage.setItem("product_data", JSON.stringify(product));
                        }
                    });
                } else {
                    var data = {
                        action: 'is_user_logged_in',
                        button_text: 'Download'
                    };
                    jQuery.post(myThemePath, data, function(response) {
                        if (response == 'no') {
                            $('.button_title').text(data.button_text);
                        }
                    });
                }
            }
        });
    }
    this.run = function() {
        $('body').on('click', '.js-sound', self.playAudio);
        // $('#playbar').css('bottom', 0);
        $('.js-defaultsound').on('click', function() {
            $(".js-defaultsound").unbind("click");
            $(this).removeClass('js-defaultsound');
            $('#js-defaultsound').on('click', self.playAudio).trigger('click');
            $("#js-defaultsound").unbind("click");
        });
    }
    self.run();
};
var audio = new AudioSample();

function onClickTabsHandler() {
    var l = $('.js-tab--contact li');
    $(l).on('click', function() {
        var i = $(this).index();
        $('.js-tab--contact li').removeClass('selected');
        $(this).addClass('selected');
        $('.js-contain--contact').find('> div').hide();
        $('.js-contain--contact').find(' > div:eq(' + i + ')').velocity({
            opacity: 1
        }, {
            display: 'block',
            complete: function() {
                $('.js-contain--contact').find('> div').removeClass('show display hide');
                $(this).addClass('show');
                $('.default-usage-select').parents('.jquery-selectbox').unselectbox();
                $('.default-usage-select').selectbox();
            }
        });
    });
}

onClickTabsHandler();

function onClickTabsAccountHandler() {
    var l = $('.js-tab--account li');
    $(l).on('click', function() {
        var i = $(this).index();
        $('.js-tab--account li').removeClass('selected');
        $(this).addClass('selected');
        $('.js-contain--account').find('> div').hide();
        $('.js-contain--account').find(' > div:eq(' + i + ')').velocity({
            opacity: 1
        }, {
            display: 'block',
            complete: function() {
                $('.js-contain--account').find('> div').removeClass('show display hide');
                $(this).addClass('display');
                $('.default-usage-select').selectbox();
            }
        });
    });
}

onClickTabsAccountHandler();

function showSearh() {
    $('.btn-search').on('click', function(evt) {
        evt.preventDefault();
        $('#search').velocity({
            opacity: 0
        }, {
            duration: 100,
            complete: function() {
                $(this).velocity({
                    opacity: 1
                }, {
                    display: 'block'
                })
            }
        });
    });
}

showSearh();

function onClickOpenHidePopupLogin() {
    $('.js-account').on('click', function(event) {
        event.preventDefault();
    });
    $('.js-close-account').on('click', function(event) {
        event.preventDefault();
        hidePopupLogin();
    });
    $('.js-ovl-close').on('click', function(event) {
        event.preventDefault();
        $('#search ').velocity({
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
    });

    function hidePopupLogin() {
        $('#account, #updateprofile, #changepass, #search , #lostpass').velocity({
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
        // $('.js-contain--account > div').removeClass('show display hide');
    }
}

onClickOpenHidePopupLogin();

function openPopupLogin() {
    console.log('openlogin')
    $('#account').velocity({
        opacity: 0
    }, {
        duration: 100,
        complete: function() {
            $(this).velocity({
                opacity: 1
            }, {
                display: 'block'
            })
            $('.js-tab--account li:eq(0)').trigger('click');
        }
    });
}

function onClickOpenHidePopupElse() {
    $('.js-update-profile').on('click', function(event) {
        event.preventDefault();
        openPopupProfile();
    });
    $('.js-change-password').on('click', function(event) {
        event.preventDefault();
        openPopupChangePass();
    });

    function openPopupProfile() {
        $('#updateprofile').velocity({
            opacity: 0
        }, {
            duration: 100,
            complete: function() {
                $(this).velocity({
                    opacity: 1
                }, {
                    display: 'block',
                    complete: function() {
                        $(this).find('.profile').addClass('display');
                        $('.default-usage-select').parents('.jquery-selectbox').unselectbox();
                        $('.default-usage-select').selectbox();
                        $('.js-list-country').on('change', UNISON.booking.changeCountry);
                        $('.js-submit-profile').on('click', UNISON.member.updateProfile);
                    }
                });
            }
        });
    }

    function openPopupChangePass() {
        $('#changepass').velocity({
            opacity: 0
        }, {
            duration: 100,
            complete: function() {
                $(this).velocity({
                    opacity: 1
                }, {
                    display: 'block',
                    complete: function() {
                        $(this).find('.change-pass').addClass('display');
                        $('.default-usage-select').parents('.jquery-selectbox').unselectbox();
                        $('.default-usage-select').selectbox();
                    }
                });
            }
        });
    }
}

onClickOpenHidePopupElse();

function onClickTabsPaymentHandler() {
    var l = $('.js-tab--payment li');
    $(l).on('click', function() {
        var i = $(this).index();
        $('.js-tab--payment li').removeClass('selected');
        $(this).addClass('selected');
        $('.js-contain--payment').find('> div').hide();
        $('.js-contain--payment').find(' > div:eq(' + i + ')').velocity({
            opacity: 1
        }, {
            display: 'block',
            complete: function() {
                $('.js-contain--payment').find('> div').removeClass('show display hide');
                $(this).addClass('display');
            }
        });
    });
}

function onClickCustomerSupport() {
    $('.list-support li').on('click', function() {
        if ($(this).hasClass('active')) {
            return;
        } else {
            $('.list-support li').removeClass('active');
            $(this).addClass('active');
        }
    });
}

onClickCustomerSupport();

function animateFilter() {
    $('.js-artist-list > div').velocity("transition.slideUpIn", {
        stagger: 50
    });
}

function animateSamplePack() {
    $('.js-samplepack-list > div').velocity("transition.slideUpIn", {
        stagger: 50
    });
}

$(function() {
    $('.rating li').on('click', function() {
        var selectedCssClass = 'selected';
        var $this = $(this);
        $this.siblings('.' + selectedCssClass).removeClass(selectedCssClass);
        $this.addClass(selectedCssClass).parent().addClass('vote-cast');
    });
    $('.js-write-review').on('click', function(evt) {
        evt.preventDefault();
        $('.write-review').show();
    });
});

function initLoadItemWhenScroll() {
    var $fwindow = $(window),
        scrollTop = window.pageYOffset || document.documentElement.scrollTop,
        hscreen = getDocumentSize(3);
    $fwindow.on('scroll', function() {
        scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        if (scrollTop >= (hscreen - 200)) {
            UNISON.artists.pagingContent();
        }
    });
}

initLoadItemWhenScroll();
