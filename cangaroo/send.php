<?php
$to      = "contacto@cangaroo.com.mx";
$subject = "Sitio Web : Contacto";
$message = "Nombre: ".$_REQUEST["name"]."\nTel.: ".$_REQUEST["phone"]."\n\n".$_REQUEST["comments"];
$email = $_REQUEST["email"];

function iniciar_pagina($titulo, $tiempo) {
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/xhtml1-strict.dtd">';
	echo '<html xmlns="http://www.w3.org/1999/xhtml">';
	echo '<head>';
	echo '<title>'.$titulo.'</title>';
	echo '<meta http-equiv="Content-Type" content="text/xhtml; charset=utf-8"/>';
	if( $tiempo != "" ) {
		echo '<meta http-equiv="Refresh" content="'.$tiempo.';URL=contacto.html"/>';
	}
	echo '</head>';
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
	iniciar_pagina("Servicio Peugeot Cangaroo : Email Inválido", "");
	echo '<a href="javascript:history.back()">Por favor, ingrese una dirección de correo válida.</a>';
} else {
	$headers = "From: $email";
	if( mail($to, $subject, $message, $headers) ) {
		iniciar_pagina("Servicio Peugeot Cangaroo : Envío Exitoso", "3");
		echo("<p>El mensaje se envió correctamente.</p>");
	} else {
		iniciar_pagina("Servicio Peugeot Cangaroo : Envío Fallido", "3");
		echo("<p>El mensaje no se pudo enviar, intentelo más tarde.</p>");
	}
}

cerrar_pagina();

?>