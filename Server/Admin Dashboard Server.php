<?php
    include ("DB_connect.php");

    function getTotal($tablename){
        global $conn; 
        $query = "SELECT * FROM $tablename"; 
        $result = mysqli_query($conn, $query);

        $totalCount = mysqli_num_rows($result);

        return $totalCount;
    }
?>