<?php
    include "DB_connect.php";
    $option = isset($_GET['option']) ? $_GET['option'] : '';

    $sql = "";
    switch ($option) {
        case 'transactions':
            // Query to fetch data for option 1
            $sql = "SELECT DISTINCT YEAR(Timestamp) AS year FROM transactionhistory WHERE User_Id = 21";
            break;

        case 'trips':
            // Query to fetch data for option 2
            $sql = "SELECT DISTINCT YEAR(Timestamp) AS year FROM tripdata WHERE User_Id = 21";
            break;
    }
// $sql = "SELECT DISTINCT YEAR(Timestamp) AS year FROM transactionhistory WHERE User_Id = 21";
    $result = $conn->query($sql);

    // Fetch data and store it in an array
    $data = array();
    while ($row = $result->fetch_assoc()) {
        foreach ($row as $key => $value) {
            $data[] = $value;
        }
    }
    

// Close connection


    // Send data as JSON
    // Return the JSON response
    
    // header('Content-Type: application/json');
    echo json_encode($data);
    $conn->close();
?>