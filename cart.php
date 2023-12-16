<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="Test.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
<body>
<div class="info">
            <div class="blackRectangle">
            <span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
    <a href="index.html" class="text">Home Page </a>
                <span class="icon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                <span class="text">19255</span>
                <span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                    <a href="https://pan-marine.net/images/2020/06/18/pm-map.jpg" class="text">Our Stores </a>
                </span>               
                 <span class="icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
               <a href="cart.php" class="text">My Cart</a>
                <a href="log-in.php">
                 <span class="icon"><i class="fa fa-user" aria-hidden="true"></i></span>
                </a>
            </div>
        </div>
         
        <h1 class="name">MY CART</h2><br>
        <?php
include_once('connection.php');

// Check if the ID parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the data for the clicked ID from your database
    $sql = "SELECT * FROM product WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Insert the fetched data into the cart table
        $insertQuery = "INSERT INTO cart (id, description, price, quantity) VALUES (?, ?, ?, 1) ON DUPLICATE KEY UPDATE quantity = quantity + 1";
        $stmtInsert = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($stmtInsert, 'isd', $row['id'], $row['description'], $row['price']);
        mysqli_stmt_execute($stmtInsert);
        mysqli_stmt_close($stmtInsert);

        // Redirect back to the previous page or wherever you want after insertion
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "No data found for the selected ID";
    }
}

// Handle form submission for updating quantity
if (isset($_POST['update_id']) && isset($_POST['quantity'])) {
    $updateId = $_POST['update_id'];
    $newQuantity = $_POST['quantity'];

    // Update the quantity in the cart table
    $updateQuery = "UPDATE cart SET quantity = ? WHERE id = ?";
    $stmtUpdate = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmtUpdate, 'ii', $newQuantity, $updateId);
    mysqli_stmt_execute($stmtUpdate);
    mysqli_stmt_close($stmtUpdate);

    // Redirect back to the cart page after updating quantity
    header('Location: cart.php');
    exit();
}

// Handle form submission for deleting an item from the cart
if (isset($_POST['delete_id'])) {
    $deleteId = $_POST['delete_id'];

    // Delete the item from the cart table
    $deleteQuery = "DELETE FROM cart WHERE id = ?";
    $stmtDelete = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmtDelete, 'i', $deleteId);
    $deleteResult = mysqli_stmt_execute($stmtDelete);

    if ($deleteResult) {
        // Redirect back to the cart page after successful deletion
        header('Location: cart.php');
        exit();
    } else {
        // Display an error message if deletion fails
        echo "Error deleting item: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmtDelete);
}

// Display existing cart items with quantity controls and delete option
$sqlCart = "SELECT * FROM cart";
$resultCart = mysqli_query($conn, $sqlCart);

echo '<div id="cartInfo">';
$totalPrice = 0; // Initializing the total price variable

// Display existing cart items with quantity controls and delete option
if ($resultCart) {
    if (mysqli_num_rows($resultCart) > 0) {
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Brand</th><th>Price</th><th>Quantity</th><th>Action</th></tr>';

        while ($row = mysqli_fetch_assoc($resultCart)) {
            echo '<tr >';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['description'] . '</td>';
            echo '<td>' . $row['price'] . '</td>';
            echo '<td>';
            echo '<form method="post">';
            echo '<input type="hidden" name="delete_id" value="' . $row['id'] . '">';
        
            // Minus button
            echo '<button type="button" class="quantity-button" data-type="minus">-</button>';
        
            // Quantity input field
            echo '<input type="text" name="quantity" value="' . $row['quantity'] . '">';
        
            // Plus button
            echo '<button type="button" class="quantity-button" data-type="plus">+</button>';
        
            echo '<button type="submit" name="update_id" value="' . $row['id'] . '">Update</button>';
        
            // Delete button
            echo '<button type="button" class="delete-button" data-id="' . $row['id'] . '">Delete</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        
            $totalPrice += $row['price'] * $row['quantity'];
        }
        

        echo '<tr><td colspan="3"><strong>Total:</strong></td><td>' . $totalPrice . '</td><td></td></tr>';

        echo '</table>';
    } else {
        echo "No records found in the cart";
    }
} else {
    echo "Query execution failed for the cart";
}
echo '</div>';
?>
<button onclick="goToIndex()">Return to home page </button>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Quantity adjustment script
        const quantityButtons = document.querySelectorAll('.quantity-button');

        quantityButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default action (form submission)

                const type = this.getAttribute('data-type');
                const inputField = this.parentNode.querySelector('input[name="quantity"]');
                let currentValue = parseInt(inputField.value);

                if (type === 'minus' && currentValue > 1) {
                    currentValue -= 1;
                } else if (type === 'plus') {
                    currentValue += 1;
                }

                inputField.value = currentValue;

                // If needed, you can add an AJAX call here to update the quantity without submitting the form
            });
        });

        // Delete button functionality
        const deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                if (confirm('Are you sure you want to delete this item?')) {
                    const deleteId = this.getAttribute('data-id');
                    const form = this.closest('form');

                    form.querySelector('input[name="delete_id"]').value = deleteId;
                    form.submit();
                }
            });
        });
    });
</script>

<script>
    function goToIndex() {
        window.location.href = 'index.html';
    }
</script>
</body>
</html>
