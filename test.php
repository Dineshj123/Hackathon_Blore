<?php
session_start();
$font_size=30;
$text=myfunction();
$_SESSION["strings"]=$text;
header('Content-type: image/png');
$image_width=120;
$image_height=20;
$image=imagecreate($image_width,$image_height)
or die('Cannot Initialize new GD image stream');
$background=imagecolorallocate($image,0,255,0);
$black=imagecolorallocate($image,0,0,0);
imagestring($image,5,5,1,$_SESSION["strings"],$black);
imagejpeg($image);
imagedestroy($image);

	
function myfunction(){

$chars='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$numbers='0123456789';
srand((double)microtime()*1000000);
$str="";
$i=0;
while($i<(rand(10,14))/2){
	$num=rand()%33;
	$tmp=substr($chars,$num,1);
	$tmp=$tmp.substr($numbers,$num,1);
	$str=$str.$tmp;$i++;
}
return $str;
}
?>