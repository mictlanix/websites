<?php
  include '_functions.php';
  
	session_start();
  validate_token();

	// response hash
	$response = array('type'=>'', 'message'=>'');
	
	try{
		// now, we save the email
		save_email($_POST["email"], 0);
		
		// let's assume everything is ok, setup successful response
		$response['type'] = 'success';
		$response['message'] = 'Suscripción suspendida!';
	}catch(Exception $e){
		$response['type'] = 'error';
		$response['message'] = $e->getMessage();
	}
	
	// now we are ready to turn this hash into JSON
	print json_encode($response);
	exit;
?>