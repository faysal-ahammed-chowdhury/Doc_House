<?php
session_start();
require_once 'C:\\xampp\htdocs\Doc_House\model\Admin\SpecializationModel.php';

    function getSpecialization()
    {
        $data = getAllSpecializationA();
        // var_dump($data);
        return $data;
    }

    // $data = getSpecialization();
    // var_dump($data);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // AJAX
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {

        $spid = intval($_POST['spid']);

        if (hasDoctors($spid)) {
            echo 'has_doctors';
            exit;
        }

        echo deleteSpecializationByID($spid) ? 'deleted' : 'error';
        exit;
    }

    if (isset($_POST['action']) && $_POST['action'] === 'update') {
        $spid = intval($_POST['spid'] ?? 0);
        $name = trim($_POST['name'] ?? '');

        if ($spid <= 0 || $name === '') {
            echo 'error';
            exit;
        }

        $name = strtoupper($name);

        $result = updateSpecialization([
            'spid' => $spid,
            'name' => $name
        ]);

        echo $result ? 'updated' : 'error';
        exit;
    }



    // Live check
    if (isset($_POST['action']) && $_POST['action'] === 'check') {

        $spec = trim($_POST['specialization'] ?? '');

        if ($spec === '') {
            echo 'empty';
            exit;
        }

        echo checkSpecializationExists($spec) ? 'exists' : 'available';
        exit;
    }

    // Submit
    $spec = trim($_POST['specialization'] ?? '');

    if ($spec === '') {
        $_SESSION['specializationError'] = "Enter Specialization First";
        header('Location: /Doc_House/view/Admin/pages/Specializations.php');
        exit;
    }

    if (checkSpecializationExists($spec)) {
        $_SESSION['specialization'] = $spec;
        $_SESSION['specializationError'] = "Specialization already exists!";
        header('Location: /Doc_House/view/Admin/pages/Specializations.php');
        exit;
    }

    $spec = strtoupper($spec);
    addSpecialization(['name' => $spec]);

    unset($_SESSION['specialization'], $_SESSION['specializationError']);




    header('Location: /Doc_House/view/Admin/pages/Specializations.php');
    exit;
}
