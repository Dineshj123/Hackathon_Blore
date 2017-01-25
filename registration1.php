<?php
session_start();
$host="localhost";
$user="root";
$password="";
$db="fwm";
$dbcon=@mysqli_connect($host,$user, $password, $db);
if(isset($_POST['submit'])){
    $count=0;
    $name=$_POST['school_name'];
    $add=$_POST['address'];
    $email=$_POST['school_email'];
    $pwd1=$_POST['Password1'];
    $pwd2=$_POST['Password2'];
    $pwd=md5(sha1($pwd1));
       // $string=@$_POST['passfield']; 
       // $strings=$_SESSION["strings"];
       //   if($string!=$strings){
       //     $count+=1;
       //     echo 'Please enter correct captcha!';
       // }
       if($pwd1!=$pwd2){$count+=1;echo "<b style='color:red'>Password mismatch!</b>";}
       $sql="select * from `schools` where email='$email'";
       if(@mysqli_num_rows(@mysqli_query($dbcon,$sql))){
        $count+=1;
        echo 'Email Id Already taken';
       }
       $target_dir = "uploads/ ";
       if($_FILES["fileToUpload"]["size"]!=0){
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
else{$uploadOk=1;}
if($uploadOk==1&&$count==0){
    $images=$target_file;
    $sql = "INSERT INTO `schools` (`id`,`schoolname`,`email`,`password`,`logo`,`Address`) VALUES ('NULL', '$name', '$email', '$pwd', '$images','$add')";
    $res=@mysqli_query($dbcon, $sql);
	if(!$res){
        echo "ERROR INSERTING INTO DATABASE";
        }
		else{header('Location:login.php');}
    }   
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap Registration Form Template</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
<script>
    function validateForm(){
        var count=0;
        var a=document.forms["form"]["school_name"].value;
        if(a==null||a==''){
            count++;
            alert('Please enter your school name');
        }
        var b=document.forms["form"]["school_email"].value;
        if(a==null||a==''){
            count++;
            alert('Please enter your school email id');
        }
        var c=document.forms["form"]["pwd"].value;
        if(a==null||a==''){
            count++;
            alert('Please enter your password');
        }
        var d=document.forms["form"]["captcha"].value;
        if(a==null||a==''){
            count++;
            alert('Please enter the captcha');
        }
        if(count>0) {return false;}
    }
    </script>
    
    </head>

    <body>

		<!-- Top menu -->
		<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html">Food Wastage Control Initiative</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="top-navbar-1">
					<ul class="nav navbar-nav navbar-right">
						<li>
							<span class="li-text">
								Follow 
							</span> 
							<a href="http://www.digitalindia.gov.in/"><strong>DigitalIndia</strong></a> 
							<span class="li-text">
								Campaign 
							</span> 
							<span class="li-social">
								<a href="https://www.facebook.com/OfficialDigitalIndia"><i class="fa fa-facebook"></i></a> 
								<a href="https://twitter.com/_digitalindia?lang=en"><i class="fa fa-twitter"></i></a> 
								<a href="#"><i class="fa fa-envelope"></i></a> 
								<a href="#"><i class="fa fa-skype"></i></a>
							</span>
						</li>
					</ul>
				</div>
			</div>
		</nav>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Food Wastage Control</strong> Initiative</h1>
                            <div class="description">
                            	<p>
                             Use this website to Avoid Food Wastage in your school..Be a part of FOOD FOR ALL campaign...!
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-sm-6 book">
                    		<img src="assets/img/ebook2.png" height="380px">
                    	</div>
                        <div class="col-sm-5 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Food for All Campaign!!</h3>
                            		<p>Fill in the form below to get instant access:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-pencil"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="registration1.php"  method="post" class="registration-form" onsubmit="return validateForm()" enctype="multipart/form-data">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-first-name">School name</label>
			                        	<input type="text" name="school_name" placeholder="School Name..." class="form-first-name form-control" id="form-first-name">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-last-name">School Address</label>
			                        	<input type="text" name="address" placeholder="Address..." class="form-last-name form-control" id="form-last-name">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-email">School email_id</label>
			                        	<input type="text" name="school_email" placeholder="Email id(school)..." class="form-email form-control" id="form-email">
			                        </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-email">Password</label>
                                        <input type="password"  name="Password1" placeholder="Password..." class="form-email form-control" id="form-email">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-email">Confirm Password</label>
                                        <input type="password" name="Password2" placeholder="Confirm Password..." class="form-email form-control" id="form-email">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-email">School LOGO</label>
                                        <input type="file" name="fileToUpload" placeholder="School Logo..." class="form-email form-control" id="form-email">
                                    </div>
			                        <button type="submit" name="submit" class="btn">Register my School!</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
                </div>
                                    <div id="result">hi</div>

            </div>
            

        </div>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>