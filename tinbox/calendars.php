<?php
	session_start();
	$token = md5(uniqid(rand(), true)); 
	$_SESSION['token'] = $token;
?>
<!DOCTYPE html>
<html lang="es">
  <head>
		<title>Tinbox - Calendarios</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/colorbox.css" rel="stylesheet" media="screen">
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
              <li><a href="home">Inicio</a></li>
              <li class="active"><a href="#">Calendarios</a></li>
              <!--<li><a href="notebooks">Cuadernos</a></li>-->
              <li><a href="contact">Contacto</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
  	<div class="calendar-bg">
	  	<div class="wrapper">
			  <div class="container">
			    <div class="row">
			      <div id="calendar-sizes" class="span12">
			        <div class="slides_container">
		            <div>
		              <div class="content span">
										<h1>Mini</h1>
	                	<div class="image">
											<img src="images/calendar-size-mini.png" alt="Calendario Mini" style="margin-top:44px" />
	                	</div>
										<div class="description">
											<p class="hilite">¡Pequeño y práctico!</p> 
											<p>
												13 páginas a color de <b>22 &times; 10 cm</b><br/>
												Cartulina premium con caballete y<br/>
												arillo metálico.
											</p>
											<p class="price">$100</p>
										</div>
		              </div>
		            </div>
		            
		            <div>
		              <div class="content span">
										<h1>Escritorio</h1>
	                	<div class="image">
											<img src="images/calendar-size-desk.png" alt="Calendario Escritorio" style="margin-top:50px"/>
	                	</div>
										<div class="description">
											<p class="hilite">¡Ideal para la oficina!</p> 
											<p>
												13 páginas a color de <b>30 &times; 10.5 cm</b><br/>
												Cartulina premium con caballete y<br/>
												arillo metálico.
											</p>
											<p class="price">$110</p>
										</div>
		              </div>
		            </div>
		            
		            <div>
		              <div class="content span">
										<h1>CD</h1>
	                	<div class="image">
											<img src="images/calendar-size-cd.png" alt="Calendario CD" style="margin-top:15px" />
	                	</div>
										<div class="description">
											<p class="hilite">¡El más vendido!</p> 
											<p>
												13 páginas a color de <b>12 &times; 14 cm</b><br/>
												Cartulina premium con caja de
												acrílico.
											</p>
											<p class="price">$90</p>
										</div>
		              </div>
		            </div>
		            
		            <div>
		              <div class="content vertical span">
										<h1>Postal</h1>
	                	<div class="image">
											<img src="images/calendar-size-postal.png" alt="Calendario Postal" style="margin-top:-52px" />
	                	</div>
										<div class="description">
											<p class="hilite">¡Úsalo como novedosa postal!</p>
											<p>
												13 páginas a color de <b>15 &times; 22 cm</b><br/>
												Cartulina premium con caballete y<br/>
												arillo metálico.
											</p>
											<p class="price">$110</p>
										</div>
		              </div>
		            </div>
		            
		            <div>
		              <div class="content vertical span">
										<h1>Organizador</h1>
	                	<div class="image">
											<img src="images/calendar-size-org.png" alt="Calendario Organizador" style="margin-top:-75px" />
	                	</div>
										<div class="description">
											<p class="hilite">¡Útil para tus anotaciones!</p> 
											<p>
												13 páginas a color de <b>21.5 &times; 30 cm</b><br/>
												Cartulina premium con colgador<br/>
												para pared y arillo metálico.
											</p>
											<p class="price">$155</p>
										</div>
		              </div>
		            </div>
		            
		            <div>
		              <div class="content vertical span">
										<h1>Poster</h1>
	                	<div class="image">
											<img src="images/calendar-size-poster.png" alt="Calendario Poster" style="margin-top:-108px" />
	                	</div>
										<div class="description">
											<p class="hilite">¡Perfecto para decorar la pared!</p> 
											<p>
												13 páginas a color de <b>30 &times; 44 cm</b><br/>
												Cartulina premium con colgador<br/>
												para pared y arillo metálico.
											</p>
											<p class="price">$280</p>
										</div>
		              </div>
		            </div>
		            
		            <!--
		            <div>
		              <div class="content span">
										<h1>Panorámico</h1>
	                	<div class="image">
											<img src="images/calendar-size-panom.png" alt="Calendario Panorámico" style="margin-top:-30px" />
	                	</div>
										<div class="description">
											<p class="hilite">¡Panoramic's Phrase!</p> 
											<p>
												13 páginas a color de <b>44 &times; 30 cm</b><br/>
												Cartulina premium con colgador<br/>
												para pared y arillo metálico.
											</p>
											<p class="price">$280</p>
										</div>
		              </div>
		            </div>
		            -->
			        </div>
			        <a href="#" class="prev"><img src="images/slider-prev.png" alt="Anterior"></a>
			        <a href="#" class="next"><img src="images/slider-next.png" alt="Siguiente"></a>
			        <ul class="pagination">
	              <li class="">
	              	<a href="#1" title="Mini">
	              		<img src="images/slider-position-mini.png" alt="Mini"/>
	              		<span>$100</span>
	             		</a>
	           		</li>
	              <li class="">
	              	<a href="#2" title="Escritorio">
	              		<img src="images/slider-position-desk.png" alt="Escritorio"/>
	              		<span>$110</span>
	             		</a>
	           		</li>
	              <li class="">
	              	<a href="#3" title="CD">
	              		<img src="images/slider-position-cd.png" alt="CD"/>
	              		<span>$90</span>
	             		</a>
	           		</li>
	              <li class="">
	              	<a href="#4" title="Postal">
	              		<img src="images/slider-position-postal.png" alt="Postal"/>
	              		<span>$110</span>
	             		</a>
	           		</li>
	              <li class="">
	              	<a href="#5" title="Organizador">
	              		<img src="images/slider-position-org.png" alt="Organizador"/>
	              		<span>$155</span>
	             		</a>
	           		</li>
	              <li class="last">
	              	<a href="#6" title="Poster">
	              		<img src="images/slider-position-poster.png" alt="Poster"/>
	              		<span>$280</span>
	             		</a>
	           		</li>
	           		<!--
	              <li class="last">
	              	<a href="#7" title="Panorámico">
	              		<img src="images/slider-position-panom.png" alt="Panorámico"/>
	              		<span>$280</span>
	             		</a>
	           		</li>
	           		-->
			        </ul>
			      </div>
			    </div>
			  </div>
			</div>
		</div>

		<div class="bluebg">
			<div id="tabs-container" class="container">
				<ul id="calendar-tabs" class="nav nav-tabs">
				  <li class="active"><a href="#80s" data-toggle="tab">80s</a></li>
				  <li class=""><a href="#worldtravel" data-toggle="tab">World Travel</a></li>
				</ul>
			</div>
			<div class="tab-content">
				<div id="80s" class="container tab-pane fade in active">
		    	<ul class="thumbnails"></ul>
			  </div>
				<div id="worldtravel" class="container tab-pane fade in">
		    	<ul class="thumbnails"></ul>
   			</div>
			</div>
		</div>

		<!-- FOOTER -->
		<div class="graybg clearfix">
			<div class="to-up"><a href="#" class="go-to-up gray-blue"></a></div>
			<?php include '_contactus.php';?>
		</div>

		<div id="howtobuy">
			<button id="orders" type="button" class="btn btn-large btn-warning">Pedidos</button>
			<div class="content">
				<a id="close" href="#"><i class="icon-remove icon-white"></i></a>
				<h1>Pide tus calendarios</h1>
				<p>Vía correo electrónico a <a href="mailto:info@tinbox.mx" target="_blank">info@tinbox.mx</a> o por teléfono al <a href="tel:5556723912" target="_blank">(55) 5672-3912</a>.</p>
			  <ol>
			  	<li>Descarga el <a href="downloads/base-2013.xls" target="_blank"><i class="icon-download-alt icon-white"></i>formato</a>
			  			y sus <br/><a href="downloads/instrucciones-2013.pdf" target="_blank"><i class="icon-download-alt icon-white"></i>instrucciones</a> de llenado.</li>
			  	<li>LLena el formato y mándalo a nuestro <br/><a href="mailto:info@tinbox.mx" target="_blank"><i class="icon-envelope icon-white"></i> correo electrónico</a>, escribenos si tienes alguna duda.</li>
			  	<li>Espera la confirmación de tu pedido e instrucciones de pago.</li>
			  	<li>Confirma el pago mandando tu comprobante vía <a href="mailto:info@tinbox.mx" target="_blank"><i class="icon-envelope icon-white"></i> correo electrónico</a>.</li>
			  	<li>Recíbelos en tu casa u oficina.</li>
			  </ol>
			</div>
		</div>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slides.jquery.min.js"></script>
		<script src="js/jquery.colorbox-min.js"></script>
		<script>
		(function(){
			var imgList = [];
			var imgArr = ["images/wood_tile.gif",
										"images/calendar-header-bg.png",
										"images/calendar-size-content-bg.png",
										"images/calendar-sizes-bg.png"];
			
			for(var i in imgArr) {
				imgList.push(new Image(imgArr[i]));
			}
		})();
		
		function buildThumbnails(model, size){
			var container = $("#" + model + " .thumbnails");
			
			for(var i = 1; i < 13; i++){
				var e = $("<li class='span3'><a href='' class='thumbnail'><img src='' alt=''></a></li>");
						
				$("img", e).attr("src", "examples/" + model + "/" + size + "/thumbs/" + ("0" + i).substr(-2) + ".jpg");
				$("a", e).attr("href","examples/" + model + "/" + size + "/" + ("0" + i).substr(-2) + ".jpg").addClass(model);
				
				container.append(e);
			}			
		}

		$(function(){
		  $("#calendar-sizes").slides({
		  	start:3,
		    next:'next',
		    prev:'prev',
		    preload:false,
		    preloadImage:'images/loading.gif',
		    generatePagination:false,
				animationComplete:function(current) {
					var sizes = ["mini","desk","cd","postal","org","poster"];
					var size = sizes[current-1];
					
					$('#80s img').each(function(i) {
					    var url = this.src.replace(/80s\/[a-z]*\//g, '80s/' + size + '/');
					    var image = $(this);
					    image.fadeOut('fast', function () {
					        image.attr('src', url);
					        image.fadeIn('fast');
					    });
					});
					$('#worldtravel img').each(function(i) {
					    var url = this.src.replace(/worldtravel\/[a-z]*\//g, 'worldtravel/' + size + '/');
					    var image = $(this);
					    image.fadeOut('fast', function () {
					        image.attr('src', url);
					        image.fadeIn('fast');
					    });
					});
					$('#80s a').each(function(i) {
					    this.href = this.href.replace(/80s\/[a-z]*\//g, '80s/' + size + '/');
					});
					$('#worldtravel a').each(function(i) {
					    this.href = this.href.replace(/worldtravel\/[a-z]*\//g, 'worldtravel/' + size + '/');
					});
		    }
		  });
		 
		 	buildThumbnails("80s", "cd");
		 	buildThumbnails("worldtravel", "cd");
		 	
		  $("#80s .thumbnail").colorbox({rel:'80s',current:'{current} / {total}'});
		  $("#worldtravel .thumbnail").colorbox({rel:'worldtravel',current:'{current} / {total}'});
		  
		  $('#orders').click(function(){ 
		  	$(this).hide();
		  	$('#howtobuy .content').show('fast');
		  	return false;
		  });
 		  $('#close').click(function(){
		  	$('#howtobuy .content').hide('fast', function(){
		  		$('#orders').show();
		  	});
		  	return false;
		  });
		  
		});
		</script>
		<?php include_once("_analyticstracking.php") ?>
  </body>
</html>