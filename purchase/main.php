<style>
    /*header text*/
    #topHeader {
        font-family: "Lucida Console", "Courier New", monospace;
        font-weight: bolder;
        font-size: 25px;
        padding-left: 10px;

        color: indianred;

    }

    /*search page wrapper div*/
    #wrapper {
        position: relative;
        background-color: lightgrey;
        color: black;
        width: 50%;
        height: 100%;
        margin: auto;
        border: 1px ridge white;
    }

    /*****search header******/
    .purchase_header {
        background-color: gray;
        margin-left: 20%;
        padding-top: 1px;
        height: 50px;
    }

    /*****body*******/
    body {
        font-family: "Lato", sans-serif;
    }

    /***********side navigation********/
    .sidenav {
        height: 100%;
        margin-left: 20%;
        width: 15%;
        /*width of nav page*/
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: indianred;
        overflow-x: hidden;
        padding-top: 5px;
        border: ridge 1px white;
    }

    .sidenav a {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 25px;
        font-weight: bolder;
        color: rgb(164, 164, 164);
        display: block;
        border-top: ridge 1px lightgrey;
        margin: 5px;

    }

    .sidenav a:hover {
        color: black;
    }

    /************main**********/
    .main {
        margin-left: 22%;
        /* Set left margin the same as the width of the sidenav */
        font-size: 28px;
        /* Increased text to enable scrolling */
        padding: 0px 10px;
    }

    /*************PERSONAL INFO ******/
    .form-group {
        font-size: 1.5vw;
    }
</style>
<!----------include files to get id of car and to mirror car info from view page-->
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/car_db.php');
	if (!isset($_GET['id'])) {
		$id = 3;
		//echo("<script>location.href = 'index.php?a=search';</script>");
	} else {
		$id = $_GET['id'];
	}
	
	$car = get_car_by_id($id);
?>
<!----------include files to get user account and to mirror user info from profile page-->
<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');
    
    $hash = $_SESSION['login'];
    $account = get_account_by_hash($hash);
?>

<!--------------------------------------------------------------------------------HTML------------------------------------------------------------------------->

<html>

<body>
    <div id="wrapper">
        <!----------------------------side Navigation page------------------------------>
        <div class="sidenav">
            <a href="" style="color:white;" id="carDetails">
                <img>
                <p><?php echo($car['year'] . " " .$car['manufacturer'] . " " . $car['model']);?></p>

                <p><?php echo('List Price: $'.$car['price']);?></p>

            </a>
            </br>
            <a href="/purchase/main.php" style="color: black;">Personal Information</a> </br>
            <a href="/purchase/transport.php">Delivery or Pick Up</a> </br>
            <a href="/purchase/payment.php">Payment</a> </br>
            <a href="/purchase/review.php">Review Order</a> </br>
            <a href="/purchase/finalize.php">FINALIZE PURCHASE</a> </br>
        </div>
        <!-------------header--------------->
        <header class="purchase_header">
            <p id="topHeader">PURCHASE CAR</p>

        </header>
        <!----------------------------main page on the other side------------------------------>
        <div class="main">

            <!---------------Personal information form-------------->
            <form>
                <div class="form-group">
                    <label for="fName">First Name</label>
                    <input type="text" class="form-control" id="fName" value="<?php echo($account['f_name']);?>">
                </div>

                <div class="form-group">
                    <label for="lName">Last Name</label>
                    <input type="text" class="form-control" id="lName" placeholder="last name...">
                </div>

                <div class="form-group">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="form-group">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>

                <div class="form-group">
                    <label for="inputAddress2">Address 2</label>
                    <input type="text" class="form-control" id="inputAddress2"
                        placeholder="Apartment, studio, or floor">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">City</label>
                        <input type="text" class="form-control" id="inputCity">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">State</label>
                        <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip">Zip</label>
                        <input type="text" class="form-control" id="inputZip">
                    </div>
                </div></br>

                <button onclick="document.location='/purchase/transport.php'" type="submit"
                    class="btn btn-primary">Submit</button>
            </form>

            <!---------------Choose Delivery or Pick Up-------------->

        </div>






    </div>
    <!--end div wrapper-->
</body>


</html>