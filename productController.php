<?php 
include_once 'productRepository.php';

class ProductController{
    private $errorMessage;
    private $succedMessage;

    public function __construct(){
        $this->errorMessage="";
        $this->succedMessage="";
    }
    public function getAllProds()  {
        $repo = new ProductRepository();
        return $repo->getAllProducts();
    }
    public function addProduct($name, $description, $price, $brand_id,$image) {
        $repo = new ProductRepository();
    
        if (empty($name) || empty($description) || empty($price)) {
            $this->errorMessage = "All fields are required.";
            return;
        }
    
        if (!is_numeric($price) || $price <= 0) {
            $this->errorMessage = "Price must be a positive number.";
            return;
        }
        
        // upload img
        if ($image && $image['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'assets/storage/';
            $fileName = basename($image['name']);
            $uploadPath = $uploadDir . $fileName;
    
            // if dir not exists create
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
    
            // upload
            if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
                $repo->addProductToDatabase($name, $description, $price,$brand_id, $uploadPath);
                $this->succedMessage = "Product added successfully.";
            } else {
                $this->errorMessage = "Failed to upload the image.";
            }
        } else {
            $this->errorMessage = "Invalid image file.";
        }
    }    
    public function deleteProduct($id) {
        $repo = new ProductRepository();
    
        if (empty($id) || !is_numeric($id)) {
            $this->errorMessage = "Invalid product ID.";
            return;
        }
    
        $deleted = $repo->deleteProductById($id);
    
        if ($deleted) {
            $this->succedMessage = "Product deleted successfully.";
        } else {
            $this->errorMessage = "Failed to delete the product.";
        }
    }
    public function editProduct($id, $name, $description, $price, $brand_id, $newImage = null ) {
        $repo = new ProductRepository();
    
        // validity
        if (empty($name) || empty($description) || empty($price)) {
            $this->errorMessage = "All fields are required.";
            return;
        }
    
        if (!is_numeric($price) || $price <= 0) {
            $this->errorMessage = "Price must be a positive number.";
            return;
        }
    
        // Get prod
        $existingProduct = $repo->getProductById($id);
        if (!$existingProduct) {
            $this->errorMessage = "Product not found.";
            return;
        }
    
        $imagePath = $existingProduct['image'];
    
        // new img
        if ($newImage && $newImage['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'assets/storage/';
            $fileName = basename($newImage['name']);
            $uploadPath = $uploadDir . $fileName;
    
            // create dir
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
    
            //delete old img
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
    
            // upload img
            if (move_uploaded_file($newImage['tmp_name'], $uploadPath)) {
                $imagePath = $uploadPath; // Update the image path
            } else {
                $this->errorMessage = "Failed to upload the new image.";
                return;
            }
        }
    
        // update
        $updated = $repo->updateProduct($id, $name, $description, $price,$brand_id, $imagePath);
    
        if ($updated) {
            $this->succedMessage = "Product updated successfully.";
        } else {
            $this->errorMessage = "Failed to update the product.";
        }
    }
    
    public function getErrorMessage(){
        return $this->errorMessage;
    }

    public function getSuccedMessage(){
        return $this->succedMessage;
    }
}
?>