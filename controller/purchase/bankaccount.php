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
//bank account info
$info['payType'] =      filter_input(INPUT_POST, 'paymenttype', FILTER_SANITIZE_STRING); //paymenttype
$info['accountType'] =  filter_input(INPUT_POST, 'accounttype', FILTER_SANITIZE_STRING); // account type
$info['accountFN'] =    filter_input(INPUT_POST, 'accountfname', FILTER_SANITIZE_STRING); //account first name
$info['accountLN'] =    filter_input(INPUT_POST, 'accountlname', FILTER_SANITIZE_STRING); // account last name
$info['accountNum'] =   filter_input(INPUT_POST, 'accountnum', FILTER_SANITIZE_STRING); //account number
$info['routing'] =      filter_input(INPUT_POST, 'routing', FILTER_SANITIZE_STRING); // account routing


//clear out credit card info

$info['cardType'] =     "NULL"; //card type
$info['cardFN'] =       "NULL"; //card first name
$info['cardLN'] =       "NULL"; //card last name
$info['cardNum'] =      "NULL"; //card number
$info['exp'] =          "NULL"; //card exp
$info['cvv'] =          "NULL";  //cvv


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
    pay_with_account($info);
    header("Location: /index.php?a=finalize");
}

?>

<!---------TEMP PLACEMENT FOR FUNCTIONS----->
<?php 

//save personal info
function pay_with_account($array) {
    global $db;
    $query =    "UPDATE `purchase` "
                . "SET"
                //bank account info
                .   "`payment_type`            = :payType, " //pay type
                .   "`account_type`             = :accountType, " //account type
                .   "`account_fname`             = :accountFN, " //acct fname
                .   "`account_lname`             = :accountLN, " //acct lname
                .   "`account_num`             = :accountNum, " //acct num
                .   "`routing_num`             = :routing, " //routing

                //credit card info (NULL)
                .   "`delivery_date`                 = :cardType, " //card type
                .   "`delivery_timeframe`            = :cardFN, " //card fname
                .   "`delivery_address`              = :cardLN, " //card lname
                .   "`delivery_state`                = :cardNum, " //card num
                .   "`delivery_zip`                  = :exp, " //card exp
                .   "`delivery_phonenum`             = :cvv " //card cvv
                . "WHERE "
                .   "`user_id`                  = user_id; ";


    try {
        $stmt = $db->prepare($query);
        //account info
        $stmt->bindValue(':payType',            $array['payType']);
        $stmt->bindValue(':accountType',        $array['accountType']);
        $stmt->bindValue(':accountFN',          $array['accountFN']);
        $stmt->bindValue(':accountLN',          $array['accountLN']);
        $stmt->bindValue(':accountNum',         $array['accountNum']);
        $stmt->bindValue(':routing',            $array['routing']);
        

        //card info
        $stmt->bindValue(':cardType',       $array['cardType']);
        $stmt->bindValue(':cardFN',         $array['cardFN']);
        $stmt->bindValue(':cardLN',         $array['cardLN']);
        $stmt->bindValue(':cardNum',        $array['cardNum']);
        $stmt->bindValue(':exp',            $array['exp']);
        $stmt->bindValue(':cvv',            $array['cvv']);

        $stmt->execute();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}