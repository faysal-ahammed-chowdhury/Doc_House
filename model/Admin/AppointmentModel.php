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