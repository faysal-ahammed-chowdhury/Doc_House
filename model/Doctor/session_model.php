<?php
require_once 'db.php';

function addSession($did, $date, $start, $end, $duration) {
    $conn = initDB();
    $did = mysqli_real_escape_string($conn, $did);
    $date = mysqli_real_escape_string($conn, $date);
    $start = mysqli_real_escape_string($conn, $start);
    $end = mysqli_real_escape_string($conn, $end);
    $duration = mysqli_real_escape_string($conn, $duration);

    $sql = "INSERT INTO session (did, date, start_time, end_time, slot_duration, status) 
            VALUES ('$did', '$date', '$start', '$end', '$duration', 'open')";

    return mysqli_query($conn, $sql);
}

function getUpcomingSessions($did) {
    $conn = initDB();
    $date = date('Y-m-d');
    $sql = "SELECT *, 
            (SELECT COUNT(*) FROM appointment WHERE sid = session.sid) as booked_count 
            FROM session 
            WHERE did = '$did' AND date >= '$date' 
            ORDER BY date ASC, start_time ASC";
    
    $result = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) $data[] = $row;
    return $data;
}

function getPastSessions($did) {
    $conn = initDB();
    $date = date('Y-m-d');
    $sql = "SELECT *, 
            (SELECT COUNT(*) FROM appointment WHERE sid = session.sid) as booked_count 
            FROM session 
            WHERE did = '$did' AND date < '$date' 
            ORDER BY date DESC";
    
    $result = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) $data[] = $row;
    return $data;
}

function getSessionById($sid) {
    $conn = initDB();
    $sid = mysqli_real_escape_string($conn, $sid);
    $sql = "SELECT * FROM session WHERE sid = '$sid'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function getAppointmentsBySession($sid) {
    $conn = initDB();
    $sid = mysqli_real_escape_string($conn, $sid);
    $sql = "SELECT a.*, u.name as patient_name 
            FROM appointment a
            JOIN patient p ON a.pid = p.pid
            JOIN user u ON p.uid = u.uid
            WHERE a.sid = '$sid'
            ORDER BY a.time ASC";
    
    $result = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) $data[] = $row;
    return $data;
}

function deleteSession($sid) {
    $conn = initDB();
    $sid = mysqli_real_escape_string($conn, $sid);
    $sql = "DELETE FROM session WHERE sid='$sid'";
    return mysqli_query($conn, $sql);
}
?>