<?php
header('Content-type: text/html; charset=utf-8');
session_start();
if (!$_SESSION['admin'])
    header('Location: auth.php');

require_once("header.php");
?>


<div class="project-title">
    <h1 style="text-align: center; margin-top: 30px">Welcome Bobur!</h1>
    <p>From this admin panel you are able to create a new user and assign them one specific role. Just fill up the following form and press Create button!</p>
</div>

<div class="project-form">
    <form action="createAndManageUser.php" method="post">
        <fieldset>
            <legend>Creating Users</legend>
            <label for="">Last Name</label><br>
            <input type="text" name="User_last_name"><br>
            <label for="">First Name</label><br>
            <input type="text" name="User_first_name"><br>
            <label for="">Create Email</label><br>
            <input type="email" name="User_email"><br>
            <label for="">Create Password</label><br>
            <input type="password" name="User_password"><br>
            <label for="">Roles</label><br>
            <select name="Roles" id="">
                <option value="Student Team Leader">Team Leader</option>
                <option value="Student">Student</option>
            </select><br><br>
            <div class="user_form_buttons">
                <input type="submit" name="submitForm" value="Create">
                <input type="reset" value="Reset">
            </div>

        </fieldset>
    </form>
</div>

<?php
//Footer Connection
require_once("footer.php");
?>
