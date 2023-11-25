<?php
    if(isset($_POST['email']) && isset($_POST['password'])){
        // Database connection parameter

        //* You should change the informaction depending on your database
        $servername = "localhost";
        $username = "root";
        $password = "1234";
        $dbname = "Metroconnect";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $email = $_POST['email'];
        $password =  $_POST['password'];

        // this checks if the textbox are empty
        if(empty($email)|| empty($password)){
            header("Location: ..\Commuter Login Page.php?error=empty");
            $conn->close();
            exit();
        }

        // this the SQL script that will get the user data
        $sql = "SELECT * FROM Commuter WHERE Email_Address = ? AND Password = ?";

        /*
            the next four lines is a prepared statement
            * this helps prevent SQL injection by allowing you to bind parameters to a query so.. pretty important.
        */
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        // this checks of the user exists
        if ($result->num_rows > 0) {
            header("Location: ..\DashBoard.html");

        } else {
            header("Location: ..\Commuter Login Page.php?error=invalid");
        }
        $conn->close();
    }
?>
