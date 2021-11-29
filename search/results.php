<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php'); //including php file for database connection

$color_results  = get_car_by_color (0, 25); //get result filtered by color


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

?>

<div class="row">
    <?php
                        foreach($color_results as $row): ?>
    <div class="column">


        <a href="#">
            <div class="card text-right" id="result_card">
                <img class="card-img-top" src=<?php echo('"'.$row['image_url'].'"');?> alt="Vehicle Image">
                <div class="card-body">
                    <p class="card-text" style="text-transform:uppercase;" id="results_yearmakemodel_text">
                        <?php echo(''.$row['year'].'  '.$row['manufacturer'].' '.$row['model']);?> </p>
                    <!--year and make and model-->
                    <p class="card-text">Mileage: <?php echo(''.$row['odo']);?></p>
                    </p>
                    <!--mileage-->
                    <p class="card-text">ID: <?php echo(''.$row['id']);?> </p>

                </div>
            </div>
        </a>

    </div>
    <?php endforeach; ?>
</div>