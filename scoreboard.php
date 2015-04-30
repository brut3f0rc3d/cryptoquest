<?php
	session_start();
	if(!isset($_SESSION['data']))
		header('Location: index.php');
	else{
		$username=$_SESSION['data']['user_name'];
	}
	include_once('header.php');
	include_once('models/User.php');

	$scoreboard = User::getScores();
	foreach($scoreboard as $key=>$row){
				 		$score[$key]=$row['score'];
	}
	
	array_multisort($score, SORT_DESC, $scoreboard);
	if(isset($scoreboard)){
		$count=1;
		echo "<table class='table table-striped'><thead><tr><th>#</th><th>Team Name</th><th>Score</th></tr></thead><tbody>";
		foreach($scoreboard as $score){

			echo "<tr><td>".$count."</td><td>".$score['name']."</td><td>".$score['score']."</td></tr>";
			$count++;
		}
		echo "</tbody></table>";
	}
	
?>
