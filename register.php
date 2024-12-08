<?php
$conn = new mysqli("localhost", "root", "", "hello");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$project_title = $_POST['project_title'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$time_slot = $_POST['time_slot'];

$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $stmt = $conn->prepare("UPDATE students SET first_name = ?, last_name = ?, project_title = ?, email = ?, phone = ?, time_slot = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", $first_name, $last_name, $project_title, $email, $phone, $time_slot, $id);
    if ($stmt->execute()) {
        echo "Registration updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    $stmt = $conn->prepare("INSERT INTO students (id, first_name, last_name, project_title, email, phone, time_slot) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $id, $first_name, $last_name, $project_title, $email, $phone, $time_slot);
    if ($stmt->execute()) {
        $stmt = $conn->prepare("UPDATE time_slots SET remaining_seats = remaining_seats - 1 WHERE time_slot = ?");
        $stmt->bind_param("s", $time_slot);
        $stmt->execute();
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>
