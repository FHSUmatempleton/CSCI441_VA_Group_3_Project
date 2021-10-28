<?php
//$config = parse_ini_file('/var/www/config.ini');

$dsn = "mysql:host=localhost;dbname=cartalog";
$username = "root";
//$password = $config['MYSQL_PASSWORD'];
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $err = $e->getMessage();
    include($_SERVER['DOCUMENT_ROOT'].'/view/error/db_error_connect.php');
    exit;
}

function display_db_error($err) {
    global $app_path;
    include($_SERVER['DOCUMENT_ROOT'].'/view/error/db_error.php');
}


?>