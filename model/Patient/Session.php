<?php
require_once "db.php";

function getAllSessionByDId($did)
{
    $conn = initDB();
    $sql = "SELECT sid, did, date, start_time, end_time, slot_duration FROM session 
            WHERE did='$did'
            ORDER BY date, start_time";
    $result = mysqli_query($conn, $sql);

    $sessions = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $session = [];
            $session["sid"] = $row["sid"];
            $session["did"] = $row["did"];
            $session["date"] = $row["date"];
            $session["start_time"] = $row["start_time"];
            $session["end_time"] = $row["end_time"];
            $session["slot_duration"] = $row["slot_duration"];
            array_push($sessions, $session);
        }
    }
    return $sessions;
}

function getAllUpcomingSessionByDId($did)
{
    $conn = initDB();
    $sql = "SELECT sid, did, date, start_time, end_time, slot_duration FROM session 
            WHERE did='$did' AND date >= CURDATE()
            ORDER BY date, start_time";
    $result = mysqli_query($conn, $sql);

    $sessions = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $session = [];
            $session["sid"] = $row["sid"];
            $session["did"] = $row["did"];
            $session["date"] = $row["date"];
            $session["start_time"] = $row["start_time"];
            $session["end_time"] = $row["end_time"];
            $session["slot_duration"] = $row["slot_duration"];
            array_push($sessions, $session);
        }
    }
    return $sessions;
}

function isOldSession($sid)
{
    $conn = initDB();
    $sql = "SELECT sid FROM session 
            WHERE sid='$sid' AND date < CURDATE()";
    $result = mysqli_query($conn, $sql);

    return mysqli_num_rows($result) == 1;
}


function isSessionExistAndActive($sid)
{
    $conn = initDB();
    $sql = "SELECT status FROM session WHERE sid='$sid'";
    $result = mysqli_query($conn, $sql);

    $status = null;
    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $status = $row["status"];
        }
    }
    return (isset($status) && $status == 'open');
}

function getSessionBySId($sid)
{
    $conn = initDB();
    $sql = "SELECT sid, did, date, start_time, end_time, slot_duration FROM session WHERE sid='$sid'";
    $result = mysqli_query($conn, $sql);

    $session = [];
    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $session["sid"] = $row["sid"];
            $session["did"] = $row["did"];
            $session["date"] = $row["date"];
            $session["start_time"] = $row["start_time"];
            $session["end_time"] = $row["end_time"];
            $session["slot_duration"] = $row["slot_duration"];
        }
    }
    return $session;
}
