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
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/model/car_db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//--------access database to get user account info-----
$hash = $_SESSION['login'];
$account = get_account_by_hash($hash);

$debug = false;

// Initialize information array
$info = array();

$info['user_id'] = $account['id']; //userid
//$info['car_id'] = $car['id']; //car vin#
//$info['vin'] = $car['vin']; //car_id
$info['type'] = filter_input(INPUT_POST, 'del_type', FILTER_SANITIZE_STRING); //type
$info['date'] = filter_input(INPUT_POST, 'deliveryDate', FILTER_SANITIZE_STRING); // date
$info['time'] = filter_input(INPUT_POST, 'timeframe', FILTER_SANITIZE_STRING); //timeframe
$info['address'] = filter_input(INPUT_POST, 'del_address', FILTER_SANITIZE_STRING); //address
$info['state'] = filter_input(INPUT_POST, 'del_state', FILTER_SANITIZE_STRING); //state
$info['zip'] = filter_input(INPUT_POST, 'del_zip', FILTER_SANITIZE_STRING); //zipcode
$info['phone'] = filter_input(INPUT_POST, 'del_phone', FILTER_SANITIZE_STRING); //phone

//clear out pickup date

$info['fname'] = "NULL"; 
$info['lname'] = "NULL"; 
$info['phone'] = "NULL"; 

// Verify phone number is 10 digits without symbols or spaces.
//$info['phone'] = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING); //phonenumber
//$info['phone'] = preg_replace('/[^0-9]/', '', $info['phone']);
//if(strlen($info['phone']) != 10) {
//    if ($debug) {
//        echo('<p>Phone number invalid.</p>');
//    } else {
//        $_SESSION['Error'] = "InvalidPhone";
//        header("Location: /index.php?a=finalize");
//    }
 //   exit();
//}

if ($debug) {
    echo('<p>Missing information.</p>');
} else {
    transport_info($info);
    header("Location: /index.php?a=review");
}

?>

<!---------TEMP PLACEMENT FOR FUNCTIONS----->
<?php 

//save personal info
function transport_info($array) {
    global $db;
    $query =    "UPDATE `purchase` "
                . "SET"
                .   "`delivery_type`            = :type, "
                .   "`pickup_fname`             = :fname, "
                .   "`pickup_lname`             = :lname, "
                .   "`pickup_phone`             = :phone, "

                
                .   "`delivery_date`                 = :date, "
                .   "`delivery_timeframe`            = :time, "
                .   "`delivery_address`              = :address, "
                .   "`delivery_state`                = :state, "
                .   "`delivery_zip`                  = :zip, "
                .   "`delivery_phonenum`             = :phone "
                . "WHERE "
                .   "`user_id`                  = user_id; ";


    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':type',      $array['type']);
        $stmt->bindValue(':date',      $array['date']);
        $stmt->bindValue(':time',      $array['time']);
        $stmt->bindValue(':address',   $array['address']);
        $stmt->bindValue(':state',     $array['state']);
        $stmt->bindValue(':zip',     $array['zip']);
        $stmt->bindValue(':phone',   $array['phone']);

        
        $stmt->bindValue(':fname',      $array['fname']);
        $stmt->bindValue(':lname',      $array['lname']);
        $stmt->bindValue(':phone',      $array['phone']);

        $stmt->execute();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}
?>