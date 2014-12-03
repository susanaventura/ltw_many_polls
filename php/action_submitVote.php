<?php

	/*retorna false se user ou psw incorretos, ou o user se funcionar*/
	$session = session_start();                         // starts the session 
	  
	include('../database/connection.php'); // connects to the database
	include('../database/polls.php');      // loads the functions responsible for the users table
	 
	$user = $_GET['user'];
	
	if ($user == 'anonymous' || 
		(	isset($_SESSION['username']) && 
			$_SESSION['username'] == $user &&
			verifyCSRFToken($_POST['csrf_token'])) 
		) {
	
		$poll = $_GET['poll'];
		$answers = (array) json_decode($_GET['answers']);
	
		var_dump($answers);
	
		giveAnswer($user, $poll, $answers);
	} else {
		echo "Invalid csrf_token!!";
	}
	
?>
