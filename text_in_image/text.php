<?php
header('Content-Type: image/png');
 $top_file = 'barcode4.jpg';
$bottom_file = 'core.jpg';

$top = imagecreatefromjpeg($top_file);
$bottom = imagecreatefromjpeg($bottom_file);

// get current width/height
list($top_width, $top_height) = getimagesize($top_file);
list($bottom_width, $bottom_height) = getimagesize($bottom_file);

// compute new width/height
$new_width = ($top_width > $bottom_width) ? $top_width : $bottom_width;
$new_height = $top_height + $bottom_height;

// create new image and merge
$new = imagecreate(300, 150);
//imagecopy($new, $top, 300, 0, 0, -180, $top_width, $top_height);
imagecopy($new, $top, 20, 70, 0, 0, $top_width, $top_height);

// save to file
imagejpeg($new, 'merged_image.jpg');
$bar = imagecreatefromjpeg('merged_image.jpg');
$black = imagecolorallocate($bar, 0, 0, 0);
imagettftext($bar, 40, 0, $top_width+40, 110, $black, 'arial.ttf', '$67');
imagettftext($bar, 12, 0, $top_width+40, 130, $black, 'arial.ttf', 'Sugar');
imagettftext($bar, 18, 0, 70, 30, $black, 'arial.ttf', 'POSNIC');
imagettftext($bar, 10, 0, 30, 50, $black, 'arial.ttf', '#133,18th Cross,29Th Main,HSR Layout');
imagejpeg($bar);


imagejpeg($bar, 'merged_image.jpg');