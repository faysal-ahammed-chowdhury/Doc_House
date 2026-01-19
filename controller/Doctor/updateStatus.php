<?php
require_once "../../middleware/authMiddleware.php";
require_once "../../middleware/doctorMiddleware.php";
require_once '../../model/Doctor/appointment_model.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    $result = updateAppointmentStatus($id, $status);
    if ($result) {
        http_response_code(200); 
        echo "Success";
    } else {
        http_response_code(500);
        echo "Database Error";
    }
}else {
 
    http_response_code(400);
    echo "Invalid Request";
}
?>