

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
<!--------------------------------------------------------------------------------HTML------------------------------------------------------------------------->

<html>  
    <body>
        <div id="wrapper"> 
<!----------------------------side Navigation page------------------------------>            
<div class="sidenav">
                <a href="" style = "color:white;" id="carDetails">
                    <img>
                    <p><?php echo($car['year'] . " " .$car['manufacturer'] . " " . $car['model']);?></p>
                    
                    <p><?php echo('List Price: $'.$car['price']);?></p>

                </a> 
            </br>
                <a href="index.php?a=purchase" style = "color: black;">Personal Information</a> </br>
                <a href="index.php?a=transport">Delivery or Pick Up</a> </br>
                <a href="index.php?a=payment">Payment</a> </br>
                <a href="index.php?a=review">Review Order</a> </br>
                <a href="index.php?a=finalize">FINALIZE PURCHASE</a> </br>
            </div>
<!----------------------------main page on the other side------------------------------>
            <div class="main">
                <!-------------header--------------->
                <header class="purchase_header">
                    <p id="purchase_car">REVIEW YOUR ORDER</p>
                </header>
                <!---------------REVIEW Purchase-------------->
                <div>
                    <p><?php echo($car['year'] . " " .$car['manufacturer'] . " " . $car['model']);?></p>
                    <p><?php echo('List Price: $'.$car['price']);?></p>
                    <p>Fees:</p>
                    <p>$200.00</p>
                    <p>Tax </p>
                    <p>500</p>
                    <p>Total</p>
                    <p>$</p>

                    <button type="submit" class="btn btn-primary">Place Order</button>

                </div>

            </div>
            



                
            
        </div> <!--end div wrapper-->
    </body>
    

</html>