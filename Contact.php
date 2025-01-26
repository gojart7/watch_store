<?php 
    session_start();
    require_once 'auth_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="css/ContactStyle.css">
</head>

<body>
    
<div class="nav-links">
    <h1>Watch Store</h1>
    <a href="index.php">Home</a>
    <a href="ProductPage.php">Product</a>
    <a href="UserBrands.php">Our Brands</a>
    <a href="AboutUs.html">About Us</a>
    <a href="logout.php">Logout</a>
  </div>
    
<section class="home" id="home">
</section>
<section class="contact" id="contact">

    <h1 class="heading"><span>contact</span> us</h1>

    <div class="row">

        <iframe class="map" src="https://maps.google.com/maps?q=ahp%20prizren&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" allowfullscreen="" loading="lazy"></iframe>

        <form action="https://formspree.io/f/xwkjenol"
        method="POST">
            
            <h3>get in touch</h3>
            <input type="text" placeholder="your name" class="box">
            <input name="email" type="email" placeholder="your email" class="box">
            <input type="tel" placeholder="subject" class="box">
            <textarea name="message" placeholder="your message" class="box" cols="30" rows="10"></textarea>
            <input type="submit" value="Send" class="btn">
        </form>

    </div>
</section>




<script src="js/script.js"></script>
</body>
</html>