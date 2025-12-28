<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['loginErr'] = "Something is wrong! Try again.";
    header("Location: login.php");
    exit();
}

const ADMIN = 'admin';
const PATIENT = 'patient';
const DOCTOR = 'doctor';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    if ($user['role'] == ADMIN) {
        header("Location: ../Admin/Dashboard.php");
        exit();
    } else if ($user['role'] == PATIENT) {
        header("Location: ../patient/home.php");
        exit();
    } else if ($user['role'] == DOCTOR) {
        header("Location: ../patient/home.php"); // will fix later
        exit();
    } else {
        $_SESSION['loginErr'] = "Something is wrong! Try again.";
        header("Location: login.php");
        exit();
    }
}

if (!isset($_POST['email']) || !isset($_POST['password'])) {
    $_SESSION['loginErr'] = "Something is wrong! Try again.";
    header("Location: login.php");
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];

$_SESSION['old_email'] = $email;

if (empty(trim($email)) || empty(trim($password))) {
    $_SESSION['loginErr'] = "Please provide email & password";
    header("Location: login.php");
    exit();
}

// work with database
echo "All Done";
unset($_SESSION['old_email']);
