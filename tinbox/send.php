<?php
  include '_functions.php';
  
	session_start();
  validate_token();
	
	// response hash
	$response = array('type'=>'', 'message'=>'');
	$field_names = array('name'=>'nombre', 'email'=>'email', 'phone'=>'teléfono', 'message'=>'mensaje');

	try{
		// do some sort of data validations, very simple example below
		$required_fields = array('name', 'email', 'message');
		foreach($required_fields as $field){
			if(empty($_POST[$field])){
				throw new Exception('El campo requerido "'.ucfirst($field_names[$field]).'" está vacio.');
			}
		}
		
		if (!is_valid_email($_POST['email'])) {
			throw new Exception('El email proporcionado no es válido.');
		}
		
		$email   = $_POST["email"];
		
		// save email
		try {
			save_email($email, 2);
		} catch (Exception $e) {
		}
		
		// ok, field validations are ok
		$to      = "eddy@mictlanix.org";
		//$to      = "info@tinbox.mx, judith@tinbox.mx";
		$from		 = "website@tinbox.mx";
		$subject = "Tinbox - Sitio Web";
		$body    = "Nombre: ".$_POST["name"]."\n".
		           "Email: ".$_POST["email"]."\n".
		           "Tel.: ".$_POST["phone"]."\n\n".
		            $_POST["message"];
		$headers = "From: ".$from;
		
		// now, send email
		if(!mail($to, $subject, $body, $headers, "-f$from")) {
			throw new Exception('Ups, algo salió mal. Intentalo más tarde.');
		}
		
		// let's assume everything is ok, setup successful response
		$response['type'] = 'success';
		$response['message'] = 'Gracias por escribirnos!';
	} catch (Exception $e) {
		$response['type'] = 'error';
		$response['message'] = $e->getMessage();
	}

	// now we are ready to turn this hash into JSON
	print json_encode($response);
	exit;
?>