
<?php
	include_once("templates/secureSessionStart.php");

	/* include das databases*/
	if(!isset($_SESSION['username'])) $user = 'anonymous'; else $user = $_SESSION['username'];
	if(!isset($_SESSION['csrf_token'])) $token = ''; else $token = $_SESSION['csrf_token'];
		
	/* include templates */
	include_once("templates/header.php");  
	include_once("templates/editPoll.php");  
	include_once("templates/footer.php");  
?>
