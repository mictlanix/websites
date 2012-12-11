<?php
	session_start();
	$token = md5(uniqid(rand(), true)); 
	$_SESSION['token'] = $token;
	$email = $_GET["email"];
?>
<!DOCTYPE html>
<html lang="es">
  <head>
		<title>Tinbox - Suspender la suscripción</title>
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

		<!-- FOOTER -->
		<div class="graybg clearfix">
			<div id="footer-columns" class="container">
				<div class="left-column-form">
					<ul>
						<li class="">
							<h1><a href="calendars">Calendarios</a></h1>
							<p>Calendario 2013, revive la nostalgia por los años 80's o haz un viaje por 12 hermosas ciudades.</p>
						</li>
						<li class="">
							<!--<h1><a href="notebooks">Cuadernos</a></h1>-->
							<h1><a href="javascript:void(0)">Cuadernos</a></h1>
							<p>Todo lo que hacemos y lo que podemos hacer está totalmente personalizado para ti.</p>
						</li>
						<li class="last">
							<h1><a href="contact">Contacto</a></h1>
							<p>Haremos lo mejor para ti, si tan sólo nos lo dices!</p>
						</li>
					</ul>
				</div>
				<div class="right-column-form">
					<h4>Suspender la suscripción</h4>
					<p class="column-form">
						¿Quieres dejar de recibir noticias y promociones acerca de nustros increibles productos?
					</p>
					<form action="unsubscribe" class="subscribe-form" method="post">
							<input type="hidden" name="token" value="<?php echo $token; ?>" />
							<input type="email" class="subscribe-email" name="email" value="<?php echo $email; ?>" placeholder="correo electrónico (e-mail)"/>
							<button class="subscribe-it red-button" type="submit">Suspender</button>
					</form>
					<p id="subscribe-msg"></p>
				</div>
				<div class="p11"></div>
				<div class="p12"></div>
			</div>
			<div id="footer">
				<div class="footer">
					<a href="https://www.facebook.com/TinboxMX" class="facebook" title="facebook"><img src="images/facebook.png" alt="facebook"/></a>
					<a href="https://twitter.com/TinboxMX" class="twitter" title="twitter"><img src="images/twitter.png" alt="twitter"/></a>
					<div>&copy; Tinbox 2012</div>
				</div>
			</div>
		</div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script>
		$(function(){
			$('.subscribe-form').submit(function() {
				if($('.subscribe-email').attr('value')) {
					$.post("unsubscribe", $('.subscribe-form').serialize(), function(data){
						$('.subscribe-form').hide();
						$('#subscribe-msg').html(data.message).removeClass().addClass('msg-' + data.type);
						$('#subscribe-msg').fadeIn('fast').delay(3000).fadeOut('fast', function(){
							$('.subscribe-form').fadeIn('fast');
						});
					}, "json");
				}
				return false;
			});
		});
		</script>
  </body>
</html>