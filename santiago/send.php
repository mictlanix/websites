<?php
	function is_valid_email($email) {
	  return preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $email);
	}
	
    if($_POST){
        // response hash
        $field_names = array('name'=>'nombre', 'email'=>'email', 'phone'=>'teléfono', 'message'=>'mensaje');
        $response = array('type'=>'', 'message'=>'');
 
        try{
            // do some sort of data validations, very simple example below
            $required_fields = array('name', 'email', 'phone', 'message');
            foreach($required_fields as $field){
                if(empty($_POST[$field])){
                    throw new Exception('El campo requerido "'.ucfirst($field_names[$field]).'" está vacio.');
                }
            }
 
			if (!is_valid_email($_POST['email'])) {
				throw new Exception('El email proporcionado no es válido.');
			}
			
            // ok, field validations are ok
            
			$to      = "santiago@santiago.mx";
			$email   = $_POST["email"];
			$subject = "DSA - Sitio Web";
			$body    = "Nombre: ".$_POST["name"]."\n".
			           "Empresa: ".$_POST["company"]."\n".
			           "Email: ".$_POST["email"]."\n".
			           "Tel.: ".$_POST["phone"]."\n\n".
			            $_POST["message"];
			$headers = "From: ".$email;
			
            // now, send email
 
 			if(!mail($to, $subject, $body, $headers, "-f$email")) {
 				throw new Exception('Ups, algo salió mal. Intentalo más tarde.');
 			}
 			
            // let's assume everything is ok, setup successful response
            $response['type'] = 'success';
            $response['message'] = 'Gracias por comunicarte con nosotros!';
        }catch(Exception $e){
            $response['type'] = 'error';
            $response['message'] = $e->getMessage();
        }
        
        // now we are ready to turn this hash into JSON
        print json_encode($response);
        exit;
    }
?>