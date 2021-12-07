<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');
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
	#purchaseNowButton {
		padding: 0px 10px 0px 10px;
		text-decoration: none;

		font-size: 25px;
		font-weight: bolder;
		color: indianred;
		display: block;
		border: solid #666 3px;
		margin-left: 84%;
		margin-bottom: 10px;
		border-radius: 10%;
	}

	.sty {
		padding: 0px 10px 0px 10px;
		text-decoration: none;

		font-size: 25px;
		font-weight: bolder;
		color: indianred;
		display: block;
		margin-left: 84%;
		margin-bottom: 10px;
		border-radius: 10%;
	}

	#purchaseNowButton:hover {
		box-shadow: 0 0 10px indianred;
	}
</style>


<div id="wrapper">
	<div class="container">
		<h1 class="mb-3 bread">Car Details</h1>
		<!--Reserve button-->
		<?php
			if (get_reservation_status($car['id'])) {
				$time = new DateTime(get_reservation_time($car['id'])); 
				$timeExpire = $time->add(new DateInterval('PT30M'));
				$timeNow = new DateTime(date('Y-m-d H:i:s'));
				if ($timeNow > $timeExpire) {
					delete_reservation($car['id']);
				}
			}
		?>

		<?php if (get_reservation_status($car['id'])): ?>
		<?php if (get_reservation_user_by_car($car['id']) == get_account_by_hash($_SESSION['login'])['id']): ?>
		<?php
		$timeDiff = $timeExpire->diff($timeNow);
		
		?>
		<div class="sty">Reserved for
			<div id="time_container"><?php echo $timeDiff->format('%I:%S');?></div>
		</div>
		<form action="index.php?a=purchase" method="post">
			<input id="id" name="id" hidden value="<?php echo $car['id'];?>">
			<input type="submit" id="purchaseNowButton" value="Purchase">
		</form>
		<?php else: ?>
		<?php endif; ?>
		<?php else: ?>
		<div>
			<form action="/controller/inventory/reserve.php" method="post">
				<input id="id" name="id" hidden value="<?php echo $car['id'];?>">
				<input type="submit" id="purchaseNowButton" value="Reserve">
			</form>
		</div>
		<?php endif; ?>
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
</div>

<script>
	function updateTimer(expire) {

		var timer = document.getElementById("time_container");
		var now = new Date(Date.now());
		var time_to_expire = (expire.getTime() - now.getTime()) / 1000;
		var seconds = time_to_expire % 60;
		var remain = time_to_expire - seconds;
		if (remain < 60) {
			var minutes = 0;
		} else {
			var minutes = remain / 60;
		}
		console.log(minutes + ":" + seconds);
		timer.innerHTML = minutes + ":" + seconds);


	};
	window.onload = function () {
		var timer = document.getElementById("time_container").innerHTML;
		var time_split = timer.split(':');
		var seconds_to_expire = (parseInt(time_split[0], 10) * 60) + parseInt(time_split[1], 10);
		var expire = new Date(Date.now());
		expire.setSeconds(expire.getSeconds() + seconds_to_expire);
		var timer_obj = document.getElementById("time_container");

		setInterval(function () {
				var now = new Date(Date.now());
				var time_to_expire = (expire.getTime() - now.getTime()) / 1000;
				var seconds = time_to_expire % 60;
				var remain = time_to_expire - seconds;
				var remain = time_to_expire - seconds;
				if (remain < 60) {
					var minutes = 0;
				} else {
					var minutes = remain / 60;
				}
				console.log(minutes + ":" + seconds);
				timer.innerHTML = minutes + ":" + seconds);
		}, 1000);

	};
</script>