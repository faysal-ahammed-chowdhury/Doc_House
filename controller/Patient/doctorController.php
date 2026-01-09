<?php
// require_once "../../middleware/authMiddleware.php";
// require_once "../../middleware/patientMiddleware.php";
require_once "../../model/Patient/Doctor.php";

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    echo "Something went wrong";
    exit;
}

$docName = isset($_GET['doc_name']) ? $_GET['doc_name'] : '';
$docSpecialityID = isset($_GET['specialization']) ? $_GET['specialization'] : '';

$doctorList = [];

if (!empty($docName) && !empty($docSpecialityID)) {
    $doctorList = getDoctorsByNameAndSpId($docName, $docSpecialityID);
} else if (!empty($docName)) {
    $doctorList = getDoctorsByName($docName);
} else if (!empty($docSpecialityID)) {
    $doctorList = getDoctorsBySpId($docSpecialityID);
} else {

    $doctorList = getAllDoctors();

    // $doctor1 = [
    //     'DID' => '105',
    //     'name' => 'Forman Ahammed Chowdhury',
    //     'specialization' => 'Neurologist',
    //     'specializationID' => '1',
    //     'img' => '',
    // ];

    // $doctor2 = [
    //     'DID' => '101',
    //     'name' => 'Farzana Akter',
    //     'specialization' => 'Dentist',
    //     'specializationID' => '2',
    //     'img' => '',
    // ];

    // $doctor3 = [
    //     'DID' => '102',
    //     'name' => 'Abdul Rahaman Fardin',
    //     'specialization' => 'Jack of all trades',
    //     'specializationID' => '3',
    //     'img' => '',
    // ];

    // $doctor4 = [
    //     'DID' => '103',
    //     'name' => 'Chowdhury Farhan',
    //     'specialization' => 'Business Doctor',
    //     'specializationID' => '3',
    //     'img' => '',
    // ];

    // $doctor5 = [
    //     'DID' => '104',
    //     'name' => 'Rafi Alam',
    //     'specialization' => 'Class 8',
    //     'specializationID' => '3',
    //     'img' => '',
    // ];

    // $doctorList = [$doctor1, $doctor2, $doctor3, $doctor4, $doctor5];
}
