
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
                        <input style="background-color: indianred; border: 2px ridge white;" type="radio" id="chkDelivery" name="chkDiv" onclick="showDeliveryDiv()" />
                            Home delivery
                    </label>
                </div>
<!-----------------------radio buttons for pick up------------->
                
                <div class="option_label">
                    <label for="chkPickUp">
                        <input type="radio" id="chkPickUp" name="chkDiv" onclick="showPickUpDiv()" />
                        In-person Pickup
                    </label>
                </div>

<!-----------------------Delivery Div------------->
                
                <div class="option_div" id="deliveryDiv" style="display:none">
                    <form>
                        <div class= "form-group">
                            <label for = "deliveryDate">Choose a delivery date and time:</label>
                            <input type = "date" id="deliveryDate" name="deliveryDate"></br>
                        </div>
                        <!--time options-->
                        <div class= "form-group">
                            <select id="year_search" onchange="selectYear()">
                                <option hidden>Choose time</option>
                                <option value=" Morning ">Morning (between 9 AM - 12 PM)</option>
                                <option value=" Afternoon ">Afternoon (between 12 PM - 3 PM)</option>
                                <option value=" Evening ">Evening (between 3 PM - 6 PM)</option>
                            </select>
                        </div>
                        <div class="form-group col-md-11">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="state">State</label>
                            <input type="text" name="state" id="state"
                            class="form-control form-control-lg" pattern="\D*" maxlength="2">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip">
                        </div>

                        <div class="form-group col-md-5">
                            <label for="phone">Phone number</label>
                            <input type="text" class="form-control" id="phone" maxlength="10">
                        </div>
                        <button style="background-color: indianred; border: 2px ridge white;" onclick="document.location='/purchase/transport.php'" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                        
                </div>

<!-----------------------PickUp Div------------->
                
                <div class="option_div" id="pickupDiv" style="display:none">
                <form>
                    <div class="form-group">
                        <label for="fName">First Name</label>
                        <input type="text" class="form-control" id="fName" placeholder="First name of the person picking up the car">
                    </div>

                    <div class="form-group">
                        <label for="lName">Last Name</label>
                        <input type="text" class="form-control" id="lName" placeholder="Last name of the person picking up the car">
                    </div>
                    <div class="form-group">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="text" class="form-control" id="phoneNumber" placeholder="Phone number of pickup person">
                    </div>
                    
                
                    <button style="background-color: indianred; border: 2px ridge white;" onclick="document.location='/purchase/transport.php'" type="submit" class="btn btn-primary">Submit</button>
                </form>
                </div>
            </div><!--end main-->
            



                
            
        </div> <!--end div wrapper-->
    </body>
    

</html>