<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_POST['id']) || !isset($_POST['perms'])) {
    header("Location: /index.php?a=admin");
    exit;
}

if (!isset($_SESSION['login'])) {
    header("Location: /index.php?a=login");
    exit;
}

if (get_account_by_hash($_SESSION['login'])['perms'] < 2) {
    header("Location: /index.php?a=login");
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$perms = filter_input(INPUT_POST, 'perms', FILTER_SANITIZE_NUMBER_INT);

set_perms($id, $perms);
header("Location: /index.php?a=admin");