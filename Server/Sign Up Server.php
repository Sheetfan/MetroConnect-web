<?php

use FFI\CType;

    $firstName = $lastName= $Gender= $email = $contactNumber = $dob = $password = $commuterType="";
    $firstNameErr = $lastNameErr = $genderErr = $emailErr= $contactNumberErr = $dobErr = $PasswordErr = $commuterTypeErr="";

include 'DB_connect.php';

    if($_SERVER["REQUEST_METHOD"] == "POST")
    
    {
        // Validate first name
        $firstName=trim($_POST['first_name']);
        if(empty($firstName)){
            $firstNameErr ='Please enter your first name.';
        }else if(!ctype_alpha(str_replace(' ','', $firstName))){
            $firstNameErr = 'Name must contain only Letters';
        }

        //Validate last name
        $lastName=trim($_POST['last_name']);
        if(empty($lastName)){
            $lastName ='Please enter your first name.';
        }else if(!ctype_alpha(str_replace(' ','', $lastName))){
            $lastNameErr = 'Last Name must contain only letters';
        }
        
        //Validate email address
        $email = trim($_POST["email"]);
        if(empty($email)){
            $emailErr = 'Please enter your email address.';
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErr = 'Invalid email format.';
        }else{
            $sql="SELECT * FROM Commuter WHERE Email_Address = ?";
            if($stmt = $conn->prepare($sql)){
                $stmt->bind_param("s",$email);

                if($stmt->execute()){
                    $stmt->store_result();
                    if($stmt->num_rows>0){
                        $emailErr = 'This email is already exist.';
                    }
                }else{
                    $emailErr = 'Oops! Something went wrong. Please try again later.';
                }
                    $stmt->close();
            }
            //$conn->close();
        }

        //Validate gender
        if(empty($_POST['gender'])){
            $genderErr = 'Please select gender.';
        } else {
            $gender = $_POST['gender'];
            $validGenders=["male","female","other"];

            if(!in_array($gender, $validGenders)){
                $genderErr = 'Invalid gender selection.';
            }

        }

        //Validate Contact Number
        if(empty(trim($_POST["contact_number"]))){
            $contactNumberErr = 'Contact number is required.';
        }else{
            $contactNumber = trim($_POST["contact_number"]);
            if(!preg_match('/^(\+27|0)[0-9]{9}$/', $contactNumber) && !preg_match('/^\+27(\s)?[0-9]{2}(\s)?[0-9]{3}(\s)?[0-9]{4}$/', $contactNumber)){
                $contactNumberErr = 'Invalid South African contact number format.';
            }
        }

        if (empty(trim($_POST["dob"]))) {
        $dobErr = 'Please enter your date of birth.';
        } else {
        $dob = trim($_POST["dob"]);
        $date_format='Y-m-d';
        
        $d=DateTime::createFromFormat($date_format, $dob);
        if($d && $d -> format($date_format)==$dob){
            $today = new DateTime();
            $age =$today ->diff($d)->y;

            if($age<3){
                $dobErr='No registrations for anyone under the age of 3.';
            }
        } else{
            $dobErr = 'Incorrect data format. Please use YYYY-MM-DD format.';
        }

    }

        // Validate commuter type
        if (empty($_POST["commuter_type"])) {
            $commuterTypeErr = 'Please select your commuter type.';
        } else {
            $commuterType = $_POST["commuter_type"];
            if (isset($age)) {
                // Check for 'Disabled' first, and if selected, bypass other age checks
                if ($commuterType == "Disabled" && $age < 3) {
                    $commuterTypeErr = 'Commuter type Disabled is not allowed for ages under 3.';
                } else if ($age >= 3 && $age <= 12 && $commuterType != "Children" && $commuterType != "Disabled") {
                    $commuterTypeErr = 'Commuter type should be Children for ages between 3 and 12.';
                } else if ($age > 12 && $age <= 20 && $commuterType != "Scholar" && $commuterType != "Disabled") {
                    $commuterTypeErr = 'Commuter type should be Scholar for ages between 13 and 20.';
                } else if ($age > 20 && $age < 60 && $commuterType != "Adults" && $commuterType != "Disabled") {
                    $commuterTypeErr = 'Commuter type should be Adults for ages between 21 and 59.';
                } else if ($age >= 60 && $commuterType != "Pensioners" && $commuterType != "Disabled") {
                    $commuterTypeErr = 'Commuter type should be Pensioners for ages 60 and above.';
                }
            }
        }
        

       // generate random password 
        function generateRandomPassword(){
            $numbers='0123456789';
            $lowerCaseLetters='abcdefghijklmnopqrstuvwxyz';
            $upperCaseLetters='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            
            $allCharacters = $numbers. $lowerCaseLetters . $upperCaseLetters;

            $password = '';
            for($i=0; $i<8; $i++){
                $randomIndex = rand(0, strlen($allCharacters)-1);
                $password .=$allCharacters[$randomIndex];
            }
            return $password;
        }
        $password = password_hash(generateRandomPassword(), PASSWORD_DEFAULT);

        if(empty($firstNameErr) && empty($lastNameErr) && empty($emailErr) && empty($genderErr) && empty($contactNumberErr) && empty($dobErr) && empty($commuterTypeErr)){

            //Start transaction
            $conn->begin_transaction();

            try {
                $insertCommuterSql = "INSERT INTO commuter (First_Name, Last_Name, Gender, Email_Address, Password, Commuter_Type, Commuter_Number, Date_Of_Birth) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($insertCommuterSql);
                $stmt->bind_param("ssssssss",$firstName,$lastName,$gender,$email, $password, $commuterType, $contactNumber, $dob);

                if(!$stmt->execute()){
                    throw new Exception("Error in inserting user: " . $stmt->error);
                }

                //Get the Last inserted User_Id
                $newUserId = $conn->insert_id;

                // Insert into VirtualBusTag table with default values
                $insertTagSql="INSERT INTO VirtualBusTag (User_Id, Zone1, Zone2, Zone3, Zone4, Zone5, Zone6, Zone7, Zone8, Stored_Value) 
                VALUES (?, 0, 0, 0, 0, 0, 0, 0, 0, 0.00)";
                $tagStmt= $conn->prepare($insertTagSql);
                $tagStmt->bind_param("i", $newUserId);

                if(!$tagStmt->execute()){
                    throw new Exception("Error in inserting tags: " . $stmt->error);
                }

                $conn->commit();
                echo "New user and default virtual bus tags created successfully.";

                $stmt->close();
                $tagStmt->close();

            } catch (Exception $e) {
                //An error occurred, rollback the transaction
                $conn->rollback();
                echo "Transaction failed: ". $e->getMessage();
            }
            $conn->close();
        }

    }

?>