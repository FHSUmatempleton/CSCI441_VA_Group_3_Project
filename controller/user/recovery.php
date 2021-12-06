<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/recovery_db.php');
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $debug = true;

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    if (empty($_POST['email'])) {
        $_SESSION['Error'] = "NoField";
        header("Location: /index.php?a=recovery");
        exit();
    }
    if (!get_account_exists($email)) {
        $_SESSION['Error'] = "Unregistered";
        header("Location: /index.php?a=recovery");
        exit();
    }

    //--------------------------send reset link---------------------------
    //
    //  This password reset system incorporates token-based expiration.
    //
    //--------------------------------------------------------------------
        //  Create a recovery record
        create_recovery_record($email);

        //  Retrieve the recovery record
        $record = get_recovery_record($email);

        //  Retrieve token from recovery record
        $token = $record['token_key'];

        //  Password reset link
        if ($debug) {
            $url = 'localhost/index.php?a=recovery2&h='.$token;
        } else {
            $url = 'https://web.gelat.in/index.php?a=recovery2&h='.$token;
        }
        
        //  Send mail
        if ($debug) {
            echo $url;
        } else {
            mail($email, "Cartana Password Reset", $url);
        }
    
    
    //----------------------------------------------------------------
?>