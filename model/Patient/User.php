<?php
require_once "db.php";
require_once "Patient.php";

function getUserByEmail($email)
{
    $conn = initDB();
    $email = mysqli_real_escape_string($conn, $email);

    $sql = "SELECT uid, name, dob, role, img FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    $foundUser = [];
    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $foundUser["uid"] = $row["uid"];
            $foundUser["name"] = $row["name"];
            $foundUser["email"] = $email;
            $foundUser["dob"] = $row["dob"];
            $foundUser["role"] = $row["role"];
            $foundUser["img"] = $row["img"];
        }
    }
    return $foundUser;
}

function getUIdByEmail($email)
{
    $conn = initDB();
    $email = mysqli_real_escape_string($conn, $email);

    $sql = "SELECT uid, name, dob, role FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    $uid = null;
    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $uid = $row["uid"];
        }
    }
    return $uid;
}


function matchPassword($email, $password)
{
    $conn = initDB();
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

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


function updateUserByUid($uid, $name, $phone, $dob, $password = null)
{
    $conn = initDB();
    $uid = mysqli_real_escape_string($conn, $uid);
    $name = mysqli_real_escape_string($conn, $name);
    $phone = mysqli_real_escape_string($conn, $phone);
    $dob = mysqli_real_escape_string($conn, $dob);

    if ($password !== null && strlen($password) > 0) {
        $password = mysqli_real_escape_string($conn, $password);
        $sqlUser = "
            UPDATE user 
            SET name='$name', phone='$phone', dob='$dob', password='$password' 
            WHERE uid='$uid'
        ";
    } else {
        $sqlUser = "
            UPDATE user 
            SET name='$name', phone='$phone', dob='$dob'
            WHERE uid='$uid'
        ";
    }

    return mysqli_query($conn, $sqlUser);
}


function updatePasswordByUid($uid, $password)
{
    $conn = initDB();
    $uid = mysqli_real_escape_string($conn, $uid);
    $password = mysqli_real_escape_string($conn, $password);
    $sqlUser = "UPDATE user 
                SET password='$password' 
                WHERE uid='$uid'";

    return mysqli_query($conn, $sqlUser);
}

function addUser($name, $email, $password, $phone, $role, $dob)
{
    $conn = initDB();
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $phone = mysqli_real_escape_string($conn, $phone);
    $role = mysqli_real_escape_string($conn, $role);
    $dob = mysqli_real_escape_string($conn, $dob);
    $sql = "INSERT INTO user (name, email, password, phone, role, dob)
            VALUES ('$name', '$email', '$password', '$phone', '$role', '$dob')";

    return mysqli_query($conn, $sql);
}


function updateImgByUid($uid, $img_location)
{
    $conn = initDB();
    $uid = mysqli_real_escape_string($conn, $uid);

    $sqlUser = "UPDATE user 
                SET img='$img_location' 
                WHERE uid='$uid'";

    return mysqli_query($conn, $sqlUser);
}
