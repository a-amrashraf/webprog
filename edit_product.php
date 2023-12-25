<!-- edit_product.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>

    <?php
    include_once('connection.php');

    // Check if ID is set in the URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Fetch product details based on the ID
        $sql = "SELECT * FROM product WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $newDescription = $_POST['description'];
                $newPrice = $_POST['price'];
                $newImageURL = $_POST['image_url'];

                // Update product details in the database
                $updateSql = "UPDATE product SET description='$newDescription', price='$newPrice', image_url='$newImageURL' WHERE id=$id";
                if ($conn->query($updateSql) === TRUE) {
                    // Redirect to admin dashboard after updating
                    header("Location: admin_dashboard.php");
                    exit();
                } else {
                    echo "Error updating product: " . $conn->error;
                }
            }
    ?>
            <!-- Form to edit the product -->
            <form action="" method="POST">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" value="<?php echo $row['description']; ?>" required><br><br>

                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="<?php echo $row['price']; ?>" required><br><br>

                <label for="image_url">Image URL:</label>
                <input type="text" id="image_url" name="image_url" value="<?php echo $row['image_url']; ?>" required><br><br>

                <input type="submit" value="Update">
            </form>
            <br>
            <a href="admin_dashboard.php"><button>Return to Dashboard</button></a>
    <?php
        } else {
            echo "Product not found.";
        }
    } else {
        echo "No ID provided.";
    }

    $conn->close();
    ?>
</body>
</html>
