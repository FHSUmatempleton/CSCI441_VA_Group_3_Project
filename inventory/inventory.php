<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');
    
    if (get_perms_by_hash($_SESSION['login']) < 1) {
        header("Location: /index.php");
    }

    if (!isset($_SESSION['login'])) {
        header("Location: /index.php");
    }
    

?>