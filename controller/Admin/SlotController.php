<?php
if (!isset($_POST['session_id'])) {
    exit;
}

$data = explode('_', $_POST['session_id']);

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

while ($startMin + $duration <= $endMin) {
    $slotStart = toTime($startMin);
    $slotEnd   = toTime($startMin + $duration);

    echo '<option value="' . $slotStart . '-' . $slotEnd . '">';
    echo $slotStart . ' - ' . $slotEnd;
    echo '</option>';

    $startMin += $duration;
}
