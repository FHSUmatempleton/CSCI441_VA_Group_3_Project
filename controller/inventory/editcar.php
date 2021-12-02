<?php
var_dump($_POST);

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



?>