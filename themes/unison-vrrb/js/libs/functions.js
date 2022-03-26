var UNISON ={
  _countError : 0,
  init: function() {

    UNISON.samplePacks.init();
    UNISON.artists.init();
    UNISON.member.init();
    UNISON.booking.init();
    UNISON.payment.init();

    $('.js-btn-submit').on('click' , UNISON.addNewsletter);
    $('.js-btn-contact').on('click' , UNISON.submitContact);

    $('.js-btn-search').on('click', UNISON.searchGoogle);
    $('.js-input-search').on('keypress', UNISON.enterSearchGoogle);
  },
  __callAuto: function() {

  },
  addErrorForm : function(_key_ , _message_) {
    $(_key_).addClass('error');
    $(_key_).parent().append('<span class="message-error">' + _message_ + '</span>');
    UNISON._countError = UNISON._countError + 1;
  },
  removeErrorForm : function(_form_) {
    $(_form_).find('input , textarea , select ').removeClass('error');
    $(_form_).find('.message-error').remove();
    UNISON._countError = 0;
  },
  enterSearchGoogle : function(e){
    if(e.which == 13 || e.keyCode == 13 ) {
      UNISON.searchGoogle(e);
    }
  },
  searchGoogle : function(e) {
    if($('.js-input-search').val() == '') {
      return false;
    }
    $(this).parents('form').submit();
  },
  submitContact : function(e) {
    e.preventDefault();

    UNISON.removeErrorForm($('.frmContact'));

    var firstName   = $('.frmContact input[name=first_name]');
    var lastName    = $('.frmContact input[name=last_name]');
    var email       = $('.frmContact input[name=email]');
    var phone       = $('.frmContact input[name=phone]');
    var language    = $('.frmContact input[name=language]');
    var daw         = $('.frmContact input[name=daw]');
    var location    = $('.frmContact select[name=location]');
    var price       = $('.frmContact input[name=price]');
    var soundCloud  = $('.frmContact input[name=sound_cloud]');
    var interestedSigning  = $('.frmContact input[name=interested_signing]');
    var message     = $('.frmContact textarea[name=message]');

    if(BE.functions.checkEmpty($(firstName).val()) ) {
      UNISON.addErrorForm(firstName , "Please enter your first name."  );
    }
    if(BE.functions.checkEmpty($(lastName).val()) ) {
      UNISON.addErrorForm(lastName , "Please enter your last name." );
    }
    if(BE.functions.checkEmpty($(email).val()) ) {
      UNISON.addErrorForm(email , "Please enter your email." );
    } else {
      if(!BE.functions.checkEmail($(email).val()) ) {
        UNISON.addErrorForm(email , "The format of email is incorrect." );
      }
    }
    if(BE.functions.checkEmpty($(phone).val()) ) {
      UNISON.addErrorForm(phone , "Please enter your phone number." );
    }
    if(BE.functions.checkEmpty($(language).val()) ) {
      UNISON.addErrorForm(language , "Please enter your language." );
    }
    if(BE.functions.checkEmpty($(daw).val()) ) {
      UNISON.addErrorForm(daw , "Please enter your daw." );
    }
    if(BE.functions.checkEmpty($(location).val()) ) {
      UNISON.addErrorForm(location , "Please enter your location." );
    }
    if(BE.functions.checkEmpty($(price).val()) ) {
      UNISON.addErrorForm(price , "Please enter your price Per/hr." );
    }
    if(BE.functions.checkEmpty($(soundCloud).val()) ) {
      UNISON.addErrorForm(soundCloud , "Please enter your sound cloud link." );
    }
    if(BE.functions.checkEmpty($(message).val()) ) {
      UNISON.addErrorForm(message , "Please enter your sound message." );
    }

    if(UNISON._countError == 0) {
      BE.loading.showLoading();
      $.post( $('.frmContact').attr('action') , $('.frmContact').serializeArray() , function(response) {
        BE.loading.hideLoading();
        BE.alert(response.message);
        if(response.status == 1) {
          $('.frmContact')[0].reset();
        }
      }, 'json');
    }
  },
  addNewsletter : function(e) {
    e.preventDefault();
    UNISON.removeErrorForm($('.frmNewsletter'));

    var name      = $('.frmNewsletter input[name=name]');
    var email     = $('.frmNewsletter input[name=email]');

    if(BE.functions.checkEmpty($(name).val()) ) {
      UNISON.addErrorForm(name , "Please enter your name."  );
    }
    if(BE.functions.checkEmpty($(email).val()) ) {
      UNISON.addErrorForm(email , "Please enter your email."  );
    } else {
      if(!BE.functions.checkEmail($(email).val()) ) {
        UNISON.addErrorForm(email , "The format of email is incorrect."  );
      }
    }

    if(UNISON._countError == 0) {
      BE.loading.showLoading();
      $.post( $('.frmNewsletter').attr('action') , $('.frmNewsletter').serializeArray() , function(response) {
        BE.loading.hideLoading();
        BE.alert(response.message);
        if(response.status == 1) {
          $('.frmNewsletter')[0].reset();
        }
      }, 'json');
    }

  },
  customParseJSON : function (data) {
    if(!BE.functions.checkEmpty(data) ) {
      return $.parseJSON(data);
    }
    return '';
  },
  convertPrice : function(price) {
    return '$' + price;
  }
};

UNISON.booking = {
  lessionWithTimeZones : UNISON.customParseJSON($('.js-lession-times').val()),
  lessionTimes : [],
  defaultTimeZone : 'US' ,
  changeTimeZone : 'US' ,
  init : function() {
    $('.back-date').on('click' , UNISON.booking.backDatePicker);
    $('.js-checkout-booking').on('click' , UNISON.booking.checkout);
    $('.js-time-zone').on('change' , UNISON.booking.changeTimeZone);

    if (Countries.hasOwnProperty($('.js-location-code').attr('data-code'))) {
      UNISON.booking.changeTimeZone = UNISON.booking.defaultTimeZone = Countries[$('.js-location-code').attr('data-code')].zones[0];
    }
    UNISON.booking.lessionTimes = UNISON.booking.lessionWithTimeZones;
    console.log(UNISON.booking.lessionTimes);
  },
  changeTimeZone : function(e) {
    e.preventDefault();

    var _country  = $(this).val();
    var phoneCode = $(this).find('option:selected').attr('id');
    var countryCode = $(this).find('option:selected').attr('data-code');
    $('.phone-code').text('(+' + phoneCode + ')');
    $.post( $(this).attr('data-href') , { country : $(this).val() } , function(reponse) {

      var options = '';
      $.each(reponse.data.cityList , function(i, item) {
        options += '<option value="'+ item.id +'">'+ item.name +'</option>';
      });

      $('.js-list-city').html(options);
      $(".js-list-city").parents('.jquery-selectbox').unselectbox();
      $(".js-list-city").selectbox();

    }, 'json');

    if (Countries.hasOwnProperty(countryCode)) {
      UNISON.booking.convertDatesBetweenTimezones(Countries[countryCode].zones[0]);
    }
  },
  convertDatesBetweenTimezones : function( _timeZone_ , _dateFormat = "YYYY-MM-DD H:m" ) {
    UNISON.booking.changeTimeZone = BE.functions.checkEmpty(_timeZone_) ? _timeZone_ : _timeZone_;
    UNISON.booking.lessionWithTimeZones = [];

    $.each(UNISON.booking.lessionTimes , function(date , item) {
      var formatDate = moment(date).format('YYYY-MM-DD');
      $.each(item , function(i , hour) {
        var currentTime = moment(hour.toUpperCase() , ["h:mm A"]).format("HH:mm");
        var addDateWithTime = formatDate +" "+currentTime;
        var _moment = moment.tz(addDateWithTime , _dateFormat , UNISON.booking.defaultTimeZone);
        var _convertMoment = _moment.clone().tz(UNISON.booking.changeTimeZone);
        var _dateConvert = _convertMoment.format('MM/DD/YYYY');
        var _timeConvert = _convertMoment.format('h:mm A');

        if(typeof UNISON.booking.lessionWithTimeZones[_dateConvert] === 'undefined') {
          UNISON.booking.lessionWithTimeZones[_dateConvert] = [];
        }
        UNISON.booking.lessionWithTimeZones[_dateConvert].push(_timeConvert);
      });
    });

    $( "#datepicker" ).datepicker({
     onSelect: function(date) {
      UNISON.booking.chooseDate(date);
     },
     minDate: new Date(),
     beforeShowDay: UNISON.booking.disableSpecificDates
    });

    UNISON.booking.backDatePicker();
  },
  disableSpecificDates : function (_date_) {
    var m = _date_.getMonth();
    var d = _date_.getDate();
    var y = _date_.getFullYear();
    var currentdate = ("0" + (m + 1)).slice(-2) + '/' + ("0" + d).slice(-2) + '/' + y ;
    if (UNISON.booking.lessionWithTimeZones.hasOwnProperty(currentdate)) {
       return [true, ''];
    }
    return [false];
  },
  chooseDate : function(_date_) {
    //if(!BE.functions.checkEmpty(UNISON.booking.lessionWithTimeZones) ) {
      if (UNISON.booking.lessionWithTimeZones.hasOwnProperty(_date_)) {
        UNISON.booking.outputHtmlTimes(UNISON.booking.lessionWithTimeZones[_date_] , _date_);
        console.log(UNISON.booking.lessionWithTimeZones[_date_]);
      } else {
        BE.alert("Sorry , the artist don't have time on this day.");
      }
    /*}else {
        BE.alert("Sorry , the artist don't have time on this day.");
    }*/
  },
  outputHtmlTimes : function(times , _date_) {
    var output = '' , timeFisrt = '';
    var index = 0;
    $.each(times, function(i, item) {
      output += '<li>'+item.toUpperCase()+'</li>';
      timeFisrt = index == 0 ? item.toUpperCase() : timeFisrt;
      index++;
    });
    index = times.length > 0 ? times.length : index;
    var formatted = $.datepicker.formatDate("d M yy", new Date(_date_));
    $('.js-title-date').text(formatted);
    $('.js-all-times').text(timeFisrt +' - '+ times[index - 1].toUpperCase() );
    $('.js-list-date').removeClass('display');
    $('.js-list-hours').addClass('display');
    $('.js-list-times').html(output);

    $('.js-title-dates').text( $('.js-title-dates').attr('data-title-time') );
    $('.back-date').show();

    //add booking
    $('.frmBooking input[name=date_lession]').val(_date_);
    $('.js-list-times > li').on('click' , UNISON.booking.chooseLessionsHour);
  },
  chooseLessionsHour : function(e) {
    e.preventDefault();
    if( $(this).hasClass('selected') ) {
      $(this).removeClass('selected');
    } else {
      $(this).addClass('selected');
    }

    var currentDate = $('.frmBooking input[name=date_lession]').val();
    var numberLession = 0;
    var output = '' , hours = '' , hoursArtist = '' , dateArtist = currentDate;
    $('.js-list-times > li.selected').each(function(item) {
      output += $(this).text().toUpperCase()+' - ';
      hours += $(this).text().toUpperCase() + '|';

      var dataDate = UNISON.booking.backDefaultTimeZones(currentDate , $(this).text());
      hoursArtist += dataDate.hours + '|';
      dateArtist += dataDate.date != '' ? dataDate.date + ',' : '';
      numberLession++;
    });
    output = output.substring(0,(output.length-2));

    var totalCost = numberLession * parseInt($('.js-lession-cost').attr('data-cost')) ;
    $('.js-choose-houses').html(output);
    $('.js-total-money').html( UNISON.convertPrice(totalCost) );
    $('.frmBooking input[name=hours_lession]').val(hours);
    $('.frmBooking input[name=hours_artist]').val(hoursArtist);
    $('.frmBooking input[name=date_artist]').val(dateArtist);
  },
  backDatePicker : function() {

    $('.js-list-date').addClass('display');
    $('.js-list-hours').removeClass('display');

    $('.js-title-dates').text( $('.js-title-dates').attr('data-title-date') );
    $('.back-date').hide();

    $('.js-title-date').html('--');
    $('.js-choose-houses').html('--');
    $('.js-total-money').html( UNISON.convertPrice(0) );
    $('.frmBooking input[name=date_lession] , .frmBooking input[name=date_artist]').val('');
    $('.frmBooking input[name=hours_lession] , .frmBooking input[name=hours_artist]').val('');

  },
  backDefaultTimeZones : function(currentDate , _hours_) {


    var formatDate = moment(currentDate).format('YYYY-MM-DD');
    var currentTime = moment(_hours_ , ["h:mm A"]).format("HH:mm");
    var addDateWithTime = formatDate +" "+currentTime;
    var _moment = moment.tz(addDateWithTime  , UNISON.booking.changeTimeZone);
    var _convertMoment = _moment.clone().tz(UNISON.booking.defaultTimeZone);
    var _dateConvert = _convertMoment.format('MM/DD/YYYY');
    var data = {};
    data.date  =  currentDate == _convertMoment.format('MM/DD/YYYY') ? '' : _convertMoment.format('MM/DD/YYYY') ;
    data.hours =  _convertMoment.format('h:mm A');
    return data;

  },
  checkout : function(e) {
    e.preventDefault();
    var _this_ = $(this);
   if(UNISON.member.checkLoginJs(1)) {

      UNISON.removeErrorForm($('.frmBooking'));

      var firstName   = $('.frmBooking input[name=first_name]');
      var lastName    = $('.frmBooking input[name=last_name]');
      var email       = $('.frmBooking input[name=email]');
      var phone       = $('.frmBooking input[name=phone]');
      var country     = $('.frmBooking input[name=country]');
      var city        = $('.frmBooking input[name=city]');
      var dateLession = $('.frmBooking input[name=date_lession]');
      var hoursLession= $('.frmBooking input[name=hours_lession]');

      if(BE.functions.checkEmpty($(firstName).val()) ) {
        UNISON.addErrorForm(firstName , "Please enter your first name."  );
      }
      if(BE.functions.checkEmpty($(lastName).val()) ) {
        UNISON.addErrorForm(lastName , "Please enter your last name."  );
      }
      if(BE.functions.checkEmpty($(email).val()) ) {
        UNISON.addErrorForm(email , "Please enter your email."  );
      } else {
        if(!BE.functions.checkEmail($(email).val()) ) {
          UNISON.addErrorForm(email , "The format of email is incorrect."  );
        }
      }
      if(BE.functions.checkEmpty($(phone).val()) ) {
        UNISON.addErrorForm(phone , "Please enter your phone number."  );
      }
      if(BE.functions.checkEmpty($(dateLession).val()) ) {
        BE.alert("Please choose the date."); return false;
      }
      if(BE.functions.checkEmpty($(hoursLession).val()) ) {
        BE.alert("Please choose the hours."); return false;
      }

      if(UNISON._countError == 0) {
        BE.loading.showLoading();
        $.post( $('.frmBooking').attr('action') , $('.frmBooking').serializeArray() , function(response) {
          BE.loading.hideLoading();
          if(response.status == 1) {
            location.href = $(_this_).attr('href');
          } else {
            BE.alert(response.message);
          }
        }, 'json');
      }

    }

  }
}


UNISON.samplePacks = {
  init : function() {
    $('.js-samplepacks-filter').on('click' , UNISON.samplePacks.filterParks );
    $('.js-samplepacks-genres').on('change' , UNISON.samplePacks.genres );
    $('.js-samplepacks-search').on('click' , UNISON.samplePacks.checkSearch );
    $('.js-search').on('keypress' , UNISON.samplePacks.enterSearch );

    UNISON.samplePacks.initCart();
  },
  initCart : function() {
    $('.js-add-cart').on('click' , UNISON.samplePacks.addToCart );
    $('.js-remove-cart').on('click' , UNISON.samplePacks.removeCart );
  },
  removeCart : function(e) {
    e.preventDefault();
    var data = {};
    data.itemId  = $(this).attr('data-id');

    var _this_ = $(this);
    BE.loading.showLoading();
    $.post($(this).attr('href') , data , function(_response){
      BE.loading.hideLoading();

      $('.js-total-item-cart').text(_response.data.totalItemInCart);
      $('.js-half-' + data.itemId).remove()
      $(_this_).parents('.cart-item').remove();

      $('.js-subtotal-cart').text(_response.data.subTotalCart);
      $('.js-discount-price').text(_response.data.totalDiscount);
      $('.js-total-cart').text(_response.data.totalCart);

    });

  },
  addToCart : function(e) {
    e.preventDefault();

    var data = {};
    data.quantity = $(this).attr('data-quantity');
    data.itemId  = $(this).attr('data-id');

    BE.loading.showLoading();
    $.post($(this).attr('href') , data , function(_response){
      BE.loading.hideLoading();
      $('.js-total-item-cart').text(_response.data.totalItemInCart);
    });

  },
  enterSearch : function(e) {
    if(e.which == 13) {
      UNISON.samplePacks.filter();
    }
  },
  checkSearch : function(e) {
    e.preventDefault();
    if(BE.functions.checkEmpty($('.js-search').val()) ) {
      BE.alert("Please enter the keywork."); return false;
    }
    UNISON.samplePacks.filter();
  },
  filterParks : function(e) {
    e.preventDefault();
    $('.js-samplepacks-filter').removeClass('selected');
    $(this).addClass('selected');
    UNISON.samplePacks.filter();
  },
  genres : function(e) {
    e.preventDefault();
    UNISON.samplePacks.filter();
  },
  filter : function() {

    var data = {};
    data.filter = $('.js-samplepacks-filter.selected').attr('data-type');
    data.genres = $('.js-samplepacks-genres').val();
    data.search = $('.js-search').val();
    data.page   = $('.js-samplepack-list').attr('data-page');

    BE.loading.showLoading();
    $.get($('.samplepacks-filter').attr('data-href') , data , function(_response){
      BE.loading.hideLoading();
      $('.js-samplepack-list').html(_response);
      UNISON.samplePacks.initCart();
      animateSamplePack();
    });
  }

}

UNISON.artists = {
  init: function() {
    $('.js-artists-filter').on('click' , UNISON.artists.filterGenres );

    $('.js-send-review').on('click' , UNISON.artists.sendReview );
    $('.rating .vote').on('click' , UNISON.artists.addColorRating );

    $('.write-review textarea').on('keyup' , UNISON.artists.checkNumberReview );
    $('.write-review textarea').on('paste' , UNISON.artists.checkParseNumberReview );

    $('.js-next-content').on('click' , UNISON.artists.nextSlideContent );
    $('.js-prev-content').on('click' , UNISON.artists.prevSlideContent );
  },
  pagingContent : function() {
    alert('DONE');
  },
  nextSlideContent : function(e) {
    e.preventDefault();

    var totalPage = $(this).attr('data-maxpage');
    var currentPage = $(this).attr('data-page');
    if( totalPage >= currentPage ) {
      $.get($(this).attr('href') , { 'page' : parseInt(currentPage) + 1 , 'call' : 'js'  } , function(_response) {
        $('.js-item-list').html(_response);
        currentPage++;

        $('.js-prev-content').attr('data-page' , currentPage );
        $('.js-next-content').attr('data-page' , currentPage );
        $('.js-prev-content').removeClass('hide');
        if(totalPage <= currentPage) $('.js-next-content').addClass('hide');
      }) ;
    }

  },
  prevSlideContent : function(e) {
    e.preventDefault();

    var totalPage = $(this).attr('data-maxpage');
    var currentPage = $(this).attr('data-page');
    if( currentPage > 0 ) {
      $.get($(this).attr('href') , { 'page' :parseInt(currentPage)-1 , 'call' : 'js' } , function(_response) {
        $('.js-item-list').html(_response);
        currentPage--;
        $('.js-prev-content').attr('data-page' , currentPage );
        $('.js-next-content').attr('data-page' , currentPage );
        $('.js-next-content').removeClass('hide');
        if(currentPage == 1) $('.js-prev-content').addClass('hide');
      }) ;
    }

  },
  filterGenres : function(e) {
    e.preventDefault();

    $('.js-artists-filter').removeClass('selected');
    $(this).addClass('selected');

    var data = {};
    data.genres = $(this).attr('data-id');
    data.page = $('.js-artist-list').attr('data-page');
    BE.loading.showLoading();
    $.get($(this).parents('.artists-filter').attr('data-href') , data , function(_response){
      BE.loading.hideLoading();
      $('.js-artist-list').html(_response.data.outputHtml);
      _response.data.totalPage <= 1 ? $('.js-artist-list').parents('.item-block').find('.js-next').hide() : $('.js-artist-list').parents('.item-block').find('.js-next').show() ;
      animateFilter();
      var artists = new Gallery('#artist-slider');
    } , 'json');
  },
  addColorRating : function() {
    $(this).parents('.rating').find('li').removeClass('selected');
    $(this).addClass('selected');
    var currentIndex = $('.rating li.selected').index();
    for (var i = 0; i <= currentIndex; i++) {
      $('.rating li:eq('+i+')').addClass('selected');
    }
  },
  checkNumberReview : function(e){
    var keycode = e.keyCode ? e.keyCode : e.which;
    var currentNumber = $(this).val().length;
    $('.js-total-char').text(currentNumber);
  },
  checkParseNumberReview : function(e) {
    var _this = $(this);
    setTimeout(function () {
        var currentNumber = $(_this).val().length;
        $('.js-total-char').text(currentNumber);
    }, 100);
  },
  sendReview : function(e) {
    e.preventDefault();

    var dataPost = {};
    dataPost.review = $('.write-review textarea[name=review]').val();
    dataPost.rate   = parseInt($('.rating li.selected:last').index()) + 1;

    if(BE.functions.checkEmpty(dataPost.review) ) {
      BE.alert("Please enter your review."); return false;
    } else {
      if(dataPost.review.length < 75) {
        BE.alert("Please type at least 75 letters to make a good review for our artist."); return false;
      }
    }
    if(dataPost.rate == 0 ) {
      BE.alert("Please rate for the artist."); return false;
    }

    BE.loading.showLoading();
    $.post( $(this).attr('data-href') , dataPost , function(response) {
      BE.loading.hideLoading();
      location.reload();
    }, 'json');


  }
}

UNISON.payment = {
  init : function() {
    $('.js-btn-payment').on('click' , UNISON.payment.checkout);
    $('.js-btn-promo').on('click' , UNISON.payment.promoCode);
    $('.js-input-promo').on('keypress' , UNISON.payment.checkEnterPromoCode);

    $('.js-btn-review-cart').on('click' , UNISON.payment.reviewCart);
  },
  reviewCart : function(e) {
    e.preventDefault();
    if(UNISON.member.checkLoginJs(1)) {
      if($(this).attr('data-total') > 0) {
        $(this).parents('form').submit();
      } else {
         BE.alert("Your cart is empty."); return false;
      }

    }
  },
  checkEnterPromoCode : function(e) {
    if(e.which == 13) {
      UNISON.payment.promoCode(e);
    }
  },
  promoCode : function(e) {
    e.preventDefault();
    if(BE.functions.checkEmpty($('.js-input-promo').val()) ) {
      BE.alert("Please input the promo code."); return false;
    }

    var dataPost = {};
    dataPost.action = 'PROMOCODE';
    dataPost.code = $('.js-input-promo').val();
    $.post($('.js-btn-promo').attr('data-href') , dataPost , function(_response){
      if(_response.status == 1) {
        $('.js-discount-price').text(_response.data.totalDiscount);
        $('.js-total-cart').text(_response.data.totalCart);
      } else {
        jAlert(_response.message);
      }
    });
  },
  checkout : function(e) {
    e.preventDefault();

    $('.frmPayment').submit();

    //$.post($(this).attr('data-href') , {'r' : Math.random() } , function(){
      //$('.frmPayment').submit();
    //});
  }
}

UNISON.member = {
  _isLoad: false,
  _isLogin: $('meta[name=_chkuid]').attr("content"),
  _urlAvatar: '',
  _redirectUrl : '',
  init: function () {

    $('.js-btn-facebook').on('click', UNISON.member.loginFacebook);
    $('.js-btn-login').on('click', UNISON.member.loginNormal);
    $('.js-btn-register').on('click', UNISON.member.register);

    $('.js-update-info').on('click', UNISON.member.updateInfo);

    $('.js-check-login').on('click' , UNISON.member.checkLogin);
    $('.js-change-pass').on('click' , UNISON.member.changePass);
    //$('.js-submit-profile').on('click' , UNISON.member.updateProfile);

    $('.js-btn-upload').on('click' , function(){
      $('.js-input-file').click();
    });


    $('.js-input-file').change(function () {
      var fileExtension = ['jpg', 'png', 'jpeg'];
      if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 || this.files[0].size > (3*1024*1024) ) {
        $(this).val('');
        jAlert('You can only attach .jpg, .png, and .jpeg files that are less than 3MB in size'); return false;
      } else {

        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return false;

        if (files[0].size > 5242880) {
            jAlert("Vui lòng gửi hình dự thi có dung lượng dưới 5Mb"); return false;
        }

        if ($.inArray($(this).val().split('.').pop().toLowerCase(), BE.functions._allowExtension) == -1) {
            jAlert("Bạn vui lòng chỉ tải ảnh với định dạng .jpeg .jpg  .png  .gif  .bmp");
        } else {
            if (/^image/.test(files[0].type)) {
                var reader = new FileReader();
                reader.readAsDataURL(files[0]);

                reader.onloadend = function () {

                  var data = {};
                  data.image = this.result;
                  BE.loading.showLoading();
                  $.post($(".js-page-profile").attr("href"), data , function (_response) {
                    BE.loading.hideLoading();
                     $(".js-preview-avatar").attr("src",   data.image );
                  }, 'json');
                }
            }
        }


      }
    });

  },
  checkLogin : function(e) {
    e.preventDefault();
    UNISON.member._redirectUrl = $(this).attr('href');
    if(UNISON.member.checkLoginJs(1)) {
      location.href = UNISON.member._redirectUrl;
    }
  },
  checkLoginJs: function (_login) {
    if ( parseInt(UNISON.member._isLogin) == 0 || !BE.functions.isNumber(UNISON.member._isLogin) ) {
      if (_login == 1) {
        openPopupLogin();
        //$('#account').show();
      }
      return false;
    }
    return true;
  },
  loginFacebook: function (e) {
    if (typeof e != 'undefined') e.preventDefault();
    if (typeof FB != 'undefined') {
      UNISON.member._isLoad = false;

      clearInterval(UNISON.member._setInterval);
      var loginUrl = $(this).attr('data-href');
      var permissions = "email,public_profile";
      BE.loading.showLoading();
      FB.getLoginStatus(function (response) {
        if (response.status === 'connected') {
            UNISON.member.login(response.authResponse.accessToken);
        } else {
          FB.login(function (response) {
            if (response.status === 'connected') {
              UNISON.member.login(response.authResponse.accessToken);
            } else {
              BE.loading.hideLoading();
            }
          }, { perms: permissions });
        }
      });
    } else {
      jAlert('Đang tải Api Facebook , vui lòng chờ trong giây lát.');
      UNISON.member._setInterval = setInterval(function () {
          if (UNISON.member._isLoad) { UNISON.member.login(e); }
      }, 200);
    }
  },
  login: function (_accessToken) {

    var result = {};
    result.accessToken = _accessToken;
    result.action = 'LOGINFB';
    $.post($(".js-btn-facebook").attr("href"), result, function (_response) {
      BE.loading.hideLoading();
      if (_response.status == 1) {

        UNISON.member._isLogin = 1;
        if(!BE.functions.checkEmpty(UNISON.member._redirectUrl) ) {
          location.href = UNISON.member._redirectUrl;
        }

      } else {
          jAlert(_response.message);
      }
    }, 'json');
  },
  register: function (e) {
    e.preventDefault();

    UNISON.removeErrorForm($('.frmSignUp'));

    var firstName = $('.frmSignUp input[name=first_name]');
    var lastName  = $('.frmSignUp input[name=last_name]');
    var email     = $('.frmSignUp input[name=email]');
    var password  = $('.frmSignUp input[name=password]');
    var confirmPass = $('.frmSignUp input[name=confim-password]');

    if(BE.functions.checkEmpty($(firstName).val()) ) {
      UNISON.addErrorForm(firstName , "Please enter your first name."  );
    }
    if(BE.functions.checkEmpty($(lastName).val()) ) {
      UNISON.addErrorForm(lastName , "Please enter your last name."  );
    }
    if(BE.functions.checkEmpty($(email).val()) ) {
      UNISON.addErrorForm(email , "Please enter your email address.");
    } else {
      if(!BE.functions.checkEmail($(email).val()) ) {
        UNISON.addErrorForm(email , "The format of email not valid.");
      }
    }
    if(BE.functions.checkEmpty($(password).val()) ) {
      UNISON.addErrorForm(password , "Please enter your password.");
    } else {
      if( $(password).val() != $(confirmPass).val() ) {
        UNISON.addErrorForm(confirmPass , "The passwords you entered not match.");
      }
    }

    if(UNISON._countError == 0) {
      BE.loading.showLoading();
      $.post( $('.frmSignUp').attr('action') , $('.frmSignUp').serializeArray() , function(response) {
        BE.loading.hideLoading();
        jAlert(response.message , '' , function() {
          if(response.status == 1) {
            $('.frmSignUp')[0].reset();
            location.reload();
          }
        });
      }, 'json');
    }

  },
  loginNormal: function (e) {
    e.preventDefault();

    UNISON.removeErrorForm($('.frmSignIn'));

    var email    = $('.frmSignIn input[name=email]');
    var password = $('.frmSignIn input[name=password]');

    if(BE.functions.checkEmpty($(email).val()) ) {
      UNISON.addErrorForm(email , "Please enter your email address.");
    } else {
      if(!BE.functions.checkEmail($(email).val()) ) {
        UNISON.addErrorForm(email , "The format of email not valid.");
      }
    }
    if(BE.functions.checkEmpty($(password).val()) ) {
      UNISON.addErrorForm(password , "Please enter your password.");
    }

    if(UNISON._countError == 0) {
      BE.loading.showLoading();
      $.post($(this).parents('form').attr("action"), $('.frmSignIn').serializeArray(), function (_response) {
        BE.loading.hideLoading();
        if (_response.status == 1) {
          if(!BE.functions.checkEmpty(UNISON.member._redirectUrl) ) {
            location.href = UNISON.member._redirectUrl;
          } else {
            location.reload();
          }
        } else {
          jAlert(_response.message);
        }
      }, 'json');
    }
  },
  changePass: function (e) {
    e.preventDefault();

    UNISON.removeErrorForm($('.frmChangePass'));
    var currentPass = $('.frmChangePass input[name=current_password]');
    var confirmPass = $('.frmChangePass input[name=confim_password]');
    var password    = $('.frmChangePass input[name=password]');


    if(BE.functions.checkEmpty($(currentPass).val()) ) {
      UNISON.addErrorForm(currentPass , "Please enter your current password.");
    }
    if(BE.functions.checkEmpty($(password).val()) ) {
      UNISON.addErrorForm(password , "Please enter your password.");
    } else {
      if( $(password).val() != $(confirmPass).val() ) {
        UNISON.addErrorForm(confirmPass , "The passwords you entered not match.");
      }
    }

    if(UNISON._countError == 0) {
      BE.loading.showLoading();
      $.post($(this).parents('form').attr("action"), $('.frmChangePass').serializeArray(), function (_response) {
        BE.loading.hideLoading();
        if (_response.status == 1) {
          $('.js-close-account').click();
        } else {
          jAlert(_response.message);
        }
      }, 'json');
    }
  },
  updateProfile : function (e) {
    e.preventDefault();

    UNISON.removeErrorForm($('.frmUpdateProfile'));
    var firstName = $('.frmUpdateProfile input[name=first_name]');
    var lastName  = $('.frmUpdateProfile input[name=last_name]');
    var email     = $('.frmUpdateProfile input[name=email]');
    var country   = $('.frmUpdateProfile select[name=country]');
    var city      = $('.frmUpdateProfile select[name=city]');
    var phone     = $('.frmUpdateProfile input[name=phone]');

    if(BE.functions.checkEmpty($(firstName).val()) ) {
       UNISON.addErrorForm(firstName , "Please enter your first name.");
    }
    if(BE.functions.checkEmpty($(lastName).val()) ) {
      UNISON.addErrorForm(lastName , "Please enter your last name.");
    }
    if(BE.functions.checkEmpty($(email).val()) ) {
      UNISON.addErrorForm(email , "Please enter your email address.");
    } else {
      if(!BE.functions.checkEmail($(email).val()) ) {
        UNISON.addErrorForm(email , "The format of email not valid.");
      }
    }
    if(BE.functions.checkEmpty($(country).val()) ) {
      UNISON.addErrorForm(country , "Please choose your country.");
    }
    if(BE.functions.checkEmpty($(city).val()) ) {
      UNISON.addErrorForm(city , "Please choose your city.");
    }
    if(BE.functions.checkEmpty($(phone).val()) ) {
      UNISON.addErrorForm(phone , "Please enter your phone number.");
    }

    if(UNISON._countError == 0) {
      BE.loading.showLoading();
      $.post( $('.frmUpdateProfile').attr('action') , $('.frmUpdateProfile').serializeArray() , function(_response) {
        BE.loading.hideLoading();
        jAlert(_response.message , '' , function(){
          if (_response.status == 1) {
            location.reload();
          }
        });

      }, 'json');
    }
  }

}

$(document).ready(function () {
  UNISON.init();
});

