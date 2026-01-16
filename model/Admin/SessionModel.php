<?php
    require_once "C:\\xampp\htdocs\Doc_House\model\db.php";

    function getSessionIDByDID($id)
    {
        $conn = initDB();
        $id = (int)$id;

        $sql = "SELECT sid FROM session WHERE did=$id";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return (int)$row['sid'];
        }

        return null;
    }

?>