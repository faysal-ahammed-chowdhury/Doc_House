<?php
require_once "../Helper/Auth/authChecker.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['regErr'] = "Something is wrong! Try again.";
    header("Location: /Doc_House/view/Auth/register.php");
    exit();
}


if (
    !isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['phone'])
    || !isset($_POST['password']) || !isset($_POST['cpassword'])
    || !isset($_POST['dob']) || !isset($_POST['gender'])
) {
    $_SESSION['regErr'] = "Something is wrong! Try again.";
    header("Location: /Doc_House/view/Auth/register.php");
    exit();
}

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$password = trim($_POST['password']);
$cpassword = trim($_POST['cpassword']);
$dob = trim($_POST['dob']);
$gender = trim($_POST['gender']);

$_SESSION['regData'] = [
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'password' => $password,
    'cpassword' => $cpassword,
    'dob' => $dob,
    'gender' => $gender,
];

if (
    empty($name) || empty($email) || empty($phone) || empty($password) || empty($cpassword)
    || empty($dob) || empty($gender)
) {
    $_SESSION['regErr'] = "Please fillup all the fields";
    header("Location: /Doc_House/view/Auth/register.php");
    exit();
}

if (strlen($password) < 8) {
    $_SESSION['regErr'] = "Password must be at least 8 characters";
    header("Location: /Doc_House/view/Auth/register.php");
    exit();
}

if ($password !== $cpassword) {
    $_SESSION['regErr'] = "Passwords did not mathced";
    header("Location: /Doc_House/view/Auth/register.php");
    exit();
}

if (!($gender == "male" || $gender == "female")) {
    $_SESSION['regErr'] = "Please select a gender";
    header("Location: /Doc_House/view/Auth/register.php");
    exit();
}

// work with dob here

// work with model here
echo "All Done";
unset($_SESSION['regErr']);
unset($_SESSION['regData']);
