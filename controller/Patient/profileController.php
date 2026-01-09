<?php
require_once "../../middleware/authMiddleware.php";
require_once "../../middleware/patientMiddleware.php";
include_once "../../model/Patient/Patient.php";

$curUser = getPatientByPId($_SESSION['user']['pid']);

if (!isset($curUser['pid'])) {
    echo "Something is wrong\n";
    exit();
}
