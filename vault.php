<?php
$password='viperidaes';
if(($_POST['password'])==$password){
	echo "Congratulations. The flag is : edge15_n0thing_i$_really_a_$ecret";
}
elseif ($_POST['password']=='' || empty($_POST['password'])) {
	echo '';
}
else{
	echo "So boring. So very boring!";
}
?>
<html>
<head></head>
<body>
<style>
	body{
		margin: 0px;
		padding: 0px 20px;
		text-align: center;
	}
</style>
	<h1>Welcome to the secret vault</h1>
	<form method="POST">
		<input type="password" placeholder="Enter the secret passkey" maxlength="7" required name="password">
		<button value="Submit">Submit</button>
	</form>
</body>
</html>