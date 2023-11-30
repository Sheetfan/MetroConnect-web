<?php
include "DB_connect.php";

session_start();
$option1 = isset($_GET["option1"]) ? $_GET["option1"] : '';

$userId = $_SESSION["userInfo"]["User_Id"];
$sql = "SELECT * FROM notifications WHERE User_Id = $userId";
$result = $conn->query($sql);

// Check if there is data
if ($result->num_rows > 0) {
    // Fetch data
    $data = $result->fetch_assoc();

    // Generate HTML based on the received data
    if ($data) {
        echo '<div class="notifications-container">';
        while($row = $result->fetch_assoc()){
            switch($row["Message_Type"]){
                case "error":
                    echo '<div class="card error">';
                    echo    '<div class="type">' . "{$row["Message_Type"]}" . '</div>';
                    echo    '<div class="notification-massage">' . "{$row["Content"]}" . '</div>';
                    echo    '<div class="notification-timestamp">' . "{$row["Timestamp"]}" . '</div>';
                    echo '</div>';
                    
                break;
                case "warning":
                    echo '<div class="card warning">';
                    echo    '<div class="type">' . "{$row["Message_Type"]}" . '</div>';
                    echo    '<div class="notification-massage">' . "{$row["Content"]}" . '</div>';
                    echo    '<div class="notification-timestamp">' . "{$row["Timestamp"]}" . '</div>';
                    echo '</div>';
                break;
                case "success":
                    echo '<div class="card success">';
                    echo    '<div class="type">' . "{$row["Message_Type"]}" . '</div>';
                    echo    '<div class="notification-massage">' . "{$row["Content"]}" . '</div>';
                    echo    '<div class="notification-timestamp">' . "{$row["Timestamp"]}" . '</div>';
                    echo '</div>';
                    break;
                case "announcement":
                    echo '<div class="card announcement">';
                    echo    '<div class="type">' . "{$row["Message_Type"]}" . '</div>';
                    echo    '<div class="notification-massage">' . "{$row["Content"]}" . '</div>';
                    echo    '<div class="notification-timestamp">' . "{$row["Timestamp"]}" . '</div>';
                    echo '</div>';
                    break;
            }
            
        }
        echo '</div>';
    } else {
        echo "No rows found.";
    }
}
?>