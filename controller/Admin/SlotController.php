<?php
require_once 'C:\\xampp\htdocs\Doc_House\model\Admin\AppointmentModel.php';


if (!isset($_POST['session_id'])) {
    exit;
}

$data = explode('_', $_POST['session_id']);

// var_dump($data);
// exit();

$date     = $data[1];
$start    = $data[2];
$end      = $data[3];
$duration = (int)$data[4];

function toMinutes($time) {
    [$h, $m] = explode(':', $time);
    return ($h * 60) + $m;
}

function toTime($minutes) {
    return sprintf('%02d:%02d', floor($minutes / 60), $minutes % 60);
}

$startMin = toMinutes($start);
$endMin   = toMinutes($end);

echo '<option value="">Select Your Slot</option>';

function to12Hr($tmp) {
    $arr = explode(':', $tmp);
    $str = "";
    if ((int)($arr[0]) > 12) {
        $str .= $arr[0] - 12;
    }
    else {
        $str .= $arr[0];
    }
    $str .= ":";
    $str .= $arr[1];
    if ((int)($arr[0]) >= 12) {
        $str .= " PM";
    }
    else {
        $str .= " AM";
    }
    return  $str;
}


while ($startMin + $duration <= $endMin) {
    $slotStart = toTime($startMin);
    $slotEnd   = toTime($startMin + $duration);

    if (!isBookedSlot($slotStart . ":00", $data[5])) {
        echo '<option value="' . $slotStart . '-' . $slotEnd . '">';
        echo to12Hr($slotStart) . ' - ' . to12Hr($slotEnd);
        echo '</option>';
    }

    $startMin += $duration;
}
