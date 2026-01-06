<?php
require_once "db.php";

function getPIdByUId($uid)
{
    $conn = initDB();
    $sql = "SELECT pid FROM patient WHERE uid='$uid'";
    $result = mysqli_query($conn, $sql);

    $pid = "";
    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $pid = $row["pid"];
        }
    }
    return $pid;
}
