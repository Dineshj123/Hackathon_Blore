<?php
session_start();
if(isset($_POST['submit'])){
	$name=$_POST['school_name'];
	$add=$_POST['address'];
	$email=$_POST['school_email'];
	$pwd=$_POST['pwd'];
	   $string=@$_POST['passfield']; 
	   $strings=$_SESSION["strings"];
		 if($string!=$strings){
		   die("captcha wrong!!!!");
	   }
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
if($uploadOk==1){
	$images=$target_file;
	$sql = "INSERT INTO `school` (`id`,`schoolname`,`email`,`password`,`logo`,`Address`) VALUES ('NULL', '$name', '$email', '$pwd', '$images','$add')";
	if(!mysqli_query($dbcon, $sql)){
		echo "ERROR INSERTING INTO DATABASE";
		}
	}	
}
?>
<html>
	<head>
	<script>
	function validateForm(){
		var count=0;
		var a=document.forms["form"]["school_name"].value;
		if(a==null||a==''){
			count++;
			alert('Please enter your school name');
		}
		var a=document.forms["form"]["school_email"].value;
		if(a==null||a==''){
			count++;
			alert('Please enter your school email id');
		}
		var a=document.forms["form"]["pwd"].value;
		if(a==null||a==''){
			count++;
			alert('Please enter your password');
		}
		var a=document.forms["form"]["captcha"].value;
		if(a==null||a==''){
			count++;
			alert('Please enter the captcha');
		}
		if(count>0) {return false;}
	}
	</script>
	<style>
	#form_id{
		width:450px;
		height:450px;
		background-color:gray;
	}
	</style>
	</head>
	<body>
	<div id="form_id">
	<form id="form" name="form" method="post" action="registration.php" onsubmit="return validateForm()" enctype="multipart/form-data" >
	<br>
	School Name :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" id="school_name" name="school_name" /><br><br>
	School Address : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="address" name="address" /><br><br>
	School Email_Id :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;<input type="email" id="school_email" name="school_email" /><br><br>
	Password :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" id="pwd" name="pwd" /><br><br>
	Picture To be Selected:<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="fileToUpload" id="fileToUpload" />
	<br><br>CAPTCHA:
	&nbsp;&nbsp;&nbsp;&nbsp;<img src="test.php" name="captcha" id="captcha" /><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="passfield" value=""  />
	<br><input type="submit" id="submit" name="submit" value="Register" />
	</form>
	</div>
	</body>
</html>