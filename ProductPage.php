<?php 
if(session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  
  if (!isset($_SESSION['adminemail'])) {
    header('Location: adminLogin.php');
    exit;
  }

  require_once 'productController.php';

  $productController = new ProductController();
  $products = $productController->getAllProds();
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products</title>
    <link rel="stylesheet" href="ProductPage.css" />
  </head>
  <div class="nav-links">
    <h1>Watch Store</h1>
    <a href="index.php">Home</a>
    <a href="UserBrands.php">Our Brands</a>
    <a href="AboutUs.html">About Us</a>
    <a href="">Contact</a>
    <a href="logout.php">Logout</a>
  </div>
  <p>Find Your Perfect Timepiece - Elegance and Precision in Every Tick!</p>
  <body>
    <div class="container">
    <?php foreach ($products as $product): ?>
      <div class="items">
        <img src="<?php echo str_replace('C:/laragon/www/', '/', htmlspecialchars($product['image'])); ?>" alt="Product Image" />
        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
        <h5 class="details"><?php echo htmlspecialchars($product['brand_name']); ?></h5>
        <p class="details"><?php echo htmlspecialchars($product['description']); ?></p>
        <p class="price"><?php echo htmlspecialchars($product['price']); ?>€</p>
        <button class="buy">BUY</button>
      </div>
    <?php endforeach; ?>
    </div>
  </body>
</html>
