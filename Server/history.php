<?php
include "DB_connect.php";
// Query to fetch data from the database based on the selected option

$option = isset($_GET['option']) ? $_GET['option'] : '';
$sql = ""; 
// Use a switch statement or if conditions to handle different options
switch ($option) {
    case 'transactions':
        // Query to fetch data for option 1
        $sql = "SELECT * FROM transactionhistory WHERE User_Id = 21";
        break;

    case 'trips':
        // Query to fetch data for option 2
        $sql = "SELECT * FROM tripdata WHERE User_Id = 21";
        break;

}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch and display each record
    while ($row = $result->fetch_assoc()) {
        // echo "<p>{$row['column1']} - {$row['column2']} - {$row['column3']}</p>";

        
        if($option === "transactions"){
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
                    if($row["Amount"] === 0){
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