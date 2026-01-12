<?php
function initDB()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "doc_house";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}