<?php

//Start session
session_start();

//Add a database connection file
require_once("dbconnect.php");

//We declare a cell to add errors that may occur during processing of the form.
$_SESSION["error_messages"] = '';

//Declare a cell to add successful messages
$_SESSION["success_messages"] = '';

/*

Check if the form has been submitted, that is, if the register button has been clicked. If yes, then go ahead, if not, then the user went to this page directly. In this case, we display an error message to him.
*/
if (isset($_POST["btn_submit_register"]) && !empty($_POST["btn_submit_register"])) {

    // (1)Place for the next piece of code

    //Check the received captcha
    //Trim spaces from the beginning and end of line
    $captcha = trim($_POST["captcha"]);

    if (isset($_POST["captcha"]) && !empty($captcha)) {

        //Compare the received value with the value from the session.
        if (($_SESSION["rand"] != $captcha) && ($_SESSION["rand"] != "")) {

            //If the captcha is not correct, then return the user to the registration page, and there we will display him an error message that he entered the wrong captcha.
            $error_message = "<p class='mesage_error'><strong>Error!</strong>You entered the wrong captcha</p>";

            // We save an error message to the session.
            $_SESSION["error_messages"] = $error_message;

            //Returning the user to the registration page
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_register.php");

            //Stop the script
            exit();
        }

        // (2)Place for the next piece of code
        //Check if the data sent from the form exists in the $ _POST global array and enclose the transferred data in ordinary variables.
        if (isset($_POST["first_name"])) {

            //Trim spaces from the beginning and end of line
            $first_name = trim($_POST["first_name"]);

            //Checking a variable for void
            if (!empty($first_name)) {

                // For security, convert special characters to HTML entities
                $first_name = htmlspecialchars($first_name, ENT_QUOTES);
            } else {
                //We save an error message to the session.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Enter your name</p>";

                //Returning the user to the registration page
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_register.php");

                //Stop the script
                exit();
            }


        } else {
            //We save an error message to the session.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Missing field with name</p>";

            //Returning the user to the registration page
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_register.php");

            //Stop the script
            exit();
        }


        if (isset($_POST["last_name"])) {

            //Trim spaces from the beginning and end of line
            $last_name = trim($_POST["last_name"]);

            if (!empty($last_name)) {
                //For security, convert special characters to HTML entities
                $last_name = htmlspecialchars($last_name, ENT_QUOTES);
            } else {

                //We save an error message to the session.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Enter your last name</p>";

                //Returning the user to the registration page
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_register.php");

                //Stop the script
                exit();
            }


        } else {

            //We save an error message to the session.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Missing field with last name</p>";

            //Returning the user to the registration page
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_register.php");

            //Stop the script
            exit();
        }


        if (isset($_POST["email"])) {

            //Trim spaces from the beginning and end of line
            $email = trim($_POST["email"]);

            if (!empty($email)) {


                $email = htmlspecialchars($email, ENT_QUOTES);

                // (3)Code place to check the format of the mailing address and its uniqueness

                //Checking the format of the received mail address using a regular expression
                $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";

                //If the format of the received mail address does not match the regular expression
                if (!preg_match($reg_email, $email)) {
                    //We save an error message to the session.
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >You entered an invalid email</p>";

                    //Returning the user to the registration page
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: " . $address_site . "/form_register.php");

                    //Stop the script
                    exit();
                }

                //Check if there is already such an address in the database.
                $result_query = $mysqli->query("SELECT `email` FROM `users` WHERE `email`='" . $email . "'");

                //If the number of received lines is exactly one, then the user with this mailing address is already registered
                if ($result_query->num_rows == 1) {

                    //If the result is not false
                    if (($row = $result_query->fetch_assoc()) != false) {

                        //We save an error message to the session.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >A user with this email address is already registered</p>";

                        //Returning the user to the registration page
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: " . $address_site . "/form_register.php");

                    } else {
                        // We save an error message to the session.
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Error in query to database</p>";

                        //Returning the user to the registration page
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: " . $address_site . "/form_register.php");
                    }


                    $result_query->close();

                    //Stop the script
                    exit();
                }


                $result_query->close();
            } else {
                // We save an error message to the session.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Enter your email</p>";

                //Returning the user to the registration page
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_register.php");

                //Stop the script
                exit();
            }

        } else {
            //  We save an error message to the session.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Missing Email field</p>";

            //Returning the user to the registration page
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_register.php");

            //Stop the script
            exit();
        }


        if (isset($_POST["password"])) {

            //Trim spaces from the beginning and end of line
            $password = trim($_POST["password"]);

            if (!empty($password)) {
                $password = htmlspecialchars($password, ENT_QUOTES);

                //Encryption of password
                $password = md5($password . "top_secret");
            } else {
                // Saving an error message to the session.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Enter your password</p>";

                //Returning the user to the registration page
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_register.php");

                //Stop the script
                exit();
            }

        } else {
            // We save an error message to the session.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Missing password field</p>";

            //Returning the user to the registration page
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_register.php");

            //Stop the script
            exit();
        }

        // (4) The place for the code to add the user to the database

        //Request to add a user to the database
        $result_query_insert = $mysqli->query("INSERT INTO `users` (first_name, last_name, email, password) VALUES ('" . $first_name . "', '" . $last_name . "', '" . $email . "', '" . $password . "')");

        if (!$result_query_insert) {
            //We save an error message to the session.
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Error requesting to add a user to the database</p>";

            //Returning the user to the registration page
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_register.php");

            //Stop the script
            exit();
        } else {

            $_SESSION["success_messages"] = "<p class='success_message'>Registration completed successfully!!! <br />Now you can log in using your username and password.</p>";

            //We send the user to the authorization page
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_auth.php");
        }

        /* Request Completion */
        $result_query_insert->close();

        //Close the connection to the database
        $mysqli->close();

    } else {
        //If the captcha is not transferred or it is empty
        exit("<p><strong>Ошибка!</strong> There is no verification code, i.e. a captcha code. You can go to <a href=" . $address_site . "> home page </a>.</p>");
    }

} else {

    exit("<p><strong>Ошибка!</strong> You went directly to this page, so there is no data to process. You can go to <a href=" . $address_site . "> home page </a>.</p>");
}


?>

















