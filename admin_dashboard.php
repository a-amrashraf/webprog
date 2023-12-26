<!-- admin_dashboard.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
<body >
    <h1 style="text-align:center;">Welcome to the Admin Dashboard</h1>

    <!-- Add Button to Toggle Form Visibility -->
    <button  onclick="toggleForm()">Add Product</button>

    <!-- Form to add rows to the product table (Initially Hidden) -->
    
    <div class="container">
        <div class="row">
       <div class="col-md-6 offset-md-3">
    <form id="addForm" style="display: none;" method="POST" action="add_product.php">
    <div class="user mb-3">
        <label for="id" style="font-size:17px;" class="form-label">ID:</label>
        <input type="text" class="form-control" id="id" name="id"><br><br>
    </div>
    <div class="user mb-3">
        <label for="description" style="font-size:17px;" class="form-label">Description:</label>
        <input type="text" class="form-control" id="description" name="description" required><br><br>
    </div>
    <div class="user mb-3">
        <label for="price" style="font-size:17px;" class="form-label">Price:</label>
        <input type="text" class="form-control" id="price" name="price" required><br><br>
    </div>
    <div class="user mb-3">
        <label for="image_url" style="font-size:17px;" class="form-label">Image URL:</label>
        <input type="text" class="form-control" id="image_url" name="image_url" required><br><br>
    </div>
        <input class="add-tab-button" type="submit" value="Add to Table">
        <p style="margin:5px;">NOTE</p>
    <p>Every item has a certain range of Ids <br>  Tires: 100 < T < 200 <br> Oils: 200 < O < 300 <br> Batteries: 300 < B < 400 <br> Services: 400 < S < 500 <br> Accessories: 500 < A < 600 </p>
    </form>
    </div>
    </div>
    </div>
    <a href="index.html"><button>Home Page</button></a>

   <!-- Show Product Table -->
   <table class="table" border="1">
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
               echo "<td >" . $row["price"] . "</td>";
               echo "<td >" . $row["image_url"] . "</td>";
               echo '<td><button style="background-color:red;" onclick="deleteProduct(' . $row["id"] . ')">Delete</button></td>';
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