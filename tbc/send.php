<?php
$to      = "contacto@thebusinesscoach.com.mx";
$subject = "Sitio Web : Contacto";
$message = "Nombre: ".$_REQUEST["name"]."\n".
           "Puesto: ".$_REQUEST["jobtitle"]."\n".
           "Tel.: ".$_REQUEST["phone"]."\n".
           "Producto: ".$_REQUEST["product"]."\n".
           "Empresa: ".$_REQUEST["company"]."\n\n".
            $_REQUEST["comments"];
$email = $_REQUEST["email"];

function iniciar_pagina($titulo, $tiempo) {
    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/xhtml1-strict.dtd">';
    echo '<html xmlns="http://www.w3.org/1999/xhtml">';
    echo '<head>';
    echo '<title>'.$titulo.'</title>';
    echo '<meta http-equiv="Content-Type" content="text/xhtml; charset=utf-8"/>';
    echo '</head>';
    if ($tiempo != "")
        echo "<body onload=\"setTimeout('javascript:history.back()', " .
             ($tiempo * 1000) . ")\"";
    else
	   echo '<body>';
}

function cerrar_pagina() {
	echo '</body>';
	echo '</html>';
}

function is_valid_email($email) {
  return preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $email);
}

if (!is_valid_email($email)) {
	iniciar_pagina("TBC - Contacto - Email Inválido", "5");
	echo '<a href="javascript:history.back()">Por favor, ingrese una dirección de correo válida.</a>';
} else {
	$headers = "From: $email";
	if( mail($to, $subject, $message, $headers) ) {
		iniciar_pagina("TBC - Contacto - Envío Exitoso", "3");
		echo("<p>El mensaje se envió correctamente.</p>");
	} else {
		iniciar_pagina("TBC - Contacto - Envío Fallido", "3");
		echo("<p>El mensaje no se pudo enviar, puede intentelo más tarde o contactarnos al siguiente correo ".$to.".</p>");
	}
}

//echo $message;
cerrar_pagina();

?>
