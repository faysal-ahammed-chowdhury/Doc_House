<?php require_once "../../middleware/guestMiddleware.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['loginErr'] = "Something is wrong! Try again.";
    header("Location: /Doc_House/view/Auth/login.php");
    exit();
}


if (!isset($_POST['email']) || !isset($_POST['password'])) {
    $_SESSION['loginErr'] = "Something is wrong! Try again.";
    header("Location: /Doc_House/view/Auth/login.php");
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];

$_SESSION['old_email'] = $email;

if (empty(trim($email)) || empty(trim($password))) {
    $_SESSION['loginErr'] = "Please provide email & password";
    header("Location: /Doc_House/view/Auth/login.php");
    exit();
}

// work with model here
// patient dummy login approval
$_SESSION['user'] = [
    'role' => 'patient',
    'name' => "Faysal Ahammed",
    'email' => $email,
    'pid' => '101',
];
unset($_SESSION['old_email']);
unset($_SESSION['loginErr']);
header("Location: ../../view/Auth/login.php");
