<?php
	require_once('Database.php');

	//Exceptions
    class UserNotLoggedInException extends Exception{
    }
    class UserNotFoundException extends Exception{
    }


	class User{

		public static $data;

		   public function __construct(){
            //print_r(func_get_args());
            //If args are absent
            if(count(func_get_args())==0)
            {
               
                if(isset($_SESSION['data']))
                    $this->data = $_SESSION['data'];
                else
                    throw new UserNotLoggedInException;
                return;
            }
            //If args are present
            $key=func_get_arg(0);
            $value=func_get_arg(1);
            //Get the results array. Result is an associative array.
            $result= Database::query("SELECT * FROM `users` where $key = ?", $value);
            //Check if any record exists.
            if(count($result)==0)
            {
                throw new UserNotFoundException;
                return null;
            }
            else
                $this->data=$result[0];
        }

          public static function user_exists($key, $value){
            $result = Database::query("SELECT * FROM 'users' WHERE '$key'=?",$value);
            if(count($result)==0)
                throw new UserNotFoundException;
            else
                return true;
        }

		public static function login($email, $password){
			if(isset($email) && isset($password))
			{
				$results=Database::query("SELECT * FROM `users` WHERE `user_name`=? and `user_password`=?",$email, $password);
				if(count($results))
				{
					$_SESSION['data']=$results[0];
					return $results[0];
				}
				else{
					return false;
				}

			}
			else{
				return false;
			}
		}

		public static function is_logged(){
			return isset($_SESSION['data']);
		}

		public static function calculateScore($userid){
			$score=0;
			$questions = Database::query("SELECT `question_id`, `question_flag`,`points` FROM `questions`");
			foreach ($questions as $question){
				$result=Database::query("SELECT * FROM `answers` WHERE `user_id`=? AND `question_id`=? AND `answer`=?", $userid, $question['question_id'], $question['question_flag']);
				if(count($result))
					$score+=$question['points'];
			}
			return $score;
		}
		public static function getScores(){
			$users = Database::query("SELECT `user_id`,`user_name` FROM `users`");
			$scoreboard=array();
			foreach($users as $user){
				$score = User::calculateScore($user['user_id']);
				$scoreboard[$user['user_id']]['name']=$user['user_name'];
				$scoreboard[$user['user_id']]['score']=$score;
			}
			return ($scoreboard);
		}
		
	}

?>