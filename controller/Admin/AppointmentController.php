<?php
    require_once 'C:\\xampp\htdocs\Doc_House\model\Admin\AppointmentModel.php';
    require_once 'C:\\xampp\htdocs\Doc_House\model\Admin\SessionModel.php';
    session_start();

    function getAppointmentsData()
    {
        $data = getAppointments();
        return $data;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $patientName = trim($_POST['patient_name']);
        $docName = trim($_POST['doc_name']);
        $docTotalTime = trim($_POST['doc_total_time']);
        $docAvailableSlot = trim($_POST['doc_available_slot']);
        $status = trim($_POST['status']);

        $pid  = (int)$_POST['patient_id'];
        

        if(empty($patientName)){
            $_SESSION['patientNameErrorApp'] = 'Enter Patient Name';
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Appointments.php');
            exit;
        }
        else{
            $_SESSION['patientNameApp'] = $patientName;
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Appointments.php');
        }


        if(empty($docName)){
            $_SESSION['docNameErrorApp'] = 'Select Docto Name';
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Appointments.php');
            exit;
        }
        else{
            $_SESSION['docNameApp'] = $docName;
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Appointments.php');
        }


        if(empty($docTotalTime)){
            $_SESSION['docTotalTimeErrorApp'] = 'Select Available Session';
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Appointments.php');
            exit;
        }
        else{
            $_SESSION['docTotalTimeApp'] = $docTotalTime;
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Appointments.php');
        }


        if(empty($docAvailableSlot)){
            $_SESSION['docAvailableSlotErrorApp'] = 'Select Available Slot';
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Appointments.php');
            exit;
        }
        else{
            $_SESSION['docAvailableSlotApp'] = $docAvailableSlot;
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Appointments.php');
        }


        if(empty($status)){
            $_SESSION['statusErrorApp'] = 'Select Status';
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Appointments.php');
            exit;
        }
        else{
            $_SESSION['statusApp'] = $status;
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Appointments.php');
        }

        $timeParts = explode('-', $docAvailableSlot);
        $time = $timeParts[0];

        $sid = getSessionIDByDID($docTotalTime);


        $data = [
            'sid' => $sid,
            'pid' => $pid,
            'time' => $time,
            'status' => $status
        ];

        $result = addAppointment($data);

        if($result)
        {
            unset(
                $_SESSION['patientNameApp'],
                $_SESSION['docNameApp'],
                $_SESSION['docTotalTimeApp'],
                $_SESSION['docAvailableSlotApp'],
                $_SESSION['statusApp'],
                $_SESSION['openModal'],
            );

                $_SESSION['toast'] = [
        'message' => 'Appointment added successfully',
        'type' => 'success'
    ];

            header('Location: /Doc_House/view/Admin/pages/Appointments.php');
            exit;
        }

    }
?>