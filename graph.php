<?php
session_start();
?>
<html>
<head>
<style>
#myCanvas{
	margin-left:100px;
	border-left:1px solid;
	border-bottom:1px solid;
}
#rice{
	margin-left:90px;
}
#myCanvas1{
	margin-left:100px;
	border-left:1px solid;
	border-bottom:1px solid;
}
#wheat{
	margin-left:90px;
}
#myCanvas2{
	margin-left:100px;
	border-left:1px solid;
	border-bottom:1px solid;
}
#veg{
	margin-left:90px;
}
#myCanvas3{
	margin-left:100px;
	border-left:1px solid;
	border-bottom:1px solid;
}
#grain{
	margin-left:90px;
}
</style>
</head>
<body>
<div id="rice">Rice</div>
<canvas id="myCanvas" width="1000" height="100">
Your browser does not support the HTML5 canvas tag.
</canvas>
<div id="wheat">Wheat</div>
<canvas id="myCanvas1" width="1000" height="100">
Your browser does not support the HTML5 canvas tag.
</canvas>
<div id="veg">Vegetables</div>
<canvas id="myCanvas2" width="1000" height="100">
Your browser does not support the HTML5 canvas tag.
</canvas>
<div id="grain">Grain</div>
<canvas id="myCanvas3" width="1000" height="100">
Your browser does not support the HTML5 canvas tag.
</canvas>
<?php
$host="localhost";
$user="root";
$password="";
$db="fwm";
$dbcon=@mysqli_connect($host,$user, $password, $db);
$email=$_SESSION['email'];
$val=0;
for($i=6;$i>=0;$i--){
	if($i==6){$text="mon";}
	if($i==5){$text="tue";}
	if($i==4){$text="wed";}
	if($i==3){$text="thurs";}
	if($i==2){$text="fri";}
	if($i==1){$text="sat";}
	if($i==0){$text="sun";}
	$date=date('d/m/Y',strtotime("-".$i." days"));
	$sql="select * from `datafeed` where date='$date' and email='$email'";
	$res=@mysqli_query($dbcon,$sql);
	$arr=@mysqli_fetch_array($res);
	$ricecon=$arr['ricecon'];
	$ricemax=$_SESSION['ricemax'];
	$wheatcon=$arr['wheatcon'];
	$wheatmax=$_SESSION['wheatmax'];
	$vegcon=$arr['vegcon'];
	$vegmax=$_SESSION['vegmax'];
	$graincon=$arr['graincon'];
	$grainmax=$_SESSION['grainmax'];
	$avg=($ricecon/$ricemax)*100;
	$avg1=($wheatcon/$wheatmax)*100;
	$avg2=($vegcon/$vegmax)*100;
	$avg3=($graincon/$grainmax)*100;
	if($avg<=1){$avg=15;}
	if($avg1<=1){$avg=15;}
	if($avg2<=1){$avg=15;}
	if($avg3<=1){$avg=15;}
	echo "
	<script type='text/javascript'>
	var c = document.getElementById('myCanvas');
var ctx = c.getContext('2d');
ctx.fillStyle = '#FF0000';
ctx.fillRect(".$val.",100-".$avg.",60,".$avg.");
</script>
	";
	echo "
	<script type='text/javascript'>
	var c = document.getElementById('myCanvas1');
var ctx = c.getContext('2d');
ctx.fillStyle = '#FF0000';
ctx.fillRect(".$val.",100-".$avg.",60,".$avg.");
</script>
	";
	echo "
	<script type='text/javascript'>
	var c = document.getElementById('myCanvas2');
var ctx = c.getContext('2d');
ctx.fillStyle = '#FF0000';
ctx.fillRect(".$val.",100-".$avg.",30,".$avg.");
</script>
	";
	echo "
	<script type='text/javascript'>
	var c = document.getElementById('myCanvas3');
var ctx = c.getContext('2d');
ctx.fillStyle = '#FF0000';
ctx.fillRect(".$val.",100-".$avg.",60,".$avg.");
</script>
	";
	$val+=90;
	}
?>
</body>
</head>
</html>