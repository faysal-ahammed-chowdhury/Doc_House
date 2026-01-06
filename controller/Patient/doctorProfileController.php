<?php
require_once "../../model/Doctor.php";

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    echo "Something went wrong";
    exit;
}

if (!isset($_GET['DID'])) {
    header("Location: /Doc_House/view/Auth/login.php");
    exit;
}

$doctor = getDoctorsByDId($_GET['DID']);
if (!isset($doctor['DID'])) {
    header("Location: /Doc_House/view/Auth/login.php");
    exit;
}
