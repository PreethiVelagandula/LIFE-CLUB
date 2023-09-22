<?php
session_start();
if (!isset($_SESSION['AdminLoginId'])) {
    header("location: admin.php");
    exit();
}
$selectedMonth = $_GET['month'] ?? '';
// Define an array of month names
$months = array(
    '01' => 'January',
    '02' => 'February',
    '03' => 'March',
    '04' => 'April',
    '05' => 'May',
    '06' => 'June',
    '07' => 'July',
    '08' => 'August',
    '09' => 'September',
    '10' => 'October',
    '11' => 'November',
    '12' => 'December'
);
// Modify the query to include the month filter
$query = "SELECT * FROM donate";
if (!empty($selectedMonth)) {
    $query .= " WHERE MONTH(dt) = '$selectedMonth'";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            margin: 0px;
        }
        div.header {
            font-family: poppins;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 60px;
            background-color: black;
            color: white;
        }
        div.header button {
            background-color: #f0f0f0;
            font-size: 16px;
            font-weight: 550;
            padding: 8px 12px;
            border-radius: 5px;
            border: 2px solid white;
            transition: 0.3s;
        }
        div.header button:hover {
            letter-spacing: 2px;
        }
        /* CSS for the table */
        table {
            margin-top: 10px;
            width: 100%;
            border-collapse: collapse;
            background-color: #333;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        table th,
        table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #555;
        }
        table th {
            background-color: #555;
            font-weight: bold;
            text-transform: uppercase;
        }
        table tr:nth-child(even) {
            background-color: #444;
        }
        table tr:hover {
            background-color: #666;
        }
        table th,
        table td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
            text-align: center;
        }
        table td:last-child {
            text-align: center;
        }
        table td a {
            color: #00a0ff;
            text-decoration: none;
        }
        table td a:hover {
            text-decoration: underline;
        }
       /* CSS for the month filter */
    .month-filter {
        margin: 20px 0;
        display: flex;
        align-items: center;
    }
    .month-filter label {
        font-weight: bold;
        margin-right: 10px;
        margin-left: 10px;
        font-size: larger;
    }
    .month-filter select {
        padding: 8px;
        font-size: 16px;
        border-radius: 5px;
    }
    .month-filter {
         margin-bottom: 10px;
    }
    </style>
</head>
<body>
    <div class="header">
        <h1>ADMIN PANEL - LIFE CLUB</h1>
        <form method="POST">
            <button name="Logout">LOG OUT</button>
        </form>
    </div>
    <?php
    if (isset($_POST['Logout'])) {
        session_destroy();
        header("location: admin.php");
       
        exit();
    }
    ?>
<!--Month section starts-->
    <div class="month-filter">
        <label for="month-select">Filter by Month:</label>
        <select id="month-select" onchange="filterData()">
            <option value="">All Months</option>
            <?php
            foreach ($months as $monthNum => $monthName) {
                $selected = ($selectedMonth === $monthNum) ? 'selected' : '';
                echo '<option value="' . $monthNum . '"' . $selected . '>' . $monthName . '</option>';
            }
            ?>
        </select>
    </div>
<!--Month section ends-->
<!--Database to admin page table startss-->
    <div id="data-table-container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "donate";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // Fetch data from the database
        $result = $conn->query($query);
        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr>';
            echo '<th>S.No</th>';
            echo '<th>Name</th>';
            echo '<th>Number</th>';
            echo '<th>Email</th>';
            echo '<th>Amount</th>';
            echo '<th>Date and Time</th>';
            echo '</tr>';
            // Loop through each row of data and display it in the table
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['sno'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['phone'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['amount'] . '</td>';
                echo '<td>' . $row['dt'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'No data found.';
        }
        $conn->close();
        ?>
        <!--Database to admin page table ends-->
    </div>
    <script>
        function filterData() {
            var selectedMonth = document.getElementById('month-select').value;
            var url = 'adminpanel.php?month=' + selectedMonth;
            window.location.href = url;
        }
    </script>
    <script src="script.js"></script>
</body>
</html>







