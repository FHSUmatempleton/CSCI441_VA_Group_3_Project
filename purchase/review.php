<style>
  /************FINALIZE PURCHASE***********/
  #total{
    
    border:2px ridge white;
    width:100%;
    background-color: darkgray;
    padding: 5px;

  }
.review_header{
  background-color: gray;
  margin:-10px;
  margin-left: -30px;
  padding-top: 1px;
  height: 50px;
  border: 2px ridge white;
  
}
#review{
    color: indianred;
    font-weight: bolder;
    margin-left: 20px;
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
                <header class="review_header">
                    <p id="review">REVIEW YOUR ORDER</p>
                </header>
                <!---------------REVIEW Purchase-------------->

                <div class="container">
                    <p><?php echo($car['year'] . " " .$car['manufacturer'] . " " . $car['model']);?></p>
                    <p style="font-size:medium;" >Vin: <?php echo($car['vin']);?></p>
                    <div class="row">
                        <div class="col">
                        List Price:
                        </div>
                        <div style="font-weight:bold;" class="col">
                        <?php echo('$'.$car['price']);?>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col">
                        Fee:
                        </div>
                        <div style="font-weight:bold;" class="col">
                        $200.00
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col">
                        Taxes:
                        </div>
                        <div style="font-weight:bold;" class="col">
                        $500.00
                        </div>
                    </div>
                </div>

                <div id="total" class="container">
                    <div class="row">
                        <div class="col">
                        Total:
                        </div>
                        <div style="font-weight:bold;" class="col">
                        <?php echo('$'.$car['price']+200+500);?>
                        </div>
                    </div>
                </div>
                <a style="background-color:indianred;" class="btn btn-primary" href="index.php?a=payment" role="button">Go to Payment</a>
                
                

            </div>
            



                
            
        </div> <!--end div wrapper-->
    </body>
    

</html>