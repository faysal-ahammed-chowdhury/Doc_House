<?php
require_once 'db.php';

function getDashboardStats($did) {
    $conn = initDB();
    $stats = [];
    $today = date('Y-m-d');

    $sql = "SELECT COUNT(DISTINCT a.pid) as total 
            FROM appointment a 
            JOIN session s ON a.sid = s.sid 
            WHERE s.did = '$did'
            AND a.status = 'accepted'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $stats['total_patients'] = $row['total'];

    $sql = "SELECT COUNT(*) as total 
            FROM appointment a 
            JOIN session s ON a.sid = s.sid 
            WHERE s.did = '$did' 
            AND s.date = '$today'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $sql = "SELECT COUNT(*) as total 
            FROM appointment a 
            JOIN session s ON a.sid = s.sid 
            WHERE s.did = '$did' 
            AND s.date = '$today' 
            AND a.status = 'accepted'";
    $new_result = mysqli_query($conn, $sql);
    $new_row = mysqli_fetch_assoc($new_result);
    $stats['today_appointments'] = $new_row['total'];


    $sql = "SELECT COUNT(*) as total 
            FROM appointment a 
            JOIN session s ON a.sid = s.sid 
            WHERE s.did = '$did' 
            AND a.status = 'pending'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $stats['pending_requests'] = $row['total'];

    return $stats;
}

function getRecentAppointments($did, $limit = 5) {
    $conn = initDB();
    $today = date('Y-m-d');
    
    $sql = "SELECT a.*, s.date, u.name as patient_name 
            FROM appointment a
            JOIN session s ON a.sid = s.sid
            JOIN patient p ON a.pid = p.pid
            JOIN user u    ON p.uid = u.uid
            WHERE s.did = '$did' 
            AND s.date >= '$today'
            ORDER BY s.date ASC, a.time ASC
            LIMIT $limit";
    
    $result = mysqli_query($conn, $sql);
    
    $data = [];
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}
?>