<?php
    require_once "C:\\xampp\htdocs\Doc_House\model\db.php";

    function addUser($data)
    {
        $conn = initDB();

        $sql = "INSERT INTO user (name, email, password, phone, role, dob)
                VALUES (
                    '{$data['name']}',
                    '{$data['email']}',
                    '{$data['password']}',
                    '{$data['phone']}',
                    '{$data['role']}',
                    '{$data['dob']}'
                )";

        return mysqli_query($conn, $sql);
    }

    function getUserID($email)
    {
        $conn = initDB();
        $email = mysqli_real_escape_string($conn, trim($email));

        $sql = "SELECT uid FROM `user` WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            return (int)$row['uid'];
        }

        return null;
    }

    function updateUser($data)
    {
        $conn = initDB();

        $sql = "UPDATE user SET 
                    name = '{$data['name']}',
                    email = '{$data['email']}',
                    password = '{$data['password']}',
                    phone = '{$data['phone']}'
                WHERE uid = {$data['uid']}";

        return mysqli_query($conn, $sql);
    }


    function deleteUserByUID($uid) {
        $conn = initDB();
        $uid  = (int)$uid;

        $sql = "DELETE FROM user WHERE uid = $uid";

        return mysqli_query($conn, $sql);
    }





?>