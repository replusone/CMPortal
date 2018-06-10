<?php
//session_start();
header('Content-type: image/jpeg');

if(isset($_GET['code']) === true && empty($_GET['code']) === false){
	$text = $_GET['code'];
}
else{
	$text = 'oooo';
}
$font_size = 30;

$image_width = 202;
$image_height = 40;

$image = imagecreate($image_width, $image_height);
imagecolorallocate($image, 240, 200, 239);
$text_color = imagecolorallocate($image, 10, 15, 48);

for($x = 1; $x < 100; $x++){
	$x1 = rand(1,200);
	$y1 = rand(1,200);
	$x2 = rand(1,200);
	$y2 = rand(1,200);
	imageline($image, $x1, $y1, $x2, $y2, $text_color);
}

imagettftext($image, $font_size, 0, 15, 30, $text_color, 'VINERITC.ttf', $text);
imagejpeg($image);
?>