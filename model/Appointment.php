<?php
require_once "db.php";

function getBookedAppointmentsBySId($sid)
{
    $conn = initDB();
    $sql = "SELECT aptid, sid, pid, time, status FROM appointment WHERE sid='$sid' and status='accepted'";
    $result = mysqli_query($conn, $sql);

    $allAppointment = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $singleAppointment = [];
            $singleAppointment["aptid"] = $row["aptid"];
            $singleAppointment["sid"] = $row["sid"];
            $singleAppointment["pid"] = $row["pid"];
            $singleAppointment["time"] = $row["time"];
            array_push($allAppointment, $singleAppointment);
        }
    }
    return $allAppointment;
}

function getAllAppointment()
{
    $conn = initDB();
    $sql = "SELECT a.aptid, a.sid, a.pid, a.time, a.date, a.status, 
                   d.did, u.uid AS doctor_uid, u.name AS doctor_name
            FROM appointment a
            JOIN session s ON a.sid = s.sid
            JOIN doctor d ON s.did = d.did
            JOIN user u ON d.uid = u.uid";

    $result = mysqli_query($conn, $sql);

    $allAppointment = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $singleAppointment = [];
            $singleAppointment["aptid"] = $row["aptid"];
            $singleAppointment["sid"] = $row["sid"];
            $singleAppointment["pid"] = $row["pid"];
            $singleAppointment["time"] = $row["time"];
            $singleAppointment["date"] = $row["date"];
            $singleAppointment["status"] = $row["status"];
            $singleAppointment["did"] = $row["did"];
            $singleAppointment["doctor_uid"] = $row["doctor_uid"];
            $singleAppointment["doctor_name"] = $row["doctor_name"];
            array_push($allAppointment, $singleAppointment);
        }
    }

    return $allAppointment;
}

function getAllAppointmentByPId($pid)
{
    $conn = initDB();
    $sql = "SELECT a.aptid, a.sid, a.pid, a.time, a.date, a.status, 
                   d.did, u.uid AS doctor_uid, u.name AS doctor_name
            FROM appointment a
            JOIN session s ON a.sid = s.sid
            JOIN doctor d ON s.did = d.did
            JOIN user u ON d.uid = u.uid
            WHERE a.pid = '$pid'";

    $result = mysqli_query($conn, $sql);

    $allAppointment = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $singleAppointment = [];
            $singleAppointment["aptid"] = $row["aptid"];
            $singleAppointment["sid"] = $row["sid"];
            $singleAppointment["pid"] = $row["pid"];
            $singleAppointment["time"] = $row["time"];
            $singleAppointment["date"] = $row["date"];
            $singleAppointment["status"] = $row["status"];
            $singleAppointment["did"] = $row["did"];
            $singleAppointment["doctor_uid"] = $row["doctor_uid"];
            $singleAppointment["doctor_name"] = $row["doctor_name"];
            array_push($allAppointment, $singleAppointment);
        }
    }

    return $allAppointment;
}

function getAppointmentsByDateAndStatusAndPId($date, $status, $pid)
{
    $conn = initDB();
    $sql = "SELECT a.aptid, a.sid, a.pid, a.time, a.date, a.status, 
                   d.did, u.uid AS doctor_uid, u.name AS doctor_name
            FROM appointment a
            JOIN session s ON a.sid = s.sid
            JOIN doctor d ON s.did = d.did
            JOIN user u ON d.uid = u.uid
            WHERE a.date = '$date' AND a.status = '$status' AND a.pid = '$pid'";

    $result = mysqli_query($conn, $sql);

    $allAppointment = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $singleAppointment = [];
            $singleAppointment["aptid"] = $row["aptid"];
            $singleAppointment["sid"] = $row["sid"];
            $singleAppointment["pid"] = $row["pid"];
            $singleAppointment["time"] = $row["time"];
            $singleAppointment["date"] = $row["date"];
            $singleAppointment["status"] = $row["status"];
            $singleAppointment["did"] = $row["did"];
            $singleAppointment["doctor_uid"] = $row["doctor_uid"];
            $singleAppointment["doctor_name"] = $row["doctor_name"];
            array_push($allAppointment, $singleAppointment);
        }
    }

    return $allAppointment;
}

function getAppointmentsByDateAndPId($date, $pid)
{
    $conn = initDB();
    $sql = "SELECT a.aptid, a.sid, a.pid, a.time, a.date, a.status, 
                   d.did, u.uid AS doctor_uid, u.name AS doctor_name
            FROM appointment a
            JOIN session s ON a.sid = s.sid
            JOIN doctor d ON s.did = d.did
            JOIN user u ON d.uid = u.uid
            WHERE a.date = '$date' AND a.pid = '$pid'";

    $result = mysqli_query($conn, $sql);

    $allAppointment = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $singleAppointment = [];
            $singleAppointment["aptid"] = $row["aptid"];
            $singleAppointment["sid"] = $row["sid"];
            $singleAppointment["pid"] = $row["pid"];
            $singleAppointment["time"] = $row["time"];
            $singleAppointment["date"] = $row["date"];
            $singleAppointment["status"] = $row["status"];
            $singleAppointment["did"] = $row["did"];
            $singleAppointment["doctor_uid"] = $row["doctor_uid"];
            $singleAppointment["doctor_name"] = $row["doctor_name"];
            array_push($allAppointment, $singleAppointment);
        }
    }

    return $allAppointment;
}

function getAppointmentsByStatusAndPId($status, $pid)
{
    $conn = initDB();
    $sql = "SELECT a.aptid, a.sid, a.pid, a.time, a.date, a.status, 
                   d.did, u.uid AS doctor_uid, u.name AS doctor_name
            FROM appointment a
            JOIN session s ON a.sid = s.sid
            JOIN doctor d ON s.did = d.did
            JOIN user u ON d.uid = u.uid
            WHERE a.status = '$status' AND a.pid = '$pid'";

    $result = mysqli_query($conn, $sql);

    $allAppointment = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $singleAppointment = [];
            $singleAppointment["aptid"] = $row["aptid"];
            $singleAppointment["sid"] = $row["sid"];
            $singleAppointment["pid"] = $row["pid"];
            $singleAppointment["time"] = $row["time"];
            $singleAppointment["date"] = $row["date"];
            $singleAppointment["status"] = $row["status"];
            $singleAppointment["did"] = $row["did"];
            $singleAppointment["doctor_uid"] = $row["doctor_uid"];
            $singleAppointment["doctor_name"] = $row["doctor_name"];
            array_push($allAppointment, $singleAppointment);
        }
    }

    return $allAppointment;
}
