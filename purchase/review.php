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
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/view/purchase_nav.php');?>
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
                        <div style="font-weight:bold;" class="col text-end">
                        <?php echo('$'.number_format($car['price'], 2));?>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col">
                        Fee:
                        </div>
                        <div style="font-weight:bold;" class="col text-end">
                        <?php $fee = round($car['price'] * 0.0175, 2); echo "$".number_format($fee, 2);?>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col">
                        Taxes:
                        </div>
                        <div style="font-weight:bold;" class="col text-end">
                        <?php $taxes = round($car['price'] * 0.0725, 2); echo "$".number_format($taxes, 2);?>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>

                <div id="total" class="container" style="border-style: none;">
                    <div class="row">
                        <div class="col">
                        Total:
                        </div>
                        <div style="font-weight:bold;" class="col text-end">
                        <?php echo('$'.number_format($car['price']+$fee+$taxes, 2));?>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>
                <a style="background-color:indianred; border-style: none;" class="btn btn-primary" href="index.php?a=payment" role="button">Go to Payment</a>
                
                

            </div>
            



                
            
        </div> <!--end div wrapper-->
    </body>
    

</html>