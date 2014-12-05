<?php

	/*retorna false se user ou psw incorretos, ou o user se funcionar*/
	$session = session_start();                         // starts the session 
	  
	include('../database/connection.php'); // connects to the database
	include('../database/users.php');      // loads the functions responsible for the users table
	include('../php/templates/tokenHandling.php');

	$user = $_POST['username'];
	

	if($_SESSION['username'] == $user &&
				isset($_POST['csrf_token']) &&
				verifyCSRFToken($_POST['csrf_token'])){
					
					updateUser($user, $_POST['firstName'], $_POST['lastName'], $_POST['password'],$_POST['birthDate']);
					
					
					$jsonResponse = array('status' => true);
					echo json_encode($jsonResponse);
	}
	else {
		$jsonResponse = array('status' => false);
		echo json_encode($jsonResponse);
	}
				
			
?>