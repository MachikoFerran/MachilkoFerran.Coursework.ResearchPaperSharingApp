<?php
//Log In Page Structure

require_once("header.php");
?>



<!-- Message output block -->
<div class="block_for_messages">
    <?php

    if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
        echo $_SESSION["error_messages"];

        //We destroy so that it does not appear again when the page is refreshed
        unset($_SESSION["error_messages"]);
    }

    if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
        echo $_SESSION["success_messages"];

        //We destroy so that it does not appear again when the page is refreshed
        unset($_SESSION["success_messages"]);
    }
    ?>
</div>

<?php
//We check if the user is not authorized, then we display the authorization form,
//otherwise, we display a message that he is already authorized
if(!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
    ?>

    <div id="form_auth">
        <h2>Log In</h2>
        <form action="auth.php" method="post" name="form_auth" >
            <table>

                <tr>
                    <td> Email: </td>
                    <td>
                        <input type="email" name="email" required="required" /><br />
                        <span id="valid_email_message" class="mesage_error"></span>
                    </td>
                </tr>

                <tr>
                    <td> Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="6 characters minimum" required="required" /><br />
                        <span id="valid_password_message" class="mesage_error"></span>
                    </td>
                </tr>

                <tr>
                    <td> Captcha: </td>
                    <td>
                        <p>
                            <img src="captcha.php" alt="Капча" /> <br />
                            <input type="text" name="captcha" placeholder="" />
                        </p>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" class="submit" name="btn_submit_auth" value="Log In" style="margin: auto;" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <?php
}else{
    ?>
    <div id="authorized">
        <h2>You are already logged in</h2>
    </div>

    <?php
}
?>


<?php
//Footer Connection
require_once("footer.php");
?>

