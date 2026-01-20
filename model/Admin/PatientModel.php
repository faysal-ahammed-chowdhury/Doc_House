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

?>