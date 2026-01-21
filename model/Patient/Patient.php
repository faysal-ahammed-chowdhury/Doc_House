<?php
require_once "db.php";

function getPIdByUId($uid)
{
    $conn = initDB();
    $uid = mysqli_real_escape_string($conn, $uid);

    $sql = "SELECT pid FROM patient WHERE uid='$uid'";
    $result = mysqli_query($conn, $sql);

    $pid = "";
    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $pid = $row["pid"];
        }
    }
    return $pid;
}

function getPatientByPId($pid)
{
    $conn = initDB();
    $pid = mysqli_real_escape_string($conn, $pid);

    $sql = "SELECT p.pid, p.uid, p.gender, p.weight, u.dob, 
                   u.name, u.email, u.phone, u.img
            FROM patient p
            INNER JOIN user u ON p.uid = u.uid
            WHERE p.pid = '$pid'";

    $result = mysqli_query($conn, $sql);

    $patient = [];
    if (mysqli_num_rows($result) === 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $patient["pid"] = $row["pid"];
            $patient["uid"] = $row["uid"];
            $patient["name"] = $row["name"];
            $patient["email"] = $row["email"];
            $patient["phone"] = $row["phone"];
            $patient["gender"] = $row["gender"];
            $patient["weight"] = $row["weight"];
            $patient["dob"] = $row["dob"];
            $patient["img"] = $row["img"];
        }
    }

    return $patient;
}

function updatePatientByPid($pid, $weight, $gender)
{
    $conn = initDB();
    $pid = mysqli_real_escape_string($conn, $pid);
    $weight = mysqli_real_escape_string($conn, $weight);
    $gender = mysqli_real_escape_string($conn, $gender);

    $sqlPatient = "
        UPDATE patient 
        SET weight='$weight', gender='$gender' 
        WHERE pid='$pid'
    ";

    return mysqli_query($conn, $sqlPatient);
}


function addPatient($uid, $gender, $weight)
{
    $conn = initDB();
    $uid = mysqli_real_escape_string($conn, $uid);
    $gender = mysqli_real_escape_string($conn, $gender);
    $weight = mysqli_real_escape_string($conn, $weight);
    $sql = "INSERT INTO patient (uid, gender, weight)
            VALUES ('$uid', '$gender', '$weight')";

    if (mysqli_query($conn, $sql)) return true;
    else return false;
}
