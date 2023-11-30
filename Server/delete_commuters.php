<?php
// Include database connection file
include 'DB_connect.php';

// Set the content type to JSON
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the user ID from POST data
    $userId = isset($_POST['userId']) ? $conn->real_escape_string($_POST['userId']) : '';

    // Check if userId is not empty
    if (!empty($userId)) {
        // Prepare DELETE query
        $sql = "DELETE FROM Commuter WHERE User_Id = ?";
        if ($stmt = $conn->prepare($sql)) {
            // Bind userId to the prepared statement as a parameter
            $stmt->bind_param("i", $userId);
            // Execute the statement
            if ($stmt->execute()) {
                // Check if any rows were affected
                if ($stmt->affected_rows > 0) {
                    echo json_encode(["message" => "User deleted successfully"]);
                } else {
                    echo json_encode(["error" => "User not found or already deleted"]);
                }
            } else {
                // Handle errors related to statement execution
                echo json_encode(["error" => "Error executing query: " . $stmt->error]);
            }
            // Close statement
            $stmt->close();
        } else {
            // Handle errors related to statement preparation
            echo json_encode(["error" => "Error preparing query: " . $conn->error]);
        }
    } else {
        // Handle the case where the user ID is not provided
        echo json_encode(["error" => "User ID is required"]);
    }
    // Close the database connection
    $conn->close();
} else {
    // Handle the case where the request method is not POST
    echo json_encode(["error" => "Invalid request method"]);
}
?>
