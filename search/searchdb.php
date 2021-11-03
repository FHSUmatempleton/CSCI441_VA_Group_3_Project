<?php 

    //DB
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cartalog";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //require "../model/db.php"; //including php file for database
 
?>
