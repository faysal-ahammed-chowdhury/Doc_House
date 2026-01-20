<?php
require_once "../../model/Doctor/session_model.php";

if (!isset($_GET['sid'])) {
    header("Location: mySessions.php");
    exit();
}

$sid = $_GET['sid'];
$session = getSessionById($sid);
$appointments = getAppointmentsBySession($sid);
$booked = getBookedTimesBySession($sid);

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    deleteSession($sid);
    header("Location: mySessions.php");
    exit();
}
?>