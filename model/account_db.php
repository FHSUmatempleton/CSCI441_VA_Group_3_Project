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

function modify_account($array) {
    global $db;
    $query =    "UPDATE `users` "
                . "SET "
                .   "`f_name`               = :fname, "
                .   "`l_name`               = :lname, "
                .   "`st_addr`              = :addr, "
                .   "`state`                = :state, "
                .   "`zip`                  = :zip, "
                .   "`phone`                = :phone, "
                .   "`email`                = :email "
                . "WHERE "
                .   "`login_hash`           = :lhash; ";
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

function get_account_self($email, $hash) {
    $acct = get_account_by_hash($hash);
    if ($email = $acct['email']) {
        return true;
    } else {
        return false;
    }
}

function confirm_account($email, $password) {
    if (!get_account_exists($email)) {
        return false;
    } else {
        $hash = get_password_hash($email)['password'];
        return password_verify($password, $hash);
    }
}

function update_password($login_hash, $password_hash) {
    global $db;
    $query = 'UPDATE `users` SET `password` = :pword WHERE `login_hash` = :lhash';
    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':pword', $password_hash);
        $stmt->bindValue(':lhash', $login_hash);
        $stmt->execute();
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

function set_login_hash($email) {
    global $db;
    $query = 'UPDATE users SET `login_hash` = :lhash WHERE `email` = :email';
    $hash = bin2hex(random_bytes(32));
    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':lhash', $hash);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $hash;
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

function get_account_userid($email) {
    global $db;
    $query = 'SELECT id FROM `users` WHERE `email` = :email';
    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $userid = $stmt->fetch();
        return intval($userid['id']);
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

function get_account_by_hash($hash) {
    global $db;
    $query = 'SELECT * FROM `users` WHERE `login_hash` = :lhash';
    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':lhash', $hash);
        $stmt->execute();
        $account = $stmt->fetch();
        return $account;
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

function get_perms_by_hash($hash) {
    global $db;
    $query = 'SELECT perms FROM `users` WHERE `login_hash` = :lhash';
    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':lhash', $hash);
        $stmt->execute();
        $account = $stmt->fetch();
        return intval($account["perms"]);
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

function get_all_users() {
    global $db;
    $query = 'SELECT * FROM `users`';
    try {
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}

function set_perms($id, $perms) {
    global $db;
    $query = 'UPDATE `users` SET `perms` = :perms WHERE `id` = :id';
    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':perms', $perms);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    } catch (PDOException $e) {
        $err = $e->getMessage();
        display_db_error($err);
    }
}