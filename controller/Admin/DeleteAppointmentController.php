<?php
require_once 'C:\\xampp\htdocs\Doc_House\model\Admin\AppointmentModel.php';

if (isset($_POST['aptid'])) {
    $aptid = $_POST['aptid'];

    $result = deleteAppointment($aptid);

    if ($result) {
        $appointments = getAppointments();
        if(!empty($appointments)){
             echo '
                <tr>
                    <th>PATIENT</th>
                    <th>DOCTOR</th>
                    <th>SCHEDULE</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                </tr>
            ';

            foreach($appointments as $apt){
                echo '
                <tr>
                    <td>
                        <div>
                            <div><h4>'.substr($apt['patient_name'],0,2).'</h4></div>
                            <div><h4>'.htmlspecialchars($apt['patient_name']).'</h4><p>PID-'.$apt['patient_id'].'</p></div>
                        </div>
                    </td>
                    <td>
                        <div><h4>'.htmlspecialchars($apt['doctor_name']).'</h4><p>DID-'.$apt['doctor_id'].'</p></div>
                    </td>
                    <td>
                        <div><h4>'.date("M d, Y", strtotime($apt['session_date'])).'</h4>
                        <p>'.date("h:i A", strtotime($apt['appointment_time'])).' (SIS-'.$apt['session_id'].')</p></div>
                    </td>
                    <td><p>'.ucfirst($apt['appointment_status']).'</p></td>
                    <td>
                        <button id="edit_btn" data-aptid="'.$apt['aptid'].'"><i class="ri-edit-2-fill"></i></button>
                        <button id="delete_btn" data-aptid="'.$apt['aptid'].'"><i class="ri-delete-bin-6-fill"></i></button>
                    </td>
                </tr>';
            }
        } else {
            echo '
                <tr>
                    <th>PATIENT</th>
                    <th>DOCTOR</th>
                    <th>SCHEDULE</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                </tr>
            ';
            echo '<tr><td colspan="5" style="text-align:center;">No appointments found</td></tr>';
        }
    } else {
        echo "error";
    }
}
exit;
