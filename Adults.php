<?php
    include 'Server/DB_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Adults</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Style/commuterType.css">
</head>
<body>
    <aside class="sidebar">
        <!-- Sidebar content -->
        <h1>MetroConnect Admin</h1>
        <nav class="sidebar-nav">
            <ul>
                <li><a href="Admin Dashboard.php">Dashboard </a></li>
                <li class="active"><a href="Adults.php">Adults</a></li>
                <li><a href="Scholar.php">Scholars</a></li>
                <li><a href="Pensioners.php">Pensioners</a></li>
                <li><a href="Disabled.php">Disabled</a></li>
                <li><a href="Children.php">Children (3 and 12)</a></li>
                <li><a href="Price.php">Price</a></li>
                <li><a href="logout.html">Log out</a></li>
            </ul>
        </nav>
    </aside>
    
    <main class="content">
        <header class="content-header">
            <h2>Adults</h2>
            <div class="user-info">
                <span>Buzwane Mahlangu</span>
                <i class="fa fa-user" aria-hidden="true"></i>
            </div>
        </header>
        
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Date of birth</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                   $commuterType = 'Adults';
                   $sql="SELECT User_Id, First_Name, Last_Name,  Gender, Email_Address, Commuter_Number, Date_Of_Birth From commuter Where Commuter_Type = ?";
                   if($stmt = $conn->prepare($sql)){
                        $stmt->bind_param("s", $commuterType);
                        // Execute statement
                        $stmt->execute();
                        // Store the result so we can access it later
                        $result = $stmt->get_result();

                        if($result->num_rows>0){
                            while($row= $result->fetch_assoc()){
                                echo "<tr>";
                                    echo "<td>".htmlspecialchars($row['User_Id'])."</td>";
                                    echo "<td>".htmlspecialchars($row['First_Name'])."</td>";
                                    echo "<td>".htmlspecialchars($row['Last_Name'])."</td>";
                                    echo "<td>".htmlspecialchars($row['Gender'])."</td>";
                                    echo "<td>".htmlspecialchars($row['Email_Address'])."</td>";
                                    echo "<td>".htmlspecialchars($row['Commuter_Number'])."</td>";
                                    echo "<td>".htmlspecialchars($row['Date_Of_Birth'])."</td>";
                                    echo "<td>";
                                        echo '<button class="btn-blue" onclick="openUpdateForm('.htmlspecialchars($row['User_Id']) . ')">Update</button>';
                                        echo '<button class="btn-green" onclick="viewHistory('.htmlspecialchars($row['User_Id']) .')">View History</button>';
                                        echo '<button class="btn-red" onclick="openDeleteModal('.htmlspecialchars($row['User_Id']) . ')">Delete Account</button>';

                                    echo "</td>";
                                echo "</tr>";
                            }
                        } else{
                            echo "<tr><td colspan='8'>No adults found.</td></tr>";
                        }
                        $stmt->close();
                   } else{
                        echo "Error: ". $conn->error;
                   }

                   $conn->close();
                ?>
            </tbody>
        </table>
    </main>

    <div id="historyModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeHistoryModal()">&times;</span>
            <h2>History for User: <span id="historyUserId"></span></h2>
            <div id="historyContent"><!-- History data will be displayed here --></div>
        </div>
    </div>

    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form id="updateForm">
                <input type="hidden" name="userId" id="userId">
                    <label for="firstName">First Name: </label>
                <input type="text" name="firstName" id="firstName" required>
                    <label for="lastName">Last Name: </label>
                <input type="text" name="lastName" id="lastName" required>
                   <label for="email">Email: </label>
                <input type="email" name="email" id="email" required>
                    <label for="contactNumber">Contact Number:</label>
                <input type="tel" name="contactNumber" id="contactNumber">
                <button type="submit">Update</button>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeDeleteModal()">&times;</span>
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete this account?</p>
        <input type="hidden" id="userIdToDelete" name="userIdToDelete">
        <button class="btn-delete-confirm" onclick="confirmDeletion()">Yes, Delete</button>
        <button class="btn-cancel" onclick="closeDeleteModal()">Cancel</button>

    </div>
</div>
    <script src="Edit_feature.js"></script>
    <script src="history_handler.js"></script>
    <script src="Delete_commuters.js"></script>
</body>
</html>
