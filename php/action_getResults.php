<?php

	/*retorna false se user ou psw incorretos, ou o user se funcionar*/
	include_once("templates/secureSessionStart.php");                         // starts the session 
	  
	include('../database/connection.php'); // connects to the database
	include('../database/polls.php');      // loads the functions responsible for the users table
	 
	if (isset($_GET['question'])) {
		$question  = $_GET['question'];
		$results = getResults($question);
	
		echo json_encode($results);
	}
	
	
?>
