<?php

	/*retorna false se user ou psw incorretos, ou o user se funcionar*/
	include_once("templates/secureSessionStart.php");                        // starts the session 
	  
	include('../database/connection.php'); // connects to the database
	include('../database/polls.php');      // loads the functions responsible for the users table
	include('../php/templates/tokenHandling.php');
	 
	$user = $_POST['user'];
	
	if ($user == 'anonymous' || 
			(	isset($_SESSION['username']) && 
				$_SESSION['username'] == $user &&
				isset($_POST['csrf_token']) &&
				verifyCSRFToken($_POST['csrf_token'])
			) 
		)
		{
	
		$poll = $_POST['poll'];
		$answers = (array) json_decode($_POST['answers']);
	
		//var_dump($answers);
	
		giveAnswer($user, $poll, $answers);
		
		$jsonResponse = array('voteSubmitted' => true);
		echo json_encode($jsonResponse);
	} else {
		$jsonResponse = array('voteSubmitted' => false);
		echo json_encode($jsonResponse);
	}
	
?>
