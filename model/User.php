<?php
require_once "db.php";
require_once "Patient.php";

function getUserByEmail($email)
{
    $conn = initDB();
    $sql = "SELECT uid, name, role FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    $foundUser = [];
    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $foundUser["uid"] = $row["uid"];
            $foundUser["name"] = $row["name"];
            $foundUser["email"] = $email;
            $foundUser["role"] = $row["role"];
        }

        if ($foundUser["role"] == 'patient') {
            $foundUser["pid"] = getPIdByUId($foundUser["uid"]);
        } else if ($foundUser["role"] == 'doctor') {
        } else if ($foundUser["role"] == 'admin') {
        }
    }
    return $foundUser;
}


function matchPassword($email, $password)
{
    $conn = initDB();
    $sql = "SELECT * FROM user WHERE email='$email' and password='$password'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) == 1;
}
