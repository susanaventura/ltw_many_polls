<?php
	session_start(); 
	
	/* include das databases*/
	include('../database/connection.php');
	include('../database/polls.php');
	

	if (!isset($_GET['searchText']))
		$polls = getAllPublicPolls();
	
	else if($_GET['searchText'] == "MyPolls")
		$polls = getUserPolls($_SESSION['username']);
	
	else if($_GET['searchText'] == "PollsIcanAnswer")
		$polls = getPollsUserCanAnswer($_SESSION['username']);
	
	else if($_GET['searchText'] == "PollsIveAnswered" && isset($_SESSION['username']))
		$polls = getPollsUserHasAnswered($_SESSION['username']);
	
	else $polls = getPollsByKeys($_GET['searchText']);
	require('../php/lib/password.php');
$options = ['cost' => 12];
	$passwordhash = password_hash('1', PASSWORD_DEFAULT, $options);
	var_dump($passwordhash);
	/* include templates */
	include_once("templates/header.php");  
	include_once("templates/pollsList.php");
	include_once("templates/list_polls.php");
	include_once("templates/footer.php");

?>