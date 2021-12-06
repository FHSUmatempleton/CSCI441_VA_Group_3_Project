<!--------PICKUP OPTIONS------>
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

$info['type'] = filter_input(INPUT_POST, 'del_type', FILTER_SANITIZE_STRING); //type
$info['fname'] = filter_input(INPUT_POST, 'pickup_fname', FILTER_SANITIZE_STRING); // fname
$info['lname'] = filter_input(INPUT_POST, 'pickup_lname', FILTER_SANITIZE_STRING); //lname
$info['phone'] = filter_input(INPUT_POST, 'pickup_phone', FILTER_SANITIZE_STRING); //phone
//if user chose pickup option, clear out delivery field
$info['delDate'] = "NULL"; 
$info['delTime'] = "NULL";
$info['delAddress'] = "NULL";
$info['deLState'] = "NULL";
$info['delZip'] = "NULL";
$info['delPhone'] = "NULL";




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
    transport_info2($info);
    header("Location: /index.php?a=review");
}

?>

<!---------TEMP PLACEMENT FOR FUNCTIONS----->
<?php 

//save personal info
function transport_info2($array) {
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
                .   "`delivery_phonenum`             = :delphone "
                .  "WHERE "
                .   "`user_id`                  = user_id; ";


    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':type',       $array['type']);
        $stmt->bindValue(':fname',      $array['fname']);
        $stmt->bindValue(':lname',      $array['lname']);
        $stmt->bindValue(':phone',      $array['phone']);

        //$stmt->bindValue(':type',      $array['type']);
        $stmt->bindValue(':date',      $array['date']);
        $stmt->bindValue(':time',      $array['time']);
        $stmt->bindValue(':address',   $array['address']);
        $stmt->bindValue(':state',     $array['state']);
        $stmt->bindValue(':zip',       $array['zip']);
        $stmt->bindValue(':delphone',  $array['delPhone']);


        $stmt->execute();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}
?>