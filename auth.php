<?php
//This chunk of code for LOG IN PAGE.


//Start the Session
session_start();

//Adding a database connection file
require_once("dbconnect.php");

//We declare a cell to add errors that may occur during processing of the form.
$_SESSION["error_messages"] = '';

//Declare a cell to add successful messages
$_SESSION["success_messages"] = '';


/*Checking if the form has been submitted, that is, if the Login button has been clicked. If yes, then go ahead, if not, then the user went to this page directly. In this case, we display an error message to him.*/
if (isset($_POST["btn_submit_auth"]) && !empty($_POST["btn_submit_auth"])) {

    //Check the received captcha
    if (isset($_POST["captcha"])) {

        //Trim spaces from the beginning and end of line
        $captcha = trim($_POST["captcha"]);

        if (!empty($captcha)) {

            //Compare the received value with the value from the session.
            if (($_SESSION["rand"] != $captcha) && ($_SESSION["rand"] != "")) {

                //If the captcha is not correct, then we return the user to the authorization page, and there we will display him an error message that he entered the wrong captcha.

                $error_message = "<p class='mesage_error'><strong>Error!</strong> You entered the wrong captcha </p>";

                //We save an error message to the session.
                $_SESSION["error_messages"] = $error_message;

                //Returning the user to the authorization page
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_auth.php");

                //Stop the script
                exit();
            }

        } else {

            $error_message = "<p class='mesage_error'><strong>Error!</strong> The captcha input field should not be empty. </p>";

            //We save an error message to the session.
            $_SESSION["error_messages"] = $error_message;

            //Returning the user to the authorization page
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_auth.php");

            //Stop the script
            exit();

        }

        //(2)Place to process the mailing address

        //Trim spaces from the beginning and end of line
        $email = trim($_POST["email"]);
        if (isset($_POST["email"])) {

            if (!empty($email)) {
                $email = htmlspecialchars($email, ENT_QUOTES);

                //Checking the format of the received mail address using a regular expression
                $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";

                //If the format of the received mail address does not match the regular expression
                if (!preg_match($reg_email, $email)) {
                    //We save an error message to the session.
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >You entered the wrong email</p>";

                    //Returning the user to the authorization page
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: " . $address_site . "/form_auth.php");

                    //Stop the script
                    exit();
                }
            } else {
                //We save an error message to the session.
                $_SESSION["error_messages"] .= "<p class='mesage_error' >The field for entering a mailing address (email) should not be empty.</p>";

                //Returning the user to the registration page
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_register.php");

                //Stop the script
                exit();
            }


        } else {
            //We save an error message to the session.
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Missing Email field</p>";

            //Returning the user to the authorization page
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_auth.php");

            //Stop the script
            exit();
        }

        //(3)Password Processing Area
        if (isset($_POST["password"])) {

            //Trim spaces from the beginning and end of line
            $password = trim($_POST["password"]);

            if (!empty($password)) {
                $password = htmlspecialchars($password, ENT_QUOTES);

                //Encrypt Password
                $password = md5($password . "top_secret");
            } else {
                //We save an error message to the session.
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Enter your password</p>";

                //Returning the user to the registration page
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_auth.php");

                //Stop the script
                exit();
            }

        } else {
            // We save an error message to the session.
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Missing password field</p>";

            //Returning the user to the registration page
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_auth.php");

            //Stop the script
            exit();
        }

        // (4) Place for making a request to the database
        //A query in the database on the user's selection.
        $result_query_select = $mysqli->query("SELECT * FROM `users` WHERE email = '" . $email . "' AND password = '" . $password . "'");

        if (!$result_query_select) {
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Requesting a user fetch from the database</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_auth.php");

            //Останавливаем скрипт
            exit();
        } else {

            //Проверяем, если в базе нет пользователя с такими данными, то выводим сообщение об ошибке
            if ($result_query_select->num_rows == 1) {

                // Если введенные данные совпадают с данными из базы, то сохраняем логин и пароль в массив сессий.
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;

                //Возвращаем пользователя на главную страницу
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/index.php");

            } else {

                // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Incorrect username and / or password</p>";

                //Returning the user to the registration page
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_auth.php");

                //Stop the script
                exit();
            }
        }

    } else {
        //If the captcha is not transferred
        exit("<p><strong>Ошибка!</strong> There is no verification code, i.e. a captcha code. You can go to <a href=" . $address_site . "> home page </a>.</p>");
    }

} else {
    exit("<p><strong>Ошибка!</strong> You went directly to this page, so there is no data to process. You can go to <a href=" . $address_site . "> home page </a>.</p>");
}


$email = $_POST['email'];
$pas = $_POST['password'];
if ($email == 'NBob88@yandex.ru' && $pas == 1234567) {
    session_start();
    $_SESSION['admin'] = true;
    $script = 'project.php';
} else if ($email == '123456@gmail.com' && $pas == 'dogseven') {
    session_start();
    $_SESSION['user'] = true;
    $script = 'user_form.php';
} else if ($email == 'luis@gmail.com' && $pas == 'teamleader') {
    session_start();
    $_SESSION['team leader'] = true;
    $script = 'teamleader.php';
} else
    $script = 'form-auth.php';
header("Location: $script");


//if ($email == '123456@gmail.com' && $pas == 'dogseven') {
//    session_start();
//    $_SESSION['user'] = true;
//    $script = 'user_form.php';
//} else
//    $script = 'form-auth.php';
//header("Location: $script");



