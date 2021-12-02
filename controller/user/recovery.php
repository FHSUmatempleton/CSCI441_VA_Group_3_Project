<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/recovery_db.php');
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $debug = true;

    //  To do: fix this vvv
    if (!isset($_POST['email'])) {
        $_SESSION['Error'] = "IncorrectInfo";
        header("Location: /index.php?a=recovery");
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    //  To do: fix this vvv
    if (!get_account_exists($email)) {
        $_SESSION['Error'] = "IncorrectInfo";
        header("Location: /index.php?a=recovery"); 
    }

    //--------------------------send reset link---------------------------
    //
    //  This password reset system incorporates token-based expiration.
    //
    //--------------------------------------------------------------------
        //  Retrieve userid
        $userid = get_account_userid($email);

        //  Create a recovery record
        create_recovery_record($userid);

        //  Retrieve the recovery record
        $record = get_recovery_record($userid);

        //  Password reset link
        $token = $record['token_key'];

        $url = 'https://web.gelat.in/index.php?a=recovery2&h='.$token;
        
        //  Send mail
        if ($debug) {
            echo $url;
        } else {
            mail($email, "Cartana Password Reset", $url);
        }
    
    
    //----------------------------------------------------------------

?>