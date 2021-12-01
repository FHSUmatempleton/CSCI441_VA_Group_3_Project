<?php
function create_recovery_record($userid) {
    global $db;
    $query =    "INSERT IGNORE INTO "
                .   " `password_recovery` "
                .   "SET"
                .   " `userid`              = :userid, "
                .   " `token_key`           = :token_key, "
                .   " `start_time`          = :start_time, "
                .   " `end_time`            = :end_time";
    try {
        $stmt = $db->prepare($query);

        // Generate token key...
        $token_key = bin2hex(random_bytes(32));

        // Get start/end times...
        $start_time = new DateTime();
        $end_time = (clone $start_time)->add(new DateInterval('PT1H'));    // expiration = 1 hour

        $stmt->bindValue(':userid', $userid);
        $stmt->bindValue(':token_key', $token_key);
        $stmt->bindValue(':start_time', $start_time->format('Y-m-d H:i:s'));
        $stmt->bindValue(':end_time', $end_time->format('Y-m-d H:i:s'));
        $stmt->execute();
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

function get_recovery_record($userid) {
    global $db;
    $query = 'SELECT * FROM `password_recovery` WHERE `userid` = :userid';
    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':userid', $userid);
        $stmt->execute();
        $record = $stmt->fetch();
        return $record;
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}
?>