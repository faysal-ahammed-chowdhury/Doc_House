<?php
    session_start();
    require_once 'C:\\xampp\htdocs\Doc_House\model\Admin\AdminModel.php';
    require_once 'C:\\xampp\htdocs\Doc_House\model\Admin\UserModel.php';

    // delete
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'deleteAdmin') {

        $uid = isset($_POST['uid']) ? (int)$_POST['uid'] : 0;
        if (!$uid) {
            echo 'Invalid UID';
            exit;
        }

        $userDeleted = deleteUserByUID($uid);


        if ($userDeleted) {
            echo 'delete';
        } else {
            echo 'Delete failed';
        }
        exit;
    }

        // Updata

        if (isset($_POST['action']) && $_POST['action'] === 'update') {
            $uid = intval($_POST['uid'] ?? 0);
            $name = trim($_POST['admin_name'] ?? '');
            $email = trim($_POST['admin_email']);
            $phone = trim($_POST['admin_phone']);
            $dob = trim($_POST['admin_dob']);

            if ($uid <= 0 || $name === '' || $email === '' || $phone === '' || $dob === '') {
                echo 'error';
                exit;
            }


            $result = updateAdmin([
                'uid' => $uid,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'dob' => $dob
            ]);

            echo $result ? 'updated' : 'error';
            exit;
        }

    
    // Filter
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'filterDoctors') {
        header('Content-Type: application/json');

        $search = trim($_POST['search'] ?? '');

        $admins = getFilteredadmins($search);

        if (!empty($admins)) {
            echo json_encode([
                'status' => 'success',
                'admins' => $admins
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'admins' => []
            ]);
        }
        exit;
    }



    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = trim($_POST['admin_email']);
        $name = trim($_POST['admin_name']);
        $pass = trim($_POST['admin_pass']);
        $phone = trim($_POST['admin_phone']);
        $dob = trim($_POST['admin_dob']);


        $emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

        if (empty($email)) {
            $_SESSION['emailError'] = 'Enter Your Email ';
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Admin.php');
            exit;
        }
        elseif(!preg_match($emailRegex, $email)){
            $_SESSION['emailError'] = 'Enter A Valid Email Address';
            $_SESSION['email'] = $email;
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Admin.php');
            exit;
        }
        else{
            $_SESSION['email'] = $email;
            $_SESSION['openModal'] = true;
        }



        if (empty($pass)) {
            $_SESSION['passError'] = 'Enter Your Password';
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Admin.php');
            exit;
        }
        elseif(strlen($pass) < 6){
            $_SESSION['passError'] = 'Password At Least 6 characters';
            $_SESSION['pass'] = $pass;
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Admin.php');
            exit;
        }
        else{
            $_SESSION['pass'] = $pass;
            $_SESSION['openModal'] = true;
        }



        if (empty($name)) {
            $_SESSION['nameError'] = 'Enter Your Name';
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Admin.php');
            exit;
        }else{
            $_SESSION['name'] = $name;
            $_SESSION['openModal'] = true;
        }


        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);

        if (empty($phone)) {
            $_SESSION['phoneError'] = 'Enter your phone number';
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Admin.php');
            exit;
        } 
        elseif (strlen($cleanPhone) < 11 || strlen($cleanPhone) > 15) {
            $_SESSION['phoneError'] = 'Enter a valid phone number (11-15 digits)';
            $_SESSION['phone'] = $phone;
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Admin.php');
            exit;
        } 
        else {
            $_SESSION['phone'] = $phone;
            $_SESSION['openModal'] = true;
        }


        if (empty($dob)) {
            $_SESSION['dobError'] = 'Enter Your DOB';
            $_SESSION['openModal'] = true;
            header('Location: /Doc_House/view/Admin/pages/Admin.php');
            exit;
        }else{
            $_SESSION['dob'] = $dob;
            $_SESSION['openModal'] = true;
        }

        $userData = [
            'email'          => $email,
            'name'           => $name,
            'password'       => $pass,
            'phone'          => $phone,
            'role'           => 'admin',
            'dob'            => $dob
        ];

        var_dump($userData);

        $result = addUser($userData);

        if($result)
        {
            unset(
                $_SESSION['email'],
                $_SESSION['pass'],
                $_SESSION['name'],
                $_SESSION['phone'],
                $_SESSION['emailError'],
                $_SESSION['passError'],
                $_SESSION['nameError'],
                $_SESSION['phoneError'],
                $_SESSION['openModal']
            );
        }


        header('Location: /Doc_House/view/Admin/pages/Admin.php');
        exit;

    }


?>