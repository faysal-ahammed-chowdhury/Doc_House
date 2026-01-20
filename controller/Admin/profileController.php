<?php
require_once "C:\\xampp\htdocs\Doc_House\middleware\authMiddleware.php";
require_once "C:\\xampp\htdocs\Doc_House\middleware\adminMiddleware.php";
require_once "C:\\xampp\htdocs\Doc_House\model\Admin\UserModel.php";

$curUser = getUserByUid($_SESSION['user']['uid']);

if (!isset($curUser['uid'])) {
    echo "Something is wrong\n";
    exit();
}
