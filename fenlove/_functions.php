<?php

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

?>