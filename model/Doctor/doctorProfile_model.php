<?php
require_once 'db.php';

function getDoctorProfile($uid) {
    $conn = initDB();
    $uid = mysqli_real_escape_string($conn, $uid);

    $sql = "SELECT u.name, u.email, u.phone, u.img, s.name as specialization, d.fee, d.bio 
            FROM user u 
            JOIN doctor d ON u.uid = d.uid 
            LEFT JOIN specialization s ON d.spid = s.spid
            WHERE u.uid = '$uid'";

    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function deleteDoctorImage($uid) {
    $conn = initDB();
    $uid = mysqli_real_escape_string($conn, $uid);
    $sql = "UPDATE user SET img = NULL WHERE uid = '$uid'";
    return mysqli_query($conn, $sql);
}


function updateDoctorProfile($uid, $did, $name, $phone, $fee, $bio, $newPassword = null, $img = null) {
    $conn = initDB();

    $uid = mysqli_real_escape_string($conn, $uid);
    $did = mysqli_real_escape_string($conn, $did);
    $name = mysqli_real_escape_string($conn, $name);
    $phone = mysqli_real_escape_string($conn, $phone);
    $fee = mysqli_real_escape_string($conn, $fee);
    $bio = mysqli_real_escape_string($conn, $bio);

    $passQuery = "";
    if (!empty($newPassword)) {
        $newPassword = mysqli_real_escape_string($conn, $newPassword);
        $passQuery = ", password = '$newPassword'";
    }

    $imgQuery = "";
    if (!empty($img)) {
        $img = mysqli_real_escape_string($conn, $img);
        $imgQuery = ", img = '$img'";
    }

    $sqlUser = "UPDATE user SET name = '$name', phone = '$phone' $passQuery $imgQuery WHERE uid = '$uid'";
    $sqlDoc = "UPDATE doctor SET fee = '$fee', bio = '$bio' WHERE did = '$did'";

    if (mysqli_query($conn, $sqlUser) && mysqli_query($conn, $sqlDoc)) {
        return true;
    } else {
        return mysqli_error($conn);
    }
}
?>