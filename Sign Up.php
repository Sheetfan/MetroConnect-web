<?php
    include 'Server/Sign Up Server.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Style/Sign Up styles.css">
</head>
<body>
<div class="signup-form">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <h2>Sign Up</h2>
        <div class="form-row">
            <input type="text" name="first_name" placeholder="First Name" >
                <?php if(!empty($firstNameErr)){
                    echo '<p style="color: red;">'.$firstNameErr.'</p>'; 
                }?>

            <input type="text" name="last_name" placeholder="Last Name" >
                <?php if(!empty($lastNameErr)) echo '<p style="color: red;">'.$lastNameErr.'</p>';?>
        </div>
        <div class="form-row">
            <input type="email" name="email" placeholder="Email address" >
            <?php if(!empty($emailErr)) echo '<p style="color: red;">'.$emailErr.'</p>' ; ?>

            <div class="select-wrapper">
                <select name="gender" >
                    <option value="" selected disabled hidden>Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <?php if(!empty($genderErr)) echo '<p style="color: red;">'.$genderErr.'</p>'?>
        </div>
        <input type="tel" name="contact_number" placeholder="Contact Number">
            <?php if(!empty($contactNumberErr)) echo '<p style="color: red;">'.$contactNumberErr.'</p>'; ?>

        <div class="form-row">
            <input type="date" name="dob" placeholder="Date of Birth">
                <?php if(!empty($dobErr)) echo '<p style="color: red;">'.$dobErr.'</p>'; ?>

            <div class="select-wrapper">
                <select name="commuter_type">
                    <option value="" disabled selected hidden>Commuter Type</option>
                    <option value="Adults">Adult</option>
                    <option value="Scholar">Scholar</option>
                    <option value="pensioners">Pensioners</option>
                    <option value="Disabled">Disabled</option>
                    <option value="Children">Children (3 to 12)</option>
                </select>
            </div>
                <?php if(!empty($commuterTypeErr)) echo '<p style="color: red;">'.$commuterTypeErr.'</p>'; ?>
        </div>
        <button type="submit">Sign up</button>
    </form>
</div>
</body>
</html>
