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
$brands = (new BrandRepository())->getAllBrands();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $brand_id = $_POST['brand_id'];
    $image = $_FILES['image'];

    $productController->addProduct($name, $description, $price,$brand_id, $image);
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
    <title>Add Product</title>
    <link rel="stylesheet" href="css/addEditProds.css">
    <script defer src="javascript/addProduct.js"></script>
</head>
<body>
    <div class="nav-links">
        <h1>Watch Store</h1>
        <a href="dashboard.php">Dashboard</a>
        <a href="AdminBrand.php">Brands</a>
        <a href="adminLogout.php">Logout</a>
    </div>

    <h2 class="mainTitle">Add Product</h2>

    <?php if (!empty($errMessage)): ?>
        <div class="error-message"><?php echo $errMessage; ?></div>
    <?php endif; ?>

    <?php if (!empty($successMessage)): ?>
        <div class="success-message"><?php echo $successMessage; ?></div>
    <?php endif; ?>

    <?php ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="innerFormData">
                <div>
                    <label>Upload Image:</label>
                    <div id="imagePreviewContainer">
                    <img id="imagePreview" src="" alt="Image Preview" style="display: none; width: 100px; height: 100px; margin-top: 10px;">
                    </div>
                    <input type="file" name="image" accept="image/*" onchange="previewImage(event)" required>
                </div>

                <div>
                    <label>Product Name:</label>
                    <input type="text" name="name" required>
                    <label>Brand:</label>      
                    <select name="brand_id" required>
                        <option value="">Select a Brand</option>
                        <?php foreach ($brands as $brand): ?>
                            <option value="<?php echo htmlspecialchars($brand['id']); ?>">
                                <?php echo htmlspecialchars($brand['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label>Description:</label>
                    <textarea name="description" required></textarea>
                    <label>Price in €:</label>
                    <input type="number" step="0.01" name="price" required>
                    <button type="submit" name="add">Add Product</button>
                </div>
            </div>
        </form>
</body>
</html>