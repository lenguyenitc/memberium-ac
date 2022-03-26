function Gallery(selector) {

  var self = this;

  this.$gallery = $(selector);
  this.total = this.$gallery.find('.home-slide .home-slide--item').length;
  this.currenImg = 0;
  this.autoRunState = null;
  this.wScreen = getDocumentSize(2);
  this.hScreen = getDocumentSize(3);
  this.position = 0;
  this.firstItem = this.$gallery.find('.home-slide').children()[0];



  this.setup = function () {

    self.$gallery.find('.js-prev, .js-next, .dash').hide();

    self.$gallery.find('.home-slide--item').width(self.wScreen);
    self.$gallery.find('.home-slide').width(self.wScreen*self.total);

    $(window).bind('resize', function () {

      self.wScreen = getDocumentSize(2),
      self.hScreen = getDocumentSize(3),
      self.position = self.currenImg * self.wScreen;

      self.$gallery.find('.home-slide--item').width(self.wScreen);
      self.$gallery.find('.home-slide').width(self.wScreen*self.total);

      self.$gallery.find('.glr-slider').css({ left: -self.position});

    });

    var dot = '';

    for ( var i = 1; i <= self.total; i++)
    dot += '<li></li>';

    if(self.total>1){
      self.$gallery.find('.js-dot').append(dot);
      self.$gallery.find('.js-dot li:eq(0)').addClass('selected');
      self.$gallery.find('.js-next, .dash').show();
    }

    

  }

  this.dotActive = function () {

    self.$gallery.find('.js-dot li').removeClass('selected')
    self.$gallery.find('.js-dot li:eq('+self.currenImg+')').addClass('selected');
  }

  this.dotHandler = function () {

    self.$gallery.find('.js-dot li').removeClass('selected')
    $(this).addClass('selected');

    self.currenImg = $(this).index();
    self.position = self.currenImg*self.wScreen;
    self.$gallery.find('.home-slide').velocity({left: -self.position});


    if(self.currenImg === 0) {
      self.$gallery.find('.js-prev').hide();
      self.$gallery.find('.js-next').show();
    } else if(self.currenImg === self.total-1) {
      self.$gallery.find('.js-prev').show();
      self.$gallery.find('.js-next').hide();
    } else {
      self.$gallery.find('.js-prev').show();
      self.$gallery.find('.js-next').show();
    }

  }

  this.nextHandler = function () {

    if( self.currenImg < self.total-1) {

      self.currenImg++;

      self.position = self.currenImg*self.wScreen;
      self.$gallery.find('.home-slide').velocity({
        left: -self.position
      });

      self.dotActive();
      self.$gallery.find('.js-prev').show();

      if(self.currenImg === self.total-1) {
        self.$gallery.find('.js-next').hide();
      }
    }

  }

  this.prevHandler = function () {

    if( self.currenImg > 0 ) {

      self.currenImg--;
      self.position = self.currenImg*self.wScreen;

      self.$gallery.find('.home-slide').velocity({
        left: -self.position
      });

      self.dotActive();
      self.$gallery.find('.js-next').show();
      if(self.currenImg === 0) {
        self.$gallery.find('.js-prev').hide();
      }
    }
 
  }

  this.run = function () {
    self.$gallery.find('.js-next').on('click', self.nextHandler);
    self.$gallery.find('.js-prev').on('click', self.prevHandler);
    self.$gallery.find('.js-dot li').on('click', self.dotHandler);
  }

  self.setup();
  self.run();

};


var slider = new Gallery('#slider');
var artists = new Gallery('#artist-slider');
var samplepack = new Gallery('#samplepack-slider');
