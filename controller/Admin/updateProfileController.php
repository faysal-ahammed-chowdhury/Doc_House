<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "C:\\xampp\htdocs\Doc_House\middleware\authMiddleware.php";
require_once "C:\\xampp\htdocs\Doc_House\middleware\adminMiddleware.php";
require_once 'C:\\xampp\htdocs\Doc_House\model\Admin\\UserModel.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['updateProfileErr'] = "Something is wrong! Try again.";
    header("Location: /Doc_House/view/Admin/pages/profile.php");
    exit();
}


if (
    !isset($_POST['fullname']) || !isset($_POST['email']) || !isset($_POST['phone'])
    || !isset($_POST['password']) || !isset($_POST['cpassword'])
    || !isset($_POST['dob'])
) {
    $_SESSION['updateProfileErr'] = "Something is wrong! Try again.";
    header("Location: /Doc_House/view/Admin/pages/profile.php");
    exit();
}

$name = trim($_POST['fullname']);
$phone = trim($_POST['phone']);
$password = trim($_POST['password']);
$cpassword = trim($_POST['cpassword']);
$dob = trim($_POST['dob']);


if (
    empty($name) || empty($phone) || empty($dob)
) {
    $_SESSION['updateProfileErr'] = "Can't be empty!";
    header("Location: /Doc_House/view/Admin/pages/profile.php");
    exit();
}

if (strlen($password) > 0) {
    if (strlen($password) < 8) {
        $_SESSION['updateProfileErr'] = "Password must be at least 8 characters";
        header("Location: /Doc_House/view/Admin/pages/profile.php");
        exit();
    }

    if ($password !== $cpassword) {
        $_SESSION['updateProfileErr'] = "Passwords do not match!";
        header("Location: /Doc_House/view/Admin/pages/profile.php");
        exit();
    }
}

if (strlen($password) == 0) {
    $password = null;
}

if ($dob > date('Y-m-d')) {
    $_SESSION['updateProfileErr'] = "Please select a valid Birth Date";
    header("Location: /Doc_House/view/Admin/pages/profile.php");
    exit();
}

// work with model here
if (updateUserByUid($_SESSION['user']['uid'], $name, $phone, $dob, md5($password))) {
    unset($_SESSION['updateProfileErr']);
    $_SESSION['updateProfileSuccess'] = "Profile updated successfully!";
    $_SESSION['user']['name'] = $name;
    header("Location: /Doc_House/view/Admin/pages/profile.php");
} else {
    $_SESSION['updateProfileErr'] = "Something is wrong";
    header("Location: /Doc_House/view/Admin/pages/profile.php");
    exit();
}
