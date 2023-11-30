<?php
    include 'DB_connect.php';
    header('Content-Type: application/json');


    if(isset($_GET['userId'])){
        $userId=$conn->real_escape_string($_GET['userId']);

        $sql = "SELECT First_Name, Last_Name, Email_Address, Commuter_Number FROM commuter WHERE User_Id=?"; 

        if($stmt=$conn->prepare($sql)){
            $stmt->bind_param("s",$userId);
            $stmt->execute();
            $result=$stmt->get_result();

            if($row= $result->fetch_assoc()){
                echo json_encode($row);
            }else{
                echo json_encode(["error"=>"User not found"]);
            }
            $stmt->close();
        } else{
            echo json_encode(["error" => "Error in query"]);
        }
        $conn->close();
    }
    
?>