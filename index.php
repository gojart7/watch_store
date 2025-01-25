<?php 
    // session_start();
    require_once 'auth_check.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HomePage</title>
    <link rel="stylesheet" href="HomePage.css" />
  </head>
  <div class="navBar">
    <h1>Watch Store</h1>
    <!-- <a href="">Home</a> -->
    <a href="ProductPage.php">Product</a>
    <a href="UserBrands.php">Our Brands</a>
    <a href="AboutUs.html">About Us</a>
    <a href="">Contact</a>
    <a href="logout.php">Logout</a>
  </div>
  <body>
    <div class="intro">
      <h2>Welcome to Watch Store</h2>
      <p>
        Discover a world of timeless elegance and cutting-edge design at Watch
        Store. We offer a curated selection of luxurious timepieces from
        renowned brands such as Rolex and Hublot, combining precision
        engineering with unmatched style.
      </p>
      <p>
        Whether you're searching for the perfect accessory to elevate your style
        or a gift that lasts a lifetime, our collection has something for
        everyone. Explore our watches and let us help you make every moment
        count.
      </p>
    </div>

    <div class="slider-container">
      <div class="slider">
        <div
          class="slide"
          style="background-image: url('assets/images/Rolex/Rolex1.jpg')"
        ></div>
        <div
          class="slide"
          style="background-image: url('assets/images/Rolex/Rolex2.jpg')"
        ></div>
        <div
          class="slide"
          style="background-image: url('assets/images/Rolex/Rolex4.jpg')"
        ></div>
        <div
          class="slide"
          style="background-image: url('assets/images/Hublot/Hublot1.jpg')"
        ></div>
        <div
          class="slide"
          style="background-image: url('assets/images/Hublot/Hublot2.jpg')"
        ></div>
      </div>
      <button class="prev">❮</button>
      <button class="next">❯</button>
    </div>

    <div class="footer">
      <div class="contact">
        <h3>Contact Us</h3>
        <li>Email: WatchStore@gmail.com</li>
        <li>Number: +383045123456</li>
        <li>Address: Prizren</li>
      </div>
      <div class="social-media">
        <h3>Follow For More</h3>
        <li><a href="">Facebook</a></li>
        <li><a href="">Instagram</a></li>
        <li><a href="">LinkedIn</a></li>
      </div>
      <div class="home-links">
        <h3>Quick Links</h3>
        <li><a href="">Home</a></li>
        <li><a href="ProductPage.php">Product</a></li>
        <li><a href="UserBrands.php">Our Brands</a></li>
        <li><a href="AboutUs.html">About Us</a></li>
        <li><a href="">Contact</a></li>
      </div>
    </div>
    <script src="HomePage.js"></script>
  </body>
</html>
