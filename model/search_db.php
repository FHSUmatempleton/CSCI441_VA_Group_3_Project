
<?php 

require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php'); //including php file for database connection

//*******************get all distinct MAKE from table  in DB**************/
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

//*******************get all distinct MODELS from table  in DB**************/
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
//*******************get all distinct BODYTYPES from table  in DB**************/
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
//*******************get all distinct COLORS from table  in DB**************/
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

//********************************************DISPLAY DATA***********************************/

//**********get all year, url, model, mileage, price in order to display in search results for default cards */
function get_all_cars($start, $count) {
    global $db;
    $query = "SELECT image_url, year, manufacturer, model, odo, price, id FROM cars ORDER BY id DESC LIMIT 25";
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

//----------get cars by color------------
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


function get_car_by_color_black ($start, $count) {
    global $db;
    $k = "black";
    $query = "SELECT image_url, year, manufacturer, model, odo, price, id FROM cars WHERE color = '{$k}' ORDER BY id DESC LIMIT 25";
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