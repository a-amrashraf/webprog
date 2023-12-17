<!DOCTYPE html>
<html>
<head>
    <title>Product Listing</title>
    <!-- Your CSS styles can be included here -->
    <style>
        /* Define your CSS styles for the product listing */
        /* ... Your existing styles ... */
    </style>
</head>
<body>
    <h1>Product Listing</h1>
    <div class="product-list">

    <?php
    include_once('connection.php');
    // Fetch products
    $sql = "SELECT id, image_url, product_name, category, price FROM admin";
    $result = $conn->query($sql);

    // Check if there are results
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product">';
            echo '<img src="' . $row["image_url"] . '" alt="' . $row["product_name"] . '">';
            echo "<p>Product ID: " . $row["id"] . "</p>";
            echo "<p>Name: " . $row["product_name"] . "</p>";
            echo "<p>Category: " . $row["category"] . "</p>";
            echo "<p>Price: $" . $row["price"] . "</p>";
            // Add to Cart button
            echo '<button class="add-to-cart-btn" onclick="addToCart(' . $row["id"] . ', \'' . $row["product_name"] . '\', \'' . $row["category"] . '\', ' . $row["price"] . ')">Add to Cart</button>';
            echo '</div>';
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
    </div>
    <script>
        function addToCart(productId, productName, category, price) {
            // Redirect to cart.php and pass the product information as URL parameters
            window.location.href = 'cart.php?id=' + productId +
                                   '&product_name=' + encodeURIComponent(productName) +
                                   '&category=' + encodeURIComponent(category) +
                                   '&price=' + price;
        }
    </script>
</body>
</html>
