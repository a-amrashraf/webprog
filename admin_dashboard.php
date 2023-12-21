<!-- admin_dashboard.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        /* Hide the form by default */
        #productForm {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Welcome to the Admin Dashboard</h1>

    <!-- Button to toggle the form visibility -->
    <button onclick="toggleForm()">Add Product</button>

    <!-- Form to add rows to the product table -->
    <form id="productForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id"><br><br>

        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required><br><br>

        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required><br><br>

        <label for="image_url">Image URL:</label>
        <input type="text" id="image_url" name="image_url" required><br><br>

        <input type="submit" value="Add to Table">
    </form>

    <script>
        function toggleForm() {
            var form = document.getElementById("productForm");
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>

    <?php
    session_start();
    include_once('connection.php'); // Assuming you have a file to handle the database connection

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $id = $_POST['id']; // If using auto-increment, this may be omitted
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image_url = $_POST['image_url'];

        // SQL query to insert data into the product table
        $sql = "INSERT INTO product (id, description, price, image_url) VALUES ('$id', '$description', '$price', '$image_url')";
        
        if ($conn->query($sql) === TRUE) {
            // Redirect back to admin dashboard after successful insertion
            header('Location: admin_dashboard.php');
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
    ?>
</body>
</html>
