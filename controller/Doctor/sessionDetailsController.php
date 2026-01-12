<?php
require_once __DIR__ . '/../../model/Doctor/session_model.php';

if (!isset($_GET['sid'])) {
    header("Location: mySession.php");
    exit();
}

$sid = $_GET['sid'];
$session = getSessionById($sid);
$appointments = getAppointmentsBySession($sid);

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    deleteSession($sid);
    header("Location: mySession.php");
    exit();
}
?>