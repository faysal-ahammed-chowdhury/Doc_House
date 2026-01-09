<?php
header('Content-Type: application/json');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "../../model/Patient/Appointment.php";
require_once "../../model/Patient/Session.php";


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
        "message" => "You are not authorized to book appointment"
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

if (!isset($_POST['sid']) || !isset($_POST['timeSlot'])) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Session ID and Time Slot missing"
    ]);
    exit();
}

$sid = $_POST['sid'];
$timeSlot = $_POST['timeSlot'];

$singleSession = getSessionBySId($sid);
if (!isset($singleSession['sid'])) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Session not found"
    ]);
    exit();
}

$sessionExist = isSessionExistAndActive($sid);
if (!$sessionExist) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Session is not Open"
    ]);
    exit();
}


if (isOldSession($sid)) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Session Expired"
    ]);
    exit();
}

$allAppointmentsOfThisSession = getBookedAppointmentsBySId($sid);

$alreadyBooked = false;
foreach ($allAppointmentsOfThisSession as $singleAppointmentsOfThisSession) {
    if ($singleAppointmentsOfThisSession['time'] == $timeSlot) {
        $alreadyBooked = true;
    }
}

if ($alreadyBooked) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "This session has already been booked"
    ]);
    exit();
}

$startTime = $singleSession['start_time'];
$endTime = $singleSession['end_time'];
$interval = $singleSession['slot_duration'];
$current = strtotime($startTime);
$end = strtotime($endTime);
$times = [];

$validTime = false;
while ($current < $end) {
    if ($timeSlot == date("H:i:s", $current)) {
        $validTime = true;
    }

    $current = strtotime("+{$interval} minutes", $current);
}

if (!$validTime) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Invalid Time Selected"
    ]);
    exit();
}

$tmp = getAppointmentBySIdPIdAndNotCancelled($sid, $_SESSION['user']['pid']);
if (count($tmp) > 0) {
    http_response_code(400);
    echo json_encode([
        "status" => "warning",
        "message" => "You have already request for an appointment",
    ]);
    exit();
}

if (addAppointment($sid, $_SESSION['user']['pid'], $timeSlot, 'pending')) {
    http_response_code(201);
    echo json_encode([
        "status" => "success",
        "message" => "Appointment is pending, wait for approval"
    ]);
    exit();
}

http_response_code(500);
echo json_encode([
    "status" => "error",
    "message" => "Something went wrong"
]);
exit();
