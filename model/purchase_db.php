<?php
function get_tx_by_user($id) {
    global $db;
    $query = "SELECT * FROM purchase WHERE `user_id` = :id;";
    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}