<?php
include "DB_connect.php";

session_start();
$option1 = isset($_GET["option1"]) ? $_GET["option1"] : '';
$option2 = isset($_GET["option2"]) ? $_GET["option2"] : "";
$sql = "";

$userId = $_SESSION["userInfo"]["User_Id"];
// Use a switch statement or if conditions to handle different options
switch ($option1) {
    case 'transactions':
        // Query to fetch data for option 1

        switch($option2){
            case "none":
                $sql = "SELECT * FROM transactionhistory WHERE User_Id = $userId";
                break;
            case "3 months":
                $sql = "SELECT * FROM TransactionHistory WHERE User_Id = $userId AND Timestamp >= CURDATE() - INTERVAL 3 MONTH";
                break;
            case "6 months";
                $sql = "SELECT * FROM TransactionHistory WHERE User_Id = $userId AND Timestamp >= CURDATE() - INTERVAL 6 MONTH";
                break;
            default:
                $sql = "SELECT * FROM TransactionHistory WHERE User_Id = $userId AND YEAR(Timestamp) = $option2";
                break;
        }
        break;
    case 'trips':
        // Query to fetch data for option 2
        switch ($option2) {
            case "none":
                $sql = "SELECT * FROM tripdata WHERE User_Id = $userId";
                break;
            case "3 months":

                $sql = "SELECT * FROM tripdata WHERE $userId AND Timestamp >= CURDATE() - INTERVAL 3 MONTH";
                break;
            case "6 months";
                $sql = "SELECT * FROM tripdata WHERE $userId AND Timestamp >= CURDATE() - INTERVAL 6 MONTH";
                break;
            default:
                $sql = "SELECT * FROM tripdata WHERE $userId AND YEAR(Timestamp) = $option2";
                break;
        }
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch and display each record
    echo '<div class = "history-container">';
    while ($row = $result->fetch_assoc()) {

        if($option1 === "transactions"){
            echo '<div class="history-card">';
                echo '<div class="info">';
                if($row["Zone"] == 0){
                    echo '<div class="zone-info">' . "{$row["Type_Of_Fare"]}" . '</div>';
                }
                else{
                    echo '<div class="zone-info">Zone'. "{$row["Zone"]}"." - " ."{$row["Type_Of_Fare"]}".'</div>';
                }
                    echo '<div class="history-timestamp">'."{$row["Timestamp"]}".'</div>';
                    echo '<div>'."{$row["Transaction_Status"]}".'</div>';
                echo "</div>";
                echo '<div class="history-amount">';
                    echo "<div>R{$row["Amount"]}</div>";
                echo "</div>";
            echo "</div>";
        }
        else{
            echo '<div class="history-card">';
                echo '<div class="info">';
                    echo '<div class="zone-info">'."{$row["Routes"]}" . '</div>';
                    echo '<div class="history-timestamp">' . "{$row["Timestamp"]}" . '</div>';
                echo "</div>";
                echo '<div class="history-amount">';
                if($row["Amount"] == 0){
                    echo "<div>R{$row["Amount"]}</div>";
                }
                else{
                    echo "<div>Trip</div>";
                }
                    
                echo "</div>";
            echo "</div>";
        }
    }
    echo "</div>";
} else {
    echo "No records found";
}

// Close the connection
$conn->close();

?>