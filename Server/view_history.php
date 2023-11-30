<?php
    include 'DB_connect.php';


    if(isset($_GET['userId'])){
        $userId = $conn->real_escape_string($_GET['userId']);

        $sql = "SELECT * FROM TransactionHistory WHERE User_Id = ?";

        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            $historyData = $result->fetch_all(MYSQLI_ASSOC);

            echo json_encode($historyData);

            $stmt->close();
        }else{
            echo json_encode(["error" => "Error preparing SQL statement: ". $conn->error]);
        }

        $conn->close();
    } else{
        echo json_encode(["error" => "userId not provided"]);
    }
?>