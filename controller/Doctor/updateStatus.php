<?php
require_once "../../middleware/authMiddleware.php";
require_once "../../middleware/doctorMiddleware.php";
require_once '../../model/Doctor/appointment_model.php';
require_once '../../model/Doctor/dashboard_model.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];
    $did = $_SESSION['user']['did'];

    $result = updateAppointmentStatus($id, $status);
    if ($result) {
        $newStats = getDashboardStats($did);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'stats' => $newStats]);
        exit();
    } else {
        http_response_code(500);
        echo "Database Error";
    }
}else {
 
    http_response_code(400);
    echo "Invalid Request";
}
?>