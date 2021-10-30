<?php
$dsn = "mysql:host=localhost;dbname=cartalog";

if (PHP_OS == "Linux" && gethostname() == "web") {
    $username = "webuser";
    $password = parse_ini_file('/var/www/config.ini')['MYSQL_PASSWORD'];
} else {
    $username = "root";
    $password = "";
}
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