<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');

    if (!isset($_SESSION['login'])) {
        header("Location: /index.php");
    }
    
    $hash = $_SESSION['login'];
    $account = get_account_by_hash($hash);
?>

<div id="wrapper">
    <main>
        <!-- to do: password change? -->
        <!-- to do: account deactivation? -->

        <p>Date/time of registration: <?php echo($account['created_at']); ?> </p>
        <p>UserId: <?php echo($account['id']); ?> </p>
        <p>First Name: <?php echo($account['f_name']); ?> </p>
        <p>Last Name: <?php echo($account['l_name']); ?> </p>
        <p>Street Address: <?php echo($account['st_addr']); ?> </p>
        <p>State: <?php echo($account['state']); ?> </p>
        <p>ZIP Code: <?php echo($account['zip']); ?> </p>
        <p>Phone Number: <?php echo($account['phone']); ?> </p>
        <p>Email: <?php echo($account['email']); ?> </p>
    </main>
</div>