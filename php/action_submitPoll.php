<?php

	/*retorna false se user ou psw incorretos, ou o user se funcionar*/
	$session = session_start();                         // starts the session 
	  
	include('../database/connection.php'); // connects to the database
	include('../database/polls.php');      // loads the functions responsible for the users table
	 
	//$user = $_SESSION['username'];	
	$user = 'teste';
	$questions = array();
	
	$title = $_GET['title'];
	$image = $_GET['image'];
	$isPrivate = $_GET['isPrivate'];
	
	$questions['questionText'] = $_GET['question'];
	$questions['multipleAnswer'] = $_GET['multipleAnswer']; 
	$questions['answers'] = json_decode($_GET['answers']);
	
	foreach($questions['answers'] as $i)
		echo "$i<br>";
	
	submitPoll($user,$title,$image,$isPrivate,$questions);
	
?>
