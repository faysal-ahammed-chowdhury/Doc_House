<?php
    require_once "C:\\xampp\htdocs\Doc_House\model\db.php";


    function addDoctorAdmin($data)
    {
        $conn = initDB();

        $uid  = (int)$data['uid'];
        $fee  = (float)$data['fee'];
        $bio  = mysqli_real_escape_string($conn, $data['bio']);
        $spid = (int)$data['spid'];

        $sql = "INSERT INTO doctor (uid, fee, bio, spid)
                VALUES ($uid, $fee, '$bio', $spid)";


        return mysqli_query($conn, $sql);
    }



    function getAllDoctorsAdmin() {
        $conn = initDB();

        $sql = "SELECT 
                    d.uid,
                    u.name AS doctor_name,
                    u.email,
                    u.phone,
                    s.name AS specialization
                FROM doctor d
                JOIN user u ON d.uid = u.uid
                JOIN specialization s ON d.spid = s.spid";

        $result = mysqli_query($conn, $sql);

        $doctors = [];
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $doctor = [];

                $doctor['uid'] = $row['uid'];
                $doctor['name'] = $row['doctor_name'];
                $doctor['email'] = $row['email'];
                $doctor['phone'] = $row['phone'];
                $doctor['specialization'] = $row['specialization'];


                array_push($doctors, $doctor);
            }
        }

        return $doctors;
    }

    function getDoctorByEmail($email) {
        $conn = initDB();
        $stmt = $conn->prepare("SELECT u.uid, u.password, d.fee, d.bio 
                                FROM user u 
                                JOIN doctor d ON d.uid = u.uid 
                                WHERE u.email = ? 
                                LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        $doctor = [];
        if($row = $result->fetch_assoc()) {
            $doctor = [
                'uid' => $row['uid'],
                'pass' => $row['password'],
                'fee' => $row['fee'],
                'bio' => $row['bio']
            ];
        }
        return $doctor ? [$doctor] : [];
    }



    function updateDoctorAdmin($data)
    {
        $conn = initDB();

        $sql = "UPDATE doctor SET 
                    fee = '{$data['fee']}',
                    bio = '{$data['bio']}',
                    spid = '{$data['spid']}'
                WHERE uid = {$data['uid']}";

        return mysqli_query($conn, $sql);
    }

    function getFilteredDoctors($search = '', $specialization = '') {
        $conn = initDB();

        $search = mysqli_real_escape_string($conn, $search);
        $specialization = mysqli_real_escape_string($conn, $specialization);

        $sql = "SELECT u.uid, u.name, u.email, u.phone, s.name AS specialization
                FROM user u
                INNER JOIN doctor d ON u.uid = d.uid
                INNER JOIN specialization s ON d.spid = s.spid
                WHERE u.role = 'doctor'";

        if ($search !== '') {
            $sql .= " AND (u.name LIKE '%$search%' OR u.email LIKE '%$search%')";
        }

        if ($specialization !== '') {
            $sql .= " AND LOWER(s.name) = LOWER('$specialization')";
        }

        $result = mysqli_query($conn, $sql);
        $doctors = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $doctors[] = $row;
        }

        return $doctors;
    }





    function deleteDoctorByUID($uid) {
        $conn = initDB();
        $uid  = (int)$uid;

        $sql = "DELETE FROM doctor WHERE uid = $uid";

        return mysqli_query($conn, $sql);
    }




?>