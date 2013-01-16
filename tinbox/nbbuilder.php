<?php
	session_start();
	$token = md5(uniqid(rand(), true)); 
	$_SESSION['token'] = $token;
?>
<!DOCTYPE html>
<html lang="es">
  <head>
		<title>Tinbox - Notebook Builder</title>
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
              <li><a href="/">Inicio</a></li>
              <li><a href="calendars">Calendarios</a></li>
              <li><a href="notebooks">Cuadernos</a></li>
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
					<h4>Notebook Builder</h4>
					<p class="column-form">
						¿Quieres un cuaderno con tu nombre?
					</p>
					<form action="nbbuild" class="subscribe-form" method="post">
							<input type="hidden" name="token" value="<?php echo $token; ?>" />
							<input type="text" name="name" class="nb-name" placeholder="texto de personalización" required/>
							<button class="subscribe-it red-button" type="submit">Generar</button>
							
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
				if($('.nb-name').attr('value')) {
					$.post("nbbuild", $('.subscribe-form').serialize(), function(data){
						$('.subscribe-form').hide();
				    if(data.type === "error") {
				      $('#subscribe-msg').html(data.message).removeClass().addClass('msg-' + data.type).fadeIn('fast');
				      return false;
				    }
						$('#subscribe-msg').html('<a class="btn btn-success" href="' + data.message + '" target="_blank">Descargar</a>');
						$('#subscribe-msg').fadeIn('fast');
					}, "json");
				}
				return false;
			});
		});
		</script>
  </body>
</html>