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

function getPollsByKeys($text) {
	global $db;
	var_dump($db);
	$string = "%".$text."%";
	try {
		
		 $stmt = $db->prepare('SELECT DISTINCT id, title, owner, image FROM Poll WHERE id in (select poll FROM Question WHERE question LIKE :text) OR title LIKE :text');


		 $stmt->bindParam(':text', $string);
		 $stmt->execute();   
		 
		 $res = $stmt->fetchAll();
		 		 
		 
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
		//$insertAnswer->execute(array($user,$answer));
		echo "userAnswerPoll($user, $answer) <br>";
	}

}

/*
	Devolve os resultados de uma certa pergunta.
	Output
	Array(2) {
		['questionText'] => texto da pergunta
		['answers'] => array(numero de respostas possiveis) {
				[idRespostaPossivel1] => array(2) {
					['text'] => texto da resposta possivel 1
					['n'] => numero de respostas de utilizadores com esta resposta
				}
				(...)
				[idRespostaPossivelN] => array(2) {
					['text'] => texto da resposta possivel n
					['n'] => numero de respostas de utilizadores com esta resposta
				}
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
	
	foreach($res as $answerRes) {
		$id = $answerRes['answer'];
		$results['answers'][$id]['text'] = $answerRes['answerText'];
		$results['answers'][$id]['n'] = $answerRes['n'];
	}
	return $results;
}

?>