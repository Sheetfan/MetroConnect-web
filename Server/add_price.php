<?php
include 'DB_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $zone = $conn->real_escape_string($_POST['zone']);
    $commuterType = $conn->real_escape_string($_POST['commuterType']);
    $fareType = $conn->real_escape_string($_POST['fareType']);
    $amount = $conn->real_escape_string($_POST['amount']);

    // SQL to insert data
    $sql = "INSERT INTO BusFare (Zone, Commuter_Type, Fare_Type, Amount) VALUES (?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("issd", $zone, $commuterType, $fareType, $amount);

        if ($stmt->execute()) {
            echo json_encode(["message" => "New price added successfully"]);
        } else {
            echo json_encode(["error" => "Error adding price: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["error" => "Error preparing statement: " . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(["error" => "Invalid request method"]);
}
?>
