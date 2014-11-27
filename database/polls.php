<?php

function getAllPublicPolls() {
	global $db;
	
	try {
		var_dump($db);
		 $stmt = $db->prepare('SELECT id, title, owner, image FROM Poll WHERE isPrivate = 0');

		 //var_dump($stmt);
		 $stmt->execute();   
		 
		 $res = $stmt->fetchAll();
		 
		 //var_dump($res);
		 
		 
	} catch (PDOException $e) {
			echo $e->getMessage();
	}
		 
	return $res;
}


?>