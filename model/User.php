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

// function getNameByUId($uid)
// {
//     $conn = initDB();
//     $sql = "SELECT name FROM user WHERE uid='$uid'";
//     $result = mysqli_query($conn, $sql);

//     $name = "NULL";
//     if (mysqli_num_rows($result) == 1) {
//         while ($row = mysqli_fetch_assoc($result)) {
//             $name = $row["name"];
//         }
//     }
//     return $name;
// }


function updateUserByUid($uid, $name, $phone, $password = null)
{
    $conn = initDB();

    if ($password !== null && strlen($password) > 0) {
        $sqlUser = "
            UPDATE user 
            SET name='$name', phone='$phone', password='$password' 
            WHERE uid='$uid'
        ";
    } else {
        $sqlUser = "
            UPDATE user 
            SET name='$name', phone='$phone' 
            WHERE uid='$uid'
        ";
    }

    return mysqli_query($conn, $sqlUser);
}
