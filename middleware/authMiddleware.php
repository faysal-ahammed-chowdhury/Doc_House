<?php
session_start();

const ADMIN = 'admin';
const PATIENT = 'patient';
const DOCTOR = 'doctor';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    if ($user['role'] == ADMIN) {
        header("Location: /Doc_House/view/Admin/Dashboard.php");
        exit();
    } else if ($user['role'] == PATIENT) {
        header("Location: /Doc_House/view/Patient/home.php");
        exit();
    } else if ($user['role'] == DOCTOR) {
        header("Location: /Doc_House/view/Patient/home.php"); // will fix later
        exit();
    }
}
