<?php
/*
try{
  $db = new PDO('sqlite:database.db');
  } catch (PDOException $e) {
	  echo $e->getMessage();
  };
  */
	  
/**** filtros de pesquisa *****/
function getAllPublicPolls($user) {
	global $db;
	
	try {

		 $stmt = $db->prepare('SELECT id, title, owner, image, isPrivate FROM Poll WHERE isPrivate = 0 OR owner = ? ORDER BY id DESC');

		 $stmt->execute(array($user));   
		 
		 $res = $stmt->fetchAll();	 
		 
	} catch (PDOException $e) {
			echo $e->getMessage();
	}
		 
	return $res;
}

function getUserPolls($user) {
	global $db;
	
	try {

		 $stmt = $db->prepare('SELECT id, title, owner, image, isPrivate FROM Poll WHERE owner = ? ORDER BY id DESC');

		 //var_dump($stmt);
		 $stmt->execute(array($user));   
		 
		 $res = $stmt->fetchAll();
		 
		 //var_dump($res);
		 
		 
	} catch (PDOException $e) {
			echo $e->getMessage();
	}
		 
	return $res;
}

function getPollsByKeys($text) {
	 global $db;

	 $string = "%".$text."%";
	 try {
	  
	   $stmt = $db->prepare('SELECT DISTINCT id, title, owner, image, isPrivate FROM Poll WHERE id in (select poll FROM Question WHERE question LIKE :text) OR title LIKE :text ORDER BY id DESC');

	   $stmt->bindParam(':text', $string);
	   $stmt->execute();   
	   
	   $res = $stmt->fetchAll();
		  
	   
	 } catch (PDOException $e) {
	   echo $e->getMessage();
	 }
	   
	 return $res;
}

function getPollsUserHasAnswered($user) {
	global $db;

	
	try {
		 $stmt = $db->prepare('
			SELECT DISTINCT id, title, owner, image, isPrivate 
			FROM Poll 
			WHERE id in 
				(SELECT DISTINCT Question.poll 
				 FROM Question, PossibleAnswer, UserAnswerPoll
				 WHERE 
					UserAnswerPoll.answer = PossibleAnswer.id AND
					PossibleAnswer.question = Question.id AND
					UserAnswerPoll.user = ?
				)
			ORDER BY id DESC
		');
		
		 $stmt->execute(array($user));   
		 
		 $res = $stmt->fetchAll();
		 		 
		 
	} catch (PDOException $e) {
			echo $e->getMessage();
	}
		 
	return $res;
}

function getPollsUserCanAnswer($user){
	global $db;

	try {
		
		 $stmt = $db->prepare('
			SELECT DISTINCT id, title, owner, image, isPrivate 
			FROM Poll 
			WHERE id not in 
				(SELECT DISTINCT Question.poll 
				 FROM Question, PossibleAnswer, UserAnswerPoll
				 WHERE 
					UserAnswerPoll.answer = PossibleAnswer.id AND
					PossibleAnswer.question = Question.id AND
					UserAnswerPoll.user = ?
				)
			ORDER BY id DESC
		');
		
		 $stmt->execute(array($user));   
		 
		 $res = $stmt->fetchAll();
		 		 
		 
	} catch (PDOException $e) {
			echo $e->getMessage();
	}
		 
	return $res;
}




/********/


class Poll {
	public $id;
	public $title;
	public $owner;
	public $image;
	public $voteLabel;
	public $resultsLabel;
	
	public $questions;
}

function getPoll($pollid) {
	global $db;
	
	$queryPoll = $db->prepare('SELECT title,image,owner,voteLabel,resultsLabel FROM Poll WHERE id = ?');
	$queryQuestions = $db->prepare('SELECT id,question, multipleAnswers FROM Question WHERE poll = ?');
	$queryPossibleAnswer = $db->prepare('SELECT * FROM PossibleAnswer WHERE question = ?');
	
	$queryPoll->execute(array($pollid));
	$pollRes = $queryPoll->fetch();
	if ($pollRes == false) return false;
	
	$poll = new Poll();
	$poll->id = $pollid;
	$poll->title = $pollRes['title'];
	$poll->owner = $pollRes['owner'];
	$poll->image = $pollRes['image'];
	$poll->voteLabel = $pollRes['voteLabel'];
	$poll->resultsLabel = $pollRes['resultsLabel'];
	
	
	$queryQuestions->execute(array($pollid));
	$poll->questions = $queryQuestions->fetchAll();

	
	foreach($poll->questions as $i => $question) {
		$queryPossibleAnswer->execute(array($question['id']));
		$poll->questions[$i]['possibleanswers'] = $queryPossibleAnswer->fetchAll();
	}
	
	return $poll;
}

/*
	Verifica se um user já respondeu a uma poll e dá as respostas dele
	Devolve false se ainda não respondeu
	Devolve um array com as respostas dele caso contrario.
*/
function userAnsweredPoll($user, $poll) {
	global $db;
	
	if ($user == 'anonymous') {
		if (!isset($_SESSION['pollsAnswered'])) return false;
		if (!isset($_SESSION['pollsAnswered'][$poll])) return false;
		
		return $_SESSION['pollsAnswered'][$poll];
	}
	
	$queryGetAnswersByUserAndPoll = $db->prepare(' 
		SELECT UserAnswerPoll.answer as id
		FROM UserAnswerPoll,PossibleAnswer,Question 
		WHERE
			UserAnswerPoll.answer = PossibleAnswer.id AND
			PossibleAnswer.question = Question.id AND
			UserAnswerPoll.user = ? AND
			Question.poll = ?;
	');
			
	$queryGetAnswersByUserAndPoll->execute(array($user, $poll));
	$res = $queryGetAnswersByUserAndPoll->fetchAll();
	
	if (sizeof($res)>0) {
		$answers = array();
		foreach($res as $i=>$answer) {
			$answers[$i] = $answer['id'];
		}
		return $answers;
	} else
		return false;
}


/*
	Guarda na base de dados as respostas de um user a uma poll
	Caso seja anonimo guarda se respondeu, e as suas respostas, na session
	Não faz quaisquer verificações!	
*/
function giveAnswer($user, $poll, $answers) {
	global $db;
	
	$insertAnswer = $db->prepare(' INSERT INTO UserAnswerPoll values(?,?)');
	
	// annonimous
	if ($user == 'anonymous') {
		if (!isset($_SESSION['pollsAnswered']))	$_SESSION['pollsAnswered'] = array();
		if (!isset($_SESSION['pollsAnswered'][$poll])) {
			$_SESSION['pollsAnswered'][$poll] = $answers;				
		}
	} 	
	
	foreach($answers as $answer) {
		$insertAnswer->execute(array($user,$answer));
		
	}

}

/*
	Devolve os resultados de uma certa pergunta.
	Output
	Array(2) {
		['questionText'] => texto da pergunta
		['answers'] => array(numero de respostas possiveis) {
				array(2) { texto da resposta possivel 1, numero de respostas de utilizadores com esta resposta},
				array(2) { texto da resposta possivel 2, numero de respostas de utilizadores com esta resposta},
				(...)
				array(2) { texto da resposta possivel n, numero de respostas de utilizadores com esta resposta}
		}
	}
	
	Exemplo:
	$results = getResults($idPergunta);
	echo "Respostas à pergunta $results['questionText']: <br>";
	foreach($results['answers'] as $answer) {
		echo "Resposta: $answer['text'] => $answer['n'] respostas. <br>";
	}
	
*/
function getResults($question) {
	 global $db;
	 
	 $queryQuestionResults = $db->prepare(' 
		  SELECT 
		   PossibleAnswer.id as answer, PossibleAnswer.answer as answerText, count(UserAnswerPoll.answer) as n
		  FROM 
		   PossibleAnswer left join UserAnswerPoll 
		   ON UserAnswerPoll.answer = PossibleAnswer.id
		  WHERE
		   PossibleAnswer.question = ?
		  GROUP BY
		   PossibleAnswer.id;
	 ');
	 $queryQuestionText = $db->prepare('SELECT question FROM Question WHERE id = ?');
	 
	 $queryQuestionResults->execute(array($question));
	 $queryQuestionText->execute(array($question));
	 
	 $res = $queryQuestionResults->fetchAll();

	 $results = array();
	 $results['questionText'] = $queryQuestionText->fetch()['question'];
	 $results['answers'] = array();
	 
	 foreach($res as $answerRes)
	  array_push($results['answers'], 
		 array((string) $answerRes['answerText'], (int) $answerRes['n']));
	  
	 //var_dump($results['answers']);
	 return $results;
}

/*
	Função para criar uma poll
	$questions é um array de questions em que cada elemento tem:
	'questionText' => texto da pergunta
	'multipleAnswer' => bool de se é multipleAnswer
	'answers' => array com o texto de cada answer
	Tambem funciona se for enviado um elemento só em $questions
*/
function submitPoll($user, $title, $image, $isPrivate, $voteLabel, $submitLabel, $questions) {
	global $db;
	
	if (isset($questions['questionText'])) $questions = array($questions);
	
	$insertPoll = $db->prepare(' INSERT INTO Poll(title,image,isPrivate,owner,voteLabel,resultsLabel) values(?,?,?,?,?,?)');
	$insertQuestion = $db->prepare(' INSERT INTO Question(question, poll, multipleAnswers) values (?,?,?)');
	$insertPossibleAnswer = $db->prepare(' INSERT INTO PossibleAnswer(answer, question) values(?,?)');
	
	$insertPoll->execute(array($title, $image, $isPrivate, $user, $voteLabel, $submitLabel));
	$pollId =  $db->lastInsertId("id");
	 
	foreach($questions as $question) {
		$insertQuestion->execute(array($question['questionText'], $pollId, $question['multipleAnswer']));
		$questionID = $db->lastInsertId("id");
		
		foreach($question['answers'] as $answerText)
			$insertPossibleAnswer->execute(array($answerText, $questionID));		
	}
}

function changePollPrivacy($pollId, $newPrivacy){
	global $db;
	
	$updateQuery = $db->prepare('UPDATE Poll SET isPrivate = ? WHERE id = ?');
	
	$updateQuery->execute(array($newPrivacy, $pollId));
}

function removePoll($pollId) {
	global $db;
	
	$deleteQuery = $db->prepare('DELETE FROM Poll WHERE id = ?');
	
	$deleteQuery->execute(array($pollId));
	
}

function removeUser($username) {
	
	global $db;
	
	$deleteQuery = $db->prepare('DELETE FROM User WHERE username = ?');
	
	$deleteQuery->execute(array($username));
	
}


?>