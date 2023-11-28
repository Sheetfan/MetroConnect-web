<?php
include "DB_connect.php";
// Query to fetch data from the database based on the selected option

$option1 = isset($_GET["option1"]) ? $_GET["option1"] : '';
$option2 = isset($_GET["option2"]) ? $_GET["option2"] : "";
$sql = "";
// Use a switch statement or if conditions to handle different options
switch ($option1) {
    case 'transactions':
        // Query to fetch data for option 1

        switch($option2){
            case "none":
                $sql = "SELECT * FROM transactionhistory WHERE User_Id = 21";
                break;
            case "3 months":
                $sql = "SELECT * FROM TransactionHistory WHERE Timestamp >= CURDATE() - INTERVAL 3 MONTH";
                break;
            case "6 months";
                $sql = "SELECT * FROM TransactionHistory WHERE Timestamp >= CURDATE() - INTERVAL 6 MONTH";
                break;
            default:
                $sql = "SELECT * FROM TransactionHistory WHERE YEAR(Timestamp) = $option2";
                break;
        }
        break;
    case 'trips':
        // Query to fetch data for option 2
        switch ($option2) {
            case "none":
                $sql = "SELECT * FROM tripdata WHERE User_Id = 21";
                break;
            case "3 months":

                $sql = "SELECT * FROM tripdata WHERE Timestamp >= CURDATE() - INTERVAL 3 MONTH";
                break;
            case "6 months";
                $sql = "SELECT * FROM tripdata WHERE Timestamp >= CURDATE() - INTERVAL 6 MONTH";
                break;
            default:
                $sql = "SELECT * FROM tripdata WHERE YEAR(Timestamp) = $option2";
                break;
        }
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch and display each record
    while ($row = $result->fetch_assoc()) {
        // echo "<p>{$row['column1']} - {$row['column2']} - {$row['column3']}</p>";

        
        if($option1 === "transactions"){
            echo '<div class="transaction-record">';
                echo '<div class="transaction-details">';
                    echo "<h3>Zone {$row["Zone"]} - {$row["Type_Of_Fare"]}</h3>";
                    echo "<p>{$row["Timestamp"]}</p>";
                    echo "<p>{$row["Transaction_Status"]}</p>";
                echo "</div>";
                echo '<div class="transaction-amount">';
                    echo "<p>R{$row["Amount"]}</p>";
                echo "</div>";
            echo "</div>";
        }
        else{
            echo '<div class="transaction-list">';
                echo '<div class="transaction-item">';
                    echo "<h3>{$row["Routes"]}</h3>";
                    echo "<p>{$row["Timestamp"]}</p>";
                    if($row["Amount"] == 0){
                        echo '<span class="trips">Trips</span>';
                    }
                    else{
                        echo '<span class="trips">' . "{$row["Amount"]}" . '</span>';
                    }
                echo "</div>";
            echo"</div>";
        }
    }
} else {
    echo "No records found";
}

// Close the connection
$conn->close();

?>