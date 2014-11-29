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


class Poll {
	public $id;
	public $title;
	public $owner;
	public $image;
	
	public $questions;
}

function getPoll($pollid) {
	global $db;
	
	$queryPoll = $db->prepare('SELECT title,image,owner FROM Poll WHERE id = ?');
	$queryQuestions = $db->prepare('SELECT id,question FROM Question WHERE poll = ?');
	$queryPossibleAnswer = $db->prepare('SELECT * FROM PossibleAnswer WHERE question = ?');
	
	$queryPoll->execute(array($pollid));
	$pollRes = $queryPoll->fetch();
	if ($pollRes == false) return false;
	
	$poll = new Poll();
	$poll->id = $pollid;
	$poll->title = $pollRes['title'];
	$poll->owner = $pollRes['owner'];
	$poll->image = $pollRes['image'];
	
	
	$queryQuestions->execute(array($pollid));
	$poll->questions = $queryQuestions->fetchAll();

	
	foreach($poll->questions as $i => $question) {
		$queryPossibleAnswer->execute(array($question['id']));
		$poll->questions[$i]['possibleanswers'] = $queryPossibleAnswer->fetchAll();
	}
	
	var_dump($poll);
	return $poll;
}

function giveAnswer($user, $question, $answer) {
	global $db;
	
	
	$deletePreviousAnswers = $db->prepare('
		DELETE FROM UserAnswerPoll 
		WHERE 
			user = ? and 
			answer in 
				(SELECT id from PossibleAnswer WHERE question = ?)
	'); // Delete all answers to the same question the user is trying to answer
	
	$insertAnswer = $db->prepare(' INSERT INTO UserAnswerPoll values(?,?)');
	
	// TODO

}


?>