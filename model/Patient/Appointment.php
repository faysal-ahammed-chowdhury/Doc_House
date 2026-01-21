<?php
require_once "db.php";

function addAppointment($sid, $pid, $timeSlot, $status)
{
    $conn = initDB();
    $sid = mysqli_real_escape_string($conn, $sid);
    $pid = mysqli_real_escape_string($conn, $pid);
    $timeSlot = mysqli_real_escape_string($conn, $timeSlot);
    $status = mysqli_real_escape_string($conn, $status);

    $sql = "INSERT INTO appointment (sid, pid, time, status)
            VALUES ('$sid', '$pid', '$timeSlot', '$status')";

    if (mysqli_query($conn, $sql)) return true;
    else return false;
}


function getAppointmentByAptId($aptid)
{
    $conn = initDB();
    $aptid = mysqli_real_escape_string($conn, $aptid);
    $sql = "SELECT aptid, sid, pid, time, status FROM appointment 
            WHERE aptid='$aptid'";

    $result = mysqli_query($conn, $sql);

    $singleAppointment = [];
    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $singleAppointment["aptid"] = $row["aptid"];
            $singleAppointment["sid"] = $row["sid"];
            $singleAppointment["pid"] = $row["pid"];
            $singleAppointment["time"] = $row["time"];
            $singleAppointment["status"] = $row["status"];
        }
    }

    return $singleAppointment;
}

function getBookedAppointmentsBySId($sid)
{
    $conn = initDB();
    $sid = mysqli_real_escape_string($conn, $sid);
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
    $sql = "SELECT a.aptid, a.sid, a.pid, a.time, s.date, a.status, 
                   d.did, u.uid AS doctor_uid, u.name AS doctor_name
            FROM appointment a
            JOIN session s ON a.sid = s.sid
            JOIN doctor d ON s.did = d.did
            JOIN user u ON d.uid = u.uid
            ORDER BY s.date DESC, a.time ASC";

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
    $pid = mysqli_real_escape_string($conn, $pid);
    $sql = "SELECT a.aptid, a.sid, a.pid, a.time, s.date, a.status, 
                   d.did, u.uid AS doctor_uid, u.name AS doctor_name
            FROM appointment a
            JOIN session s ON a.sid = s.sid
            JOIN doctor d ON s.did = d.did
            JOIN user u ON d.uid = u.uid
            WHERE a.pid = '$pid'
            ORDER BY s.date DESC, a.time ASC";

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
    $date = mysqli_real_escape_string($conn, $date);
    $status = mysqli_real_escape_string($conn, $status);
    $pid = mysqli_real_escape_string($conn, $pid);
    $sql = "SELECT a.aptid, a.sid, a.pid, a.time, s.date, a.status, 
                   d.did, u.uid AS doctor_uid, u.name AS doctor_name
            FROM appointment a
            JOIN session s ON a.sid = s.sid
            JOIN doctor d ON s.did = d.did
            JOIN user u ON d.uid = u.uid
            WHERE s.date = '$date' AND a.status = '$status' AND a.pid = '$pid'
            ORDER BY s.date DESC, a.time ASC";

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
    $date = mysqli_real_escape_string($conn, $date);
    $pid = mysqli_real_escape_string($conn, $pid);

    $sql = "SELECT a.aptid, a.sid, a.pid, a.time, s.date, a.status, 
                   d.did, u.uid AS doctor_uid, u.name AS doctor_name
            FROM appointment a
            JOIN session s ON a.sid = s.sid
            JOIN doctor d ON s.did = d.did
            JOIN user u ON d.uid = u.uid
            WHERE s.date = '$date' AND a.pid = '$pid'
            ORDER BY s.date DESC, a.time ASC";

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
    $status = mysqli_real_escape_string($conn, $status);
    $pid = mysqli_real_escape_string($conn, $pid);
    $sql = "SELECT a.aptid, a.sid, a.pid, a.time, s.date, a.status, 
                   d.did, u.uid AS doctor_uid, u.name AS doctor_name
            FROM appointment a
            JOIN session s ON a.sid = s.sid
            JOIN doctor d ON s.did = d.did
            JOIN user u ON d.uid = u.uid
            WHERE a.status = '$status' AND a.pid = '$pid'
            ORDER BY s.date DESC, a.time ASC";

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

function getPIdbyAptId($aptid)
{
    $conn = initDB();
    $aptid = mysqli_real_escape_string($conn, $aptid);
    $sql = "SELECT pid FROM appointment
            WHERE aptid = '$aptid'";

    $result = mysqli_query($conn, $sql);

    $pid = "";
    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $pid = $row["pid"];
        }
    }

    return $pid;
}

function updateAppointmentStatus($aptid, $status)
{
    $conn = initDB();
    $aptid = mysqli_real_escape_string($conn, $aptid);
    $status = mysqli_real_escape_string($conn, $status);

    $sql = "UPDATE appointment SET status='$status' WHERE aptid='$aptid'";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}


function getAppointmentBySIdPIdAndNotCancelled($sid, $pid)
{
    $conn = initDB();
    $sid = mysqli_real_escape_string($conn, $sid);
    $pid = mysqli_real_escape_string($conn, $pid);

    $sql = "SELECT aptid, sid, pid, time, status FROM appointment 
            WHERE sid='$sid' and pid='$pid' and status!='cancelled' AND status!='rejected'";
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
