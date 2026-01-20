<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../../middleware/authMiddleware.php";
require_once "../../middleware/patientMiddleware.php";
include_once "../../model/Patient/User.php";
include_once "../../model/Patient/Patient.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['updateProfileErr'] = "Something is wrong! Try again.";
    header("Location: /Doc_House/view/Patient/profile.php");
    exit();
}


if (
    !isset($_POST['fullname']) || !isset($_POST['email']) || !isset($_POST['phone'])
    || !isset($_POST['password']) || !isset($_POST['cpassword'])
    || !isset($_POST['dob']) || !isset($_POST['gender']) || !isset($_POST['weight'])
) {
    $_SESSION['updateProfileErr'] = "Something is wrong! Try again.";
    header("Location: /Doc_House/view/Patient/profile.php");
    exit();
}

$name = trim($_POST['fullname']);
$phone = trim($_POST['phone']);
$password = trim($_POST['password']);
$cpassword = trim($_POST['cpassword']);
$dob = trim($_POST['dob']);
$gender = trim($_POST['gender']);
$weight = trim($_POST['weight']);


if (
    empty($name) || empty($phone) || empty($dob) || empty($gender) || empty($weight)
) {
    $_SESSION['updateProfileErr'] = "Can't be empty!";
    header("Location: /Doc_House/view/Patient/profile.php");
    exit();
}

if (strlen($password) > 0) {
    if (strlen($password) < 8) {
        $_SESSION['updateProfileErr'] = "Password must be at least 8 characters";
        header("Location: /Doc_House/view/Patient/profile.php");
        exit();
    }

    if ($password !== $cpassword) {
        $_SESSION['updateProfileErr'] = "Passwords do not match!";
        header("Location: /Doc_House/view/Patient/profile.php");
        exit();
    }
}

if (!($gender == "male" || $gender == "female")) {
    $_SESSION['updateProfileErr'] = "Please select a gender";
    header("Location: /Doc_House/view/Patient/profile.php");
    exit();
}

if (strlen($password) == 0) {
    $password = null;
}

// work with model here
if (updateUserByUid($_SESSION['user']['uid'], $name, $phone, $dob, $password) && updatePatientByPid($_SESSION['user']['pid'], $weight, $gender)) {
    unset($_SESSION['updateProfileErr']);
    $_SESSION['updateProfileSuccess'] = "Profile updated successfully!";
    $_SESSION['user']['name'] = $name;
    header("Location: /Doc_House/view/Patient/profile.php");
} else {
    $_SESSION['updateProfileErr'] = "Something is wrong";
    header("Location: /Doc_House/view/Patient/profile.php");
    exit();
}
