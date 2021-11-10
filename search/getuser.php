<?php error_reporting(-1); ?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>



<?php
$dsn = "mysql:host=localhost;dbname=cartalog";

if (PHP_OS == "Linux" && gethostname() == "web") {
    $username = "webuser";
    $password = parse_ini_file('/var/www/config.ini')['MYSQL_PASSWORD'];
} else {
    $username = "root";
    $password = "";
}
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $err = $e->getMessage();
    include($_SERVER['DOCUMENT_ROOT'].'/view/error/db_error_connect.php');
    exit;
}

function display_db_error($err) {
    global $app_path;
    include($_SERVER['DOCUMENT_ROOT'].'/view/error/db_error.php');
}


?>

<?php


function get_car_by_color ($start, $count) {
    global $db;
    $q = intval($_GET['q']);
    $query = "SELECT image_url, year, manufacturer, model, odo, price, id FROM cars WHERE color = '{$q}' ORDER BY id DESC LIMIT 25";
    try {
        $stmt = $db->prepare($query);
        // $stmt->bindValue(':start', $start);
        // $stmt->bindValue(':count', $count);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }

}
/*
$q = intval($_GET['q']);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cartalog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


mysqli_select_db($conn,"cartalog");
$select_color= "SELECT * FROM cars WHERE color = '".$q."'";
$colors = mysqli_query($conn, $select_color); */

$colors = get_car_by_color (0,10);
?>
    <?php
    foreach($colors as $row): 
?>
<div class="row">
<div class="column">
    <a href="#">
    <div>
    <div class="card text-right" id="result_card_color" >
        <img class="card-img-top" src=<?php echo('"'.$row['image_url'].'"');?> alt="Vehicle Image">
        <div class="card-body">
        <p class="card-text" style="text-transform:uppercase;" id="results_yearmakemodel_text"><?php echo(''.$row['year'].'  '.$row['manufacturer'].' '.$row['model']);?> </p> <!--year and make and model-->
        <p class="card-text">Price: $ <?php echo(''.$row['price']);?></p> <!--price-->
        <p class="card-text">Mileage: <?php echo(''.$row['odo']);?></p></p> <!--mileage-->
        </div>
    </div>
    </a>
</div>
</div>
<?php endforeach; ?>

</body>
</html>