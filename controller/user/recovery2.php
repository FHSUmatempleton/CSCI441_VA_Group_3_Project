<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$debug = false;

// To do: verify token has correct url
// To do: verify token is not expired


// Verify all fields are given.
$errors = false;
if (
    !isset($_POST['curPassword']) || !isset($_POST['newPassword'])
    || !isset($_POST['confirmPass'])
    ) {
    $_SESSION['Error'] = "NoField";
    $_SESSION['ErrorFields'] = array();
    $errors = true;
}
if (!isset($_POST['curPassword'])) {
    array_push($_SESSION['ErrorFields'], "Current Password");
}
if (!isset($_POST['newPassword'])) {
    array_push($_SESSION['ErrorFields'], "New Password");
}
if (!isset($_POST['confirmPass'])) {
    array_push($_SESSION['ErrorFields'], "Password Confirmation");
}

$account = get_account_by_hash($_SESSION['login']);
if (!confirm_account($account['email'], $_POST['curPassword'])) {
    $_SESSION['Error'] = "InvalidPass";
    header("Location: /index.php?a=crecovery2");
}

if ($errors) {
    if ($debug) {
        echo('<p>Fields not filled</p>');
        echo("<p>" . var_dump($_SESSION['ErrorFields']) . "</p>");
        echo("<p>" . var_dump($_POST) . "</p>");
    } else {
        header("Location: /index.php?a=crecovery2");
    }
    exit();
}



if ($_POST['newPassword'] != $_POST['confirmPass']) {
    if ($debug) {
        echo('<p>Passwords don\'t match.</p>');
    } else {
        $_SESSION['Error'] = "NoMatch";
        header("Location: /index.php?a=crecovery2");
    }
    exit();
}

// Initialize information array
$info = array();

// Verify password complexity and length.
$info['newPassword'] = filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_STRING);
$complexity = 0;
if (preg_match('@[A-Z]@', $info['newPassword'])) {$complexity += 1;}
if (preg_match('@[a-z]@', $info['newPassword'])) {$complexity += 1;}
if (preg_match('@[0-9]@', $info['newPassword'])) {$complexity += 1;}
if (preg_match('@[^\w]@', $info['newPassword'])) {$complexity += 1;}

if ($complexity < 3 || strlen($info['newPassword']) < 8) {
    if ($debug) {
        echo('<p>Password not complex enough.</p>');
    } else {
        $_SESSION['Error'] = "InsecurePass";
        header("Location: /index.php?a=crecovery2");
    }
    exit();
}

// Generate hash using PHP password_hash, which includes salt by default
$phash = password_hash($info['newPassword'], PASSWORD_DEFAULT);

// Send email here.

if ($debug) {
    echo('<p>Attempted to register account</p>');
} else {
    update_password($_SESSION['login'], $phash);
    $_SESSION['Registered'] = true;
    header("Location: /index.php?a=crecovery2");
}


?>