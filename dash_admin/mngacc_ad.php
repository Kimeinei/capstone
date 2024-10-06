<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../css/sidebar.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <nav>
    <ul>
            <li>
                <a href="#" class="logo">
                    <img src="../photos/GUI-no-tubig.png" alt="logo">
                </a>
            </li>
            <li><a href="dash_ad.php">
                <i class="fas fa-home"></i>
                <span class="nav-item">Dashboard</span>
            </a></li>
            <li><a href="map_ad.php">
                <i class="fas fa-map"></i>
                <span class="nav-item">Map Overview</span>
            </a></li>
            <li><a href="mngacc_ad.php">
                <i class="fas fa-user"></i>
                <span class="nav-item">Manage Accounts</span>
            </a></li>
            <li><a href="mngrpt_ad.php">
                <i class="fas fa-file"></i>
                <span class="nav-item">Manage Reports</span>
            </a></li>
            <li><a href="advisory_ad.php">
                <i class="fas fa-edit"></i>
                <span class="nav-item">Advisory</span>
            </a></li>
            <li><a href="archive_ad.php">
                <i class="fas fa-book"></i>
                <span class="nav-item">Archive</span>
            </a></li>
        </ul>
    </nav>
    <h2>Manage Accounts</h2>
    <form action="mngacc_ad.php" method="POST">
        <h3>Create New Account</h3>
        <input type="hidden" name="action" value="create">
        <label>First Name: </label>
        <input type="text" name="firstName" required><br>

        <label>Last Name: </label>
        <input type="text" name="lastName" required><br>

        <label>Email: </label>
        <input type="email" name="email" required><br>

        <label>Password: </label>
        <input type="password" name="password" required><br>

        <label>User Type: </label>
        <select name="user_type">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select><br>

        <label>Status: </label>
        <select name="status">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select><br>

        <button type="submit">Add Account</button>
    </form>

    <h3>Existing Accounts</h3>
    <table border="1">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>User Type</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php
        include '../connect.php'; // Include your database connection

        // PHP code to retrieve and display accounts from the database
        $result = $conn->query("SELECT * FROM users");

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['firstName'] . "</td>";
            echo "<td>" . $row['lastName'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['user_type'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td>
                    <form action='mngacc_ad.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='action' value='edit'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button type='submit'>Edit</button>
                    </form>
                    <form action='mngacc_ad.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='action' value='delete'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button type='submit'>Delete</button>
                    </form>
                </td>";
            echo "</tr>";
        }
        ?>
    </table>

    <?php
    // Handle form submissions (create, edit, delete)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $action = $_POST['action'];

        if ($action == 'create') {
            // Logic for creating a new account
            // Your code here...

        } elseif ($action == 'edit') {
            // Logic for editing an existing account
            // Your code here...

        } elseif ($action == 'delete') {
            // Logic for deleting an account
            // Your code here...
        }
    }
    ?>

<style>
    body {
        background: #eaeaea; /* Matches your existing body background */
        font-family: "Poppins", sans-serif; /* Consistent with your font choice */
        margin-left: 240px; /* Adjusted to match the sidebar width */
    }

    h2, h3 {
        text-align: center; /* Center align headers */
        color: #555; /* Text color for headers */
    }

    table {
        width: 100%; /* Full-width table */
        margin: 20px 0; /* Margin above and below the table */
        border-collapse: collapse; /* Collapsed borders */
    }

    th, td {
        padding: 12px; /* Padding inside cells */
        text-align: left; /* Left-align text */
        border-bottom: 1px solid #ddd; /* Bottom border for rows */
    }

    th {
        background-color: #f4f4f4; /* Background color for headers */
        color: #333; /* Header text color */
    }

    tr:hover {
        background-color: #f1f1f1; /* Highlight row on hover */
    }

    button {
        background-color: #007bff; /* Button color */
        color: white; /* Button text color */
        border: none; /* No border */
        padding: 6px 12px; /* Padding inside buttons */
        cursor: pointer; /* Pointer cursor on hover */
        border-radius: 4px; /* Rounded corners */
        transition: background-color 0.3s; /* Smooth transition */
    }

    button:hover {
        background-color: #0056b3; /* Darker button color on hover */
    }

    form {
        display: inline; /* Inline forms for buttons */
    }

    input[type="text"], input[type="email"], input[type="password"], select {
        width: 100%; /* Full width for inputs */
        padding: 10px; /* Padding inside inputs */
        margin: 5px 0 10px; /* Margin for spacing */
        border: 1px solid #ccc; /* Border color */
        border-radius: 4px; /* Rounded corners */
        box-sizing: border-box; /* Include padding and border in width */
    }

    input[type="hidden"] {
        display: none; /* Hide hidden inputs */
    }
</style>

</body>
</html>