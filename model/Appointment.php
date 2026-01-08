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
