<!-- add_product.php -->
<?php
include_once('connection.php'); // Assuming you have a file to handle the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id']; // Ensure you handle this ID based on your database setup (auto-increment or user-provided)
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];

    // SQL query to insert data into the product table
    $sql = "INSERT INTO product (id, description, price, image_url) VALUES ('$id', '$description', '$price', '$image_url')";
    
    if ($conn->query($sql) === TRUE) {
        header('Location: admin_dashboard.php'); // Redirect to admin_dashboard.php after successful insertion
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
