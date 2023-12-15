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

// Fetch data from cart_tires table
$sqlCart = "SELECT * FROM cart_tires";
$resultCart = mysqli_query($conn, $sqlCart);

echo '<div id="cartInfo">';
if ($resultCart) {
    if (mysqli_num_rows($resultCart) > 0) {
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Brand</th><th>Model</th><th>Size</th><th>Price</th></tr>';
        
        // Output data of each row
        while ($row = mysqli_fetch_assoc($resultCart)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['brand'] . '</td>';
            echo '<td>' . $row['model'] . '</td>';
            echo '<td>' . $row['size'] . '</td>';
            echo '<td>' . $row['price'] . '</td>';
            echo '</tr>';
        }
        
        echo '</table>';
    } else {
        echo "No records found in the cart";
    }
} else {
    echo "Query execution failed for the cart";
}
echo '</div>';

// Your existing code to display and insert data into tires table
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fetch_data']) && $_GET['fetch_data'] === 'true') {
    echo '<div id="dynamicCartInfo">';
    
    if (!$conn) {
        echo "Connection failed";
        die();
    } else {
        $sql = "SELECT brand, model, size, price FROM tires";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Display data
                    echo "<div>Brand: " . $row['brand'] . " ---- Model: " . $row['model'] . " ---- Size: " . $row['size'] . " ---- Price: " . $row['price'] . "</div>";

                    // Insert into cart_tires table
                    $insertQuery = "INSERT INTO cart_tires (brand, model, size, price) VALUES ('" . $row['brand'] . "', '" . $row['model'] . "', '" . $row['size'] . "', " . $row['price'] . ")";
                    mysqli_query($conn, $insertQuery);
                }
            } else {
                echo "0 Records Found";
            }
        } else {
            echo "Query execution failed";
        }
    }

    mysqli_close($conn);
    echo '</div>';
} 
?>


<button onclick="goToIndex()">Return to Index</button>
<script>
    function goToIndex() {
        window.location.href = 'index.html';
    }
</script>
</body>
</html>