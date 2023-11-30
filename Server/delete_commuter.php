<?php
include 'DB_connect.php';
header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve the user ID from POST data
    $userId = isset($_POST['userId']) ? $conn->real_escape_string($_POST['userId']) : '';

    // Check if userId is not empty
    if (!empty($userId)) {

        // Prepare DELETE query
        $sql = "DELETE FROM Commuter WHERE User_Id = ?";
        if ($stmt = $conn->prepare($sql)) {
            
            $stmt->bind_param("i", $userId);

           
            if ($stmt->execute()) {
               
                if ($stmt->affected_rows > 0) {
                    echo json_encode(["message" => "User deleted successfully"]);
                } else {
                    echo json_encode(["error" => "User not found or already deleted"]);
                }
            } else {
                echo json_encode(["error" => "Error executing query: " . $stmt->error]);
            }

            // Close statement
            $stmt->close();
        } else {
            echo json_encode(["error" => "Error preparing query: " . $conn->error]);
        }
    } else {
        echo json_encode(["error" => "User ID is required"]);
    }

    // Close connection
    $conn->close();
} else {
    // Handle invalid request method
    echo json_encode(["error" => "Invalid request method"]);
}
?>
