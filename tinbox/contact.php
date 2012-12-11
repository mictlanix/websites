<?php
	session_start();
	$token = md5(uniqid(rand(), true)); 
	$_SESSION['token'] = $token;
?>
<!DOCTYPE html>
<html lang="es">
  <head>
		<title>Tinbox - Contacto</title>
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
              <li><a href="home">Inicio</a></li>
              <li><a href="calendars">Calendarios</a></li>
              <!--<li><a href="notebooks">Cuadernos</a></li>-->
              <li class="active"><a href="#">Contacto</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
  	<div class="greenbg">
			<div class="container">
		    <div class="c01"></div>
		    <div class="c02"></div>
		    <div class="c03"></div>
	      <div class="row">
		      <div class="contact-page">
		        <h1 class="span">
		        	<img src="images/contactus.png" alt="Contactanos" title="Contactanos">
	        	</h1>
		        <p>
		        	Nada nos encantaría más que oír de ti.
		        	Cuentanos de tu proyecto, tus preguntas o incluso tu color favorito.
	        	</p>
		        <h2 class="contact-name">
		        	<img src="images/contact-logo.png" alt="« Tinbox »" title="Tinbox">
		        </h2>
		        <div class="clearfix" >
		            <div class="contact-address">
		              <span>Dirección:</span><br/>
		              Georgia 181<br/>
									Colonia Nápoles<br/>
									México, DF, 03810
		            </div>
		            <div class="contact-city">
		            	<span>¿Estás en la ciudad?</span><br/>
									<i>No dudes en visitarnos<br/>para que conozcas nuestros<br/>íncreibles productos.</i>
		            </div>
		        </div>
		        <div class="clearfix" >
		            <div class="contact-email">
		              <span>E-mail:</span><br/>
		              <a href="mailto:info@tinbox.mx" title="Escribir un correo">info@tinbox.mx</a>
		            </div>
		            <div class="contact-phone">
		              <span>Teléfonos:</span><br/>
		              <a href="tel:5556723912">(55) 5672 3912</a><br/>
		              <a href="tel:5556723944">(55) 5672 3944</a>
		            </div>
		        </div>
		      </div>
				</div>
			</div>
		</div>

		<div class="contact-map">
		  <iframe class="map" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
		  				src="//maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Dataprint,+Georgia,+N%C3%A1poles,+Benito+Ju%C3%A1rez,+Mexico&amp;aq=0&amp;oq=dataprint&amp;sll=19.320099,-99.152184&amp;sspn=0.813853,1.212616&amp;ie=UTF8&amp;hq=Dataprint,+Georgia,&amp;hnear=N%C3%A1poles,+Benito+Ju%C3%A1rez,+Mexico+City,+Distrito+Federal,+Mexico&amp;t=m&amp;ll=19.39091,-99.180322&amp;spn=0.019431,0.027466&amp;z=15&amp;iwloc=A&amp;output=embed">
		  </iframe>
		</div>

		<!-- FOOTER -->
		<div class="graybg clearfix">
			<div class="to-up"><a href="#" class="go-to-up gray-beige"></a></div>
			<?php include '_contactus.php';?>
		</div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/script.js"></script>
		<?php include_once("_analyticstracking.php") ?>
  </body>
</html>