<?php
session_start();
$email=$_SESSION['email'];
//echo $email;
if(!$_SESSION['email']){header('Location:login.php');}
$host="localhost";
$user="root";
$password="";
$db="fwm";
$dbcon=@mysqli_connect($host,$user, $password, $db);
$sum=array();
$s=0;
$s1=0;
$s2=0;
$s3=0;
$max=0;
$max1=0;
$max2=0;
$max3=0;
$count=0;
$count1=0;
$count2=0;$count3=0;
$std_count=0;
$std_count1=0;
$std_count2=0;
$std_count3=0;
$sd[]=array();$j=0;
for($i=6;$i>=0;$i--){$j++;
	$date=date('d/m/Y',strtotime("-".$i." days"));
	$sql="select * from `datafeed` where date='$date' and email='$email'";
	$res=@mysqli_query($dbcon,$sql);
	$arr=@mysqli_fetch_array($res);
	$s+=$arr['ricecon'];
	$sd['ricecon'][$j]=$arr['ricecon'];
	if($s>$max){$max=$s;$ricemax=$max;}
	$sum['ricecon']=$s;
	$s1+=$arr['wheatcon'];
	$sd['wheatcon'][$j]=$arr['wheatcon'];
	if($s1>$max1){$max1=$s1;$wheatmax=$max1;}
	$sum['wheatcon']=$s1;
	$s2+=$arr['vegcon'];
	$sd['vegcon'][$j]=$arr['vegcon'];
	if($s2>$max2){$max2=$s2;$vegmax=$max2;}
	$sum['vegcon']=$s2;
	$sd['graincon'][$j]=$arr['graincon'];
	$s3+=$arr['graincon'];
	if($s3>$max3){$max3=$s3;$grainmax=$max3;}
	$sum['graincon']=$s3;
	}
	$avg=$sum['ricecon']/7;
	$avg=floor($avg * 100) / 100;
	$avg1=$sum['wheatcon']/7;
	$av1=floor($avg1 * 100) / 100;
	$avg2=$sum['vegcon']/7;
	$av2=floor($avg2 * 100) / 100;
	$avg3=$sum['graincon']/7;
	$avg3=floor($avg3 * 100) / 100;
	$_SESSION['ricemax']=$ricemax;
	$_SESSION['wheatmax']=$wheatmax;
	$_SESSION['vegmax']=$vegmax;
	$_SESSION['grainmax']=$grainmax;
	for($i=1;$i<=7;$i++){
		$count+=$sd['ricecon'][$i];
		//echo $sd['ricecon'][$i];
		$count1+=$sd['wheatcon'][$i];
		$count2+=$sd['vegcon'][$i];
		$count3+=$sd['graincon'][$i];
	}
	//echo $count." ";
	$count=($count/7);
	$count1=($count1/7);
	$count2=($count2/7);
	$count3=($count3/7);
	//echo $sd['ricecon']['$i']." ".$count;
	for($i=1;$i<=7;$i++){
		$std_count+=(($sd['ricecon'][$i]-$count)*($sd['ricecon'][$i]-$count));
		$std_count1+=(($sd['wheatcon'][$i]-$count1)*($sd['wheatcon'][$i]-$count1));
		$std_count2+=(($sd['vegcon'][$i]-$count2)*($sd['vegcon'][$i]-$count2));
		$std_count3+=(($sd['graincon'][$i]-$count3)*($sd['graincon'][$i]-$count3));
		$std_count=$std_count/49;
		$std_count+=$_SESSION['ricemax'];
		$std_count1=$std_count1/49;
		$std_count1+=$_SESSION['ricemax'];
		$std_count2=$std_count2/49;
		$std_count2+=$_SESSION['ricemax'];
		$std_count3=$std_count3/49;
		$std_count3+=$_SESSION['ricemax'];
	}
	echo "<tr><td>Total rice consumed :".$sum['ricecon']."</td><td>Avg Rice consumed :".$avg."</td></tr><br>";
	echo "Total wheat consumed :".$sum['wheatcon']."</td><td>Avg wheat consumed :".$avg1."</td></tr><br>";
	echo "Total veg consumed :".$sum['vegcon']."</td><td>Avg veg consumed :".$avg2."</td></tr><br>";
	echo "Total grain consumed :".$sum['graincon']."</td><td>Avg grain consumed :".$avg3."</td></tr><br>";
	echo "From next week, the revised quantities that will be issued will be as follows :<br>";
	echo "<tr><td>For Rice :</td><td>".$std_count."</td></tr><br>";
	echo "<tr><td>For wheat :</td><td>".$std_count1."</td></tr><br>";
	echo "<tr><td>For vegetables :</td><td>".$std_count2."</td></tr><br>";
	echo "<tr><td>For grain :</td><td>".$std_count3."</td></tr><br>";
?>
<html>
<head>
</head>
<body>
</body>
</html>