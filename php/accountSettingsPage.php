<?php
	session_start(); 
	
	/* include das databases*/
	include('../database/connection.php');
	include('../database/users.php');
	
	$user = $_GET['user'];
	
	$userSettings = getUser($user);
	
	if(!$userSettings) die();
	
	/* include templates */
	include_once("templates/header.php");  
	include_once("templates/accountSettings.php");
	include_once("templates/footer.php");

	

	
?>