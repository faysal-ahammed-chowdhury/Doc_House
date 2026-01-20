<?php
    require_once "C:\\xampp\htdocs\Doc_House\model\db.php";

    function getAllPatient()
    {
        $conn = initDB();
        $sql = "SELECT * FROM patient";

        $result = mysqli_query($conn, $sql);

        $patients = [];

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $patient = [];

                $patient['pid'] = $row['pid'];
                $patient['uid'] = $row['uid'];
                $patient['gender'] = $row['gender'];
                $patient['weight'] = $row['weight'];

                $patients[] = $patient;
            }
        }

        return $patients;
    }

    function getPatientIDbyUid($uid)
    {
        $conn = initDB();
        $uid = (int)$uid;

        $sql = "SELECT pid FROM patient WHERE uid=$uid LIMIT 1";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            return (int)$row['pid'];
        }

        return null;
    }


    function deletePatientByPid($pid)
    {
        $conn = initDB();
        $pid = (int)$pid;

        $sql = "DELETE FROM patient WHERE pid=$pid";

        return mysqli_query($conn, $sql);
    }



    function searchPatient($keyword)
    {
        $conn = initDB();

        $sql = "SELECT * FROM user 
                WHERE role='patient'
                AND (name LIKE '%$keyword%' OR email LIKE '%$keyword%')";

        $result = mysqli_query($conn, $sql);

        $patients = [];
        if($result && mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $patient = [];

                $patient['uid'] = $row['uid'];
                $patient['name'] = $row['name'];
                $patient['email'] = $row['email'];
                $patient['phone'] = $row['phone'];
                $patient['dob'] = $row['dob'];

                array_push($patients, $patient);
            }
        }

        return $patients;
    }


?>