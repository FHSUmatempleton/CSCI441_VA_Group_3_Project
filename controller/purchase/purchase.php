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
//access database to get user account info
$hash = $_SESSION['login'];
$account = get_account_by_hash($hash);

$debug = false;

// Initialize information array
$info = array();

$info['user_id'] = $account['id']; //userid
$info['car_id'] = $car['id']; //car vin#
$info['vin'] = $car['vin']; //car_id
$info['fname'] = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING); //firstname
$info['lname'] = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING); // lastname
$info['address'] = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING); //address
$info['state'] = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING); //state
$info['zip'] = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING); //zipcode
$info['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

// Verify phone number is 10 digits without symbols or spaces.
$info['phone'] = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING); //phonenumber
$info['phone'] = preg_replace('/[^0-9]/', '', $info['phone']);
if(strlen($info['phone']) != 10) {
    if ($debug) {
        echo('<p>Phone number invalid.</p>');
    } else {
        $_SESSION['Error'] = "InvalidPhone";
        header("Location: /index.php?a=purchase");
    }
    exit();
}

if ($debug) {
    echo('<p>Missing information.</p>');
} else {
    purchase_info($info);
    header("Location: /index.php?a=transport");
}

?>

<!---------TEMP PLACEMENT FOR FUNCTIONS----->
<?php 
//save userid at the beggining

/*function insert_userid($user_id)
{
    global $db;
    $query =    "INSERT IGNORE INTO "
                .       "`purchase` ("
                .       "`user_id`"
                . ") VALUES ("
                .       ":user_id)";
                try {
                    $stmt = $db->prepare($query);
                    $stmt->bindValue(':user_id',     $user_id);

                    $stmt->execute();
                    $stmt->closeCursor();
                } catch (PDOException $e) {
                    $err = $e->getMessage();
                    display_db_error($err);
                }
}*/

//save personal info
function purchase_info($array) {
    global $db;
    $query =    "INSERT IGNORE INTO "
                .       "`purchase` ("
                .       "`user_id`, "
                .       "`car_id`, "
                .       "`vin`, "
                .       "`buyer_fname`, "
                .       "`buyer_lname`, "
                .       "`buyer_address`, "
                .       "`buyer_state`, "
                .       "`buyer_zip`, "
                .       "`buyer_phonenum`, "
                .       "`buyer_email`"
                . ") VALUES ("
                .       ":user_id, "
                .       ":car_id, "
                .       ":vin, "
                .       ":fname, "
                .       ":lname, "
                .       ":address, "
                .       ":state, "
                .       ":zip, "
                .       ":phone, "
                .       ":email)";
    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':user_id',   $array['user_id']);
        $stmt->bindValue(':car_id',    $array['car_id']);
        $stmt->bindValue(':vin',       $array['vin']);
        $stmt->bindValue(':fname',     $array['fname']);
        $stmt->bindValue(':lname',     $array['lname']);
        $stmt->bindValue(':address',   $array['address']);
        $stmt->bindValue(':state',     $array['state']);
        $stmt->bindValue(':zip',       $array['zip']);
        $stmt->bindValue(':phone',     $array['phone']);
        $stmt->bindValue(':email',     $array['email']);
        $stmt->execute();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}
?>