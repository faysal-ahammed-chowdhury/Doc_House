<?php
    require_once 'C:\\xampp\htdocs\Doc_House\model\Admin\DoctorModel.php';
    require_once 'C:\\xampp\htdocs\Doc_House\model\Admin\SpecializationModel.php';
    require_once 'C:\\xampp\htdocs\Doc_House\model\Admin\UserModel.php';

    function allDoctors()
    {
        return getAllDoctorsAdmin();
    }


    // if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        
    // }


    // Delete

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'deleteDoctor') {
        header('Content-Type: application/json');

        $uid = $_POST['uid'] ?? null;

        if (!$uid) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid ID'
            ]);
            exit;
        }

        // delete from doctor first
        $doctorDeleted = deleteDoctorByUID($uid);
        $userDeleted   = deleteUserByUID($uid);

        if ($doctorDeleted && $userDeleted) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Doctor deleted successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Delete failed'
            ]);
        }
        exit;
    }


    // Get

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'getDoctor') {
        header('Content-Type: application/json');
        $email = $_POST['doctor_email'] ?? null;

        if ($email) {
            $doctorData = getDoctorByEmail($email);
            if (!empty($doctorData)) {
                echo json_encode($doctorData[0]);
            } else {
                echo json_encode([]);
            }
        } else {
            echo json_encode([]);
        }

        exit;
    }


    // Filter

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'filterDoctors') {
    header('Content-Type: application/json');

    $search = trim($_POST['search'] ?? '');
    $specialization = trim($_POST['specialization'] ?? '');

    $doctors = getFilteredDoctors($search, $specialization);

    if (!empty($doctors)) {
        echo json_encode([
            'status' => 'success',
            'doctors' => $doctors
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'doctors' => []
        ]);
    }
    exit;
}





    // Update

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateDoctor'])) {

        $uid = trim($_POST['doctor_uid']);
        $email = trim($_POST['doc_email']);
        $name = trim($_POST['doc_name']);
        $pass = trim($_POST['doc_pass']);
        $phone = trim($_POST['doc_phone']);
        $specialization = trim($_POST['doc_specialization']);
        $fee = trim($_POST['doc_fee']);
        $bio = trim($_POST['doc_bio']);

        $spid = getSpcID($specialization);


        $userData = [
            'uid'      => $uid,
            'name'     => $name,
            'email'    => $email,
            'password' => $pass,
            'phone'    => $phone
        ];

        $doctorData = [
            'uid'  => $uid,
            'fee'  => $fee,
            'bio'  => $bio,
            'spid' => $spid
        ];


        $userUpdated = updateUser($userData);

        $doctorUpdated = updateDoctorAdmin($doctorData);

        if ($userUpdated && $doctorUpdated) {
            $_SESSION['toast'] = [
                'message' => 'Doctor updated successfully',
                'type' => 'success'
            ];
        } else {
            $_SESSION['toast'] = [
                'message' => 'Failed to update doctor!',
                'type' => 'error'
            ];
        }

        header('Location: /Doc_House/view/Admin/pages/Doctor.php');
        exit;

    }


    // Live Search
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'checkEmail') {

        $email = trim($_POST['email'] ?? '');

        if ($email && checkEmailExit($email)) {
            $_SESSION['openModal'] = true;
            echo 'exists';
        } else {
            echo 'ok';
        }
        exit;
    }




    // Submit

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['updateDoctor'])) {
        $email = trim($_POST['doc_email']);
        $name = trim($_POST['doc_name']);
        $pass = trim($_POST['doc_pass']);
        $specialization = trim($_POST['doc_specialization']);
        $fee = trim($_POST['doc_fee']);
        $phone = trim($_POST['doc_phone']);
        $bio = trim($_POST['doc_bio']);



        $emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

        if (empty($email)) {
            $_SESSION['emailError'] = 'Enter Your Email ';
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Doctor.php');
            exit;
        }
        elseif(!preg_match($emailRegex, $email)){
            $_SESSION['emailError'] = 'Enter A Valid Email Address';
            $_SESSION['email'] = $email;
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Doctor.php');
            exit;
        }
        else{
            $_SESSION['email'] = $email;
            $_SESSION['openModal'] = true;
            // header('Location: /Doc_House/view/Admin/pages/Doctor.php');
            // exit;
        }

        if (empty($pass)) {
            $_SESSION['passError'] = 'Enter Your Password';
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Doctor.php');
            exit;
        }
        elseif(strlen($pass) < 6){
            $_SESSION['passError'] = 'Password At Least 6 characters';
            $_SESSION['pass'] = $pass;
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Doctor.php');
            exit;
        }
        else{
            $_SESSION['pass'] = $pass;
            $_SESSION['openModal'] = true;
            // header('Location: /Doc_House/view/Admin/pages/Doctor.php');
            // exit;
        }

        if (empty($name)) {
            $_SESSION['nameError'] = 'Enter Your Name';
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Doctor.php');
            exit;
        }else{
            $_SESSION['name'] = $name;
            $_SESSION['openModal'] = true;
            // header('Location: /Doc_House/view/Admin/pages/Doctor.php');
            // exit;
        }



        if (empty($specialization)) {
            $_SESSION['specialError'] = 'Select Doctor Specialization';
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Doctor.php');
            exit;
        }
        else{
            $_SESSION['specialization'] = $specialization;
            $_SESSION['openModal'] = true;
            // header('Location: /Doc_House/view/Admin/pages/Doctor.php');
        }


        if (empty($fee)) {
            $_SESSION['feeError'] = 'Enter Your Fees';
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Doctor.php');
            exit;
        }
        elseif(!is_numeric($fee)){
            $_SESSION['feeError'] = 'Fees Must Be a Number';
            $_SESSION['fee'] = $fee;
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Doctor.php');
            exit;
        }
        else{
            $_SESSION['fee'] = $fee;
            $_SESSION['openModal'] = true;
            // header('Location: /Doc_House/view/Admin/pages/Doctor.php');
        }



        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);

        if (empty($phone)) {
            $_SESSION['phoneError'] = 'Enter Your Phone Number';
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Doctor.php');
            exit;
        }
        else{
            $_SESSION['phone'] = $phone;
            $_SESSION['openModal'] = true;
        }



        if (empty($bio)) {
            $_SESSION['bioError'] = 'Enter Your Bio';
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Doctor.php');
            exit;
        }
        else{
            $_SESSION['bio'] = $bio;
            $_SESSION['openModal'] = true;
            // header('Location: /Doc_House/view/Admin/pages/Doctor.php');
        }


        // $emailExit = checkEmailExit($email);
        // if($emailExit)
        // {
        //     $_SESSION['emailError'] = 'Email Already Exit';
        //     $_SESSION['openModal'] = true;
        //     header('Location: /Doc_House/view/Admin/pages/Doctor.php');
        //     exit;
        // }

        $doctor = [
            'email'          => trim($_POST['doc_email']),
            'name'           => trim($_POST['doc_name']),
            'pass'       => trim($_POST['doc_pass']),
            'specialization' => trim($_POST['doc_specialization']),
            'fee'            => trim($_POST['doc_fee']),
            'phone'          => trim($_POST['doc_phone']),
            'bio'            => trim($_POST['doc_bio']),
        ];


        $userData = [
            'email'          => $email,
            'name'           => $name,
            'password'       => $pass,
            'specialization' => $specialization,
            'fee'            => $fee,
            'phone'          => $phone,
            'bio'            => $bio,
            'role'           => 'doctor',
            'dob'            => ''
        ];

        $result = addUser($userData);


        $uid  = getUserID($email);
        $spid = getSpcID($specialization);


        $doctorData = [
            'uid'  => $uid,
            'fee'  => $fee,
            'bio'  => $bio,
            'spid' => $spid
        ];

        $doctorResult = addDoctorAdmin($doctorData);



        if ($doctorResult) {
            unset(
                $_SESSION['email'],
                $_SESSION['pass'],
                $_SESSION['name'],
                $_SESSION['specialization'],
                $_SESSION['fee'],
                $_SESSION['phone'],
                $_SESSION['bio'],
                $_SESSION['emailError'],
                $_SESSION['passError'],
                $_SESSION['nameError'],
                $_SESSION['specialError'],
                $_SESSION['feeError'],
                $_SESSION['phoneError'],
                $_SESSION['bioError'],
                $_SESSION['openModal']
            );

            
        } else {
            echo "Insert failed";
        }

        header('Location: /Doc_House/view/Admin/pages/Doctor.php');
        exit;
    }


?>