<?php

	$key = "ipyqwjiymliyaj"; 

	function decrypt($cipher){
		for($i=0; $i<strlen($cipher); $i++){
			// Get ascii value of current char
			$ascii = ord($cipher[$i]);
			
			// decryption
			if($ascii-$i<97)
				$new_ascii=$ascii-$i+26;
			else
				$new_ascii=$ascii-$i;
			echo chr($new_ascii);
		}
			
	}


	$responses[0]="Now if I allowed that, it would be child's play.";
	$responses[1]="You didn't think it would be so easy, did you?";
	$responses[2]="Seriously? I would rather give out the answer.";
	$responses[3]="And that's your famous intellect?";
	$responses[4]="You're boring.Very.";
	$responses[5]="And you call yourself brilliant?";
	if(isset($_POST['cipher']) && !empty($_POST['cipher']) && ctype_alpha($_POST['cipher'])){
		$cipher = strtolower($_POST['cipher']);
		if($cipher == $key || strlen($cipher)>4){
			$index = rand(0,5);
			echo $responses[$index];
		}
		else{
			decrypt($cipher);
		}
	}


?>
<h2>
<form method="POST">
	<input type="text" placeholder="Enter text to decrypt" name="cipher">
	<button type="submit">Decrypt</button>
</form>