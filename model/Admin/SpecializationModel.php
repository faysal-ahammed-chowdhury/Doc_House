<?php
    require_once "C:\\xampp\htdocs\Doc_House\model\db.php";

    function addSpecialization($data) {
        $conn = initDB();
        $name = mysqli_real_escape_string($conn, trim($data['name']));
        $sql = "INSERT INTO specialization (name) VALUES ('$name')";
        return mysqli_query($conn, $sql);
    }

    function getAllSpecializationA()
    {
       $conn = initDB();

        $sql = "
            SELECT 
                s.spid,
                s.name AS specialization_name,
                COUNT(d.did) AS doctor_count
            FROM specialization s
            LEFT JOIN doctor d ON d.spid = s.spid
            GROUP BY s.spid, s.name
            ORDER BY doctor_count DESC
        ";

        $result = mysqli_query($conn, $sql);
        $specializations = [];

        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $spec = [];

                $spec['spid'] = $row['spid'];
                $spec['name'] = $row['specialization_name'];
                $spec['doctor_count'] = $row['doctor_count'];

                array_push($specializations, $spec);
            }
        }

        return $specializations;
    }

    // $data = getAllSpecializationA();
    // var_dump($data);




    function getSpcID($spcName)
    {
        $conn = initDB();
        $spcName = mysqli_real_escape_string($conn, trim($spcName));

        $sql = "SELECT spid FROM specialization WHERE name = '$spcName' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            return (int)$row['spid'];
        }

        return null;
    }

    function checkSpecializationExists($name) {
        $conn = initDB();
        $name = mysqli_real_escape_string($conn, trim($name));
        $sql = "SELECT spid FROM specialization WHERE name = '$name' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        return ($result && mysqli_num_rows($result) > 0);
    }

    function hasDoctors($spid)
    {
        $conn = initDB();
        $sql = "SELECT 1 FROM doctor WHERE spid = $spid LIMIT 1";
        $result = mysqli_query($conn, $sql);
        return mysqli_num_rows($result) > 0;
    }


    function deleteSpecializationByID($spID)
    {
        $conn = initDB();
        $sql = "DELETE FROM specialization WHERE spid = $spID";
        return mysqli_query($conn, $sql);
    }


    function updateSpecialization($data)
    {
        $name = $data['name'];
        $spid = (int)$data['spid'];
        $conn = initDB();
        $sql = "UPDATE specialization SET name = '$name' WHERE spid = $spid";
        return mysqli_query($conn, $sql);
    }

?>