<?php
header('Content-type: text/html; charset=utf-8');
session_start();
if (!$_SESSION['user'])
    header('Location: auth.php');
require_once("header.php");
?>

<div class="user_form_text">
    <?php
    if (isset($_POST['p_submit'])) {
        echo 'User has been susscessfully created!';
    }

    ?>
    <p>Welcome! Here you can upload your works. Please full up the following fields and submit the paper.</p>
</div>

<form action="/scripts/takefile.php" method="post" enctype="multipart/form-data" class="form_user">
    <fieldset>
        <legend>Put a project</legend>
        <label for="project_title">Please write the title:</label><br>
        <input type="text" name="project_title" id="project_title" placeholder="Write the title..."><br>
        <label for="project_description">Write the description:</label><br>
        <textarea name="project_description" id="project_description" cols="80" rows="10"
                  placeholder="Type here..."></textarea><br><br>
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="myfile"><br>
        <div class="user_form_buttons">
            <input type="submit" name="p_submit" value="Submit">
            <input type="reset" value="Reset">
        </div>
    </fieldset>
</form>


<?php
//Footer Connection
require_once("footer.php");
?>

