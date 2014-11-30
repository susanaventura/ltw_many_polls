<?php
session_start();
/* include das databases*/
	include('../database/connection.php');
	include('../database/polls.php');
		$polls = getAllPublicPolls();

	
	/* include templates */
	include_once("templates/header.php");  
	include_once("templates/pollsList.php");
	include_once("templates/list_polls.php");
	include_once("templates/pollX.php");
	include_once("templates/footer.php");

?>