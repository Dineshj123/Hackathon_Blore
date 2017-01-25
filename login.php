<?php
session_start();
$host="localhost";
$user="root";
$password="";
$db="fwm";
$dbcon=@mysqli_connect($host,$user, $password, $db);
if(isset($_POST['submit'])){
	$email=$_POST['email'];
	$pwd=$_POST['pwd'];
	$pwds=md5(sha1($pwd));
	$sql=" SELECT * FROM `schools` WHERE email='$email' && password='$pwds'  ";
	$res=mysqli_query($dbcon,$sql);
	$user=@mysqli_fetch_array($res);
	if($user!=0){
		$_SESSION['email']=$email;
		header('Location:index.php');
	}
	else{
		echo "Wrong Credentials";
	}
}

?>
<html>
<head>
</head>
<body>
<form id="form" name="form" method="post" action="login.php">
Email : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="email" name="email" id="email" /><br><br>
Password : &nbsp;&nbsp;&nbsp;&nbsp;<input type="password" id="pwd" name="pwd" /><br><br>
<input type="submit" id='submit' name="submit" value="LOG IN" />
</form>
</body>
</html>