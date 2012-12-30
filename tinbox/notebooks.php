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
    	var filters = ["A","B","C","D","E","F","G","H","I","J","K","L","M","P","R","S","T","U","V"];
    	var list = $(".nb-catalog-menu ul");
    	
    	for (var i in filters) {
    		var f = filters[i];
    		var e = $("<li><a></a></li>");
    		e.children("a").attr("href", "#" + f).html(f);
    		list.append(e);
    	}
    	
    	$(".nb-catalog-menu li:first").addClass("active");
    }
		  
    function buildBaraja(model){
    	var models = ["A1","A2","A3","A4","A5","A6","A7","A8","A12",
    				  "B1","B2","B3","B4","B5","B6","B7","B8","B9","B10","B11","B12","B13",
    				  "C1","C2",
    				  "D1","D2","D3","D4",
    				  "E1","E2","E3","E4","E5",
    				  "F1","F2","F3","F4","F5","F6","F7","F8","F9","F10","F11","F12","F13","F14","F15","F16","F17","F18","F19","F20",
    				  "G1","G2","G3","G4","G5","G6",
    				  "H1","H2","H3","H4","H5","H6","H7",
    				  "I1","I2","I3","I4","I5",
    				  "J1","J2","J3","J4","J5","J6","J7",
    				  "K1","K2","K3","K4","K5","K6","K7","K8",
    				  "L1","L2","L3","L4","L5","L6","L7","L8",
    				  "M1","M2","M3","M4","M5","M6","M7","M8",
    				  "P1","P2","P3","P4","P5","P6","P7","P8","P9",
    				  "R1","R2",
    				  "S1","S2","S3","S4",
    				  "T1","T2","T3","T4","T5","T6","T7","T8","T9","T10","T11","T12","T13","T14","T15","T16","T17","T18","T19","T20",
    				  "U1","U2","U3","U4",
    				  "V1","V2","V3","V4"];
    	var html_items = $("<ul></ul>");
    	
    	for (var i in models) {
    		var m = models[i];
    		
    		if(m.charAt(0) !== model)
    		  continue;
    		
    		var e = $("<li><img alt=''/><img src='images/nb-card.png' alt=''/></li>");
    		e.attr("data-key", m);
    		$("img:first", e).attr("src", "nb/" + m + ".jpg");
    		
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