<?php 
include_once 'productController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['adminemail'])) {
    header('Location: adminLogin.php');
    exit;
}

$productController = new ProductController();

// delete
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['delete'])) {
    $productId = $_GET['delete'];

    $productController->deleteProduct($productId);
    $products = $productController->getAllProds(); // Refresh the product list
    header('Location: AdminProduct.php');
}

$products = $productController->getAllProds();
$errMessage = $productController->getErrorMessage();
$successMessage = $productController->getSuccedMessage();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="css/adminBrands.css">
</head>
<body>
    <div class="nav-links">
        <h1>Watch Store</h1>
        <a href="dashboard.php">Dashboard</a>
        <a href="AdminBrand.php">Brands</a>
        <a href="adminLogout.php">Logout</a>
    </div>

    <div class="mainTitleContainer">
        <h2 class="mainTitle">Manage Products</h2>
        <a id="addProd" href="AddProduct.php">Add</a>
    </div>

    <?php if (!empty($errMessage)): ?>
        <div class="error-message"><?php echo $errMessage; ?></div>
    <?php endif; ?>

    <?php if (!empty($successMessage)): ?>
        <div class="success-message"><?php echo $successMessage; ?></div>
    <?php endif; ?>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['id']); ?></td>
                    <td><img src="<?php echo str_replace('C:/laragon/www/', '/', htmlspecialchars($product['image'])); ?>" " alt="Product Image" style="width: 50px; height: 50px; border-radius: 5px;"></td>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo htmlspecialchars($product['brand_name']); ?></td>
                    <td><?php echo htmlspecialchars($product['description']); ?></td>
                    <td>€<?php echo htmlspecialchars($product['price']); ?></td>
                    <td>
                        <a href="AdminProduct.php?delete=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        <a class="editLink" href="EditProduct.php?id=<?php echo $product['id']; ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
