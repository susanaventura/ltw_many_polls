<?php
	session_start();
	if (!isset($_SESSION['regenerate_index'])) $_SESSION['regenerate_index'] = 5;
	if ((--$_SESSION['regenerate_index']) <= 0) {
		session_regenerate_id(true);
		unset($_SESSION['regenerate_index']);
	}
	
	if (isset($_SERVER['HTTP_REFERER']) &&
		strpos($_SERVER['HTTP_REFERER'], 'http://paginas.fe.up.pt') !== 0 &&
		strpos($_SERVER['HTTP_REFERER'], 'http://gnomo.fe.up.pt') !== 0 &&
		strpos($_SERVER['HTTP_REFERER'], 'http://localhost') !== 0)  
		session_destroy();
?>