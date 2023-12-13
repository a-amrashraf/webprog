<?php
// Replace these values with your actual database credentials
$db_server="localhost";
$db_user="root";
$db_pass="";
$db_name="businessdb";

// Create connection
$conn = new mysqli($db_server,$db_user,$db_pass,$db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare data to be inserted
$user = "HEMO"; // Replace with the actual username
$password = "omar123"; // Replace with the hashed password
$reg_date = date('Y-m-d H:i:s'); // Current date and time

// SQL query to insert data into the table
$sql = "INSERT INTO users (user, password, reg_date) VALUES ('$user', '$password', '$reg_date')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
