<?php
//This script works for PROFILE PAGE when active any role
if(isset($_POST['submit'])) {
    if(empty($_FILES['avatarka']['size']))  die('You did not select a file');
    if($_FILES['avatarka']['size'] > (5 * 1024 * 1024)) die('File size should not exceed 5Mb');
    $imageinfo = getimagesize($_FILES['avatarka']['tmp_name']);
    $arr = array('image/jpeg','image/gif','image/png');
    if(!in_array($imageinfo['mime'],$arr)) echo ('Image must be in jpg, gif or png format');
    else {
        $upload_dir = 'images/'; //image folder name
        $name = $upload_dir.date('YmdHis').basename($_FILES['avatarka']['name']);
        $mov = move_uploaded_file($_FILES['avatarka']['tmp_name'],$name);
        if($mov) {
            require('setup.php'); //connection to the database
            $name = stripslashes(strip_tags(trim($name)));
            mysqli_query( ); //add request here
        }
        else echo 'An error occurred while loading the avatar. Please try again.';
    }
}
