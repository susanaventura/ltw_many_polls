<?php
echo "hello <br>";
  $refer = $_SERVER['HTTP_REFERER'];
  echo "Refer: $refer <br>";
  $session = session_start();                         // starts the session 
  echo "Session: $session <br>";
  
  include('../database/connection.php'); // connects to the database
  include('../database/users.php');      // loads the functions responsible for the users table
 
	$postUser = $_POST['username']; 
	$postPsw = $_POST['password'];
 
	include('../php/templates/tokenHandling.php');
 
	if (!userExists($postUser) && !userExists($_POST['email'])){ // test if user exists
		$user = signupUser($_POST['username'], $_POST['birth'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password']);
		$_SESSION['username'] = $postUser;         // store the username
		$_SESSION['csrf_token'] = generateRandomToken();
	}
	

	echo "OK<br>";
	
  if (!empty($_SERVER['HTTP_REFERER'])) header("Location: ".$_SERVER['HTTP_REFERER']);

?>
