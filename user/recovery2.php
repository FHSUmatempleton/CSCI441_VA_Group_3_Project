<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/recovery_db.php');
    
    $token = filter_input(INPUT_GET, 'h', FILTER_SANITIZE_STRING);
    $current_time = new DateTime();

    //  If token is invalid/expired redirect to login page
    if (!confirm_valid_token($token, $current_time->format('Y-m-d H:i:s'))) {
        $_SESSION['TokenError'] = true;
        header("Location: /index.php?a=login");
        exit();
    }
?>

<div id="wrapper">
    <main>
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


                                <form action="controller/user/recovery2.php" method="post">
                                    <div class="mb-md-5 mt-md-4 pb-5">

                                        <?php
                                            if (isset($_SESSION['Error'])) {
                                                if ($_SESSION['Error'] == "NoField") {
                                                    echo('<p>One or more fields were not filled out: </p>');
                                                    foreach ($_SESSION['ErrorFields'] as $error) {
                                                        echo("* <p>$error</p>");
                                                    }
                                                    unset($_SESSION['ErrorFields']);
                                                } else if ($_SESSION['Error'] == "NoMatch") {
                                                    echo('<p>The new password and confirm password fields do not match.');
                                                } else if ($_SESSION['Error'] == "InsecurePass") {
                                                    echo('<p>Sorry, your password must contain three of the following four:</br>
                                                    * An uppercase letter</br>
                                                    * A lowercase letter</br>
                                                    * A number</br>
                                                    * A symbol</p>');
                                                } else if ($_SESSION['Error'] == "InvalidPass") {
                                                    echo ('<p>You\'ve entered an invalid password.</p>');
                                                }
                                                unset($_SESSION['Error']);
                                            }

                                            if (isset($_SESSION['Registered'])) {
                                                echo('<p>Your password was changed successfully.</p>');
                                            }
                                        ?>

                                        <h2 class="fw-bold mb-2 text-uppercase">Password Change</h2>

                                        <div class="form-outline row form-white">
                                            <input type="password" name="newPassword" id="newPassword" class="form-control form-control-lg" />
                                            <label class="form-label" for="newPassword">New Password</label>
                                            <meter max="4" id="password-strength-meter"></meter>
                                            <p id="password-strength-text"></p>
                                        </div>

                                        <div class="form-outline row form-white">
                                            <input type="password" name="confirmPass" id="confirmPass" class="form-control form-control-lg" />
                                            <label class="form-label" for="confirmPass">Confirm Password</label>
                                            <p id="password-confirm-text"></p>
                                        </div>

                                        <button class="btn btn-outline-light btn-lg px-5" id="submitButton" type="submit" disabled>Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
<script src="js/login/recovery2.js"></script>