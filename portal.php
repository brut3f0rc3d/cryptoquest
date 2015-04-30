<?php
	session_start();
	if(!isset($_SESSION['data']))
		header('Location: index.php');
	else{
		$username=$_SESSION['data']['user_name'];
		$userid=$_SESSION['data']['user_id'];
	}
	include_once('header.php');
	include_once('models/Questions.php');
	$stack = Questions::getStack();
	
?>
<?php echo '<input id="user_id" hidden value="'.$userid.'">'; ?>
<div id="problem-stack" style="float:left">
	<ul class="nav nav-pills nav-stacked">
	<?php
		foreach ($stack as $item){
			echo "<li role='presentation'  class='question-pill' data-id='".$item['question_id']."'><a href='#'>".$item['question_name']."</a></li>";
		}
	?>
	</ul>
</div>
<div id="problem-definition" style="float:right">
	<input type="hidden" id="problem-id">
	<div id="problem-head">
		<div id="problem-name" style="float:left"></div>
		<div id="problem-points" style="float:right"></div>
		<div style="clear:both"></div>
	</div>
	<div id="problem-desc"><div style="text-align:center"><h2>Welcome</h2><h3>to</h3><h1>Cryptoquest</h1><br><br><p>Click on any question to begin</p></div></div>
	<div id="problem-file"></div>
	<div id="problem-flag" hidden>
		<input type="text" placeholder="Enter the flag" class="form-control" id="user_flag">
		<br>
		<button class="btn btn-primary" id="submit">Submit</button>
	</div>
	<div class="alert" role="alert" id="response" style="margin-top:10px"></div>
</div>
<div style="clear:both"></div>

<script>

	$(".question-pill").click(function(e){
		e.preventDefault();
		$("#problem-file").html("");
		$("#problem-name").html("");
		$("#problem-points").html("");
		$("#problem-desc").html("");
		$("#problem-stack li").removeClass('active');
		$("#problem-flag").removeAttr('hidden');
		$("#user_flag").val('');
		$("#response").attr('hidden','hidden');
		$(this).addClass('active');
		var userid = $("#user_id").val();
		var id = $(this).data('id');
		console.log($(this).data('id'));

		$.ajax({
			url:'get.php',
			method:'POST',
			data:{id: id, userid: userid},
			dataType:'json',
			success:function(reply){
				console.log(reply);
				if(reply['solved']==1){
					$("#user_flag").attr('placeholder',"You've already solved this question");
					$("#user_flag").attr('disabled','disabled');
					$("#submit").attr('disabled','disabled');
				}
				else{
					$("#user_flag").attr('placeholder',"Enter the flag");
					$("#user_flag").removeAttr('disabled');
					$("#submit").removeAttr('disabled');
				}

				$("#problem-head").addClass('well');
				$("#problem-name").html(reply['question_name']);
				$("#problem-points").html(reply['points']);
				$("#problem-desc").html(reply['question_desc']);
				$("#problem-id").val(id);
				//$("#problem-file").html(reply['question_file']);
				if(reply['question_file']==null || reply['question_file']=="")
					console.log('No Attachments');
				else{
					$("#problem-file").html("<i class='fa fa-paperclip'></i><a href=public/"+reply['question_file']+"> Attachments </a>");
				}
			},
			error:function(xhr, desc, err) {
            console.log(xhr);
            console.log("Desc :: "+desc+"\nError :: "+err);
            }
		});
	});

	$("#submit").click(function(e){
		e.preventDefault();
		var id = $("#problem-id").val();
		var flag = $("#user_flag").val();
		var user_id = $("#user_id").val();
		$("#user_flag").val('');
		$.ajax({
			url:'check.php',
			method:'POST',
			data:{userid: user_id, id: id, flag: flag},
			dataType:'json',
			success:function(reply){
				$("#response").removeAttr('hidden');
				if(reply['statusCode']==1){
					$("#response").removeClass('alert-danger');
					$("#response").addClass('alert-success');
					$("#response").html("Great work! You cracked the question");
					$("#user_flag").attr('placeholder',"You've already solved this question");
					$("#user_flag").attr('disabled','disabled');
					$("#submit").attr('disabled','disabled');
				}
				else if(reply['statusCode']==0){
					$("#response").removeClass('alert-success');
					$("#response").addClass('alert-danger');
					$("#response").html("No that's not the flag. Try again!");
				}
				else{
					$("#response").removeClass('alert-success');
					$("#response").addClass('alert-danger');
					$("#response").html("There was some error submitting the flag.");
				}
			},
			error:function(xhr, desc, err){
				console.log(xhr);
				console.log("Desc :: "+desc+"\nError :: "+err);
			}
		});
	});

	
</script>

