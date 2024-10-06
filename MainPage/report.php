<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Main Page</title>
    <link rel="stylesheet" href="report.css">

</head>
<body>
    <header class="header">
        <a href="../photos/GUI-no-tubig.png" class="logo">
            <img src="../photos/GUI-no-tubig.png" alt="Logo">
        </a>        

        <nav class="navbar">
            <a href="main_page.html">Home</a>
            <a href="#">About</a>
            <a href="#">Map</a>
            <a href="report.php" class="active">Report</a>
            <a href="../LoginPage/login.html">Login</a>
        </nav>
    </header>

    <section class="report">
        <h2>Complaint Form</h2>
        <form action="/submit_complaint" method="post" enctype="multipart/form-data">
            <!-- Name -->
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>

            <!-- Contact Number -->
            <label for="contact">Contact No.:</label><br>
            <input type="tel" id="contact" name="contact" required><br><br>

            <!-- Report Issue -->
            <label for="issue">Report Issue:</label><br>
            <input type="text" id="issue" name="issue" required><br><br>

            <!-- Upload Image -->
            <label for="image">Upload Image:</label><br>
            <input type="file" id="image" name="image" accept="image/*"><br><br>

            <!-- Complaint -->
            <label for="complaint">Complaint Description:</label><br>
            <textarea id="complaint" name="complaint" rows="4" cols="50" required></textarea><br><br>

            <!-- Address -->
            <label for="address">Address:</label><br>
            <textarea id="address" name="address" rows="2" cols="50" required></textarea><br><br>

            <!-- Submit Button -->
            <input type="submit" value="Submit">
        </form>
    </section>
</body>

</html>