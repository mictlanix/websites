<?php
  include '_functions.php';
  
	session_start();
  validate_token();

	// response hash
	$response = array('type'=>'', 'message'=>'');
	
  try{
    $name = trim($_POST["name"]);
    $hash = sha1($name);
    
    if($name == "") {
      throw new Exception('El text de personalización está vacio.');
    }
    
    $home     = "/var/www/tinbox/bin";
    $program  = "NbTest.exe";
    $template = "../templates/nb-b1-junior.pdf";
    $output   = "../htdocs/downloads/$hash.pdf";
    $cmd      = "mono '$program' '$template' '$name' '$output'";
    
    $cwd = getcwd();
    chdir($home);
    exec($cmd);
		chdir($cwd);
		
		// let's assume everything is ok, setup successful response
		$response['type'] = 'success';
		$response['message'] = "downloads/$hash.pdf";
	}catch(Exception $e){
		$response['type'] = 'error';
		$response['message'] = $e->getMessage();
	}
	
	// now we are ready to turn this hash into JSON
	print json_encode($response);
	exit;
?>