<?php
session_start();
if(isset($_POST['submit'])){
	$email=$_POST['email'];
	$pwd=$_POST['pwd'];
	$sql=" SELECT * FROM `users` WHERE usersname='$uname' && password='$pwds'  ";
	$res=mysqli_query($dbcon,$sql);
	$user=mysqli_fetch_array($res);
	if($user!=0){
		header('Location : index.php');
	}
	else{
		echo 'Wrong Credentials';
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