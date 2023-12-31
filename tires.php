<?php
session_start(); // Starting the session

// Check if the username is stored in the session
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} 
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="Test.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
    integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Tires</title>
  <style>
    .card {
      margin: 10px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      text-align: center;
    }
    body {
    background-color:#7f819f4d  ;
  }
    </style>
 
</head>

<body>
  <!-- heaader-->

  <div class="info">
    <div class="blackRectangle">
    <span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
    <a href="index.php" class="text">Home Page </a>
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
        <div class="name">

        <?php 
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        echo '<span style="font-size: 20px; margin-top:-10px;">Welcome ' . $_SESSION['username'] . '</span>';
    } else {
        echo '<h2 style="font-size: 18px;">Welcome Guest</h2>';
 // or any default message if the username is not set
    }
    ?>
</div>      
    </div>
</div>
<h1 class="name">TIRES</h2><br>
  <!-- product selection -->
  <?php
include_once('connection.php');
// Fetch products
$sql = "SELECT id, image_url, description, price FROM product WHERE id >100 AND id < 200";
$result = $conn->query($sql);

echo '<div class="container">';
echo '<div class="row">';
// Check if there are results
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card" style="width: 18rem;">';
        echo '<img style="width:260px; height:230px;" src="' . $row["image_url"] . '" alt="' . $row["description"] . '">';
        echo '<div class="card-body">';
        echo "<p>Product ID: " . $row["id"] . "</p>";
        echo "<p>Name: " . $row["description"] . "</p>";
        echo "<p>Price: $" . $row["price"] . "</p>";
        echo '<button class="add_cart_btn" data-id="' . $row["id"] . '" data-description="' . $row["description"] . '" data-price="' . $row["price"] . '">Add to Cart</button>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "0 results";
}
echo '</div>';
echo '</div>';
$conn->close();
?>
  <!-- end product section -->
  <div class="lowerpRectangle">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <p class="whiteText">Customer Support</p>
                    <p class="greyText">Return & Refund</p>
                    <p class="greyText">Tires Warranties</p>
                    <p class="greyText">FAQs</p>
                </div>
                <div class="col-md-4">
                    <p class="whiteText">About Ghayarly</p>
                    <a href="about-us.html" class="greyText">Who we are?</a><br>
                    <br>
                    <a href="https://pan-marine.net/images/2020/06/18/pm-map.jpg" class="greyText">Find Stores</a>                
                </div>
                <div class="col-md-4">
                    <p class="whiteText">Customer Service</p>
                    <p class="greyText">Contact Us</p>
                    <p class="greyText">feedback@ghayarly.com</p>
                    <p class="greyText">19255</p>
                </div>
            </div>
            <div class="social_box">
                <a href="">
                  <i class="fa fa-facebook" aria-hidden="true"></i>
                </a>
                <a href="">
                  <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>
                <a href="">
                  <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
                <a href="">
                  <i class="fa fa-youtube" aria-hidden="true"></i>
                </a>
              </div>
        </div>
    </div>
  <!-- end info_section -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const addToCartButtons = document.querySelectorAll('.add_cart_btn');

        addToCartButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                const description = this.getAttribute('data-description');
                const price = this.getAttribute('data-price');

                // Redirect to cart.php and pass the product information as URL parameters
                window.location.href = 'cart.php?id=' + productId +
                                       '&description=' + encodeURIComponent(description) +
                                       '&price=' + price;
            });
        });
    });
</script>
</body>

</html>