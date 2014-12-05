<?php
	session_start(); 

	/* include das databases*/
	include('../database/connection.php');
	include('../database/polls.php');
	
	if (isset($_GET['id']))
		$poll = getPoll($_GET['id']);
	else die();
	
	if(!isset($_SESSION['username'])) $user = 'anonymous'; else $user = $_SESSION['username'];
	if(!isset($_SESSION['csrf_token'])) $token = ''; else $token = $_SESSION['csrf_token'];
		
	$userAnsweredPoll = userAnsweredPoll($user, $_GET['id']);
	
	$polls = getUserPolls($poll->owner);
	foreach($polls as $i => $p) {
		if ($p['id'] == $poll->id)
			unset($polls[$i]);
	}
	
	/* include templates */
	include_once("templates/header.php");  
	include_once("templates/pollX.php");
	include_once("templates/footer.php");

?>