<?php

	/*retorna false se user ou psw incorretos, ou o user se funcionar*/
	include_once("templates/secureSessionStart.php");                         // starts the session 
	  
	include('../database/connection.php'); // connects to the database
	include('../database/polls.php');      // loads the functions responsible for the users table
	include('../php/templates/tokenHandling.php');
	
	
	if (isset($_SESSION['username']) && isset($_POST['csrf_token']) && verifyCSRFToken($_POST['csrf_token'])) {
		
		$user = $_SESSION['username'];		
		$title = $_POST['title'];
		$image = $_POST['image'];
		$isPrivate = $_POST['isPrivate'];
		$voteLabel = $_POST['voteLabel'];
		$resultsLabel= $_POST['resultsLabel'];
		$questions = array();
		$questions['questionText'] = $_POST['question'];
		$questions['multipleAnswer'] = $_POST['multipleAnswer']; 
		$questions['answers'] = json_decode($_POST['answers']);
		
		
		submitPoll($user,$title,$image,$isPrivate,$voteLabel,$resultsLabel,$questions);
		
		$jsonResponse = array('pollSubmitted' => true);
		echo json_encode($jsonResponse);
	}
	
	else {
		$jsonResponse = array('pollSubmitted' => false);
		echo json_encode($jsonResponse);}
	
?>
