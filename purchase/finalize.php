<style>
  /************FINALIZE PURCHASE***********/
 
  .description_header{
    background-color: rgb(166, 166, 166);
    margin:-10px;
    margin-left: -30px;
    margin-bottom:5px;
    padding-top: 1px;
    height: 50px;
    border: 1px ridge white;
  }
  #description{
    color: black;
    font-weight: bold;
    margin-left: 20px;
    font-size:30px;
}
.finalize_header{
  background-color: gray;
  margin:-10px;
  margin-left: -30px;
  padding-top: 1px;
  height: 50px;
  border: 2px ridge white;
  
}
#finalizetext{
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
    $fee = round($car['price'] * 0.0175, 2);
    $taxes = round($car['price'] * 0.0725, 2);
?>

<?php
    //get account info
    $hash = $_SESSION['login'];
    $account = get_account_by_hash($hash);
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
                <header class="finalize_header">
                    <p id="finalizetext">FINALIZE YOUR PURCHASE</p>
                </header>
                
                <div class="container">
                    <div class="row">
                        <div style="font-weight:bold;" class="col">
                        Seller:
                        </div>
                        <div style="font-weight:bold;" class="col">
                        Buyer:
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col">
                        Cartana LLC
                        </div>
                        <div class="col">
                        <?php echo($account['f_name']. " " . $account['l_name']);?>
                        </div>
                    </div>
                </div>
                <h2 style="margin-top: 3px;" class="description_header">
                    <p id="description">Vehicle Description</p>
                </h2> 
                <div class="container">
                    <p style="font-size:large;">Year: <?php echo($car['year']);?></p>
                    <p style="font-size:large;">Make: <?php echo($car['manufacturer']);?></p>
                    <p style="font-size:large;">Model: <?php echo($car['model']);?></p>
                    <p style="font-size:large;" >Vin: <?php echo($car['vin']);?></p>
                    <p style="font-size:large;" >Color: <?php echo($car['color']);?></p>
                </div>
                <h2 class="description_header">
                    <p id="description">Price Breakdown</p> 
                </h2>
                    <div class="row">
                        <div style="font-size:large;" class="col">
                        List Price:
                        </div>
                        <div style="font-weight:bold; font-size:large;" class="col text-end">
                        <?php echo('$'.number_format($car['price'], 2));?>
                        </div>
                        <div class="col"></div>
                    </div>
                

                <div class="container">
                    <div class="row">
                        <div style="font-size:large;" class="col">
                        Fee:
                        </div>
                        <div style="font-weight:bold; font-size:large;" class="col text-end">
                        <?php echo('$'.number_format($fee, 2));?>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div style="font-size:large;" class="col">
                        Taxes:
                        </div>
                        <div style="font-weight:bold; font-size:large;" class="col text-end">
                        <?php echo('$'.number_format($taxes, 2));?>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>

                <div id="total" class="container">
                    <div style="font-size:large;" class="row">
                        <div class="col">
                        Total:
                        </div>
                        <div style="font-weight:bold; font-size:large;"class="col text-end">
                        <?php echo('$'.$car['price']+$fee+$taxes);?>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>    
                <div>
                </hr>
                <h4>I have read the <a href="index.php?a=agreement">Full Purchase Agreement</a> and agreed to the terms therein.</h4>
                    <form action="controller/purchase/finalize.php" method="post">
                    <!-- <div class="form-group">
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck" name="purchase_agreement" value="yes">
                        <label class="form-check-label" for="gridCheck">
                            I have read the <a href="index.php?a=agreement">Full Purchase Agreement</a> and agreed to the terms therein.
                        </label>
                    </div> -->
                    <div style="font-color: black;" class= "form-group">
                            <select name = "finalize" id="finalize">
                                <option hidden>Please choose:</option>
                                <option  value="Yes">I agree</option>
                                <option  value="No">I do not agree</option>
                                
                            </select>
                        </div>
                    <button style="background-color:indianred; border: 2px ridge white;" onclick="document.location='/index.php?a=finalize'" type="submit" class="btn btn-primary">Finalize Purchase</button>
                    </form>

                </div>
                    
                    

                        
                    
                       
                    
            </div>
                    

                    
                    
                
                <!---------------Finalize Purchase-------------->
                

                
            
        </div> <!--end div wrapper-->
    </body>
    

</html>