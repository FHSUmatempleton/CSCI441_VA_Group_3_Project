<?php
function get_car_by_id($id) {
    global $db;
    $query = "SELECT * FROM cars WHERE id = :id";
    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $car = $stmt->fetch();
        $stmt->closeCursor();
        return $car;
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

function modify_car_by_id($id, $array) {
    global $db;
    $query = "UPDATE `cars` SET "
            . "vin = :vin, "
            . "year = :year, "
            . "manufacturer = :make, "
            . "model = :model, "
            . "series = :series, "
            . "`trim` = :tri, "
            . "cond = :cond, "
            . "price = :price, "
            . "description = :description, "
            . "cylinders = :cylinders, "
            . "fuel = :fuel, "
            . "odo = :odo, "
            . "drivetrain = :drivetrain, "
            . "transmission = :transmission, "
            . "body = :body, "
            . "color = :color, "
            . "image_url = :url, "
            . "doors = :doors, "
            . "seats = :seats, "
            . "type = :type "
            . "WHERE id = :id";
    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':vin',     $array['vin']);
        $stmt->bindValue(':year',     $array['year']);
        $stmt->bindValue(':make',     $array['make']);
        $stmt->bindValue(':model',     $array['model']);
        $stmt->bindValue(':series',     $array['series']);
        $stmt->bindValue(':tri',     $array['trim']);
        $stmt->bindValue(':cond',     $array['condition']);
        $stmt->bindValue(':price',     $array['price']);
        $stmt->bindValue(':description',     $array['description']);
        $stmt->bindValue(':cylinders',     $array['cylinders']);
        $stmt->bindValue(':fuel',     $array['fuel']);
        $stmt->bindValue(':odo',     $array['odo']);
        $stmt->bindValue(':drivetrain',     $array['drivetrain']);
        $stmt->bindValue(':transmission',     $array['transmission']);
        $stmt->bindValue(':body',     $array['body']);
        $stmt->bindValue(':color',     $array['color']);
        $stmt->bindValue(':url',     $array['image_url']);
        $stmt->bindValue(':doors',     $array['doors']);
        $stmt->bindValue(':seats',     $array['seats']);
        $stmt->bindValue(':type',     $array['type']);
        $stmt->bindValue(':id',     $id);
        $stmt->execute();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

?>