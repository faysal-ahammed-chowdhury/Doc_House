<?php
require_once "C:\\xampp\htdocs\Doc_House\middleware\authMiddleware.php";
require_once "C:\\xampp\htdocs\Doc_House\middleware\adminMiddleware.php";
require_once 'C:\\xampp\\htdocs\\Doc_House\\model\\Admin\\UserModel.php';
require_once 'C:\\xampp\\htdocs\\Doc_House\\model\\Admin\\PatientModel.php';
require_once 'C:\\xampp\\htdocs\\Doc_House\\model\\Admin\\AppointmentModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'deletePatient') {

    $uid = isset($_POST['uid']) ? (int)$_POST['uid'] : 0;
    if (!$uid) {
        echo 'Invalid UID';
        exit;
    }

    $pid = getPatientIDbyUid($uid);
    if (!$pid) {
        echo 'Patient not found';
        exit;
    }

    $appointmentDeleted = deleteAppointmentByPid($pid); 
    $patientDeleted     = deletePatientByPid($pid);
    $userDeleted        = deleteUserByUID($uid);


    if ($patientDeleted && $userDeleted) {
        echo 'delete';
    } else {
        echo 'Delete failed';
    }
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'searchPatient') {

    $keyword = trim($_POST['keyword'] ?? '');

    $patients = searchPatient($keyword);

    ?>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Date of Birth</th>
        <th>ACTION</th>
    </tr>

    <?php if (!empty($patients)) : ?>
        <?php foreach ($patients as $patient) : ?>
            <tr>
                <td><?= htmlspecialchars($patient['name']) ?></td>
                <td><?= htmlspecialchars($patient['email']) ?></td>
                <td><?= htmlspecialchars($patient['phone']) ?></td>
                <td><?= date("M d, Y", strtotime($patient['dob'])) ?></td>
                <td>
                    <button class="delete_btn" data-uid="<?= $patient['uid'] ?>">
                        <i class="ri-delete-bin-6-fill"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="5" style="text-align:center;">No patients found</td>
        </tr>
    <?php endif; ?>

    <?php
    exit;
}
