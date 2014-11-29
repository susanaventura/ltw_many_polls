<?php
/*
try{
  $db = new PDO('sqlite:database.db');
  } catch (PDOException $e) {
	  echo $e->getMessage();
  };
  */
function getAllPublicPolls() {
	global $db;
	
	try {

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

function getUserPolls($user) {
	global $db;
	
	try {
		var_dump($db);
		 $stmt = $db->prepare('SELECT id, title, owner, image FROM Poll WHERE owner = ?');

		 //var_dump($stmt);
		 $stmt->execute(array($user));   
		 
		 $res = $stmt->fetchAll();
		 
		 //var_dump($res);
		 
		 
	} catch (PDOException $e) {
			echo $e->getMessage();
	}
		 
	return $res;
}

function getQuestionsPolls($text) {
	global $db;
	var_dump($db);
	$string = "%".$text."%";
	try {
		
		 $stmt = $db->prepare('SELECT id, title, owner, image FROM Poll WHERE id in (select poll FROM Question WHERE question LIKE :text)');


		 $stmt->bindParam(':text', $string);
		 $stmt->execute();   
		 
		 $res = $stmt->fetchAll();
		 		 
		 
	} catch (PDOException $e) {
			echo $e->getMessage();
	}
		 
	return $res;
}


function getPollsByText($text) {
	global $db;
	$string = "%".$text."%";
	try {
		var_dump($db);
		 $stmt = $db->prepare('SELECT id, title, owner, image FROM Poll WHERE title like ?');

		 //var_dump($stmt);
		 $stmt->execute(array($string));   
		 
		 $res = $stmt->fetchAll();
		 
		 //var_dump($res);
		 
		 
	} catch (PDOException $e) {
			echo $e->getMessage();
	}
		 
	return $res;
}
?>