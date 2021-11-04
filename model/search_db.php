<html>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"></html>
<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php'); //including php file for database connection
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="../search/search.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php  //get data from data base

function get_all_makes() {
    global $db; // References the global database object
    $query = "SELECT DISTINCT manufacturer FROM cars ORDER BY manufacturer";
    try {
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

function get_all_models() {
    global $db; // References the global database object
    $query = "SELECT model FROM cars ORDER BY model";
    try {
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

function get_all_bodytypes() {
    global $db; // References the global database object
    $query = "SELECT DISTINCT body FROM cars ORDER BY body";
    try {
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

function get_all_colors() {
    global $db; // References the global database object
    $query = "SELECT DISTINCT color FROM cars ORDER BY color";
    try {
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

function get_all_cars($start, $count) {
    global $db;
    $query = "SELECT image_url, year, manufacturer, model, odo, price FROM cars ORDER BY id DESC LIMIT 25";
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


// $select_make= "SELECT DISTINCT manufacturer FROM cars ORDER BY manufacturer"; //search all make from DB
// $select_model= "SELECT DISTINCT model FROM cars ORDER BY model"; // search all model from DB
// $select_bodytype= "SELECT DISTINCT body FROM cars ORDER BY body"; // search all body type from DB
// $select_color= "SELECT DISTINCT color FROM cars ORDER BY color"; // search all colors from DB

// $manufacturers = mysqli_query($conn, $select_make);  // query unique make
// $models = mysqli_query($conn, $select_model);  // query unique model
// $colors = mysqli_query($conn, $select_color);  // query unique colors
// $bodytypes = mysqli_query($conn, $select_bodytype);  // query unique body type

//$make_array = mysqli_fetch_array($manufacturers); //array for **NOT USED YET***
?>