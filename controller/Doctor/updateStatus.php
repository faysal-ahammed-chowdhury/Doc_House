<?php
require_once '../../model/Doctor/appointment_model.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    updateAppointmentStatus($id, $status);
}

header("Location: ../../view/Doctor/appointments.php");
exit();
?>