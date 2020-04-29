<?php
require_once("header.php");
?>


<!-- Message output block -->
<div class="block_for_messages">
    <?php
    //If there are error messages in the session, then print them
    if (isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])) {
        echo $_SESSION["error_messages"];

        //We destroy so that they are not displayed again when the page is refreshed
        unset($_SESSION["error_messages"]);
    }

    //If there are joyful messages in the session, then print them
    if (isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])) {
        echo $_SESSION["success_messages"];

        //We destroy so that they are not displayed again when the page is refreshed
        unset($_SESSION["success_messages"]);
    }
    ?>
</div>

<?php
//We check if the user is not authorized, then we display the registration form,
//otherwise, we display a message that it is already registered
if (!isset($_SESSION["email"]) && !isset($_SESSION["password"])) {
    ?>

    <div id="form_register">
        <h2>Register</h2>

        <form action="register.php" method="post" name="form_register">
            <table>
                <tbody>
                <tr>
                    <td> Name:</td>
                    <td>
                        <input type="text" name="first_name" required="required">
                    </td>
                </tr>

                <tr>
                    <td> Surname:</td>
                    <td>
                        <input type="text" name="last_name" required="required">
                    </td>
                </tr>

                <tr>
                    <td> Email:</td>
                    <td>
                        <input type="email" name="email" required="required"><br>
                        <span id="valid_email_message" class="mesage_error"></span>
                    </td>
                </tr>

                <tr>
                    <td> Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="6 characters minimum" required="required"><br>
                        <span id="valid_password_message" class="mesage_error"></span>
                    </td>
                </tr>
                <tr>
                    <td> Captcha:</td>
                    <td>
                        <p>
                            <img src="captcha.php" alt="Captcha"/> <br><br>
                            <input type="text" name="captcha" placeholder="Checking code" required="required">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="btn_submit_register" value="Register">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
    <?php
} else {
    ?>
    <div id="authorized">
        <h2>You are already registered</h2>
    </div>

    <?php
}

?>


<?php
//Footer Connection
require_once("footer.php");
?>
