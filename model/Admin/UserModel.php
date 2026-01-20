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

    function getAllUser()
    {
        $conn = initDB();
        $sql = "SELECT * FROM user 
                ORDER BY uid DESC 
                LIMIT 10";
        $result = mysqli_query($conn, $sql);

        $users = [];
        if($result && mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $user = [];

                $user['name'] = $row['name'];
                $user['email'] = $row['email'];
                $user['phone'] = $row['phone'];
                $user['role'] = $row['role'];

                array_push($users, $user);
            }
        }

        return $users;
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


    function getOnlyPatient()
    {
        $conn = initDB();
        $sql = "SELECT * FROM user 
                WHERE role='patient'";
        $result = mysqli_query($conn, $sql);

        $patients = [];
        if($result && mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $patient = [];

                $patient['uid'] = $row['uid'];
                $patient['name'] = $row['name'];
                $patient['email'] = $row['email'];
                $patient['phone'] = $row['phone'];
                $patient['dob'] = $row['dob'];

                array_push($patients, $patient);
            }
        }

        return $patients;
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


    function getUserByUId($uid) {
        $conn = initDB();
        $sql = "SELECT * FROM user WHERE uid='$uid'";
        $result = mysqli_query($conn, $sql);

        $foundUser = [];
        if (mysqli_num_rows($result) == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
                $foundUser["uid"] = $row["uid"];
                $foundUser["name"] = $row["name"];
                $foundUser["email"] = $row["email"];
                $foundUser["phone"] = $row["phone"];
                $foundUser["dob"] = $row["dob"];
                $foundUser["role"] = $row["role"];
                $foundUser["img"] = $row["img"];
            }
        }
        return $foundUser;
    }

    function updateUserByUid($uid, $name, $phone, $dob, $password = null) {
        $conn = initDB();

        if ($password !== null && strlen($password) > 0) {
            $sqlUser = "
                UPDATE user 
                SET name='$name', phone='$phone', dob='$dob', password='$password' 
                WHERE uid='$uid'
            ";
        } else {
            $sqlUser = "
                UPDATE user 
                SET name='$name', phone='$phone', dob='$dob'
                WHERE uid='$uid'
            ";
        }

        return mysqli_query($conn, $sqlUser);
    }

    function updateImgByUid($uid, $img_location) {
        $conn = initDB();
        $sqlUser = "UPDATE user 
                    SET img='$img_location' 
                    WHERE uid='$uid'";

        return mysqli_query($conn, $sqlUser);
    }



?>