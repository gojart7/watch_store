<?php 
include_once 'brandController.php';
if(session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  
  if (!isset($_SESSION['adminemail'])) {
    header('Location: adminLogin.php');
    exit;
  }

  $brandController = new BrandController();
  $totalBrands = $brandController->countAllBrands();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css" />
</head>
<div class="nav-links">
    <h1>Watch Store</h1>
    <a href="AdminProduct.php">Product</a>
    <a href="AdminBrand.php">Brands</a>
    <a href="adminLogout.php">Logout</a>
  </div>

  <div class="container">
    <div class="card">
      <h2>Total Brands</h2>
      <p>You currently have <strong><?php echo $totalBrands; ?></strong> brands registered.</p>
    </div>

    <div class="card">
      <h2>Users</h2>
      <p>Total users: <strong>1,234</strong></p>
    </div>
  </div>
<body>
    
</body>
</html>