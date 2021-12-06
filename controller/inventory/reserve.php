<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/model/car_db.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_POST['id'])) {
    header("Location: /index.php?a=search");
    exit;
}

if (!isset($_SESSION['login'])) {
    header("Location: /index.php?a=login");
    exit;
} else {
    $uid = get_account_by_hash($_SESSION['login'])['id'];
}

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

if (get_reservation_status($id)) {
    header("Location: /index.php?a=search");
    exit;
}

set_reservation($id, $uid);
header("Location: /index.php?a=view&id=$id");