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
              <!--<li class="active"><a href="#">Cuadernos</a></li>-->
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
			    	<div class='span12' style="height:420px;background:rgba(0,0,0,0.3)">
			    	</div>
					</div>
			    <div class="row">
			    	<div class='span4' style="margin-top:20px;height:220px;background:rgba(0,0,0,0.3)"">
			    	</div>
			    	<div class='span4' style="margin-top:20px;height:220px;background:rgba(0,0,0,0.3)"">
			    	</div>
			    	<div class='span4' style="margin-top:20px;height:220px;background:rgba(0,0,0,0.3)"">
			    	</div>
					</div>
			  </div>
			</div>
		</div>
		
		<!-- FOOTER -->
		<div class="bluebg">
			<div class="container">
				<h1><h1>
			</div>
		</div>

		<!-- FOOTER -->
		<div class="graybg clearfix">
			<div class="to-up"><a href="#" class="go-to-up gray-blue"></a></div>
			<?php include '_contactus.php';?>
		</div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slides.jquery.min.js"></script>
		<script src="js/jquery.colorbox-min.js"></script>
		<script>
		$(function(){
		 
		});
		</script>
		<?php include_once("_analyticstracking.php") ?>
  </body>
</html>