<?php
require_once 'db.php';

function getDashboardStats($did) {
    $conn = initDB();
    $stats = [];
    $today = date('Y-m-d');

    $sql_patients = "SELECT COUNT(DISTINCT a.pid) as count 
                     FROM appointment a 
                     JOIN session s ON a.sid = s.sid 
                     WHERE s.did = '$did'";
    $res_patients = mysqli_query($conn, $sql_patients);
    $stats['total_patients'] = mysqli_fetch_assoc($res_patients)['count'];

    $sql_today = "SELECT COUNT(*) as count 
                  FROM appointment a 
                  JOIN session s ON a.sid = s.sid 
                  WHERE s.did = '$did' AND s.date = '$today' AND a.status != 'cancelled'";
    $res_today = mysqli_query($conn, $sql_today);
    $stats['today_appointments'] = mysqli_fetch_assoc($res_today)['count'];

    $sql_pending = "SELECT COUNT(*) as count 
                    FROM appointment a 
                    JOIN session s ON a.sid = s.sid 
                    WHERE s.did = '$did' AND a.status = 'pending'";
    $res_pending = mysqli_query($conn, $sql_pending);
    $stats['pending_requests'] = mysqli_fetch_assoc($res_pending)['count'];

    return $stats;
}

function getRecentAppointments($did, $limit = 3) {
    $conn = initDB();
    $today = date('Y-m-d');
    
    $sql = "SELECT a.*, s.date, u.name as patient_name 
            FROM appointment a
            JOIN session s ON a.sid = s.sid
            JOIN patient p ON a.pid = p.pid
            JOIN user u ON p.uid = u.uid
            WHERE s.did = '$did' AND s.date >= '$today'
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