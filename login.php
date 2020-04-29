<?php

// Login page

//Function to generate a random string
function generateCode($length = 6)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
        $code .= $chars[mt_rand(0, $clen)];
    }
    return $code;
}

// Connect to DB
$link = mysqli_connect("localhost", "root", "", "db.personal");

if (isset($_POST['submit'])) {
    //We extract from the database a record whose login is equal to the entered
    $query = mysqli_query($link, "SELECT user_id, user_password FROM users WHERE user_login='" . mysqli_real_escape_string($link, $_POST['login']) . "' LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    //Compare passwords
    if ($data['user_password'] === md5(md5($_POST['password']))) {
        //We generate a random number and encrypt it
        $hash = md5(generateCode(10));

        if (!empty($_POST['not_attach_ip'])) {
            //If the user has selected IP binding
            //Translate IP into a string
            $insip = ", user_ip=INET_ATON('" . $_SERVER['REMOTE_ADDR'] . "')";
        }

        // We write in the database a new hash of authorization and IP
        mysqli_query($link, "UPDATE users SET user_hash='" . $hash . "' " . $insip . " WHERE user_id='" . $data['user_id'] . "'");

        //Set cookies
        setcookie("id", $data['user_id'], time() + 60 * 60 * 24 * 30, "/");
        setcookie("hash", $hash, time() + 60 * 60 * 24 * 30, "/", null, null, true); // httponly !!!

        //Redirecting the browser to the page for checking our script
        header("Location: check.php");
        exit();
    } else {
        print "You entered an incorrect username / password";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/style.css">
    <title>Document</title>
</head>
<body>
<header>
    <div class="header">
        <img src="images/logo.jpg" alt="Logo"><a href="#"></a>
        <div class="credent">
            <button>Log In</button>
            <div class="loginfield">
                <form method="POST">
                    Login <input name="login" type="text" required><br>
                    Password <input name="password" type="password" required><br>
                    Do not attach to IP (not safe) <input type="checkbox" name="not_attach_ip"><br>
                    <input name="submit" type="submit" value="Log In">
                </form>
            </div>
        </div>


    </div>
</header>


<section>

    <div class="wrap">
        <input type="radio" name="slides" id="point1" checked>
        <input type="radio" name="slides" id="point2">
        <input type="radio" name="slides" id="point3">

        <div class="slider">
            <div class="slides img1"></div>
            <div class="slides img2"></div>
            <div class="slides img3"></div>
        </div>

        <div class="control">
            <label for="point1"></label>
            <label for="point2"></label>
            <label for="point3"></label>
        </div>
    </div>
</section>
</body>
</html>

