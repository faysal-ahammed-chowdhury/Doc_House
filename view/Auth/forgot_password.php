<?php require_once "../../middleware/authMiddleware.php" ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Recovery</title>
    <link rel="stylesheet" href="css/style.css">
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
            <form novalidate onsubmit="return handleForgotPass(this)" action="../../controller/Auth/forgotPassController.php" method="POST">
                <h2 class="heading">Account Recovery</h2>
                <p class="light-para">
                    Enter your email and date of birth to verify.
                </p>
                <div
                    <?php echo (isset($_SESSION['forgotPassErr']) && !empty($_SESSION['forgotPassErr'])) ? 'style="display: block;"' : 'style="display: none;"'; ?>
                    class="error-box">
                    <span class="error-text"><?php echo $_SESSION['forgotPassErr'] ?></span>
                    <?php unset($_SESSION['forgotPassErr']); ?>
                </div>
                <div
                    <?php echo (isset($_SESSION['forgotPassSuccess']) && !empty($_SESSION['forgotPassSuccess'])) ? 'style="display: block;"' : 'style="display: none;"'; ?>
                    class="success-box">
                    <span class="success-text"><?php echo $_SESSION['forgotPassSuccess'] ?></span>
                    <?php unset($_SESSION['forgotPassSuccess']); ?>
                </div>
                <div class="field">
                    <label for="email">Email <span class="red-star">*</span></label>
                    <input type="email" id="email" name="email"
                        value="<?php
                                echo (isset($_SESSION['forgotPassData']['email']) && !empty($_SESSION['forgotPassData']['email'])) ? $_SESSION['forgotPassData']['email'] : "";
                                unset($_SESSION['forgotPassData']['email']);
                                ?>">
                    <p class="error hidden" id="emailErrBox">Email is required</p>
                </div>
                <div class="field">
                    <label for="dob">Date of Birth <span class="red-star">*</span></label>
                    <input type="date" id="dob" name="dob"
                        value="<?php
                                echo (isset($_SESSION['forgotPassData']['dob']) && !empty($_SESSION['forgotPassData']['dob'])) ? $_SESSION['forgotPassData']['dob'] : "";
                                unset($_SESSION['forgotPassData']['email']);
                                ?>">
                    <p class="error hidden" id="dobErrBox">DOB is required</p>
                </div>
                <div class="field two-field">
                    <div class="first">
                        <label for="new_password">New Password <span class="red-star">*</span></label>
                        <input type="password" id="new_password" name="new_password"
                            value="<?php
                                    echo (isset($_SESSION['forgotPassData']['new_password']) && !empty($_SESSION['forgotPassData']['new_password'])) ? $_SESSION['forgotPassData']['new_password'] : "";
                                    unset($_SESSION['forgotPassData']['new_password']);
                                    ?>">
                        <p class="error hidden" id="newPassErrBox">Password is required</p>
                    </div>
                    <div class="second">
                        <label for="cnew_password">Confirm Password <span class="red-star">*</span></label>
                        <input type="password" id="cnew_password" name="cnew_password"
                            value="<?php
                                    echo (isset($_SESSION['forgotPassData']['cnew_password']) && !empty($_SESSION['forgotPassData']['cnew_password'])) ? $_SESSION['forgotPassData']['cnew_password'] : "";
                                    unset($_SESSION['forgotPassData']['cnew_password']);
                                    ?>">
                        <p class="error hidden" id="cnewPassErrBox">Confrim Password is required</p>
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


    <script src="js/script.js"></script>
</body>

</html>