<?php
session_start();
$_SESSION = [];
session_destroy();
header("Location: /Doc_House/view/Auth/login.php");
exit();
