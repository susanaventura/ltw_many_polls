<?php
	session_start();
	session_regenerate_id(true);
	
	if (isset($_SERVER['HTTP_REFERER']) &&
		strpos($_SERVER['HTTP_REFERER'], 'http://paginas.fe.up.pt') !== 0 &&
		strpos($_SERVER['HTTP_REFERER'], 'http://gnomo.fe.up.pt') !== 0 &&
		strpos($_SERVER['HTTP_REFERER'], 'http://localhost') !== 0)  
		session_destroy();
?>