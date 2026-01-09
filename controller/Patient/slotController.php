<?php
header('Content-Type: application/json');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "../../model/Session.php";
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
        "message" => "You are not authorized to get slots"
    ]);
    exit();
}

if (!isset($_GET['sid'])) {
    http_response_code(400);
    echo json_encode([
        "status" => "warning",
        "message" => "Provide a Session ID"
    ]);
    exit();
}

$singleSession = getSessionBySId($_GET['sid']);
if (!isset($singleSession['sid'])) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Session not found"
    ]);
    exit();
}

$sessionExist = isSessionExistAndActive($_GET['sid']);
if (!$sessionExist) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Session is not Open"
    ]);
    exit();
}

if (isOldSession($_GET['sid'])) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Session Expired"
    ]);
    exit();
}

$allAppointmentsOfThisSession = getBookedAppointmentsBySId($_GET['sid']);
$bookedTimes = [];

foreach ($allAppointmentsOfThisSession as $singleAppointmentsOfThisSession) {
    $bookedTimes[$singleAppointmentsOfThisSession['time']] = true;
}

$startTime = $singleSession['start_time'];
$endTime = $singleSession['end_time'];
$interval = $singleSession['slot_duration'];
$current = strtotime($startTime);
$end = strtotime($endTime);
$times = [];

while ($current < $end) {
    if (!isset($bookedTimes[date("H:i:s", $current)])) {
        $times[] = date("H:i:s", $current);
    }

    $current = strtotime("+{$interval} minutes", $current);
}

http_response_code(200);
echo json_encode([
    "status" => "success",
    "times" => $times
]);
exit();
