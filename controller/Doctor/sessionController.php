<?php
require_once "../../model/Doctor/session_model.php";

$doctor_id = $_SESSION['user']['did'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_session'])) {
    $date = $_POST['date'];
    $start = $_POST['start_time'];
    $end = $_POST['end_time'];
    $duration = $_POST['duration'];

    addSession($doctor_id, $date, $start, $end, $duration);
}

if (isset($_GET['delete_id'])) {
    deleteSession($_GET['delete_id']);
    header("Location: mySessions.php");
    exit();
}

$upcomingSessions = getUpcomingSessions($doctor_id);
$pastSessions = getPastSessions($doctor_id);
?>