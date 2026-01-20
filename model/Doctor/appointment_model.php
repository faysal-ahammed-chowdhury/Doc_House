<?php
require_once 'db.php';

function getAppointmentsByDoctor($did, $date = null, $status = null)
{
    $conn = initDB();
    $did = (int) $did;
    $sql = "SELECT a.aptid, a.time, a.status, s.date, u.name AS patient_name
            FROM appointment a
            JOIN session s ON a.sid = s.sid
            JOIN patient p ON a.pid = p.pid
            JOIN user u ON p.uid = u.uid
            WHERE s.did = '$did'";

    if (!empty($date)) {
        $date = mysqli_real_escape_string($conn, $date);
        $sql .= " AND s.date = '$date'";
    }

    if (!empty($status)) {
        $status = mysqli_real_escape_string($conn, $status);
        $sql .= " AND a.status = '$status'";
    }

    $sql .= " ORDER BY s.date DESC, a.time ASC";

    $result = mysqli_query($conn, $sql);
    $data = [];

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    return $data;
}

function updateAppointmentStatus($aptid, $status)
{
    $conn = initDB();
    
    $aptid = (int) $aptid;
    $status = (int) $status;

    $sql = "UPDATE appointment SET status='$status' WHERE aptid='$aptid'";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}


?>