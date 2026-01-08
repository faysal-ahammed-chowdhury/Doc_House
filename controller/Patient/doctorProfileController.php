<?php
require_once "../../middleware/authMiddleware.php";
require_once "../../middleware/patientMiddleware.php";
require_once "../../model/Doctor.php";
require_once "../../model/Session.php";

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    echo "Something went wrong";
    exit;
}

if (!isset($_GET['DID'])) {
    header("Location: /Doc_House/view/Auth/login.php");
    exit;
}

$doctor = getDoctorsByDId($_GET['DID']);
if (!isset($doctor['DID'])) {
    header("Location: /Doc_House/view/Auth/login.php");
    exit;
}

$allSessions = getAllUpcomingSessionByDId($_GET['DID']);

function sessionTime($session)
{
    $start = DateTime::createFromFormat('H:i:s', $session['start_time']);
    $end   = DateTime::createFromFormat('H:i:s', $session['end_time']);
    $date = DateTime::createFromFormat('Y-m-d', $session['date']);
    return $start->format('h:iA') . '-' . $end->format('h:iA') . ', ' . $date->format('d F, Y');
};
