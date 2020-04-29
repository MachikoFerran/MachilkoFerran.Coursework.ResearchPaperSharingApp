<?php
//Connection with database script


//Specify the encoding
header('Content-Type: text/html; charset=utf-8');

$server = "localhost"; /* host name (to be specified by the provider), if we work on a local server, then specify localhost */
$username = "root"; /* DB username */
$password = ""; /* User password, if the user does not have a password then leave blank*/
$database = "db.personal"; /* The name of the database that created */

//Database connection through MySQLi
$mysqli = new mysqli($server, $username, $password, $database);

// Check the success of the connection.
if (mysqli_connect_errno()) {
    echo "<p><strong>Invalid connection with DB</strong>. Error Description: ".mysqli_connect_error()."</p>";
    exit();
}

//Set connection encoding
$mysqli->set_charset('utf8');

//For convenience, add a variable here that will contain the name of our site
$address_site = "http://personal";
?>
