<?php
	session_start();
	$token = md5(uniqid(rand(), true)); 
	$_SESSION['token'] = $token;
?>
<!DOCTYPE html>
<html lang="es">
  <head>
		<title>Tinbox - Cuadernos</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/colorbox.css" rel="stylesheet" media="screen">
    <link href="css/baraja.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="brand" href="/">
          	<img src="images/logo.png" alt="Tinbox Logo">
          	<span>Tinbox</span>
          </a>
          <p class="navbar-text pull-left">&#9733; Crea nuevos recuerdos &#9733;</p>
          <div class="nav-collapse collapse">
            <ul class="nav pull-right">
              <li><a href="/">Inicio</a></li>
              <li><a href="calendars">Calendarios</a></li>
              <li class="active"><a href="#">Cuadernos</a></li>
              <li><a href="contact">Contacto</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
    <div class="notebook-bg">
      <div class="wrapper" style="margin-top:20px;">
        <div class="container">
          <div class="row">
            <div class='span12' style="margin-bottom:40px;box-shadow:#141414 0px 15px 45px;">
              <img src="images/blackboard.jpg" alt="Libretas Personalizadas, con tu nombre o de quién tú quieras!">
            </div>
          </div>
          <div class="row">
            <div class='span5'>
              <ul id="nb-sizes">
                <li data-key="junior">
                  <img src="images/nb-junior.png" alt="Cuaderno Tamaño Junior">
                </li>
                <li data-key="maxi">
                  <img src="images/nb-maxi.png" alt="Cuaderno Tamaño Maxi">
                </li>
                <li data-key="mini">
                  <img src="images/nb-mini.png" alt="Cuaderno Tamaño Mini">
                </li>
              </ul>
            </div>
            <div class='offset2 span5'>
              <div id="nb-size-desc">
                <p class="junior">
                  <b>JUNIOR</b><br/>                  Super práctica<br/>en la oficina.<br/>
                  <small>17.5 &times; 22.5 cm</small>
                </p>
                <p class="maxi">
                  <b>MAXI</b><br/>                  Ideal para<br/>la escuela.<br/>
                  <small>22 &times; 29 cm</small>
                </p>
                <p class="mini">
                  <b>MINI</b><br/>                  La de<br/>bolsillo…<br/>muy útil!<br/>
                  <small>11 &times; 15 cm</small>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
		
		<!-- FOOTER -->
		<div class="nb-green-bg">
		  <div class="nb-catalog-title">
		    <h1>Catálogo</h1>
		  </div>
			<div class="container">
				<div class="nb-catalog-menu">
				  <ul></ul>
				</div>
				<div class="nb-models">
          <ul id="nb-baraja" class="baraja-container">
            <li><img alt=''/><img src='images/nb-card.png' alt=''/></li>
          </ul>
        </div>
				<div id="nb-model-name">A1</div>
			</div>
		</div>

		<!-- FOOTER -->
		<div class="graybg clearfix">
			<div class="to-up"><a href="#" class="go-to-up gray-green2"></a></div>
			<?php include '_contactus.php';?>
		</div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/script.js"></script>
		<script src="js/slides.jquery.min.js"></script>
		<script src="js/jquery.colorbox.min.js"></script>
		<script src="js/jquery.roundabout.min.js"></script>
		<script src="js/modernizr.custom.baraja.js"></script>
		<script src="js/jquery.baraja.js"></script>
		<script>
		function buildFilters(){
    	var filters = ["A","B","C","D","E","F","G","H","I","L","M","N","P","R","T"];
    	var list = $(".nb-catalog-menu ul");
    	
    	for (var i in filters) {
    		var f = filters[i];
    		var e = $("<li><a></a></li>");
    		e.children("a").attr("href", "#" + f).html(f);
    		list.append(e);
    	}
    	
    	$(".nb-catalog-menu li:first").addClass("active");
    }
    
		function in_array(arr, val) {
      for(var i=0;i<arr.length;i++) {
        if(arr[i] === val) {
          return true;
        }
      }
      return false;
    }
    
    function buildBaraja(model){
    	var models = {"A":{first:1,last:36,exclude:[12]},
                    "B":{first:1,last:27,exclude:[]},
                    "C":{first:1,last:09,exclude:[]},
                    "D":{first:1,last:09,exclude:[]},
                    "E":{first:1,last:09,exclude:[]},
                    "F":{first:1,last:18,exclude:[]},
                    "G":{first:1,last:09,exclude:[]},
                    "H":{first:1,last:27,exclude:[]},
                    "I":{first:1,last:09,exclude:[]},
                    "L":{first:1,last:18,exclude:[]},
                    "M":{first:1,last:09,exclude:[]},
                    "N":{first:1,last:09,exclude:[]},
                    "P":{first:1,last:09,exclude:[]},
                    "R":{first:1,last:09,exclude:[]},
                    "T":{first:1,last:36,exclude:[]}};
      
    	var html_items = $("<ul></ul>");
  		var m = models[model];
    	    	
      for (var i = m.first; i <= m.last; i++) {
        if(in_array (m.exclude, i))
          continue;
        
        var item = model + i;
        var e = $("<li><img alt=''/><img src='images/nb-card.png' alt=''/></li>");
        e.attr("data-key", item);
        $("img:first", e).attr("src", "nb/" + item + ".jpg");
        
        html_items.append(e);
      }
    	
    	return html_items.children();
    }
    
    $(function(){
      buildFilters();
      
      $('#nb-sizes').roundabout();
      $('#nb-sizes li').focus(function() {
        var model = $(this).data('key');
        $('#nb-size-desc p').fadeOut(100);
        $('#nb-size-desc .' + model).delay(130).fadeIn('slow');
      });
      
      var baraja = $('#nb-baraja').baraja({
        speed:400,
        focusCallback: function(){
          $('#nb-model-name').html($(this).data('key'));
        }
      });
      
      $(".nb-catalog-menu a").click(function(e){
        e.preventDefault();
        
        if(baraja.isAnimating) {
          return false;
        }
        
        $(".nb-catalog-menu li.active").removeClass("active");
        $(this).parent().addClass("active");
        
        baraja.replace(buildBaraja($(this).text()));
        setTimeout(function() {
          $('#nb-model-name').html($("#nb-baraja li:first").data('key'));
				}, 1000);
      });
      
      $(".nb-catalog-menu a:first").trigger("click");
    });
		</script>
		<?php include_once("_analyticstracking.php") ?>
  </body>
</html>