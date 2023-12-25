<!-- edit_product.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="Test.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <style>
        body{
        font-family:sans-serif;
        font-size: 17px;
    }
    </style>
</head>
<body>
    <h1 style="text-align:center;">Edit Product</h1>

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
            <div class="container">
        <div class="row">
       <div class="col-md-6 offset-md-3">
            <form action="" method="POST">
            <div class="user mb-3">
                <label for="description"  class="form-label">Description:</label>
                <input type="text" class="form-control" id="description" name="description" value="<?php echo $row['description']; ?>" required><br><br>
            </div>
            <div class="user mb-3">
                <label for="price"  class="form-label">Price:</label>
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $row['price']; ?>" required><br><br>
            </div>
            <div class="user mb-3">
                <label for="image_url"  class="form-label">Image URL:</label>
                <input type="text" class="form-control" id="image_url" name="image_url" value="<?php echo $row['image_url']; ?>" required><br><br>
            </div>
                <input class="add-tab-button" type="submit" value="Update">
            </form>
            <br>
            <a href="admin_dashboard.php"><button>Return to Dashboard</button></a>
            </div>
    </div>
    </div>
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