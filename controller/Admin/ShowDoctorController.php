<?php
    require_once "C:\\xampp\htdocs\Doc_House\middleware\authMiddleware.php";
    require_once "C:\\xampp\htdocs\Doc_House\middleware\adminMiddleware.php";
    include_once "../../model/Doctor.php";

    function showAllDoctor(){
        $doctor = getAllDoctors();
        var_dump($doctor);
        return $doctor;
    }

    // showAllDoctor();

    $data = showAllDoctor();
?>