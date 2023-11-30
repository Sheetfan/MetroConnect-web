<?php
    include 'Server/DB_connect.php';
    include 'Server/Admin Dashboard Server.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Style/Admin DashBoard.css">
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>MetroConnect Admin</h2>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li class="active"><a href="#">Dashboard</a></li>
                <li><a href="Adults.php">Adults</a></li>
                <li><a href="Scholar.php">Scholars</a></li>
                <li><a href="Pensioners.php">Pensioners</a></li>
                <li><a href="Disabled.php">Disabled</a></li>
                <li><a href="Children.php">Children (3 and 12)</a></li>
                <li><a href="Price.php">Price</a></li>
                <li><a href="#">Log out</a></li>
            </ul>
        </nav>
    </aside>
    <main class="admin-content">
        <header class="admin-header">
            <h2>Admin Dashboard</h2>
            <div class="admin-profile">
                <span>Admin Name</span>
                <i class="fa fa-user" aria-hidden="true"></i>
            </div>
        </header>
        <div class="admin-dashboard">
            <div class="stat-item" id="registered-adults">
                <?php
                    $commuterType='Adults';
                    $sql = "SELECT * FROM commuter WHERE Commuter_Type = '$commuterType'";
                    $result = mysqli_query($conn,$sql);
                    $totalAdults = mysqli_num_rows($result);
                    $totalRecords = getTotal('commuter');
                    $progressBar = ($totalAdults/$totalRecords) * 100;
                ?>
                <h3>Total Number of Registered Adults: <?php echo $totalAdults; ?></h3>
                <div class="stat-bar" style="width: <?php echo $progressBar?>%;"></div>
            </div>

            <div class="stat-item" id="registered-scholars">
                <?php
                    $commuterType='Scholar';
                    $sql = "SELECT * FROM commuter WHERE Commuter_Type = '$commuterType'";
                    $result = mysqli_query($conn,$sql);
                    $totalScholar = mysqli_num_rows($result);
                    $totalRecords = getTotal('commuter');
                    $progressBar = ($totalScholar/$totalRecords) * 100;
                ?>
                <h3>Total Number of Registered Scholars: <?php echo $totalScholar;?></h3>
                <div class="stat-bar" style="width: <?php echo $progressBar?>%;"></div>
            </div>

            <div class="stat-item" id="registered-pensioners">
                <?php
                    $commuterType='Pensioner';
                    $sql = "SELECT * FROM commuter WHERE Commuter_Type = '$commuterType'";
                    $result = mysqli_query($conn,$sql);
                    $totalPensioner = mysqli_num_rows($result);
                    $totalRecords = getTotal('commuter');
                    $progressBar = ($totalPensioner/$totalRecords) * 100;
                ?>
                <h3>Total Number of Pensioners: <?php echo $totalPensioner; ?></h3>
                <div class="stat-bar" style="width: <?php echo $progressBar?>%;"></div>
            </div>

            <div class="stat-item" id="registered-disabled">
                <?php
                    $commuterType='Disabled';
                    $sql = "SELECT * FROM commuter WHERE Commuter_Type = '$commuterType'";
                    $result = mysqli_query($conn,$sql);
                    $totalDisabled = mysqli_num_rows($result);
                    $totalRecords = getTotal('commuter');
                    $progressBar = ($totalDisabled/$totalRecords) * 100;
                ?>
                <h3>Total Number of Disabled: <?php echo $totalDisabled; ?></h3>
                <div class="stat-bar" style="width: <?php echo $progressBar?>%;"></div>
            </div>

            <div class="stat-item" id="registered-children">
                <?php
                    $commuterType='Children';
                    $sql = "SELECT * FROM commuter WHERE Commuter_Type = '$commuterType'";
                    $result = mysqli_query($conn,$sql);
                    $totalChildren = mysqli_num_rows($result);
                    $totalRecords = getTotal('commuter');
                    $progressBar = ($totalChildren/$totalRecords) * 100;
                ?>
                <h3>Total Number of Children between 3 and 12: <?php echo $totalChildren?></h3>
                <div class="stat-bar" style="width: <?php echo $progressBar?>%;"></div>
            </div>
        </div>
    </main>
    <script src="admin_dashboard.js"></script>
</body>
</html>
