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
$info['payType'] =      filter_input(INPUT_POST, 'paymenttype', FILTER_SANITIZE_STRING);//paymenttype
$info['accountType'] =  "NULL"; // account type
$info['accountFN'] =    "NULL"; //account first name
$info['accountLN'] =    "NULL"; // account last name
$info['accountNum'] =   "NULL"; //account number
$info['routing'] =      "NULL"; // account routing 


//credit card info

$info['cardType'] =     filter_input(INPUT_POST, 'cardtype', FILTER_SANITIZE_STRING); //paymenttype //card type
$info['cardFN'] =       filter_input(INPUT_POST, 'cardfname', FILTER_SANITIZE_STRING); //paymenttype //card first name
$info['cardLN'] =       filter_input(INPUT_POST, 'cardlname', FILTER_SANITIZE_STRING); //paymenttype //card last name
$info['cardNum'] =      filter_input(INPUT_POST, 'cardnum', FILTER_SANITIZE_STRING); //paymenttype //card number
$info['exp'] =          filter_input(INPUT_POST, 'exp', FILTER_SANITIZE_STRING); //paymenttype //card exp
$info['cvv'] =          filter_input(INPUT_POST, 'cvv', FILTER_SANITIZE_STRING); //cvv


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
    pay_with_card($info);
    header("Location: /index.php?a=finalize");
}

?>

<!---------TEMP PLACEMENT FOR FUNCTIONS----->
<?php 

//save personal info
function pay_with_card($array) {
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

                //credit card info 
                .   "`card_type`                 = :cardType, " //card type
                .   "`card_fname`            = :cardFN, " //card fname
                .   "`card_lname`              = :cardLN, " //card lname
                .   "`card_num`                = :cardNum, " //card num
                .   "`card_expiration`                  = :exp, " //card exp
                .   "`card_cvv`             = :cvv " //card cvv
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