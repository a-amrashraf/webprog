<?php
$server = "localhost";
$user = "root";
$pass = "";
$dbname = "businessdb";

// Establish connection
$conn = mysqli_connect($server, $user, $pass, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch the first row from the 'tires' table
$sql = "SELECT * FROM tires LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Output data of the first row
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row); // Return the data as JSON (for demonstration)
} else {
    echo "No results found";
}

mysqli_close($conn);
?>
