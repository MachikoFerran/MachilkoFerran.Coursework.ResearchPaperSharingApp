<?php
session_start();
?>


<!--As you can see, it is Header section. I did it separately just like footer for convenient connection with other pages-->

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HomePage</title>

    <!-- Custom fonts for this template -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="shortcut icon" href="images/logo.jpg" >



<!--    <link href="assets/css/all.css" rel="stylesheet">-->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            "use strict";
            //===============Email Verificationl ==================//

            //Regular expression to check email
            var pattern = /^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i;

            $('input[name=email]').blur(function () {

                if ($(this).val() != '') {

                    //Checking if the entered email matches the regular expression
                    if ($(this).val().search(pattern) == 0) {

                        $.ajax({

                            //The name of the file in which we will check email for existence in the database
                            url: "check_email.php",

                            // Specify by which method the data will be transmitted.
                            type: "POST",

                            //Specify in JSON format what data to transfer
                            data: {
                                email: $(this).val()
                            },

                            //The type of content we expect to receive from the server.
                            dataType: "html",

                            //The function that will be executed before sending data
                            beforeSend: function () {

                                $('#valid_email_message').text('Checking...');
                            },

                            //The function that will be executed after all the data has been successfully received.
                            success: function (data) {

                                //The resulting response is placed inside the span tag
                                $('#valid_email_message').html(data);
                            }
                        });

                        //Activate the submit button
                        $('input[type=submit]').attr('disabled', false);
                    } else {
                        //Error message
                        $('#valid_email_message').html('<span class="mesage_error">Incorrect Email</span>');

                        //Deactivate the submit button
                        $('input[type=submit]').attr('disabled', true);
                    }

                } else {
                    $('#valid_email_message').html('<span class="mesage_error">Enter the email</span>');
                }
            });

            //================ Length of Email ==================
            var password = $('input[name=password]');

            password.blur(function () {
                if (password.val() != '') {

                    //If the password is less than six characters long, then an error message is displayed.
                    if (password.val().length < 6) {
                        //Выводим сообщение об ошибке
                        $('#valid_password_message').text('Minimum password length 6 characters');

                        // Deactivate the submit button
                        $('input[type=submit]').attr('disabled', true);

                    } else {
                        //Remove the error message
                        $('#valid_password_message').text('');

                        //Activate the submit button
                        $('input[type=submit]').attr('disabled', false);
                    }
                } else {
                    $('#valid_password_message').text('Enter the password');
                }
            });
        });
    </script>

    <link rel="stylesheet" href="assets/fontawesome-free-5.12.1-web/css/all.min.css">


</head>

<body>

<!-- NAVIGATION BAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php"><img src="images/logo.jpg" alt="logo"></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item active">
                    <a class="nav-link" href="about us.php">ABOUT US<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">HOME<span class="sr-only">(current)</span></a>
                </li>

                <?php
                //Check if the user is authorized
                if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
                    //if not, then display a block with links to the registration and authorization page
                    ?>

                    <li class="nav-item active">
                        <a class="nav-link" href="form_auth.php">LOGIN</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="form_register.php" id="register_string">REGISTER</a>
                    </li>

                    <?php
                } else {
                    //If the user is authorized, then we display the Exit link
                    ?>
                    <div id="change_profile">
                        <li class="nav-item active">
                            <a class="nav-link" href="/editprofile.php">CHANGE PROFILE</a>
                        </li>
                    </div>
                    <br>
                <li class="nav-item active">
                        <a  class="nav-link" href="/logout.php">LOG OUT</a>
                </li>
                    <?php
                }
                ?>


            </ul>
        </div>

    </div>
</nav>
