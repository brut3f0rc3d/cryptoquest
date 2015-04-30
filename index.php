<?php 

	session_start();
	require_once('header.php'); 
?>
<div style="float:left; width:45%">
<h2>Registration</h2>
	<form role="form">
		<div class="form-group">
			<input type="text" placeholder="Your username, please" class="form-control" id="reg_name">
		</div>
		<div class="form-group">
			<input type="password" placeholder="Choose a secure password" class="form-control" id="reg_password">
		</div>
		<div class="form-group">
			<input type="text" placeholder="Your mobile number, please." class="form-control" id="reg_mobile">
		</div>
		<div class="form-group">
			<input type="text" placeholder="And your email id." class="form-control" id="reg_email">
		</div>
		<div class="form-group">
			<input type="text" placeholder="Your college please." class="form-control" id="reg_college">
		</div>
		<button id="register">Register</button>
	</form>
</div>
<div style="float:right; width:40%">
	<h2>Login</h2>
	<form role="form">
		<div class="form-group">
			<input type="text" placeholder="Your username" class="form-control" id="login_name">
		</div>
		<div class="form-group">
			<input type="password" placeholder="Password" class="form-control" id="login_password">
		</div>
		<button id="login">Log In</button>
	</form>
</div>
<div style="clear:both"></div>
<div id="response"></div>
<script>
	function register(){
		var name = $("#reg_name").val();
		var email = $("#reg_email").val();
		var password = $("#reg_password").val();
		var college = $("#reg_college").val();
		var mobile = $("#reg_mobile").val();

		console.log(name,email,password,college,mobile);

		$.ajax({
			url:"authenticate.php",
			method:"POST",
			data:{name: name, email: email, password: password, college: college, mobile: mobile, index: 0},
			dataType:"json",
			success:function(reply){
			if(reply['statusCode']==1)
				$("#response").html("You have successfully registered. Login to proceed.");
			},
			error:function(xhr, desc, err) {
            console.log(xhr);
            console.log("Desc :: "+desc+"\nError :: "+err);
            }
		});
	}

	function login(){
		var name = $("#login_name").val();
		var password = $("#login_password").val();

		console.log(name, password);

		$.ajax({
			url:"authenticate.php",
			method:"POST",
			data:{name: name, password: password, index: 1},
			dataType:"json",
			success:function(reply){
				console.log(reply);
				$("#response").html(reply['set']);
				if(reply['statusCode']==1)
					window.location.href="portal.php";
			},
			error:function(xhr, desc, err) {
            console.log(xhr);
            console.log("Desc :: "+desc+"\nError :: "+err);
            }
		});

	}
	$("#register").click(function(e){
		e.preventDefault();
		register();
	});

	$("#login").click(function(e){
		e.preventDefault();
		login();
	});
</script>