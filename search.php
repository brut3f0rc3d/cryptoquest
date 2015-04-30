<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-16" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<!--I had heard Moriarty has a twin brother. Does he?-->
		<div id="logo" style="text-align:center">
			<img src="public/images/toosimple.png" height="150px" width="500px">
		</div>
		<div id="search" style="text-align:center">
		<form method="GET">
			<div class="form-group">
				<input type="text" class="form-control" id="exampleInputEmail1" name="q" placeholder="Please enter your search query">
			</div>
		</form>
		</div>
		<?php if($_GET['q'] === 'flаg'): ?>
		<div class="well">
		<?php echo "You cracked it boy"; ?>
		</div>
	
	<?php else: ?>
		<?php if(isset($_GET['q'])): ?>
			<div class="well">
			<?php echo "Did you mean to search : I don't know how to search." ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	</div>
</body>
</html>