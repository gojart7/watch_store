<?php 
include_once 'brandController.php';

$brandController = new BrandController();
$brands = $brandController->getAllBrands(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brands</title>
    <link rel="stylesheet" href="css/userBrands.css">
</head>
<div class="nav-links">
    <h1>Watch Store</h1>
    <a href="index.php">Home</a>
    <a href="ProductPage.php">Product</a>
    <a href="AboutUs.html">About Us</a>
    <a href="">Contact</a>
</div>
<div class="container">
     <?php foreach ($brands as $brand): ?>
        <div class="card">
            <h2><?php echo htmlspecialchars($brand['name']); ?></h2>
            <p><?php echo htmlspecialchars($brand['description']); ?></p>
        </div>
        <?php endforeach; ?>
    </div>
<body>
    
</body>
</html>