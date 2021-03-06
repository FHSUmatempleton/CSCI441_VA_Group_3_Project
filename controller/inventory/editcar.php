<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/car_db.php');

function add_error($type, $field) {
    if (!isset($_SESSION['error'])) {$_SESSION['error'] = array();}
    if (!array_key_exists($type, $_SESSION['error'])) {array_push($_SESSION['error'], $type);}
    if (!isset($_SESSION['errorfields'])) {$_SESSION['errorfields'] = array();}
    if (!array_key_exists($type, $_SESSION['errorfields'])) {$_SESSION['errorfields'][$type] = array();}
    if (!in_array($field, $_SESSION['errorfields'][$type])) {array_push($_SESSION['errorfields'][$type], $field);}
}



$checkTypes = array(
    "vin" => "VIN",
    "year" => "Year",
    "model" => "Model",
    "manufacturer" => "Make",
    "series" => "Series",
    "trim" => "Trim",
    "cond" => "Condition",
    "price" => "Price",
    "description" => "Description",
    "odo" => "Mileage"
);

foreach ($checkTypes as $key => $display) {
    if (!isset($_POST[$key])) {add_error("MissingData", $display);}
}

if (strlen($_POST['vin']) != 17) {
    add_error("InvalidFormat", "VIN");
}

if (!is_numeric($_POST['odo'])) {
    add_error("InvalidFormat", "odo");
}
if (!is_numeric($_POST['cond']) || $_POST['cond'] < 1 || $_POST['cond'] > 5) {
    add_error("InvalidFormat", "cond");
}
if (!is_numeric($_POST['price'])) {
    add_error("InvalidFormat", "price");
}
if (!is_numeric($_POST['cylinders']) && $_POST['cylinders'] != "") {
    add_error("InvalidFormat", "cylinders");
}
if (!is_numeric($_POST['doors']) && $_POST['doors'] != "") {
    add_error("InvalidFormat", "doors");
}
if (!is_numeric($_POST['seats']) && $_POST['seats'] != "") {
    add_error("InvalidFormat", "seats");
}

$data = array(
    "id" => $_POST['id'],
    "vin" => $_POST['vin'],
    "year" => $_POST['year'],
    "make" => $_POST['manufacturer'],
    "model" => $_POST['model'],
    "series" => $_POST['series'],
    "trim" => $_POST['trim'],
    "condition" => $_POST['cond'],
    "price" => $_POST['price'],
    "description" => $_POST['description'],
    "cylinders" => $_POST['cylinders'],
    "fuel" => $_POST['fuel'],
    "odo" => $_POST['odo'],
    "drivetrain" => $_POST['drivetrain'],
    "transmission" => $_POST['transmission'],
    "body" => $_POST['body'],
    "color" => $_POST['color'],
    "image_url" => $_POST['image_url'],
    "doors" => $_POST['doors'],
    "seats" => $_POST['seats'],
    "type" => $_POST['type']
);

modify_car_by_id($data['id'], $data);
header("Location: /index.php?a=editcar&id=" . $data['id']);

?>