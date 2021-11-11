<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');

    if (!isset($_SESSION['login'])) {
        header("Location: /index.php");
    }
    
    $hash = $_SESSION['login'];
    $account = get_account_by_hash($hash)[0];
?>

<div id="wrapper">
    <main>
        <!-- to do: password change? -->
        <!-- to do: account deactivation? -->

        <form action="controller/modify.php" method="post">
            <p>Cartana Member Since: <?php echo($account['created_at']); ?> </p>

            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" value="<?php echo($account['f_name']);?>">
            </br>

            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" value="<?php echo($account['l_name']);?>">
            </br>

            <label for="fname">Street Address:</label>
            <input type="text" id="staddr" name="staddr" value="<?php echo($account['st_addr']);?>">
            </br>

            <label for="state">State:</label>
            <input type="text" id="state" name="state" value="<?php echo($account['state']);?>">
            </br>

            <label for="zip">ZIP:</label>
            <input type="text" id="zip" name="zip" value="<?php echo($account['zip']);?>">
            </br>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo($account['phone']);?>">
            </br>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo($account['email']);?>">
            </br>

            <button class="btn btn-outline-dark" type="submit">Submit</button>
        </form>
    </main>
</div>