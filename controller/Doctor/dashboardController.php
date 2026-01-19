<?php
require_once "../../model/Doctor/dashboard_model.php";

$doctor_id = $_SESSION['user']['did'] ?? 0;

$stats = getDashboardStats($doctor_id);
$recentAppointments = getRecentAppointments($doctor_id);
?>