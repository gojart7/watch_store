<?php 
if(session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  
  if (!isset($_SESSION['adminemail'])) {
    header('Location: adminLogin.php');
    exit;
  }

  require_once 'brandController.php';

  $brandController = new BrandController();


// Handle Add Brand
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $brandController->addBrand($name, $description);
}

// Handle Delete Brand
if (isset($_GET['delete'])) {
    $brandController->deleteBrand($_GET['delete']);
    header('Location: AdminBrand.php');
}

  $brands= $brandController->getAllBrands();
  $errmessage = $brandController->getErrorMessage();
  $smessage = $brandController->getSuccedMessage();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brands</title>
    <link rel="stylesheet" href="css/adminBrands.css" />
</head>
<div class="nav-links">
    <h1>Watch Store</h1>
    <a href="dashboard.php">Dashboard</a>
    <a href="">Product</a>
    <a href="adminLogout.php">Logout</a>
  </div>
<body>
<h2 class="mainTitle">Manage Brands</h2>

    <?php if (!empty($errmessage)): ?>
        <div class="error-message"><?php echo $errmessage; ?></div>
    <?php endif; ?>

    <?php if (!empty($smessage)): ?>
        <div class="success-message"><?php echo $smessage; ?></div>
    <?php endif; ?>

<form method="POST">
    <input type="text" name="name" placeholder="Brand Name" required>
    <textarea name="description" placeholder="Brand Description" required></textarea>
    <button type="submit" name="add">Add Brand</button>
</form>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Brand Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($brands as $brand): ?>
            <tr>
            <td><?php echo htmlspecialchars($brand['id']); ?></td>
                    <td><?php echo htmlspecialchars($brand['name']); ?></td>
                    <td><?php echo htmlspecialchars($brand['description']); ?></td>
                    <td>
                        <a href="AdminBrand.php?delete=<?php echo $brand['id']; ?>" onclick="return confirm('Are you sure you want to delete this brand?')">Delete</a>
                    </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>