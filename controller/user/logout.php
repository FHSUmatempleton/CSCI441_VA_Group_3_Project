<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_COOKIE['login'])) {
        setcookie('login', false, time(), '/');
    }
    if (isset($_SESSION['login'])) {
        unset($_SESSION['login']);
    }
    header("Location: /index.php?a=login");
?>