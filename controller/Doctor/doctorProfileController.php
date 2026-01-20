<?php
session_start();
require_once "../../model/Doctor/doctorProfile_model.php";

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'doctor') {
    header("Location: ../Auth/login.php");
    exit();
}

$uid = $_SESSION['user']['uid'];
$did = $_SESSION['user']['did'];
$message = "";
$error = "";



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['remove_photo'])) {
        $currentData = getDoctorProfile($uid);
        $oldFile = $currentData['img'];

        if (deleteDoctorImage($uid)) {
            if (!empty($oldFile) && file_exists($oldFile)) {
                unlink($oldFile);
            }
            $message = "Photo removed successfully!";
        } else {
            $error = "Failed to remove photo.";
        }
        header("Location: ../../view/Doctor/doctorProfile.php");
        exit();
    }
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $fee = trim($_POST['fee'] ?? '');
    $bio = trim($_POST['bio'] ?? '');

    $newPass = $_POST['new_password'] ?? '';
    $confirmPass = $_POST['confirm_password'] ?? '';

    $finalPass = null;
    $finalImgPath = null;

    if (empty($name) || empty($phone) || empty($fee)) {
        $error = "Name, Phone, and Fee are required fields.";
    } elseif (!is_numeric($fee) || $fee < 0) {
        $error = "Consultation Fee must be a valid positive number.";
    } elseif (!empty($newPass)) {
        if (strlen($newPass) < 6) {
            $error = "Password must be at least 6 characters long.";
        } elseif ($newPass !== $confirmPass) {
            $error = "Passwords do not match!";
        } else {
            $finalPass = $newPass;
        }
    }

    if (empty($error) && !empty($_FILES['profile_photo']['name'])) {
        $fileName = $_FILES['profile_photo']['name'];
        $fileTmp = $_FILES['profile_photo']['tmp_name'];
        $fileSize = $_FILES['profile_photo']['size'];
        $fileError = $_FILES['profile_photo']['error'];

        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) {

                    $uploadDir = "../../uploads/profile/";
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $newFileName = "IMG_" . $uid . "_" . time() . "." . $fileExt;
                    $destination = $uploadDir . $newFileName;

                    if (move_uploaded_file($fileTmp, $destination)) {
                        $finalImgPath = $destination;
                    } else {
                        $error = "Failed to upload image. Check folder permissions.";
                    }
                } else {
                    $error = "File is too big! Max size is 5MB.";
                }
            } else {
                $error = "There was an error uploading your file.";
            }
        } else {
            $error = "Invalid file type! Only JPG, JPEG, and PNG are allowed.";
        }
    }

    if (empty($error)) {
        $updateResult = updateDoctorProfile($uid, $did, $name, $phone, $fee, $bio, $finalPass, $finalImgPath);

        if ($updateResult === true) {
            $message = "Profile updated successfully!";
            $_SESSION['user']['name'] = $name;
        } else {
            $error = "Update failed: " . $updateResult;
        }
    }
}



$doctorData = getDoctorProfile($uid);

if (!$doctorData) {
    die("Error: User data not found.");
}
?>