<?php
session_start();
//Special code for creating CAPTCHA (in Log In Page) checking bot


//Generating a random number.
$rand = mt_rand(1000, 9999);

//Save the value of the variable $ rand (captcha) in the session
$_SESSION["rand"] = $rand;

//Create a new black and white image
$im = imageCreateTrueColor(90,50);

//Specify white color for text
$c = imageColorAllocate($im, 255, 255, 255);

//Write the resulting random number to the image
imageTtfText($im, 20, -10, 10, 30, $c, __DIR__."/fonts/verdana.ttf", $rand);

header("Content-type: image/png");

// Display image
imagePng($im);

//Freeing up resources
imageDestroy($im);
?>
