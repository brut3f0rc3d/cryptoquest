<?php
	session_start();
	if(!isset($_SESSION['data']))
		header('Location: index.php');
	else{
		$username=$_SESSION['data']['user_name'];
	}
	include_once('header.php');
?>