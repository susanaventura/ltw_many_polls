<?php
	session_start(); 

	echo time();
	
	/* include das databases*/
	include('../database/connection.php');
	include('../database/polls.php');
	

	if (!isset($_GET['searchText']))
		$polls = getAllPublicPolls();
	
	else if($_GET['searchText'] == "MyPolls")
		$polls = getUserPolls($_SESSION['username']);
	
	else if($_GET['searchText'] == "PollsIveAnswered")
		$polls = getPollsUserHasAnswered($_SESSION['username']);
	
	else $polls = getPollsByKeys($_GET['searchText']);
	
	
	/* include templates */
	include_once("templates/header.php");  
	include_once("templates/pollsList.php");
	include_once("templates/list_polls.php");
	include_once("templates/footer.php");

?>