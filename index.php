<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Case</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <style>
  .jumbotron{
	  height:500px;
  }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="feed.php">Feed</a></li>
        <li><a href="statistics.php">statistics</a></li>
		<li><a href="graph.php">Graph</a></li>
		<li><a href="edit.php">Edit</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
  <div class="container">
  <div class="jumbotron">
  <?php
  $host="localhost";
$user="root";
$password="";
$db="fwm";
$dbcon=@mysqli_connect($host,$user, $password, $db);
  if($_SESSION['email']==NULL){header('Location:login.php');}
  else{
	  $email=$_SESSION['email'];
	$sql="SELECT * FROM `schools` WHERE email='$email'";
	$res=mysqli_query($dbcon,$sql);
	$a=mysqli_fetch_array($res);
	echo $a['schoolname'];
	$img=$a['logo'];
	echo "<img src='$img' width='100px' alt='fault'>";
  }
  ?>
  </div>
  </div>
</nav>

</body>
</html>
