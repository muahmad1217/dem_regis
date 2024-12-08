<?php
$conn = new mysqli("localhost", "root", "", "hello");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM time_slots WHERE remaining_seats > 0");

while ($row = $result->fetch_assoc()) {
    echo "<option value='{$row['time_slot']}'>{$row['time_slot']} ({$row['remaining_seats']} seats remaining)</option>";
}

$conn->close();
?>
