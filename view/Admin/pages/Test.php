<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['doc_email'] ?? '');
    $name  = trim($_POST['doc_name'] ?? '');
    $pass  = trim($_POST['doc_pass'] ?? '');
    $specialization = trim($_POST['doc_specialization'] ?? '');
    $fee   = trim($_POST['doc_fee'] ?? '');
    $phone = trim($_POST['doc_phone'] ?? '');
    $bio   = trim($_POST['doc_bio'] ?? '');

    $conn = mysqli_connect("localhost", "root", "", "doc_house");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO newTest (name, email, password, phone, role, dob)
            VALUES ('$name', '$email', '$pass', '$phone', 'admin', 'two')";

    if (mysqli_query($conn, $sql)) {
        echo "Success";
    } else {
        echo "SQL Error: " . mysqli_error($conn);
    }
}
