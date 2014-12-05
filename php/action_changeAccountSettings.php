<?php

	/*retorna false se user ou psw incorretos, ou o user se funcionar*/
	include_once("templates/secureSessionStart.php");                   // starts the session 
	  
	include('../database/connection.php'); // connects to the database
	include('../database/users.php');      // loads the functions responsible for the users table
	include('../php/templates/tokenHandling.php');

	
	if(	isset($_POST['username']) &&
		isset($_POST['firstName']) &&
		isset($_POST['lastName']) &&
		isset($_POST['password']) &&
		isset($_POST['birthDate']) &&
		
		isset($_SESSION['username']) &&
		isset($_POST['csrf_token']) && verifyCSRFToken($_POST['csrf_token']) &&
		strtotime($_POST['birthDate']) != false && strtotime($_POST['birthDate']) >= strtotime('1900-01-01')
	  ){
					
		updateUser($_SESSION['username'], $_POST['firstName'], $_POST['lastName'], $_POST['password'],$_POST['birthDate']);
										
		$jsonResponse = array('status' => true);
		echo json_encode($jsonResponse);
	}
	else {
		$jsonResponse = array('status' => false);
		echo json_encode($jsonResponse);
	}
				
			
?>