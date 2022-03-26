$(document).ready(function() {

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

});



function AudioSample(selector) {

    var self = this;
    this.$audio = $(selector);

    var audioPlayer = $('.js-wrap-audio');


    this.playAudio = function(event) {
        event.preventDefault();

        var pathFile = $(this).attr('data-file'),
            samplepack = '<audio id="music"><source src="' + pathFile + '" type="audio/ogg"></audio>';

        $('.js-sound').not($(this)).removeClass('pause');

        if (!$(this).hasClass('pause')) {
            $(this).addClass('pause');
            audioPlayer.find('audio').remove();
            audioPlayer.append(samplepack);
            document.getElementById("music").play();
        } else {
            $(this).removeClass('pause');
            audioPlayer.find('audio').remove();
        }

    }

    this.run = function() {
        $('.js-sound').on('click', self.playAudio);
    }

    self.run();

};

var audio = new AudioSample('#audio');










function onClickTabsHandler() {

    var l = $('.js-tab--contact li');

    $(l).on('click', function() {
        var i = $(this).index();

        $('.js-tab--contact li').removeClass('selected');
        $(this).addClass('selected');


        $('.js-contain--contact').find('> div').hide();

        $('.js-contain--contact').find(' > div:eq(' + i + ')').velocity({ opacity: 1 }, {
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

        $('.js-contain--account').find(' > div:eq(' + i + ')').velocity({ opacity: 1 }, {
            display: 'block',
            complete: function() {
                $('.js-contain--account').find('> div').removeClass('show display hide');
                $(this).addClass('display');
            }
        });

    });

}

onClickTabsAccountHandler();




function onClickOpenHidePopupLogin() {

    $('.js-account').on('click', function(event) {
        event.preventDefault();
    });


    $('.js-close-account').on('click', function(event) {
        event.preventDefault();
        hidePopupLogin();
    });

    function hidePopupLogin() {
        $('body').css({ 'overflow-x': 'hidden', 'overflow-y': 'scroll' });
        $('#account, #updateprofile, #changepass').velocity({ opacity: 0 }, {
            duration: 300,
            complete: function() {
                $(this).velocity({ opacity: 0 }, { display: 'none' })
            }
        });
        // $('.js-contain--account > div').removeClass('show display hide');
    }

}

onClickOpenHidePopupLogin();


function openPopupLogin() {

    $('body').css({ overflow: 'hidden' });
    $('#account').velocity({ opacity: 0 }, {
        duration: 100,
        complete: function() {
            $(this).velocity({ opacity: 1 }, { display: 'block' })
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
        $('body').css({ overflow: 'hidden' });
        $('#updateprofile').velocity({ opacity: 0 }, {
            duration: 100,
            complete: function() {
                $(this).velocity({ opacity: 1 }, {
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
        $('body').css({ overflow: 'hidden' });
        $('#changepass').velocity({ opacity: 0 }, {
            duration: 100,
            complete: function() {
                $(this).velocity({ opacity: 1 }, {
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

        $('.js-contain--payment').find(' > div:eq(' + i + ')').velocity({ opacity: 1 }, {
            display: 'block',
            complete: function() {
                $('.js-contain--payment').find('> div').removeClass('show display hide');
                $(this).addClass('display');
            }
        });

    });

}
//onClickTabsPaymentHandler();

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
    $('.js-artist-list > div').velocity("transition.slideLeftIn", { stagger: 50 });
}

$(function() {
    $('.rating li').on('click', function() {
        var selectedCssClass = 'selected';
        var $this = $(this);
        $this.siblings('.' + selectedCssClass).removeClass(selectedCssClass);
        $this
            .addClass(selectedCssClass)
            .parent().addClass('vote-cast');
    });

    $('.js-write-review').on('click', function(evt) {
        evt.preventDefault();
        $('.write-review').show();
    });
});