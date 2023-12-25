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
    <form id="addForm" style="display: none;" method="POST" action="add_product.php">
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

   <!-- Show Product Table -->
   <table border="1">
       <!-- Table headers -->
       <tr>
           <th>ID</th>
           <th>Description</th>
           <th>Price</th>
           <th>Image URL</th>
           <th>Action</th>
           <th>Edit</th>
       </tr>
       <!-- PHP code to display products -->
       <?php
       include_once('connection.php');
       $sql = "SELECT * FROM product";
       $result = $conn->query($sql);

       if ($result->num_rows > 0) {
           while ($row = $result->fetch_assoc()) {
               echo "<tr id='row_" . $row["id"] . "'>";
               echo "<td>" . $row["id"] . "</td>";
               echo "<td>" . $row["description"] . "</td>";
               echo "<td>" . $row["price"] . "</td>";
               echo "<td>" . $row["image_url"] . "</td>";
               echo '<td><button onclick="deleteProduct(' . $row["id"] . ')">Delete</button></td>';
               echo '<td><button onclick="editProduct(' . $row["id"] . ')">Edit</button></td>';
               echo "</tr>";
           }
       } else {
           echo "<tr><td colspan='6'>No products found</td></tr>";
       }
       $conn->close();
       ?>
   </table>

    <script>
        function toggleForm() {
            var form = document.getElementById("addForm");
            form.style.display = form.style.display === "none" ? "block" : "none";
        }

        function editProduct(id) {
            window.location.href = 'edit_product.php?id=' + id;
        }

        function deleteProduct(id) {
            if (confirm('Are you sure you want to delete this item?')) {
                $.ajax({
                    type: 'POST',
                    url: 'delete_product.php',
                    data: { delete_id: id },
                    success: function(response) {
                        if (response === 'success') {
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
