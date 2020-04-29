<?php
session_start();

//if (isset($_POST["editprofile"])) {
//    $password = $_POST["password"];
//    $conf_password = $_POST["conf_password"];
//    $old_password = $_POST["old_password"];
//    if (isset($_SESSION["login"], $old_password)) {
//        if (strlen($password) >= 6) {
//            if ($password === $conf_password) {
//                $password = md5($password);
//                setPassword($_SESSION["login"], $password);
//
//            } else echo "Password not correct";
//        } else echo "Password too short";
//
//    } else echo "Incorrect Password!";



$status='';

if (isset($_POST['submitForm']))
{
    $lastname = $_POST['User_last_name'];
    $firstname = $_POST['User_first_name'];
    $email = $_POST['User_email'];
    $password = $_POST['User_password'];
    $role = $_POST['Roles'];


    if ($lastname=='' || $firstname=='' || $email=='' || $password=='' || $role=='')
    {
        $status='warning';
        $msg = "All fields are required to be filled before continuing.";
    }else
    {
        $user = new User();
        $result = $user->createuser($lastname,$firstname,$email,$password,$role);
        $status = $result["status"];
        $msg = $result["msg"];
    }
}



?>


