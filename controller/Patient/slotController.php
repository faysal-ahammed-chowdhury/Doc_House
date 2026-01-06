<?php
include_once "../../model/Session.php";
include_once "../../model/Appointment.php";

header('Content-Type: application/json');

if (!isset($_GET['sid'])) {
    http_response_code(400);
    echo json_encode([]);
    exit();
}

$sessionExist = isSessionExistAndActive($_GET['sid']);
if (!$sessionExist) {
    http_response_code(400);
    echo json_encode([]);
    exit();
}

$singleSession = getSessionBySId($_GET['sid']);
if (!isset($singleSession['sid'])) {
    http_response_code(400);
    echo json_encode([]);
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

echo json_encode($times);
exit();
