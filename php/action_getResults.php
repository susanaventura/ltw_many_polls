<?php

	/*retorna false se user ou psw incorretos, ou o user se funcionar*/
	$session = session_start();                         // starts the session 
	  
	include('../database/connection.php'); // connects to the database
	include('../database/polls.php');      // loads the functions responsible for the users table
	 
	
	$question  = $_GET['question'];
	$results = getResults($question);
	
	echo json_encode($results);
	
	
?>
