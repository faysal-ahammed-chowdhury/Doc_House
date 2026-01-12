<?php
session_start();
require_once __DIR__ . '/../../model/Doctor/appointment_model.php';

$doctor_id = 11; 

$filterDate = isset($_GET['date']) ? $_GET['date'] : '';
$filterStatus = isset($_GET['status']) ? $_GET['status'] : '';

$appointmentList = getAppointmentsByDoctor($doctor_id, $filterDate, $filterStatus);
?>