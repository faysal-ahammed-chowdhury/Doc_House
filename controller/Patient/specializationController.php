<?php
// require_once "../../middleware/authMiddleware.php";
// require_once "../../middleware/patientMiddleware.php";
if (isset($_SESSION['user'])) {
    require_once "../../middleware/patientMiddleware.php";
}

require_once "../../model/Patient/Specialization.php";
$allSpecializations = getAllSpecialization();
