<?php
	session_start(); 
	
	/* include das databases*/
	include('../database/connection.php');
	include('../database/polls.php');
	
	if(!isset($_SESSION['username'])) $user = 'anonymous'; else $user = $_SESSION['username'];

	if (!isset($_GET['searchText']))
		$polls = getAllPublicPolls($user);
	
	else if($_GET['searchText'] == "MyPolls")
		$polls = getUserPolls($user);
	
	else if($_GET['searchText'] == "PollsIcanAnswer")
		$polls = getPollsUserCanAnswer($user);
	
	else if($_GET['searchText'] == "PollsIveAnswered")
		$polls = getPollsUserHasAnswered($user);
	
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