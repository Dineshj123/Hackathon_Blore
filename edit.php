<?php
session_start();
if(isset($_POST['submit'])){
	$num=$_POST['number'];
	$add=$_POST['address'];
	if($num){
		$sql="UPDATE `schooldetails` SET `noofstudents` ='$num'";
		$res=mysqli_query($dbcon,$sql);
		if(!$res){echo 'Error in updating noofstudents';}
	}
	if($add){
		$sql="UPDATE `schools` SET `address` ='$add'";
		$res=mysqli_query($dbcon,$sql);
		if(!$res){echo 'Error in updating address';}
	}
}

?>
<html>
<head>
<script>
function func(val){
	if(val=="number"){
	if(document.getElementById("number").type=="hidden"){
		document.getElementById("address").type="hidden";
		document.getElementById("number").type="text;"
	}
	else{
		document.getElementById("number").type="hidden";
	}
	}
	else{
	if(document.getElementById("address").type=="hidden"){
		document.getElementById("address").type="text;"
		document.getElementById("number").type="hidden";
	}
	else{
		document.getElementById("address").type="hidden";
	}
	}
}
</script>
</head>
<body>
<form id="form" name="form" name="form" method="post" action="edit.php">
<select id="edit_select" onchange="func(this.value)">
<option value="">---</option>
<option value="number">NumberOfStudents</option>
<option value="address">Address</option>
</select><br><br>
<input type="hidden" id="number" name="number" placeholder="Edit NumberOfStudents" />
<br><br>
<input type="hidden" id="address" name="address" placeholder="Edit Address" />
<input type="submit" id="submit" name="submit" value="Submit" />
</form>
</body>
</html>