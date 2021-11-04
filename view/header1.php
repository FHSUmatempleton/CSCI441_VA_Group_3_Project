<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // If we have a login cookie but nothing in the session, copy it.
    if (isset($_COOKIE['login']) && !isset($_SESSION['login'])) {
        $_SESSION['login'] = $_COOKIE['login'];

    // If the session login info is mismatched, prefer cookie.
    } else if (isset($_COOKIE['login]']) && isset($_SESSION['login']) && ($_COOKIE['login'] != $_SESSION['login'])) {
        $_SESSION['login'] = $_COOKIE['login'];
    }
?>
<!doctype html>
<html>
	<head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <title> <?= isset($PageTitle) ? "Cartana - " . $PageTitle : "Cartalog"?></title>
        <link rel="shortcut icon" href="img/cartana_icon.ico" />
		<?php include_once('model/utils.php'); ?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="css/main.css" rel="stylesheet" />
