<?php
    require_once "C:\\xampp\htdocs\Doc_House\model\db.php";

    function addSpecialization($data)
    {
        $conn = initDB();
        $sql = "INSERT INTO specialization (name) VALUES (
            '{$data['name']}'
            -- '{$data['image']}'
        )";

        return mysqli_query($conn, $sql);
    }

    function getAllSpecializationA()
    {
        $conn = initDB();
        if (!$conn) {
            die("DB connection failed");
        }
        $sql = "SELECT * FROM specialization";

        $result = mysqli_query($conn, $sql);

        $specializations = [];

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $specializations[] = $row;
            }
        }

        return $specializations;
    }


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




?>