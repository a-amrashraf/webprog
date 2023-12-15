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
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fetch_data']) && $_GET['fetch_data'] === 'true') {
    echo '<div id="cartInfo">';
    include_once('connection.php');

    if (!$conn) {
        echo "Connection failed";
        die();
    } else {
        $sql = "SELECT brand, model, size, price FROM tires";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div>Brand: " . $row['brand'] . " ---- Model: " . $row['model'] . " ---- Size: " . $row['size'] . " ---- Price: " . $row['price'] . "</div>";
                }
            } else {
                echo "0 Records Found";
            }
        } else {
            echo "Query execution failed";
        }

        mysqli_close($conn);
    }
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
