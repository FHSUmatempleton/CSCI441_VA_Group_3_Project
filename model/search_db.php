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
    $query = "SELECT year, manufacturer, model, odo, price, id, color, body FROM cars ORDER BY id DESC LIMIT 25";
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

function get_all_cars_count() {
    global $db;
    $query = "SELECT COUNT(*) FROM cars;";
    try {
        $stmt = $db->prepare($query);
        $stmt -> execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

function get_cars_by_query($start, $count, $make, $priceMin, $priceMax, $odoMin, $odoMax, $yearMin, $yearMax, $body, $color) {
    global $db;
    $query = "SELECT year, manufacturer, model, odo, price, id, color, body FROM cars WHERE ";
    if ($make != "*") {
        $query .= "manufacturer = :make AND ";
    }
    if ($body != "*") {
        $query .= "body = :body AND ";
    }
    if ($color != "*") {
        $query .= "color = :color AND ";
    }
    $query .= "price BETWEEN :priceMin AND :priceMax AND ";
    $query .= "odo BETWEEN :odoMin AND :odoMax AND ";
    $query .= "year BETWEEN :yearMin AND :yearMax AND ";
    $query .= "1=1 ";
    $query .= "LIMIT :count OFFSET :start";
    try {
        $stmt = $db->prepare($query);
        if ($make != "*") {
            $stmt -> bindValue(':make', $make);
        }
        if ($body != "*") {
            $stmt -> bindValue(':body', $body);
        }
        if ($color != "*") {
            $stmt -> bindValue(':color', $color);
        }
        $stmt -> bindValue(':priceMin', $priceMin);
        $stmt -> bindValue(':priceMax', $priceMax);
        $stmt -> bindValue(':odoMin', $odoMin);
        $stmt -> bindValue(':odoMax', $odoMax);
        $stmt -> bindValue(':yearMin', $yearMin);
        $stmt -> bindValue(':yearMax', $yearMax);
        $stmt -> bindValue(':count', $count, PDO::PARAM_INT);
        $stmt -> bindValue(':start', $start, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

function get_cars_count_by_query($make, $priceMin, $priceMax, $odoMin, $odoMax, $yearMin, $yearMax, $body, $color) {
    global $db;
    $query = "SELECT COUNT(*) FROM cars WHERE ";
    if ($make != "*") {
        $query .= "manufacturer = :make AND ";
    }
    if ($body != "*") {
        $query .= "body = :body AND ";
    }
    if ($color != "*") {
        $query .= "color = :color AND ";
    }
    $query .= "price BETWEEN :priceMin AND :priceMax AND ";
    $query .= "odo BETWEEN :odoMin AND :odoMax AND ";
    $query .= "year BETWEEN :yearMin AND :yearMax AND ";
    $query .= "1=1 ";
    try {
        $stmt = $db->prepare($query);
        if ($make != "*") {
            $stmt -> bindValue(':make', $make);
        }
        if ($body != "*") {
            $stmt -> bindValue(':body', $body);
        }
        if ($color != "*") {
            $stmt -> bindValue(':color', $color);
        }
        $stmt -> bindValue(':priceMin', $priceMin);
        $stmt -> bindValue(':priceMax', $priceMax);
        $stmt -> bindValue(':odoMin', $odoMin);
        $stmt -> bindValue(':odoMax', $odoMax);
        $stmt -> bindValue(':yearMin', $yearMin);
        $stmt -> bindValue(':yearMax', $yearMax);
        $stmt -> execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

//----------get cars by color------------
function get_car_by_color ($start, $count) {
    global $db;
    $q = intval($_GET['q']);
    $query = "SELECT image_url, year, manufacturer, model, odo, price, id FROM cars WHERE color = ':color' ORDER BY id DESC LIMIT 25";
    try {
        $stmt = $db->prepare($query);
        $stmt -> bindValue(':color', $q);
        // $stmt->bindValue(':start', $start);
        // $stmt->bindValue(':count', $count);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }

}