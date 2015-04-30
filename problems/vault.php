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



Private Files

You have been contacted by a powerful official. And the name is not to be disclosed for obvious reasons. He wants you to recover some important documents from a secret vault.
After you start digging for futher info, you discover that the vault is owned by none other than The BlackMailer. Thanks to your cyber friends, you have discovered an online portal that allows direct access to the vault. 
However it requires a key. You manage to find a code snippet similar to the one that used for the vault. Recover the password and get the files.
