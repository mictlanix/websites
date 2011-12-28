
(function($) {
  $.fn.mtxSlider = function(options) {
    var defaults = { thumb_opacity: 0.3, callback: false };
    var settings = $.extend(false, defaults, options);
    $(this).each(function() {
      var slider  = new MtxSlider(this, settings);
    });
  };

  function MtxSlider(wrapper, settings) {
    this.init(wrapper, settings);
  };
  
  MtxSlider.prototype = {
    // Elements
    wrapper: false,
    thumbs_wrapper: false,
    settings: false,
    init: function(wrapper, settings) {
      var context = this;
      this.wrapper = $(wrapper);
      this.thumbs_wrapper = this.wrapper.find('.mtx-thumbs');
      this.settings = settings;
      this.findImages();
      this.initBackAndForward();
      this.highLightThumb(this.thumbs_wrapper.find('.mtx-thumb0'));
    },
    findImages: function() {
      var context = this;
      var thumb_wrapper_width = 0;
      var thumbs_loaded = 0;
      var thumbs = this.thumbs_wrapper.find('a');
      var thumb_count = thumbs.length;
      if(this.settings.thumb_opacity < 1) {
        thumbs.find('img').css('opacity', this.settings.thumb_opacity);
      };
      thumbs.each(
        function(i) {
          var link = $(this);
          var thumb = link.find('img');
          if(!context.isImageLoaded(thumb[0])) {
            thumb.load(
              function() {
                thumb_wrapper_width += $(this).closest('li')[0].offsetWidth;
                thumbs_loaded++;
              }
            );
          } else {
            thumb_wrapper_width += thumb.closest('li')[0].offsetWidth;
            thumbs_loaded++;
          };
          link.addClass('mtx-thumb'+ i);
          link.click(
            function() {
	          context.highLightThumb($(this));
	          if($.isFunction(context.settings.callback)) {
		        context.settings.callback(this);
		      };
              return false;
            }
          ).hover(
            function() {
              if(!$(this).is('.mtx-active') && context.settings.thumb_opacity < 1) {
                $(this).find('img').fadeTo(300, 1);
              };
            },
            function() {
              if(!$(this).is('.mtx-active') && context.settings.thumb_opacity < 1) {
                $(this).find('img').fadeTo(300, context.settings.thumb_opacity);
              };
            }
          );
        }
      );
      var inter = setInterval(
        function() {
          if(thumb_count == thumbs_loaded) {
            thumb_wrapper_width -= 100;
            var list = context.wrapper.find('.mtx-thumb-list');
            list.css('width', thumb_wrapper_width +'px');
            var i = 1;
            var last_height = list.height();
            while(i < 201) {
              list.css('width', (thumb_wrapper_width + i) +'px');
              if(last_height != list.height()) {
                break;
              }
              last_height = list.height();
              i++;
            }
            clearInterval(inter);
          };
        },
        100
      );
    },
    initBackAndForward: function() {
      var context = this;
      var scroll_forward = $('<div class="mtx-forward"></div>');
      var scroll_back = $('<div class="mtx-back"></div>');
      this.wrapper.append(scroll_forward);
      this.wrapper.prepend(scroll_back);
      var thumbs_scroll_interval = false;
      $(scroll_back).add(scroll_forward).click(
        function() {
          var width = context.wrapper.width()  - 50;
          if($(this).is('.mtx-forward')) {
            var left = context.thumbs_wrapper.scrollLeft() + width;
          } else {
            var left = context.thumbs_wrapper.scrollLeft() - width;
          };
          context.thumbs_wrapper.animate({scrollLeft: left +'px'});
          return false;
        }
      ).css('opacity', 0.6).hover(
        function() {
          var direction = 'left';
          if($(this).is('.mtx-forward')) {
            direction = 'right';
          };
          thumbs_scroll_interval = setInterval(
            function() {
              
              var left = context.thumbs_wrapper.scrollLeft() + 1;
              if(direction == 'left') {
                left = context.thumbs_wrapper.scrollLeft() - 1;
              };
              context.thumbs_wrapper.scrollLeft(left);
            },
            10
          );
          $(this).css('opacity', 1);
        },
        function() {
          clearInterval(thumbs_scroll_interval);
          $(this).css('opacity', 0.6);
        }
      );
    },
    isImageLoaded: function(img) {
      if(typeof img.complete != 'undefined' && !img.complete) {
        return false;
      };
      if(typeof img.naturalWidth != 'undefined' && img.naturalWidth == 0) {
        return false;
      };
      return true;
    },
    highLightThumb: function(thumb) {
      this.thumbs_wrapper.find('.mtx-active').removeClass('mtx-active');
      thumb.addClass('mtx-active');
      if(this.settings.thumb_opacity < 1) {
        this.thumbs_wrapper.find('a:not(.mtx-active) img').fadeTo(300, this.settings.thumb_opacity);
        thumb.find('img').fadeTo(300, 1);
      };
      var left = thumb[0].parentNode.offsetLeft;
      left -= (this.wrapper.width()  / 2) - (thumb[0].offsetWidth / 2);
      this.thumbs_wrapper.animate({scrollLeft: left +'px'});
    }
  };
})(jQuery);