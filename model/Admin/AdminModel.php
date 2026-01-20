<?php
    require_once "C:\\xampp\htdocs\Doc_House\model\db.php";

    
    function getOnlyAdmin()
    {
        $conn = initDB();
        $sql = "SELECT * FROM user 
                WHERE role='admin'";
        $result = mysqli_query($conn, $sql);

        $admins = [];
        if($result && mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $admin = [];

                $admin['uid'] = $row['uid'];
                $admin['name'] = $row['name'];
                $admin['email'] = $row['email'];
                $admin['phone'] = $row['phone'];
                $admin['dob'] = $row['dob'];

                array_push($admins, $admin);
            }
        }

        return $admins;
    }

    function getFilteredadmins($search='')
    {
        $conn = initDB();

        $search = mysqli_real_escape_string($conn, $search);

        $sql = "SELECT u.uid, u.name, u.email, u.phone, u.dob
                FROM user u
                WHERE u.role = 'admin'";

        if ($search !== '') {
            $sql .= " AND (u.name LIKE '%$search%' OR u.email LIKE '%$search%')";
        }


        $result = mysqli_query($conn, $sql);
        $admins = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $admins[] = $row;
        }

        return $admins;
    }

    function updateAdmin($data)
    {
        $conn = initDB();

        $uid   = (int)$data['uid'];
        $name  = mysqli_real_escape_string($conn, $data['name']);
        $email = mysqli_real_escape_string($conn, $data['email']);
        $phone = mysqli_real_escape_string($conn, $data['phone']);
        $dob   = mysqli_real_escape_string($conn, $data['dob']);

        $sql = "UPDATE user 
                SET name='$name', 
                    email='$email', 
                    phone='$phone', 
                    dob='$dob' 
                WHERE uid=$uid";

        return mysqli_query($conn, $sql);
    }


?>