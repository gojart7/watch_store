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
$product = null;

// pod exists?
if (isset($_GET['id'])) {
    $product = (new ProductRepository())->getProductById($_GET['id']);
    if (!$product) {
        die("Product not found.");
    }
}

// update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $newImage = $_FILES['image'];

    $productController->editProduct($id, $name, $description, $price, $newImage);
    $product = (new ProductRepository())->getProductById($id); // Refresh product details
    
    header('Location: AdminProduct.php');
    exit;
}

$errMessage = $productController->getErrorMessage();
$successMessage = $productController->getSuccedMessage();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="css/adminBrands.css">
</head>
<body>
    <div class="nav-links">
        <h1>Watch Store</h1>
        <a href="dashboard.php">Dashboard</a>
        <a href="AdminBrand.php">Brands</a>
        <a href="adminLogout.php">Logout</a>
    </div>

    <h2 class="mainTitle">Edit Product</h2>

    <?php if (!empty($errMessage)): ?>
        <div class="error-message"><?php echo $errMessage; ?></div>
    <?php endif; ?>

    <?php if (!empty($successMessage)): ?>
        <div class="success-message"><?php echo $successMessage; ?></div>
    <?php endif; ?>

    <?php if ($product): ?>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
            <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
            <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
            <label>Current Image:</label>
            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Current Image" style="width: 100px; height: 100px;">
            <label>Replace Image (Optional):</label>
            <input type="file" name="image" accept="image/*">
            <button type="submit" name="update">Update Product</button>
        </form>
    <?php else: ?>
        <p>Product not found.</p>
    <?php endif; ?>
</body>
</html>
