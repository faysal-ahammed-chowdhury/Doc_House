<?php
require_once 'C:\\xampp\htdocs\Doc_House\model\Admin\AppointmentModel.php';

if (!isset($_POST['uid'])) {
    exit;
}

$uid = (int)$_POST['uid'];
$sessions = getSessionByID($uid);

echo '<option value="">Select Available Session</option>';

foreach ($sessions as $session) {
    echo '<option value="' . $session['did'] . '_' . $session['date'] . '_' . $session['start_time'] . '_' . $session['end_time'] . '_' . $session['slot_duration'] . '">';
    echo $session['date'] . ' (' . $session['start_time'] . ' - ' . $session['end_time'] . ')';
    echo '</option>';
}
