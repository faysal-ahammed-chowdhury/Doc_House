<?php
session_start();
require_once 'C:\\xampp\htdocs\Doc_House\model\Admin\SpecializationModel.php';

    function allSpecialization()
    {
        $data = getAllSpecializationA();
        return $data;
    }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $spec = trim($_POST['specialization'] ?? '');


    if ($spec === '') {
        $_SESSION['specializationError'] = "Enter Specialization First";
        header('Location: /Doc_House/view/Admin/pages/Specializations.php');
        exit;
    }
    else
    {
        $_SESSION['specialization'] = $spec;
        header('Location: /Doc_House/view/Admin/pages/Specializations.php');
    }



    $data = [
        "name"  => $spec
    ];

    $result = addSpecialization($data);

    if ($result) {
        unset($_SESSION['specialization']);
        unset($_SESSION['specializationError']);
        unset($_SESSION['fileError']);
    }



    header('Location: /Doc_House/view/Admin/pages/Specializations.php');
    exit;
}
