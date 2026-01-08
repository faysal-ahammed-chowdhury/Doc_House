<?php require_once "../../middleware/guestMiddleware.php";
require_once "../../model/User.php";
require_once "../../model/Patient.php";

$emailRegex = '/^[a-zA-Z0-9._]+@[a-zA-Z0-9.-]+\.[a-zA-Z]+$/';
$phoneRegex = '/^[0-9]{11}$/';

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
$weight = trim($_POST['weight']);

$_SESSION['regData'] = [
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'password' => $password,
    'cpassword' => $cpassword,
    'dob' => $dob,
    'gender' => $gender,
    'weight' => $weight,
];

if (
    empty($name) || empty($email) || empty($phone) || empty($password) || empty($cpassword)
    || empty($dob) || empty($gender) || empty($weight)
) {
    $_SESSION['regErr'] = "Please fillup all the fields";
    header("Location: /Doc_House/view/Auth/register.php");
    exit();
}

if (!preg_match($emailRegex, $email)) {
    $_SESSION['regErr'] = "Enter a valid Email";
    header("Location: /Doc_House/view/Auth/register.php");
    exit();
}

if (!preg_match($phoneRegex, $phone)) {
    $_SESSION['regErr'] = "Enter a valid Phone Number";
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

if ($dob > date('Y-m-d')) {
    $_SESSION['regErr'] = "Please select a valid Birth Date";
    header("Location: /Doc_House/view/Auth/register.php");
    exit();
}

if (!is_numeric($weight)) {
    $_SESSION['regErr'] = "Please enter a valid Weight";
    header("Location: /Doc_House/view/Auth/register.php");
    exit();
}

$weight = (int)$weight;
if ($weight < 0) {
    $_SESSION['regErr'] = "Please enter a valid Weight";
    header("Location: /Doc_House/view/Auth/register.php");
    exit();
}

// work with model here
echo $email;
$tmpUId = getUIdByEmail($email);
if (isset($tmpUId)) {
    $_SESSION['regErr'] = "Email is already registered";
    header("Location: /Doc_House/view/Auth/register.php");
    exit();
}

if (!addUser($name, $email, $password, $phone, 'patient', $dob)) {
    $_SESSION['regErr'] = "Something went wrong try again";
    header("Location: /Doc_House/view/Auth/register.php");
    exit();
}
$tmpUId = getUIdByEmail($email);
addPatient($tmpUId, $gender, $weight);

$_SESSION['user'] = getUserByEmail($email);
unset($_SESSION['regErr']);
unset($_SESSION['regData']);
header("Location: /Doc_House/view/Auth/register.php");
