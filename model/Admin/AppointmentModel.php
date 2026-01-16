<?php
    require_once "C:\\xampp\htdocs\Doc_House\model\db.php";


    function addAppointment($data)
    {
        $conn = initDB();

        $sid  = (int)$data['sid'];
        $pid = (int)$data['pid'];
        $time = $data['time'];
        $status = $data['status'];

        $sql = "INSERT INTO appointment (sid, pid, time, status)
            VALUES ($sid, $pid, '$time', '$status')";



        return mysqli_query($conn, $sql);
    }


    function getAppointments()
    {
        $conn = initDB();

        $sql = "SELECT 
            a.aptid,
            a.time AS appointment_time,
            a.status AS appointment_status,
            p.pid AS patient_id,
            u_patient.name AS patient_name,
            d.did AS doctor_id,
            u_doctor.name AS doctor_name,
            d.uid AS doctor_uid,
            d.fee AS doctor_fee,
            d.bio AS doctor_bio,
            d.spid AS doctor_specialization_id,
            s.sid AS session_id,
            s.date AS session_date,
            s.start_time AS session_start_time,
            s.end_time AS session_end_time,
            s.slot_duration AS session_slot_duration
        FROM appointment a
        JOIN patient p ON a.pid = p.pid
        JOIN user u_patient ON p.uid = u_patient.uid
        JOIN session s ON a.sid = s.sid
        JOIN doctor d ON s.did = d.did
        JOIN user u_doctor ON d.uid = u_doctor.uid
        ORDER BY a.aptid DESC";

        $result = mysqli_query($conn, $sql);

        $appointments = [];

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $appointments[] = $row;
            }
        }

        return $appointments;
    }



    function searchPatientsByUser($keyword) {
        $conn = initDB();

        $sql = "SELECT 
                    u.uid,
                    u.name,
                    p.pid
                FROM user u
                INNER JOIN patient p ON p.uid = u.uid
                WHERE u.name LIKE ?
                LIMIT 10";

        $stmt = mysqli_prepare($conn, $sql);
        $search = "%" . $keyword . "%";
        mysqli_stmt_bind_param($stmt, "s", $search);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $patients = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $patients[] = [
                'uid'  => $row['uid'],
                'pid'  => $row['pid'],
                'name' => $row['name']
            ];
        }

        return $patients;
    }



function getDoctorID($uid)
{
    $conn = initDB();
    $uid = (int)$uid;

    $sql = "SELECT did FROM doctor WHERE uid = $uid LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return (int)$row['did'];
    }

    return null;
}




function getSessionByID($uid)
{
    $conn = initDB();

    $did = getDoctorID($uid);
    if (!$did) {
        return [];
    }

    $sql = "SELECT * FROM session WHERE did = $did AND status='open'";
    $result = mysqli_query($conn, $sql);

    $sessions = [];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sessions[] = [
                'did'           => $row['did'],
                'date'          => $row['date'],
                'start_time'    => $row['start_time'],
                'end_time'      => $row['end_time'],
                'slot_duration' => $row['slot_duration'],
                'status'        => $row['status']
            ];
        }
    }

    return $sessions;
}


?>