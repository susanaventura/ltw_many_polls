<?php

	/*retorna false se user ou psw incorretos, ou o user se funcionar*/
	$session = session_start();                         // starts the session 
	  
	include('../database/connection.php'); // connects to the database
	include('../database/polls.php');      // loads the functions responsible for the users table
	include('../php/templates/tokenHandling.php');
	 
	$user = $_GET['user'];
	
	if ($user == 'anonymous' || 
			(	isset($_SESSION['username']) && 
				$_SESSION['username'] == $user &&
				isset($_GET['csrf_token']) &&
				verifyCSRFToken($_GET['csrf_token'])
			) 
		)
		{
	
		$poll = $_GET['poll'];
		$answers = (array) json_decode($_GET['answers']);
	
		//var_dump($answers);
	
		giveAnswer($user, $poll, $answers);
		
		$jsonResponse = array('voteSubmitted' => true);
		echo json_encode($jsonResponse);
	} else {
		$jsonResponse = array('voteSubmitted' => false);
		echo json_encode($jsonResponse);
	}
	
?>
