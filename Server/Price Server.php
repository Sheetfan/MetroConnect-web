<?php
    include 'DB_connect.php';

    if(isset($_GET['commutertype'])){
        $commutertype = $conn->real_escape_string($_GET['commutertype']);

        $sql = "SELECT Zone, Commuter_Type, Fare_Type, Amount FROM BusFare WHERE Commuter_Type= ?";

        if($stmt=$conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $commutertype);
            $stmt->execute();
            $result=$stmt->get_result();

            if($result->num_rows > 0){
                while ($row=$result->fetch_assoc()) {
                    echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["Zone"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Commuter_Type"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Fare_Type"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Amount"]) . "</td>";
                        echo "<td>
                                <div class='price-actions'>
                                    <button class='btn-update'>Update</button>
                                    <button class='btn-delete'>Delete</button>
                                </div>
                              </td>";
                    echo "</tr>";
                }
            }else{
                echo "<tr><td colspan='5'>No fare data found</td></tr>";
            }

            $stmt->close();
        }else{
            echo "Error preparing statement: ".$conn->error;
        }

        $conn->close();
    }
?>