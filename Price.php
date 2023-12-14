<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Style/Price_Styles.css">
</head>
<body>
    <aside class="sidebar">
        <h1>MetroConnect Admin</h1>
        <nav class="sidebar-nav">
            <ul>
                <li><a href="Admin Dashboard.php">Dashboard </a></li>
                <li><a href="Adults.php">Adults</a></li>
                <li><a href="Scholar.php">Scholars</a></li>
                <li><a href="Pensioners.php">Pensioners</a></li>
                <li><a href="Disabled.php">Disabled</a></li>
                <li><a href="Children.php">Children (3 and 12)</a></li>
                <li class="active"><a href="Price.php">Price</a></li>
                <li><a href="logout.html">Log out</a></li>
            </ul>
        </nav>
    </aside>

    <main class="content">
        <header class="content-header">
            <h2>Price</h2>
            <div class="user-info">
                <span>Buzwane Mahlangu</span>
                <i class="fa fa-user" aria-hidden="true"></i>
            </div>
        </header>

        <div class="price-controls">
            <div>
                <select name="commuter_type" class="commuter_type">
                    <option value="" disabled selected hidden>Commuter Type</option>
                    <option value="Adults">Adult</option>
                    <option value="Scholar">Scholar</option>
                    <option value="Pensioner">Pensioners</option>
                    <option value="Disabled">Disabled</option>
                    <option value="Children">Children (3 to 12)</option>
                </select>
            </div>
            <div>
                <button class='btn-modify'>Add</button>
            </div>
        </div>

        <table class="user-table">
            <thead>
                <tr>
                    <th>Zone</th>
                    <th>Commuter type</th>
                    <th>Fare type</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>

    </main>

    <div id="addPriceModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeAddModal()">&times;</span>
        <form id="addPriceForm">
            <label for="zone">Zone:</label>
            <input type="number" id="zone" name="zone" required>

            <label for="commuterType">Commuter Type:</label>
            <select id="commuterType" name="commuterType" required>
                <option value="Adults">Adult</option>
                <option value="Scholar">Scholar</option>
                <option value="Pensioner">Pensioners</option>
                <option value="Disabled">Disabled</option>
                <option value="Children">Children (3 to 12)</option>
            </select>

            <label for="fareType">Fare Type:</label>
            <input type="text" id="fareType" name="fareType" required>

            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" step="0.01" required>

            <button type="submit">Add</button>
            
        </form>
    </div>
</div>


    <script src="js/Price.js"></script>
</body>
</html>
