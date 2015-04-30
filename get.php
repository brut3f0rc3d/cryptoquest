<?php
	
	include('models/Questions.php');

	if(isset($_POST['id']) && isset($_POST['userid'])){
		$id = $_POST['id'];
		$userid = $_POST['userid'];
		$question = Questions::getById($id, $userid);
		echo json_encode($question);
	}

?>