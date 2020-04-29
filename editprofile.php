<?php
//Header
require_once("header.php");
?>
<div class="edit-profile">
    <h1>Edit Profile</h1>

    <div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="https://static.change.org/profile-img/default-user-profile.svg" class="img-responsive"
                             alt="">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            Bob Ferran
                        </div>
                        <div class="profile-usertitle-job">
                            Developer
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                        <button type="button" class="btn btn-success btn-sm">Follow</button>
                        <button type="button" class="btn btn-danger btn-sm">Message</button>
                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->

                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-md-9">
                <div class="profile-content">

                    <form id="form1" action="/profile/profile.php" method="post" enctype="multipart/form-data">
                        <h3>Change Password</h3>
                        <table id="editprofile-table">
                            <tr>
                                <td>
                                    <label for="">New Password:</label>
                                </td>
                                <td>
                                    <input type="password" name="password">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">Confirm Password:</label>
                                </td>
                                <td>
                                    <input type="password" name="conf_password">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">Current Password</label>
                                </td>
                                <td>
                                    <input type="password" name="old_password">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p><input type="file" name="avatarka">
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" name="editprofile" value="Edit">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
//Footer
require_once("footer.php");
?>
