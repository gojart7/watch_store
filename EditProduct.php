<?php
include_once 'productController.php';
include_once 'brandController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['adminemail'])) {
    header('Location: adminLogin.php');
    exit;
}

$productController = new ProductController();
$product = null;
$brands = (new BrandRepository())->getAllBrands();

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
    $brand_id = $_POST['brand_id'];
    $newImage = $_FILES['image'];

    $productController->editProduct($id, $name, $description, $price,$brand_id, $newImage);
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
    <link rel="stylesheet" href="css/addEditProds.css">
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
            <div class="innerFormData">
                <div>
                    <label>Current Image:</label>
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Current Image" style="width: 100px; height: 100px;">
                    <label>Replace Image (Optional):</label>
                    <input type="file" name="image" accept="image/*">
                </div>

                <div>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
                    <label>Product Name:</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                    <label>Brand:</label>      
                    <select name="brand_id" required>
                        <option value="">Select a Brand</option>
                        <?php foreach ($brands as $brand): ?>
                            <option value="<?php echo htmlspecialchars($brand['id']); ?>" 
                                <?php echo $brand['id'] == $product['brand_id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($brand['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label>Description:</label>
                    <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
                    <label>Price in €:</label>
                    <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
                    <button type="submit" name="update">Update Product</button>
                </div>
            </div>
        </form>
    <?php else: ?>
        <p>Product not found.</p>
    <?php endif; ?>
</body>
</html>
