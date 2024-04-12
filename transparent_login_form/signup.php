<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testing1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['uname'];
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $password = $_POST['pass']; // Store password as plain text

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("INSERT INTO users (USERNAME, FIRST_NAME, LAST_NAME, PASSWORD) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $first_name, $last_name, $password);

    if ($stmt->execute()) {
        echo "REGISTERED SUCCESSFULLY!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>