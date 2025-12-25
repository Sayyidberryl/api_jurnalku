<?php
// Create a simple test image
$width = 200;
$height = 200;
$image = imagecreatetruecolor($width, $height);

// Set background color to blue
$blue = imagecolorallocate($image, 0, 100, 200);
imagefill($image, 0, 0, $blue);

// Add some text
$white = imagecolorallocate($image, 255, 255, 255);
imagestring($image, 5, 50, 90, 'TEST', $white);
imagestring($image, 3, 60, 110, 'PROFILE', $white);

// Save as JPEG
imagejpeg($image, 'test_profile.jpg', 90);
imagedestroy($image);

echo "Test image created: test_profile.jpg\n";
?>