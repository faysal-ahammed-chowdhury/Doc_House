<?php require_once "../../controller/Helper/Auth/authChecker.php" ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Recovery</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="box">
        <div class="left">
            <div class="content">
                <img src="../images/logo.png" alt="Logo" class="logo">
                <p class="gray-para">
                    Your health journey starts here. Connect with top specialists and manage your appointments with ease.
                </p>
            </div>
        </div>
        <div class="right">
            <form action="">
                <h2 class="heading">Account Recovery</h2>
                <p class="light-para">
                    Enter your email and date of birth to verify.
                </p>
                <div class="field">
                    <label for="email">Email <span class="red-star">*</span></label>
                    <input type="email" id="email" name="email">
                </div>
                <div class="field">
                    <label for="dob">Date of Birth <span class="red-star">*</span></label>
                    <input type="date" id="dob" name="dob">
                </div>
                <div class="field two-field">
                    <div class="first">
                        <label for="new_password">New Password <span class="red-star">*</span></label>
                        <input type="password" id="new_password" name="new_password">
                    </div>
                    <div class="second">
                        <label for="cnew_password">Confirm Password <span class="red-star">*</span></label>
                        <input type="password" id="cnew_password" name="cnew_password">
                    </div>
                </div>

                <div class="field">
                    <input class="submit-btn" type="submit" value="Submit"">
                </div>
                <div class=" other">
                    <p><a href="login.php">Back to Login</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>