<html>
<!--bootstrap-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</html>

<!----------include files to get id of car and to mirror car info from view page-->
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/car_db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');
	$user = get_account_by_hash($_SESSION['login'])['id'];
    $id = get_reservation_car_by_user($user)['id'];
	
	$car = get_car_by_id($id);
?>
<!----------include files to get user account and to mirror user info from profile page-->
<?php
    //require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
    //require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');

    //if (!isset($_SESSION['login'])) {
     //   header("Location: /purchase/main.php"); 
    //}
    
    $hash = $_SESSION['login'];
    $account = get_account_by_hash($hash);
?>


<!--------------------------------------------------------------------------------HTML------------------------------------------------------------------------->

<html>

<body>
    <div id="wrapper">
        <!----------------------------side Navigation page------------------------------>
            <?php include_once($_SERVER['DOCUMENT_ROOT'].'/view/purchase_nav.php');?>
        <!-------------header--------------->
        <header class="purchase_header">
            <p id="topHeader">PURCHASE CAR</p>

        </header>
        <!----------------------------main page on the other side------------------------------>
        <div class="main">

            <!---------------Personal information form-------------->
            <form action="controller/purchase/purchase.php" method="post">
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname"
                        value="<?php echo($account['f_name']);?>">
                </div>

                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname"
                        value="<?php echo($account['l_name']);?>">
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" class="form-control" id="email" name="email"
                        value="<?php echo($account['email']);?>">
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="<?php echo($account['st_addr']);?>">
                </div>

                <div class="form-group col-md-3">
                    <label for="state">State</label>
                    <input type="text" name="state" id="state" class="form-control form-control-lg" pattern="\D*"
                        maxlength="2" value="<?php echo($account['state']);?>" />
                </div>

                <div class="form-group col-md-4">
                    <label for="zip">Zip</label>
                    <input type="text" class="form-control" id="zip" name="zip" value="<?php echo($account['zip']);?>">
                </div>

                <div class="form-group col-md-5">
                    <label for="phone">Phone number</label>
                    <input type="text" class="form-control" id="phone" name="phone" maxlength="10"
                        value="<?php echo($account['phone']);?>">
                </div>
                <button style="background-color: indianred; border: none;" type="submit"
                    class="btn btn-primary">Submit</button>
        </div></br>

        </form>

        <!---------------Choose Delivery or Pick Up-------------->

    </div>






    </div>
    <!--end div wrapper-->
</body>


</html>