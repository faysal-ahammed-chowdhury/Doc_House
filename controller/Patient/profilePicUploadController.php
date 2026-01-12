<?php
require_once "../../middleware/authMiddleware.php";
require_once "../../middleware/patientMiddleware.php";
include_once "../../model/Patient/User.php";
include_once "../../model/Patient/Patient.php";

$curUser = getPatientByPId($_SESSION['user']['pid']);

if (!isset($curUser['pid'])) {
    echo "Something is wrong\n";
    exit();
}

if (!isset($_FILES['profile_pic'])) {
    $_SESSION['picErr'] = "Something is wrong";
    header("Location: /Doc_House/view/Patient/profile.php");
    exit();
}

if (empty($_FILES['profile_pic']['name'])) {
    $_SESSION['picErr'] = "Please select a photo";
    header("Location: /Doc_House/view/Patient/profile.php");
    exit();
}

if (($_FILES['profile_pic']['error']) != 0) {
    $_SESSION['picErr'] = "Something is wrong";
    header("Location: /Doc_House/view/Patient/profile.php");
    exit();
}

if (
    !($_FILES['profile_pic']['type'] == 'image/png'
        || $_FILES['profile_pic']['type'] == 'image/jpg'
        || $_FILES['profile_pic']['type'] == 'image/jpeg')
) {
    $_SESSION['picErr'] = "Only PNG, JPG, JPEG Allowed";
    header("Location: /Doc_House/view/Patient/profile.php");
    exit();
}

$maxSize = 2 * 1024 * 1024; // 2MB
if ($_FILES['profile_pic']['size'] > $maxSize) {
    $_SESSION['picErr'] = "Too large file, Maximum 2MB";
    header("Location: /Doc_House/view/Patient/profile.php");
    exit();
}


$target_file = "/Doc_House/uploads/profile/";
$target_location = $target_file . rand(1, 100000) . $_FILES['profile_pic']['name'];
// var_dump($_FILES['profile_pic']);
// exit();

if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $target_location)) {
    if (updateImgByUid($_SESSION['user']['uid'], $target_location)) {
        $_SESSION['picSuccess'] = "Profile Picture Updated";
        $_SESSION['user']['img'] = $target_file;
        header("Location: /Doc_House/view/Patient/profile.php");
        exit();
    } else {
        $_SESSION['picErr'] = "Failed to upload image";
        header("Location: /Doc_House/view/Patient/profile.php");
        exit();
    }
} else {
    $_SESSION['picErr'] = "Failed to upload image2";
    header("Location: /Doc_House/view/Patient/profile.php");
    exit();
}
