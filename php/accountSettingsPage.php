<?php
	session_start(); 
	
	/* include das databases*/
	include('../database/connection.php');
	include('../database/polls.php');
	
	
	
	
	/* include templates */
	include_once("templates/header.php");  
	include_once("templates/accountSettings.php");
	include_once("templates/footer.php");

?>