<?php
	session_start();
	$token = md5(uniqid(rand(), true)); 
	$_SESSION['token'] = $token;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Una marca orgullosamente Colombiana inspirada en la mujer sensual, soñadora que quiere verse bien.">
        <meta name="author" content="">
        <title>FenLove - Contacto</title>
        <!-- favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="manifest.json">
        <link rel="mask-icon" href="safari-pinned-tab.svg" color="#ff19a7">
        <meta name="theme-color" content="#ffffff">
        <!-- styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/easyzoom.css" rel="stylesheet">
    </head>
    <body class="bg-p">
        <div class="my-contact">
            <div class="bg-p">
                <nav class="navbar navbar-toggleable-sm navbar-inverse">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#my-navbar" aria-controls="my-navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">
                        <img src="images/logo-white.png" title="FenLove" alt="FenLove">
                    </a>
                    <div class="collapse navbar-collapse" id="my-navbar">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="catalog.html">Catálogo <span class="sr-only">(current)</span></a>
                            </li>
                            <!--<li class="nav-item">
                                <a class="nav-link" href="about-us.html">Nosotros</a>
                            </li>-->
                            <li class="nav-item active">
                                <a class="nav-link" href="contact.php">Contacto</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container">
                    <div class="row">
                        <h2 class="col-10 offset-1">Un pequeño saludo...</h2>
                    </div>
                    <form>
                        <input type="hidden" name="token" value="<?php echo $token; ?>" />
                        <div class="row">
                            <div class="col-10 col-md-4 offset-1">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-10 col-md-4 offset-1 offset-md-0">
                                <div class="form-group">
                                    <label for="email">Correo</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-10 col-md-8 offset-1">
                                <div class="form-group">
                                    <label for="subject">Asunto</label>
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="" required>
                                </div>
                            </div>
                            <div class="col-10 col-md-8 offset-1">
                                <div class="form-group">
                                    <label for="message">Mensaje</label>
                                    <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 col-md-2 offset-7">
                                <div class="form-group text-right">
                                    <button id="send" type="submit" class="btn">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="clearfix">&nbsp;</div>
            </div>

            <div class="container-fluid ">
                <div class="row bg-b">
                    <div class="col-7">
                        <div class="social">
                            <h4>Siguenos</h4>
                            <a href="#"  target="_blank">
                                <img src="images/tw.png" alt="Twitter" />
                            </a>
                            <a href="https://www.facebook.com/Fenlove-1606086066335704/" target="_blank">
                                <img src="images/fb.png" alt="Facebook" />
                            </a>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="copyright text-right">
                            <p>
                                2017 Fenlove®<br>
                                <a href="mailto:info@fenlove.me">info@fenlove.me</a><br><br>
                                <a href="#">Aviso de Privacidad</a>
                            </p>
                            <p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <script src="js/easyzoom.js"></script>
        <script>
            $(function(){
                $('form').submit(function(event) {
                    event.preventDefault();

                    if($('textarea#message').val()) {
                        $.post("send.php", $('form').serialize(), function(data) {
                            if(data.type === 'success') {
                                $('form')[0].reset();
                            } else {
                                alert(data.message);
                            }
                        }, "json");
                    }

                    return false;
                });
            });
        </script>

    </body>
</html>