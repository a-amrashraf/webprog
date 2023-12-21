<!-- admin_dashboard.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1>Welcome to the Admin Dashboard</h1>

    <!-- Add Button to Toggle Form Visibility -->
    <button onclick="toggleForm()">Add Product</button>

    <!-- Form to add rows to the product table (Initially Hidden) -->
    <form id="addForm" style="display: none;" method="POST">
        <!-- Your input fields for adding products -->
    </form>

    <!-- Show Product Table -->
    <table border="1">
        <!-- Table headers -->
        <tr>
            <th>ID</th>
            <th>Description</th>
            <th>Price</th>
            <th>Image URL</th>
            <th>Action</th>
        </tr>
        <?php
        // Display product table rows
        include_once('connection.php');
        $sql = "SELECT * FROM product";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["image_url"] . "</td>";
                echo '<td><button onclick="deleteProduct(' . $row["id"] . ')">Delete</button></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No products found</td></tr>";
        }
        $conn->close();
        ?>
    </table>

    <script>
        // Function to toggle the visibility of the add form
        function toggleForm() {
            var form = document.getElementById("addForm");
            form.style.display = form.style.display === "none" ? "block" : "none";
        }

        // Function to delete a product using AJAX
        function deleteProduct(id) {
            if (confirm('Are you sure you want to delete this item?')) {
                $.ajax({
                    type: 'POST',
                    url: 'delete_product.php',
                    data: { delete_id: id },
                    success: function(response) {
                        if (response === 'success') {
                            // Reload the current page after successful deletion
                            location.reload();
                        } else {
                            alert('Error deleting product.');
                        }
                    }
                });
            }
        }
    </script>
</body>
</html>
