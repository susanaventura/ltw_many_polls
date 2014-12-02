<?php

	/*retorna false se user ou psw incorretos, ou o user se funcionar*/
	$session = session_start();                         // starts the session 
	  
	include('../database/connection.php'); // connects to the database
	include('../database/users.php');      // loads the functions responsible for the users table
	 
	$postUser = $_POST['username']; //can be email or username
	$postPsw = $_POST['password'];
	 
	$correctLogin = userExists($postUser) && correctPswUser($postUser, $postPsw);
	

	if ($correctLogin){ // test if user exists
		if (strpos($postUser, '@') !== false)
			$user = getUsername($postUser);
		else $user = $postUser;
		
		$_SESSION['username'] = $user;         // store the username
			
		$jsonResponse = array('correctLogin' => true);
		echo json_encode($jsonResponse);
		//return;
	} else {
		$jsonResponse = array('correctLogin' => false);
		echo json_encode($jsonResponse);
		//return;
	}
	
?>
