<?php
function create_recovery_record($email) {
    global $db;

    // Generate token key...
    $token_key = bin2hex(random_bytes(32));

    // Get start/end times...
    $start_time = new DateTime();
    $end_time = (clone $start_time)->add(new DateInterval('PT1H'));    // expiration = 1 hour

    $query =    'INSERT INTO password_recovery (token_key, start_time, end_time, email)
                VALUES (:token_key, :start_time, :end_time, :email)';
    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':token_key', $token_key);
        $stmt->bindValue(':start_time', $start_time->format('Y-m-d H:i:s'));
        $stmt->bindValue(':end_time', $end_time->format('Y-m-d H:i:s'));
        $stmt->execute();
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

function get_recovery_record($email) {
    global $db;
    $query = 'SELECT * FROM `password_recovery` WHERE `email` = :email ORDER BY id DESC';
    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $record = $stmt->fetch();
        return $record;
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

function get_rrecord_email($token_key) {
    global $db;
    $query = 'SELECT email FROM `password_recovery` WHERE `token_key` = :token_key ORDER BY id DESC';
    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':token_key', $token_key);
        $stmt->execute();
        $result = $stmt->fetch();
        return strval($result['email']);
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

function confirm_valid_token($token_key, $current_time) {
    global $db;
    $query =    'SELECT * FROM `password_recovery` WHERE `token_key` = :token_key 
                AND :current_time BETWEEN `start_time` AND `end_time` ';
    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':token_key', $token_key);
        $stmt->bindValue(':current_time', $current_time);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result != false) {
            $result = true;
        }
        return $result;
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}
?>