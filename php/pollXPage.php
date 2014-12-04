<?php
	session_start(); 

	/* include das databases*/
	include('../database/connection.php');
	include('../database/polls.php');
	if (isset($_GET['id']))
		$poll = getPoll($_GET['id']);
	else die();
	
	if(!isset($_SESSION['username'])) $user = 'anonymous'; else $user = $_SESSION['username'];

	$userAnsweredPoll = userAnsweredPoll($user, $_GET['id']);
	
	
	 
	/* include templates */
	include_once("templates/header.php");  
	include_once("templates/pollX.php");
	include_once("templates/footer.php");

?>