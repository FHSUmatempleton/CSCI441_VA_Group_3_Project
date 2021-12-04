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
                <a href="/purchase/transport.php" style = "color: black;">Delivery or Pick Up</a> </br>
                <a href="/purchase/payment.php">Payment</a> </br>
                <a href="/purchase/review.php">Review Order</a> </br>
                <a href="/purchase/finalize.php">FINALIZE PURCHASE</a> </br>
            </div>
<!----------------------------main page on the other side------------------------------>
            <div class="main">
                <!-------------header--------------->
                <header class="purchase_header">
                    <p id="purchase_car">HOW DO YOU WANT TO GET YOUR CAR?</p>
                </header>
                
                <!---------------Choose Delivery or Pick Up-------------->

<script type="text/javascript">
    function showDeliveryDiv() {
        //var chkDelivery = document.getElementById("chkDelivery");
        //var deliveryDiv = document.getElementById("deliveryDiv");
        //deliveryDiv.style.display = chkDelivery.checked ? "block" : "none";
        if (document.getElementById('chkDelivery').checked){
            document.getElementById('deliveryDiv').style.display ='block';
            document.getElementById('pickupDiv').style.display='none';
        }
        else {
            document.getElementById('deliveryDiv').style.display = 'none';    
        }
    }

    function showPickUpDiv() {
        //var chkDelivery = document.getElementById("chkPickUp");
        //var pickupDiv = document.getElementById("pickupDiv");
        //pickupDiv.style.display = chkPickUp.checked ? "block" : "none";
        if (document.getElementById('chkPickUp').checked){
            document.getElementById('pickupDiv').style.display ='block';
            document.getElementById('deliveryDiv').style.display = 'none'; 
            
        }
        else {
            document.getElementById('pickupDiv').style.display = 'none';    
        }
    }
</script>


                <span>How would you prefer to get your dream car?</span> </br>
<!-----------------------radio buttons for delivery------------->
                <label for="chkDelivery">
                    <input type="radio" id="chkDelivery" name="chkDiv" onclick="showDeliveryDiv()" />
                    Home delivery
                </label>
<!-----------------------radio buttons for pick up------------->
                <label for="chkPickUp">
                    <input type="radio" id="chkPickUp" name="chkDiv" onclick="showPickUpDiv()" />
                    In-person Pickup
                </label>

<!-----------------------Delivery Div------------->
                
                <div id="deliveryDiv" style="display:none">
                    <form>
                        <label for = "deliveryDate">Choose a delivery date and time:</label>
                        <input type = "date" id="deliveryDate" name="deliveryDate">
                        <!--time options-->
                        <select id="year_search" onchange="selectYear()">
                            <option hidden>Choose time</option>
                            <option value=" BETWEEN 2020 AND 3000 ">Morning (between 9 AM - 12 PM)</option>
                            <option value=" BETWEEN 2010 AND 2019 ">Afternoon (between 12 PM - 3 PM)</option>
                            <option value=" BETWEEN 2005 AND 2009 ">Evening (between 3 PM - 6 PM)</option>
                        </select>
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                        </div>

                        <div class="form-group">
                            <label for="inputAddress2">Address 2</label>
                            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
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
                        </div>
                        <div class="form-group">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="text" class="form-control" id="phoneNumber" placeholder="800-123-4567">
                        </div>
                        <button onclick="document.location='/purchase/transport.php'" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                        
                </div>

<!-----------------------PickUp Div------------->
                
                <div id="pickupDiv" style="display:none">
                <form>
                    <div class="form-group">
                        <label for="fName">First Name</label>
                        <input type="text" class="form-control" id="fName" placeholder="first name...">
                    </div>

                    <div class="form-group">
                        <label for="lName">Last Name</label>
                        <input type="text" class="form-control" id="lName" placeholder="last name...">
                    </div>
                    <div class="form-group">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="text" class="form-control" id="phoneNumber" placeholder="800-123-4567">
                    </div>
                    
                
                    <button onclick="document.location='/purchase/transport.php'" type="submit" class="btn btn-primary">Submit</button>
                </form>
                </div>
            </div><!--end main-->
            



                
            
        </div> <!--end div wrapper-->
    </body>
    

</html>