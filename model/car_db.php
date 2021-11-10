<?php
function get_car($id) {
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
?>