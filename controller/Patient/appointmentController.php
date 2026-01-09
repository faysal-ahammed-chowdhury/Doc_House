<?php
require_once "../../middleware/authMiddleware.php";
require_once "../../middleware/patientMiddleware.php";
require_once "../../model/Patient/Appointment.php";

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    echo "Something went wrong";
    exit;
}

$filterDate = isset($_GET['filter_date']) ? $_GET['filter_date'] : '';
$filterStatus = isset($_GET['status']) ? $_GET['status'] : '';

$appointmentList = [];

if (!empty($filterDate) && !empty($filterStatus)) {
    $appointmentList = getAppointmentsByDateAndStatusAndPId($filterDate, $filterStatus, $_SESSION['user']['pid']);
} else if (!empty($filterDate)) {
    $appointmentList = getAppointmentsByDateAndPId($filterDate, $_SESSION['user']['pid']);
} else if (!empty($filterStatus)) {
    $appointmentList = getAppointmentsByStatusAndPId($filterStatus, $_SESSION['user']['pid']);
} else {
    $appointmentList = getAllAppointmentByPId($_SESSION['user']['pid']);
}
