<?php
include '0B$cUr3/_db_credentials_.php';

function validate_token() {
  if ($_SESSION['token'] != $_POST['token']){
  	$response = array('type'=>'', 'message'=>'');
  	$response['type'] = 'error';
  	$response['message'] = "Invalid token!";
  	print json_encode($response);
		exit;
	}
}

function is_valid_email($email) {
	return preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $email);
}

function save_email($email, $active = 1) {
	global $db_host, $db_name, $db_user, $db_password;
	
	// do some sort of data validations
	if (!is_valid_email($email)) {
		throw new Exception('El email proporcionado no es válido.');
	}
	
	try {
	  $dbh = new PDO('mysql:host='.$db_host.';dbname='.$db_name.';charset=utf-8', $db_user, $db_password);
	  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  
	  $sth = $dbh->prepare('SELECT active FROM subscriber WHERE email = :email');
	  $sth->bindValue(':email', $email, PDO::PARAM_STR);
	  $sth->execute();
	  
	  $result = $sth->fetchAll();
	  
	  if (count ($result)) {
	  	$sth = $dbh->prepare('UPDATE subscriber SET active = :active WHERE email = :email');
	 	}	else {
	 		$sth = $dbh->prepare('INSERT INTO subscriber (email, active) VALUES(:email, :active)');
	 	}
	 	
	 	if($active == 2) {
			$active = count ($result) ? $result[0][0] : 0;
	 	}
	 	
	 	$sth->bindParam(':email', $email, PDO::PARAM_STR);
	 	$sth->bindParam(':active', $active, PDO::PARAM_INT);
		$sth->execute();
	 	
    $dbh = null;
	} catch(PDOException $e) {
    $dbh = null;
		throw new Exception('Ups, algo salió mal. Intentalo más tarde.'. $e->getMessage());
	}
}
?>