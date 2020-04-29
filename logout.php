<?php
//Log Out Page

// Delete cookies
setcookie("id", "", time() - 3600*24*30*12, "/");
setcookie("hash", "", time() - 3600*24*30*12, "/",null,null,true); // httponly !!!


//Start the session
session_start();

unset($_SESSION["email"]);
unset($_SESSION["password"]);

//We return the user to the page on which he clicked on the exit button.
header("HTTP/1.1 301 Moved Permanently");
header("Location: " . $_SERVER["HTTP_REFERER"]);

?>
