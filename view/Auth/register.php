<?php require_once "../../middleware/guestMiddleware.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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
            <form novalidate onsubmit="return handleRegister(this)" action="../../controller/Auth/registerController.php" method="POST">
                <h2 class="heading">Create Account</h2>
                <p class="light-para">
                    Enter your details to register as a new patient.
                </p>
                <div
                    <?php echo (isset($_SESSION['regErr']) && !empty($_SESSION['regErr'])) ? 'style="display: block;"' : 'style="display: none;"'; ?>
                    class="error-box">
                    <span class="error-text"><?php echo $_SESSION['regErr'] ?></span>
                    <?php unset($_SESSION['regErr']); ?>
                </div>
                <div class="field">
                    <label for="name">Name <span class="red-star">*</span></label>
                    <input type="text" id="name" name="name"
                        value="<?php
                                echo (isset($_SESSION['regData']['name']) && !empty($_SESSION['regData']['name'])) ? $_SESSION['regData']['name'] : "";
                                unset($_SESSION['regData']['name']);
                                ?>">
                    <p class="error hidden" id="nameErrBox">Name is required</p>
                </div>
                <div class="field two-field">
                    <div class="first">
                        <label for="email">Email <span class="red-star">*</span></label>
                        <input type="email" id="email" name="email"
                            value="<?php
                                    echo (isset($_SESSION['regData']['email']) && !empty($_SESSION['regData']['email'])) ? $_SESSION['regData']['email'] : "";
                                    unset($_SESSION['regData']['email']);
                                    ?>">
                        <p class="error hidden" id="emailErrBox">Email is required</p>
                    </div>
                    <div class="second">
                        <label for="phone">Phone <span class="red-star">*</span></label>
                        <input type="text" id="phone" name="phone"
                            value="<?php
                                    echo (isset($_SESSION['regData']['phone']) && !empty($_SESSION['regData']['phone'])) ? $_SESSION['regData']['phone'] : "";
                                    unset($_SESSION['regData']['phone']);
                                    ?>">
                        <p class="error hidden" id="phoneErrBox">Phone is required</p>
                    </div>
                </div>
                <div class="field two-field">
                    <div class="first">
                        <label for="password">Password <span class="red-star">*</span></label>
                        <input type="password" id="password" name="password"
                            value="<?php
                                    echo (isset($_SESSION['regData']['password']) && !empty($_SESSION['regData']['password'])) ? $_SESSION['regData']['password'] : "";
                                    unset($_SESSION['regData']['password']);
                                    ?>">
                        <p class="error hidden" id="passErrBox">Password is required</p>
                    </div>
                    <div class="second">
                        <label for="cpassword">Confirm Password <span class="red-star">*</span></label>
                        <input type="password" id="cpassword" name="cpassword"
                            value="<?php
                                    echo (isset($_SESSION['regData']['cpassword']) && !empty($_SESSION['regData']['cpassword'])) ? $_SESSION['regData']['cpassword'] : "";
                                    unset($_SESSION['regData']['cpassword']);
                                    ?>">
                        <p class="error hidden" id="cpassErrBox">Confrim Password is required</p>
                    </div>
                </div>
                <div class="field two-field">
                    <div class="first">
                        <label for="dob">Date of Birth <span class="red-star">*</span></label>
                        <input type="date" id="dob" name="dob"
                            value="<?php
                                    echo (isset($_SESSION['regData']['dob']) && !empty($_SESSION['regData']['dob'])) ? $_SESSION['regData']['dob'] : "";
                                    unset($_SESSION['regData']['dob']);
                                    ?>" max="<?php echo date('Y-m-d'); ?>">
                        <p class="error hidden" id="dobErrBox">Date of Birth is required</p>
                    </div>
                    <div class="second">
                        <label for="gender">Gender <span class="red-star">*</span></label>
                        <select name="gender" id="gender">
                            <option value=""
                                <?php echo (isset($_SESSION['regData']['gender']) && ($_SESSION['regData']['gender']) == "") ? "selected" : ""; ?>>Select Gender</option>
                            <option value="male"
                                <?php echo (isset($_SESSION['regData']['gender']) && ($_SESSION['regData']['gender']) == "male") ? "selected" : ""; ?>>Male</option>
                            <option value="female"
                                <?php echo (isset($_SESSION['regData']['gender']) && ($_SESSION['regData']['gender']) == "female") ? "selected" : ""; ?>>Female</option>
                        </select>
                        <p class="error hidden" id="genderErrBox">Please select a gender</p>
                    </div>
                </div>
                <div class="field">
                    <label for="weight">Weight <span class="red-star">*</span></label>
                    <input type="number" id="weight" name="weight"
                        value="<?php
                                echo (isset($_SESSION['regData']['weight']) && !empty($_SESSION['regData']['weight'])) ? $_SESSION['regData']['weight'] : "";
                                unset($_SESSION['regData']['weight']);
                                ?>">
                    <p class="error hidden" id="weightErrBox">Weight is required</p>
                </div>
                <div class="field">
                    <input class="submit-btn" type="submit" value="Register">
                </div>
                <div class="other">
                    <p>Already have an account? <a href="login.php">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>

</html>