<?php

	/*retorna false se user ou psw incorretos, ou o user se funcionar*/
	$session = session_start();                         // starts the session 
	  
	include('../database/connection.php'); // connects to the database
	include('../database/polls.php');      // loads the functions responsible for the users table
	include('../php/templates/tokenHandling.php');
	
	$user = $_SESSION['username'];
	$token = $_POST['csrf_token'];
	

	
	if (isset($_SESSION['username']) && verifyCSRFToken($token)) {
			
		$title = $_POST['title'];
		$image = $_POST['image'];
		$isPrivate = $_POST['isPrivate'];
	
		$questions = array();
		$questions['questionText'] = $_POST['question'];
		$questions['multipleAnswer'] = $_POST['multipleAnswer']; 
		$questions['answers'] = json_decode($_POST['answers']);
		
		submitPoll($user,$title,$image,$isPrivate,$questions);
		
		$jsonResponse = array('pollSubmitted' => true);
		echo json_encode($jsonResponse);
		
	}
	
	else {
		$jsonResponse = array('pollSubmitted' => false);
		echo json_encode($jsonResponse);}
	
?>
