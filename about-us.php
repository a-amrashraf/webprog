<?php
session_start(); // Starting the session

// Check if the username is stored in the session
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="Test.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
    integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Ghayarly</title>
  <style>
   h2{
    text-align: center;
    font-size: 40px;
    margin-top: 50px;
    margin-bottom: 50px;
    color: #be2644;
    font-family: 'Roboto', sans-serif;
    font-weight: 700;
    line-height: 1.5;
    letter-spacing: 0.5px;
   }
  .info p{
    text-align: center;
    font-size: 20px;
    margin-top: 50px;
    margin-bottom: 50px;
    color: #171f21;
    font-family: 'Roboto', sans-serif;
    font-weight: 700;
    line-height: 1.5;
    letter-spacing: 0.5px;
   }
   .info li{
    text-align: center;
    font-size: 20px;
    margin-top: 50px;
    margin-bottom: 50px;
    color: #171f21;
    font-family: 'Roboto', sans-serif;
    font-weight: 700;
    line-height: 1.5;
    letter-spacing: 0.5px;
   }
</style>
</head>
<body>
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
      }
      ?>
  </div>      
      </div>
  </div> 
  <body>
    <div class="info">
   <h2>About Ghayarly</h2>
    <div>
  <center> <img src="https://di-uploads-pod11.dealerinspire.com/shelormotormile/uploads/2020/05/Webp.net-resizeimage-29-1024x683.jpg" style="width:50%; height:50%;" alt="About Ghayarly"></center>
    <p>
       Ghayarly is a professional auto service center that operates in Egypt since 2023 to provide top quality car services and 
       premium tire brands for all car models and makes. It offers the most convenient service experience to drivers all around
        Egypt through its ever growing chain of stores across the country, online store and mobile service vans. We are always 
         fully dedicated to help drivers everywhere to enjoy the safest, most comfortable and pleasurable possible drives.
    </p>
</div>
<section>
    <h2>Our Mission</h2>
    <div>
  <center>  <img src="https://occupation-dictionary.vtc.edu.hk/f/occupation/4496/690c492/description_duty_image-iStock-504070478.jpg" style="width:50%; height:50%;" alt="Our Mission"> </center>
  <p>
      To provide drivers with professional auto service and premium tire brands, for their utmost safety, convenience, 
      and driving pleasure. Ghayarly is the only service chain and retailer in Egypt that combines the superb quality 
      of global brands with outstanding service expertise, using the world’s latest technology, and best maintenance 
      tools and equipment.
    </p>
   
</div>
</section>

  <section>
    <h2>What We Offer</h2>
    <div>
<center> <img src="https://cdn-fastly.autoguide.com/media/2023/06/28/13303384/how-long-do-tires-last-on-average.jpg?size=720x845&nocrop=1" style="width:50%; height:50%;" alt="what we offer"></center>
    <p>
      We provide the world’s best tire brands. We are the sole agent of Bridgestone; the no.1 tire brand worldwide, 
      along with Firestone and Starmaxx, providing full spectrum tire collections to satisfy the needs of all vehicle
       types and driving conditions. We also offer a whole range of top global brands of car batteries, oils, and accessories.
    </p>
</div>
  </section>

  <section>
    <h2>Our Reach</h2>
      <p>
        Over 50 comfortable service centers and showrooms, strategically located, in almost every major city all around the country.<br>Online store; to browse, select and purchase your products from the comfort of your home.<br>Mobile service vans; that reach you anywhere to deliver, install your products, and offer a full range of car services at your doorstep.
    </p>
  </section>
    </div>
    </div>
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
                    <a href="about-us.php" class="greyText">Who we are?</a><br>
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
</body>
</html>