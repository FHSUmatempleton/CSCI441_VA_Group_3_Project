<?php
function register_account($array) {
    global $db;
    $query =    "INSERT IGNORE INTO "
                .   "`users` "
                . "SET "
                .   "`f_name`               = :fname, "
                .   "`l_name`               = :lname, "
                .   "`st_addr`              = :addr, "
                .   "`state`                = :state, "
                .   "`zip`                  = :zip, "
                .   "`phone`                = :phone, "
                .   "`email`                = :email, "
                .   "`password`             = :hash, "
                .   "`created_at`           = :created, "
                .   "`registration_hash`    = :reghash, "
                .   "`registered`           = :registered, "
                .   "`perms`                = :perms";
    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':fname',     $array['fname']);
        $stmt->bindValue(':lname',     $array['lname']);
        $stmt->bindValue(':addr',      $array['addr']);
        $stmt->bindValue(':state',     $array['state']);
        $stmt->bindValue(':zip',       $array['zip']);
        $stmt->bindValue(':phone',     $array['phone']);
        $stmt->bindValue(':email',     $array['email']);
        $stmt->bindValue(':hash',      $array['hash']);
        $stmt->bindValue(':created',   time());
        $stmt->bindValue(':reghash',   $array['reghash']);
        $stmt->bindValue(':registered', false);
        $stmt->bindValue(':perms', 0);
        $stmt->execute();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

function get_account_exists($email) {
    global $db;
    $query = 'SELECT * FROM users WHERE email = :email';
    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

function get_password_hash($email) {
    global $db;
    $query = 'SELECT password FROM `users` WHERE `email` = :email';
    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

function confirm_account($email, $password) {
    if (!get_account_exists($email)) {
        return false;
    } else {
        $hash = get_password_hash($email);
        return password_verify($password, $hash);
    }
}

function set_login_hash($email) {
    global $db;
    $query = 'UPDATE users SET `login_hash` = :lhash WHERE `email` = :email';
    $hash = sha256(rand());
    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':lhash', $hash);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}