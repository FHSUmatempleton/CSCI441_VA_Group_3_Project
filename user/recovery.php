<section class="vh-100 gradient-custom">
    <div class="container py-5 h-70">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-x1-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <form action="controller/user/recovery.php" method="post">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <?php
                                    if(isset($_SESSION['Error'])) {
                                        if ($_SESSION['Error'] == "NoField") {
                                            echo '<p>Unfilled field.</p>';
                                        }
                                        if ($_SESSION['Error'] == "Unregistered") {
                                            echo '<p>Unregistered email</p>';
                                        }
                                        unset($_SESSION['Error']);
                                    }
                                ?>

                                <h2 class="fw-bold mb-2 text-uppercase">Password Recovery</h2>
                                <p class="text-white-50 mb-5">Please enter the email tied to your account.</p>

                                <div class="form-outline form-white mb-4">
                                    <input type="email" name="email" id="typeEmailX" class="form-control form-control-lg" />
                                    <label class="form-label" for="typeEmailX">Email</label>
                                </div>

                                <button class="btn btn-outline-light btn-lg px-5" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>