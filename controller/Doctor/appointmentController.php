<?php
require_once  '../../model/Doctor/appointment_model.php';

$doctor_id = $_SESSION['user']['did'] ?? 0;

$filterDate = isset($_GET['date']) ? $_GET['date'] : '';
$filterStatus = isset($_GET['status']) ? $_GET['status'] : '';

$appointmentList = getAppointmentsByDoctor($doctor_id, $filterDate, $filterStatus);
?>