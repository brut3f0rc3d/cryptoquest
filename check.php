<?php
	session_start();
    include_once('models/Database.php');
    include_once('models/Questions.php');
	$errors=array();

	if(isset($_POST['id']) && isset($_POST['flag']) && isset($_POST['userid'])){
		$result = Questions::checkAnswer($_POST['userid'], $_POST['id'], $_POST['flag']);
		if($result[0]['question_flag']==$_POST['flag'])
			$errors['statusCode']=1;
		else
			$errors['statusCode']=0;
	}
	else{
		$errors['statusCode']=2;
		$errors['status'] = "Please enter a flag";
	}

	echo json_encode($errors);

?>