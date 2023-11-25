<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="Style/Commuter Login Page styles.css">
    </head>
    <body>
        <div class="login-container">
            <form action="Server/verify.php" method="post">
                <h2>Commuter Login</h2>
                
                <div class="form-group">
                    <?php
                        // Display error messages if any
                        if (isset($_GET['error'])) {
                            $error = $_GET['error'];
                            switch ($error) {
                                case 'empty':
                                    echo '<p style="color: red;">Please fill in all fields.</p>';
                                    break;
                                case 'invalid':
                                    echo '<p style="color: red;">Invalid email or password.</p>';
                                    break;
                            }
                        }
                    ?>
                    <input type="email" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group"> 
                    <input type="password" id="password" name="password"  placeholder="Password">
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </body>
</html>
