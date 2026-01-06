<?php
require_once "db.php";

function getAllSpecialization()
{
    $conn = initDB();
    $sql = "SELECT spid, name, img FROM specialization";
    $result = mysqli_query($conn, $sql);

    $specializations = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $specialization = [];
            $specialization["spid"] = $row["spid"];
            $specialization["name"] = $row["name"];
            $specialization["img"] = $row["img"];
            array_push($specializations, $specialization);
        }
    }
    return $specializations;
}
