<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        include 'DB_connect.php'; // Ensure you have included your database connection file

        $userId = $conn->real_escape_string($_POST['userId']);
        $firstName = $conn->real_escape_string($_POST['firstName']);
        $lastName = $conn->real_escape_string($_POST['lastName']);
        $email = $conn->real_escape_string($_POST['email']);
        $contactNumber = $conn->real_escape_string($_POST['contactNumber']);

        $sql = "UPDATE commuter SET First_Name=?, Last_Name=?, Email_Address=?, Commuter_Number=? WHERE User_Id=?";

        if($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssi", $firstName, $lastName, $email, $contactNumber, $userId);
            $stmt->execute();

            if($stmt->affected_rows > 0) {
                echo json_encode(["message" => "User updated successfully"]);
            } else {
                echo json_encode(["error" => "No changes made or user not found"]);
            }
            $stmt->close();
        } else {
            echo json_encode(["error" => "Error preparing SQL statement: " . $conn->error]);
        }
        $conn->close();
    }
?>
