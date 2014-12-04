<?php
  $session = session_start();                         // starts the session 

  
  include('../database/connection.php'); // connects to the database
  include('../database/users.php');      // loads the functions responsible for the users table
  include('../php/templates/tokenHandling.php');
	
	$maxLen = 48;
	$postUser = substr($_POST['username'], 0, $maxLen); 
	$postPsw = substr($_POST['password'], 0, $maxLen);
	$postEmail = substr($_POST['email'], 0, $maxLen);
	$postBirthDate = $_POST['birth'];
	$postFirstName = substr($_POST['firstname'], 0, $maxLen);
	$postLastName = substr($_POST['lastname'], 0, $maxLen);
	
	$birthTimeStamp = strtotime($postBirthDate);
	
 
	if (userExists($postUser)) {
		$jsonResponse = array('correctSignup' => false, 'errorMsg' => 'Username already exists!');
		echo json_encode($jsonResponse);
	} else
	if (userExists($postEmail)) {
		$jsonResponse = array('correctSignup' => false, 'errorMsg' => 'Email already exists!');
		echo json_encode($jsonResponse);
	} else
	if ($birthTimeStamp == false || $birthTimeStamp < strtotime('1900-01-01')) {
		$jsonResponse = array('correctSignup' => false, 'errorMsg' => 'Invalid birth date!');
		echo json_encode($jsonResponse);
	} else 
	{
		signupUser($postUser, $postBirthDate, $postFirstName, $postLastName, $postEmail, $postPsw);
		
		// login new user
		$_SESSION['username'] = $postUser;
		$_SESSION['csrf_token'] = generateRandomToken();
		
		$jsonResponse = array('correctSignup' => true);
		echo json_encode($jsonResponse);
	}
	

?>
