<?php

	/*retorna false se user ou psw incorretos, ou o user se funcionar*/
	include_once("templates/secureSessionStart.php");                        // starts the session 
	  
	include('../database/connection.php'); // connects to the database
	include('../database/polls.php');      // loads the functions responsible for the users table
	
	$postPollId = $_POST['id'];
	$postToken = $_POST['csrf_token'];
	$poll = getPoll($postPollId);
	$pollOwner = $poll->owner;
	
	if (isset($_SESSION['username']) &&
		$_SESSION['username'] == $pollOwner &&
		isset($_SESSION['csrf_token']) &&
		$_SESSION['csrf_token'] == $postToken
		) {
		
		removePoll($postPollId);
	
		$jsonResponse = array('status' => true);
		echo json_encode($jsonResponse);
	} else {
		$jsonResponse = array('status' => false);
		echo json_encode($jsonResponse);
	}
	
	
?>