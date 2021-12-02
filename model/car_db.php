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

function modify_car_by_id($id, $data) {
    global $db;
    $query = "UPDATE `cars` SET "
            . "vin = :vin, "
            . "year = :year, "
            . "manufacturer = :make, "
            . "model = :model, "
            . "series = :series, "
            . "trim = :trim, "
            . "condition = :condition, "
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
        $stmt->bindValue(':fname',     $array['fname']);
        $stmt->bindValue(':lname',     $array['lname']);
        $stmt->bindValue(':addr',      $array['addr']);
        $stmt->bindValue(':state',     $array['state']);
        $stmt->bindValue(':zip',       $array['zip']);
        $stmt->bindValue(':phone',     $array['phone']);
        $stmt->bindValue(':email',     $array['email']);
        $stmt->bindValue(':lhash',     $array['hash']);
        $stmt->execute();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

?>