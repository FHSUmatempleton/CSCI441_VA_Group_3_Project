<section class="vh-100 gradient-custom">
<div class="container py-5 h-70">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">

                    <div class="mb-md-5 mt-md-4 pb-5">
                        <?php
                            if(isset($_SESSION['Registered'])) {
                                //echo('<p>Please check your email for the registration link!</p>');
                                unset($_SESSION['Registered']);
                            }
                            if(isset($_SESSION['Error'])) {
                                echo('<p>Incorrect email or password.</p>');
                                unset($_SESSION['Error']);
                            }
                            if (isset($_SESSION['TokenError'])) {
                                echo('<p>Invalid/outdated token.</p>');
                                unset($_SESSION['TokenError']);
                            }
                        ?>

                        <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                        <p class="text-white-50 mb-5">Please enter your login and password!</p>

                        <form action="controller/user/login.php" method="post">
                            <div class="form-outline form-white mb-4">
                                <input type="email" name="email" id="typeEmailX" class="form-control form-control-lg" />
                                <label class="form-label" for="typeEmailX">Email</label>
                            </div>

                            <div class="form-outline form-white mb-4">
                                <input type="password" name="password" id="typePasswordX" class="form-control form-control-lg" />
                                <label class="form-label" for="typePasswordX">Password</label>
                            </div>

                            <div class="form-outline form-white mb-4">
                                <input type="checkbox" name="login_persist" id="login_persist"/>
                                <label class="form-label" for="login_persist">Stay signed in</label>
                            </div>

                            <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="index.php?a=recovery">Forgot password?</a></p>

                            <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                        </form>

                    </div>

                    <div>
                        <p class="mb-0">Don't have an account? <a href="index.php?a=register" class="text-white-50 fw-bold">Sign Up</a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</section>