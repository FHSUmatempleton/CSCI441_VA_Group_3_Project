<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/model/account_db.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$debug = false;
// Initialize information array
$info = array();

$info['fname'] = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING); //firstname
$info['lname'] = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING); // lastname
$info['address'] = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING); //address
$info['state'] = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING); //state
$info['zip'] = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING); //zipcode

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
<?php //save personal info
function purchase_info($array) {
    global $db;
    $query =    "INSERT IGNORE INTO "
                .  "`purchase` ("
                .       "buyer_fname, "
                .       "buyer_lname, "
                .       "buyer_address, "
                .       "buyer_state, "
                .       "buyer_zip, "
                .       "buyer_phonenum, "
                .       "buyer_email, "
                . ") VALUES ( "
                .       ":fname, "
                .       ":lname, "
                .       ":address, "
                .       ":state, "
                .       ":zip, "
                .       ":phone , "
                .       ":email )";
    try {
        $stmt = $db->prepare($query);
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