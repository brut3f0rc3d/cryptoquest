<!DOCTYPE html>
<html>
<head>
<!--
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
-->
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom.css">
<!--
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
-->
<!--
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
-->
	<script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

	<title>Crypto Quest</title>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">CryptoQuest</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <?php if(isset($_SESSION['data'])): ?>
      <p class="navbar-text user-name"><?php echo "Logged in as, ".$username; ?></p>
    <?php endif; ?>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="scoreboard.php">Scoreboard</a></li>
      <?php if(isset($_SESSION['data'])): ?>
        <li><a href="portal.php">Problem Portal</a></li>
        <li><a href="rules.php">Rules</a></li>
        <li><a href="#" id="logout">Logout</a></li>
      <?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<script>
  $("#logout").click(function(e){
    e.preventDefault();
    $.ajax({
      url:'authenticate.php',
      method:'POST',
      data:{index:2},
      success:function(reply){
        if(reply['statusCode']==1)
          window.location.href="index.php";
        else
          window.location.href="portal.php";
      },
      error:function(xhr, desc, err){
        console.log(xhr);
        console.log("Desc :: "+desc+"\nError :: "+err);
      }
    });
  });

</script>
<div class="container">
