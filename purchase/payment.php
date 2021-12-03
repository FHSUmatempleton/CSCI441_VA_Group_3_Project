<style>

/*header text*/
#topHeader {
  font-family: "Lucida Console", "Courier New", monospace;
  font-weight: bolder;
  font-size: 25px;
  padding-left: 10px;
 
  color:indianred;

}
/*search page wrapper div*/
#wrapper{
  position: relative;
  background-color: lightgrey;
  color: black;
  width: 50%;
  height: 100%;
  margin: auto;
  border: 1px ridge white;
}

/*****search header******/
.purchase_header{
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
  width: 15%; /*width of nav page*/
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
  margin-left: 22%; /* Set left margin the same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

/*************PERSONAL INFO ******/
.form-group{
    font-size: 1.5vw;
}

</style>
<!--------------------------------------------------------------------------------HTML------------------------------------------------------------------------->

<html>  
    <body>
        <div id="wrapper"> 
<!----------------------------side Navigation page------------------------------>            
            <div class="sidenav">
                <a href="#">CAR DETAIL BOX GOES HERE</a> </br>
                <a href="/purchase/main.php">Personal Information</a> </br>
                <a href="/purchase/transport.php">Delivery or Pick Up</a> </br>
                <a href="/purchase/payment.php" style = "color: black;">Payment</a> </br>
                <a href="/purchase/review.php">Review Order</a> </br>
                <a href="/purchase/finalize.php">FINALIZE PURCHASE</a> </br>
            </div>
<!----------------------------main page on the other side------------------------------>
            <div class="main">
                <!-------------header--------------->
                <header class="purchase_header">
                    <p id="purchase_car">PAYMENT OPTIONS</p>
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
            </div>  

         <!--payment method div -->
            <div>

                <h4>Select a Payment Method</h4></br>
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
                
                <div id="checkingDiv" style="display:none">
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
                    
                                   
                    <button onclick="document.location='/purchase/transport.php'" type="submit" class="btn btn-primary">Submit</button>
                </form>
                        
                </div>

<!-----------------------Credit Card Div------------->
                
                <div id="creditDiv" style="display:none">
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
                
                    <button onclick="document.location='/purchase/transport.php'" type="submit" class="btn btn-primary">Submit</button>
                </form>
                </div>
        </div>       
            </div><!--end main-->
            



                
            
        </div> <!--end div wrapper-->
    </body>
    

</html>