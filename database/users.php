<?php

	require('../php/lib/password.php');

  function userExists($user) {
	global $db;
    try {
		$stmt = $db->prepare('SELECT * FROM User WHERE username = ? OR mail = ?');
		$stmt->execute(array($user, $user)); 
		
	} catch (PDOException $e) {
		echo $e->getMessage();
	}	

    return $stmt->fetch() !== false;
  }
  
  function correctPswUser($username, $password) {
	global $db;
	
	try {
		 $stmt = $db->prepare('SELECT password FROM User WHERE username = ? OR mail = ?');
		 $stmt->execute(array($username, $username));   
		 
		 $res = $stmt->fetch();
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
		 
	return ($res !== false && password_verify($password, $res['password']));
  }
  
  function signupUser($username, $birthdate, $firstname, $lastname, $email, $password) {
	  global $db;
	  
	  $stmt = $db->prepare('INSERT INTO User (username, birthDate, firstName, lastName, mail, password) VALUES (?, ?, ?, ?, ?, ?)');	  

	  if (!$stmt) {
		echo "\nPDO::errorInfo():\n";
		print_r($db->errorInfo());
	}
	
	$options = ['cost' => 12];
	$passwordhash = password_hash($password, PASSWORD_DEFAULT, $options);
	
	$user = $stmt->execute(array($username, $birthdate, $firstname, $lastname, $email, $passwordhash));
	
	return $user['username'];
	  
  }
  
  //returns username for the given mail
  function getUsername($mail) {
	  global $db;
	  $username;
	  try {
		 $stmt = $db->prepare('SELECT username FROM User WHERE mail = ?');
		 $stmt->execute(array($mail));   
		 
		 $res = $stmt->fetch();
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
	
	
	return $res['username'];
  }
  
?>
