<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "attendancesystem";
    $port = "3307";


    $conn = new mysqli($host,$user,$password,$database,$port);
    if ($conn->connect_error) {
        echo "Seems like you have not configure the database properly. failed to connect to the database:".$conn->connect_error;
    }
?>
