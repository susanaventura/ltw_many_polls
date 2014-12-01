<?

/*try{
  $db = new PDO('sqlite:database.db');
  } catch (PDOException $e) {
	  echo $e->getMessage();
  };*/

	
	$question=$_GET['id'];
		
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

	echo json_encode($results);
?>