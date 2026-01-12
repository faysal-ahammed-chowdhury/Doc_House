<?php
    include_once "../../model/Doctor.php";

    function showAllDoctor(){
        $doctor = getAllDoctors();
        var_dump($doctor);
        return $doctor;
    }

    // showAllDoctor();

    $data = showAllDoctor();
?>