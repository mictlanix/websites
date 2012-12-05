<?php
	session_start();
  include '0B$cUr3/_db_credentials_.php';

	// response hash
	$response = array('type'=>'', 'message'=>'');
	
  if ($_SESSION['token'] != $_POST['token']){
  	$response['type'] = 'error';
  	$response['message'] = "Invalid token!";
  	print json_encode($response);
		exit;
	}

	function is_valid_email($email) {
	  return preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $email);
	}

	try{
		$email = $_POST["email"];
		
		// do some sort of data validations
		if (!is_valid_email($email)) {
			throw new Exception('El email proporcionado no es válido.');
		}

		// now, we save the email

		try {  
		  $dbh = new PDO('mysql:host='.$db_host.';dbname='.$db_name.';charset=utf-8', $db_user, $db_password);
		  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  
		  $sth = $dbh->prepare('SELECT subscriber_id FROM subscriber WHERE email = :email');
		  $sth->bindValue(':email', $email, PDO::PARAM_STR);
		  $sth->execute();
		  
		  $result = $sth->fetchAll();
		  
		  if (count ($result)) {
		  	$sth = $dbh->prepare('UPDATE subscriber SET active = 1 WHERE email = :email');
	  	}	else {
	  		$sth = $dbh->prepare('INSERT INTO subscriber (email, active) VALUES(:email, 1)');
	  	}
	  	
	  	$sth->bindParam(':email', $email, PDO::PARAM_STR);
 			$sth->execute();
		} catch(PDOException $e) {
			throw new Exception('Ups, algo salió mal. Intentalo más tarde.');
		}
		
		// let's assume everything is ok, setup successful response
		$response['type'] = 'success';
		$response['message'] = 'Gracias por suscribirte!';
	}catch(Exception $e){
		$response['type'] = 'error';
		$response['message'] = $e->getMessage();
	}

	$dbh = null;
	
	// now we are ready to turn this hash into JSON
	print json_encode($response);
	exit;
?>