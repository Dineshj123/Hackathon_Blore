<?php
session_start();
$host="localhost";
$user="root";
$password="";
$db="fwm";
$dbcon=@mysqli_connect($host,$user, $password, $db);
if(isset($_POST['submit'])){
	$email=$_SESSION['email'];
	$numberofstudents=$_POST['number'];
	$grainrec=$_POST['grainrec'];
	$graincon=$_POST['graincon'];
	$wheatrec=$_POST['wheatrec'];
	$wheatcon=$_POST['wheatcon'];
	$ricerec=$_POST['ricerec'];
	$ricecon=$_POST['ricecon'];
	$vegrec=$_POST['vegrec'];
	$vegcon=$_POST['vegcon'];
	if($grainrec>=$graincon&&$wheatrec>=$wheatcon&&$ricerec>=$ricecon&&$vegrec>=$vegcon){
		
	if($numberofstudents){
		$sql="SELECT * from `schooldetails` where email='$email'";
		$res=mysqli_query($dbcon,$sql);
		if(!@mysqli_num_rows($res)){
		$sql="INSERT INTO schooldetails (`id`,`email`,`noofstudents`) VALUES('NULL','$email','$numberofstudents')";
		$sqli=mysqli_query($dbcon,$sql);
	}
	else{echo "You have already registered";}
	}
	else{echo 'Please enter number of students';}
	if($grainrec&&$graincon&&$wheatrec&&$wheatcon&&$ricerec&&$ricecon&&$vegrec&&$vegcon){
		$date=date('d/m/Y', strtotime("now"));
		$sql="SELECT * from `schooldetails` where email='$email' && date!='$date'";
		$res=mysqli_query($dbcon,$sql);
		if(@mysqli_num_rows($res)){
		$sql="INSERT INtO datafeed (`id`,`email`,`grainrec`,`graincon`,`wheatrec`,`wheatcon`,`ricerec`,`ricecon`,`vegrec`,`vegcon`,`date`) 
		VALUES ('NULL','$email','$grainrec','$graincon','$wheatrec','$wheatcon','$ricerec','$ricecon','$vegrec','$vegcon','$date')";
		$sqli=mysqli_query($dbcon,$sql);
		if(!$sqli){echo "Error in updating feeddata table";}
	}
	else{echo "You have already registered";}
	}
	else{echo 'Please enter all items quantities';}
	
}
}
else{
	echo 'Pleasse enter the details correctly';
}
?>
<html>
<head>
</head>
<body>
<form id="form" name="form" method="post" action="feed.php">
Number Of Students <input type="text" id="number" name="number" />
<br><br>Grains :<tr>
<td>Received&nbsp;&nbsp;&nbsp;<input type="text" id="grainrec" name="grainrec" />Kgs</td>
<td>consumed&nbsp;&nbsp;&nbsp;<input type="text" id="graincon" name="graincon" />Kgs</td>
</tr>
<br><br>Wheat:<tr>
<td>Received&nbsp;&nbsp;&nbsp;<input type="text" id="wheatrec" name="wheatrec" />Kgs</td>
<td>consumed&nbsp;&nbsp;&nbsp;<input type="text" id="wheatcon" name="wheatcon" />Kgs</td>
</tr>
<br><br>Rice:<tr>
<td>Received&nbsp;&nbsp;&nbsp;<input type="text" id="ricerec" name="ricerec" />Kgs</td>
<td>consumed&nbsp;&nbsp;&nbsp;<input type="text" id="ricecon" name="ricecon" />Kgs</td>
</tr>
<br><br>Vegetables:
<tr>
<td>Received&nbsp;&nbsp;&nbsp;<input type="text" id="vegrec" name="vegrec" />Kgs</td>
<td>consumed&nbsp;&nbsp;&nbsp;<input type="text" id="vegcon" name="vegcon" />Kgs</td>
</tr>
<input type="submit" id="submit" name="submit" value="Submit" />
</form>
</body>
</html>