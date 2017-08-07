<?php 

require('../config.php');





if (!empty($_POST)){

	// this post is coming from the user form
	// note we aren't saving their first question response
	if($_POST['step'] == 'user'){

		$error = false;
		$clean = $focus = array();
		$message = '';


		// validate required fields, save in $clean
		$fn = filter_var($_POST['fn'],FILTER_SANITIZE_STRING);
		if($fn != ''){ $clean['fn'] = $fn; }
		else { $error = true; array_push($focus,'#fn'); }

		$ln = filter_var($_POST['ln'],FILTER_SANITIZE_STRING);
		if($ln != ''){ $clean['ln'] = $ln; }
		else { $error = true; array_push($focus,'#ln'); }

		$email = filter_var($_POST['em'],FILTER_SANITIZE_EMAIL);
		if((filter_var($email, FILTER_VALIDATE_EMAIL))&&($email != '')){ $clean['email'] = $email; } 
		else { $error = true; array_push($focus,'#em'); }
		
		/*$answer = filter_var($_POST['answer'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
		if((filter_var($answer,FILTER_VALIDATE_FLOAT))&&($answer != '')) { $clean['q1'] = $answer; }
		else { $error = true; array_push($focus, '#answer'); $message = 'There was a problem with your request. Please try again later.'; }*/


		// validate optional fields
		if(!empty($_POST['address'])){ $clean['address'] = filter_var($_POST['address'],FILTER_SANITIZE_STRING); }
		if(!empty($_POST['city'])){ $clean['city'] = filter_var($_POST['city'],FILTER_SANITIZE_STRING); }
		if(!empty($_POST['state'])){ $clean['state'] = filter_var($_POST['state'],FILTER_SANITIZE_STRING); }
		if(!empty($_POST['zip'])){ $clean['zip'] = filter_var($_POST['zip'],FILTER_SANITIZE_STRING); }
		if(!empty($_POST['optin']) && $_POST['optin'] == 'y'){ $clean['opt_in'] = 'y'; }
		if(!empty($_POST['source'])){ $clean['utmSource'] = 'WITWQuiz-'.filter_var($_POST['source'],FILTER_SANITIZE_STRING); }
		if(!empty($_POST['medium'])){ $clean['utmMedium'] = filter_var($_POST['medium'],FILTER_SANITIZE_STRING); }
		if(!empty($_POST['campaign'])){ $clean['utmCampaign'] = filter_var($_POST['campaign'],FILTER_SANITIZE_STRING); }
		if(!empty($_POST['term'])){ $clean['utmTerm'] = filter_var($_POST['term'],FILTER_SANITIZE_STRING); }
		if(!empty($_POST['content'])){ $clean['utmContent'] = filter_var($_POST['content'],FILTER_SANITIZE_STRING); }


		// how'd we do?
		if($error == false){

			// create timestamp
			$clean['created_on'] = date('Y-m-d H:i:s'); 
			
			// save the string, 
			// note the array keys in clean are the names of the table columns
			$columns = $vals = '';
			foreach($clean as $key => $val){
				$columns .= $key.',';
				$vals .= ':'.$key.',';
			}

			$columns = rtrim($columns, ',');
			$vals = rtrim($vals, ',');

			$stmt = $app['pdo']->prepare('SELECT * FROM users WHERE email = :em');
			$stmt->bindValue(':em', $clean['email']);
			$stmt->execute();
			$existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

			if($existingUser == false){
				$sql = 'INSERT INTO users ('.$columns.') VALUES ('.$vals.') RETURNING user_id';
			} else {
				//$sql = 'INSERT INTO users ('.$columns.') VALUES ('.$vals.') RETURNING user_id';
				//$sql = "UPDATE users SET q".$question." = :answer WHERE user_id = :id";
			}
			$sql = 'INSERT INTO users ('.$columns.') VALUES ('.$vals.') RETURNING user_id';

			$stmt = $app['pdo']->prepare($sql);

			foreach($clean as $key => $val){
				$stmt->bindValue(':'.$key, $val); //bind the values to the prepared statement
			}

			// try to save it
			if($stmt->execute()){
				$user = $stmt->fetch(PDO::FETCH_ASSOC); 
				$resp = $user['user_id'];
				$result = 'success';

			} else {
				$result = 'error';
				$resp = $stmt->errorInfo();
			}

			$resp = array('result'=>$result,'resp'=>$resp,'message'=>$clean,'id'=>$user['user_id']); // define a response

		} else {
			$resp = array('result'=>'error', 'focus'=>$focus, 'message' => 'Oops, something went wrong on the form! Please fill in any missing information below.'); // define a response (this one def an error)
		}

		// create user session if it was a successful insert
		if($result == 'success'){
			$app['session']->set('user', array('userId' => $user['user_id']));
		}

		echo json_encode($resp); // response to user

	}








	if($_POST['step'] == 'question'){
		$user = $app['session']->get('user');
		$userId = $user['userId'];

		$error = false;
		$clean = $focus = array();
		$message = '';

		$answer = filter_var($_POST['answer'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
		if((filter_var($answer,FILTER_VALIDATE_FLOAT))&&($answer != '')) { $clean['answer'] = $answer; }
		else { $error = true; }

		if($_POST['questionNumber'] >= 0 && $_POST['questionNumber'] <= 9){
			$question = $_POST['questionNumber'];
			$question++;
		} else {
			$error = true;
		}


		if($error == false){

			$sql = "UPDATE users SET q".$question." = :answer WHERE user_id = :id";
			$stmt = $app['pdo']->prepare($sql);
			$stmt->bindValue(':answer', $clean['answer']);
			$stmt->bindValue(':id', $userId);
			if($stmt->execute()){
				$result = 'success';
				$message = calculateScore($app,$question,$clean['answer'],$userId);

			} else {
				$result = 'error';
				$message = 'failed to update user';
			}
				
		} else {
			$result = 'error';
			$message = 'form validation failed';
		}


		$resp = array('result'=>$result, 'message' => $message, 'userId' => $userId); 
		echo json_encode($resp); // response to user


	}

	if($_POST['step'] == 'final'){
		$user = $app['session']->get('user');
		$userId = $user['userId'];

		$message = calculateFinalScore($app,$userId);	
	}

}





function calculateScore($app,$questionNumber,$answer,$userId){

	// get other responses for this question
	$responses = array();
	$stmt = $app['pdo']->prepare('SELECT q'.$questionNumber.' FROM users');
	$stmt->execute();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		if($row['q'.$questionNumber] != NULL){ array_push($responses,$row['q'.$questionNumber]); }
	}

	

	// get the correct answer for this question
	$stmt = $app['pdo']->prepare('SELECT * FROM questions WHERE question_id = :id');
	$stmt->bindValue(':id', $questionNumber);
	$stmt->execute();
	$questionInfo = $stmt->fetch(PDO::FETCH_ASSOC);

	// find out how others did on this question
	$answerOffsets = array();
	foreach($responses as $response){
		array_push($answerOffsets,abs($response-$questionInfo['question_answer']));
	}

	// find out how this user did on this question
	$thisOffset = abs($answer-$questionInfo['question_answer']);

	// create array of worse responses
	$worseAnswers = array();
	foreach($answerOffsets as $offset){
		if($offset > $thisOffset){ array_push($worseAnswers,$offset); }
	}

	//you wanna subtract one from total to exclude this answer
	if(count($answerOffsets) == 1){
		$score = 100;
	} else {
		$score = round((count($worseAnswers)/(count($answerOffsets)-1) * 100)); 
	}

	$resp = array();
	$resp['userAnswer'] = $answer;
	$resp['questionId'] = $questionNumber;
	$resp['questionAnswer'] = $questionInfo['question_answer'];
	$resp['score'] = $score;
	$resp['userId'] = $userId;


	return $resp;
}


function calculateFinalScore($app,$id){

	$stmt = $app['pdo']->prepare('SELECT * FROM questions');
	$stmt->execute();

	$questions = array();
	while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        $questions['q'.$row['question_id']] = [
            'answer' => $row['question_answer'],
            'scale' => $row['question_scale'],
            'resp' => array(),
            'offsets' => array()
        ];
    }

	$stmt = $app['pdo']->prepare('SELECT user_id,q1,q2,q3,q4,q5,q6,q7,q8,q9 FROM users');
	$stmt->execute();
	$users = $stmt->fetchALL(PDO::FETCH_ASSOC);

	$resp = array();

	// get the offset for each question per user and save as array in user, also save avg
	$usrRespArray = array();
	foreach($users as $key =>$val){

		foreach ($questions as $questionKey => $questionVal){
			if($users[$key][$questionKey] != NULL){
				$users[$key]['offsets'][] = (abs($users[$key][$questionKey]-$questions[$questionKey]['answer']))/$questions[$questionKey]['scale'];
			}
		}

		$userFinalScore = array_sum($users[$key]['offsets']) / count($users[$key]['offsets']);
		$users[$key]['avgOffset'] = $userFinalScore;

		if($users[$key]['user_id'] == $id){
			$thisUserScore = $userFinalScore;
		}
	}

	$worseAnswers = 0;
	foreach($users as $user){
		if($user['user_id'] != $id){
			if($user['avgOffset'] > $thisUserScore){
				$worseAnswers++;
			}


		}
	}

	$score = round($worseAnswers/(count($users)-1) * 100); 

	/*
	echo '>>'.$thisUserScore.'<br /><br /><br />';
	echo 'worse answers '.$worseAnswers;
	echo '   total users '.count($users);
	echo 'score '.$score;
	echo '<br /><br /><br />';
	var_dump($users);*/

	$resp = array('result'=>'success', 'message' => $score); 
	echo json_encode($resp); // response to user
}



?>