<?php 

include_once('Database.php');

class Questions{
	public static function getById($id, $userid){

		$results = Database::query("SELECT `question_id`, `question_name`, `question_desc`, `question_file`, `points` FROM `questions` WHERE `question_id` = ?", $id);
		$flag = Database::query("SELECT `question_flag` FROM `questions` WHERE `question_id` = ?", $id);
		$correct_flag = $flag[0]['question_flag'];
		$solved = Database::query("SELECT `answer_id` FROM `answers` WHERE `question_id`=? AND `user_id`=? AND `answer`= ?", $id, $userid, $correct_flag);

		if(count($solved)){
			$results[0]['solved']=1;
		}
		else
			$results[0]['solved']=0;
		if(count($results)){
			return $results[0];
		}
	}

	// Get all inserted questions
	public static function getAll(){
		$result = Database::query("SELECT * FROM `questions`");
		echo json_encode($result);
	}

	// Get all question names with respective points
	public static function getStack(){
		$result = Database::query("SELECT `question_id`,`question_name`,`points` FROM `questions` WHERE 1=?",1);
		return ($result);
	}


	public static function checkAnswer($userid, $questionid, $flag){
		date_default_timezone_set('Asia/Calcutta');
		$data = array('user_id'=>$userid, 'question_id'=>$questionid, 'answer'=>$flag, 'timestamp'=>date("Y-m-d H:i:s"));
		$inserted = Database::insert('answers', $data);
		$result=Database::query("SELECT `question_flag` FROM `questions` WHERE `question_id`=?", $questionid);
		return $result;
	}
}