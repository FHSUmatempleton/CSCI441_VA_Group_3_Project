<!--display error-->
<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
?>

<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/search_db.php');
 ?>
<script type="text/javascrip" src="../js/search/search.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php

//get data
$results_by_color = get_car_from_color (0, 25); //filter by color
$results_by_model = get_car_from_model (0, 25); //filter by model
//$results_by_year = get_car_from_year (0, 25); // filter by year
$results_by_bodytype = get_car_from_bodytype (0, 25); //filter by bodytype 
//$results_by_mileage = get_car_from_mileage (0, 25); //filter by mileage
?>

<!---------------display results when dropdown selected: COLOR------------>

<?php
    foreach($results_by_color as $row): 
?>
<div class="row">
<div class="column">
    <a href="#">
    <div>
    <div class="card text-right" id="result_card" >
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



<!-------------display results when dropdown selected: MODEL------------->


<?php
    foreach($results_by_model as $row): 
?>
<div class="row">
<div class="column">
    <a href="#">
    <div>
    <div class="card text-right" id="result_card_model">
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

<!------------display results when dropdown selected: BODY TYPE----------->
<?php
    foreach($results_by_bodytype as $row): 
?>
<div class="row">
<div class="column">
    <a href="#">
    <div>
    <div class="card text-right" id="result_card_body">
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



<?php 
//----------get cars by color------------
function get_car_from_color ($start, $count) {
    global $db;
    $SURE = $_POST['KEY'];
    echo var_dump($k) . "<br>";
    $k = trim($k);
    $query = "SELECT image_url, year, manufacturer, model, odo, price FROM cars WHERE color ='{$SURE}' ORDER BY id DESC LIMIT 25";
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
?>