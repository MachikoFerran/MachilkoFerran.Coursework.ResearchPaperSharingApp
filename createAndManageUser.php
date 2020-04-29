<?php
session_start();

//This script belongs to Admin panel page.
error_reporting(E_ALL);
ini_set('display_errors', 1);
$pageTitle = "Create User";
require_once("header.php");



   
   $status='';

   if (isset($_POST['submitForm']))
   {
        $lastname = $_POST['User_last_name'];
        $firstname = $_POST['User_first_name'];
        $email = $_POST['User_email'];
        $password = $_POST['User_password'];
        $role = $_POST['Roles'];
        echo 'User has been susscessfully created!';
       }
