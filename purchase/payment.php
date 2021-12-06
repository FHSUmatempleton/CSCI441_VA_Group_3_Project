
<style>
  /************DELIVERY OR PICKUP PAGE*************/
.payment_option_div{
    
    border:2px ridge white;
    width:100%;
    background-color: rgb(243, 216, 216);
    padding: 10px;

  }
.payment_header{
  background-color: gray;
  margin:-10px;
  margin-left: -30px;
  padding-top: 1px;
  height: 50px;
  border: 2px ridge white;
  
}
#payment{
    color: indianred;
    font-weight: bolder;
    margin-left: 20px;
}
/********label for radio button**** */
/*.option_label{
    border: 1px;
    font-weight: bold;
}*/

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
                <header class="payment_header">
                    <p id="payment">PAYMENT OPTIONS</p>
                </header>
                
                <!---------------Choose credit or checking-------------->

<script type="text/javascript">
    function showCheckingDiv() {
        if (document.getElementById('chkChecking').checked){
            document.getElementById('checkingDiv').style.display ='block';
            document.getElementById('creditDiv').style.display='none';
        }
        else {
            document.getElementById('checkingDiv').style.display = 'none';    
        }
    }

    function showCreditDiv() {
        if (document.getElementById('chkCredit').checked){
            document.getElementById('creditDiv').style.display ='block';
            document.getElementById('checkingDiv').style.display = 'none'; 
            
        }
        else {
            document.getElementById('creditDiv').style.display = 'none';    
        }
    }
</script>
        <!--payment amount div-->
            <div>
                <h4>Payment Amount</h4>
                <p>Amount Due* </p> 
                <h4>Select a Payment Method</h4>
            </div>  

         <!--payment method div -->
            <div>


<!-----------------------radio buttons for checking account------------->
                <label for="chkChecking">
                    <input type="radio" id="chkChecking" name="chkDiv" onclick="showCheckingDiv()" />
                    Checking Account
                </label>
<!-----------------------radio buttons for creditcard------------->
                <label for="chkCredit">
                    <input type="radio" id="chkCredit" name="chkDiv" onclick="showCreditDiv()" />
                    Credit Card
                </label>

<!-----------------------Checking Account Div------------->
                
                <div class="payment_option_div" id="checkingDiv" style="display:none">
                    <form>
                        <div class="form-group">
                            <label for="fullNameAccount">Account Holder Name</label>
                            <input type="text" class="form-control" id="fullName" placeholder="Enter account holder full name">
                        </div>

                        <div class="form-group">
                            <label for="accountNumber">Account Number</label>
                            <input type="text" class="form-control" id="accountNumber" placeholder="Enter account number">
                        </div>

                        <div class="form-group">
                            <label for="routing">Routing Number</label>
                            <input type="text" class="form-control" id="routing" placeholder="Enter routing number">
                        </div>
                        
                                    
                        <button style="background-color:indianred; border: 2px ridge white;" onclick="document.location='/purchase/transport.php'" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                        
                </div>

<!-----------------------Credit Card Div------------->
                
                <div class="payment_option_div" id="creditDiv" style="display:none">
                    <form>
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" class="form-control" id="fullName" placeholder="Enter full name as appeared on card">
                        </div>

                        <div class="form-group">
                                <label for="cardNumber">Card Number</label>
                                <input type="text" class="form-control" id="cardNumber" placeholder="Enter credit card number">
                        </div>

                        <div class="form-group">
                                <label for="CVV">CVV</label>
                                <input type="text" class="form-control" id="CVV" placeholder="Enter verification code">
                        </div>
                        
                        <div class="form-group">
                                <label for="expDate">CVV</label>
                                <input type="text" class="form-control" id="expDate" placeholder="Enter expiration date">
                        </div>
                    
                        <button style="background-color:indianred; border: 2px ridge white;" onclick="document.location='/purchase/transport.php'" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
        </div>       
            </div><!--end main-->
            



                
            
        </div> <!--end div wrapper-->
    </body>
    

</html>