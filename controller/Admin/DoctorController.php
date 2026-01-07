<?php
    session_start();   

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = trim($_POST['doc_email']);
        $name = trim($_POST['doc_name']);
        $pass = trim($_POST['doc_pass']);
        $specialization = trim($_POST['doc_specialization']);
        $fee = trim($_POST['doc_fee']);
        $phone = trim($_POST['doc_phone']);
        $bio = trim($_POST['doc_bio']);

        $emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

        if (empty($email)) {
            $_SESSION['emailError'] = 'Enter Your Email Address';
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
            header('Location: /Doc_House/view/Admin/pages/Doctor.php');
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
            header('Location: /Doc_House/view/Admin/pages/Doctor.php');
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
            header('Location: /Doc_House/view/Admin/pages/Doctor.php');
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
            header('Location: /Doc_House/view/Admin/pages/Doctor.php');
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
            header('Location: /Doc_House/view/Admin/pages/Doctor.php');
        }



        if (empty($phone)) {
            $_SESSION['phoneError'] = 'Enter Your Phone Number';
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Doctor.php');
            exit;
        }
        elseif(!is_numeric($phone) || strlen($phone) < 11){
            $_SESSION['phoneError'] = 'Enter a valid phone number';
            $_SESSION['phone'] = $phone;
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Doctor.php');
            exit;
        }
        else{
            $_SESSION['phone'] = $phone;
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Doctor.php');
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
            header('Location: /Doc_House/view/Admin/pages/Doctor.php');
        }
    }
?>