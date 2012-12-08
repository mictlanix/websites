<?php
	session_start();
	$token = md5(uniqid(rand(), true)); 
	$_SESSION['token'] = $token;
?>
<!DOCTYPE html>
<html lang="es">
  <head>
		<title>Tinbox</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
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
              <li class="active"><a href="#">Inicio</a></li>
              <li><a href="calendars">Calendarios</a></li>
              <!--<li><a href="notebooks">Cuadernos</a></li>-->
              <li><a href="contact">Contacto</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide">
      <div class="carousel-inner">
        <div class="item active">
          <div class="img" style="background-image:url(images/slide01.jpg)"></div>
        </div>
        <div class="item">
          <div class="img" style="background-image:url(images/slide02.jpg)"></div>
        </div>
        <div class="item">
          <div class="img" style="background-image:url(images/slide03.jpg)"></div>
        </div>
        <div class="item">
          <div class="img" style="background-image:url(images/slide04.jpg)"></div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div><!-- /.carousel -->
    
  	<div class="greenbg">
			<div class="green-wave"></div>
			<div class="container marketing">
	      <div class="row">
	        <div class="span4">
	          <h2 title="World Travel">
	          	<img src="images/worldtravel.png" alt="World Travel">
	          </h2>
	          <p>Un viaje por 12 hermosas ciudades, con personalizaciones impactantes en distintos estilos que marcaron época.<br/>¡Bon voyage!</p>
	          <p><a href="calendars">Ver detalles &raquo;</a></p>
	        </div>
	        <div class="span4">
	          <h2 title="80's">
	          	<img src="images/80s.png" alt="80's">
	          </h2>
	          <p>Revive la nostalgia por años ridículamente divertidos. ¡No hace falta que hayas usado hombreras para que lo disfrutes!<br/>Yo &hearts; los 80's!</p>
	          <p><a href="calendars">Ver detalles &raquo;</a></p>
       		</div>
	        <div class="span4">
	          <h2 title="Cuadernos">
	          	<img src="images/notebooks.png" alt="Cuadernos">
	          </h2>
	          <p>Crea tus propias memorias. Regálaselo a tus clientes, a tus amigos, a quien tú quieras! Ideal para la oficina y el colegio.<br/>¿Cuál quieres? Escoge el tuyo.</p>
	          <p><a href="javascript:void(0)">Próximamente</a></p>
	          <!--<p><a href="notebooks">Ver detalles &raquo;</a></p>-->
	        </div>
      	</div>

			</div>
		</div>

		<!-- FOOTER -->
		<div class="graybg clearfix">
			<div class="to-up"><a href="#" class="go-to-up gray-green"></a></div>
			<?php include '_contactus.php';?>
		</div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/script.js"></script>
		<script>
		$(function(){
			$('#myCarousel').carousel();
		});
		</script>
		<?php include_once("_analyticstracking.php") ?>
  </body>
</html>