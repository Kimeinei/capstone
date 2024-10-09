<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../css/sidebar.css">
    <title>Admin Dashboard</title>
    <style>
        body {
            background: #eaeaea; /* Matches your existing body background */
            font-family: "Poppins", sans-serif; /* Consistent with your font choice */
            margin-left: 240px; /* Adjusted to match the sidebar width */
        }

        .container {
            max-width: 1100px; /* Set maximum width for the wrapper */
            margin: 100px auto; /* Center the container with more space on top */
            padding: 20px; /* Padding around the content */
            background: #ffffff; /* White background for the content area */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }

        .search-container {
            display: flex; /* Flexbox for alignment */
            align-items: center; /* Center vertically */
            justify-content: flex-start; /* Align search bar to the left */
            padding-left: 20px; /* Padding to align with the table */
            margin: 100px auto 20px; /* Lower the search container with increased top margin */
        }

        .search-container input {
            padding: 10px; /* Padding inside the search box */
            margin-right: 10px; /* Space between input and button */
            border: 1px solid #ccc; /* Border color */
            border-radius: 4px; /* Rounded corners */
            width: 200px; /* Fixed width for the input */
        }

        table {
            width: 100%; /* Full-width table */
            margin: 20px 0; /* Margin above and below the table */
            border-collapse: collapse; /* Collapsed borders */
            font-size: 14px; /* Smaller font size for table */
        }

        th, td {
            max-width: 150px; /* Limit the maximum width of the table cells */
            white-space: nowrap; /* Prevent text from wrapping */
            overflow: hidden; /* Hide overflowed content */
            text-overflow: ellipsis; /* Add ellipsis (...) when text overflows */
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4; /* Background color for headers */
            color: #333; /* Header text color */
        }

        tr:hover {
            background-color: #f1f1f1; /* Highlight row on hover */
        }

        /* Styles for action buttons */
        button {
            padding: 6px 10px; /* Smaller padding for buttons */
            margin: 0 3px; /* Adjusted margin between buttons */
            background-color: #1743e3; /* Button background color */
            color: #ffffff; /* Text color */
            border: none; /* Remove border */
            border-radius: 4px; /* Rounded corners */
            font-size: 12px; /* Smaller button text */
            cursor: pointer; /* Pointer cursor on hover */
            transition: background-color 0.3s ease; /* Smooth transition for background color */
        }

        button:hover {
            background-color: #0f1f8c; /* Darker shade on hover */
        }

        button:focus {
            outline: none; /* Remove focus outline */
        }

    </style>
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

    <div class="search-container">
        <input type="text" id="search" placeholder="Search accounts...">
    </div>

    <div class="container">
        <table id="accountsTable" border="1">
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
                echo "<td>" . $row['status'] . "</td>";// Hi Kimi I am a Hacker
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
    </div>

    <script>
        document.getElementById('search').addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#accountsTable tr:not(:first-child)'); // Select all rows except the header

            rows.forEach(row => {
                const cells = row.getElementsByTagName('td');
                let rowVisible = false;

                for (let i = 0; i < cells.length - 1; i++) { // Skip the last column (Actions)
                    if (cells[i].innerText.toLowerCase().includes(filter)) {
                        rowVisible = true;
                    }
                }

                row.style.display = rowVisible ? '' : 'none'; // Show or hide row
            });
        });
    </script>
</body>
</html>
