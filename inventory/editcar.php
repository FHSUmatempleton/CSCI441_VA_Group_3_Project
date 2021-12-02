<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/search_db.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/car_db.php');

	if (!isset($_POST['id'])) {
		$id = 3;
	} else {
		$id = $_POST['id'];
	}
    
    if (get_perms_by_hash($_SESSION['login']) < 1) {
        header("Location: /index.php");
    }

    if (!isset($_SESSION['login'])) {
        header("Location: /index.php");
    }

    $manufacturers  = get_all_makes();      // query unique make
    $models         = get_all_models();     // query unique model
    $colors         = get_all_colors();     // query unique colors
    $bodytypes      = get_all_bodytypes();  // query unique body type

    $car = get_car_by_id($id);
?>

<style>
    td {
        font-weight: bold;
    }
</style>

<div id="wrapper">
    <main>
        <section style="height: 100%">
            <table class="table" style="width: 50%; margin: 0px auto;" id="sortTable">
                <form action="controller/inventory/editcar.php" method="POST">
                    <tr>
                        <td>ID</td>
                        <td><?php echo $car['id'];?></td>
                    </tr>
                    <tr>
                        <td>VIN</td>
                        <td><input name="vin" id="vin" value="<?php echo $car['vin'];?>"></input></td>
                    </tr>
                    <tr>
                        <td>Year</td>
                        <td><input name="year" id="year" value="<?php echo $car['year'];?>"></input></td>
                    </tr>
                    <tr>
                        <td>Make</td>
                        <td>
                            <select id="make_search" name="manufacturer">
                                <option value="all" hidden>Manufacturer</option>
                                <?php foreach ($manufacturers as $row): ?>
                                <option value="<?php echo $row["manufacturer"] ?>"
                                    <?php if ($row["manufacturer"] == $car['manufacturer']) { echo "selected"; }?>>
                                    <?php echo (ucfirst($row["manufacturer"])) ?>
                                </option>
                                <?php endforeach;   ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Model</td>
                        <td><input name="model" id="model" value="<?php echo $car['model'];?>"></input></td>
                    </tr>
                    <tr>
                        <td>Series</td>
                        <td><input name="series" id="series" value="<?php echo $car['series'];?>"></input></td>
                    </tr>
                    <tr>
                        <td>Trim</td>
                        <td><input name="trim" id="trim" value="<?php echo $car['trim'];?>"></input></td>
                    </tr>
                    <tr>
                        <td>Condition (1-5)</td>
                        <td><input name="cond" id="cond" value="<?php echo $car['cond'];?>"></input></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><input name="price" id="price" value="<?php echo $car['price'];?>"></input></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><textarea name="description" id="description"><?php echo $car['description'];?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Cylinders</td>
                        <td><input name="cylinders" id="cylinders" value="<?php echo $car['cylinders'];?>"></input></td>
                    </tr>
                    <tr>
                        <td>Fuel</td>
                        <td><input name="fuel" id="fuel" value="<?php echo $car['fuel'];?>"></input></td>
                    </tr>
                    <tr>
                        <td>Mileage</td>
                        <td><input name="odo" id="odo" value="<?php echo $car['odo'];?>"></input></td>
                    </tr>
                    <tr>
                        <td>Drivetrain</td>
                        <td><input name="drivetrain" id="drivetrain" value="<?php echo $car['drivetrain'];?>"></input>
                        </td>
                    </tr>
                    <tr>
                        <td>Transmission</td>
                        <td><input name="transmission" id="transmission"
                                value="<?php echo $car['transmission'];?>"></input></td>
                    </tr>
                    <tr>
                        <td>Body</td>
                        <td>
                            <select id="body_search" name="body">
                                <option value="all" hidden>Body Type</option>
                                <?php foreach ($colors as $row): ?>
                                <option value="<?php echo $row["color"] ?>"
                                    <?php if ($row["color"] == $car['color']) { echo "selected"; }?>>
                                    <?php echo (ucfirst($row["color"])) ?>
                                </option>
                                <?php endforeach;   ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Color</td>
                        <td>
                            <select id="color_search" name="color">
                                <option value="all" hidden>Color</option>
                                <?php foreach ($bodytypes as $row): ?>
                                <option value="<?php echo $row["body"] ?>"
                                    <?php if ($row["body"] == $car['body']) { echo "selected"; }?>>
                                    <?php echo (ucfirst($row["body"])) ?>
                                </option>
                                <?php endforeach;   ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Image URL</td>
                        <td><input name="image_url" id="image_url" value="<?php echo $car['image_url'];?>"></input></td>
                    </tr>
                    <tr>
                        <td>Doors</td>
                        <td><input name="doors" id="doors" value="<?php echo $car['doors'];?>"></input></td>
                    </tr>
                    <tr>
                        <td>Seats</td>
                        <td><input name="seats" id="seats" value="<?php echo $car['seats'];?>"></input></td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td><input name="type" id="type" value="<?php echo $car['type'];?>"></input></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Submit"></td>
                    <tr>
                </form>
            </table>
        </section>
    </main>
</div>