<?php
	include_once("templates/secureSessionStart.php"); 
	
	/* include das databases*/
	include('../database/connection.php');
	include('../database/users.php');
	
	if (!isset($_SESSION['username'])) die();
	$user = $_SESSION['username'];
	$userSettings = getUser($user);
	
	if(!$userSettings) die();
	
	/* include templates */
	include_once("templates/header.php");  
	include_once("templates/accountSettings.php");
	include_once("templates/footer.php");

	

	
?>