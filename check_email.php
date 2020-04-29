<?php
//Add a database connection file
require_once("dbconnect.php");

if(isset($_POST["email"])) {

    $email =  trim($_POST["email"]);

    $email = htmlspecialchars($email, ENT_QUOTES);

    //Check if there is already such an address in the database.
    $result_query = $mysqli->query("SELECT `email` FROM `users` WHERE `email`='".$email."'");

    //If the number of received lines is exactly one, then the user with this mailing address is already registered
    if($result_query->num_rows == 1){

        echo "<span class='mesage_error'>A user with this email address is already registered</span>";

    }else{
        echo "<span class='success_message'>Free mailing address</span>";
    }

    //close sample
    $result_query->close();
}
?>
