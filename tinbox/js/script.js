$(function(){
	"use strict";
	
	$('.subscribe-form').submit(function() {
		if($('.subscribe-email').attr('value')) {
			$.post("subscribe", $('.subscribe-form').serialize(), function(data){
				$('.subscribe-form').hide();
				$('#subscribe-msg').html(data.message).removeClass().addClass('msg-' + data.type);
				$('#subscribe-msg').fadeIn('fast').delay(3000).fadeOut('fast', function(){
					$('.subscribe-form').fadeIn('fast');
					if(data.type === 'success') {
						$('.subscribe-form')[0].reset();
					}
				});
			}, "json");
		}
		return false;
	});
	
	$('.contact-form').submit(function() {
		if($('.contact-form textarea').attr('value')) {
			$.post("send", $('.contact-form').serialize(), function(data){
				$('.contact-form').hide();
				$('#contact-msg').html(data.message).removeClass().addClass('msg-' + data.type);
				$('#contact-msg').fadeIn('fast').delay(3000).fadeOut('fast', function(){
					$('.contact-form').fadeIn('fast');
					if(data.type === 'success') {
						$('.contact-form')[0].reset();
					}
				});
			}, "json");
		}
		return false;
	});
	
	var e = $(".go-to-up");
  e.click(function(){
    $("html:not(:animated)" +( !$.browser.opera ? ",body:not(:animated)" : "")).animate({ scrollTop: 0}, 500 );
    return false;
  });
});