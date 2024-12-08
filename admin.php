<?php
$conn = new mysqli("localhost", "root", "", "hello");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navigation Links -->
    <nav>
        <a href="index.html">Registration Page</a> |
        <a href="admin.php">Admin Page</a>
    </nav>

    <h1>Registered Students</h1>
    <?php
    $result = $conn->query("SELECT * FROM students");
    echo "<table border='1'><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Project Title</th><th>Email</th><th>Phone</th><th>Time Slot</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['first_name']}</td>
            <td>{$row['last_name']}</td>
            <td>{$row['project_title']}</td>
            <td>{$row['email']}</td>
            <td>{$row['phone']}</td>
            <td>{$row['time_slot']}</td>
        </tr>";
    }
    echo "</table>";

    echo "<h1>Available Time Slots</h1>";
    $result = $conn->query("SELECT * FROM time_slots");
    echo "<table border='1'><tr><th>Time Slot</th><th>Remaining Seats</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['time_slot']}</td>
            <td>{$row['remaining_seats']}</td>
        </tr>";
    }
    echo "</table>";

    $conn->close();
    ?>
</body>
</html>
