<!-- delivery.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Delivery Items</title>
    <!-- Add any necessary CSS or external stylesheets -->
</head>
<body>
    <h1>Delivery Items</h1>

    <?php
    // Include the connection file
    include_once('connection.php');

    // Fetch data from the delivery_items table
    $sql = "SELECT * FROM delivery_items";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display table headers
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Description</th><th>Price</th><th>Quantity</th><th>Address</th><th>City</th><th>ZIP</th><th>Username</th><th>Created At</th></tr>';

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["product_id"] . "</td>";
            echo "<td>" . $row["description"] . "</td>";
            echo "<td>" . $row["price"] . "</td>";
            echo "<td>" . $row["quantity"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["city"] . "</td>";
            echo "<td>" . $row["zip"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["created_at"] . "</td>"; // Output the created_at column

            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No delivery items found";
    }

    // Close the connection
    $conn->close();
    ?>

</body>
</html>
