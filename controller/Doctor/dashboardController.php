<?php
require_once __DIR__ . '/../../model/Doctor/dashboard_model.php';

if (isset($_SESSION['user']['did'])) {
    $doctor_id = $_SESSION['user']['did'];
} elseif (isset($_SESSION['did'])) {
    $doctor_id = $_SESSION['did'];
} else {
    $doctor_id = 11;
}

$stats = getDashboardStats($doctor_id);
$recentAppointments = getRecentAppointments($doctor_id, 3);
?>