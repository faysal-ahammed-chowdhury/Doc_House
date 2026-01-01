<?php require_once "../../middleware/authMiddleware.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['forgotPassErr'] = "Something is wrong! Try again.";
    header("Location: /Doc_House/view/Auth/forgot_password.php");
    exit();
}

if (
    !isset($_POST['email']) || !isset($_POST['dob'])
    || !isset($_POST['new_password']) || !isset($_POST['cnew_password'])
) {
    $_SESSION['forgotPassErr'] = "Something is wrong! Try again.";
    header("Location: /Doc_House/view/Auth/forgot_password.php");
    exit();
}

$email = trim($_POST['email']);
$dob = trim($_POST['dob']);
$password = trim($_POST['new_password']);
$cpassword = trim($_POST['cnew_password']);

$_SESSION['forgotPassData'] = [
    'email' => $email,
    'dob' => $dob,
    'new_password' => $password,
    'cnew_password' => $cpassword,
];

if (empty($email) || empty($password) || empty($cpassword) ||  empty($dob)) {
    $_SESSION['forgotPassErr'] = "Please fillup all the fields";
    header("Location: /Doc_House/view/Auth/forgot_password.php");
    exit();
}

// check email and dob valid or not through model

if (strlen($password) < 8) {
    $_SESSION['forgotPassErr'] = "Password must be at least 8 characters";
    header("Location: /Doc_House/view/Auth/forgot_password.php");
    exit();
}

if ($password !== $cpassword) {
    $_SESSION['forgotPassErr'] = "Passwords did not mathced";
    header("Location: /Doc_House/view/Auth/forgot_password.php");
    exit();
}

// update new password through model

unset($_SESSION['forgotPassErr']);
unset($_SESSION['forgotPassData']);
$_SESSION['forgotPassSuccess'] = "Password Updated! Please Login";
header("Location: /Doc_House/view/Auth/forgot_password.php");
