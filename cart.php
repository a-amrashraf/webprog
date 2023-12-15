<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
</head>
<body>

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

</body>
</html>
