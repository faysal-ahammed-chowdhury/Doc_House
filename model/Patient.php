<?php
require_once "db.php";

function getPIdByUId($uid)
{
    $conn = initDB();
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
    $sql = "SELECT p.pid, p.uid, p.gender, p.dob, 
                   u.name, u.email, u.phone
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
            $patient["dob"] = $row["dob"];
        }
    }

    return $patient;
}

function updatePatientByPid($pid, $dob, $gender)
{
    $conn = initDB();

    $sqlPatient = "
        UPDATE patient 
        SET dob='$dob', gender='$gender' 
        WHERE pid='$pid'
    ";

    return mysqli_query($conn, $sqlPatient);
}
