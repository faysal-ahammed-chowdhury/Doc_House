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



?>