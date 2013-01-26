var AppRouter = Backbone.Router.extend({
  routes: {
    ""            :"root",         // #/
    "us"          :"us",           // #/us
    "us/vivid"    :"vivid",        // #/us/vivid
    "us/mantra"   :"mantra",       // #/us/mantra
    "us/values"   :"values",       // #/us/values
    "contact"     :"contact",      // #/contact
    "*page"       :"defaultAction"
  },
  defaultAction:function (page) {
    alert("Path: " + page);
  },
  root:function(){        
    $('div').removeClass('active');
    $("#us").animate({height:'50%'}, 150);
    $("#us").children('div').css({height:''});
    $("#us-header").css({height:'100%'});
    $("#contact").animate({height:'50%'}, 150);
  },
  us:function(){
    $("#contact").animate({height:0}, 300);
    $('div,li').removeClass('active');
    
    $("#us").css({height:'100%'});
    $("#us-nav").css({height:'50%'});
    $("#us-header").addClass('active').animate({height:'50%'}, 300);
  },
  vivid:function(){
    showUsContent();
    
    $("#vivid").addClass('active');
    $("#vivid-container").animate({marginLeft:0}, 300);
    //$("#mantra-container").css({marginLeft:''});
  },
  mantra:function(){        
    showUsContent();

    $("#mantra").addClass('active');
    $("#vivid-container").animate({marginLeft:'-200%'}, 300);
    $("#mantra-container").animate({marginLeft:''}, 300);
  },
  values:function(){
    showUsContent();

    $("#values").addClass('active');
    $("#vivid-container,#mantra-container").animate({marginLeft:'-200%'}, 300);
  },
  contact:function(){
    $("#us").animate({height:0}, 300);
    $('div').removeClass('active');
    
    $("#contact").animate({height:'100%'}, 300);
    $('#contact-header').addClass('active');
  }
});
var app_router = new AppRouter;

function showUsContent(){
  $("#us-header").animate({height:0}, 300);
  $("#us-content").css({height:'50%'});
  $('div,li').removeClass('active');
}
function init(){
  var splash = $('#left, #right');
  
  splash.show();
  
  $(window).resize(windowResize);
  $('#value-list li').mouseenter(function(){
    var id = $(this).attr('id');
    $('#value-desc li').hide();
    $('#' + id + '-desc').css('display','');
  });
  
  if (Modernizr.csstransforms) {
    $(window).resize(slopyResize);
    $('.slopy').click(slopyClick);
  } else {
    $('.slopy').removeClass('slopy').css({'width':'','height':'50%'});
    Backbone.history.start();
  }
  
  $(window).resize();
  
  splash.delay(2000).animate({'width': '0'}, 500, function(){
      $('#homepage').remove();
  });
}
function getWidth(){
  var w = $(window).width();
  return w > 800 ? w : 800;
}
function getHeight(){
  var h = $(window).height();
  return h > 400 ? h : 400;
}
function windowResize(){
  var w = getWidth(), h = getHeight();
  $('#container').width(w).height(h);
}
function slopyResize(){
  var s = $('.slopy');
  var w = getWidth(), h = getHeight();
  var a = Math.atan(h / w);
  var l = $('.lower.slopy');
  s.height(h);
  l.width(2 * w);
  l.rotate(-a);
  $('a:first', l).rotate(a);
}
function slopyClick(){
  var self = $(this);
  var w = getWidth(), h = getHeight();
  var angle = Math.atan(h / w);

  if(self.hasClass('upper')) {
    self.parent().css('background','#000');
  }else{
    self.parent().css('background','#fff');
  }
  
  self.css('background','#fff');
  self.css('color','#000');
  
  $('.slopy.lower').animate({ 'borderSpacing': angle }, {
      step: function(now,fx) {
        var i = now - angle;
        var p = now / angle;
        
        $(this).rotate(i);
        $('a:first', this).rotate(-i);
        
        $('.slopy').css('height', (100 - (50 * p)) + '%');
      },
      duration:200,
      complete:function(){
        self.parent().css('background','');
        self.css({'background':'','color':''});
        $('.slopy').removeClass('slopy').css({'width':''});

        Backbone.history.start();
        app_router.navigate("");
        app_router.navigate($('a', self).attr("href"), {trigger: true});
      }
  });
  
  $(window).unbind('resize',slopyResize);
  $('.slopy').unbind("click");
}

(function($){ 
  $.fn.extend({          
    rotate: function(options) {
      var angle = options;
      return this.each(function() {
        $(this).css({
          '-webkit-transform':'rotate('+angle+'rad)',
             '-moz-transform':'rotate('+angle+'rad)',
              '-ms-transform':'rotate('+angle+'rad)',
               '-o-transform':'rotate('+angle+'rad)',
                  'transform':'rotate('+angle+'rad)'
        });
      });
    }
  });     
})(jQuery);