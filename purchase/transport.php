<style>
    #delivery{
        font-weight: bold;
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
<!--------------------------------------------------------------------------------HTML------------------------------------------------------------------------->

<html>  
    <body>
        <div id="wrapper"> 
<!----------------------------side Navigation page------------------------------>            
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/view/purchase_nav.php');?>
<!----------------------------main page on the other side------------------------------>
            <div class="main">
                <!-------------header--------------->
                <header class="transport_header">
                    <p id="transport">DELIVERY OPTIONS</p>
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


                <span>How do you prefer to get your dream car?</span> </br>
<!-----------------------radio buttons for delivery------------->
                <div class="option_label">
                    <label for="chkDelivery" >
                        <input style="background-color: indianred; border: 2px ridge white;" type="radio" id="chkDelivery" name="chkDiv" value ="delivery" onclick="showDeliveryDiv()" />
                            Home delivery
                    </label>
                </div>
<!-----------------------radio buttons for pick up------------->
                
                <div class="option_label">
                    <label for="chkPickUp">
                        <input type="radio" id="chkPickUp" name="chkDiv" value="pickup" onclick="showPickUpDiv()" />
                        In-person Pickup
                    </label>
                </div>

<!-----------------------Delivery Div------------->
                
                <div class="option_div" id="deliveryDiv" style="display:none">
                    <form action="controller/purchase/delivery.php" method="post">

                        <div class="form-group col-md-11">
                            <input type="text" class="form-control" id="delivery" name="del_type" value="Home Delivery"readonly> <!-- -->
                        </div>

                        <div class= "form-group">
                            <label for = "deliveryDate">Choose a delivery date and time:</label>
                            <input type = "date" id="deliveryDate" name="deliveryDate"></br>
                        </div>
                        <!--time options-->
                        <div class= "form-group">
                            <select name = "timeframe" id="timeframe">
                                <option hidden>Choose time</option>
                                <option name = "timeframe1" value="Morning">Morning (between 9 AM - 12 PM)</option>
                                <option name = "timeframe2" value="Afternoon">Afternoon (between 12 PM - 3 PM)</option>
                                <option name = "timeframe3" value="Evening">Evening (between 3 PM - 6 PM)</option>
                            </select>
                        </div>
                        <div class="form-group col-md-11">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="del_address"> <!-- -->
                        </div>

                        <div class="form-group col-md-3">
                            <label for="state">State</label>
                            <input type="text" name="del_state" id="state" 
                                class="form-control form-control-lg" pattern="\D*" maxlength="2"> <!-- -->
                        </div>

                        <div class="form-group col-md-4">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" name="del_zip"> <!-- -->
                        </div>

                        <div class="form-group col-md-5">
                            <label for="phone">Phone number</label>
                            <input type="text" class="form-control" id="phone" name="del_phone" maxlength="10"> <!-- -->
                        </div>
                        <button style="background-color: indianred; border: 2px ridge white;" onclick="document.location='/index.php?a=review'" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                        
                </div>

<!-----------------------PickUp Div------------->
                
                <div class="option_div" id="pickupDiv" style="display:none">
                <form action="controller/purchase/pickup.php" method="post">
                    
                    <div class="form-group">
                            <input type="text" class="form-control" id="pickup" name="del_type" value="Pickup"readonly> <!-- -->
                    </div>


                    <div class="form-group">
                        <label for="fName">First Name</label>
                        <input type="text" class="form-control" id="fName" name="pickup_fname" placeholder="First name of the person picking up the car"> <!-- -->
                    </div>

                    <div class="form-group">
                        <label for="lName">Last Name</label>
                        <input type="text" class="form-control" id="lName" name="pickup_lname" placeholder="Last name of the person picking up the car"> <!-- -->
                    </div>
                    <div class="form-group">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="text" class="form-control" id="phoneNumber" name="pickup_phone" placeholder="Phone number of pickup person"> <!-- -->
                    </div>
                    
                
                    <button style="background-color: indianred; border: 2px ridge white;" onclick="document.location='/index.php?a=review'" type="submit" class="btn btn-primary">Submit</button>
                </form>
                </div>
            </div><!--end main-->
            



                
            
        </div> <!--end div wrapper-->
    </body>
    

</html>