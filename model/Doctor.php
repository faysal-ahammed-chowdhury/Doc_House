<?php
require_once "db.php";
require_once "Specialization.php";
require_once "User.php";

function getAllDoctors()
{
    $conn = initDB();
    $sql = "SELECT d.did, d.uid, d.spid, u.name AS doctor_name, s.name AS specialization_name
            FROM doctor d
            INNER JOIN user u ON d.uid = u.uid
            INNER JOIN specialization s ON d.spid = s.spid";

    $result = mysqli_query($conn, $sql);

    $doctors = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $doctor = [];
            $doctor["DID"] = $row["did"];
            $doctor["name"] = $row["doctor_name"];
            $doctor["specializationID"] = $row["spid"];
            $doctor["specialization"] = $row["specialization_name"];
            $doctor["img"] = "";

            array_push($doctors, $doctor);
        }
    }

    return $doctors;
}

function getDoctorsByName($name)
{
    $conn = initDB();
    $sql = "SELECT d.did, d.uid, d.spid, u.name AS doctor_name, s.name AS specialization_name
            FROM doctor d
            INNER JOIN user u ON d.uid = u.uid
            INNER JOIN specialization s ON d.spid = s.spid
            WHERE LOWER(u.name) LIKE LOWER(CONCAT('%', '$name', '%'))";

    $result = mysqli_query($conn, $sql);

    $doctors = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $doctor = [];
            $doctor["DID"] = $row["did"];
            $doctor["name"] = $row["doctor_name"];
            $doctor["specializationID"] = $row["spid"];
            $doctor["specialization"] = $row["specialization_name"];
            $doctor["img"] = "";

            array_push($doctors, $doctor);
        }
    }

    return $doctors;
}


function getDoctorsBySpId($spid)
{
    $conn = initDB();
    $sql = "SELECT d.did, d.uid, d.spid, u.name AS doctor_name, s.name AS specialization_name
            FROM doctor d
            INNER JOIN user u ON d.uid = u.uid
            INNER JOIN specialization s ON d.spid = s.spid
            WHERE d.spid = '$spid'";

    $result = mysqli_query($conn, $sql);

    $doctors = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $doctor = [];
            $doctor["DID"] = $row["did"];
            $doctor["name"] = $row["doctor_name"];
            $doctor["specializationID"] = $row["spid"];
            $doctor["specialization"] = $row["specialization_name"];
            $doctor["img"] = "";

            array_push($doctors, $doctor);
        }
    }

    return $doctors;
}


function getDoctorsByNameAndSpId($name, $spid)
{
    $conn = initDB();
    $sql = "SELECT d.did, d.uid, d.spid, u.name AS doctor_name, s.name AS specialization_name
            FROM doctor d
            INNER JOIN user u ON d.uid = u.uid
            INNER JOIN specialization s ON d.spid = s.spid
            WHERE LOWER(u.name) LIKE LOWER(CONCAT('%', '$name', '%'))
              AND d.spid = '$spid'";

    $result = mysqli_query($conn, $sql);

    $doctors = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $doctor = [];
            $doctor["DID"] = $row["did"];
            $doctor["name"] = $row["doctor_name"];
            $doctor["specializationID"] = $row["spid"];
            $doctor["specialization"] = $row["specialization_name"];
            $doctor["img"] = "";

            array_push($doctors, $doctor);
        }
    }

    return $doctors;
}



function getDoctorsByDId($did)
{
    $conn = initDB();
    $sql = "SELECT d.did, d.uid, d.spid, d.fee, d.bio, u.name AS doctor_name, u.email, u.phone, s.name AS specialization_name
            FROM doctor d
            INNER JOIN user u ON d.uid = u.uid
            INNER JOIN specialization s ON d.spid = s.spid
            WHERE d.did = '$did'";

    $result = mysqli_query($conn, $sql);

    $doctor = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $doctor["DID"] = $row["did"];
            $doctor["name"] = $row["doctor_name"];
            $doctor["email"] = $row["email"];
            $doctor["phone"] = $row["phone"];
            $doctor["fee"] = $row["fee"];
            $doctor["specializationID"] = $row["spid"];
            $doctor["specialization"] = $row["specialization_name"];
            $doctor["bio"] = $row["bio"];
            $doctor["img"] = "";
        }
    }

    return $doctor;
}
