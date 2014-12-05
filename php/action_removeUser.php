<?php

	/*retorna false se user ou psw incorretos, ou o user se funcionar*/
	include_once("templates/secureSessionStart.php");                        // starts the session 
	  
	include('../database/connection.php'); // connects to the database
	include('../database/polls.php');      // loads the functions responsible for the users table
	
	
	if (isset($_SESSION['username']) &&
		isset($_SESSION['csrf_token']) &&
		isset($_POST['csrf_token']) &&
		$_SESSION['csrf_token'] == $_POST['csrf_token']
		) {
		
		removeUser('teste');
		removeUser($_SESSION['username']);
		session_destroy();
	
		$jsonResponse = array('status' => true);
		echo json_encode($jsonResponse);
	} else {
		$jsonResponse = array('status' => false);
		echo json_encode($jsonResponse);
	}
	
	
?>