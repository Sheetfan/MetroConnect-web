<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="Style/DashBoard style.css"> -->
    <!-- <link rel="stylesheet" href="Style/Transaction style.css"> -->
    <link rel="stylesheet" href="Style/Transaction History style.css">
    <!-- <link rel="stylesheet" href="Style/Notification style.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>

<body>
    <div class="sidebar">
        <h2>MetroConnect</h2>
        <ul>
            <li id="dashboard">
                <i class="fa fa-home" aria-hidden="true"></i>
                Dashboard
            </li>
            <li class="active" id="history">
                <i class="fa fa-exchange" aria-hidden="true"></i>
                History
            </li>
            <li id="notifications">
                <i class="fa fa-bell" aria-hidden="true"></i>
                Notifications
            </li>
            <li>
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Log out
            </li>
        </ul>
    </div>
    <div class="main-content">
        <header>
            <h2 class="heading-name">Dashboard</h2>
            <div class="user-info">
                Commuter Name
                <i class="fa fa-user" aria-hidden="true"></i>
            </div>
        </header>
        <div class="transaction-filters">

        </div>
        <div class="zone-container">

        </div>
    </div>
    <script src="js/main page.js"></script>
</body>

</html>