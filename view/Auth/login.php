<?php
session_start();

const ADMIN = 'admin';
const PATIENT = 'patient';
const DOCTOR = 'doctor';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    if ($user['role'] == ADMIN) {
        header("Location: ../Admin/Dashboard.php");
        exit();
    } else if ($user['role'] == PATIENT) {
        header("Location: ../Patient/home.php");
        exit();
    } else if ($user['role'] == DOCTOR) {
        header("Location: ../Patient/home.php"); // will fix later
        exit();
    } else {
        $_SESSION['loginErr'] = "Something is wrong! Try again.";
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            <form action="/Doc_House/controller/Auth/loginController.php" method="POST">
                <h2 class="heading">Welcome Back</h2>
                <p class="light-para">
                    Please enter your details to sign in.
                </p>
                <div></div>
                <div
                    <?php echo (isset($_SESSION['loginErr']) && !empty($_SESSION['loginErr'])) ? 'style="display: block;"' : 'style="display: none;"'; ?>
                    class="error-box">
                    <span class="error-text"><?php echo $_SESSION['loginErr'] ?></span>
                    <?php unset($_SESSION['loginErr']); ?>
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                        value="<?php
                                echo (isset($_SESSION['old_email']) && !empty($_SESSION['old_email'])) ? $_SESSION['old_email'] : "";
                                unset($_SESSION['old_email']);
                                ?>">
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                </div>
                <div class="field">
                    <input class="submit-btn" type="submit" value="Login"">
                </div>
                <div class=" other">
                    <p><a href="">Forgot Password?</a></p>
                    <p>Don't have an account? <a href="">Create account</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>