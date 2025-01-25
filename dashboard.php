<?php 
include_once 'brandController.php';
include_once 'productController.php';
include_once 'userRepository.php';
include_once 'adminRepository.php';

if(session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  
  if (!isset($_SESSION['adminemail'])) {
    header('Location: adminLogin.php');
    exit;
  }

  $brandController = new BrandController();
  $productController = new ProductController();
  $userRepo = new UserRepository();
  $adminRepo = new AdminRepository();
  
  $totalBrands = $brandController->countAllBrands();
  $totalProds = $productController->countAllProds();
  $totalUsers = $userRepo->countAllusers();
  $totalAdmins = $adminRepo->countAlladmins();
  $users = $userRepo->getAllUsers();
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
      <p>Total users: <strong><?php echo $totalUsers; ?></strong> registered</p>
    </div>

    <div class="card">
      <h2>Admins</h2>
      <p>Total admins: <strong><?php echo $totalAdmins; ?></strong> registered</p>
    </div>

    <div class="card">
      <h2>Products</h2>
      <p>Total products: <strong><?php echo $totalProds; ?></strong> registered</p>
    </div>

    <table>
      <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
          </tr>
      </thead>
      <tbody>
          <?php foreach($users as $user): ?>
             <tr>
              <td>
                <?php echo htmlspecialchars($user['id']); ?></td>
                     <td><?php echo htmlspecialchars($user['name']); ?></td>
                     <td><?php echo htmlspecialchars($user['surname']); ?></td>
                     <td><?php echo htmlspecialchars($user['email']); ?></td>
              </tr>
         <?php endforeach; ?>
      </tbody>
</table>
    
  </div>
<body>
    
</body>
</html>