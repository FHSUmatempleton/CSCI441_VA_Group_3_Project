<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if either field is not there.
if (!isset($_POST['email']) || !isset($_POST['password'])) {
    $_SESSION['Error'] = "IncorrectInfo";
    header("Location: /index.php?a=login");
}

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

if (confirm_account($email, $password)) {
    $hash = set_login_hash($email);
    // Set login to not expire for one week.
    setcookie("login", $hash, time() + (60 * 60 * 24 * 7));
    header("Location: /index.php");
} else {
    $_SESSION['Error'] = "IncorrectInfo";
    header("Location: /index.php?a=login");
}

?>