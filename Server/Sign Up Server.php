<?

use FFI\CType;

    $firstName = $lastName= $Gender= $email = $contactNumber = $dob = $password = $commuterType="";
    $firstNameErr = $lastNameErr = $genderErr = $emailErr= $contactNumberErr = $dobErr = $PasswordErr = $commuterTypeErr="";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    
    {

        // Validate first name
        if(empty(trim($_POST['first_name']))){
            $firstNameError ="Please enter your first name.";
        }else{
            // remove white spaces from the beginning and end
            $trimName = trim($_POST["first_name"]);
        }

        if(!ctype_alpha(str_replace(' ','', $trimName))){
            $firstNameErr = "Name must contain only Letters";
        }else{
            $firstName = $trimName;
        }

        //Validate last name
        if(empty(trim($_POST['last_name']))){
            $lastNameError ="Please enter your last name.";
        }else{
            $trimlastName = trim($_POST['last_name']);
        }

        if(!ctype_alpha(str_replace(' ','',$trimlastName))){
            $lastNameErr = "Last Name must contain only letters";
        }else{
            $lastName = $trimlastName;
        }
        //Validate email address
        if(empty(trim($_POST['email']))){
            $emailErr = "Please enter your email address.";
        }else if(!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)){
            $emailErr = "Invalid email format.";
        }else{
            $email = trim($_POST["email"]);
            // Check if email already exists in the database here
        }

        //Validate gender
        if(empty($_POST['gender'])){
            $genderErr = "Please select gender.";
        } else {
            $gender = $_POST['gender'];
            $validGenders=["male","female","other"];

            if(!in_array($gender, $validGenders)){
                $genderErr = "Invalid gender selection.";
            }

        }

        //Validate Contact Number
        if(empty(trim($_POST["contact_number"]))){
            $contactNumberErr = "Contact number is required.";
        }else{
            $contactNumber = trim($_POST["contact_number"]);
            if(!preg_match('/^(\+27|0)[0-9]{9}$/', $contactNumber) && !preg_match('/^\+27(\s)?[0-9]{2}(\s)?[0-9]{3}(\s)?[0-9]{4}$/', $contactNumber)){
                $contactNumberErr = "Invalid South African contact number format.";
            }
        }

        if (empty(trim($_POST["dob"]))) {
        $dobErr = "Please enter your date of birth.";
        } else {
        $dob = trim($_POST["dob"]);
        $date_format='Y-m-d';
        
        $d=DateTime::createFromFormat($date_format, $dob);
        if($d && $d -> format($date_format)==$dob){
            $today = new DateTime();
            $age =$today ->diff($d)->y;

            if($age<3){
                $dobErr="No registrations for anyone under the age of 3.";
            }
        } else{
            $dobErr = "Incorrect data format. Please use YYYY/MM/DD format.";
        }

        }

        // Validate commuter type
        if (empty($_POST["commuter_type"])) {
            $commuterTypeErr = "Please select your commuter type.";
        } else {
            $commuterType = $_POST["commuter_type"];
            if(isset($age)){
                if($age>= 3 && $AGE <= 12 && $commuterType!= "Children"){
                    $commuterTypeErr = "Commuter type should be 'Children' for ages between 3 and 12.";
                } else if($age > 12 && $age <= 20 && $commuterType != "Scholar"){
                    $commuterTypeErr = "Commuter type should be 'Scholar' for ages between 13 and 20.";
                } else if($age > 20 && $age < 60 && $commuterType != "Adults"){
                    $commuterTypeErr = "Commuter type should be 'Adults' for ages between 21 and 59.";
                }else if($age >= 60 && $commuterType != "Pensioners"){
                    $commuterTypeErr = "Commuter type should be 'Pensioners' for ages 60 and above.";
                }
            }
        }

       
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

        $password = generateRandomPassword();

    }

?>