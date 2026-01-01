<php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $email = filter_input(INPUT_POST, 'doc_email', FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['doc_pass']);
    $name = trim($_POST['doc_name']);
    $specialization = trim($_POST['doc_specialization']);
    $fee = trim($_POST['doc_fee']);
    $phone = trim($_POST['doc_phone']);
    $bio = trim($_POST['doc_bio']);

    $errors = [];

    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters";
    }

    if (empty($name)) {
        $errors['name'] = "Full name is required";
    }

    if (empty($specialization)) {
        $errors['specialization'] = "Specialization is required";
    }

    if (empty($fee)) {
        $errors['fee'] = "Consultation fee is required";
    } elseif (!is_numeric($fee)) {
        $errors['fee'] = "Fee must be a number";
    }

    if (empty($phone)) {
        $errors['phone'] = "Phone number is required";
    } elseif (!preg_match('/^\+?[0-9\s\-]+$/', $phone)) {
        $errors['phone'] = "Invalid phone number format";
    }

    if (empty($bio)) {
        $errors['bio'] = "Biography is required";
    }

    if (!empty($errors)) {
        foreach ($errors as $field => $message) {
            echo "<p>$field error: $message</p>";
        }
        exit;
    }
?>