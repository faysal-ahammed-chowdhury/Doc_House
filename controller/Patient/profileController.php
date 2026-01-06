<?php
include_once "../../model/Patient.php";

$curUser = getPatientByPId($_SESSION['user']['pid']);

if (!isset($curUser['pid'])) {
    echo "Something is wrong\n";
    exit();
}
