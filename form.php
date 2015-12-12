<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname="mydatabase";
$dbcon = @mysqli_connect($servername, $username, $password, $dbname);

if (!$dbcon) {
    die("Connection failed: " . mysqli_connect_error());
} 
global $rollno;
   if(isset($_POST['submitted'])){
	   $string=@$_POST['passfield']; 
	   $strings=$_SESSION["strings"];
		 if($string!=$strings){
		   die("captcha wrong!!!!");
	   }
   }
    if(isset($_POST["submitted"])) {
	$target_dir = "C:/wamp/www/Hackathon/uploads/ ";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
		echo $_FILES["fileToUpload"]["name"];
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
if ($_FILES["fileToUpload"]["size"] > 500000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
	}
    if(isset($_POST['submitted'])){
   $rollno=@$_POST['rollno'];
	$name = mysqli_real_escape_string($dbcon, $_POST['name']);
	$department=@$_POST['dept'];
	$yearofstudy=@$_POST['yearofstudy'];
	$email=@$_POST['email'];
	$pwd=md5(@$_POST['pwd']);
	$pwd=sha1($pwd);
	$url="c:wamp/www/$rollno.jpg";
	rename("$target_file","$target_dir $rollno.$imageFileType");
	$target_file=$target_dir ."$rollno.$imageFileType";
	$images=$target_file;
	$id=rg();
	$stradd=0;
	if(strlen($id)==8){
		$id=$stradd.$id;
	}
	if($uploadOk==1){
	$sql = "INSERT INTO `test` (`ROLLNO`, `Name`, `Department`, `YearOfStudy`, `email`,`password`, `profilepicture`, `ID`) VALUES ('$rollno', '$name', '$department', '$yearofstudy', '$email','$pwd','$images','$id')";
	if(!mysqli_query($dbcon, $sql)){
		echo "ERROR";
		}
	}
	}
function rg(){
$number='0123456789';
	srand((double)microtime()*1000000);
	$str="";
	$i=0;
while($i<9){
	$num=rand(0,9)%33;
	$tmp=substr($number,$num,1);
	$str=$str.$tmp;
	$i++;
}
$temp1=$str;
$tmp=$str%10;
$temp1/=10;
$temp=$temp1%10;
$sum=$temp;
if($temp*2>9){
	$t=$temp*2;
	$sum=0;
	  while ($t != 0)
   {
      $remainder = $t % 10;
      $sum  = $sum + $remainder;
      $t = $t / 10;
   }
   }
     $str=substr($str,0,7).$sum;
   $sum=$tmp;
   if($tmp*2>9){
	$t=$tmp*2;
	$sum=0;
	  while ($t != 0)
   {
      $remainder = $t % 10;
      $sum  = $sum + $remainder;
      $t = $t / 10;
   }
   }
   $str=substr($str,0,8).$sum;
   $t=$str;
	$sum=0;
	  while ($t != 0)
   {
      $remainder = $t % 10;
      $sum  = $sum + $remainder;
      $t = $t / 10;
   }
          if($sum%10!==0){$sum=rg();}
  else{  
  return $str;}
  return $sum;
}



?>
<html>
<head>
<style>
.captcha{
	width:120px;
	height:30px;
	background-color:red;
    transform: rotate(0.01turn);
}
</style>
<script>
var count=0;
function validateForm(){
	var x=document.forms["form"]["rollno"].value;
	if(x==null||x==''){
		count++;
		alert('please provide your roll number!');
	}
	var y=document.forms["form"]["name"].value;
	if(y==null||y==''){
		count++;
		alert('please provide your name!');
	}
	var z=document.forms["form"]["yearofstudy"].value;
	if(z==null||z==''){
		count++;
		alert('please provide your tenure in nitt!');
	}
	var a=document.forms["form"]["dept"].value;
	if(a==null||a==''){
		count++;
		alert('please fill the department from which you are!');
	}
	var b=document.forms["form"]["email"].value;
	if(b==null||b==''){
		count++;
		alert('please provide a valid email address!');
	}
	var c=document.forms["form"]["pwd"].value;
	if(c==null||c==''){
		count++;
		alert('please provide your password!');
	}
	var d=document.forms["form"]["passfield"].value;
	if(d==null||d==''){
		count++;
		alert('please enter the captcha in the box!');
	}
		var e=document.forms["form"]["fileToUpload"].value;
	if(e==null||e==''){
		count++;
		alert('please provide image to set your profile picture!');
	}
	if(count>0){return false;}
}
function myfunc(){
if(document.getElementById("pwd").type=="password"){
document.getElementById("pwd").type="text";
}
else{
document.getElementById("pwd").type="password";
}
}
</script>
<style>
#form{
	background-color:gray;
	border-bottom-left-radius: 2em;
	border-top-left-radius: 2em;
	border-top-right-radius: 2em;
	border-bottom-right-radius: 2em;
	width:350px;
	height:500px;
    margin:120 400px;
	}
	#id{
		text-align:center;
		color:red;
		position:absolute;
		margin:30 90px;
	}
	#submitted{
		margin:20 140px;
	}
</style>
</head>
<body>
<form name="form" id="form" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
<div id="id">STUDENT INFORMATION</div>
<br><br><br><br>
&nbsp;&nbsp;&nbsp;ROLL.NO:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="rollno"  /><br><br>
&nbsp;&nbsp;&nbsp;Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="name"  /><br><br>
&nbsp;&nbsp;&nbsp;Department:&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="dept" /><br><br>
&nbsp;&nbsp;&nbsp;Year Of Study: <input type="text" name="yearofstudy"  /><br><br>
&nbsp;&nbsp;&nbsp;Email-ID:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="email" name="email"  /><br><br>
&nbsp;&nbsp;&nbsp;Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="password" id="pwd" name="pwd"  /><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name check value="checkbox" onclick="myfunc()" >show characters <br>
&nbsp;&nbsp;&nbsp;Picture To be Selected:<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="fileToUpload" id="fileToUpload" />
<br><br>&nbsp;&nbsp;&nbsp;CAPTCHA:
&nbsp;&nbsp;&nbsp;&nbsp;<img src="test.php" name="captcha" id="captcha" /><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="passfield" value=""  />
<br><input type="submit" name="submitted" id="submitted"  value="submit" />
</form>
</body>
</html>
	