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
  <title>oils</title>

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
    </div>
</div>
  <!-- product selection -->
  <?php
include_once('connection.php');
// Fetch products
$sql = "SELECT id, image_url, description, price FROM product WHERE id > 200 AND id < 300";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
      echo '<figure class="figure" style="margin: 20px; padding-left: 20px;">';
        echo '<img style="width:250px; height:250px;" src="' . $row["image_url"] . '" alt="' . $row["description"] . '">';
        echo '<figcaption style="padding-top:10px;">';
        echo "<p>Product ID: " . $row["id"] . "</p>";
        echo "<p>Name: " . $row["description"] . "</p>";
        echo "<p>Price: $" . $row["price"] . "</p>";
        echo '</figcaption>';
        echo '<button class="add_cart_btn" data-id="' . $row["id"] . '" data-description="' . $row["description"] . '" data-price="' . $row["price"] . '">Add to Cart</button>';
        echo '</figure>';
        echo '</div>';
    }
} else {
    echo "0 results";
}
$conn->close();
?>
  <!-- info section -->
  <div class="lowerpRectangle">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="whitepText">
            <h5>
              <a href="" class="navbar-brand">
                <span>
                  Ghayarly
                </span>
              </a>
            </h5>
            <p>
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              All over Egypt
            </p>
            <p>
              <i class="fa fa-phone" aria-hidden="true"></i>
              19255
            </p>
            <p>
              <i class="fa fa-envelope" aria-hidden="true"></i>
              feedback@Ghayarly.com
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="whitepText" >
            <h5>
              Information
            </h5>
            <p>
              All your car needs and services at your door step.
           <br>
              with Ghayarly you can order your car service online and we will come to you or visit us at the nearest shop.
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="whitepText">
            <h5>
              Useful Link
            </h5>
            <ul>
              <li>
                <a href="index.html">
                  Home
                </a>
              </li>
              <li>
                <a>
                  About us
                </a>
              </li>
           
              <li>
                <a>
                  Why Us
                </a>
              </li>
            
            </ul>
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
      </div>
    </div>
  </section>

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