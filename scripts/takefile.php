<?php
//This script is used for sending any types of files or Image from USER page.
print_r($_FILES);


$take = $_FILES['myfile']['tmp_name'];
$name = $_FILES['myfile']['name'];
move_uploaded_file($take, 'userfiles/'.$name);
if(isset($_POST['p_submit'])){
    echo "Documents successfully sent!";
}
//move_uploaded_file($take, 'docs');
