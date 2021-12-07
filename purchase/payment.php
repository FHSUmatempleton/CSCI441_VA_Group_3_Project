
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

<?php
    $total=$car['price'] + 500 + 200;
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
                <a href="index.php?a=purchase" >Personal Information</a> </br>
                <a href="index.php?a=transport">Delivery or Pick Up</a> </br>
                <a href="index.php?a=review">Review Order</a> </br>
                <a href="index.php?a=payment"style = "color: black;">Payment</a> </br>   
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
</br>
        <div class="container">
            <div class="row">
                <div class="col">
                <h4>Payment Amount</h4>
                </div>

                <div class="col">
                <p style="font-weight:bold; float:right;">$ <?php echo"$total"?></p> 
                </div>
            </div>
            <h4>Select a Payment Method</h4>
        </div>

            
         <!--payment method div -->
            <div>


<!-----------------------radio buttons for checking account------------->
                <label for="chkChecking">
                    <input type="radio" id="chkChecking" name="chkDiv" onclick="showCheckingDiv()" />
                    Bank Account
                </label>
<!-----------------------radio buttons for creditcard------------->
                <label for="chkCredit">
                    <input type="radio" id="chkCredit" name="chkDiv" onclick="showCreditDiv()" />
                    Credit Card
                </label>

<!-----------------------BANK Account Div------------->
                
                <div class="payment_option_div" id="checkingDiv" style="display:none">
                    <form action="controller/purchase/bankaccount.php" method="post">

                        <div class="form-group col-md-11">
                            <input type="text" class="form-control" id="total" name="total" value="<?php echo("$total");?>" hidden> <!--total -->
                        </div>

                        <div class="form-group col-md-11">
                            <input type="text" class="form-control" id="paymenttype" name="paymenttype" value="Bank Account" hidden> <!--payment type -->
                        </div>

                        <div class= "form-group">
                            <select name = "accounttype" id="accttype">
                                <option hidden>Checking or Savings</option>
                                <option  value="Checking">Checking</option>
                                <option  value="Savings">Savings</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fNameAccount">Account Holder First Name</label>
                            <input type="text" class="form-control" id="firstName" name="accountfname" placeholder="Enter account holder first name">
                        </div>

                        <div class="form-group">
                            <label for="lNameAccount">Account Holder Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="accountlname" placeholder="Enter account holder last name">
                        </div>

                        <div class="form-group">
                            <label for="accountNumber">Account Number</label>
                            <input type="text" class="form-control" id="accountNumber" name="accountnum" placeholder="Enter account number">
                        </div>

                        <div class="form-group">
                            <label for="routing">Routing Number</label>
                            <input type="text" class="form-control" id="routing" name="routing" placeholder="Enter routing number">
                        </div>
                        
                                    
                        <button style="background-color:indianred; border: 2px ridge white;" onclick="document.location='/index.php?a=finalize'" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                        
                </div>

<!-----------------------Credit Card Div------------->
                
                <div class="payment_option_div" id="creditDiv" style="display:none">
                    <form action="controller/purchase/card.php" method="post">

                        <div class="form-group col-md-11">
                            <input type="text" class="form-control" id="total" name="total" value="<?php echo("$total");?>" hidden> <!--total -->
                        </div>

                        <div class="form-group col-md-11">
                            <input type="text" class="form-control" id="paymenttype name="paymenttype" value="Credit Card" hidden> <!-- -->
                        </div>

                        <div class= "form-group">
                            <select name = "cardtype" id="cardtype">
                                <option hidden>Choose type of card</option>
                                <option  value="Visa">Visa</option>
                                <option  value="Master Card">Master Card</option>
                                <option  value="American Express">American Express</option>
                                <option  value="Discovery">Discovery</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fName">First Name</label>
                            <input type="text" class="form-control" id="fullName" name="cardfname" placeholder="Enter first name as appeared on card"> 
                        </div>

                        <div class="form-group">
                            <label for="lName">Last Name</label>
                            <input type="text" class="form-control" id="fullName" name="cardlname" placeholder="Enter last name as appeared on card">
                        </div>

                        

                        <div class="form-group">
                                <label for="cardNumber">Card Number</label>
                                <input type="text" class="form-control" id="cardNumber" name="cardnum" placeholder="Enter credit card number">
                        </div>

                        
                        
                        <div class="form-group">
                                <label for="expDate">Expiration Date</label>
                                <input type="date" class="form-control" id="expDate" name="exp" placeholder="Enter expiration date">
                        </div>

                        <div class="form-group">
                                <label for="CVV">CVV</label>
                                <input type="text" class="form-control" id="CVV" name="cvv" placeholder="Enter verification code">
                        </div>
                    
                        <button style="background-color:indianred; border: 2px ridge white;" onclick="document.location='/index.php?a=finalize'" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
        </div>       
            </div><!--end main-->
            



                
            
        </div> <!--end div wrapper-->
    </body>
    

</html>