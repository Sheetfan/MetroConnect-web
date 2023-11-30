<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/main page.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>

<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>MetroConnect</h2>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li class="dashboard">
                    <span><i class="fa fa-home" aria-hidden="true"></i> Dashboard</span>
                </li>
                <li class="history">
                    <span><i class="fa fa-exchange" aria-hidden="true"></i> History</span>
                </li>
                <li class="notifications">
                    <span><i class="fa fa-bell" aria-hidden="true"></i> Notifications</span>
                </li>
                <a href="Commuter Login Page.php">
                    <li class="signout-frame">
                        <span><i class="fa fa-sign-out" aria-hidden="true"></i> Log out</span>
                    </li>
                </a>
            </ul>
        </nav>
    </aside>
    <main class="main-content">
        <header>
            <h2 class="heading-name">Dashboard</h2>
            <a href="Personal Info.html">
                <div class="user-info">
                    <span><?php $_SESSION["userId"]?></span>
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
            </a>
        </header>
        <div class="top-compontents"></div>
        <div class="main-container"></div>
    </main>
    <script src="js/main page.js"></script>
</body>

</html>