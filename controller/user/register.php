<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$debug = false;

// Verify all fields are given.
$errors = false;
if (
    !isset($_POST['email']) || !isset($_POST['password'])
    || !isset($_POST['confirmPass']) || !isset($_POST['fname'])
    || !isset($_POST['lname']) || !isset($_POST['address'])
    || !isset($_POST['state'])
    || !isset($_POST['zip']) || !isset($_POST['phone'])
    ) {
    $_SESSION['Error'] = "NoField";
    $_SESSION['ErrorFields'] = array();
    $errors = true;
}
if (!isset($_POST['email'])) {
    array_push($_SESSION['ErrorFields'], "Email");
}
if (!isset($_POST['password'])) {
    array_push($_SESSION['ErrorFields'], "Password");
}
if (!isset($_POST['confirmPass'])) {
    array_push($_SESSION['ErrorFields'], "Password Confirmation");
}
if (!isset($_POST['fname'])) {
    array_push($_SESSION['ErrorFields'], "First Name");
}
if (!isset($_POST['lname'])) {
    array_push($_SESSION['ErrorFields'], "Last Name");
}
if (!isset($_POST['address'])) {
    array_push($_SESSION['ErrorFields'], "Street Address");
}
if (!isset($_POST['state'])) {
    array_push($_SESSION['ErrorFields'], "State");
}
if (!isset($_POST['zip'])) {
    array_push($_SESSION['ErrorFields'], "ZIP Code");
}
if (!isset($_POST['phone'])) {
    array_push($_SESSION['ErrorFields'], "Phone Number");
}

if ($errors) {
    if ($debug) {
        echo('<p>Fields not filled</p>');
        echo("<p>" . var_dump($_SESSION['ErrorFields']) . "</p>");
        echo("<p>" . var_dump($_POST) . "</p>");
    } else {
        header("Location: /index.php?a=register");
    }
    exit();
}

if ($_POST['password'] != $_POST['confirmPass']) {
    if ($debug) {
        echo('<p>Passwords don\'t match.</p>');
    } else {
        $_SESSION['Error'] = "NoMatch";
        header("Location: /index.php?a=register");
    }
    exit();
}

// Initialize information array
$info = array();

// Check if email is already taken.
$info['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
if ($debug) {
    echo('<p>Attempted to get account status</p>');
}
$accountTaken = get_account_exists($info['email']);
if ($accountTaken) {
    if ($debug) {
        echo('<p>'. var_dump($accountTaken) .'</p>');
        echo('<p>Email taken.</p>');
        echo('<p>'.get_account_exists($info['email']).'</p>');
    } else {
        $_SESSION['Error'] = "AlreadyTaken";
        header("Location: /index.php?a=register");
    }
    exit();
}

// Verify password complexity and length.
$info['password'] = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$complexity = 0;
if (preg_match('@[A-Z]@', $info['password'])) {$complexity += 1;}
if (preg_match('@[a-z]@', $info['password'])) {$complexity += 1;}
if (preg_match('@[0-9]@', $info['password'])) {$complexity += 1;}
if (preg_match('@[^\w]@', $info['password'])) {$complexity += 1;}

if ($complexity < 3 || strlen($info['password']) < 8) {
    if ($debug) {
        echo('<p>Password not complex enough.</p>');
    } else {
        $_SESSION['Error'] = "InsecurePass";
        header("Location: /index.php?a=register");
    }
    exit();
}

// Verify phone number is 10 digits without symbols or spaces.
$info['phone'] = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
$info['phone'] = preg_replace('/[^0-9]/', '', $info['phone']);
if(strlen($info['phone']) != 10) {
    if ($debug) {
        echo('<p>Phone number invalid.</p>');
    } else {
        $_SESSION['Error'] = "InvalidPhone";
        header("Location: /index.php?a=register");
    }
    exit();
}

// Grab remaining information
$info['fname'] = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
$info['lname'] = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
$info['addr'] = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
$info['state'] = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
$info['zip'] = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING);

// Generate hash using PHP password_hash, which includes salt by default
$info['hash'] = password_hash($info['password'], PASSWORD_DEFAULT);

// Generate a registration hash, this is used for email verification.
$info['reghash'] = bin2hex(random_bytes(32));

// Send email here.

if ($debug) {
    echo('<p>Attempted to register account</p>');
} else {
    register_account($info);
    $_SESSION['Registered'] = true;
    header("Location: /index.php?a=login");
}


?>