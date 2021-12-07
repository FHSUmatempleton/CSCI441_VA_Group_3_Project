<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/car_db.php');

    if (!isset($_SESSION['login'])) {
        header("Location: /index.php");
    }
    
    $hash = $_SESSION['login'];
    $account = get_account_by_hash($hash);
    $car = get_car_by_id(3);
    $total=$car['price']+500+200;//total purchase price
?>


<head>
    <title>Cartana</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.html">Cartana</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="search.html" class="nav-link">Search</a></li>
                    <li class="nav-item"><a href="financing.html" class="nav-link">Financing</a></li>
                    <li class="nav-item active"><a href="cars.html" class="nav-link">Cars</a></li>
                    <li class="nav-item"><a href="revies.html" class="nav-link">Reviews</a></li>
                    <li class="nav-item"><a href="contact.html" class="nav-link">Contact us</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    <div class="container">
        <h1 class="mb-3 bread">Car Purchase Agreement</h1>
    </div>

    <section class="ftco-section ftco-car-details">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="car-details">
                        <div class="text text-center">
                            <h2><?php echo($car['manufacturer'] . " " . $car['model']);?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <p>
                This car purchase agreement has been entered into as of <?php echo date("m/d/y") ?> between Cartana Inc. (Seller)
                and <?php echo($account['f_name'] . " " . $account['l_name']);?> (Buyer).
            </p>
            <h3>Payment</h3>
            <p>
                The total purchase price to be paid by Buyer to Seller for the vehicle listed is inclusive of all down
                payments made by Buyer.
                Total purchase price is broken down as follows:
                <li>
                    Payment Due to Buyer on or before execution of this agreement:
                    <span style="font-weight:bold;">$ <?php echo($total);?></span> <!--changed price to total -->
                </li>
                <li>
                    Payments can be made via cash, money order, or with prior approval check made out to seller.
                </li>
            </p>
            <p>The vehicle being sold is as follows:
                <li>
                    <h5 class="heading mb-0 pl-3">
                        Make:
                        <span><?php echo($car['manufacturer']);?></span>
                    </h5>
                </li>
                <li>
                    <h5 class="heading mb-0 pl-3">
                        Model:
                        <span><?php echo($car['model']);?></span>
                    </h5>
                </li>
                <li>
                    <h5 class="heading mb-0 pl-3">
                        Year:
                        <span><?php echo($car['year']);?></span>
                    </h5>
                </li>
                <li>
                    <h5 class="heading mb-0 pl-3">
                        Color:
                        <span><?php echo($car['color']);?></span>
                    </h5>
                </li>
                <li>
                    <h5 class="heading mb-0 pl-3">
                        Milage:
                        <span><?php echo($car['odo']);?></span>
                    </h5>
                </li>
                <li>
                    <h5 class="heading mb-0 pl-3">
                        VIN:
                        <span><?php echo($car['vin']);?></span>
                    </h5>
                </li>
            </p>
            <p>
                Seller desires to sell the vehicle described above, Buyer accepts the above mentioned vehicle and agrees
                to price and delivery of the “Acquired Vehicle”,
                under the terms and conditions set forth below; Buyer shall take possession of same, as agreed between
                both parties on or before “Delivery Date”.
                If delivery is to be made at a date after the execution of this contract, acquired vehicle will be
                delivered in the same condition as inspection condition.
                Seller is responsible for the execution all documents presented by Buyer which are necessary to transfer
                title and registration to buyer.
            </p>
            <h3>Warranty</h3>
            <p>
                Warranties. This vehicle is sold “AS IS”, and Seller does not in any way, expressly or implied, give any
                warranties to Buyer.
            </p>
            <h3>Odometer</h3>
            <p>
                Odometer Declaration. Seller agrees that the odometer in the Acquired Vehicle now reads miles
                and to the best of Seller’s knowledge it reflects the actual mileage of the vehicle described herein.
            </p>
            <h3>Buyer Representation</h3>
            <p>
                Buyer Representation. Buyer may have an individual represent themselves for signing of this agreement as
                long as said individual provides to Seller that
                he or she has the power and authority to do so on behalf of Buyer.
            </p>
            <h3>Buyer’s Insurance & Tags</h3>
            <p>
                Buyer acknowledges that unless prohibited by applicable law, any insurance coverage, license, tags,
                plates or registration maintained by Seller on the Acquired Vehicle
                shall be canceled upon delivery of the Acquired Vehicle to, and the acceptance of, by Buyer.
            </p>
            <h3>Continuation of Warranties</h3>
            <p>
                All representations and warranties contained in this Agreement (if any) shall continue in full force and
                effect after execution of this agreement.
                If either party later learns that a warranty or representation that it made is untrue, it is under a
                duty to promptly disclose this information to the other party in writing.
                No representation or warranty contained herein shall be deemed to have been waived or impaired by any
                investigation made by or knowledge of the other party to this Agreement.
            </p>
            <h3>Indemnification</h3>
            <p>
                Indemnification of Attorneys Fees and out-of-pocket costs. Should any party materially breach this
                agreement (including representations and warranties made to the other side),
                the non-breaching party shall be indemnified by the breaching party for its reasonable attorneys fees
                and out-of-pocket costs which in any way relate to, or were precipitated by,
                the breach of this contract (including the breach of representations or warranties). This provision
                shall not limit in any way the remedies either party may have otherwise
                possessed in law or equity relative to a breach of this contract. The term “out- of-pocket costs”, as
                used in this contract, shall not include lost profits.
            </p>
            <h3>Entire Agreement</h3>
            <p>
                This Agreement, including the attachments mentioned in the body as incorporated by reference, sets forth
                the entire agreement between the Parties with regard to the subject matter hereof.
                All prior agreements, representations and warranties, express or implied, oral or written, with respect
                to the subject matter hereof, are hereby superseded by this agreement.
            </p>
            <h3>Severability</h3>
            <p>
                In the event any provision of this Agreement is deemed to be void, invalid, or unenforceable, that
                provision shall be severed from the remainder of this Agreement so as not to cause
                the invalidity or unenforceability of the remainder of this Agreement. All remaining provisions of this
                Agreement shall then continue in full force and effect.
                If any provision shall be deemed invalid due to its scope or breadth, such provision shall be deemed
                valid to the extent of the scope and breadth permitted by law.
            </p>
            <h3>Modification</h3>
            <p>
                Except as otherwise provided in this document, this agreement may be modified, superseded, or voided
                only upon the written and signed agreement of the Parties.
                Further, the physical destruction or loss of this document shall not be construed as a modification or
                termination of the agreement contained herein.
            </p>
            <h3>Acknowledgments</h3>
            <p>
                Each party acknowledges that he or she has had an adequate opportunity to read and study this Agreement,
                to consider it, to consult with attorneys if he or she has so desired.
            </p>
            <h3>Exclusive Jurisdiction</h3>
            <p>
                The Parties, by entering into this agreement, submit to jurisdiction in <?php echo($account['state']);?> for
                adjudication of any disputes and/or claims between the parties under this agreement.
                Furthermore, the parties hereby agree that the courts of <?php echo($account['state']);?> shall have exclusive
                jurisdiction over any disputes between the parties relative to this agreement,
                whether said disputes sound in contract, tort, or other areas of the law. This Agreement shall be
                interpreted under, and governed by, the laws of the state of <?php echo($account['state']);?>.
            </p>
            <h3>Acceptance</h3>
            <p>
                Both signing parties acknowledge the acceptance and agreement of all terms conditions and deliverables.
                Seller and Buyer affix their signatures as follows.
            </p>
            <p>
                <li>Cartana Inc</li>
                <li>Signature</li>
                <li><?php echo date("m/d/y") ?></li>
            </p>
            <p>
                <li><?php echo($account['f_name'] . " " . $account['l_name']);?></li>
                <li>Signature</li>
                <li><?php echo date("m/d/y") ?></li>
            </p>

            <div class="row">
                <div class="col-md-12 pills">
                    <div class="bd-example bd-example-tabs">
                        <div class="d-flex justify-content-center">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-description-tab" data-toggle="pill"
                                        href="#pills-description" role="tab" aria-controls="pills-description"
                                        aria-expanded="true">Cancel</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-manufacturer-tab" data-toggle="pill"
                                        href="#pills-manufacturer" role="tab" aria-controls="pills-manufacturer"
                                        aria-expanded="true">Submit</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade" id="pills-manufacturer" role="tabpanel"
                                aria-labelledby="pills-manufacturer-tab">
                                <p> ???</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2"><a href="#" class="logo">Cartana</span></a></h2>
                        <p> ???</p>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-5">
                        <h2 class="ftco-heading-2">Information</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">About</a></li>
                            <li><a href="#" class="py-2 d-block">Term and Conditions</a></li>
                            <li><a href="#" class="py-2 d-block">Best Price Guarantee</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Customer Support</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">FAQ</a></li>
                            <li><a href="#" class="py-2 d-block">Payment Option</a></li>
                            <li><a href="#" class="py-2 d-block">How it works</a></li>
                            <li><a href="#" class="py-2 d-block">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text">Address</span></li>
                                <li><a href="#"><span class="icon icon-phone"></span><span class="text">Phone</span></a>
                                </li>
                                <li><a href="#"><span class="icon icon-envelope"></span><span
                                            class="text">info@gmail.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
    </script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>

</body>