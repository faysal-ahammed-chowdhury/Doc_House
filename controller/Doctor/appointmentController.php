<?php
require_once __DIR__ . '/../../model/Doctor/appointment_model.php';

if (isset($_SESSION['user']['did'])) {
    $doctor_id = $_SESSION['user']['did'];
} elseif (isset($_SESSION['did'])) {
    $doctor_id = $_SESSION['did'];
} else {
    $doctor_id = 11;
}

$filterDate = isset($_GET['date']) ? $_GET['date'] : '';
$filterStatus = isset($_GET['status']) ? $_GET['status'] : '';

$appointmentList = getAppointmentsByDoctor($doctor_id, $filterDate, $filterStatus);
?>