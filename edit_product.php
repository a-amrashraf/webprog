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
    ?>
            <!-- Form to edit the product -->
            <form action="update_product.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <label for="description">Description:</label>
                <input type="text" id="description" name="description" value="<?php echo $row['description']; ?>" required><br><br>

                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="<?php echo $row['price']; ?>" required><br><br>

                <label for="image_url">Image URL:</label>
                <input type="text" id="image_url" name="image_url" value="<?php echo $row['image_url']; ?>" required><br><br>

                <input type="submit" value="Update">
            </form>
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
