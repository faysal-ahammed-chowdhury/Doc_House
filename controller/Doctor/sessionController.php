<?php
require_once __DIR__ . '/../../model/Doctor/session_model.php';

if (isset($_SESSION['user']['did'])) {
    $doctor_id = $_SESSION['user']['did'];
} elseif (isset($_SESSION['did'])) {
    $doctor_id = $_SESSION['did'];
} else {
    $doctor_id = 11;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_session'])) {
    $date = $_POST['date'];
    $start = $_POST['start_time'];
    $end = $_POST['end_time'];
    $duration = $_POST['duration'];

    if (addSession($doctor_id, $date, $start, $end, $duration)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

if (isset($_GET['delete_id'])) {
    deleteSession($_GET['delete_id']);
    header("Location: mySession.php");
    exit();
}

$upcomingSessions = getUpcomingSessions($doctor_id);
$pastSessions = getPastSessions($doctor_id);
?>