<?php
// Database connection parameter

    //* You should change the informaction depending on your database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "metrobus";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>