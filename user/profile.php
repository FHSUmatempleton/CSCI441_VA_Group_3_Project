<?php
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
        <?php 
    if (array_key_exists('errors', $_POST)) {
        $errors = $_POST['errors'];
    }
?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
<section class="vh-100 gradient-custom">
<div class="container py-5 h-70">
    <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
        <div class="card-body p-5 text-center">


            <form action="controller/user/modify.php" method="post">
                <div class="mb-md-5 mt-md-4 pb-5">

                <?php if (isset($_SESSION['Error'])) {
                    if ($_SESSION['Error'] == "AlreadyTaken") {
                        echo('<p>Sorry, this account already exists.</p>');
                    } else if ($_SESSION['Error'] == "NoField") {
                        echo('<p>One or more fields were not filled out: </p>');
                        foreach ($_SESSION['ErrorFields'] as $error) {
                            echo("* <p>$error</p>");
                        }
                        unset($_SESSION['ErrorFields']);
                    } else if ($_SESSION['Error'] == "NoMatch") {
                        echo('<p>The password and confirm password fields do not match.');
                    } else if ($_SESSION['Error'] == "InsecurePass") {
                        echo('<p>Sorry, your password must contain three of the following four:</br>
                        * An uppercase letter</br>
                        * A lowercase letter</br>
                        * A number</br>
                        * A symbol</p>');
                    } else if ($_SESSION['Error'] == "InvalidPhone") {
                        echo('<p>Sorry, that phone number is invalid.');
                    }
                    unset($_SESSION['Error']);
                }
                ?>

                <h2 class="fw-bold mb-2 text-uppercase">USER SINCE</br><?php echo($account['created_at']); ?></h2>

                <div class="form-outline row form-white">
                    <input type="email" name="email" id="email" class="form-control form-control-lg" value="<?php echo($account['email']);?>">
                    <label class="form-label" for="email">Email</label>
                </div>

                <div class="form-outline row form-white">
                    <div class="col-sm">
                        <input type="text" name="fname" id="fname" class="form-control form-control-lg" value="<?php echo($account['f_name']);?>"/>
                        <label class="form-label" for="fname">First Name</label>
                    </div>
                    <div class="col-sm">
                        <input type="text" name="lname" id="lname" class="form-control form-control-lg" value="<?php echo($account['l_name']);?>"/>
                        <label class="form-label" for="lname">Last Name</label>
                    </div>
                </div>

                <div class="form-outline row form-white">
                    <input type="text" name="address" id="address" class="form-control form-control-lg" value="<?php echo($account['st_addr']);?>"/>
                    <label class="form-label" for="address">Street Address</label>
                </div>

                <div class="form-outline row form-white">
                    <div class="col-6">
                        <input type="text" name="state" id="state" class="form-control form-control-lg" pattern="\D*" maxlength="2" value="<?php echo($account['state']);?>"/>
                        <label class="form-label" for="state">State</label>
                    </div>
                    <div class="col-6">
                        <input type="number" name="zip" id="zipcode" class="form-control form-control-lg" pattern="\d*" oninput="this.value=this.value.slice(0, this.maxLength)" maxlength="5" value="<?php echo($account['zip']);?>"/>
                        <label class="form-label" for="zip">ZIP Code</label>
                    </div>
                </div>

                <div class="form-outline row form-white mb-3">
                    <input type="tel" name="phone" id="phone" class="form-control form-control-lg" value="<?php echo($account['phone']);?>"/>
                    <label class="form-label" for="phone">Phone Number</label>
                </div>

                <div class="mb-5">
                    <a href="index.php?a=changepass" class="text-white-50 fw-bold">Change Password</a>
                </div>

                <button class="btn btn-outline-light btn-lg px-5" id="submitButton" type="submit">Submit</button>
            </form>
        </div>
        </div>
    </div>
    </div>
</div>
</section>
    </main>
</div>
