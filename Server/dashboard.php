<?php
    include "DB_connect.php";
    // Query to fetch data from the database based on the selected option
    //TODO Make it connect to the in page 
    $sql = "SELECT * FROM virtualbustag WHERE User_Id = 21";
    $result = $conn->query($sql);

    // Check if there is data
    if ($result->num_rows > 0) {
        // Fetch data
        $data = $result->fetch_assoc();

    // Generate HTML based on the received data
        if ($data) {
            echo '<div class="zone-container">';
            foreach ($data as $key => $value) {
                if(!($key == "Tag_Id" || $key == "User_Id" || $key == "Stored_Value")){
                    echo '<div class="zone-card">';
                        echo "<h3>Zone ". substr($key, -1) . "</h3>";
                        echo "<p>" . "Trips:" . $value . "</p>";
                    echo '</div>';
                }
                else if($key == "Stored_Value"){
                    echo '<div class="zone-card">';
                        echo "<h3>" . "stored value" . "</h3>";
                        echo "<p>" . "Value:R" . $value . "</p>";
                    echo '</div>';
                }
            }
            echo '</div>';
        } else {
            echo "No rows found.";
        }


    } else {
        echo "No data found for the selected option";
    }

    // Close the connection
    $conn->close();
?>