<?php
header('Content-Type: application/json');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "../../model/Appointment.php";


if (!isset($_SESSION['user'])) {
    http_response_code(403);
    echo json_encode([
        "status" => "error",
        "message" => "User missing, try again"
    ]);
    exit();
}

if ($_SESSION['user']['role'] !== 'patient') {
    http_response_code(403);
    echo json_encode([
        "status" => "error",
        "message" => "You are not authorized to cancel this appointment"
    ]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405);
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method"
    ]);
    exit();
}


if (!isset($_POST['aptid'])) {
    http_response_code(400);
    echo json_encode([]);
    exit();
}

$singleAppointment = getAppointmentByAptId($_POST['aptid']);

if (!isset($singleAppointment['aptid'])) {
    http_response_code(404);
    echo json_encode([
        "status" => "error",
        "message" => "Appointment not found",
    ]);
    exit();
}

if ($singleAppointment['pid'] !== $_SESSION['user']['pid']) {
    http_response_code(403);
    echo json_encode([
        "status" => "error",
        "message" => "You are not authorized to cancel this appointment",
    ]);
    exit();
}

if ($singleAppointment['status'] === "accepted") {
    http_response_code(400);
    echo json_encode([
        "status" => "warning",
        "message" => "Appointment is already Accepted, you can not cancel it",
    ]);
    exit();
}


if (updateAppointmentStatus($_POST['aptid'], 'cancelled')) {
    http_response_code(200);
    echo json_encode([
        "status" => "success",
        "message" => "Appointment cancelled successfully"
    ]);
    exit();
} else {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Failed to cancel appointment. Please try again later"
    ]);
    exit();
}
