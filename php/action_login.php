<?php

	$refer = $_SERVER['HTTP_REFERER'];
	echo "Refer: $refer <br>";
	$session = session_start();                         // starts the session 
	echo "Session: $session <br>";
	  
	include('../database/connection.php'); // connects to the database
	include('../database/users.php');      // loads the functions responsible for the users table
	 
	$postUser = $_POST['username']; //can be email or username
	$postPsw = $_POST['password'];
	 

	if (userExists($postUser) && correctPswUser($postUser, $postPsw)){ // test if user exists
		if (strpos($postUser, '@') !== false)
			$user = getUsername($postUser);
		else $user = $postUser;
		
		$_SESSION['username'] = $user;         // store the username
	}
 	
 // if (!empty($_SERVER['HTTP_REFERER'])) header("Location: ".$_SERVER['HTTP_REFERER']);
	header("Location: ".'http://paginas.fe.up.pt/~ei12009/projeto/php/editPollPage.php');

?>
