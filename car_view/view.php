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
<!--temp place for Purchase Now button style -->
<style>
	#purchaseNowButton{
		padding: 6px 8px 6px 16px;
		text-decoration: none;
		
		font-size: 25px;
		font-weight: bolder;
		color: indianred;
		display: block;
		border: groove 7px lightgrey;
		margin-left: 84%;
		margin-bottom: 10px;
	}

	#purchaseNowButton:hover {
		box-shadow: 0 0 10px indianred; 
	}
</style>
<div class="container">
	<h1 class="mb-3 bread">Car Details</h1>
	<!--Purchase Now button--> 
	<div>
		<button id="purchaseNowButton" onclick="location='index.php?a=purchase'">Purchase Now</button> 
		
	</div>
</div>

<section class="ftco-section ftco-car-details">

	<div class="container">
		<div class="row justify-content-center">
			<?php           
                            $na = false;
                            if ($car['color'] == "black" || $car['color'] == "brown" || $car['color'] == "custom") {
                                $na = true;
                            } else if ($car['color'] == "silver") {
                                $carColor = "grey";
                            } else {
                                $carColor = $car['color'];
                            }
                    
                            switch ($car['body']) {
                                case "Pickup":
                                case "Truck":
                                    $carBody = "truck";
                                    break;
                                case "Convertible/Cabriolet":
                                    $carBody = "convertible";
                                    break;
                                case "Sport Utility Vehicle (SUV)/Multi-Purpose Vehicle (MPV)":
                                    $carBody = "suv";
                                    break;
                                case "Coupe":
                                    $carBody = "coupe";
                                    break;
                                case "Sedan/Saloon":
                                    $carBody = "sedan";
                                    break;
                                case "Crossover Utility Vehicle (CUV)":
                                    $carBody = "suv";
                                    break;
                                case "Hatchback/Liftback/Notchback":
                                    $carBody = "hatchback";
                                    break;
                                case "Cargo Van":
                                    $carBody = "van";
                                    break;
                                case "Minivan":
                                    $carBody = "minivan";
                                    break;
                                default:
                                    $na = true;
                                    break;
                            }
                            if ($na) {
                                $imgPath = "na.jpg";
                            } else {
                                $imgPath = "$carBody/$carBody-$carColor.jpg";
                            }
                    ?>
			<img src="img/search/<?php echo $imgPath;?>" width='70%' height='30%' />
			<div class="col-md-12">
				<div class="car-details">
					<div class="img rounded" style="background-image: url(images/bg_1.jpg);"></div>
					<div class="text text-center">
						<h1><?php echo($car['manufacturer'] . " " . $car['model']);?></h1>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md d-flex align-self-stretch ftco-animate">
				<div class="media block-6 services">
					<div class="media-body py-md-4">
						<div class="d-flex mb-3 align-items-center">
							<div class="icon d-flex align-items-center justify-content-center"><span
									class="flaticon-car-seat"></span></div>
							<div class="text">
								<h3 class="heading mb-0 pl-3">
									Year:
									<span><?php echo($car['year']);?></span>
								</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services">
						<div class="media-body py-md-4">
							<div class="d-flex mb-3 align-items-center">
								<div class="icon d-flex align-items-center justify-content-center"><span
										class="flaticon-dashboard"></span></div>
								<div class="text">
									<h3 class="heading mb-0 pl-3">
										Mileage:
										<span><?php echo($car['odo']);?></span>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services">
						<div class="media-body py-md-4">
							<div class="d-flex mb-3 align-items-center">
								<div class="icon d-flex align-items-center justify-content-center"><span
										class="flaticon-dashboard"></span></div>
								<div class="text">
									<h3 class="heading mb-0 pl-3">
										Body:
										<span><?php echo($car['body']);?></span>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services">
						<div class="media-body py-md-4">
							<div class="d-flex mb-3 align-items-center">
								<div class="icon d-flex align-items-center justify-content-center"><span
										class="flaticon-car-seat"></span></div>
								<div class="text">
									<h3 class="heading mb-0 pl-3">
										Color:
										<span><?php echo($car['color']);?></span>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>				
				<div class="col-md d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services">
						<div class="media-body py-md-4">
							<div class="d-flex mb-3 align-items-center">
								<div class="icon d-flex align-items-center justify-content-center"><span
										class="flaticon-pistons"></span></div>
								<div class="text">
									<h3 class="heading mb-0 pl-3">
										Transmission:
										<span><?php echo($car['transmission']);?></span>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services">
						<div class="media-body py-md-4">
							<div class="d-flex mb-3 align-items-center">
								<div class="icon d-flex align-items-center justify-content-center"><span
										class="flaticon-diesel"></span></div>
								<div class="text">
									<h3 class="heading mb-0 pl-3">
										Fuel:
										<span><?php echo($car['fuel']);?></span>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<ul class="features">
						<li class="check"><span class="ion-ios-checkmark"></span>Airconditions</li>
						<li class="check"><span class="ion-ios-checkmark"></span>Child Seat</li>
						<li class="check"><span class="ion-ios-checkmark"></span>GPS</li>
						<li class="check"><span class="ion-ios-checkmark"></span>Luggage</li>
						<li class="check"><span class="ion-ios-checkmark"></span>Music</li>
					</ul>
				</div>
				<div class="col-md-4">
					<ul class="features">
						<li class="check"><span class="ion-ios-checkmark"></span>Seat Belt</li>
						<li class="remove"><span class="ion-ios-close"></span>Sleeping Bed</li>
						<li class="check"><span class="ion-ios-checkmark"></span>Water</li>
						<li class="check"><span class="ion-ios-checkmark"></span>Bluetooth</li>
						<li class="remove"><span class="ion-ios-close"></span>Onboard computer</li>
					</ul>
				</div>
				<div class="col-md-4">
					<ul class="features">
						<li class="check"><span class="ion-ios-checkmark"></span>Audio input</li>
						<li class="check"><span class="ion-ios-checkmark"></span>Long Term Trips</li>
						<li class="check"><span class="ion-ios-checkmark"></span>Car Kit</li>
						<li class="check"><span class="ion-ios-checkmark"></span>Remote central locking</li>
						<li class="check"><span class="ion-ios-checkmark"></span>Climate control</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
	</div>
	</div>
</section>