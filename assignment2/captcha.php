<?php
// Create a CAPTCHA image given a "text" query parameter
// Adapted form source: https://code.tutsplus.com/tutorials/build-your-own-captcha-and-contact-form-in-php--net-5362

$captcha_string = $_GET['text'];
$string_length = strlen($captcha_string);

// Create blank image
$image = imagecreatetruecolor(200, 50);

imageantialias($image, true);

$colors = [];

$red = rand(125, 175);
$green = rand(125, 175);
$blue = rand(125, 175);

for ($i = 0; $i < 5; $i++) {
	$colors[] = imagecolorallocate($image, $red - 20 * $i, $green - 20 * $i, $blue - 20 * $i);
}

imagefill($image, 0, 0, $colors[0]);

// Draw rectangles in random locations
for ($i = 0; $i < 10; $i++) {
	imagesetthickness($image, rand(2, 10));
	$line_color = $colors[rand(1, 4)];
	imagerectangle($image, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $line_color);
}

$black = imagecolorallocate($image, 0, 0, 0);
$white = imagecolorallocate($image, 255, 255, 255);
$textcolors = [$black, $white];

$fonts = [dirname(__FILE__) . '/fonts/Acme.ttf', dirname(__FILE__) . '/fonts/Ubuntu.ttf', dirname(__FILE__) . '/fonts/Merriweather.ttf', dirname(__FILE__) . '/fonts/PlayfairDisplay.ttf'];

// Draw CAPTCHA string on background
for ($i = 0; $i < $string_length; $i++) {
	$letter_space = 170 / $string_length;
	$initial = 15;

	imagettftext($image, 24, rand(-15, 15), $initial + $i * $letter_space, rand(25, 45), $textcolors[rand(0, 1)], $fonts[array_rand($fonts)], $captcha_string[$i]);
}

// Create the image
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
