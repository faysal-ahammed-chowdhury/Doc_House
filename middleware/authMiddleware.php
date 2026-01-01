<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /Doc_House/view/Auth/login.php");
    exit();
}
