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
		if(!empty($_POST['source'])){ $clean['source_code'] = filter_var($_POST['source'],FILTER_SANITIZE_STRING); }
		if(!empty($_POST['optin']) && $_POST['optin'] == 'y'){ $clean['opt_in'] = 'y'; }


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
			$resp = array('result'=>'error', 'focus'=>$focus, 'message' => $message); // define a response (this one def an error)
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

		//{step: "question", answer: "-5.6", questionNumber: "0"}
		// validate required fields, save in $clean

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


		$resp = array('result'=>$result, 'message' => $message); 
		echo json_encode($resp); // response to user


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
	$score = round((count($worseAnswers)/(count($answerOffsets)-1) * 100)); 

	/*
	var_dump($responses);
	echo 'this offset '.$thisOffset.'<br /><br />';
	echo 'offsets<br />';
	var_dump($answerOffsets);
	echo '<br /><br />worse answers<br />';
	var_dump($worseAnswers);
	echo '<br /><br />'.count($worseAnswers)/count($answerOffsets);

	

	var_dump($score);

	die();
*/

	$resp = array();
	$resp['userAnswer'] = $answer;
	$resp['questionId'] = $questionNumber;
	$resp['questionAnswer'] = $questionInfo['question_answer'];
	$resp['score'] = $score;
	$resp['userId'] = $userId;


	return $resp;
}






?>