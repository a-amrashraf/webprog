<!DOCTYPE html>
<html>
<head>
    <title>Product Listing</title>
    <!-- Your CSS styles can be included here -->
    <style>
        /* Define your CSS styles for the product listing */
        .product {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
        .product img {
            max-width: 100px; /* Adjust the maximum width of the image */
            height: auto;
            display: block;
            margin-bottom: 5px;
        }
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
        echo '</div>';
    }
} else {
    echo "0 results";
}
$conn->close();
?>
    </div>
    <script>
        // Any JavaScript functionality can be added here
    </script>
</body>
</html>
