<?php
    require_once "C:\\xampp\htdocs\Doc_House\middleware\authMiddleware.php";
    require_once "C:\\xampp\htdocs\Doc_House\middleware\adminMiddleware.php";
    require_once 'C:\\xampp\htdocs\Doc_House\model\Admin\AppointmentModel.php';

    if (!empty($_POST['query'])) {

        $patients = searchPatientsByUser(trim($_POST['query']));

        if (empty($patients)) {
            echo '<div class="search-item">No patient found</div>';
            exit;
        }

        foreach ($patients as $patient) {
            echo '<div class="search-item patient-item"
                        data-pid="'.$patient['pid'].'"
                        data-uid="'.$patient['uid'].'">'
                    . htmlspecialchars($patient['name']) .
                '</div>';
        }
    }
?>
