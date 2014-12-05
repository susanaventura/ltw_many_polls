<?php

	/*retorna false se user ou psw incorretos, ou o user se funcionar*/
	include_once("templates/secureSessionStart.php");                         // starts the session 
	
	include('../database/connection.php'); // connects to the database
	include('../database/users.php');      // loads the functions responsible for the users table
	include('../php/templates/tokenHandling.php');
	
	if (isset($_POST['username']) && 
		isset($_POST['password']) &&
		userExists($postUser) && 
		correctPswUser($postUser, $postPsw)
		){ // test if user exists
		
		if (strpos($postUser, '@') !== false)
			$user = getUsername($postUser);
		else $user = $postUser;
		
		$_SESSION['username'] = $user;         // store the username
		$_SESSION['csrf_token'] = generateRandomToken(); // generate a auth token
			
		$jsonResponse = array('correctLogin' => true);
		echo json_encode($jsonResponse);

	} else {
		$jsonResponse = array('correctLogin' => false);
		echo json_encode($jsonResponse);
	}
	
?>
