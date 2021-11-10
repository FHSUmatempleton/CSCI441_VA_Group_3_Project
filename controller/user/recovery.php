<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (!isset($_POST['email'])) {
        $_SESSION['Error'] = "IncorrectInfo";
        header("Location: /index.php?a=recovery.php");
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    if (get_account_exists($email)) {
        
    } else {
        $_SESSION['Error'] = "IncorrectInfo";
        header("Location: /index.php?a=recovery.php");
    }
?>